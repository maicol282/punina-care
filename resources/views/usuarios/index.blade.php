@extends('layouts.app')

@section('title', 'Gestión de Médicos')
@section('page-title', 'Gestión de Médicos')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-user-md me-2 text-primary"></i>Lista de Médicos</h5>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo Médico
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Cédula</th>
                        <th>Registro</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>
                            <strong>{{ $usuario->name }}</strong>
                            @if($usuario->especialidad)
                                <br><small class="text-muted">{{ $usuario->especialidad }}</small>
                            @endif
                        </td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->cedula }}</td>
                        <td>{{ $usuario->created_at->diffForHumans() }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón para cambiar contraseña -->
                                <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalReset{{ $usuario->id }}" title="Cambiar contraseña">
                                    <i class="fas fa-key"></i>
                                </button>

                                @if($usuario->id !== auth()->id())
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete(event, 'delete-form-{{ $usuario->id }}')" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>

                            <!-- Formulario oculto para eliminar -->
                            <form id="delete-form-{{ $usuario->id }}" 
                                  action="{{ route('usuarios.destroy', $usuario) }}" 
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay usuarios registrados.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-3">
            {{ $usuarios->links() }}
        </div>
    </div>
</div>

<!-- MODALES DE RESETEO DE CONTRASEÑA (Fuera de la tabla) -->
@foreach($usuarios as $usuario)
<div class="modal fade" id="modalReset{{ $usuario->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('usuarios.reset-password', $usuario) }}" method="POST">
                @csrf
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-key me-2"></i>Cambiar contraseña: {{ $usuario->name }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nueva Contraseña <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        <small class="text-muted">Mínimo 8 caracteres, incluir mayúscula, minúscula, número y símbolo.</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-info text-white">
                        <i class="fas fa-save me-1"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script>
    function confirmDelete(event, formId) {
        event.preventDefault();
        if (confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')) {
            document.getElementById(formId).submit();
        }
    }
</script>
@endpush
@endsection