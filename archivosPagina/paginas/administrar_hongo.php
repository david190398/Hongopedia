<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="icon"   href="../img/mushroom.svg" type="image/png" /> 
		
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
						<a class="nav-link"href="../paginas/buscar.php">Buscar</a>
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
							echo "<li class='nav-item'><a href=\"../paginas/aportar.php\" class='nav-link '>Aportar</a></li>";
						}
						
						if ($_SESSION["tipo_usuario"] == 1 ){	/* Cuenta */
							echo "<li class='nav-item'><a href=\"../paginas/cuenta.php\" class='nav-link '>Cuenta</a></li>" ;
						}
						else {
							echo "<li class='nav-item'><a href=\"../paginas/informacionUsuario.php\" class='nav-link '>Cuenta</a></li>";
						}
					?>
					<li class='nav-item'>
						<a href="../paginas/acerca.php" class='nav-link' >Acerca de</a>
					</li>
					<?php
						if ($_SESSION["tipo_usuario"] == 3 ){	/* Administrar hongos es solo para administradores */
							echo "<li class='nav-item active'><a href=\"administracion.php\" class='nav-link '>Administración</a></li>" ;
						}
					?>
				</ul>
			</div>
		</div>
		  </nav>
    <main>
		<?php
			if ($_SESSION["tipo_usuario"] != 3 ){	/* Si no es un administrador, no debería estar aquí */
				header('Location: ../index.php');
			}
			if ($_SESSION["pagina_anterior"] == NULL){
				$_SESSION["pagina_anterior"] = "administracion.php";
			}
		?>
      <section style="margin-left: 1%; font-weight: bold; ">
		<?php
			session_start();
			$id = $_GET['id_hon'];
			require_once '../php/cargar_ficha.php';
			$cargar = new cargar();
			$valido = $cargar->es_valido_id($id); // para evitar que busque hongos que no existen modificando el link

			
			if($valido){
				$inferior = $cargar->cargar_inferior($id);
				$superior = $cargar->cargar_superior($id);
				$lateral = $cargar->cargar_lateral($id);
				$rel_mano = $cargar->cargar_rel_mano($id);
				
				
				$nom_cientifico = $cargar->cargar_nombre($id);
				if ($nom_cientifico == "No se registró información para el nombre científico"){ $nom_cientifico = ""; }
				$nom_vul = $cargar->cargar_nombre_vul($id);
				if ($nom_vul == "No se registró información para el nombre vulgar"){ $nom_vul = ""; }
				
				
				$fami = $cargar->cargar_familia($id);
				if ($fami == "No se registró información para la familia"){ $fami = ""; }

				$habitat = $cargar->cargar_habitat($id);
				if ($habitat == "No se registró información para el hábitat"){ $habitat = ""; }
				
				$color = $cargar->cargar_color($id);
				if ($color == "No se registró información para el color"){ $color = ""; }
				
				
				$area = $cargar->cargar_area($id);
				if ($area == "Error al cargar el nombre del area"){ $area = 'Seleccionar opción'; }
				$habito = $cargar->cargar_habito($id);
				if ($habito == "Error al cargar el nombre del habito"){ $habito = 'Seleccionar opción'; }
				$clasificacion = $cargar->cargar_clasificacion($id);
				if ($clasificacion == "Error al cargar el nombre de la clasificación"){ $clasificacion = 'Desconocido'; }
				
				
				$ubicacion = $cargar->cargar_ubicacion($id);
				if ($ubicacion == "No se registró información para la ubicación"){ $ubicacion = ""; }
				
				$temporada = $cargar->cargar_temporada($id);
				if ($temporada == "No se registró información para la temporada"){ $temporada = ""; }
				

				$pileo = $cargar->cargar_pileo($id);
				if ($pileo == "No se registró información para el píleo"){ $pileo = ""; }
				$hime = $cargar->cargar_hime($id);
				if ($hime == "No se registró información para el himenóforo"){ $hime = ""; }
				$esti = $cargar->cargar_esti($id);
				if ($esti == "No se registró información para el estípite"){ $esti = ""; }
				
				
				$altura = $cargar->cargar_altura($id);
				if ($altura == "No se registró información para la altitud" or $altura == 0){ $altura = ""; }
				
				
				$observacion = $cargar->cargar_observacion($id);
				if ($observacion == "No posee observaciones"){ $observacion = ""; }
				
				
				$icono = $cargar->cargar_icono($id);
				
				$fecha = $cargar->cargar_fecha($id);
				$tupla_valida = $cargar->tupla_valida($id);
			
			
			

			} else{
				echo "<h1>Hongo no registrado en la base de datos, inténtelo mas tarde</h1>";
				echo "<h2>       Redireccionando a la pestaña de administración ...</h2>";
				header("refresh:4;url=http://hongopedia.me/paginas/administracion.php");
			}
			
			if($valido){
		  
		?>

		<form method="POST" action= "../php/modificar_tupla_hongo.php" enctype="multipart/form-data">
			<input type="hidden"  id="id_hongo" name="id_hongo" value="<?php echo $id ; ?>"> <!-- Input de tipo oculto para pasar el id_hongo -->
			<div class="form-row">
				<div class="form-group col-md-1">
					<a class="btn btn-success" href="<?php echo "../paginas/".$_SESSION["pagina_anterior"]; ?>" role="button" style="float: right; " >Volver</a>
				</div>
				<div class="form-group col-md-3">
				</div>
				<div class="form-group col-md-4">
					<label for="tupla_valida_modificar">Estado de la información</label>
					<select class="form-control" id="tupla_valida_modificar" name="tupla_valida_modificar" size=1 >
						<option <?php if($tupla_valida == 0){echo 'selected';} ?> value="0">En espera</option>
						<option <?php if($tupla_valida == 1){echo 'selected';} ?> value="1">Aceptada</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<?php
						if ($_SESSION["estado_modificar_tupla_hongo"] == NULL ){
							$_SESSION["estado_modificar_tupla_hongo"] = "";
						}
						echo "<br/><p><span style=\"color: green; text_align: center;\">".$_SESSION["estado_modificar_tupla_hongo"]."</span></p>";
						$_SESSION["estado_modificar_tupla_hongo"] = "";
					?>
				</div>
				<div class="form-group col-md-2">
					<input type="submit" class="btn btn-primary" id="boton_modificar_tupla" name="boton_modificar_tupla" value="Confirmar cambios" />
				</div>
				
				
			</div>
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-5">
					<label for="nombre_cientifico_modificar">Nombre científico</label>	
					<input type="text" class="form-control" id="nombre_cientifico_modificar" name="nombre_cientifico_modificar" maxlength="70" value="<?php echo htmlentities($nom_cientifico) ; ?>" >
				</div>
				<div class="form-group col-md-5">
					<label for="nombre_vulgar_modificar">Nombre vulgar</label>
					<input type="text" class="form-control" id="nombre_vulgar_modificar" name="nombre_vulgar_modificar" maxlength="70" value="<?php echo htmlentities($nom_vul) ; ?>" >
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-5">
					<label for="familia_modificar">Familia</label>	
					<input type="text" class="form-control" id="familia_modificar" name="familia_modificar" maxlength="70" value="<?php echo htmlentities($fami) ; ?>" >
				</div>
				<div class="form-group col-md-5">
					<label for="habitat_modificar">Hábitat</label>	
					<input type="text" class="form-control" id="habitat_modificar" name="habitat_modificar" maxlength="200" value="<?php echo htmlentities($habitat) ; ?>" >
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-10">
					<label for="ubicacion_modificar">Ubicación específica</label>
					<input type="text" class="form-control" id="ubicacion_modificar" name="ubicacion_modificar" maxlength="250" value="<?php echo htmlentities($ubicacion) ; ?>" >
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-5">
					<label for="color_modificar">Color</label>	
					<input type="text" class="form-control" id="color_modificar" name="color_modificar" maxlength="70" value="<?php echo htmlentities($color) ; ?>" >
				</div>
				<div class="form-group col-md-5">
					<label for="temporada_modificar">Temporada</label>	
					<input type="text" class="form-control" id="temporada_modificar" name="temporada_modificar" maxlength="70" placeholder="Mes - Mes" value="<?php echo htmlentities($temporada) ; ?>" >
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-3">
					<label for="habito_modificar">Hábito</label>
					<select class="form-control" id="habito_modificar" name="habito_modificar" size=1>
						<option <?php if($habito == 'Seleccionar opción'){echo 'selected';} ?> value="4">Seleccionar opción</option>
						<option <?php if($habito == 'Gregario'){echo 'selected';} ?> value="1">Gregario</option>
						<option <?php if($habito == 'Disperso'){echo 'selected';} ?> value="2">Disperso</option>
						<option <?php if($habito == 'Solitario'){echo 'selected';} ?> value="3">Solitario</option>
					</select>								
				</div>
				<div class="form-group col-md-4">
					<label for="area_de_conservacion_modificar">Área de conservación</label>	
					<select class="form-control" id="area_de_conservacion_modificar" name="area_de_conservacion_modificar" size=1>
						<option <?php if($area == 'Seleccionar opción'){echo 'selected';} ?> value="12">Seleccionar opción</option>
						<option <?php if($area == 'Arenal Huetar Norte (ACAHN)'){echo 'selected';} ?> value="1">Arenal Huetar Norte (ACAHN)</option>
						<option <?php if($area == 'Arenal Tempisque (ACAT)'){echo 'selected';} ?> value="2">Arenal Tempisque (ACAT)</option>
						<option <?php if($area == 'Central (ACC)'){echo 'selected';} ?> value="3">Central (ACC)</option>
						<option <?php if($area == 'Guanacaste (ACG)'){echo 'selected';} ?> value="4">Guanacaste (ACG)</option>
						<option <?php if($area == 'La Amistad Caribe (ACLAC)'){echo 'selected';} ?> value="5">La Amistad Caribe (ACLAC)</option>
						<option <?php if($area == 'La Amistad-Pacífico (ACLAP)'){echo 'selected';} ?> value="6">La Amistad-Pacífico (ACLAP)</option>
						<option <?php if($area == 'Marina Cocos (ACMC)'){echo 'selected';} ?> value="7">Marina Cocos (ACMC)</option>
						<option <?php if($area == 'Osa (ACOSA)'){echo 'selected';} ?> value="8">Osa (ACOSA)</option>
						<option <?php if($area == 'Pacífico Central (ACOPAC)'){echo 'selected';} ?> value="9">Pacífico Central (ACOPAC)</option>
						<option <?php if($area == 'Tempisque (ACT)'){echo 'selected';} ?> value="10">Tempisque (ACT)</option>
						<option <?php if($area == 'Tortuguero (ACTo'){echo 'selected';} ?> value="11">Tortuguero (ACTo)</option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label for="clasificacion_modificar">Clasificación</label>
					<select class="form-control" id="clasificacion_modificar" name="clasificacion_modificar" size=1>
						<option <?php if($clasificacion == 'Seleccionar opción'){echo 'selected';} ?> value="5">Seleccionar opción</option>
						<option <?php if($clasificacion == 'Comestible'){echo 'selected';} ?> value="1">Comestible</option>
						<option <?php if($clasificacion == 'Venenoso'){echo 'selected';} ?> value="2">Venenoso</option>
						<option <?php if($clasificacion == 'Alucinógeno'){echo 'selected';} ?> value="3">Alucinógeno</option>
						<option <?php if($clasificacion == 'Medicinal'){echo 'selected';} ?> value="4">Medicinal</option>
						<option <?php if($clasificacion == 'Desconocido'){echo 'selected';} ?> value="5">Desconocido</option>
					</select>								
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-5">
					<label for="pileo_modificar">Píleo</label>
					<input type="text" class="form-control" id="pileo_modificar" name="pileo_modificar" maxlength="300" value="<?php echo htmlentities($pileo) ; ?>" >
				</div>
				<div class="form-group col-md-5">
					<label for="estipite_modificar">Estípite</label>
					<input type="text" class="form-control" id="estipite_modificar" name="estipite_modificar" maxlength="300" value="<?php echo htmlentities($esti) ; ?>" >
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-10">
					<label for="himenoforo_modificar">Himenóforo</label>
					<input type="text" class="form-control" id="himenoforo_modificar" name="himenoforo_modificar"  maxlength="300" value="<?php echo htmlentities($hime) ; ?>" >
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-5">
					<label for="fecha_del_avistamiento_modificar">Fecha del avistamiento</label>
					<input type="date" class="form-control" id="fecha_del_avistamiento_modificar" name="fecha_del_avistamiento_modificar" value="<?php echo $fecha->format('Y-m-d'); ?>"  >
				</div>
				<div class="form-group col-md-5">
					<label for="altura_del_avistamiento_modificar">Altitud de la ubicación en metros</label>
					<input type="number" class="form-control" id="altura_del_avistamiento_modificar" name="altura_del_avistamiento_modificar" min="0" max="3900" value="<?php echo htmlentities($altura) ; ?>" >
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-md-10">
					<label for="observaciones_modificar">Observaciones</label>
					<textarea class="form-control" id="observaciones_modificar" name="observaciones_modificar" rows="2" wrap="soft"><?php echo htmlentities($observacion) ; ?></textarea>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-sm-1">
				</div>
				<div class="form-group col-md-2">
					<div class="foto2">
						<img id="foto_superior" src=<?php echo $superior ?> alt="Foto superior" width="200" height="140" class="mx-auto d-block"/>
						<p class="text-center">Superior</p>
					</div>
				</div>
				<div class="form-group col-md-4">
					<div class="form-group col">
						<div class="col-auto">
							<label for="superior">Imagen superior</label>
						</div>
						<div class="col-auto">
							<input type="file" class="form-control-file" id="superior" name="superior" accept="image/*" /> 
						</div>
						<br />
						
						<div class="col-auto">
							<label for="inferior">Imagen inferior</label>
						</div>
						<div class="col-auto">
							<input type="file" class="form-control-file" id="inferior" name="inferior" accept="image/*" /> 
						</div>
						<br />
					</div>
				</div>
				<div class="form-group col-md-2">
					<div class="foto1">
						<img id="foto_inferior" src=<?php echo $inferior ?> alt="Foto inferior" width="200" height="140" class="mx-auto d-block"/>
						<p class="text-center">Inferior</p>
					</div>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-1">
				</div>
				<div class="form-group col-sm-1">
				</div>
				<div class="form-group col-md-2">
					<div class="foto4">
						<img id="foto_lateral" src=<?php echo $lateral ?> alt="Foto Lateral" width="200" height="140" class="mx-auto d-block"/>
						<p class="text-center">Lateral</p>
					</div>
				</div>
				<div class="form-group col-md-4">
					<div class="form-group col">
						<div class="col-auto">
							<label for="lateral">Imagen lateral</label>
						</div>
						<div class="col-auto">
							<input type="file" class="form-control-file" id="lateral" name="lateral" accept="image/*" />
						</div>
						<br />
						
						<div class="col-auto">
							<label for="mano_hongo">Relación mano-hongo</label>
						</div>
						<div class="col-auto">
							<input type="file" class="form-control-file" id="mano_hongo" name="mano_hongo" src="img/up.svg" width="20" height="20" accept="image/*" />
						</div>
						<br />
					</div>
				</div>
				<div class="form-group col-md-2">
					<div class="foto3">
						<img id="foto_mano" src=<?php echo $rel_mano ?> alt="Foto relación mano" width="200" height="140" class="mx-auto d-block"/>
						<p class="text-center">Relacion con la mano</p>
					</div>
				</div>
			</div>
			
			<div style="text-align: center; ">
				<input type="submit" class="btn btn-primary" id="boton_modificar_tupla" name="boton_modificar_tupla" value="Confirmar cambios" />
			</div>
		</form>
		<form method="POST" action="../php/eliminar_hongo.php" enctype="multipart/form-data">
			<input type="hidden"  id="id_hong" name="id_hong" value="<?php echo $id ; ?>">
			<input type="submit" class="btn btn-danger" id="boton_borrar_hongo" name="boton_borrar_hongo" value="Eliminar hongo" />
		</form>
		<br />
		

        <!-- The Modal -->
        <div id="myModal" class="modal">

          <!-- The Close Button -->
          <span class="close">&times;</span>

          <!-- Modal Content (The Image) -->
          <img class="modal-content" id="img01">

          <!-- Modal Caption (Image Text) -->
          <div id="caption"></div>
        </div>

      <!-- Foto Superior -->
      <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("foto_superior");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
          modal.style.display = "none";
        }
      </script>

      <!-- Foto Inferior -->
      <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("foto_inferior");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
          modal.style.display = "none";
        }
      </script>

      <!-- Foto Lateral -->
      <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("foto_lateral");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
          modal.style.display = "none";
        }
      </script>

      <!-- Foto Mano -->
      <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("foto_mano");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
          modal.style.display = "none";
        }
      </script>

      <?php
      
                }// cierra el if del id valido
      
      
      ?> 

      </main>
    </body>
</html>
