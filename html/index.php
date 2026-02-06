<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Docker: Apache + MariaDB</title>
    <style>
        body { font-family: sans-serif; margin: 40px; line-height: 1.6; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        tr:nth-child(even) { background-color: #fafafa; }
        .status { padding: 10px; border-radius: 4px; margin-bottom: 20px; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h1>Gestión de Usuarios (Apache + MariaDB)</h1>

    <?php
    $host = 'mariadb';
    $db   = 'mi_base_de_datos';
    $user = 'usuario_db';
    $pass = 'password_db';

    // Intentar conexión con reintentos
    $max_attempts = 5;
    $attempt = 1;
    $conn = null;

    while ($attempt <= $max_attempts) {
        $conn = @new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            sleep(2);
            $attempt++;
        } else {
            break;
        }
    }

    if (!$conn || $conn->connect_error) {
        echo "<div class='status error'>Error de conexión: " . ($conn ? $conn->connect_error : "Tiempo de espera agotado") . "</div>";
    } else {
        echo "<div class='status success'>¡Conectado exitosamente a MariaDB!</div>";

        // Realizar consulta
        $sql = "SELECT id, nombre, email, creado_en FROM usuarios";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<h2>Lista de Usuarios Registrados:</h2>";
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de Registro</th>
                        </tr>
                    </thead>
                    <tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["nombre"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["creado_en"] . "</td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No se encontraron usuarios o la tabla está vacía.</p>";
        }
        $conn->close();
    }
    ?>
</body>
</html>
