<?php
	/**
	* @file modificar_tupla_hongo.php
	*
	* @author Bruno Alejandro Conejo Soto, Grupo Gestión de Hongos
	*
	* @brief Clase que maneja el cambio de la información de un hongo.
	*/
	class modif_hongo{
		var $conn;
		
		function __construct(){
	  
		}
		function __destruct(){ 
		
		}
		
		/**
		* Este método utiliza las variables globales $_GET y $_POST para
		* actualizar los datos de un hongo en la base de datos.
		* 
		* @author Bruno Alejandro Conejo Soto, Grupo Gestión de Hongos
		*
		* @returns Sin valor de retorno.
		* @param No requiere parámetros.
		*/
		function modificar_info_hongo(){
			session_start();
			$_SESSION["estado_modificar_tupla_hongo"] = "";
			$conn = $this->conectarse_a_BD();
			
			$this->set_dato('tupla_valida', $_POST["tupla_valida_modificar"], $_POST['id_hongo']);
			$this->set_dato('nomb_cient', $_POST["nombre_cientifico_modificar"], $_POST['id_hongo']);
			$this->set_dato('nomb_vulgar', $_POST["nombre_vulgar_modificar"], $_POST['id_hongo']);
			
			$this->set_dato('familia', $_POST["familia_modificar"], $_POST['id_hongo']);
			$this->set_dato('habitat', $_POST["habitat_modificar"], $_POST['id_hongo']);
			$this->set_dato('ubicacion', $_POST["ubicacion_modificar"], $_POST['id_hongo']);
			$this->set_dato('color', $_POST["color_modificar"], $_POST['id_hongo']);
			$this->set_dato('temporada', $_POST["temporada_modificar"], $_POST['id_hongo']);
			
			$this->set_dato('habito', $_POST["habito_modificar"], $_POST['id_hongo']);
			$this->set_dato('id_area_consv', $_POST["area_de_conservacion_modificar"], $_POST['id_hongo']);
			$this->set_dato('clasificacion', $_POST["clasificacion_modificar"], $_POST['id_hongo']);
			
			$this->set_dato('pileo', $_POST["pileo_modificar"], $_POST['id_hongo']);
			$this->set_dato('estipite', $_POST["estipite_modificar"], $_POST['id_hongo']);
			$this->set_dato('himenoforo', $_POST["himenoforo_modificar"], $_POST['id_hongo']);
			
			$this->set_dato('fecha_avista', $_POST["fecha_del_avistamiento_modificar"], $_POST['id_hongo']);
			$this->set_dato('altura_avisto', $_POST["altura_del_avistamiento_modificar"], $_POST['id_hongo']);
			$this->set_dato('observacion', $_POST["observaciones_modificar"], $_POST['id_hongo']);
			
				
			//Imágenes
			$this->cambiar_imagen('superior', $_POST['id_hongo']);
			$this->cambiar_imagen('inferior', $_POST['id_hongo']);
			$this->cambiar_imagen('lateral', $_POST['id_hongo']);
			$this->cambiar_imagen('mano_hongo', $_POST['id_hongo']);


			$_SESSION["estado_modificar_tupla_hongo"] = $_SESSION["estado_modificar_tupla_hongo"]."Se actualizaron los datos del hongo";
			
			header('Location: ../paginas/administrar_hongo.php?id_hon='.$_POST['id_hongo']);
			sqlsrv_close($conn);
			die();
		}
		
		/**
		* Este método conecta con una la base de datos del Hongopedia.
		* 
		* @author Grupo Gestión de Hongos
		*
		* @returns $conn : la conexión con la base de datos.
		* @param No requiere parámetros.
		*/
		function conectarse_a_BD(){
			$serverName = "35.224.8.47"; //serverName\instanceName
			$connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
			$conn = sqlsrv_connect($serverName, $connectionInfo);
			if ($conn) {
			   // echo "Connection established.<br />";
			} else {
				echo "No se pudo establecer la conexión.<br />";
				die(print_r(sqlsrv_errors(), true));
			}
			$this->conn = $conn;
			return $conn;
		}
		
		/**
		* Este método realiza un "update" en la tabla Hongos en el
		* atributo epecificado en $nom_colum para un hongo específico.
		* 
		* @author Bruno Alejandro Conejo Soto, Grupo Gestión de Hongos
		*
		* @returns Sin valor de retorno.
		*
		* @param $nom_colum : el atributo/columna a cambiar.
		* @param $dato_nuevo : el nuevo valor que se guardará.
		* @param $id_hongo : el hongo específico al que se le realizará el cambio.
		*/
		function set_dato($nom_colum, $dato_nuevo, $id_hongo){
			$sql = "update GestionHongos.dbo.Hongos set {$nom_colum} = '{$dato_nuevo}' where id_hongo = {$id_hongo}";
			$qry = sqlsrv_query($this->conn, $sql);
			if ($qry === false) {
				echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
			}
		}
		
		/**
		* Este método obtiene el nombre de una imagen guardado
		* en la base de datos.
		* 
		* @author Grupo Gestión de Hongos
		*
		* @returns El nombre de la imagen.
		*
		* @param $tipo_img : el nombre del atributo de la imagen a buscar (img_sup, img_lat, etc.)
		* @param $id_hongo : el hongo específico del cual se busca obtener su imagen.
		*/
		function obtenerimg($tipo_img, $id_hongo){
			$sql = "select {$tipo_img} from GestionHongos.dbo.Hongos where id_hongo = {$id_hongo}";
			$qry = sqlsrv_query($this->conn, $sql);
			if ($qry === false) {
				echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
			}
			$data = '';
			while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
				$data .= $row[$tipo_img];
			}
			return $data;
		}
		
		/**
		* Sube una imagen al servidor, borra la anterior (si existe) y actualiza un campo
		* de atributo específico en la base de datos.
		* 
		* @author Bruno Alejandro Conejo Soto, Grupo Gestión de Hongos
		*
		* @returns Sin valor de retorno.
		*
		* @param $imagen : el tipo de la imagen a guardar (superior, lateral, inferior o mano_hongo)
		* @param $id_hongo : el hongo específico al cual se busca actualizarle una imagen.
		*/
		function cambiar_imagen($imagen, $id_hongo){
			if (isset($_POST['boton_modificar_tupla'])) {
				$archivo = $_FILES[$imagen]['name'];
				if (isset($archivo) && $archivo != "") {
					$tipo = $_FILES[$imagen]['type'];
					$tamano = $_FILES[$imagen]['size'];
					$temp = $_FILES[$imagen]['tmp_name'];
					if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) /*&& ($tamano < 2000000)*/ )) {
						$_SESSION["estado_modificar_tupla_hongo"] = $_SESSION["estado_modificar_tupla_hongo"]."Error. La extensión de los archivos no es correcta, se permiten archivos .gif, .jpg, .png.<br/>";
					}
					else {
						$imgVieja = $this->obtenerimg($tipo_img, $id_hongo);
						if($imgVieja !== ""){	//Borrar la imagen anterior
							unlink($imgVieja);
						}
						$nombre_archivo = '../img/HongosBaseDatos/'.$_POST['id_hongo'].'_'.$imagen.'_'.$archivo;
						if (move_uploaded_file($temp, $nombre_archivo)) {	//Se subió la imagen correctamente
							chmod($nombre_archivo, 0777);
							
							$tipo_img = '';
							if($imagen == 'superior'){
								$tipo_img = 'img_sup';
							}
							else {
								if($imagen == 'inferior'){
									$tipo_img = 'img_inf';
								}
								else{
									if($imagen == 'lateral'){
										$tipo_img = 'img_lat';
									}
									else{
										if($imagen == 'mano_hongo'){
											$tipo_img = 'img_mano_hongo';
										}
									}
								}
							}
							
							$sql = "UPDATE GestionHongos.dbo.Hongos SET {$tipo_img} = '{$nombre_archivo}' where id_hongo = {$id_hongo}";
							$qry = sqlsrv_query($this->conn, $sql);
							if ($qry === false) {
								$_SESSION["estado_modificar_tupla_hongo"] = $_SESSION["estado_modificar_tupla_hongo"]."Error, al actualizar la imagen.<br/>";
								echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
							}
						}
						else {
							$_SESSION["estado_modificar_tupla_hongo"] = $_SESSION["estado_modificar_tupla_hongo"]."Error, al subir la imagen.<br/>";
						}
					}
				}
			}
		}
	}

	$mod_hong = new modif_hongo();
    $mod_hong->modificar_info_hongo();
?>
