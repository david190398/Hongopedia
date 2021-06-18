<?php
    session_start();
    $_SESSION["tipo_usuario"] = 1;
    $_SESSION["id_usuario"] = NULL;
    $_SESSION["esGoogle"] = 0;
    header('Location: ../paginas/cuenta.php');
    die();
?>