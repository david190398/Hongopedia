<?php
class clasificaciones {
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
    /*if ($conn) {
      echo "Connection established.<br />";
  } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
  }*/
    $sql = "select nombre from GestionHongos.dbo.Clasificaciones_hongo where id_clasificacion = {$id}";
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
    /*if ($conn) {
      echo "Connection established.<br />";
    } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
    }*/
    $sql = "update GestionHongos.dbo.Clasificaciones_hongo set nombre = '{$nombre}' where id_clasificacion = {$id}";
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
    /*if ($conn) {
      echo "Connection established.<br />";
    } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
    }*/
    $sql = "insert into GestionHongos.dbo.Clasificaciones_hongo values ('{$nombre}')";
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
    /*if ($conn) {
      echo "Connection established.<br />";
    } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
    }*/
    $sql = "delete from GestionHongos.dbo.Clasificaciones_hongo Where id_clasificacion = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }
}
?>