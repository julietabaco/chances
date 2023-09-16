<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio
    header('Location: index.php');
    exit();
}

// Cerrar la sesión y redirigir al índice
session_unset();
session_destroy();
header('Location: index.php');
exit();
?>
