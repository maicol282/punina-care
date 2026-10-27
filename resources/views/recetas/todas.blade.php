@extends('layouts.app')

@section('title', 'Todas las Recetas')
@section('page-title', 'Listado General de Recetas Médicas')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-prescription-bottle me-2 text-primary"></i>Todas las Recetas Médicas</h5>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Medicamento</th>
                        <th>Dosis</th>
                        <th>Fecha Emisión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recetas as $receta)
                    <tr>
                        <td>{{ $receta->id }}</td>
                        <td>
                            <strong>{{ $receta->historialClinico->paciente->nombre_completo }}</strong>
                            <br>
                            <small class="text-muted">{{ $receta->historialClinico->paciente->cedula ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <strong>{{ $receta->medicamento }}</strong>
                            @if($receta->presentacion)
                                <br><small>{{ $receta->presentacion }} - {{ $receta->concentracion }}</small>
                            @endif
                        </td>
                        <td>{{ $receta->dosis }} - {{ $receta->frecuencia }} - {{ $receta->duracion }}</td>
                        <td>{{ $receta->fecha_emision->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('historial.show', $receta->historialClinico) }}" 
                                   class="btn btn-sm btn-info" title="Ver historial" data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('recetas.imprimir', $receta->id) }}" 
                                   class="btn btn-sm btn-secondary" target="_blank" title="Imprimir receta" data-bs-toggle="tooltip">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <a href="{{ route('recetas.edit', $receta->id) }}" 
                                   class="btn btn-sm btn-warning" title="Editar receta" data-bs-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="{{ route('recetas.enviar', $receta) }}" class="btn btn-sm btn-info text-white" title="Enviar por Correo" onclick="return confirm('¿Enviar receta al paciente?')">
                                <i class="fas fa-envelope"></i>
                                </a>
                                @if($receta->enviado)
                                <span class="badge bg-success">Enviada</span>
                                @endif
                               <!-- <a href="{{ route('exportar.recetas') }}" class="btn btn-success btn-sm" target="_blank">
                                    <i class="fas fa-file-excel me-1"></i> Exportar Excel
                                </a> -->
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete(event, 'delete-form-{{ $receta->id }}')"
                                        title="Eliminar receta" data-bs-toggle="tooltip">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $receta->id }}" 
                                  action="{{ route('recetas.destroy', $receta->id) }}" 
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-prescription-bottle fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No hay recetas médicas registradas</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $recetas->links() }}
        </div>
    </div>
</div>
@endsection