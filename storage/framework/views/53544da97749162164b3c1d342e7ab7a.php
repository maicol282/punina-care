

<?php $__env->startSection('title', 'Historiales Médicos'); ?>
<?php $__env->startSection('page-title', 'Listado de Historiales Médicos'); ?>

<?php $__env->startSection('content'); ?>
<div class="card border-0 shadow-sm">
    <!-- ========== CABECERA ========== -->
    <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center border-bottom">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="fas fa-notes-medical me-2 text-primary"></i> Todos los Historiales Clínicos
        </h5>
    </div>

    <div class="card-body p-4">
        <!-- ========== ALERTAS DE BÚSQUEDA ========== -->
        <?php if(request('search')): ?>
            <div class="alert alert-info d-flex align-items-center mb-4 border-0 shadow-sm" role="alert">
                <i class="fas fa-search fa-lg me-3"></i> 
                <div>
                    Resultados para: <strong>"<?php echo e(request('search')); ?>"</strong>
                    <span class="badge bg-white text-info ms-2"><?php echo e($historiales->total()); ?> encontrados</span>
                </div>
            </div>
        <?php endif; ?>

        <!-- ========== BARRA DE BÚSQUEDA Y FILTROS ========== -->
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-8 col-lg-6">
                <form method="GET" action="<?php echo e(route('historiales.index')); ?>" id="searchHistForm">
                    <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                        <span class="input-group-text bg-white border-0 text-muted ps-3">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-0 bg-white" 
                               value="<?php echo e(request('search')); ?>" 
                               placeholder="Buscar por nombre o cédula del paciente..."
                               id="searchHistInput" style="box-shadow: none;">
                        <button type="submit" class="btn btn-primary px-4">Buscar</button>
                        <?php if(request('search')): ?>
                        <a href="<?php echo e(route('historiales.index')); ?>" class="btn btn-light px-3 border-start" title="Limpiar búsqueda">
                            <i class="fas fa-times text-danger"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-lg-6 text-md-end">
                <button class="btn btn-outline-secondary rounded-pill shadow-sm" id="toggleFiltrosHistoriales" type="button">
                    <i class="fas fa-sliders-h me-1"></i>
                    <span id="toggleFiltrosTextoHistoriales">Filtros Avanzados</span>
                    <?php if(request()->hasAny(['fecha_inicio', 'fecha_fin', 'doctor', 'diagnostico'])): ?>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">Filtros activos</span>
                        </span>
                    <?php endif; ?>
                </button>
            </div>
        </div>

        <!-- ========== PANEL DE FILTROS OCULTO ========== -->
        <div id="filtrosHistorialesContainer" class="bg-light p-4 rounded-4 mb-4 border" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-dark mb-0"><i class="fas fa-filter text-primary me-2"></i> Opciones de Filtrado</h6>
                <?php if(request()->hasAny(['fecha_inicio', 'fecha_fin', 'doctor', 'diagnostico'])): ?>
                    <span class="badge bg-primary rounded-pill">Filtros Activos</span>
                <?php endif; ?>
            </div>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" id="filtroHistFechaInicio" class="form-control" value="<?php echo e(request('fecha_inicio')); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Fecha Fin</label>
                    <input type="date" name="fecha_fin" id="filtroHistFechaFin" class="form-control" value="<?php echo e(request('fecha_fin')); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Doctor Tratante</label>
                    <input type="text" name="doctor" id="filtroHistDoctor" class="form-control" value="<?php echo e(request('doctor')); ?>" placeholder="Ej: Dr. Pérez">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Diagnóstico (CIE-10 o texto)</label>
                    <input type="text" name="diagnostico" id="filtroHistDiagnostico" class="form-control" value="<?php echo e(request('diagnostico')); ?>" placeholder="Palabra clave o código">
                </div>
                <div class="col-12 mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <button class="btn btn-light border shadow-sm" id="limpiarFiltrosHistoriales">
                        <i class="fas fa-undo me-1"></i> Limpiar
                    </button>
                    <a href="#" id="exportarFiltrosHistoriales" class="btn btn-success shadow-sm" target="_blank">
                        <i class="fas fa-file-excel me-1"></i> Excel
                    </a>
                    <button class="btn btn-primary shadow-sm" id="aplicarFiltrosHistoriales">
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
                        <th class="ps-3 text-muted">ID</th>
                        <th class="text-muted">Paciente</th>
                        <th class="text-muted">Fecha Consulta</th>
                        <th class="text-muted">Doctor</th>
                        <th class="text-muted" style="max-width: 250px;">Diagnóstico principal</th>
                        <th class="text-end pe-4 text-muted">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $historiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $historial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-primary" style="font-size: 13px;">
                                <i class="fas fa-id-card me-1"></i>
                                <?php echo e($historial->paciente->cedula ?? 'SIN-CÉDULA'); ?>

                                <br>
                                <small class="text-muted" style="font-size: 11px;">
                                    <?php echo e($historial->fecha_consulta->format('Ymd')); ?>

                                </small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3" style="width:38px; height:38px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-user-injured"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block"><?php echo e($historial->paciente->nombre_completo); ?></span>
                                    <div class="small">
                                        <span class="badge bg-light text-dark border me-1"><?php echo e($historial->paciente->cedula ?? 'S/C'); ?></span>
                                        <span class="text-muted"><i class="fas fa-phone me-1"></i><?php echo e($historial->paciente->telefono ?? '-'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="far fa-calendar-alt text-muted me-2"></i>
                                <span><?php echo e($historial->fecha_consulta->format('d/m/Y')); ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-1 me-2 text-center" style="width: 24px; height: 24px; line-height: 1;">
                                    <i class="fas fa-user-md text-primary" style="font-size: 10px;"></i>
                                </div>
                                <span class="text-dark"><?php echo e($historial->doctor ?? 'N/E'); ?></span>
                            </div>
                        </td>
                        <td style="max-width: 250px;">
                            <?php if($historial->diagnosticos && $historial->diagnosticos->count() > 0): ?>
                                <div class="d-flex flex-wrap gap-1">
                                    <?php $__currentLoopData = $historial->diagnosticos->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diagnostico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info" title="<?php echo e($diagnostico->descripcion); ?>" style="white-space: normal; text-align: left;">
                                            <?php if($diagnostico->cie10_code): ?>
                                                <span class="badge bg-info text-white me-1" style="font-size: 10px;"><?php echo e($diagnostico->cie10_code); ?></span>
                                            <?php endif; ?>
                                            <?php echo e(Str::limit($diagnostico->descripcion, 25)); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($historial->diagnosticos->count() > 2): ?>
                                        <span class="badge bg-light text-dark border" title="Ver todos los diagnósticos">
                                            +<?php echo e($historial->diagnosticos->count() - 2); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php elseif($historial->diagnostico): ?>
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning">
                                    <?php echo e(Str::limit($historial->diagnostico, 30)); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-muted small">
                                    <i class="fas fa-minus-circle text-muted me-1"></i> No especificado
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-3">
                            <div class="btn-group shadow-sm">
                                <a href="<?php echo e(route('historial.show', $historial)); ?>" class="btn btn-sm btn-light border text-primary" title="Ver Completo" data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('reportes.historial', $historial)); ?>" class="btn btn-sm btn-light border text-danger" target="_blank" title="Exportar PDF" data-bs-toggle="tooltip">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar historiales')): ?>
                                <a href="<?php echo e(route('historial.edit', $historial)); ?>" class="btn btn-sm btn-light border text-warning" title="Editar" data-bs-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear seguimientos')): ?>
                                <a href="<?php echo e(route('seguimientos.create', $historial)); ?>" class="btn btn-sm btn-light border text-success" title="Agregar Seguimiento" data-bs-toggle="tooltip">
                                    <i class="fas fa-clipboard-check"></i>
                                </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('reposos.create', $historial)); ?>" class="btn btn-sm btn-light border text-info" title="Emitir Reposo" data-bs-toggle="tooltip">
                                    <i class="fas fa-bed"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <?php if(request('search')): ?>
                                    <i class="fas fa-search-minus fa-4x text-muted mb-3 opacity-25"></i>
                                    <h5 class="text-muted fw-bold">Sin resultados</h5>
                                    <p class="text-muted">No encontramos historiales para "<strong><?php echo e(request('search')); ?></strong>"</p>
                                    <a href="<?php echo e(route('historiales.index')); ?>" class="btn btn-primary rounded-pill mt-2 px-4">
                                        <i class="fas fa-arrow-left me-1"></i> Ver todos los historiales
                                    </a>
                                <?php else: ?>
                                    <i class="fas fa-file-medical fa-4x text-muted mb-3 opacity-25"></i>
                                    <h5 class="text-muted fw-bold">Sin historiales</h5>
                                    <p class="text-muted">Aún no hay historiales médicos registrados en el sistema.</p>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- ========== PAGINACIÓN ========== -->
        <?php if($historiales->count() > 0): ?>
        <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
            <span class="text-muted small">
                Mostrando <?php echo e($historiales->firstItem() ?? 0); ?> a <?php echo e($historiales->lastItem() ?? 0); ?> de <?php echo e($historiales->total()); ?> registros
            </span>
            <div>
                <?php echo e($historiales->appends(request()->query())->links()); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    // Inicializar tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // ========== TOGGLE FILTROS ==========
    let filtrosHistVisibles = false;
    const hasHistFilters = window.location.search.includes('fecha_inicio') || 
                           window.location.search.includes('fecha_fin') || 
                           window.location.search.includes('doctor') || 
                           window.location.search.includes('diagnostico');
    
    if (hasHistFilters) {
        $('#filtrosHistorialesContainer').show();
        filtrosHistVisibles = true;
        $('#toggleFiltrosTextoHistoriales').text('Ocultar Filtros');
        $('#toggleFiltrosHistoriales i').removeClass('fa-sliders-h').addClass('fa-times');
        $('#toggleFiltrosHistoriales').addClass('btn-secondary text-white').removeClass('btn-outline-secondary');
    }
    
    $('#toggleFiltrosHistoriales').on('click', function() {
        $('#filtrosHistorialesContainer').slideToggle(300);
        filtrosHistVisibles = !filtrosHistVisibles;
        
        if(filtrosHistVisibles) {
            $('#toggleFiltrosTextoHistoriales').text('Ocultar Filtros');
            $(this).find('i').removeClass('fa-sliders-h').addClass('fa-times');
            $(this).addClass('btn-secondary text-white').removeClass('btn-outline-secondary');
        } else {
            $('#toggleFiltrosTextoHistoriales').text('Filtros Avanzados');
            $(this).find('i').removeClass('fa-times').addClass('fa-sliders-h');
            $(this).removeClass('btn-secondary text-white').addClass('btn-outline-secondary');
        }
    });
    
    // ========== APLICAR FILTROS ==========
    $('#aplicarFiltrosHistoriales').on('click', function() {
        const params = new URLSearchParams();
        const search = new URLSearchParams(window.location.search).get('search');
        if (search) params.append('search', search);
        
        if ($('#filtroHistFechaInicio').val()) params.append('fecha_inicio', $('#filtroHistFechaInicio').val());
        if ($('#filtroHistFechaFin').val()) params.append('fecha_fin', $('#filtroHistFechaFin').val());
        if ($('#filtroHistDoctor').val()) params.append('doctor', $('#filtroHistDoctor').val());
        if ($('#filtroHistDiagnostico').val()) params.append('diagnostico', $('#filtroHistDiagnostico').val());
        
        const url = new URL(window.location.href);
        url.search = params.toString();
        window.location.href = url.toString();
    });
    
    // ========== EXPORTAR EXCEL CON FILTROS ==========
    $('#exportarFiltrosHistoriales').on('click', function(e) {
        e.preventDefault();
        const params = new URLSearchParams(window.location.search);
        const url = '<?php echo e(route("exportar.historiales")); ?>?' + params.toString();
        window.open(url, '_blank');
    });
    
    // ========== LIMPIAR FILTROS ==========
    $('#limpiarFiltrosHistoriales').on('click', function() {
        const search = new URLSearchParams(window.location.search).get('search');
        window.location.href = search ? `?search=${encodeURIComponent(search)}` : '?';
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historiales/index.blade.php ENDPATH**/ ?>