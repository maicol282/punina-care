@extends('layouts.app')

@section('title', 'Panel de Estadísticas')
@section('page-title', 'Panel de Estadísticas')

@section('content')
<!-- ========== TARJETAS DE ESTADÍSTICAS ========== -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1">Total Pacientes</p>
                        <h2 class="fw-bolder mb-0 text-primary">{{ $totalPacientes }}</h2>
                    </div>
                    <div class="icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1">Historiales Clínicos</p>
                        <h2 class="fw-bolder mb-0 text-success">{{ $totalHistoriales }}</h2>
                    </div>
                    <div class="icon-box bg-success bg-opacity-10 text-success">
                        <i class="fas fa-notes-medical fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1">Seguimientos</p>
                        <h2 class="fw-bolder mb-0 text-info">{{ $totalSeguimientos }}</h2>
                    </div>
                    <div class="icon-box bg-info bg-opacity-10 text-info">
                        <i class="fas fa-clipboard-list fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card h-100 border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1">Diagnósticos Registrados</p>
                        <h2 class="fw-bolder mb-0 text-warning">{{ \App\Models\Diagnostico::count() }}</h2>
                    </div>
                    <div class="icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-diagnoses fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Botón de Exportar a Excel -->
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('seguridad.dashboard.exportar') }}" class="btn btn-success">
        <i class="fas fa-file-excel me-1"></i> Exportar Estadísticas a Excel
    </a>
</div>
<!-- ========== GRÁFICOS PRINCIPALES - FILA 1 ========== -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card h-100 border-0">
            <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-chart-line me-2 text-primary"></i> Evolución de Consultas</h6>
                <span class="badge bg-light text-dark border">Últimos 12 meses</span>
            </div>
            <div class="card-body p-4">
                <div style="height: 280px; position: relative;">
                    <canvas id="consultasChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100 border-0">
            <div class="card-header bg-transparent py-3">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-venus-mars me-2 text-primary"></i> Pacientes por Género</h6>
            </div>
            <div class="card-body p-4">
                <div style="height: 200px; position: relative;" class="mb-4">
                    <canvas id="generoChart"></canvas>
                </div>
                <div>
                    @foreach($pacientesGenero as $genero)
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                            <span class="fw-medium text-dark">
                                @if($genero->genero == 'Masculino' || $genero->genero == 'M')
                                    <i class="fas fa-mars text-primary me-2"></i> Masculino
                                @elseif($genero->genero == 'Femenino' || $genero->genero == 'F')
                                    <i class="fas fa-venus text-danger me-2"></i> Femenino
                                @else
                                    <i class="fas fa-genderless text-secondary me-2"></i> {{ $genero->genero ?: 'Otro' }}
                                @endif
                            </span>
                                                        <span class="badge bg-white text-dark border rounded-pill">
                                {{ $genero->total }} ({{ $genero->porcentaje }}%)
                                
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== GRÁFICOS - FILA 2 ========== -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card h-100 border-0">
            <div class="card-header bg-transparent py-3">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-user-plus me-2 text-success"></i> Nuevos Pacientes por Mes</h6>
            </div>
            <div class="card-body p-4">
                <div style="height: 250px; position: relative;">
                    <canvas id="pacientesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100 border-0">
            <div class="card-header bg-transparent py-3">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-birthday-cake me-2 text-warning"></i> Distribución por Edad</h6>
            </div>
            <div class="card-body p-4">
                <div style="height: 180px; position: relative;">
                    <canvas id="edadChart"></canvas>
                                    <!-- Listado de porcentajes por edad -->
                <div class="mt-3">
                    @foreach($edadesStats as $edad)
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                            <span class="fw-medium text-dark">{{ $edad->rango_edad }}</span>
                            <span class="badge bg-white text-dark border rounded-pill">
                                {{ $edad->total }} ({{ $edad->porcentaje }}%)
                            </span>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== GRÁFICOS - FILA 3 ========== -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card h-100 border-0">
            <div class="card-header bg-transparent py-3">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-stethoscope me-2 text-info"></i> Top 5 Diagnósticos</h6>
            </div>
            <div class="card-body p-4">
                <div style="height: 120px; position: relative;">
                    <canvas id="topDiagnosticosChart"></canvas>
                                    <!-- Listado de porcentajes -->
                <div class="mt-3">
                    @foreach($topDiagnosticos as $diag)
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                            <span class="fw-medium text-dark text-truncate" style="max-width: 70%;" title="{{ $diag->descripcion }}">
                                {{ Str::limit($diag->descripcion, 30) }}
                            </span>
                            <span class="badge bg-white text-dark border rounded-pill">
                                {{ $diag->total }} ({{ $diag->porcentaje }}%)
                            </span>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100 border-0">
            <div class="card-header bg-transparent py-3">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-user-md me-2 text-primary"></i> Top 5 Médicos con más consultas</h6>
            </div>
            <div class="card-body p-4">
                <div style="height: 120px; position: relative;">
                    <canvas id="medicosChart"></canvas>
                                    <!-- Listado de porcentajes -->
                <div class="mt-3">
                    @foreach($topMedicos as $medico)
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                            <span class="fw-medium text-dark">{{ $medico->doctor }}</span>
                            <span class="badge bg-white text-dark border rounded-pill">
                                {{ $medico->total }} ({{ $medico->porcentaje }}%)
                            </span>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== TABLAS E INFORMACIÓN ========== -->
<div class="row g-4 mb-4">
    <!-- Últimos Pacientes -->
    <div class="col-lg-6">
        <div class="card h-100 border-0">
            <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark">Últimos Pacientes Registrados</h6>
                <a href="{{ route('pacientes.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Ver todos</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Paciente</th>
                                <th>Teléfono</th>
                                <th>Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimosPacientes as $paciente)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box bg-light text-primary me-3" style="width: 36px; height: 36px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <a href="{{ route('pacientes.show', $paciente) }}" class="text-decoration-none text-dark fw-medium">
                                            {{ $paciente->nombre }} {{ $paciente->apellido }}
                                        </a>
                                    </div>
                                </td>
                                <td><span class="text-muted">{{ $paciente->telefono ?? 'N/E' }}</span></td>
                                <td><span class="badge bg-light text-dark border">{{ $paciente->created_at->diffForHumans() }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-5">
                                    <i class="fas fa-user-slash fa-2x mb-3 opacity-50 d-block"></i>
                                    No hay pacientes registrados
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Actividad Reciente & CIE-10 (Si aplica) -->
    <div class="col-lg-6">
        <!-- Top CIE 10 -->
        @if($topCie10->count() > 0)
        <div class="card border-0 mb-4">
            <div class="card-header bg-transparent py-3">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-code me-2 text-danger"></i> Códigos CIE-10 Frecuentes</h6>
            </div>
            <div class="card-body p-4">
                <div style="height: 150px; position: relative;">
                    <canvas id="cie10Chart"></canvas>
                                    <!-- Listado de porcentajes -->
                <div class="mt-3">
                    @foreach($topCie10 as $cie)
                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                            <span class="fw-medium text-dark">
                                <i class="fas fa-code me-1 text-danger"></i> {{ $cie->cie10_code }}
                            </span>
                            <span class="badge bg-white text-dark border rounded-pill">
                                {{ $cie->total }} ({{ $cie->porcentaje }}%)
                            </span>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Actividad Reciente -->
        <div class="card border-0">
            <div class="card-header bg-transparent py-3">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-bolt me-2 text-warning"></i> Actividad Reciente</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($actividadReciente as $actividad)
                    <li class="list-group-item px-4 py-3 border-bottom">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-info bg-opacity-10 text-info me-3" style="width: 36px; height: 36px;">
                                    <i class="fas fa-notes-medical"></i>
                                </div>
                                <div>
                                    <a href="{{ route('pacientes.show', $actividad->paciente) }}" class="text-decoration-none text-dark fw-medium d-block">
                                        {{ $actividad->paciente->nombre }} {{ $actividad->paciente->apellido }}
                                    </a>
                                    <small class="text-muted">Historial Actualizado</small>
                                </div>
                            </div>
                            <small class="text-muted">{{ $actividad->fecha_consulta ? Carbon\Carbon::parse($actividad->fecha_consulta)->format('d/m/Y') : 'N/E' }}</small>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted py-4 border-0">
                        <i class="fas fa-inbox me-2"></i> No hay actividad reciente
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- ========== DISTRIBUCIÓN GEOGRÁFICA ========== -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card h-100 border-0">
            <div class="card-header bg-transparent py-3">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-city me-2 text-primary"></i> Pacientes por Ciudad</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Ciudad</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pacientesPorCiudad as $ciudad)
                            <tr>
                                <td class="ps-4 fw-medium">{{ $ciudad->ciudad }}</td>
                                <td class="text-center">{{ $ciudad->total }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">{{ $ciudad->porcentaje }}%</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-5">
                                    <i class="fas fa-map-marker-slash fa-2x mb-3 opacity-50 d-block"></i>
                                    No hay datos de ciudad registrados
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100 border-0">
            <div class="card-header bg-transparent py-3">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-map-marker-alt me-2 text-success"></i> Pacientes por Provincia</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Provincia</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pacientesPorProvincia as $provincia)
                            <tr>
                                <td class="ps-4 fw-medium">{{ $provincia->provincia }}</td>
                                <td class="text-center">{{ $provincia->total }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill">{{ $provincia->porcentaje }}%</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-5">
                                    <i class="fas fa-map-marker-slash fa-2x mb-3 opacity-50 d-block"></i>
                                    No hay datos de provincia registrados
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== ACCIONES RÁPIDAS ========== -->
<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="card border-0 bg-transparent shadow-none">
            <div class="card-body p-0">
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <a href="{{ route('pacientes.create') }}" class="btn btn-primary w-100 py-3 shadow-sm d-flex flex-column align-items-center">
                            <i class="fas fa-user-plus fa-2x mb-2"></i>
                            <span class="fw-semibold">Nuevo Paciente</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('pacientes.index') }}" class="btn btn-success w-100 py-3 shadow-sm d-flex flex-column align-items-center">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <span class="fw-semibold">Ver Pacientes</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="{{ route('recetas.todas') }}" class="btn btn-info text-white w-100 py-3 shadow-sm d-flex flex-column align-items-center">
                            <i class="fas fa-prescription fa-2x mb-2"></i>
                            <span class="fw-semibold">Gestión de Recetas</span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="btn btn-warning text-white w-100 py-3 shadow-sm d-flex flex-column align-items-center" onclick="alert('Módulo de Citas en desarrollo')">
                            <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                            <span class="fw-semibold">Agenda de Citas</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- CONFIGURACIÓN GLOBAL CHART.JS ---
        Chart.defaults.font.family = "'Inter', -apple-system, sans-serif";
        Chart.defaults.color = '#64748b'; 
        Chart.defaults.scale.grid.color = '#f1f5f9'; 
        Chart.defaults.plugins.tooltip.backgroundColor = '#1e293b';
        Chart.defaults.plugins.tooltip.padding = 12;
        Chart.defaults.plugins.tooltip.cornerRadius = 8;
        Chart.defaults.plugins.tooltip.titleFont = { size: 14, weight: 'bold' };
        Chart.defaults.plugins.tooltip.bodyFont = { size: 13 };
        
        // 1. CONSULTAS POR MES
        @if($consultasPorMes->count() > 0)
        (function() {
            const ctx = document.getElementById('consultasChart').getContext('2d');
            const meses = @json($meses);
            const labels = @json($consultasPorMes->map(function($item) use ($meses) {
                return $meses[$item->mes - 1] . ' ' . $item->año;
            }));
            const data = @json($consultasPorMes->pluck('total'));
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Consultas',
                        data: data,
                        borderColor: '#0f2b45', /* primary */
                        backgroundColor: 'rgba(15, 43, 69, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#0f2b45',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
            });
        })();
        @endif

        // 2. GÉNERO
        @if($pacientesGenero->count() > 0)
        (function() {
            const ctx = document.getElementById('generoChart').getContext('2d');
            const labels = @json($pacientesGenero->map(function($item) {
                return $item->genero == 'Masculino' || $item->genero == 'M' ? 'Masculino' : ($item->genero == 'Femenino' || $item->genero == 'F' ? 'Femenino' : 'Otro');
            }));
            const data = @json($pacientesGenero->pluck('total'));
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{ data: data, backgroundColor: ['#0f2b45', '#e74c3c', '#94a3b8'], borderWidth: 0, hoverOffset: 5 }]
                },
                options: { responsive: true, maintainAspectRatio: false, cutout: '75%', plugins: { legend: { display: false } } }
            });
        })();
        @endif

        // 3. NUEVOS PACIENTES
        @if($pacientesPorMes->count() > 0)
        (function() {
            const ctx = document.getElementById('pacientesChart').getContext('2d');
            const meses = @json($meses);
            const labels = @json($pacientesPorMes->map(function($item) use ($meses) {
                return $meses[$item->mes - 1] . ' ' . $item->año;
            }));
            const data = @json($pacientesPorMes->pluck('total'));
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{ label: 'Nuevos Pacientes', data: data, backgroundColor: '#2b7a62', borderRadius: 6 }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
            });
        })();
        @endif

        // 4. EDADES
        @if($edadesStats->count() > 0)
        (function() {
            const ctx = document.getElementById('edadChart').getContext('2d');
            const labels = @json($edadesStats->pluck('rango_edad'));
            const data = @json($edadesStats->pluck('total'));
            const colores = ['#0f2b45', '#2b7a62', '#f39c12', '#e74c3c', '#3498db', '#1abc9c'];
            
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{ data: data, backgroundColor: colores.slice(0, data.length), borderWidth: 2, borderColor: '#fff' }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right', labels: { padding: 15, usePointStyle: true, pointStyle: 'circle' } } } }
            });
        })();
        @endif

        // 5. TOP DIAGNÓSTICOS
        @if($topDiagnosticos->count() > 0)
        (function() {
            const ctx = document.getElementById('topDiagnosticosChart').getContext('2d');
            const labels = @json($topDiagnosticos->pluck('descripcion')->map(function($d) { return strlen($d) > 25 ? substr($d, 0, 25) . '...' : $d; }));
            const data = @json($topDiagnosticos->pluck('total'));
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{ label: 'Frecuencia', data: data, backgroundColor: '#3498db', borderRadius: 6 }]
                },
                options: { responsive: true, maintainAspectRatio: false, indexAxis: 'y', plugins: { legend: { display: false } }, scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } } }
            });
        })();
        @endif

        // 6. TOP MÉDICOS
        @if($topMedicos->count() > 0)
        (function() {
            const ctx = document.getElementById('medicosChart').getContext('2d');
            const labels = @json($topMedicos->pluck('doctor'));
            const data = @json($topMedicos->pluck('total'));
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{ label: 'Consultas Atendidas', data: data, backgroundColor: '#1a4468', borderRadius: 6 }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
            });
        })();
        @endif

        // 7. TOP CIE-10
        @if($topCie10->count() > 0)
        (function() {
            const ctx = document.getElementById('cie10Chart');
            if (ctx) {
                const labels = @json($topCie10->pluck('cie10_code'));
                const data = @json($topCie10->pluck('total'));
                
                new Chart(ctx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{ label: 'Usos', data: data, backgroundColor: '#e74c3c', borderRadius: 4 }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
                });
            }
        })();
        @endif
    });
</script>
@endpush