<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: listado.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("DELETE FROM juegos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Juego - Tienda de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://example.com/video-game-background.jpg'); /* Cambia esto por una imagen temática */
            background-size: cover;
            background-position: center;
            color: #fff;
        }
        .container {
            margin-top: 100px;
        }
        .form-box {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #FFD700; /* Brillo dorado */
            text-align: center;
        }
        .form-box h1 {
            font-family: 'Press Start 2P', cursive; /* Fuente temática de videojuegos */
            color: #FFD700; /* Color dorado */
            margin-bottom: 20px;
        }
        .form-box p {
            margin-bottom: 20px;
            color: #FFD700; /* Texto dorado */
        }
        .btn-custom {
            background-color: #FFD700;
            border: none;
            color: black;
            font-weight: bold;
            margin: 10px;
        }
        .btn-custom:hover {
            background-color: #FFC107;
        }
        .btn-cancel {
            background-color: #dc3545;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-cancel:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1>Eliminar Juego</h1>
            <p>¿Estás seguro de que deseas eliminar este juego?</p>
            <form method="POST">
                <button type="submit" class="btn btn-custom">Confirmar Eliminación</button>
                <a href="listado.php" class="btn btn-cancel">Cancelar</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
