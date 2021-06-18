<?php
	/**
	* @file cambiarInfoUsuario.php
	*
	* @author Bruno Alejandro Conejo Soto, Grupo Gestión de Hongos
	*
	* @brief Maneja el cambio de la información de perfil de un usuario,
	* cambiando solo lo que el usuario desea.
	*/
	require_once 'registro.php';
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
	function modificar_perfil(){
		$registro = new registro();
		$conn = $registro->conectarse();
		
		if (password_verify($_POST["passwordA"], $registro->obtener_contraseña($_SESSION["id_usuario"]))){	//Confirmar que la constraseña actual es correcta
			//Correo
			if ($_POST["nuevo_correo"] !== ""){
				$data = $registro->existe($_POST["nuevo_correo"]);
				if($data !== "") {
					//Correo ya existente
					$_SESSION["estado_cambio_perfil"] = "El correo ya está registrado.<br/>";
				}
				else {	//Puedo cambiar correo
					$registro->cambiar_correo($_SESSION["id_usuario"], $_POST["nuevo_correo"]);
					$_SESSION["estado_cambio_perfil"] = "Se actualizó el correo.<br/>";
				}
			}
			
			//Contraseña
			if ($_POST["passwordN"] !== ""){
				if ($_POST["passwordN"] === $_POST["password"]){
					if ($_POST["passwordN"] === $_POST["passwordA"]){
						//Misma contraseña
						$_SESSION["estado_cambio_perfil"] = $_SESSION["estado_cambio_perfil"]."La nueva contraseña es igual a la actual.<br/>";
					}
					else{
						//Nueva contraseña
						$registro->cambiar_contrasena($_SESSION["id_usuario"], $_POST["passwordN"]);
						$_SESSION["estado_cambio_perfil"] = $_SESSION["estado_cambio_perfil"]."Se actualizó la contraseña.<br/>";
					}
				}
			}
			
			//Imagen
			if($_POST["nueva_img_perfil"] !== ""){
				$registro->cambiar_imagen($_SESSION["id_usuario"]);
			}
		}
		else{
			$_SESSION["estado_cambio_perfil"] = "Contraseña actual incorrecta.<br/>";
		}
		if( $_SESSION["esGoogle"] === 1){
			if($_POST["nueva_img_perfil"] !== ""){
				$registro->cambiar_imagen($_SESSION["id_usuario"]);
			}
		}
		header('Location: ../paginas/informacionUsuario.php');
        sqlsrv_close($conn);
        die();
    }
	
    modificar_perfil();
?>
