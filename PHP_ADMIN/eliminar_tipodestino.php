<?php
include("../include/SEMH_conn_BD.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar los registros dependientes en tbldestino
    $query_delete_dependents = "DELETE FROM tbldestino WHERE id_tipodestino = $id";
    if (mysqli_query($conn, $query_delete_dependents)) {
        // Luego eliminar el registro en tbltipodestino
        $query_delete_tipo = "DELETE FROM tbltipodestino WHERE id_tipodestino = $id";
        if (mysqli_query($conn, $query_delete_tipo)) {
            header("Location: SEMH_tipo_destino.php");
        } else {
            echo "Error al eliminar en tbltipodestino: " . mysqli_error($conn);
        }
    } else {
        echo "Error al eliminar dependientes en tbldestino: " . mysqli_error($conn);
    }
}
