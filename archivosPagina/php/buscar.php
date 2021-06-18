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
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="author" content="Grupo Gestion de Hongos"/>
	<meta name="keywords" content="hongos, wiki, gestion"/>
	<meta name="generator" content="Grupo Gestion de Hongos" />
	<title>Gestion de Hongos</title>
	<link href="../css/resultados.css" rel="stylesheet"/>
  </head>   
  <body> 
	<header id="encabezado_sitio">
		<img id="site_logo" src="../img/mushroom.svg" alt="Logo del sitio" width="80" height="60"/>
		<h1>Hongopedia</h1>
	</header>
	<nav>
		<ul>
			<li><a href="../index.html"> Inicio </a></li>
			<li><a href="../html/buscar.html">Buscar</a></li>
			<li><a href="../html/aportar.html">Aportar</a></li>
			<li><a href="../html/cuenta.html">Cuenta</a></li>
			<li><a href="../html/acerca.html">Acerca de</a></li>
		</ul>
	</nav>
	<main>


  <h2 style="margin-left: 10%" >Resultados de la búsqueda:</h2><br><br>
  <table id="table1" style="margin-left: 10%" border="1" bordercolor="black">
  
    <?php 

    $wheres = array();
    if (!empty($_POST['nombre_buscar'])) {
      $wheres[] = 'nomb_cient = \''.$_POST['nombre_buscar'].'\' OR nomb_vulgar =  \''.$_POST['nombre_buscar'].'\'';
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
        $wheres[] = 'altura_avisto between \''.$_POST['altitud_hasta_buscar'].' AND  '.$_POST['altitud_desde_buscar'];
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


    $query = "SELECT (img_sup), (id_hongo), (nomb_cient), (nomb_vulgar) FROM GestionHongos.dbo.Hongos";

    if (!empty($wheres)) {
      $query .= " WHERE " . implode(' AND ', $wheres);
  }

  //echo($query);

    $res = sqlsrv_query($conn,$query);
    if( $res === false ) {
      die( print_r( sqlsrv_errors(), true));
    }
    
    $encabezado=1;
    $encontrado=false;
    while($row=sqlsrv_fetch_array($res)){
      $encontrado=true;
      if($encabezado==1){
        $encabezado=0;
        ?>
        <tr>
          <th align="center" height=20 width=100>Foto</td>
          <th align="center" height=20 width=120>Nombre Cientifico</td>
          <th align="center" height=20 width=120>Nombre Vulgar</td>
        </tr>
        <?php
      }
    ?>
    
    <tr>
      <td align="center"><img src=<?=$row[0]?> alt="" border=3 height=100 width=100></img></td>
      <td align="center"><?=$row[2]?></td>
      <td align="center"><?=$row[3]?></td>
    </tr>
    <?php
    }
    if($encontrado==false){
    ?>
      <h3 style="margin-left: 10%" >Sin resultados de búsqueda</h3><br>
      <td bgcolor="#ffffff" align="center" height=20 width=100><a href="../html/buscar.html">Volver</a></td>
    <?php
    }
    ?>
  </table>
  </main>
  </body>
</html>