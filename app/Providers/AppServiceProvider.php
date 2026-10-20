<?php

namespace App\Providers;

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
        // Configuración global de contraseñas fuertes
        \Illuminate\Validation\Rules\Password::defaults(function () {
            return \Illuminate\Validation\Rules\Password::min(8)
                ->mixedCase()      // Mayúsculas y minúsculas
                ->numbers()        // Al menos un número
                ->symbols();       // Al menos un símbolo (ej: !@#$%^&*)
        });
    }
}
