<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelanggan\PaymentController;
use App\Http\Controllers\Api\ApiMenuController;

Route::post('/xendit/callback', [PaymentController::class, 'handleCallback']);

Route::get('/coba', function () {
    return response()->json(['message' => 'API OK']);
});

// API Mobile App
Route::get('/menu/{nomor_meja}', [ApiMenuController::class, 'getMenuByMeja']);
