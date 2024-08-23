<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("INSERT INTO juegos (titulo, descripcion, precio, stock) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $titulo, $descripcion, $precio, $stock);

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
    <title>Agregar Nuevo Juego - Tienda de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://static.vecteezy.com/system/resources/previews/002/068/367/original/background-abstract-yellow-and-black-color-free-vector.jpg'); /* Cambia esto por una imagen temática */
            background-size: cover;
            background-position: center;
            color: #fff;
        }
        .form-container {
            margin-top: 50px;
        }
        .form-box {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #FFD700; /* Brillo dorado */
        }
        .form-box h2 {
            font-family: 'Press Start 2P', cursive; /* Fuente temática de videojuegos */
            color: #FFD700; /* Color dorado */
            text-align: center;
        }
        .form-control {
            background-color: #222;
            border: 1px solid #444;
            color: #FFD700; /* Texto dorado */
        }
        .form-control:focus {
            border-color: #FFD700;
            box-shadow: 0px 0px 5px #FFD700;
        }
        .btn-custom {
            background-color: #FFD700;
            border: none;
            color: black;
            font-weight: bold;
            width: 100%;
        }
        .btn-custom:hover {
            background-color: #FFC107;
        }
        .btn-back {
            background-color: #dc3545;
            border: none;
            color: white;
            font-weight: bold;
            margin-top: 10px;
        }
        .btn-back:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-box">
                    <h2>Agregar Nuevo Juego</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="titulo" placeholder="Título" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="descripcion" placeholder="Descripción"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" name="precio" step="0.01" placeholder="Precio" required>
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" name="stock" placeholder="Stock" required>
                        </div>
                        <button type="submit" class="btn btn-custom">Guardar</button>
                        <a href="listado.php" class="btn btn-back">Volver al Listado</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
