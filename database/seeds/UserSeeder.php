<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('abcd@1234'),
                'email' => 'admin@mobo.lk'
            ],
            [
                'name' => 'Webmaster',
                'password' => \Illuminate\Support\Facades\Hash::make('1234@abcd'),
                'email' => 'webmaster@mobo.lk'
            ]
        ]);
    }
}
