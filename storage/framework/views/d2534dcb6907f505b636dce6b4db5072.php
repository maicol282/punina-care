<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Sistema de Historial Clínico'); ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <!-- Estilos personalizados -->
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
    
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/jitsi-pip.js')); ?>"></script>
<?php $__env->stopPush(); ?>
</head>
<body>

<button class="btn" id="sidebarToggle" title="Abrir/Cerrar menú">
    <i class="fas fa-bars"></i>
</button>


    <?php if(auth()->guard()->check()): ?>
<!-- ===== BOTÓN HAMBURGUESA ===== -->
<!-- ===== SIDEBAR ===== -->
<div class="sidebar" id="sidebar">
    <!-- Botón colapsar -->
    <div class="sidebar-toggle-wrapper">
      <button class="sidebar-collapse-btn" id="sidebarCollapse" title="Colapsar menú">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Logo -->
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fas fa-notes-medical"></i>
        </div>
        <span class="brand-text">Clínica Médica</span>
        
    </div>
    
    
    <!-- Menú -->
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                    <i class="fas fa-chart-pie"></i>
                    <span>Estadísticas</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('pacientes.*') ? 'active' : ''); ?>" href="<?php echo e(route('pacientes.index')); ?>">
                    <i class="fas fa-users"></i>
                    <span>Pacientes</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('pacientes.create') ? 'active' : ''); ?>" href="<?php echo e(route('pacientes.create')); ?>">
                    <i class="fas fa-user-plus"></i>
                    <span>Nuevo Paciente</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('historiales.index') ? 'active' : ''); ?>" href="<?php echo e(route('historiales.index')); ?>">
                    <i class="fas fa-notes-medical"></i>
                    <span>Historiales</span>
                </a>
            </li>
            

            <!-- ===== SEPARADOR ===== -->
            <li class="nav-divider"></li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('recetas.*') ? 'active' : ''); ?>" href="<?php echo e(route('recetas.todas')); ?>">
                    <i class="fas fa-prescription-bottle"></i>
                    <span>Recetas Médicas</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('citas.*') ? 'active' : ''); ?>" href="<?php echo e(route('citas.index')); ?>">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Calendario de Citas</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('ia.*') ? 'active' : ''); ?>" href="<?php echo e(route('ia.index')); ?>">
                    <i class="fas fa-brain me-2"></i>
                    <span>IA</span>
                    <span class="badge bg-success text-white ms-1" style="font-size: 8px;">Pro</span>
                </a>
            </li>

            <!-- ===== SEPARADOR ===== -->
            <li class="nav-divider"></li>
            
           <!-- <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('reposos.*') ? 'active' : ''); ?>" href="<?php echo e(route('reposos.index')); ?>">
                    <i class="fas fa-bed"></i>
                    <span>Reposos</span>
                </a>
            </li> -->

               <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('pedidos-examenes.*') ? 'active' : ''); ?>" href="<?php echo e(route('pedidos-examenes.index')); ?>">
                <i class="fas fa-flask"></i>
                <span>Pedidos de Exámenes</span>
                 </a>
                </li>  

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('certificados.*') ? 'active' : ''); ?>" 
                href="<?php echo e(route('certificados.index')); ?>">
                    <i class="fas fa-certificate me-2"></i>
                    <span>Certificados</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('telemedicina.*') ? 'active' : ''); ?>" href="<?php echo e(route('telemedicina.index')); ?>">
                    <i class="fas fa-video"></i>
                    <span>Punina Care</span>
                </a>
            </li>

            <!-- ===== SEPARADOR ===== -->
            <li class="nav-divider"></li>
            
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('profile.edit') ? 'active' : ''); ?>" href="<?php echo e(route('profile.edit')); ?>">
                    <i class="fas fa-user-cog"></i>
                    <span>Firma de documentos</span>
                </a>
            </li>
            
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrador')): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('usuarios.*') ? 'active' : ''); ?>" href="<?php echo e(route('usuarios.index')); ?>">
                    <i class="fas fa-user-md"></i>
                    <span>Médicos</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Usuario -->
    <div class="sidebar-footer">
        <div class="user-info">
            <i class="fas fa-user-circle"></i>
            <span><?php echo e(Auth::user()->name); ?></span>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="logout-btn" title="Cerrar sesión">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
        <?php if(auth()->guard()->check()): ?>
    <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm fw-medium d-flex align-items-center gap-1">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </button>
    </form>
<?php endif; ?>
    </div>
</div>

<!-- Overlay -->
<?php endif; ?>

    <!-- Main Content -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="main-content">
        <?php if(auth()->guard()->check()): ?>
        <div class="navbar-top d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <!-- ===== BOTÓN HAMBURGUESA (SOLO VISIBLE EN MÓVIL) ===== -->
        <div>
            <h4 class="mb-0 text-primary"><?php echo $__env->yieldContent('page-title'); ?></h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active"><?php echo $__env->yieldContent('breadcrumb', 'Panel Principal'); ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
        <?php echo $__env->make('components.buscador-global', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
       
        <span class="badge bg-primary"><?php echo e(Auth::user()->getRoleNames()->first()); ?></span>
     <button class="btn btn-outline-primary btn-sm" id="btnAyuda" title="Ayuda del sistema">
        <i class="fas fa-question-circle"></i>
    </button>
    </div>
    
</div> 
<!-- Overlay para cerrar el menú en móvil -->
<?php endif; ?>

        <!-- Alertas -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-times-circle me-2"></i>
                <strong>Por favor corrige los siguientes errores:</strong>
                <ul class="mb-0 mt-2">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <!-- Contenido principal -->
        <?php echo $__env->yieldContent('content'); ?>
        
        <!-- Footer -->
        <footer class="text-center mt-4 py-3">
            <p class="mb-0 text-muted small">
                &copy; <?php echo e(date('Y')); ?> Sistema de Historial Clínico. Todos los derechos reservados.
            </p>
        </footer>
    </div>
    <div class="modal fade" id="ayudaModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle me-2"></i>
                        Ayuda del Sistema - Punina Care
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="accordionAyuda">
                        
                        <!-- PACIENTES -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ayudaPacientes">
                                    <i class="fas fa-users me-2 text-primary"></i> Pacientes
                                </button>
                            </h2>
                            <div id="ayudaPacientes" class="accordion-collapse collapse show" data-bs-parent="#accordionAyuda">
                                <div class="accordion-body">
                                    <p><strong>¿Qué puedes hacer aquí?</strong></p>
                                    <ul>
                                        <li><strong>Registrar</strong> nuevos pacientes con sus datos personales y médicos.</li>
                                        <li><strong>Buscar</strong> pacientes por nombre, apellido o cédula.</li>
                                        <li><strong>Ver</strong> el perfil completo con su historial clínico.</li>
                                        <li><strong>Editar</strong> o <strong>eliminar</strong> pacientes.</li>
                                    </ul>
                                    <p class="text-muted small">Los datos sensibles como cédula y teléfono están encriptados por seguridad.</p>
                                </div>
                            </div>
                        </div>

                        <!-- HISTORIALES -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ayudaHistoriales">
                                    <i class="fas fa-notes-medical me-2 text-success"></i> Historiales Clínicos
                                </button>
                            </h2>
                            <div id="ayudaHistoriales" class="accordion-collapse collapse" data-bs-parent="#accordionAyuda">
                                <div class="accordion-body">
                                    <p><strong>¿Qué puedes hacer aquí?</strong></p>
                                    <ul>
                                        <li><strong>Crear</strong> historiales clínicos desde el perfil del paciente.</li>
                                        <li><strong>Registrar</strong> signos vitales, antecedentes y exploración física.</li>
                                        <li><strong>Añadir</strong> diagnósticos con código CIE-10.</li>
                                        <li><strong>Adjuntar</strong> estudios complementarios (imágenes, PDFs).</li>
                                        <li><strong>Generar</strong> reposos y certificados médicos desde el historial.</li>
                                    </ul>
                                    <p class="text-muted small">Los diagnósticos pueden ser PRE (Presuntivo) o DEF (Definitivo).</p>
                                </div>
                            </div>
                        </div>

                        <!-- RECETAS -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ayudaRecetas">
                                    <i class="fas fa-prescription me-2 text-warning"></i> Recetas Médicas
                                </button>
                            </h2>
                            <div id="ayudaRecetas" class="accordion-collapse collapse" data-bs-parent="#accordionAyuda">
                                <div class="accordion-body">
                                    <p><strong>¿Qué puedes hacer aquí?</strong></p>
                                    <ul>
                                        <li><strong>Generar</strong> recetas automáticamente desde el tratamiento.</li>
                                        <li><strong>Agregar</strong> múltiples medicamentos en una sola receta.</li>
                                        <li><strong>Especificar</strong> dosis, frecuencia y duración.</li>
                                        <li><strong>Incluir</strong> signos de alarma y recomendaciones no farmacológicas.</li>
                                        <li><strong>Imprimir</strong> recetas en formato PDF.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- CITAS -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ayudaCitas">
                                    <i class="fas fa-calendar-alt me-2 text-info"></i> Calendario de Citas
                                </button>
                            </h2>
                            <div id="ayudaCitas" class="accordion-collapse collapse" data-bs-parent="#accordionAyuda">
                                <div class="accordion-body">
                                    <p><strong>¿Qué puedes hacer aquí?</strong></p>
                                    <ul>
                                        <li><strong>Ver</strong> las citas programadas en vista mensual, semanal o diaria.</li>
                                        <li><strong>Crear</strong> nuevas citas seleccionando fecha y hora.</li>
                                        <li><strong>Editar</strong> o <strong>cancelar</strong> citas existentes.</li>
                                        <li><strong>Filtrar</strong> citas por médico o estado.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- PUNINA CARE -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ayudaPunina">
                                    <i class="fas fa-video me-2 text-danger"></i> Punina Care (Telemedicina)
                                </button>
                            </h2>
                            <div id="ayudaPunina" class="accordion-collapse collapse" data-bs-parent="#accordionAyuda">
                                <div class="accordion-body">
                                    <p><strong>¿Qué puedes hacer aquí?</strong></p>
                                    <ul>
                                        <li><strong>Agendar</strong> consultas virtuales con pacientes.</li>
                                        <li><strong>Generar</strong> enlaces de videollamada automáticos (Jitsi Meet).</li>
                                        <li><strong>Iniciar</strong> videollamadas con un solo clic.</li>
                                        <li><strong>Registrar</strong> el inicio y fin de cada consulta.</li>
                                        <li><strong>Copiar</strong> el enlace de la reunión para compartir.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- IA -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ayudaIA">
                                    <i class="fas fa-robot me-2 text-dark"></i> Asistente IA (Itaca)
                                </button>
                            </h2>
                            <div id="ayudaIA" class="accordion-collapse collapse" data-bs-parent="#accordionAyuda">
                                <div class="accordion-body">
                                    <p><strong>¿Qué puedes hacer aquí?</strong></p>
                                    <ul>
                                        <li><strong>Generar</strong> notas clínicas automáticas.</li>
                                        <li><strong>Obtener</strong> respuestas con evidencia científica (PubMed).</li>
                                        <li><strong>Crear</strong> recetas y órdenes diagnósticas inteligentes.</li>
                                        <li><strong>Ahorrar</strong> hasta 10 horas semanales en carga administrativa.</li>
                                    </ul>
                                    <p class="text-muted small">Herramienta de apoyo, no reemplaza el criterio médico profesional.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- SCRIPTS - ORDEN CORRECTO (FUNDAMENTAL)       -->
    <!-- ============================================ -->
    
    <!-- 1. PRIMERO: jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- 2. SEGUNDO: jQuery UI (depende de jQuery) -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <!-- 3. TERCERO: Bootstrap JS (depende de jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- 4. SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- 5. Select2 JS (depende de jQuery) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <!-- 6. Scripts personalizados -->
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/autocompletado-gmail.js')); ?>"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
    
    <!-- Scripts globales -->
    <script>
        // Confirmación de eliminación con SweetAlert2
        function confirmDelete(event, formId) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede revertir",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3498db',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
        
        function showToast(message, type = 'success') {
            Swal.fire({
                title: type === 'success' ? 'Éxito' : type === 'error' ? 'Error' : 'Información',
                text: message,
                icon: type,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }
        
        // Inicializar tooltips de Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
        //-----------------------------------------
        




    
    // ============================================================
    // RESTAURAR ESTADO EN DESKTOP
    // ============================================================
    if (getScreenType() === 'desktop') {
    }
    
    // ============================================================
    // CERRAR CON ESC
    // ============================================================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
    
    // ============================================================
    // MANEJAR CAMBIO DE TAMAÑO DE VENTANA
    // ============================================================
    let lastScreenType = getScreenType();
    let resizeTimer;
    
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const currentScreenType = getScreenType();
            
            if (currentScreenType !== lastScreenType) {
                if (currentScreenType === 'desktop') {
                    // Restaurar modo desktop
                    sidebar.classList.remove('open');
                    if (overlay) overlay.classList.remove('active');
                    document.body.style.overflow = '';
                } else {
                        sidebar.classList.remove('collapsed');
                        if (mainContent) mainContent.classList.remove('expanded');
                    }
                } else {
                    // Modo tablet/móvil
                    sidebar.classList.remove('collapsed');
                    if (mainContent) mainContent.classList.remove('expanded');
                    sidebar.classList.remove('open');
                    if (overlay) overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
                
                lastScreenType = currentScreenType;
                console.log('📱 Cambio de pantalla:', currentScreenType);
            }
        }, 150);
    });
    
    // ============================================================
    // BOTÓN AYUDA (mantener funcionalidad existente)
    // ============================================================
    const btnAyuda = document.getElementById('btnAyuda');
    if (btnAyuda) {
        btnAyuda.addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('ayudaModal'));
            modal.show();
        });
    }
    
    console.log('✅ Sistema de menú responsive inicializado. Pantalla:', getScreenType());

</script>
<script>
// ============================================================
// SISTEMA DE MENÚ RESPONSIVE UNIFICADO
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');
    const toggleBtn = document.getElementById('sidebarToggle');
    const collapseBtn = document.getElementById('sidebarCollapse');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (!sidebar) {
        console.warn('⚠️ Sidebar no encontrado');
        return;
    }
    
    // ============================================================
    // DETECTAR TIPO DE PANTALLA
    // ============================================================
    function getScreenType() {
        const width = window.innerWidth;
        if (width >= 992) return 'desktop';
        if (width >= 768) return 'tablet';
        return 'mobile';
    }
    
    // ============================================================
    // ABRIR/CERRAR SIDEBAR EN MÓVIL Y TABLET
    // ============================================================
    function toggleMobileSidebar() {
        sidebar.classList.toggle('open');
        if (overlay) overlay.classList.toggle('active');
        document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
    }
    
    // ============================================================
    // COLAPSAR SIDEBAR EN DESKTOP
    // ============================================================
    function toggleDesktopSidebar() {
        sidebar.classList.toggle('collapsed');
        if (mainContent) mainContent.classList.toggle('expanded');
        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
    }
    
    // ============================================================
    // BOTÓN HAMBURGUESA (MÓVIL/TABLET/DESKTOP)
    // ============================================================
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const screenType = getScreenType();
            
            if (screenType === 'desktop') {
                toggleDesktopSidebar();
            } else {
                toggleMobileSidebar();
            }
        });
    }
    
    // ============================================================
    // BOTÓN COLAPSAR (DENTRO DEL SIDEBAR)
    // ============================================================
    if (collapseBtn) {
        collapseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            toggleDesktopSidebar();
        });
    }
    
    // ============================================================
    // OVERLAY - CERRAR AL HACER CLIC
    // ============================================================
    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // ============================================================
    // CERRAR AL HACER CLIC EN UN ENLACE (MÓVIL/TABLET)
    // ============================================================
    document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
        link.addEventListener('click', function() {
            if (getScreenType() !== 'desktop') {
                setTimeout(function() {
                    sidebar.classList.remove('open');
                    if (overlay) overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }, 150);
            }
        });
    });
    
    // ============================================================
    // RESTAURAR ESTADO EN DESKTOP
    // ============================================================
    if (getScreenType() === 'desktop') {
        const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (collapsed) {
            sidebar.classList.add('collapsed');
            if (mainContent) mainContent.classList.add('expanded');
        }
    }
    
    // ============================================================
    // CERRAR CON ESC
    // ============================================================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
    
    // ============================================================
    // MANEJAR CAMBIO DE TAMAÑO DE VENTANA
    // ============================================================
    let lastScreenType = getScreenType();
    let resizeTimer;
    
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const currentScreenType = getScreenType();
            
            if (currentScreenType !== lastScreenType) {
                if (currentScreenType === 'desktop') {
                    sidebar.classList.remove('open');
                    if (overlay) overlay.classList.remove('active');
                    document.body.style.overflow = '';
                    
                    const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                    if (collapsed) {
                        sidebar.classList.add('collapsed');
                        if (mainContent) mainContent.classList.add('expanded');
                    } else {
                        sidebar.classList.remove('collapsed');
                        if (mainContent) mainContent.classList.remove('expanded');
                    }
                } else {
                    sidebar.classList.remove('collapsed');
                    if (mainContent) mainContent.classList.remove('expanded');
                    sidebar.classList.remove('open');
                    if (overlay) overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
                
                lastScreenType = currentScreenType;
                console.log('📱 Cambio de pantalla:', currentScreenType);
            }
        }, 150);
    });
    
    // ============================================================
    // BOTÓN AYUDA
    // ============================================================
    const btnAyuda = document.getElementById('btnAyuda');
    if (btnAyuda) {
        btnAyuda.addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('ayudaModal'));
            modal.show();
        });
    }
    
    console.log('✅ Sistema de menú responsive inicializado. Pantalla:', getScreenType());
});
</script>



    
    


    <!-- ============================================ -->
    
    


    <!-- ============================================ -->
    



    



    


    


    <!-- MODAL DE CARGA PARA ENVÍO DE CORREOS -->
    <div class="modal fade" id="modalEnviandoCorreo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body text-center py-5">
                    <i class="fas fa-envelope-open-text fa-4x text-primary mb-4"></i>
                    <h5 class="mb-4 fw-bold">Enviando documento...</h5>
                    <div class="progress" style="height: 25px; border-radius: 12px;">
                        <div id="progressBarCorreo" class="progress-bar progress-bar-striped progress-bar-animated bg-success fw-bold" role="progressbar" style="width: 0%; font-size: 14px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <p class="text-muted mt-4 mb-0 small"><i class="fas fa-info-circle me-1"></i> Por favor, no cierre esta ventana.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/layouts/app.blade.php ENDPATH**/ ?>