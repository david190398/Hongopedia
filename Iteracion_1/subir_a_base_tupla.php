<?php

require_once 'model.php';

//instancia

if (isset($_POST)) {

    $model =new Model();


    $model->tupla_aceptada=1;//si la tupla fue aceptada como informacion valida
    $model->id_user=1; //id de la fuente que agregra la informacion
    
    $model->nom_cientifico=$_POST["nombre_cientifico_aportadoADM"];
    $model->nom_vulgar=$_POST["nombre_vulgar_aportadoADM"];
    $model->familia=$_POST["familia_aportadoADM"];
    $model->habitat=$_POST["hábitat_aportadoADM"];
    $model->color=$_POST["color_aportadoADM"];
    $model->area=$_POST["area_de_conservacion_aportadoADM"];
    $model->habito=$_POST["habito_aportadoADM"];
    $model->ubicacion=$_POST["ubicacion_aportadoADM"];
    $model->temporada=$_POST["temporada_aportadoADM"];
    $model->clasificacion=$_POST["clasificación_aportadoADM"];
    $model->pileo=$_POST["pileo_aportadoADM"];
    $model->himeonoforo=$_POST["himenoforo_aportadoADM"];
    $model->estipite=$_POST["estipite_aportadoADM"];
    $model->fecha=$_POST["fecha_del_avistamiento_aportadoADM"];
    $model->altura=$_POST["altura_del_avistamiento_aportadoADM"];
    $model->observacion=$_POST["observaciones_aportadoADM"];
    
    
    $ruta_img_sup="";
    $ruta_img_inf="";
    $ruta_img_lat="";
    $ruta_img_mano="";
    
    
    $prefijo=$model->GenereNombreAleatorio(6)."_";
    //inicio prueba subir imagen
    //Comprobamos que no este vacio nuestro input file.
    if (file_exists($_FILES['imagen_superior_aportadoADM']['tmp_name'])) {
        $ruta_img_sup=brindeRutaImagen($prefijo, "sup_", 'imagen_superior_aportadoADM');
        echo "<img src=$ruta_img_sup border='0' width='300' height='100'>"; //imprime la imagen en el php
    }

    if (file_exists($_FILES['imagen_inferior_aportadoADM']['tmp_name'])) {
        $ruta_img_inf=brindeRutaImagen($prefijo, "inf_", 'imagen_inferior_aportadoADM');
        echo "<img src=$ruta_img_inf border='0' width='300' height='100'>"; //imprime la imagen en el php
    }

    if (file_exists($_FILES['imagen_lateral_aportadoADM']['tmp_name'])) {
        $ruta_img_lat=brindeRutaImagen($prefijo, "lat_",'imagen_lateral_aportadoADM');
        echo "<img src=$ruta_img_lat border='0' width='300' height='100'>"; //imprime la imagen en el php
    }
    

    if (file_exists($_FILES['imagen_relacion_mano-hongo_aportadoADM']['tmp_name'])) {
        $ruta_img_mano=brindeRutaImagen($prefijo, "mano_",'imagen_relacion_mano-hongo_aportadoADM');
        echo "<img src=$ruta_img_mano border='0' width='300' height='100'>"; //imprime la imagen en el php
    }
    
    
    //fin prueba subir imagen
    
    $model->img_sup=$ruta_img_sup;//$_POST["imagen_superior_aportadoADM"];
    $model->img_inf=$ruta_img_inf;//$_POST["observaciones_aportadoADM"];
    $model->img_lat=$ruta_img_lat;//$_POST["observaciones_aportadoADM"];
    $model->img_mano=$ruta_img_mano;//$_POST["observaciones_aportadoADM"];
    
    
    $res=$model->Aporte();

    if($res>0){

        
        header("refresh:4;url=http://http://35.223.146.57/html/aportar.html");
    
    }
    
}else{

    echo "<h1>InCorrecto</h1>";
    
    header("refresh:4;url=http://localhost/pruebaConectar/archivosPagina/html/aportar.html");

}



function brindeRutaImagen($pref, $tipo, $nom_archivo){
    $carpeta="";
    //Definido y no NULL nuestro formulario.
    
    //obtenemos datos imagen.
    $file = $_FILES[$nom_archivo];
    $nombre_img = $file["name"];            
    $extencion_img = $file["type"];
    $ruta_temporal = $file["tmp_name"];
    $tamano_img = $file["size"];
    $dimensiones = getimagesize($ruta_temporal);
    $ancho = $dimensiones[0];
    $altura = $dimensiones[1];
    $carpeta = "/imgs/$nombre_img";
    //echo ('Tengo el archivo ');
    //echo ($extencion_img);

    //echo '<pre>';
    //print_r($_FILES);
    //echo '</pre>';


    $img_error = true;

    //Comprobaciones error (¡Esto es a gusto colores!).
    if ($extencion_img != 'image/jpeg' && $extencion_img != 'image/jpg' && $extencion_img != 'image/png' && $extencion_img != 'image/gif') {
        echo "<b>$nombre_img</b>, no es una imagen valido, un imagen con extensión valido podría ser entre (.jpg, .jpeg, .png o .gif).";                      
    } else { //Imagen correcto.
        //Reseteo error en false.       
        $img_error = false;
    }

    $carpeta="../img/HongosBaseDatos/";
    $nombre_img= $pref.$tipo.$nombre_img;
    $carpeta=$carpeta.$nombre_img;
    //Verdadero imagen.
    if ($nombre_img && $img_error===false) {
        //Cargamos imagen al servidor.
        if(move_uploaded_file($ruta_temporal,"../img/HongosBaseDatos/".$nombre_img)) { 
            echo "Foto subida correctamente";          
        } else { //Falso, imagen no cargo.          
            echo "No se pudo guardar la foto.";   
            echo "Not uploaded because of error #".$_FILES["file"]["error"];
        }
    }

    return $carpeta;
}



?> 