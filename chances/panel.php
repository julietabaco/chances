<?php
require 'conexion.php'; // Asegúrate de tener tu archivo de conexión

$query = "SELECT `trabajos-usuarios`.`id_trabajos`, `trabajos-usuarios`.`usuario_id`, `trabajos-usuarios`.`titulo`, `trabajos-usuarios`.`descripcion`, `usuarios`.`nombre` AS `nombre_usuario` FROM `trabajos-usuarios` INNER JOIN `usuarios` ON `trabajos-usuarios`.`usuario_id` = `usuarios`.`usuario_id`";
$result = mysqli_query($conexion, $query);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Página principal</title>
    <link rel="stylesheet" href="css/header3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/form.css">
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
          <li><a href="configurar.html">Encontrar Trabajo</a></li>
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
    <!-- <div class="contenedor">
      <article class="filtros">
        <div class="localidad">
          Localidad
        </div>
      </article>
      <article class="trabajos"></article>
    </div> -->
    <!--<div class="card">-->
    <!--  <div class="card-body">-->
    <!--    <h5 class="card-title">Solicito plomero para arreglar cañeria</h5>-->
    <!--    <h6 class="card-subtitle mb-2 text-body-secondary">Agustin</h6>-->
    <!--    <p class="card-text">El problema se encuentra en el baño, hay que romper la pared para resolverlo. Ademas quiero instalar un termotanque en el lavadero.  </p>-->
    <!--    <p class="fech-public text-body-secondary">3 dias</p>-->
    <!--    <a href="#" class="card-link">Ver publicacion</a>-->
    <!--  </div>-->
    <!--</div>-->
    
<div class="contenedor-tarjetas">
<?php
if (!$result) {
    echo "Error en la consulta: " . mysqli_error($conexion);
} else {
 
    // Mostrar las publicaciones en tarjetas
    while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="publicar">';

      echo '<div class="card">';
        echo '<div class="card-body">';

          
          echo '<h5 class="card-title">' . $row['titulo'] . '</h5>';
          echo '<h6 class="card-subtitle mb-2 text-body-secondary">' . $row['nombre_usuario'] . ' solicita</h6>';
          echo '<p class="card-text">' . $row['descripcion'] . '</p>';
          echo'<div class="enlaces">';
            echo '<a href="detalles_usuario.php?usuario_id=' . $row['usuario_id'] . '" class="card-link">Ver publicación</a>';
            echo '<a href="https://wa.me/541122429667/" class="card-link">Contactar</a>';
          echo'</div>';
        
          echo '</div>';
      echo '</div>';

    echo '</div>';
}

}
?>
</div>

   
</body>
</html>
