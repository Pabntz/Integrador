<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Confirma la ruta para incluir la conexión
include(__DIR__ . '/../usuario/conexion.php'); // __DIR__ asegura que la ruta sea correcta

$sql = "SELECT usuario_id, nombre, correo, rol, estado FROM usuario";
$result = $conn->query($sql);
?>

<div class="content-container">
    <h1>Gestión de Usuarios</h1>
    <button onclick="openUserForm()">Agregar Usuario</button>

    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['usuario_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['correo']); ?></td>
                    <td><?php echo htmlspecialchars($row['rol']); ?></td>
                    <td><?php echo $row['estado'] ? 'Activo' : 'Inactivo'; ?></td>
                    <td>
                        <button onclick="openUserForm(<?php echo $row['usuario_id']; ?>)">Editar</button>
                        <button onclick="deleteUser(<?php echo $row['usuario_id']; ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php $conn->close(); ?>
