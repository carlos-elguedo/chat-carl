<?php

session_start();

require_once '../bdacceso/Selector.php';
require_once '../bdacceso/Insertador.php';
require_once '../funciones/tieneInyeccion.php';


if(isset($_SESSION["ID"])){
    $ID = $_SESSION["ID"];
    
    $ruta_perfil = "http://localhost/mylove/servidor/archivos/imagenesPerfil/";
    
    
    //Comprobar datos correctos aqui
    
    
    
    
    $selector = new Selector();
    $insertador = new Insertador();
    
    //echo "Llego al servidor id: " . $ID;
    
    $codigo = $selector->darDatoPersona("codigo", $ID);
    $contador = $selector->darNumeroImagenPerfil($ID);
    $numero_imagenes = 0;
    if($contador == "null" || $contador == ""){
        $numero_imagenes = 0;
    }else{
        $numero_imagenes = $contador;
    }
    
    $ruta = "";
    
    /*
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    comprobar TAMAÑO Y VIRUS EN LA IMAGEN AQUI
    */
    $archivo = $_FILES['img']['tmp_name'];
    $nombreArchivo = $_FILES['img']['name'];
    $tipo = $_FILES ['img'][ 'type' ];
    
    
    $tipo_archivo = substr($tipo, strrpos($tipo, "/")+1, strlen($tipo));
    $numero_imagenes += 1;
    
    
    
    
    move_uploaded_file($archivo, "../archivos/imagenesPerfil/" . $ID . "-" . $codigo . "-" . $numero_imagenes .  "." . $tipo_archivo);
    
    
    $ruta = $ID . "-" . $codigo . "-" . $numero_imagenes .  "." . $tipo_archivo;
    
    
    $resultado_guardar_img_bd = $insertador->guadarImagenPerfilPersona($ID, $ruta, $numero_imagenes);
    
    
    if(strcmp($resultado_guardar_img_bd, "OK") == 0){
        echo "<label id='estado-subida-imagen'></label>";
        echo "<script>";
        echo    "$('.img-usuario').prop('src', '". $ruta_perfil . $ruta ."');";
        echo    "localStorage.setItem('img-perfil', '" . $ruta . "');";
        echo    "cerrarTeatroImagenPerfilSubida();";
        echo    "$('#estado-subida-imagen').html(darTextoEspecifico(darLenguaje(), 3));";
        echo    "$('#respuestas-servidor').fadeIn(1500, function(){setTimeout(function(){ $('#respuestas-servidor').fadeOut(2000)}, 2000);});";
        echo "</script>";
    }else{
        echo "ERROR SUBIENDO LA IMAGEN";
    }
    
}else{
    echo "Inicia sesion primero...";
}

?>