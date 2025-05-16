<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Awaludin', // Ganti dengan nama yang diinginkan
            'email' => 'awal72304@gmail.com',
            'email_verified_at' => now(), // Ganti dengan email yang diinginkan
            'password' => Hash::make('Admin#123'), // Ganti dengan password yang diinginkan
            'role' => 'cashier', // Pastikan ada kolom role jika Anda menggunakan role
        ]);
    }
}
