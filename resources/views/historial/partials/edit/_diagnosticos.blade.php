<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3">
        <i class="fas fa-clinic-medical me-2 text-primary"></i> Diagnósticos
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="diagnosticos-table">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 35%">Diagnóstico</th>
                        <th style="width: 30%">Código CIE-10</th>
                        <th style="width: 20%">Tipo</th>
                        <th style="width: 10%">Acción</th>
                    </tr>
                </thead>
                <tbody id="diagnosticos-body">
                    @forelse($historial->diagnosticos as $index => $diag)
                        <tr class="diagnostico-row">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <textarea name="diagnosticos[{{ $index }}][descripcion]" class="form-control diagnostico-autocomplete" rows="2" placeholder="Escriba el diagnóstico..." data-index="{{ $index }}">{{ old("diagnosticos.{$index}.descripcion", $diag->descripcion) }}</textarea>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="diagnosticos[{{ $index }}][cie10]" id="cie10_{{ $index }}" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" value="{{ old("diagnosticos.{$index}.cie10", $diag->cie10_code) }}" data-index="{{ $index }}">
                                    <button type="button" class="btn btn-outline-secondary clear-cie10-row" data-index="{{ $index }}" title="Limpiar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div id="cie10-results-{{ $index }}" class="cie10-results" style="display: none;"></div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[{{ $index }}][tipo]" value="PRE" {{ old("diagnosticos.{$index}.tipo", $diag->tipo) == 'PRE' ? 'checked' : '' }}>
                                        <label class="form-check-label">PRE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[{{ $index }}][tipo]" value="DEF" {{ old("diagnosticos.{$index}.tipo", $diag->tipo) == 'DEF' ? 'checked' : '' }}>
                                        <label class="form-check-label">DEF</label>
                                    </div>
                                </div>
                                <input type="hidden" name="diagnosticos[{{ $index }}][id]" value="{{ $diag->id }}">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm eliminar-diagnostico" {{ $historial->diagnosticos->count() <= 1 ? 'disabled' : '' }}>
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="diagnostico-row">
                            <td class="text-center">1</td>
                            <td>
                                <textarea name="diagnosticos[0][descripcion]" class="form-control diagnostico-autocomplete" rows="1" placeholder="Escriba el diagnóstico..." data-index="0"></textarea>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="diagnosticos[0][cie10]" id="cie10_0" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" data-index="0">
                                    <button type="button" class="btn btn-outline-secondary clear-cie10-row" data-index="0" title="Limpiar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div id="cie10-results-0" class="cie10-results" style="display: none;"></div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[0][tipo]" value="PRE" checked>
                                        <label class="form-check-label">PRE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[0][tipo]" value="DEF">
                                        <label class="form-check-label">DEF</label>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm eliminar-diagnostico" disabled>
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary btn-sm mt-2" id="agregar-diagnostico">
            <i class="fas fa-plus me-1"></i> Agregar Diagnóstico
        </button>
        <small class="text-muted d-block mt-2">PRE = Presuntivo | DEF = Definitivo</small>
    </div>
</div>
       
