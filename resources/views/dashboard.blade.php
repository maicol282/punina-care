@extends('layouts.app')

@section('title', 'Estadísticas')
@section('page-title', 'Panel de Estadísticas')

@section('content')
<!-- Tarjetas de estadísticas principales -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #3498db;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <i class="fas fa-users me-1"></i> Total Pacientes
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPacientes }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-left-success shadow h-100 py-2" style="border-left: 4px solid #2ecc71;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            <i class="fas fa-notes-medical me-1"></i> Total Historiales
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalHistoriales }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-notes-medical fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-left-info shadow h-100 py-2" style="border-left: 4px solid #3498db;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            <i class="fas fa-calendar-check me-1"></i> Total Seguimientos
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSeguimientos }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card border-left-warning shadow h-100 py-2" style="border-left: 4px solid #f39c12;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            <i class="fas fa-clock me-1"></i> Próximas Citas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $proximasCitas->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráficos principales - Fila 1 -->
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-line me-2"></i> Evolución de Consultas (últimos 12 meses)
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="height: 350px;">
                    <canvas id="consultasChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie me-2"></i> Pacientes por Género
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-pie" style="height: 250px;">
                    <canvas id="generoChart"></canvas>
                </div>
                <div class="mt-3">
                    @foreach($pacientesGenero as $genero)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>
                                @if($genero->genero == 'M')
                                    <i class="fas fa-mars text-primary me-2"></i> Masculino
                                @elseif($genero->genero == 'F')
                                    <i class="fas fa-venus text-danger me-2"></i> Femenino
                                @else
                                    <i class="fas fa-genderless text-secondary me-2"></i> Otro
                                @endif
                            </span>
                            <span class="badge bg-primary rounded-pill">{{ $genero->total }}</span>
                        </div>
                    @endforeach
                    <div class="text-center mt-2">
                        <small class="text-muted">Total: {{ $totalPacientes }} pacientes</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráficos principales - Fila 2 -->
<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-bar me-2"></i> Nuevos Pacientes por Mes
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-bar" style="height: 300px;">
                    <canvas id="pacientesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie me-2"></i> Distribución por Rango de Edad
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-pie" style="height: 250px;">
                    <canvas id="edadChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráficos de análisis - Fila 3 -->
<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-bar me-2"></i> Top 5 Diagnósticos más Frecuentes
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-bar" style="height: 300px;">
                    <canvas id="topDiagnosticosChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-md me-2"></i> Top 5 Médicos por Consultas
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-bar" style="height: 300px;">
                    <canvas id="medicosChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tablas informativas - Fila 4 -->
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-calendar-alt me-2"></i> Próximas Citas (7 días)
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Doctor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($proximasCitas as $cita)
                            <tr>
                                <td>{{ $cita->historialClinico->paciente->nombre_completo }}</td>
                                <td>{{ $cita->proxima_cita->format('d/m/Y') }}</td>
                                <td>{{ $cita->historialClinico->doctor ?? 'N/E' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No hay citas programadas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-plus me-2"></i> Últimos Pacientes Registrados
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimosPacientes as $paciente)
                            <tr>
                                <td>{{ $paciente->nombre_completo }}</td>
                                <td>{{ $paciente->telefono }}</td>
                                <td>{{ $paciente->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No hay pacientes registrados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if($consultasPorEspecialidad->count() > 0 || $topCie10->count() > 0)
<div class="row mb-4">
    @if($consultasPorEspecialidad->count() > 0)
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-bar me-2"></i> Consultas por Especialidad
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-bar" style="height: 300px;">
                    <canvas id="especialidadChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($topCie10->count() > 0)
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-code me-2"></i> Top Códigos CIE-10
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-bar" style="height: 300px;">
                    <canvas id="cie10Chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endif
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Gráfico de consultas por mes (línea)
        @if($consultasPorMes->count() > 0)
        const ctxConsultas = document.getElementById('consultasChart').getContext('2d');
        new Chart(ctxConsultas, {
            type: 'line',
            data: {
                labels: {!! json_encode($consultasPorMes->map(function($item) {
                    $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                    return $meses[$item->mes - 1] . ' ' . $item->año;
                })) !!},
                datasets: [{
                    label: 'Consultas',
                    data: {!! json_encode($consultasPorMes->pluck('total')) !!},
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#3498db',
                    pointBorderColor: '#fff',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } }
            }
        });
        @endif

        // 2. Gráfico de género (dona)
        @if($pacientesGenero->count() > 0)
        const ctxGenero = document.getElementById('generoChart').getContext('2d');
        new Chart(ctxGenero, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($pacientesGenero->map(function($item) {
                    return $item->genero == 'M' ? 'Masculino' : ($item->genero == 'F' ? 'Femenino' : 'Otro');
                })) !!},
                datasets: [{
                    data: {!! json_encode($pacientesGenero->pluck('total')) !!},
                    backgroundColor: ['#3498db', '#e74c3c', '#95a5a6'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
        @endif

        // 3. Gráfico de nuevos pacientes (barras)
        @if($pacientesPorMes->count() > 0)
        const ctxPacientes = document.getElementById('pacientesChart').getContext('2d');
        new Chart(ctxPacientes, {
            type: 'bar',
            data: {
                labels: {!! json_encode($pacientesPorMes->map(function($item) {
                    $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                    return $meses[$item->mes - 1] . ' ' . $item->año;
                })) !!},
                datasets: [{
                    label: 'Nuevos Pacientes',
                    data: {!! json_encode($pacientesPorMes->pluck('total')) !!},
                    backgroundColor: '#2ecc71',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } }
            }
        });
        @endif

        // 4. Gráfico de rangos de edad (pastel)
        @if(isset($edadesStats) && $edadesStats->count() > 0)
        const ctxEdad = document.getElementById('edadChart').getContext('2d');
        new Chart(ctxEdad, {
            type: 'pie',
            data: {
                labels: {!! json_encode($edadesStats->pluck('rango_edad')) !!},
                datasets: [{
                    data: {!! json_encode($edadesStats->pluck('total')) !!},
                    backgroundColor: ['#3498db', '#e74c3c', '#f39c12', '#2ecc71', '#9b59b6', '#1abc9c'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'right' } }
            }
        });
        @endif

        // 5. Gráfico top diagnósticos (barras horizontales)
        @if(isset($topDiagnosticos) && $topDiagnosticos->count() > 0)
        const ctxDiag = document.getElementById('topDiagnosticosChart').getContext('2d');
        new Chart(ctxDiag, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topDiagnosticos->pluck('diagnostico')->map(function($d) { return \Illuminate\Support\Str::limit($d, 25); })) !!},
                datasets: [{
                    label: 'Frecuencia',
                    data: {!! json_encode($topDiagnosticos->pluck('total')) !!},
                    backgroundColor: '#9b59b6',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: { legend: { position: 'top' } }
            }
        });
        @endif

        // 6. Gráfico top médicos (barras)
        @if($topMedicos->count() > 0)
        const ctxMedicos = document.getElementById('medicosChart').getContext('2d');
        new Chart(ctxMedicos, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topMedicos->pluck('doctor')) !!},
                datasets: [{
                    label: 'Consultas',
                    data: {!! json_encode($topMedicos->pluck('total')) !!},
                    backgroundColor: '#3498db',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } }
            }
        });
        @endif

        // 7. Gráfico por especialidad
        @if(isset($consultasPorEspecialidad) && $consultasPorEspecialidad->count() > 0)
        const ctxEsp = document.getElementById('especialidadChart');
        if (ctxEsp) {
            new Chart(ctxEsp.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($consultasPorEspecialidad->pluck('especialidad')) !!},
                    datasets: [{
                        label: 'Consultas',
                        data: {!! json_encode($consultasPorEspecialidad->pluck('total')) !!},
                        backgroundColor: '#2ecc71',
                        borderRadius: 5
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }
        @endif

        // 8. Gráfico top CIE-10
        @if(isset($topCie10) && $topCie10->count() > 0)
        const ctxCie10 = document.getElementById('cie10Chart');
        if (ctxCie10) {
            new Chart(ctxCie10.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($topCie10->pluck('codigo')) !!},
                    datasets: [{
                        label: 'Usos',
                        data: {!! json_encode($topCie10->pluck('total')) !!},
                        backgroundColor: '#e74c3c',
                        borderRadius: 5
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }
        @endif
    });
</script>
@endpush