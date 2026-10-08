@extends('layouts.app')

@section('title', 'Lista de Pacientes')
@section('page-title', 'Gestión de Pacientes')

@section('content')
<div class="card border-0 shadow-sm">
    <!-- ========== CABECERA ========== -->
    <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center border-bottom">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="fas fa-users me-2 text-primary"></i> Lista de Pacientes
        </h5>
        @can('crear pacientes')
        <a href="{{ route('pacientes.create') }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
            <i class="fas fa-plus me-1"></i> Nuevo Paciente
        </a>
        @endcan
    </div>

    <div class="card-body p-4">
        <!-- ========== ALERTAS ========== -->
        @if(request('search'))
            <div class="alert alert-info d-flex align-items-center mb-4 border-0 shadow-sm" role="alert">
                <i class="fas fa-search fa-lg me-3"></i> 
                <div>
                    Resultados para: <strong>"{{ request('search') }}"</strong>
                    <span class="badge bg-white text-info ms-2">{{ $pacientes->total() }} encontrados</span>
                </div>
            </div>
        @endif

        <!-- ========== BARRA DE BÚSQUEDA Y FILTROS ========== -->
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-8 col-lg-6">
                <form method="GET" action="{{ route('pacientes.index') }}" id="searchForm">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                        <span class="input-group-text bg-white border-0 text-muted ps-3">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-0 bg-white" 
                               value="{{ request('search') }}" 
                               placeholder="Buscar por nombre, cédula o teléfono..."
                               id="searchInput" style="box-shadow: none;">
                        <button type="submit" class="btn btn-primary px-4">Buscar</button>
                        @if(request('search'))
                        <a href="{{ route('pacientes.index') }}" class="btn btn-light px-3 border-start" title="Limpiar búsqueda">
                            <i class="fas fa-times text-danger"></i>
                        </a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-lg-6 text-md-end">
                <button class="btn btn-outline-secondary rounded-pill shadow-sm" id="toggleFiltrosPacientes" type="button">
                    <i class="fas fa-sliders-h me-1"></i>
                    <span id="toggleFiltrosTextoPacientes">Filtros Avanzados</span>
                    @if(request()->hasAny(['fecha_inicio', 'fecha_fin', 'genero', 'ciudad', 'ocupacion']))
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">Filtros activos</span>
                        </span>
                    @endif
                </button>
            </div>
        </div>

        <!-- ========== PANEL DE FILTROS OCULTO ========== -->
        <div id="filtrosPacientesContainer" class="bg-light p-4 rounded-4 mb-4 border" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-dark mb-0"><i class="fas fa-filter text-primary me-2"></i> Opciones de Filtrado</h6>
                @if(request()->hasAny(['fecha_inicio', 'fecha_fin', 'genero', 'ciudad', 'ocupacion']))
                    <span class="badge bg-primary rounded-pill">Filtros Activos</span>
                @endif
            </div>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" id="filtroFechaInicio" class="form-control" value="{{ request('fecha_inicio') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Fecha Fin</label>
                    <input type="date" name="fecha_fin" id="filtroFechaFin" class="form-control" value="{{ request('fecha_fin') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label text-muted small fw-semibold">Género</label>
                    <select name="genero" id="filtroGenero" class="form-select">
                        <option value="">Todos</option>
                        <option value="M" {{ request('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ request('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                        <option value="Otro" {{ request('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label text-muted small fw-semibold">Ciudad</label>
                    <input type="text" name="ciudad" id="filtroCiudad" class="form-control" value="{{ request('ciudad') }}" placeholder="Ej: Quito">
                </div>
                <div class="col-md-2">
                    <label class="form-label text-muted small fw-semibold">Ocupación</label>
                    <input type="text" name="ocupacion" id="filtroOcupacion" class="form-control" value="{{ request('ocupacion') }}" placeholder="Ej: Médico">
                </div>
                <div class="col-12 mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <button class="btn btn-light border shadow-sm" id="limpiarFiltrosPacientes">
                        <i class="fas fa-undo me-1"></i> Limpiar
                    </button>
                    <a href="#" id="exportarFiltrosPacientes" class="btn btn-success shadow-sm" target="_blank">
                        <i class="fas fa-file-excel me-1"></i> Excel
                    </a>
                    <button class="btn btn-primary shadow-sm" id="aplicarFiltrosPacientes">
                        <i class="fas fa-check me-1"></i> Aplicar Filtros
                    </button>
                </div>
            </div>
        </div>

        <!-- ========== TABLA DE DATOS ========== -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3 text-muted">#</th>
                        <th class="text-muted">Cédula</th>
                        <th class="text-muted">Paciente</th>
                        <th class="text-muted">Edad</th>
                        <th class="text-muted">Género</th>
                        <th class="text-muted">Contacto</th>
                        <th class="text-center text-muted">Historiales</th>
                        <th class="text-end pe-4 text-muted">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pacientes as $paciente)
                    <tr>
                        <td class="ps-3 fw-semibold text-muted">{{ $paciente->id }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $paciente->cedula ?? 'N/E' }}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-2" style="width:35px; height:35px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block">{{ $paciente->nombre_completo }}</span>
                                    <small class="text-muted">{{ $paciente->ocupacion ?? 'Sin ocupación' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $paciente->edad }} años</td>
                        <td>
                            @if($paciente->genero == 'M')
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1"><i class="fas fa-mars me-1"></i> Masc</span>
                            @elseif($paciente->genero == 'F')
                                <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1"><i class="fas fa-venus me-1"></i> Fem</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1"><i class="fas fa-genderless me-1"></i> Otro</span>
                            @endif
                        </td>
                        <td>
                            <div class="small">
                                <div><i class="fas fa-phone text-muted me-1"></i> {{ $paciente->telefono ?? '-' }}</div>
                                @if($paciente->email)
                                <div class="text-truncate" style="max-width: 150px;" title="{{ $paciente->email }}">
                                    <i class="fas fa-envelope text-muted me-1"></i> {{ $paciente->email }}
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-info rounded-pill px-3">{{ $paciente->historial_clinicos_count }}</span>
                        </td>
                        <td class="text-end pe-3">
                            <div class="btn-group shadow-sm">
                                <a href="{{ route('pacientes.show', $paciente) }}" class="btn btn-sm btn-light border text-primary" title="Ver" data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('editar pacientes')
                                <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-sm btn-light border text-warning" title="Editar" data-bs-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan
                                @can('crear historiales')
                                <a href="{{ route('historial.create', $paciente) }}" class="btn btn-sm btn-light border text-success" title="Nuevo Historial" data-bs-toggle="tooltip">
                                    <i class="fas fa-notes-medical"></i>
                                </a>
                                @endcan
                                @can('crear reportes')
                                <a href="{{ route('reportes.paciente', $paciente) }}" class="btn btn-sm btn-light border text-secondary" title="PDF" target="_blank" data-bs-toggle="tooltip">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @endcan
                                @if(auth()->user()->hasAnyRole(['Administrador', 'Médico']))
                                <button type="button" class="btn btn-sm btn-light border text-danger" 
                                        onclick="confirmDelete(event, 'delete-form-{{ $paciente->id }}')"
                                        title="Eliminar" data-bs-toggle="tooltip">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                @if(request('search'))
                                    <i class="fas fa-search-minus fa-4x text-muted mb-3 opacity-25"></i>
                                    <h5 class="text-muted fw-bold">Sin resultados</h5>
                                    <p class="text-muted">No encontramos pacientes para "<strong>{{ request('search') }}</strong>"</p>
                                    <a href="{{ route('pacientes.index') }}" class="btn btn-primary rounded-pill mt-2 px-4">
                                        <i class="fas fa-arrow-left me-1"></i> Volver a la lista
                                    </a>
                                @else
                                    <i class="fas fa-folder-open fa-4x text-muted mb-3 opacity-25"></i>
                                    <h5 class="text-muted fw-bold">Directorio vacío</h5>
                                    <p class="text-muted">Aún no hay pacientes registrados en el sistema.</p>
                                    @can('crear pacientes')
                                    <a href="{{ route('pacientes.create') }}" class="btn btn-primary rounded-pill mt-2 px-4 shadow-sm">
                                        <i class="fas fa-plus me-1"></i> Registrar Primer Paciente
                                    </a>
                                    @endcan
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- ========== PAGINACIÓN ========== -->
        @if($pacientes->count() > 0)
        <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
            <span class="text-muted small">
                Mostrando {{ $pacientes->firstItem() ?? 0 }} a {{ $pacientes->lastItem() ?? 0 }} de {{ $pacientes->total() }} pacientes
            </span>
            <div>
                {{ $pacientes->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inicializar Tooltips de Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    function confirmDelete(event, formId) {
        event.preventDefault();
        Swal.fire({
            title: '¿Eliminar paciente?',
            text: "Esta acción es irreversible y podría afectar los historiales clínicos asociados.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="fas fa-trash me-1"></i> Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'rounded-pill px-4',
                cancelButton: 'rounded-pill px-4'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
    
    $(document).ready(function() {
        let filtrosVisibles = false;
        const hasFilters = window.location.search.includes('fecha_inicio') || 
                           window.location.search.includes('fecha_fin') || 
                           window.location.search.includes('genero') || 
                           window.location.search.includes('ciudad') || 
                           window.location.search.includes('ocupacion');
        
        if (hasFilters) {
            $('#filtrosPacientesContainer').show();
            filtrosVisibles = true;
            $('#toggleFiltrosTextoPacientes').text('Ocultar Filtros');
            $('#toggleFiltrosPacientes i').removeClass('fa-sliders-h').addClass('fa-times');
            $('#toggleFiltrosPacientes').addClass('btn-secondary text-white').removeClass('btn-outline-secondary');
        }
        
        $('#toggleFiltrosPacientes').on('click', function() {
            $('#filtrosPacientesContainer').slideToggle(300);
            filtrosVisibles = !filtrosVisibles;
            
            if(filtrosVisibles) {
                $('#toggleFiltrosTextoPacientes').text('Ocultar Filtros');
                $(this).find('i').removeClass('fa-sliders-h').addClass('fa-times');
                $(this).addClass('btn-secondary text-white').removeClass('btn-outline-secondary');
            } else {
                $('#toggleFiltrosTextoPacientes').text('Filtros Avanzados');
                $(this).find('i').removeClass('fa-times').addClass('fa-sliders-h');
                $(this).removeClass('btn-secondary text-white').addClass('btn-outline-secondary');
            }
        });
        
        // Aplicar Filtros, Exportar Excel y Limpiar se mantienen exactamente igual
        $('#aplicarFiltrosPacientes').on('click', function() {
            const params = new URLSearchParams();
            const search = new URLSearchParams(window.location.search).get('search');
            if (search) params.append('search', search);
            
            if ($('#filtroFechaInicio').val()) params.append('fecha_inicio', $('#filtroFechaInicio').val());
            if ($('#filtroFechaFin').val()) params.append('fecha_fin', $('#filtroFechaFin').val());
            if ($('#filtroGenero').val()) params.append('genero', $('#filtroGenero').val());
            if ($('#filtroCiudad').val()) params.append('ciudad', $('#filtroCiudad').val());
            if ($('#filtroOcupacion').val()) params.append('ocupacion', $('#filtroOcupacion').val());
            
            const url = new URL(window.location.href);
            url.search = params.toString();
            window.location.href = url.toString();
        });
        
        $('#exportarFiltrosPacientes').on('click', function(e) {
            e.preventDefault();
            const params = new URLSearchParams(window.location.search);
            const url = '{{ route("exportar.pacientes") }}?' + params.toString();
            window.open(url, '_blank');
        });
        
        $('#limpiarFiltrosPacientes').on('click', function() {
            const search = new URLSearchParams(window.location.search).get('search');
            window.location.href = search ? `?search=${encodeURIComponent(search)}` : '?';
        });
    });
</script>
@endpush