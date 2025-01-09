<?php
include("../include/SEMH_conn_BD.php");

// Función para eliminar un avión por su ID
function SEMH_eliminarAvion($conn, $id)
{
    $query = "DELETE FROM tblavion WHERE id_avion = $id";
    return mysqli_query($conn, $query); // Ejecuta la consulta de eliminación
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Elimina el avión si se proporciona un ID válido
    if (SEMH_eliminarAvion($conn, $id)) {
        header("Location: SEMH_aviones.php"); // Redirige a la página principal
    } else {
        echo "Error: " . mysqli_error($conn); // Muestra un error si la eliminación falla
    }
}
