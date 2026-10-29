function abrirJitsiEnPiP(salaNombre, nombrePaciente) {
    if (!('documentPictureInPicture' in window)) {
        alert('Tu navegador no soporta la ventana flotante. Usa Chrome o Edge.');
        return;
    }

    const salaLimpia = salaNombre.replace(/[^a-zA-Z0-9\-]/g, '');
    const url = "https://meet.centromedicopuninacare.tech/" + salaLimpia + "#userInfo.displayName=%22Dr.%20" + encodeURIComponent(nombrePaciente) + "%22&config.prejoinPageEnabled=false";

    let iframe = document.getElementById('jitsi-pip-iframe');
    if (!iframe) {
        iframe = document.createElement('iframe');
        iframe.id = 'jitsi-pip-iframe';
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.style.border = 'none';
        iframe.allow = "camera; microphone; fullscreen; display-capture; autoplay;";
        iframe.src = url;
        document.body.appendChild(iframe);
    } else {
        iframe.src = url;
    }

    // Abrir ventana PiP más grande
    window.documentPictureInPicture.requestWindow({
        width: 650,  // Más ancho
        height: 450, // Más alto
    }).then((pipWindow) => {
        pipWindow.document.body.style.margin = '0';
        pipWindow.document.body.style.overflow = 'hidden';
        pipWindow.document.body.appendChild(iframe);

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

        pipWindow.addEventListener('pagehide', () => {
            if (iframe && iframe.parentNode === pipWindow.document.body) {
                document.body.appendChild(iframe);
                iframe.style.display = 'none';
            }
        });
    }).catch((error) => {
        console.error('Error al abrir PiP:', error);
        alert('No se pudo abrir la ventana flotante. Asegúrate de estar en HTTPS o localhost.');
    });
}
