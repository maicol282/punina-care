@extends('layouts.app')

@section('title', 'Recetas Médicas')
@section('page-title', 'Recetario Médico')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-prescription-bottle me-2 text-primary"></i>
            Recetas - {{ $historial->paciente->nombre_completo }}
            <small class="text-muted">(Consulta: {{ $historial->fecha_consulta->format('d/m/Y') }})</small>
        </h5>
        <div>
            <a href="{{ route('recetas.create', $historial) }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i> Nueva Receta
            </a>
            @if($recetas->count() > 0)
            <a href="{{ route('recetas.imprimir.todas', $historial) }}" class="btn btn-secondary btn-sm" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> Imprimir Todas
            </a>
            @endif
            <a href="{{ route('historial.show', $historial) }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($recetas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Medicamento</th>
                            <th>Dosis</th>
                            <th>Frecuencia</th>
                            <th>Duración</th>
                            <th>Signos Alarma</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recetas as $receta)
                        <tr>
                            <td>{{ $receta->fecha_emision->format('d/m/Y') }}</td>
                            <td>
                                <strong>{{ $receta->medicamento }}</strong>
                                @if($receta->presentacion)<br><small>{{ $receta->presentacion }}</small>@endif
                            </td>
                            <td>{{ $receta->dosis }}</td>
                            <td>{{ $receta->frecuencia }}</td>
                            <td>{{ $receta->duracion }}</td>
                            <td>
                                @if($receta->signos_alarma)
                                    <span class="badge bg-warning text-dark" title="{{ $receta->signos_alarma }}">
                                        <i class="fas fa-exclamation-triangle"></i> {{ Str::limit($receta->signos_alarma, 30) }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">No registrados</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
    <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-sm btn-warning" title="Editar receta" data-bs-toggle="tooltip">
        <i class="fas fa-edit"></i>
    </a>
    <a href="{{ route('recetas.imprimir', $receta->id) }}" class="btn btn-sm btn-secondary" target="_blank" title="Imprimir receta en PDF" data-bs-toggle="tooltip">
        <i class="fas fa-file-pdf"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger"
            onclick="confirmDelete(event, 'delete-form-{{ $receta->id }}')"
            title="Eliminar receta" data-bs-toggle="tooltip">
        <i class="fas fa-trash"></i>
    </button>
</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-prescription-bottle fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No hay recetas registradas</h5>
                <a href="{{ route('recetas.create', $historial) }}" class="btn btn-primary mt-2">
                    <i class="fas fa-plus me-1"></i> Crear Primera Receta
                </a>
            </div>
        @endif
    </div>
</div>
@endsection