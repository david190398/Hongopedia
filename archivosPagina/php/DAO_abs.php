<?php
class DAO_abs {
    function __construct(){

    }

    function __destruct(){

    }

    function get_abs($valor_conocido,$nombre_tabla,$dato_atributo,$columna_comparador){
      $serverName = "35.224.8.47"; //serverName\instanceName
      $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
      $conn = sqlsrv_connect($serverName, $connectionInfo);
      $sql = "SELECT {$dato_atributo} from GestionHongos.dbo.{$nombre_tabla} where {$columna_comparador} = {$valor_conocido}";
      $qry = sqlsrv_query($conn, $sql);
      if ($qry === false) {
        echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
      }
      $data = '';
      if($dato_atributo != "fecha_avista"){
        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row[$dato_atributo];
            }

      }else{

        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row[$dato_atributo]->format('Y-m-d');
        }
      }
      sqlsrv_close($conn);
      return $data;
    }

    function set_abs($valor_conocido,$nombre_tabla,$dato_atributo,$columna_comparador,$nuevo_dato){
      $serverName = "35.224.8.47"; //serverName\instanceName
      $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
      $conn = sqlsrv_connect($serverName, $connectionInfo);
      /*if ($conn) {
        echo "Connection established.<br />";
        } else {
        echo "Connection could not be established.<br />";
        die(print_r(sqlsrv_errors(), true));
        }*/
      $sql = "UPDATE GestionHongos.dbo.{$nombre_tabla} SET {$dato_atributo} = '{$nuevo_dato}' where {$columna_comparador} = {$valor_conocido}";
      $qry = sqlsrv_query($conn, $sql);
      if ($qry === false) {
        echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
      }
      sqlsrv_close($conn);
    }

    function inserte_abs($parametros,$nombre_tabla) {
      $serverName = "35.224.8.47"; //serverName\instanceName
      $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
      $conn = sqlsrv_connect($serverName, $connectionInfo);
      $sql = "INSERT INTO GestionHongos.dbo.{$nombre_tabla} VALUES ({$parametros})";
      $qry = sqlsrv_query($conn, $sql);
      if ($qry === false) {
        echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
      }
      sqlsrv_close($conn);
    }

    function elimine_abs($id,$nombre_tabla,$id_sql) {
      $serverName = "35.224.8.47"; //serverName\instanceName
      $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
      $conn = sqlsrv_connect($serverName, $connectionInfo);
      $sql = "DELETE FROM GestionHongos.dbo.{$nombre_tabla} Where {$id_sql} = {$id}";
      $qry = sqlsrv_query($conn, $sql);
      if ($qry === false) {
        echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
      }
      sqlsrv_close($conn);
    }
}
?>
