<?php $__env->startSection('title', 'Asistente Médico IA'); ?>
<?php $__env->startSection('page-title', 'Asistente Médico IA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-0">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-robot me-2"></i> Chat con el Asistente Médico</h5>
                    <span class="badge bg-light text-dark">Groq + Llama 3.3</span>
                </div>
                <div class="card-body p-0">
                    <!-- Selector de Paciente (opcional) -->
                    <div class="p-3 border-bottom bg-light">
                        <label class="form-label fw-bold small mb-1">Adjuntar contexto de paciente (opcional):</label>
                        <select id="pacienteContexto" class="form-select form-select-sm">
                            <option value="">-- Sin paciente (consulta general) --</option>
                            <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($paciente->id); ?>"><?php echo e($paciente->nombre_completo); ?> (<?php echo e($paciente->edad); ?> años)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <small class="text-muted">Los datos personales del paciente serán anonimizados antes de enviarse a la IA.</small>
                    </div>

                    <!-- Área de Mensajes -->
                    <div id="chatMessages" class="p-3" style="height: 450px; overflow-y: auto; background: #f8f9fa;">
                        <!-- Mensaje de Bienvenida -->
                        <div class="d-flex mb-3">
                            <div class="me-2"><i class="fas fa-robot fa-2x text-primary"></i></div>
                            <div class="bg-white p-3 rounded shadow-sm" style="max-width: 80%;">
                                Hola, soy tu asistente médico. Puedo ayudarte con diagnósticos, tratamientos o generar un plan de salud. ¿En qué puedo ayudarte hoy?
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de Envío -->
                    <div class="p-3 border-top">
                        <form id="chatForm" class="d-flex gap-2">
                            <input type="text" id="messageInput" class="form-control" placeholder="Escribe tu consulta médica..." autocomplete="off" required>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const chatMessages = document.getElementById('chatMessages');
    const pacienteSelect = document.getElementById('pacienteContexto');

    // Historial de la conversación
    let conversationHistory = [];

    function addMessage(role, content) {
        const isUser = role === 'user';
        const html = `
            <div class="d-flex mb-3 ${isUser ? 'justify-content-end' : ''}">
                ${!isUser ? '<div class="me-2"><i class="fas fa-robot fa-2x text-primary"></i></div>' : ''}
                <div class="${isUser ? 'bg-primary text-white' : 'bg-white'} p-3 rounded shadow-sm" style="max-width: 80%;">
                    ${content.replace(/\n/g, '<br>')}
                </div>
                ${isUser ? '<div class="ms-2"><i class="fas fa-user-md fa-2x text-secondary"></i></div>' : ''}
            </div>
        `;
        chatMessages.insertAdjacentHTML('beforeend', html);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showLoading() {
        const html = `
            <div id="loadingMessage" class="d-flex mb-3">
                <div class="me-2"><i class="fas fa-robot fa-2x text-primary"></i></div>
                <div class="bg-white p-3 rounded shadow-sm">
                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                    Pensando...
                </div>
            </div>
        `;
        chatMessages.insertAdjacentHTML('beforeend', html);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function removeLoading() {
        const loading = document.getElementById('loadingMessage');
        if (loading) loading.remove();
    }

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const mensaje = messageInput.value.trim();
        if (!mensaje) return;

        // Añadir mensaje del usuario al UI y al historial
        addMessage('user', mensaje);
        conversationHistory.push({ role: 'user', content: mensaje });
        messageInput.value = '';
        showLoading();

        // Enviar petición
        fetch('<?php echo e(route("ia.chat")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({
                messages: conversationHistory,
                paciente_id: pacienteSelect.value || null
            })
        })
        .then(response => response.json())
        .then(data => {
            removeLoading();
            if (data.error) {
                addMessage('assistant', '❌ Error: ' + data.error);
            } else {
                addMessage('assistant', data.response);
                conversationHistory.push({ role: 'assistant', content: data.response });
            }
        })
        .catch(error => {
            removeLoading();
            addMessage('assistant', '❌ Error de conexión. Intenta de nuevo.');
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/ia/index.blade.php ENDPATH**/ ?>