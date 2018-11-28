<?php
$conexion = mysqli_connect("localhost","root","","sistema");        //Conecta con la base de datos sistema
mysqli_select_db($conexion,"sistema");                              //Selecciona la base de datos sistema
date_default_timezone_set("America/Tegucigalpa");                   //Establece la zona horaria
mysqli_query($conexion,"SET NAMES utf8");                           //Realiza una consulta
mysqli_query($conexion,"SET CHARACTER_SET utf");
$s='Bs';

$requestData= $_REQUEST;

$id_clase=$_POST['id_clase'];


$columns = array( 
// datatable column index  => database column name 
0=>'ID_ALUMNO',
1=> 'NOMBRE_ALUMNO',
2=>'PRIMER_PARCIAL',
3=>'SEGUNDO_PARCIAL',
4=>'TERCER_PARCIAL',
5=>'CUARTO_PARCIAL',
6=>'NOTA_FINAL'); 


$sql="SELECT ID_CLASE,NOMBRE_CLASE,ID_ALUMNO,NOMBRE,ID_GRADO,
                                                       CASE WHEN ID_PARCIAL = 1 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END AS PRIMER_PARCIAL,
                                                       CASE WHEN ID_PARCIAL = 2 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END AS SEGUNDO_PARCIAL,
                                                       CASE WHEN ID_PARCIAL = 3 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END AS TERCER_PARCIAL,
                                                       CASE WHEN ID_PARCIAL = 4 THEN (HOMEWORK+CLASSWORK+CLASSWORK_EVALUATION+TEST) ELSE 0 END AS CUARTO_PARCIAL,
                                                       PUNTAJE AS PARCIALES
                                                FROM (SELECT CA.ID_CLASE,CL.NOMBRE_CLASE,CA.ID_ALUMNO,A.NOMBRE,CG.ID_GRADO,C.ID_PARCIAL,HOMEWORK,CLASSWORK,CLASSWORK_EVALUATION,TEST,C.PUNTAJE
                                                        FROM clasexalumno as ca inner join clasesxgrado as cg on cg.ID_CLASE = ca.ID_CLASE
                                                        INNER join calificaciones as c on c.ID_ALUMNO = ca.ID_ALUMNO and c.ID_CLASE=ca.ID_CLASE
                                                        INNER JOIN alumno AS A ON A.ID_ALUMNO = CA.ID_ALUMNO
                                                        INNER JOIN clase AS CL ON CL.ID_CLASE=CA.ID_CLASE
                                                        INNER JOIN PERIODO AS P ON P.id_periodo = C.ANIO
                                                        WHERE P.estado = 1
                                                        AND CA.ID_CLASE = '$id_clase') AS T1
                                                group by ID_CLASE,NOMBRE_CLASE,ID_ALUMNO,NOMBRE,ID_GRADO";


if($query=mysqli_query($conexion, $sql)){
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;}

if($query=mysqli_query($conexion, $sql)){
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
#J$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
} 

$query=mysqli_query($conexion, $sql) or die();

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
$nestedData=array(); 
$nestedData[] = $row["ID_ALUMNO"];
$nestedData[] = $row["NOMBRE"];
$nestedData[] = $row["PRIMER_PARCIAL"];
$nestedData[] = $row["SEGUNDO_PARCIAL"];
$nestedData[] = $row["TERCER_PARCIAL"];
$nestedData[] = $row["CUARTO_PARCIAL"];
$nestedData[] = (($row['PRIMER_PARCIAL']+$row['SEGUNDO_PARCIAL']+$row['TERCER_PARCIAL']+$row['CUARTO_PARCIAL'])/4);
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