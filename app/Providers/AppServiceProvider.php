<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;
use App\Models\Paciente;
use App\Policies\PacientePolicy;

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
        // Registrar la Policy de Paciente
        Gate::policy(Paciente::class, PacientePolicy::class);

        // Configuración global de contraseñas fuertes
        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()      // Mayúsculas y minúsculas
                ->numbers()        // Al menos un número
                ->symbols();       // Al menos un símbolo
        });
    }
}
