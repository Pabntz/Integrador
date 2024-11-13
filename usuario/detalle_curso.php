<?php
session_start();
include('../usuario/conexion.php'); // Asegúrate de que este archivo tiene la conexión a la base de datos

// Verificar si el curso ID está presente en la URL
if (!isset($_GET['curso_id'])) {
    echo "No se ha especificado un curso.";
    exit();
}

$curso_id = intval($_GET['curso_id']);

// Obtener los datos del curso desde la base de datos
$sql = "SELECT * FROM curso WHERE curso_id = ? AND estado = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $curso_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $curso = $result->fetch_assoc();
} else {
    echo "Curso no encontrado o no disponible.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($curso['nombre_curso']); ?></title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/curso.css">
</head>

<body>
    <div class="header1">
        <header>
            <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
            <img src="../imagenes/logo.png" alt="Logo" class="logo" />
            <div class="title">IGLESIA DE DIOS</div>
            <div class="busuario"><?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'Invitado'; ?></div>
            <div class="user-dropdown">
                <img src="../imagenes/user_perfile-removebg-preview.png" alt="Imagen de Usuario" class="user-icon" onclick="toggleUserMenu()" />
                <div id="userMenu" class="user-dropdown-content">
                    <a href="#">Área personal</a>
                    <a href="#">Perfil</a>
                    <a href="#">Calificaciones</a>
                    <a href="#">Mensajes</a>
                    <a href="#">Preferencias</a>
                    <a href="../login/logout.php">Cerrar sesión</a>
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

    <div class="course-detail-container">
        <div class="course-description-container">
            <h1 class="course-title"><?php echo htmlspecialchars($curso['nombre_curso']); ?></h1>
            <p class="descripcion"><?php echo nl2br(htmlspecialchars($curso['descripcion'])); ?></p>
            <div class="course-price">
                <h2>Precio del Curso</h2>
                <p><?php echo $curso['precio'] == 0 ? 'Gratis' : '$' . number_format($curso['precio'], 2); ?></p>
            </div>
        </div>

        <div class="course-index-container">
            <div class="course-index">
                <h2>Índice de Contenido</h2>
                <ul>
                    <?php
                    $contenido = json_decode($curso['contenido'], true); // Decodificar el contenido JSON
                    if (is_array($contenido)) {
                        foreach ($contenido as $leccion) {
                            echo "<li>" . htmlspecialchars($leccion) . "</li>";
                        }
                    } else {
                        echo "<li>No hay contenido disponible.</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="inscribirme-container">
            <a href="../usuario/inscripcion.php?curso_id=<?php echo $curso['curso_id']; ?>" class="inscribirme-btn">Inscribirme</a>
        </div>
    </div>

    <script src="../js/main.js"></script>
</body>

</html>
