<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
        // Supaya default string panjang di database aman
        Schema::defaultStringLength(191);

        // Set default timezone aplikasi ke Jakarta
        date_default_timezone_set('Asia/Jakarta');
    
    }
}
