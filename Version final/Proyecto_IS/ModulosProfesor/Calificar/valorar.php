<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../funciones.php";
	include_once "../class_buscar.php";
	
	if(!empty($_GET['cod'])){
		$id_alumno=$_GET['cod'];
    $id_clase=$_GET['id_clase'];
    $clase=$_GET['clase'];
		$oAlumno=new Consultar_Alumno($conexion,$id_alumno);	
		$nombre_alumno=$oAlumno->consultar('NOMBRE');

	}else{
    print($_GET['cod']);
		header('Location:error.php');
	}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.: <?php echo $nombre_alumno; ?> :.</title>
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
    
    <a href="../index.php" class="text-info"><i class="icon-fast-backward"></i> <strong>Regresar</strong></a>
    <div align="center">
    	<table width="65%">
          <tr>
            <td>
            	<?php 
      					if(!empty($_POST['alumno'])){
      						$id_clase=limpiar($_POST['clase']);
      						$id_seccion=limpiar($_POST['seccion']);
      						$id_parcial=limpiar($_POST['parcial']);
      						$id_alumno=limpiar($_POST['alumno']);
                  $HOMEWORK=limpiar($_POST['HOMEWORK']);
                  $CLASSWORK=limpiar($_POST['CLASSWORK']);
                  $CLASSWORK_EVALUATION=limpiar($_POST['CLASSWORK_EVALUATION']);
                  $TEST=limpiar($_POST['TEST']);
      						$fecha=date('Y-m-d');
                  $oGuardar=new Proceso_Calificar($conexion,$id_clase,$id_seccion,$id_parcial,$id_alumno,$HOMEWORK,$CLASSWORK,$CLASSWORK_EVALUATION,$TEST);
                  $oGuardar->guardar();
      					}
      				?>
            	<table class="table table-bordered">                
                  <tr class="info">
                    <td class="text-info"><h2><img src="img/alumno.png" width="80" height="80"> <?php echo $id_alumno.' | '.$nombre_alumno.' | '.$clase; ?></h2></td>
                  </tr>
              </table>
              <div class="row-fluid">   
              </div>
                <br>
                <table class="table table-bordered table table-hover">
                  <tr class="info">
                    <td width="17%"><center><strong class="text-info">PARCIAL</strong></center></td>
                    <td width="17%"><center><strong class="text-info">HOMEWORK</strong></center></td>
                    <td width="17%"><center><strong class="text-info">CLASSWORK</strong></center></td>
                    <td width="17%"><center><strong class="text-info">CLASSWORK EVALUATION</strong></center></td>
                    <td width="17%"><center><strong class="text-info">TEST</strong></center></td>
                    <td width="10%"><strong class="text-info"></strong></td>
                  </tr>
                  <?php 
				 	          if(!empty($_GET['periodo'])){
				  		        $id_periodo=limpiar($_GET['periodo']);
						          $pa=mysqli_query($conexion,"SELECT * FROM Calificaciones WHERE id_alumno='$id_alumno' and periodo='$id_periodo' group by alumno, materia");
					          }else{
						          $pa=mysqli_query($conexion,"SELECT *
                                        FROM Calificaciones A INNER JOIN PARCIAL B ON A.ID_PARCIAL = B.ID_PARCIAL 
                                        INNER JOIN periodo AS P ON P.id_periodo = A.ANIO
                                        WHERE id_alumno='$id_alumno'
                                        AND ID_CLASE='$id_clase'
                                        AND P.ESTADO = 1");					
					          }
					          while($row=mysqli_fetch_array($pa)){
						          $url=$row['ID_CLASE'];						
				          ?>
                  <tr>
                    <td><center><?php echo $row['NOMBRE_PARCIAL']; ?></center></td>
                    <td><center><?php echo $row['HOMEWORK'].'%'; ?></center></td>
                    <td><center><?php echo $row['CLASSWORK'].'%'; ?></center></td>
                    <td><center><?php echo $row['CLASSWORK_EVALUATION'].'%'; ?></center></td>
                    <td><center><?php echo $row['TEST'].'%'; ?></center></td>
                    <td>
                      <center>
                        <a href="#myModal<?php echo $row['ID_PARCIAL']; ?>" role="button" class="btn" data-toggle="modal"><strong>Editar</strong></a>
                      </center>
                    </td> 
                    <div id="myModal<?php echo $row['ID_PARCIAL']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="form2" method="post" action="">
                        <input type="hidden" name="parcial" value="<?php echo $row['ID_PARCIAL']; ?>">
                        <input type="hidden" name="seccion" value="<?php echo $row['ID_SECCION']; ?>">
                        <input type="hidden" name="grado" value="<?php echo $row['ID_GRADO']; ?>">
                        <input type="hidden" name="alumno" value="<?php echo $row['ID_ALUMNO']; ?>">
                        <input type="hidden" name="clase" value="<?php echo $row['ID_CLASE']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Editar Notas</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>HOMEWORK</strong><br>
                                    <input type="text" name="HOMEWORK" autocomplete="off" required value="<?php echo $row['HOMEWORK']; ?>">    
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>CLASSWORK</strong><br>
                                    <input type="text" name="CLASSWORK" autocomplete="off" required value="<?php echo $row['CLASSWORK']; ?>">    
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>CLASSWORK EVALUATION</strong><br>
                                    <input type="text" name="CLASSWORK_EVALUATION" autocomplete="off" required value="<?php echo $row['CLASSWORK_EVALUATION']; ?>">    
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>TEST</strong><br>
                                    <input type="text" name="TEST" autocomplete="off" required value="<?php echo $row['TEST']; ?>">    
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                            <button type="submit" class="btn btn-success"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                        </div>
                        </form>
                  </div>                   
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
