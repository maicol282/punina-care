@extends('layouts.app')

@section('title', 'Médicos')
@section('page-title', 'Gestión de Médicos')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Lista de Médicos</h5>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Nuevo Médico
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
    <tr>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">ID</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Nombre</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Email</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Rol</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Registro</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Acciones</th>
    </tr>
</thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            @foreach($usuario->getRoleNames() as $rol)
                                <span class="badge bg-primary">{{ $rol }}</span>
                            @endforeach
                        </td>
                        <td>{{ $usuario->created_at->diffForHumans() }}</td>
                                                   <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón para cambiar contraseña -->
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalReset{{ $usuario->id }}" title="Cambiar contraseña">
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
                        <td colspan="6" class="text-center">No hay médicos registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $usuarios->links() }}
    </div>
</div>
<!-- MODALES DE RESETEO DE CONTRASEÑA (Fuera de la tabla para que funcionen bien) -->
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
                        <input type="password" name="password" class="form-control" required minlength="8">
                        <small class="text-muted">Mínimo 8 caracteres.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required minlength="8">
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
@endsection
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