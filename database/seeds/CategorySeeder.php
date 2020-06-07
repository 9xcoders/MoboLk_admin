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
            ['name' => 'Mobile Phones',
                'slug' => 'mobile-phones'],
            ['name' => 'Tablets',
                'slug' => 'tablets'],
            ['name' => 'Accessories',
                'slug' => 'accessories'],
            ['name' => 'Gadgets',
                'slug' => 'gadgets']
        ]);
    }
}
