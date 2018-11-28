<?php 
 error_reporting(0);
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
    $pa=mysqli_query($conexion,"SELECT NOMBRE_CLASE from clase where id_clase = '$id_clase' ");  
    $row=mysqli_fetch_assoc($pa);
    $clase=$row['NOMBRE_CLASE'];
	
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>.: Calificaciones de la clase <?php echo $clase; ?> :.</title>
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
                
                <table id="tabla_valorar1" class="table table-bordered table table-hover">
                 <thead>
                    <tr class="info">
                        <th>ID ALUMNO</th>
                        <th>NOMBRE ALUMNO</th>
                        <th>PRIMER PARCIAL</th>
                        <th>SEGUNDO PARCIAL</th>
                        <th>TERCER PARCIAL</th>
                        <th>CUARTO PARCIAL</th>
                        <th>NOTA FINAL</th>
                        
                    </tr>
                  <?php
                    $pa=mysqli_query($conexion,"SELECT DISTINCT ID_CLASE,NOMBRE_CLASE,ID_ALUMNO,NOMBRE,ID_GRADO,ID_PARCIAL,
                                                       SUM(CASE WHEN ID_PARCIAL = 1 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END) AS PRIMER_PARCIAL,
                                                       SUM(CASE WHEN ID_PARCIAL = 2 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END) AS SEGUNDO_PARCIAL,
                                                       SUM(CASE WHEN ID_PARCIAL = 3 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END) AS TERCER_PARCIAL,
                                                       SUM(CASE WHEN ID_PARCIAL = 4 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END) AS CUARTO_PARCIAL,
                                                       SUM(PUNTAJE) AS PARCIALES
                                                FROM (SELECT CA.ID_CLASE,CL.NOMBRE_CLASE,CA.ID_ALUMNO,A.NOMBRE,CG.ID_GRADO,C.ID_PARCIAL,HOMEWORK,CLASSWORK,CLASSWORK_EVALUATION,TEST,C.PUNTAJE
                                                        FROM clasexalumno as ca inner join clasesxgrado as cg on cg.ID_CLASE = ca.ID_CLASE
                                                        INNER join calificaciones as c on c.ID_ALUMNO = ca.ID_ALUMNO and c.ID_CLASE=ca.ID_CLASE
                                                        INNER JOIN alumno AS A ON A.ID_ALUMNO = CA.ID_ALUMNO
                                                        INNER JOIN clase AS CL ON CL.ID_CLASE=CA.ID_CLASE
                                                        INNER JOIN PERIODO AS P ON P.id_periodo = C.ANIO
                                                        WHERE P.estado = 1
                                                        AND CA.ID_CLASE = $id_clase) AS T1 ");	

					          while($row=mysqli_fetch_assoc($pa)){
						          $cod_alumno=strtoupper($row['ID_ALUMNO']);
                      $id_clase=$row['ID_CLASE'];
                      $clase=$row['NOMBRE_CLASE'];
                      $nombre=$row['NOMBRE'];
						      ?>
                  <!--<tr>
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
                  </tr>-->
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
  var dataTable = $('#tabla_valorar1').DataTable( {

//botones
  dom: 'Bfrtip',
  buttons: ['excelHtml5','pdfHtml5'],

//hasta aqui---------------'csvHtml5',copyHtml5',
 
// "bPaginate": false,
  "processing": true,
  "serverSide": true,
  "bFilter": false,
        
  "ajax":{
    url :"datatable/datosDataTable-Valorar1.php", // json datasource
    type: "post",
    data: {        
      "id_clase":"<?php echo $_GET['clase']; ?>"},  // method  , by default get

  error: function(){  // error handling
    $(".employee-grid-error").html("");
    $("#materia-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
    $("#employee-grid_processing").css("display","none");},

   columns: [
            {data: 'ID_ALUMNO', name: 'ID_ALUMNO'},
            {data: 'NOMBRE_ALUMNO', name: 'NOMBRE_ALUMNO'},
            {data: 'PRIMER_PARCIAL', name: 'PRIMER_PARCIAL'},
            {data: 'SEGUNDO_PARCIAL', name: 'SEGUNDO_PARCIAL'},
            {data: 'TERCER_PARCIAL', name: 'TERCER_PARCIAL'},
            {data: 'CUARTO_PARCIAL', name: 'CUARTO_PARCIAL'},  
            {data: 'NOTA_FINAL', name: 'NOTA_FINAL'},          
            ],
          },          

  "columnDefs": [       
    {
    "targets": 1,
    "data": null,
    "defaultContent": "<button>Click!</button>",
  // this case `data: 0`.
    "render": function ( data, type, row ) {
        return '<a href="valorar.php?cod=<?php echo $cod_alumno;?>&id_clase=<?php echo $id_clase;?>&clase=<?php echo $clase;?>">'+data[1]+'</a>';
       

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
    // print($_GET['cod']);
    header("HTTP/1.1 403 Forbidden");
  }
?>