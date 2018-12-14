<?php

class Proceso_Profesor{
    var $id;
    var $med;    	
    var $nom;      
    var $ape;      	
    var $fecha;			
    var $con;		
    var $tipo;
    var $dir;      	
    var $tel;   	
    var $ident;      	
    var $correo;	
    var $nac;	
    var $estado;
    var $conexion; 
    var $contrasenia; 

    
    function __construct($conexion,$id, $nom, $ape, $fecha, $dir, $tel, $ident, $correo, $nac, $usuario, $tipo, $contrasenia,$estado){
        $this->id=$id;      
        $this->nom=$nom;   
        $this->ape=$ape;  		
        $this->fecha=$fecha;	
        $this->estado=$estado;
        $this->dir=$dir;    
        $this->tel=$tel;    
        $this->ident=$ident; 
        $this->correo=$correo;	
        $this->nac=$nac;	
		$this->tipo=$tipo;	
        $this->contrasenia=$contrasenia;
        $this->conexion=$conexion; 
		
    }
    
    
    function guardar(){

        $id=$this->id;		
        $nom=$this->nom;	
        $ape=$this->ape;	
        $usuario=$this->usuario;		
        $fecha=$this->fecha;	
        $estado=$this->estado;
		$dir=$this->dir;	
        $tel=$this->tel;	
        $ident=$this->ident;	
        $correo=$this->correo;	
        $nac=$this->nac;
		$tipo=$this->tipo;	
        $contrasenia=$this->contrasenia;
        $conexion=$this->conexion; 

		try{
            $pa=mysqli_query($conexion,"SELECT * FROM persona WHERE NO_IDENTIDAD='$ident'");
            
            //if(!empty($row=mysqli_fetch_array($pa))){
            if (mysqli_num_rows($pa) != "0") {
               echo mensajes('Ya se tiene un usuario con el id '.$ident.' registrado','rojo');
            }else{
                mysqli_query($conexion, "INSERT INTO persona (PRIVILEGIO_ID_PRIVILEGIO,NOMBRES, APELLIDOS, FECHA_NACIMIENTO,LUGAR_NACIMIENTO, COLONIA, TELEFONO_CASA, NO_IDENTIDAD, EMAIL, USUARIO, CONTRASENIA, ACTIVO_PERSONA) VALUES ('$tipo','$nom','$ape','$fecha', '$nac','$dir','$tel','$ident','$correo','$usuario','$contrasenia', '$estado')");
                echo mensajes('El Usuario "'.$nom.' '.$ape.'" Ha sido Guardado con Exito','verde');
            }
        }catch(Exception $e)
            {echo mensajes('ERROR LANZADO '.$e,'rojo');}            	
        

								  
    }
   
	
	function actualizar(){
       	$id=$this->id;		
        $nom=$this->nom;	
        $ape=$this->ape;		
        $fecha=$this->fecha;	
        $estado=$this->estado;
		$dir=$this->dir;	
        $tel=$this->tel;	
        $iednt=$this->ident;	
        $correo=$this->correo;	
        $nac=$this->nac;
		$tipo=$this->tipo;
        $contrasenia=$this->contrasenia;
        $conexion=$this->conexion; 
		
		mysqli_query($conexion, "UPDATE persona SET NOMBRES='$nom', APELLIDOS='$ape', FECHA_NACIMIENTO='$fecha', LUGAR_NACIMIENTO='$nac', COLONIA='$dir', TELEFONO_CASA='$tel', NO_IDENTIDAD='$ident', EMAIL='$correo', PRIVILEGIO_ID_PRIVILEGIO='$tipo', ACTIVO_PERSONA='$estado' WHERE ID_PERSONA='$id'");


    }



    function eliminar(){
        $id=$this->id;       
        $estado=$this->estado;
        $conexion=$this->conexion; 
        try{
            mysqli_query($conexion, "UPDATE persona SET ACTIVO_PERSONA=0 WHERE ID_PERSONA='$id'");
            echo mensajes('El usuario "'.$_POST['nombre'].'" se elimino con Exito','verde');
        }catch(Exception $e)
            {echo mensajes('ERROR LANZADO '.$e,'rojo');} 
        


    }
}
?>