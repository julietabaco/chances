<?php
session_start(); // Iniciar sesión si no lo has hecho

require 'conexion.php'; // Asegúrate de tener tu archivo de conexión

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id_trabajo = $_GET["id"];
    
    // Consultar la publicación por ID
    $query = "SELECT * FROM `trabajos-usuarios` WHERE `id_trabajos` = '$id_trabajo' AND `usuario_id` = '{$_SESSION['usuario_id']}'";
    $result = mysqli_query($conexion, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "La publicación no existe o no tienes permiso para editarla.";
        exit();
    }
} else {
    echo "No se proporcionó un ID válido.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevo_titulo = $_POST["nuevo_titulo"];
    $nueva_descripcion = $_POST["nueva_descripcion"];

    // Actualizar la publicación en la base de datos
    $update_query = "UPDATE `trabajos-usuarios` SET `titulo` = '$nuevo_titulo', `descripcion` = '$nueva_descripcion' WHERE `id_trabajos` = '$id_trabajo'";
    $update_result = mysqli_query($conexion, $update_query);
    
    if ($update_result) {
        header("Location: perfil.php"); // Redirige de vuelta al perfil después de la edición
        exit();
    } else {
        echo "Error al actualizar la publicación.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/editar.css">
    <title>Editar Publicación</title>
    <!-- Agrega tus enlaces a hojas de estilo y fuentes aquí -->
</head>
<body>
    <!-- Agrega tu encabezado o barra de navegación aquí -->

    <div class="card">
        <h1>Editar Publicación</h1>

        <form action="editar_publicacion.php?id=<?php echo $id_trabajo; ?>" method="POST">
            <h3>Rubro</h3>
            <input type="text" name="nuevo_titulo" value="<?php echo $row['titulo']; ?>">
            <h3>Descripcion</h3>
            <textarea name="nueva_descripcion"><?php echo $row['descripcion']; ?></textarea><br>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

    <!-- Agrega tu pie de página aquí -->
</body>
</html>
