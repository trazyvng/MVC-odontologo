<?php
include('conexion.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Verificar el usuario y la contraseña
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['usuario'] = $usuario;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.php';</script>";
    }
}
?>