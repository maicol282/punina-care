<?php $__env->startSection('title', 'Pedidos de Exámenes'); ?>
<?php $__env->startSection('page-title', 'Pedidos de Exámenes'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-flask me-2 text-primary"></i>
            <?php if(isset($paciente)): ?>
                Pedidos de Exámenes - <?php echo e($paciente->nombre_completo); ?>

            <?php else: ?>
                Todos los Pedidos de Exámenes
            <?php endif; ?>
        </h5>
        <?php if(isset($paciente)): ?>
        <a href="<?php echo e(route('pacientes.show', $paciente->id)); ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Volver al Paciente
        </a>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <?php if($pedidos->isEmpty()): ?>
            <div class="text-center py-4">
                <i class="fas fa-flask fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No hay pedidos de exámenes registrados</h5>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <?php if(!isset($paciente)): ?>
                                <th>Paciente</th>
                            <?php endif; ?>
                            <th>Fecha</th>
                            <th>Médico</th>
                            <th>Exámenes</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($pedido->id); ?></td>
                            <?php if(!isset($paciente)): ?>
                                <td><?php echo e($pedido->paciente->nombre_completo); ?></td>
                            <?php endif; ?>
                            <td><?php echo e($pedido->fecha_pedido->format('d/m/Y')); ?></td>
                            <td><?php echo e($pedido->medico->name); ?></td>
                            <td>
                                <span class="badge bg-info"><?php echo e($pedido->detalles->count()); ?> exámenes</span>
                            </td>
                            <td>
                                <?php if($pedido->estado == 'pendiente'): ?>
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                <?php elseif($pedido->estado == 'completado'): ?>
                                    <span class="badge bg-success">Completado</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Cancelado</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('pedidos-examenes.enviar', $pedido)); ?>" 
   class="btn btn-sm btn-info text-white" 
   title="Enviar por Correo"
   onclick="event.preventDefault(); var url = this.href; document.getElementById('modalEnviandoCorreo').classList.add('show'); document.getElementById('modalEnviandoCorreo').style.display='block'; var progressBar = document.getElementById('progressBarCorreo'); var width = 0; var interval = setInterval(function() { if (width >= 100) { clearInterval(interval); window.location.href = url; } else { width += 10; progressBar.style.width = width + '%'; progressBar.innerHTML = width + '%'; } }, 150);">
    <i class="fas fa-envelope"></i>
</a>
                                <?php if($pedido->enviado): ?>
                                 <span class="badge bg-success">Enviado</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('pedidos-examenes.pdf', $pedido)); ?>" class="btn btn-sm btn-danger" target="_blank" title="Ver PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <?php if(!isset($paciente)): ?>
                <div class="mt-3">
                    <?php echo e($pedidos->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pedidos-examenes/index.blade.php ENDPATH**/ ?>