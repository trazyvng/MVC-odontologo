<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Odontologicos Mclaren</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Servicios odontologicos Mclaren</h1>
    </header>
    <h1>Bienvenido a Servicios Odontologicos Mclaren</h1>
    <div class="imagen-container">
        <img src="img/odon.jpeg" alt="Descripción de la imagen" class="imagen">
    </div>
    <div class="center-container">
        <div class="login-container">
            <h2>Iniciar sesión</h2>
            <form action="login.php" method="POST">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="clave" placeholder="Contraseña" required>
                <button type="submit" class="submit-btn">Ingresar</button>
            </form>
            <p>¿No tienes una cuenta? <a href="registro.php">Crear usuario</a></p>
        </div>
    </div>
    <footer>
        <h5>Todos los derechos reservados, noviembre 2024</h5>
    </footer>
</body>
</html>