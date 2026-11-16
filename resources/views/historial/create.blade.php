@extends('layouts.app')

@section('title', 'Nuevo Historial Clínico')
@section('page-title', 'Registrar Nuevo Historial Clínico')

@php $breadcrumbs = ['Pacientes' => route('pacientes.index'), 'Historiales' => route('historiales.index'), 'Nuevo Historial' => null]; @endphp
@section('content')
<div class="container-fluid px-0">
    <!-- Header con botón de copiar -->
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

    <form action="{{ route('historial.store', $paciente) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(auth()->user()->hasRole('Enfermero'))
            <!-- VISTA PARA ENFERMERO: Solo Signos Vitales y Alergias -->
            <div class="alert alert-info border-0 shadow-sm mb-4">
                <i class="fas fa-info-circle me-2"></i> Estás registrando un control de signos vitales. Solo puedes ingresar los datos de esta sección.
            </div>
            
            <!-- Campos ocultos requeridos por el controlador -->
            <input type="hidden" name="fecha_consulta" value="{{ date('Y-m-d') }}">
            <input type="hidden" name="motivo_consulta" value="Control de signos vitales (Enfermería)">
            <input type="hidden" name="doctor" value="{{ auth()->user()->name }}">
            
            <!-- Alergias (Está dentro de antecedentes patológicos) -->
            @include('historial.partials._antecedentes-patologicos')
            
            <!-- Signos Vitales -->
            @include('historial.partials._signos-vitales')
            
            <!-- Botones de acción -->
            @include('historial.partials._botones-accion')
        @else
            <!-- VISTA COMPLETA PARA MÉDICOS Y ADMINISTRADORES -->
            @include('historial.partials._info-paciente')
            @include('historial.partials._datos-consulta')
            
            @include('historial.partials._antecedentes-patologicos')
            @include('historial.partials._antecedentes-no-patologicos')
            @include('historial.partials._antecedentes-familiares')
            @include('historial.partials._gineco-obstetricos')
            @include('historial.partials._enfermedad-actual')
            @include('historial.partials._signos-vitales')
            @include('historial.partials._revision-sistemas')
            @include('historial.partials._exploracion-fisica')
            @include('historial.partials._estudios-complementarios')
            @include('historial.partials._diagnosticos')
            @include('historial.partials._tratamiento')
            @include('historial.partials._observaciones')
            @include('historial.partials._botones-accion')
        @endif
    </form>
</div>
@endsection

{{-- @push('scripts') --}}
    @include('historial.partials._scripts')
    @include('historial.partials._scripts-receta')
    <script>
        window.cie10SearchUrl = '{{ route("cie10.search") }}';
        window.cie10ByDiagnosticoUrl = '{{ route("cie10.by-diagnostico") }}';
    </script>

{{-- @endpush --}}
