<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contáctenos - IGLESIA DE DIOS</title>
    <link rel="stylesheet" href="../css/contacto.css" />
    <link rel="stylesheet" href="../css/index.css"/>
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

    <div class="separator"></div>

    <main>
        <section class="contact-container">
            <h1>Contáctenos</h1>
            <p>Por favor, complete el siguiente formulario para ponerse en contacto con nosotros.</p>
            
            <form action="#" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required />

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required />

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

                <button type="submit">Enviar Mensaje</button>
            </form>
        </section>
    </main>

    <footer></footer>

    <script src="../js/main.js"></script>
</body>
</html>
