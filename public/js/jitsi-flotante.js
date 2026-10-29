// Hacer la ventana arrastrable
function hacerArrastrable(elemento, header) {
    let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    header.onmousedown = iniciarArrastre;

    function iniciarArrastre(e) {
        e = e || window.event;
        e.preventDefault();
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = detenerArrastre;
        document.onmousemove = arrastrar;
    }

    function arrastrar(e) {
        e = e || window.event;
        e.preventDefault();
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        elemento.style.top = (elemento.offsetTop - pos2) + "px";
        elemento.style.left = (elemento.offsetLeft - pos1) + "px";
        elemento.style.bottom = "auto";
        elemento.style.right = "auto";
    }

    function detenerArrastre() {
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

// Abrir teleconsulta
function iniciarTeleconsulta(nombrePaciente, salaNombre) {
    const salaLimpia = salaNombre.replace(/[^a-zA-Z0-9\-]/g, '');
    const url = "https://meet.jit.si/" + salaLimpia + "#userInfo.displayName=%22Dr.%20" + encodeURIComponent(nombrePaciente) + "%22&config.prejoinPageEnabled=false";
    
    const iframe = document.getElementById('jitsi-iframe');
    if (iframe) {
        iframe.src = url;
    }
    document.getElementById('teleconsulta-flotante').style.display = 'block';
    document.getElementById('btn-abrir-teleconsulta').style.display = 'none';
    sessionStorage.setItem('teleconsulta_activa', JSON.stringify({ nombre: nombrePaciente, sala: salaLimpia }));
}

// Cerrar teleconsulta
function cerrarTeleconsulta() {
    const iframe = document.getElementById('jitsi-iframe');
    if (iframe) iframe.src = '';
    sessionStorage.removeItem('teleconsulta_activa');
    document.getElementById('teleconsulta-flotante').style.display = 'none';
    document.getElementById('btn-abrir-teleconsulta').style.display = 'block';
}

// Función que hace el AJAX y abre el iframe
function iniciarConsultaRemota(consultaId, pacienteNombre, salaNombre) {
    fetch(`/telemedicina/${consultaId}/iniciar-sesion`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        iniciarTeleconsulta(pacienteNombre, salaNombre);
    })
    .catch(error => {
        console.error('Error:', error);
        iniciarTeleconsulta(pacienteNombre, salaNombre);
    });
}

// Configurar al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const ventana = document.getElementById('teleconsulta-flotante');
    const header = document.getElementById('teleconsulta-header');
    if (ventana && header) {
        hacerArrastrable(ventana, header);
    }

    // Restaurar si había una llamada activa
    setTimeout(function() {
        const activa = sessionStorage.getItem('teleconsulta_activa');
        if (activa) {
            try {
                const data = JSON.parse(activa);
                iniciarTeleconsulta(data.nombre, data.sala);
            } catch (e) {
                console.error("Error al restaurar teleconsulta:", e);
            }
        }
    }, 1000);
});
