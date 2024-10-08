<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Raj', // Correct column name
            'last_name' => 'Mohan', // Correct column name
            'email' => 'rajmohan12@gmail.com',
            'password' => Hash::make('rajmohan@123'),
            'role'=>2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
