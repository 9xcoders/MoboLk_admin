<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brand_categories')->insert([
            ['brand_id' => 1, 'category_id' => 1, 'show_home' => true],
            ['brand_id' => 2, 'category_id' => 1, 'show_home' => true],
            ['brand_id' => 3, 'category_id' => 1, 'show_home' => true],
            ['brand_id' => 4, 'category_id' => 1, 'show_home' => false],
            ['brand_id' => 1, 'category_id' => 2, 'show_home' => false],
            ['brand_id' => 1, 'category_id' => 3, 'show_home' => false],
        ]);
    }
}
