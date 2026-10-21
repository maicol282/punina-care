@extends('layouts.app')

@section('title', 'Nuevo Pedido de Exámenes')
@section('page-title', 'Nuevo Pedido de Exámenes')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-flask me-2 text-primary"></i>Pedido de Exámenes</h5>
        <small class="text-muted">Paciente: <strong>{{ $paciente->nombre_completo }}</strong></small>
    </div>
    <div class="card-body">
        <form action="{{ route('pedidos-examenes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
            <input type="hidden" name="historial_id" value="{{ $historial->id ?? '' }}">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Datos Generales -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label">Fecha del Pedido <span class="text-danger">*</span></label>
                    <input type="date" name="fecha_pedido" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Diagnóstico (CIE-10)</label>
                    <input type="text" name="diagnostico_cie10" class="form-control" value="{{ old('diagnostico_cie10', $diagnosticoAuto ?? '') }}" placeholder="Ej: J00 - Rinofaringitis aguda">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Motivo de la Solicitud</label>
                    <textarea name="motivo" class="form-control" rows="2" placeholder="Motivo...">{{ old('motivo', $motivoAuto ?? '') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Resumen Clínico</label>
                    <textarea name="resumen_clinico" class="form-control" rows="2" placeholder="Resumen...">{{ old('resumen_clinico', $historial ? $historial->enfermedad_actual : '') }}</textarea>
                </div>
            </div>

            <hr>

            <!-- ACORDEÓN DE EXÁMENES -->
            <h6 class="fw-bold text-primary mb-3"><i class="fas fa-list-check me-2"></i>Seleccione los Exámenes</h6>
            
            <div class="accordion" id="accordionExamenes">
                @foreach($examenes as $categoria => $subcategorias)
                    <div class="accordion-item mb-2 border rounded">
                        <h2 class="accordion-header" id="heading{{ Str::slug($categoria) }}">
                            <button class="accordion-button collapsed fw-bold text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ Str::slug($categoria) }}" aria-expanded="false">
                                <i class="fas fa-folder-open me-2"></i> {{ $categoria }}
                            </button>
                        </h2>
                        <div id="collapse{{ Str::slug($categoria) }}" class="accordion-collapse collapse" data-bs-parent="#accordionExamenes">
                            <div class="accordion-body bg-light">
                                
                                @foreach($subcategorias as $subcategoria => $items)
                                    <div class="mb-3">
                                        <strong class="text-secondary d-block mb-2 border-bottom pb-1">
                                            <i class="fas fa-tag me-1"></i> {{ $subcategoria }}
                                        </strong>
                                        <div class="row">
                                            @foreach($items as $examen)
                                                <div class="col-md-4 col-lg-3 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="examenes[]" value="{{ $examen->id }}" id="examen_{{ $examen->id }}">
                                                        <label class="form-check-label small" for="examen_{{ $examen->id }}">
                                                            {{ $examen->nombre }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- CATEGORÍA OTROS -->
                <div class="accordion-item mb-2 border rounded">
                    <h2 class="accordion-header" id="headingOtros">
                        <button class="accordion-button collapsed fw-bold text-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOtros" aria-expanded="false">
                            <i class="fas fa-plus-circle me-2"></i> Otros Exámenes (Especificar)
                        </button>
                    </h2>
                    <div id="collapseOtros" class="accordion-collapse collapse" data-bs-parent="#accordionExamenes">
                        <div class="accordion-body bg-light">
                            <label class="form-label fw-bold">Escriba aquí los exámenes que no están en la lista:</label>
                            <textarea name="otros_examenes" class="form-control" rows="3" placeholder="Ej: Examen de sangre especial, prueba de alergia, etc..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('pacientes.show', $paciente->id) }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Guardar Pedido de Exámenes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
