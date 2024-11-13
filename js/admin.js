function openCursoForm(curso_id = null) {
    // Mostrar el modal del formulario de curso
    const modal = document.getElementById('cursoFormModal');
    modal.style.display = 'block';

    if (curso_id) {
        // Cargar datos del curso para edición usando AJAX (opcional)
        document.getElementById('modalTitle').textContent = 'Editar Curso';
        document.getElementById('curso_id').value = curso_id;
        // Aquí puedes usar fetch o XMLHttpRequest para obtener datos del curso y llenar el formulario
    } else {
        // Limpiar el formulario para agregar un nuevo curso
        document.getElementById('modalTitle').textContent = 'Agregar Curso';
        document.getElementById('cursoForm').reset();
        document.getElementById('curso_id').value = '';
    }
}

function closeCursoForm() {
    // Ocultar el modal del formulario de curso
    const modal = document.getElementById('cursoFormModal');
    modal.style.display = 'none';
}

function deleteCurso(curso_id) {
    if (confirm('¿Estás seguro de que deseas eliminar este curso?')) {
        window.location.href = `../modules/curso_module.php?delete_id=${curso_id}`;
    }
}
