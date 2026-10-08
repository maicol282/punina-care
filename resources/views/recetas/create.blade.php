@extends('layouts.app')

@section('title', 'Nueva Receta')
@section('page-title', 'Registrar Nueva Receta')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-prescription-bottle me-2 text-primary"></i>
                    Nueva Receta - {{ $historial->paciente->nombre_completo }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('recetas.store', $historial) }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_emision" class="form-label">Fecha de Emisión <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('fecha_emision') is-invalid @enderror" 
                                   id="fecha_emision" name="fecha_emision" 
                                   value="{{ old('fecha_emision', date('Y-m-d')) }}" required>
                            @error('fecha_emision')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="medicamento" class="form-label">Medicamento <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('medicamento') is-invalid @enderror" 
                                   id="medicamento" name="medicamento" value="{{ old('medicamento') }}" required>
                            @error('medicamento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="presentacion" class="form-label">Presentación</label>
                            <input type="text" class="form-control @error('presentacion') is-invalid @enderror" 
                                   id="presentacion" name="presentacion" value="{{ old('presentacion') }}" 
                                   placeholder="Ej: Tableta, Cápsula, Jarabe...">
                            @error('presentacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="concentracion" class="form-label">Concentración</label>
                            <input type="text" class="form-control @error('concentracion') is-invalid @enderror" 
                                   id="concentracion" name="concentracion" value="{{ old('concentracion') }}" 
                                   placeholder="Ej: 500mg, 10mg/ml...">
                            @error('concentracion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="dosis" class="form-label">Dosis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('dosis') is-invalid @enderror" 
                                   id="dosis" name="dosis" value="{{ old('dosis') }}" 
                                   placeholder="Ej: 1 tableta, 10ml..." required>
                            @error('dosis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="frecuencia" class="form-label">Frecuencia <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('frecuencia') is-invalid @enderror" 
                                   id="frecuencia" name="frecuencia" value="{{ old('frecuencia') }}" 
                                   placeholder="Ej: Cada 8 horas, 3 veces al día..." required>
                            @error('frecuencia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="duracion" class="form-label">Duración <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('duracion') is-invalid @enderror" 
                                   id="duracion" name="duracion" value="{{ old('duracion') }}" 
                                   placeholder="Ej: 7 días, 1 mes..." required>
                            @error('duracion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Signos de Alarma -->
<div class="col-md-6 mb-3">
    <label for="signos_alarma" class="form-label">Signos de Alarma</label>
    <input type="text" class="form-control @error('signos_alarma') is-invalid @enderror" 
           id="signos_alarma" name="signos_alarma" value="{{ old('signos_alarma') }}">
    @error('signos_alarma')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<!-- Recomendaciones No Farmacológicas -->
<div class="col-md-6 mb-3">
    <label for="recomendaciones_no_farmacologicas" class="form-label">Recomendaciones No Farmacológicas</label>
    <input type="text" class="form-control @error('recomendaciones_no_farmacologicas') is-invalid @enderror" 
           id="recomendaciones_no_farmacologicas" name="recomendaciones_no_farmacologicas" value="{{ old('recomendaciones_no_farmacologicas') }}">
    @error('recomendaciones_no_farmacologicas')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

                        <div class="col-12 mb-3">
                            <label for="indicaciones" class="form-label">Indicaciones</label>
                            <textarea class="form-control @error('indicaciones') is-invalid @enderror" 
                                      id="indicaciones" name="indicaciones" rows="3" 
                                      placeholder="Instrucciones adicionales para el paciente...">{{ old('indicaciones') }}</textarea>
                            @error('indicaciones')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="advertencias" class="form-label">Advertencias</label>
                            <textarea class="form-control @error('advertencias') is-invalid @enderror" 
                                      id="advertencias" name="advertencias" rows="2" 
                                      placeholder="Contraindicaciones, efectos secundarios, precauciones...">{{ old('advertencias') }}</textarea>
                            @error('advertencias')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('recetas.index', $historial) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Guardar Receta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection