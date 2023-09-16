<?php
require_once 'conexion.php';

// Verifica si se envió el formulario de inicio de sesión

if (isset($_POST['login'])) {
    // Obtén los datos del formulario
    $email = $_POST['username'];
    $contrasena = $_POST['contrasena'];

    // Verifica si los campos están vacíos
    if (empty($email)) {
        $error = "Por favor, ingresa tu email.";
    } elseif (empty($contrasena)) {
        $error = "Por favor, ingresa tu contraseña.";
    } else {
        // Verifica las credenciales del usuario
        $query = "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'";
        $result = $conexion->query($query);

        if ($result && $result->num_rows > 0) {
            // Inicio de sesión exitoso
            $usuario = $result->fetch_assoc();
            session_start();
            $_SESSION['usuario_id'] = $usuario['usuario_id'];
            header('Location: panel.php');
            exit();
        } else {
            // Credenciales inválidas
            $error = "Credenciales incorrectas. Inténtalo nuevamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div class="contenedor">
        <h2>Inicio de sesión</h2>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Gmail:</label>
                <input type="text" id="username" name="username" placeholder="Ingresa tu Gmail">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="contrasena" placeholder="Ingresa tu contraseña">
            </div>
            <input type="submit" name="login" value="Iniciar sesión">
        </form>
    </div>
</body>
</html>
