<?php
session_start();
include('../usuario/conexion.php'); // Ruta ajustada para incluir la conexión correctamente

// Valores de búsqueda y ordenación
$search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';
$allowedSorts = ['nombre_curso', 'duracion_curso', 'precio'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $allowedSorts) ? $_GET['sort'] : 'nombre_curso';

// Consultar todos los cursos con filtros y ordenación
$sql = "
    SELECT curso_id, nombre_curso, descripcion, duracion_curso, precio, imagen
    FROM curso
    WHERE estado = 1 AND nombre_curso LIKE ?
    ORDER BY $sort
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Cursos - Tabla</title>
    <link rel="stylesheet" href="../css/index.css"> <!-- Ruta ajustada para CSS -->
    <link rel="stylesheet" href="../css/listado_tabla.css"> <!-- Ruta ajustada para CSS -->
</head>
<body>
<div class="header1">
    <header>
        <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
        <img src="../imagenes/logo.png" alt="Logo" class="logo" /> <!-- Ruta ajustada para logo -->
        <div class="title">IGLESIA DE DIOS</div>
        <div class="busuario"><?php echo htmlspecialchars($_SESSION['usuario'] ?? 'Invitado'); ?></div>

        <div class="user-dropdown">
            <img src="../imagenes/user_perfile-removebg-preview.png" alt="Imagen de Usuario" class="user-icon" onclick="toggleUserMenu()" /> <!-- Ruta ajustada para imagen de usuario -->
            <div id="userMenu" class="user-dropdown-content">
                <a href="#">Área personal</a>
                <a href="#">Perfil</a>
                <a href="#">Calificaciones</a>
                <a href="#">Mensajes</a>
                <a href="#">Preferencias</a>
                <a href="../login/logout.php">Cerrar sesión</a> <!-- Ruta ajustada para logout -->
            </div>
        </div>
    </header>
</div>

<aside id="menuAside">
    <ul>
      <li><a href="../index.php">Inicio</a></li>
      <li><a href="listado_tabla.php">CursosT</a></li>
      <li><a href="listado_box.php">CursosB</a></li>
      <li><a href="mis_cursos.php">Mis Cursos</a></li>
    </ul>
</aside>

<div class="separator"></div>

<!-- Contenedor principal de la sección "Listado de Cursos" -->
<div class="main-container">
    <div class="content-container">
        <h1>Listado de Cursos</h1>

        <!-- Contenedor para el formulario de búsqueda y ordenación -->
        <div class="search-container">
            <form method="GET" action="listado_tabla.php" class="search-sort-form">
                <input type="text" name="search" placeholder="Buscar curso..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <select name="sort">
                    <option value="nombre_curso" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'nombre_curso' ? 'selected' : ''; ?>>Nombre</option>
                    <option value="duracion_curso" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'duracion_curso' ? 'selected' : ''; ?>>Duración</option>
                    <option value="precio" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'precio' ? 'selected' : ''; ?>>Precio</option>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </div>

        <!-- Tabla de cursos -->
        <table>
            <thead>
                <tr>
                    <th>Nombre del Curso</th>
                    <th>Descripción</th>
                    <th>Duración</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($curso = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($curso['nombre_curso']); ?></td>
                            <td><?php echo htmlspecialchars(substr($curso['descripcion'], 0, 100)) . '...'; ?></td>
                            <td><?php echo htmlspecialchars($curso['duracion_curso']); ?></td>
                            <td><?php echo htmlspecialchars($curso['precio']) == 0 ? 'Gratis' : '$' . number_format($curso['precio'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No se encontraron cursos.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../js/main.js"></script> <!-- Ruta ajustada para el script JS -->
</body>
</html>
