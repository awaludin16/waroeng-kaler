<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Owner Kedai',
                'email' => 'owner@kedai.com',
                'password' => Hash::make('password123'),
                'role' => 'owner',
                'remember_token' => null,
            ],
            [
                'name' => 'Kasir Kedai',
                'email' => 'kasir@kedai.com',
                'password' => Hash::make('password123'),
                'role' => 'kasir',
                'remember_token' => null,
            ],
        ]);
    }
}
