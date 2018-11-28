<?php
class Consultar_Actividad{
	private $consulta;
	private $fetch;
	private $conexion;
	function __construct($conexion,$codigo){
		$this->conexion=$conexion;
		$this->consulta = mysqli_query($this->conexion,"SELECT * FROM actividad WHERE id='$codigo'");
		$this->fetch = mysqli_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
class Consultar_Materias{
	private $conexion;
	private $consulta;
	private $fetch;
	
	function __construct($codigo,$conexion){
		$this->conexion=$conexion;
		$this->consulta = mysqli_query($this->conexion,"SELECT * FROM materia WHERE id='$codigo'");
		$this->fetch = mysqli_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}



class Consultar_Profesor{
	private $consulta;
	private $fetch;
	private $conexion;

	function __construct($codigo,$conexion){
		$this->conexion = $conexion;
		$this->consulta = mysqli_query($this->conexion,"SELECT a.NOMBRES, a.APELLIDOS, b.CARGO from PERSONA as a inner join MAESTRO as b on ID_MAESTRO=ID_PERSONA where ID_PERSONA = '$codigo'");
		$this->fetch = mysqli_fetch_assoc($this->consulta);

	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}


class Consultar_Seccion{
	private $consulta;
	private $fetch;
	private $conexion;
	function __construct($codigo,$conexion){
		$this->conexion=$conexion;
		$this->consulta = mysqli_query($this->conexion,"SELECT * FROM SECCION WHERE ID_SECCION=$codigo");
		$this->fetch = mysqli_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Empresa{
	private $consulta;
	private $fetch;
	private $conexion;
	function __construct($conexion,$codigo){
		$this->conexion=$conexion;
		$this->consulta = mysqli_query($this->conexion,"SELECT * FROM empresa WHERE id='$codigo'");
		$this->fetch = mysqli_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Periodo{
	private $consulta;
	private $fetch;
	private $conexion;
	function __construct($conexion,$codigo){
		$this->conexion=$conexion;
		$this->consulta = mysqli_query($this->conexion,"SELECT * FROM periodo WHERE id='$codigo'");
		$this->fetch = mysqli_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Alumno{
	private $consulta;
	private $fetch;
	private $conexion;
	function __construct($conexion,$codigo){
		$this->conexion=$conexion;
		$this->consulta=mysqli_query($this->conexion,"SELECT * FROM alumnos WHERE doc='$codigo'");
		$this->fetch=mysqli_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}


class Consultar_Grado{
	private $consulta;
	private $fetch;
	private $conexion;
	
	function __construct($codigo,$conexion){
		$this->conexion = $conexion;
		$this->consulta = mysqli_query($this->conexion,"SELECT * FROM GRADO WHERE ID_GRADO=$codigo");
		$this->fetch = mysqli_fetch_assoc($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}


class Consultar_Jornada{
	private $consulta;
	private $fetch;
	private $conexion;
	function __construct($codigo,$conexion){
		$this->conexion=$conexion;
		$this->consulta=mysqli_query($this->conexion,"SELECT * FROM JORNADA WHERE ID_JORNADA='$codigo'");
		$this->fetch=mysqli_fetch_array($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
?>