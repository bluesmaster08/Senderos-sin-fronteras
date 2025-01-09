<?php
// Definición de variables de usuario y contraseña
$user_admin = "admin_mh_sergio";
$password_admin = "ES1822033494";
$user_cliente = "cliente_mh_sergio";
$password_cliente = "ES1822033494";

// Define la variable para almacenar el mensaje de error
$error_message = "";

// Procesamiento del formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado los campos de usuario y contraseña
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Comparar las credenciales ingresadas con las credenciales almacenadas
        if (($username == $user_admin && $password == $password_admin) || ($username == $user_cliente && $password == $password_cliente)) {
            // Credenciales válidas, redireccionar a la sección correspondiente
            if ($username == $user_admin) {
                // Usuario administrador
                header("Location: PHP_ADMIN/SEMH_home_admin.php");
                exit();
            } elseif ($username == $user_cliente) {
                // Usuario cliente
                header("Location: PHP_CLIENT/SEMH_home_cliente.php");
                exit();
            }
        } else {
            // Credenciales inválidas, mostrar mensaje de error
            $error_message = "Usuario o contraseña incorrectos";
        }
    }
}
