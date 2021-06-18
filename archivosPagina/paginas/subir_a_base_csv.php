
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
					<li class="nav-item active">
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
							echo "<li class='nav-item'><a href=\"aportar.php\" class='nav-link '>Aportar</a></li>";
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
//phpinfo();


require_once 'model.php';


if (file_exists($_FILES['csv_aportadoADM']['tmp_name'])) {
    


    $model =new Model();

    if ($_SESSION["tipo_usuario"] == 3 ){

      $model->tupla_aceptada=1;//si la tupla fue aceptada como informacion valida
    }else{
      $model->tupla_aceptada=0;//si no

  }
    $model->id_user=$_SESSION["id_usuario"] ; //id de la fuente que agrega la informacion,esta por defecto que la persona con id 1 es la que agrega
    $model->archivo_csv=$model->GenereNombreAleatorio(6);
    $model->ruta="csv/";

    //echo($model->GenereNombreAleatorio(6));
    $model->Aporte_csv();
    header("refresh:4;url=http://hongopedia.me/paginas/aportar.php");

}else {
  
    echo "<h2>Incorrecto: No aporto archivo</h2>";
      
      header("refresh:0;url=http://hongopedia.me/paginas/aportar.php");



}



/*
$serverName = "35.224.8.47"; //serverName\instanceName
$connectionInfo = array( "Database"=>"GestionHongos", "UID"=>"sqlserver", "PWD"=>"honguit0s");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
  echo "Connection established.<br />";
}else{
  echo "Connection could not be established.<br />";
  die( print_r( sqlsrv_errors(), true));
}
sqlsrv_close( $conn );
*/
?>

</body>
</html>