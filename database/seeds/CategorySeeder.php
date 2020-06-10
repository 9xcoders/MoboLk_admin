<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Mobile Phones',
                'slug' => 'mobile-phones',
                'image_url' => env('BASE_PATH') . 'img/categories/mobile-phones.png'
            ],
            [
                'name' => 'Tablets',
                'slug' => 'tablets',
                'image_url' => env('BASE_PATH') . 'img/categories/tablets.png'
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'image_url' => env('BASE_PATH') . 'img/categories/accessories.png'
            ],
            [
                'name' => 'Gadgets',
                'slug' => 'gadgets',
                'image_url' => env('BASE_PATH') . 'img/categories/gadgets.png'
            ],
            [
                'name' => 'Wearables',
                'slug' => 'wearables',
                'image_url' => env('BASE_PATH') . 'img/categories/wearables.png'
            ]
        ]);
    }
}
