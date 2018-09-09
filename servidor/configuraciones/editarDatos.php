<?php

session_start();

include ("../bdacceso/Actualizador.php");
include ("../funciones/tieneInyeccion.php");
require_once '../funciones/Idiomas.php';

if(isset($_SESSION["ID"])){
    $ID = $_SESSION["ID"];
    //Empezamos a sacar los datos
    if(isset($_POST["edit1"]) && isset($_POST["edit3"]) && isset($_POST["edit3"])){
    $dato1 = addslashes($_POST["edit1"]);
    $dato2 = addslashes($_POST["edit2"]);
    $dato3 = addslashes($_POST["edit3"]);


    //Volvemos a verificamos los datos enviados por el usuario
    $dato1 = mysql_real_escape_string($dato1);
    $dato2 = mysql_real_escape_string($dato2);
    $dato3 = mysql_real_escape_string($dato3);
    
    
    
    if(
                noTieneInyeccionSQL( $dato1 ) == true &&
                noTieneInyeccionSQL( $dato2 ) == true &&
                noTieneInyeccionSQL( $dato3 ) == true 
    ){
        //Bien, todo bien, empezemos a comprobar que tipo de edicion es
        $post_tipo_edicion = $dato3;
        $post_lenguaje_edit = $dato2;
        $post_dato = $dato1;
        
        $actualizador = new Actualizador();
        
        $idioma = new Idiomas($post_lenguaje_edit);
        
        
        
        if(strcmp($post_tipo_edicion, "1")== 0 || $post_tipo_edicion == 1){
            //Editar el nombre
            //echo "Llego donde es: " . $post_dato . " - " . $post_lenguaje_edit;
            $resultado = $actualizador->cambiarNombre($ID, $post_dato);
        
            if($resultado == true){
                echo $idioma->edi_nom_correctamente;
            }else{
                
            }
            
        }
        if(strcmp($post_tipo_edicion, "2")== 0 || $post_tipo_edicion == 2){
            //Editar el 
        }
        if(strcmp($post_tipo_edicion, "3")== 0 || $post_tipo_edicion == 3){
            //Editar el 
        }
        
        
        
        
        
    }else{
        echo "Tiene inyteccion XDxd";
    }
    
    
    
    
    
    
    
}else{
    echo "Que paso amiguito";
}
    
}else{
    echo "Inicia sesion...";
}
?>