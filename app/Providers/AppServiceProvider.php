<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;


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
        RateLimiter::for('contact', function (Request $request) {
            $key = ($request->ip()) . '|' . strtolower((string)$request->input('email'));
            return [
                Limit::perMinute(3)->by($key),
                Limit::perHour(10)->by($request->ip()),
            ];
        });
    }
}
