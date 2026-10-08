@extends('layouts.app')

@section('title', 'Editar Reposo')
@section('page-title', 'Editar Reposo Médico')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2 text-primary"></i>
                    Editar Reposo #{{ $reposo->numero_reposo }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('reposos.update', $reposo) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Información del Paciente -->
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-md-4">
                                <strong><i class="fas fa-user me-2"></i>Paciente:</strong>
                                {{ $reposo->paciente->nombre }} {{ $reposo->paciente->apellido }}
                            </div>
                            <div class="col-md-4">
                                <strong><i class="fas fa-id-card me-2"></i>Cédula:</strong>
                                {{ $reposo->paciente->cedula ?? 'N/E' }}
                            </div>
                            <div class="col-md-4">
                                <strong><i class="fas fa-hashtag me-2"></i>N° Reposo:</strong>
                                <span class="badge bg-dark">{{ $reposo->numero_reposo }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Fecha Inicio <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" 
                                   value="{{ old('fecha_inicio', $reposo->fecha_inicio->format('Y-m-d')) }}" required>
                            @error('fecha_inicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Fecha Fin <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" 
                                   value="{{ old('fecha_fin', $reposo->fecha_fin->format('Y-m-d')) }}" required>
                            @error('fecha_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Días de Incapacidad</label>
                            <input type="number" name="dias" class="form-control @error('dias') is-invalid @enderror" 
                                   value="{{ old('dias', $reposo->dias) }}" min="1" placeholder="Se calcula automáticamente">
                            @error('dias')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tipo de Reposo <span class="text-danger">*</span></label>
                            <select name="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                                <option value="laboral" {{ old('tipo', $reposo->tipo) == 'laboral' ? 'selected' : '' }}>Laboral</option>
                                <option value="escolar" {{ old('tipo', $reposo->tipo) == 'escolar' ? 'selected' : '' }}>Escolar</option>
                                <option value="otro" {{ old('tipo', $reposo->tipo) == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Estado <span class="text-danger">*</span></label>
                            <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="activo" {{ old('estado', $reposo->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="completado" {{ old('estado', $reposo->estado) == 'completado' ? 'selected' : '' }}>Completado</option>
                                <option value="anulado" {{ old('estado', $reposo->estado) == 'anulado' ? 'selected' : '' }}>Anulado</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Diagnóstico <span class="text-danger">*</span></label>
                            <textarea name="diagnostico" rows="3" class="form-control @error('diagnostico') is-invalid @enderror" 
                                      placeholder="Describa el diagnóstico que amerita el reposo..." required>{{ old('diagnostico', $reposo->diagnostico) }}</textarea>
                            @error('diagnostico')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Recomendaciones</label>
                            <textarea name="recomendaciones" rows="2" class="form-control @error('recomendaciones') is-invalid @enderror" 
                                      placeholder="Recomendaciones para el paciente durante el reposo...">{{ old('recomendaciones', $reposo->recomendaciones) }}</textarea>
                            @error('recomendaciones')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Actualizar Reposo
                        </button>
                        <a href="{{ route('reposos.show', $reposo) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection