<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Bienvenido, <?= htmlspecialchars($_SESSION['username'] ?? 'Usuario') ?>!</h2>
        <p>Has iniciado sesión correctamente.</p>
        <a href="<?= $basePath ?>/logout" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</body>
</html>