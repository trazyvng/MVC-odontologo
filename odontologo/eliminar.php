<?php
include('conexion.php');

$id = $_GET['id'];
$sql = "DELETE FROM citas WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php");
} else {
    echo "Error al eliminar la cita: " . $conn->error;
}
?>