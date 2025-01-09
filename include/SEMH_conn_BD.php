<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
//Inicio de sesion
// Verificar si una sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Cadena de conexión 
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'BD_Senderos_sin_fronteras'
);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}





/*
if ($conn) {
echo "Se ha conectado la base de datos...";
} else {
echo "Error al conectar la base de datos: " . mysqli_connect_error();
}*/