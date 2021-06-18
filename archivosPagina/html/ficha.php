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
  <link href="../css/ficha.css" rel="stylesheet"/>
  </head>   
  <body> 
	  <header id="encabezado_sitio">
    	<img id="site_logo" src="../img/mushroom.svg" alt="Logo del sitio" width="80" height="60"/>
        <h1>Hongopedia</h1>
      </header>
      <nav>
          <ul>
            <li><a href="../index.html"> Inicio </a></li>
            <li><a href="buscar.html">Buscar</a></li>
            <li><a href="aportar.html">Aportar</a></li>
            <li><a href="cuenta.html">Cuenta</a></li>
            <li><a href="acerca.html">Acerca de</a></li>
          </ul>
      </nav>
    <main>
      <section id="area_principal">
              <?php
                session_start();
                $id = $_SESSION['id_hon'];
                require_once '../php/cargar_ficha.php';
                $cargar = new cargar();
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
              ?>
        <div class="contenedor">
          
          <div class="foto_izquierda">
            <div class="foto1">
              <img id="foto_inferior" src=<?php echo $inferior ?> alt="Logo" width="200" height="140"/>
              <span class="texto1">inferior</span>
            </div>
            <div class="icono1">
              <img id="foto_inferior" src=<?php echo $icono ?> width="60" height="60"/>
              <span class="texto_icono1">Clasificación: <?php echo utf8_encode($clasificacion) ?></span>
            </div>
          </div>
          <div class="descripcion">
            <h1><?php echo $nom_cientifico ?></h1>
            <p class="desc">Nombre vulgar: <?php echo utf8_encode($nom_cientifico) ?></p>
            <p class="desc">Familia: <?php echo utf8_encode($fami) ?></p> 
            <p class="desc">Habitat: <?php echo utf8_encode($habitat) ?></p> 
            <p class="desc">Color: <?php echo utf8_encode($color) ?></p> 
            <p class="desc">Area: <?php echo utf8_encode($area) ?></p> 
            <p class="desc">Ubicación: <?php echo utf8_encode($ubicacion) ?></p> 
            <p class="desc">Habito: <?php echo utf8_encode($habito) ?></p> 
            <p class="desc">Temporada: <?php echo utf8_encode($temporada) ?></p> 
            <p class="desc">Pileo: <?php echo utf8_encode($pileo) ?></p> 
            <p class="desc">Himenéforo: <?php echo utf8_encode($hime) ?></p>
            <p class="desc">Estípite: <?php echo utf8_encode($esti) ?></p>
            <p class="desc">Altura: <?php echo utf8_encode($fami) ?></p>
            <p class="desc">Observación: <?php echo utf8_encode($observacion) ?></p>
          </div>
          <div class="fotos_derecha">
            <div class="foto2">
              <img id="foto_superior" src=<?php echo $superior ?> alt="Logo1" width="200" height="140"/>
              <span class="texto2">Superior</span>
            </div>
            <div class="foto3">
              <img id="foto_mano" src=<?php echo $rel_mano ?> alt="Logo2" width="200" height="140"/>
              <span class="texto3">Relación mano</span>
            </div>
            <div class="foto4">
              <img id="foto_lateral" src=<?php echo $lateral ?> alt="Logo3" width="200" height="140"/>
              <span class="texto4">Lateral</span>
            </div>
          </div>
          
        </div>
        
      </section>
      <section id="area_bot">
        <form method="post" class="botones" action="../php/cargar_ficha.php">
          <input id="enviar_PDF" type="submit" name="button1" class="button" value="Enviar PDF al correo" />
        </form>
        <form method="post" class="botones" action="funDesc.php">
          <input id="compartir_facebook" type="submit" name="button1" class="button" value="Compartir hongo en Facebook" />
        </form>
      </section>
      </main>
    </body>
</html>
