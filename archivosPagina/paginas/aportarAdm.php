<!DOCTYPE html>
<html lang="es"> 
  <head>
	  <link  rel="icon"   href="../img/mushroom.svg" type="image/png" /> 
	  <meta charset="utf-8"/>
	  <meta name="viewport" content="width=device-width, initial-scale=1"/>
	  <meta name="author" content="Grupo Gestion de Hongos"/>
	  <meta name="keywords" content="hongos, wiki, gestion"/>
	  <meta name="generator" content="Grupo Gestion de Hongos" />
	  <title>Gestion de Hongos</title>
	  <link href="../css/ap.css" rel="stylesheet"/>
  </head>   
  <body> 
	<header id="encabezado_sitio">
    	<img id="site_logo" src="../img/mushroom.svg" alt="Logo del sitio" width="80" height="60"/>
        <h1>Hongopedia</h1>
	</header>
	<nav>
		<ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="buscar.php">Buscar</a></li>
			<?php
				session_start();
				error_reporting(0); /* Para que no reporte el error cuando $_SESSION["tipo_usuario"] == NULL al entrar la primera vez */
				if ($_SESSION["tipo_usuario"] == NULL){
					$_SESSION["tipo_usuario"] = 1;
				}

				if ($_SESSION["tipo_usuario"] == 3 ){	/* Aportar */
					echo "<li><a href=\"aportar.php\">Aportar</a></li>" ;
				}
				else {
					if ($_SESSION["tipo_usuario"] == 2 ){
						echo "<li><a href=\"aportar.php\">Aportar</a></li>" ;
					}
					else {	//Visitante
						echo "<li style=\"color: gray;\">Aportar</li>";
					}
				}
				if ($_SESSION["tipo_usuario"] == 1 ){	/* Cuenta */
					echo "<li><a href=\"cuenta.php\">Cuenta</a></li>";
				}
				else {
					echo "<li><a href=\"informacionUsuario.php\">Cuenta</a></li>";
				}
			?>
            <li><a href="acerca.php">Acerca de</a></li>
		</ul>
	</nav>
	<main>
	<section>
		<h1>Aportar</h1>
        <p id="tipoUsuario">Administrador</p>
        <section id="area">
            <section id="columna1">
				<form method="POST" action="../paginas/subir_a_base_csv.php" enctype="multipart/form-data">
					<label>Aportar desde un csv <input type="file" id="csv_aportadoADM" name="csv_aportadoADM" accept="archivos_csv/*.csv"/> 
					<input type="submit" class="action" value="Subir CSV" name="Boton_subir_CSV_ADM" /> </label>
				</form>
				
				<form action= "../paginas/subir_a_base_tupla.php" method="POST" enctype="multipart/form-data">
					<p>Nombre científico<input type="text" id="nombre_cientifico_aportadoADM" name="nombre_cientifico_aportadoADM" size="30" maxlength="70" ><br/>
					<p>Nombre vulgar <input type="text" id="nombre_vulgar_aportadoADM" name="nombre_vulgar_aportadoADM" size="30" maxlength="70" ><br />
					<p>Familia <input type="text" id="familia_aportadoADM" name="familia_aportadoADM" size="30" maxlength="70" ><br />
					<p>Hábitat <input type="text" id="hábitat_aportadoADM" name="hábitat_aportadoADM" size="30" maxlength="200" ><br />
					<p>Color <input type="text" id="color_aportadoADM" name="color_aportadoADM" size="30" maxlength="70" ><br />
					<p>Área de conservación
					<select id="area_de_conservacion_aportadoADM" name="area_de_conservacion_aportadoADM" size=1>
						<option selected value="12">Seleccionar opción</option>
						<option value="1">Arenal Huetar Norte (ACAHN)</option>
						<option value="2">Arenal Tempisque (ACAT)</option>
						<option value="3">Central (ACC)</option>
						<option value="4">Guanacaste (ACG)</option>
						<option value="5">La Amistad Caribe (ACLAC)'</option>
						<option value="6">La Amistad-Pacífico (ACLAP)</option>
						<option value="7">Marina Cocos (ACMC)</option>
						<option value="8">Osa (ACOSA)</option>
						<option value="9">Pacífico Central (ACOPAC)</option>
						<option value="10">Tempisque (ACT)'</option>
						<option value="11">Tortuguero (ACTo)</option>
					</select><br />
					<p>Ubicación específica <input type="text" id="ubicacion_aportadoADM" name="ubicacion_aportadoADM" size="30" maxlength="250" ><br />
					<p>Hábito
						<select id="habito_aportadoADM" name="habito_aportadoADM" size=1>
							<option selected value="4">Seleccionar opción</option>
							<option value="1">Gregario</option>
							<option value="2">Disperso</option>
							<option value="3">Solitario</option>
						</select><br />
					<p>Temporada <input type="text" id="temporada_aportadoADM" name="temporada_aportadoADM" size="30" maxlength="70" placeholder="Mes - Mes" ><br />
					<p>Clasificación
						<select id="clasificación_aportadoADM" name="clasificación_aportadoADM" size=1>
							<option selected value="5">Seleccionar opción</option>
							<option value="1">Comestible</option>
							<option value="2">Venenoso</option>
							<option value="3">Alucinógeno</option>
							<option value="4">Medicinal</option>
							<option value="5">Desconocido</option>
						</select><br />
					<p>Píleo <input type="text" id="pileo_aportadoADM" name="pileo_aportadoADM" size="35" maxlength="300" ><br />
			</section>
			<section id="columna2">
					<p>Himenóforo <input type="text" id="himenoforo_aportadoADM" name="himenoforo_aportadoADM" size="35" maxlength="300" ><br />
					<p>Estípite <input type="text" id="estipite_aportadoADM" name="estipite_aportadoADM" size="35" maxlength="300" ><br />
					<p>Fecha del avistamiento <input type="date" id="fecha_del_avistamiento_aportadoADM" name="fecha_del_avistamiento_aportadoADM"><br />
					<p>Altitud de la ubicación en metros <input type="number" id="altura_del_avistamiento_aportadoADM" name="altura_del_avistamiento_aportadoADM" min="0" max="3900" ><br />
					<p>Observaciones</p><textarea id="observaciones_aportadoADM" name="observaciones_aportadoADM" rows="10" cols="40" wrap="soft" ></textarea><br />
					<p>Imagen superior<input type="file" name="imagen_superior_aportadoADM" /><br />
					<p>Imagen inferior<input type="file" id="imagen_inferior_aportadoADM" name="imagen_inferior_aportadoADM" accept="imagenes/*.jpg"> <br />
					<p>Imagen lateral<input type="file" id="imagen_lateral_aportadoADM" name="imagen_lateral_aportadoADM" accept="imagenes/*.jpg"> <br />
					<p>Relación mano-hongo <input type="file" id="imagen_relacion_mano-hongo_aportadoADM" name="imagen_relacion_mano-hongo_aportadoADM" src="img/up.svg" width="20" height="20" accept="imagenes/*.jpg"></p> <br />
			</section>
					<input type="submit" class="action" id="subirTupla" value="Subir datos" name="Boton_subir_tupla_ADM"  /> <br />
				</form> <br />
		</section>
	</section>
   	</main>
  	</body>
</html>
