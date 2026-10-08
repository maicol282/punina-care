@extends('layouts.app')

@section('title', 'Registrar Médico')
@section('page-title', 'Registrar Nuevo Médico')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user-md me-2 text-primary"></i>Datos del Médico</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required>
                    <small class="text-muted">Mínimo 8 caracteres</small>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="role" class="form-label">Rol <span class="text-danger">*</span></label>
                    <select class="form-select @error('role') is-invalid @enderror" 
                            id="role" name="role" required>
                        <option value="">Seleccione un rol...</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->name }}" {{ old('role') == $rol->name ? 'selected' : '' }}>
                                {{ $rol->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <select class="form-select @error('especialidad') is-invalid @enderror" 
                            id="especialidad" name="especialidad">
                        <option value="">Seleccione una especialidad...</option>
                        <option value="Medicina General" {{ old('especialidad') == 'Medicina General' ? 'selected' : '' }}>Medicina General</option>
                        <option value="Cardiología" {{ old('especialidad') == 'Cardiología' ? 'selected' : '' }}>Cardiología</option>
                        <option value="Pediatría" {{ old('especialidad') == 'Pediatría' ? 'selected' : '' }}>Pediatría</option>
                        <option value="Ginecología" {{ old('especialidad') == 'Ginecología' ? 'selected' : '' }}>Ginecología</option>
                        <option value="Traumatología" {{ old('especialidad') == 'Traumatología' ? 'selected' : '' }}>Traumatología</option>
                        <option value="Dermatología" {{ old('especialidad') == 'Dermatología' ? 'selected' : '' }}>Dermatología</option>
                        <option value="Neurología" {{ old('especialidad') == 'Neurología' ? 'selected' : '' }}>Neurología</option>
                        <option value="Psiquiatría" {{ old('especialidad') == 'Psiquiatría' ? 'selected' : '' }}>Psiquiatría</option>
                        <option value="Oftalmología" {{ old('especialidad') == 'Oftalmología' ? 'selected' : '' }}>Oftalmología</option>
                        <option value="Odontología" {{ old('especialidad') == 'Odontología' ? 'selected' : '' }}>Odontología</option>
                    </select>
                    @error('especialidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Nota:</strong> El usuario podrá iniciar sesión con el email y contraseña registrados.
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Registrar Médico
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Validación de contraseña en tiempo real
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    
    function validatePassword() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Las contraseñas no coinciden');
        } else {
            confirmPassword.setCustomValidity('');
        }
    }
    
    password.addEventListener('change', validatePassword);
    confirmPassword.addEventListener('keyup', validatePassword);
</script>
@endpush