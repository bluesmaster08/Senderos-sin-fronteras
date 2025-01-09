<?php
include("../include/SEMH_conn_BD.php");

// Función para guardar un nuevo avión en la base de datos
function SEMH_guardarAvion($conn, $numero_serie, $modelo, $capacidad_asientos, $empresa_propietaria)
{
    $query = "INSERT INTO tblavion (numero_serie, modelo, capacidad_asientos, empresa_propietaria) VALUES ('$numero_serie', '$modelo', $capacidad_asientos, '$empresa_propietaria')";
    return mysqli_query($conn, $query); // Ejecuta la consulta de inserción
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Guarda el avión si las validaciones son correctas
    if (SEMH_guardarAvion($conn, $numero_serie, $modelo, $capacidad_asientos, $empresa_propietaria)) {
        header("Location: SEMH_aviones.php"); // Redirige a la página principal
    } else {
        echo "Error: " . mysqli_error($conn); // Muestra un error si la inserción falla
    }
}
