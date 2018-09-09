<?php

session_start();

include ("bdacceso/selector.php");


if(isset($_SESSION["ID"])){
    $ID = $_SESSION["ID"];
    
    $selector = new Selector();
    
    //echo "Se conecto bien " . $ID;
    
    $datos_persona = $selector->darDatosPersona($ID);
    
    
    $nombre = $datos_persona["nombre"];
    $img_perfil = $datos_persona["imagen_perfil"];
    
    
    
    echo "<script>";
    if(!strcmp($nombre, "") == 0){
        echo    "localStorage.setItem('username', '". $nombre ."');";
    }
    if(!strcmp($img_perfil, "") == 0){
        echo    "localStorage.setItem('img-perfil', '" . $img_perfil . "');";
    }
    echo "setName(localStorage.getItem('username'));";
    
    echo "setImagenUsuario(localStorage.getItem('img-perfil'));";
    echo "</script>";
    
    
    
    
    
    
    
    
    
    
    
}else{
    echo "<label>Inicia sesion...</label>";
    echo "<script>";
    echo "PUEDE_PEDIR_EVENTOS = false;";
    echo "</script>"; 
}


?>