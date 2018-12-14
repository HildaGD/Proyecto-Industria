<?php
	
	$conexion = mysqli_connect("localhost","root","");
	mysqli_select_db("sistem",$conexion);
	date_default_timezone_set("America/Caracas");
    mysqli_query("SET NAMES utf8");
	mysqli_query("SET CHARACTER_SET utf");
	$s='Bs';
	
	function limpiar($tags){
		$tags = strip_tags($tags);
		$tags = stripslashes($tags);
		$tags = htmlentities($tags);
		return $tags;
	}

	
?>