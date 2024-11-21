<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Registrar nuevo usuario</h2>
    <div class="center-container">
        <div class="form-container">
            <form action="registrar_usuario.php" method="POST">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="clave" placeholder="Contraseña" required>
                <button type="submit">Registrar</button>
            </form>
            <p><a href="index.php">Volver al login</a></p>
        </div>
    </div>
</body>
</html>