@extends('layouts.app')

@section('title', 'Punina Care - Editar Consulta')
@section('page-title', 'Editar Consulta de Telemedicina')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-video me-2 text-primary"></i>
            Editar Consulta #{{ $consulta->id }}
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('telemedicina.update', $consulta) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Paciente <span class="text-danger">*</span></label>
                    <select name="paciente_id" class="form-select" required>
                        <option value="">Seleccione un paciente...</option>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id }}" {{ old('paciente_id', $consulta->paciente_id) == $paciente->id ? 'selected' : '' }}>
                                {{ $paciente->nombre }} {{ $paciente->apellido }} - {{ $paciente->cedula ?? 'N/E' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Médico <span class="text-danger">*</span></label>
                    <select name="medico_id" class="form-select" required>
                        <option value="">Seleccione un médico...</option>
                        @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}" {{ old('medico_id', $consulta->medico_id) == $medico->id ? 'selected' : '' }}>
                                {{ $medico->name }} - {{ $medico->especialidad ?? 'Médico General' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha y Hora <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="fecha_hora_programada" class="form-control" 
                           value="{{ old('fecha_hora_programada', $consulta->fecha_hora_programada->format('Y-m-d\TH:i')) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Duración (minutos) <span class="text-danger">*</span></label>
                    <input type="number" name="duracion" class="form-control" 
                           value="{{ old('duracion', $consulta->duracion) }}" min="15" max="120" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Estado <span class="text-danger">*</span></label>
                    <select name="estado" class="form-select" required>
                        <option value="programada" {{ old('estado', $consulta->estado) == 'programada' ? 'selected' : '' }}>Programada</option>
                        <option value="en_curso" {{ old('estado', $consulta->estado) == 'en_curso' ? 'selected' : '' }}>En curso</option>
                        <option value="completada" {{ old('estado', $consulta->estado) == 'completada' ? 'selected' : '' }}>Completada</option>
                        <option value="cancelada" {{ old('estado', $consulta->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Motivo de la consulta <span class="text-danger">*</span></label>
                    <textarea name="motivo" rows="3" class="form-control" required>{{ old('motivo', $consulta->motivo) }}</textarea>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Notas adicionales</label>
                    <textarea name="notas" rows="2" class="form-control">{{ old('notas', $consulta->notas) }}</textarea>
                </div>

                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Enlace de videollamada:</strong>
                        <a href="{{ $consulta->enlace_acceso }}" target="_blank" class="text-primary">
                            {{ $consulta->enlace_acceso }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-3">
                <a href="{{ route('telemedicina.show', $consulta) }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar Consulta
                </button>
            </div>

        </form>
    </div>
</div>
@endsection