<?php
require_once 'registro.php';
session_start();
    function cuentaS(){
        $registro = new registro();
        $conn = $registro->conectarse();
        $data = $registro->existe($_POST["correoI"]);
        if($data === "") {
            $_SESSION["correoInvalido"] = 1;
            header('Location: ../paginas/cuenta.php');
            die();
        } else {
          
            $passRegis = $registro->obtenerPass($_POST["correoI"]);
            if(password_verify($_POST["passwordI"], $passRegis)) {
              $_SESSION["id_usuario"] = $registro->obtenerId($_POST["correoI"]);
              if($registro->es_admin($_POST["correoI"])){
                $_SESSION["tipo_usuario"] = 3;
              }else{
                $_SESSION["tipo_usuario"] = 2;
              }
              header('Location: ../paginas/informacionUsuario.php');
            }else{
              $_SESSION["passwordIncorrecto"] = 1;
              header('Location: ../paginas/cuenta.php');
            } 
        }
        $_SESSION["esGoogle"] = 0;
        sqlsrv_close($conn);
        die();
    }
    cuentaS();
?>
