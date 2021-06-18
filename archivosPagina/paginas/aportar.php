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
					<li class="nav-item">
						<a class="nav-link" href="buscar.php">Buscar</a>
					</li>
					
					<!-- <ul class="nav nav-pills"  style="background-color: white">
						<li class="nav-item"><a href="index.php" class="nav-link active">Inicio</a></li>
						<li class="nav-item"><a href="paginas/buscar.php" class="nav-link ">Buscar</a></li> -->
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
		<section style="margin-left: 1% ; font-weight: bold">
			<?php
				if ($_SESSION["tipo_usuario"] == 1 ){	/* Si es un visitante, no debería estar aquí */
					header('Location: ../index.php');
				}
			?>
		
			<h1>Aportar
			<?php
				if ($_SESSION["tipo_usuario"] == 3 ){	/* Es un administrador */
					echo "<span style=\"font-size: 35%; font-weight: bold; \">(Administrador)</span>";
				}
			?>
			</h1>
			<form method="POST" action="../paginas/subir_a_base_csv.php" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col-auto">
						<label for="csv_aportadoADM"><span style="font-weight: lighter ;" >Subir información desde un archivo <i>csv</i></span></label>
					</div>
					<div class="col-auto">
						<input type="file" class="form-control-file" id="csv_aportadoADM" name="csv_aportadoADM" accept="archivos_csv/*.csv"/> 
					</div>
					<div class="col-auto">
						<input type="submit" class="btn btn-primary" value="Subir CSV" name="Boton_subir_CSV_ADM" /> 
					</div>
				</div>
			</form>
			<br />
			
			<form method="POST" action= "../paginas/subir_a_base_tupla.php" enctype="multipart/form-data">
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-5">
						<label for="nombre_cientifico_aportadoADM">Nombre científico</label>	
						<input type="text" class="form-control" id="nombre_cientifico_aportadoADM" name="nombre_cientifico_aportadoADM" maxlength="70" >
					</div>
					<div class="form-group col-md-5">
						<label for="nombre_vulgar_aportadoADM">Nombre vulgar</label>
						<input type="text" class="form-control" id="nombre_vulgar_aportadoADM" name="nombre_vulgar_aportadoADM" maxlength="70" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-5">
						<label for="familia_aportadoADM">Familia</label>	
						<input type="text" class="form-control" id="familia_aportadoADM" name="familia_aportadoADM" maxlength="70" >
					</div>
					<div class="form-group col-md-5">
						<label for="hábitat_aportadoADM">Hábitat</label>	
						<input type="text" class="form-control" id="hábitat_aportadoADM" name="hábitat_aportadoADM" maxlength="200" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-10">
						<label for="ubicacion_aportadoADM">Ubicación específica</label>
						<input type="text" class="form-control" id="ubicacion_aportadoADM" name="ubicacion_aportadoADM" maxlength="250" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-5">
						<label for="color_aportadoADM">Color</label>	
						<input type="text" class="form-control" id="color_aportadoADM" name="color_aportadoADM" maxlength="70" >
					</div>
					<div class="form-group col-md-5">
						<label for="temporada_aportadoADM">Temporada</label>	
						<input type="text" class="form-control" id="temporada_aportadoADM" name="temporada_aportadoADM" maxlength="70" placeholder="Mes - Mes" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-3">
						<label for="habito_aportadoADM">Hábito</label>
						<select class="form-control" id="habito_aportadoADM" name="habito_aportadoADM" size=1>
							<option selected value="4">Seleccionar opción</option>
							<option value="1">Gregario</option>
							<option value="2">Disperso</option>
							<option value="3">Solitario</option>
						</select>								
					</div>
					<div class="form-group col-md-4">
						<label for="area_de_conservacion_aportadoADM">Área de conservación</label>	
						<select class="form-control" id="area_de_conservacion_aportadoADM" name="area_de_conservacion_aportadoADM" size=1>
							<option selected value="12">Seleccionar opción</option>
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
					<div class="form-group col-md-3">
						<label for="clasificación_aportadoADM">Clasificación</label>
						<select class="form-control" id="clasificación_aportadoADM" name="clasificación_aportadoADM" size=1>
							<option selected value="5">Seleccionar opción</option>
							<option value="1">Comestible</option>
							<option value="2">Venenoso</option>
							<option value="3">Alucinógeno</option>
							<option value="4">Medicinal</option>
							<option value="5">Desconocido</option>
						</select>								
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-5">
						<label for="pileo_aportadoADM">Píleo</label>
						<input type="text" class="form-control" id="pileo_aportadoADM" name="pileo_aportadoADM" maxlength="300" >
					</div>
					<div class="form-group col-md-5">
						<label for="estipite_aportadoADM">Estípite</label>
						<input type="text" class="form-control" id="estipite_aportadoADM" name="estipite_aportadoADM" maxlength="300" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-10">
						<label for="himenoforo_aportadoADM">Himenóforo</label>
						<input type="text" class="form-control" id="himenoforo_aportadoADM" name="himenoforo_aportadoADM"  maxlength="300" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-5">
						<label for="fecha_del_avistamiento_aportadoADM">Fecha del avistamiento</label>
						<input type="date" class="form-control" id="fecha_del_avistamiento_aportadoADM" name="fecha_del_avistamiento_aportadoADM">
					</div>
					<div class="form-group col-md-5">
						<label for="altura_del_avistamiento_aportadoADM">Altitud de la ubicación en metros</label>
						<input type="number" class="form-control" id="altura_del_avistamiento_aportadoADM" name="altura_del_avistamiento_aportadoADM" min="0" max="3900" >
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-1">
					</div>
					<div class="form-group col-md-5">
						<label for="">Observaciones</label>
						<textarea class="form-control" id="observaciones_aportadoADM" name="observaciones_aportadoADM" rows="12" wrap="soft" ></textarea>
					</div>
					<div class="form-group col">
						<div class="col-auto">
							<label for="imagen_superior_aportadoADM">Imagen superior</label>
						</div>
						<div class="col-auto">
							<input type="file" class="form-control-file" id="imagen_superior_aportadoADM" name="imagen_superior_aportadoADM" accept="imagenes/*.jpg" /> 
						</div>
						<br />
						
						<div class="col-auto">
							<label for="imagen_inferior_aportadoADM">Imagen inferior</label>
						</div>
						<div class="col-auto">
							<input type="file" class="form-control-file" id="imagen_inferior_aportadoADM" name="imagen_inferior_aportadoADM" accept="imagenes/*.jpg" /> 
						</div>
						<br />
						
						<div class="col-auto">
							<label for="imagen_lateral_aportadoADM">Imagen lateral</label>
						</div>
						<div class="col-auto">
							<input type="file" class="form-control-file" id="imagen_lateral_aportadoADM" name="imagen_lateral_aportadoADM" accept="imagenes/*.jpg" /> 
						</div>
						<br />
						
						<div class="col-auto">
							<label for="imagen_relacion_mano-hongo_aportadoADM">Relación mano-hongo</label>
						</div>
						<div class="col-auto">
							<input type="file" class="form-control-file" id="imagen_relacion_mano-hongo_aportadoADM" name="imagen_relacion_mano-hongo_aportadoADM" src="img/up.svg" width="20" height="20" accept="imagenes/*.jpg" /> 
						</div>
					</div>
				</div>
				<div style="text-align: center; ">
					<input type="submit" class="btn btn-primary" id="subirTupla" name="Boton_subir_tupla_ADM" value="Subir datos" />
				</div>
			</form>
			<br />
		</section>
		</main>
  	</body>
</html>
