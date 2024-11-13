<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../usuario/conexion.php'); // Asegúrate de que la ruta sea correcta para incluir la conexión

// Verificar si la conexión a la base de datos fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Registrar la hora de fin de la sesión actual
$sql = "UPDATE sesiones_usuario 
        SET hora_fin = NOW() 
        WHERE usuario_id = ? 
        AND hora_fin IS NULL"; // Actualizar solo la sesión activa
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$stmt->close(); // Cerrar el statement

// Cerrar la conexión a la base de datos
$conn->close();

// Cerrar la sesión del usuario
session_destroy(); // Destruir la sesión actual

// Redirigir al login dentro de la carpeta actual (login/)
header('Location: ./login.php');
exit();
?>
