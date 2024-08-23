<?php
include 'config.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$total = 0;

$stmt = $conn->prepare("INSERT INTO ordenes (usuario_id, total) VALUES (?, ?)");
$stmt->bind_param("id", $usuario_id, $total);
$stmt->execute();
$orden_id = $stmt->insert_id;

foreach ($_SESSION['carrito'] as $juego_id => $cantidad) {
    // Obtener precio del juego
    $precio = ...;

    // Insertar en detalles_orden
    $stmt = $conn->prepare("INSERT INTO detalles_orden (orden_id, juego_id, cantidad, precio) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiid", $orden_id, $juego_id, $cantidad, $precio);
    $stmt->execute();

    $total += $precio * $cantidad;
}

// Actualizar el total de la orden
$stmt = $conn->prepare("UPDATE ordenes SET total = ? WHERE id = ?");
$stmt->bind_param("di", $total, $orden_id);
$stmt->execute();

$stmt->close();
$conn->close();

// Limpiar el carrito
unset($_SESSION['carrito']);

echo "Compra realizada con éxito. Recibo generado.";
?>
