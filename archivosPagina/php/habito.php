<?php
class habito {
  // VARIABLES DE LA CLASE
  var $id;
  var $nombre;
  
  // FUNCIONES DE LA CLASE
  function __construct(){

  }
  function __destruct(){ 
  
  }

  // METODO GET
  function get_nombre($id){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $sql = "SELECT nombre from GestionHongos.dbo.Habitos_hongo where id_habito = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    $data = '';
    while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
      $data .= $row['nombre'];
    }
    sqlsrv_close($conn);
    return $data;
  }

  // METODO SET
  function set_nombre($id,$nombre){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $sql = "UPDATE GestionHongos.dbo.Habitos_hongo SET nombre = '{$nombre}' where id_habito = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }

  function insertar_nuevo($nombre) {
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $sql = "INSERT INTO GestionHongos.dbo.Habitos_hongo VALUES ('{$nombre}')";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }

  function eliminar($id) {
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $sql = "DELETE FROM GestionHongos.dbo.Habitos_hongo Where id_habito = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }
}
?>