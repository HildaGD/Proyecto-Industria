<?php

	$conexion = mysqli_connect("localhost","root","","sistema");		//Conecta con la base de datos sistema
	mysqli_select_db($conexion,"sistema");								//Selecciona la base de datos sistema
	date_default_timezone_set("America/Tegucigalpa");					//Establece la zona horaria
    mysqli_query($conexion,"SET NAMES utf8");							//Realiza una consulta
	mysqli_query($conexion,"SET CHARACTER_SET utf");
	$s='Bs';

	$paa=mysqli_query($conexion,"SELECT `PRIVILEGIO_ID_PRIVILEGIO`,  `NOMBRES`,  `APELLIDOS` FROM persona WHERE `USUARIO` = 'juanper' AND  `CONTRASENIA` =  '4321'");			//Realiza una consulta				
	if($dato=mysqli_fetch_assoc($paa)){
		$id=$dato['PRIVILEGIO_ID_PRIVILEGIO'];
		$nombres=$dato['NOMBRES'];
		$apellidos=$dato['APELLIDOS'];
	}
	
	
	function limpiar($tags){
		

		return $tags;
	}
?>