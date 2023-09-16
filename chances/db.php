<?php
// Incluye el archivo de configuración
require_once 'config.php';

// Función para establecer la conexión a la base de datos
function conectar() {
    $conexion = new mysqli('localhost', 'chances', 'chances123', 'chances');

    if ($conexion->connect_error) {
        die('Error de conexión: ' . $conexion->connect_error);
    }

    return $conexion;
}

// Función para cerrar la conexión a la base de datos
function desconectar($conexion) {
    $conexion->close();
}
?>