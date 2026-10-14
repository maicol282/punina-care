<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Videollamada - <?php echo e($consulta->paciente->nombre_completo); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #1a1a1a; overflow: hidden; font-family: sans-serif; }
        
        .barra {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #0d47a1, #1565c0);
            color: white;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            font-size: 13px;
            height: 40px;
        }
        
        .barra-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .indicador {
            width: 8px;
            height: 8px;
            background: #27ae60;
            border-radius: 50%;
            animation: pulso 1.5s infinite;
        }
        
        @keyframes pulso {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        
        .btn-cerrar {
            background: #c0392b;
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .btn-cerrar:hover {
            background: #a93226;
        }
        
        #jitsiContainer { 
            width: 100vw; 
            height: calc(100vh - 40px);
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="barra">
        <div class="barra-info">
            <span class="indicador"></span>
            <span>
                <strong>En consulta con:</strong> <?php echo e($consulta->paciente->nombre_completo); ?>

            </span>
        </div>
        <div>
            <span style="margin-right: 10px; font-size: 11px;">
                Inicio: <?php echo e($consulta->fecha_inicio_real ? $consulta->fecha_inicio_real->format('H:i') : 'Pendiente'); ?>

            </span>
            <button class="btn-cerrar" onclick="window.close()">Cerrar</button>
        </div>
    </div>
    
    <div id="jitsiContainer"></div>
    
    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        const api = new JitsiMeetExternalAPI('meet.jit.si', {
            roomName: '<?php echo e($consulta->sala_nombre); ?>',
            parentNode: document.querySelector('#jitsiContainer'),
            width: '100%',
            height: '100%',
            userInfo: {
                displayName: '<?php echo e(auth()->user()->name); ?>',
                email: '<?php echo e(auth()->user()->email); ?>'
            },
            configOverwrite: {
                startWithAudioMuted: false,
                startWithVideoMuted: false,
                prejoinPageEnabled: false,
                disableDeepLinking: true,
            }
        });
        
        // Al cerrar la ventana, desconectar
        window.addEventListener('beforeunload', function() {
            try { api.dispose(); } catch(e) {}
        });
    </script>
</body>
</html>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/telemedicina/popup.blade.php ENDPATH**/ ?>