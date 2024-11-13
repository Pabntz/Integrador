<?php
session_start(); // Iniciar la sesión

// Parámetros de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Cambiar según tu configuración
$dbname = "paradigmas";

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión a la base de datos fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>