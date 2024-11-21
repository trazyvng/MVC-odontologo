<?php
include('conexion.php');

$usuario = $_POST['usuario'];
$clave = $_POST['clave']; // Guardar la contraseña en texto plano (no recomendado para producción)

// Verificar si el usuario ya existe
$sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "El usuario ya existe. <a href='registro.php'>Intenta con otro nombre</a>";
} else {
    // Insertar nuevo usuario
    $sql = "INSERT INTO usuarios (usuario, clave) VALUES ('$usuario', '$clave')";
    if ($conn->query($sql) === TRUE) {
        // Redireccionar al index.php después de un registro exitoso
        echo "<script>
                alert('Usuario registrado exitosamente.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>