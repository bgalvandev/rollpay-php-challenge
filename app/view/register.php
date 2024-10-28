<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registrar Usuario</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                Error al registrar el usuario. Inténtalo de nuevo.
            </div>
        <?php elseif (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">
                Usuario registrado exitosamente.
            </div>
        <?php endif; ?>
        <form action="<?= $basePath ?>/register" method="post">
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="<?= $basePath ?>/login" class="btn btn-secondary">Iniciar Sesión</a>
        </form>
    </div>
</body>
</html>