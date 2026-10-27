<?php $__env->startSection('title', 'Listado de Certificados Médicos'); ?>
<?php $__env->startSection('page-title', 'Certificados Médicos'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-certificate me-2 text-primary"></i>
            Certificados Médicos
            <span class="badge bg-primary ms-2"><?php echo e($certificados->total()); ?></span>
        </h5>
    </div>
    <div class="card-body">

        <!-- ===== FILTROS ===== -->
        <div class="row mb-3">
            <div class="col-md-12">
                <form method="GET" action="<?php echo e(route('certificados.index')); ?>" class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control form-control-sm" 
                               placeholder="Buscar por paciente..." value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col-md-3">
                        <select name="estado" class="form-select form-select-sm">
                            <option value="">Todos los estados</option>
                            <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($estado); ?>" <?php echo e(request('estado') == $estado ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($estado)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="paciente_id" class="form-select form-select-sm">
                            <option value="">Todos los pacientes</option>
                            <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($paciente->id); ?>" <?php echo e(request('paciente_id') == $paciente->id ? 'selected' : ''); ?>>
                                    <?php echo e($paciente->nombre); ?> <?php echo e($paciente->apellido); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-filter me-1"></i> Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ===== TABLA ===== -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Reposo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $certificados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <span class="badge bg-dark"><?php echo e($certificado->numero_certificado); ?></span>
                        </td>
                        <td>
                            <strong><?php echo e($certificado->paciente->nombre); ?> <?php echo e($certificado->paciente->apellido); ?></strong>
                            <br>
                            <small class="text-muted">Cédula: <?php echo e($certificado->paciente->cedula ?? 'N/E'); ?></small>
                        </td>
                        <td><?php echo e($certificado->fecha_atencion->format('d/m/Y')); ?></td>
                        <td>
                            <span class="badge bg-info"><?php echo e($certificado->tipo_contingencia_label); ?></span>
                        </td>
                        <td>
                            <?php if($certificado->reposo): ?>
                                <span class="badge bg-warning"><?php echo e($certificado->reposo_dias); ?> días</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">No</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($certificado->estado == 'activo' ? 'success' : 'danger'); ?>">
                                <?php echo e($certificado->estado_label); ?>

                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('certificados.show', $certificado)); ?>" class="btn btn-info" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('certificados.edit', $certificado)); ?>" class="btn btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo e(route('certificados.imprimir', $certificado)); ?>" class="btn btn-success" title="PDF" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <form action="<?php echo e(route('certificados.destroy', $certificado)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <a href="<?php echo e(route('certificados.enviar', $certificado->id)); ?>" class="btn btn-sm btn-info text-white" title="Enviar por Correo" onclick="return confirm('¿Enviar certificado al paciente?')">
                            <i class="fas fa-envelope"></i>
                            </a>
                            <?php if($certificado->enviado): ?>
                            <span class="badge bg-success">Enviado</span>
                            <?php endif; ?>
                        </td>    

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-certificate fa-3x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">No hay certificados médicos registrados</h5>
                            <p class="text-muted">Los certificados se generan desde el historial clínico del paciente.</p>
                            <a href="<?php echo e(route('historiales.index')); ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-notes-medical me-1"></i> Ir a Historiales
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- ===== PAGINACIÓN ===== -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <span class="text-muted">
                    Mostrando <?php echo e($certificados->firstItem() ?? 0); ?> - <?php echo e($certificados->lastItem() ?? 0); ?> 
                    de <?php echo e($certificados->total()); ?> resultados
                </span>
            </div>
            <div>
                <?php echo e($certificados->appends(request()->query())->links()); ?>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/certificados/index.blade.php ENDPATH**/ ?>