<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'firstname' => 'Keya',
            'lastname' => 'Bhattacharjee',
            'email' => 'keya@reddensoft.com',
            'password' => Hash::make('123456'),
            'usertype' => 1,
        ]);
    }
}
