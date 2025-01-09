<?php
include("../include/SEMH_conn_BD.php"); // Incluye el archivo de conexión a la base de datos

// Función para obtener un cliente por su ID
function SEMH_obtenerClientePorID($conn, $id)
{
    $query = "SELECT * FROM tblcliente WHERE id_cliente = $id"; // Consulta SQL para obtener un cliente específico por ID
    return mysqli_query($conn, $query); // Ejecuta la consulta y devuelve el resultado
}

// Función para actualizar los datos de un cliente
function SEMH_actualizarCliente($conn, $id, $nombre, $apellido_paterno, $apellido_materno, $rfc, $curp)
{
    $query = "UPDATE tblcliente SET nombre = '$nombre', apellido_paterno = '$apellido_paterno', apellido_materno = '$apellido_materno', rfc = '$rfc', curp = '$curp' WHERE id_cliente = $id"; // Consulta SQL para actualizar los datos de un cliente
    return mysqli_query($conn, $query); // Ejecuta la consulta y devuelve el resultado
}

if (isset($_GET['id'])) { // Verifica si se ha proporcionado un ID en la URL
    $id = $_GET['id'];
    $result = SEMH_obtenerClientePorID($conn, $id); // Llama a la función para obtener los datos del cliente

    if (mysqli_num_rows($result) == 1) { // Verifica si se ha encontrado el cliente
        $row = mysqli_fetch_assoc($result); // Obtiene los datos del cliente
        $nombre = $row['nombre'];
        $apellido_paterno = $row['apellido_paterno'];
        $apellido_materno = $row['apellido_materno'];
        $rfc = $row['rfc'];
        $curp = $row['curp'];
    }
}

if (isset($_POST['update'])) { // Verifica si se ha enviado el formulario de actualización
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $rfc = $_POST['rfc'];
    $curp = $_POST['curp'];

    // Validaciones
    if (empty($nombre) || empty($apellido_paterno) || empty($rfc) || empty($curp)) {
        die("Todos los campos obligatorios deben ser llenados.");
    }

    $stringPattern = "/^[a-zA-Z\s]+$/";

    if (!preg_match($stringPattern, $nombre)) {
        die("El nombre solo debe contener letras y espacios.");
    }
    if (!preg_match($stringPattern, $apellido_paterno)) {
        die("El apellido paterno solo debe contener letras y espacios.");
    }
    if (!preg_match($stringPattern, $apellido_materno)) {
        die("El apellido materno solo debe contener letras y espacios.");
    }
    if (strlen($rfc) != 13) {
        die("El RFC debe tener exactamente 13 caracteres.");
    }
    if (strlen($curp) != 18) {
        die("El CURP debe tener exactamente 18 caracteres.");
    }

    if (SEMH_actualizarCliente($conn, $id, $nombre, $apellido_paterno, $apellido_materno, $rfc, $curp)) { // Llama a la función para actualizar el cliente
        header("Location: SEMH_clientes.php"); // Redirige a la página de clientes si la actualización es exitosa
    } else {
        echo "Error al actualizar: " . mysqli_error($conn); // Muestra un error si la actualización falla
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../CSS/styles.css"> <!-- Enlace al archivo CSS para los estilos -->
</head>

<body>
    <header>
        <h1>Editar Cliente</h1>
    </header>

    <main>
        <form action="editar_cliente.php?id=<?php echo $_GET['id']; ?>" method="POST"> <!-- Formulario para editar un cliente -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required pattern="[a-zA-Z\s]+"> <!-- Campo de texto con validación para solo letras y espacios -->
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?php echo $apellido_paterno; ?>" required pattern="[a-zA-Z\s]+"> <!-- Campo de texto con validación para solo letras y espacios -->
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" value="<?php echo $apellido_materno; ?>" required pattern="[a-zA-Z\s]+"> <!-- Campo de texto con validación para solo letras y espacios -->
            </div>
            <div class="form-group">
                <label for="rfc">RFC:</label>
                <input type="text" id="rfc" name="rfc" value="<?php echo $rfc; ?>" required minlength="13" maxlength="13"> <!-- Campo de texto con validación de longitud exacta de 13 caracteres -->
            </div>
            <div class="form-group">
                <label for="curp">CURP:</label>
                <input type="text" id="curp" name="curp" value="<?php echo $curp; ?>" required minlength="18" maxlength="18"> <!-- Campo de texto con validación de longitud exacta de 18 caracteres -->
            </div>
            <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
        </form>
    </main>

    <footer>
        <p>&copy; SEMH – PW1 – 2024/06/04</p>
    </footer>
</body>

</html>