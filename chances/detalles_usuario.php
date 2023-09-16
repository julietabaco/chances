<?php
session_start(); // Iniciar sesión si no lo has hecho

require 'conexion.php'; // Asegúrate de tener tu archivo de conexión

if (!isset($_GET['usuario_id'])) {
    echo "No se proporcionó un ID de usuario.";
    exit();
}

$usuario_id = $_GET['usuario_id'];

// Consultar los detalles del usuario
$query_usuario = "SELECT * FROM `usuarios` WHERE `usuario_id` = '$usuario_id'";
$result_usuario = mysqli_query($conexion, $query_usuario);

if (!$result_usuario || mysqli_num_rows($result_usuario) === 0) {
    echo "El usuario no existe.";
    exit();
}

$row_usuario = mysqli_fetch_assoc($result_usuario);

// Consultar las publicaciones del usuario
$query_publicaciones = "SELECT * FROM `trabajos-usuarios` WHERE `usuario_id` = '$usuario_id'";
$result_publicaciones = mysqli_query($conexion, $query_publicaciones);

// Función para formatear la diferencia de tiempo en un formato legible
function format_time_diff($seconds) {
    $time_formats = array(
        array(60, 'segundos'),
        array(3600, 'minutos'),
        array(86400, 'horas'),
        array(604800, 'días'),
        array(2592000, 'meses'),
        array(31536000, 'años')
    );

    foreach ($time_formats as $format) {
        if ($seconds < $format[0]) {
            if ($format[1] == 'meses') {
                $months = max(1, floor($seconds / 2592000));
                return "hace $months $format[1]";
            }
            if ($format[1] == 'años') {
                $years = max(1, floor($seconds / 31536000));
                return "hace $years $format[1]";
            }
            $value = max(1, floor($seconds / $format[0]));
            return "hace $value $format[1]";
        }
    }

    return 'hace mucho tiempo';
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Detalles del Usuario</title>
    <link rel="stylesheet" href="css/prueba.css">
    <link rel="stylesheet" href="css/header3.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/detalles.css">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
   <link rel="shortcut icon" href="img/perfil.jpg"> 
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair:ital,wght@1,300&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Dosis&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap');
    .navegacion{
  background-color: #dfdfdf;
}
  </style>
    <!-- Agrega tus enlaces a hojas de estilo y fuentes aquí -->
</head>
<body>
    <header>
    <nav class="navegacion">
        <a href="panel.php" class="logo">Chances</a>
        <ul class="menu">
          <li><a href="#">¿Porque Chances?</a></li>
          <li><a href="#">Encontrar Trabajo</a></li>
          <li><a href="#">Contacto</a></li>
        </ul>
        <div class="barrabusqueda">
          <form>
            <input type="text" placeholder="Buscar..." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form> 
        </div>
        <div class="ubiperfil">
          <label class="dropdown">
            <div class="dd-button">
              Perfil
            </div>
            <input type="checkbox" class="dd-input" id="test">
            <ul class="dd-menu">
              <li><a href="perfil.php">Detalles</a></li>
              <li><a href="logout.php" class="red">Cerrar Sesion</a></li>
            </ul>
          </label> 
        </div>       
      </nav>
      <div class="linea"></div>
    </header>

  <h1>Detalles del Usuario</h1>
    <div class="detalles">

      <div class="detail">
        <p><strong>Nombre:</strong> <div class="dato"><?php echo $row_usuario['nombre']; ?></div></p>
      </div>

      <div class="detail">
        <p><strong>Apellido:</strong> <div class="dato"><?php echo $row_usuario['apellido']; ?></div></p>
      </div>

      <div class="detail">
        <p><strong>Email:</strong> <div class="dato"><?php echo $row_usuario['email']; ?></div></p>
      </div>

    </div>

    <h2>Publicaciones del Usuario</h2>
    <div class="cards">
      <?php
      while ($row_publicacion = mysqli_fetch_assoc($result_publicaciones)) {
          echo '<div class="card">';
          echo '<div class="card-header">'. $row_publicacion['titulo'] . '</div>';
          echo '<div class="card-body">';
          echo '<p class="card-text">' . $row_publicacion['descripcion'] . '</p>';
          echo '</div>';

          // Calcular la diferencia de tiempo
          $time_diff = time() - strtotime($row_publicacion['fecha_publicacion']);
          $formatted_time_diff = format_time_diff($time_diff);
          echo '<div class="card-footer text-body-secondary">' . $formatted_time_diff . '</div>';
          echo '</div>';
      }
      ?>
    </div>


    <!-- Agrega tu pie de página aquí -->
</body>
</html>
