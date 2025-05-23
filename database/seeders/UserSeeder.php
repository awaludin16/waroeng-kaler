<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Awaludin', // Ganti dengan nama yang diinginkan
            'email' => 'awal72304@gmail.com',
            'email_verified_at' => now(), // Ganti dengan email yang diinginkan
            'password' => Hash::make('Admin#123'), // Ganti dengan password yang diinginkan
            'role' => 'cashier', // Pastikan ada kolom role jika Anda menggunakan role
        ]);
    }
}
