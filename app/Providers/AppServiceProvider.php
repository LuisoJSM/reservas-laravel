<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Business;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Blade::if('dateNotIsToday', function (Carbon $date) {
            return ! $date->isToday();
        });


        Blade::if('dateWithinFutureDays', function (Carbon $date, Business $business) {
            return $date->dayofYear > (now()->dayOfYear + $business->max_future_days);
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
