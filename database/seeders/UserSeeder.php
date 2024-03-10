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
            'phone' => '01000000000',
            'email' => 'admin@booking.com',
            'role' => 'admin',
            'password' => Hash::make('123456789'),
        ]);
    }
}
