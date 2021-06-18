<?php 


    $id = $_GET['id_hon'];
    require_once '../php/cargar_ficha.php';
    $cargar = new cargar();

    $valido= $cargar->es_valido_id($id); // para evitar que busque hongos que no existen modificando el link

    if($valido){
      $inferior = $cargar->cargar_inferior($id);
      $superior = $cargar->cargar_superior($id);
      $lateral = $cargar->cargar_lateral($id);
      $rel_mano = $cargar->cargar_rel_mano($id);
      $nom_cientifico = $cargar->cargar_nombre($id);
      $nom_vul = $cargar->cargar_nombre_vul($id);
      $fami = $cargar->cargar_familia($id);
      $habitat = $cargar->cargar_habitat($id);
      $color = $cargar->cargar_color($id);
      $area = $cargar->cargar_area($id);
      $ubicacion = $cargar->cargar_ubicacion($id);
      $habito = $cargar->cargar_habito($id);
      $temporada = $cargar->cargar_temporada($id);
      $clasificacion = $cargar->cargar_clasificacion($id);
      $pileo = $cargar->cargar_pileo($id);
      $hime = $cargar->cargar_hime($id);
      $esti = $cargar->cargar_esti($id);
      $altura = $cargar->cargar_altura($id);
      $observacion = $cargar->cargar_observacion($id);
      $icono = $cargar->cargar_icono($id);

    }else{

      echo "<h1>Hongo no registrado en la base de datos, intentelo mas tarde</h1>";
      echo "<h2>       Redireccionando a la pestaña de buscar...</h2>";
      header("refresh:4;url=http://hongopedia.me/paginas/buscar.php");

    }



    $nom_imagen="http://hongopedia.me/img/Default/imagendeperfil.png";
    if($lateral!="" && $lateral!='../img/Default/hongo_default.svg'){

      $nom_imagen=$lateral;
      $nom_imagen=str_replace("..","http://hongopedia.me/",$nom_imagen);


    }else{

      if($inferior!="" && $inferior!='../img/Default/hongo_default.svg'){
        $nom_imagen=$inferior;
        $nom_imagen=str_replace("..","http://hongopedia.me/",$nom_imagen);

      }else{
        if($superior!="" && $superior!='../img/Default/hongo_default.svg'){

          $nom_imagen=$superior;
          $nom_imagen=str_replace("..","http://hongopedia.me/",$nom_imagen);
        }else{

        $nom_imagen="http://hongopedia.me/img/Default/imagendeperfil.png"; // no tiene ninguna imagen se debe poner la imagen predeterminada
        }

    }

    }

?>

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

        <meta property="og:url"                content="http://hongopedia.me/paginas/ficha.php?id_hon=<?=$_GET['id_hon']?>" />
        <meta property="og:title"              content="<?=$nom_cientifico?>" />
        <meta property="og:description"        content="<?=$observacion?>" />
        <meta property="og:image"         content="<?=$nom_imagen?>" />
        <meta property="og:image:width" content="500" />
        <meta property="og:image:height" content="500" />

        <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v9.0" nonce="glrbpTjB"></script>

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
							echo "<li class='nav-item'><a href=\"../paginas/administracion.php\" class='nav-link '>Administración</a></li>" ;
						}
					?>
				</ul>
			</div>
		</div>
		  </nav>
    <main>
      <section style="margin-left: 1% ; ">
      <?php
                session_start();
                

                if($valido){
              
              ?>
        <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="foto1">
              <img id="foto_inferior" src=<?php echo $inferior ?> alt="Foto inferior" width="200" height="140" class="mx-auto d-block"/>
              <p class="text-center">Inferior</p>
            </div>
            <div class="icono1">
              <img id="foto_inferior" src=<?php echo $icono ?> width="40" height="40"/>
              <span class="texto_icono1">Clasificación: <?php echo htmlentities($clasificacion) ?></span>
            </div>
			<?php
			if ($_SESSION["tipo_usuario"] == 3){
				echo "<div class=\"form-group\" style=\"float: left; \">
					<br />
					<a class=\"btn btn-primary\" href=\"administrar_hongo.php?id_hon={$id}\" role=\"button\" style=\"float: right; \" >Modificar información</a>
				</div>";
				$_SESSION["pagina_anterior"] = "ficha.php?id_hon={$id}";
			}
			?>
          </div>
          <div class="col-md-6">
            <h1><?php echo htmlentities($nom_cientifico) ?></h1>
            <p> <span class="desc">Nombre vulgar: </span><?php echo htmlentities($nom_vul) ?></p>
            <p> <span class="desc">Familia: </span> <?php echo htmlentities($fami) ?></p> 
            <p> <span class="desc">Habitat: </span> <?php echo htmlentities($habitat) ?></p> 
            <p> <span class="desc">Color: </span> <?php echo htmlentities($color) ?></p> 
            <p> <span class="desc">Área: </span>  <?php echo htmlentities($area) ?></p> 
            <p> <span class="desc">Ubicación </span>: <?php echo htmlentities($ubicacion) ?></p> 
            <p> <span class="desc">Habito: </span> <?php echo htmlentities($habito) ?></p> 
            <p> <span class="desc">Temporada: </span> <?php echo htmlentities($temporada) ?></p> 
            <p> <span class="desc">Pileo: </span>  <?php echo htmlentities($pileo) ?></p> 
            <p> <span class="desc">Himenéforo: </span> <?php echo htmlentities($hime) ?></p>
            <p> <span class="desc">Estípite: </span> <?php echo htmlentities($esti) ?></p>
            <p> <span class="desc">Altura: </span> <?php echo htmlentities($altura) ?> metros</p>
            <p> <span class="desc">Observación: </span> <?php echo htmlentities($observacion) ?></p>
          </div>
          <div class="col-md-3">
            <div class="foto2">
              <img id="foto_superior" src=<?php echo $superior ?> alt="Foto superior" width="200" height="140" class="mx-auto d-block"/>
              <p class="text-center">Superior</p>
            </div>
            <div class="foto3">
              <img id="foto_mano" src=<?php echo $rel_mano ?> alt="Foto relación mano" width="200" height="140" class="mx-auto d-block"/>
              <p class="text-center">Relacion con la mano</p>
            </div>
            <div class="foto4">
              <img id="foto_lateral" src=<?php echo $lateral ?> alt="Foto Lateral" width="200" height="140" class="mx-auto d-block"/>
              <p class="text-center">Lateral</p>
            </div>
          </div>
          </div>
        </div>
        
      </section>
      <section id="area_bot">
      <div class="container">
        <div class="row">
            <div class="col-md-6">
              <form method="post" target = "_blank" class="text-center" action="../php/generarPDF.php?id_hon=<?=$id?>">
                <input id="enviar_PDF" type="submit" name="button1" class="btn btn-primary" value="Generar PDF" />
              </form>
            </div>
             
            <div class="col-md-6">
              <form method="post" class="text-center" action="funDesc.php">
                <div class="fb-share-button" data-href="http://hongopedia.me/paginas/ficha.php?id_hon=<?=$_GET['id_hon']?>" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fhongopedia.me%2Fpaginas%2Fficha.php%3Fid_hon%3D14&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a></div>
              </form>
            </div>
        </div>
      </div>
      </section>
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
