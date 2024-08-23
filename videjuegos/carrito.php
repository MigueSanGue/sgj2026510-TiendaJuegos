<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $juego_id = $_POST['juego_id'];
    $cantidad = $_POST['cantidad'];

    $_SESSION['carrito'][$juego_id] = $cantidad;

    header("Location: carrito.php");
    exit();
}

// Mostrar los juegos en el carrito
foreach ($_SESSION['carrito'] as $juego_id => $cantidad) {
    // Consulta para obtener detalles del juego
    // Muestra título, precio, cantidad y subtotal
}
?>

<form method="POST" action="checkout.php">
    <button type="submit">Finalizar Compra</button>
</form>
