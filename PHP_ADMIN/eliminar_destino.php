<?php
// Incluir el archivo de conexión a la base de datos
include("../include/SEMH_conn_BD.php");

// Función para verificar si un destino está vinculado a un tipo de destino
function SEMH_verificarDestinoVinculado($conn, $id)
{
    // Consulta para verificar si el destino tiene un tipo de destino asociado
    $query = "SELECT id_tipodestino FROM tbldestino WHERE id_destino = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Retorna verdadero si el destino tiene un tipo de destino asociado, falso en caso contrario
    return !empty($row['id_tipodestino']);
}

// Función para eliminar un destino por su ID
function SEMH_eliminar_destino($conn, $id)
{
    // Verificar si el destino está vinculado a un tipo de destino
    if (SEMH_verificarDestinoVinculado($conn, $id)) {
        // Si el destino está vinculado a un tipo de destino, mostrar un mensaje de error y no eliminar
        echo "Error: El destino no puede ser eliminado porque está vinculado a un tipo de destino.";
        return false;
    }

    // Consulta para eliminar el destino
    $query = "DELETE FROM tbldestino WHERE id_destino = $id";
    return mysqli_query($conn, $query);
}

// Eliminar el destino si se ha proporcionado un ID
if (isset($_GET['id'])) {
    // Obtener el ID del destino desde los parámetros de la URL
    $id = $_GET['id'];

    // Intentar eliminar el destino y redirigir a la página de destinos si tiene éxito
    if (SEMH_eliminar_destino($conn, $id)) {
        header("Location: SEMH_destinos.php");
    } else {
        // Si hay un error, mostrar el mensaje de error
        echo "Error: " . mysqli_error($conn);
    }
}
