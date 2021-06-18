<?php
    include 'plantilla.php';
	session_start();
    //$icono = htmlentities($cargar->cargar_icono($id));*/
    $id_hongo = $_GET['id_hon'];
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    /*if ($conn) {
        echo "Connection established.<br />";
    } else {
        echo "Connection could not be established.<br />";
        die(print_r(sqlsrv_errors(), true));
    }*/

    $sql = "SELECT * from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
        echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    $data = "";
            
            
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
    
    $arreglo = array('Nombre Científico: ','Nombre Vulgar: ','Familia: ','Habitat: ','Color: ','Área de conservación: ','Ubicación: ','Habito: ','Temporada: ','Clasificación: ','Pileo: ','Himenóforo: ','Estípite: ','Altura: ','Observación: ',
    'img_sup','img_inf','img_lat','img_mano_hongo');
    $areas = array('','Arenal Huetar Norte (ACAHN)','Arenal Tempisque (ACAT)','Central (ACC)','Guanacaste (ACG)','La Amistad-Caribe (ACLAC)','La Amistad-Pacífico (ACLAP)','Marina Cocos (ACMC)','Osa (ACOSA)',
    'Pacífico Central (ACOPAC)','Tempisque (ACT)','Tortuguero (ACTo)','Desconocido');
    $habito = array('','Gregario','Disperso','Solitario','Desconocido');
    $clasi = array('','Comestible','Venenoso','Alucinógeno','Medicinal','Desconocido');
    $pdf->SetFont('Arial','',14);
    $cont = 0;
    while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
        $pdf->Cell(0,8,iconv('UTF-8','windows-1252',$arreglo[0].$row['nomb_cient']),1,1,'C');
        $pdf->Cell(0,8,iconv('UTF-8','windows-1252',$arreglo[1].$row['nomb_vulgar']),1,1,'C');
        $pdf->Cell(0,8,iconv('UTF-8','windows-1252',$arreglo[2].$row['familia']),1,1,'C');
        $pdf->MultiCell(0,8,iconv('UTF-8','windows-1252',$arreglo[3].$row['habitat']),1,'C',0);
        $pdf->Cell(0,8,iconv('UTF-8','windows-1252',$arreglo[4].$row['color']),1,1,'C');
        $pdf->Cell(0,8,iconv('UTF-8','windows-1252',$arreglo[5].$areas[$row['id_area_consv']]),1,1,'C');
        $pdf->MultiCell(0,8,iconv('UTF-8','windows-1252',$arreglo[6].$row['ubicacion']),1,'C',0);
        $pdf->Cell(0,8,iconv('UTF-8','windows-1252',$arreglo[7].$habito[$row['habito']]),1,1,'C');
        $pdf->Cell(0,8,iconv('UTF-8','windows-1252',$arreglo[8].$row['temporada']),1,1,'C');
        $pdf->Cell(0,8,iconv('UTF-8','windows-1252',$arreglo[9].$clasi[$row['clasificacion']]),1,1,'C');
        $pdf->MultiCell(0,8,iconv('UTF-8','windows-1252',$arreglo[10].$row['pileo']),1,'C',0);
        $pdf->MultiCell(0,8,iconv('UTF-8','windows-1252',$arreglo[11].$row['himenoforo']),1,'C',0);
        $pdf->MultiCell(0,8,iconv('UTF-8','windows-1252',$arreglo[12].$row['estipite']),1,'C',0);
        $pdf->Cell(0,8,iconv('UTF-8','windows-1252',$arreglo[13].$row['altura_avisto'].' metros.'),1,1,'C');
        $pdf->MultiCell(0,8,iconv('UTF-8','windows-1252',$arreglo[14].$row['observacion']),1,'C',0);
        $pdf->AddPage();
        $pdf->Cell(0,6,'FOTOS',1,1,'C');
        if($row['img_sup'] != ""){ // file does not exist
            $pdf->MultiCell(0,120, $pdf->Image($row['img_sup'], $pdf->GetX(), $pdf->GetY(),120,120),0,'C');
            $cont++;
        }
        if($row['img_inf'] != ""){ // file does not exist
            $pdf->MultiCell(0,120, $pdf->Image($row['img_inf'], $pdf->GetX(), $pdf->GetY(),120,120),0,'C');
            $cont++;
        }
        if($cont == 2){
            $pdf->AddPage();
        }
        if($row['img_lat'] != ""){ // file does not exist
            $pdf->MultiCell(0,120, $pdf->Image($row['img_lat'], $pdf->GetX(), $pdf->GetY(),120,120),0,'C');
            $cont++;
        }
        if($cont == 2){
            $pdf->AddPage();
        }
        if($row['img_mano_hongo'] != ""){ // file does not exist
            $pdf->MultiCell(0,120, $pdf->Image($row['img_mano_hongo'], $pdf->GetX(), $pdf->GetY(),120,120),0,'C');
        }
    }
    sqlsrv_close($conn);
	$pdf->Output();
?>