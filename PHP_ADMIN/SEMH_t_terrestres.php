<?php
include("../include/SEMH_conn_BD.php");

// Función para obtener todos los transportes terrestres desde la base de datos
function SEMH_obtenerTransportesTerrestres($conn)
{
    $query = "SELECT * FROM tbltranspterrestre";
    return mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Transportes Terrestres</title>
    <link rel="stylesheet" href="../CSS/styles.css">
    <script src="../JS/validaciones_t_terrestres.js"></script>
</head>

<body>
    <header>
        <h1>Gestión de Transportes Terrestres</h1>
        <nav>
            <a href="SEMH_home_admin.php">Inicio || </a>
            <a href="../index.php"> Cerrar Sesión</a>
        </nav>
    </header>
    <main>
        <h2>Registrar un Nuevo Transporte Terrestre</h2>
        <!-- Formulario para agregar un nuevo transporte terrestre -->
        <form action="guardar_transporte.php" method="POST">
            <div class="form-group">
                <label for="tipo_transporte">Tipo de Transporte:</label>
                <input type="text" id="tipo_transporte" name="tipo_transporte" placeholder="Tipo de Transporte" required>
            </div>
            <div class="form-group">
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" placeholder="Placa" required>
            </div>
            <div class="form-group">
                <label for="capacidad_pasajeros">Capacidad de Pasajeros:</label>
                <input type="number" id="capacidad_pasajeros" name="capacidad_pasajeros" min="1" max="80" placeholder="Capacidad de Pasajeros" required>
            </div>
            <div class="form-group">
                <label for="año_fabricacion">Año de Fabricación:</label>
                <input type="number" id="año_fabricacion" name="año_fabricacion" min="2000" max="2024" value="2000" required>
            </div>
            <div class="form-group">
                <label for="empresa_propietaria">Empresa Propietaria:</label>
                <input type="text" id="empresa_propietaria" name="empresa_propietaria" placeholder="Empresa Propietaria" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <!--Tabla para visualizar los registros-->
        <section id="transportes">
            <h2>Transportes Terrestres Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Tipo de Transporte</th>
                        <th>Placa</th>
                        <th>Capacidad de Pasajeros</th>
                        <th>Año de Fabricación</th>
                        <th>Empresa Propietaria</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se mostrarán los transportes terrestres registrados -->
                    <?php
                    // Obtener los datos de los transportes terrestres y mostrarlos en la tabla
                    $result_transpterrestre = SEMH_obtenerTransportesTerrestres($conn);
                    while ($row = mysqli_fetch_assoc($result_transpterrestre)) { ?>
                        <tr>
                            <td><?php echo $row['tipo_transporte']; ?></td>
                            <td><?php echo $row['placa']; ?></td>
                            <td><?php echo $row['capacidad_pasajeros']; ?></td>
                            <td><?php echo $row['año_fabricacion']; ?></td>
                            <td><?php echo $row['empresa_propietaria']; ?></td>
                            <td>
                                <a href="editar_transporte.php?id=<?php echo $row['id_transpterrestre'] ?>" class="btn btn-edit">Editar</a>
                                <a href="eliminar_transporte.php?id=<?php echo $row['id_transpterrestre'] ?>" class="btn btn-delete">Eliminar</a>
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