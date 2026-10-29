@extends('layouts.app')

@section('title', 'Punina Care - Telemedicina')
@section('page-title', 'Punina Care - Telemedicina')

@section('content')
    <!-- AVISO DE USO DE TELECONSULTA -->
    <div class="alert alert-info alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
        <div class="d-flex">
            <div class="me-3">
                <i class="fas fa-info-circle fa-2x"></i>
            </div>
            <div>
                <h5 class="alert-heading fw-bold mb-1">¿Cómo funciona la Teleconsulta?</h5>
                <p class="mb-0 small">Haga clic en el botón verde de cualquier consulta para abrir la <strong>App de Jitsi</strong>. Usted será el anfitrión. Puede navegar por el sistema sin cortes mientras la app se mantiene abierta.</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-video me-2 text-primary"></i>
            Consultas de Telemedicina
            <span class="badge bg-primary ms-2">{{ $consultas->total() }}</span>
        </h5>
        <a href="{{ route('telemedicina.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Nueva Consulta
        </a>
    </div>
    <div class="card-body">
        <!-- Filtros -->
        <div class="row mb-3">
            <div class="col-md-12">
                <form method="GET" action="{{ route('telemedicina.index') }}" class="row g-2">
                    <div class="col-md-4">
                        <select name="estado" class="form-select form-select-sm">
                            <option value="">Todos los estados</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado }}" {{ request('estado') == $estado ? 'selected' : '' }}>
                                    {{ ucfirst($estado) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="paciente_id" class="form-select form-select-sm">
                            <option value="">Todos los pacientes</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" {{ request('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->nombre }} {{ $paciente->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-filter me-1"></i> Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Fecha/Hora</th>
                        <th>Duración</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($consultas as $consulta)
                        <tr>
                            <td>
                                <strong>{{ $consulta->paciente->nombre }} {{ $consulta->paciente->apellido }}</strong>
                                <br>
                                <small class="text-muted">Cédula: {{ $consulta->paciente->cedula ?? 'N/E' }}</small>
                            </td>
                            <td>{{ $consulta->medico->name }}</td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $consulta->fecha_hora_programada->format('d/m/Y') }}
                                </span>
                                <br>
                                <small class="text-muted">{{ $consulta->fecha_hora_programada->format('H:i') }}</small>
                            </td>
                            <td>{{ $consulta->duracion }} min</td>
                            <td>
                                <span class="badge bg-{{ $consulta->estado_color }}">
                                    {{ $consulta->estado_label }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('telemedicina.show', $consulta) }}" class="btn btn-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($consulta->estado == 'programada')
                                        <a href="{{ route('telemedicina.edit', $consulta) }}" class="btn btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('telemedicina.cancelar', $consulta) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger" title="Cancelar" onclick="return confirm('¿Cancelar esta consulta?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($consulta->estado == 'programada' || $consulta->estado == 'en_curso')
                                        <a href="jitsi-meet://{{ $consulta->sala_nombre }}" target="_blank" class="btn btn-success" title="Iniciar videollamada">
                                            <i class="fas fa-video"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-video-slash fa-3x text-muted mb-3 d-block"></i>
                                <h5 class="text-muted">No hay consultas de telemedicina</h5>
                                <a href="{{ route('telemedicina.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i> Crear primera consulta
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-end mt-3">
            {{ $consultas->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection