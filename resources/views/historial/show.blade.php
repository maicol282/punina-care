@extends('layouts.app')

@section('title', 'Detalle del Historial Clínico')
@section('page-title', 'Expediente Médico')

@section('content')
<div class="container-fluid px-0">
    
    <!-- ========== ENCABEZADO DEL PACIENTE ========== -->
    @include('historial.partials.show._encabezado-paciente')

    <!-- ========== DATOS DE LA CONSULTA ========== -->
    @include('historial.partials.show._datos-consulta')

    <!-- ========== SECCIÓN: SIGNOS VITALES ========== -->
   @include('historial.partials.show._signos-antecedentes')

    <!-- ========== GINECO OBSTÉTRICOS (SI APLICA) ========== -->
   @include('historial.partials.show._gineco-obstetricos')

    <!-- ========== EXPLORACIÓN FÍSICA Y SISTEMAS ========== -->
   @include('historial.partials.show._exploracion-sistemas')

    <!-- ========== DIAGNÓSTICOS, TRATAMIENTO Y ADJUNTOS ========== -->
    @include('historial.partials.show._diagnosticos-tratamiento')
    <!-- ========== PANEL DE ACCIONES E HISTORIALES RELACIONADOS ========== -->
    @include('historial.partials.show._acciones-historiales')

</div>

<!-- ========== MODAL ELIMINAR ========== -->

@endsection
@include('historial.partials.show._modal-eliminar')

@include('historial.partials.show._scripts')