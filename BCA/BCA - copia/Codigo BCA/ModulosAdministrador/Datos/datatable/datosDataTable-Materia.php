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
0 =>'ID_CLASE', 
1 => 'NOMBRE_CLASE',
2=> 'ESTADO_CLASE',
3=>'NOMBRE_GRADO',
4=>'NOMBRE_MAESTRO',
5=>'ID_PERSONA'
);

$sql="SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,CONCAT(C.NOMBRES,' ', C.APELLIDOS) As NOMBRE_MAESTRO,ESTADO_CLASE,ID_PERSONA,e.NOMBRE_GRADO
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                UNION ALL
                                                SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,CONCAT(C.NOMBRES,' ', C.APELLIDOS) As NOMBRE_MAESTRO,ESTADO_CLASE,ID_PERSONA,' '
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                 INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)                        
                                                UNION ALL
                                                SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,'',ESTADO_CLASE,'',C.NOMBRE_GRADO
                                                FROM clasesxgrado A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN grado AS C ON C.ID_GRADO = A.ID_GRADO  WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                 FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                                                     UNION ALL
                                                SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                             FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                            INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                            INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO) )
                                                 UNION ALL
                                                SELECT DISTINCT A.ID_CLASE,A.NOMBRE_CLASE,' ',ESTADO_CLASE,' ',''
                                                FROM clase A WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                UNION ALL
                                                SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)                        
                                                UNION ALL
                            SELECT DISTINCT B.ID_CLASE
                            FROM clasesxgrado A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN grado AS C ON C.ID_GRADO = A.ID_GRADO 
                            WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                            FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                            INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                            INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                            UNION ALL
                            SELECT DISTINCT B.ID_CLASE
                            FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                            WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                            FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                            INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                            INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)))
                                                order by ID_CLASE";



if($query=mysqli_query($conexion, $sql)){
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  

}


$sql = "SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,CONCAT(C.NOMBRES,' ', C.APELLIDOS) As NOMBRE_MAESTRO,ESTADO_CLASE,ID_PERSONA,e.NOMBRE_GRADO
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                UNION ALL
                                                SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,CONCAT(C.NOMBRES,' ', C.APELLIDOS) As NOMBRE_MAESTRO,ESTADO_CLASE,ID_PERSONA,' '
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                 INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)                        
                                                UNION ALL
                                                SELECT DISTINCT B.ID_CLASE,B.NOMBRE_CLASE,'',ESTADO_CLASE,'',C.NOMBRE_GRADO
                                                FROM clasesxgrado A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN grado AS C ON C.ID_GRADO = A.ID_GRADO  WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                 FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                                                     UNION ALL
                                                SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                             FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                            INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                            INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO) )
                                                 UNION ALL
                                                SELECT DISTINCT A.ID_CLASE,A.NOMBRE_CLASE,' ',ESTADO_CLASE,' ',''
                                                FROM clase A WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                                                UNION ALL
                                                SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                                                FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                                                INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                                                INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                                                INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)                        
                                                UNION ALL
                            SELECT DISTINCT B.ID_CLASE
                            FROM clasesxgrado A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN grado AS C ON C.ID_GRADO = A.ID_GRADO 
                            WHERE A.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                            FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                            INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                            INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO
                            UNION ALL
                            SELECT DISTINCT B.ID_CLASE
                            FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                            WHERE B.id_clase NOT IN (SELECT DISTINCT B.ID_CLASE
                            FROM clasexmaestro A INNER JOIN CLASE AS B  ON A.id_clase = B.ID_CLASE 
                            INNER JOIN persona AS C ON C.ID_PERSONA = A.id_maestro 
                            INNER JOIN clasesxgrado as d on d.ID_CLASE = b.ID_CLASE
                            INNER JOIN grado AS e on d.ID_GRADO=e.ID_GRADO)))";
// $sql.=" WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql.=" AND ( e.NOMBRE_GRADO LIKE '".$requestData['search']['value']."%' ";    
   // $sql.=" OR  B.NOMBRE_CLASE LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR  NOMBRE_MAESTRO LIKE '".$requestData['search']['value']."%' )";
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

$nestedData[] = $row["ID_CLASE"];
$nestedData[] = $row["NOMBRE_CLASE"];
$nestedData[] = $row["ESTADO_CLASE"];
$nestedData[] = $row["NOMBRE_GRADO"];
$nestedData[] = $row["NOMBRE_MAESTRO"];
$nestedData[] = $row["ID_PERSONA"];



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