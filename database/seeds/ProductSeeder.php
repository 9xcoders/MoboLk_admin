<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'unique_id' => 'PRD-00000001',
                'name' => 'Samsung Galaxy A50',
                'slug' => 'samsung-galaxy-a50',
                'short_desc' => '',
                'long_desc' => '',
                'price' => 48500,
                'in_stock' => true,
                'brand_id' => 1,
                'category_id' => 1,
                'keywords' => 'samsung, mobile, phone, samsung, galaxy, galaxy A5, A50'
            ],
            [
                'unique_id' => 'PRD-00000002',
                'name' => 'Huawei P9',
                'slug' => 'huawei-p9',
                'short_desc' => '',
                'long_desc' => '',
                'price' => 52500,
                'in_stock' => true,
                'brand_id' => 2,
                'category_id' => 1,
                'keywords' => 'huawei, mobile, phone, huawei P9, P9'
            ],
            [
                'unique_id' => 'PRD-00000003',
                'name' => 'Apple IPhone 7',
                'slug' => 'apple-iphone-7',
                'short_desc' => '',
                'long_desc' => '',
                'price' => 95500,
                'in_stock' => true,
                'brand_id' => 3,
                'category_id' => 1,
                'keywords' => 'apple,iphone, mobile, phone, apple iphone 7, iphone 7'
            ],
        ]);
    }
}
