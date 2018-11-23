<?php 
	include_once "php_conexion.php";
	include_once "class/class.php";
	include_once "class/funciones.php";
	
	if(!empty($_GET['estado'])){
		$nit=limpiar($_GET['estado']);
	  	$cans=mysql_query("SELECT * FROM tarifas WHERE id='$nit'");
	  	if($dat=mysql_fetch_array($cans)){
        	if($dat['estado']=='s'){
		  		$xSQL="Update tarifas Set estado='n' Where id='$nit'";
		  		mysql_query($xSQL);
		  		header('location:tarifas.php');
            }else{
				$xSQL="Update tarifas Set estado='s' Where id='$nit'";
				mysql_query($xSQL);
				header('location:tarifas.php');
            }	
	  	}
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.: Principal :.</title>
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

    <?php include_once "menu/m_principal.php"; ?>
  <div align="center">
    <table width="90%">
      <tr>
        <td>
        	<div align="right">
			  <a href="#nuevo" role="button" class="btn" data-toggle="modal"><i class="icon-plus"></i><strong> Nuevo Registro</strong></a>
            </div><br>
            <?php 
				if(!empty($_POST['valor'])){
					$tiempo=limpiar($_POST['tiempo']);				$valor=limpiar($_POST['valor']);
					$descrip=limpiar($_POST['descrip']);			$estado=limpiar($_POST['estado']);
					
					if(empty($_POST['id'])){
						$objGuardar=new Proceso_Tarifas($tiempo,$descrip,$valor,'',$estado);
						$objGuardar->guardar();
						echo mensajes('Registro Guardado con Exito','verde');
					}else{
						$id=limpiar($_POST['id']);
						$objGuardar=new Proceso_Tarifas($tiempo,$descrip,$valor,$id,$estado);
						$objGuardar->actualizar();
						echo mensajes('Registro Actualizado con Exito','verde');
					}
				}
			?>
        	<table class="table table-bordered table table-hover">
              <tr class="info">
                <td><strong>Tiempo</strong></td>
                <td><strong>Descripcion</strong></td>
                <td><strong>Valor</strong></td>
                <td><center><strong>Estado</strong></center></td>
                <td>&nbsp;</td>
              </tr>
              <?php 
			  	$cans=mysql_query("SELECT * FROM tarifas");
                while($row=mysql_fetch_array($cans)){
			  ?>
              <tr>
                <td><?php echo $row['tiempo']; ?></td>
                <td><?php echo $row['descrip']; ?></td>
                <td>$ <?php echo formato($row['valor']); ?></td>
                <td>
                	<center>
                        <a href="tarifas.php?estado=<?php echo $row['id']; ?>" title="Cambiar Estado">
	                        <?php echo estado($row['estado']); ?>
                        </a>
                    </center>
                </td>
                <td>
                	<center>
	                	<a href="#m<?php echo $row['id']; ?>" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-edit"></i></a>
                    </center>
                
                </td>
              </tr>
 	          <div id="m<?php echo $row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                	<form name="form1" method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	                <h3 id="myModalLabel">Actualizar Registro</h3>
                    </div>
                    <div class="modal-body">
        	            <div class="row-fluid">
                            <div class="span6">
                                <strong>Tiempo/Duracion</strong><br>
                                <input type="text" name="tiempo" autocomplete="off" required value="<?php echo $row['tiempo']; ?>"><br>
                                <strong>Valor</strong><br>
                                <div class="input-prepend input-append">
                                    <span class="add-on"><strong>$</strong></span>
                                    <input type="number" class="input-medium" name="valor" min="1" value="<?php echo $row['valor']; ?>" autocomplete="off" required>
                                    <span class="add-on"><strong>.00</strong></span>
                                </div>
                            </div>
                            <div class="span6">
                                <strong>Descripcion de la Operacion</strong><br>
                                <input type="text" name="descrip" autocomplete="off" required value="<?php echo $row['descrip']; ?>"><br>
                                <strong>Estado</strong><br>
                                <select name="estado">
                                    <option value="s" <?php if($row['estado']=='s'){echo 'selected';} ?>>Activo</option>
                                    <option value="n" <?php if($row['estado']=='n'){echo 'selected';} ?>>No Activo</option>
                                </select>  
                            </div>
                    	</div>
                    </div>
                    <div class="modal-footer">
            	        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                	    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar Cambios</strong></button>
                    </div>
                    </form>
                </div>
              <?php } ?>
            </table>

        </td>
      </tr>
    </table>
	</div>
    
    		<div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            	<form name="form1" method="post" action="">
                <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	            <h3 id="myModalLabel">Nuevo Registro</h3>
                </div>
                <div class="modal-body">
        	        <div class="row-fluid">
                    	<div class="span6">
                        	<strong>Tiempo/Duracion</strong><br>
                            <input type="text" name="tiempo" autocomplete="off" required><br>
                            <strong>Valor</strong><br>
                            <div class="input-prepend input-append">
								<span class="add-on"><strong>$</strong></span>
	                            <input type="number" class="input-medium" name="valor" min="1" autocomplete="off" required>
                                <span class="add-on"><strong>.00</strong></span>
							</div>
                        </div>
                    	<div class="span6">
                        	<strong>Descripcion de la Operacion</strong><br>
                           	<input type="text" name="descrip" autocomplete="off" required><br>
                            <strong>Estado</strong><br>
							<select name="estado">
                            	<option value="s">Activo</option>
                                <option value="n">No Activo</option>
                            </select>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
            	    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cerrar</button>
                	<button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                </div>
                </form>
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
