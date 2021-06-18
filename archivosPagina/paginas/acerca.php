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
							echo "<li class='nav-item'><a href=\"cuenta.php\" class='nav-link '>Cuenta</a></li>" ;
						}
						else {
							echo "<li class='nav-item'><a href=\"informacionUsuario.php\" class='nav-link '>Cuenta</a></li>";
						}
					?>
					<li class="nav-item active">
						<a href="acerca.php" class='nav-link' >Acerca de</a>
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
		  <section style="margin-left: 1% ; ">
			<section id ="area_principal">
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-5">
						<br />
						<br />
						<h2>Acerca de</h2>
						<br />
						<p style="text-align: justify; " ><span style="color:  #ffffff00; ">12345</span>Este proyecto fue desarrollado por estudiantes de computación de la Universidad de Costa Rica (UCR) con el fin de
							proveer un servicio útil y de fortalecer las capacidades de trabajo en equipo, manejo de proyectos y distintos
							conocimientos de ingeniería de software.<br />
							<br />
							<span style="color:  #ffffff00; ">12345</span>Si desea colaborar para hacer más grande la página, puede crearse un perfil o iniciar sesión en la pestaña "Cuenta" del menú principal,
							para que de esta forma pueda aportar información de hongos de Costa Rica en la pestaña "Aportar". Los encargados de la página revisamos
							los aportes de los usuarios y los aprobamos para que estén a la vista de todos.<br />
							<br />
							¡De antemano le agradecemos su colaboración!
						</p>
					</div>
					<div class="form-group col-xs-1">
					</div>
					<div class="form-group col-md-5">
						<br />
						<br />
						<div class="form-group col">
							<div class="col-auto">
								<div class='row row-cols-3'>
									<div class="col">
										<img src="../img/Default/logo_ucr.png" class="rounded mx-auto d-block" width="100%" height="auto" alt="Logo_UCR, hongopedia.me">
									</div>
									<div class="col">
									<br />
										<img src="../img/Default/figura_humana.svg" class="rounded mx-auto d-block" width="100%" height="100" alt="Figura humana, hongopedia.me">
									</div>
									<div class="col">
										<img src="../img/Default/ecci.png" class="rounded mx-auto d-block" width="100%" height="auto" alt="Logo_UCR, hongopedia.me">
									</div>
								</div>
							</div>
							<div class="col-auto">
								<br />
								<br />
								<h5>Contactos de los desarrolladores:</h6>
								<ul class="list-group" id="correos_miembros" >
									<li class="list-group-item"> juan.diazmarchena@ucr.ac.cr </li>
									<li class="list-group-item"> marcos.castro@ucr.ac.cr </li>
									<li class="list-group-item"> alvaro.vega@ucr.ac.cr </li>
									<li class="list-group-item"> bruno.conejo@ucr.ac.cr</li>
								</ul>
								<br />
								<h5>Correo del sitio:</h6>
								<ul class="list-group" id="correo_sitio" >
									<li class="list-group-item"> hongopediame@gmail.com </li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
		  </section>
        </main>
		<footer>
		</footer>
    </body>
</html>

