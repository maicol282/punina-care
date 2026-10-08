@extends('layouts.app')

@section('title', 'Reposos Médicos')
@section('page-title', 'Gestión de Reposos Médicos')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Buscador y Filtros -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('reposos.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Buscar</label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Nombre o cédula del paciente..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Paciente</label>
                        <select name="paciente_id" class="form-select">
                            <option value="">Todos</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" {{ request('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->nombre }} {{ $paciente->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado }}" {{ request('estado') == $estado ? 'selected' : '' }}>
                                    {{ ucfirst($estado) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i> Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de Reposos -->
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-bed me-2 text-primary"></i>
                    Reposos Médicos
                    <span class="badge bg-primary ms-2">{{ $reposos->total() }}</span>
                </h5>
                <a href="{{ route('historiales.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> Nuevo Reposo
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>N° Reposo</th>
                                <th>Paciente</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Días</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reposos as $reposo)
                            <tr>
                                <td>
                                    <span class="badge bg-dark">{{ $reposo->numero_reposo }}</span>
                                </td>
                                <td>
                                    <strong>{{ $reposo->paciente->nombre }} {{ $reposo->paciente->apellido }}</strong>
                                    <br>
                                    <small class="text-muted">Cédula: {{ $reposo->paciente->cedula ?? 'N/E' }}</small>
                                </td>
                                <td>{{ $reposo->fecha_inicio->format('d/m/Y') }}</td>
                                <td>{{ $reposo->fecha_fin->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $reposo->dias }} días</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $reposo->tipo_label }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $reposo->estado_color }}">
                                        {{ $reposo->estado_label }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('reposos.show', $reposo) }}" class="btn btn-info" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('reposos.edit', $reposo) }}" class="btn btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('reposos.imprimir', $reposo) }}" class="btn btn-success" title="PDF" target="_blank">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <form action="{{ route('reposos.destroy', $reposo) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este reposo?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="fas fa-bed fa-3x text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">No hay reposos médicos registrados</h5>
                                    <p class="text-muted">Los reposos se crean desde el historial clínico del paciente.</p>
                                    <a href="{{ route('historiales.index') }}" class="btn btn-primary">
                                        <i class="fas fa-notes-medical me-1"></i> Ir a Historiales
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <span class="text-muted">
                            Mostrando {{ $reposos->firstItem() ?? 0 }} - {{ $reposos->lastItem() ?? 0 }} 
                            de {{ $reposos->total() }} resultados
                        </span>
                    </div>
                    <div>
                        {{ $reposos->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection