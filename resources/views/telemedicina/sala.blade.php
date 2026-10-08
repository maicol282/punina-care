@extends('layouts.app')

@section('title', 'Sala de Videollamada')
@section('page-title', 'Sala de Videollamada')

@section('content')
<div class="container-fluid">
    <div class="alert alert-info d-flex align-items-center justify-content-between">
        <div>
            <i class="fas fa-info-circle me-2"></i>
            <strong>Consulta activa:</strong> {{ $consulta->paciente->nombre_completo }} - 
            {{ $consulta->fecha_hora_programada->format('d/m/Y H:i') }}
        </div>
        <div>
            <a href="{{ route('telemedicina.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body text-center py-5">
            <i class="fas fa-video fa-4x text-primary mb-3"></i>
            <h4>Videollamada lista para iniciar</h4>
            <p class="text-muted">
                Presiona el botón verde para abrir la videollamada con 
                <strong>{{ $consulta->paciente->nombre_completo }}</strong>.
            </p>
            <div class="d-grid gap-2 d-md-block mt-4">
                <button id="btnAbrirVentana" class="btn btn-success btn-lg">
                    <i class="fas fa-video me-2"></i> Iniciar Videollamada
                </button>
                <button id="btnFinalizar" class="btn btn-danger btn-lg ms-2">
                    <i class="fas fa-phone-slash me-2"></i> Finalizar Consulta
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const consultaId = {{ $consulta->id }};
    const urlJitsi = '{{ $consulta->enlace_acceso }}';
    const nombreVentana = 'jitsi_videollamada_' + consultaId;
    
    // ============================================================
    // ABRIR JITSI EN VENTANA POPUP
    // ============================================================
    function abrirVideollamada() {
        // Dimensiones del popup: 30% del ancho y 100% del alto
        const anchoPantalla = window.screen.availWidth;
        const altoPantalla = window.screen.availHeight;
        
        const anchoJitsi = Math.floor(anchoPantalla * 0.30);
        const altoJitsi = Math.floor(altoPantalla * 0.95);
        const posicionLeft = Math.floor(anchoPantalla * 0.70);
        const posicionTop = 0;
        
        // Abrir Jitsi como ventana popup
        const ventanaJitsi = window.open(
            urlJitsi,
            nombreVentana,
            `width=${anchoJitsi},height=${altoJitsi},left=${posicionLeft},top=${posicionTop},menubar=no,toolbar=no,location=no,status=no,resizable=yes,scrollbars=no`
        );
        
        // Si el navegador bloquea la ventana, mostrar alerta
        if (!ventanaJitsi || ventanaJitsi.closed || typeof ventanaJitsi.closed === 'undefined') {
            alert(
                'El navegador bloqueó la ventana de la videollamada.\n\n' +
                'Por favor, permite las ventanas emergentes (popups) para este sitio:\n\n' +
                '1. Haz clic en el ícono de "popup bloqueado" en la barra de direcciones\n' +
                '2. Selecciona "Permitir siempre ventanas emergentes de este sitio"\n' +
                '3. Vuelve a hacer clic en "Iniciar Videollamada"'
            );
            return null;
        }
        
        // Mostrar el modal de instrucciones
        setTimeout(function() {
            mostrarInstrucciones();
        }, 500);
        
        return ventanaJitsi;
    }
    
    // ============================================================
    // MODAL DE INSTRUCCIONES SIMPLE Y CLARO
    // ============================================================
    function mostrarInstrucciones() {
        // Verificar si el usuario marcó "no volver a mostrar"
        if (localStorage.getItem('instrucciones_jitsi_no_mostrar') === 'true') {
            return;
        }
        
        // Verificar si ya se mostraron en esta sesión
        if (sessionStorage.getItem('instrucciones_jitsi_mostradas') === 'true') {
            return;
        }
        
        const modal = document.createElement('div');
        modal.style.cssText = `
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.8);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 20px;
            overflow-y: auto;
        `;
        
        modal.innerHTML = `
            <div style="background: white; border-radius: 16px; padding: 35px; max-width: 640px; width: 100%; box-shadow: 0 20px 60px rgba(0,0,0,0.4); max-height: 90vh; overflow-y: auto;">
                
                <!-- Header -->
                <div style="text-align: center; margin-bottom: 25px;">
                    <div style="background: linear-gradient(135deg, #27ae60, #2ecc71); width: 80px; height: 80px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 8px 20px rgba(39,174,96,0.3);">
                        <i class="fas fa-check" style="font-size: 40px; color: white;"></i>
                    </div>
                    <h2 style="margin: 0; color: #27ae60; font-size: 26px;">¡Todo listo!</h2>
                    <p style="color: #555; margin: 10px 0 0 0; font-size: 16px;">
                        La videollamada se abrió en una ventana aparte
                    </p>
                </div>

                <!-- Mensaje principal -->
                <div style="background: #e8f5e9; border-left: 5px solid #27ae60; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
                    <p style="margin: 0; color: #1b5e20; font-size: 15px; line-height: 1.6;">
                        <strong>👉 Ahora tienes 2 ventanas abiertas:</strong><br>
                        <strong>Ventana 1:</strong> Esta ventana (el sistema médico)<br>
                        <strong>Ventana 2:</strong> La videollamada con el paciente
                    </p>
                </div>

                <!-- Instrucción paso a paso -->
                <div style="margin-bottom: 25px;">
                    <h3 style="color: #0d47a1; font-size: 18px; margin: 0 0 15px 0; text-align: center;">
                        <i class="fas fa-hand-point-right"></i> ¿Cómo ver al paciente y trabajar al mismo tiempo?
                    </h3>
                    
                    <div style="background: #f8f9fa; border-radius: 10px; padding: 20px; border: 2px dashed #0d47a1;">
                        <p style="margin: 0 0 15px 0; color: #333; font-size: 15px; line-height: 1.6;">
                            Para ver al paciente y llenar los datos al mismo tiempo, necesitas poner las dos ventanas <strong>una al lado de la otra</strong>. Es muy fácil, mira:
                        </p>
                        
                        <!-- Paso 1 -->
                        <div style="display: flex; gap: 15px; margin-bottom: 18px; align-items: flex-start;">
                            <div style="background: #0d47a1; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; font-size: 15px;">1</div>
                            <div>
                                <strong style="color: #0d47a1; font-size: 15px;">Pon esta ventana (el sistema) a la izquierda</strong>
                                <p style="margin: 5px 0 0 0; color: #555; font-size: 14px; line-height: 1.5;">
                                    Haz clic en esta ventana y presiona la tecla <strong>Windows</strong> y sin soltarla, presiona la <strong>flecha izquierda (←)</strong>.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Paso 2 -->
                        <div style="display: flex; gap: 15px; margin-bottom: 18px; align-items: flex-start;">
                            <div style="background: #0d47a1; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; font-size: 15px;">2</div>
                            <div>
                                <strong style="color: #0d47a1; font-size: 15px;">Pon la ventana de la videollamada a la derecha</strong>
                                <p style="margin: 5px 0 0 0; color: #555; font-size: 14px; line-height: 1.5;">
                                    Haz clic en la ventana de la videollamada y presiona la tecla <strong>Windows</strong> y sin soltarla, presiona la <strong>flecha derecha (→)</strong>.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Resultado -->
                        <div style="background: #fff; border-radius: 8px; padding: 15px; margin-top: 15px; border-left: 4px solid #27ae60;">
                            <strong style="color: #27ae60; font-size: 14px;">✅ ¡Y listo!</strong>
                            <p style="margin: 5px 0 0 0; color: #333; font-size: 14px;">
                                Ahora verás al paciente a un lado y el sistema al otro. Podrás verlo mientras llenas su información.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Alternativa para Mac -->
                <div style="background: #f0f7ff; border-radius: 10px; padding: 18px; margin-bottom: 20px; border-left: 5px solid #0078d4;">
                    <strong style="color: #0078d4; font-size: 14px;">
                        <i class="fab fa-apple"></i> ¿Usas Mac?
                    </strong>
                    <p style="margin: 8px 0 0 0; color: #333; font-size: 14px; line-height: 1.5;">
                        No uses las flechas. En su lugar, coloca el mouse sobre el <strong>botón verde</strong> (el del círculo de arriba a la izquierda de cada ventana), mantén presionado y arrastra hacia la izquierda o derecha según quieras.
                    </p>
                </div>

                <!-- Aviso importante -->
                <div style="background: #fff3cd; border-left: 5px solid #f39c12; padding: 18px; border-radius: 8px; margin-bottom: 25px;">
                    <strong style="color: #856404; font-size: 14px;">
                        <i class="fas fa-exclamation-triangle"></i> Importante
                    </strong>
                    <p style="margin: 8px 0 0 0; color: #856404; font-size: 14px; line-height: 1.5;">
                        <strong>No cierres la ventana de la videollamada</strong> hasta terminar la consulta. 
                        Si la cierras sin querer, presiona el botón <strong>"Iniciar Videollamada"</strong> otra vez para abrirla de nuevo.
                    </p>
                </div>

                <!-- Botón de cerrar -->
                <div style="text-align: center;">
                    <button id="btnEntendido" style="background: linear-gradient(135deg, #0d47a1, #1565c0); color: white; border: none; padding: 16px 50px; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; box-shadow: 0 4px 15px rgba(13,71,161,0.3); transition: transform 0.2s;">
                        <i class="fas fa-check-circle"></i> Entendido, comenzar consulta
                    </button>
                </div>

                <!-- Checkbox -->
                <div style="text-align: center; margin-top: 18px;">
                    <label style="font-size: 13px; color: #888; cursor: pointer;">
                        <input type="checkbox" id="noMostrarDeNuevo" style="margin-right: 6px;">
                        No volver a mostrar este mensaje
                    </label>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Cerrar con el botón
        document.getElementById('btnEntendido').addEventListener('click', function() {
            const noMostrar = document.getElementById('noMostrarDeNuevo').checked;
            if (noMostrar) {
                localStorage.setItem('instrucciones_jitsi_no_mostrar', 'true');
            }
            sessionStorage.setItem('instrucciones_jitsi_mostradas', 'true');
            modal.remove();
        });
        
        // Cerrar haciendo clic fuera
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                const noMostrar = document.getElementById('noMostrarDeNuevo').checked;
                if (noMostrar) {
                    localStorage.setItem('instrucciones_jitsi_no_mostrar', 'true');
                }
                sessionStorage.setItem('instrucciones_jitsi_mostradas', 'true');
                modal.remove();
            }
        });
    }
    
    // ============================================================
    // BOTÓN: INICIAR VIDEOLLAMADA
    // ============================================================
    document.getElementById('btnAbrirVentana').addEventListener('click', function () {
        abrirVideollamada();
    });
    
    // ============================================================
    // FINALIZAR CONSULTA
    // ============================================================
    document.getElementById('btnFinalizar').addEventListener('click', async function () {
        if (!confirm('¿Está seguro que desea finalizar la consulta?')) return;
        
        try {
            const response = await fetch('{{ route('telemedicina.finalizar', $consulta) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            });
            
            if (response.ok) {
                // Intentar cerrar la ventana de Jitsi
                const ventanaJitsi = window.open('', nombreVentana);
                if (ventanaJitsi) {
                    ventanaJitsi.close();
                }
                window.location.href = '{{ route('telemedicina.index') }}';
            }
        } catch (err) {
            console.error('Error:', err);
            alert('Error al finalizar la consulta');
        }
    });
});
</script>
@endpush
