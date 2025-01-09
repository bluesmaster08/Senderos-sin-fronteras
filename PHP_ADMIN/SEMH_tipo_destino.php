<?php include("../include/SEMH_conn_BD.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tipos de Destino</title>
    <link rel="stylesheet" href="../CSS/styles.css">
    <script src="../JS/validaciones_tipo_destino.js"></script>
</head>

<body>
    <header>
        <h1>Gestión de Tipos de Destino</h1>
        <nav>
            <a href="SEMH_home_admin.php">Inicio || </a>
            <a href="../index.php"> Cerrar Sesión</a>
        </nav>
    </header>
    <main>
        <h2>Registrar un Nuevo Tipo de Destino</h2>

        <form action="guardar_tipodestino.php" method="POST">
            <div class="form-group">
                <label for="nombre_destino">Nombre del Destino:</label>
                <input type="text" id="nombre_destino" name="nombre_destino" placeholder="Nombre del Destino" required>
            </div>
            <div class="form-group">
                <label for="actividades_populares">Actividades Populares:</label>
                <input type="text" id="actividades_populares" name="actividades_populares" placeholder="Actividades Populares" required>
            </div>
            <div class="form-group">
                <label for="epoca_sugerida">Época Sugerida:</label>
                <input type="text" id="epoca_sugerida" name="epoca_sugerida" placeholder="Época Sugerida" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <section id="tipos_destino">
            <h2>Tipos de Destino Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre del Destino</th>
                        <th>Actividades Populares</th>
                        <th>Época Sugerida</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbltipodestino";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['nombre_destino']; ?></td>
                            <td><?php echo $row['actividades_populares']; ?></td>
                            <td><?php echo $row['epoca_sugerida']; ?></td>
                            <td>
                                <a href="editar_tipodestino.php?id=<?php echo $row['id_tipodestino']; ?>" class="btn btn-edit">Editar</a>
                                <a href="eliminar_tipodestino.php?id=<?php echo $row['id_tipodestino']; ?>" class="btn btn-delete">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; SEMH – PW1 – 2024/05/24</p>
    </footer>
</body>

</html>