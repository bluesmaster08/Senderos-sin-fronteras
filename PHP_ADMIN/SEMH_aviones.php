<?php
include("../include/SEMH_conn_BD.php");

// Función para obtener todos los aviones de la base de datos
function SEMH_obtenerAviones($conn)
{
    $query = "SELECT * FROM tblavion";
    return mysqli_query($conn, $query); // Ejecuta la consulta y retorna el resultado
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Aviones</title>
    <link rel="stylesheet" href="../CSS/styles.css">
    <script src="../JS/validaciones_avion.js"></script>
</head>

<body>
    <header>
        <h1>Gestión de Aviones</h1>
        <nav>
            <a href="SEMH_home_admin.php">Inicio || </a>
            <a href="../index.php">Cerrar Sesión</a>
        </nav>
    </header>
    <main>
        <h2>Registrar un Nuevo Avión</h2>

        <!-- Formulario para agregar un nuevo avión -->
        <form action="guardar_avion.php" method="POST">
            <div class="form-group">
                <label for="numero_serie">Número de Serie:</label>
                <input type="text" id="numero_serie" name="numero_serie" placeholder="Número de Serie" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" placeholder="Modelo" required>
            </div>
            <div class="form-group">
                <label for="capacidad_asientos">Capacidad de Asientos:</label>
                <input type="number" id="capacidad_asientos" name="capacidad_asientos" placeholder="Capacidad de Asientos" required min="1" max="80">
            </div>
            <div class="form-group">
                <label for="empresa_propietaria">Empresa Propietaria:</label>
                <input type="text" id="empresa_propietaria" name="empresa_propietaria" placeholder="Empresa Propietaria" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <!-- Tabla para visualizar los registros -->
        <section id="aviones">
            <h2>Aviones Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Número de Serie</th>
                        <th>Modelo</th>
                        <th>Capacidad de Asientos</th>
                        <th>Empresa Propietaria</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = SEMH_obtenerAviones($conn); // Obtener aviones desde la BD
                    while ($row = mysqli_fetch_assoc($result)) { // Iterar sobre los resultados
                    ?>
                        <tr>
                            <td><?php echo $row['numero_serie']; ?></td>
                            <td><?php echo $row['modelo']; ?></td>
                            <td><?php echo $row['capacidad_asientos']; ?></td>
                            <td><?php echo $row['empresa_propietaria']; ?></td>
                            <td>
                                <!-- Enlaces para editar y eliminar -->
                                <a href="editar_avion.php?id=<?php echo $row['id_avion']; ?>" class="btn btn-edit">Editar</a>
                                <a href="eliminar_avion.php?id=<?php echo $row['id_avion']; ?>" class="btn btn-delete">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; SEMH – PW1 – 2024/05/12</p>
    </footer>
</body>

</html>