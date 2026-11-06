        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-female me-2 text-primary"></i> Antecedentes Gineco Obstétricos
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Menarquia</label>
                        <input type="text" name="menarquia" class="form-control" placeholder="Edad">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Ritmo Menstrual</label>
                        <input type="text" name="ritmo" class="form-control" placeholder="Regular/Irregular">
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="esta_embarazada" id="esta_embarazada" value="1" {{ old('esta_embarazada', $historial->esta_embarazada ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="esta_embarazada">
                                ¿La paciente está embarazada?
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">F.M.U</label>
                        <input type="date" name="fmu" id="fmu" class="form-control" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Edad Gestacional</label>
                        <input type="text" id="edad_gestacional" class="form-control" readonly placeholder="Se calcula con la FUM">
                    </div>
                    <div class="col-md-4 mb-3">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Menopausia</label>
                        <select name="menopausia" class="form-select">
                            <option value="">Seleccione</option>
                            <option value="Premenopausia">Premenopausia</option>
                            <option value="Perimenopausia">Perimenopausia</option>
                            <option value="Menopausia">Menopausia</option>
                            <option value="Postmenopausia">Postmenopausia</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">G (Gestas)</label>
                        <input type="number" name="gestas" class="form-control" placeholder="0" min="0">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">P (Partos)</label>
                        <input type="number" name="partos" class="form-control" placeholder="0" min="0">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">A (Abortos)</label>
                        <input type="number" name="abortos" class="form-control" placeholder="0" min="0">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">C (Cesáreas)</label>
                        <input type="number" name="cesareas" class="form-control" placeholder="0" min="0">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Hijos Vivos</label>
                        <input type="number" name="hijos_vivos" class="form-control" placeholder="0" min="0">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">N° Parejas Sexuales</label>
                        <input type="number" name="num_parejas_sexuales" class="form-control" placeholder="0" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Métodos Anticonceptivos</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usa_anticonceptivos" id="usa_anticonceptivos_si" value="1">
                                <label class="form-check-label" for="usa_anticonceptivos_si">Sí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usa_anticonceptivos" id="usa_anticonceptivos_no" value="0" checked>
                                <label class="form-check-label" for="usa_anticonceptivos_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">¿Cuáles?</label>
                        <input type="text" name="cuales_anticonceptivos" class="form-control">
                    </div>
                </div>
            </div>
        </div>

<script>
    function calcularEdadGestacional(fecha) {
        const egInput = document.getElementById('edad_gestacional');
        if (!egInput || !fecha) {
            if (egInput) egInput.value = '';
            return;
        }
        
        const fmu = new Date(fecha);
        const hoy = new Date();
        
        if (isNaN(fmu.getTime())) {
            egInput.value = 'Fecha inválida';
            return;
        }
        if (fmu > hoy) {
            egInput.value = 'Fecha futura inválida';
            return;
        }
        
        const diffTime = hoy - fmu;
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        const semanas = Math.floor(diffDays / 7);
        const dias = diffDays % 7;
        
        egInput.value = semanas + ' semanas y ' + dias + ' días';
    }

    // Ejecutar al cargar si ya hay una fecha (para edición)
    document.addEventListener('DOMContentLoaded', function() {
        const fmuInput = document.getElementById('fmu');
        if (fmuInput && fmuInput.value) {
            calcularEdadGestacional(fmuInput.value);
        }
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('esta_embarazada');
    const fmuInput = document.getElementById('fmu');
    const egInput = document.getElementById('edad_gestacional');
    
    if (!checkbox || !fmuInput || !egInput) return;
    
    function toggleEmbarazo() {
        if (checkbox.checked) {
            // Si hay FUM, calcular
            if (fmuInput.value) {
                calcularEdadGestacional(fmuInput.value);
            }
        } else {
            // Si no está embarazada, limpiar la edad gestacional (pero no la FUM)
            egInput.value = '';
        }
    }
    
    // Ejecutar al cargar
    toggleEmbarazo();
    
    // Escuchar cambios
    checkbox.addEventListener('change', toggleEmbarazo);
});
</script>
