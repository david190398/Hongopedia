<?php
    class cargar {
        // VARIABLES DE LA CLASE
        
        // FUNCIONES DE LA CLASE
        
        function __construct(){
      
        }
        function __destruct(){ 
        
        }

        function tupla_valida($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);
            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/
            $sql = "SELECT tupla_valida from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = 0;
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data = $row['tupla_valida'];
            }
            sqlsrv_close($conn);
            return $data;
        }

        function es_valido_id($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);
            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/
            $valido=true;
            $sql = "SELECT COUNT(id_hongo) as id_valido from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
                $valido=false;
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['id_valido'];
            }

            if($data === "0"){ // file does not exist
                $valido=false;
            }

            sqlsrv_close($conn);
            return $valido;


        }


        function cargar_inferior($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);
            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT img_inf from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['img_inf'];
            }

            if($data === ""){ // file does not exist
                $data = '../img/Default/hongo_default.svg';
            }

            sqlsrv_close($conn);
            return $data;
        }
        function cargar_superior($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT img_sup from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .=  $row['img_sup'];
            }
            
            if($data === ""){ // file does not exist
                $data = '../img/Default/hongo_default.svg';
            }

            sqlsrv_close($conn);
            return $data;
        }
        function cargar_lateral($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT img_lat from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['img_lat'];
            }

            if($data === ""){ // file does not exist
                $data = '../img/Default/hongo_default.svg';
            }

            sqlsrv_close($conn);
            return $data;
        }
        function cargar_rel_mano($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT img_mano_hongo from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['img_mano_hongo'];
            }

            if($data === ""){ // file does not exist
                $data = '../img/Default/hongo_default.svg';
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_nombre($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT nomb_cient from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['nomb_cient'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para el nombre científico";
            }

            sqlsrv_close($conn);
            return $data;
        }
        function cargar_nombre_vul($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT nomb_vulgar from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['nomb_vulgar'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para el nombre vulgar";
            }

            sqlsrv_close($conn);
            return $data;
        }
        function cargar_familia($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT familia from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['familia'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para la familia";
            }

            sqlsrv_close($conn);
            return $data;
        }
        function cargar_habitat($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT habitat from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['habitat'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para el hábitat";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_color($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT color from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['color'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para el color";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_area($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT id_area_consv from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $id_area = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $id_area .= $row['id_area_consv'];
            }

            /*if($data === ""){ // file does not exist
                $data = "Error al cargar el nombre";
            }*/

            $sql2 = "SELECT nombre from GestionHongos.dbo.Areas_de_conservacion where id_area = {$id_area}";
            $qry2 = sqlsrv_query($conn, $sql2);
            if ($qry2 === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }

            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry2, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['nombre'];
            }

            if($data === ""){ // file does not exist
                $data = "Error al cargar el nombre del area";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_ubicacion($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT ubicacion from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['ubicacion'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para la ubicación";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_habito($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT habito from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $id_habito = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $id_habito .= $row['habito'];
            }

            /*if($data === ""){ // file does not exist
                $data = "Error al cargar el nombre";
            }*/

            $sql2 = "SELECT nombre from GestionHongos.dbo.Habitos_hongo where id_habito = {$id_habito}";
            $qry2 = sqlsrv_query($conn, $sql2);
            if ($qry2 === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }

            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry2, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['nombre'];
            }

            if($data === ""){ // file does not exist
                $data = "Error al cargar el nombre del habito";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_temporada($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT temporada from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['temporada'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para la temporada";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_clasificacion($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT clasificacion from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $id_clasi = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $id_clasi .= $row['clasificacion'];
            }

            /*if($data === ""){ // file does not exist
                $data = "Error al cargar el nombre";
            }*/

            $sql2 = "SELECT nombre from GestionHongos.dbo.Clasificaciones_hongo where id_clasificacion = {$id_clasi}";
            $qry2 = sqlsrv_query($conn, $sql2);
            if ($qry2 === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }

            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry2, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['nombre'];
            }

            if($data === ""){ // file does not exist
                $data = "Error al cargar el nombre de la clasificación";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_pileo($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT pileo from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['pileo'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para el píleo";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_hime($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT himenoforo from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['himenoforo'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para el himenóforo";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_esti($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT estipite from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['estipite'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para el estípite";
            }

            sqlsrv_close($conn);
            return $data;
        }

        /*function cargar_fecha($id_hongo){
            
        }*/

        function cargar_altura($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT altura_avisto from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['altura_avisto'];
            }

            if($data === ""){ // file does not exist
                $data = "No se registró información para la altitud";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_observacion($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT observacion from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data .= $row['observacion'];
            }

            if($data === ""){ // file does not exist
                $data = "No posee observaciones";
            }

            sqlsrv_close($conn);
            return $data;
        }

        function cargar_icono($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT clasificacion from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $id_clasi = "";
            
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $id_clasi .= $row['clasificacion'];
            }

            /*if($data === ""){ // file does not exist
                $data = "Error al cargar el nombre";
            }*/

            $data = "";
            if($id_clasi === '1'){
                $data .= '../img/Iconos/comestible.png';
            }
            if($id_clasi === '2'){
                $data .= '../img/Iconos/venenoso.png';
            }
            if($id_clasi === '3'){
                $data .= '../img/Iconos/alucinogeno.png';
            }
            if($id_clasi === '4'){
                $data .= '../img/Iconos/medicinal.png';
            }
            if($id_clasi === '5'){
                $data .= '../img/Iconos/desc.png';
            }
            

            sqlsrv_close($conn);
            return $data;
        }
		
		function cargar_fecha($id_hongo){
            $serverName = "35.224.8.47"; //serverName\instanceName
            $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            /*if ($conn) {
                echo "Connection established.<br />";
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(sqlsrv_errors(), true));
            }*/

            $sql = "SELECT fecha_avista from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
            $qry = sqlsrv_query($conn, $sql);
            if ($qry === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
            }
            $data = "";
            while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
                $data = $row['fecha_avista'];
            }
			
            // if($data === ""){ // file does not exist
                // $data = '01-01-1900';
            // }

            sqlsrv_close($conn);
            return $data;
        }
    }
?>