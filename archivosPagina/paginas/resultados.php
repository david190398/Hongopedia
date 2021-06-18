<?php 

$serverName = "35.224.8.47"; //serverName\instanceName
    $connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if( $conn === false ) {
      die( print_r( sqlsrv_errors(), true));
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
	<main>

  <br>
 
      <?php 
      
      sleep(1);

      session_start();
      error_reporting(0); /* Para que no reporte el error cuando $_SESSION["tipo_usuario"] == NULL al entrar la primera vez */
      
      if($_SESSION["query"]==NULL){
        $wheres = array();
        if (!empty($_POST['nombre_buscar'])) {
          $wheres[] = 'nomb_cient like \'%'.$_POST['nombre_buscar'].'%\' OR nomb_vulgar like  \'%'.$_POST['nombre_buscar'].'%\'';
        }
        if (!empty($_POST['clasificacion_buscar'])) {
            $wheres[] = 'clasificacion = '.$_POST['clasificacion_buscar'];
          
        }
        if (!empty($_POST['habito_buscar'])) {
          $wheres[] = 'habito = '.$_POST['habito_buscar'];
        
        }
        if (!empty($_POST['area_de_conservacion_buscar'])) {
          $wheres[] = 'id_area_consv = '.$_POST['area_de_conservacion_buscar'];
        
        }
        if (!empty($_POST['familia_buscar'])) {
          $wheres[] = 'familia = \''.$_POST['familia_buscar'].'\'';
        }
        if (!empty($_POST['temporada_buscar'])) {
          $wheres[] = 'temporada = \''.$_POST['temporada_buscar'].'\'';
        }

        if ((!empty($_POST['fecha_inicio_buscar'])) && (!empty($_POST['fecha_final_buscar']) )) { // si se proporcionan las dos fechas
          if($_POST['fecha_inicio_buscar'] <= $_POST['fecha_final_buscar'] ){
            $wheres[] = 'fecha_avista between \''.$_POST['fecha_inicio_buscar'].'\' AND  \''.$_POST['fecha_final_buscar'].'\'';
            //echo ("la fecha viene bien ordenada");
          }else{
            $wheres[] = 'fecha_avista between \''.$_POST['fecha_final_buscar'].'\' AND  \''.$_POST['fecha_inicio_buscar'].'\'';
            //echo ("la fecha viene mal ordenada");
          }
        }else{
          if (!empty($_POST['fecha_inicio_buscar'])) {

            $wheres[] = 'fecha_avista >= \''.$_POST['fecha_inicio_buscar'].'\'';

          }else{
            if (!empty($_POST['fecha_final_buscar'])) {

              $wheres[] = 'fecha_avista <= \''.$_POST['fecha_final_buscar'].'\'';
            }
          }
        }

        if ((!empty($_POST['altitud_desde_buscar'])) && (!empty($_POST['altitud_hasta_buscar']) )) { // si se proporcionan las dos alturas
          if($_POST['altitud_desde_buscar'] <= $_POST['altitud_hasta_buscar'] ){
            $wheres[] = 'altura_avisto between '.$_POST['altitud_desde_buscar'].' AND  '.$_POST['altitud_hasta_buscar'].'';
            //echo ("la altitud viene bien ordenada");
          }else{
            $wheres[] = 'altura_avisto between '.$_POST['altitud_hasta_buscar'].' AND  '.$_POST['altitud_desde_buscar'];
            //echo ("la altitud viene mal ordenada");
          }
        }else{
          if (!empty($_POST['altitud_desde_buscar'])) {

            $wheres[] = 'altura_avisto >= '.$_POST['altitud_desde_buscar'];

        }else{
          if (!empty($_POST['altitud_hasta_buscar'])) {

            $wheres[] = 'altura_avisto <= '.$_POST['altitud_hasta_buscar'];
          }
        }
      }

      // todos los parametros listos


      $query = "SELECT (id_hongo), (nomb_cient), (nomb_vulgar), (img_sup), (img_inf), (img_lat) FROM GestionHongos.dbo.Hongos WHERE tupla_valida=1";

      if (!empty($wheres)) {
        $query .= " AND " . implode(' AND ', $wheres);
      }

      $_SESSION["query"]=$query;//guardo la query globalmente


      }else{
        $query = $_SESSION["query"]; //la actualizo
        //echo("uso session");
      }
      
    //echo($query);

    //echo($_SESSION["query"]);

      $res = sqlsrv_query($conn,$query);
      if( $res === false ) {
        die( print_r( sqlsrv_errors(), true));
      }

     //Se crea la tabla
      ?>
        
          <?php 

          $rows = sqlsrv_has_rows( $res );

          if($rows === true){

          ?>

            <div class=" text-center " style="width: 75%;">
            

            <h3 >Resultados de la búsqueda</h3><br>
            
            <form action="resultados.php"  method="POST" enctype="multipart/form-data" >
            <div class="form-check form-check-inline" >
              <input class="form-check-input" type="radio" name="radio_opt" id="inlineRadio1" value="op1" onchange="this.form.submit()" <?php echo ($_POST["radio_opt"]== 'op1') ?  "checked" : "" ;  ?> <?php echo ($_POST["radio_opt"]== '') ?  "checked" : "" ;  ?> >
              <label class="form-check-label" for="inlineRadio1">Tabla</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="radio_opt" id="inlineRadio2" value="op2" onchange="this.form.submit()" <?php echo ($_POST["radio_opt"]== 'op2') ?  "checked" : "" ;  ?>>
              <label class="form-check-label" for="inlineRadio2">Fotografías</label>
            </div>
            
            <a class="btn btn-success  " href="../paginas/buscar.php" role="button" style="float: right;" >Volver</a>
            </form>
        </div>

        <br> <br>

            

          

      <?php 

      if(($_POST["radio_opt"] =="") || ($_POST["radio_opt"] =="op1") ){
        $numero=1;
        $encabezado=1;
        $encontrado=false;
        while($row=sqlsrv_fetch_array($res)){
          $encontrado=true;
          if($encabezado==1){
            $encabezado=0;
          ?>
          <div class="container" style="width: 100%; " >
            <div class="row justify-content-center">
          
            <div class="col-auto">

          <table class="table table-responsive table-hover text-center" >
          <thead class="table-danger text-dark " >
          <tr>
            
            <th style="border-color:black;" scope="col">Foto</th>
            <th style="border-color:black;" scope="col">Nombre científico</th>
            <th style="border-color:black;" scope="col">Nombre vulgar</th>
            <th style="border-color:black;" scope="col">Descripción</th>
          </tr>
          </thead>
          <?php
        }
      ?>
      
      <tr>
        <?php
        $nom_imagen="";
        if($row[5]!=""){

          $nom_imagen=$row[5];
          
          
        }else{

          if($row[3]!=""){
            $nom_imagen=$row[3];
            

          }else{
            if($row[4]!=""){

              $nom_imagen=$row[4];

            }else{

              $nom_imagen="../img/Default/hongo_default.svg"; // no tiene ninguna imagen se debe poner la imagen predeterminada
            }

          }

        }
        $nom_vulgar="---";
        if($row[2]!=""){

          $nom_vulgar=$row[2];
          
          
        }
        //$_SESSION['id_hon'] = $row[0];
        
        ?>
        <tbody>
        

        <!-- <td align="center"><img src=<?=$nom_imagen?> alt="" border=3 height=100 width=100></img></td> -->
        
        <td style="border-color:black; vertical-align:middle;" scope="col"><img  src="<?=$nom_imagen?>" alt="" border=1 height=90 width=100></img></td>

        <!-- <td align="center"><?=$row[1]?></td> -->
        <td style="border-color:black;vertical-align:middle; " scope="col"><?=$row[1]?></td>

        <!-- <td align="center"><?=$row[2]?></td> -->
        <td style="border-color:black; vertical-align:middle; " scope="col"><?=$nom_vulgar?></td>

        <!-- <td align="center"><a href="ficha.php?id_hon=<?=$row[0]?>"><img  src="../img/Default/lupa_busqueda.png" alt="" border=1 height=50 width=50></img></a></td> -->
        <td style="border-color:black; vertical-align:middle;  " scope="col"><a href="ficha.php?id_hon=<?=$row[0]?>"><img  src="../img/Default/lupa_busqueda.png" alt="" border=1 height=90 width=100 ></img></a></td>
        
      </tr>
      <?php
      $numero++;
      }

      }else{


      //fotografias
      ?>

      <div class="container"  >
      
      <div class="row row-cols-sm-2 row-cols-md-5  text-center justify-content-center">
          

      <?php
      $encontrado=false;
      $contador=0;
      while($row=sqlsrv_fetch_array($res)){
        
        $encontrado=true;
        
        $nom_imagen="";
        if($row[5]!=""){

          $nom_imagen=$row[5];
          
          
        }else{

          if($row[3]!=""){
            $nom_imagen=$row[3];
            

          }else{
            if($row[4]!=""){

              $nom_imagen=$row[4];

            }else{

              $nom_imagen="../img/Default/hongo_default.svg"; // no tiene ninguna imagen se debe poner la imagen predeterminada
            }

          }

        }
        $nom_hongo="---";
        if($row[1]!=""){
          $nom_hongo=$row[1];
        }else{
          if($row[2]!=""){
            $nom_hongo=$row[2];
          }
        }
        
        ?>
        
        
          <div class="col">
          
          <a href="ficha.php?id_hon=<?=$row[0]?>"><img  src="<?=$nom_imagen?>" alt="" border=1 height=130 width=130 ></img></a><p align="bottom"><?=$nom_hongo?></p></td>
          
          </div>
        

        <?php
        

        }

        ?>
      </div>
      <?php
      }
    }//cierra el if de si hay rows en la query 
      if($encontrado==false){
      ?>
        <div class=" text-center " style="width: 75%;">
        <h2>Sin resultados de búsqueda</h2><br>
        <!-- <td bgcolor="#ffffff" align="center" height=20 width=100><a href="../paginas/buscar.php">Volver</a></td> -->

        <a class="btn btn-danger" href="../paginas/buscar.php" role="button" style="float: middle;" >Regresar para realizar otra búsqueda</a>
        </div>
      <?php
      }else{
      ?>
      
      <?php
      }
      ?>
      </table>

      </div>
  </div>
  <br><br>
  </main>
  </body>
</html>