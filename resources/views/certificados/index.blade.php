@extends('layouts.app')

@section('title', 'Listado de Certificados Médicos')
@section('page-title', 'Certificados Médicos')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-certificate me-2 text-primary"></i>
            Certificados Médicos
            <span class="badge bg-primary ms-2">{{ $certificados->total() }}</span>
        </h5>
    </div>
    <div class="card-body">

        <!-- ===== FILTROS ===== -->
        <div class="row mb-3">
            <div class="col-md-12">
                <form method="GET" action="{{ route('certificados.index') }}" class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control form-control-sm" 
                               placeholder="Buscar por paciente..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="estado" class="form-select form-select-sm">
                            <option value="">Todos los estados</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado }}" {{ request('estado') == $estado ? 'selected' : '' }}>
                                    {{ ucfirst($estado) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="paciente_id" class="form-select form-select-sm">
                            <option value="">Todos los pacientes</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" {{ request('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->nombre }} {{ $paciente->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-filter me-1"></i> Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ===== TABLA ===== -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Reposo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certificados as $certificado)
                    <tr>
                        <td>
                            <span class="badge bg-dark">{{ $certificado->numero_certificado }}</span>
                        </td>
                        <td>
                            <strong>{{ $certificado->paciente->nombre }} {{ $certificado->paciente->apellido }}</strong>
                            <br>
                            <small class="text-muted">Cédula: {{ $certificado->paciente->cedula ?? 'N/E' }}</small>
                        </td>
                        <td>{{ $certificado->fecha_atencion->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-info">{{ $certificado->tipo_contingencia_label }}</span>
                        </td>
                        <td>
                            @if($certificado->reposo)
                                <span class="badge bg-warning">{{ $certificado->reposo_dias }} días</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $certificado->estado == 'activo' ? 'success' : 'danger' }}">
                                {{ $certificado->estado_label }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('certificados.show', $certificado) }}" class="btn btn-info" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('certificados.edit', $certificado) }}" class="btn btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('certificados.imprimir', $certificado) }}" class="btn btn-success" title="PDF" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <form action="{{ route('certificados.destroy', $certificado) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-certificate fa-3x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">No hay certificados médicos registrados</h5>
                            <p class="text-muted">Los certificados se generan desde el historial clínico del paciente.</p>
                            <a href="{{ route('historiales.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-notes-medical me-1"></i> Ir a Historiales
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ===== PAGINACIÓN ===== -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <span class="text-muted">
                    Mostrando {{ $certificados->firstItem() ?? 0 }} - {{ $certificados->lastItem() ?? 0 }} 
                    de {{ $certificados->total() }} resultados
                </span>
            </div>
            <div>
                {{ $certificados->appends(request()->query())->links() }}
            </div>
        </div>

    </div>
</div>
@endsection