<?php
include('../include/SEMH_conn_BD.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_destino = $_POST['nombre_destino'];
    $actividades_populares = $_POST['actividades_populares'];
    $epoca_sugerida = $_POST['epoca_sugerida'];

    $query = "INSERT INTO tbltipodestino (nombre_destino, actividades_populares, epoca_sugerida) 
              VALUES ('$nombre_destino', '$actividades_populares', '$epoca_sugerida')";

    if (mysqli_query($conn, $query)) {
        header("Location: SEMH_tipo_destino.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
