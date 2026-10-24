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
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">F.M.U</label>
                        <input type="date" name="fmu" class="form-control">
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
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/_gineco-obstetricos.blade.php ENDPATH**/ ?>