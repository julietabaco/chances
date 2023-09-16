<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $publicacion_id = $_GET["id"];
    $usuario_id = $_SESSION['usuario_id'];

    require 'conexion.php';

    // Verificar que el usuario es el propietario de la publicación antes de eliminar
    $verificacion_query = "SELECT * FROM `trabajos-usuarios` WHERE id_trabajos = $publicacion_id AND usuario_id = $usuario_id";
    $verificacion_result = mysqli_query($conexion, $verificacion_query);

    if ($verificacion_result && mysqli_num_rows($verificacion_result) > 0) {
        // El usuario es el propietario, se puede eliminar
        $eliminacion_query = "DELETE FROM `trabajos-usuarios` WHERE id_trabajos = $publicacion_id";
        mysqli_query($conexion, $eliminacion_query);
    }

    // Redirigir de vuelta a perfil.php
    header("Location: perfil.php");
} else {
    echo "Acceso no válido";
}
?>
