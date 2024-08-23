
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Tienda de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://img.freepik.com/vector-premium/fondo-abstracto-amarillo-negro_182771-501.jpg'); /* Cambia esto por una imagen temática */
            background-size: cover;
            background-position: center;
            color: #fff;
        }
        .login-container {
            margin-top: 100px;
        }
        .login-box {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 215, 0, 0.5); /* Sombra dorada */
        }
        .login-box h2 {
            font-family: 'Press Start 2P', cursive; /* Fuente temática de videojuegos */
            color: #FFD700; /* Color dorado */
        }
        .btn-custom {
            background-color: #FFD700;
            border: none;
            color: black;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #FFC107;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="login-box text-center">
                    <h2>Inicio de Sesión</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST"action="listado.php">
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include 'config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['tipo'] = $user['tipo'];
            header("Location: listado.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "No existe una cuenta con ese correo.";
    }

    $stmt->close();
    $conn->close();
}
?>
