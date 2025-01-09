<?php
// Configuración para mostrar errores en pantalla
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica si no se ha iniciado la sesión y la inicia
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Establece la conexión a la base de datos
$conn = mysqli_connect(
    'localhost', // Nombre del servidor de la base de datos
    'id22221643_root', // Nombre de usuario de la base de datos
    'Es1822033494_', // Contraseña del usuario de la base de datos
    'id22221643_bd_senderos_sin_fronteras' // Nombre de la base de datos
);

// Verifica si la conexión fue exitosa, de lo contrario muestra un mensaje de error
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
