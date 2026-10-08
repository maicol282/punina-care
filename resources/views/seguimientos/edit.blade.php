@extends('layouts.app')

@section('title', 'Editar Seguimiento')
@section('page-title', 'Editar Seguimiento')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Información de la Consulta -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-notes-medical me-2"></i>
                    Editando Seguimiento - {{ $seguimiento->fecha_seguimiento->format('d/m/Y') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Paciente:</strong> {{ $seguimiento->historialClinico->paciente->nombre_completo }}</p>
                        <p><strong>Fecha consulta original:</strong> {{ $seguimiento->historialClinico->fecha_consulta->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Motivo:</strong> {{ Str::limit($seguimiento->historialClinico->motivo_consulta, 50) }}</p>
                        <p><strong>Diagnóstico:</strong> {{ Str::limit($seguimiento->historialClinico->diagnostico, 50) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- INICIO DEL FORMULARIO DE EDICIÓN -->
        <form action="{{ route('seguimientos.update', $seguimiento) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-edit me-2 text-primary"></i>Editar Datos del Seguimiento</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_seguimiento" class="form-label">Fecha de Seguimiento <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('fecha_seguimiento') is-invalid @enderror" 
                                   id="fecha_seguimiento" name="fecha_seguimiento" 
                                   value="{{ old('fecha_seguimiento', $seguimiento->fecha_seguimiento->format('Y-m-d')) }}" required>
                            @error('fecha_seguimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="proxima_cita" class="form-label">Próxima Cita</label>
                            <input type="date" class="form-control @error('proxima_cita') is-invalid @enderror" 
                                   id="proxima_cita" name="proxima_cita" 
                                   value="{{ old('proxima_cita', $seguimiento->proxima_cita?->format('Y-m-d')) }}">
                            @error('proxima_cita')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="evolucion" class="form-label">Evolución del Paciente <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('evolucion') is-invalid @enderror" 
                                  id="evolucion" name="evolucion" rows="4" required>{{ old('evolucion', $seguimiento->evolucion) }}</textarea>
                        @error('evolucion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nuevos_sintomas" class="form-label">Nuevos Síntomas</label>
                        <textarea class="form-control @error('nuevos_sintomas') is-invalid @enderror" 
                                  id="nuevos_sintomas" name="nuevos_sintomas" rows="2">{{ old('nuevos_sintomas', $seguimiento->nuevos_sintomas) }}</textarea>
                        @error('nuevos_sintomas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="medicamentos_ajustados" class="form-label">Ajuste de Medicamentos</label>
                        <textarea class="form-control @error('medicamentos_ajustados') is-invalid @enderror" 
                                  id="medicamentos_ajustados" name="medicamentos_ajustados" rows="2">{{ old('medicamentos_ajustados', $seguimiento->medicamentos_ajustados) }}</textarea>
                        @error('medicamentos_ajustados')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="recomendaciones" class="form-label">Recomendaciones <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('recomendaciones') is-invalid @enderror" 
                                  id="recomendaciones" name="recomendaciones" rows="3" required>{{ old('recomendaciones', $seguimiento->recomendaciones) }}</textarea>
                        @error('recomendaciones')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- BOTONES -->
            <div class="row mt-4">
                <div class="col-12 text-end">
                    <a href="{{ route('historial.show', $seguimiento->historialClinico) }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Actualizar Seguimiento
                    </button>
                </div>
            </div>

        </form>
        <!-- FIN DEL FORMULARIO -->

    </div>
</div>
@endsection