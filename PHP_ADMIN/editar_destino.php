<?php
include("../include/SEMH_conn_BD.php");

// Función para obtener un destino por su ID
function SEMH_obtenerDestinoPorID($conn, $id)
{
    $query = "SELECT * FROM tbldestino WHERE id_destino = $id";
    return mysqli_query($conn, $query);
}

// Función para actualizar un destino
function SEMH_actualizarDestino($conn, $id, $id_tipodestino, $id_avion1, $id_avion2, $id_transpterrestre1, $id_transpterrestre2, $id_cliente, $pais, $reseña, $coordenadas, $imagen_destino = null)
{
    $id_tipodestino = $id_tipodestino ? "'$id_tipodestino'" : "NULL";
    if ($imagen_destino) {
        $query = "UPDATE tbldestino SET id_tipodestino = $id_tipodestino, id_avion1 = '$id_avion1', id_avion2 = '$id_avion2', id_transpterrestre1 = '$id_transpterrestre1', id_transpterrestre2 = '$id_transpterrestre2', id_cliente = '$id_cliente', país = '$pais', reseña = '$reseña', coordenadas = '$coordenadas', imagen_destino = ? WHERE id_destino = $id";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $imagen_destino);
        return $stmt->execute();
    } else {
        $query = "UPDATE tbldestino SET id_tipodestino = $id_tipodestino, id_avion1 = '$id_avion1', id_avion2 = '$id_avion2', id_transpterrestre1 = '$id_transpterrestre1', id_transpterrestre2 = '$id_transpterrestre2', id_cliente = '$id_cliente', país = '$pais', reseña = '$reseña', coordenadas = '$coordenadas' WHERE id_destino = $id";
        return mysqli_query($conn, $query);
    }
}

// Función para verificar si un destino está vinculado a un tipo de destino
function SEMH_verificarDestinoVinculado($conn, $id)
{
    $query = "SELECT id_tipodestino FROM tbldestino WHERE id_destino = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return !empty($row['id_tipodestino']);
}

// Función para eliminar un destino por su ID
function SEMH_eliminar_destino($conn, $id)
{
    // Verificar si el destino está vinculado a un tipo de destino
    if (SEMH_verificarDestinoVinculado($conn, $id)) {
        echo "Error: El destino no puede ser eliminado porque está vinculado a un tipo de destino.";
        return false;
    }

    $query = "DELETE FROM tbldestino WHERE id_destino = $id";
    return mysqli_query($conn, $query);
}

// Funciones para obtener los datos necesarios para los menús desplegables
function SEMH_obtenerTiposDestino($conn)
{
    return mysqli_query($conn, "SELECT * FROM tbltipodestino");
}

function SEMH_obtenerAviones($conn)
{
    return mysqli_query($conn, "SELECT * FROM tblavion");
}

function SEMH_obtenerTransportesTerrestres($conn)
{
    return mysqli_query($conn, "SELECT * FROM tbltranspterrestre");
}

function SEMH_obtenerClientes($conn)
{
    return mysqli_query($conn, "SELECT * FROM tblcliente");
}

// Obtener el destino a editar si se ha proporcionado un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = SEMH_obtenerDestinoPorID($conn, $id);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $id_tipodestino = $row['id_tipodestino'];
        $id_avion1 = $row['id_avion1'];
        $id_avion2 = $row['id_avion2'];
        $id_transpterrestre1 = $row['id_transpterrestre1'];
        $id_transpterrestre2 = $row['id_transpterrestre2'];
        $id_cliente = $row['id_cliente'];
        $pais = $row['país'];
        $reseña = $row['reseña'];
        $coordenadas = $row['coordenadas'];
        $imagen_destino = $row['imagen_destino'];
    }
}

// Actualizar el destino si se ha enviado el formulario
if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $id_tipodestino = $_POST['id_tipodestino'];
    $id_avion1 = $_POST['id_avion1'];
    $id_avion2 = $_POST['id_avion2'];
    $id_transpterrestre1 = $_POST['id_transpterrestre1'];
    $id_transpterrestre2 = $_POST['id_transpterrestre2'];
    $id_cliente = $_POST['id_cliente'];
    $pais = $_POST['pais'];
    $reseña = $_POST['reseña'];
    $coordenadas = $_POST['coordenadas'];

    // Verificar si se ha subido una nueva imagen
    if (!empty($_FILES['imagen_destino']['tmp_name'])) {
        $imagen_destino = file_get_contents($_FILES['imagen_destino']['tmp_name']);
    }

    // Actualizar el destino en la base de datos
    if (SEMH_actualizarDestino($conn, $id, $id_tipodestino, $id_avion1, $id_avion2, $id_transpterrestre1, $id_transpterrestre2, $id_cliente, $pais, $reseña, $coordenadas, $imagen_destino ?? null)) {
        header("Location: SEMH_destinos.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Destino</title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>

<body>
    <header>
        <h1>Editar Destino</h1>
    </header>
    <main>
        <form action="editar_destino.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id_tipodestino">Tipo de Destino (Opcional):</label>
                <select id="id_tipodestino" name="id_tipodestino">
                    <option value="">Seleccionar Tipo de Destino (Opcional)</option>
                    <?php
                    $tiposDestino = SEMH_obtenerTiposDestino($conn);
                    while ($row = mysqli_fetch_assoc($tiposDestino)) {
                        $selected = ($row['id_tipodestino'] == $id_tipodestino) ? 'selected' : '';
                        echo "<option value='{$row['id_tipodestino']}' $selected>{$row['nombre_destino']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_avion1">Avión 1:</label>
                <select id="id_avion1" name="id_avion1" required>
                    <?php
                    $aviones1 = SEMH_obtenerAviones($conn);
                    while ($row = mysqli_fetch_assoc($aviones1)) {
                        $selected = ($row['id_avion'] == $id_avion1) ? 'selected' : '';
                        echo "<option value='{$row['id_avion']}' $selected>{$row['modelo']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_avion2">Avión 2:</label>
                <select id="id_avion2" name="id_avion2" required>
                    <?php
                    $aviones2 = SEMH_obtenerAviones($conn);
                    while ($row = mysqli_fetch_assoc($aviones2)) {
                        $selected = ($row['id_avion'] == $id_avion2) ? 'selected' : '';
                        echo "<option value='{$row['id_avion']}' $selected>{$row['modelo']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_transpterrestre1">Transporte Terrestre 1:</label>
                <select id="id_transpterrestre1" name="id_transpterrestre1" required>
                    <?php
                    $transportesTerrestres1 = SEMH_obtenerTransportesTerrestres($conn);
                    while ($row = mysqli_fetch_assoc($transportesTerrestres1)) {
                        $selected = ($row['id_transpterrestre'] == $id_transpterrestre1) ? 'selected' : '';
                        echo "<option value='{$row['id_transpterrestre']}' $selected>{$row['tipo_transporte']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_transpterrestre2">Transporte Terrestre 2:</label>
                <select id="id_transpterrestre2" name="id_transpterrestre2" required>
                    <?php
                    $transportesTerrestres2 = SEMH_obtenerTransportesTerrestres($conn);
                    while ($row = mysqli_fetch_assoc($transportesTerrestres2)) {
                        $selected = ($row['id_transpterrestre'] == $id_transpterrestre2) ? 'selected' : '';
                        echo "<option value='{$row['id_transpterrestre']}' $selected>{$row['tipo_transporte']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_cliente">Cliente:</label>
                <select id="id_cliente" name="id_cliente" required>
                    <?php
                    $clientes = SEMH_obtenerClientes($conn);
                    while ($row = mysqli_fetch_assoc($clientes)) {
                        $selected = ($row['id_cliente'] == $id_cliente) ? 'selected' : '';
                        echo "<option value='{$row['id_cliente']}' $selected>{$row['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="pais">País:</label>
                <input type="text" id="pais" name="pais" value="<?php echo $pais; ?>" required>
            </div>
            <div class="form-group">
                <label for="reseña">Reseña:</label>
                <input type="text" id="reseña" name="reseña" value="<?php echo $reseña; ?>" required>
            </div>
            <div class="form-group">
                <label for="coordenadas">Coordenadas:</label>
                <input type="text" id="coordenadas" name="coordenadas" value="<?php echo $coordenadas; ?>" required>
            </div>
            <div class="form-group">
                <label for="imagen_destino">Imagen del Destino:</label>
                <input type="file" id="imagen_destino" name="imagen_destino">
                <?php if ($imagen_destino) : ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen_destino); ?>" width="100" height="100">
                <?php endif; ?>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
        </form>
    </main>

    <footer>
        <p>&copy; SEMH – PW1 – 2024/05/24</p>
    </footer>
</body>

</html>