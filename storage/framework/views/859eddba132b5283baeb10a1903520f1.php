<!-- Buscador Global -->
<div class="position-relative" style="max-width: 400px;">
    <div class="input-group">
        <span class="input-group-text bg-white border-end-0">
            <i class="fas fa-search text-muted"></i>
        </span>
        <input type="text" id="globalSearchInput" class="form-control border-start-0" 
               placeholder="Buscar pacientes, historiales, recetas..." 
               autocomplete="off">
        <button class="btn btn-outline-secondary" id="globalSearchClear" type="button" style="display: none;">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <!-- Resultados -->
    <div id="globalSearchResults" class="position-absolute top-100 start-0 end-0 mt-1 bg-white rounded-3 shadow-lg" 
         style="display: none; z-index: 1050; max-height: 500px; overflow-y: auto;">
        <div id="globalSearchContent"></div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('globalSearchInput');
    const searchResults = document.getElementById('globalSearchResults');
    const searchContent = document.getElementById('globalSearchContent');
    const clearBtn = document.getElementById('globalSearchClear');
    let searchTimeout;
    let currentQuery = '';
    
    // Ocultar resultados al hacer clic fuera
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.position-relative')) {
            searchResults.style.display = 'none';
        }
    });
    
    // Mostrar/ocultar botón limpiar
    searchInput.addEventListener('input', function() {
        const hasText = this.value.trim().length > 0;
        clearBtn.style.display = hasText ? 'block' : 'none';
        
        const query = this.value.trim();
        currentQuery = query;
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            searchResults.style.display = 'none';
            return;
        }
        
        searchTimeout = setTimeout(() => {
            realizarBusqueda(query);
        }, 500);
    });
    
    // Limpiar búsqueda
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        searchResults.style.display = 'none';
        searchInput.focus();
    });
    
    // Atajo de teclado Ctrl+K o Cmd+K
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
        }
        if (e.key === 'Escape') {
            searchResults.style.display = 'none';
        }
    });
    
    function realizarBusqueda(query) {
        fetch('/buscar?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                mostrarResultados(data, query);
            })
            .catch(error => {
                console.error('Error en búsqueda:', error);
                searchContent.innerHTML = `
                    <div class="p-3 text-center text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Error al buscar. Intente nuevamente.
                    </div>
                `;
                searchResults.style.display = 'block';
            });
    }
    
    function mostrarResultados(data, query) {
        const total = data.pacientes.length + data.historiales.length + data.recetas.length;
        
        if (total === 0) {
            searchContent.innerHTML = `
                <div class="p-4 text-center text-muted">
                    <i class="fas fa-search fa-2x mb-2 d-block"></i>
                    No se encontraron resultados para "<strong>${query}</strong>"
                </div>
            `;
            searchResults.style.display = 'block';
            return;
        }
        
        let html = '';
        
        // Pacientes
        if (data.pacientes.length > 0) {
            html += `
                <div class="dropdown-header px-3 py-2 bg-light fw-bold">
                    <i class="fas fa-users me-2"></i> Pacientes (${data.pacientes.length})
                </div>
            `;
            data.pacientes.forEach(item => {
                html += `
                    <a href="${item.url}" class="dropdown-item d-flex align-items-center py-2 px-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 32px; height: 32px; font-size: 12px;">
                            <i class="${item.icono}"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">${item.titulo}</div>
                            <div class="small text-muted">${item.descripcion}</div>
                        </div>
                        <span class="badge bg-primary ms-auto">Paciente</span>
                    </a>
                `;
            });
        }
        
        // Historiales
        if (data.historiales.length > 0) {
            html += `
                <div class="dropdown-divider"></div>
                <div class="dropdown-header px-3 py-2 bg-light fw-bold">
                    <i class="fas fa-notes-medical me-2"></i> Historiales (${data.historiales.length})
                </div>
            `;
            data.historiales.forEach(item => {
                html += `
                    <a href="${item.url}" class="dropdown-item d-flex align-items-center py-2 px-3">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 32px; height: 32px; font-size: 12px;">
                            <i class="${item.icono}"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">${item.titulo}</div>
                            <div class="small text-muted">${item.descripcion}</div>
                        </div>
                        <span class="badge bg-success ms-auto">Historial</span>
                    </a>
                `;
            });
        }
        
        // Recetas
        if (data.recetas.length > 0) {
            html += `
                <div class="dropdown-divider"></div>
                <div class="dropdown-header px-3 py-2 bg-light fw-bold">
                    <i class="fas fa-prescription-bottle me-2"></i> Recetas (${data.recetas.length})
                </div>
            `;
            data.recetas.forEach(item => {
                html += `
                    <a href="${item.url}" class="dropdown-item d-flex align-items-center py-2 px-3">
                        <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 32px; height: 32px; font-size: 12px;">
                            <i class="${item.icono}"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">${item.titulo}</div>
                            <div class="small text-muted">${item.descripcion}</div>
                        </div>
                        <span class="badge bg-warning text-dark ms-auto">Receta</span>
                    </a>
                `;
            });
        }
        
        searchContent.innerHTML = html;
        searchResults.style.display = 'block';
    }
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/components/buscador-global.blade.php ENDPATH**/ ?>