<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cedula' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // 1. Obtener la cédula del formulario
        $cedula = $this->input('cedula');
        $password = $this->input('password');

        // 2. Limpiar la cédula (quitar espacios, guiones, etc.)
        $cedulaLimpia = preg_replace('/[^0-9]/', '', $cedula);

        // 3. Generar el hash para buscar en la BD
        $cedulaHash = hash('sha256', $cedulaLimpia);

        // 4. Buscar al usuario por su hash
        $user = User::where('cedula_hash', $cedulaHash)->first();

        // 5. Verificar usuario y contraseña
        if (!$user || !Hash::check($password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'cedula' => trans('auth.failed'),
            ]);
        }

        // 6. Autenticar y limpiar el RateLimiter
        Auth::login($user, $this->boolean('remember'));
        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'cedula' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('cedula')).'|'.$this->ip());
    }
}
