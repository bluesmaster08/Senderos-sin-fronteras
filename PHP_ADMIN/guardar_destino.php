<?php
include('../include/SEMH_conn_BD.php');

// Función para guardar un nuevo destino en la base de datos
function SEMH_guardarDestino($conn, $id_tipodestino, $id_avion1, $id_avion2, $id_transpterrestre1, $id_transpterrestre2, $id_cliente, $pais, $reseña, $coordenadas, $imagen_destino)
{
    $id_tipodestino = $id_tipodestino ? "'$id_tipodestino'" : "NULL";
    $query = "INSERT INTO tbldestino (id_tipodestino, id_avion1, id_avion2, id_transpterrestre1, id_transpterrestre2, id_cliente, país, reseña, coordenadas, imagen_destino)
              VALUES ($id_tipodestino, '$id_avion1', '$id_avion2', '$id_transpterrestre1', '$id_transpterrestre2', '$id_cliente', '$pais', '$reseña', '$coordenadas', '$imagen_destino')";
    return mysqli_query($conn, $query);
}
// Guardar el destino si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_tipodestino = $_POST['id_tipodestino'];
    $id_avion1 = $_POST['id_avion1'];
    $id_avion2 = $_POST['id_avion2'];
    $id_transpterrestre1 = $_POST['id_transpterrestre1'];
    $id_transpterrestre2 = $_POST['id_transpterrestre2'];
    $id_cliente = $_POST['id_cliente'];
    $pais = $_POST['pais'];
    $reseña = $_POST['reseña'];
    $coordenadas = $_POST['coordenadas'];
    $imagen_destino = addslashes(file_get_contents($_FILES['imagen_destino']['tmp_name']));

    if (SEMH_guardarDestino($conn, $id_tipodestino, $id_avion1, $id_avion2, $id_transpterrestre1, $id_transpterrestre2, $id_cliente, $pais, $reseña, $coordenadas, $imagen_destino)) {
        header("Location: SEMH_destinos.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
