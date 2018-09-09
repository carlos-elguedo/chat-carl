<?php

session_start();

include ("../bdacceso/Selector.php");
include ("../bdacceso/Mensajes.php");
include ("../bdacceso/Actualizador.php");
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
        $actualizador = new Actualizador();
        $idioma = new Idiomas($post_lenguaje);
        $evento = new Evento();
        
        switch($post_tipo_evento){
            //Caso uno, para cunado el even sea un escribiendo normal
            case 10:
                $dato = $evento->getEventoEspecifico($ID, 22);
                $dato_mensaje = 0;
                $dato_relacion = 0;
                $dato_tabla = "";
                
                if($dato == true){
                    $dato_mensaje = $dato["dato"];
                    $dato_relacion = $dato["dato_2"];
                    $dato_tabla = $dato["tabla"];
                }
                
                $mensaje_entregado =$selector->traerMensaje($ID, $dato_tabla, $dato_mensaje); 
                $filas = mysql_num_rows($mensaje_entregado);
                if($filas == 0){
                    echo "No encontraron el mensaje";
                    $selector->seleccionarEventoYCambiarEstado($ID, 22);
                }else{
                    echo "<script>";
                    while($mensaje = mysql_fetch_array($mensaje_entregado)){
                        
                        echo "var division = $('#texto_division_esta_relacion_".$dato_relacion."').val();";
                        //echo "var bandeja = 'bandeja_".$dato_relacion."';";
                        
                        //Sacamos que tipo de mensaje es el actual y los demas datos comunes del mensaje
                        $tipo = $mensaje["tipo"];
                        $de = $mensaje["de"];
                        $msg = $mensaje["mensaje"];
                        $hora = $mensaje["hora"];
                        $id_mensaje = $mensaje["id_mensaje"];
                         
                        //Este controlador para saber que tipo de mensaje es
                        switch($tipo){
                            case 1:
                                //Un mensaje normal        
                                echo "colocarMensajeEntregado($id_mensaje, division, $dato_relacion);";
                                break;
                                
                            default:
                                //No entro a ningun tipo de mensaje
                                break;
                        }
                        
                    }
                    echo "</script>";
                    
                    //Listo, ahora cambiamos el estado del evento
                    $selector->seleccionarEventoYCambiarEstado($ID, 22);
                    
                    
                } 
                break;
                
            case 20:
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