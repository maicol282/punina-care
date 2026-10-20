@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ========== CALCULAR EDAD ==========
    function calcularEdad(fechaNacimiento) {
        if (!fechaNacimiento) return '';
        let fecha = new Date(fechaNacimiento);
        let hoy = new Date();
        if (isNaN(fecha.getTime())) return '';
        let edad = hoy.getFullYear() - fecha.getFullYear();
        let mes = hoy.getMonth() - fecha.getMonth();
        if (mes < 0 || (mes === 0 && hoy.getDate() < fecha.getDate())) {
            edad--;
        }
        return edad >= 0 ? edad : '';
    }

    // ========== VARIABLES PARA DEBOUNCE ==========
    let timeoutId = null;
    const DEBOUNCE_DELAY = 300;

    // ========== FUNCIÓN PRINCIPAL DE AUTOCOMPLETADO ==========
    function autocompletarFacturacion() {
        const nombre = document.getElementById('nombre')?.value?.trim() || '';
        const apellido = document.getElementById('apellido')?.value?.trim() || '';
        const telefono = document.getElementById('telefono')?.value?.trim() || '';
        const email = document.getElementById('email')?.value?.trim() || '';
        const cedula = document.getElementById('cedula')?.value?.trim() || '';
        const direccion = document.getElementById('direccion')?.value?.trim() || '';
        const ciudad = document.getElementById('ciudad')?.value?.trim() || '';
        const provincia = document.getElementById('provincia')?.value?.trim() || '';
        const pais = document.getElementById('pais')?.value?.trim() || '';

        let datosActualizados = false;

        const rucInput = document.getElementById('ruc');
        if (cedula && rucInput) {
            if (rucInput.value.length === 0 || cedula.length > rucInput.value.length) {
                rucInput.value = cedula;
                datosActualizados = true;
            }
        }

        const razonSocialInput = document.getElementById('razon_social');
        if ((nombre || apellido) && razonSocialInput) {
            const nombreCompleto = [nombre, apellido].filter(Boolean).join(' ');
            if (nombreCompleto.length > razonSocialInput.value.length || razonSocialInput.value.length === 0) {
                razonSocialInput.value = nombreCompleto;
                datosActualizados = true;
            }
        }

        const direccionFiscalInput = document.getElementById('direccion_fiscal');
        if (direccionFiscalInput) {
            let direccionCompleta = '';
            if (direccion) direccionCompleta += direccion;
            if (ciudad) { if (direccionCompleta) direccionCompleta += ', '; direccionCompleta += ciudad; }
            if (provincia) { if (direccionCompleta) direccionCompleta += ', '; direccionCompleta += provincia; }
            if (pais) { if (direccionCompleta) direccionCompleta += ', '; direccionCompleta += pais; }
            if (direccionCompleta.length > 5) {
                if (direccionFiscalInput.value.length === 0 || direccionCompleta.length > direccionFiscalInput.value.length) {
                    direccionFiscalInput.value = direccionCompleta;
                    datosActualizados = true;
                }
            }
        }

        const telefonoFacturacionInput = document.getElementById('telefono_facturacion');
        if (telefono && telefonoFacturacionInput) {
            if (telefonoFacturacionInput.value.length === 0 || telefono.length > telefonoFacturacionInput.value.length) {
                telefonoFacturacionInput.value = telefono;
                datosActualizados = true;
            }
        }

        const emailFacturacionInput = document.getElementById('email_facturacion');
        if (email && emailFacturacionInput) {
            if (email.includes('@') && email.includes('.')) {
                if (emailFacturacionInput.value.length === 0 || email.length > emailFacturacionInput.value.length) {
                    emailFacturacionInput.value = email;
                    datosActualizados = true;
                }
            }
        }

        if (datosActualizados) {
            mostrarIndicador('✅ Datos de facturación actualizados');
        }
        return datosActualizados;
    }

    function mostrarIndicador(mensaje) {
        const indicator = document.getElementById('autocompleteIndicator');
        const message = document.getElementById('autocompleteMessage');
        if (indicator && message) {
            indicator.style.display = 'block';
            message.textContent = mensaje;
            clearTimeout(indicator._timeout);
            indicator._timeout = setTimeout(() => { indicator.style.display = 'none'; }, 2500);
        }
    }

    function autocompletarConDebounce() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() { autocompletarFacturacion(); }, DEBOUNCE_DELAY);
    }

    function copiarDatosManual() {
        const camposFacturacion = ['ruc', 'razon_social', 'direccion_fiscal', 'telefono_facturacion', 'email_facturacion'];
        camposFacturacion.forEach(function(id) {
            const campo = document.getElementById(id);
            if (campo) campo.value = '';
        });
        const actualizado = autocompletarFacturacion();
        if (actualizado) { mostrarIndicador('✅ Datos copiados manualmente'); }
        else { mostrarIndicador('ℹ Complete más datos del paciente'); }
    }

    function configurarEventos() {
        const campos = ['nombre', 'apellido', 'telefono', 'email', 'cedula', 'direccion', 'ciudad', 'provincia', 'pais'];
        campos.forEach(function(id) {
            const campo = document.getElementById(id);
            if (campo) {
                campo.addEventListener('input', function() { autocompletarConDebounce(); });
                campo.addEventListener('blur', function() { autocompletarFacturacion(); });
            }
        });
    }

    const fechaInput = document.getElementById('fecha_nacimiento');
    const edadInput = document.getElementById('edad');
    if (fechaInput && edadInput) {
        if (fechaInput.value) edadInput.value = calcularEdad(fechaInput.value);
        fechaInput.addEventListener('change', function() { edadInput.value = calcularEdad(this.value); });
        fechaInput.addEventListener('input', function() { edadInput.value = calcularEdad(this.value); });
    }

    configurarEventos();
    const btnCopiar = document.getElementById('btnCopiarDatos');
    if (btnCopiar) btnCopiar.addEventListener('click', copiarDatosManual);

    setTimeout(function() { autocompletarFacturacion(); }, 500);
});

function verificarEdadParaFacturacion() {
    const fechaNacimiento = document.getElementById("fecha_nacimiento")?.value;
    const facturacionCard = document.getElementById("facturacion-card");
    if (!fechaNacimiento || !facturacionCard) return;
    const hoy = new Date();
    const nacimiento = new Date(fechaNacimiento);
    let edad = hoy.getFullYear() - nacimiento.getFullYear();
    const mes = hoy.getMonth() - nacimiento.getMonth();
    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) { edad--; }
    
    if (edad < 18) {
        facturacionCard.style.display = "none";
        const campos = ["ruc", "razon_social", "direccion_fiscal", "telefono_facturacion", "email_facturacion"];
        campos.forEach(id => { const c = document.getElementById(id); if (c) { c.disabled = true; c.value = ""; c.required = false; } });
        ["obligado_contabilidad", "contribuyente_especial", "agente_retencion"].forEach(id => { const c = document.getElementById(id); if (c) { c.checked = false; c.disabled = true; } });
    } else {
        facturacionCard.style.display = "";
        const campos = ["ruc", "razon_social", "direccion_fiscal", "telefono_facturacion", "email_facturacion"];
        campos.forEach(id => { const c = document.getElementById(id); if (c) { c.disabled = false; } });
        ["obligado_contabilidad", "contribuyente_especial", "agente_retencion"].forEach(id => { const c = document.getElementById(id); if (c) { c.disabled = false; } });
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const fechaInput = document.getElementById("fecha_nacimiento");
    if (fechaInput) {
        fechaInput.addEventListener("change", verificarEdadParaFacturacion);
        fechaInput.addEventListener("input", verificarEdadParaFacturacion);
        if (fechaInput.value) verificarEdadParaFacturacion();
    }
});
</script>
@endpush
