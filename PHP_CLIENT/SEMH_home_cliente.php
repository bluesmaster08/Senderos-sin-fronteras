<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senderos sin fronteras - Home cliente</title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>

<body style="background-image: url('../IMG/detalle_destino.jpg')">
    <header>
        <h1>Tu aventura empieza aquí...</h1>
    </header>
    <nav>
        <ul>
            <li><a href="SEMH_reservas.php">Mis Reservas</a></li>
            <li><a href="../index.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <main>
        <h1>Destinos Disponibles</h1>
        <section id="destinos">
            <!--MUESTRA LOS REGISTROS DE LAS TAREAS EN UNA TABLA-->
            <table class="table table-bordered task-table">
                <!-- Cabecera de la tabla -->
                <thead>
                    <tr>
                        <th>Destino</th>
                        <th>País</th>
                        <th>Reseña</th>
                        <th>Imagen</th>
                        <th>Acciones </th>
                    </tr>
                </thead>
                <!-- Cuerpo de la tabla (información de la base de datos) -->
                <td>recuperar dato de BD con PHP</td>
                <td>recuperar dato de BD con PHP</td>
                <td>recuperar dato de BD con PHP</td>
                <td>recuperar dato de BD con PHP</td>
                <td>
                    <a href="SEMH_reservas.php"> <button>Reservar</button></a>
                </td>
                </td>
                <tbody>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; SEMH – PW1 – 2024/05/11</p>
    </footer>
</body>

</html>