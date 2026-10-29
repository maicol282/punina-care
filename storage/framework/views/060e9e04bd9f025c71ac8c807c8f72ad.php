<?php $__env->startSection('title', 'Punina Care - Telemedicina'); ?>
<?php $__env->startSection('page-title', 'Punina Care - Telemedicina'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-video me-2 text-primary"></i>
            Consultas de Telemedicina
            <span class="badge bg-primary ms-2"><?php echo e($consultas->total()); ?></span>
        </h5>
        <a href="<?php echo e(route('telemedicina.create')); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Nueva Consulta
        </a>
    </div>
    <div class="card-body">
        <!-- Filtros -->
        <div class="row mb-3">
            <div class="col-md-12">
                <form method="GET" action="<?php echo e(route('telemedicina.index')); ?>" class="row g-2">
                    <div class="col-md-4">
                        <select name="estado" class="form-select form-select-sm">
                            <option value="">Todos los estados</option>
                            <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($estado); ?>" <?php echo e(request('estado') == $estado ? 'selected' : ''); ?>>
                                    <?php echo e(ucfirst($estado)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="paciente_id" class="form-select form-select-sm">
                            <option value="">Todos los pacientes</option>
                            <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($paciente->id); ?>" <?php echo e(request('paciente_id') == $paciente->id ? 'selected' : ''); ?>>
                                    <?php echo e($paciente->nombre); ?> <?php echo e($paciente->apellido); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <?php $__empty_1 = true; $__currentLoopData = $consultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consulta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($consulta->paciente->nombre); ?> <?php echo e($consulta->paciente->apellido); ?></strong>
                                <br>
                                <small class="text-muted">Cédula: <?php echo e($consulta->paciente->cedula ?? 'N/E'); ?></small>
                            </td>
                            <td><?php echo e($consulta->medico->name); ?></td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    <?php echo e($consulta->fecha_hora_programada->format('d/m/Y')); ?>

                                </span>
                                <br>
                                <small class="text-muted"><?php echo e($consulta->fecha_hora_programada->format('H:i')); ?></small>
                            </td>
                            <td><?php echo e($consulta->duracion); ?> min</td>
                            <td>
                                <span class="badge bg-<?php echo e($consulta->estado_color); ?>">
                                    <?php echo e($consulta->estado_label); ?>

                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?php echo e(route('telemedicina.show', $consulta)); ?>" class="btn btn-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <?php if($consulta->estado == 'programada'): ?>
                                        <a href="<?php echo e(route('telemedicina.edit', $consulta)); ?>" class="btn btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('telemedicina.cancelar', $consulta)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('POST'); ?>
                                            <button type="submit" class="btn btn-danger" title="Cancelar" onclick="return confirm('¿Cancelar esta consulta?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if($consulta->estado == 'programada' || $consulta->estado == 'en_curso'): ?>
                                        <a href="jitsi-meet://<?php echo e($consulta->sala_nombre); ?>" target="_blank" class="btn btn-success" title="Iniciar videollamada">
                                            <i class="fas fa-video"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-video-slash fa-3x text-muted mb-3 d-block"></i>
                                <h5 class="text-muted">No hay consultas de telemedicina</h5>
                                <a href="<?php echo e(route('telemedicina.create')); ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i> Crear primera consulta
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-end mt-3">
            <?php echo e($consultas->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/telemedicina/index.blade.php ENDPATH**/ ?>