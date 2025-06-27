<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Xendit\Configuration;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
        setlocale(LC_TIME, 'id_ID.utf8', 'id_ID.UTF-8', 'Indonesian_indonesia.1252');
        Carbon::setLocale('id');
    }
}
