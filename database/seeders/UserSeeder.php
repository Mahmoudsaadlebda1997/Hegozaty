<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'phone_number' => '01000000000',
            'address' => 'Egypt',
            'email' => 'superAdmin@point.com',
            'role' => 'superAdmin',
            'password' => Hash::make('123456789'),
        ]);
    }
}
