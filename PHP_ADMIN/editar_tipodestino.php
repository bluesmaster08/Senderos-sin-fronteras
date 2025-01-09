<?php
include("../include/SEMH_conn_BD.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tbltipodestino WHERE id_tipodestino = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nombre_destino = $row['nombre_destino'];
        $actividades_populares = $row['actividades_populares'];
        $epoca_sugerida = $row['epoca_sugerida'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    $nombre_destino = $_POST['nombre_destino'];
    $actividades_populares = $_POST['actividades_populares'];
    $epoca_sugerida = $_POST['epoca_sugerida'];

    $query = "UPDATE tbltipodestino SET nombre_destino = '$nombre_destino', 
              actividades_populares = '$actividades_populares', 
              epoca_sugerida = '$epoca_sugerida' WHERE id_tipodestino = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: SEMH_tipo_destino.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tipo de Destino</title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>

<body>
    <header>
        <h1>Editar Tipo de Destino</h1>
    </header>
    <main>
        <form action="editar_tipodestino.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="form-group">
                <label for="nombre_destino">Nombre del Destino:</label>
                <input type="text" id="nombre_destino" name="nombre_destino" value="<?php echo $nombre_destino; ?>" required>
            </div>
            <div class="form-group">
                <label for="actividades_populares">Actividades Populares:</label>
                <input type="text" id="actividades_populares" name="actividades_populares" value="<?php echo $actividades_populares; ?>" required>
            </div>
            <div class="form-group">
                <label for="epoca_sugerida">Época Sugerida:</label>
                <input type="text" id="epoca_sugerida" name="epoca_sugerida" value="<?php echo $epoca_sugerida; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </main>
</body>
<footer>
    <p>&copy; SEMH – PW1 – 2024/05/24</p>
</footer>

</html>