<?php
	/**
	* @file modificar_usuario.php
	*
	* @author Bruno Alejandro Conejo Soto, Grupo Gestión de Hongos
	*
	* @brief Maneja el cambio de la información de perfil de un usuario,
	* cambiando solo lo que el usuario desea.
	*/
	require_once 'registro.php';
	require_once 'usuario.php';
	session_start();
	
	/**
	* Este método utiliza las variables globales $_SESSION y $_POST para
	* aceptar o no cambios en la cuenta de un usuario.
	* 
	* @author Bruno Alejandro Conejo Soto, Grupo Gestión de Hongos
	*
	* @returns Sin valor de retorno.
	* @param No requiere parámetros.
	*/
	function modificar_usuario_administrador(){
		$usuario = new usuario();
		if ($_POST["accion"] == 0){		//Ascender o degradar
			if($_POST["permisosUsuario"] == 0){	
				$usuario->set_es_admin($_POST["id_usuario"], 1);
			}
			if($_POST["permisosUsuario"] == 1){
				$usuario->set_es_admin($_POST["id_usuario"], 0);
			}
		}
		if ($_POST["accion"] == 1){		//Eliminar al usuario
			$registro = new registro();
			$conn = $registro->conectarse();
			$imgPerfil = $registro->obtenerimg($_POST["id_usuario"]);
			$usuario->eliminar_usuario($conn, $_POST["id_usuario"], $imgPerfil);
			sqlsrv_close($conn);
		}

		header('Location: ../paginas/administracion.php');
        die();
    }
	
    modificar_usuario_administrador();
?>
