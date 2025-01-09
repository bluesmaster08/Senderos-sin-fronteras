<!-- Incluimos el archivo que contiene la conexión a la base de datos -->
<?php include("include/SEMH_conn_BD.php"); ?>
<!-- Incluimos el archivo con la lógica de la validación de usuarios -->
<?php include("include/login.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senderos sin fronteras - Inicio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="CSS/styles2.css">
    <!-- JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Carrusel JS -->
    <script src="JS/carrusel.js"></script>
</head>

<body style="background-color: #f5f5f5;" onload="initCarousel()">
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100">
            <!-- Panel de login -->
            <div class="col-lg-6 col-md-12 bg-white p-5 shadow-sm">
                <div class="text-center mb-4">
                    <h1 class="fw-bold text-primary">Senderos sin fronteras</h1>
                    <p class="text-muted">¡Bienvenido de nuevo!</p>
                </div>
                <!-- Mostrar mensajes de error -->
                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <!-- Formulario -->
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    <p class="text-muted">¿Eres nuevo aquí? <a href="../PHP_CLIENT/SEMH_registrar.php">Regístrate ahora</a></p>
                </div>
            </div>
            <!-- Panel decorativo -->
            <div class="col-lg-6 col-md-12 d-none d-lg-block bg-dark text-white p-0">
                <div class="h-100 d-flex flex-column justify-content-center align-items-center"
                    style="background: url('IMG/index.jpg') center/cover;">
                    <h1>Es tiempo de</h1>
                    <p>viajar...</p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center p-5 bg-opacity-50 bg-dark w-100">
        <h2 class="fw-bold">Explora nuevos horizontes</h2>
        <p>Descubre destinos únicos y vive experiencias inolvidables.</p>
    </div>
    <footer class="text-center py-3 bg-light">
        <p>Creado por Sergio Meneses Hernández (2024) &#169;</p>
    </footer>
</body>

</html>