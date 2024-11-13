<?php
session_start();
include('../usuario/conexion.php'); // Ruta ajustada para incluir la conexión correctamente


// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login/login.php"); // Ruta ajustada a la carpeta de login
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Consultar los cursos en los que el usuario está inscrito
$sql = "
    SELECT c.curso_id, c.nombre_curso, c.descripcion, c.imagen, i.estado_inscripcion
    FROM curso c
    INNER JOIN inscripcion i ON c.curso_id = i.curso_id
    WHERE i.usuario_id = ? AND c.estado = 1
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$cursos_en_curso = [];
$cursos_completados = [];

while ($curso = $result->fetch_assoc()) {
    if ($curso['estado_inscripcion'] == 'activa') {
        $cursos_en_curso[] = $curso;
    } else {
        $cursos_completados[] = $curso;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Cursos</title>
    <link rel="stylesheet" href="../css/index.css"> <!-- Ruta ajustada -->
    <link rel="stylesheet" href="../css/mis_cursos.css"> <!-- Ruta ajustada -->
</head>
<body>
<div class="header1">
    <header>
        <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
        <img src="../imagenes/logo.png" alt="Logo" class="logo" /> <!-- Ruta ajustada -->
        <div class="title">IGLESIA DE DIOS</div>
        <div class="busuario"><?php echo htmlspecialchars($_SESSION['usuario']); ?></div>

        <div class="user-dropdown">
            <img src="../imagenes/user_perfile-removebg-preview.png" alt="Imagen de Usuario" class="user-icon" onclick="toggleUserMenu()" /> <!-- Ruta ajustada -->
            <div id="userMenu" class="user-dropdown-content">
                <a href="#">Área personal</a>
                <a href="#">Perfil</a>
                <a href="#">Calificaciones</a>
                <a href="#">Mensajes</a>
                <a href="#">Preferencias</a>
                <a href="../login/logout.php">Cerrar sesión</a> <!-- Ruta ajustada -->
            </div>
        </div>
    </header>
</div>

<aside id="menuAside">
    <ul>
        <li><a href="../index.php">Inicio</a></li> <!-- Ruta ajustada -->
        <li><a href="../usuario/listado_tabla.php">CursosT</a></li> <!-- Ruta ajustada -->
        <li><a href="../usuario/listado_box.php">CursosB</a></li> <!-- Ruta ajustada -->
        <li><a href="mis_cursos.php">Mis Cursos</a></li>
    </ul>
</aside>

<div class="separator"></div>

<div class="main-container">
    <div class="content-container">
        <h1>Mi aprendizaje</h1>
        <div class="tabs">
            <button class="tab-button active" onclick="showTab('en_curso')">En curso</button>
            <button class="tab-button" onclick="showTab('completado')">Completado(a)</button>
        </div>

        <div id="en_curso" class="tab-content active">
            <?php if (count($cursos_en_curso) > 0): ?>
                <?php foreach ($cursos_en_curso as $curso): ?>
                    <div class="course-card">
                        <img src="../imagenes/<?php echo htmlspecialchars($curso['imagen']); ?>" alt="Imagen del curso"> <!-- Ruta ajustada -->
                        <div class="course-details">
                            <h2><?php echo htmlspecialchars($curso['nombre_curso']); ?></h2>
                            <p><?php echo htmlspecialchars($curso['descripcion']); ?></p>
                        </div>
                        <button class="action-button">Ver curso</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Encontrarás tus cursos en progreso aquí.</p>
            <?php endif; ?>
        </div>

        <div id="completado" class="tab-content">
            <?php if (count($cursos_completados) > 0): ?>
                <?php foreach ($cursos_completados as $curso): ?>
                    <div class="course-card">
                        <img src="../imagenes/<?php echo htmlspecialchars($curso['imagen']); ?>" alt="Imagen del curso"> <!-- Ruta ajustada -->
                        <div class="course-details">
                            <h2><?php echo htmlspecialchars($curso['nombre_curso']); ?></h2>
                            <p><?php echo htmlspecialchars($curso['descripcion']); ?></p>
                        </div>
                        <button class="action-button">Ver certificado</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Encontrarás tus cursos completados aquí.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="../js/mis_cursos.js"></script> <!-- Ruta ajustada -->
<script src="../js/main.js"></script> <!-- Ruta ajustada -->
</body>
</html>
