<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-3 text-success" :status="session('status')" />

    <h4 class="text-center mb-4 text-primary">
        <i class="fa-solid fa-user-doctor me-2"></i>
    </h4>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Honeypot: los humanos no lo ven, los bots lo rellenan -->
        <div style="display: none;">
            <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
        </div>
        <!-- Time-Trap: timestamp encriptado -->
        <input type="hidden" name="timestamp" value="{{ $timestamp ?? '' }}">

        <!-- CEDULA -->
        <div class="mb-3">
    <label for="cedula" class="form-label">Cédula</label>
    <input id="cedula" type="text" name="cedula" class="form-control @error('cedula') is-invalid @enderror" value="{{ old('cedula') }}" required autofocus autocomplete="username" placeholder="Ej: 1700000001">
    @error('cedula')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember -->
        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">Recordarme</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <button type="submit" class="btn btn-primary px-4">
                Iniciar Sesión
            </button>
        </div>
    </form>
</x-guest-layout>
