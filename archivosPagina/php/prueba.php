<!DOCTYPE html>
<html lang="es"> 
	<head>
		<link  rel="icon"   href="img/mushroom.svg" type="image/png" /> 
		
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
			<a class="navbar-brand" href="index.php">
			<img id="site_logo" src="img/mushroom.svg" alt="Logo del sitio" style="" width="30" height="30" class="d-inline-block align-top" alt="">
			  Hongopedia
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link"href="paginas/buscar.php">Buscar</a>
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
							echo "<li class='nav-item'><a href=\"paginas/aportar.php\" class='nav-link '>Aportar</a></li>";
						}
						
						if ($_SESSION["tipo_usuario"] == 1 ){	/* Cuenta */
							echo "<li class='nav-item'><a href=\"paginas/cuenta.php\" class='nav-link '>Cuenta</a></li>" ;
						}
						else {
							echo "<li class='nav-item'><a href=\"paginas/informacionUsuario.php\" class='nav-link '>Cuenta</a></li>";
						}
					?>
					<li class='nav-item'>
						<a href="paginas/acerca.php" class='nav-link' >Acerca de</a>
					</li>
					<?php
						if ($_SESSION["tipo_usuario"] == 3 ){	/* Administrar hongos es solo para administradores */
							echo "<li class='nav-item'><a href=\"paginas/administracion.php\" class='nav-link '>Administración</a></li>" ;
						}
					?>
				</ul>
			</div>
		</div>
		  </nav>
		<main>
        <?php



/**
* This example shows making an SMTP connection with authentication.
*/
//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//Create a new PHPMailer instance
require_once '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../../vendor/phpmailer/phpmailer/src/SMTP.php';
require_once '../../vendor/phpmailer/phpmailer/src/Exception.php';

$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.sendgrid.net';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = 'apikey';
//Password to use for SMTP authentication
$mail->Password = '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';
//Set who the message is to be sent from
$mail->setFrom('hongopediame@gmail.com', 'Equipo de soporte Hongopedia.me');
//Set an alternative reply-to address
$mail->addReplyTo('hongopediame@gmail.com', 'Hongopedia');
//Set who the message is to be sent to
$mail->addAddress('marcos.metal20@hotmail.com');
//Set the subject line
$mail->Subject = 'PHPMailer SMTP test';
$mail->Body = "Esta es una prueba de correo"; // Mensaje a enviar
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
echo 'Message sent!';
}








		$contraseña = "newcontra2";
		echo "entra al codigo incio";

	
        /*$fina = password_hash($contraseña, PASSWORD_DEFAULT);
        echo $fina;
        $correcta = "Juanñajo";
        if(password_verify($correcta, $fina)){
            echo "contraseña correcta";
        } else{
            echo "contraseña incorrecta";
        }*/
        ?>
		  <section style="margin-left: 1% ; ">
			<section id ="area_principal">
				<div class="row">
					<section id="imagen_principal" class="col-md-4">
						</br>
						<a><img src="img/mushroomGrande.svg" alt="Sección intro" /></a>
					</section>
					<?php
						//$_SESSION["1"]
						session_start();
						$_SESSION["existeCorreo"] = 0;
						$_SESSION["passwordIncorrecto"] = 0;
						$_SESSION["correoInvalido"] = 0;
						$_SESSION["esGoogle"] = 1;
						/// echo $_SESSION["tipo_usuario"];
					?>
					<section id="area_texto" class="col-md-8" >
						</br>
						</br>
						<h2>Gestión de hongos</h2>
						<p>Esta página se encarga de recopilar información sobre hongos para que estén al acceso de todos, 
						  cada hongo registrado 
						  tiene una ficha con más detalles. </p>
						</br>
						<h6>Entre las principales funcionalidades se pueden destacar:</h6>
						</br>
						<ul class="list-unstyled">
							<li>
						<ul>
							<li>Base de datos dinámica: los usuarios pueden aportar a la base y hacer que esta crezca, 
								de esta forma
								involucramos a los usuarios y nos aseguramos que la base nunca se estanque.</li>
							</br>
							<li>Filtros de búsqueda específicos: Permite encontrar el hongo deseado 
								rápidamente y facilita la navegación.</li>
							</br>
						</ul>
						</br>
						<form method="post" action="funDesc.php">
							<input id="descargarCSVCompleto" type="submit" name="button1" class="button" value="Descargar información de los hongos en CSV" />
						</form>
					</section>
				</div>
			</section>
		  </section>
        </main>
		<footer>
		</footer>
    </body>
</html>