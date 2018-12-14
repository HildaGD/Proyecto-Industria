<?php 
  session_start();
  include_once "Modulos/php_conexion.php";
  include_once "Modulos/funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title> Inicio de sesion </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #000;
  background-image: url(img/a7c12ee2.png);
  background-repeat: repeat;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #000;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      input{ 
      text-align:center; 
      } 
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

<link rel="icon" type="image/png" sizes="32x32" href="ico/favicon.png">
  </head>

  <body>

    <div class="container">
    <form name="form1" method="post" action="" class="form-signin">
        <center><img src="img/school-building.jpg" width="300" height="300"></center><br>
        <?php 
      if(!empty($_POST['usu']) and !empty($_POST['con'])){ 
      $usu=limpiar($_POST['usu']); 
      $con=limpiar($_POST['con']);
      
      $pa=mysqli_query($conexion,"SELECT `ID_PERSONA`, `PRIVILEGIO_ID_PRIVILEGIO`,  `NOMBRES`,  `APELLIDOS` FROM persona WHERE `USUARIO` = '$usu' AND  `CONTRASENIA` =  '$con'");       
      if($row=mysqli_fetch_assoc($pa))
      {
        if($row['PRIVILEGIO_ID_PRIVILEGIO']=='2')
        {
          $nombre=$row['NOMBRES'];
          $nombre=explode(" ", $nombre);
          $nombre=$nombre[0];
          $_SESSION['user_name']=$nombre;
          $_SESSION['tipo_user']="a";
          $_SESSION['cod_user']=$row['ID_PERSONA'];
          echo mensajes('Bienvenido<br>'.$row['NOMBRES'].' '.$row['APELLIDOS'].'<br> Ingresando, por favor espere...','verde').'<br>';
          echo '<center><img src="img/ajax-loader.gif"></center><br>';
          echo '<meta http-equiv="refresh" content="5;url=PrincipalProfesor.php">';
        }
        elseif($row['PRIVILEGIO_ID_PRIVILEGIO']=='1')
        {
          $nombre=$row['NOMBRES'];
          $nombre=explode(" ", $nombre);
          $nombre=$nombre[0];
          $_SESSION['user_name']=$nombre;
          $_SESSION['tipo_user']="p";
          $_SESSION['cod_user']=$row['ID_PERSONA'];
          echo mensajes('Bienvenido<br>'.$row['NOMBRES'].' '.$row['APELLIDOS'].'<br> Ingresando, por favor espere...','verde').'<br>';
          echo '<center><img src="img/ajax-loader.gif"></center><br>';
          echo '<meta http-equiv="refresh" content="5;url=PrincipalAdministrador.php">';
        }
        else
        {
          echo mensajes('Usted no se encuentra Activo en la base de datos<br>Consulte con su Administrador de Sistema','rojo'); 
        }

      }else{
        echo mensajes('Usuario y/o Contraseña Incorrecto<br>','rojo');
        echo '<center><a href="index.php" class="btn"><strong>Intentar de Nuevo</strong></a></center>';
      }
    }else{
      echo '  <input type="text" name="usu" class="input-block-level" placeholder="Usuario" autocomplete="off style="text-align:center;" required>
          <input type="password" name="con" class="input-block-level" placeholder="Contraseña" autocomplete="off" required>
          <div align="center"><button class="btn btn-large btn-success" type="submit"><strong>Ingresar</strong></button></div>';   
    }
    ?>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>

</html>
