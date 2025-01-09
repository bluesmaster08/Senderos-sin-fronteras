<?php
include("../include/SEMH_conn_BD.php");

// Función para obtener un avión por su ID
function SEMH_obtenerAvionPorID($conn, $id)
{
    $query = "SELECT * FROM tblavion WHERE id_avion = $id";
    return mysqli_query($conn, $query); // Ejecuta la consulta y retorna el resultado
}

// Función para actualizar los datos de un avión
function SEMH_actualizarAvion($conn, $id, $numero_serie, $modelo, $capacidad_asientos, $empresa_propietaria)
{
    $query = "UPDATE tblavion SET numero_serie = '$numero_serie', modelo = '$modelo', capacidad_asientos = $capacidad_asientos, empresa_propietaria = '$empresa_propietaria' WHERE id_avion = $id";
    return mysqli_query($conn, $query); // Ejecuta la consulta de actualización
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = SEMH_obtenerAvionPorID($conn, $id);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $numero_serie = $row['numero_serie'];
        $modelo = $row['modelo'];
        $capacidad_asientos = $row['capacidad_asientos'];
        $empresa_propietaria = $row['empresa_propietaria'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $numero_serie = $_POST['numero_serie'];
    $modelo = $_POST['modelo'];
    $capacidad_asientos = $_POST['capacidad_asientos'];
    $empresa_propietaria = $_POST['empresa_propietaria'];

    // Validaciones de entrada
    if (empty($numero_serie) || empty($modelo) || empty($capacidad_asientos) || empty($empresa_propietaria)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    if (!is_numeric($capacidad_asientos) || $capacidad_asientos < 1 || $capacidad_asientos > 80) {
        echo "La capacidad de asientos debe ser un número entre 1 y 80.";
        exit;
    }

    // Actualiza el avión si las validaciones son correctas
    if (SEMH_actualizarAvion($conn, $id, $numero_serie, $modelo, $capacidad_asientos, $empresa_propietaria)) {
        header("Location: SEMH_aviones.php"); // Redirige a la página principal
    } else {
        echo "Error: " . mysqli_error($conn); // Muestra un error si la actualización falla
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Avión</title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>

<body>
    <header>
        <h1>Editar Avión</h1>
    </header>

    <main>
        <!-- Formulario para editar avión -->
        <form action="editar_avion.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="form-group">
                <label for="numero_serie">Número de Serie:</label>
                <input type="text" id="numero_serie" name="numero_serie" value="<?php echo $numero_serie; ?>" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" value="<?php echo $modelo; ?>" required>
            </div>
            <div class="form-group">
                <label for="capacidad_asientos">Capacidad de Asientos:</label>
                <input type="number" id="capacidad_asientos" name="capacidad_asientos" value="<?php echo $capacidad_asientos; ?>" required min="1" max="80">
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