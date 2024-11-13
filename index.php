<?php
session_start(); // Iniciar la sesión

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Verificar si hay un usuario logueado
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IGLESIA DE DIOS</title>
  <link rel="stylesheet" href="css/index.css" />
</head>

<body>
  <div class="header1">
    <header>
      <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
      <img src="imagenes/logo.png" alt="Logo" class="logo" />
      <div class="title">IGLESIA DE DIOS</div>
      <div class="busuario"><?php echo htmlspecialchars($usuario); ?></div>

      <div class="user-dropdown">
        <img
          src="imagenes/user_perfile-removebg-preview.png"
          alt="Imagen de Usuario"
          class="user-icon"
          onclick="toggleUserMenu()" />
        <div id="userMenu" class="user-dropdown-content">
          <a href="#">Área personal</a>
          <a href="#">Perfil</a>
          <a href="#">Calificaciones</a>
          <a href="#">Mensajes</a>
          <a href="#">Preferencias</a>
          <a href="login/logout.php">Cerrar sesión</a> <!-- Ruta ajustada -->
        </div>
      </div>
    </header>
  </div>

  <aside id="menuAside">
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="usuario/listado_tabla.php">CursosT</a></li> <!-- Ruta ajustada -->
      <li><a href="usuario/listado_box.php">CursosB</a></li> <!-- Ruta ajustada -->
      <li><a href="usuario/mis_cursos.php">Mis Cursos</a></li> <!-- Ruta ajustada -->
    </ul>
  </aside>

  <div class="separator"></div>

  <div class="news-carousel-container">
    <div class="news-carousel">
      <div class="news-item">
        <img
          src="imagenes/encendidos.jpg"
          alt="Noticia 1"
          class="news-image" />
        <div class="news-description">
          <h2>ESTAMOS ENCENDIDOS</h2>
          <p>Dios está forjando una generación prendida fuego por él</p>
        </div>
      </div>
      <div class="news-item">
        <img
          src="imagenes/Salvando_Generaciones.jpg"
          alt="Noticia 2"
          class="news-image" />
        <div class="news-description">
          <h2>Misión</h2>
          <p>
            Nuestra misión para este año es alcanzar a todas las generaciones
            y unirlas en el propósito que Dios tiene para cada una de ellas
          </p>
        </div>
      </div>
      <div class="news-item">
        <img
          src="imagenes/lengua_de_señas.jpg"
          alt="Noticia 3"
          class="news-image" />
        <div class="news-description">
          <h2>Preparate</h2>
          <p>
            Dios capacita personas para llevar su evangelio hacia nuevas
            fronteras, no te lo pierdas
          </p>
        </div>
      </div>
    </div>
  </div>

  <footer></footer>

  <script src="js/main.js"></script> <!-- Ruta ajustada -->
</body>

</html>
