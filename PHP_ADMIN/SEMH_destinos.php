<?php
// Incluye el archivo de conexión a la base de datos
include("../include/SEMH_conn_BD.php");

// Función para obtener los tipos de destino
function SEMH_obtenerTiposDestino($conn)
{
    return mysqli_query($conn, "SELECT id_tipodestino, nombre_destino FROM tbltipodestino");
}

// Función para obtener los aviones
function SEMH_obtenerAviones($conn)
{
    return mysqli_query($conn, "SELECT id_avion, modelo FROM tblavion");
}

// Función para obtener los transportes terrestres
function SEMH_obtenerTransportesTerrestres($conn)
{
    return mysqli_query($conn, "SELECT id_transpterrestre, tipo_transporte FROM tbltranspterrestre");
}

// Función para obtener los clientes
function SEMH_obtenerClientes($conn)
{
    return mysqli_query($conn, "SELECT id_cliente, nombre FROM tblcliente");
}

// Función para obtener los destinos
function SEMH_obtenerDestinos($conn)
{
    return mysqli_query($conn, "SELECT * FROM tbldestino");
}

// Obtener las opciones para los menús desplegables
$tiposDestino = SEMH_obtenerTiposDestino($conn);
$aviones1 = SEMH_obtenerAviones($conn);
$aviones2 = SEMH_obtenerAviones($conn);
$transportesTerrestres1 = SEMH_obtenerTransportesTerrestres($conn);
$transportesTerrestres2 = SEMH_obtenerTransportesTerrestres($conn);
$clientes = SEMH_obtenerClientes($conn);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Destinos</title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>

<body>
    <header>
        <h1>Gestión de Destinos</h1>
        <nav>
            <a href="SEMH_home_admin.php">Inicio || </a>
            <a href="../index.php">Cerrar Sesión</a>
        </nav>
    </header>
    <main>
        <h2>Registrar un Nuevo Destino</h2>

        <form action="guardar_destino.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="id_tipodestino">Tipo de Destino (Opcional):</label>
                <select id="id_tipodestino" name="id_tipodestino">
                    <option value="">Seleccionar Tipo de Destino (Opcional)</option>
                    <?php while ($row = mysqli_fetch_assoc($tiposDestino)) { ?>
                        <option value="<?php echo $row['id_tipodestino']; ?>"><?php echo $row['nombre_destino']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="id_avion1">Avión 1:</label>
                <select id="id_avion1" name="id_avion1" required>
                    <?php while ($row = mysqli_fetch_assoc($aviones1)) { ?>
                        <option value="<?php echo $row['id_avion']; ?>"><?php echo $row['modelo']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_avion2">Avión 2:</label>
                <select id="id_avion2" name="id_avion2" required>
                    <?php while ($row = mysqli_fetch_assoc($aviones2)) { ?>
                        <option value="<?php echo $row['id_avion']; ?>"><?php echo $row['modelo']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_transpterrestre1">Transporte Terrestre 1:</label>
                <select id="id_transpterrestre1" name="id_transpterrestre1" required>
                    <?php while ($row = mysqli_fetch_assoc($transportesTerrestres1)) { ?>
                        <option value="<?php echo $row['id_transpterrestre']; ?>"><?php echo $row['tipo_transporte']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_transpterrestre2">Transporte Terrestre 2:</label>
                <select id="id_transpterrestre2" name="id_transpterrestre2" required>
                    <?php while ($row = mysqli_fetch_assoc($transportesTerrestres2)) { ?>
                        <option value="<?php echo $row['id_transpterrestre']; ?>"><?php echo $row['tipo_transporte']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_cliente">Cliente:</label>
                <select id="id_cliente" name="id_cliente" required>
                    <?php while ($row = mysqli_fetch_assoc($clientes)) { ?>
                        <option value="<?php echo $row['id_cliente']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="pais">País:</label>
                <input type="text" id="pais" name="pais" required>
            </div>
            <div class="form-group">
                <label for="reseña">Reseña:</label>
                <input type="text" id="reseña" name="reseña" required>
            </div>
            <div class="form-group">
                <label for="coordenadas">Coordenadas:</label>
                <input type="text" id="coordenadas" name="coordenadas" required>
            </div>
            <div class="form-group">
                <label for="imagen_destino">Imagen del Destino:</label>
                <input type="file" id="imagen_destino" name="imagen_destino" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <section id="destinos">
            <h2>Destinos Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo de Destino</th>
                        <th>Avión 1</th>
                        <th>Avión 2</th>
                        <th>Transporte Terrestre 1</th>
                        <th>Transporte Terrestre 2</th>
                        <th>Cliente</th>
                        <th>País</th>
                        <th>Reseña</th>
                        <th>Coordenadas</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Obtener y mostrar los destinos registrados en la base de datos
                    $result = SEMH_obtenerDestinos($conn);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id_destino']; ?></td>
                            <td><?php echo $row['id_tipodestino']; ?></td>
                            <td><?php echo $row['id_avion1']; ?></td>
                            <td><?php echo $row['id_avion2']; ?></td>
                            <td><?php echo $row['id_transpterrestre1']; ?></td>
                            <td><?php echo $row['id_transpterrestre2']; ?></td>
                            <td><?php echo $row['id_cliente']; ?></td>
                            <td><?php echo $row['país']; ?></td>
                            <td><?php echo $row['reseña']; ?></td>
                            <td><?php echo $row['coordenadas']; ?></td>
                            <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagen_destino']); ?>" width="100" height="100"></td>
                            <td>
                                <a href="editar_destino.php?id=<?php echo $row['id_destino']; ?>" class="btn btn-edit">Editar</a>
                                <a href="eliminar_destino.php?id=<?php echo $row['id_destino']; ?>" class="btn btn-delete">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; SEMH – PW1 – 2024/06/04</p>
    </footer>
</body>

</html>