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
                                        <!--<div class="row-fluid">
                                            <div class="span6">
                                                <strong>Profesor</strong><br>
                                                <select name="profesor">
                                                    <?php
                                                        $sl=mysqli_query($conexion,"SELECT id_persona,nombres,apellidos FROM persona WHERE privilegio_id_privilegio=1");              
                                                        while($cl=mysqli_fetch_array($sl)){
                                                            echo '<option value="'.$cl['id_persona'].'">'.$cl['nombres'].' '.$cl['apellidos'].'</option>';
                                                           }
                                                    ?>
                                                </select><br> 
                                            </div>                                           
                                        </div>-->
                                    </div>
                                    <div class="modal-footer">
                	                    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
            	                        <button type="submit" class="btn btn-success"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                                    </div>
                                    </form>
                                </div>
                                
                            </div>
                    	</div>
                    </td>
              	</tr>
            </table>
            <?php
                try{
                if(!empty($_POST['nombre']) and empty($_POST['confirmar'])){
					$nombre=limpiar($_POST['nombre']);                   
					if(empty($_POST['id'])){
						$oMateria=new Proceso_Clase($conexion,'',$nombre,'',1);
						$oMateria->guardar($conexion);
					}else{
						$ID_CLASE=limpiar($_POST['id']);
                        $profesor=limpiar($_POST['profesor']);
                        $ESTADO_CLASE=limpiar($_POST['ESTADO_CLASE']);  
						$oMateria=new Proceso_Clase($conexion,$ID_CLASE,$nombre,$profesor,$ESTADO_CLASE);
						$oMateria->actualizar($conexion);						
					}
				}
                if(!empty($_POST['confirmar'])){
                    if ($_POST['confirmar'] == "1") {
                        $nombre=limpiar($_POST['nombre']);
                        $profesor=limpiar($_POST['profesor']); 
                        $ID_CLASE=limpiar($_POST['id']);    
                        $oMateria=new Proceso_Clase($conexion,$ID_CLASE,$nombre,$profesor,'');
                        $oMateria->eliminar($conexion);                   
                }}
            }catch(Exception $e){
                echo mensajes('Error lanzado '.$e,'rojo');
            }
            

			?>
            <table class="table table-bordered table-hover">
            	<tr class="info">
                	<td width="15%"><center><strong class="text-info">Codigo Clase</strong></center></td>
                    <td width="30%"><strong class="text-info">Nombre de la Clase</strong></td>
                    <td width="15%"><center><strong class="text-info">Estado de la Clase</strong></center></td>
                    <td width="15%"><center><strong class="text-info">Grado</strong></center></td>
                    <td width="15%"><center><strong class="text-info">Profesor</strong></center></td>
                    <td width="5%"><strong class="text-info">Editar</strong></td>
                    <td width="5%"><strong class="text-info">Eliminar</strong></td>                    
                </tr>
                <?php
					if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
						$pa=mysqli_query($conexion,"SELECT * FROM
                                                    (SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,CONCAT(C.NOMBRES,' ', C.APELLIDOS) As NOMBRE_MAESTRO,ESTADO_CLASE,ID_PERSONA,e.NOMBRE_GRADO
                                                    FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                    INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                    INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                    UNION ALL
                                                    SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,CONCAT(C.NOMBRES,' ', C.APELLIDOS) As NOMBRE_MAESTRO,ESTADO_CLASE,ID_PERSONA,' '
                                                    FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                    WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                             FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                             INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                             INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                             INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)                        
                                                    UNION ALL
                                                    SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,'',ESTADO_CLASE,'',C.NOMBRE_GRADO
                                                    FROM clasesxgrado A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN grado AS C ON C.ID_GRADO = A.ID_GRADO  WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                                         FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                         INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                         INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                                         INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                                                         UNION ALL
                                                                                         SELECT DISTINCT B.ID_CLASE
                                                                                         FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                         INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                         WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                                                                  FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                                                  INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                                                  INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                                                                  INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO) )
                                                     UNION ALL
                                                    SELECT DISTINCT A.ID_CLASE,A.NOMBRE_CLASE,' ',ESTADO_CLASE,' ',''
                                                    FROM clase A WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                    FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                    INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                    INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                    UNION ALL
                                                    SELECT DISTINCT B.ID_CLASE
                                                    FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                    WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                             FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                             INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                             INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                             INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)                        
                                                    UNION ALL
                                                    SELECT DISTINCT B.ID_CLASE
                                                    FROM clasesxgrado A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN grado AS C ON C.ID_GRADO = A.ID_GRADO 
                                                    WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                                         FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                         INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                         INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                                         INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                                                         UNION ALL
                                                                                         SELECT DISTINCT B.ID_CLASE
                                                                                         FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                         INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                         WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                                                                  FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                                                  INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                                                  INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                                                                  INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)))) S
                                                    WHERE NOMBRE_CLASE LIKE '%$buscar%'");					
					}else{
						$pa=mysqli_query($conexion,"SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,CONCAT(C.NOMBRES,' ', C.APELLIDOS) As NOMBRE_MAESTRO,ESTADO_CLASE,ID_PERSONA,e.NOMBRE_GRADO
                                                    FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                    INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                    INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                    UNION ALL
                                                    SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,CONCAT(C.NOMBRES,' ', C.APELLIDOS) As NOMBRE_MAESTRO,ESTADO_CLASE,ID_PERSONA,' '
                                                    FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                    WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                             FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                             INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                             INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                             INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)                        
                                                    UNION ALL
                                                    SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,'',ESTADO_CLASE,'',C.NOMBRE_GRADO
                                                    FROM clasesxgrado A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN grado AS C ON C.ID_GRADO = A.ID_GRADO  WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                                         FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                         INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                         INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                                         INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                                                         UNION ALL
                                                                                         SELECT DISTINCT B.ID_CLASE
                                                                                         FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                         INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                         WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                                                                  FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                                                  INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                                                  INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                                                                  INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO) )
                                                     UNION ALL
                                                    SELECT DISTINCT A.ID_CLASE,A.NOMBRE_CLASE,' ',ESTADO_CLASE,' ',''
                                                    FROM clase A WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                    FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                    INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                    INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                    UNION ALL
                                                    SELECT DISTINCT B.ID_CLASE
                                                    FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                    WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                             FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                             INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                             INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                             INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)                        
                                                    UNION ALL
                                                    SELECT DISTINCT B.ID_CLASE
                                                    FROM clasesxgrado A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN grado AS C ON C.ID_GRADO = A.ID_GRADO 
                                                    WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                                         FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                         INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                         INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                                         INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                                                         UNION ALL
                                                                                         SELECT DISTINCT B.ID_CLASE
                                                                                         FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                         INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                         WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                                                                                  FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                                                                                  INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                                                                                  INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                                                                                  INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)))
                                                    order by ID_CLASE");				
					}
					
					while($row=mysqli_fetch_array($pa)){
				?>
                <tr>
                	<td><center><?php echo $row['ID_CLASE']; ?></center></td>
                    <td><?php echo $row['NOMBRE_CLASE']; ?></td>
                    <td><center><?php echo estado($row['ESTADO_CLASE']); ?></center></td>
                    <td><center><?php echo $row['NOMBRE_GRADO']; ?></center></td>
                    <td><center><?php echo $row['NOMBRE_MAESTRO']; ?></center></td>
                    <td>
                    	<center>
                        	<a href="#a<?php echo $row['ID_CLASE']; ?>" title="Editar Clase" role="button" class="btn btn-mini" data-toggle="modal">
                            	<i class="icon-edit"></i>
                            </a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="#b<?php echo $row['ID_CLASE']; ?>" title="Eliminar Clase" role="button" class="btn btn-mini" data-toggle="modal">
                                <i class="icon-remove" ></i>
                            </a>
                        </center>
                    </td>

                </tr>
                
               <div id="a<?php echo $row['ID_CLASE']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="form2" method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $row['ID_CLASE']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Actualizar Clase</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>Nombre de la Clase</strong><br>
                                    <input type="text" name="nombre" autocomplete="off" required value="<?php echo $row['NOMBRE_CLASE']; ?>">   
                                    <input type="hidden" name="confirmar" autocomplete="off" required value="0"> 
                                </div>
                                <div class="span6">
                                    <strong>ID de la Clase</strong><br>
                                    <input type="text" name="id" autocomplete="off"  readonly="readonly" required value="<?php echo $row['ID_CLASE']; ?>">                                     
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>Profesor</strong><br>
                                    <select name="profesor">
                                        <?php
                                        try{
                                            $sl=mysqli_query($conexion,"SELECT id_persona,nombres,apellidos FROM persona WHERE privilegio_id_privilegio=2");              
                                            while($cl=mysqli_fetch_array($sl)){
                                                echo '<option value="'.$cl['id_persona'].'">'.$cl['nombres'].' '.$cl['apellidos'].'</option>';
                                               }
                                            }catch(Exception $e)
                                               {echo mensajes('ERROR LANZADO '.$e,'rojo');}    

                                        ?>
                                    </select><br> 
                                </div>  
                                <div class="span6">
                                    <strong>Estado</strong><br>
                                    <select name="ESTADO_CLASE">
                                        <option value="1">Activo</option>
                                        <option value="0">No Activo</option>
                                    </select>
                                </div>                                               
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                            <button type="submit" class="btn btn-success"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                        </div>
                        </form>
                </div>

                <div id="b<?php echo $row['ID_CLASE']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="form3" method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $row['ID_CLASE']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Eliminar Clase</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>La clase "<?php echo $row['NOMBRE_CLASE']; ?>" se eliminara </strong><br>
                                    <input type="hidden" name="nombre" autocomplete="off" required value="<?php echo $row['NOMBRE_CLASE']; ?>"> 
                                    <input type="hidden" name="id" autocomplete="off" required value="<?php echo $row['ID_CLASE']; ?>"> 
                                    <input type="hidden" name="profesor" autocomplete="off" required value="<?php echo $row['id_persona']; ?>"> 
                                    <input type="hidden" name="confirmar" autocomplete="off" required value="1"> 
                                    <input type="hidden" name="ESTADO_CLASE" autocomplete="off" required value="<?php echo $row['ESTADO_CLASE']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                            <button type="submit" class="btn btn-danger"><i class="icon-ok"></i> <strong>Confirmar</strong></button>
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
