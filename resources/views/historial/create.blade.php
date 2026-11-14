@extends('layouts.app')

@section('title', 'Nuevo Historial Clínico')
@section('page-title', 'Registrar Nuevo Historial Clínico')

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

        <!-- Información del paciente -->
        @include('historial.partials._info-paciente')
        @include('historial.partials._datos-consulta')
        
        <!-- ANTECEDENTES PERSONALES PATOLÓGICOS -->
        @include('historial.partials._antecedentes-patologicos')
        
        <!-- ANTECEDENTES PERSONALES NO PATOLÓGICOS -->
        @include('historial.partials._antecedentes-no-patologicos')
        
        <!-- ANTECEDENTES FAMILIARES -->
        @include('historial.partials._antecedentes-familiares')
        
        <!-- GINECO OBSTÉTRICOS -->
        @include('historial.partials._gineco-obstetricos')
        
        <!-- ENFERMEDAD ACTUAL -->
        @include('historial.partials._enfermedad-actual')
        
        <!-- SIGNOS VITALES -->
        @include('historial.partials._signos-vitales')
        
        <!-- EXPLORACIÓN FÍSICA -->
        @include('historial.partials._exploracion-fisica')
        
        <!-- REVISIÓN DE ÓRGANOS Y SISTEMAS -->
        @include('historial.partials._revision-sistemas')
        
        <!-- ESTUDIOS COMPLEMENTARIOS -->
        @include('historial.partials._estudios-complementarios')
        
        <!-- DIAGNÓSTICOS -->
        @include('historial.partials._diagnosticos')
        
        <!-- TRATAMIENTO Y RECOMENDACIONES -->
        @include('historial.partials._tratamiento')
        
        <!-- OBSERVACIONES -->
        @include('historial.partials._observaciones')
        
        <!-- BOTONES -->
        @include('historial.partials._botones-accion')
    </form>
</div>
@endsection

@push('scripts')
    @include('historial.partials._scripts')
    @include('historial.partials._scripts-receta')
    <script>
        window.cie10SearchUrl = '{{ route("cie10.search") }}';
        window.cie10ByDiagnosticoUrl = '{{ route("cie10.by-diagnostico") }}';
    </script>

    // ============================================
    // CONFIGURAR DROP ZONES (SUBIDA DE ARCHIVOS)
    // ============================================
    function configurarDropZone(zoneClass, inputClass, listClass) {
        const dropZone = document.querySelector(zoneClass);
        const fileInput = document.querySelector(inputClass);
        const fileList = document.querySelector(listClass);
        if (!dropZone || !fileInput) return;

        dropZone.addEventListener('click', function(e) {
            e.stopPropagation();
            fileInput.click();
        });

        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#4f46e5';
            this.style.background = '#eef2ff';
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#d1d5db';
            this.style.background = '#fafafa';
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#d1d5db';
            this.style.background = '#fafafa';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                mostrarArchivos(files, fileList);
            }
        });

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                mostrarArchivos(this.files, fileList);
            }
        });
    }

    function mostrarArchivos(files, fileList) {
        let html = '';
        for (let file of files) {
            const icono = file.type.includes('pdf') ? 'fa-file-pdf' : (file.type.includes('image') ? 'fa-file-image' : 'fa-file');
            const color = file.type.includes('pdf') ? 'danger' : (file.type.includes('image') ? 'primary' : 'secondary');
            const tamaño = file.size > 1048576 ? (file.size / 1048576).toFixed(1) + 'MB' : (file.size / 1024).toFixed(0) + 'KB';
            html += `
                <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;">
                    <i class="fas ${icono} text-${color}" style="font-size: 12px;"></i>
                    <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                    <span class="text-muted" style="font-size: 9px;">${tamaño}</span>
                </div>
            `;
        }
        fileList.innerHTML = html;
    }

    // Inicializar dropzones
    configurarDropZone('.drop-zone-laboratorio', '.file-input-laboratorio', '.file-list-laboratorio');
    configurarDropZone('.drop-zone-imagen', '.file-input-imagen', '.file-list-imagen');
    configurarDropZone('.drop-zone-otros', '.file-input-otros', '.file-list-otros');
    
@endpush
