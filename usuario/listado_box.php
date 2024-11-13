<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../usuario/conexion.php'); // Ruta ajustada para incluir la conexión correctamente

// Verificar si hay un usuario logueado
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';

// Consulta para obtener todos los cursos activos
$sql = "SELECT curso_id, nombre_curso, descripcion, imagen FROM curso WHERE estado = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Cursos - Box</title>
    <link rel="stylesheet" href="../css/listado_box.css"> <!-- Ruta CSS ajustada -->
    <link rel="stylesheet" href="../css/index.css"> <!-- Ruta CSS ajustada -->
</head>
<body>
<div class="header1">
    <header>
        <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
        <img src="../imagenes/logo.png" alt="Logo" class="logo" /> <!-- Ruta de imagen ajustada -->
        <div class="title">IGLESIA DE DIOS</div>
        <div class="busuario"><?php echo htmlspecialchars($usuario); ?></div>

        <div class="user-dropdown">
            <img src="../imagenes/user_perfile-removebg-preview.png" alt="Imagen de Usuario" class="user-icon" onclick="toggleUserMenu()" /> <!-- Ruta de imagen ajustada -->
            <div id="userMenu" class="user-dropdown-content">
                <a href="#">Área personal</a>
                <a href="#">Perfil</a>
                <a href="#">Calificaciones</a>
                <a href="#">Mensajes</a>
                <a href="#">Preferencias</a>
                <a href="../login/logout.php">Cerrar sesión</a> <!-- Ruta de logout ajustada -->
            </div>
        </div>
    </header>
</div>

<aside id="menuAside">
    <ul>
        <li><a href="../index.php">Inicio</a></li> <!-- Ruta de navegación ajustada -->
        <li><a href="listado_tabla.php">CursosT</a></li>
        <li><a href="listado_box.php">CursosB</a></li>
        <li><a href="mis_cursos.php">Mis Cursos</a></li>
    </ul>
</aside>

<div class="separator"></div>

<div class="container"> 
    <?php
    // Generar cada curso dinámicamente
    if ($result->num_rows > 0) {
        while ($curso = $result->fetch_assoc()) {
            echo "<article class='presentacion'>";
            echo "<a href='detalle_curso.php?curso_id=" . $curso['curso_id'] . "'>";
            echo "<img src='../imagenes/" . htmlspecialchars($curso['imagen']) . "' alt='Descripción de la imagen' class='imagen'>"; // Ruta de imagen ajustada
            echo "<div class='descripcion'>";
            echo "<h2>" . htmlspecialchars($curso['nombre_curso']) . "</h2>";
            echo "<p>" . htmlspecialchars(substr($curso['descripcion'], 0, 200)) . "...</p>"; // Limita la descripción a 200 caracteres
            echo "</div>";
            echo "</a>";
            echo "</article>";
        }
    } else {
        echo "<p>No hay cursos disponibles en este momento.</p>";
    }
    ?>
</div>

<script src="../js/main.js"></script> <!-- Ruta JS ajustada -->
</body>
</html>

<?php
$conn->close();
?>
