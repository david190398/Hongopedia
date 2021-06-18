<?php
    require_once 'usuario.php';
    require_once 'area_conservacion.php';
    require_once 'habito.php';
    $usuario = new usuario();
    $area = new area_conservacion();
    $habito = new habito();
    echo "contraseña del usuario " . $usuario->get_contrasena(1) .".<br />";
    echo "nombre imagen de perfil del usuario " . $usuario->get_imagen(1) .".<br />";
    echo "numero de intentos del usuario " . $usuario->get_intentos(1) .".<br />";
    echo "correo del usuario " . $usuario->get_correo(1) .".<br />";
    if ($usuario->get_es_admin(1)){
        echo "el usuario es admin .<br />";
    } else {
        echo "el usuario no es admin .<br />";
    }
    $usuario->set_contrasena(1,"contrasena");
    $usuario->set_correo(1,"example@gamil.com");
    $usuario->set_imagen(1,"example.jpg");
    $usuario->set_es_admin(1,1);
    $usuario->set_intentos(1,5);
    echo "contraseña del usuario " . $usuario->get_contrasena(1) .".<br />";
    echo "nombre imagen de perfil del usuario " . $usuario->get_imagen(1) .".<br />";
    echo "numero de intentos del usuario " . $usuario->get_intentos(1) .".<br />";
    echo "correo del usuario " . $usuario->get_correo(1) .".<br />";
    // $usuario->insertar_nuevo("david@gmail","password","me.png","1");
    echo "nombre del area " . $area->get_nombre(12) .".<br />";
    // $area->insertar_nuevo("Turrialbe New Yok");
    // $area->eliminar(13);
    // $habito->insertar_nuevo("famicon");
    $habito->eliminar(5);
?>