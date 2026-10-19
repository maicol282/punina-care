@extends('layouts.app')

@section('title', 'Nuevo Historial Clínico')
<div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
    <div>
        <i class="fas fa-file-medical me-2 text-primary"></i> 
        <span class="fw-semibold">Registrar Nuevo Historial Clínico</span>
        @if($paciente->historialClinicos->count() > 0)
            <span class="badge bg-info ms-2">Historiales previos: {{ $paciente->historialClinicos->count() }}</span>
        @endif
    </div>
    <div>
        @if($paciente->historialClinicos->count() > 0)
            <button type="button" class="btn btn-warning btn-sm" id="btnCopiarHistorialAnterior" title="Copiar datos del último historial">
                <i class="fas fa-copy me-1"></i> Copiar último historial
            </button>
        @endif
    </div>
</div>
@section('page-title', 'Registrar Nuevo Historial Clínico')

@section('content')
<div class="container-fluid px-0">
    <!-- Información del paciente -->
@include('historial.partials._info-paciente')
@include('historial.partials._datos-consulta')
        <!-- ========== ANTECEDENTES PERSONALES PATOLÓGICOS ========== -->
  @include('historial.partials._antecedentes-patologicos')
        <!-- ========== ANTECEDENTES PERSONALES NO PATOLÓGICOS ========== -->
        @include('historial.partials._antecedentes-no-patologicos')
        <!-- ========== ANTECEDENTES FAMILIARES ========== -->
        @include('historial.partials._antecedentes-familiares')
        <!-- ========== GINECO OBSTÉTRICOS ========== -->
                @include('historial.partials._gineco-obstetricos')
<!-- ========== ENFERMEDAD ACTUAL ========== -->
               @include('historial.partials._enfermedad-actual')
        <!-- ========== SIGNOS VITALES ========== -->
        @include('historial.partials._signos-vitales')
        <!-- ========== EXPLORACIÓN FÍSICA ========== -->
        @include('historial.partials._exploracion-fisica')
        <!-- ========== REVISIÓN DE ÓRGANOS Y SISTEMAS ========== -->
        @include('historial.partials._revision-sistemas')
<!-- ========== ESTUDIOS COMPLEMENTARIOS ========== -->
        @include('historial.partials._estudios-complementarios')
<!-- ========== DIAGNÓSTICOS ========== -->
        @include('historial.partials._diagnosticos')
        <!-- ========== TRATAMIENTO Y RECOMENDACIONES ========== -->
        @include('historial.partials._tratamiento')
        <!-- ========== OBSERVACIONES ========== -->
        @include('historial.partials._observaciones')
        <!-- BOTONES -->
                @include('historial.partials._botones-accion')
    </form>
</div>
@endsection
@push('scripts')
    @include('historial.partials._scripts')
@endpush