<?php
class Proceso_Clase{
    var $ID_CLASE;      	
    var $NOMBRE_CLASE;
    var $ID_PROFESOR;
    var $ESTADO_CLASE;
   
    var $conexion;
    function __construct($conexion,$ID_CLASE, $NOMBRE_CLASE,$ID_MAESTRO,$ESTADO_CLASE){
        $this->ID_CLASE=$ID_CLASE;      	
        $this->NOMBRE_CLASE=$NOMBRE_CLASE;       
        $this->conexion=$conexion; 
        $this->ID_MAESTRO=$ID_MAESTRO;
        $this->ESTADO_CLASE=$ESTADO_CLASE;
    }
    
    function guardar($conexion){
	    $ID_CLASE=$this->ID_CLASE;		
	    $NOMBRE_CLASE=strtoupper($this->NOMBRE_CLASE);	
	    $ID_MAESTRO=$this->ID_MAESTRO;
		$this->conexion=$conexion; 	
        try{
        	$pa=mysqli_query($conexion,"SELECT * FROM CLASE WHERE upper(NOMBRE_CLASE) LIKE '$NOMBRE_CLASE'");
        	$row=mysqli_fetch_array($pa);
        	if($row['NOMBRE_CLASE'] == $NOMBRE_CLASE){
               echo mensajes('La clase '.$NOMBRE_CLASE.' ya se encuentra registrada','rojo');
            }else{
                mysqli_query($conexion,"INSERT INTO CLASE (NOMBRE_CLASE,ESTADO_CLASE) VALUES ('$NOMBRE_CLASE','1')");
                echo mensajes('La clase "'.$NOMBRE_CLASE.'" Registrada con Exito','verde');
            }
        }catch(Exception $e)
        {echo mensajes('ERROR LANZADO '.$e,'rojo');}   

    }

	function actualizar($conexion){
		$ID_CLASE=$this->ID_CLASE;		
	    $NOMBRE_CLASE=$this->NOMBRE_CLASE;	
	    $ID_MAESTRO=$this->ID_MAESTRO;
		$this->conexion=$conexion; 
        $ESTADO_CLASE=$this->ESTADO_CLASE;	
		try{
            mysqli_query($conexion,"UPDATE CLASE SET NOMBRE_CLASE='$NOMBRE_CLASE',ESTADO_CLASE='$ESTADO_CLASE' WHERE ID_CLASE='$ID_CLASE'");

            $pa=mysqli_query($conexion,"SELECT * FROM CLASEXMAESTRO WHERE ID_CLASE = $ID_CLASE");            
            if(empty(mysqli_fetch_array($pa))){
		       mysqli_query($conexion,"INSERT INTO CLASEXMAESTRO (ID_CLASE, ID_MAESTRO) VALUES ('$ID_CLASE','$ID_MAESTRO')");
		    echo mensajes('La clase "'.$NOMBRE_CLASE.'" Actualizada con Exito','verde');
            }else{
                mysqli_query($conexion,"UPDATE CLASEXMAESTRO SET ID_MAESTRO='$ID_MAESTRO' WHERE ID_CLASE='$ID_CLASE'");
            echo mensajes('La clase "'.$NOMBRE_CLASE.'" Actualizada con Exito','verde');
            }
		}catch(Exception $e)
        {echo mensajes('ERROR LANZADO '.$e,'rojo');}  
								  
	}

    function eliminar($conexion){
	    $ID_CLASE=$this->ID_CLASE;	   
		$this->conexion=$conexion; 	
		try{
        	mysqli_query($conexion,"UPDATE CLASE SET ESTADO_CLASE=0 WHERE ID_CLASE ='$ID_CLASE'");
        	echo mensajes('La clase "'.$_POST['nombre'].'" se elimino con Exito','verde');
		}catch(Exception $e)
        	{echo mensajes('ERROR LANZADO '.$e,'rojo');}  						  
    }

}

class Proceso_Seccion{
    var $ID_SECCION;      	
    var $NOMBRE_SECCION;   	
    var $ID_JORNADA;
    var $ID_GRADO;
    var $SECCION_ACTIVO;
    var $conexion;
    var $ID_PERIODO;
    function __construct($conexion,$ID_SECCION, $ID_JORNADA, $ID_GRADO, $SECCION_ACTIVO,$ID_PERIODO){
        $this->ID_SECCION=$ID_SECCION;          
		$this->ID_JORNADA=$ID_JORNADA;
		$this->ID_GRADO=$ID_GRADO;		
		$this->SECCION_ACTIVO=$SECCION_ACTIVO;
		$this->conexion=$conexion;
        $this->ID_PERIODO=$ID_PERIODO;
    }
    //hastaaqui----------------------------------------------------------------------------------------
    function guardar($conexion){
        PRINT('ENTRA');
	    $ID_SECCION=$this->ID_SECCION;
	    $ID_JORNADA=$this->ID_JORNADA;
		$ID_GRADO=$this->ID_GRADO;	
		$SECCION_ACTIVO=$this->SECCION_ACTIVO;
		$conexion=$this->conexion;	
        $ID_PERIODO=$this->ID_PERIODO;

        try{
            $pa=mysqli_query($conexion,"SELECT * FROM seccionesxgrado AS SG INNER JOIN SECCION AS S ON S.ID_SECCION = SG.ID_SECCION 
                                        WHERE id_periodo LIKE '$ID_PERIODO' AND SG.ID_SECCION = '$ID_SECCION' AND SG.ID_GRADO = '$ID_GRADO' AND SG.ID_JORNADA = '$ID_JORNADA'");            
            if(!empty(mysqli_fetch_array($pa))){
               echo mensajes('La seccion ya se encuentra registrada','rojo');
            }else{
                if($ID_PERIODO){
                mysqli_query($conexion,"INSERT INTO seccionesxgrado (ESTADO, ID_JORNADA, ID_GRADO, ID_SECCION, ID_PERIODO) 
                                        VALUES ('$SECCION_ACTIVO','$ID_JORNADA','$ID_GRADO','$ID_SECCION','$ID_PERIODO')");
                echo mensajes('La seccion fue registrada con Exito','verde');}
                else{ECho mensajes('No se pudo crear la sección ya que no se asigno un periodo','rojo');}            }
        }catch(Exception $e)
            {echo mensajes('ERROR LANZADO '.$e,'rojo');}  	


    }
	
	function actualizar($conexion){
		 $ID_SECCION=$this->ID_SECCION;			
		 $NOMBRE_SECCION=$this->NOMBRE_SECCION;
		 $ID_JORNADA=$this->ID_JORNADA;
		 $ID_GRADO=$this->ID_GRADO;	
		 $SECCION_ACTIVO=$this->SECCION_ACTIVO;
		 $conexion=$this->conexion;		
		 try{
         mysqli_query($conexion,"UPDATE SECCION SET NOMBRE_SECCION='$NOMBRE_SECCION',
										ID_JORNADA='$ID_JORNADA',
										ID_GRADO='$ID_GRADO',
										SECCION_ACTIVO='$SECCION_ACTIVO'
								 WHERE  ID_SECCION='$ID_SECCION'");

         echo mensajes('La Seccion "'.$NOMBRE_SECCION.'" Actualizada con Exito','verde');
         } catch(Exception $e)
            {echo mensajes('ERROR LANZADO '.$e,'rojo');}    
	}

    function eliminar($conexion){
	    $ID_SECCION=$this->ID_SECCION;
		$this->conexion=$conexion; 	
        mysqli_query($conexion,"UPDATE SECCION SET SECCION_ACTIVO = 0 WHERE ID_SECCION ='$ID_SECCION'");
								  
    }

}


class Proceso_Periodo{
    var $ANIO;          
    var $PERIODO;
    var $ESTADO_PERIODO; 
    var $ID_PERIODO;  
    var $conexion;

    function __construct($conexion,$ID_PERIODO,$ANIO, $PERIODO,$ESTADO_PERIODO){
        $this->ANIO=$ANIO;          
        $this->PERIODO=$PERIODO;       
        $this->conexion=$conexion; 
        $this->ESTADO_PERIODO=$ESTADO_PERIODO;
        $this->ID_PERIODO=$ID_PERIODO;
    }
    
    function guardar($conexion){
        $ANIO=$this->ANIO;      
        $PERIODO=$this->PERIODO;
        $ESTADO_PERIODO=$this->ESTADO_PERIODO;
        $this->conexion=$conexion;  
        try{
            $pa=mysqli_query($conexion,"SELECT * FROM PERIODO WHERE PERIODO LIKE '$PERIODO' AND ANIO = '$ANIO'");
            if(!empty(mysqli_fetch_array($pa))){
               echo mensajes('El periodo '.$PERIODO.' - '.$ANIO.' ya se encuentra registrada','rojo');
            }else{
                mysqli_query($conexion,"INSERT INTO PERIODO (anio, periodo, estado) VALUES ('$ANIO','$PERIODO','0')");
                echo mensajes('El periodo "'.$PERIODO.' - '.$ANIO.'" se registró con Exito','verde');
            }
        }catch(Exception $e)
        {echo mensajes('ERROR LANZADO '.$e,'rojo');}   

    }


    function actualizar($conexion){
        $ID_PERIODO=$this->ID_PERIODO;      
        $ANIO=$this->ANIO;  
        $PERIODO=$this->PERIODO;
        $this->conexion=$conexion; 
        $ESTADO_PERIODO=$this->ESTADO_PERIODO; 
        try{
            $pa=mysqli_query($conexion,"SELECT * from PERIODO WHERE PERIODO='$PERIODO' AND ANIO = '$ANIO' AND ID_PERIODO <> '$ID_PERIODO'");            
            $pe=mysqli_query($conexion,"SELECT * from PERIODO WHERE ESTADO = 1");
            if(!empty(mysqli_fetch_array($pa))){
                echo mensajes('El Periodo "'.$PERIODO.' - '.$ANIO.'" ya se encuentra registrado','rojo');
            }
            else if(!empty(mysqli_fetch_array($pe))) {
                    echo mensajes('Ya se cuenta con un periodo activo','rojo');}            
            else{
                mysqli_query($conexion,"UPDATE PERIODO SET ANIO='$ANIO',ESTADO='$ESTADO_PERIODO', PERIODO='$PERIODO' WHERE ID_PERIODO='$ID_PERIODO'");
                 echo mensajes('El Periodo "'.$PERIODO.' - '.$ANIO.'" se actualizó con Exito','verde');
            }
            
        }catch(Exception $e)
        {echo mensajes('ERROR LANZADO '.$e,'rojo');}  
                                  
    }

    function eliminar($conexion){
        $ID_PERIODO=$this->ID_PERIODO;     
        $this->conexion=$conexion;  
        try{
            mysqli_query($conexion,"UPDATE PERIODO SET ESTADO=0 WHERE ID_PERIODO ='$ID_PERIODO'");
            echo mensajes('El Periodo se desactivó con Exito','verde');
        }catch(Exception $e)
            {echo mensajes('ERROR LANZADO '.$e,'rojo');}                          
    }

}


class Proceso_Grado{
    var $ID_GRADO; 
    var $NOMBRE_GRADO;   		
    var $GRADO_ACTIVO;
    var $ID_CLASE;
    VAR $conexion;
    function __construct($conexion,$ID_GRADO, $NOMBRE_GRADO, $GRADO_ACTIVO,$ID_CLASE){
        $this->ID_GRADO=$ID_GRADO;
        $this->NOMBRE_GRADO=$NOMBRE_GRADO;          
        $this->GRADO_ACTIVO=$GRADO_ACTIVO;
        $this->conexion=$conexion;
        $this->ID_CLASE=$ID_CLASE;
    }
    
    function guardar($conexion){
        $ID_GRADO=$this->ID_GRADO;
	    $NOMBRE_GRADO=$this->NOMBRE_GRADO;
		$GRADO_ACTIVO=$this->GRADO_ACTIVO;
		$conexion=$this->conexion;	
        mysqli_query($conexion,"INSERT INTO GRADO (NOMBRE_GRADO, GRADO_ACTIVO) 
                                  VALUES ('$NOMBRE_GRADO','$GRADO_ACTIVO')");
        echo mensajes('El Grado "'.$NOMBRE_GRADO.'" Registrado con Exito','verde');
								  
    }
	
	function actualizar($conexion){
		$ID_GRADO=$this->ID_GRADO;
        $NOMBRE_GRADO=$this->NOMBRE_GRADO;  
        $GRADO_ACTIVO=$this->GRADO_ACTIVO;        
        $conexion=$this->conexion;	
        $ID_CLASE=$this->ID_CLASE;

		mysqli_query($conexion,"UPDATE GRADO SET NOMBRE_GRADO='$NOMBRE_GRADO',
			                           GRADO_ACTIVO='$GRADO_ACTIVO'
								WHERE ID_GRADO='$ID_GRADO'");
        mysqli_query($conexion,"INSERT INTO CLASESXGRADO (ID_GRADO,ID_CLASE)
                                 VALUES ('$ID_GRADO','$ID_CLASE')");
        echo mensajes('El Grado "'.$NOMBRE_GRADO.'" Actualizado con Exito','verde');
	}

    function eliminar($conexion){
	    $ID_GRADO=$this->ID_GRADO;
		$this->conexion=$conexion; 	
        mysqli_query($conexion,"UPDATE GRADO SET GRADO_ACTIVO = 0 WHERE ID_GRADO ='$ID_GRADO'");
								  
    }



}
?>