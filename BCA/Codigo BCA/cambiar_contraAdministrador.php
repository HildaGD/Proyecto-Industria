<?php 
 error_reporting(0);
	session_start();
	include_once "Modulos/php_conexion.php";
	include_once "Modulos/funciones.php";
	if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='p'){
		$usu=limpiar($_SESSION['cod_user']);
	
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.: Cambiar Contraseña :.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="ico/favicon.png">
  </head>
  <!-- FACEBOOK COMENTARIOS -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- FIN CODIGO FACEBOOK -->
  <body>

    <?php include_once "menuAdministrador/m_principalAdministrador.php"; ?>
	<div align="center">
    	<?php 
			if(!empty($_POST['con'])){
				$con=limpiar($_POST['con']);
				$n1=limpiar($_POST['n1']);
				$n2=limpiar($_POST['n2']);
				
				if($n1==$n2){
					
					$can=mysqli_query($conexion, "SELECT * FROM persona WHERE ID_PERSONA=$usu and CONTRASENIA = '$con'"); 
					if($dato=mysqli_fetch_array($can)){
						mysqli_query($conexion, "UPDATE persona SET CONTRASENIA='$n2' WHERE ID_PERSONA = '$usu';");
						echo mensajes('Contraseña Cambiada Con Exito','verde');
					}else{
						echo mensajes('La Contraseña Antigua Digitada no es Correcta, Vuelva a Intentarlo','rojo');
					}
				}else{
					echo mensajes('Debe de Confirmar Correctamente la Nueva Contraseña Digitada','rojo');
				}
			}
		
		?>
    	<table width="70%" >
          <tr>
            <td><br>
            	<table class="table table-bordered">
                  <tr class="info">
                    <td><h1 align="center"><img src="img/act.png" width="100" height="100" class="img-circle img-polaroid"> Cambiar Contraseña</h1></td>
                  </tr>
                  <tr>
                    <td>
                    	<div align="center">
                            <form name="form1" method="post" action=""><br>
                                <strong>Contraseña Antigua</strong><br>
                                <input type="password" name="con" class="input-xlarge" required><br>
                                <strong>Contraseña Nueva</strong><br>
                                <input type="password" name="n1" class="input-xlarge" required><br>
                                <strong>Confirme la Nueva Contraseña</strong><br>
                                <input type="password" name="n2" class="input-xlarge" required><br><br>
                                <button type="submit" name="boton" class="btn btn-primary">
                                	<i class="icon-refresh"></i> <strong>Actualizar Contraseña</strong>
                                </button>
                            </form>
                        </div>
                    </td>
                  </tr>
                </table>

            </td>
          </tr>
        </table>
    </div>
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
<?php 

}else{
    header("HTTP/1.1 403 Forbidden");
  }
?>