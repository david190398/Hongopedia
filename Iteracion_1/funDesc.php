<?php
    function descCsv(){
        $serverName = "35.224.8.47"; //serverName\instanceName
        $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
        $conn = sqlsrv_connect($serverName, $connectionInfo);

        /*if ($conn) {
            echo "Connection established.<br />";
        } else {
            echo "Connection could not be established.<br />";
            die(print_r(sqlsrv_errors(), true));
        }*/

        $csv_sep = ",";
        $sql = "SELECT * from GestionHongos.dbo.Hongos";
        $qry = sqlsrv_query($conn, $sql);
        if ($qry === false) {
            echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        }
        $data = "id_hongo,nomb_cient,nomb_vulgar,familia,habitat,color,id_area_consv,ubicacion,habito,temporada,clasificacion,pileo,himenoforo,estipite,altura_avisto,observacion,img_sup,img_inf,img_lat,img_mano_hongo,usuario_fuente \n";
        
        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row['id_hongo'] . $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ",$row['nomb_cient']) . $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ",$row['nomb_vulgar']) . $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ",$row['familia']) . $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ",$row['habitat']) . $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ",$row['color']) .
                $csv_sep . $row['id_area_consv'] . $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ",$row['ubicacion']) . $csv_sep . $row['habito'] . $csv_sep . $row['temporada'] . $csv_sep . $row['clasificacion'] . $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ", $row['pileo']) .
                $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ",$row['himenoforo']) . $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ",$row['estipite']) . $csv_sep . $row['altura_avisto'] . $csv_sep . str_replace(array("\n","\r\n","\r",",",";",".")," ",$row['observacion']) . $csv_sep . $row['img_sup'] .
                $csv_sep . $row['img_inf'] . $csv_sep . $row['img_lat'] . $csv_sep . $row['img_mano_hongo'] . $csv_sep . $row['usuario_fuente'] . "\n";
        }
        $file = 'respaldo/file.csv';
        usleep(40);
        //chmod($file, 0777);
        file_put_contents($file, "");
        usleep(40);
        file_put_contents($file, $data);
        //$file = 'respaldo/file.csv';

        if(!file_exists($file)){ // file does not exist
            die('file not found');
        } else {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=file.csv");
            header("Content-Type: text/csv");
            header("Content-Transfer-Encoding: binary");
        
            // read the file from disk
            readfile($file);
        }

        sqlsrv_close($conn);
    }
    descCsv();
?>