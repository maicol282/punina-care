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

@push('scripts')
<script>
    function calcularEdadDetallada(fechaNacimiento) {
        const edadInput = document.getElementById('edad');
        const detalleInput = document.getElementById('edad_detallada');
        
        if (!fechaNacimiento || !edadInput) return;
        
        const hoy = new Date();
        const nacimiento = new Date(fechaNacimiento);
        
        if (isNaN(nacimiento.getTime())) {
            edadInput.value = '';
            if (detalleInput) detalleInput.textContent = '';
            return;
        }
        
        let años = hoy.getFullYear() - nacimiento.getFullYear();
        let meses = hoy.getMonth() - nacimiento.getMonth();
        let dias = hoy.getDate() - nacimiento.getDate();
        
        if (dias < 0) {
            meses--;
            const ultimoDiaMesAnterior = new Date(hoy.getFullYear(), hoy.getMonth(), 0).getDate();
            dias += ultimoDiaMesAnterior;
        }
        
        if (meses < 0) {
            años--;
            meses += 12;
        }
        
        edadInput.value = años;
        
        if (detalleInput) {
            if (años === 0) {
                if (meses === 0) {
                    detalleInput.textContent = `(${dias} días de nacido)`;
                } else {
                    detalleInput.textContent = `(${meses} meses y ${dias} días)`;
                }
            } else if (años < 2) {
                const totalMeses = (años * 12) + meses;
                detalleInput.textContent = `(${totalMeses} meses)`;
            } else {
                detalleInput.textContent = '';
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const fechaInput = document.getElementById('fecha_nacimiento');
        if (fechaInput) {
            if (fechaInput.value) {
                setTimeout(() => calcularEdadDetallada(fechaInput.value), 100);
            }
            fechaInput.addEventListener('change', function() {
                calcularEdadDetallada(this.value);
            });
            fechaInput.addEventListener('input', function() {
                calcularEdadDetallada(this.value);
            });
        }
    });
</script>
@endpush

@endsection

@include('pacientes.partials.create._scripts')
