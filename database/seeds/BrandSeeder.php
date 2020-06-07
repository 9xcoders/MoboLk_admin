<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            ['name' => 'Samsung',
                'slug' => 'samsung',
                'image' => '/img/brands/a.png'
            ],
            ['name' => 'Huawei',
                'slug' => 'huawei',
                'image' => '/img/brands/a.png'
            ],
            ['name' => 'Apple',
                'slug' => 'apple',
                'image' => '/img/brands/a.png'
            ],
            ['name' => 'Oppo',
                'slug' => 'oppo',
                'image' => '/img/brands/a.png'
            ]
        ]);
    }
}
