@extends('layouts.app')

@section('title', 'Detalle de Certificado Médico')
@section('page-title', 'Detalle de Certificado Médico')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Acciones -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('certificados.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
            <div>
                <a href="{{ route('certificados.imprimir', $certificado) }}" class="btn btn-success" target="_blank">
                    <i class="fas fa-file-pdf me-1"></i> Imprimir PDF
                </a>
                <a href="{{ route('certificados.edit', $certificado) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
                <form action="{{ route('certificados.destroy', $certificado) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este certificado?')">
                        <i class="fas fa-trash me-1"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>

        <!-- Tarjeta Principal -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-certificate me-2"></i>
                    Certificado Médico #{{ $certificado->numero_certificado }}
                    <span class="badge bg-{{ $certificado->estado == 'activo' ? 'success' : 'danger' }} ms-2">
                        {{ $certificado->estado_label }}
                    </span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Información del Paciente -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-user me-2"></i> Información del Paciente
                        </h6>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                <p><strong>Nombre:</strong></p>
                                <p><strong>Cédula:</strong></p>
                                <p><strong>Dirección:</strong></p>
                                <p><strong>Teléfono:</strong></p>
                                <p><strong>Empresa:</strong></p>
                                <p><strong>Puesto:</strong></p>
                            </div>
                            <div class="col-7">
                                <p>{{ $certificado->paciente_nombre }}</p>
                                <p>{{ $certificado->paciente_cedula }}</p>
                                <p>{{ $certificado->paciente_direccion ?? 'No especificada' }}</p>
                                <p>{{ $certificado->paciente_telefono ?? 'No especificado' }}</p>
                                <p>{{ $certificado->paciente_empresa ?? 'No especificada' }}</p>
                                <p>{{ $certificado->paciente_puesto ?? 'No especificado' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Certificado -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-info-circle me-2"></i> Información del Certificado
                        </h6>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                <p><strong>Número:</strong></p>
                                <p><strong>Fecha Atención:</strong></p>
                                <p><strong>Tipo Contingencia:</strong></p>
                                <p><strong>Reposo:</strong></p>
                                @if($certificado->reposo)
                                    <p><strong>Inicio Reposo:</strong></p>
                                    <p><strong>Fin Reposo:</strong></p>
                                    <p><strong>Días Reposo:</strong></p>
                                @endif
                            </div>
                            <div class="col-7">
                                <p><span class="badge bg-dark">{{ $certificado->numero_certificado }}</span></p>
                                <p>{{ $certificado->fecha_atencion->format('d/m/Y') }}</p>
                                <p><span class="badge bg-info">{{ $certificado->tipo_contingencia_label }}</span></p>
                                <p>
                                    @if($certificado->reposo)
                                        <span class="badge bg-warning">Sí</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </p>
                                @if($certificado->reposo)
                                    <p>{{ $certificado->reposo_inicio->format('d/m/Y') }}</p>
                                    <p>{{ $certificado->reposo_fin->format('d/m/Y') }}</p>
                                    <p><span class="badge bg-danger">{{ $certificado->reposo_dias }} días</span></p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Diagnósticos -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-stethoscope me-2"></i> Diagnósticos
                        </h6>
                        <hr>
                        @php
                            $diagnosticos = explode("\n", trim($certificado->diagnosticos));
                        @endphp
                        @foreach($diagnosticos as $diagnostico)
                            @if(trim($diagnostico))
                                <p class="mb-1"><strong>•</strong> {{ trim($diagnostico) }}</p>
                            @endif
                        @endforeach
                    </div>

                    <!-- Observaciones -->
                    @if($certificado->observaciones)
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-comment me-2"></i> Observaciones
                        </h6>
                        <hr>
                        <p>{{ $certificado->observaciones }}</p>
                    </div>
                    @endif

                    <!-- Datos del Médico -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-user-md me-2"></i> Datos del Médico
                        </h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Nombre:</strong>
                                <p>{{ $certificado->medico_nombre }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>Especialidad:</strong>
                                <p>{{ $certificado->medico_especialidad ?? 'Medicina General' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>Cédula:</strong>
                                <p>{{ $certificado->medico_cedula ?? 'N/E' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Historial Asociado -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-notes-medical me-2"></i> Historial Asociado
                        </h6>
                        <hr>
                        <a href="{{ route('historial.show', $certificado->historialClinico) }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-1"></i> Ver Historial del {{ $certificado->historialClinico->fecha_consulta->format('d/m/Y') }}
                        </a>
                        <a href="{{ route('pacientes.show', $certificado->paciente) }}" class="btn btn-outline-info">
                            <i class="fas fa-user me-1"></i> Ver Perfil del Paciente
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>
                    Creado: {{ $certificado->created_at->format('d/m/Y H:i') }} | 
                    Última modificación: {{ $certificado->updated_at->format('d/m/Y H:i') }}
                </small>
            </div>
        </div>
    </div>
</div>
@endsection