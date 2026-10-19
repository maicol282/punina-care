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
                            <div class="btn-group">
                                <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($usuario->id !== auth()->id())
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete(event, 'delete-form-{{ $usuario->id }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
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