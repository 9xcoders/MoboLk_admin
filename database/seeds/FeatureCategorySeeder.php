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
                'add_multi' => false
            ],
            [
                'name' => 'Storage',
                'slug' => 'storage',
                'add_multi' => false
            ],
            [
                'name' => 'Color',
                'slug' => 'color',
                'add_multi' => true
            ]
        ]);
    }
}
