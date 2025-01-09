<?php
include('../include/SEMH_conn_BD.php');

// Función para obtener un transporte terrestre por su ID
function SEMH_obtenerTransportePorID($conn, $id)
{
    $query = "SELECT * FROM tbltranspterrestre WHERE id_transpterrestre = $id";
    return mysqli_query($conn, $query);
}

// Función para actualizar un transporte terrestre
function SEMH_actualizarTransporte($conn, $id, $tipo_transporte, $placa, $capacidad_pasajeros, $año_fabricacion, $empresa_propietaria)
{
    $query = "UPDATE tbltranspterrestre SET 
              tipo_transporte = '$tipo_transporte', 
              placa = '$placa', 
              capacidad_pasajeros = $capacidad_pasajeros, 
              año_fabricacion = $año_fabricacion, 
              empresa_propietaria = '$empresa_propietaria' 
              WHERE id_transpterrestre = $id";
    return mysqli_query($conn, $query);
}

// Verificar si se ha pasado un ID en la URL para obtener los datos del transporte terrestre a editar
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = SEMH_obtenerTransportePorID($conn, $id);

    // Verificar si se encontró un registro con el ID proporcionado
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $tipo_transporte = $row['tipo_transporte'];
        $placa = $row['placa'];
        $capacidad_pasajeros = $row['capacidad_pasajeros'];
        $año_fabricacion = $row['año_fabricacion'];
        $empresa_propietaria = $row['empresa_propietaria'];
    }
}

// Verificar si se ha enviado el formulario de actualización
if (isset($_POST['update'])) {
    $id = intval($_GET['id']);
    $tipo_transporte = trim($_POST['tipo_transporte']);
    $placa = trim($_POST['placa']);
    $capacidad_pasajeros = intval($_POST['capacidad_pasajeros']);
    $año_fabricacion = intval($_POST['año_fabricacion']);
    $empresa_propietaria = trim($_POST['empresa_propietaria']);

    // Validaciones de los datos del formulario
    if (empty($tipo_transporte) || empty($placa) || empty($capacidad_pasajeros) || empty($año_fabricacion) || empty($empresa_propietaria)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    if (!is_numeric($capacidad_pasajeros) || $capacidad_pasajeros < 1 || $capacidad_pasajeros > 80) {
        echo "La capacidad de pasajeros debe ser un número entre 1 y 80.";
        exit;
    }

    if ($año_fabricacion < 2000 || $año_fabricacion > 2024) {
        echo "El año de fabricación debe estar entre 2000 y 2024.";
        exit;
    }

    // Actualizar los datos del transporte terrestre en la base de datos
    if (SEMH_actualizarTransporte($conn, $id, $tipo_transporte, $placa, $capacidad_pasajeros, $año_fabricacion, $empresa_propietaria)) {
        header("Location: SEMH_t_terrestres.php");
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
    <title>Editar Transporte Terrestre</title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>

<body>
    <header>
        <h1>Editar Transporte Terrestre</h1>
    </header>
    <main>
        <!-- Formulario para editar un transporte terrestre -->
        <form action="editar_transporte.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="form-group">
                <label for="tipo_transporte">Tipo de Transporte:</label>
                <input type="text" id="tipo_transporte" name="tipo_transporte" value="<?php echo $tipo_transporte; ?>" required>
            </div>
            <div class="form-group">
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" value="<?php echo $placa; ?>" required>
            </div>
            <div class="form-group">
                <label for="capacidad_pasajeros">Capacidad de Pasajeros:</label>
                <input type="number" id="capacidad_pasajeros" name="capacidad_pasajeros" min="1" max="80" value="<?php echo $capacidad_pasajeros; ?>" required>
            </div>
            <div class="form-group">
                <label for="año_fabricacion">Año de Fabricación:</label>
                <input type="number" id="año_fabricacion" name="año_fabricacion" min="2000" max="2024" value="<?php echo $año_fabricacion; ?>" required>
            </div>
            <div class="form-group">
                <label for="empresa_propietaria">Empresa Propietaria:</label>
                <input type="text" id="empresa_propietaria" name="empresa_propietaria" value="<?php echo $empresa_propietaria; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
        </form>
    </main>
    <footer>
        <p>&copy; SEMH – PW1 – 2024/05/24</p>
    </footer>
</body>

</html>