<?php


//phpinfo();


require_once 'model.php';

//phpinfo();



if (file_exists($_FILES['csv_aportadoADM']['tmp_name'])) {
    
    $model =new Model();

    $model->archivo_csv=$model->GenereNombreAleatorio(6);
    $model->ruta="csv/";

    //echo($model->GenereNombreAleatorio(6));
    $model->Aporte_csv();
    header("refresh:4;url=HTTP://35.223.146.57/html/aportar.html");

}else {
  
    echo "<h1>InCorrecto</h1>";
      
      header("refresh:0;url=HTTP://35.223.146.57/html/aportar.html");



}



/*
$serverName = "35.224.8.47"; //serverName\instanceName
$connectionInfo = array( "Database"=>"GestionHongos", "UID"=>"sqlserver", "PWD"=>"honguit0s");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
  echo "Connection established.<br />";
}else{
  echo "Connection could not be established.<br />";
  die( print_r( sqlsrv_errors(), true));
}
sqlsrv_close( $conn );
*/
?>