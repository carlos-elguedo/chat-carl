<?php

session_start();

include ("../bdacceso/Selector.php");
include ("../bdacceso/Mensajes.php");
include ("../bdacceso/Insertador.php");
include ("../bdacceso/Evento.php");
include ("../funciones/tieneInyeccion.php");
require_once '../funciones/Idiomas.php';

if(isset($_SESSION["ID"])){
    $ID = $_SESSION["ID"];
    //Empezamos a sacar los datos
    
    
    $dato1 = addslashes($_POST["msg1"]);
    $dato2 = addslashes($_POST["msg2"]);
    //Volvemos a verificamos los datos enviados por el usuario
    $dato1 = mysql_real_escape_string($dato1);
    $dato2 = mysql_real_escape_string($dato2);
    
    
    if( noTieneInyeccionSQL( $dato1 ) == true &&
        noTieneInyeccionSQL( $dato2 ) == true){
        //Bien, todo bien, empezemos a comprobar que accion realizar en la solicitud
        $post_lenguaje = $dato1;
        $post_tipo_evento = $dato2;
        
        $selector = new Selector();
        $idioma = new Idiomas($post_lenguaje);
        $evento = new Evento();
        
        switch($post_tipo_evento){
            //Caso uno, para cunado el even sea un escribiendo normal
            case 10:
                $dato = $evento->getEventoEspecifico($ID, 20);
                $dato_relacion = 0;
                if($dato == true){
                    $dato_relacion = $dato["dato"];
                }
                //Bien, ya tenemos el dato que indica el id de la relacion,
                //procedemos a mostrar el script del mensaje escribiendo
                echo "<script>";
                //echo "var division = $('#texto_division_esta_relacion_".$dato_relacion."').val();";
                //Cambiamos la variable que 
                //echo "console.log('Imprimido desde el servidor: ' + eval('ESCRIBIENDO.' + division));";
                echo "estaEscribiendo(".$dato_relacion.");";
                echo "</script>";
                //Listo, ahora cambiamos el estado del evento
                $selector->seleccionarEventoYCambiarEstado($ID, 20); 
                break;
                
            case 30:
                echo "Entro en el dos";
                break;
            default:
                echo "Entro en default";
                break;
        }
        
        
        
        
        
        
        
    }
    else{
        echo "Tiene Inyeccion";
    }
}else{
    echo "Inicia sesion correctamente...";
}
?>