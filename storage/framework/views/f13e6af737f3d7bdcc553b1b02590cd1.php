

<?php $__env->startSection('title', 'Registrar Paciente'); ?>
<?php $__env->startSection('page-title', 'Registro de Paciente'); ?>
<?php $__env->startSection('breadcrumb', 'Nuevo Paciente'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Datos del Paciente</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('pacientes.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="row">
                <!-- COLUMNA IZQUIERDA - INFORMACIÓN PERSONAL -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="fas fa-user me-2 text-primary"></i>Información Personal</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required>
                                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="apellido" name="apellido" value="<?php echo e(old('apellido')); ?>" required>
                                <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control <?php $__errorArgs = ['fecha_nacimiento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo e(old('fecha_nacimiento')); ?>" required>
                                    <?php $__errorArgs = ['fecha_nacimiento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edad" class="form-label">Edad (años)</label>
                                    <input type="text" class="form-control" id="edad" readonly style="background-color: #e9ecef;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="genero" class="form-label">Género <span class="text-danger">*</span></label>
                                    <select class="form-select <?php $__errorArgs = ['genero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="genero" name="genero" required>
                                        <option value="">Seleccione...</option>
                                        <option value="M" <?php echo e(old('genero') == 'M' ? 'selected' : ''); ?>>Masculino</option>
                                        <option value="F" <?php echo e(old('genero') == 'F' ? 'selected' : ''); ?>>Femenino</option>
                                        <option value="Otro" <?php echo e(old('genero') == 'Otro' ? 'selected' : ''); ?>>Otro</option>
                                    </select>
                                    <?php $__errorArgs = ['genero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                                    <select class="form-select <?php $__errorArgs = ['tipo_sangre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="tipo_sangre" name="tipo_sangre">
                                        <option value="">Seleccione...</option>
                                        <?php $__currentLoopData = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tipo); ?>" <?php echo e(old('tipo_sangre') == $tipo ? 'selected' : ''); ?>><?php echo e($tipo); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['tipo_sangre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="telefono" name="telefono" value="<?php echo e(old('telefono')); ?>" required>
                                    <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cedula" class="form-label">Cédula</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['cedula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="cedula" name="cedula" value="<?php echo e(old('cedula')); ?>" 
                                           placeholder="1234567890" maxlength="10" 
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <?php $__errorArgs = ['cedula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ocupacion" class="form-label">Ocupación</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['ocupacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="ocupacion" name="ocupacion" value="<?php echo e(old('ocupacion')); ?>" 
                                           placeholder="Ej: Médico, Ingeniero...">
                                    <?php $__errorArgs = ['ocupacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COLUMNA DERECHA - UBICACIÓN Y OBSERVACIONES -->
                <div class="col-md-6">
                    <!-- Tarjeta de Ubicación -->
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Ubicación</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pais" class="form-label">País</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['pais'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="pais" name="pais" value="<?php echo e(old('pais')); ?>" placeholder="Ecuador">
                                    <?php $__errorArgs = ['pais'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="provincia" class="form-label">Provincia</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['provincia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="provincia" name="provincia" value="<?php echo e(old('provincia')); ?>" placeholder="Pichincha">
                                    <?php $__errorArgs = ['provincia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="ciudad" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['ciudad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           id="ciudad" name="ciudad" value="<?php echo e(old('ciudad')); ?>" placeholder="Quito">
                                    <?php $__errorArgs = ['ciudad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="direccion" class="form-label">Dirección específica</label>
                                    <textarea class="form-control <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                              id="direccion" name="direccion" rows="2" 
                                              placeholder="Calle, número, edificio..."><?php echo e(old('direccion')); ?></textarea>
                                    <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de Información Médica -->
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="fas fa-notes-medical me-2 text-primary"></i>Información Médica</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="alergias" class="form-label">
                                    <i class="fas fa-allergies me-1 text-danger"></i> Alergias
                                </label>
                                <textarea class="form-control <?php $__errorArgs = ['alergias'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          id="alergias" name="alergias" rows="3" 
                                          placeholder="Ej: Penicilina, Ibuprofeno, látex, polen, etc..."><?php echo e(old('alergias')); ?></textarea>
                                <?php $__errorArgs = ['alergias'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label for="observaciones" class="form-label">Observaciones</label>
                                <textarea class="form-control <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          id="observaciones" name="observaciones" rows="3" 
                                          placeholder="Información adicional relevante..."><?php echo e(old('observaciones')); ?></textarea>
                                <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Tarjeta de Facturación - CON AUTOCOMPLETADO -->
            <div class="card mt-3 facturacion-field" id="facturacion-card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><i class="fas fa-file-invoice-dollar me-2 text-primary"></i>Datos de Facturación</h6>
                    <div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="btnCopiarDatos">
                            <i class="fas fa-copy me-1"></i> Copiar datos del paciente
                        </button>
                        <span class="badge bg-info ms-2">Autocompletado automático</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ruc" class="form-label">RUC</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['ruc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="ruc" name="ruc" value="<?php echo e(old('ruc')); ?>" 
                                placeholder="13 dígitos" maxlength="13" 
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            <small class="text-muted">Número de RUC (13 dígitos)</small>
                            <?php $__errorArgs = ['ruc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="razon_social" class="form-label">Razón Social / Nombres</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['razon_social'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="razon_social" name="razon_social" value="<?php echo e(old('razon_social')); ?>">
                            <?php $__errorArgs = ['razon_social'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="direccion_fiscal" class="form-label">Dirección Fiscal</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['direccion_fiscal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="direccion_fiscal" name="direccion_fiscal" value="<?php echo e(old('direccion_fiscal')); ?>">
                            <?php $__errorArgs = ['direccion_fiscal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono_facturacion" class="form-label">Teléfono Facturación</label>
                            <input type="tel" class="form-control <?php $__errorArgs = ['telefono_facturacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="telefono_facturacion" name="telefono_facturacion" value="<?php echo e(old('telefono_facturacion')); ?>">
                            <?php $__errorArgs = ['telefono_facturacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email_facturacion" class="form-label">Email Facturación</label>
                            <input type="email" class="form-control <?php $__errorArgs = ['email_facturacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="email_facturacion" name="email_facturacion" value="<?php echo e(old('email_facturacion')); ?>">
                            <?php $__errorArgs = ['email_facturacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="obligado_contabilidad" id="obligado_contabilidad" value="1" <?php echo e(old('obligado_contabilidad') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="obligado_contabilidad">
                                    Obligado a llevar contabilidad
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contribuyente_especial" id="contribuyente_especial" value="1" <?php echo e(old('contribuyente_especial') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="contribuyente_especial">
                                    Contribuyente Especial
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="agente_retencion" id="agente_retencion" value="1" <?php echo e(old('agente_retencion') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="agente_retencion">
                                    Agente de Retención
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INDICADOR DE AUTOCOMPLETADO -->
            <div id="autocompleteIndicator" class="alert alert-info mt-3" style="display: none;">
                <i class="fas fa-sync fa-spin me-2"></i>
                <span id="autocompleteMessage">Copiando datos del paciente...</span>
            </div>

            <div class="row mt-4">
                <div class="col-12 text-end">
                    <a href="<?php echo e(route('pacientes.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Paciente
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Script de autocompletado cargado');

    // ========== CALCULAR EDAD ==========
    function calcularEdad(fechaNacimiento) {
        if (!fechaNacimiento) return '';
        
        let fecha = new Date(fechaNacimiento);
        let hoy = new Date();
        
        if (isNaN(fecha.getTime())) return '';
        
        let edad = hoy.getFullYear() - fecha.getFullYear();
        let mes = hoy.getMonth() - fecha.getMonth();
        
        if (mes < 0 || (mes === 0 && hoy.getDate() < fecha.getDate())) {
            edad--;
        }
        
        return edad >= 0 ? edad : '';
    }

    // ========== VARIABLES PARA DEBOUNCE ==========
    let timeoutId = null;
    const DEBOUNCE_DELAY = 300;

    // ========== FUNCIÓN PRINCIPAL DE AUTOCOMPLETADO ==========
    function autocompletarFacturacion() {
        console.log('🔄 Ejecutando autocompletado...');
        
        // Obtener valores
        const nombre = document.getElementById('nombre')?.value?.trim() || '';
        const apellido = document.getElementById('apellido')?.value?.trim() || '';
        const telefono = document.getElementById('telefono')?.value?.trim() || '';
        const email = document.getElementById('email')?.value?.trim() || '';
        const cedula = document.getElementById('cedula')?.value?.trim() || '';
        const direccion = document.getElementById('direccion')?.value?.trim() || '';
        const ciudad = document.getElementById('ciudad')?.value?.trim() || '';
        const provincia = document.getElementById('provincia')?.value?.trim() || '';
        const pais = document.getElementById('pais')?.value?.trim() || '';

        console.log('📝 Datos capturados:', { 
            nombre, apellido, telefono, email, cedula, 
            direccion, ciudad, provincia, pais 
        });

        let datosActualizados = false;

        // ===== 1. RUC - Copiar cédula =====
        const rucInput = document.getElementById('ruc');
        if (cedula && rucInput) {
            if (rucInput.value.length === 0 || cedula.length > rucInput.value.length) {
                rucInput.value = cedula;
                datosActualizados = true;
                console.log('✅ RUC actualizado:', cedula);
            }
        }

        // ===== 2. RAZÓN SOCIAL - NOMBRE COMPLETO (SIEMPRE ACTUALIZA) =====
        const razonSocialInput = document.getElementById('razon_social');
        if ((nombre || apellido) && razonSocialInput) {
            const nombreCompleto = [nombre, apellido].filter(Boolean).join(' ');
            
            // ACTUALIZAR SIEMPRE que el nombre completo sea más largo
            if (nombreCompleto.length > razonSocialInput.value.length || 
                razonSocialInput.value.length === 0) {
                razonSocialInput.value = nombreCompleto;
                datosActualizados = true;
                console.log('✅ Razón Social actualizada:', nombreCompleto);
            }
        }

        // ===== 3. DIRECCIÓN FISCAL =====
        const direccionFiscalInput = document.getElementById('direccion_fiscal');
        if (direccionFiscalInput) {
            let direccionCompleta = '';
            
            if (direccion) direccionCompleta += direccion;
            if (ciudad) {
                if (direccionCompleta) direccionCompleta += ', ';
                direccionCompleta += ciudad;
            }
            if (provincia) {
                if (direccionCompleta) direccionCompleta += ', ';
                direccionCompleta += provincia;
            }
            if (pais) {
                if (direccionCompleta) direccionCompleta += ', ';
                direccionCompleta += pais;
            }

            console.log('📍 Dirección completa:', direccionCompleta);

            if (direccionCompleta.length > 5) {
                if (direccionFiscalInput.value.length === 0 || 
                    direccionCompleta.length > direccionFiscalInput.value.length) {
                    direccionFiscalInput.value = direccionCompleta;
                    datosActualizados = true;
                    console.log('✅ Dirección Fiscal actualizada:', direccionCompleta);
                }
            }
        }

        // ===== 4. TELÉFONO FACTURACIÓN =====
        const telefonoFacturacionInput = document.getElementById('telefono_facturacion');
        if (telefono && telefonoFacturacionInput) {
            if (telefonoFacturacionInput.value.length === 0 || 
                telefono.length > telefonoFacturacionInput.value.length) {
                telefonoFacturacionInput.value = telefono;
                datosActualizados = true;
                console.log('✅ Teléfono Facturación actualizado:', telefono);
            }
        }

        // ===== 5. EMAIL FACTURACIÓN =====
        const emailFacturacionInput = document.getElementById('email_facturacion');
        if (email && emailFacturacionInput) {
            // Validar que el email tenga @ y .
            if (email.includes('@') && email.includes('.')) {
                if (emailFacturacionInput.value.length === 0 || 
                    email.length > emailFacturacionInput.value.length) {
                    emailFacturacionInput.value = email;
                    datosActualizados = true;
                    console.log('✅ Email Facturación actualizado:', email);
                }
            }
        }

        // Mostrar indicador si se actualizaron datos
        if (datosActualizados) {
            mostrarIndicador('✅ Datos de facturación actualizados');
        }

        return datosActualizados;
    }

    // ========== MOSTRAR INDICADOR ==========
    function mostrarIndicador(mensaje) {
        const indicator = document.getElementById('autocompleteIndicator');
        const message = document.getElementById('autocompleteMessage');
        if (indicator && message) {
            indicator.style.display = 'block';
            message.textContent = mensaje;
            clearTimeout(indicator._timeout);
            indicator._timeout = setTimeout(() => {
                indicator.style.display = 'none';
            }, 2500);
        }
    }

    // ========== FUNCIÓN CON DEBOUNCE ==========
    function autocompletarConDebounce() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            autocompletarFacturacion();
        }, DEBOUNCE_DELAY);
    }

    // ========== COPIAR MANUAL (FORZADO) ==========
    function copiarDatosManual() {
        console.log('🔄 Copiando datos manualmente...');
        
        // Limpiar campos de facturación
        const camposFacturacion = ['ruc', 'razon_social', 'direccion_fiscal', 'telefono_facturacion', 'email_facturacion'];
        camposFacturacion.forEach(function(id) {
            const campo = document.getElementById(id);
            if (campo) {
                campo.value = '';
            }
        });
        
        // Ejecutar autocompletado
        const actualizado = autocompletarFacturacion();
        if (actualizado) {
            mostrarIndicador('✅ Datos copiados manualmente');
        } else {
            mostrarIndicador('ℹ️ Complete más datos del paciente');
        }
    }

    // ========== CONFIGURAR EVENTOS ==========
    function configurarEventos() {
        const campos = [
            'nombre', 'apellido', 'telefono', 'email', 'cedula',
            'direccion', 'ciudad', 'provincia', 'pais'
        ];

        campos.forEach(function(id) {
            const campo = document.getElementById(id);
            if (campo) {
                campo.addEventListener('input', function() {
                    console.log(`⌨️ Campo "${id}" modificado:`, this.value);
                    autocompletarConDebounce();
                });
                campo.addEventListener('blur', function() {
                    autocompletarFacturacion();
                });
            }
        });

        console.log('✅ Eventos configurados para', campos.length, 'campos');
    }

    // ========== INICIALIZAR ==========
    
    // 1. Calcular edad
    const fechaInput = document.getElementById('fecha_nacimiento');
    const edadInput = document.getElementById('edad');
    
    if (fechaInput && edadInput) {
        if (fechaInput.value) {
            edadInput.value = calcularEdad(fechaInput.value);
        }
        fechaInput.addEventListener('change', function() {
            edadInput.value = calcularEdad(this.value);
        });
        fechaInput.addEventListener('input', function() {
            edadInput.value = calcularEdad(this.value);
        });
    }

    // 2. Configurar eventos
    configurarEventos();

    // 3. Botón copiar manual
    const btnCopiar = document.getElementById('btnCopiarDatos');
    if (btnCopiar) {
        btnCopiar.addEventListener('click', copiarDatosManual);
    }

    // 4. Autocompletar al cargar
    setTimeout(function() {
        autocompletarFacturacion();
    }, 500);

    console.log('✅ Script de autocompletado inicializado');
});
// ============================================
// OCULTAR FACTURACIÓN PARA MENORES DE EDAD
// ============================================
function verificarEdadParaFacturacion() {
    const fechaNacimiento = document.getElementById("fecha_nacimiento")?.value;
    const facturacionCard = document.getElementById("facturacion-card");
    
    if (!fechaNacimiento || !facturacionCard) return;
    
    const hoy = new Date();
    const nacimiento = new Date(fechaNacimiento);
    let edad = hoy.getFullYear() - nacimiento.getFullYear();
    const mes = hoy.getMonth() - nacimiento.getMonth();
    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
        edad--;
    }
    
    if (edad < 18) {
        facturacionCard.style.display = "none";
        
        const campos = ["ruc", "razon_social", "direccion_fiscal", "telefono_facturacion", "email_facturacion"];
        campos.forEach(id => {
            const campo = document.getElementById(id);
            if (campo) {
                campo.disabled = true;
                campo.value = "";
                campo.required = false;
            }
        });
        
        ["obligado_contabilidad", "contribuyente_especial", "agente_retencion"].forEach(id => {
            const checkbox = document.getElementById(id);
            if (checkbox) {
                checkbox.checked = false;
                checkbox.disabled = true;
            }
        });
        
        console.log("👶 Paciente menor de edad - Facturación oculta");
    } else {
        facturacionCard.style.display = "";
        
        const campos = ["ruc", "razon_social", "direccion_fiscal", "telefono_facturacion", "email_facturacion"];
        campos.forEach(id => {
            const campo = document.getElementById(id);
            if (campo) {
                campo.disabled = false;
            }
        });
        
        ["obligado_contabilidad", "contribuyente_especial", "agente_retencion"].forEach(id => {
            const checkbox = document.getElementById(id);
            if (checkbox) {
                checkbox.disabled = false;
            }
        });
        
        console.log("👨 Adulto - Facturación visible");
    }
}

// Ejecutar al cargar y al cambiar fecha de nacimiento
document.addEventListener("DOMContentLoaded", function() {
    const fechaInput = document.getElementById("fecha_nacimiento");
    if (fechaInput) {
        fechaInput.addEventListener("change", verificarEdadParaFacturacion);
        fechaInput.addEventListener("input", verificarEdadParaFacturacion);
        if (fechaInput.value) {
            verificarEdadParaFacturacion();
        }
    }
});
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pacientes/create.blade.php ENDPATH**/ ?>