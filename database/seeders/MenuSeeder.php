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
            [
                'kategori_id' => 2,
                'nama_menu' => 'Americano',
                'harga' => 15000,
                'deskripsi' => 'Satu hingga 10 teguk espresso dan delapan hingga 12 ons air panas.',
                'gambar' => 'iced-americano-6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 3,
                'nama_menu' => 'Pisang Goreng Keju',
                'harga' => 17000,
                'deskripsi' => 'Pisang goreng renyah dengan taburan keju dan cokelat.',
                'gambar' => 'maxresdefault.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 3,
                'nama_menu' => 'Risoles Mayo',
                'harga' => 10000,
                'deskripsi' => 'Risoles dengan isian sosis dan mayones, dibalut tepung roti.',
                'gambar' => '62e35a47c7535.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 2,
                'nama_menu' => 'Green Tea Latte',
                'harga' => 23000,
                'deskripsi' => 'Latte hijau dengan aroma teh Jepang.',
                'gambar' => 'Starbucks-Iced-Matcha-Green-Tea-Latte-7-of-16.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 1,
                'nama_menu' => 'Ayam Geprek + Sangu',
                'harga' => 29000,
                'deskripsi' => 'Ayam goreng digeprek lalu ditambhain sangu',
                'gambar' => '10a71c00-230f-4161-8fba-4bf04489300f_722a1ba8-4b9c-4877-9896-bd70320a6f84_Go-Biz_20200419_203339.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 2,
                'nama_menu' => 'Chocolate Milkshake',
                'harga' => 22000,
                'deskripsi' => 'Milkshake cokelat dengan krim kocok di atasnya.',
                'gambar' => 'IMG_2377-5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 1,
                'nama_menu' => 'Mie Goreng Jawa',
                'harga' => 27000,
                'deskripsi' => 'Mie goreng khas Jawa dengan rasa manis gurih.',
                'gambar' => 'mie-goreng-jawa-500x300.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 2,
                'nama_menu' => 'Cappuccino',
                'harga' => 25000,
                'deskripsi' => 'Kopi susu dengan foam lembut di atasnya.',
                'gambar' => 'cappucino-selber-machen.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 1,
                'nama_menu' => 'Nasi Goreng Spesial',
                'harga' => 35000,
                'deskripsi' => 'Nasi goreng dengan topping telur, ayam, dan kerupuk.',
                'gambar' => 'OIP.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 2,
                'nama_menu' => 'Matcha Latte',
                'harga' => 27000,
                'deskripsi' => 'Minuman teh hijau dengan susu dan rasa manis lembut.',
                'gambar' => 'hot-and-iced-matcha-latte-3-1024x1536.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 3,
                'nama_menu' => 'French Fries',
                'harga' => 18000,
                'deskripsi' => 'Kentang goreng renyah disajikan dengan saus.',
                'gambar' => 'Kentang-goreng.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 2,
                'nama_menu' => 'Es Teh Manis',
                'harga' => 8000,
                'deskripsi' => 'Teh segar dengan tambahan gula batu dan es.',
                'gambar' => 'Gambar-Es-Teh-Manis-6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
