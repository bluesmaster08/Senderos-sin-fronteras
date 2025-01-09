<?php
include("../include/SEMH_conn_BD.php"); // Conexión a la base de datos
session_start(); // Iniciar sesión para usar mensajes flash

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellido_paterno = mysqli_real_escape_string($conn, $_POST['apellido']);
    $apellido_materno = mysqli_real_escape_string($conn, $_POST['segundo_apellido']);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']);
    $sexo = mysqli_real_escape_string($conn, $_POST['sexo']);
    $entidad_federativa = mysqli_real_escape_string($conn, $_POST['entidad_federativa']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $nombre_usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $rfc = mysqli_real_escape_string($conn, $_POST['rfc']);
    $curp = mysqli_real_escape_string($conn, $_POST['curp']);

    // Validaciones básicas
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Las contraseñas no coinciden.";
        header("Location: SEMH_registrar.php");
        exit();
    }

    // Encriptar contraseña
    $password_encrypted = password_hash($password, PASSWORD_DEFAULT);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO tblcliente (nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo, entidad_federativa, email, nombre_usuario, password_cliente, rfc, curp)
            VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$sexo', '$entidad_federativa', '$email', '$nombre_usuario', '$password_encrypted', '$rfc', '$curp')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Registro exitoso!";
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    // Cerrar conexión
    mysqli_close($conn);
    header("Location: SEMH_registrar.php");
    exit();
}
