<?php
require_once 'config.php';

// Crear conexión
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Función para desconectar de la base de datos
function desconectar($conexion) {
    $conexion->close();
}
?>
