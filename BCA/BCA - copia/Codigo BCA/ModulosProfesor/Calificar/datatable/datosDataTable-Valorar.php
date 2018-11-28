<?php
$conexion = mysqli_connect("localhost","root","","sistema");        //Conecta con la base de datos sistema
mysqli_select_db($conexion,"sistema");                              //Selecciona la base de datos sistema
date_default_timezone_set("America/Tegucigalpa");                   //Establece la zona horaria
mysqli_query($conexion,"SET NAMES utf8");                           //Realiza una consulta
mysqli_query($conexion,"SET CHARACTER_SET utf");
$s='Bs';

$requestData= $_REQUEST;

$id_alumno=$_POST['id_alumno'];
$id_clase=$_POST['id_clase'];

$columns = array( 
// datatable column index  => database column name
// 0 =>'PARCIAL', 
0=>'NOMBRE_PARCIAL',
1=> 'HOMEWORK',
2=>'CLASSWORK',
3=>'CLASSWORK_EVALUATION',
4=>'TEST',
5=>'ID_PARCIAL'
); 

$sql="SELECT *  FROM Calificaciones A INNER JOIN PARCIAL B ON A.ID_PARCIAL = B.ID_PARCIAL 
                                        INNER JOIN periodo AS P ON P.id_periodo = A.ANIO
                                        WHERE id_alumno='$id_alumno'
                                        AND ID_CLASE='$id_clase'
                                        AND P.ESTADO = 1";

if($query=mysqli_query($conexion, $sql)){
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  
}

if($query=mysqli_query($conexion, $sql)){
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY B.ID_PARCIAL";

} 

$query=mysqli_query($conexion, $sql) or die();


$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
$nestedData=array(); 
$nestedData[] = $row["NOMBRE_PARCIAL"];
$nestedData[] = $row["HOMEWORK"];
$nestedData[] = $row["CLASSWORK"];
$nestedData[] = $row["CLASSWORK_EVALUATION"];
$nestedData[] = $row["TEST"];
$nestedData[] = $row["ID_PARCIAL"];

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