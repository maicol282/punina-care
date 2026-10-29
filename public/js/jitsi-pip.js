function abrirJitsiEnPiP(salaNombre, nombrePaciente) {
    // 1. Verificar si el navegador soporta Document PiP
    if (!('documentPictureInPicture' in window)) {
        alert('Tu navegador no soporta la ventana flotante (Picture-in-Picture). Por favor, usa Google Chrome o Microsoft Edge.');
        return;
    }

    // 2. Generar la URL de Jitsi
    const salaLimpia = salaNombre.replace(/[^a-zA-Z0-9\-]/g, '');
    const url = "https://meet.jit.si/" + salaLimpia + "#userInfo.displayName=%22Dr.%20" + encodeURIComponent(nombrePaciente) + "%22&config.prejoinPageEnabled=false";

    // 3. Crear un iframe temporal (si no existe)
    let iframe = document.getElementById('jitsi-pip-iframe');
    if (!iframe) {
        iframe = document.createElement('iframe');
        iframe.id = 'jitsi-pip-iframe';
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.style.border = 'none';
        iframe.allow = "camera; microphone; fullscreen; display-capture; autoplay;";
        iframe.src = url;
        document.body.appendChild(iframe); // Lo agregamos al body temporalmente
    } else {
        iframe.src = url;
    }

    // 4. Abrir la ventana PiP y mover el iframe
    window.documentPictureInPicture.requestWindow({
        width: 400,
        height: 300,
    }).then((pipWindow) => {
        // Mover el iframe a la ventana PiP
        pipWindow.document.body.style.margin = '0';
        pipWindow.document.body.style.overflow = 'hidden';
        pipWindow.document.body.appendChild(iframe);
        
        // Opcional: Copiar estilos del documento principal a la ventana PiP
        [...document.styleSheets].forEach((styleSheet) => {
            try {
                const cssRules = [...styleSheet.cssRules].map((rule) => rule.cssText).join('');
                const style = document.createElement('style');
                style.textContent = cssRules;
                pipWindow.document.head.appendChild(style);
            } catch (e) {
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.type = styleSheet.type;
                link.media = styleSheet.media;
                link.href = styleSheet.href;
                pipWindow.document.head.appendChild(link);
            }
        });

        // 5. Manejar el cierre de la ventana PiP (devolver el iframe al body)
        pipWindow.addEventListener('pagehide', () => {
            if (iframe && iframe.parentNode === pipWindow.document.body) {
                document.body.appendChild(iframe);
                iframe.style.display = 'none'; // Ocultarlo de nuevo
            }
        });
    }).catch((error) => {
        console.error('Error al abrir PiP:', error);
        alert('No se pudo abrir la ventana flotante. Asegúrate de que la página esté en HTTPS o en localhost.');
    });
}
