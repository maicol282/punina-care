@extends('layouts.app')

@section('title', 'Editar Historial Clínico')
@section('page-title', 'Editar Historial Clínico')

@section('content')
<div class="container-fluid px-0">
    <!-- Información del paciente -->
       @include('historial.partials.edit._info-paciente')

    <form action="{{ route('historial.update', $historial->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if(auth()->user()->hasRole('Enfermero'))
            <!-- VISTA PARA ENFERMERO: Solo Signos Vitales y Alergias -->
            <div class="alert alert-info border-0 shadow-sm mb-4">
                <i class="fas fa-info-circle me-2"></i> Estás editando un control de signos vitales. Solo puedes modificar los datos de esta sección.
            </div>
            
            <!-- Alergias (dentro de antecedentes patológicos) -->
            <div class="mb-3">
                <label class="form-label fw-bold">Alergias a medicamentos</label>
                <textarea name="alergias_patologicas" class="form-control" rows="2" placeholder="Penicilina, Ibuprofeno...">{{ old('alergias_patologicas', $historial->alergias_patologicas) }}</textarea>
            </div>
            
            @include('historial.partials.edit._signos-vitales')
            @include('historial.partials.edit._botones-accion')
        @else
            <!-- VISTA COMPLETA PARA MÉDICOS Y ADMINISTRADORES -->
            @include('historial.partials.edit._datos-consulta')
            @include('historial.partials.edit._antecedentes-patologicos')
            @include('historial.partials.edit._antecedentes-no-patologicos')
            @include('historial.partials.edit._antecedentes-familiares')
            @include('historial.partials.edit._gineco-obstetricos')
            @include('historial.partials.edit._enfermedad-actual')
            @include('historial.partials.edit._signos-vitales')
            @include('historial.partials.edit._revision-sistemas')
            @include('historial.partials.edit._exploracion-fisica')
            @include('historial.partials.edit._estudios-complementarios')
            @include('historial.partials.edit._diagnosticos')
            @include('historial.partials.edit._tratamiento')
            @include('historial.partials.edit._observaciones')
            @include('historial.partials.edit._recetas')
            @include('historial.partials.edit._botones-accion')
        @endif
    </form>
    </form>
</div>
@endsection
@push('scripts')
@include('historial.partials.edit._scripts')
@endpush
@include('historial.partials._scripts-receta')
