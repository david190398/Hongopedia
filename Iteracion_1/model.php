<?php

//modelo

class Model{

    var $id;// aun no se usa

    var $nom_cientifico;
    var $nom_vulgar;
    var $familia;
    var $habitat;
    var $color;
    var $area;
    var $habito;
    var $ubicacion;//nuevo
    var $temporada;
    var $clasificacion;
    var $pileo;
    var $himeonoforo;
    var $estipite;
    var $fecha;
    var $altura;
    var $observacion;

    //IMAGENES
    var $img_sup;
    var $img_lat;
    var $img_inf;
    var $img_mano;

    //Para aportar csv
    var $archivo_csv;
    var $ruta;

    //Otras de configuracion
    var $id_user=1; // id del usuario que aporta la informacion
    var $tupla_aceptada=1; // tupla validada por el admin



    function __construct(){

    }

    function Aporte(){

        //variables de conexion
        //
        $cadenaCnx="sqlsrv:Server=35.224.8.47;Database=GestionHongos";
        $user="sqlserver";
        $pass="honguit0s";

        $cnx=new PDO($cadenaCnx, $user, $pass);
        
        //$sql = "INSERT INTO Hongos values (0, 'hongomus2', 'champiñon', 'setas', 'troncos', 'gris',1,1,1,10,1,'no','no','si','2015-12-17',1000,'Es un hongo de prueba ','img1','img2','img3','img4',1)";
        $sql = "INSERT INTO Hongos VALUES (:par0, :par1,:par2,:par3,:par4,:par5,:par6,:par7,:par8,:par9,:par10,:par11,:par12,:par13,:par14,:par15,:par16,:par17,:par18,:par19,:par20,:paruser)";

        $stmt= $cnx->prepare($sql);

        $stmt->bindValue(":par0",1); //tupla valida

        $stmt->bindValue(":par1",$this->nom_cientifico);
        $stmt->bindValue(":par2",$this->nom_vulgar);
        $stmt->bindValue(":par3",$this->familia);
        $stmt->bindValue(":par4",$this->habitat);
        $stmt->bindValue(":par5",$this->color);
        $stmt->bindValue(":par6",$this->area);
        $stmt->bindValue(":par7",$this->ubicacion);
        $stmt->bindValue(":par8",$this->habito);
        $stmt->bindValue(":par9",$this->temporada);
        $stmt->bindValue(":par10",$this->clasificacion);
        $stmt->bindValue(":par11",$this->pileo);
        $stmt->bindValue(":par12",$this->himeonoforo);
        $stmt->bindValue(":par13",$this->estipite);
        $stmt->bindValue(":par14",$this->fecha);
        $stmt->bindValue(":par15",$this->altura);
        $stmt->bindValue(":par16",$this->observacion);


        $stmt->bindValue(":par17",$this->img_sup);
        $stmt->bindValue(":par18",$this->img_inf);
        $stmt->bindValue(":par19",$this->img_lat);
        $stmt->bindValue(":par20",$this->img_mano);


        $stmt->bindValue(":paruser",1); // agrega quien es la fuente del hongo agregado

        

        $stmt->execute();
        
        if($stmt->execute()){
            echo "<p> Insertado correctamente <br /></p>\n";
        }else{
            echo "<p> No insertado: <br /></p>\n";
            echo "\nPDO::errorCode(): ", $stmt->errorCode();
        }


        $fila=1;

        return $fila;

        
        
    }
    function Aporte_csv(){
        
        $cadenaCnx="sqlsrv:Server=35.224.8.47;Database=GestionHongos";
        $user="sqlserver";
        $pass="honguit0s";

        $cnx=new PDO($cadenaCnx, $user, $pass);
        //echo '<pre>';
        //print_r($_FILES);
        //echo '</pre>';
        
        $archivo_ruta= $this->SubeArchivo($this->archivo_csv,$this->ruta);

        ini_set('auto_detect_line_endings', TRUE);

        $archivo=fopen($archivo_ruta,"r");
        $fila=0;
        while(($dato=fgetcsv($archivo,1000,",","\n"))!= FALSE){

            //echo '<pre>';
            //print_r($dato);
            //echo '</pre>';
            $numero = count($dato);
            //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
            $fila++;
            /*
            for ($c=0; $c < $numero; $c++) {
                echo $dato[$c] . "<br />\n";
            }
*/          //echo $dato[13] . "<br />\n";
            //echo $dato[14] . "<br />\n";
            if($numero == 20){
                $sql = "INSERT INTO Hongos VALUES (:par0, :par1,:par2,:par3,:par4,:par5,:par6,:par7,:par8,:par9,:par10,:par11,:par12,:par13,:par14,:par15,:par16,:par17,:par18,:par19,:par20,:paruser)";

                $stmt= $cnx->prepare($sql);

                $stmt->bindValue(":par0",1); //tupla valida

                $stmt->bindValue(":par1",$dato[0],PDO::PARAM_STR);
                $stmt->bindValue(":par2",$dato[1],PDO::PARAM_STR);
                $stmt->bindValue(":par3",$dato[2],PDO::PARAM_STR);
                $stmt->bindValue(":par4",$dato[3],PDO::PARAM_STR);
                $stmt->bindValue(":par5",$dato[4],PDO::PARAM_STR);
                $stmt->bindValue(":par6",$dato[5]);
                $stmt->bindValue(":par7",$dato[6]);
                $stmt->bindValue(":par8",$dato[7]);
                $stmt->bindValue(":par9",$dato[8]);
                $stmt->bindValue(":par10",$dato[9]);
                $stmt->bindValue(":par11",$dato[10]);
                $stmt->bindValue(":par12",$dato[11]);
                $stmt->bindValue(":par13",$dato[12]);
                $stmt->bindValue(":par14",$dato[13]);
                $stmt->bindValue(":par15",$dato[14]);
                $stmt->bindValue(":par16",$dato[15]);


                $stmt->bindValue(":par17","");
                $stmt->bindValue(":par18","");
                $stmt->bindValue(":par19","");
                $stmt->bindValue(":par20","");


                $stmt->bindValue(":paruser",1); // agrega quien es la fuente del hongo agregado

                

                if($stmt->execute()){

                    echo "<p> Insertado correctamente: <br /></p>\n";

                }else{

                    echo "<p> No insertado: <br /></p>\n";
                    echo "\nPDO::errorCode(): ", $stmt->errorCode();

                }

            }

            
            

            
           
        }

        fclose($archivo); 

    }
    function GenereNombreAleatorio($tamaño){
        $cadena="";
        $posibilidades="1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz_";

        $indice=0;
        while($indice<$tamaño){
            $caracter=substr($posibilidades,mt_rand(0,strlen($posibilidades)-1),1);
            $cadena .= $caracter;
            $indice++;

        }

        return $cadena;

    }



    
     function SubeArchivo($nombre_archivo, $rut){
        $aceptado=TRUE;
        /*if(!($_FILES['csv_aportadoADM']['type']==='text/csv')){
            echo("Formato de archivo no permitido");
            $aceptado=FALSE;
        }
        */
        if($aceptado){
            $tipo= explode('.', $_FILES['csv_aportadoADM']['name']);
            $num=count($tipo);
            $extension=$tipo[$num-1];
            $nombre_completo=$rut.$nombre_archivo.'.'.$extension;
            
            
            if(move_uploaded_file($_FILES['csv_aportadoADM']['tmp_name'],$nombre_completo)){
                echo ($nombre_completo);
                return($nombre_completo);

            }else{
                echo ("no se subio el csv");
                return ("");


            }


        }


    }

    
}

?> 