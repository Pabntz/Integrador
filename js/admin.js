function openUserModule(usuario_id = null) {
    document.getElementById("userModule").style.display = "flex";
    if (usuario_id) {
        document.getElementById("modalTitle").innerText = "Editar Usuario";
        document.getElementById("usuario_id").value = usuario_id;
        // Puedes agregar AJAX para cargar los datos actuales del usuario en el formulario
    } else {
        document.getElementById("modalTitle").innerText = "Agregar Usuario";
        document.getElementById("userForm").reset();
    }
}

function closeUserModule() {
    document.getElementById("userModule").style.display = "none";
}

function deleteUser(usuario_id) {
    if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
        window.location.href = `modules/delete_user.php?id=${usuario_id}`;
    }
}
