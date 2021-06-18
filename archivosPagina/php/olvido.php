<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
date_default_timezone_set('Etc/UTC');
    require_once 'registro.php';
    require_once '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require_once '../../vendor/phpmailer/phpmailer/src/SMTP.php';
    require_once '../../vendor/phpmailer/phpmailer/src/Exception.php';
    require_once 'registro.php';
session_start();
    function olvidoCon(){
        $registro = new registro();
        $conn = $registro->conectarse();
        $data = $registro->existe($_POST["correoR"]);
        if($data === "") {
            $_SESSION["correoInvalido"]= 1; 
            header('Location: ../paginas/cuenta.php');
            die();
        } else {
            $a = mt_rand(100000,999999);
            echo $a;
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'smtp.sendgrid.net';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'apikey';
            $mail->Password = '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';
            //Set who the message is to be sent from
            $mail->setFrom('hongopediame@gmail.com', 'Equipo de soporte Hongopedia.me');
            //Set an alternative reply-to address
            $mail->addReplyTo('hongopediame@gmail.com', 'Hongopedia');
            //Set who the message is to be sent to
            $mail->addAddress($_POST["correoR"]);
            $mail->Subject = 'Hongopedia: Nueva contrasena ';
            $mail->Body = "Estimado usuario la contraseña de su cuenta ha sido cambiada, su nueva contraseña es $a, una vez inicie sesión puede cambiar su contraseña.";
            //send the message, check for errors
            $id = $registro->obtenerId($_POST["correoR"]);
            $registro->cambiar_contrasena($id, $a);
            if (!$mail->send()) {
            } else {
            }
            $_SESSION["enviado"] = 1;
            header('Location: ../paginas/cuenta.php');
        }
        sqlsrv_close($conn);
        die();
    }
    olvidoCon();
?>