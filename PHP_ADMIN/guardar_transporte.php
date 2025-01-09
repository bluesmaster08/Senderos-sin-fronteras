<?php
include('../include/SEMH_conn_BD.php');

// Función para guardar un nuevo transporte terrestre en la base de datos
function SEMH_guardarTransporte($conn, $tipo_transporte, $placa, $capacidad_pasajeros, $año_fabricacion, $empresa_propietaria)
{
    $query = "INSERT INTO tbltranspterrestre (tipo_transporte, placa, capacidad_pasajeros, año_fabricacion, empresa_propietaria) 
              VALUES ('$tipo_transporte', '$placa', $capacidad_pasajeros, $año_fabricacion, '$empresa_propietaria')";
    return mysqli_query($conn, $query);
}
// Verificar si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    // Guardar el nuevo transporte terrestre en la base de datos
    if (SEMH_guardarTransporte($conn, $tipo_transporte, $placa, $capacidad_pasajeros, $año_fabricacion, $empresa_propietaria)) {
        header("Location: SEMH_t_terrestres.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
