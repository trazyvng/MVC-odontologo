<?php
include('conexion.php');

$fecha = $_GET['fecha'];
$sql = "SELECT * FROM citas WHERE fecha='$fecha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Servicio</th>
                <th>Hora</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['nombre_paciente']}</td>
                <td>{$row['email_paciente']}</td>
                <td>{$row['telefono_paciente']}</td>
                <td>{$row['servicio']}</td>
                <td>{$row['hora']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay citas registradas para esta fecha.";
}

$conn->close();
?>