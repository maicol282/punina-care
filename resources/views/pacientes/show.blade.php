@extends('layouts.app')

@section('title', 'Detalles del Paciente')
@section('page-title', 'Perfil del Paciente')

@section('content')
<div class="row">
    @include('pacientes.partials.show._sidebar')
    @include('pacientes.partials.show._historiales')
</div>
@endsection

@include('pacientes.partials.show._scripts')
