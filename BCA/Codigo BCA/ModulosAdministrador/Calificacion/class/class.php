<?php

class Proceso_Alumno{
    var $id;    		
    var $nombre;   
    var $identAlum;  
    var $fecha; 
    var $esc;       	
    var $trans;	
    var $direccion;
    var $fechaMatricula;
    var $estado;
    var $fechaEncargado;
    var $telefono;
    var $religion;
    var $cargo;
    var $telOfic;
    var $parentesco;
    var $nombreEncargado;
    var $conexion;
    var $grado;
    var $seccion;
    var $jornada;
    var $profesion;
    var $encargado;
    var $trabajo;


    function __construct($conexion, $id, $nombre, $identAlum,$fecha, $esc, $trans, $direccion, $estado, $telefono,$religion,$cargo,$telOfic, $trabajo, $profesion, $parentesco,$nombreEncargado,$grado,$seccion,$jornada,$encargado){
    	$this->conexion=$conexion;
        $this->id=$id;            
        $this->nombre=$nombre;   
        $this->identAlum=$identAlum;  
        $this->fecha=$fecha; 
        $this->esc=$esc;           
        $this->trans=$trans; 
        $this->direccion=$direccion;
        $this->estado=$estado;
        $this->telefono=$telefono;
        $this->religion=$religion;
        $this->cargo=$cargo;
        $this->telOfic=$telOfic;
        $this->parentesco=$parentesco;
        $this->nombreEncargado =$nombreEncargado;
        $this->grado=$grado;
        $this->seccion=$seccion;
        $this->jornada=$jornada;
        $this->profesion=$profesion;
        $this->encargado=$encargado;

    }
    
    function guardar(){    	
        $id=$this->id;            
        $nombre=$this->nombre;   
        $identAlum=$this->identAlum;  
        $fecha=$this->fecha; 
        $esc=$this->esc;           
        $trans=$this->trans; 
        $direccion=$this->direccion;
        $fechaMatricula=$this->fechaMatricula;
        $estado=$this->estado;
        $fechaEncargado=$this->fechaEncargado;
        $telefono=$this->telefono;
        $religion=$this->religion;
        $cargo=$this->cargo;
        $trabajo=$this->trabajo;
        $telOfic=$this->telOfic;
        $parentesco=$this->parentesco;	
        $conexion=$this->conexion;
        $profesion=$this->profesion;
        $encargado=$this->encargado;
        try{
        	$pa=mysqli_query($conexion,"SELECT * FROM alumno WHERE NO_IDENTIDAD='$identAlum'");
        	
        	if (mysqli_num_rows($pa) != "0") {
               echo mensajes('Ya se tiene un alumno con el id '.$identAlum.' registrado','rojo');
            }else{
//Alumno

            mysqli_query($conexion, "INSERT INTO alumno 
                                                (ID_ALUMNO, ID_INFO_MEDICA, 
                                                NOMBRE, 
                                                ESCUELA_PROCEDENCIA, 
                                                UTILIZA_TRANSPORTE, 
                                                NOTAS, 
                                                CROQUIS, 
                                                ACTIVO_ALUMNO, 
                                                DIRECCION, 
                                                LUGAR_NACIMIENTO,  
                                                FECHA_NACIMIENTO, 
                                                RELIGION, 
                                                NO_IDENTIDAD) 
                                    VALUES ('$id',1,'$nombre','$esc','$trans',0,'N/A','$estado','$direccion',' ','$fecha','$religion','$identAlum')");
            echo mensajes('El alumno "'.$nombre.'" se guardó con Exito','verde');
            
//Encargado
            mysqli_query($conexion, "INSERT INTO encargado
                                                (ID_ENCARGADO,
                                                CARGO,
                                                LUGAR_TRABAJO,
                                                PROFESION,
                                                TELE_OFICINA,
                                                PARENTESCO)
                                                VALUES
                                                ($encargado
                                                $cargo,
                                                $trabajo,
                                                $profesion,
                                                $telOfic,
                                                $parentesco)");
//Encargado Por Alumno
            mysqli_query($conexion, "INSERT INTO encargadoxalumno
                                    (ID_ENCARGADO,
                                    ID_ALUMNO)
                                    VALUES
                                    ($encargado,
                                    $id)");
            }
        }catch(Exception $e)
            {echo mensajes('ERROR LANZADO '.$e,'rojo');}         	
			  
    }
     
	
	function actualizar(){
        $this->id=$id;          
        $this->nombre=$nombre;          
        $this->esc=$esc;        
        $this->trans=$trans;    
        $this->notas=$notas;
        $this->croquis=$croquis;   
        $this->estado=$estado;  
        $this->direccion=$direccion;
        $this->nacimiento=$nacimiento; 
        $this->fecha=$fecha;      
        $this->religion=$religion;
        $this->identidad=$identidad;		
		
        try{
            mysql_query($conexion, "UPDATE alumno SET NOMBRE='$nombre',
                                        ESCUELA_PROCEDENCIA='$esc',
                                        UTILIZA_TRANSPORTE='$trans',
                                        NOTAS='$notas',
                                        CROQUIS='$croquis',
                                        ACTIVO_ALUMNO='$estado',
                                        DIRECCION='$direccion',
                                        LUGAR_NACIMIENTO='$nacimiento',
                                        FECHA_NACIMIENTO='$fecha',
                                        RELIGION='$religion',
                                        NO_IDENTIDAD='$identidad'
                                WHERE ID_ALUMNO='$id'");

            echo mensajes('El usuario "'.$_POST['nombre'].'" se actualizó con Exito','verde');
        }catch(Exception $e)
            {echo mensajes('ERROR LANZADO '.$e,'rojo');} 
		
	}

	 function eliminar(){
        $id=$this->id;       
        $estado=$this->estado;
        $conexion=$this->conexion; 
        try{
            mysqli_query($conexion, "UPDATE alumno SET ACTIVO_ALUMNO=0 WHERE ID_ALUMNO='$id'");
            echo mensajes('El Alumno "'.$_POST['nombreAl'].'" se eliminó con Exito','verde');
        }catch(Exception $e)
            {echo mensajes('ERROR LANZADO '.$e,'rojo');}  
    }

    
    function matricular($grado,$seccion,$jornada,$periodo){
    $conexion=$this->conexion; 
    $ID_ALUMNO=$this->id;    
		try{
        	$pa=mysqli_query($conexion,"SELECT * FROM seccionesxgrado as sg
										where sg.ID_GRADO = '$grado'
										and sg.ID_SECCION = '$seccion'
										and sg.ID_JORNADA = '$jornada'");   

        	if (mysqli_num_rows($pa) != "0") {
                $ma=mysqli_query($conexion,"SELECT * FROM clasexalumno as ca INNER  JOIN clasesxgrado AS cg on cg.ID_CLASE = ca.ID_CLASE
                                                where cg.ID_GRADO = '$grado'
                                                and ca.ID_SECCION = '$seccion'
                                                and ca.ID_JORNADA = '$jornada'
                                                and ca.ID_PERIODO = '$periodo'
                                                and ca.ID_ALUMNO = '$ID_ALUMNO'
                                                and ca.ESTADO=1");
                if(mysqli_num_rows($ma) == "0"){
            	    $pe=mysqli_query($conexion, "SELECT id_clase from clasesxgrado where id_grado = '$grado'");        		
        		    while($row=mysqli_fetch_array($pe)){  		             
    		            $ID_CLASE = $row['id_clase'];
                        mysqli_query($conexion,"UPDATE clasexalumno SET ESTADO=0 
                                                WHERE ID_CLASE='$ID_CLASE',
                                                      ID_ALUMNO='$ID_ALUMNO', 
                                                      ID_SECCION='$seccion',
                                                      ID_JORNADA='$jornada', 
                                                      ID_PERIODO='$periodo')"); 

    		            mysqli_query($conexion,"INSERT INTO clasexalumno (ID_CLASE, ID_ALUMNO, ID_SECCION,ID_JORNADA, ID_PERIODO,ESTADO) 
                                                VALUES ('$ID_CLASE','$ID_ALUMNO','$seccion','$jornada','$periodo',1)");	         
    		           
                        $par=mysqli_query($conexion, "SELECT ID_PARCIAL from parcial");
    		            while($parcial=mysqli_fetch_array($par)){                
                            $ID_PARCIAL = $parcial['ID_PARCIAL'];	            	
        		            mysqli_query($conexion,"INSERT INTO calificaciones 
                                                                (ID_PARCIAL,
                                                                 ID_SECCION,
                                                                 ID_ALUMNO, 
                                                                 ID_CLASE, 
                                                                 HOMEWORK, 
                                                                 CLASSWORK, 
                                                                 CLASSWORK_EVALUATION, 
                                                                 TEST, 
                                                                 PUNTAJE, 
                                                                 NOTA,  
                                                                 ANIO) 
        					                        VALUES ('$ID_PARCIAL','$seccion','$ID_ALUMNO','$ID_CLASE',0,0,0,0,0,0,'$periodo')");
        					                                    }	          
                        }echo mensajes('El alumno fue matriculado con exito','verde');}
               else{
                    echo mensajes('El alumno ya se encuentra matriculado en la seccíon','rojo');
                    }
            }else{
            echo mensajes('La seccion y jornada no esta disponible','rojo');
            }

        }catch(Exception $e)
            {echo mensajes('ERROR LANZADO '.$e,'rojo');}   
    }
		}
?>