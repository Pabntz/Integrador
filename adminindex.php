<?php
session_start(); // Iniciar la sesión

include('usuario/conexion.php'); 

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: index.php"); // Ruta ajustada para redirigir a la raíz
    exit();
}
$module = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Panel de Administración</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="header1">
    <header>
        <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
        <img src="imagenes/logo.png" alt="Logo" class="logo">
        <div class="title">IGLESIA DE DIOS</div>
        <div class="busuario"><?php echo htmlspecialchars($_SESSION['usuario']); ?></div>

        <div class="user-dropdown">
            <img src="imagenes/user_perfile-removebg-preview.png" alt="Imagen de Usuario" class="user-icon" onclick="toggleUserMenu()">
            <div id="userMenu" class="user-dropdown-content">
                <a href="#">Área personal</a>
                <a href="#">Perfil</a>
                <a href="#">Calificaciones</a>
                <a href="#">Mensajes</a>
                <a href="#">Preferencias</a>
                <a href="login/logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>
</div>

<aside id="menuAside">
    <ul>
        <li><a href="adminindex.php?page=dashboard">Inicio</a></li>
        <li><a href="adminindex.php?page=listado_usuarios">UsuariosTabla</a></li>
        <li><a href="adminindex.php?page=adminCursos">AdminCursos</a></li>
    </ul>
</aside>

<div class="main-container">
    <?php
    switch ($module) {
        case 'listado_usuarios':
            include('modules/gestion_usuarios.php'); 
            break;
        case 'adminCursos':
            include('modules/gestion_cursos.php'); 
            break;
        case 'dashboard':
        default:
            ?>
            <div class="news-carousel-container">
                <div class="news-carousel">
                    <div class="news-item active">
                        <img src="imagenes/encendidos.jpg" alt="Noticia 1" class="news-image">
                        <div class="news-description">
                            <h2>ESTAMOS ENCENDIDOS</h2>
                            <p>Dios está forjando una generación prendida fuego por él</p>
                        </div>
                    </div>
                    <div class="news-item">
                        <img src="imagenes/Salvando_Generaciones.jpg" alt="Noticia 2" class="news-image">
                        <div class="news-description">
                            <h2>Misión</h2>
                            <p>Nuestra misión para este año es alcanzar a todas las generaciones y unirlas en el propósito de Dios</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            break;
    }
    ?>
</div>

<script src="js/main.js"></script>
<script src="js/admin.js"></script>

<?php
if ($module === 'adminCursos') {
    echo '<script src="js/adminCursos.js"></script>';
}
?>

</body>
</html>
