// ============================================
// MEJORAS DE DISEÑO - SISTEMA DE HISTORIAL CLÍNICO
// ============================================

// 1. BARRA DE PROGRESO
class ProgressBar {
    constructor() {
        this.bar = null;
        this.create();
        this.bindEvents();
    }

    create() {
        this.bar = document.createElement('div');
        this.bar.className = 'progress-bar-top';
        this.bar.style.transform = 'scaleX(0)';
        document.body.appendChild(this.bar);
    }

    start() {
        this.bar.style.transform = 'scaleX(0.3)';
        this.bar.style.display = 'block';
    }

    set(percent) {
        this.bar.style.transform = `scaleX(${percent / 100})`;
    }

    complete() {
        this.bar.style.transform = 'scaleX(1)';
        setTimeout(() => {
            this.bar.style.display = 'none';
            this.bar.style.transform = 'scaleX(0)';
        }, 500);
    }

    bindEvents() {
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', () => this.start());
        });

        // Interceptar fetch y axios
        const originalFetch = window.fetch;
        window.fetch = async (...args) => {
            this.start();
            try {
                const response = await originalFetch(...args);
                this.complete();
                return response;
            } catch (error) {
                this.complete();
                throw error;
            }
        };
    }
}

// 2. NOTIFICACIONES TOAST
class ToastManager {
    constructor() {
        this.container = null;
        this.create();
    }

    create() {
        this.container = document.createElement('div');
        this.container.className = 'toast-notification';
        document.body.appendChild(this.container);
    }

    show(message, type = 'success', duration = 3000) {
        const toast = document.createElement('div');
        toast.className = 'toast-custom';
        
        const bgColor = type === 'success' ? '#2ecc71' : type === 'error' ? '#e74c3c' : type === 'warning' ? '#f39c12' : '#3498db';
        
        toast.innerHTML = `
            <div style="background: ${bgColor}; color: white; padding: 12px 16px; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                <span style="flex: 1;">${message}</span>
                <button onclick="this.closest('.toast-custom').remove()" style="background: none; border: none; color: white; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        this.container.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, duration);
    }
}

// 3. SIDEBAR COLLAPSABLE
class SidebarManager {
    constructor() {
        this.sidebar = document.querySelector('.sidebar');
        this.mainContent = document.querySelector('.main-content');
        this.createButton();
        this.loadState();
    }

    createButton() {
        const button = document.createElement('button');
        button.className = 'btn btn-light rounded-circle position-fixed';
        button.style.cssText = 'bottom: 20px; left: 20px; z-index: 1000; width: 40px; height: 40px;';
        button.innerHTML = '<i class="fas fa-bars"></i>';
        button.onclick = () => this.toggle();
        document.body.appendChild(button);
    }

    toggle() {
        this.sidebar.classList.toggle('collapsed');
        this.mainContent.classList.toggle('expanded');
        localStorage.setItem('sidebarCollapsed', this.sidebar.classList.contains('collapsed'));
    }

    loadState() {
        const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (collapsed) {
            this.sidebar.classList.add('collapsed');
            this.mainContent.classList.add('expanded');
        }
    }
}

// 4. TEMA OSCURO
class ThemeManager {
    constructor() {
        this.loadTheme();
        this.createButton();
    }

    createButton() {
        const button = document.createElement('button');
        button.className = 'btn btn-light rounded-circle position-fixed';
        button.style.cssText = 'bottom: 80px; left: 20px; z-index: 1000; width: 40px; height: 40px;';
        button.innerHTML = '<i class="fas fa-moon"></i>';
        button.onclick = () => this.toggle();
        document.body.appendChild(button);
    }

    toggle() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDark);
        const icon = document.querySelector('.position-fixed .fa-moon, .position-fixed .fa-sun');
        if (icon) {
            icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
        }
    }

    loadTheme() {
        const isDark = localStorage.getItem('darkMode') === 'true';
        if (isDark) {
            document.body.classList.add('dark-mode');
        }
    }
}

// 5. VALIDACIÓN EN TIEMPO REAL
class FormValidator {
    constructor() {
        this.bindValidation();
    }

    bindValidation() {
        document.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('input', () => this.validateField(field));
            field.addEventListener('blur', () => this.validateField(field));
        });
    }

    validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let message = '';

        if (field.required && !value) {
            isValid = false;
            message = 'Este campo es obligatorio';
        }

        if (field.type === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            isValid = false;
            message = 'Ingrese un email válido';
        }

        if (field.type === 'tel' && value && !/^[0-9+\-\s()]{7,15}$/.test(value)) {
            isValid = false;
            message = 'Ingrese un teléfono válido';
        }

        // Mostrar feedback
        let feedback = field.parentElement.querySelector('.validation-feedback');
        if (!feedback) {
            feedback = document.createElement('div');
            feedback.className = 'validation-feedback';
            field.parentElement.appendChild(feedback);
        }

        if (!isValid) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            feedback.textContent = message;
            feedback.className = 'validation-feedback invalid';
        } else if (value) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
            feedback.textContent = '✓ Correcto';
            feedback.className = 'validation-feedback valid';
        } else {
            field.classList.remove('is-valid', 'is-invalid');
            feedback.textContent = '';
        }
    }
}

// 6. BUSCADOR GLOBAL
class GlobalSearch {
    constructor() {
        this.create();
        this.bindEvents();
    }

    create() {
        const container = document.createElement('div');
        container.className = 'global-search position-fixed';
        container.style.cssText = 'top: 20px; right: 20px; z-index: 1000; width: 300px;';
        container.innerHTML = `
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" id="globalSearchInput" placeholder="Buscar... (Ctrl+K)">
                <button class="btn btn-outline-secondary" id="globalSearchClose"><i class="fas fa-times"></i></button>
            </div>
            <div class="global-search-results" id="globalSearchResults"></div>
        `;
        document.body.appendChild(container);
        
        // Shortcut hint
        const hint = document.createElement('div');
        hint.className = 'global-search-shortcut';
        hint.innerHTML = 'Press <kbd>Ctrl</kbd> + <kbd>K</kbd> to search';
        document.body.appendChild(hint);
    }

    bindEvents() {
        const input = document.getElementById('globalSearchInput');
        const results = document.getElementById('globalSearchResults');
        
        input.addEventListener('keyup', async (e) => {
            if (e.key === 'Escape') {
                results.style.display = 'none';
                input.value = '';
                return;
            }
            
            const query = e.target.value.trim();
            if (query.length < 2) {
                results.style.display = 'none';
                return;
            }
            
            // Buscar pacientes
            const response = await fetch(`/pacientes/search?q=${encodeURIComponent(query)}`);
            const pacientes = await response.json();
            
            if (pacientes.length > 0) {
                let html = '<div class="list-group">';
                pacientes.forEach(p => {
                    html += `
                        <a href="/pacientes/${p.id}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>${p.nombre_completo}</strong>
                                    <br>
                                    <small>${p.telefono || ''} | ${p.email || ''}</small>
                                </div>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                    `;
                });
                html += '</div>';
                results.innerHTML = html;
                results.style.display = 'block';
            } else {
                results.innerHTML = '<div class="list-group-item text-muted text-center">No se encontraron resultados</div>';
                results.style.display = 'block';
            }
        });
        
        // Cerrar resultados al hacer clic fuera
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.global-search')) {
                results.style.display = 'none';
            }
        });
        
        // Atajo de teclado Ctrl+K
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                input.focus();
            }
        });
    }
}

// 7. FILTROS AVANZADOS
class AdvancedFilters {
    constructor() {
        this.filters = {};
        this.createPanel();
    }

    createPanel() {
        const panel = document.createElement('div');
        panel.className = 'filter-panel';
        panel.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filtros Avanzados</h6>
                <button class="btn btn-sm btn-outline-secondary" id="clearAllFilters">
                    <i class="fas fa-times me-1"></i>Limpiar
                </button>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <select class="form-select" id="filterGenero">
                        <option value="">Todos los géneros</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="filterFechaInicio" placeholder="Fecha inicio">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="filterFechaFin" placeholder="Fecha fin">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="filterDoctor">
                        <option value="">Todos los médicos</option>
                    </select>
                </div>
            </div>
            <div id="activeFilters" class="mt-3"></div>
        `;
        
        const mainContent = document.querySelector('.main-content');
        if (mainContent && mainContent.firstChild) {
            mainContent.insertBefore(panel, mainContent.firstChild);
        }
        
        this.bindEvents();
    }

    bindEvents() {
        const filters = ['filterGenero', 'filterFechaInicio', 'filterFechaFin', 'filterDoctor'];
        filters.forEach(id => {
            document.getElementById(id)?.addEventListener('change', () => this.applyFilters());
        });
        
        document.getElementById('clearAllFilters')?.addEventListener('click', () => this.clearFilters());
    }

    applyFilters() {
        this.filters = {
            genero: document.getElementById('filterGenero')?.value,
            fechaInicio: document.getElementById('filterFechaInicio')?.value,
            fechaFin: document.getElementById('filterFechaFin')?.value,
            doctor: document.getElementById('filterDoctor')?.value
        };
        
        this.updateActiveFilters();
        this.filterTable();
    }

    updateActiveFilters() {
        const container = document.getElementById('activeFilters');
        if (!container) return;
        
        container.innerHTML = '';
        Object.entries(this.filters).forEach(([key, value]) => {
            if (value) {
                const badge = document.createElement('span');
                badge.className = 'filter-badge';
                badge.innerHTML = `${key}: ${value} <span class="remove-filter" data-filter="${key}">×</span>`;
                container.appendChild(badge);
            }
        });
    }

    filterTable() {
        // Implementar filtrado según la página actual
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            let show = true;
            if (this.filters.genero) {
                const generoCell = row.querySelector('td:nth-child(4)');
                if (generoCell && !generoCell.textContent.includes(this.filters.genero)) {
                    show = false;
                }
            }
            row.style.display = show ? '' : 'none';
        });
    }

    clearFilters() {
        this.filters = {};
        ['filterGenero', 'filterFechaInicio', 'filterFechaFin', 'filterDoctor'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = '';
        });
        this.updateActiveFilters();
        this.filterTable();
    }
}

// 8. ESTADÍSTICAS ANIMADAS
class AnimatedStats {
    constructor() {
        this.animateNumbers();
    }

    animateNumbers() {
        document.querySelectorAll('.stat-number').forEach(el => {
            const target = parseInt(el.textContent);
            if (!isNaN(target)) {
                let current = 0;
                const increment = target / 30;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        el.textContent = target;
                        clearInterval(timer);
                    } else {
                        el.textContent = Math.floor(current);
                    }
                }, 20);
            }
        });
    }
}

// 9. LOADING EN BOTONES
class ButtonLoading {
    constructor() {
        this.bindButtons();
    }

    bindButtons() {
        document.querySelectorAll('button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (btn.closest('form')?.checkValidity()) {
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<span class="loading-spinner me-2"></span> Cargando...';
                    btn.classList.add('btn-loading');
                    
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.classList.remove('btn-loading');
                    }, 3000);
                }
            });
        });
    }
}

// 10. TOOLTIPS AUTOMÁTICOS
class Tooltips {
    constructor() {
        this.addTooltips();
    }

    addTooltips() {
        document.querySelectorAll('[title]').forEach(el => {
            const title = el.getAttribute('title');
            if (title) {
                el.setAttribute('data-tooltip', title);
                el.removeAttribute('title');
            }
        });
    }
}

// Inicializar todas las mejoras
document.addEventListener('DOMContentLoaded', () => {
    window.progressBar = new ProgressBar();
    window.toastManager = new ToastManager();
    window.sidebarManager = new SidebarManager();
    window.themeManager = new ThemeManager();
    window.formValidator = new FormValidator();
    window.globalSearch = new GlobalSearch();
    window.advancedFilters = new AdvancedFilters();
    window.animatedStats = new AnimatedStats();
    window.buttonLoading = new ButtonLoading();
    window.tooltips = new Tooltips();
    
    // Reemplazar alertas normales con toasts
    window.alert = (message) => window.toastManager.show(message, 'warning');
    
    // Mensaje de bienvenida
    setTimeout(() => {
        window.toastManager.show('¡Bienvenido al sistema de historial clínico!', 'success');
    }, 500);
});