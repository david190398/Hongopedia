<?php
class usuario {
  // VARIABLES DE LA CLASE
  var $id;
  var $contrasena;
  var $correo;
  var $imagen;
  var $intentos = 3;
  var $es_admin;

  // FUNCIONES DE LA CLASE
  function __construct(){

  }
  function __destruct(){ 
  
  }

  // METODOS GET
  function get_correo($id){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
  } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
  }*/
    $sql = "SELECT correo from GestionHongos.dbo.Usuarios where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    $data = '';
    while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
      $data .= $row['correo'];
    }
    sqlsrv_close($conn);
    return $data;
  }

  function get_contrasena($id){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
  } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
  }*/
    $sql = "SELECT contrasena from GestionHongos.dbo.Usuarios where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    $data = '';
    while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
      $data .= $row['contrasena'];
    }
    sqlsrv_close($conn);
    return $data;
  }

  function get_imagen($id){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
  } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
  }*/
    $sql = "SELECT img_perfil from GestionHongos.dbo.Usuarios where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    $data = '';
    while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
      $data .= $row['img_perfil'];
    }
    sqlsrv_close($conn);
    return $data;
  }

  function get_intentos($id){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
  } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
  }*/
    $sql = "SELECT intentos from GestionHongos.dbo.Usuarios where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    $data = '';
    while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
      $data .= $row['intentos'];
    }
    sqlsrv_close($conn);
    return $data;
  }

  function get_es_admin($id){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
  } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
  }*/
    $sql = "SELECT es_admin from GestionHongos.dbo.Usuarios where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    $data = '';
    while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
      $data .= $row['es_admin'];
    }
    sqlsrv_close($conn);
    return $data;
  }

  // METODOS SET
  function set_contrasena($id,$contrasena){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
    } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
    }*/
    $sql = "UPDATE GestionHongos.dbo.Usuarios SET contrasena = '{$contrasena}' where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }

  function set_intentos($id,$intentos){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
    } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
    }*/
    $sql = "UPDATE GestionHongos.dbo.Usuarios SET intentos = '{$intentos}' where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }

  function set_imagen($id,$imagen){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
    } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
    }*/
    $sql = "UPDATE GestionHongos.dbo.Usuarios SET img_perfil = '{$imagen}' where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }

  function set_es_admin($id,$es_admin){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
    } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
    }*/
    $sql = "UPDATE GestionHongos.dbo.Usuarios SET es_admin = '{$es_admin}' where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }

  function set_correo($id,$correo){
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
    } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
    }*/
    $sql = "UPDATE GestionHongos.dbo.Usuarios SET correo = '{$correo}' where id_usuario = {$id}";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }

  function insertar_nuevo($contrasena,$correo,$imagen,$es_admin) {
    $serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    /*if ($conn) {
      echo "Connection established.<br />";
    } else {
      echo "Connection could not be established.<br />";
      die(print_r(sqlsrv_errors(), true));
    }*/
    $intentos=3;
    $sql = "INSERT INTO GestionHongos.dbo.Usuarios VALUES ('{$correo}','{$contrasena}',$intentos,'{$imagen}','{$es_admin}')";
    $qry = sqlsrv_query($conn, $sql);
    if ($qry === false) {
      echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
    }
    sqlsrv_close($conn);
  }
  
	function eliminar_usuario($conn, $id , $imgPerfil) {
		$sql = "UPDATE GestionHongos.dbo.Usuarios SET correo = '{$id}_eliminado' where id_usuario = {$id}";
		$qry = sqlsrv_query($conn, $sql);
		if ($qry === false) {
		  echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
		
		if($imgPerfil !== 'default_perfil.png'){		//Borrar la imagen de perfil
			unlink('../img/UserProfile/'.$imgPerfil);
		}

		$sql2 = "UPDATE GestionHongos.dbo.Usuarios SET img_perfil = 'default_perfil.png' where id_usuario = {$id}";
		$qry2 = sqlsrv_query($conn, $sql2);
		if ($qry2 === false) {
			echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
		
		$sql3 = "UPDATE GestionHongos.dbo.Usuarios SET contrasena = 'dead' where id_usuario = {$id}";
		$qry3 = sqlsrv_query($conn, $sql3);
		if ($qry3 === false) {
		  echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
	}

}
?>