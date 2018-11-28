<?php

class Proceso_Calificar{
    var $conexion;    	
    var $id_clase;      
    var $id_seccion;       	
    var $id_parcial;		
    var $id_alumno;
	var $HOMEWORK;	
	var $CLASSWORK;
	var $CLASSWORK_EVALUATION;
	var $TEST;
    
    function __construct($conexion,$id_clase,$id_seccion,$id_parcial,$id_alumno,$HOMEWORK,$CLASSWORK,$CLASSWORK_EVALUATION,$TEST){
        $this->conexion=$conexion;      		
        $this->id_clase=$id_clase;    
		$this->id_seccion=$id_seccion;		
		$this->id_parcial=$id_parcial;  
		$this->id_alumno=$id_alumno;		
		$this->HOMEWORK=$HOMEWORK;			
		$this->CLASSWORK=$CLASSWORK;
		$this->CLASSWORK_EVALUATION=$CLASSWORK_EVALUATION;
		$this->TEST=$TEST;

    }
    
    function guardar(){
    $conexion=$this->conexion;    	
    $id_clase=$this->id_clase;      
    $id_seccion=$this->id_seccion;       	
    $id_parcial=$this->id_parcial;		
    $id_alumno=$this->id_alumno;
	$HOMEWORK=$this->HOMEWORK;	
	$CLASSWORK=$this->CLASSWORK;
	$CLASSWORK_EVALUATION=$this->CLASSWORK_EVALUATION;
	$TEST=$this->TEST;

	$pa=mysqli_query($conexion,"SELECT DISTINCT classwork,classwork_evaluation, test,homework FROM LIMITES AS L 
							INNER JOIN SECCIONESXGRADO AS SG ON SG.ID_GRADO = L.ID_GRADO
							INNER JOIN clasesxgrado AS CG ON CG.ID_GRADO = SG.ID_GRADO
							WHERE ID_CLASE = '$id_clase'");
	$row=mysqli_fetch_array($pa);
	if($row['homework']< $HOMEWORK){ echo mensajes('Nota de HOMEWORK es incorrecta ','rojo');}
		elseif ($row['classwork_evaluation']< $CLASSWORK_EVALUATION) {echo mensajes('Nota de CLASSWORK_EVALUATION es incorrecta ','rojo');}
			elseif ($row['test']< $TEST) {echo mensajes('Nota de TEST es incorrecta ','rojo');}
				elseif ($row['classwork']< $CLASSWORK) {echo mensajes('Nota de CLASSWORK es incorrecta ','rojo');} 
				else{mysqli_query($conexion,"UPDATE calificaciones AS CL INNER JOIN PERIODO AS P ON P.ID_PERIODO = CL.ANIO SET CL.HOMEWORK=$HOMEWORK, CL.CLASSWORK=$CLASSWORK, CL.CLASSWORK_EVALUATION=$CLASSWORK_EVALUATION,CL.TEST=$TEST,PUNTAJE=1
        	         WHERE CL.id_alumno = $id_alumno AND CL.ID_SECCION=$id_seccion and CL.id_clase=$id_clase and CL.id_parcial=$id_parcial AND P.ESTADO = 1 ");	
    
    }}
	
	function actualizar(){
       	$id=$this->id;				
       	$materia=$this->materia;	
		$alumno=$this->alumno;		
		$actividad=$this->actividad;		
		$valor=$this->valor;		
		$periodo=$this->periodo;			
		$fecha=$this->fecha;
		
		mysql_query("UPDATE notas SET valor='$valor' WHERE id='$id'");
	}
}
?>