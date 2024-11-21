php

Copiar
<?php
include('conexion.php');
session_start();
date_default_timezone_set('America/Caracas');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

// Obtener el usuario actual
$usuario = $_SESSION['usuario'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($usuario); ?></h1>
    <a href="logout.php" class="logout-btn">Cerrar sesión</a>

    <!-- Formulario para registrar nueva cita -->
    <div class="form-container">
        <h2>Registrar nueva cita</h2>
        <form action="registrar.php" method="POST" id="citaForm">
            <input type="text" name="nombre" placeholder="Nombre del paciente" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <select name="servicio" id="servicio" required onchange="calcularPrecio()">
                <option value="" disabled selected>Selecciona un servicio</option>
                <option value="Limpieza">Limpieza ($30)</option>
                <option value="Extracción">Extracción ($50)</option>
                <option value="Ortodoncia">Ortodoncia ($100)</option>
            </select>
            <input type="date" name="fecha" id="fecha" required onchange="verificarCitas()">
            <input type="time" name="hora" required>
            <input type="text" name="precio" id="precio" placeholder="Precio con IVA" readonly>
            <button type="submit">Registrar cita</button>
        </form>
    </div>

    <!-- Mostrar citas del día actual -->
    <div class="table-container">
        <h2>Citas del día de hoy</h2>
        <div id="citasHoy">
            <?php
            $fechaHoy = date("Y-m-d");
            $sql = "SELECT * FROM citas WHERE fecha='$fechaHoy'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Servicio</th>
                            <th>Hora</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['nombre_paciente']) . "</td>
                            <td>" . htmlspecialchars($row['email_paciente']) . "</td>
                            <td>" . htmlspecialchars($row['telefono_paciente']) . "</td>
                            <td>" . htmlspecialchars($row['servicio']) . "</td>
                            <td>" . htmlspecialchars($row['hora']) . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No hay citas registradas para hoy.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Contador de personas atendidas -->
    <div class="stats-container">
        <h2>Estadísticas del día</h2>
        <?php
        $sqlContador = "SELECT COUNT(*) as total FROM citas WHERE fecha='$fechaHoy'";
        $resultContador = $conn->query($sqlContador);
        $row = $resultContador->fetch_assoc();
        echo "<p>Total de citas para hoy: <strong>" . $row['total'] . "</strong></p>";

        // Contador por tipo de servicio
        $sqlServicios = "SELECT servicio, COUNT(*) as cantidad FROM citas WHERE fecha='$fechaHoy' GROUP BY servicio";
        $resultServicios = $conn->query($sqlServicios);
        
        if ($resultServicios->num_rows > 0) {
            echo "<p>Desglose por servicio:</p>";
            echo "<ul>";
            while ($rowServicio = $resultServicios->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($rowServicio['servicio']) . ": <strong>" . $rowServicio['cantidad'] . "</strong></li>";
            }
            echo "</ul>";
        }
        ?>
    </div>

    <script>
    function calcularPrecio() {
        const servicio = document.getElementById("servicio").value;
        let precio = 0;

        switch (servicio) {
            case "Limpieza":
                precio = 30;
                break;
            case "Extracción":
                precio = 50;
                break;
            case "Ortodoncia":
                precio = 100;
                break;
            default:
                precio = 0;
                break;
        }

        const precioConIva = precio * 1.16;
        document.getElementById("precio").value = "$" + precioConIva.toFixed(2);
    }

    function verificarCitas() {
        const fecha = document.getElementById("fecha").value;
        if (!fecha) return;

        fetch(`verificar_citas.php?fecha=${fecha}`)
            .then(response => response.text())
            .then(data => {
                if (data === 'ocupado') {
                    alert('Ya hay citas registradas para esta fecha. Por favor, elija otra fecha.');
                }
            });
    }
    </script>
</body>
</html>