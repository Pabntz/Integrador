<?php
include('../usuario/conexion.php'); // Ruta ajustada para la conexión

$sql = "SELECT curso_id, nombre_curso, descripcion, duracion_curso, estado, precio FROM curso";
$result = $conn->query($sql);
?>

<div class="content-container">
    <h1>Gestión de Cursos</h1>
    <button onclick="openCursoForm()">Agregar Curso</button>

    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Curso</th>
                <th>Descripción</th>
                <th>Duración</th>
                <th>Estado</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['curso_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_curso']); ?></td>
                    <td><?php echo htmlspecialchars(substr($row['descripcion'], 0, 50)); ?>...</td>
                    <td><?php echo htmlspecialchars($row['duracion_curso']); ?></td>
                    <td><?php echo $row['estado'] ? 'Activo' : 'Inactivo'; ?></td>
                    <td><?php echo number_format($row['precio'], 2); ?></td>
                    <td>
                        <button onclick="openCursoForm(<?php echo $row['curso_id']; ?>)">Editar</button>
                        <button onclick="deleteCurso(<?php echo $row['curso_id']; ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<div id="cursoFormModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCursoForm()">&times;</span>
        <h2 id="modalTitle">Agregar Curso</h2>
        <form action="modules/curso_module.php" method="POST" id="cursoForm"> <!-- Ruta ajustada -->
            <input type="hidden" name="curso_id" id="curso_id">
            <label for="nombre_curso">Nombre del Curso:</label>
            <input type="text" name="nombre_curso" id="nombre_curso" required>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required></textarea>
            <label for="duracion_curso">Duración:</label>
            <input type="text" name="duracion_curso" id="duracion_curso" required>
            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" step="0.01" required>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <button type="submit" name="submit">Guardar</button>
        </form>
    </div>
</div>

<?php $conn->close(); ?>
