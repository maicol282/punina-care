@extends('layouts.app')

@section('title', 'Nuevo Reposo Médico')
@section('page-title', 'Registrar Reposo Médico')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-bed me-2 text-primary"></i>
                    Nuevo Reposo - {{ $paciente->nombre }} {{ $paciente->apellido }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('reposos.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="historial_clinico_id" value="{{ $historial->id }}">
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

                    <!-- Información del Paciente -->
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-md-4">
                                <strong><i class="fas fa-user me-2"></i>Paciente:</strong>
                                {{ $paciente->nombre }} {{ $paciente->apellido }}
                            </div>
                            <div class="col-md-4">
                                <strong><i class="fas fa-id-card me-2"></i>Cédula:</strong>
                                {{ $paciente->cedula ?? 'N/E' }}
                            </div>
                            <div class="col-md-4">
                                <strong><i class="fas fa-calendar me-2"></i>Historial:</strong>
                                {{ $historial->fecha_consulta->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Fecha Inicio <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" 
                                   value="{{ old('fecha_inicio', date('Y-m-d')) }}" required>
                            @error('fecha_inicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Fecha Fin <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" 
                                   value="{{ old('fecha_fin', date('Y-m-d', strtotime('+7 days'))) }}" required>
                            @error('fecha_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Días de Incapacidad</label>
                            <input type="number" name="dias" class="form-control @error('dias') is-invalid @enderror" 
                                   value="{{ old('dias') }}" min="1" placeholder="Se calcula automáticamente">
                            @error('dias')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tipo de Reposo <span class="text-danger">*</span></label>
                            <select name="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                                <option value="laboral" {{ old('tipo') == 'laboral' ? 'selected' : '' }}>Laboral</option>
                                <option value="escolar" {{ old('tipo') == 'escolar' ? 'selected' : '' }}>Escolar</option>
                                <option value="otro" {{ old('tipo') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Médico Emisor <span class="text-danger">*</span></label>
                            <input type="text" name="medico_emisor" class="form-control @error('medico_emisor') is-invalid @enderror" 
                                   value="{{ old('medico_emisor', auth()->user()->name) }}" required>
                            @error('medico_emisor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Diagnóstico <span class="text-danger">*</span></label>
                            <textarea name="diagnostico" rows="3" class="form-control @error('diagnostico') is-invalid @enderror" 
                                      placeholder="Describa el diagnóstico que amerita el reposo..." required>{{ old('diagnostico') }}</textarea>
                            @error('diagnostico')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Recomendaciones</label>
                            <textarea name="recomendaciones" rows="2" class="form-control @error('recomendaciones') is-invalid @enderror" 
                                      placeholder="Recomendaciones para el paciente durante el reposo...">{{ old('recomendaciones') }}</textarea>
                            @error('recomendaciones')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Guardar Reposo
                        </button>
                        <a href="{{ route('historial.show', $historial) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection