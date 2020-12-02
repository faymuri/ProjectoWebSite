<?php

//se inclue el archivo conexion.php que es en donde se encuentra 
//las instrucciones para establecer la conexion entre php y la base de datos
include('conexion.php');

//Evita el error de las variables vacias
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();

//Si se ha enviado el formulario
// se inicializan variables con los parametros de la tabla usuarios
$correo_electronico = $_REQUEST['correo_electronico'];
$clave = $_REQUEST['clave'];
$nombre_completo = $_REQUEST['nombre_completo'];

if (isset($user) && isset($clave))

     {
        // extrae  las  3 primeras letras de la informacion ingresada en el campo usuario      
         $salt = substr ($correo_electronico, 0, 3);
         // se crea la encriptacion de la clave ingresada para hacer una contraseña segura
         $clave_crypt = crypt ($clave, $salt);
         $instruccion = "SELECT correo_electronico, clave FROM registro WHERE correo_electronico = '$correo_electronico'" .
            " and clave = '$clave_crypt'";
         $consulta = mysqli_query ($conexion, $instruccion)
            or die ("Fallo en la consulta");
         $nfilas = mysqli_num_rows ($consulta);
         mysqli_close ($conexion);


      // Los datos introducidos son correctos
         if ($nfilas > 0)
         {
            $correo_electronico_valido = $correo_electronico ;
            $_SESSION["correo_electronico_valido"] = $correo_electronico_valido;
           // print ("<P>Valor de la variable de sesión: $usuario_valido</P>\n");
            echo" <script>
                    window.alert('Bienvenido $nombre_completo');
                  </script>";
         }
      }


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Computer Store </title>
    <!--normalizacion web-->
    <link rel="stylesheet" href="../CSS/normalize.css">
    <!-- Bootstrap  CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!--linkcss-->
    <link rel="stylesheet" href="/CSS/grid.css">
    <link rel="stylesheet" href="/CSS/formularios.css">
    <!--Fuente-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!--social bar -->
    <link rel="icon" href="/Images/newlogo.png">
    <link rel="stylesheet" href="../CSS/font.css">
    <!--iconomenu-->
    <link rel="stylesheet" href="/socia-bar/icon-menu.css">
</head>

<body>

  <div class="social">
    <ul>
      <li><a href="https://www.facebook.com/" target="none" class="icon-facebook2"></a></li>
      <li><a href="https://twitter.com/" target="none" class="icon-twitter"></a></li>
      <li><a href="https://youtube.com/" target="none" class="icon-youtube"></a></li>
      <li><a href="https://www.instagram.com/" target="none" class="icon-instagram"></a></li>

    </ul>
  </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.html">Computer Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
          aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/HTML/index.html">Home</a>
            </li>
            <div class="dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Nuestros Productos
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="procesadores.html">Procesadores</a>
                <a class="dropdown-item" href="tarjetas.html">Tarjetas</a>
                <a class="dropdown-item" href="almacenamiento.html">Almacenamiento</a>
                <a class="dropdown-item" href="accesorios.html">Accesorios</a>
                <a class="dropdown-item" href="nuestros productos.html">Ver todo</a>
              </div>
            </div>
            <div class="dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Nuestra Empresa</a>
             <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="nuestra empresa.html">¿Quienes somos?</a>
              <a class="dropdown-item" href="Mision.html">Mision</a>
              <a class="dropdown-item" href="Vision.html">Vision</a>
              <a class="dropdown-item" href="valores.html">Nuestros Valores</a>
              </div>
            </div>
            <li class="nav-item">
              <a class="nav-link" href="../HTML/contacto.html">Contactanos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/HTML/login.html">Mi Cuenta</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php
    if (isset($_SESSION["correo_electronico_valido"])){
      }
    ?>

<?PHP
     
       // Intento de entrada fallido
   else  (isset ($correo_electronico))
   {
      print ("<BR><BR>\n");
      print ("<P ALIGN='CENTER'>Acceso no autorizado</P>\n");
      
      print ("<P ALIGN='CENTER'><a class='btn btn-primary' href='login.php' role='button'>Conectar</a></P>\n");

   }
   ?>
  
      <!--seccion del formulario-->
    <form class="formulario" action="login.php" method="POST">
        <div class="col-12 user-img">
            <img src="/Images/newlogo.png" th:src="@{/img/user.png}" />
            <h1>Login</h1>
        </div>
        <div class="contenedor">
            <div class="input-contenedor">
                <i class="fas fa-envelope icon"></i>
                <input type="email" placeholder="Correo Electronico" name="correo_electronico" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ingrese un correo electronico valido" required>

            </div>

            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="password" placeholder="Contraseña" name="clave" required title="ingrese una contraseña">

            </div>
            <input type="submit" value="Login" class="button">
            <p>Al iniciar sesion, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
            <p>¿No tienes una cuenta? <a class="link" href="/HTML/registro.html">Registrate </a></p>
        </div>
    </form>
    <!-- Footer -->
    <footer class="py-5 footer">
        <div class="wrapper">

            <section class="columns">

                <div class="column">
                    <img src="/Images/imgs/camion.png" alt="">
                    <a>ENVÍO RÁPIDO Y GRATUITO</a>
                    <p>Todos los productos de la tienda en línea tienen envío gratuito a toda Colombia.</p>
                </div>

                <div class="column">
                    <img src="/Images/imgs/mercadopago-blanco-40.png" alt="">
                    <a>CON MERCADOPAGO ES MÁS FÁCIL</a>
                    <p>En nuestra tienda podrás usar tu método de pago favorito.</p>
                </div>

                <div class="column">
                    <img src="/Images/imgs/seguridad (1).png" alt="">
                    <a>COMPRA FÁCIL Y 100% SEGURA</a>
                    <p>Todos tus datos están protegidos con nuestro certificado de seguridad.</p>
                </div>
            </section>
        </div>
    </footer>
    <div class="article">
        <article class="columns">

            <div class="column">
                <h2>COMUNÍCATE CON NOSOTROS</h2>
                <p> +57 (1) 333 333 </br>
                    +57 (320) 590 3860</br>
                    +57 (301) 257 2493</br>
                    contacto@computerstore.com </br>
                    Si tienes alguna queja, reclamo contactar al número de telefono
                </p>

            </div>

            <div class="column">
                <h2>¡VISÍTANOS!</h2>
                <p>Carrera 68 #104, Complejo Norte, Medellín, Antioquia</p>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7163230763854!2d-75.57092368590659!3d6.300956127460148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e442f25d6670d4d%3A0x8043999e5e767b96!2sSENA%20-%20Centro%20de%20Tecnolog%C3%ADa%20de%20la%20Manufactura%20Avanzada!5e0!3m2!1ses-419!2sco!4v1592176140054!5m2!1ses-419!2sco"
                    width="300" height="100" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
            <div class="column">
                <h2>MÉTODOS DE PAGO</h2>
                <img src="/Images/mtodos-de-pago-en-la-tienda.png" width="300px" height="100px" alt="">
            </div>

        </article>
    </div>
    <div class="formulate">
      <p class="m-0 text-center ">Todos los derechos son reservados <h7>Computer Store</h7> Copyright &copy; Fay Murillo y Camilo Moreno 2020</p>
    </div>




    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>

</body>

</html>