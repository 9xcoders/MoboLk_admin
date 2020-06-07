<?php

namespace App\Http\Controllers;

use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\FeatureCategoryRepository;
use App\Repository\FeatureRepository;
use App\Repository\ProductFeatureRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductVersionRepository;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Shakee93\FonoApi\FonoApi;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    private $productRepository;
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
                                ProductVersionRepository $productVersionRepository,
                                ProductFeatureRepository $productFeatureRepository,
                                FeatureCategoryRepository $featureCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->featureRepository = $featureRepository;
        $this->productRepository = $productRepository;
        $this->productVersionRepository = $productVersionRepository;
        $this->productFeatureRepository = $productFeatureRepository;
        $this->brandRepository = $brandRepository;
        $this->featureCategoryRepository = $featureCategoryRepository;
        $this->fonoapi = FonoApi::init($this->phonoKey);
    }

    public function index(Request $request)
    {

        $products = $this->productRepository->productsWithCategoriesOffset(20);
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
        $imageUrl = null;
        $productSlug = Str::slug($request->name, '-');

        if ($request->file('default_image')) {
            $image = $request->file('default_image');
            $filename = $productSlug . '.' . $image->getClientOriginalExtension();

            $directory = 'img/products/';
            $path = public_path($directory);
            if (!File::exists($path)) File::makeDirectory($path, 0755);

            $imageSave = Image::make($image);
            $imageSave->fit(600, 600);
            $imageSave->save($path . '/' . $filename);

            $imageUrl = url($directory . $filename);
        }
        $id = IdGenerator::generate(['table' => 'products', 'field' => 'unique_id', 'length' => 12, 'prefix' => 'PRD-']);

        $product = [
            'name' => $request->name,
            'slug' => $productSlug,
            'unique_id' => $id,
            'default_image' => $imageUrl,
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
//        dd($request->all());

        $product = $this->productRepository->find($id);

        if (!$product) {
            dd("Not found");
        }

        $imageUrl = null;
        $productSlug = Str::slug($request->name, '-');

        if ($request->file('default_image')) {
            $image = $request->file('default_image');
            $filename = $productSlug . '.' . $image->getClientOriginalExtension();

            $directory = 'img/products/';
            $path = public_path($directory);
            if (!File::exists($path)) File::makeDirectory($path, 0755);

            $imageSave = Image::make($image);
            $imageSave->fit(250, 150);
            $imageSave->save($path . '/' . $filename);

            $imageUrl = url($directory . $filename);
            $product->default_image = $imageUrl;
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


    public function versionIndex(Request $request)
    {
        dd($request->all());
    }

    public function versionCreate(Request $request)
    {
        dd($request->all());
    }

    public function versionStore(Request $request)
    {
        $productSlug = Str::slug($request->name, '-');

        $id = IdGenerator::generate(['table' => 'product_versions', 'field' => 'unique_id', 'length' => 12, 'prefix' => 'VRN-']);

        $productSlug .= '_' . $productSlug;
        foreach ($request->features as $feature) {
            $productSlug .= $this->featureRepository->find($feature)->slug . '-';
        }

        $productSlug = rtrim($productSlug, '-');

        $version = [
            'name' => $request->name,
            'unique_id' => $id,
            'product_id' => $request->product_id,
            'slug' => $productSlug,
            'price' => $request->price,
            'off_price' => $request->off_price,
            'in_stock' => $request->in_stock ? true : false,
            'features' => json_encode($request->features)
        ];

//        dd($version);
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
            dd($inserted);
        }

    }
}
