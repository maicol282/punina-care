<?php $__env->startPush('scripts'); ?>
<script>
    function confirmDelete(event, formId) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pacientes/partials/show/_scripts.blade.php ENDPATH**/ ?>