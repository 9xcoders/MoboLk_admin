<?php

namespace App\Http\Controllers;

use App\Repository\BrandCategoryRepository;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Image;

class BrandController extends Controller
{
    private $categoryRepository;
    private $brandRepository;
    private $brandCategoryRepository;

    public function __construct(CategoryRepository $categoryRepository,
                                BrandRepository $brandRepository,
                                BrandCategoryRepository $brandCategoryRepository)
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->brandCategoryRepository = $brandCategoryRepository;
    }

    public function index()
    {
        $brands = $this->brandRepository->brandsWithCategories();

        foreach ($brands as $brand) {
            $brand->categoryNames = "";
            foreach ($brand->brandCategories as $category) {
                $brand->categoryNames .= $category->category->name . ", ";
            }
            $brand->categoryNames = rtrim($brand->categoryNames, ", ");
        }

        $data = [
            'title' => 'Brands',
            'brands' => $brands
        ];

        return view('brand.index', compact('data'));
    }

    public function create(Request $request)
    {
        $categories = $this->categoryRepository->all();

        $data = [
            'title' => 'Add Brand',
            'categories' => $categories
        ];

        return view('brand.add-edit', compact('data'));
    }

    public function store(Request $request)
    {
        $imageUrl = null;
        $brandSlug = Str::slug($request->name, '-');

        $params = $request->except('_token');
        $params['slug'] = $brandSlug;

        $customAttributes = [
            'name' => 'Name',
            'slug' => 'Name',
        ];

        $validator = Validator::make($params, [
            'name' => 'required|max:255',
            'categories' => 'required',
            'slug' => 'required|unique:brands,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [], $customAttributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $filename = $brandSlug . '.' . $image->getClientOriginalExtension();

            $directory = 'img/brands/';
            $path = public_path($directory);
            if (!File::exists($path)) File::makeDirectory($path, 0755);

            $imageSave = Image::make($image);
            $imageSave->resize(150, 100);
            $imageSave->save($path . '/' . $filename);

            $imageUrl = url($directory . $filename);
        }
        $showHomes = $request->show_home ? $request->show_home : [];

        $brand = [
            'name' => $request->name,
            'slug' => $brandSlug,
            'image' => $imageUrl
        ];

        $showHomeArray = array_intersect($request->categories, $showHomes);

//        dd($showHomeArray);

        $inserted = $this->brandRepository->create($brand);


        if ($inserted) {

            $brandCategories = [];

            foreach ($request->categories as $category) {
                $brandCategories[] = [
                    'brand_id' => $inserted->id,
                    'category_id' => $category,
                    'show_home' => in_array($category, $showHomeArray) ? true : false
                ];
            }
            $brandCategoryInserted = $this->brandCategoryRepository->insert($brandCategories);
            return redirect()->route('brand.index');


        }
        return null;
    }

    public function edit(Request $request, $id)
    {
        $categories = $this->categoryRepository->all();
        $brand = $this->brandRepository->brandWithCategories($id);

        if (!$brand) {
            dd("Not found");
        }

        foreach ($categories as $category) {
            $category->checked = false;
            $category->showHome = false;
            foreach ($brand->brandCategories as $brandCategory) {
                if ($brandCategory->category->id === $category->id) {
                    $category->checked = true;

                    if ($brandCategory->show_home) {
                        $category->showHome = true;
                    }

                }
            }
        }

//        dd($categories);

        $data = [
            'title' => 'Edit Brand',
            'categories' => $categories,
            'brand' => $brand
        ];

        return view('brand.add-edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $params = $request->all();
        $brand = $this->brandRepository->find($id);

        if ($brand) {

            $imageUrl = null;
            $brandSlug = Str::slug($request->name, '-');

            $params['slug'] = $brandSlug;
            $customAttributes = [
                'name' => 'Name',
                'slug' => 'Name',
            ];

            $validator = Validator::make($params, [
                'name' => 'required|max:255',
                'categories' => 'required',
                'slug' => ['required', Rule::unique('brands', 'slug')->ignore($id, 'id')],
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ], [], $customAttributes);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->file('image')) {
                $image = $request->file('image');
                $filename = $brandSlug . '.' . $image->getClientOriginalExtension();

                $directory = 'img/brands/';
                $path = public_path($directory);
                if (!File::exists($path)) File::makeDirectory($path, 0755);

                $imageSave = Image::make($image);
                $imageSave->resize(150, 100);
                $imageSave->save($path . '/' . $filename);

                $imageUrl = url($directory . $filename);
                $brand->image = $imageUrl;
            }

            $brand->name = $request->name;
            $brand->slug = $brandSlug;

            $brand->save();

            $brandCategories = $brand->brandCategories;
            $categories = $request->categories;

            $showHomes = $request->show_home ? $request->show_home : [];

            $showHomeArray = array_intersect($request->categories, $showHomes);


            $toDelete = [];

//            foreach ($brandCategories as $brandCategory) {
//                if (!in_array($brandCategory->category_id, $categories)) {
//                    $toDelete[] = $brandCategory->id;
//                }
//            }
            foreach ($brandCategories as $brandCategory) {
                $this->brandCategoryRepository->delete($brandCategory->id);
            }

            foreach ($categories as $category) {
                $brandCategory = [
                    'brand_id' => $brand->id,
                    'category_id' => $category,
                    'show_home' => in_array($category, $showHomeArray) ? true : false
                ];

                $this->brandCategoryRepository->create($brandCategory);
            }

//            if (count($toDelete) > 0) {
//                $this->brandCategoryRepository->delete($toDelete);
//            }

            return redirect()->route('brand.index');
        } else {
            dd("Not found");
        }
    }

    public function delete(Request $request, $id)
    {
        $brand = $this->brandRepository->brandWithCategories($id);
        if (!$brand) {
            dd("Not found");
        }
        $this->brandRepository->delete($brand->id);
        $this->brandCategoryRepository->deleteByBrand($brand->id);
        return redirect()->route('brand.index');

    }

    public function brandByCategory(Request $request)
    {
        $brands = $this->brandRepository->brandByCategory($request->categoryId);
        return response()->json($brands);
    }
}
