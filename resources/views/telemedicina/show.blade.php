@extends('layouts.app')

@section('title', 'Punina Care - Detalle de Consulta')
@section('page-title', 'Detalle de Consulta - Telemedicina')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-video me-2"></i>
            Consulta #{{ $consulta->id }}
            <span class="badge bg-{{ $consulta->estado_color }} ms-2">{{ $consulta->estado_label }}</span>
        </h5>
        <div>
            <span class="badge bg-light text-dark">Punina Care</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Información del Paciente -->
            <div class="col-md-6">
                <h6 class="fw-bold text-primary"><i class="fas fa-user me-2"></i>Paciente</h6>
                <hr>
                <p><strong>Nombre:</strong> {{ $consulta->paciente->nombre }} {{ $consulta->paciente->apellido }}</p>
                <p><strong>Cédula:</strong> {{ $consulta->paciente->cedula ?? 'N/E' }}</p>
                <p><strong>Teléfono:</strong> {{ $consulta->paciente->telefono ?? 'N/E' }}</p>
                <p><strong>Email:</strong> {{ $consulta->paciente->email ?? 'N/E' }}</p>
            </div>

            <!-- Información del Médico -->
            <div class="col-md-6">
                <h6 class="fw-bold text-primary"><i class="fas fa-user-md me-2"></i>Médico</h6>
                <hr>
                <p><strong>Nombre:</strong> {{ $consulta->medico->name }}</p>
                <p><strong>Especialidad:</strong> {{ $consulta->medico->especialidad ?? 'Médico General' }}</p>
                <p><strong>Email:</strong> {{ $consulta->medico->email }}</p>
            </div>

            <!-- Información de la Consulta -->
            <div class="col-12 mt-3">
                <h6 class="fw-bold text-primary"><i class="fas fa-calendar-alt me-2"></i>Información de la Consulta</h6>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Fecha programada:</strong><br>
                            <span class="badge bg-light text-dark">{{ $consulta->fecha_hora_programada->format('d/m/Y H:i') }}</span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Duración:</strong> {{ $consulta->duracion }} minutos</p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            <strong>Estado:</strong>
                            <span class="badge bg-{{ $consulta->estado_color }}">{{ $consulta->estado_label }}</span>
                        </p>
                    </div>
                    @if($consulta->fecha_inicio_real)
                    <div class="col-md-4">
                        <p><strong>Inicio real:</strong> {{ $consulta->fecha_inicio_real->format('d/m/Y H:i') }}</p>
                    </div>
                    @endif
                    @if($consulta->fecha_fin_real)
                    <div class="col-md-4">
                        <p><strong>Fin real:</strong> {{ $consulta->fecha_fin_real->format('d/m/Y H:i') }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Motivo -->
            <div class="col-12 mt-3">
                <h6 class="fw-bold text-primary"><i class="fas fa-notes-medical me-2"></i>Motivo</h6>
                <hr>
                <p>{{ $consulta->motivo ?? 'No especificado' }}</p>
            </div>

            <!-- Notas -->
            @if($consulta->notas)
            <div class="col-12 mt-3">
                <h6 class="fw-bold text-primary"><i class="fas fa-comment me-2"></i>Notas</h6>
                <hr>
                <p>{{ $consulta->notas }}</p>
            </div>
            @endif

            <!-- ===== ENLACE DE VIDEOLHAMADA CON BOTÓN COPIAR ===== -->
            <div class="col-12 mt-3">
                <div class="alert alert-success">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-link me-2"></i>
                        <strong>Enlace de videollamada:</strong>
                        <a href="{{ $consulta->enlace_acceso }}" target="_blank" class="text-primary" id="enlaceVideollamada">
                            {{ $consulta->enlace_acceso }}
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-secondary ms-2" id="copiarEnlace" title="Copiar enlace">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <small class="text-muted">La videollamada se realiza a través de Jitsi Meet</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('telemedicina.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
        <div>
            @if($consulta->estado == 'programada')
                <a href="{{ route('telemedicina.sala', $consulta) }}" class="btn btn-success" target="_blank">
                    <i class="fas fa-video me-1"></i> Iniciar Videollamada
                </a>
                <form action="{{ route('telemedicina.cancelar', $consulta) }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Cancelar esta consulta?')">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                </form>
            @endif
            @if($consulta->estado == 'en_curso')
                <form action="{{ route('telemedicina.finalizar', $consulta) }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check me-1"></i> Finalizar Consulta
                    </button>
                </form>
                <a href="{{ $consulta->enlace_acceso }}" target="_blank" class="btn btn-success">
                    <i class="fas fa-video me-1"></i> Unirse a Videollamada
                </a>
            @endif
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== COPIAR ENLACE =====
    const btnCopiar = document.getElementById('copiarEnlace');
    const enlace = document.getElementById('enlaceVideollamada');

    if (btnCopiar && enlace) {
        btnCopiar.addEventListener('click', function() {
            const url = enlace.textContent.trim();
            
            // Usar navigator.clipboard si está disponible
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(function() {
                    mostrarToast('✅ Enlace copiado al portapapeles');
                }).catch(function() {
                    copiarUrlAlternativo(url);
                });
            } else {
                copiarUrlAlternativo(url);
            }
        });
    }

    function copiarUrlAlternativo(url) {
        // Método alternativo para navegadores antiguos
        const textarea = document.createElement('textarea');
        textarea.value = url;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        mostrarToast('✅ Enlace copiado al portapapeles');
    }

    function mostrarToast(mensaje) {
        // Crear toast simple
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-3';
        toast.role = 'alert';
        toast.ariaLive = 'assertive';
        toast.ariaAtomic = 'true';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${mensaje}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        
        const bsToast = new bootstrap.Toast(toast, { delay: 3000 });
        bsToast.show();
        
        toast.addEventListener('hidden.bs.toast', function() {
            toast.remove();
        });
    }
});
</script>
@endpush