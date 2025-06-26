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
        // Directiva para comprobar si la fecha NO es hoy
        Blade::if('dateNotIsToday', function (Carbon $date) {
            return ! $date->isToday();
        });

        // Directiva para comprobar si la fecha está dentro del límite permitido de días futuros
        Blade::if('dateWithinMaxFutureDays', function (Carbon $date, Business $business) {
            return $date->dayOfYear <= (now()->dayOfYear + $business->max_future_days);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configurar Carbon para usar el idioma español
        Carbon::setLocale('es');
    }
}
