<?php
if (isset($_POST)) {
    session_start();
    $_SESSION['id_hon'] = $_POST['id_hongo'];
    header("refresh:0;url=http://35.223.146.57/html/ficha.php");
}
?>