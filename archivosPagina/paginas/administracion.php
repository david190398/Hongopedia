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
					<li class="nav-item">
						<a class="nav-link hover"href="buscar.php">Buscar</a>
					</li>
					

					<?php
						// session_cache_limiter('private_no_expire'); // para que no se tenga que confirmar el envio de formulario manualment
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
							echo "<li class='nav-item active'><a href=\"administracion.php\" class='nav-link '>Administración</a></li>" ;
						}
					?>
				</ul>
			</div>
		</div>
		  </nav>
	  <main>
		<?php
			if ($_SESSION["tipo_usuario"] != 3){	/* Si no es un administrador, no debería estar aquí */
				header('Location: ../index.php');
			}
			$_SESSION["pagina_anterior"] = 'administracion.php';
		?>
	  <br>
	  <section style="margin-left: 1%; ">
		<?php 
		sleep(1);
		session_start();
		error_reporting(0); /* Para que no reporte el error cuando $_SESSION["tipo_usuario"] == NULL al entrar la primera vez */
		
		
		// Administrar usuarios
		$queryUser = "SELECT (id_usuario), (correo), (es_admin), (contrasena) FROM GestionHongos.dbo.Usuarios ORDER BY es_admin desc";
		$resUser = sqlsrv_query($conn, $queryUser);
		if($resUser === false) {
			die( print_r( sqlsrv_errors(), true));
		}
		$rowsUser = sqlsrv_has_rows($resUser);
		if($rowsUser === true){
		
			?>
			<p>
				<button class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					<span style="font-size: 150%; font-weight: bold; color: black; "> Administrar usuarios</span>
				</button>
			</p>
			<div class="collapse" id="collapseExample">
			<div class="card card-body" style="background-color: #FFF2CC;">
			
			<div class="container" style="width: 100%; " >
            <div class="row justify-content-center">
            <div class="col-auto">

			<?php 
			$numeroUser=1;
			$encabezadoUser=1;
			$encontradoUser=false;
			while($rowUser=sqlsrv_fetch_array($resUser)){
				$encontradoUser=true;
				if($encabezadoUser==1){
					$encabezadoUser=0;
					?>
					<table class="table table-responsive table-hover text-center" >
					<thead class="table-danger text-dark " >
						<tr>
							<th style="border-color:black;" scope="col">#</th>
							<th style="border-color:black;" scope="col">Correo</th>
							<th style="border-color:black;" scope="col">Permisos</th>
							<th style="border-color:black;" scope="col">Administrar</th>
						</tr>
					</thead>
					<?php
				}
				
				if ($rowUser[0] != $_SESSION["id_usuario"] and $rowUser[3] != 'dead'){	//Mi usuario actual no debe salir en la tabla
					?>
					<tr>
						<?php
						$permisosUser = "Administrador";
						if($rowUser[2] != 1){
							$permisosUser = "Usuario corriente";
						}
						?>
						<tbody>
			

						<!-- <td align="center"><img src=<?=$nom_imagen?> alt="" border=3 height=100 width=100></img></td> -->
						
						<td style="border-color:black; vertical-align:middle;" scope="col"><?=$numeroUser?></td>

						<!-- <td align="center"><?=$row[1]?></td> -->
						<td style="border-color:black;vertical-align:middle; " scope="col"><?=$rowUser[1]?></td>

						<!-- <td align="center"><?=$row[2]?></td> -->
						<td style="border-color:black; vertical-align:middle; " scope="col"><?=$permisosUser?></td>

						<!-- <td align="center"><a href="ficha.php?id_hon=<?=$row[0]?>"><img  src="../img/Default/lupa_busqueda.png" alt="" border=1 height=50 width=50></img></a></td> -->
						<td colspan="2" style="border-color:black; vertical-align:middle;  " scope="col">
							<div class="form-row" style="margin-top:8%; ">
								<div class="form-group">
									<form method="POST" action="../php/modificar_usuario_administrador.php" enctype="multipart/form-data">
										<input type="hidden"  id="id_usuario" name="id_usuario" value="<?php echo $rowUser[0] ; ?>">
										<input type="hidden"  id="permisosUsuario" name="permisosUsuario" value="<?php echo $rowUser[2] ; ?>">
										<input type="hidden"  id="accion" name="accion" value="<?php echo 0; ?>">
										<input type="submit" class="<?php if($rowUser[2] == 1){ echo "btn btn-warning";} else{ echo "btn btn-success";} ?>" id="boton_modificar_permisos_usuario" name="boton_modificar_permisos_usuario" value="<?php if($rowUser[2] == 1){ echo "Degradar";} else{ echo "Ascender";} ?>" />
									</form>
								</div>
								<div class="form-group ">
									<p><span style="color:  #ffffff00; ">12</span></p>
								</div>
				
								<div class="form-group">
									<form method="POST" action="../php/modificar_usuario_administrador.php" enctype="multipart/form-data">
										<input type="hidden"  id="id_usuario" name="id_usuario" value="<?php echo $rowUser[0] ; ?>">
										<input type="hidden"  id="accion" name="accion" value="<?php echo 1; ?>">
										<input type="submit" class="btn btn-danger" id="boton_eliminar_usuario" name="boton_eliminar_usuario" value="Eliminar usuario" />
									</form>
								</div>
							</div>
						</td>
					</tr>
					
					<?php
					$numeroUser++;
				}
			}
		}//cierra el if de si hay rows en la query 
		if($encontradoUser == false){
		?>
			<div class=" text-center " style="width: 75%;">
				<h2>Sin resultados de usuarios</h2><br>
			</div>
		<?php	
		}
		?>
		</table>
		</div>
		</div>
		</div>
		
		</div>
		</div>
		
		<br />
		<br />
		
		
		
		
		
		
		
		<?php
		// Administrar hongos
		
		$query = "SELECT (id_hongo), (nomb_cient), (nomb_vulgar), (img_sup), (img_inf), (img_lat), (tupla_valida) FROM GestionHongos.dbo.Hongos ORDER BY tupla_valida";
		$res = sqlsrv_query($conn, $query);
		if($res === false) {
			die( print_r( sqlsrv_errors(), true));
		}

		//Se crea la tabla
		$rows = sqlsrv_has_rows($res);
		if($rows === true){

			?>

            <div style="width: 75%;" >
				<h3 >Administrar información de los hongos</h3><br>
			</div>

            <div class="container" style="width: 100%; " >
            <div class="row justify-content-center">
          
            <div class="col-auto">

          

			<?php 
			$numero=1;
			$encabezado=1;
			$encontrado=false;
			while($row=sqlsrv_fetch_array($res)){
				$encontrado=true;
				if($encabezado==1){
					$encabezado=0;
					?>
					<table class="table table-responsive table-hover text-center" >
					<thead class="table-danger text-dark " >
						<tr>
							<th style="border-color:black;" scope="col">Foto</th>
							<th style="border-color:black;" scope="col">Nombre científico</th>
							<th style="border-color:black;" scope="col">Nombre vulgar</th>
							<th style="border-color:black;" scope="col">Estado de los datos</th>
							<th style="border-color:black;" scope="col">Administrar</th>
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
					} else{
						if($row[3]!=""){
							$nom_imagen=$row[3];
						} else{
							if($row[4]!=""){
								$nom_imagen=$row[4];
							} else{
								$nom_imagen="../img/Default/hongo_default.svg"; // no tiene ninguna imagen se debe poner la imagen predeterminada
							}
						}
					}
					
					$nom_vulgar="---";
					if($row[2]!=""){
						$nom_vulgar=$row[2];
					}
					
					$nom_cient = "---";
					if ($row[1] != ""){
						$nom_cient = $row[1];
					}
					
					$tupla_valida = "Aceptados";
					if ($row[6] == 0){
						$tupla_valida = "En espera por revisión";
					}
					
					?>
					<tbody>
		
					
					<td style="border-color:black; vertical-align:middle;" scope="col"><img  src="<?=$nom_imagen?>" alt="" border=1 height=90 width=100></img></td>

					<td style="border-color:black;vertical-align:middle; " scope="col"><?=$nom_cient?></td>

					<td style="border-color:black; vertical-align:middle; " scope="col"><?=$nom_vulgar?></td>
					
					<td style="border-color:black; vertical-align:middle; " scope="col"><?=$tupla_valida?></td>
					
					<td colspan="2" style="border-color:black; vertical-align:middle; " scope="col">
						<div class="form-row" style="margin-top:7%; ">
							<div class="form-group">
								<a class="btn btn-primary" href="administrar_hongo.php?id_hon=<?=$row[0]?>" role="button" style="float: right; " >Modificar información</a>
							</div>
							<div class="form-group ">
								<p><span style="color:  #ffffff00; ">12</span></p>
							</div>
							<div class="form-group">
								<form method="POST" action="../php/eliminar_hongo.php" enctype="multipart/form-data">
									<input type="hidden"  id="id_hong" name="id_hong" value="<?php echo $row[0] ; ?>">
									<input type="submit" class="btn btn-danger" id="boton_borrar_hongo" name="boton_borrar_hongo" value="Eliminar hongo" />
								</form>
							</div>
						</div>
					</td>
					
				</tr>
				
				<?php
				$numero++;
			}
		}//cierra el if de si hay rows en la query 
		if($encontrado==false){
		?>
			<div class=" text-center " style="width: 75%;">
				<h2>Sin resultados de hongos</h2><br>
				<!-- <td bgcolor="#ffffff" align="center" height=20 width=100><a href="../paginas/buscar.php">Volver</a></td> -->

				<a class="btn btn-danger" href="../index.php" role="button" style="float: middle;" >Regresar a Inicio</a>
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
		</div>
		<br><br>
	  </section>
	  </main>
	</body>
</html>