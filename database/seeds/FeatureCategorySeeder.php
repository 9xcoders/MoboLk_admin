<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_categories')->insert([
            [
                'name' => 'Ram',
                'slug' => 'ram',
                'is_filter' => true
            ],
            [
                'name' => 'Storage',
                'slug' => 'storage',
                'is_filter' => true
            ],
            [
                'name' => 'Color',
                'slug' => 'color',
                'is_filter' => true
            ],
            [
                'name' => 'Warranty',
                'slug' => 'warranty',
                'is_filter' => false
            ]
        ]);
    }
}
