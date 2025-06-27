<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelanggan\PaymentController;

Route::post('/xendit/callback', [PaymentController::class, 'handleCallback']);
