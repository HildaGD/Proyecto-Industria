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
0 =>'ID_PERSONA', 
1 => 'NOMBRES',
2=> 'EMAIL',
3=>'TELEFONO_CASA',
4=>'ACTIVO_PERSONA',
5=>'PRIVILEGIO_ID_PRIVILEGIO'


);

$sql="SELECT * FROM persona LEFT join encargado on id_persona=id_encargado LEFT join maestro on ID_PERSONA=id_maestro";



if($query=mysqli_query($conexion, $sql)){
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  

}

$sql = "SELECT * FROM persona LEFT join encargado on id_persona=id_encargado LEFT join maestro on ID_PERSONA=id_maestro";
$sql.=" WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql.=" AND ( NOMBRES LIKE '".$requestData['search']['value']."%' ";    
    $sql.=" OR  APELLIDOS LIKE '".$requestData['search']['value']."%' ";
    
   
    $sql.=" OR PRIVILEGIO_ID_PRIVILEGIO LIKE '".$requestData['search']['value']."%' )";
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

$nestedData[] = $row["ID_PERSONA"];
$nestedData[] = $row["NOMBRES"].' '.$row["APELLIDOS"];
$nestedData[] = $row["EMAIL"];
$nestedData[] = $row["TELEFONO_CASA"];
$nestedData[] = $row["ACTIVO_PERSONA"];
$nestedData[] = $row["PRIVILEGIO_ID_PRIVILEGIO"];

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