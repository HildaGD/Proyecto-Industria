<?php 
	session_start();
  include_once "Modulos/php_conexion.php";
  include_once "Modulos/class_buscar.php";
  include_once "Modulos/funciones.php";
  
	if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='p'){
		$profesor=limpiar($_SESSION['cod_user']);
    $oProfesor=new Consultar_Profesor($profesor,$conexion);
		$nombre_profesor=$oProfesor->consultar('NOMBRES').' '.$oProfesor->consultar('APELLIDOS');
	}else{
		header('Location:error.php');
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.: Principal Profesor:.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="ico/favicon.png">
  </head>

  <body>

    <?php include_once "menuProfesor/m_principalProfesor.php"; ?>
    <br><br>
	  <div align="center">
    	<h2><?php echo $nombre_profesor; ?></h2>
    	<table width="60%">
          <tr>
            <td>
            	<table class="table table-bordered">
                  <tr class="info">
                    <td colspan="2"><h2 class="text-info" align="center"><img src="img/salon.png" width="80" height="80">  Mis Clases</h2></td>
                  </tr>
                    <?php 
				  	          $pa=mysqli_query($conexion,"SELECT a.nombre_clase, a.ID_CLASE FROM clase as a inner join CLASEXMAESTRO as b on a.ID_CLASE=b.ID_CLASE where ID_MAESTRO='$profesor' and a.estado_clase = 1;");				
					            while($row=mysqli_fetch_assoc($pa)){
					        	    $url=$row['ID_CLASE'];
  				          ?>
                  <tr>
                      <td>
                      	<div align="center">
                          	<a href="ModulosProfesor/Calificar/index.php?clase='<?php echo $url; ?>'" title="Ir a Valorar Alumnos" class="btn btn-success btn-lg btn-block">
                          		<strong><i class="icon-ok"></i> <?php echo $row['nombre_clase']; ?></strong>
                              </a>
                          </div>
                      </td>
                    </tr>
                  <?php } ?>
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
