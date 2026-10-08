@extends('layouts.app')

@section('title', 'Editar Paciente')
@section('page-title', 'Editar Datos del Paciente')
@section('breadcrumb', 'Editar Paciente')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Editar Paciente: {{ $paciente->nombre_completo }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- COLUMNA IZQUIERDA - INFORMACIÓN PERSONAL -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="fas fa-user me-2 text-primary"></i>Información Personal</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre', $paciente->nombre) }}" required>
                                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('apellido') is-invalid @enderror" 
                                       id="apellido" name="apellido" value="{{ old('apellido', $paciente->apellido) }}" required>
                                @error('apellido')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                           id="fecha_nacimiento" name="fecha_nacimiento" 
                                           value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento instanceof \Carbon\Carbon ? $paciente->fecha_nacimiento->format('Y-m-d') : $paciente->fecha_nacimiento) }}" required>
                                    @error('fecha_nacimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edad" class="form-label">Edad (años)</label>
                                    <input type="text" class="form-control" id="edad" readonly style="background-color: #e9ecef;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="genero" class="form-label">Género <span class="text-danger">*</span></label>
                                    <select class="form-select @error('genero') is-invalid @enderror" id="genero" name="genero" required>
                                        <option value="">Seleccione...</option>
                                        <option value="M" {{ old('genero', $paciente->genero) == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('genero', $paciente->genero) == 'F' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro" {{ old('genero', $paciente->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('genero')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                                    <select class="form-select @error('tipo_sangre') is-invalid @enderror" id="tipo_sangre" name="tipo_sangre">
                                        <option value="">Seleccione...</option>
                                        @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $tipo)
                                            <option value="{{ $tipo }}" {{ old('tipo_sangre', $paciente->tipo_sangre) == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_sangre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                           id="telefono" name="telefono" value="{{ old('telefono', $paciente->telefono) }}" required>
                                    @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $paciente->email) }}" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cedula" class="form-label">Cédula</label>
                                    <input type="text" class="form-control @error('cedula') is-invalid @enderror" 
                                           id="cedula" name="cedula" value="{{ old('cedula', $paciente->cedula) }}" 
                                           placeholder="1234567890" maxlength="10" 
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    @error('cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ocupacion" class="form-label">Ocupación</label>
                                    <input type="text" class="form-control @error('ocupacion') is-invalid @enderror" 
                                           id="ocupacion" name="ocupacion" value="{{ old('ocupacion', $paciente->ocupacion) }}" 
                                           placeholder="Ej: Médico, Ingeniero...">
                                    @error('ocupacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COLUMNA DERECHA - UBICACIÓN Y OBSERVACIONES -->
                <div class="col-md-6">
                    <!-- Tarjeta de Ubicación -->
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Ubicación</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pais" class="form-label">País</label>
                                    <input type="text" class="form-control @error('pais') is-invalid @enderror" 
                                           id="pais" name="pais" value="{{ old('pais', $paciente->pais) }}" placeholder="Ecuador">
                                    @error('pais')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="provincia" class="form-label">Provincia</label>
                                    <input type="text" class="form-control @error('provincia') is-invalid @enderror" 
                                           id="provincia" name="provincia" value="{{ old('provincia', $paciente->provincia) }}" placeholder="Pichincha">
                                    @error('provincia')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="ciudad" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control @error('ciudad') is-invalid @enderror" 
                                           id="ciudad" name="ciudad" value="{{ old('ciudad', $paciente->ciudad) }}" placeholder="Quito">
                                    @error('ciudad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="direccion" class="form-label">Dirección específica</label>
                                    <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                              id="direccion" name="direccion" rows="2" 
                                              placeholder="Calle, número, edificio...">{{ old('direccion', $paciente->direccion) }}</textarea>
                                    @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de Información Médica -->
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="fas fa-notes-medical me-2 text-primary"></i>Información Médica</h6>
                        </div>
                        <!-- Alergias -->
                        <div class="card-body">
                            <label for="alergias" class="form-label">
                                <i class="fas fa-allergies me-1 text-danger"></i> Alergias
                            </label>
                            <textarea class="form-control @error('alergias') is-invalid @enderror" 
                                    id="alergias" name="alergias" rows="3" 
                                    placeholder="Ej: Penicilina, Ibuprofeno, látex, polen, etc...">{{ old('alergias', $paciente->alergias) }}</textarea>
                            
                            @error('alergias')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="observaciones" class="form-label">Observaciones</label>
                                <textarea class="form-control @error('observaciones') is-invalid @enderror" 
                                          id="observaciones" name="observaciones" rows="4" 
                                          placeholder="Información adicional relevante...">{{ old('observaciones', $paciente->observaciones) }}</textarea>
                                @error('observaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ==================== TARJETA DE FACTURACIÓN (SRI ECUADOR) ==================== -->
                    <div class="card">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="fas fa-file-invoice-dollar me-2 text-primary"></i>Datos de Facturación</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ruc" class="form-label">RUC</label>
                                    <input type="text" class="form-control @error('ruc') is-invalid @enderror" 
                                           id="ruc" name="ruc" value="{{ old('ruc', $paciente->ruc) }}" 
                                           placeholder="13 dígitos" maxlength="13" 
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <small class="text-muted">Número de RUC (13 dígitos)</small>
                                    @error('ruc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="razon_social" class="form-label">Razón Social / Nombres</label>
                                    <input type="text" class="form-control @error('razon_social') is-invalid @enderror" 
                                           id="razon_social" name="razon_social" value="{{ old('razon_social', $paciente->razon_social) }}">
                                    @error('razon_social')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="direccion_fiscal" class="form-label">Dirección Fiscal</label>
                                    <input type="text" class="form-control @error('direccion_fiscal') is-invalid @enderror" 
                                           id="direccion_fiscal" name="direccion_fiscal" value="{{ old('direccion_fiscal', $paciente->direccion_fiscal) }}">
                                    @error('direccion_fiscal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefono_facturacion" class="form-label">Teléfono Facturación</label>
                                    <input type="tel" class="form-control @error('telefono_facturacion') is-invalid @enderror" 
                                           id="telefono_facturacion" name="telefono_facturacion" value="{{ old('telefono_facturacion', $paciente->telefono_facturacion) }}">
                                    @error('telefono_facturacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_facturacion" class="form-label">Email Facturación</label>
                                    <input type="email" class="form-control @error('email_facturacion') is-invalid @enderror" 
                                           id="email_facturacion" name="email_facturacion" value="{{ old('email_facturacion', $paciente->email_facturacion) }}">
                                    @error('email_facturacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="obligado_contabilidad" id="obligado_contabilidad" value="1" 
                                               {{ old('obligado_contabilidad', $paciente->obligado_contabilidad) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="obligado_contabilidad">
                                            Obligado a llevar contabilidad
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="contribuyente_especial" id="contribuyente_especial" value="1" 
                                               {{ old('contribuyente_especial', $paciente->contribuyente_especial) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="contribuyente_especial">
                                            Contribuyente Especial
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="agente_retencion" id="agente_retencion" value="1" 
                                               {{ old('agente_retencion', $paciente->agente_retencion) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="agente_retencion">
                                            Agente de Retención
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <!-- Alerta informativa si el paciente tiene historiales -->
            @if($paciente->historialClinicos->count() > 0)
            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Nota:</strong> Este paciente tiene {{ $paciente->historialClinicos->count() }} historial(es) clínico(s). 
                La modificación de estos datos no afecta los registros de historial existentes.
            </div>
            @endif

            <div class="row mt-4">
                <div class="col-12 text-end">
                    <a href="{{ route('pacientes.show', $paciente) }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Actualizar Paciente
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function calcularEdad(fechaNacimiento) {
        if (!fechaNacimiento) return '';
        
        let fecha = new Date(fechaNacimiento);
        let hoy = new Date();
        
        if (isNaN(fecha.getTime())) return '';
        
        let edad = hoy.getFullYear() - fecha.getFullYear();
        let mes = hoy.getMonth() - fecha.getMonth();
        
        if (mes < 0 || (mes === 0 && hoy.getDate() < fecha.getDate())) {
            edad--;
        }
        
        return edad >= 0 ? edad : '';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const fechaInput = document.getElementById('fecha_nacimiento');
        const edadInput = document.getElementById('edad');
        
        if (fechaInput && edadInput) {
            // Calcular edad inicial
            if (fechaInput.value) {
                edadInput.value = calcularEdad(fechaInput.value);
            }
            
            // Actualizar al cambiar fecha
            fechaInput.addEventListener('change', function() {
                edadInput.value = calcularEdad(this.value);
            });
            
            fechaInput.addEventListener('input', function() {
                edadInput.value = calcularEdad(this.value);
            });
        }
    });
</script>
@endpush