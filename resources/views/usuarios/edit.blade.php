@extends('layouts.app')

@section('title', 'Editar Usuario')
@section('page-title', 'Editar Usuario')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Editar Usuario: {{ $usuario->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="role" class="form-label">Rol <span class="text-danger">*</span></label>
                    <select class="form-select @error('role') is-invalid @enderror" 
                            id="role" name="role" required>
                        <option value="">Seleccione un rol...</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->name }}" 
                                {{ $usuario->hasRole($rol->name) ? 'selected' : '' }}>
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
        <option value="Medicina General" {{ old('especialidad', $usuario->especialidad) == 'Medicina General' ? 'selected' : '' }}>Medicina General</option>
        <option value="Cardiología" {{ old('especialidad', $usuario->especialidad) == 'Cardiología' ? 'selected' : '' }}>Cardiología</option>
        <option value="Pediatría" {{ old('especialidad', $usuario->especialidad) == 'Pediatría' ? 'selected' : '' }}>Pediatría</option>
        <option value="Ginecología" {{ old('especialidad', $usuario->especialidad) == 'Ginecología' ? 'selected' : '' }}>Ginecología</option>
        <option value="Traumatología" {{ old('especialidad', $usuario->especialidad) == 'Traumatología' ? 'selected' : '' }}>Traumatología</option>
        <option value="Dermatología" {{ old('especialidad', $usuario->especialidad) == 'Dermatología' ? 'selected' : '' }}>Dermatología</option>
        <option value="Neurología" {{ old('especialidad', $usuario->especialidad) == 'Neurología' ? 'selected' : '' }}>Neurología</option>
        <option value="Psiquiatría" {{ old('especialidad', $usuario->especialidad) == 'Psiquiatría' ? 'selected' : '' }}>Psiquiatría</option>
        <option value="Oftalmología" {{ old('especialidad', $usuario->especialidad) == 'Oftalmología' ? 'selected' : '' }}>Oftalmología</option>
        <option value="Odontología" {{ old('especialidad', $usuario->especialidad) == 'Odontología' ? 'selected' : '' }}>Odontología</option>
    </select>
    @error('especialidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
            </div>

            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle me-2"></i>
                Si deseas cambiar la contraseña, usa el registro de nuevo usuario o la opción de recuperación.
            </div>

            <div class="text-end">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection