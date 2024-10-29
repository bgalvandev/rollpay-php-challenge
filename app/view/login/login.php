<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .btn-primary {
            width: 100%;
        }
        .alert {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="text-center mb-4">
            <h2>Iniciar Sesión</h2>
        </div>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                Credenciales incorrectas. Inténtalo de nuevo.
            </div>
        <?php endif; ?>

        <form action="<?= htmlspecialchars($basePath) ?>/login" method="post">
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        <div class="text-center mt-3">
            <p>¿No tienes cuenta? <a href="<?= htmlspecialchars($basePath) ?>/register">Regístrate</a></p>
        </div>
    </div>
</body>
</html>