<?php 
error_reporting(0);

  session_start();
  include_once "../php_conexion.php";
  include_once "class/class.php";
  include_once "../class_buscar.php";
  include_once "../funciones.php";
  if($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='p'){
    $usu=limpiar($_SESSION['cod_user']);
  
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.: Grados :.</title>
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
                                    <img src="img/grado.png" width="80" height="80">
                                    Control de Grados
                                </h2>
                            </div>
                            <div class="span6">
                            	<!-- <form name="form1" method="post" action="">
                                	<div class="input-append">
                                	<input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Grados">
                                    <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                                    </div>
                          	    </form> -->
                                <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                                	<strong><i class="icon-plus"></i> Ingresar Nuevo Grado</strong>
                                </a>
                                
                                <div id="nuevo"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                                <form name="form1" method="post" action="">
                                    <div class="modal-header">
	                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	                                <h3 id="myModalLabel">Ingresar Nuevo Grado</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <strong>Descripcion del Grado</strong><br>
                                                <input type="text" name="nombre" autocomplete="off" required value="">    
                                            </div>
                                            <div class="span6">
                                                <strong>Estado del Grado</strong><br>
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
				if(!empty($_POST['confirmar'])){
                    if ($_POST['confirmar'] == "1") {
                        $nombre=limpiar($_POST['nombre']);
                        $ID_GRADO=limpiar($_POST['id']);   
                        $GRADO_ACTIVO=limpiar($_POST['estado']);  
                        $oMateria=new Proceso_Grado($conexion,$ID_GRADO,$nombre,$GRADO_ACTIVO,'');
                        $oMateria->eliminar($conexion);
                   echo mensajes('El Grado "'.$_POST['nombre'].'" se elimino con Exito','verde'); 
                }}else{
                if(!empty($_POST['nombre']) AND !empty($_POST['clase'])){
					$NOMBRE_GRADO=limpiar($_POST['nombre']);	
                    $GRADO_ACTIVO=limpiar($_POST['estado']);
                    $ID_CLASE=limpiar($_POST['clase']);
					if(empty($_POST['id'])){
						$oGrado = new Proceso_Grado($conexion,'',$NOMBRE_GRADO,$GRADO_ACTIVO,'');
						$oGrado->guardar($conexion);
						
					}else{
						$id=limpiar($_POST['id']);	
						$oGrado = new Proceso_Grado($conexion,$id,$NOMBRE_GRADO,$GRADO_ACTIVO,$ID_CLASE);
						$oGrado->actualizar($conexion);						
					}
				}elseif(!empty($_POST['nombre'])){
                    $NOMBRE_GRADO=limpiar($_POST['nombre']);    
                    $GRADO_ACTIVO=limpiar($_POST['estado']);
                    if(empty($_POST['id'])){
                        $oGrado = new Proceso_Grado($conexion,'',$NOMBRE_GRADO,$GRADO_ACTIVO,'');
                        $oGrado->guardar($conexion);
                        
                    }else{
                        $id=limpiar($_POST['id']);  
                        $oGrado = new Proceso_Grado($conexion,$id,$NOMBRE_GRADO,$GRADO_ACTIVO,'');
                        $oGrado->actualizar($conexion);                     
                    }
                }
            }

			?>
            <table  id ="tabla_grado" class="table table-bordered table-hover">
                <thead>
                <tr class="info">
                    <th>Codigo del Grado</th>
                    <th>Nombre del Grado</th>
                    <th>Estado</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
                    <th>Clases</th>
                </tr>
                <?php
					if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
						$pa=mysqli_query($conexion,"SELECT * FROM GRADO WHERE NOMBRE_GRADO LIKE '%$buscar%' or ID_GRADO='$buscar'");					
					}else{
						$pa=mysqli_query($conexion,"SELECT * FROM GRADO");				
					}
					
					while($row=mysqli_fetch_array($pa)){
				?>
               <!--  <tr>
                	<td><center><?php echo $row['ID_GRADO']; ?></center></td>
                    <td><?php echo $row['NOMBRE_GRADO']; ?></td>
                    <td>
                        <center>
                            <a href="#c<?php echo $row['ID_GRADO']; ?>" title="Clases" role="button" class="btn btn-mini" data-toggle="modal">
                                <i class="icon-list-alt"></i>
                            </a>
                        </center>
                    </td>                    
                    <td><center><?php echo estado($row['GRADO_ACTIVO']); ?></center></td>
                    <td>
                    	<center>
                        	<a href="#a<?php echo $row['ID_GRADO']; ?>" title="Editar Grado" role="button" class="btn btn-mini" data-toggle="modal">
                            	<i class="icon-edit"></i>
                            </a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="#b<?php echo $row['ID_GRADO']; ?>" title="Eliminar Grado" role="button" class="btn btn-mini" data-toggle="modal">
                                <i class="icon-remove"></i>
                            </a>
                        </center>
                    </td>
                </tr> -->
                
               <div id="a<?php echo $row['ID_GRADO']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	            	<form name="form2" method="post" action="">
                    	<input type="hidden" name="id" value="<?php echo $row['ID_GRADO']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Actualizar Grado</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>Descripcion del Grado</strong><br>
                                    <input type="text" name="nombre" autocomplete="off" required value="<?php echo $row['NOMBRE_GRADO']; ?>">    
                                </div>
                                <div class="span6">
                                    <strong>Estado del Grado</strong><br>
                                    <select name="estado">
                                        <option value=1 >Activo</option>
                                        <option value=0 >No Activo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>ID del Grado</strong><br>
                                    <input type="text" name="id" autocomplete="off" required value="<?php echo $row['ID_GRADO']; ?>">    
                                </div>
                                <div class="span6">
                                    <strong>Agregar Clase al Grado</strong><br>
                                    <select name="clase">
                                        <?php
                                            $sl=mysqli_query($conexion,"SELECT id_clase,nombre_clase 
                                                                        FROM Clase 
                                                                        WHERE ID_CLASE NOT IN (SELECT ID_CLASE FROM clasesxgrado)
                                                                        AND ESTADO_CLASE = 1");              
                                            while($cl=mysqli_fetch_array($sl)){
                                                echo '<option value="'.$cl['id_clase'].'">'.$cl['nombre_clase'].'</option>';
                                               }
                                        ?>
                                    </select><br>    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                            <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                        </div>
                    </form>
                </div>

                <div id="b<?php echo $row['ID_GRADO']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="form3" method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $row['ID_GRADO']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Eliminar Grado</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>El Grado "<?php echo $row['NOMBRE_GRADO']; ?>" se eliminara </strong><br>
                                    <input type="hidden" name="nombre" autocomplete="off" required value="<?php echo $row['NOMBRE_GRADO']; ?>"> 
                                    <input type="hidden" name="id" autocomplete="off" required value="<?php echo $row['ID_GRADO']; ?>"> 
                                    <input type="hidden" name="estado" autocomplete="off" required value="<?php echo $row['GRADO_ACTIVO']; ?>">
                                    <input type="hidden" name="confirmar" autocomplete="off" required value="1"> 
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                            <button type="submit" class="btn btn-danger"><i class="icon-ok"></i> <strong>Confirmar</strong></button>
                        </div>
                        </form>
                    </div>

                    <div id="c<?php echo $row['ID_GRADO']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form name="form3" method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $row['ID_GRADO']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Lista de Clases</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <select name="profesor">
                                        <?php
                                            $sl=mysqli_query($conexion,"SELECT distinct a.id_clase,a.nombre_clase FROM clase a inner join clasesxgrado b on a.id_clase=b.id_clase 
                                                WHERE ID_GRADO=".$row['ID_GRADO']);              
                                            while($cl=mysqli_fetch_array($sl)){
                                                echo '<option value="'.$cl['id_clase'].'">'.$cl['nombre_clase'].'</option>';
                                               }
                                        ?>
                                    </select><br> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                        </div>
                        </form>
                    </div>


                
				<?php } ?>
                </thead>
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


<link rel="stylesheet" type="text/css" href="../../css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="../../Buttons-1.5.1/css/buttons.dataTables.min.css"/>


<script type="text/javascript" src="../../js/datatables.min.js"></script>
<script type="text/javascript" src="../../Buttons-1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../../JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="../../pdfmake-0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="../../pdfmake-0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="../../Buttons-1.5.1/js/buttons.html5.min.js"></script>




    <script>
      var editor; // use a global for the submit and return data rendering in the examples
 



      $(document).ready(function() {
        var dataTable = $('#tabla_grado').DataTable( {

//botones
        //     dom: 'Bfrtip',
        // buttons: [
        //     'copyHtml5',
        //     'excelHtml5',
        //     'csvHtml5',
        //     'pdfHtml5'
        // ],

//hasta aqui---------------

          "processing": true,
          "serverSide": true,
          "ajax":{
            url :"datatable/datosDataTable-Grado.php", // json datasource
            type: "post",  // method  , by default get
            error: function(){  // error handling
              $(".employee-grid-error").html("");
              $("#materia-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#employee-grid_processing").css("display","none");
              
            },




             columns: [
            {data: 'ID_GRADO', name: 'ID_GRADO'},
            {data: 'NOMBRE_GRADO', name: 'NOMBRE_GRADO'},
            {data: 'GRADO_ACTIVO', name: 'GRADO_ACTIVO'},
            {data: 'ID_GRADO', name: 'ID_GRADO'},
            {data: 'ID_GRADO', name: 'ID_GRADO'},
            {data: 'ID_GRADO', name: 'ID_GRADO'},

           
        ],
          },
          

       "columnDefs": [

       {
            "targets": 2,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                   
                    if(data[2]=='1'){
                        return 'Activo';
                    }
                    else{
                    return 'Inactivo';
                }
                },
        },
         {
            "targets": 3,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return ' <a href="#b'+data[0]+'" title="Eliminar Grado" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-remove"></i></a>';
                },
        },
           {
            "targets": 4,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#a'+data[0]+'" title="Editar Grado" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-edit"></i></a>';

                    
                },
        },
         {
            "targets": 5,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#c'+data[0]+'" title="Clases" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-list-alt"></i></a>';

                    
                },
        },

        
         ],
        "language": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  },

        } );
      } );

     
    </script>

  </body>
</html>
<?php 

}else{
    header("HTTP/1.1 403 Forbidden");
  }
?>