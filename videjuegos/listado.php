<?php
include 'config.php';

// Consultar todos los juegos
$result = $conn->query("SELECT * FROM juegos");

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Juegos - Tienda de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://static.vecteezy.com/system/resources/previews/002/068/673/original/design-background-abstract-yellow-and-black-free-vector.jpg'); /* Cambia esto por una imagen temática */
            background-size: cover;
            background-position: center;
            color: #fff;
        }
        .container {
            margin-top: 50px;
        }
        .table {
            background-color: rgba(0, 0, 0, 0.85);
            border-radius: 15px;
            overflow: hidden;
            color: #FFD700; /* Texto dorado */
            border: 1px solid #444;
        }
        .table thead th {
            background-color: #333;
            color: #FFD700;
            font-weight: bold;
            text-align: center;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #444;
        }
        .table tbody tr:hover {
            background-color: #555;
        }
        .btn-custom {
            background-color: #FFD700;
            border: none;
            color: black;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #FFC107;
        }
        .btn-warning, .btn-danger {
            font-weight: bold;
        }
        .actions a {
            color: #FFD700;
            font-weight: bold;
            margin-right: 5px;
        }
        .actions a:hover {
            color: #FFC107;
        }
        .header {
            background: rgba(0, 0, 0, 0.85);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0px 0px 15px 0px #FFD700;
        }
        .header h1 {
            font-family: 'Press Start 2P', cursive; /* Fuente temática de videojuegos */
            color: #FFD700;
        }
        .btn-back {
            background-color: #dc3545;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-back:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Listado de Juegos</h1>
            <a href="crear.php" class="btn btn-custom">Agregar Nuevo Juego</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['titulo']; ?></td>
                    <td><?= $row['descripcion']; ?></td>
                    <td>$<?= number_format($row['precio'], 2); ?></td>
                    <td><?= $row['stock']; ?></td>
                    <td class="actions">
                        <a href="editar.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="eliminar.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este juego?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
