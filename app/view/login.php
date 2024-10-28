<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Iniciar Sesión</h2>
            <a href="<?= $basePath ?>/register" class="btn btn-secondary">Registrar</a>
        </div>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                Credenciales incorrectas. Inténtalo de nuevo.
            </div>
        <?php endif; ?>
        <form action="<?= $basePath ?>/login" method="post">
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username" >
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>