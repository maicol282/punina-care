<div class="card mt-3 facturacion-field" id="facturacion-card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0"><i class="fas fa-file-invoice-dollar me-2 text-primary"></i>Datos de Facturación</h6>
        <div>
            <button type="button" class="btn btn-sm btn-outline-primary" id="btnCopiarDatos">
                <i class="fas fa-copy me-1"></i> Copiar datos del paciente
            </button>
            <span class="badge bg-info ms-2">Autocompletado automático</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="ruc" class="form-label">RUC</label>
                <input type="text" class="form-control @error('ruc') is-invalid @enderror" 
                    id="ruc" name="ruc" value="{{ old('ruc') }}" 
                    placeholder="13 dígitos" maxlength="13" 
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                <small class="text-muted">Número de RUC (13 dígitos)</small>
                @error('ruc')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="razon_social" class="form-label">Razón Social / Nombres</label>
                <input type="text" class="form-control @error('razon_social') is-invalid @enderror" 
                    id="razon_social" name="razon_social" value="{{ old('razon_social') }}">
                @error('razon_social')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-12 mb-3">
                <label for="direccion_fiscal" class="form-label">Dirección Fiscal</label>
                <input type="text" class="form-control @error('direccion_fiscal') is-invalid @enderror" 
                    id="direccion_fiscal" name="direccion_fiscal" value="{{ old('direccion_fiscal') }}">
                @error('direccion_fiscal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono_facturacion" class="form-label">Teléfono Facturación</label>
                <input type="tel" class="form-control @error('telefono_facturacion') is-invalid @enderror" 
                    id="telefono_facturacion" name="telefono_facturacion" value="{{ old('telefono_facturacion') }}">
                @error('telefono_facturacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="email_facturacion" class="form-label">Email Facturación</label>
                <input type="email" class="form-control @error('email_facturacion') is-invalid @enderror" 
                    id="email_facturacion" name="email_facturacion" value="{{ old('email_facturacion') }}">
                @error('email_facturacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="obligado_contabilidad" id="obligado_contabilidad" value="1" {{ old('obligado_contabilidad') ? 'checked' : '' }}>
                    <label class="form-check-label" for="obligado_contabilidad">
                        Obligado a llevar contabilidad
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="contribuyente_especial" id="contribuyente_especial" value="1" {{ old('contribuyente_especial') ? 'checked' : '' }}>
                    <label class="form-check-label" for="contribuyente_especial">
                        Contribuyente Especial
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="agente_retencion" id="agente_retencion" value="1" {{ old('agente_retencion') ? 'checked' : '' }}>
                    <label class="form-check-label" for="agente_retencion">
                        Agente de Retención
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- INDICADOR DE AUTOCOMPLETADO -->
<div id="autocompleteIndicator" class="alert alert-info mt-3" style="display: none;">
    <i class="fas fa-sync fa-spin me-2"></i>
    <span id="autocompleteMessage">Copiando datos del paciente...</span>
</div>
