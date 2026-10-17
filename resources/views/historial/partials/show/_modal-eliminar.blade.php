@push('styles')
<!-- ========== MODAL ELIMINAR ========== -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-danger text-white border-0 p-4">
                <h5 class="modal-title fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <i class="fas fa-trash-alt fa-3x text-danger opacity-50 mb-3"></i>
                <p class="fs-5 text-dark mb-1">¿Estás seguro de eliminar este historial?</p>
                <p class="text-muted small mb-0">Esta acción es irreversible y eliminará todos los registros, recetas y adjuntos asociados.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 border" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('historial.destroy', $historial->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4 shadow-sm">Sí, Eliminar Historial</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush