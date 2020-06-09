<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\FeatureCategoryRepository;
use App\Repository\FeatureRepository;
use App\Repository\ProductFeatureRepository;
use App\Repository\ProductImageRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductVersionRepository;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Shakee93\FonoApi\FonoApi;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    private $productRepository;
    private $productImageRepository;
    private $categoryRepository;
    private $featureRepository;
    private $brandRepository;
    private $featureCategoryRepository;
    private $productVersionRepository;
    private $productFeatureRepository;
    private $phonoKey = '07098efc8fc0637d5221f2c41b665331f1779a55ac7b6cf6';
    private $fonoapi;

    public function __construct(CategoryRepository $categoryRepository,
                                BrandRepository $brandRepository,
                                FeatureRepository $featureRepository,
                                ProductRepository $productRepository,
                                ProductImageRepository $productImageRepository,
                                ProductVersionRepository $productVersionRepository,
                                ProductFeatureRepository $productFeatureRepository,
                                FeatureCategoryRepository $featureCategoryRepository)
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
        $this->featureRepository = $featureRepository;
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;
        $this->productVersionRepository = $productVersionRepository;
        $this->productFeatureRepository = $productFeatureRepository;
        $this->brandRepository = $brandRepository;
        $this->featureCategoryRepository = $featureCategoryRepository;
        $this->fonoapi = FonoApi::init($this->phonoKey);
    }

    public function index(Request $request)
    {

        $products = $this->productRepository->productsWithCategories();
        $data = [
            'title' => 'Products',
            'products' => $products
        ];

        return view('product.index', compact('data'));
    }

    public function create(Request $request)
    {
        $categories = $this->categoryRepository->all();

        $data = [
            'title' => 'Add Product',
            'categories' => $categories
        ];

        return view('product.add-edit', compact('data'));
    }

    public function store(Request $request)
    {

        $params = $request->all();
        $productSlug = Str::slug($request->name, '-');

        $params['slug'] = $productSlug;


        $customAttributes = [
            'name' => 'Product name',
            'slug' => 'Product name',
            'category_id' => 'Category',
            'price' => 'Price',
            'short_desc' => 'Short description',
        ];

        $validator = Validator::make($params, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:products,slug',
            'category_id' => 'required',
            'price' => 'required',
            'short_desc' => 'required',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [], $customAttributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $imageUrls = [];

        if ($request->file('product_images')) {

            foreach ($request->file('product_images') as $image) {
                $filename = $productSlug . '-' . Carbon::now()->timestamp . rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                $directory = 'img/products/';
                $path = public_path($directory);
                if (!File::exists($path)) File::makeDirectory($path, 0755);

                $imageSave = Image::make($image);
                $imageSave->fit(600, 600);
                $imageSave->save($path . '/' . $filename);

                $imageUrls[] = url($directory . $filename);
            }
        }
        $id = IdGenerator::generate(['table' => 'products', 'field' => 'unique_id', 'length' => 12, 'prefix' => 'PRD-']);

        $product = [
            'name' => $request->name,
            'slug' => $productSlug,
            'unique_id' => $id,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'price' => $request->price,
            'off_price' => $request->off_price,
            'in_stock' => $request->in_stock ? true : false,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'keywords' => $request->keywords,
        ];
        $inserted = $this->productRepository->create($product);
        if ($inserted) {


            $imageArray = [];
            foreach ($imageUrls as $imageUrl) {
                $imageArray[] = [
                    'product_id' => $inserted->id,
                    'image_url' => $imageUrl,
                    'is_version' => false
                ];
            }
            $this->productImageRepository->insert($imageArray);

            return redirect()->route('product.index');
        }
        return null;
    }

    public function edit(Request $request)
    {
        $categories = $this->categoryRepository->all();
        $product = $this->productRepository->productWithEverythingById($request->id);


        if (!$product) {
            dd("Not found");
        }

        $data = [
            'title' => 'Edit Product',
            'categories' => $categories,
            'brands' => $brands = $this->brandRepository->brandByCategory($product->category_id),
            'product' => $product,
            'featureCategories' => $this->featureCategoryRepository->featureCategoriesWithFeatures()
        ];

        return view('product.add-edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepository->find($id);

        $imageUrl = null;
        $params = $request->all();
        $productSlug = Str::slug($request->name, '-');

        $params['slug'] = $productSlug;

        $customAttributes = [
            'name' => 'Product name',
            'slug' => 'Product name',
            'category_id' => 'Category',
            'price' => 'Price',
            'short_desc' => 'Short description',
        ];

        $validator = Validator::make($params, [
            'name' => 'required|max:255',
            'slug' => ['required', Rule::unique('products', 'slug')->ignore($id, 'id')],
            'category_id' => 'required',
            'price' => 'required',
            'short_desc' => 'required',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [], $customAttributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!$product) {
            dd("Not found");
        }


        $imageUrls = [];

        if ($request->file('product_images')) {

            foreach ($request->file('product_images') as $image) {
                $filename = $productSlug . '-' . Carbon::now()->timestamp . rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                $directory = 'img/products/';
                $path = public_path($directory);
                if (!File::exists($path)) File::makeDirectory($path, 0755);

                $imageSave = Image::make($image);
                $imageSave->fit(600, 600);
                $imageSave->save($path . '/' . $filename);

                $imageUrls[] = url($directory . $filename);
            }
        }

        $product->name = $request->name;
        $product->slug = $productSlug;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->in_stock = $request->in_stock ? true : false;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;
        $product->price = $request->price;
        $product->off_price = $request->off_price;
        $product->keywords = $request->keywords;
        $product->save();

        $imageArray = [];
        foreach ($imageUrls as $imageUrl) {
            $imageArray[] = [
                'product_id' => $product->id,
                'image_url' => $imageUrl,
                'is_version' => false
            ];
        }
        $this->productImageRepository->insert($imageArray);

        return redirect()->route('product.index');
    }

    public function delete(Request $request, $id)
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            dd("Not found");
        }
        $this->productRepository->delete($product->id);
        return redirect()->route('product.index');

    }

    public function deleteProductImage(Request $request, $id)
    {
        $productImage = $this->productImageRepository->find($id);
        if (!$productImage) {
            dd("Not found");
        }
        $this->productImageRepository->delete($productImage->id);
        return redirect()->route('product.index');

    }


    public function versionIndex(Request $request)
    {
        dd($request->all());
    }

    public function versionCreate(Request $request)
    {
        $data = [
            'title' => 'Add Version',
            'product' => $product = $this->productRepository->find($request->id),
            'featureCategories' => $this->featureCategoryRepository->featureCategoriesWithFeatures()
        ];

        return view('version.add-edit', compact('data'));
    }

    public function versionStore(Request $request, $id)
    {
        $params = $request->all();
        $productSlug = Str::slug($request->name, '-');

        $productSlug .= '_';
        foreach ($request->features as $feature) {
            $productSlug .= $this->featureRepository->find($feature)->slug . '-';
        }

        $productSlug = rtrim($productSlug, '-');

        $params['slug'] = $productSlug;


        $customAttributes = [
            'name' => 'Name',
            'slug' => 'Name',
            'price' => 'Price'
        ];

        $validator = Validator::make($params, [
            'name' => 'required|max:255',
            'slug' => 'required|unique:product_versions,slug',
            'price' => 'required',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [], $customAttributes);


        $imageUrls = [];

        if ($request->file('product_images')) {

            foreach ($request->file('product_images') as $image) {
                $filename = $productSlug . '-' . Carbon::now()->timestamp . rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                $directory = 'img/products/';
                $path = public_path($directory);
                if (!File::exists($path)) File::makeDirectory($path, 0755);

                $imageSave = Image::make($image);
                $imageSave->fit(600, 600);
                $imageSave->save($path . '/' . $filename);

                $imageUrls[] = url($directory . $filename);
            }
        }


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $versionId = IdGenerator::generate(['table' => 'product_versions', 'field' => 'unique_id', 'length' => 12, 'prefix' => 'VRN-']);


        $version = [
            'name' => $request->name,
            'unique_id' => $versionId,
            'product_id' => $request->product_id,
            'slug' => $productSlug,
            'price' => $request->price,
            'off_price' => $request->off_price,
            'in_stock' => $request->in_stock ? true : false,
            'features' => json_encode($request->features)
        ];

        $inserted = $this->productVersionRepository->create($version);

        if ($inserted) {
            $productFeatures = [];
            foreach ($request->features as $feature) {
                $productFeatures[] = [
                    'product_id' => $inserted->id,
                    'is_version' => true,
                    'feature_id' => $feature
                ];
            }
            $this->productFeatureRepository->insert($productFeatures);

            $imageArray = [];
            foreach ($imageUrls as $imageUrl) {
                $imageArray[] = [
                    'product_id' => $inserted->id,
                    'image_url' => $imageUrl,
                    'is_version' => true
                ];
            }
            $this->productImageRepository->insert($imageArray);


            return redirect()->route('product.edit', ['id' => $id])->with('isVersion', true);
        }

        return null;
    }

    public function versionEdit(Request $request, $id, $versionId)
    {
        $version = $this->productVersionRepository->productVersionWithEverythingById($versionId);

        $featureCats = $this->featureCategoryRepository->featureCategoriesWithFeatures();

        foreach ($featureCats as $featureCat) {

            foreach ($featureCat->features as $feature) {
                $feature->selected = false;
                foreach ($version->productFeatures as $productFeature) {
                    if ($feature->id == $productFeature->feature->id) {
                        $feature->selected = true;
                    }
                }
            }
        }


        if (!$version) {
            dd("Not found");
        }

        $data = [
            'title' => 'Add Version',
            'product' => $product = $this->productRepository->find($request->id),
            'featureCategories' => $featureCats,
            'version' => $version
        ];

        return view('version.add-edit', compact('data'));
    }

    public function versionUpdate(Request $request, $id, $versionId)
    {
        $version = $this->productVersionRepository->find($versionId);

        if (!$version) {
            dd("Not found");
        }


        $params = $request->all();

        $productSlug = Str::slug($request->name, '-');
        $productSlug .= '_';
        foreach ($request->features as $feature) {
            $productSlug .= $this->featureRepository->find($feature)->slug . '-';
        }

        $productSlug = rtrim($productSlug, '-');
        $params['slug'] = $productSlug;

        $imageUrls = [];

        if ($request->file('product_images')) {

            foreach ($request->file('product_images') as $image) {
                $filename = $productSlug . '-' . Carbon::now()->timestamp . rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                $directory = 'img/products/';
                $path = public_path($directory);
                if (!File::exists($path)) File::makeDirectory($path, 0755);

                $imageSave = Image::make($image);
                $imageSave->fit(600, 600);
                $imageSave->save($path . '/' . $filename);

                $imageUrls[] = url($directory . $filename);
            }
        }

        $customAttributes = [
            'name' => 'Name',
            'slug' => 'Name',
            'price' => 'Price',
        ];

        $validator = Validator::make($params, [
            'name' => 'required|max:255',
            'slug' => ['required', Rule::unique('product_versions', 'slug')->ignore($id, 'id')],
            'price' => 'required',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [], $customAttributes);

//        dd($validator->errors());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $version->name = $request->name;
        $version->slug = $productSlug;
        $version->in_stock = $request->in_stock ? true : false;
        $version->price = $request->price;
        $version->off_price = $request->off_price;
        $version->features = json_encode($request->features);


        $version->save();


        $version->productFeatures()->delete();

        $productFeatures = [];
        foreach ($request->features as $feature) {
            $productFeatures[] = [
                'product_id' => $version->id,
                'is_version' => true,
                'feature_id' => $feature
            ];
        }
        $this->productFeatureRepository->insert($productFeatures);

        $imageArray = [];
        foreach ($imageUrls as $imageUrl) {
            $imageArray[] = [
                'product_id' => $version->id,
                'image_url' => $imageUrl,
                'is_version' => true
            ];
        }
        $this->productImageRepository->insert($imageArray);

        return redirect()->route('product.edit', ['id' => $id])->with('isVersion', true);
    }

    public function versionDelete(Request $request, $id, $versionId)
    {
        $version = $this->productVersionRepository->find($versionId);
        if (!$version) {
            dd("Not found");
        }
        $this->productVersionRepository->delete($version->id);
        return redirect()->route('product.edit', ['id' => $id])->with('isVersion', true);

    }


}
