

<?php $__env->startSection('title', 'Calendario de Citas'); ?>
<?php $__env->startSection('page-title', 'Calendario de Citas Médicas'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* ===== ESTILOS DEL CALENDARIO ===== */
    .fc-event {
        cursor: pointer;
        border-radius: 6px !important;
        border: none !important;
        padding: 3px 6px !important;
        font-size: 12px !important;
        font-weight: 500 !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .fc-event:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .fc-day-today {
        background-color: #f0f7ff !important;
    }
    .fc-daygrid-day-number {
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
    }
    .fc-col-header-cell-cushion {
        font-weight: 700;
        color: #2c3e50;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }
    .fc-toolbar-title {
        font-size: 22px !important;
        font-weight: 700 !important;
        color: #1a202c;
    }
    .fc-button-primary {
        background-color: #4f46e5 !important;
        border-color: #4f46e5 !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        padding: 8px 16px !important;
        transition: all 0.2s ease;
    }
    .fc-button-primary:hover {
        background-color: #4338ca !important;
        border-color: #4338ca !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    .fc-button-primary:focus {
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.4) !important;
    }
    .fc-button-primary:disabled {
        background-color: #a5b4fc !important;
        border-color: #a5b4fc !important;
    }
    .fc-button-active {
        background-color: #1e293b !important;
        border-color: #1e293b !important;
    }
    .fc-daygrid-day-frame {
        min-height: 80px;
        transition: background-color 0.2s ease;
    }
    .fc-daygrid-day-frame:hover {
        background-color: #f8fafc;
    }
    .fc-daygrid-day-events {
        min-height: 30px;
    }

    /* ===== TARJETA DEL CALENDARIO ===== */
    .calendar-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }
    .calendar-card .card-header {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        padding: 16px 24px;
        border: none;
    }
    .calendar-card .card-header h5 {
        color: #fff;
        font-weight: 600;
        letter-spacing: 0.3px;
    }
    .calendar-card .card-header h5 i {
        color: rgba(255,255,255,0.8);
    }
    .calendar-card .card-body {
        padding: 20px;
    }

    /* ===== MODAL MEJORADO ===== */
    .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }
    .modal-header-custom {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        padding: 20px 24px;
        border: none;
    }
    .modal-header-custom h5 {
        color: #fff;
        font-weight: 600;
    }
    .modal-header-custom h5 i {
        color: rgba(255,255,255,0.8);
    }
    .modal-body-custom {
        padding: 24px;
    }
    .modal-footer-custom {
        padding: 16px 24px;
        border-top: 1px solid #f1f5f9;
        background-color: #fafbfc;
    }
    .btn-close-white {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }
    .btn-close-white:hover {
        opacity: 1;
    }

    /* ===== DETALLE DE LA CITA ===== */
    .detail-row {
        display: flex;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .detail-row:last-child {
        border-bottom: none;
    }
    .detail-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-right: 14px;
        font-size: 14px;
    }
    .detail-icon-blue { background: #eef2ff; color: #4f46e5; }
    .detail-icon-green { background: #ecfdf5; color: #10b981; }
    .detail-icon-purple { background: #f5f3ff; color: #8b5cf6; }
    .detail-icon-orange { background: #fffbeb; color: #f59e0b; }
    .detail-icon-red { background: #fef2f2; color: #ef4444; }
    .detail-icon-gray { background: #f1f5f9; color: #64748b; }

    .detail-label {
        font-size: 12px;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }
    .detail-value {
        font-size: 15px;
        font-weight: 500;
        color: #1e293b;
    }
    .detail-value-sm {
        font-size: 13px;
        color: #334155;
    }

    /* ===== BADGES ===== */
    .badge-tipo {
        font-size: 11px;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .badge-tipo-consulta { background: #eef2ff; color: #4f46e5; }
    .badge-tipo-control { background: #ecfdf5; color: #10b981; }
    .badge-tipo-emergencia { background: #fef2f2; color: #ef4444; }
    .badge-tipo-seguimiento { background: #f5f3ff; color: #8b5cf6; }

    .badge-estado {
        font-size: 11px;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .badge-estado-programada { background: #fffbeb; color: #d97706; }
    .badge-estado-realizada { background: #ecfdf5; color: #059669; }
    .badge-estado-cancelada { background: #fef2f2; color: #dc2626; }

    /* ===== BOTONES ===== */
    .btn-outline-primary-custom {
        color: #4f46e5;
        border: 2px solid #4f46e5;
        border-radius: 10px;
        padding: 8px 18px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-outline-primary-custom:hover {
        background: #4f46e5;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }
    .btn-primary-custom {
        background: #4f46e5;
        border: none;
        border-radius: 10px;
        padding: 8px 18px;
        font-weight: 600;
        color: #fff;
        transition: all 0.2s ease;
    }
    .btn-primary-custom:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        color: #fff;
    }
    .btn-success-custom {
        background: #10b981;
        border: none;
        border-radius: 10px;
        padding: 8px 18px;
        font-weight: 600;
        color: #fff;
        transition: all 0.2s ease;
    }
    .btn-success-custom:hover {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        color: #fff;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .fc-toolbar-title {
            font-size: 16px !important;
        }
        .fc-button-primary {
            padding: 6px 10px !important;
            font-size: 12px !important;
        }
        .modal-dialog {
            margin: 10px;
        }
        .detail-row {
            flex-direction: column;
            padding: 12px 0;
        }
        .detail-icon {
            margin-bottom: 8px;
        }
    }
</style>

<div class="row">
    <div class="col-12">
        <!-- ===== TARJETA DEL CALENDARIO ===== -->
        <div class="card calendar-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Calendario de Citas Médicas
                    <span class="badge bg-white text-primary ms-2" id="totalCitas">0</span>
                </h5>
                <div>
                    <a href="<?php echo e(route('citas.index')); ?>" class="btn btn-light btn-sm text-primary fw-semibold">
                        <i class="fas fa-list me-1"></i> Ver Lista
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<!-- ===== MODAL MEJORADO ===== -->
<div class="modal fade" id="citaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- HEADER -->
            <div class="modal-header-custom">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-check me-2"></i>
                    Detalles de la Cita
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body-custom" id="modalBody">
                <!-- Contenido dinámico -->
            </div>

            <!-- FOOTER -->
            <div class="modal-footer-custom d-flex justify-content-between flex-wrap gap-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cerrar
                </button>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="#" id="verPacienteBtn" class="btn btn-outline-primary-custom" target="_blank">
                        <i class="fas fa-user me-1"></i> Ver Paciente
                    </a>
                    <a href="#" id="verHistorialBtn" class="btn btn-primary-custom" target="_blank">
                        <i class="fas fa-notes-medical me-1"></i> Ver Historial
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/main.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.8/main.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.8/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        let totalCitas = 0;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            buttonText: {
                dayGridMonth: 'Mes',
                timeGridWeek: 'Semana',
                timeGridDay: 'Día',
                listWeek: 'Lista'
            },
            events: '<?php echo e(route("citas.eventos")); ?>',
            eventClick: function(info) {
                const evento = info.event;
                const ext = evento.extendedProps || {};
                const modalBody = document.getElementById('modalBody');
                const verHistorialBtn = document.getElementById('verHistorialBtn');
                const verPacienteBtn = document.getElementById('verPacienteBtn');

                // Formatear fecha
                const fecha = evento.start ? new Date(evento.start).toLocaleDateString('es-ES', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }) : 'No disponible';

                // Determinar estado
                const hoy = new Date();
                const fechaCita = new Date(evento.start);
                let estado = 'Programada';
                let estadoClass = 'badge-estado-programada';
                if (fechaCita < hoy) {
                    estado = 'Realizada';
                    estadoClass = 'badge-estado-realizada';
                }

                // Íconos por tipo
                const iconosTipo = {
                    'consulta': 'fa-stethoscope',
                    'control': 'fa-check-circle',
                    'emergencia': 'fa-ambulance',
                    'seguimiento': 'fa-chart-line'
                };
                const tipoIcon = iconosTipo[ext.tipo] || 'fa-calendar';

                modalBody.innerHTML = `
                    <!-- Paciente -->
                    <div class="detail-row">
                        <div class="detail-icon detail-icon-blue">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <div class="detail-label">Paciente</div>
                            <div class="detail-value">${evento.title}</div>
                        </div>
                    </div>

                    <!-- Fecha -->
                    <div class="detail-row">
                        <div class="detail-icon detail-icon-purple">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <div class="detail-label">Fecha de la Cita</div>
                            <div class="detail-value">${fecha}</div>
                        </div>
                    </div>

                    <!-- Teléfono -->
                    <div class="detail-row">
                        <div class="detail-icon detail-icon-green">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <div class="detail-label">Teléfono</div>
                            <div class="detail-value">${ext.telefono || 'No disponible'}</div>
                        </div>
                    </div>

                    <!-- Diagnóstico -->
                    <div class="detail-row">
                        <div class="detail-icon detail-icon-orange">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div>
                            <div class="detail-label">Diagnóstico</div>
                            <div class="detail-value">${ext.diagnostico || 'No especificado'}</div>
                        </div>
                    </div>

                    <!-- Medicamento -->
                    <div class="detail-row">
                        <div class="detail-icon detail-icon-red">
                            <i class="fas fa-prescription-bottle"></i>
                        </div>
                        <div>
                            <div class="detail-label">Medicamento</div>
                            <div class="detail-value">${ext.medicamento || 'No especificado'}</div>
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="detail-row">
                        <div class="detail-icon detail-icon-gray">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div>
                            <div class="detail-label">Estado</div>
                            <div>
                                <span class="badge-estado ${estadoClass}">${estado}</span>
                            </div>
                        </div>
                    </div>
                `;

                verHistorialBtn.href = evento.url || '#';
                verPacienteBtn.href = ext.paciente_url || '#';

                new bootstrap.Modal(document.getElementById('citaModal')).show();
            },
            eventDidMount: function(info) {
                totalCitas++;
                document.getElementById('totalCitas').textContent = totalCitas;

                // Tooltip con más información
                const ext = info.event.extendedProps || {};
                const tooltip = [
                    info.event.title,
                    ext.telefono ? '📞 ' + ext.telefono : '',
                    ext.diagnostico ? '🔬 ' + ext.diagnostico : ''
                ].filter(Boolean).join(' | ');
                info.el.setAttribute('title', tooltip);
            }
        });

        calendar.render();
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/citas/index.blade.php ENDPATH**/ ?>