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
    <title>.: Clases :.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <link href="../../css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
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
                              <!-- <form name="form1" method="post" action="">
                                  <div class="input-append">
                                  <input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Clase">
                                    <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                                    </div>
                                </form> -->
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
            <table id="materia-grid" class="table table-bordered table-hover">
              <thead>
              <tr class="info">
                  <th>Codigo Clase</th>
                    <th>Nombre de la Clase</th>
                    <th>Estado de la Clase</th>
                    <th>Grado</th>
                    <th>Profesor</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
                   <!--  <td width="5%"><strong class="text-info">Editar</strong></td>
                    <td width="5%"><strong class="text-info">Eliminar</strong></td>          -->           
                </tr>
                    
        <?php
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
                                                    FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE  INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                          INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                          INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)                        
                                                    UNION ALL
                                                    SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,'',ESTADO_CLASE,'',C.NOMBRE_GRADO
                                                    FROM clasesxgrado A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                    INNER JOIN grado AS C ON C.ID_GRADO = A.ID_GRADO  WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                        FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE  INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
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
                    
                    
                    while($row=mysqli_fetch_array($pa)){
                


                ?>  
            
                
               <div id="a<?php echo $row['ID_CLASE']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="form2" method="post" action="">
                        <input type="hidden" name="id_actualizar" value="<?php echo $row['ID_CLASE']; ?>">
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
                                            $sl=mysqli_query($conexion,"SELECT id_persona,nombres,apellidos FROM persona WHERE privilegio_id_privilegio=1");              
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
                            <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                        </div>
                        </form>
                </div>

                <div id="b<?php echo $row['ID_CLASE']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="form3" method="post" action="">
                        <input type="hidden" name="id_eliminar" value="<?php echo $row['ID_CLASE']; ?>">
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
        var dataTable = $('#materia-grid').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":{
            url :"datatable/datosDataTable-Materia.php", // json datasource
            type: "post",  // method  , by default get
            error: function(){  // error handling
              $(".employee-grid-error").html("");
              $("#materia-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#employee-grid_processing").css("display","none");
              
            },


             columns: [
            {data: 'ID_CLASE', name: 'ID_CLASE'},
            {data: 'Nombre de la Clase', name: 'Nombre de la Clase'},
            {data: 'Estado de la Clase', name: 'Estado de la Clase'},
            {data: 'Grado', name: 'Grado'},
            {data: 'Profesor', name: 'Profesor'},
            {data: 'ID_CLASE', name: 'ID_CLASE'},
            {data: 'ID_CLASE', name: 'ID_CLASE'},
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
                    return 'Inactivo';}                               
        }},
         {
            "targets": 5,
            "data": null,
            "defaultContent": "<button>Click!</button>",


              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#b'+data[0]+'" title="Eliminar Clase" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-remove"></i></a>';
                },
        },
           {
            "targets": 6,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#a'+data[0]+'"  title="Editar Clase" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-edit"></i></a>';

                    
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