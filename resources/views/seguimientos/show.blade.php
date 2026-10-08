@extends('layouts.app')

@section('title', 'Detalle de Seguimiento')
@section('page-title', 'Detalle del Seguimiento')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Botones de navegación -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('historial.show', $seguimiento->historialClinico) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver al Historial
            </a>
            <div>
                <a href="{{ route('seguimientos.edit', $seguimiento) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
                <form action="{{ route('seguimientos.destroy', $seguimiento) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este seguimiento?')">
                        <i class="fas fa-trash me-1"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>

        <!-- Tarjeta de información principal -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-check me-2"></i>
                    Seguimiento del {{ $seguimiento->fecha_seguimiento->format('d/m/Y') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Información del paciente -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-user me-2"></i> Información del Paciente
                        </h6>
                        <hr>
                        <p><strong>Nombre:</strong> 
                            <a href="{{ route('pacientes.show', $seguimiento->historialClinico->paciente) }}">
                                {{ $seguimiento->historialClinico->paciente->nombre_completo }}
                            </a>
                        </p>
                        <p><strong>Historial:</strong> 
                            <a href="{{ route('historial.show', $seguimiento->historialClinico) }}">
                                Consulta del {{ $seguimiento->historialClinico->fecha_consulta->format('d/m/Y') }}
                            </a>
                        </p>
                        <p><strong>Doctor:</strong> {{ $seguimiento->historialClinico->doctor ?? 'N/E' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-info-circle me-2"></i> Datos del Seguimiento
                        </h6>
                        <hr>
                        <p><strong>Fecha de Seguimiento:</strong> 
                            <span class="badge bg-primary">{{ $seguimiento->fecha_seguimiento->format('d/m/Y') }}</span>
                        </p>
                        @if($seguimiento->proxima_cita)
                            <p><strong>Próxima Cita:</strong> 
                                <span class="badge bg-warning">{{ $seguimiento->proxima_cita->format('d/m/Y') }}</span>
                            </p>
                        @endif
                        <p><strong>Creado:</strong> {{ $seguimiento->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Última modificación:</strong> {{ $seguimiento->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Evolución -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i> Evolución
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-0" style="white-space: pre-wrap;">{{ $seguimiento->evolucion }}</p>
            </div>
        </div>

        <!-- Nuevos Síntomas -->
        @if($seguimiento->nuevos_sintomas)
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="fas fa-thermometer-half me-2"></i> Nuevos Síntomas
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-0" style="white-space: pre-wrap;">{{ $seguimiento->nuevos_sintomas }}</p>
            </div>
        </div>
        @endif

        <!-- Medicamentos Ajustados -->
        @if($seguimiento->medicamentos_ajustados)
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-prescription me-2"></i> Ajuste de Medicamentos
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-0" style="white-space: pre-wrap;">{{ $seguimiento->medicamentos_ajustados }}</p>
            </div>
        </div>
        @endif

        <!-- Recomendaciones -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">
                    <i class="fas fa-clipboard-list me-2"></i> Recomendaciones
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-0" style="white-space: pre-wrap;">{{ $seguimiento->recomendaciones }}</p>
            </div>
        </div>
        <!-- ========== RECETA MÉDICA ========== -->
@php
    $receta = $seguimiento->historialClinico->recetas->first();
@endphp
@if($receta)
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="fas fa-prescription me-2"></i> Receta Médica
        </h5>
    </div>
    <div class="card-body">
        @php
            $medicamentos = $receta->medicamentos_json ? json_decode($receta->medicamentos_json, true) : [];
        @endphp
        
        @if(count($medicamentos) > 0)
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Medicamento</th>
                            <th>Presentación</th>
                            <th>Concentración</th>
                            <th>Dosis</th>
                            <th>Frecuencia</th>
                            <th>Duración</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicamentos as $index => $med)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $med['medicamento'] ?? '' }}</strong></td>
                                <td>{{ $med['presentacion'] ?? '' }}</td>
                                <td>{{ $med['concentracion'] ?? '' }}</td>
                                <td>{{ $med['dosis'] ?? '' }}</td>
                                <td>{{ $med['frecuencia'] ?? '' }}</td>
                                <td>{{ $med['duracion'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="row g-2 mt-2">
                @if($receta->advertencias)
                    <div class="col-12">
                        <span class="fw-semibold small text-danger">⚠️ Advertencias:</span>
                        <span class="small">{{ $receta->advertencias }}</span>
                    </div>
                @endif
                @if($receta->signos_alarma)
                    <div class="col-12">
                        <span class="fw-semibold small text-warning">🚨 Signos de Alarma:</span>
                        <span class="small">{{ $receta->signos_alarma }}</span>
                    </div>
                @endif
                @if($receta->recomendaciones_no_farmacologicas)
                    <div class="col-12">
                        <span class="fw-semibold small text-success">💡 Recomendaciones:</span>
                        <span class="small">{{ $receta->recomendaciones_no_farmacologicas }}</span>
                    </div>
                @endif
                <div class="col-12">
                    <span class="fw-semibold small text-muted">📅 Fecha de emisión:</span>
                    <span class="small">{{ $receta->fecha_emision->format('d/m/Y') }}</span>
                </div>
            </div>
            
            <div class="mt-3">
                <a href="{{ route('recetas.imprimir', $receta) }}" class="btn btn-sm btn-success" target="_blank">
                    <i class="fas fa-file-pdf me-1"></i> Imprimir Receta
                </a>
            </div>
        @else
            <!-- Receta legacy -->
            <div class="row g-2">
                <div class="col-md-6">
                    <span class="fw-semibold">Medicamento:</span>
                    <span>{{ $receta->medicamento }}</span>
                </div>
                <!-- ... resto de campos ... -->
            </div>
        @endif
    </div>
</div>
@endif
    </div>
</div>
@endsection