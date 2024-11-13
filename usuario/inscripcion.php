<?php
session_start();
include('../usuario/conexion.php'); // Ajuste de ruta para incluir el archivo de conexión

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    echo "Debes iniciar sesión para inscribirte.";
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$curso_id = intval($_GET['curso_id']);

// Verificar si el usuario ya está inscrito en el curso
$sql = "SELECT * FROM inscripcion WHERE usuario_id = ? AND curso_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $usuario_id, $curso_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Ya estás inscrito en este curso.";
} else {
    // Inscribir al usuario en el curso con estado_inscripcion = 'activa'
    $sql = "INSERT INTO inscripcion (usuario_id, curso_id, fecha_inscripcion, estado, estado_inscripcion) VALUES (?, ?, NOW(), 1, 'activa')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $usuario_id, $curso_id);

    if ($stmt->execute()) {
        // Redirigir a mis_cursos.php después de una inscripción exitosa
        header("Location: ../usuario/mis_cursos.php");
        exit(); // Detener la ejecución para asegurar la redirección
    } else {
        echo "Error en la inscripción. Inténtalo nuevamente.";
    }
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
