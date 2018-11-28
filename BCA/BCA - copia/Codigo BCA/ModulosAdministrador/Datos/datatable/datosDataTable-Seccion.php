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
	
0 =>'periodo',
1 =>'NOMBRE_SECCION',
2=> 'ESTADO',
3=> 'NOMBRE_GRADO',
4=> 'NOMBRE_JORNADA',
5 =>'id_periodo'

);

$sql="SELECT concat(P.periodo,' - ',P.anio) periodo,P.id_periodo,S.ID_SECCION,S.NOMBRE_SECCION,P.ESTADO,G.ID_GRADO,G.NOMBRE_GRADO,J.ID_JORNADA,J.NOMBRE_JORNADA
                                        FROM seccionesxgrado AS SG INNER JOIN seccion AS S ON S.ID_SECCION=SG.ID_SECCION
                                        INNER JOIN grado AS G ON G.ID_GRADO = SG.ID_GRADO
                                        INNER JOIN jornada AS J ON J.ID_JORNADA = SG.ID_JORNADA
                                        INNER JOIN periodo as P on P.id_periodo = SG.id_periodo";



if($query=mysqli_query($conexion, $sql)){
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  

}



$sql = "SELECT concat(P.periodo,' - ',P.anio) periodo,P.id_periodo,S.ID_SECCION,S.NOMBRE_SECCION,P.ESTADO,G.ID_GRADO,G.NOMBRE_GRADO,J.ID_JORNADA,J.NOMBRE_JORNADA
                                        FROM seccionesxgrado AS SG INNER JOIN seccion AS S ON S.ID_SECCION=SG.ID_SECCION
                                        INNER JOIN grado AS G ON G.ID_GRADO = SG.ID_GRADO
                                        INNER JOIN jornada AS J ON J.ID_JORNADA = SG.ID_JORNADA
                                        INNER JOIN periodo as P on P.id_periodo = SG.id_periodo";
$sql.=" WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql.=" AND ( periodo LIKE '".$requestData['search']['value']."%' ";    
    $sql.=" OR  S.NOMBRE_SECCION LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR  G.NOMBRE_GRADO LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR J.NOMBRE_JORNADA LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR P.ESTADO LIKE '".$requestData['search']['value']."%' )";
}
if($query=mysqli_query($conexion, $sql)){
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
#$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */ 
}   
$query=mysqli_query($conexion, $sql) or die();




$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
$nestedData=array(); 

$nestedData[] = $row["periodo"];
$nestedData[] = $row["NOMBRE_SECCION"];
$nestedData[] = $row["ESTADO"];
$nestedData[] = $row["NOMBRE_GRADO"];
$nestedData[] = $row["NOMBRE_JORNADA"];
$nestedData[] = $row["id_periodo"];
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