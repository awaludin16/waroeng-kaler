<?php

use App\Http\Controllers\Kasir;
use App\Http\Controllers\Kasir\MenuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelanggan\MenuController as PelangganMenuController;
use App\Http\Controllers\Pelanggan\OrderController;
use App\Models\TableCafe as Meja;

Route::get('/', function () {
    $meja = Meja::query()->first();
    // dd($meja->nomor_meja);
    return redirect()->route('pelanggan.menu', $meja->nomor_meja);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('kasir/dashboard', [Kasir\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('kasir/menu', MenuController::class);
});

// Pelanggan
// Halaman menu berdasarkan QR (meja)
Route::get('/meja/{meja:nomor_meja}', [PelangganMenuController::class, 'index'])->name('pelanggan.menu');

// Simpan pesanan
Route::post('/pesan', [OrderController::class, 'store'])->name('pelanggan.pesan');

require __DIR__ . '/auth.php';
