<?php
/// @file registro.php
///  @brief Esta clase sirve para acceder y modificar la 
//  base de datos en la tabla de usuarios
// @author Juan David Diaz y Bruno Conejo
// @date 11/11/2020
class registro{
    var $imagen = 'default_perfil.png';
    var $intentos = 3;
    var $es_admin = 0;
    var $conn;
  
    // FUNCIONES DE LA CLASE
    function __construct(){
  
    }
    function __destruct(){ 
    
    }

/**
* Este metodo permite generar la conexión con la base de datos
* @author Juan David Diaz
* @return intData retorna la conexión
* @date 11/11/2020
*/
    function conectarse(){
        $serverName = "35.224.8.47"; //serverName\instanceName
        $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if ($conn) {
           // echo "Connection established.<br />";
        } else {
            echo "Connection could not be established.<br />";
            die(print_r(sqlsrv_errors(), true));
        }
        $this->conn = $conn;
        return $conn;
    }

/**
* Este metodo verifica si el correo existe, si existe retorna el correo
* sino retorna vacio
* @author Juan David Diaz
* @param String recibe el correo que busca si existe
* @return String  si existe retorna el correo sino retorna vacio
* @date 11/11/2020
*/
    function existe($correo){
        $sql = "SELECT correo from GestionHongos.dbo.Usuarios where correo = '{$correo}'";
        $qry = sqlsrv_query($this->conn, $sql);
        if ($qry === false) {
            echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        }
        $data = '';
        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row['correo'];
        }
        return $data;
    }

/**
* Este metodo registra un nuevo usuario en la tabla de usuarios en la base
* @author Juan David Diaz
* @param String recibe el correo y la contraseña del nuevo usuario
* @date 11/11/2020
*/
    function registrar_nuevo($correo,$password){
        $intentos=3;
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql2 = "INSERT INTO GestionHongos.dbo.Usuarios VALUES ('{$correo}','{$password}',$intentos,'{$this->imagen}',{$this->es_admin})";
        $qry2 = sqlsrv_query($this->conn, $sql2);
        if ($qry2 === false) {
            echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        }
    }
/**
* Este metodo obtiene el id de un usuario con el  correo
* @author Juan David Diaz
* @param String recibe el correo del usuario
* @return intData retorna el id obtenido  
* @date 11/11/2020
*/
    function obtenerId($correo){
        $sql = "SELECT id_usuario from GestionHongos.dbo.Usuarios where correo = '{$correo}'";
        $qry = sqlsrv_query($this->conn, $sql);
        if ($qry === false) {
            echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        }
        $data = '';
        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row['id_usuario'];
        }
        return $data;
    }
/**
* Este metodo obtiene la contraseña de un usuario con el correo
* @author Juan David Diaz
* @param String recibe el correo del usuario
* @return intData retorna la contraseña obtenida  
* @date 11/11/2020
*/
    function obtenerPass($correo){
        $sql = "SELECT contrasena from GestionHongos.dbo.Usuarios where correo = '{$correo}'";
        $qry = sqlsrv_query($this->conn, $sql);
        if ($qry === false) {
            echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        }
        $data = '';
        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row['contrasena'];
        }
        return $data;
    }
/**
* Este metodo obtiene el nombre de la imagen de un usuario con el id
* @author Juan David Diaz
* @param String recibe el id del usuario
* @return intData retorna el nombre de la imagen obtenida  
* @date 11/11/2020
*/
    function obtenerimg($id){
        $sql = "SELECT img_perfil from GestionHongos.dbo.Usuarios where id_usuario = '{$id}'";
        $qry = sqlsrv_query($this->conn, $sql);
        if ($qry === false) {
            echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        }
        $data = '';
        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row['img_perfil'];
        }
        return $data;
    }
/** 
* Este metodo obtiene el correo de un usuario con el id
* @author Juan David Diaz
* @param String recibe el id del usuario
* @return intData retorna el correo obtenido 
* @date 11/11/2020
*/
    function obtenercorreo($id){
        $sql = "SELECT correo from GestionHongos.dbo.Usuarios where id_usuario = '{$id}'";
        $qry = sqlsrv_query($this->conn, $sql);
        if ($qry === false) {
            echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        }
        $data = '';
        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row['correo'];
        }
        return $data;
    }
/** 
* Este metodo obtiene el tipo de usuario de un usuario con el correo
* @author Juan David Diaz
* @param String recibe el correo del usuario
* @return intData retorna el tipo de usuario obtenido 
* @date 11/11/2020
*/
    function es_admin($correo){
        $sql = "SELECT es_admin from GestionHongos.dbo.Usuarios where correo = '{$correo}'";
        $qry = sqlsrv_query($this->conn, $sql);
        if ($qry === false) {
            echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        }
        $data = '';
        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row['es_admin'];
        }
        return $data;
    }
/**
* Este metodo obtiene la contraseña de un usuario con el correo
* @author Juan David Diaz
* @param String recibe el correo del usuario
* @return intData retorna la contraseña obtenida  
* @date 11/11/2020
*/
	function obtener_contraseña($id){
        $sql = "SELECT contrasena from GestionHongos.dbo.Usuarios where id_usuario = '{$id}'";
        $qry = sqlsrv_query($this->conn, $sql);
        if ($qry === false) {
            echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        }
        $data = '';
        while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
            $data .= $row['contrasena'];
        }
        return $data;
    }
/** 
* Este metodo modifica el correo de un usuario 
* @author Juan David Díaz
* @param String recibe el correo nuevo y el id del usuario
* @date 11/11/2020
*/
	function cambiar_correo($id, $correo){
		$sql = "UPDATE GestionHongos.dbo.Usuarios SET correo = '{$correo}' where id_usuario = '{$id}'";
		$qry = sqlsrv_query($this->conn, $sql);
		if ($qry === false) {
			echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
	}
    
/** 
* Este metodo modifica la contraseña de un usuario 
* @author Juan David Díaz
* @param String recibe la contraseña nueva y el id del usuario
* @date 11/11/2020
*/
	function cambiar_contrasena($id, $contrasena){
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
		$sql = "UPDATE GestionHongos.dbo.Usuarios SET contrasena = '{$contrasena}' where id_usuario = '{$id}'";
		$qry = sqlsrv_query($this->conn, $sql);
		if ($qry === false) {
			echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
	}

/** 
* Este metodo modifica la imagen de perfil de un usuario 
* @author Juan David Díaz
* @param String recibe id del usuario
* @date 11/11/2020
*/
	function cambiar_imagen($id){
		if (isset($_POST['confDatos'])) {
			$archivo = $_FILES['nueva_img_perfil']['name'];
			if (isset($archivo) && $archivo != "") {
				$tipo = $_FILES['nueva_img_perfil']['type'];
				$tamano = $_FILES['nueva_img_perfil']['size'];
				$temp = $_FILES['nueva_img_perfil']['tmp_name'];
				if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) /*&& ($tamano < 2000000)*/ )) {
					$_SESSION["estado_cambio_perfil"] = $_SESSION["estado_cambio_perfil"]."Error. La extensión de los archivos no es correcta, se permiten archivos .gif, .jpg, .png.<br/>";
				}
				else {
					if (move_uploaded_file($temp, '../img/UserProfile/'.$id.'_'.$archivo)) {	//Se subió la imagen correctamente
						chmod('../img/UserProfile/'.$archivo, 0777);
						$imgVieja = $this->obtenerimg($id);
						
						$sql = "UPDATE GestionHongos.dbo.Usuarios SET img_perfil = '{$id}_{$archivo}' where id_usuario = '{$id}'";
						$qry = sqlsrv_query($this->conn, $sql);
						if ($qry === false) {
							$_SESSION["estado_cambio_perfil"] = $_SESSION["estado_cambio_perfil"]."Error, al actualizar la imagen.<br/>";
							echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
						}
						else {
							$_SESSION["estado_cambio_perfil"] = $_SESSION["estado_cambio_perfil"]."Se actualizó la imagen de perfil.<br/>";
							if($imgVieja !== 'default_perfil.png'){	//Borrar la imagen anterior
								unlink('../img/UserProfile/'.$imgVieja);
							}
						}
					}
					else {
						$_SESSION["estado_cambio_perfil"] = $_SESSION["estado_cambio_perfil"]."Error, al subir la imagen.<br/>";
					}
				}
			}
		}
	}
}
?>