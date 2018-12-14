<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../class_buscar.php";
	include_once "../funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.: Secciones :.</title>
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
    <?php include_once "../../menuAdministrador/m_datos.php"; ?>
    <div align="center">
    	<table width="90%" >
          <tr>
            <td>
            	<a href="index.php" class="text-info"><i class="icon-fast-backward"></i> <strong>Regresar</strong></a>
            	<table class="table table-bordered">
                  <tr class="info">
                    <td>
                    
                    	<div class="row-fluid">
                            <div class="span6">
                            	<h2 class="text-info">
                                    <img src="img/salon.png" width="80" height="80">
                                    Control de Secciones
                                </h2>
                            </div>
                            <div class="span6">
                            	<form name="form1" method="post" action="">
                                	<div class="input-append">
                                	<input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Sección">
                                    <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                                    </div>
                          	    </form>
                                <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                                	<strong><i class="icon-plus"></i> Ingresar Nueva Sección</strong>
                                </a>                                
                                <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                	<form name="form1" method="post" action="">
                                    <div class="modal-header">
    	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                                    <h3 id="myModalLabel">Ingresar Nueva Sección</h3>
                                    </div>
                                    <div class="modal-body">
										                  <div class="row-fluid">
                                            <div class="span6">
                                            	<strong>Seccion</strong><br>
                                                <select name="seccion">
                                                 <?php
                                                    $sal=mysqli_query($conexion,"SELECT * FROM seccion");       
                                                    while($col=mysqli_fetch_array($sal)){
                                                      echo '<option value="'.$col['ID_SECCION'].'">'.$col['NOMBRE_SECCION'].'</option>';
                                                  }?>
                                                </select><br>
                                                <strong>Grado</strong><br>
                                                <select name="grado">
        		                            				 <?php
                        														$sal=mysqli_query($conexion,"SELECT * FROM GRADO");				
                        														while($col=mysqli_fetch_array($sal)){
                        															echo '<option value="'.$col['ID_GRADO'].'">'.$col['NOMBRE_GRADO'].'</option>';
                        													}?>
                                              	</select>
                                                <strong>Periodo</strong><br>
                                                <select name="periodo">
                                                 <?php
                                                    $sal=mysqli_query($conexion,"SELECT * FROM periodo WHERE ESTADO = 1");       
                                                    while($col=mysqli_fetch_array($sal)){
                                                      echo '<option value="'.$col['id_periodo'].'">'.$col['periodo'].' - '.$col['anio'].'</option>';
                                                  }?>
                                                </select>
                                            </div>
                                            <div class="span6">                                              
                                            	<strong>Jornada</strong><br>
                                                <select name="jornada">
                                                    <?php
                                                    $sl=mysqli_query($conexion,"SELECT * FROM JORNADA");        
                                                     while($cl=mysqli_fetch_array($sl)){
                                                        echo '<option value="'.$cl['ID_JORNADA'].'">'.$cl['NOMBRE_JORNADA'].'</option>';
                                                                                       }                        							?>
                                                </select><br>
                                                <input type="hidden" name="confirmar" autocomplete="off" required value="1"> 
                                                <strong>Estado</strong><br>
                                                <select name="estado">
                                                    <option value="1">Activo</option>
                                                    <option value="0">No Activo</option>
                                                </select>
                                            </div>                                            
                                        </div> 
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                                        <button type="submit" class="btn btn-success"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                  </tr>
				</table>
            </td>
          </tr>
        </table>
        <?php 
        try{
        if(!empty($_POST['confirmar'])){
        if ($_POST['confirmar'] == "1") {
          PRINT('ENTRA');
              $ID_SECCION=limpiar($_POST['seccion']);  
              $ID_JORNADA=limpiar($_POST['jornada']);
              $ID_GRADO=limpiar($_POST['grado']); 
              if(!empty($_POST['periodo'])){$ID_PERIODO=limpiar($_POST['periodo']);}else{$ID_PERIODO=0;}
              $SECCION_ACTIVO=limpiar($_POST['estado']); 
              $oSeccion=new Proceso_Seccion($conexion,$ID_SECCION, $ID_JORNADA, $ID_GRADO, $SECCION_ACTIVO,$ID_PERIODO);
              $oSeccion->guardar($conexion);         
      }
      if ($_POST['confirmar'] == "2") {
              $ID_SECCION=limpiar($_POST['seccion']);  
              $ID_JORNADA=limpiar($_POST['jornada']);
              $ID_GRADO=limpiar($_POST['grado']); 
              $ID_PERIODO=limpiar($_POST['periodo']); 
              $SECCION_ACTIVO=limpiar($_POST['estado']); 
              $oSeccion=new Proceso_Seccion($conexion,$ID_SECCION, $ID_JORNADA, $ID_GRADO, $SECCION_ACTIVO,$ID_PERIODO);
              $oSeccion->Actualizar($conexion);
      }
      if ($_POST['confirmar'] == "3") {
              $nombre=limpiar($_POST['nombre']);
              $ID_SECCION=limpiar($_POST['id']);  
              $ID_JORNADA=limpiar($_POST['jornada']);
              $ID_GRADO=limpiar($_POST['grado']); 
              $ID_PERIODO=limpiar($_POST['periodo']); 
              $SECCION_ACTIVO=limpiar($_POST['estado']); 
              $oSeccion=new Proceso_Seccion($conexion,$ID_SECCION, $nombre, $ID_JORNADA, $ID_GRADO, $SECCION_ACTIVO,$ID_PERIODO);
              $oSeccion->eliminar($conexion);
          }
        }
      }catch(Exception $e)
                {echo mensajes('ERROR LANZADO '.$e,'rojo');} 

		    ?>
        <table width="90%" >
          <tr>
            <td>
            	<table class="table table-bordered table table-hover">
                  <tr class="info">
                    <td width="11%"><center><strong class="text-info">Periodo</strong></center></td>
                    <td width="23%"><center><strong class="text-info">Sección</strong></center></td>
                    <td width="12%"><center><strong class="text-info">Grado</strong></center></td>
                    <td width="33%"><center><strong class="text-info">Jornada</strong><center></td>
                    <td width="13%"><center><strong class="text-info">Estado</strong></center></td>
                    <td width="4%"><center><strong class="text-info">Editar</strong></center></td>
                    <td width="4%"><center><strong class="text-info">Eliminar</strong></center></td>
                  </tr>
                  <?php
				  	if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
						$pa=mysqli_query($conexion,"SELECT concat(P.periodo,' - ',P.anio) periodo,S.NOMBRE_SECCION,P.ESTADO,G.ID_GRADO,G.NOMBRE_GRADO,J.ID_JORNADA,J.NOMBRE_JORNADA,S.ID_SECCION,p.ID_PERIODO
                                        FROM seccionesxgrado AS SG INNER JOIN seccion AS S ON S.ID_SECCION=SG.ID_SECCION
                                        INNER JOIN grado AS G ON G.ID_GRADO = SG.ID_GRADO
                                        INNER JOIN jornada AS J ON J.ID_JORNADA = SG.ID_JORNADA
                                        INNER JOIN periodo as P on P.id_periodo = SG.id_periodo
                                        WHERE NOMBRE_SECCION LIKE '%$buscar%' or ID_SECCION='$buscar'");					
					}else{
						$pa=mysqli_query($conexion,"SELECT concat(P.periodo,' - ',P.anio) periodo,S.NOMBRE_SECCION,P.ESTADO,G.ID_GRADO,G.NOMBRE_GRADO,J.ID_JORNADA,J.NOMBRE_JORNADA,s.ID_SECCION,p.ID_PERIODO
                                        FROM seccionesxgrado AS SG INNER JOIN seccion AS S ON S.ID_SECCION=SG.ID_SECCION
                                        INNER JOIN grado AS G ON G.ID_GRADO = SG.ID_GRADO
                                        INNER JOIN jornada AS J ON J.ID_JORNADA = SG.ID_JORNADA
                                        INNER JOIN periodo as P on P.id_periodo = SG.id_periodo");				
					}
					while($row=mysqli_fetch_array($pa)){
				  ?>
                  <tr>
                    <td><center><?php echo $row['periodo']; ?></center></td>
                    <td><center><?php echo $row['NOMBRE_SECCION']; ?></center></td>
                    <td><center><?php echo $row['NOMBRE_GRADO']; ?></center></td>
                    <td><center><?php echo $row['NOMBRE_JORNADA']; ?></center></td>
                    <td><center><?php echo estado($row['ESTADO']); ?></center></td>
                    <td>
                    	<center>
                        	<a href="#a<?php echo $row['ID_SECCION']; ?>" title="Editar Seccion" role="button" class="btn btn-mini" data-toggle="modal">
                            	<i class="icon-edit"></i>
                            </a>
                      </center>
                         <div id="a<?php echo $row['ID_SECCION']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <form name="form1" method="post" action="">
                          <input type="hidden" name="id" value="<?php echo $row['ID_SECCION']; ?>">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 id="myModalLabel">Actualizar Seccion</h3>
                          </div>
                          <div class="modal-body">
                                <div class="row-fluid">
                                    <div class="span6">
                                      <strong>Nombre de la seccion</strong><br>
                                      <input type="text" name="seccion" autocomplete="off" required value="<?php echo $row['NOMBRE_SECCION']; ?>"><br>
                                      <input type="hidden" name="confirmar" autocomplete="off" required value="2"> 
                                      <input type="hidden" name="periodo" autocomplete="off" required value="<?php echo $row['ID_PERIODO']; ?>"> 
                                      <strong>Grado</strong><br>
                                      <select name="grado">
                                          <?php
                                              $sal=mysqli_query($conexion,"SELECT * FROM GRADO");				
                                              while($col=mysqli_fetch_array($sal)){
          							                        if($col['ID_GRADO']==$row['ID_GRADO']){
                                    	            echo '<option value="'.$col['ID_GRADO'].'" selected>'.$col['NOMBRE_GRADO'].'</option>';
          							                        }else{
          									                      echo '<option value="'.$col['ID_GRADO'].'">'.$col['ID_GRADO'].'</option>';  
							                                                        }
                                                    }
                                          ?>
                                      </select>
                                    </div>
		                            <div class="span6">
			                            <strong>Jornada</strong><br>
                                        <select name="jornada">
                                            <?php
                                                $sal=mysqli_query($conexion,"SELECT DISTINCT J.ID_JORNADA,J.NOMBRE_JORNADA 
                                                                             FROM seccionesxgrado AS sg 
                                                                             inner join JORNADA AS J ON J.ID_JORNADA = sg.ID_JORNADA");             
                                                while($col=mysqli_fetch_array($sal))
                                                    { echo '<option value="'.$col['ID_JORNADA'].'">'.$col['NOMBRE_JORNADA'].'</option>'; }
                                            ?>
                                        </select><br> 
			                            <strong>Estado</strong><br>
			                            <select name="estado">
			                                <option value="1" >Activo</option>
			                                <option value="0" >No Activo</option>
			                            </select>
		                            </div>
                                </div>

                          <div class="modal-footer">
                              <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                              <button type="submit" class="btn btn-success"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
                          </div>
                          </form>
                      </div>        
                    </td>
                    <td>
                      <center>
                        <a href="#b<?php echo $row['ID_SECCION']; ?>" title="Eliminar Seccion" role="button" class="btn btn-mini" data-toggle="modal">
                          <i class="icon-remove"></i>
                        </a>
                      </center>
                    </td>
                    <div id="b<?php echo $row['ID_SECCION']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <form name="form3" method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $row['ID_SECCION']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Eliminar Seccion</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>La Seccion "<?php echo $row['NOMBRE_SECCION']; ?>" se eliminara </strong><br>
                                    <input type="hidden" name="nombre" autocomplete="off" required value="<?php echo $row['NOMBRE_SECCION']; ?>"> 
                                    <input type="hidden" name="id" autocomplete="off" required value="<?php echo $row['ID_SECCION']; ?>"> 
                                    <input type="hidden" name="confirmar" autocomplete="off" required value="3"> 
                                    <input type="hidden" name="jornada" value="<?php echo $row['ID_JORNADA']; ?>">
                                    <input type="hidden" name="grado" value="<?php echo $row['ID_GRADO']; ?>">
                                    <input type="hidden" name="estado" value="<?php echo $row['SECCION_ACTIVO']; ?>">
                                    <input type="hidden" name="periodo" value="<?php echo $row['ID_PERIODO']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                            <button type="submit" class="btn btn-danger"><i class="icon-ok"></i> <strong>Confirmar</strong></button>
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
