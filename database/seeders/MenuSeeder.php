<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['kategori_id' => 1, 'nama_menu' => 'Nasi Goreng', 'deskripsi' => 'Nasi goreng spesial', 'harga' => 15000],
            ['kategori_id' => 2, 'nama_menu' => 'Es Teh Manis', 'deskripsi' => 'Teh manis dingin', 'harga' => 5000,],
            ['kategori_id' => 3, 'nama_menu' => 'Kentang Goreng', 'deskripsi' => 'Kentang crispy', 'harga' => 10000,],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
