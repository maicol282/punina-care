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

        <!-- ========== DATOS DE LA CONSULTA ========== -->
        @include('historial.partials.edit._datos-consulta')

        

        <!-- ========== ANTECEDENTES PERSONALES PATOLÓGICOS ========== -->
        @include('historial.partials.edit._antecedentes-patologicos')

        <!-- ========== ANTECEDENTES PERSONALES NO PATOLÓGICOS ========== -->
      @include('historial.partials.edit._antecedentes-no-patologicos')

        <!-- ========== ANTECEDENTES FAMILIARES ========== -->
        @include('historial.partials.edit._antecedentes-familiares')

        <!-- ========== GINECO OBSTÉTRICOS ========== -->
              @include('historial.partials.edit._gineco-obstetricos')
         <!-- ========== ENFERMEDAD ACTUAL ========== -->
                @include('historial.partials.edit._enfermedad-actual')


        <!-- ========== SIGNOS VITALES ========== -->
        @include('historial.partials.edit._signos-vitales')
        <!-- ========== EXPLORACIÓN FÍSICA ========== -->
        @include('historial.partials.edit._exploracion-fisica')

        <!-- ========== REVISIÓN DE ÓRGANOS Y SISTEMAS ========== -->
        @include('historial.partials.edit._revision-sistemas')

      <!-- ========== ESTUDIOS COMPLEMENTARIOS ========== -->
        @include('historial.partials.edit._estudios-complementarios')
        <!-- ========== DIAGNÓSTICOS ========== -->
@include('historial.partials.edit._diagnosticos')    
        <!-- ========== TRATAMIENTO Y RECOMENDACIONES ========== -->
        @include('historial.partials.edit._tratamiento')

        <!-- ========== OBSERVACIONES ========== -->
@include('historial.partials.edit._observaciones')
        <!-- ========== BOTONES ========== -->
        @include('historial.partials.edit._botones-accion')
    </form>
</div>
@endsection
@push('scripts')
@include('historial.partials.edit._scripts')
@endpush