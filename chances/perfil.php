<?php
session_start(); // Iniciar sesión si no lo has hecho

require 'conexion.php'; // Asegúrate de tener tu archivo de conexión

$usuario_id = $_SESSION['usuario_id']; // Obtener el ID del usuario actual desde la sesión

if(isset($_POST['btn_imagen'])){
  var_dump($_FILES);
}

$query = "SELECT `id_trabajos`, `titulo`, `descripcion` FROM `trabajos-usuarios` WHERE `usuario_id` = '$usuario_id'";
$result = mysqli_query($conexion, $query);
// Verificar si el usuario ha iniciado sesión
            if (!isset($_SESSION['usuario_id'])) {
                echo "No has iniciado sesión.";
                exit; // Puedes redirigir a la página de inicio de sesión si lo prefieres
            }

  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>Página principal</title>
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/header3.css">
    <link rel="stylesheet" href="css/form.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Playfair:ital,wght@1,300&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Dosis&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@500&display=swap');
      .navegacion{
  background-color: #dfdfdf;
}
    </style>
</head>
<body>
<header>
    <nav class="navegacion">
        <a href="panel.php" class="logo">Chances</a>
        <ul class="menu">
          <li><a href="#">¿Porque Chances?</a></li>
          <li><a href="#">Encontrar Trabajo</a></li>
          <li><a href="#">Contacto</a></li>
          <li><a href="buscador.html">Buscar</a></li>
        </ul>
        <!-- <div class="barrabusqueda">
          <form>
            <input type="text" placeholder="Buscar..." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form> 
        </div> -->
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
<div class="container">
    <form action="" method="post" enctype="multipart/form-data" >
      <input type="file" name="imagen_perfil" id="">
      <input type="submit" name="btn_imagen" value="Cargar">
    </form>

    <div class=formu>
        <?php     
            // Formulario para publicar trabajo
            echo '<div class="form-box">';
            echo '<form action="procesar_publicacion.php" method="post" >';
            echo '<div class="form-group">';
            echo '<label for="titulo">Título:</label>';
            echo '<input type="text" id="titulo" name="titulo" class="form-control" placeholder="Título" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="descripcion">Descripción:</label>';
            echo '<textarea id="descripcion" name="descripcion" class="form-control" placeholder="Descripción"required></textarea>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Publicar</button>';
            echo '</form>';
            echo '</div>';
        ?>
    </div>
        
        <div class="publicaciones">
            <br><br>
        <h1>Mis Publicaciones:</h1>
  
        <div class="tarjetas">
          <?php
          // Mostrar las publicaciones del usuario actual
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <div class="publicar">
            <div class="card">
            <div class="card-body">
            <h5 class="card-title"><?=$row['titulo']?></h5>
            <p class="card-text"><?=$row['descripcion']?></p>
            <a href='editar_publicacion.php?id=<?=$row['id_trabajos']?>' class='editar'>Editar</a>
            <a href='eliminar_publicacion.php?id=<?=$row['id_trabajos']?>' class='eliminar'>Eliminar</a><br>
            </div>
            </div>
            </div>
          <?php
          }
          ?>
        </div>
    </div>
    </div>
        

</body>
</html>
