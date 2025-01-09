<?php
include("../include/SEMH_conn_BD.php"); // Incluye el archivo de conexión a la base de datos

// Función para obtener todos los clientes de la base de datos
function SEMH_obtenerClientes($conn)
{
    $query = "SELECT * FROM tblcliente"; // Consulta SQL para obtener todos los registros de la tabla tblcliente
    return mysqli_query($conn, $query); // Ejecuta la consulta y devuelve el resultado
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="../CSS/styles.css"> <!-- Enlace al archivo CSS para los estilos -->
    <script src="../JS/curp.js"></script> <!-- Enlace al archivo JavaScript para la CURP -->
</head>

<body>
    <header>
        <h1>Gestión de Clientes</h1>
        <nav>
            <a href="SEMH_home_admin.php">Inicio || </a>
            <a href="../index.php">Cerrar Sesión</a>
        </nav>
    </header>
    <main>
        <h2>Registrar un Nuevo Cliente</h2>
        <form action="guardar_cliente.php" method="POST"> <!-- Formulario para registrar un nuevo cliente -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required pattern="[a-zA-Z\s]+"> <!-- Campo de texto con validación para solo letras y espacios -->
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" required pattern="[a-zA-Z\s]+"> <!-- Campo de texto con validación para solo letras y espacios -->
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" required pattern="[a-zA-Z\s]+"> <!-- Campo de texto con validación para solo letras y espacios -->
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required> <!-- Campo de texto para la fecha de nacimiento -->
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <input type="radio" id="sexo_masculino" name="sexo" value="hombre" required> Masculino <!-- Opción de sexo masculino -->
                <input type="radio" id="sexo_femenino" name="sexo" value="mujer" required> Femenino <!-- Opción de sexo femenino -->
            </div>
            <div class="form-group">
                <label for="entidad_federativa">Entidad federativa</label>
                <select id="entidad_federativa" name="entidad_federativa" required> <!-- Lista desplegable para la entidad federativa -->
                    <option value="">Seleccione...</option> <!-- Opción predeterminada -->
                    <option value="AS">Aguascalientes</option>
                    <option value="BC">Baja California</option>
                    <option value="BS">Baja California Sur</option>
                    <option value="CC">Campeche</option>
                    <option value="CL">Coahuila de Zaragoza</option>
                    <option value="CM">Colima</option>
                    <option value="CS">Chiapas</option>
                    <option value="CH">Chihuahua</option>
                    <option value="DF">Ciudad de México</option>
                    <option value="DG">Durango</option>
                    <option value="GT">Guanajuato</option>
                    <option value="GR">Guerrero</option>
                    <option value="HG">Hidalgo</option>
                    <option value="JC">Jalisco</option>
                    <option value="MC">Edo. De México</option>
                    <option value="MN">Michoacán de Ocampo</option>
                    <option value="MS">Morelos</option>
                    <option value="NT">Nayarit</option>
                    <option value="NL">Nuevo León</option>
                    <option value="OC">Oaxaca</option>
                    <option value="PL">Puebla</option>
                    <option value="QT">Querétaro</option>
                    <option value="QR">Quintana Roo</option>
                    <option value="SP">San Luis Potosí</option>
                    <option value="SL">Sinaloa</option>
                    <option value="SR">Sonora</option>
                    <option value="TC">Tabasco</option>
                    <option value="TS">Tamaulipas</option>
                    <option value="TL">Tlaxcala</option>
                    <option value="VZ">Veracruz de Ignacio de la Llave</option>
                    <option value="YN">Yucatán</option>
                    <option value="ZS">Zacatecas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" placeholder="Correo electrónico" required> <!-- Campo de texto para el correo electrónico -->
            </div>
            <div class="form-group">
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Nombre de usuario" required> <!-- Campo de texto para el nombre de usuario -->
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Contraseña" required> <!-- Campo de texto para la contraseña -->
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required> <!-- Campo de texto para confirmar la contraseña -->
            </div>
            <div class="form-group">
                <label for="rfc">RFC:</label>
                <input type="text" id="rfc" name="rfc" placeholder="RFC" required minlength="13" maxlength="13"> <!-- Campo de texto con validación de longitud exacta de 13 caracteres -->
            </div>
            <div class="form-group">
                <label for="curp">CURP:</label>
                <input type="text" id="curp" name="curp" placeholder="CURP" required minlength="18" maxlength="18"> <!-- Campo de texto con validación de longitud exacta de 18 caracteres -->
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <!-- Tabla para visualizar los registros -->
        <section id="clientes">
            <h2>Clientes Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>RFC</th>
                        <th>CURP</th>
                        <th>Fecha de Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = SEMH_obtenerClientes($conn); // Llama a la función para obtener los clientes
                    while ($row = mysqli_fetch_assoc($result)) { ?> <!-- Itera sobre los resultados y muestra cada cliente en una fila de la tabla -->
                        <tr>
                            <td><?php echo $row['id_cliente']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['apellido_paterno']; ?></td>
                            <td><?php echo $row['apellido_materno']; ?></td>
                            <td><?php echo $row['rfc']; ?></td>
                            <td><?php echo $row['curp']; ?></td>
                            <td><?php echo $row['fecha_registro']; ?></td>
                            <td>
                                <a href="editar_cliente.php?id=<?php echo $row['id_cliente']; ?>" class="btn btn-edit">Editar</a> <!-- Enlace para editar el cliente -->
                                <a href="eliminar_cliente.php?id=<?php echo $row['id_cliente']; ?>" class="btn btn-delete">Eliminar</a> <!-- Enlace para eliminar el cliente -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; SEMH – PW1 – 2024/06/04</p>
    </footer>

</body>

</html>