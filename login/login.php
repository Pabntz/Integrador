<?php
session_start();
include('../usuario/conexion.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error_msg = "";

// Procesar los datos enviados por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_email = $_POST['username'];
    $input_password = $_POST['password'];

    // Verificar si el correo existe en la tabla usuario
    $sql = "SELECT * FROM usuario WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($input_password, $row['contraseña'])) {
            // Credenciales correctas, iniciar la sesión
            $_SESSION['usuario_id'] = $row['usuario_id'];
            $_SESSION['usuario'] = $row['nombre'];
            $_SESSION['email'] = $row['correo'];
            $_SESSION['rol'] = $row['rol'];
            
            // Redirigir según el rol
            $redirect = ($row['rol'] == 'administrador') ? '../adminindex.php' : '../index.php';
            header("Location: $redirect");
            exit();
        } else {
            $error_msg = "Credenciales incorrectas";
        }
    } else {
        $error_msg = "Credenciales incorrectas";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión - IGLESIA DE DIOS</title>
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/login.css" />
</head>
<body>
    <div class="header1">
        <header>
            <button class="menu-icon" onclick="toggleAside()">&#9776;</button>
            <img src="../imagenes/logo.png" alt="Logo" class="logo" />
            <div class="title">IGLESIA DE DIOS</div>
        </header>
    </div>

    <aside id="menuAside">
        <ul>
            <li><a href="login.php">Iniciar Sesión</a></li>
            <li><a href="contactenos.php">Contáctenos</a></li>
        </ul>
    </aside>

    <div class="login-container">
        <form class="login-form" action="login.php" method="POST">
            <h2>Iniciar Sesión</h2>
            
            <!-- Mostrar mensaje de error si existe -->
            <?php if (!empty($error_msg)): ?>
            <div class="error-msg">
                <?php echo $error_msg; ?>
            </div>
            <?php endif; ?>

            <label for="username">Correo</label>
            <input type="text" id="username" name="username" required />
            
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required />
            
            <button type="submit">Ingresar</button>
            
            <div class="link-register">
                ¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a>
            </div>
        </form>
    </div>

    <footer></footer>
    <script src="../js/main.js"></script>
</body>
</html>
