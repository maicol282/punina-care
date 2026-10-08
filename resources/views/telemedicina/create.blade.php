@extends('layouts.app')

@section('title', 'Punina Care - Nueva Consulta')
@section('page-title', 'Nueva Consulta de Telemedicina')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-video me-2 text-primary"></i>
            Nueva Consulta - Punina Care
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('telemedicina.store') }}" method="POST" id="formTelemedicina">
            @csrf

            <!-- ===== TIPO DE PACIENTE ===== -->
            <div class="card mb-3 border-primary">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-user me-2 text-primary"></i>
                        Paciente
                    </h6>
                </div>
                <div class="card-body">
                    <div class="btn-group w-100 mb-3" role="group">
                        <input type="radio" class="btn-check" name="tipo_paciente" 
                               id="tipo_existente" value="existente" 
                               {{ old('tipo_paciente', 'existente') === 'existente' ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="tipo_existente">
                            <i class="fas fa-search me-1"></i> Paciente Existente
                        </label>

                        <input type="radio" class="btn-check" name="tipo_paciente" 
                               id="tipo_nuevo" value="nuevo"
                               {{ old('tipo_paciente') === 'nuevo' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="tipo_nuevo">
                            <i class="fas fa-user-plus me-1"></i> Paciente Nuevo
                        </label>
                    </div>

                    <!-- Paciente Existente -->
                    <div id="seccionExistente">
                        <label class="form-label">Buscar Paciente <span class="text-danger">*</span></label>
                        <select name="paciente_id" id="paciente_id" class="form-select">
                            <option value="">Seleccione un paciente...</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" 
                                        data-cedula="{{ $paciente->cedula }}"
                                        data-telefono="{{ $paciente->telefono }}"
                                        data-email="{{ $paciente->email }}"
                                        {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->nombre }} {{ $paciente->apellido }} - {{ $paciente->cedula ?? 'N/E' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Paciente Nuevo -->
                    <div id="seccionNuevo" style="display: none;">
                        <div class="alert alert-success">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Se creará un nuevo paciente en el sistema</strong><br>
                            <small>Después de la consulta podrá completar los datos adicionales.</small>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" name="nuevo_paciente[nombre]" 
                                       class="form-control @error('nuevo_paciente.nombre') is-invalid @enderror"
                                       value="{{ old('nuevo_paciente.nombre') }}">
                                @error('nuevo_paciente.nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Apellido <span class="text-danger">*</span></label>
                                <input type="text" name="nuevo_paciente[apellido]" 
                                       class="form-control @error('nuevo_paciente.apellido') is-invalid @enderror"
                                       value="{{ old('nuevo_paciente.apellido') }}">
                                @error('nuevo_paciente.apellido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cédula <span class="text-danger">*</span></label>
                                <input type="text" name="nuevo_paciente[cedula]" 
                                       class="form-control @error('nuevo_paciente.cedula') is-invalid @enderror"
                                       value="{{ old('nuevo_paciente.cedula') }}" maxlength="10">
                                @error('nuevo_paciente.cedula')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                <input type="date" name="nuevo_paciente[fecha_nacimiento]" 
                                       class="form-control @error('nuevo_paciente.fecha_nacimiento') is-invalid @enderror"
                                       value="{{ old('nuevo_paciente.fecha_nacimiento') }}">
                                @error('nuevo_paciente.fecha_nacimiento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Género <span class="text-danger">*</span></label>
                                <select name="nuevo_paciente[genero]" class="form-select">
                                    <option value="M" {{ old('nuevo_paciente.genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('nuevo_paciente.genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ old('nuevo_paciente.genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="nuevo_paciente[telefono]" 
                                       class="form-control" value="{{ old('nuevo_paciente.telefono') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input type="email" name="nuevo_paciente[email]" 
                                       class="form-control" value="{{ old('nuevo_paciente.email') }}">
                                <small class="text-muted">Se usará para enviar el enlace de la videollamada</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== DATOS DE LA CITA ===== -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-calendar me-2 text-primary"></i>
                        Datos de la Cita
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Médico <span class="text-danger">*</span></label>
                            <select name="medico_id" class="form-select" required>
                                <option value="">Seleccione un médico...</option>
                                @foreach($medicos as $medico)
                                    <option value="{{ $medico->id }}" 
                                            {{ old('medico_id', auth()->id()) == $medico->id ? 'selected' : '' }}>
                                        {{ $medico->name }} - {{ $medico->especialidad ?? 'Médico General' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha y Hora <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="fecha_hora_programada" class="form-control" 
                                   value="{{ old('fecha_hora_programada', date('Y-m-d\TH:i')) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duración (minutos) <span class="text-danger">*</span></label>
                            <input type="number" name="duracion" class="form-control" 
                                   value="{{ old('duracion', 30) }}" min="15" max="120" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estado Inicial</label>
                            <select name="estado" class="form-select">
                                <option value="programada" {{ old('estado', 'programada') == 'programada' ? 'selected' : '' }}>
                                    Programada (agendar)
                                </option>
                                <option value="en_curso" {{ old('estado') == 'en_curso' ? 'selected' : '' }}>
                                    En Curso (iniciar ahora)
                                </option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Motivo de la consulta <span class="text-danger">*</span></label>
                            <textarea name="motivo" rows="3" class="form-control" 
                                      placeholder="Describa el motivo de la consulta..." required>{{ old('motivo') }}</textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Notas adicionales</label>
                            <textarea name="notas" rows="2" class="form-control" 
                                      placeholder="Información adicional...">{{ old('notas') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Punina Care - Telemedicina</strong><br>
                Al crear la consulta, se redirigirá automáticamente a la sala de videollamada.
                Podrá llenar el historial clínico mientras ve al paciente.
            </div>

            <div class="d-flex justify-content-end gap-3 mt-3">
                <a href="{{ route('telemedicina.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-video me-1"></i> Crear y Entrar a la Sala
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoExistente = document.getElementById('tipo_existente');
    const tipoNuevo = document.getElementById('tipo_nuevo');
    const seccionExistente = document.getElementById('seccionExistente');
    const seccionNuevo = document.getElementById('seccionNuevo');
    const selectPaciente = document.getElementById('paciente_id');

    function togglePaciente() {
        if (tipoExistente.checked) {
            seccionExistente.style.display = 'block';
            seccionNuevo.style.display = 'none';
            selectPaciente.required = true;
            // Quitar required de los campos de nuevo paciente
            document.querySelectorAll('#seccionNuevo input, #seccionNuevo select').forEach(el => {
                el.required = false;
            });
        } else {
            seccionExistente.style.display = 'none';
            seccionNuevo.style.display = 'block';
            selectPaciente.required = false;
            // Poner required a los campos de nuevo paciente
            document.querySelectorAll('#seccionNuevo input[name*="nombre"], #seccionNuevo input[name*="apellido"], #seccionNuevo input[name*="cedula"], #seccionNuevo input[name*="fecha_nacimiento"]').forEach(el => {
                el.required = true;
            });
        }
    }

    tipoExistente.addEventListener('change', togglePaciente);
    tipoNuevo.addEventListener('change', togglePaciente);
    
    // Ejecutar al cargar
    togglePaciente();
});
</script>
@endpush
