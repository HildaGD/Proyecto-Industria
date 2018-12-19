<?php
$conexion = mysqli_connect("localhost","root","","sistema");        //Conecta con la base de datos sistema
mysqli_select_db($conexion,"sistema");                              //Selecciona la base de datos sistema
date_default_timezone_set("America/Tegucigalpa");                   //Establece la zona horaria
mysqli_query($conexion,"SET NAMES utf8");                           //Realiza una consulta
mysqli_query($conexion,"SET CHARACTER_SET utf");
$s='Bs';

$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name 
//0 =>'ID_ALUMNO'
0 => 'NOMBRE',
1 => 'edad',
2=> 'ESCUELA_PROCEDENCIA',
3=>'UTILIZA_TRANSPORTE',
4=> 'NOMBRE_GRADO',
5=> 'NOMBRE_SECCION',
6=> 'NOMBRE_JORNADA',
7=> 'ACTIVO_ALUMNO',
8=>'ID_ALUMNO'
   
);
         

$sql="SELECT distinct a.ID_ALUMNO,a.NOMBRE,YEAR(CURDATE())-YEAR(A.FECHA_NACIMIENTO) edad, a.ESCUELA_PROCEDENCIA,a.UTILIZA_TRANSPORTE,g.NOMBRE_GRADO,s.NOMBRE_SECCION,j.NOMBRE_JORNADA,a.ACTIVO_ALUMNO FROM alumno AS A 
                                                        inner join informacion_medica AS B on A.ID_INFO_MEDICA=B.ID_INFO_MEDICA
                                                        INNER JOIN clasexalumno as ca on ca.ID_ALUMNO = a.ID_ALUMNO
                                                        INNER JOIN clasesxgrado as cg on cg.ID_CLASE = ca.ID_CLASE
                                                        INNER JOIN seccionesxgrado as sg on sg.ID_GRADO = cg.ID_GRADO
                                                        INNER JOIN grado AS g on sg.ID_GRADO = g.ID_GRADO
                                                        INNER JOIN seccion as s on s.ID_SECCION = sg.ID_SECCION and s.ID_SECCION= ca.ID_SECCION 
                                                        INNER JOIN jornada as j on sg.ID_JORNADA = j.ID_JORNADA AND j.ID_JORNADA = ca.ID_JORNADA
                                                        WHERE CA.ESTADO=1
                                                        UNION ALL
                                                        SELECT a.ID_ALUMNO,a.NOMBRE,YEAR(CURDATE())-YEAR(A.FECHA_NACIMIENTO) edad,a.ESCUELA_PROCEDENCIA,a.UTILIZA_TRANSPORTE,'','','',a.ACTIVO_ALUMNO FROM alumno AS A 
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
                                                                                    WHERE CA.ESTADO=1)";



if($query=mysqli_query($conexion, $sql)){
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  

}

$sql = "SELECT distinct a.ID_ALUMNO,a.NOMBRE,YEAR(CURDATE())-YEAR(A.FECHA_NACIMIENTO) edad, a.ESCUELA_PROCEDENCIA,a.UTILIZA_TRANSPORTE,g.NOMBRE_GRADO,s.NOMBRE_SECCION,j.NOMBRE_JORNADA,a.ACTIVO_ALUMNO FROM alumno AS A 
                                                        inner join informacion_medica AS B on A.ID_INFO_MEDICA=B.ID_INFO_MEDICA
                                                        INNER JOIN clasexalumno as ca on ca.ID_ALUMNO = a.ID_ALUMNO
                                                        INNER JOIN clasesxgrado as cg on cg.ID_CLASE = ca.ID_CLASE
                                                        INNER JOIN seccionesxgrado as sg on sg.ID_GRADO = cg.ID_GRADO
                                                        INNER JOIN grado AS g on sg.ID_GRADO = g.ID_GRADO
                                                        INNER JOIN seccion as s on s.ID_SECCION = sg.ID_SECCION and s.ID_SECCION= ca.ID_SECCION 
                                                        INNER JOIN jornada as j on sg.ID_JORNADA = j.ID_JORNADA AND j.ID_JORNADA = ca.ID_JORNADA
                                                        WHERE CA.ESTADO=1
                                                        UNION ALL
                                                        SELECT a.ID_ALUMNO,a.NOMBRE,YEAR(CURDATE())-YEAR(A.FECHA_NACIMIENTO) edad,a.ESCUELA_PROCEDENCIA,a.UTILIZA_TRANSPORTE,'','','',a.ACTIVO_ALUMNO FROM alumno AS A 
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
                                                                                    WHERE CA.ESTADO=1)";
//$sql.=" WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
   //$sql.=" WHERE g.NOMBRE_GRADO LIKE '".$requestData['search']['value']."%' ";
    $sql.=" AND ( a.Nombre LIKE '".$requestData['search']['value']."%' ";    
    $sql.=" OR g.NOMBRE_GRADO LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR s.NOMBRE_SECCION LIKE '".$requestData['search']['value']."%' ";  
    $sql.=" OR j.NOMBRE_JORNADA LIKE '".$requestData['search']['value']."%' "; 
    $sql.=" OR a.ACTIVO_ALUMNO LIKE '".$requestData['search']['value']."%' "; 
    $sql.=" OR a.UTILIZA_TRANSPORTE LIKE '".$requestData['search']['value']."%' ";   
    $sql.=" OR a.ID_ALUMNO LIKE '".$requestData['search']['value']."%' )";
}
if($query=mysqli_query($conexion, $sql)){
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */ 
}   
$query=mysqli_query($conexion, $sql) or die();




$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
$nestedData=array(); 


$nestedData[] = $row["ID_ALUMNO"];
$nestedData[] = $row["NOMBRE"];
$nestedData[] = $row["edad"];
$nestedData[] = $row["ESCUELA_PROCEDENCIA"];
$nestedData[] = $row["UTILIZA_TRANSPORTE"];
$nestedData[] = $row["NOMBRE_GRADO"];
$nestedData[] = $row["NOMBRE_SECCION"];
$nestedData[] = $row["NOMBRE_JORNADA"];
$nestedData[] = $row["ACTIVO_ALUMNO"];
$nestedData[] = $row["ID_ALUMNO"];
$data[] = $nestedData;

}



$json_data = array(
        "draw"=> intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
        "recordsTotal"=> intval( $totalData ),  // total number of records
        "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
        );

echo json_encode($json_data);  // send data as json format
?>