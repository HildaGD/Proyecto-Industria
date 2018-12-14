<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../funciones.php";
	include_once "../class_buscar.php";
	
	if(!empty($_GET['clase'])){
		$id_clase=$_GET['clase'];
	}else{
		header('Location:error.php');
  }
	
  if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='p'){
		$profesor=limpiar($_SESSION['cod_user']);
    $id_clase=limpiar($_GET['clase']);
 		#$pa=mysqli_query($conexion,"SELECT * FROM clasexalumno WHERE id_clase = '$id_clase' ");
   # if(!empty(mysqli_fetch_assoc($pa))){
     # $row=mysqli_fetch_assoc($pa);
		#	$oClase=new Consultar_Clase($row['id_clase'],$conexion);
		#	$nombre_clase=$oClase->consultar('NOMBRE_CLASE');   #.' - '.$row['nombre'];
		#}else{
			#header('Location:error.php');
		#}
		
	}else{
		#header('Location:error.php');
	}
	
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title class="text-info">.: Listado de Alumnos :.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../../css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../../ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../../ico/favicon.png">
  </head>

  <body>

    <?php include_once "../../menuProfesor/m_valorar.php"; ?>
	<div align="center">
    	<table width="70%" >
          <tr>
            <td>
        		<table class="table table-bordered">
                  <tr class="info">
                    <td>
						          <h2 class="text-info"><img src="img/calificar.png" width="80" height="80"> Listado de Alumnos de la Clase</h2>
                    </td>
                  </tr>
                </table> 
                
                <table class="table table-bordered table table-hover">
                  <tr class="info">
                    <td width="15%" colspan="1" class="text-info"><center><strong>Codigo de Alumno</strong></center></td>
                    <td width="45%" colspan="1" class="text-info"><center><strong>Nombre de Alumno</strong></center></td>
                    <td width="8%" colspan="1" class="text-info"><center><strong>Nota Primer Parcial</strong></center></td>
                    <td width="8%" colspan="1" class="text-info"><center><strong>Nota Segundo Parcial</strong></center></td>
                    <td width="8%" colspan="1" class="text-info"><center><strong>Nota Tercer Parcial</strong></center></td>
                    <td width="8%" colspan="1" class="text-info"><center><strong>Nota Cuarto Parcial</strong></center></td>
                    <td width="8%" colspan="1" class="text-info"><center><strong>Nota FINAL</strong></td>
                  </tr>
                  <?php
                    $pa=mysqli_query($conexion,"SELECT distinct ID_CLASE,NOMBRE_CLASE,ID_ALUMNO,NOMBRE,ID_GRADO,ID_PARCIAL,
                                                       SUM(CASE WHEN ID_PARCIAL = 1 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END) AS PRIMER_PARCIAL,
                                                       SUM(CASE WHEN ID_PARCIAL = 2 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END) AS SEGUNDO_PARCIAL,
                                                       SUM(CASE WHEN ID_PARCIAL = 3 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END) AS TERCER_PARCIAL,
                                                       SUM(CASE WHEN ID_PARCIAL = 4 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END) AS CUARTO_PARCIAL,
                                                       SUM(PUNTAJE) AS PARCIALES
                                                FROM (SELECT distinct CA.ID_CLASE,C.NOMBRE_CLASE,A.ID_ALUMNO,A.NOMBRE,CG.ID_GRADO,CL.ID_PARCIAL,HOMEWORK,CLASSWORK,CLASSWORK_EVALUATION,TEST,CL.PUNTAJE
                                                        FROM clasexalumno ca INNER JOIN calificaciones as cl on cl.ID_ALUMNO=ca.ID_ALUMNO AND CL.ID_CLASE = CA.ID_CLASE
                                                        INNER JOIN clasesxgrado AS CG ON CG.ID_CLASE = CA.ID_CLASE
                                                        INNER JOIN alumno AS A ON A.ID_ALUMNO = CA.ID_ALUMNO
                                                        INNER JOIN clase AS C ON C.ID_CLASE = CA.ID_CLASE
                                                        INNER JOIN seccionesxgrado AS SG ON SG.ID_GRADO = CG.ID_GRADO
                                                        INNER JOIN periodo AS P ON P.id_periodo = SG.ID_PERIODO AND CL.ANIO = P.ID_PERIODO
                                                        WHERE P.estado = 1
                                                        AND CA.ID_CLASE = $id_clase) AS T1   ");	

					          while($row=mysqli_fetch_assoc($pa)){
						          $cod_alumno=strtoupper($row['ID_ALUMNO']);
                      $id_clase=$row['ID_CLASE'];
                      $clase=$row['NOMBRE_CLASE'];
						      ?>
                  <tr>
                  	<td><center><?php echo strtoupper($row['ID_ALUMNO']); ?></center></td>
                    <td>                

                      <center><a href='valorar.php?cod=<?php echo $cod_alumno;?>&id_clase=<?php echo $id_clase;?>&clase=<?php echo $clase;?>' title='Calificar Alumno'>
							          <?php echo strtoupper($row['NOMBRE']); ?>
                      </a></center>
					          </td>
                    <td><center><?php echo strtoupper($row['PRIMER_PARCIAL']).'%'; ?></center></td>
                    <td><center><?php echo strtoupper($row['SEGUNDO_PARCIAL']).'%'; ?></center></td>
                    <td><center><?php echo strtoupper($row['TERCER_PARCIAL']).'%'; ?></center></td>
                    <td><center><?php echo strtoupper($row['CUARTO_PARCIAL']).'%'; ?></center></td>
                    <td><center><?php if($row['PARCIALES']>0){echo (($row['PRIMER_PARCIAL']+$row['SEGUNDO_PARCIAL']+$row['TERCER_PARCIAL']+$row['CUARTO_PARCIAL'])/$row['PARCIALES']).'%';}else{echo (($row['PRIMER_PARCIAL']+$row['SEGUNDO_PARCIAL']+$row['TERCER_PARCIAL']+$row['CUARTO_PARCIAL'])/1).'%';} ?></center></td>
                  </tr>  
                  <?php } ?>
                </table>   	
            </td>
          </tr>
        </table>

    </div>
    <!-- Le javascript ../../js/jquery.js
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap-transition.js"></script>
    <script src="../../js/bootstrap-alert.js"></script>
    <script src="../../js/bootstrap-modal.js"></script>
    <script src="../../js/bootstrap-dropdown.js"></script>
    <script src="../../js/bootstrap-scrollspy.js"></script>
    <script src="../../js/bootstrap-tab.js"></script>
    <script src="../../js/bootstrap-tooltip.js"></script>
    <script src="../../js/bootstrap-popover.js"></script>
    <script src="../../js/bootstrap-button.js"></script>
    <script src="../../js/bootstrap-collapse.js"></script>
    <script src="../../js/bootstrap-carousel.js"></script>
    <script src="../../js/bootstrap-typeahead.js"></script>

  </body>
</html>
