function openCursoForm(cursoId = null) {
    document.getElementById("curso_id").value = cursoId || "";
    document.getElementById("modalTitle").textContent = cursoId ? "Editar Curso" : "Agregar Curso";
    document.getElementById("cursoForm").reset();
    document.getElementById("cursoFormModal").style.display = "block";

    if (cursoId) {
        // Cargar datos del curso existente para edición
        fetch(`modules/curso_module.php?curso_id=${cursoId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById("nombre_curso").value = data.nombre_curso;
                document.getElementById("descripcion").value = data.descripcion;
                document.getElementById("duracion_curso").value = data.duracion_curso;
                document.getElementById("precio").value = data.precio;
                document.getElementById("estado").value = data.estado;
            });
    }
}

function closeCursoForm() {
    document.getElementById("cursoFormModal").style.display = "none";
}

function deleteCurso(cursoId) {
    if (confirm("¿Estás seguro de que deseas eliminar este curso?")) {
        window.location.href = `modules/curso_module.php?delete_id=${cursoId}`;
    }
}
