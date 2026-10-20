@extends('layouts.app')

@section('title', 'Registrar Paciente')
@section('page-title', 'Registro de Paciente')
@section('breadcrumb', 'Nuevo Paciente')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Datos del Paciente</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pacientes.store') }}" method="POST">
            @csrf

            <div class="row">
                <!-- COLUMNA IZQUIERDA - INFORMACIÓN PERSONAL -->
                <div class="col-md-6">
                    @include('pacientes.partials.create._informacion-personal')
                </div>

                <!-- COLUMNA DERECHA - UBICACIÓN Y OBSERVACIONES -->
                <div class="col-md-6">
                    @include('pacientes.partials.create._ubicacion')
                    @include('pacientes.partials.create._informacion-medica')
                </div>
            </div>

            @include('pacientes.partials.create._facturacion')

            <div class="row mt-4">
                <div class="col-12 text-end">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Paciente
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@include('pacientes.partials.create._scripts')
