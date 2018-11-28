<?php 
 error_reporting(0);
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../funciones.php";
	include_once "../class_buscar.php";
	
	if(!empty($_GET['cod']) && ($_SESSION['tipo_user']=='a' or $_SESSION['tipo_user']=='p')){
		$id_alumno=$_GET['cod'];
    $id_clase=$_GET['id_clase'];
    $clase=$_GET['clase'];
		$oAlumno=new Consultar_Alumno($conexion,$id_alumno);	
		$nombre_alumno=$oAlumno->consultar('NOMBRE');

	

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.:calificaciones <?php echo $nombre_alumno; ?> :.</title>
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
                <table id="tabla_valorar" class="table table-bordered table table-hover">
                 <thead>
                    <tr class="info">
                        <th>PARCIAL</th>
                        <th>HOMEWORK</th>
                        <th>CLASSWORK</th>
                        <th>CLASSWORK EVALUATION</th>
                        <th>TEST</th>
                        <th>Editar</th>
                        
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
                 <!--  <tr>
                    <td><center><?php echo $row['NOMBRE_PARCIAL']; ?></center></td>
                    <td><center><?php echo $row['HOMEWORK'].'%'; ?></center></td>
                    <td><center><?php echo $row['CLASSWORK'].'%'; ?></center></td>
                    <td><center><?php echo $row['CLASSWORK_EVALUATION'].'%'; ?></center></td>
                    <td><center><?php echo $row['TEST'].'%'; ?></center></td>
                    <td>
                      <center>
                        <a href="#myModal<?php echo $row['ID_PARCIAL']; ?>" role="button" class="btn" data-toggle="modal"><strong>Editar</strong></a>
                      </center>
                    </td>  -->
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
                  <!-- </tr> -->                     
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
      $(document).ready(function() {
        var dataTable = $('#tabla_valorar').DataTable( {

//botones
            dom: 'Bfrtip',
        buttons: [ ],

//hasta aqui---------------
 
         //"bPaginate": false,
          "processing": true,
          "serverSide": true,
          "bFilter": false,
        
          "ajax":{
            url :"datatable/datosDataTable-Valorar.php", // json datasource
            type: "post",
            data: {  
              "id_alumno":"<?php echo $_GET['cod']; ?>",
              "id_clase":"<?php echo $_GET['id_clase']; ?>"


            },  // method  , by default get
            error: function(){  // error handling
              $(".employee-grid-error").html("");
              $("#materia-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#employee-grid_processing").css("display","none");
              
            },

             columns: [
            {data: 'NOMBRE_PARCIAL', name: 'NOMBRE_PARCIAL'},
            {data: 'HOMEWORK', name: 'HOMEWORK'},
            {data: 'CLASSWORK', name: 'CLASSWORK'},
            {data: 'CLASSWORK_EVALUATION', name: 'CLASSWORK_EVALUATION'},
            {data: 'TEST', name: 'TEST'},
            {data: 'ID_PARCIAL', name: 'ID_PARCIAL'},           
        ],
          },          

       "columnDefs": [       
         {
            "targets": 5,
            "data": null,
            "defaultContent": "<button>Click!</button>",
              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#myModal'+data[5]+'" role="button" class="btn" data-toggle="modal"><strong>Editar</strong></a>';
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

        } 


  );
      } );

     
    </script>


  </body>
</html>
<?php

}else{
    // print($_GET['cod']);
    header("HTTP/1.1 403 Forbidden");
  }
?>