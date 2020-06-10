<?php

namespace App\Http\Controllers;

use App\Repository\BannerImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Image;

class BannerImageController extends Controller
{
    private $bannerImageRepository;

    public function __construct(BannerImageRepository $bannerImageRepository)
    {
        $this->bannerImageRepository = $bannerImageRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $images = $this->bannerImageRepository->all();

        $data = [
            'title' => 'Banner Image List',
            'images' => $images
        ];
        return view('banner-image.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();

            $directory = 'img/banners/';
            $path = public_path($directory);
            if (!File::exists($path)) File::makeDirectory($path, 0755);

            $imageSave = Image::make($image);
            $imageSave->fit(2500, 715);
            $imageSave->save($path . '/' . $filename);

            $imageUrl = url($directory . $filename);
        }

        $bannerImage = [
            'image_url' => $imageUrl
        ];

        $inserted = $this->bannerImageRepository->create($bannerImage);

        if ($inserted) {
            return redirect()->route('banner-image.index');

        }

        return null;
    }


    public function delete(Request $request, $id)
    {
        $brand = $this->bannerImageRepository->find($id);
        if (!$brand) {
            dd("Not found");
        }
        $this->bannerImageRepository->delete($brand->id);
        return redirect()->route('banner-image.index');

    }
}
