<?php
include("../include/SEMH_conn_BD.php"); // Incluye el archivo de conexión a la base de datos

// Función para eliminar un cliente y sus datos relacionados
function SEMH_eliminarCliente($conn, $id)
{
    $deleteRelatedQuery = "DELETE FROM tbldestino WHERE id_cliente = $id"; // Consulta SQL para eliminar datos relacionados en tbldestino
    if (!mysqli_query($conn, $deleteRelatedQuery)) { // Ejecuta la consulta y verifica si hubo errores
        return false;
    }

    $query = "DELETE FROM tblcliente WHERE id_cliente = $id"; // Consulta SQL para eliminar el cliente
    return mysqli_query($conn, $query); // Ejecuta la consulta y devuelve el resultado
}

if (isset($_GET['id'])) { // Verifica si se ha proporcionado un ID en la URL
    $id = $_GET['id'];

    if (SEMH_eliminarCliente($conn, $id)) { // Llama a la función para eliminar el cliente
        header("Location: SEMH_clientes.php"); // Redirige a la página de clientes si la eliminación es exitosa
        exit;
    } else {
        echo "Error al eliminar el cliente: " . mysqli_error($conn); // Muestra un error si la eliminación falla
    }
}
