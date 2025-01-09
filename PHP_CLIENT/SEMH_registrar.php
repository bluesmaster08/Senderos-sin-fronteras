<?php
session_start(); // Iniciar sesión para usar mensajes flash
include("../include/SEMH_conn_BD.php"); // Conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"> <!-- Definir el conjunto de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Senderos sin fronteras</title>
    <link rel="stylesheet" href="../CSS/styles.css">
    <script src="../JS/curp.js"></script> <!-- Enlace al archivo JavaScript para la CURP -->
</head>

<body>
    <header>
        <h1>Registro de Nuevo Usuario</h1>
    </header>
    <main>
        <section id="registro">
            <h2 style="text-align:center">Completa el formulario para registrarte</h2>
            <p style="text-align: center;">¿Ya tienes una cuenta? <a href="../index.php">Inicia sesión aquí</a></p>
            <?php
            // Mostrar mensajes de éxito o error si existen
            if (isset($_SESSION['success'])) {
                echo '<p style="color:green; text-align:center;">' . $_SESSION['success'] . '</p>';
                unset($_SESSION['success']); // Eliminar mensaje después de mostrarlo
            }
            if (isset($_SESSION['error'])) {
                echo '<p style="color:red; text-align:center;">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']); // Eliminar mensaje después de mostrarlo
            }
            ?>
            <div class="formulario">
                <form action="guardar_registro.php" method="post" id="login"> <!-- Formulario que envía datos a guardar_registro.php -->
                    <div class="columna">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required> <!-- Campo de texto para el nombre -->

                        <label for="apellido">Apellido paterno:</label>
                        <input type="text" id="apellido" name="apellido" required> <!-- Campo de texto para el apellido paterno -->

                        <label for="segundo_apellido">Apellido materno:</label>
                        <input type="text" id="segundo_apellido" name="segundo_apellido" required> <!-- Campo de texto para el apellido materno -->

                        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required> <!-- Campo de texto para la fecha de nacimiento -->

                        <label for="sexo">Sexo:</label>
                        <input type="radio" id="sexo_masculino" name="sexo" value="hombre" required> Masculino <!-- Opción de sexo masculino -->
                        <input type="radio" id="sexo_femenino" name="sexo" value="mujer" required> Femenino <!-- Opción de sexo femenino -->

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

                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" name="email" required> <!-- Campo de texto para el correo electrónico -->
                        <label for="usuario">Nombre de usuario:</label>
                        <input type="text" id="usuario" name="usuario" required> <!-- Campo de texto para el nombre de usuario -->
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required> <!-- Campo de texto para la contraseña -->
                        <label for="confirm_password">Confirmar contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required> <!-- Campo de texto para confirmar la contraseña -->
                        <label for="rfc">RFC:</label>
                        <input type="text" id="rfc" name="rfc" required minlength="13" maxlength="13"> <!-- Campo de texto para el RFC, con longitud mínima y máxima de 13 caracteres -->
                        <label for="curp">CURP:</label>
                        <input type="text" id="curp" name="curp" pattern="[A-Z0-9]{18}" required readonly> <!-- Campo de texto para el CURP, solo lectura y con patrón de validación -->
                    </div>
                    <button type="submit">Registrarse</button> <!-- Botón para enviar el formulario -->
                </form>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; SEMH – PW1 – 2024/05/31</p> <!-- Pie de página con mensaje de derechos de autor -->
    </footer>
</body>

</html>