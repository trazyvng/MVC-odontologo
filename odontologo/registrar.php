<?php
include('conexion.php');
session_start(); // Iniciar la sesión

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$servicio = $_POST['servicio'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$precio = $_POST['precio'];
$usuario = $_SESSION['usuario']; // Obtener el usuario de la sesión

// Insertar la cita en la base de datos
$sql = "INSERT INTO citas (nombre_paciente, email_paciente, telefono_paciente, servicio, fecha, hora, usuario)
        VALUES ('$nombre', '$email', '$telefono', '$servicio', '$fecha', '$hora', '$usuario')";

if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php");
} else {
    echo "Error al registrar la cita: " . $conn->error;
}

$conn->close();
?>