<?php

use App\Http\Controllers\Kasir;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelanggan\MenuController as PelangganMenuController;
use App\Http\Controllers\Pelanggan\OrderController;
use App\Http\Controllers\Pelanggan\PaymentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\TableCafe as Meja;

Route::get('/', function () {
    $meja = Meja::inRandomOrder()->first(); // random nomor meja

    // $meja = Meja::query()->first(); // data meja
    return redirect()->route('pelanggan.menu', $meja->nomor_meja);
});

Route::middleware(['auth', 'web'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('dashboard', [Kasir\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('menus', Kasir\MenuController::class);

    Route::get('/orders/masuk', [Kasir\OrderController::class, 'orderIn'])->name('orders.pending');
    Route::put('/orders/{order}/update-status', [Kasir\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::resource('orders', Kasir\OrderController::class);

    Route::get('/laporan', [Kasir\ReportController::class, 'laporanKategori'])->name('laporan.index');
    Route::get('/laporan/export/pdf', [Kasir\ReportController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/laporan/export/excel', [Kasir\ReportController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('/kasir/laporan/export', [Kasir\ReportController::class, 'exportExcel'])->name('kasir.laporan.export');

    Route::get('user', [Kasir\UserController::class, 'index'])->name('user.index');
});

// Pelanggan
// Halaman menu berdasarkan QR (meja)
Route::get('/menu/{meja:nomor_meja}', [PelangganMenuController::class, 'index'])->name('pelanggan.menu');

// cart route
Route::controller(Pelanggan\CartController::class)->group(function () {
    Route::get('cart', 'index')->name('cart.index');
    Route::post('cart/add/{menu}', 'add')->name('cart.add');
    Route::post('cart', 'update')->name('cart.update');
});

Route::get('/order', [OrderController::class, 'form'])->name('order');
Route::post('/order', [OrderController::class, 'store'])->name('order');
Route::get('/order/detail/{id}', [OrderController::class, 'showDetail'])->name('order.detail');

// Simpan pesanan
Route::post('/pesan', [OrderController::class, 'store'])->name('pelanggan.pesan');

Route::get('/payment/{order}', [PaymentController::class, 'payWithXendit'])->name('payment.xendit');
// Route::post('/xendit/callback', [PaymentController::class, 'handleCallback']);

require __DIR__ . '/auth.php';
