<?php
// Procesar el formulario de publicación
session_start(); // Iniciar sesión si no lo has hecho

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $usuario_id = $_SESSION['usuario_id']; // Obtener el ID del usuario actual desde la sesión

    require 'conexion.php'; // Asegúrate de tener tu archivo de conexión

    // Insertar el nuevo trabajo en la base de datos con la fecha de publicación
    $query = "INSERT INTO `trabajos-usuarios` (usuario_id, titulo, descripcion, fecha_publicacion) VALUES ('$usuario_id', '$titulo', '$descripcion', NOW())";
    mysqli_query($conexion, $query);

    // Redirigir de vuelta a perfil.php
    header("Location: perfil.php");
}
?>
