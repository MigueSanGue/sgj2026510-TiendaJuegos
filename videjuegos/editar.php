<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Consultar los detalles del juego
$stmt = $conn->prepare("SELECT * FROM juegos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$juego = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("UPDATE juegos SET titulo = ?, descripcion = ?, precio = ?, stock = ? WHERE id = ?");
    $stmt->bind_param("ssdii", $titulo, $descripcion, $precio, $stock, $id);

    if ($stmt->execute()) {
        header("Location: listado.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Juego - Tienda de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://static.vecteezy.com/system/resources/previews/011/358/948/original/abstract-business-background-with-yellow-and-black-colour-free-vector.jpg'); /* Cambia esto por una imagen temática */
            background-size: cover;
            background-position: center;
            color: #fff;
        }
        .container {
            margin-top: 50px;
        }
        .form-box {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #FFD700; /* Brillo dorado */
        }
        .form-box h1 {
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
        }
        .btn-custom:hover {
            background-color: #FFC107;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #FFD700;
            font-weight: bold;
        }
        .back-link:hover {
            color: #FFC107;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1>Editar Juego</h1>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($juego['titulo']); ?>" placeholder="Título" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="descripcion" placeholder="Descripción"><?= htmlspecialchars($juego['descripcion']); ?></textarea>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="precio" value="<?= htmlspecialchars($juego['precio']); ?>" step="0.01" placeholder="Precio" required>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="stock" value="<?= htmlspecialchars($juego['stock']); ?>" placeholder="Stock" required>
                </div>
                <button type="submit" class="btn btn-custom">Guardar Cambios</button>
            </form>
            <a href="listado.php" class="back-link">Volver al listado</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
