<?php $__env->startSection('title', 'Reposos Médicos'); ?>
<?php $__env->startSection('page-title', 'Gestión de Reposos Médicos'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <!-- Buscador y Filtros -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('reposos.index')); ?>" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Buscar</label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Nombre o cédula del paciente..." 
                               value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Paciente</label>
                        <select name="paciente_id" class="form-select">
                            <option value="">Todos</option>
                            <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($paciente->id); ?>" <?php echo e(request('paciente_id') == $paciente->id ? 'selected' : ''); ?>>
                                    <?php echo e($paciente->nombre); ?> <?php echo e($paciente->apellido); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($estado); ?>" <?php echo e(request('estado') == $estado ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($estado)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i> Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de Reposos -->
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-bed me-2 text-primary"></i>
                    Reposos Médicos
                    <span class="badge bg-primary ms-2"><?php echo e($reposos->total()); ?></span>
                </h5>
                <a href="<?php echo e(route('historiales.index')); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> Nuevo Reposo
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>N° Reposo</th>
                                <th>Paciente</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Días</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $reposos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reposo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <span class="badge bg-dark"><?php echo e($reposo->numero_reposo); ?></span>
                                </td>
                                <td>
                                    <strong><?php echo e($reposo->paciente->nombre); ?> <?php echo e($reposo->paciente->apellido); ?></strong>
                                    <br>
                                    <small class="text-muted">Cédula: <?php echo e($reposo->paciente->cedula ?? 'N/E'); ?></small>
                                </td>
                                <td><?php echo e($reposo->fecha_inicio->format('d/m/Y')); ?></td>
                                <td><?php echo e($reposo->fecha_fin->format('d/m/Y')); ?></td>
                                <td>
                                    <span class="badge bg-info"><?php echo e($reposo->dias); ?> días</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo e($reposo->tipo_label); ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($reposo->estado_color); ?>">
                                        <?php echo e($reposo->estado_label); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?php echo e(route('reposos.show', $reposo)); ?>" class="btn btn-info" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('reposos.edit', $reposo)); ?>" class="btn btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?php echo e(route('reposos.imprimir', $reposo)); ?>" class="btn btn-success" title="PDF" target="_blank">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <form action="<?php echo e(route('reposos.destroy', $reposo)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este reposo?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="fas fa-bed fa-3x text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">No hay reposos médicos registrados</h5>
                                    <p class="text-muted">Los reposos se crean desde el historial clínico del paciente.</p>
                                    <a href="<?php echo e(route('historiales.index')); ?>" class="btn btn-primary">
                                        <i class="fas fa-notes-medical me-1"></i> Ir a Historiales
                                    </a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <span class="text-muted">
                            Mostrando <?php echo e($reposos->firstItem() ?? 0); ?> - <?php echo e($reposos->lastItem() ?? 0); ?> 
                            de <?php echo e($reposos->total()); ?> resultados
                        </span>
                    </div>
                    <div>
                        <?php echo e($reposos->appends(request()->query())->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/reposos/index.blade.php ENDPATH**/ ?>