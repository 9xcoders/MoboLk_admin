<?php

namespace App\Http\Controllers;

use App\Repository\ShopSettingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Image;

class ShopSettingsController extends Controller
{
    private $shopSettingsRepository;

    public function __construct(ShopSettingsRepository $shopSettingsRepository)
    {
        $this->middleware('auth');
        $this->shopSettingsRepository = $shopSettingsRepository;
    }

    public function index()
    {
        $data = [
            'title' => 'Shop Settings',
            'settings' => $this->shopSettingsRepository->shopSettings()
        ];

        return view('shop-settings', compact('data'));
    }

    public function store(Request $request)
    {
        $params = $request->except('_token');
        $validator = Validator::make($params, [
            'shop_name' => 'required|max:255',
            'address_line_1' => 'required|max:255',
            'shop_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imageUrl = '';
        if ($request->file('shop_logo')) {
            $image = $request->file('shop_logo');
            $filename = $image->getClientOriginalName();

            $directory = 'img/shop/';
            $path = public_path($directory);
            if (!File::exists($path)) File::makeDirectory($path, 0755);

            $imageSave = Image::make($image);
            $imageSave->fit(250, 150);
            $imageSave->save($path . '/' . $filename);

            $imageUrl = url($directory . $filename);
            $params['shop_logo'] = $imageUrl;
        }
        $settings = $this->shopSettingsRepository->shopSettings();

        if ($settings) {

            $settings->shop_name = $params['shop_name'];
            if ($imageUrl){
                $settings->shop_logo = $params['shop_logo'];
            }

            $settings->address_line_1 = $params['address_line_1'];
            $settings->address_line_2 = $params['address_line_2'];
            $settings->address_line_3 = $params['address_line_3'];
            $settings->address_line_4 = $params['address_line_4'];
            $settings->latitude = $params['latitude'];
            $settings->longitude = $params['longitude'];
            $settings->hotline = $params['hotline'];
            $settings->mobile = $params['mobile'];
            $settings->tel = $params['tel'];
            $settings->email = $params['email'];
            $settings->facebook_link = $params['facebook_link'];
            $settings->instagram_link = $params['instagram_link'];
            $settings->twitter_link = $params['twitter_link'];
            $settings->youtube_link = $params['youtube_link'];

            $settings->save();

        } else {
            $inserted = $this->shopSettingsRepository->create($params);
        }


        return redirect()->route('shop-settings.index');
    }
}
