<?php
include("../include/SEMH_conn_BD.php");

// Función para eliminar un transporte terrestre por su ID
function SEMH_eliminarTransporte($conn, $id)
{
    $query = "DELETE FROM tbltranspterrestre WHERE id_transpterrestre = $id";
    return mysqli_query($conn, $query);
}

// Verificar si se ha pasado un ID en la URL para eliminar el transporte terrestre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el transporte terrestre de la base de datos
    if (SEMH_eliminarTransporte($conn, $id)) {
        header("Location: SEMH_t_terrestres.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
