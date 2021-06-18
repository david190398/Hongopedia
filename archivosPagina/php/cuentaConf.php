<?php
require_once 'registro.php';
session_start();
    function cuentaS(){
        $registro = new registro();
        $conn = $registro->conectarse();
        $data = $registro->existe($_POST["correo"]);
        if($data !== "") {
            $_SESSION["existeCorreo"] = 1;
            header('Location: ../paginas/cuenta.php');
            die();
        } else {
            $registro->registrar_nuevo($_POST["correo"],$_POST["password"]);
            $_SESSION["id_usuario"] = $registro->obtenerId($_POST["correo"]);
            $_SESSION["tipo_usuario"] = 2;
            header('Location: ../paginas/informacionUsuario.php');
        }
        $_SESSION["esGoogle"] = 0;
        sqlsrv_close($conn);
        die();
    }
    cuentaS();
?>
