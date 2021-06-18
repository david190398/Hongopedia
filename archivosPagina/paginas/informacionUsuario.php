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
    <link href="../css/agrandar_fotos.css" rel="stylesheet"/>
		<!-- <link href="css/screenV3.css" rel="stylesheet"/> -->
	</head>    
  <body style="background-color: #FFF2CC; overflow-x: hidden"> 
		<header id="encabezado_sitio" class="page-header" style="background-color:#F8CECC">
        
		</header>
		<div style="background-color:#F8CECC">
		  <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#F8CECC">
			<a class="navbar-brand" href="../index.php">
			<img id="site_logo" src="../img/mushroom.svg" alt="Logo del sitio" style="" width="30" height="30" class="d-inline-block align-top" alt="">
			  Hongopedia
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
            <a class="nav-link" href="../index.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
						<a class="nav-link"href="buscar.php">Buscar</a>
					</li>
			<?php
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
          echo "<li class='nav-item active'><a href=\"informacionUsuario.php\" class='nav-link '>Cuenta</a></li>" ;
        }
        else {
          echo "<li class='nav-item active'><a href=\"informacionUsuario.php\" class='nav-link '>Cuenta</a></li>";
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
	<main>
  <div class="row">
  
  <div id="cuenta" class="col-md-1">
  
  </div>
    <div id="cuenta" class="col-md-5">
      <?php
       if($_SESSION["id_usuario"] === NULL){
        echo "cliente google".$_SESSION["id_usuario"];
       }
		require_once '../../vendor/autoload.php';
        require_once 'config.php';
        require_once '../php/registro.php';
        session_start();
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");
        
        if (isset($_GET['code'])) {
          echo "<p>es cliente de afuera del if</p>";
          $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
          $client->setAccessToken($token['access_token']);
          
          // get profile info
          $google_oauth = new Google_Service_Oauth2($client);
          $google_account_info = $google_oauth->userinfo->get();
          $email =  $google_account_info->email;
          $name =  $google_account_info->name;
          
          // Estos datos son los que obtenemos....	
          echo $email .'<br>';
          echo $name ;
          $registro = new registro();
          $conn = $registro->conectarse();
          $data = $registro->existe($email);
          if($data !== "") {
              $_SESSION["id_usuario"] = $registro->obtenerId($email);
              if($registro->es_admin($email)){
                $_SESSION["tipo_usuario"] = 3;
              }else{
                $_SESSION["tipo_usuario"] = 2;
              }
              header('Location: ../paginas/informacionUsuario.php');
          } else {
              $registro->registrar_nuevo($email,$name);
              $_SESSION["id_usuario"] = $registro->obtenerId($email);
              $_SESSION["tipo_usuario"] = 2;
              header('Location: ../paginas/informacionUsuario.php');
          }
          sqlsrv_close($conn);
          die();
      }
    ?>
        <?php
         session_start();
        
          $id =$_SESSION["id_usuario"];
          require_once '../php/registro.php';
          $registro = new registro();
          $conn = $registro->conectarse();
          $perfil = $registro->obtenerimg($id);
          $correo = $registro->obtenercorreo($id);
          if($_SESSION["esGoogle"] === 1){
            $cambia = "disabled";
            $requerido="";
          }else{
            $cambia = "";
            $requerido="required";
          }
        ?>
        <br>
        <blockquote class="blockquote text-center">
        <div ><h4>Mi cuenta</h4></div>
        </blockquote>
        <div class="row">
       
          <div class="col-md-4">
            <img id="site_logo" class="rounded" src="../img/UserProfile/<?php echo $perfil ?>" alt="img_perfil" width="155" height="105"/>
          </div>
          <div class="col-md-5">
          <blockquote class="blockquote text-center">
          <p class="mb-0">¡Bienvenido!</p>  <?php echo $correo ?>
          </blockquote>
          </div>
        </div>
        <br>
        
        <div ><h5>Modificar perfil</h5></div>
      <?php
       if($_SESSION["esGoogle"] === 1) {
         echo "<p>Los usuarios registrados con google solo pueden modificar la imagen del perfil<br></p>";
       }
      ?>
			<form action="../php/cambiarInfoUsuario.php" method="post" enctype="multipart/form-data">

      <p>
      <button class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Cambiar datos de mi perfil
      </button>
      </p>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <div class="form-group">
          <label for="correo">Cambiar Correo:</label>
          <input type="text" id="nuevo_correo" name="nuevo_correo" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese correo"   <?php echo $cambia ?>>
          <small id="emailHelp" class="form-text text-muted">Ingrese el correo que desea registrar.</small>
        </div>
        <p> Cambiar imagen de perfil <input type="file" id="nueva_img_perfil" name="nueva_img_perfil" accept="imagenes/*.jpg"> <br />
      </div>
    </div>
    <div ><h5>Modificar mi contraseña</h5></div>
    <h3></h3>
    <p>
      <button class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
        Cambiar mi contraseña
      </button>
    </p>
    <div class="collapse" id="collapseExample2">
      <div class="card card-body">

      <div class="form-group">
          <label for="contraseña">Nueva contraseña:</label>
          <input input type="password" minlength="6" id="passN" name="passwordN" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese la nueva contraseña"   <?php echo $cambia ?>>
          <small id="emailHelp" class="form-text text-muted">Ingrese la nueva contraseña que va usar.</small>
        </div>
        <div class="form-group">
          <label for="contraseña">Confirmar nueva contraseña:</label>
          <input input type="password" minlength="6" id="Confpass" name="password" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese la nueva contraseña"   <?php echo $cambia ?>>
          <small id="emailHelp" class="form-text text-muted">Ambas contraseñas deben coincidir.</small>
        </div>
        
      </div>
    </div>
    <div class="form-group">
          <label for="correo">Contraseña actual:</label>
          <input type="password" minlength="6" id="passAct" name="passwordA" size="15" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese la contraseña actual" <?php echo $cambia ?><?php echo $requerido ?> >
          <small id="emailHelp" class="form-text text-muted">Los usuarios que inician sesión con google no necesitan insertar su contraseña actual.</small>
        </div>
        
    <input type="submit" class="btn btn-primary" id="confDatos" value="Confirmar cambios" name="confDatos" />
    </form>
			<?php /* Para mostrar el resultado del cambio de la información */
				error_reporting(0); /* Para que no reporte el error cuando $_SESSION["estado_cambio_perfil"] == NULL al entrar la primera vez */
				if ($_SESSION["estado_cambio_perfil"] == NULL ){
					$_SESSION["estado_cambio_perfil"] = "";
        }
        if($_SESSION["esGoogle"] === 1) {
          $_SESSION["estado_cambio_perfil"] = "";
        }
				echo $_SESSION["estado_cambio_perfil"]."<br/>";
				$_SESSION["estado_cambio_perfil"] = "";
			?>
     <blockquote class="blockquote text-center">
      <form action="../php/cerrar.php" method="post">
        <input type="submit" class="btn btn-outline-danger" id="salir" value="Salir de mi cuenta" name="salir"  /> <br />
      </form>
     </blockquote>
     </div>
    <div id="aportes" class="col-md-5">
      <br>
      <blockquote class="blockquote text-center">
      <div><h4>Mis aportes</h4></div>
      </blockquote>
      <!-- AQUI VAN LOS APORTES O EL CODIGO CORRESPONDIENTE-->
      <?php /* Para mostrar el resultado del cambio de la información */
          $serverName = "35.224.8.47"; //serverName\instanceName
          $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
          $conn = sqlsrv_connect($serverName, $connectionInfo);

          /*if ($conn) {
              echo "Connection established.<br />";
          } else {
              echo "Connection could not be established.<br />";
              die(print_r(sqlsrv_errors(), true));
          }*/

          $sql = "SELECT id_hongo from GestionHongos.dbo.Hongos where usuario_fuente = $id";
          $qry = sqlsrv_query($conn, $sql);
          if ($qry === false) {
              echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
          }
          $arreglo = array();
          $cont = 0;
          while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
              $arreglo[$cont] .=  $row['id_hongo'];
              $cont++;
          }
          
          if($cont === 0){ // file does not exist
            echo "<div><h3>No hay aportes</h3></div>";
          } else {
              echo "<div class='border border-secondary'>";
              echo "<div class='row row-cols-3'>";
              for($i = 0; $i < $cont; $i++){
                require_once '../php/cargar_ficha.php';
                $cargar = new cargar();
                $nom = $cargar->cargar_nombre($arreglo[$i]);
                $inferior = $cargar->cargar_inferior($arreglo[$i]);
                $superior = $cargar->cargar_superior($arreglo[$i]);
                $lateral = $cargar->cargar_lateral($arreglo[$i]);/*<a href="ficha.php?id_hon=<?=$row[0]?>"><img  src="../img/Default/lupa_busqueda.png" alt="" border=1 height=50 width=50></img></a>*/
                $valido = $cargar->tupla_valida($arreglo[$i]);
                $idTemp =$arreglo[$i];
                if($lateral != '../img/Default/hongo_default.svg'){ // file does not exist
                  if($valido === 1){
                    echo "<div class='col'><a href='ficha.php?id_hon=$idTemp'><img  src=$lateral alt='' border=1 height=50 width=50></img></a><br>$nom.<br><p class='text-primary'>Tupla válida</p></div>";
                  } else{
                    echo "<div class='col'><a href='ficha.php?id_hon=$idTemp'><img  src=$lateral alt='' border=1 height=50 width=50></img></a><br>$nom.<br><p class='text-danger'>Tupla inválida</p></div>";
                  }
                } else {
                  if($superior != '../img/Default/hongo_default.svg'){ // file does not exist
                    if($valido === 1){
                      echo "<div class='col'><a href='ficha.php?id_hon=$idTemp'><img  src=$superior alt='' border=1 height=50 width=50></img></a><br>$nom.<br><p class='text-primary'>Tupla válida</p></div>";
                    } else{
                      echo "<div class='col'><a href='ficha.php?id_hon=$idTemp'><img  src=$superior alt='' border=1 height=50 width=50></img></a><br>$nom.<br><p class='text-danger'>Tupla inválida</p></div>";
                    }
                  } else {
                    if($inferior != '../img/Default/hongo_default.svg'){ // file does not exist
                      if($valido === 1){
                        echo "<div class='col'><a href='ficha.php?id_hon=$idTemp'><img  src=$inferior alt='' border=1 height=50 width=50></img></a><br>$nom.<br><p class='text-primary'>Tupla válida</p></div>";
                      } else{
                        echo "<div class='col'><a href='ficha.php?id_hon=$idTemp'><img  src=$inferior alt='' border=1 height=50 width=50></img></a><br>$nom.<br><p class='text-danger'>Tupla inválida</p></div>";
                      }
                    } else {
                      if($valido === 1){
                        echo "<div class='col'><a href='ficha.php?id_hon=$idTemp'><img  src='../img/Default/hongo_default.svg' alt='' border=1 height=50 width=50></img></a><br>$nom.<br><p class='text-primary'>Tupla válida</p></div>";
                      } else{
                        echo "<div class='col'><a href='ficha.php?id_hon=$idTemp'><img  src='../img/Default/hongo_default.svg' alt='' border=1 height=50 width=50></img></a><br>$nom.<br><p class='text-danger'>Tupla inválida</p></div>";
                      }
                    }
                  }
                }
              }
              echo "</div>";
              echo "</div>";
            }

          sqlsrv_close($conn);
        ?>
    </div>
    <div id="cuenta" class="col-md-1">
    </div>
    </div>
   </main>
 </body>
</html>
<script async="async" type="text/javascript">
const btn = document.getElementById('confDatos');
btn.addEventListener('click',() => {
  const pass = document.getElementById('passN');
  const Confpass = document.getElementById('Confpass');
  console.log(pass.value);
  console.log(Confpass.value);
  if(pass.value !== Confpass.value){
    alert("Contraseñas no coinciden");
  }else{
    btn.type = 'submit'
  }
});
</script>