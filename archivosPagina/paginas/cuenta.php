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
	</head>  <body style="background-color: #FFF2CC; overflow-x: hidden"> 
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
          echo "<li class='nav-item active'><a href=\"cuenta.php\" class='nav-link '>Cuenta</a></li>" ;
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
        <?php
         session_start();
         $_SESSION["esGoogle"] = 1;
        ?>
        <div class="row">
        <br>
        </div>
        <div class="row">
        <div class="col-md-1">
        </div>
          <div class="col-md-5">
              <form action="../php/cuentaConf.php" method="post">
                <h4 id="hCrear" >Crea una cuenta nueva</h4>
                <div class="form-group">
                  <label for="correo">Correo:</label>
                  <input type="text" name="correo" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese correo"  required>
                  <small id="emailHelp" class="form-text text-muted">Ingrese el correo que desea registrar.</small>
                </div>
                <div class="form-group">
                  <label for="pass">Contraseña:</label>
                  <input type="password" minlength="6" id="pass" name="password" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese contraseña"  required>
                  <small id="emailHelp" class="form-text text-muted">No comparta su contraseña con nadie.</small>
                </div>
                <div class="form-group">
                  <label for="pass">Confirmar Contraseña:</label>
                  <input type="password" minlength="6" id="Confpass" name="password" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese contraseña"  required>
                  <small id="emailHelp" class="form-text text-muted">Ambas contraseñas deben coincidir.</small>
                </div>
                  
                  <input type="button" id="registrar" value="Registrarse" name="registrar"  class="btn btn-primary"/> <br/>
                  <br />
                  <?php
                    if($_SESSION["existeCorreo"] === 1){
                      echo '<div class="alert alert-danger">';
                      echo "Error: Este correo ya ha sido registrado previamente";
                      echo "</div>";
                      $_SESSION["existeCorreo"] = 0;
                    }
                  ?>
              </form>
            </div>
            <div class="col-md-5">
              <form action="../php/iniciaSesion.php" method="post">
                  <h4 id="hInicia">Inicia sesión con una cuenta existente</h4>
                  <div class="form-group">
                  <label for="correo">Correo:</label>
                    <input type="text" name="correoI" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese correo"  required>
                    <small id="emailHelp" class="form-text text-muted">Ingrese el correo que registró.</small>
                  </div>
                  <div class="form-group">
                    <label for="pass">Contraseña:</label>
                    <input type="password" minlength="6" id="passI" name="passwordI" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese contraseña"  required>
                    <small id="emailHelp" class="form-text text-muted">No comparta su contraseña con nadie.</small>
                  </div>
                  <input type="submit"  class="btn btn-primary" id="inicia" value="Iniciar Sesión" name="inicia"  /> <br />
                  <br>
                  <?php
                    if($_SESSION["correoInvalido"] === 1){
                      echo '<div class="alert alert-danger">';
                      echo "Error: El correo ingresado no esta registrado";
                      echo "</div>";
                      $_SESSION["correoInvalido"] = 0;
                    }
                    if($_SESSION["passwordIncorrecto"] === 1){
                      echo '<div class="alert alert-danger">';
                      echo "Error: La contraseña ingresada es incorrecta";
                      echo "</div>";
                      $_SESSION["passwordIncorrecto"] = 0;
                    }
                    
                    if($_SESSION["enviado"] === 1){
                      echo '<div class="alert alert-success">';
                      echo "Su nueva contraseña se envió al correo registrado";
                      echo "</div>";
                      $_SESSION["enviado"] = 0;
                    }
                  ?>
              </form>
              <p>
              <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                ¿Olvidó su contraseña?
              </a>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                  <form action="../php/olvido.php" method="post">
                    <div class="form-group">
                    <label for="correoRec">Correo:</label>
                      <input type="text" name="correoR" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese su correo"  required>
                      <small id="emailHelp" class="form-text text-muted">Se le enviara un mensaje al correo registrado con la nueva contraseña.</small>
                    </div>
                    <input type="submit"  class="btn btn-primary" id="inicia" value="Enviar contraseña" name="inicia"  /> <br />
                  </form>
                  </br>
                </div>
                </br>
              </div>
            <?php
               require_once '../../vendor/autoload.php';
                require_once 'config.php';
                $client = new Google_Client();
                $client->setClientId($clientID);
                $client->setClientSecret($clientSecret);
                $client->setRedirectUri($redirectUri);
                $client->addScope("email");
                $client->addScope("profile");
                $client->createAuthUrl();
                echo "<a href='".$client->createAuthUrl()."'><button  class='btn btn-primary' id='google'>Entrar con google</button></a><br /><br />";
            ?>
         </div>
         <div class="col-md-1">
        </div>
        </div>
      </main>
  	</body>
</html>


<script async="async" type="text/javascript">
console.log("paso al menos");
const btn = document.getElementById('registrar');
btn.addEventListener('click',() => {
  const pass = document.getElementById('pass');
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

<script async="async" type="text/javascript">
const btnG = document.getElementById('InicGoogle');
btnG.addEventListener('click',() => {

});
  </script>
  
 