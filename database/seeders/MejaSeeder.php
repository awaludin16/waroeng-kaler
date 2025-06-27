<?php

namespace Database\Seeders;

use App\Models\TableCafe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            TableCafe::create([
                'nomor_meja' => $i,
                'qr_code' => 'qrcode_meja_' . $i,
            ]);
        }
    }
}
