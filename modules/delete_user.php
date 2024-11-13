<?php
include('../usuario/conexion.php'); // Ajustada la ruta para la conexión

if (isset($_GET['id'])) {
    $usuario_id = intval($_GET['id']);
    $sql = "DELETE FROM usuario WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    
    if ($stmt->execute()) {
        header("Location: ../adminindex.php?page=listado_usuarios"); // Ruta ajustada para redirigir correctamente a listado_usuarios
    } else {
        echo "Error al eliminar el usuario.";
    }
    $stmt->close();
}
$conn->close();
?>
