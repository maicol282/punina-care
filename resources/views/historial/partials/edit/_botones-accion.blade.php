        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('pacientes.show', $historial->paciente->id) }}" class="btn btn-secondary px-4 py-2">
                <i class="fas fa-times me-2"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary px-5 py-2">
                <i class="fas fa-save me-2"></i> Actualizar Historial
            </button>
        </div>
