@extends('layouts.app')

@section('title', 'Detalle de Teleconsulta')
@section('page-title', 'Detalle de Teleconsulta')

@section('content')
    <!-- AVISO DE USO DE TELECONSULTA -->
    <div class="alert alert-info alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
        <div class="d-flex">
            <div class="me-3">
                <i class="fas fa-info-circle fa-2x"></i>
            </div>
            <div>
                <h5 class="alert-heading fw-bold mb-1">¿Cómo funciona la Teleconsulta?</h5>
                <p class="mb-2 small">Siga estos pasos para una experiencia sin cortes:</p>
                <ol class="mb-0 small">
                    <li><strong>Inicie la videollamada:</strong> Haga clic en el botón verde. Se abrirá la <strong>App de Escritorio de Jitsi</strong> (si no la tiene, descárguela <a href="https://github.com/jitsi/jitsi-meet-electron/releases" target="_blank" class="alert-link">aquí</a>).</li>
                    <li><strong>Sea el anfitrión:</strong> Usted será el moderador de la sala. Copie el enlace desde la app y envíeselo al paciente.</li>
                    <li><strong>Navegue sin cortes:</strong> Deje la ventana de Jitsi abierta (puede ponerla "Siempre visible" en su sistema). Mientras tanto, navegue por Punina Care (pacientes, historiales, recetas) sin que la llamada se corte.</li>
                </ol>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<div class="container-fluid px-0">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-video me-2 text-primary"></i>Consulta de Telemedicina #{{ $consulta->id }}</h5>
            <a href="{{ route('telemedicina.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Paciente:</strong> {{ $consulta->paciente->nombre_completo ?? 'N/A' }}</p>
                    <p><strong>Médico:</strong> {{ $consulta->medico->name ?? 'N/A' }}</p>
                    <p><strong>Fecha:</strong> {{ $consulta->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Estado:</strong> 
                        @if($consulta->estado == 'programada') <span class="badge bg-info">Programada</span>
                        
                    <!-- ENLACE DE JITSI PARA COMPARTIR -->
                    <div class="mt-4 p-3 bg-light rounded border">
                        <h6 class="fw-bold text-primary mb-2"><i class="fas fa-link me-2"></i>Enlace para el Paciente</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" readonly value="https://meet.centromedicopuninacare.tech/{{ $consulta->sala_nombre }}">
                            <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText('https://meet.centromedicopuninacare.tech/{{ $consulta->sala_nombre }}'); alert('Enlace copiado al portapapeles');">
                                <i class="fas fa-copy"></i> Copiar
                            </button>
                        </div>
                        <small class="text-muted mt-2 d-block">Envía este enlace al paciente para que se una a la consulta.</small>
                    </div>

                    @elseif($consulta->estado == 'en_curso') <span class="badge bg-success">En Curso</span>
                        @elseif($consulta->estado == 'finalizada') <span class="badge bg-secondary">Finalizada</span>
                        @elseif($consulta->estado == 'cancelada') <span class="badge bg-danger">Cancelada</span>
                        @else <span class="badge bg-secondary">{{ ucfirst($consulta->estado) }}</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    @if($consulta->estado !== 'finalizada' && $consulta->estado !== 'cancelada')
                       <a href="jitsi-meet://{{ $consulta->sala_nombre }}" target="_blank" class="btn btn-success btn-lg">
                            <i class="fas fa-video me-2"></i> Iniciar Videollamada (App Escritorio)
                        </a>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-check-circle me-1"></i> Esta consulta ya ha finalizado.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/jitsi-pip.js') }}"></script>
@endpush