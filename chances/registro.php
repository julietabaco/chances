<?php

session_start();
// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redirige a la página de inicio
    header('Location: panel.php');
    exit();
}

require_once 'conexion.php';

$nombre = $apellido = $email = $contrasena = '';
$error = '';

if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $politicas_aceptadas = isset($_POST['politicas']);

    if (empty($nombre) || empty($apellido) || empty($email) || empty($contrasena)) {
        $error = "Por favor, completa todos los campos.";
    } elseif (!$politicas_aceptadas) {
        $error = "Debes aceptar las políticas de privacidad para registrarte.";
    } else {
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conexion->query($query);

        if ($result && $result->num_rows > 0) {
            $error = "El email ya está registrado. Por favor, utiliza otro email.";
        } else {
            $query = "INSERT INTO usuarios (nombre, apellido, email, contrasena) VALUES ('$nombre', '$apellido', '$email', '$contrasena')";
            $result = $conexion->query($query);

            if ($result) {
                header('Location: panel.php');
                exit();
            } else {
                $error = "Error en el registro. Por favor, inténtalo nuevamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/registrarse.css">
  <link rel="stylesheet" href="css/terminos.css">
  <title>Registrarse</title>
</head>
<body>
    <?php if (isset($error)) { ?>
        <div class="error-message">
            <p><?php echo $error; ?></p>
        </div>
    <?php } ?>
    <?php if (isset($message)) { ?>
        <div class="success-message">
            <p><?php echo $message; ?></p>
        </div>
    <?php } ?>
<section class="ubicontenido">
    <div class="contenido">
            <h1>Registrarse</h1>
        <form action="registro.php" method="POST">
            <div class="nombre-apellido">
                <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="campo">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>">
                </div>
            </div>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>">

            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="password" name="contrasena" value="<?php echo $contrasena; ?>">
      
            
            <div class="contenedorterminos">
                <div class="ubiterminos">
                    Si estoy enterado de <a>Términos de servicio de Chances</a> incluido el <a>Acuerdo de Usuario</a>
                    y la <a>Política de privacidad </a>
                </div>
            </div>
    
            <label class="checkbox-container">
            <input type="checkbox" name="politicas" required>
            <span class="checkmark"></span>
            </label>

        <input type="submit" name="registro" value="Registrarse">
        </form>
        <button id="open">
            Ver terminos y servicios
          </button>
          
          <div id="modal_container" class="modal-container">
            <div class="modal">
              <h1>Términos de servicio de Chances incluido el Acuerdo de Usuario
                    y la Política de privacidad </h1>
              <div class="condiciones">
              <br><li class="transparencia">Términos de servicio de Chances</li><br>

                    Bienvenido a Chances, una plataforma de trabajo orientada a trabajos no profesionales. Antes de utilizar nuestros servicios, te pedimos que leas detenidamente los siguientes términos y condiciones. Al acceder o utilizar nuestro sitio web y nuestros servicios, aceptas cumplir con estos términos y estar legalmente obligado por ellos. Si no estás de acuerdo con estos términos, te solicitamos que no utilices nuestra plataforma.
<br><br>
                    Uso de la plataforma<br>
                    Chances actúa únicamente como un mediador entre usuarios que buscan trabajos no profesionales y aquellos que ofrecen sus servicios. No garantizamos la seguridad de los usuarios al abrirle la puerta a un desconocido contactado a través de nuestra página web. Los usuarios son responsables de tomar precauciones adecuadas y realizar verificaciones necesarias antes de permitir el acceso a sus hogares o lugares de trabajo.
<br><br>
                    Responsabilidad del usuario<br>
                    Al utilizar nuestros servicios, aceptas asumir la responsabilidad de tus acciones y garantizar la seguridad de tu propiedad y bienestar personal. Chances no se hace responsable por daños, lesiones o pérdidas que puedan ocurrir durante la prestación de servicios entre los usuarios.
<br><br>
                    Verificación de antecedentes<br>
                    Chances no realiza verificaciones exhaustivas de antecedentes de los usuarios. Es responsabilidad del usuario solicitar y verificar la información y referencias pertinentes antes de contratar o aceptar un trabajo. Recomendamos encarecidamente a los usuarios que ejerzan el debido cuidado y utilicen su propio juicio al seleccionar a un candidato para un trabajo.
<br><br>
                    Propiedad intelectual<br>
                    Todo el contenido presente en la plataforma de Chances, incluyendo, pero no limitado a, logotipos, textos, gráficos, imágenes y software, son propiedad exclusiva de Chances o de sus licenciantes. No se permite la reproducción, distribución o modificación del contenido sin el consentimiento previo por escrito de Chances.
<br><br>
                    Cancelación de servicios<br>
                    Chances se reserva el derecho de cancelar, suspender o restringir el acceso a nuestros servicios en cualquier momento y por cualquier motivo, sin previo aviso. Asimismo, nos reservamos el derecho de modificar o actualizar estos términos de servicio sin previo aviso.
<br><br>
                    Limitación de responsabilidad<br>
                    En ningún caso Chances será responsable por daños directos, indirectos, incidentales, especiales o consecuentes, incluyendo, entre otros, pérdida de beneficios, pérdida de datos o interrupción del negocio, que surjan o estén relacionados con el uso o la imposibilidad de utilizar nuestros servicios.
<br><br>
                    Ley aplicable y jurisdicción<br>
                    Estos términos de servicio se regirán e interpretarán de acuerdo con las leyes del país donde opera Chances. Cualquier disputa que surja de estos términos estará sujeta a la jurisdicción exclusiva de los tribunales de esa jurisdicción.
<br>
                    Al utilizar los servicios de Chances, estás de acuerdo con estos términos y condiciones. Si tienes alguna pregunta o inquietud sobre nuestros términos de servicio, por favor contáctanos a través de los canales de soporte proporcionados en nuestro sitio web.<br><br><br>
              </div>
              <div class="acuerdo">
              <li class="transparencia">Acuerdo de usuario de Chances</li><br>

                Este acuerdo de usuario ("Acuerdo") establece los términos y condiciones entre el usuario ("Usuario") y Chances ("nosotros" o "nuestro"), en relación con el uso de nuestra plataforma de trabajo. Al acceder o utilizar nuestros servicios, el Usuario acepta cumplir con este Acuerdo y estar legalmente obligado por él. Si no estás de acuerdo con estos términos, te solicitamos que no utilices nuestra plataforma.
<br><br>
                Uso de la plataforma<br>
                1.1. Al utilizar nuestros servicios, el Usuario reconoce que Chances actúa únicamente como un mediador entre usuarios que buscan trabajos no profesionales y aquellos que ofrecen sus servicios.
                1.2. El Usuario entiende y acepta que Chances no garantiza la seguridad de los usuarios al abrirle la puerta a un desconocido contactado a través de nuestra página web. Es responsabilidad del Usuario tomar las precauciones necesarias y realizar las verificaciones pertinentes antes de permitir el acceso a sus hogares o lugares de trabajo.
<br><br>
                Cuentas de usuario<br>
                2.1. El Usuario debe registrarse y crear una cuenta para acceder a ciertas características y servicios de la plataforma.
                2.2. El Usuario es responsable de mantener la confidencialidad de sus credenciales de inicio de sesión y de cualquier actividad que ocurra en su cuenta.
                2.3. El Usuario se compromete a proporcionar información precisa, actualizada y completa al registrarse y utilizar nuestra plataforma.
<br><br>
                Responsabilidad del Usuario<br>
                3.1. El Usuario acepta utilizar nuestros servicios bajo su propio riesgo y asume la responsabilidad de sus acciones y decisiones.
                3.2. El Usuario acepta que es su responsabilidad verificar la información y referencias pertinentes de otros usuarios antes de contratar o aceptar un trabajo.
                3.3. El Usuario se compromete a utilizar nuestra plataforma de acuerdo con todas las leyes y regulaciones aplicables.
<br><br>
                Propiedad intelectual<br>
                4.1. Todos los derechos de propiedad intelectual sobre el contenido y la plataforma de Chances son propiedad exclusiva de Chances o de sus licenciantes.
                4.2. No se permite la reproducción, distribución o modificación del contenido sin el consentimiento previo por escrito de Chances.
<br><br>
                Limitación de responsabilidad<br>
                5.1. En ningún caso Chances será responsable por daños directos, indirectos, incidentales, especiales o consecuentes, incluyendo, entre otros, pérdida de beneficios, pérdida de datos o interrupción del negocio, que surjan o estén relacionados con el uso o la imposibilidad de utilizar nuestros servicios.
<br><br>
                Modificaciones del Acuerdo<br>
                6.1. Chances se reserva el derecho de modificar o actualizar este Acuerdo en cualquier momento y por cualquier motivo, sin previo aviso. Las modificaciones entrarán en vigencia tan pronto como se publiquen en nuestra plataforma.
                6.2. El Usuario tiene la responsabilidad de revisar periódicamente este Acuerdo para estar al tanto de cualquier cambio.
<br><br>
                Ley aplicable y jurisdicción<br>
                7.1. Este Acuerdo se regirá e interpretará de acuerdo con las leyes del país donde opera Chances.
                7.2. Cualquier disputa que surja de este Acuerdo estará sujeta a la jurisdicción exclusiva de los tribunales de esa jurisdicción.
<br>
                Al utilizar los servicios de Chances, el Usuario está de acuerdo con este Acuerdo. Si tienes alguna pregunta o inquietud sobre nuestro Acuerdo de usuario, por favor contáctanos a través de los canales de soporte proporcionados en nuestro sitio web.<br><br><br>
              </div>
              <div class="politica">
              <li class="transparencia">Política de privacidad de Chances</li>
                    Fecha de entrada en vigencia: [26/08/2023]<br>
<br>
                    Chances ("nosotros" o "nuestro") se compromete a proteger la privacidad de los usuarios ("Usuario" o "tú") de nuestra plataforma de trabajo. Esta Política de privacidad describe cómo recopilamos, utilizamos, compartimos y protegemos la información personal del Usuario cuando utiliza nuestros servicios. Al utilizar nuestra plataforma, aceptas el procesamiento de tu información personal de acuerdo con esta Política de privacidad.
<br><br>
                    Información que recopilamos<br>
                    1.1. Información proporcionada por el Usuario: Al registrarte y utilizar nuestra plataforma, podemos recopilar información personal que tú nos proporcionas, como tu nombre, dirección de correo electrónico, número de teléfono y otra información relevante para brindarte nuestros servicios.<br>
                    1.2. Información de uso: Podemos recopilar información sobre cómo utilizas nuestra plataforma, como las búsquedas realizadas, los trabajos solicitados y otros detalles de la actividad del Usuario en nuestra plataforma.
<br><br>
                    Uso de la información<br>
                    2.1. Utilizamos la información recopilada para proporcionarte nuestros servicios y mejorar tu experiencia en nuestra plataforma.<br>
                    2.2. Podemos utilizar tu dirección de correo electrónico para enviarte comunicaciones relacionadas con nuestros servicios, como actualizaciones, notificaciones y promociones.<br>
                    2.3. Podemos utilizar información agregada y anónima para fines estadísticos y de análisis, con el fin de mejorar nuestros servicios y comprender mejor las necesidades de nuestros usuarios.
<br><br>
                    Compartir información<br>
                    3.1. No vendemos, alquilamos ni compartimos tu información personal con terceros no afiliados, excepto según se describe en esta Política de privacidad.<br>
                    3.2. Podemos compartir tu información personal con terceros proveedores de servicios que nos ayudan a brindar y mejorar nuestros servicios, siempre y cuando estén sujetos a obligaciones de confidencialidad.<br>
                    3.3. Podemos divulgar tu información personal si creemos de buena fe que dicha divulgación es necesaria para cumplir con la ley, proteger nuestros derechos legales o responder a una solicitud legalmente válida.<br><br>

                    Seguridad de la información<br>
                    4.1. Implementamos medidas de seguridad razonables para proteger la información personal del Usuario contra el acceso no autorizado, la divulgación o la destrucción.<br>
                    4.2. Sin embargo, no podemos garantizar la seguridad absoluta de la información transmitida a través de Internet. El Usuario reconoce que cualquier transmisión de información es bajo su propio riesgo.
<br><br>
                    Enlaces a sitios web de terceros<br>
                    Nuestra plataforma puede contener enlaces a sitios web de terceros. Esta Política de privacidad se aplica únicamente a la información recopilada por Chances y no somos responsables de las prácticas de privacidad de esos sitios web de terceros. Recomendamos leer las políticas de privacidad de esos sitios web de terceros antes de proporcionar cualquier información personal.
<br>
                    Cambios en la Política de privacidad
                    Nos reservamos el derecho de modificar esta Política de privacidad en cualquier momento. Cualquier cambio será efectivo cuando se publique la versión actualizada en nuestra plataforma. Te recomendamos revisar periódicamente esta Política de privacidad para estar informado sobre cómo protegemos tu información personal.
<br>
                    Contacto
                    Si tienes preguntas o inquietudes sobre nuestra Política de privacidad, puedes ponerte en contacto con nosotros a través de los canales de soporte proporcionados en nuestro sitio web.
<br><br>
                    Al utilizar nuestros servicios, el Usuario acepta los términos de esta Política de privacidad.
              </div>
              <button id="close">Cerrar</button>
            </div>
          </div>
    </div> 
</section>

<script src="js/terminos.js"></script>

</body>
</html>
