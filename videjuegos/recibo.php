<?php
include 'config.php';
session_start();

if (!isset($_SESSION['usuario_id']) || !isset($_GET['orden_id'])) {
    header("Location: login.php");
    exit();
}

$orden_id = $_GET['orden_id'];

$stmt = $conn->prepare("
    SELECT ordenes.id, ordenes.total, ordenes.fecha, 
           juegos.titulo, detalles_orden.cantidad, detalles_orden.precio 
    FROM ordenes 
    JOIN detalles_orden ON ordenes.id = detalles_orden.orden_id 
    JOIN juegos ON detalles_orden.juego_id = juegos.id 
    WHERE ordenes.id = ?
");

$stmt->bind_param("i", $orden_id);
$stmt->execute();
$result = $stmt->get_result();

$orden = $result->fetch_assoc();
?>

<h1>Recibo de Compra</h1>
<p>ID de la Orden: <?= $orden['id']; ?></p>
<p>Fecha: <?= $orden['fecha']; ?></p>

<h2>Detalles de los Juegos Comprados:</h2>
<ul>
    <?php do { ?>
        <li>
            <?= $orden['titulo']; ?> - Cantidad: <?= $orden['cantidad']; ?> - Precio Unitario: $<?= $orden['precio']; ?>
        </li>
    <?php } while ($orden = $result->fetch_assoc()); ?>
</ul>

<p><strong>Total Pagado: $<?= number_format($orden['total'], 2); ?></strong></p>

<?php
$stmt->close();
$conn->close();


?>
