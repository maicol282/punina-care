<!-- Modal de Ayuda -->
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
</div><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/components/ayuda-modal.blade.php ENDPATH**/ ?>