@extends('layouts.app')

@section('title', 'Detalle de Teleconsulta')
@section('page-title', 'Detalle de Teleconsulta')

@section('content')
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
                            <input type="text" class="form-control" readonly value="https://meet.jit.si/{{ $consulta->sala_nombre }}">
                            <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText('https://meet.jit.si/{{ $consulta->sala_nombre }}'); alert('Enlace copiado al portapapeles');">
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
                       <button type="button" class="btn btn-success btn-lg" 
        onclick="abrirJitsiEnPiP('{{ $consulta->sala_nombre }}', '{{ $consulta->paciente->nombre_completo ?? 'Paciente' }}')">
    <i class="fas fa-video me-2"></i> Iniciar Videollamada (Ventana Flotante)
</button>
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