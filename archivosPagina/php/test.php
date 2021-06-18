<?php
  // Grupo de Gestion de Hongos, utilización del DAO y sus respectivas pruebas parametrizadas
  require_once 'DAO_abs.php';
   
  // Se adaptaron las pruebas de Junit para probar nuestros componentes en php
    function test(){
    /**
     * @before
    */
      $dao = new DAO_abs();
      echo "<h2>Inicio de Test de Leer y Modificar</h2> ".".<br />";
      echo "Valor inicial del correo previo al test ". $dao->get_abs(2,"Usuarios","correo","id_usuario").".<br />";
      echo "Cambiando atributo correo a example@nuevo para el test ".".<br />";
    /**
    * @test
    */
      $dao->set_abs(2,"Usuarios","correo","id_usuario","example@nuevo").".<br />";
    /**
    * @after
    */
      echo "Valor actual del correo despues del test". $dao->get_abs(2,"Usuarios","correo","id_usuario").".<br />";
    /**
    * @afterClass
    */
      echo "Regresando el atributo a su valor original".".<br />";
      $dao->set_abs(2,"Usuarios","correo","id_usuario","example@viejo").".<br />";
      echo "Fin de Test de Leer y Modificar ".".<br />";

      echo "<h2>Inicio de Test de Crear y Eliminar</h2> ".".<br />";
    /**
     * @before
    */
      $params = "'juan@gmail','password',1,'me.png',1";
      echo "Creando un nuevo usuario con correo juan@gmail".".<br />";
    /**
    * @test
    */
      $dao->inserte_abs($params,"Usuarios");
    /**
    * @after
    */
      echo "Correo del usuario creado ". $dao->get_abs(5,"Usuarios","correo","id_usuario").".<br />";
    /**
    * @afterClass
    */
    echo "Eliminando el nuevo usuario con correo juan@gmail".".<br />";
    $dao->elimine_abs("'juan@gmail'","Usuarios","correo");
    }

    test();
?>