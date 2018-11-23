<?php
class Proceso_Clase{
    var $ID_CLASE;      	
    var $NOMBRE_CLASE;
   
    var $conexion;
    function __construct($conexion,$ID_CLASE, $NOMBRE_CLASE){
        $this->ID_CLASE=$ID_CLASE;      	
        $this->NOMBRE_CLASE=$NOMBRE_CLASE;       
        $this->conexion=$conexion; 
    }
    
    function guardar($conexion){
	    $ID_CLASE=$this->ID_CLASE;		
	    $NOMBRE_CLASE=$this->NOMBRE_CLASE;	
	    
		$this->conexion=$conexion; 	
        mysqli_query($conexion,"INSERT INTO CLASE (NOMBRE_CLASE) 
                                  VALUES ('$NOMBRE_CLASE')");
								  
    }
	
	function actualizar($conexion){
		$ID_CLASE=$this->ID_CLASE;		
	    $NOMBRE_CLASE=$this->NOMBRE_CLASE;	
	    
		$this->conexion=$conexion; 		
		mysqli_query($conexion,"UPDATE CLASE SET NOMBRE_CLASE='$NOMBRE_CLASE'
										
								WHERE ID_CLASE='$ID_CLASE'");
	}
}

class Proceso_Seccion{
    var $ID_SECCION;      	
    var $NOMBRE_SECCION;   	
    var $ID_JORNADA;
    var $ID_GRADO;
    var $SECCION_ACTIVO;
    function __construct($conexion,$ID_SECCION, $NOMBRE_SECCION, $ID_JORNADA, $ID_GRADO, $SECCION_ACTIVO){
        $this->ID_SECCION=$ID_SECCION;
        $this->NOMBRE_SECCION=$NOMBRE_SECCION;          
		$this->ID_JORNADA=$ID_JORNADA;
		$this->ID_GRADO=$ID_GRADO;		
		$this->SECCION_ACTIVO=$SECCION_ACTIVO;
    }
    //hastaaqui----------------------------------------------------------------------------------------
    function guardar($conexion){
	    $ID_SECCION=$this->ID_SECCION;
	    $NOMBRE_SECCION=$this->NOMBRE_SECCION;
	    $ID_JORNADA=$this->ID_JORNADA;
		$ID_GRADO=$this->ID_GRADO;	
		$SECCION_ACTIVO=$this->SECCION_ACTIVO;
		$conexion=$this->conexion;	
        mysqli_query($conexion,"INSERT INTO SECCION (NOMBRE_SECCION, ID_JORNADA, ID_GRADO, SECCION_ACTIVO) 
                                  VALUES ('$NOMBRE_SECCION','$ID_JORNADA','$ID_GRADO','$SECCION_ACTIVO')");
								  
    }
	
	function actualizar($conexion){
		 $ID_SECCION=$this->ID_SECCION;			
		 $NOMBRE_SECCION=$this->NOMBRE_SECCION;
		 $ID_JORNADA=$this->ID_JORNADA;
		 $ID_GRADO=$this->ID_GRADO;	
		 $SECCION_ACTIVO=$this->SECCION_ACTIVO;
				
		mysqli_query($conexion,"UPDATE SECCION SET NOMBRE_SECCION='$NOMBRE_SECCION',
										ID_JORNADA='$ID_JORNADA',
										ID_GRADO='$ID_GRADO',
										SECCION_ACTIVO='$SECCION_ACTIVO'
								WHERE ID_SECCION='$ID_SECCION'");
	}
}

class Proceso_Grado{
    var $ID_GRADO; 
    var $NOMBRE_GRADO;   		
    var $GRADO_ACTIVO;
    VAR $conexion;
    function __construct($conexion,$ID_GRADO, $NOMBRE_GRADO, $GRADO_ACTIVO){
        $this->ID_GRADO=$ID_GRADO;
        $this->NOMBRE_GRADO=$NOMBRE_GRADO;          
        $this->GRADO_ACTIVO=$GRADO_ACTIVO;
        $this->conexion=$conexion;
    }
    
    function guardar($conexion){
        $ID_GRADO=$this->ID_GRADO;
	    $NOMBRE_GRADO=$this->NOMBRE_GRADO;
		$GRADO_ACTIVO=$this->GRADO_ACTIVO;
		$conexion=$this->conexion;	
        mysqli_query($conexion,"INSERT INTO GRADO (NOMBRE_GRADO, GRADO_ACTIVO) 
                                  VALUES ('$NOMBRE_GRADO',$GRADO_ACTIVO')");
								  
    }
	
	function actualizar($conexion){
		 $this->ID_GRADO=$ID_GRADO;
        $this->NOMBRE_GRADO=$NOMBRE_GRADO;          
        $this->GRADO_ACTIVO=$GRADO_ACTIVO;
        $this->conexion=$conexion;		
		mysqli_query($conexion,"UPDATE GRADO SET NOMBRE_GRADO='$NOMBRE_GRADO',
										GRADO_ACTIVO='$GRADO_ACTIVO'
								WHERE ID_GRADO='$ID_GRADO'");
	}
}
?>