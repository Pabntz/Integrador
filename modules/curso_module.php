<?php
session_start();

include('../usuario/conexion.php'); // Ruta ajustada para incluir la conexión correctamente

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $curso_id = $_POST['curso_id'] ?? null;
    $nombre_curso = $_POST['nombre_curso'];
    $descripcion = $_POST['descripcion'];
    $duracion_curso = $_POST['duracion_curso'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];

    if ($curso_id) {
        // Actualizar curso existente
        $sql = "UPDATE curso SET nombre_curso = ?, descripcion = ?, duracion_curso = ?, precio = ?, estado = ? WHERE curso_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdis", $nombre_curso, $descripcion, $duracion_curso, $precio, $estado, $curso_id);
    } else {
        // Insertar nuevo curso
        $sql = "INSERT INTO curso (nombre_curso, descripcion, duracion_curso, precio, estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdi", $nombre_curso, $descripcion, $duracion_curso, $precio, $estado);
    }

    if ($stmt->execute()) {
        header("Location: ../adminindex.php?page=adminCursos"); // Redirige a adminCursos tras guardar
    } else {
        echo "Error al guardar el curso.";
    }
    $stmt->close();
}

// Eliminar curso
if (isset($_GET['delete_id'])) {
    $curso_id = $_GET['delete_id'];
    $sql = "DELETE FROM curso WHERE curso_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $curso_id);

    if ($stmt->execute()) {
        header("Location: ../adminindex.php?page=adminCursos"); // Redirige a adminCursos tras eliminar
    } else {
        echo "Error al eliminar el curso.";
    }
    $stmt->close();
}

$conn->close();
?>
