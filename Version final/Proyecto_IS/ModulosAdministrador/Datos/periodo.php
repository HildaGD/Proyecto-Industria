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
    <title>.: Periodos :.</title>
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
                                    <img src="img/act.png" width="80" height="80">
                                    Control de Periodos
                                </h2>
                            </div>
                            <div class="span6">
                              <input type="hidden" name="confirmar" autocomplete="off" required value="1"> 
                            	<form name="form1" method="post" action="">
                                	<div class="input-append">
                                	<input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Periodo">
                                    <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                                    </div>
                          	    </form>
                                <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                                	<strong><i class="icon-plus"></i> Ingresar Nuevo Periodo</strong>
                                </a>                                
                                <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                	<form name="form1" method="post" action="">
                                    <div class="modal-header">
    	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                                    <h3 id="myModalLabel">Ingresar Nuevo Periodo</h3>
                                    </div>
                                    <div class="modal-body">
										                  <div class="row-fluid">
                                            <div class="span6">
                                              <input type="hidden" name="confirmar" autocomplete="off" required value="1"> 
                                            	<strong>Año</strong><br>
                                                <input type="year" name="anio" step="1" min="2000" max="3000" value="<?php echo date("Y");?>"><br><br>
                                              <strong>Estado</strong><br>
                                              <select name="estado">
                                                  <option value="1">Activo</option>
                                                  <option value="0">No Activo</option>
                                              </select>
                                            </div>
                                            <div class="span6">
                                            	<strong>Número</strong><br>
                                                <select name="periodo">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
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
        if(!empty($_POST['confirmar'])){
        if ($_POST['confirmar'] == "1") {
              $PERIODO=limpiar($_POST['periodo']);              
              $ANIO=limpiar($_POST['anio']);  
              $PERIODO_ACTIVO=limpiar($_POST['estado']); 
              $oPeriodo=new Proceso_Periodo($conexion, '', $ANIO, $PERIODO, $PERIODO_ACTIVO);
              $oPeriodo->guardar($conexion);}

        if ($_POST['confirmar'] == "2") {
              $PERIODO=limpiar($_POST['periodo']);              
              $ANIO=limpiar($_POST['anio']);  
              $PERIODO_ACTIVO=limpiar($_POST['estado']);
              $ID_PERIODO=limpiar($_POST['id_periodo']); 
              $oPeriodo=new Proceso_Periodo($conexion,$ID_PERIODO ,$ANIO, $PERIODO, $PERIODO_ACTIVO);
              $oPeriodo->actualizar($conexion);}

        if ($_POST['confirmar'] == "3") {
              $ID_PERIODO=limpiar($_POST['id_periodo']); 
              $oPeriodo=new Proceso_Periodo($conexion,$ID_PERIODO , '', '','');
              $oPeriodo->eliminar($conexion);}}
		?>
        <table width="65%" >
          <tr>
            <td>
            	<table class="table table-bordered table table-hover">
                  <tr class="info">
                    <!--<td width="11%"><center><strong class="text-info">Codigo Periodo</strong></center></td>-->
                    <td width="20%"><center><strong class="text-info">Año</strong></center></td>
                    <td width="20%"><center><strong class="text-info">Periodo</strong></center></td>
                    <td width="20%"><center><strong class="text-info">Estado</strong></center></td>
                    <td width="20%"><center><strong class="text-info">Editar</strong></center></td>
                    <td width="20%"><center><strong class="text-info">Desactivar</strong></center></td>
                  </tr>
                  <?php
				  	if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
						$pa=mysqli_query($conexion,"SELECT * FROM PERIODO
                                       WHERE ANIO LIKE '%$buscar%' or PERIODO LIKE '$buscar'");					
					}else{
						$pa=mysqli_query($conexion,"SELECT * FROM PERIODO ORDER BY ANIO,PERIODO DESC");				
					}
					while($row=mysqli_fetch_array($pa)){
				  ?>
                  <tr>
                    <td><center><?php echo $row['anio']; ?></center></td>
                    <td><CENTER><?php echo $row['periodo']; ?></CENTER></td>
                    <td><center><?php echo estado($row['estado']); ?></center></td>
                    <td>
                    	<center>
                        	<a href="#a<?php echo $row['id_periodo']; ?>" title="Editar Periodo" role="button" class="btn btn-mini" data-toggle="modal">
                            	<i class="icon-edit"></i>
                            </a>
                      </center>
                         <div id="a<?php echo $row['id_periodo']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <form name="form1" method="post" action="">
                          <input type="hidden" name="id_periodo" value="<?php echo $row['id_periodo']; ?>">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 id="myModalLabel">Actualizar Periodo</h3>
                          </div>
                          <div class="modal-body">
                                <div class="row-fluid">
                                    <div class="span6">
                                      <strong>Año</strong><br>
                                      <input type="text" name="anio" autocomplete="off" required value="<?php echo $row['anio']; ?>"><br>
                                      <strong>Estado</strong><br>
                                      <select name="estado">
                                        <option value="1" >Activo</option>
                                        <option value="0" >No Activo</option>
                                      </select>                                     
                                      <input type="hidden" name="confirmar" autocomplete="off" required value="2">
                                      <input type="hidden" name="id_periodo" autocomplete="off" required value="<?php echo $row['id_periodo']; ?>">                                     
                                    </div>
		                            <div class="span6">			                            
			                            <strong>Periodo</strong><br>
			                            <input type="text" name="periodo" autocomplete="off" required value="<?php echo $row['periodo']; ?>">
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
                        <a href="#b<?php echo $row['id_periodo']; ?>" title="Eliminar Seccion" role="button" class="btn btn-mini" data-toggle="modal">
                          <i class="icon-remove"></i>
                        </a>
                      </center>
                    </td>
                    <div id="b<?php echo $row['id_periodo']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <form name="form3" method="post" action="">
                        <input type="hidden" name="id_periodo" value="<?php echo $row['id_periodo']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Desactivar Periodo</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>El periodo "<?php echo $row['periodo'].' - '.$row['anio']; ?>" se desactivará </strong><br>                                    
                                    <input type="hidden" name="confirmar" autocomplete="off" required value="3"> 
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
