// ============================================
// FUNCIONALIDADES ADICIONALES
// ============================================

// Botón para colapsar sidebar (menú hamburguesa)
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (!sidebar || !mainContent) return;
  
    
    // Cargar estado guardado
    const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (collapsed) {
        sidebar.classList.add('collapsed');
        mainContent.classList.add('expanded');
    }
});

// Función para calcular edad (si se usa en formularios)
function calcularEdad(fechaNacimiento) {
    if (!fechaNacimiento) return '';
    
    const fecha = new Date(fechaNacimiento);
    const hoy = new Date();
    
    if (isNaN(fecha.getTime())) return '';
    
    let edad = hoy.getFullYear() - fecha.getFullYear();
    const mes = hoy.getMonth() - fecha.getMonth();
    
    if (mes < 0 || (mes === 0 && hoy.getDate() < fecha.getDate())) {
        edad--;
    }
    
    return edad >= 0 ? edad : '';
}

// Configurar cálculo de edad en tiempo real (para pacientes)
document.addEventListener('DOMContentLoaded', function() {
    const fechaInput = document.getElementById('fecha_nacimiento');
    const edadInput = document.getElementById('edad');
    
    if (fechaInput && edadInput) {
        if (fechaInput.value) {
            edadInput.value = calcularEdad(fechaInput.value);
        }
        
        fechaInput.addEventListener('change', function() {
            edadInput.value = calcularEdad(this.value);
        });
        
        fechaInput.addEventListener('input', function() {
            edadInput.value = calcularEdad(this.value);
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {

    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (sidebar && mainContent) {
        
        // Buscar o crear el botón
        let toggleBtn = document.getElementById('sidebarToggleBtn');
        
        if (!toggleBtn) {
            toggleBtn = document.createElement('button');
            toggleBtn.id = 'sidebarToggleBtn';
            toggleBtn.className = 'sidebar-toggle-btn';
            toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
            document.body.appendChild(toggleBtn);
        }
        
        // Cargar estado guardado
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
        }
        
        // Evento click
        toggleBtn.onclick = function(e) {
            e.preventDefault();
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        };
    }

    // Barra de progreso
    window.showProgressBar = function() {
        let container = document.getElementById('progressBarContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'progressBarContainer';
            container.className = 'progress-bar-container';
            container.innerHTML = '<div class="progress-bar-fill"></div>';
            document.body.appendChild(container);
        }
        container.style.display = 'block';
        const fill = container.querySelector('.progress-bar-fill');
        let progress = 0;
        const interval = setInterval(() => {
            progress += 5;
            fill.style.width = Math.min(progress, 90) + '%';
            if (progress >= 90) clearInterval(interval);
        }, 50);
        return { container, fill, interval };
    };
    
    window.hideProgressBar = function() {
        const container = document.getElementById('progressBarContainer');
        if (container) {
            container.style.display = 'none';
            const fill = container.querySelector('.progress-bar-fill');
            if (fill) fill.style.width = '0%';
        }
    };

    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', () => window.showProgressBar());
    });
});