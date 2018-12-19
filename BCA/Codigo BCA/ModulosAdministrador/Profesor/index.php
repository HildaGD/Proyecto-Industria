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
    <title>.: Usuarios :.</title>
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

    <?php include_once "../../menuAdministrador/m_profesor.php"; ?>
    <div align="center">
        <table width="90%">
          <tr>
            <td>
                <table class="table table-bordered">
                  <tr class="info">
                    <td>
                        <div class="row-fluid">
                            <div class="span6">
                                <h2 class="text-info">
                                    <img src="img/profesor.png" width="80" height="80">
                                    Control de Usuarios
                                </h2>
                            </div> 
                            <div class="span6">
                                <!-- <form name="form1" method="post" action="">
                                    <div class="input-append">
                                    <input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Usuarios">
                                    <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                                    </div>
                                </form> -->
                                <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                                    <strong><i class="icon-plus"></i> Ingresar Nuevo Usuarios</strong>
                                </a>
                               <!-- INICIO MODAL AGREGAR PROFESOR -->
                                <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <form name="form2" method="post" action="">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3 id="myModalLabel">Registrar Nuevo Usuario</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <strong>ID</strong><br>
                                                
                                                <strong>Nombre</strong><br>
                                                <input type="text" name="nomb" autocomplete="off" required value=""><br>
                                                <strong>Apellidos</strong><br>
                                                <input type="text" name="apel" autocomplete="off" required value=""><br><input type="text" name="idP" autocomplete="off" readonly value="<?php $p=mysqli_query($conexion, "SELECT (MAX(ID_PERSONA)+1) AS ID FROM persona"); while($r=mysqli_fetch_array($p)){ echo $r['ID']; } ?>"><br>
                                                <strong>Correo</strong><br>
                                                <input type="email" name="correo" autocomplete="off" required value="" placeholder="example@example.com"><br>
                                                <strong>Nombre de Usuario</strong><br>
                                                <input type="text" name="usr" autocomplete="off" pattern="[A-Za-z0-9]{6,40}" title="Letras y números. Tamaño mínimo: 6"  value=""><br>
                                                <strong>Contraseña</strong><br>
                                                <input type="password" name="contrasenia" autocomplete="off" pattern="[A-Za-z0-9]{8,40}" title="Letras y números. Tamaño mínimo: 8" value=""><br>
                                                <strong>Tipo de Usuario</strong><br>
                                                <select name="tipo">
                                                    <option value="2">Maestro</option>
                                                    <option value="1">Administrador</option>
                                                    <option value="3">Encargado</option>
                                                </select>
                                            </div>
                                            <div class="span6">
                                                <strong>Dirección</strong><br>
                                                <input type="text" name="dir" autocomplete="off"  value=""><br>
                                                <strong>Teléfonos</strong><br>
                                                <input type="text" name="tel" autocomplete="off" pattern="[0-9]{8}" placeholder="12345678" value=""><br>
                                                <strong>Número de identidad</strong><br>
                                                <input type="text" name="ident" autocomplete="off" pattern="[0-9]{13}" placeholder="0801190012345"  required value=""><br>
                                                <strong>Fecha de Nacimiento</strong><br>
                                                <input type="date" name="fecha" autocomplete="off"  value=""><br>
                                                <strong>Lugar de Nacimiento</strong><br>
                                                <input type="text" name="nac" autocomplete="off" value=""><br>
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
                                        <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                                    </div>
                                    </form>
                               </div>
                                
                                <!-- FIN  MODAL AGREGAR PROFESOR -->
                            </div>
                        </div>

                    </td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>
        
        <table width="90%">
          <tr>
            <td>
                <?php
                    if(!empty($_POST['idP'])){
                        $nom=limpiar($_POST['nom']);        
                        $ape=limpiar($_POST['ape']);
                        $nomb=limpiar($_POST['nomb']);        
                        $apel=limpiar($_POST['apel']);
                        $idP=limpiar($_POST['idP']);        
                        $fecha=limpiar($_POST['fecha']);
                        $dir=limpiar($_POST['dir']);        
                        $tel=limpiar($_POST['tel']);
                        $ident=limpiar($_POST['ident']);        
                        $correo=limpiar($_POST['correo']);
                        $nac=limpiar($_POST['nac']);    
                        $usuario=limpiar($_POST['usr']);
                        $user=limpiar($_POST['user']);
                        $tipo=limpiar($_POST['tipo']);      
                        $contrasenia=limpiar($_POST['contrasenia']);
                        $estado=limpiar($_POST['estado']);
                        if(!empty($_POST['nom']) && !empty($_POST['ape']))
                        { 


                            $idP=limpiar($_POST['idP']);
                            $oProfesor=new Proceso_Profesor($conexion,$idP,$nom, $ape, $fecha, $dir, $tel, $ident, $correo, $nac, $user, $tipo, $contrasenia,$estado);
                            $oProfesor->actualizar();
                            echo mensajes('El Usuario "'.$nom.' '.$ape.'" Ha sido Actualizado con Exito','verde');
                            
                        }else{
                            $oProfesor=new Proceso_Profesor($conexion,'', $nomb, $apel, $fecha, $dir, $tel, $ident, $correo, $nac, $usuario, $tipo, $contrasenia, $estado);
                            $oProfesor->guardar($conexion);
                            
                            
                        }
                    }
                ?>
               <!-- INICIO TABLA CON INFORMACION DE LOS MAESTROS (MOSTRAR) -->
                    <table id="tabla_profesor" class="table table-bordered table table-hover">
                    <thead>
                      <tr class="info">
                        <th>ID</th>
                        <th>Nombre y Apellido</th>
                        <th>Correo</th>
                        <th>Telefónos</th>
                        <th>Estado</th>
                        <th>Tipo de Usuario</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Asignar clases</th>   
                      </tr>
                  <?php
                  
                        if(!empty($_POST['buscar']))
                        {
                                $buscar=limpiar($_POST['buscar']);
                                $pa=mysqli_query($conexion,"SELECT * FROM persona LEFT join encargado on id_persona=id_encargado LEFT join maestro on ID_PERSONA=id_maestro WHERE NOMBRES LIKE '$buscar' or APELLIDOS LIKE '$buscar' or ID_PERSONA='$buscar'");
                        }
                        else
                        {
                            $pa=mysqli_query($conexion,"SELECT * FROM persona LEFT join encargado on id_persona=id_encargado LEFT join maestro on ID_PERSONA=id_maestro");                
                        }

                         if(!empty($_POST['confirmar']))
                            {
                                if ($_POST['confirmar'] == "1") 
                                {
                                    $nombre=limpiar($_POST['nombre']);
                                    $id=limpiar($_POST['id']);    
                                    $oProfesor=new Proceso_Profesor($conexion,$id,'', '', '', '', '', '', '', '', '', '', '','');
                                    $oProfesor->eliminar($conexion);                   
                                }
                            } 
                        if(!empty($_POST['confirmar']))
                            {
                                if ($_POST['confirmar'] == "7") {
                                    $nombre=limpiar($_POST['nombreMaestro']);
                                    $id=limpiar($_POST['idMaestro']); 
                                    $idClase=limpiar($_POST['clase']);    
                                    mysqli_query($conexion, "INSERT INTO clasexmaestro
                                                    (ID_CLASE,
                                                    ID_MAESTRO)
                                                    VALUES
                                                    (idClase,
                                                    id)");  
                            echo 'La Clase fue asignada con exito.', 'verde';          
                                                                                    
                            } else{
                                echo 'Error al intentar asignar la clase.', 'rojo';
                            }
                                }
                                    

                        while($row=mysqli_fetch_array($pa))
                        {
                            if($row['PRIVILEGIO_ID_PRIVILEGIO']=='1'){
                                $tipo='Administrador';
                            }elseif($row['PRIVILEGIO_ID_PRIVILEGIO']=='2'){
                                $tipo='Maestro';
                            }
                            else{
                                $tipo='Encargado';
                            }
                
                

                  ?>
               <!--    <tr>
                    <td><?php echo $row['ID_PERSONA']; ?></td>
                    <td><?php echo $row['NOMBRES'].' '.$row['APELLIDOS']; ?></td>
                    <td><?php echo $row['EMAIL']; ?></td>
                    <td><?php echo $row['TELEFONO_CASA']; ?></td>
                    <td><center><?php echo $tipo; ?></center></td>
                    <td><center><?php echo estado($row['ACTIVO_PERSONA']); ?></center></td>
                    <td>
                        <align>
                            <a href="#a<?php echo $row['ID_PERSONA']; ?>" title="Editar Usuario" role="button" class="btn btn-mini" data-toggle="modal">
                                <i class="icon-edit"></i>
                            </a>
                        </align>
                    <td>
                        <align>
                            <a href="#b<?php echo $row['ID_PERSONA']; ?>" title="Eliminar Usuario" role="button" class="btn btn-mini" data-toggle="modal">
                                <i class="icon-remove" ></i>
                            </a>
                        </align>
                    <td>
                        <align>
                            
                            <a href="#c<?php if($row['PRIVILEGIO_ID_PRIVILEGIO']=='2'){ echo $row['ID_PERSONA'];} ?>" title="Asignar Clase" role="button" class="btn btn-mini" data-toggle="modal">
                                <i class="icon-edit" ></i>
                            </a>
                        </align>
                    </td> -->
                    <!--  INICIO MODAL ACTUALIZAR PROFESOR -->
                        <div id="a<?php echo $row['ID_PERSONA']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="form2" method="post" action="">
                            <input type="hidden" name="id" value="<?php echo $row['ID_PERSONA']; ?>">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Actualizar Usuario</h3>
                            </div>

                            <div class="modal-body">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <strong>ID</strong><br>
                                        <input type="text" name="idP" autocomplete="off" readonly value="<?php echo $row['ID_PERSONA']; ?>"><br>
                                        <strong>Nombre</strong><br>
                                        <input type="text" name="nom" autocomplete="off" required value="<?php echo $row['NOMBRES']; ?>"><br>
                                        <strong>Apellidos</strong><br>
                                        <input type="text" name="ape" autocomplete="off" required value="<?php echo $row['APELLIDOS']; ?>"><br>
                                        <strong>Lugar de nacimiento</strong><br>
                                        <input type="text" name="nac" autocomplete="off" required value="<?php echo $row['LUGAR_NACIMIENTO'];?>"><br>
                                        <strong>Correo</strong><br>
                                        <input type="text" name="correo" autocomplete="off" required value="<?php echo $row['EMAIL']; ?>"><br>
                                        <strong>Usuario</strong><br>
                                        <input type="text" name="usr" autocomplete="off" required value="<?php echo $row['USUARIO']; ?>"><br>
                                        <strong>Contraseña</strong><br>
                                        <input type="password" name="contrasenia" autocomplete="off" required value="<?php echo $row['CONTRASENIA']; ?>"><br>
                                    </div>
                                    <div class="span6">
                                        <strong>Tipo de Usuario</strong><br>
                                        <select name="tipo">
                                            <option value="2" <?php if($row['PRIVILEGIO_ID_PRIVILEGIO']=='2'){ echo 'selected'; } ?>>Maestro</option>
                                            <option value="1" <?php if($row['PRIVILEGIO_ID_PRIVILEGIO']=='1'){ echo 'selected'; } ?>>Administrador</option>
                                            <option value="3" <?php if($row['PRIVILEGIO_ID_PRIVILEGIO']=='3'){ echo 'selected'; } ?>>Encargado</option>
                                        </select>
                                        <strong>Dirección</strong><br>
                                        <input type="text" name="dir" autocomplete="off" required value="<?php echo $row['COLONIA']; ?>"><br>
                                        <strong>Teléfonos</strong><br>
                                        <input type="text" name="tel" autocomplete="off" value="<?php echo $row['TELEFONO_CASA']; ?>"><br>
                                        <strong>Identidad</strong><br>
                                        <input type="text" name="ident" autocomplete="off" required value="<?php echo $row['NO_IDENTIDAD']; ?>"><br>
                                        <strong>Fecha de Nacimiento</strong><br>
                                        <input type="date" name="fecha" autocomplete="off" required value="<?php echo $row['FECHA_NACIMIENTO']; ?>"><br>
                                        <strong>Estado</strong><br>
                                        <select name="estado">
                                            <option value="1" <?php if($row['ACTIVO_PERSONA']=='1'){ echo 'selected'; } ?>>Activo</option>
                                            <option value="0" <?php if($row['ACTIVO_PERSONA']=='0'){ echo 'selected'; } ?>>No Activo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
                            </div>
                            </form>
                       </div>

                       <!-- FIN  MODAL ACTUALIZAR PROFESOR -->

                       <!-- INICIO CAMBIO DE ESTADO A INACTIVO- ELIMINAR -->

                            <div id="b<?php echo $row['ID_PERSONA']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="form3" method="post" action="">
                                <input type="hidden" name="id" value="<?php echo $row['ID_PERSONA']; ?>">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="myModalLabel">Eliminar Usuario</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <strong>El usuario "<?php echo $row['NOMBRES'].' '.$row['APELLIDOS']; ?>" se eliminará </strong><br>
                                            <input type="hidden" name="nombre" autocomplete="off" required value="<?php echo $row['NOMBRES'].' '.$row['APELLIDOS']; ?>"> 
                                            <input type="hidden" name="id" autocomplete="off" required value="<?php echo $row['ID_PERSONA']; ?>"> 
                                            
                                            <input type="hidden" name="confirmar" autocomplete="off" required value="1"> 
                                            <input type="hidden" name="estado" autocomplete="off" required value="<?php echo $row['ACTIVO_PERSONA']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                                    <button type="submit" class="btn btn-danger"><i class="icon-ok"></i> <strong>Confirmar</strong></button>
                                </div>
                                </form>
                    </div>

                    <!-- FIN CAMBIO DE ESTADO A INACTIVO- ELIMINAR -->
                    
                    <!-- INICIO ASIGNAR CLASE A PROFESOR -->

                     <div id="c<?php echo $row['ID_PERSONA']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="form3" method="post" action="">
                                <input type="hidden" name="confirmar" autocomplete="off" required value="7"> 
                                <input type="hidden" name="idMaestro" value="<?php echo $row['ID_PERSONA']; ?>">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="myModalLabel">Asignar clase a maestro</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <strong>Nombre del maestro</strong><br>
                                    <input type="text" name="nombreMaestro" autocomplete="off" required value="<?php echo $row['NOMBRES']. ' '.$row['APELLIDOS'] ; ?>">   
                                <strong>Agregar Clase al maestro</strong><br>
                                    <select name="clase">
                                        <?php
                                            $sl=mysqli_query($conexion,"SELECT id_clase,nombre_clase 
                                                                        FROM Clase 
                                                                        WHERE ID_CLASE NOT IN (SELECT ID_CLASE FROM clasexmaestro)
                                                                        AND ESTADO_CLASE = 1");              
                                            while($cl=mysqli_fetch_array($sl)){
                                                echo '<option value="'.$cl['id_clase'].'">'.$cl['nombre_clase'].'</option>';
                                               }
                                        ?>
                                    </select><br>      
                                </div>
                                <div class="span6">
                                    <strong>Estado del maestro</strong><br>
                                    <select name="estado">
                                        <option value=1 >Activo</option>
                                        <option value=0 >No Activo</option>
                                    </select>
                                       
                                </div>
                            </div>
                            
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                                    <button type="submit" class="btn btn-danger"><i class="icon-ok"></i> <strong>Confirmar</strong></button>
                                </div>
                                </form>
                    </div>    
                    <!-- FIN ASIGNAR CLASES A PROFESORS -->
                    </td>
                  </tr>
                  <?php } ?>
                  </thead>
                </table>

                <!-- FIN TABLA MOSTRAR MAESTROS -->
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
        var dataTable = $('#tabla_profesor').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":{
            url :"datatable/profesorDataTable-Profesor.php", // json datasource
            type: "post",  // method  , by default get
            error: function(){  // error handling
              $(".employee-grid-error").html("");
              $("#materia-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#employee-grid_processing").css("display","none");
              
            },



                      
                            
                       


             columns: [
            {data: 'ID_PERSONA', name: 'ID_PERSONA'},
            {data: 'NOMBRES', name: 'NOMBRES'},
            {data: 'EMAIL', name: 'EMAIL'},
            {data: 'TELEFONO_CASA', name: 'TELEFONO_CASA'},

             {data: 'ACTIVO_PERSONA', name: 'ACTIVO_PERSONA'},
            {data: 'PRIVILEGIO_ID_PRIVILEGIO', name: 'PRIVILEGIO_ID_PRIVILEGIO'},
           

            {data: 'ID_PERSONA', name: 'ID_PERSONA'},
            {data: 'ID_PERSONA', name: 'ID_PERSONA'},
            {data: 'ID_PERSONA', name: 'ID_PERSONA'},
      ],
          },
          

       "columnDefs": [
         {
            "targets": 4,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                   
                    if(data[4]=='1'){
                        return 'Activo';
                    }
                    else{
                    return 'Inactivo';
                }
                },
        },
          {
            "targets": 5,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                   
                    if(data[5]=='1'){
                        return 'Administrador';
                    }
                   if(data[5]=='2'){
                    return 'Profesor';
                }
                },
        },

         {
            "targets": 6,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return ' <a href="#a'+data[0]+'" title="Editar Usuario" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-edit"></i></a>';
                },
        },
           {
            "targets": 7,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#b'+data[0]+'" title="Eliminar Usuario" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-remove" ></i></a>';

                    
                },
        },
        {
            "targets": 8,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#c'+data[0]+'" title="Asignar Clase" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-edit" ></i></a>';
                    
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