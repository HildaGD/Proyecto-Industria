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
    <title>.: Alumnos :.</title>
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

    <?php include_once "../../menuAdministrador/m_alumnos.php"; ?>
    
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
                                    <img src="img/alumno.png" width="80" height="80">
                                    Control de Alumnos
                                </h2>
                            </div>
                            <div class="span6">
                                <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                                    <strong><i class="icon-plus"></i> Ingresar Nuevo Alumno</strong>
                                </a>
                                
                                <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <form name="form2" method="post" action="">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3 id="myModalLabel">Registrar Nuevo Alumno</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <input type="hidden" name="confirmar" autocomplete="off" required value="1"> 
                                                <strong>Alumno</strong><br><br>
                                                <strong>ID del alumno</strong><br>
                                                <input type="text" name="idA" autocomplete="off" readonly value="<?php $p=mysqli_query($conexion, "SELECT (MAX(ID_ALUMNO)+1) AS ID FROM alumno"); while($r=mysqli_fetch_array($p)){ echo $r['ID']; } ?>"><br>
                                                <strong>Nombre Completo</strong><br>
                                                <input type="text" name="nombre" value="" autocomplete="off"><br>
                                                <strong>Número de Identidad</strong><br>
                                                <input type="text" name="identAlum" value="" autocomplete="off" pattern="[0-9]{13}" placeholder="0801190012345" ><br>
                                                <strong>Fecha de Nacimiento</strong><br>
                                                <input type="date" name="fecha" value="" autocomplete="off" ><br>
                                                <strong>Escuela de Procedencia</strong><br>
                                                <input type="text" name="esc" value="" autocomplete="off" ><br>
                                                <strong>Utiliza Transporte</strong><br>
                                                <select name="trans">
                                                    <option value="1">Sí</option>
                                                    <option value="0">No</option>
                                                </select><br>
                                                <strong>Dirección de Residencia</strong><br>
                                                <input type="text" name="direccion" value="" autocomplete="off" ><br>
                                                <strong>Religión</strong><br>
                                                <input type="text" name="religion" value="" autocomplete="off" ><br>
                                                <strong>Estado</strong><br>
                                                <select name="estado">
                                                    <option value="1">Activo</option>
                                                    <option value="0">No Activo</option>
                                                </select>
                                            </div>
                                            <div class="span6">
                                                <strong>Encargado</strong><br><br>
                                                <strong>Nombre del encargado</strong><br>
                                                <input type="text" name="nombreEncargado" value="" autocomplete="off" ><br>
                                                <strong>Lugar de trabajo</strong><br>
                                                <input type="text" name="trabajo" value="" autocomplete="off" ><br>                                                
                                                <strong>Cargo</strong><br>
                                                <input type="text" name="cargo" value="" autocomplete="off" ><br>
                                                <strong>Profesión del Encargado</strong><br>
                                                <input type="text" name="profesion" value="" autocomplete="off" ><br>
                                                <strong>Números Telefónicos de Oficina</stronsg><br>
                                                <input type="text" name="telOfic" value="" autocomplete="off" pattern="[0-9]{8}" placeholder="33333333" ><br>
                                                <strong>Parentesco con el alumno</strong><br>
                                                <input type="text" name="parentesco" value="" autocomplete="off" ><br>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true"><strong><i class="icon-remove"></i> Cerrar</strong></button>
                                        <button type="submit" class="btn btn-success"><strong><i class="icon-ok"></i> Guardar Registro</strong></button>
                                    </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </td>
                  </tr>
                </table>
                <?php 
                    if(!empty($_POST['confirmar']))
                    {
                        if($_POST['confirmar'] == 1){
                            $id=limpiar($_POST['idA']);  
                            $nombre=limpiar($_POST['nombre']);
                            $identAlum=limpiar($_POST['identAlum']); 
                            $fecha=limpiar($_POST['fecha']);         
                            $esc=limpiar($_POST['esc']);
                            $trans=limpiar($_POST['trans']);                                 
                            $direccion=limpiar($_POST['direccion']);
                            $trabajo=limpiar($_POST['trabajo']);
                            $estado=limpiar($_POST['estado']);
                            $nombreEncargado=limpiar($_POST['nombreEncargado']);  
                            $religion=limpiar($_POST['religion']);
                            $cargo=limpiar($_POST['cargo']);
                            $profesion=limpiar($_POST['profesion']);                        
                            $telOfic=limpiar($_POST['telOfic']);
                            $parentesco=limpiar($_POST['parentesco']);                             
                           
                        $oGuardar=new Proceso_Alumno($conexion, $id, $nombre, $identAlum,$fecha, $esc, $trans, $direccion, $estado, $telOfic,$religion,$cargo,$telOfic, $trabajo, $profesion, $parentesco,$nombreEncargado,'','','','','');  
                        $oGuardar->guardar();
                        }

                        if($_POST['confirmar'] == 2){
                            $id=limpiar($_POST['id']);                                                
                            $grado=limpiar($_POST['grado']);
                            $seccion=limpiar($_POST['seccion']);  
                            $jornada=limpiar($_POST['jornada']);  
                            $periodo=limpiar($_POST['periodo']);
                            $oGuardar=new Proceso_Alumno($conexion, $id, '','', '','', '', '', '','', '', '', '','','','', '',$grado,$seccion,$jornada,'','');  
                            $oGuardar->matricular($grado,$seccion,$jornada,$periodo);
                        }

                        if($_POST['confirmar'] == 3){
                            $id=limpiar($_POST['idA']);  
                            $nombre=limpiar($_POST['nombre']);
                            $identAlum=limpiar($_POST['identAlum']); 
                            $fecha=limpiar($_POST['fecha']);         
                            $esc=limpiar($_POST['esc']);
                            $trans=limpiar($_POST['trans']);                                 
                            $direccion=limpiar($_POST['direccion']);
                            $fechaMatricula=limpiar($_POST['matricula']);
                            $estado=limpiar($_POST['estado']);
                            $nombreEncargado=limpiar($_POST['nombreEncargado']);
                            $fechaEncargado=limpiar($_POST['fechaEncargado']);
                            $telefono=limpiar($_POST['telefono']);   
                            $religion=limpiar($_POST['religion']);
                            $cargo=limpiar($_POST['cargo']);                        
                            $telOfic=limpiar($_POST['telOfic']);
                            $parentesco=limpiar($_POST['parentesco']); 
                            $profesion=limpiar($_POST['profesion']);  
                            $encargado=limpiar($_POST['encargado']); 
                            $sangre=limpiar($_POST['sangre']);
                            $visuales=limpiar($_POST['visuales']); 
                            $enfermedades=limpiar($_POST['enfermedades']);
                            $medico=limpiar($_POST['medico']);
                            $medicamento=limpiar($_POST['medicamento']);
                            $clinica=limpiar($_POST['clinica']);
                            $atenciones=limpiar($_POST['atenciones']);
                            $oGuardar=new Proceso_Alumno($conexion, $id, $nombre, $identAlum,$fecha, $esc, $trans, $direccion, $estado, $telefono,$religion,$cargo,$telOfic,$trabajo,$profesion, $parentesco,$nombreEncargado,'','','', $encargado,'','','','','','','','','','');  
                            $oGuardar->guardar();
                        
                        }
                }
                    
                ?>
             <table id="tabla_alumno" class="table table-bordered table table-hover">
                    <thead>
                  <tr class="info">
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Escuela de Procedencia</th>
                    <th>Utiliza Transporte</th>
                    <th>Grado</th>
                    <th>Sección</th>
                    <th>Jornada</th>
                    <th>Estado</th>
                    <th>Actualizar</th>                    
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Matricula</th>
                  </tr>
                  <?php 
                        if(!empty($_POST['buscar']))
                        {
                            $buscar=limpiar($_POST['buscar']);
                            $pa=mysqli_query($conexion, "SELECT distinct a.ID_ALUMNO,a.NOMBRE,a.DIRECCION,a.RELIGION,a.FECHA_NACIMIENTO,YEAR(CURDATE()-YEAR(a.FECHA_NACIMIENTO)) edad,
                                                        a.ESCUELA_PROCEDENCIA,a.UTILIZA_TRANSPORTE,g.NOMBRE_GRADO,s.NOMBRE_SECCION,j.NOMBRE_JORNADA,a.ACTIVO_ALUMNO FROM alumno AS A 
                                                        inner join informacion_medica AS B on A.ID_INFO_MEDICA=B.ID_INFO_MEDICA
                                                        INNER JOIN clasexalumno as ca on ca.ID_ALUMNO = a.ID_ALUMNO
                                                        INNER JOIN clasesxgrado as cg on cg.ID_CLASE = ca.ID_CLASE
                                                        INNER JOIN seccionesxgrado as sg on sg.ID_GRADO = cg.ID_GRADO
                                                        INNER JOIN grado AS g on sg.ID_GRADO = g.ID_GRADO
                                                        INNER JOIN seccion as s on s.ID_SECCION = sg.ID_SECCION and s.ID_SECCION= ca.ID_SECCION 
                                                        INNER JOIN jornada as j on sg.ID_JORNADA = j.ID_JORNADA AND j.ID_JORNADA = ca.ID_JORNADA
                                                        UNION ALL
                                                        SELECT a.ID_ALUMNO,a.NOMBRE,a.DIRECCION,a.RELIGION,a.FECHA_NACIMIENTO,YEAR(CURDATE()-YEAR(a.FECHA_NACIMIENTO)) edad,
                                                        a.ESCUELA_PROCEDENCIA,a.UTILIZA_TRANSPORTE,'','','',a.ACTIVO_ALUMNO FROM alumno AS A 
                                                        inner join informacion_medica AS B on A.ID_INFO_MEDICA=B.ID_INFO_MEDICA
                                                        WHERE a.ID_ALUMNO NOT IN (SELECT a.ID_ALUMNO
                                                                                    FROM alumno AS A 
                                                                                    inner join informacion_medica AS B on A.ID_INFO_MEDICA=B.ID_INFO_MEDICA
                                                                                    INNER JOIN clasexalumno as ca on ca.ID_ALUMNO = a.ID_ALUMNO
                                                                                    INNER JOIN clasesxgrado as cg on cg.ID_CLASE = ca.ID_CLASE
                                                                                    INNER JOIN seccionesxgrado as sg on sg.ID_GRADO = cg.ID_GRADO
                                                                                    INNER JOIN grado AS g on sg.ID_GRADO = g.ID_GRADO
                                                                                    INNER JOIN seccion as s on s.ID_SECCION = sg.ID_SECCION
                                                                                    INNER JOIN jornada as j on sg.ID_JORNADA = j.ID_JORNADA AND j.ID_JORNADA = ca.ID_JORNADA
                                                                                    WHERE CA.ESTADO=1) 
                                                        NWHERE NOMBRE LIKE '%$buscar%' or ID_ALUMNO='$buscar'");  
                                                                                }else
                        {
                            $pa=mysqli_query($conexion, "SELECT distinct a.ID_ALUMNO,a.NOMBRE,a.DIRECCION,a.RELIGION,a.FECHA_NACIMIENTO,YEAR(CURDATE()-YEAR(a.FECHA_NACIMIENTO)) edad, 
                                                        a.ESCUELA_PROCEDENCIA,a.UTILIZA_TRANSPORTE,g.NOMBRE_GRADO,s.NOMBRE_SECCION,j.NOMBRE_JORNADA,a.ACTIVO_ALUMNO FROM alumno AS A 
                                                        inner join informacion_medica AS B on A.ID_INFO_MEDICA=B.ID_INFO_MEDICA
                                                        INNER JOIN clasexalumno as ca on ca.ID_ALUMNO = a.ID_ALUMNO
                                                        INNER JOIN clasesxgrado as cg on cg.ID_CLASE = ca.ID_CLASE
                                                        INNER JOIN seccionesxgrado as sg on sg.ID_GRADO = cg.ID_GRADO
                                                        INNER JOIN grado AS g on sg.ID_GRADO = g.ID_GRADO
                                                        INNER JOIN seccion as s on s.ID_SECCION = sg.ID_SECCION and s.ID_SECCION= ca.ID_SECCION 
                                                        INNER JOIN jornada as j on sg.ID_JORNADA = j.ID_JORNADA AND j.ID_JORNADA = ca.ID_JORNADA
                                                        UNION ALL
                                                        SELECT a.ID_ALUMNO,a.NOMBRE,a.DIRECCION,a.RELIGION,a.FECHA_NACIMIENTO,YEAR(CURDATE()-YEAR(a.FECHA_NACIMIENTO)) edad,
                                                        a.ESCUELA_PROCEDENCIA,a.UTILIZA_TRANSPORTE,'','','',a.ACTIVO_ALUMNO FROM alumno AS A 
                                                        inner join informacion_medica AS B on A.ID_INFO_MEDICA=B.ID_INFO_MEDICA
                                                        WHERE a.ID_ALUMNO NOT IN (SELECT a.ID_ALUMNO
                                                                                    FROM alumno AS A 
                                                                                    inner join informacion_medica AS B on A.ID_INFO_MEDICA=B.ID_INFO_MEDICA
                                                                                    INNER JOIN clasexalumno as ca on ca.ID_ALUMNO = a.ID_ALUMNO
                                                                                    INNER JOIN clasesxgrado as cg on cg.ID_CLASE = ca.ID_CLASE
                                                                                    INNER JOIN seccionesxgrado as sg on sg.ID_GRADO = cg.ID_GRADO
                                                                                    INNER JOIN grado AS g on sg.ID_GRADO = g.ID_GRADO
                                                                                    INNER JOIN seccion as s on s.ID_SECCION = sg.ID_SECCION
                                                                                    INNER JOIN jornada as j on sg.ID_JORNADA = j.ID_JORNADA AND j.ID_JORNADA = ca.ID_JORNADA
                                                                                    WHERE CA.ESTADO=1)");
                                                                                }
                        if(!empty($_POST['confirmar']))
                            {
                                if ($_POST['confirmar'] == "4") 
                                {
                                    $nombre=limpiar($_POST['nombreAl']);
                                    $id=limpiar($_POST['idAl']);    
                                    $oGuardar=new Proceso_Alumno($conexion,$id,'', '', '', '', '', '', '', '', '', '', '','', '', '', '', '', '', '','','','');
                                     $oGuardar->eliminar($conexion);                   
                                }
                                if ($_POST['confirmar'] == "5") 
                                {
                                    $id=limpiar($_POST['idA']);  
                                    $nombre=limpiar($_POST['nombre']);
                                    $nacimiento=limpiar($_POST['nacimiento']); 
                                    $fecha=limpiar($_POST['fecha']);   
                                    $trans=limpiar($_POST['trans']);                                 
                                    $direccion=limpiar($_POST['direccion']);
                                    $religion=limpiar($_POST['religion']);
                                    $grado=limpiar($_POST['grado']);
                                    $seccion=limpiar($_POST['seccion']);
                                    $estado=limpiar($_POST['estado']);
                                    $oGuardar=new Proceso_Alumno($conexion, $id, $nombre, '', $fecha, '', $trans, $direccion, $estado, '', $religion, '', '', '', '', '', '', $grado, $seccion, '', '', $nacimiento);  
                                    $oGuardar->actualizar();                 
                                }
                            } 
                             if(!empty($_POST['alergias']))
                            {
                                
                                    $nombre=limpiar($_POST['nombres']);
                                    $idinformacion=limpiar($_POST['idinformacion']);
                                    $id=limpiar($_POST['idAlumno']); 
                                    $encargado=limpiar($_POST['encargado']); 
                                    $alergias=limpiar($_POST['alergias']);
                                    $sangre=limpiar($_POST['sangre']);
                                    $visuales=limpiar($_POST['visuales']); 
                                    $enfermedades=limpiar($_POST['enfermedades']);
                                    $medico=limpiar($_POST['medico']);
                                    $medicamento=limpiar($_POST['medicamento']);
                                    $clinica=limpiar($_POST['clinica']);
                                    $atenciones=limpiar($_POST['atenciones']);   
                                    $oGuardar=new Proceso_Alumno($conexion,$id,$nombre, '', '', '', '', '', '', '', '', '', '','', '', '', '', '', '', '','',''/*,$alergias,$sangre,$visuales,$enfermedades,$medicamento,$clinica,$atenciones,$idinformacion*/);
                                     $oGuardar->infomedica($conexion);                   
                                
                            }    
                        while($row=mysqli_fetch_array($pa))
                        {
                            if($row['UTILIZA_TRANSPORTE']=='1')
                            {
                                $trans='Sí';
                            }
                            else
                            {
                                $trans='No';
                            }
                            
                  ?>

                         <div id="m<?php echo $row['ID_ALUMNO']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="eliminar" method="post" action="">
                                <input type="hidden" name="id" value="<?php echo $row['ID_ALUMNO']; ?>">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="myModalLabel">Matricular Alumno</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <input type="hidden" name="confirmar" autocomplete="off" required value="2"> 
                                            <input type="hidden" name="id" value="<?php echo $row['ID_ALUMNO']; ?>">
                                            <strong>Grado</strong><br>
                                            <select name="grado">
                                            <?php
                                                    $sal=mysqli_query($conexion,"SELECT distinct G.ID_GRADO,G.NOMBRE_GRADO FROM grado as g INNER join seccionesxgrado as sg on sg.ID_GRADO = g.ID_GRADO");       
                                                    while($col=mysqli_fetch_array($sal)){
                                                      echo '<option value="'.$col['ID_GRADO'].'">'.$col['NOMBRE_GRADO'].'</option>';
                                                  }?>
                                            </select>  
                                            <strong>Jornada</strong><br>
                                            <select name="jornada">
                                            <?php
                                                    $sal=mysqli_query($conexion,"SELECT distinct J.ID_JORNADA,J.NOMBRE_JORNADA FROM jornada as j INNER join seccionesxgrado as sg on sg.ID_JORNADA = J.ID_JORNADA");       
                                                    while($col=mysqli_fetch_array($sal)){
                                                      echo '<option value="'.$col['ID_JORNADA'].'">'.$col['NOMBRE_JORNADA'].'</option>';
                                                  }?>
                                            </select>                                           
                                        </div>
                                        <div class="span6">
                                            <strong>Sección</strong><br>
                                            <select name="seccion">
                                            <?php
                                                    $sal=mysqli_query($conexion,"SELECT distinct s.ID_SECCION,s.NOMBRE_SECCION FROM seccion as s INNER join seccionesxgrado as sg on sg.ID_SECCION = s.ID_SECCION");       
                                                    while($col=mysqli_fetch_array($sal)){
                                                      echo '<option value="'.$col['ID_SECCION'].'">'.$col['NOMBRE_SECCION'].'</option>';
                                                  }?>
                                            </select>
                                            <strong>Periodo</strong><br>
                                            <select name="periodo">
                                            <?php
                                                    $sal=mysqli_query($conexion,"SELECT ID_PERIODO, anio, periodo FROM periodo WHERE estado = 1");       
                                                    while($col=mysqli_fetch_array($sal)){
                                                      echo '<option value="'.$col['ID_PERIODO'].'">'.$col['periodo'].' - '.$col['anio'].'</option>';
                                                  }?>
                                            </select>  
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remover"></i> <strong>Cerrar</strong></button>
                                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> <strong>Confirmar</strong></button>
                                </div>
                            </form>
                        </div>
                    
                        <div id="x<?php echo $row['ID_ALUMNO']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="form53" method="post" action="">
                            <input type="hidden" value="<?php echo $row['ID_ALUMNO']; ?>" name="idAlumno">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Información Del Alumno</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <strong>ID información médica</strong><br>
                                                <input type="text" name="idinformacion" autocomplete="off" readonly value="<?php $p=mysqli_query($conexion, "SELECT B.ID_INFO_MEDICA as ID FROM informacion_medica AS B inner join alumno AS A on A.ID_INFO_MEDICA=B.ID_INFO_MEDICA WHERE ID_ALUMNO = $idAlumno;"); while($r=mysqli_fetch_array($p)){ echo $r['ID']; } ?>"><br>
                                        <strong>Nombre del alumno</strong><br>
                                        <input type="text" name="nombres" value="<?php echo $row['NOMBRE']; ?>" autocomplete="off" required><br>
                                        <strong>Alergias</strong><br>
                                        <input type="text" name="alergias" value="<?php echo $row['ALERGIAS']; ?>" autocomplete="off" ><br>
                                        <strong>Tipo de sangre</strong><br>
                                    <select name="sangre">
                                        <option value="O+" <?php if($row['TIPO_SANGRE']=='O+'){ echo 'selected'; }  ?>>O+</option>
                                        <option value="A+" <?php if($row['TIPO_SANGRE']=='A+'){ echo 'selected'; } ?>>A+</option>
                                        <option value="B+" <?php if($row['TIPO_SANGRE']=='B+'){ echo 'selected'; }  ?>>B+</option>
                                        <option value="AB+" <?php if($row['TIPO_SANGRE']=='AB+'){ echo 'selected'; } ?>>AB+</option>
                                        <option value="O-" <?php if($row['TIPO_SANGRE']=='O-'){ echo 'selected'; }  ?>>O-</option>
                                        <option value="A-" <?php if($row['TIPO_SANGRE']=='A-'){ echo 'selected'; } ?>>A-</option>
                                        <option value="B-" <?php if($row['TIPO_SANGRE']=='B-'){ echo 'selected'; }  ?>>B-</option>
                                        <option value="AB-" <?php if($row['TIPO_SANGRE']=='AB-'){ echo 'selected'; } ?>>AB-</option>
                                    </select><br>
                                    <strong>Requiere atención especial</strong><br>
                                    <select name="atenciones">
                                        <option value="SI" <?php if($row['ATENCIONES_ESPECIALES']=='SI'){ echo 'selected'; }  ?>>Sí</option>
                                        <option value="NO" <?php if($row['ATENCIONES_ESPECIALES']=='NO'){ echo 'selected'; } ?>>No</option>
                                    </select><br>
                                    <strong>Enfermedades</strong><br>
                                        <input type="text" name="enfermedades" value="<?php echo $row['ENFERMEDADES']; ?>" autocomplete="off" required><br>
                                    </div>
                                    <div class="span6">
                                        <strong>Problemas visuales</strong><br>
                                    <select name="visuales">
                                        <option value="SI" <?php if($row['PROBLEMAS_VISUALES']=='SI'){ echo 'selected'; }  ?>>Sí</option>
                                        <option value="NO" <?php if($row['PROBLEMAS_VISUALES']=='NO'){ echo 'selected'; } ?>>No</option>
                                    </select><br>
                                    <strong>Médico familiar</strong><br>
                                        <input type="text" name="medico" value="<?php echo $row['MEDICO_FAMILIAR']; ?>" autocomplete="off" ><br>
                                    <strong>Medicamentos</strong><br>
                                    <input type="text" name="medicamentos" value="<?php echo $row['MEDICAMENTOS']; ?>" autocomplete="off" ><br>
                                    <strong>Clínica</strong><br>
                                        <input type="text" name="clinica" value="<?php echo $row['CLINICA']; ?>" autocomplete="off" ><br>

                                     <strong>Encargado</strong><br>
                                        <select name="encargado" onchange="pais(this.value);">
                                            <option value="x"></option>
                                            <?php
                                                $p=mysqli_query($conexion,"SELECT * FROM persona WHERE PRIVILEGIO_ID_PRIVILEGIO='3'");              
                                                while($r=mysqli_fetch_array($p)){
                                                        echo '<option value="'.$r['ID_PERSONA'].'" selected>'.$r['NOMBRES'].' '.$r['APELLIDOS'].'</option>';
                                                }
                                            ?>
                                        </select>   
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar Información</strong></button>
                            </div>
                            </form>
                        </div>


                        <div id="a<?php echo $row['ID_ALUMNO']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form name="form5" method="post" action="">
                        <input type="hidden" name="idA" value="<?php echo $row['ID_ALUMNO']; ?>">
                        <input type="hidden" name="confirmar" autocomplete="off" required value="5"> 
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel" align="center">Actualizar Alumno <br> [ <?php echo $row['NOMBRE']; ?> ]</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                    <strong>ID</strong><br>
                                    <input type="text" name="idA" value="<?php echo $row['ID_ALUMNO']; ?>" autocomplete="off" readonly><br>
                                    <strong>Nombre Completo</strong><br>
                                    <input type="text" name="nombre" value="<?php echo $row['NOMBRE']; ?>" autocomplete="off" required><br>
                                    <strong>Lugar de Nacimiento</strong><br>
                                    <input type="text" name="nacimiento" value="<?php echo $row['LUGAR_NACIMIENTO']; ?>" autocomplete="off" required><br>
                                    <strong>Fecha de Nacimiento</strong><br>
                                    <input type="date" name="fecha" value="<?php echo $row['FECHA_NACIMIENTO']; ?>" autocomplete="off" required><br>
                                    <strong>Utiliza transporte</strong><br>
                                    <select name="trans">
                                        <option value="1" <?php if($row['UTILIZA_TRANSPORTE']=='1'){ echo 'selected'; } ?>>Sí</option>
                                        <option value="0" <?php if($row['UTILIZA_TRANSPORTE']=='0'){ echo 'selected'; } ?>>No</option>
                                    </select><br>
                                </div>
                                <div class="span6">
                                    <strong>Dirección de Residencia</strong><br>
                                    <input type="text" name="direccion" value="<?php echo $row['DIRECCION']; ?>" autocomplete="off" required><br>
                                    <strong>Religión</strong><br>
                                    <input type="text" name="religion" value="<?php echo $row['RELIGION']; ?>" autocomplete="off" required><br>
                                    <strong>Grado</strong><br>
                                        <select name="grado" onchange="pais(this.value);">
                                            <option value="x">---SELECCIONE---</option>
                                            <?php
                                                $p=mysqli_query($conexion,"SELECT * FROM grado WHERE GRADO_ACTIVO='1'");              
                                                while($r=mysqli_fetch_array($p)){
                                                    if(empty($row['NOMBRE_GRADO'])) {
                                                        echo '<option value="'.$r['ID_GRADO'].'">'.$r['NOMBRE_GRADO'].'</option>';
                                                    } else {
                                                        echo '<option value="'.$r['ID_GRADO'].'" '.($row['NOMBRE_GRADO'] == $r['NOMBRE_GRADO'] ? 'selected' : '').'>'.$r['NOMBRE_GRADO'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    <strong>Sección</strong><br>
                                        <select name="seccion" onchange="pais(this.value);">
                                            <option value="x">---SELECCIONE---</option>
                                            <?php
                                                $p=mysqli_query($conexion,"SELECT * FROM seccion WHERE SECCION_ACTIVO='1'");              
                                                while($r=mysqli_fetch_array($p)){
                                                    if(empty($row['NOMBRE_GRADO'])) {
                                                        echo '<option value="'.$r['ID_SECCION'].'">'.$r['NOMBRE_SECCION'].'</option>';
                                                    } else {
                                                        echo '<option value="'.$r['ID_SECCION'].'" '.($row['NOMBRE_SECCION'] == $r['NOMBRE_SECCION'] ? 'selected' : '').'>'.$r['NOMBRE_SECCION'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    <strong>Estado</strong><br>
                                    <select name="estado">
                                        <option value="1" <?php if($row['ACTIVO_ALUMNO']=='1'){ echo 'selected'; } ?>>Activo</option>
                                        <option value="0" <?php if($row['ACTIVO_ALUMNO']=='0'){ echo 'selected'; } ?>>No Activo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><strong><i class="icon-remove"></i> Cerrar</strong></button>
                            <button type="submit" class="btn btn-primary"><strong><i class="icon-ok"></i> Guardar Registro</strong></button>
                        </div>
                        </form>
                    </div>

                    
                     <div id="q<?php echo $row['ID_ALUMNO']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form name="form3" method="post" action="">
                        <input type="hidden" name="idAlum" value="<?php echo $row['ID_ALUMNO']; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel" align="center">Eliminar Alumno <br> [ <?php echo $row['NOMBRE']; ?> ]</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid">
                                <div class="span6">
                                   <strong>El alumno "<?php echo $row['NOMBRE']; ?>" se eliminará </strong><br>
                                            <input type="hidden" name="nombreAlum" autocomplete="off" required value="<?php echo $row['NOMBRE']; ?>"> 
                                            <input type="hidden" name="idAl" autocomplete="off" required value="<?php echo $row['ID_ALUMNO']; ?>">                                             
                                            <input type="hidden" name="confirmar" autocomplete="off" required value="4"> 
                                            <input type="hidden" name="estadoAl" autocomplete="off" required value="<?php echo $row['ACTIVO_ALUMNO']; ?>">
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

      $(document).ready(function() {
        var dataTable = $('#tabla_alumno').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":{
            url :"datatable/alumnosDataTable-Alumnos.php", // json datasource
            type: "post",  // method  , by default get
            error: function(){  // error handling
              $(".employee-grid-error").html("");
              $("#materia-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#employee-grid_processing").css("display","none");
              
            },     
  

             columns: [
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Edad', name: 'Edad'},

            {data: 'ESCUELA_PROCEDENCIA', name: 'ESCUELA_PROCEDENCIA'},
            {data: 'UTILIZA_TRANSPORTE', name: 'UTILIZA_TRANSPORTE'},

            {data: 'Grado', name: 'Grado'},
            {data: 'Seccion', name: 'Seccion'},
            {data: 'Jornada', name: 'Jornada'},
            {data: 'ACTIVO_ALUMNO', name: 'ACTIVO_ALUMNO'},

            {data: 'ID_ALUMNO', name: 'ID_ALUMNO'},
            {data: 'ID_ALUMNO', name: 'ID_ALUMNO'},
            {data: 'ID_ALUMNO', name: 'ID_ALUMNO'},
            {data: 'ID_ALUMNO', name: 'ID_ALUMNO'},
           
        ],
          },
          





       "columnDefs": [
         {
            "targets": 8,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#a'+data[8]+'" title="Editar Información del Alumno" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-edit"></i></a>';

                },
        },
        {
             "targets": 7,
            "data": null,
            "defaultContent": "<button>Click!</button>",


              // this case `data: 0`.
                "render": function ( data, type, row ) {
                   
                    if(data[7]=='1'){
                        return 'Activo';
                    }
                    else{
                    return 'Inactivo';}   
                },
        },
        {
             "targets": 3,
            "data": null,
            "defaultContent": "<button>Click!</button>",


              // this case `data: 0`.
                "render": function ( data, type, row ) {
                   
                    if(data[3]=='1'){
                        return 'Si';
                    }
                    else{
                    return 'No';}   
                },
        },
           {
            "targets": 9,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#x'+data[8]+'" title="Ingresar Más Información" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-th-list"></i></a>';

                    
                },
        },
        {
            "targets": 10,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return ' <a href="#q'+data[8]+'" title="Eliminar Alumno" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-remove"></i></a>';

                    
                },
        },

  {
            "targets": 11,
            "data": null,
            "defaultContent": "<button>Click!</button>",

              // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="#m'+data[8]+'" title="Matricular Alumno" role="button" class="btn btn-mini" data-toggle="modal"><i class="icon-edit"></i></a>';

                    
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