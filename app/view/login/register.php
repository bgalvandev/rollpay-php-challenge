<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .register-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .btn-primary, .btn-secondary {
            width: 100%;
        }
        .alert {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="text-center mb-4">
            <h2>Registrar Usuario</h2>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                Error al registrar el usuario. Inténtalo de nuevo.
            </div>
        <?php elseif (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">
                Usuario registrado exitosamente.
            </div>
        <?php endif; ?>

        <form action="<?= htmlspecialchars($basePath) ?>/register" method="post">
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="<?= htmlspecialchars($basePath) ?>/login" class="btn btn-secondary mt-2">Login</a>
        </form>
    </div>
</body>
</html>