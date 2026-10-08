// ============================================
// AUTOCOMPLETADO ESTILO GMAIL - VELOCIDAD OPTIMIZADA
// ============================================

class GmailAutocomplete {
    constructor(inputId, campo) {
        this.input = document.getElementById(inputId);
        this.campo = campo;
        this.sugerenciaActual = '';
        this.timeoutId = null;
        this.spanSugerencia = null;
        this.ultimaBusqueda = '';
        this.ignorarProximoInput = false;
        
        if (!this.input) return;
        
        this.init();
    }
    
    init() {
        // Crear el span de sugerencia
        this.spanSugerencia = document.createElement('span');
        this.spanSugerencia.style.cssText = `
            position: absolute;
            left: 14px;
            top: 10px;
            color: #999;
            font-family: inherit;
            font-size: inherit;
            pointer-events: none;
            white-space: pre-wrap;
            display: none;
            background: transparent;
            z-index: 1;
        `;
        
        // Envolver en contenedor
        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        wrapper.style.width = '100%';
        this.input.parentNode.insertBefore(wrapper, this.input);
        wrapper.appendChild(this.input);
        wrapper.appendChild(this.spanSugerencia);
        
        // Input transparente
        this.input.style.background = 'transparent';
        this.input.style.position = 'relative';
        this.input.style.zIndex = '2';
        
        // Eventos
        this.input.addEventListener('input', () => this.onInput());
        this.input.addEventListener('keydown', (e) => this.onKeydown(e));
        this.input.addEventListener('blur', () => this.ocultarSugerencia());
        
        // Enfocar automáticamente
        setTimeout(() => this.input.focus(), 100);
    }
    
    onInput() {
        const texto = this.input.value;
        
        // Si el texto está vacío, ocultar
        if (texto.length < 2) {
            this.ocultarSugerencia();
            return;
        }
        
        // Limpiar timeout anterior
        clearTimeout(this.timeoutId);
        
        // Velocidad mejorada: 100ms (antes 300ms)
        this.timeoutId = setTimeout(() => {
            this.buscarSugerencias(texto);
        }, 100);
    }
    
    async buscarSugerencias(texto) {
        // Evitar búsquedas repetidas con el mismo texto
        if (this.ultimaBusqueda === texto) {
            return;
        }
        this.ultimaBusqueda = texto;
        
        try {
            const response = await fetch('/autocompletado/search?campo=' + encodeURIComponent(this.campo) + '&q=' + encodeURIComponent(texto));
            const data = await response.json();
            
            if (data && data.length > 0) {
                // Buscar la mejor coincidencia (que empieza exactamente con el texto)
                const mejorCoincidencia = data.find(s => 
                    s.toLowerCase().startsWith(texto.toLowerCase())
                ) || data[0];
                
                // Mostrar solo si la sugerencia es diferente al texto actual
                if (mejorCoincidencia && mejorCoincidencia.toLowerCase() !== texto.toLowerCase()) {
                    this.mostrarSugerencia(mejorCoincidencia, texto);
                    return;
                }
            }
            this.ocultarSugerencia();
        } catch (error) {
            console.error('Error:', error);
            this.ocultarSugerencia();
        }
    }
    
    mostrarSugerencia(sugerencia, textoActual) {
        if (!sugerencia || sugerencia === textoActual) {
            this.ocultarSugerencia();
            return;
        }
        
        this.sugerenciaActual = sugerencia;
        
        // Mostrar solo la parte que falta (texto en gris)
        const textoRestante = sugerencia.substring(textoActual.length);
        this.spanSugerencia.textContent = textoRestante;
        this.spanSugerencia.style.display = 'block';
        
        // Posicionar correctamente
        const textWidth = this.obtenerAnchoTexto(textoActual);
        this.spanSugerencia.style.left = (14 + textWidth) + 'px';
    }
    
    ocultarSugerencia() {
        this.spanSugerencia.style.display = 'none';
        this.sugerenciaActual = '';
    }
    
    aceptarSugerencia() {
        if (!this.sugerenciaActual) return;
        
        this.ignorarProximoInput = true;
        this.input.value = this.sugerenciaActual;
        this.ocultarSugerencia();
        
        // Guardar el término aprendido
        fetch('/autocompletado/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                campo: this.campo,
                termino: this.sugerenciaActual
            })
        }).catch(console.error);
        
        // Posicionar cursor al final
        this.input.selectionStart = this.input.selectionEnd = this.input.value.length;
        setTimeout(() => {
            this.ignorarProximoInput = false;
        }, 50);
    }
    
    onKeydown(e) {
        // TAB para aceptar sugerencia
        if (e.key === 'Tab' && this.sugerenciaActual) {
            e.preventDefault();
            this.aceptarSugerencia();
            return;
        }
        
        // ESC para cancelar sugerencia
        if (e.key === 'Escape') {
            this.ocultarSugerencia();
        }
    }
    
    obtenerAnchoTexto(texto) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        const computedStyle = window.getComputedStyle(this.input);
        ctx.font = computedStyle.fontSize + ' ' + computedStyle.fontFamily;
        return ctx.measureText(texto).width;
    }
}

// ========== INICIALIZAR ==========
document.addEventListener('DOMContentLoaded', function() {
    const campos = [
        'motivo_consulta',
        'diagnostico',
        'tratamiento',
        'medicamentos',
        'enfermedad_actual',
        'hospitalizaciones',
        'cardiovasculares',
        'pulmonales',
        'digestivos',
        'diabetes',
        'renales',
        'quirurgicos',
        'transfusiones',
        'alergias_patologicas',
        'otros_patologicos',
        'alcohol',
        'tabaquismo',
        'drogas',
        'inmunizaciones',
        'antecedentes_familiares',
        'otros_no_patologicos',
        'observaciones',
        'cabeza',
        'cuello',
        'torax',
        'abdomen',
        'extremidades',
        'neurologico',
        'estado_mental'
    ];
    
    campos.forEach(campo => {
        const input = document.getElementById(campo);
        if (input) {
            new GmailAutocomplete(campo, campo);
        }
    });
});