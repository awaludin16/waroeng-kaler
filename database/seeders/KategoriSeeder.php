<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = ['Makanan', 'Minuman', 'Cemilan'];
        foreach ($kategori as $item) {
            Category::create(['nama_kategori' => $item]);
        }
    }
}
