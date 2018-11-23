<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.: Clases :.</title>
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

    <?php include_once "../../menu/m_datos.php"; ?>
    <div align="center">
    <table width="90%">
      <tr>
        <td>
        	<a href="index.php" class="text-info"><i class="icon-fast-backward"></i> <strong>Regresar</strong></a>
        	<table class="table table-bordered">
            	<tr class="info">
                	<td>
                  	    <div class="row-fluid">
                            <div class="span6">
                            	<h2 class="text-info">
                                    <img src="img/materia.png" width="80" height="80">
                                    Control de Clases
                                </h2>
                            </div>
                            <div class="span6">
                            	<form name="form1" method="post" action="">
                                	<div class="input-append">
                                	<input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Clase">
                                    <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                                    </div>
                          	    </form>
                                <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                                	<strong><i class="icon-plus"></i> Ingresar Nueva Clase</strong>
                                </a>
                                
                                <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                                <form name="form1" method="post" action="">
                                    <div class="modal-header">
	                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	                                <h3 id="myModalLabel">Ingresar Nueva Clase</h3>
                                    </div>
                                    <div class="modal-body">
									    <div class="row-fluid">
	                                        <div class="span6">
                                        		<strong>Nombre de la Clase</strong><br>
                                                <input type="text" name="nombre" autocomplete="off" required value="">    
                                            </div>
    	                                    <div class="span6">
                                            	<strong>Estado de la Clase</strong><br>
                                                <select name="estado">
                                                	<option value="1">Activo</option>
                                                    <option value="0">No Activo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                	                    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
            	                        <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                                    </div>
                                    </form>
                                </div>
                                
                            </div>
                    	</div>
                    </td>
              	</tr>
            </table>
            <?php
				if(!empty($_POST['nombre'])){
					$nombre=limpiar($_POST['nombre']);		
					if(empty($_POST['id'])){
						$oMateria=new Proceso_Clase($conexion,'',$nombre);
						$oMateria->guardar($conexion);
						echo mensajes('La clase "'.$nombre.'" Registrada con Exito','verde');
					}else{
						$ID_CLASE=limpiar($_POST['id']);	
						$oMateria=new Proceso_Clase($conexion,$ID_CLASE,$nombre);
						$oMateria->actualizar($conexion);
						echo mensajes('La clase "'.$nombre.'" Actualizada con Exito','verde');
					}
				}
			?>
            <table class="table table-bordered table-hover">
            	<tr class="info">
                	<td width="17%"><center><strong class="text-info">Codigo Clase</strong></center></td>
                    <td width="60%"><strong class="text-info">Nombre de la Clase</strong></td>
                    <!-- <td width="18%"><center><strong class="text-info">Estado</strong></center></td> -->
                    <td width="5%"></td>
                </tr>
                <?php
					if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
						$pa=mysqli_query($conexion,"SELECT * FROM CLASE WHERE NOMBRE_CLASE LIKE '%$buscar%' or ID_CLASE='$buscar'");					
					}else{
						$pa=mysqli_query($conexion,"SELECT * FROM CLASE");				
					}
					
					while($row=mysqli_fetch_array($pa)){
				?>
                <tr>
                	<td><center><?php echo $row['ID_CLASE']; ?></center></td>
                    <td><?php echo $row['NOMBRE_CLASE']; ?></td>
                    <!-- <td><center><?php echo estado($row['ACTIVO']); ?></center></td> -->
                    <td>
                    	<center>
                        	<a href="#a<?php echo $row['ID_CLASE']; ?>" title="Editar Clase" role="button" class="btn btn-mini" data-toggle="modal">
                            	<i class="icon-edit"></i>
                            </a>
                        </center>
                    </td>
                </tr>
                
               <div id="a<?php echo $row['ID_CLASE']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	            	<form name="form2" method="post" action="">
                    	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Actualizar Clase</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>Nombre de la Clase</strong><br>
                                    <input type="text" name="nombre" autocomplete="off" required value="<?php echo $row['NOMBRE_CLASE']; ?>">    
                                </div>
                                <!-- <div class="span6">
                                    <strong>Estado de la Clase</strong><br>
                                    <select name="estado">
                                        <option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>Activo</option>
                                        <option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>No Activo</option>
                                    </select>
                                </div> -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                            <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                        </div>
                        </form>
                    </div>
                
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
