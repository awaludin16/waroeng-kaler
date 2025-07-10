<?php

use Illuminate\Support\Facades\Route;
use App\Models\TableCafe as Meja;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Kasir;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\Kasir\KategoriController;
use App\Http\Controllers\Kasir\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pelanggan\MenuController as PelangganMenuController;
use App\Http\Controllers\Pelanggan\PaymentController;
use App\Http\Controllers\Kasir\UserController;

Route::get('/', function () {
    $meja = Meja::inRandomOrder()->first();
    return redirect()->route('pelanggan.menu', $meja->nomor_meja);
});

Route::middleware(['auth', 'web'])->post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [Kasir\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan', [Kasir\ReportController::class, 'laporanBulanan'])->name('laporan.index');
    Route::get('/laporan/export/pdf', [Kasir\ReportController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/laporan/export/excel', [Kasir\ReportController::class, 'exportExcel'])->name('laporan.export.excel');

    Route::middleware('role:kasir')->group(function () {
        Route::prefix('kasir/kategori')->group(function () {
            Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
            Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
            Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
            Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        });

        Route::resource('menus', Kasir\MenuController::class);
        Route::get('/orders/masuk', [Kasir\OrderController::class, 'orderIn'])->name('orders.pending');
        Route::resource('orders', Kasir\OrderController::class);
        Route::put('/orders/{order}/update-status', [Kasir\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/orders/{order}/cetak', [Kasir\OrderController::class, 'cetak'])->name('orders.cetak');
        Route::get('/kasir/laporan/export', [Kasir\ReportController::class, 'exportExcel'])->name('kasir.laporan.export');
    });

    Route::middleware('role:owner')->group(function () {
        Route::get('/user', [Kasir\UserController::class, 'index'])->name('user.index');
        Route::resource('user', Kasir\UserController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/menu/{nomor_meja}', [PelangganMenuController::class, 'index'])->name('pelanggan.menu');

Route::get('cart/{nomor_meja}', [Pelanggan\CartController::class, 'index'])->name('cart.index');
Route::post('cart/add/{nomor_meja}/{menu}', [Pelanggan\CartController::class, 'add'])->name('cart.add');
Route::post('cart/{nomor_meja}', [Pelanggan\CartController::class, 'update'])->name('cart.update');

Route::get('/order/{nomor_meja}', [Pelanggan\OrderController::class, 'form'])->name('order');
Route::post('/order/{nomor_meja}', [Pelanggan\OrderController::class, 'store'])->name('order.store');
Route::get('/order-detail/{id}', [Pelanggan\OrderController::class, 'showDetail'])->name('order.detail');

Route::get('/payment/{order}', [PaymentController::class, 'payWithXendit'])->name('payment.xendit');

require __DIR__ . '/auth.php';
