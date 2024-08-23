<?php
$servername = "localhost";  // Cambia esto si tu servidor no está en localhost
$username = "root";         // Usuario de tu base de datos
$password = "";             // Contraseña de tu base de datos
$dbname = "tienda_videojuegos";  // Nombre de la base de datos que estás utilizando

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
