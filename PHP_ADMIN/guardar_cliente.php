<?php
include("../include/SEMH_conn_BD.php"); // Incluye el archivo de conexión a la base de datos

// Función para guardar un nuevo cliente en la base de datos
function SEMH_guardarCliente($conn, $nombre, $apellido_paterno, $apellido_materno, $rfc, $curp)
{
    $query = "INSERT INTO tblcliente (nombre, apellido_paterno, apellido_materno, rfc, curp) VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$rfc', '$curp')"; // Consulta SQL para insertar un nuevo cliente
    return mysqli_query($conn, $query); // Ejecuta la consulta y devuelve el resultado
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Verifica si el formulario se ha enviado usando el método POST
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $rfc = $_POST['rfc'];
    $curp = $_POST['curp'];

    // Validaciones
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

    if (SEMH_guardarCliente($conn, $nombre, $apellido_paterno, $apellido_materno, $rfc, $curp)) { // Llama a la función para guardar el cliente
        header("Location: SEMH_clientes.php"); // Redirige a la página de clientes si el guardado es exitoso
    } else {
        echo "Error al guardar el cliente: " . mysqli_error($conn); // Muestra un error si el guardado falla
    }
}
