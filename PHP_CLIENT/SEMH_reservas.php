<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas - Senderos sin fronteras</title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>

<body>
    <header>
        <h1>Mis Reservas</h1>
        <nav>
            <a href="SEMH_home_cliente.php">Inicio || </a>
            <a href="../index.php"> Cerrar Sesión</a>
        </nav>
    </header>
    <main>
        <h2>Realiza tu reserva aqui</h2>
        <!-- FORMULARIO PARA REALIZAR UNA RESERVACIÓN DE DESTINO TURÍSTICO -->
        <div class="card card-body reservation-form">
            <form action="gaurdar_reservacion.php" method="POST">
                <!-- Input para el destino turístico -->
                <div class="form-group">
                    <label for="destino">¿A dónde viajarás?</label>
                    <input type="text" id="destino" name="destino" class="form-control" placeholder="Destino" autofocus>
                </div>
                <!-- Input para la fecha de viaje -->
                <div class="form-group">
                    <label for="fecha_viaje">¿Cuándo viajarás?</label>
                    <input type="date" id="fecha_viaje" name="fecha_viaje" class="form-control" placeholder="Fecha de Viaje">
                </div>
                <!-- Input para el medio de transporte -->
                <div class="form-group">
                    <label for="medio_transporte">¿En qué viajarás?</label>
                    <input type="text" id="medio_transporte" name="medio_transporte" class="form-control" placeholder="Medio de Transporte">
                </div>
                <!-- Input para la cantidad de personas que viajarán -->
                <div class="form-group">
                    <label for="cantidad_personas">¿Cuántos viajarán?</label>
                    <input type="number" id="cantidad_personas" name="cantidad_personas" class="form-control" placeholder="Cantidad de Personas">
                </div>
                <!-- Botón para realizar la reserva -->
                <input type="submit" class="btn btn-primary" name="save_reservation" value="Realizar Reserva">
            </form>
        </div>

        <!-- TABLA QUE MUESTRA LAS RESERVACIONES DEL CLIENTE -->
        <section id="reservas">
            <h2>Tus Reservas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Destino</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>recuperar dato de BD con PHP</td>
                        <td>recuperar dato de BD con PHP</td>
                        <td>recuperar dato de BD con PHP</td>
                        <td> <!-- Botón de editar -->
                            <a href="edit_reserva.php" class="btn btn-edit">Editar</a>
                            <!-- Botón de eliminar -->
                            <a href="delete_reserva.php" class="btn btn-delete">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; SEMH – PW1 – 2024/05/11</p>
    </footer>
</body>

</html>