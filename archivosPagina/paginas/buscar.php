<!DOCTYPE html>
<html lang="es"> 
	<head>
		<link rel="icon" href="../img/mushroom.svg" type="image/png" /> 
		
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
					<li class="nav-item active">
						<a class="nav-link" href="buscar.php">Buscar</a>
					</li>
					
					<!-- <ul class="nav nav-pills"  style="background-color: white">
						<li class="nav-item"><a href="index.php" class="nav-link active">Inicio</a></li>
						<li class="nav-item"><a href="paginas/buscar.php" class="nav-link ">Buscar</a></li> -->
					<?php
						session_start();
						error_reporting(0); /* Para que no reporte el error cuando $_SESSION["tipo_usuario"] == NULL al entrar la primera vez */

						$_SESSION["query"]=NULL;//limpio la variable query/

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
						<a href="acerca.php" class='nav-link'>Acerca de</a>
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
		  <section style="margin-left: 1% ; font-weight: bold; " >
			<form action= "../paginas/resultados.php" method="POST" enctype="multipart/form-data">
				<h1>Buscar</h1>
				<div class="form-row">
					<div class="form-group col-md-3">
					</div>
					<div class="form-group col-md-6">
						<label for="nombre_buscar">Nombre científico o vulgar</label>	
						<input type="text" class="form-control" id="nombre_buscar" name="nombre_buscar" maxlength="70" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-2">
					</div>
					<div class="form-group col-md-4">
						<label for="clasificacion_buscar">Clasificación</label>	
						<select class="form-control" id="clasificacion_buscar" name="clasificacion_buscar" size=1>
							<option selected value="">Seleccionar opción</option>
							<option value="1">Comestible</option>
							<option value="2">Venenoso</option>
							<option value="3">Alucinógeno</option>
							<option value="4">Medicinal</option>
							<option value="5">Desconocido</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="familia_buscar">Familia</label>
						<input type="text" class="form-control" id="familia_buscar" name="familia_buscar" maxlength="70" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-2">
					</div>
					<div class="form-group col-md-4">
						<label for="habito_buscar">Hábito</label>	
						<select class="form-control" id="habito_buscar" name="habito_buscar" size=1>
							<option selected value="">Seleccionar opción</option>
							<option value="1">Gregario</option>
							<option value="2">Disperso</option>
							<option value="3">Solitario</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="temporada_buscar">Temporada</label>
						<input type="text" class="form-control" id="temporada_buscar" name="temporada_buscar" maxlength="70" placeholder="Mes - Mes" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-2">
					</div>
					<div class="form-group col-md-4">
						<label for="area_de_conservacion_buscar">Área de conservación</label>	
						<select class="form-control" id="area_de_conservacion_buscar" name="area_de_conservacion_buscar" size=1>
							<option selected value="">Seleccionar opción</option>
							<option value="1">Arenal Huetar Norte (ACAHN)</option>
							<option value="2">Arenal Tempisque (ACAT)</option>
							<option value="3">Central (ACC)</option>
							<option value="4">Guanacaste (ACG)</option>
							<option value="5">La Amistad Caribe (ACLAC)</option>
							<option value="6">La Amistad-Pacífico (ACLAP)</option>
							<option value="7">Marina Cocos (ACMC)</option>
							<option value="8">Osa (ACOSA)</option>
							<option value="9">Pacífico Central (ACOPAC)</option>
							<option value="10">Tempisque (ACT)</option>
							<option value="11">Tortuguero (ACTo)</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="altitud_buscar">Altitud en metros</label>
						<div class="form-group row">
							<div class="col-sm-1">
							</div>
							<label for="altitud_desde_buscar" class="col-sm-2 col-form-label">desde</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="altitud_desde_buscar" name="altitud_desde_buscar" min="0" max="3900" step="100" >
							</div>
							<label for="altitud_hasta_buscar" class="col-sm-2 col-form-label">hasta</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" id="altitud_hasta_buscar" name="altitud_hasta_buscar" min="0" max="3900" step="100" >
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-3">
					</div>
					<div class="form-group col-md-6">
						<label for="fecha_buscar">Fecha del avistamiento</label>
						<div class="form-group row">
							<label for="fecha_inicio_buscar" class="col-sm-2 col-form-label">desde el </label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="fecha_inicio_buscar" name="fecha_inicio_buscar">
							</div>
							<label for="fecha_final_buscar" class="col-sm-2 col-form-label">hasta el</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" id="fecha_final_buscar" name="fecha_final_buscar">
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="form-row">		<!-- Botón buscar y limpiar opciones -->
					<div class="form-group col-md-5">
					</div>
					<div class="form-group col-md-2">
						<div style="text-align: center; ">
							<input type="submit" class="btn btn-primary" id="buscar" name="Boton_buscar" value="Buscar" /> 
						</div>
					</div>
					<div class="form-group col-md-3">
					</div>
					<div class="form-group col-md-2">
						<span><a style="color: black; font-weight: bold; " href="buscar.php" title="Limpiar opciones de búsqueda">Limpiar opciones</a></span>
					</div>
				</div>
			</form>
		  </section>
		</main>
	</body>
</html>