<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema de Historial Clínico')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.3.1/dist/driver.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <!-- Estilos personalizados -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    @stack('styles')
    @push('scripts')
<script src="{{ asset('js/jitsi-pip.js') }}"></script>
@endpush
</head>
<body>

<button class="btn" id="sidebarToggle" title="Abrir/Cerrar menú">
    <i class="fas fa-bars"></i>
</button>


    @auth
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
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-chart-pie"></i>
                    <span>Estadísticas</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pacientes.*') ? 'active' : '' }}" href="{{ route('pacientes.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Pacientes</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pacientes.create') ? 'active' : '' }}" href="{{ route('pacientes.create') }}">
                    <i class="fas fa-user-plus"></i>
                    <span>Nuevo Paciente</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('historiales.index') ? 'active' : '' }}" href="{{ route('historiales.index') }}">
                    <i class="fas fa-notes-medical"></i>
                    <span>Historiales</span>
                </a>
            </li>
            

            <!-- ===== SEPARADOR ===== -->
            <li class="nav-divider"></li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('recetas.*') ? 'active' : '' }}" href="{{ route('recetas.todas') }}">
                    <i class="fas fa-prescription-bottle"></i>
                    <span>Recetas Médicas</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('citas.*') ? 'active' : '' }}" href="{{ route('citas.index') }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Calendario de Citas</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('ia.*') ? 'active' : '' }}" href="{{ route('ia.index') }}">
                    <i class="fas fa-brain me-2"></i>
                    <span>IA</span>
                    <span class="badge bg-success text-white ms-1" style="font-size: 8px;">Pro</span>
                </a>
            </li>

            <!-- ===== SEPARADOR ===== -->
            <li class="nav-divider"></li>
            
           <!-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('reposos.*') ? 'active' : '' }}" href="{{ route('reposos.index') }}">
                    <i class="fas fa-bed"></i>
                    <span>Reposos</span>
                </a>
            </li> -->

               <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pedidos-examenes.*') ? 'active' : '' }}" href="{{ route('pedidos-examenes.index') }}">
                <i class="fas fa-flask"></i>
                <span>Pedidos de Exámenes</span>
                 </a>
                </li>  

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('certificados.*') ? 'active' : '' }}" 
                href="{{ route('certificados.index') }}">
                    <i class="fas fa-certificate me-2"></i>
                    <span>Certificados</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('telemedicina.*') ? 'active' : '' }}" href="{{ route('telemedicina.index') }}">
                    <i class="fas fa-video"></i>
                    <span>Punina Care</span>
                </a>
            </li>

            <!-- ===== SEPARADOR ===== -->
            <li class="nav-divider"></li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user-cog"></i>
                    <span>Firma de documentos</span>
                </a>
            </li>
            
            @role('Administrador')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
                    <i class="fas fa-user-md"></i>
                    <span>Médicos</span>
                </a>
            </li>
            @endrole
        </ul>
    </nav>

    <!-- Usuario -->
    <div class="sidebar-footer">
        <div class="user-info">
            <i class="fas fa-user-circle"></i>
            <span>{{ Auth::user()->name }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn" title="Cerrar sesión">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
        @auth
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm fw-medium d-flex align-items-center gap-1">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </button>
    </form>
@endauth
    </div>
</div>

<!-- Overlay -->
@endauth

    <!-- Main Content -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="main-content">
        @auth
        <div class="navbar-top d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <!-- ===== BOTÓN HAMBURGUESA (SOLO VISIBLE EN MÓVIL) ===== -->
        <div>
            <h4 class="mb-0 text-primary">@yield('page-title')</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">@yield('breadcrumb', 'Panel Principal')</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-flex align-items-center gap-3">
        @include('components.buscador-global')
       
        <span class="badge bg-primary">{{ Auth::user()->getRoleNames()->first() }}</span>
     <button class="btn btn-outline-primary btn-sm" id="btnAyuda" title="Ayuda del sistema">
        <i class="fas fa-question-circle"></i>
    </button>
    </div>
    
</div> 
<!-- Overlay para cerrar el menú en móvil -->
@endauth

        <!-- Alertas -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-times-circle me-2"></i>
                <strong>Por favor corrige los siguientes errores:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Contenido principal -->
        @yield('content')
        
        <!-- Footer -->
        
    <footer class="text-center py-4 mt-auto border-top bg-light">
        <div class="container">
            <p class="text-muted small mb-2">
                &copy; {{ date('Y') }} Punina Care - Sistema Médico Electrónico. Todos los derechos reservados.
            </p>
            <div class="d-flex justify-content-center gap-3 small">
                <a href="{{ route('legal.terminos') }}" class="text-decoration-none text-muted">Términos y Condiciones</a>
                <span class="text-muted">|</span>
                <a href="{{ route('legal.privacidad') }}" class="text-decoration-none text-muted">Política de Privacidad</a>
                <span class="text-muted">|</span>
                <a href="{{ route('legal.cookies') }}" class="text-decoration-none text-muted">Política de Cookies</a>
                <span class="text-muted">|</span>
                <a href="{{ route('legal.consentimiento') }}" class="text-decoration-none text-muted">Consentimiento Informado</a>
                <span class="text-muted">|</span>
                <a href="{{ route('legal.consentimiento-teleconsulta') }}" class="text-decoration-none text-muted">Consentimiento Teleconsulta</a>
            </div>
        </div>
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
                                    <i class="fas fa-robot me-2 text-dark"></i> Asistente IA
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
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/autocompletado-gmail.js') }}"></script>
    
    @stack('scripts')
    
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

    @include('cookie-consent::index')

    <script>
        // Función global para habilitar/deshabilitar presión arterial
        function togglePresionField() {
            const presionInput = document.getElementById('presion_arterial');
            const btn = document.getElementById('togglePresionBtn');
            const btnText = document.getElementById('btnToggleText');
            const ayuda = document.getElementById('presion_ayuda');
            
            if (!presionInput || !btn) return;
            
            if (presionInput.disabled) {
                // Habilitar
                presionInput.disabled = false;
                presionInput.value = '';
                presionInput.focus();
                if (ayuda) ayuda.textContent = 'Presión habilitada manualmente.';
                if (btnText) btnText.textContent = 'Deshabilitar';
                btn.classList.remove('btn-outline-warning');
                btn.classList.add('btn-outline-success');
            } else {
                // Deshabilitar
                presionInput.disabled = true;
                presionInput.value = 'N/A (Paciente pediátrico)';
                if (ayuda) ayuda.textContent = 'Presión deshabilitada manualmente.';
                if (btnText) btnText.textContent = 'Habilitar';
                btn.classList.remove('btn-outline-success');
                btn.classList.add('btn-outline-warning');
            }
        }

        // Configurar estado inicial al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const presionInput = document.getElementById('presion_arterial');
            const btn = document.getElementById('togglePresionBtn');
            const btnText = document.getElementById('btnToggleText');
            const ayuda = document.getElementById('presion_ayuda');
            const fechaNacimiento = document.getElementById('fecha_nacimiento_paciente')?.value;
            
            if (!presionInput || !btn) return;
            
            // Calcular edad si hay fecha de nacimiento
            let edad = 0;
            if (fechaNacimiento) {
                const hoy = new Date();
                const nacimiento = new Date(fechaNacimiento);
                edad = hoy.getFullYear() - nacimiento.getFullYear();
                const mes = hoy.getMonth() - nacimiento.getMonth();
                if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) edad--;
            }
            
            if (edad > 0 && edad < 15) {
                // Niño: deshabilitado por defecto
                presionInput.disabled = true;
                presionInput.value = 'N/A (Paciente pediátrico)';
                if (ayuda) ayuda.textContent = 'Presión deshabilitada (niño). Use el botón para habilitar.';
                if (btnText) btnText.textContent = 'Habilitar';
                btn.classList.remove('btn-outline-secondary');
                btn.classList.add('btn-outline-warning');
            } else {
                // Adulto: habilitado por defecto
                presionInput.disabled = false;
                if (ayuda) ayuda.textContent = 'Habilitado por defecto';
                if (btnText) btnText.textContent = 'Deshabilitar';
                btn.classList.remove('btn-outline-warning');
                btn.classList.add('btn-outline-success');
            }
        });
    </script>


<!-- Botón flotante de ayuda -->
<button type="button" class="btn btn-primary rounded-circle shadow-lg position-fixed" 
        style="bottom: 20px; right: 20px; width: 50px; height: 50px; z-index: 9998;"
        data-bs-toggle="modal" data-bs-target="#modalAyudaRapida"
        title="Ayuda rápida">
    <i class="fas fa-question fa-lg"></i>
</button>

<!-- Modal de ayuda rápida -->
<div class="modal fade" id="modalAyudaRapida" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-question-circle me-2"></i> Guía rápida de uso</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary"><i class="fas fa-user-plus me-2"></i>Registrar Paciente</h6>
                                <p class="small text-muted mb-0">Ve a "Pacientes" → "Nuevo Paciente". Llena los datos básicos (nombre, cédula, fecha de nacimiento).</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-success"><i class="fas fa-notes-medical me-2"></i>Crear Historial</h6>
                                <p class="small text-muted mb-0">Desde el perfil del paciente, haz clic en "Nuevo Historial". Llena los datos y guarda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-info"><i class="fas fa-video me-2"></i>Telemedicina</h6>
                                <p class="small text-muted mb-0">Ve a "Punina Care" → "Nueva Consulta". Al guardar, haz clic en "Unirse a Videollamada" (usa Chrome o Edge).</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold text-warning"><i class="fas fa-file-pdf me-2"></i>Firmar Documentos</h6>
                                <p class="small text-muted mb-0">Sube tu certificado .p12 en "Mi Perfil". Los PDFs se firmarán automáticamente.</p>
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


<!-- Botón flotante de "Volver" -->
<button type="button" class="btn btn-dark rounded-circle shadow-lg position-fixed" 
        style="bottom: 20px; left: 20px; width: 50px; height: 50px; z-index: 9997;"
        onclick="history.back()" title="Volver atrás">
    <i class="fas fa-arrow-left fa-lg"></i>
</button>


<script>
document.addEventListener('keydown', function(event) {
    if (event.key === 'F1') {
        event.preventDefault();
        var modal = document.getElementById('modalAyudaRapida');
        if (modal) {
            var bsModal = new bootstrap.Modal(modal);
            bsModal.show();
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/driver.js@1.3.1/dist/driver.js.iife.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si el usuario ya vio el tour
    const tourVisto = localStorage.getItem('punina_tour_visto');
    
    if (!tourVisto && typeof window.driver !== 'undefined') {
        const driver = window.driver.js.driver;
        const driverObj = driver({
            showProgress: true,
            showButtons: ['next', 'previous', 'close'],
            steps: [
                {
                    element: '.sidebar-brand',
                    popover: {
                        title: '👋 ¡Bienvenido a Punina Care!',
                        description: 'Este es tu sistema médico. Vamos a dar un recorrido rápido para que aprendas a usarlo.'
                    }
                },
                {
                    element: '.sidebar-nav',
                    popover: {
                        title: '📋 Menú de Navegación',
                        description: 'Aquí encontrarás todas las secciones: Pacientes, Historiales, Recetas, Telemedicina y más.'
                    }
                },
                {
                    element: '.sidebar-nav .nav-link:nth-child(2)',
                    popover: {
                        title: '👥 Pacientes',
                        description: 'Haz clic aquí para ver la lista de pacientes, crear nuevos o buscar por cédula.'
                    }
                },
                {
                    element: '.sidebar-nav .nav-link:nth-child(4)',
                    popover: {
                        title: '📄 Historiales',
                        description: 'Aquí puedes ver todos los historiales clínicos y crear nuevos.'
                    }
                },
                {
                    element: '.sidebar-nav .nav-link:nth-child(5)',
                    popover: {
                        title: '💊 Recetas',
                        description: 'Gestiona todas las recetas médicas, envíalas por correo y descárgalas firmadas.'
                    }
                },
                {
                    element: '.sidebar-nav .nav-link:nth-child(7)',
                    popover: {
                        title: '📹 Telemedicina',
                        description: 'Aquí puedes iniciar videollamadas con tus pacientes (usa Chrome o Edge).'
                    }
                },
                {
                    element: '#modalAyudaRapida',
                    popover: {
                        title: '❓ Ayuda Rápida',
                        description: 'En cualquier momento puedes presionar F1 o hacer clic en el botón de ayuda para ver esta guía.'
                    }
                },
                {
                    element: 'body',
                    popover: {
                        title: '🚀 ¡Listo para empezar!',
                        description: 'Ya conoces lo básico. Si necesitas ayuda, presiona F1. ¡Bienvenido a Punina Care!'
                    }
                }
            ],
            onDestroyed: () => {
                // Marcar el tour como visto
                localStorage.setItem('punina_tour_visto', 'true');
            }
        });
        
        // Iniciar el tour después de un pequeño delay
        setTimeout(() => {
            driverObj.drive();
        }, 1000);
    }
});
</script>


<!-- BÚSQUEDA GLOBAL (COMMAND PALETTE) -->
<div class="modal fade" id="modalBusquedaGlobal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light border-0">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" id="inputBusquedaGlobal" class="form-control border-start-0" placeholder="Buscar pacientes, historiales, recetas... (Ctrl+K)" autocomplete="off">
                </div>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div id="resultadosBusqueda" class="list-group list-group-flush">
                    <div class="p-4 text-center text-muted">
                        <i class="fas fa-keyboard fa-2x mb-2 opacity-50"></i>
                        <p class="mb-0">Escribe para buscar o usa los atajos rápidos:</p>
                        <div class="d-flex flex-wrap gap-2 justify-content-center mt-2">
                            <a href="{{ route('pacientes.index') }}" class="btn btn-sm btn-outline-primary">Pacientes</a>
                            <a href="{{ route('historiales.index') }}" class="btn btn-sm btn-outline-success">Historiales</a>
                            <a href="{{ route('recetas.todas') }}" class="btn btn-sm btn-outline-info">Recetas</a>
                            <a href="{{ route('telemedicina.index') }}" class="btn btn-sm btn-outline-warning">Telemedicina</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        var modal = document.getElementById('modalBusquedaGlobal');
        if (modal) {
            var bsModal = new bootstrap.Modal(modal);
            bsModal.show();
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('inputBusquedaGlobal');
    const resultados = document.getElementById('resultadosBusqueda');
    
    if (inputBusqueda) {
        inputBusqueda.addEventListener('input', function() {
            const query = this.value.trim();
            if (query.length < 2) {
                resultados.innerHTML = '<div class="p-4 text-center text-muted"><i class="fas fa-keyboard fa-2x mb-2 opacity-50"></i><p class="mb-0">Escribe al menos 2 caracteres...</p></div>';
                return;
            }
            
            // Aquí iría la búsqueda real (AJAX a un endpoint)
            // Por ahora, mostramos un placeholder
            resultados.innerHTML = '<div class="p-4 text-center text-muted"><div class="spinner-border spinner-border-sm me-2"></div>Buscando "<strong>' + query + '</strong>"...</div>';
            
            // Simulación de búsqueda (en el futuro, reemplazar con fetch real)
            setTimeout(() => {
                resultados.innerHTML = `
                    <div class="p-3 text-muted">
                        <p class="small mb-2">Resultados para "<strong>${query}</strong>":</p>
                        <a href="{{ route('pacientes.index') }}?buscar=${encodeURIComponent(query)}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user me-2 text-primary"></i> Buscar pacientes con "${query}"
                        </a>
                        <a href="{{ route('historiales.index') }}?buscar=${encodeURIComponent(query)}" class="list-group-item list-group-item-action">
                            <i class="fas fa-notes-medical me-2 text-success"></i> Buscar historiales con "${query}"
                        </a>
                        <a href="{{ route('recetas.todas') }}?buscar=${encodeURIComponent(query)}" class="list-group-item list-group-item-action">
                            <i class="fas fa-prescription me-2 text-info"></i> Buscar recetas con "${query}"
                        </a>
                    </div>
                `;
            }, 500);
        });
    }
});
</script>

</body>
</html>