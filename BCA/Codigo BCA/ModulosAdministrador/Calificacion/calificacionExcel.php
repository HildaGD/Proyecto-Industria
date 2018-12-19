<?php

$alumno = $_POST['alumno'];


require ('../../conexion/db.php');
require '../../excell/PHPExcel.php';

/*HACEMOS LA CONSULTA*/
$consulta = "SELECT M.id_alumno,M.nombre,M.nombre_clase,M.nombre_grado,M.id_maestro,M.nombre_seccion,N.nombre_jornada
FROM (SELECT K.id_alumno, K.nombre,K.id_seccion, K.id_jornada,K.nombre_clase,K.nombre_grado,K.id_maestro,L.nombre_seccion
FROM(SELECT I.id_alumno, I.nombre,I.id_seccion, I.id_jornada,I.nombre_clase,I.nombre_grado,J.id_maestro
FROM (SELECT G.id_alumno, G.nombre,G.id_seccion, G.id_jornada,G.nombre_clase,G.id_clase,H.nombre_grado
FROM (SELECT E.id_alumno, E.nombre,E.id_seccion, E.id_jornada,E.nombre_clase,E.id_clase,F.id_grado
FROM (SELECT C.id_alumno, C.nombre,C.id_seccion, C.id_jornada,D.nombre_clase,D.id_clase
FROM(SELECT A.id_alumno, A.nombre,B.id_clase, B.id_seccion,B.id_jornada
FROM alumno as A inner join  clasexalumno as B 
ON(A.id_alumno=B.id_alumno)) as C
inner join clase as D 
on(C.id_clase=D.id_clase)) as E
inner join clasesxgrado as F) as G
inner join grado as H on(G.id_grado=H.id_grado))as I
inner join clasexmaestro as J on (I.id_clase=J.id_clase)) as K
inner join seccion as L on(K.id_seccion=L.id_seccion)) as M
inner join jornada as N on(M.id_jornada=N.id_jornada)
group by M.id_alumno,M.nombre,M.nombre_clase
having id_alumno='$alumno'";

$resultado = mysqli_query($link,$consulta);

$fila = 7;
$gdImage = imagecreatefrompng('../../img/escuela.png');//Logotipo
    
//Objeto de PHPExcel
$objPHPExcel = new PHPExcel();
//Propiedades de Documento
$objPHPExcel->getProperties()->setCreator("Estudiantes UNAH")->setDescription("Reporte Calificaciones");

//Establecemos la pestaña activa y nombre a la pestaña
$objPHPExcel->setActiveSheetIndex(0);
$CodigoAlumno = "Calificaciones";
$objPHPExcel->getActiveSheet()->setTitle($CodigoAlumno );

//Para colocar el Logo de la escuelas
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Logotipo');
	$objDrawing->setDescription('Logotipo');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(50);
	$objDrawing->setCoordinates('A1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
    
//LOS ESTILOS QUE VAMOS A USAR
	$estiloTituloReporte = array(
        'font' => array(
        'name'      => 'Arial',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>14
        ),
        'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID
        ),
        'borders' => array(
        'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_NONE
        )
        ),
        'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
        );
        
        $estiloTituloColumnas = array(
        'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'size' =>12,
        'color' => array(
        'rgb' => 'FFFFFF'
        )
        ),
        'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '538DD5')
        ),
        'borders' => array(
        'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN
        )
        ),
        'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
        );
        
        $estiloInformacion = new PHPExcel_Style();
        $estiloInformacion->applyFromArray( array(
        'font' => array(
        'name'  => 'Arial',
        'color' => array(
        'rgb' => '000000'
        )
        ),
        'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID
        ),
        'borders' => array(
        'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN
        )
        ),
        'alignment' =>  array(
        /*'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,*/
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
        ));

        $estiloTotal = new PHPExcel_Style();
        $estiloTotal->applyFromArray( array(
        'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
        'rgb' => '000000'
        )
        ),
        'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID
        ),
        'borders' => array(
        'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN
        )
        ),
        'alignment' =>  array(
       /* 'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,*/
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
        ));
     //COLOCAMOS LOS TITULOS DE LAS CELDAS   
$objPHPExcel->getActiveSheet()->getStyle('A1:C3')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Boleta de Calificaciones');
$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Educacion Integral con Excelencia:');
$objPHPExcel->getActiveSheet()->mergeCells('B3:C3');

$objPHPExcel->getActiveSheet()->setCellValue('E2', 'AÑO : 2018');


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
$objPHPExcel->getActiveSheet()->setCellValue('A6', 'ASIGNATURA');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->setCellValue('B6', '1 per');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->setCellValue('C6', '2 per');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->setCellValue('D6', '3 per');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->setCellValue('E6', '4 per');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->setCellValue('F6', 'PROM');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->setCellValue('G6', 'REC I');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->setCellValue('H6', 'REC II');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->setCellValue('I6', 'DOCENTE');

//Recorremos los resultados de la consulta y los imprimimos
while ($row = mysqli_fetch_array($resultado))
	{
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$row['nombre_clase']);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $row['id_maestro']);
        //$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $row[' M.nombre_grado']);
        $fila++;	//Sumamos 1 para pasar a la siguiente fila

        $objPHPExcel->getActiveSheet()->setCellValue('F2', 'CODIGO:'.$row['id_alumno']);
        $objPHPExcel->getActiveSheet()->setCellValue('G2', 'ALUMNO:');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', $row['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('E3', 'JORNADA:');
        $objPHPExcel->getActiveSheet()->setCellValue('F3', $row['nombre_jornada']);
        $objPHPExcel->getActiveSheet()->setCellValue('G3', 'GRADO:'.$row['nombre_grado']);
        $objPHPExcel->getActiveSheet()->setCellValue('H3', 'SECCION:'.$row['nombre_seccion']);

    }
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A7:I".$fila);
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "E2:H2");
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "E3:H3");


    header('Content-Type:application/vnd.ms-excel');
    //header("Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Disposition:attachment; filename="Reporte.xls"');
    header('Cache-Control: max-age=0');
   
    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
   
	
?>