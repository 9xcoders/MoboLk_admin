<?php

namespace App\Http\Controllers;

use App\Repository\CategoryRepository;
use App\Repository\HotDealRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Image;

class HotDealController extends Controller
{
    private $hotDealRepository;
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository,
                                HotDealRepository $hotDealRepository)
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
        $this->hotDealRepository = $hotDealRepository;
    }

    public function index()
    {
        $hotDeals = $this->hotDealRepository->all();

        $data = [
            'title' => 'Hot Deal List',
            'hotDeals' => $hotDeals
        ];

        return view('hot-deal.index', compact('data'));
    }

    public function create(Request $request)
    {
        $categories = $this->categoryRepository->all();
        $data = [
            'title' => 'Add Hot Deal',
            'categories' => $categories
        ];

        return view('hot-deal.add-edit', compact('data'));
    }

    public function store(Request $request)
    {
        $imageUrl = null;

        $params = $request->except('_token');

        $customAttributes = [
            'category_id' => 'Category',
        ];

        $validator = Validator::make($params, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required|max:500',
            'button_text' => 'required:max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [], $customAttributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();

            $directory = 'img/deals/';
            $path = public_path($directory);
            if (!File::exists($path)) File::makeDirectory($path, 0755);

            $imageSave = Image::make($image);
            $imageSave->save($path . '/' . $filename);

            $imageUrl = url($directory . $filename);
        }

        $hotDeal = [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'button_text' => $request->button_text,
            'image_url' => $imageUrl
        ];

        $inserted = $this->hotDealRepository->create($hotDeal);

        if ($inserted) {
            return redirect()->route('hot-deal.index');
        }
        return null;
    }

    public function edit(Request $request, $id)
    {
        $hotDeal = $this->hotDealRepository->find($id);

        if (!$hotDeal) {
            dd("Not found");
        }
        $categories = $this->categoryRepository->all();

        $data = [
            'title' => 'Edit Hot Deal',
            'hotDeal' => $hotDeal,
            'categories' => $categories
        ];

        return view('hot-deal.add-edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $params = $request->all();
        $hotDeal = $this->hotDealRepository->find($id);

        if ($hotDeal) {

            $imageUrl = null;

            $customAttributes = [
                'category_id' => 'Category',
            ];

            $validator = Validator::make($params, [
                'title' => 'required|max:255',
                'category_id' => 'required',
                'description' => 'required|max:500',
                'button_text' => 'required:max:20',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ], [], $customAttributes);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->file('image')) {
                $image = $request->file('image');
                $filename = $image->getClientOriginalName();

                $directory = 'img/deals/';
                $path = public_path($directory);
                if (!File::exists($path)) File::makeDirectory($path, 0755);

                $imageSave = Image::make($image);
                $imageSave->save($path . '/' . $filename);

                $imageUrl = url($directory . $filename);
                $hotDeal->image_url = $imageUrl;
            }

            $hotDeal->title = $request->title;
            $hotDeal->description = $request->description;
            $hotDeal->button_text = $request->button_text;
            $hotDeal->category_id = $request->category_id;

            $hotDeal->save();

            return redirect()->route('hot-deal.index');
        } else {
            dd("Not found");
        }
    }

    public function delete(Request $request, $id)
    {
        $hotDeal = $this->hotDealRepository->find($id);
        if (!$hotDeal) {
            dd("Not found");
        }
        $this->hotDealRepository->delete($hotDeal->id);
        return redirect()->route('hot-deal.index');

    }

}
