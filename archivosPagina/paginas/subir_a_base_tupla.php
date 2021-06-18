
<!DOCTYPE html>
<html lang="es"> 
<head>
		<link  rel="icon"   href="../img/mushroom.svg" type="image/png" /> 
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="author" content="Grupo Gestion de Hongos"/>
		<meta name="keywords" content="hongos, wiki, gestion"/>
		<meta name="generator" content="Grupo Gestion de Hongos" />
		<title>Gestion de Hongos</title>
		<!-- <link href="css/screenV3.css" rel="stylesheet"/> -->
	</head>   
	<body style="background-color: #FFF2CC; overflow-x: hidden"> 
		<header id="encabezado_sitio" class="page-header" style="background-color:#F8CECC">
        
		</header>
		<div style="background-color:#F8CECC">
		  <nav class="navbar navbar-expand-lg navbar-light a:hover" style="background-color:#F8CECC">
			<a class="navbar-brand" href="../index.php">
			<img id="site_logo" src="../img/mushroom.svg" alt="Logo del sitio" style="" width="30" height="30" class="d-inline-block align-top" alt="">
			  Hongopedia
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item ">
						<a class="nav-link" href="../index.php">Inicio <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item ">
						<a class="nav-link hover"href="buscar.php">Buscar</a>
					</li>
					
					<!-- <ul class="nav nav-pills"  style="background-color: white">
						<li class="nav-item"><a href="index.php" class="nav-link active">Inicio</a></li>
						<li class="nav-item"><a href="paginas/buscar.php" class="nav-link ">Buscar</a></li> -->
					<?php
            session_cache_limiter('private_no_expire'); // para que no se tenga que confirmar el envio de formulario manualment
						session_start();
						error_reporting(0); /* Para que no reporte el error cuando $_SESSION["tipo_usuario"] == NULL al entrar la primera vez */
						if ($_SESSION["tipo_usuario"] == NULL){
							$_SESSION["tipo_usuario"] = 1;
						}

						if ($_SESSION["tipo_usuario"] == 1 ){	/* Aportar */
							echo "<li class='nav-item'><a href=# class='nav-link disabled'>Aportar</a></li>";
						}
						else{
							echo "<li class='nav-item active'><a href=\"aportar.php\" class='nav-link '>Aportar</a></li>";
						}
						
						if ($_SESSION["tipo_usuario"] == 1 ){	/* Cuenta */
							echo "<li class='nav-item'><a href=\"cuenta.php\" class='nav-link '>Cuenta</a></li>" ;
						}
						else {
							echo "<li class='nav-item'><a href=\"informacionUsuario.php\" class='nav-link '>Cuenta</a></li>";
						}
					?>
					<li class='nav-item'>
						<a href="acerca.php" class='nav-link '>Acerca de</a>
					</li>
					<?php
						if ($_SESSION["tipo_usuario"] == 3 ){	/* Administrar hongos es solo para administradores */
							echo "<li class='nav-item'><a href=\"administracion.php\" class='nav-link '>Administración</a></li>" ;
						}
					?>
				</ul>
			</div>
		</div>
	    </nav>

<?php
session_start();
error_reporting(0); 
require_once 'model.php';

//instancia
//$_SESSION["id_usuario"]


if (($_POST["nombre_cientifico_aportadoADM"] != "") || ($_POST["nombre_vulgar_aportadoADM"]!="")) {

    $model =new Model();

    if ($_SESSION["tipo_usuario"] == 3 ){

        $model->tupla_aceptada=1;//si la tupla fue aceptada como informacion valida
    }else{
        $model->tupla_aceptada=0;//si no ha sido validada aun

    }
    

    $model->id_user=$_SESSION["id_usuario"] ; //id de la fuente que agrega la informacion,esta por defecto que la persona con id 1 es la que agrega

    $model->nom_cientifico=$_POST["nombre_cientifico_aportadoADM"];
    $model->nom_vulgar=$_POST["nombre_vulgar_aportadoADM"];
    $model->familia=$_POST["familia_aportadoADM"];
    $model->habitat=$_POST["hábitat_aportadoADM"];
    $model->color=$_POST["color_aportadoADM"];
    $model->area=$_POST["area_de_conservacion_aportadoADM"];
    $model->habito=$_POST["habito_aportadoADM"];
    $model->ubicacion=$_POST["ubicacion_aportadoADM"];
    $model->temporada=$_POST["temporada_aportadoADM"];
    $model->clasificacion=$_POST["clasificación_aportadoADM"];
    $model->pileo=$_POST["pileo_aportadoADM"];
    $model->himeonoforo=$_POST["himenoforo_aportadoADM"];
    $model->estipite=$_POST["estipite_aportadoADM"];
    $model->fecha=$_POST["fecha_del_avistamiento_aportadoADM"];
    $model->altura=$_POST["altura_del_avistamiento_aportadoADM"];
    $model->observacion=$_POST["observaciones_aportadoADM"];
    
    
    $ruta_img_sup="";
    $ruta_img_inf="";
    $ruta_img_lat="";
    $ruta_img_mano="";
    
    
    $prefijo=$model->GenereNombreAleatorio(6)."_";
    //inicio prueba subir imagen
    //Comprobamos que no este vacio nuestro input file.
    if (file_exists($_FILES['imagen_superior_aportadoADM']['tmp_name'])) {
        $ruta_img_sup=brindeRutaImagen($prefijo, "sup_", 'imagen_superior_aportadoADM');
        echo "<img src=$ruta_img_sup border='0' width='300' height='100'>"; //imprime la imagen en el php
    }

    if (file_exists($_FILES['imagen_inferior_aportadoADM']['tmp_name'])) {
        $ruta_img_inf=brindeRutaImagen($prefijo, "inf_", 'imagen_inferior_aportadoADM');
        echo "<img src=$ruta_img_inf border='0' width='300' height='100'>"; //imprime la imagen en el php
    }

    if (file_exists($_FILES['imagen_lateral_aportadoADM']['tmp_name'])) {
        $ruta_img_lat=brindeRutaImagen($prefijo, "lat_",'imagen_lateral_aportadoADM');
        echo "<img src=$ruta_img_lat border='0' width='300' height='100'>"; //imprime la imagen en el php
    }
    

    if (file_exists($_FILES['imagen_relacion_mano-hongo_aportadoADM']['tmp_name'])) {
        $ruta_img_mano=brindeRutaImagen($prefijo, "mano_",'imagen_relacion_mano-hongo_aportadoADM');
        echo "<img src=$ruta_img_mano border='0' width='300' height='100'>"; //imprime la imagen en el php
    }
    
    
    //fin prueba subir imagen
    
    $model->img_sup=$ruta_img_sup;//$_POST["imagen_superior_aportadoADM"];
    $model->img_inf=$ruta_img_inf;//$_POST["observaciones_aportadoADM"];
    $model->img_lat=$ruta_img_lat;//$_POST["observaciones_aportadoADM"];
    $model->img_mano=$ruta_img_mano;//$_POST["observaciones_aportadoADM"];
    
    
    $res=$model->Aporte();

    
    header("refresh:4;url=http://hongopedia.me/paginas/aportar.php");
    
    
    
}else{

    echo "<h2>Incorrecto: No aportó nombre cientifico ni nombre vulgar</h2>";
    echo "<h3>Redireccionando a la pestaña anterior...</h3>";
    
    header("refresh:4;url=http://hongopedia.me/paginas/aportar.php");

}



function brindeRutaImagen($pref, $tipo, $nom_archivo){
    $carpeta="";
    //Definido y no NULL nuestro formulario.
    
    //obtenemos datos imagen.
    $file = $_FILES[$nom_archivo];
    $nombre_img = $file["name"];            
    $extencion_img = $file["type"];
    $ruta_temporal = $file["tmp_name"];
    $tamano_img = $file["size"];
    $dimensiones = getimagesize($ruta_temporal);
    $ancho = $dimensiones[0];
    $altura = $dimensiones[1];
    $carpeta = "/imgs/$nombre_img";
    //echo ('Tengo el archivo ');
    //echo ($extencion_img);

    //echo '<pre>';
    //print_r($_FILES);
    //echo '</pre>';


    $img_error = true;

    //Comprobaciones error (¡Esto es a gusto colores!).
    if ($extencion_img != 'image/jpeg' && $extencion_img != 'image/jpg' && $extencion_img != 'image/png' && $extencion_img != 'image/gif') {
        echo "<b>$nombre_img</b>, no es una imagen valido, un imagen con extensión valido podría ser entre (.jpg, .jpeg, .png o .gif).";                      
    } else { //Imagen correcto.
        //Reseteo error en false.       
        $img_error = false;
    }

    $carpeta="../img/HongosBaseDatos/";
    $nombre_img= $pref.$tipo.$nombre_img;
    $carpeta=$carpeta.$nombre_img;
    //Verdadero imagen.
    if ($nombre_img && $img_error===false) {
        //Cargamos imagen al servidor.
        if(move_uploaded_file($ruta_temporal,"../img/HongosBaseDatos/".$nombre_img)) { 
            echo "Foto subida correctamente";          
        } else { //Falso, imagen no cargo.          
            echo "No se pudo guardar la foto.";   
            echo "Not uploaded because of error #".$_FILES["file"]["error"];
        }
    }

    return $carpeta;
}



?> 
</body>
</html>