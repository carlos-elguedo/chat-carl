<?php

/**
 * Estados de las relaciones:
 *      1: Estado default, se tomara como friendZone
 *      2: Estado Mylove, este usuario tiene al otro como MyLove
 *      3: Estado FriendZone, este usuario marco al otro en la friendZone
 */
session_start();

include ("../bdacceso/Selector.php");
include ("../bdacceso/Actualizador.php");
include ("../funciones/tieneInyeccion.php");
require_once '../funciones/Idiomas.php';

if(isset($_SESSION["ID"])){
    $ID = $_SESSION["ID"];
    //Empezamos a sacar los datos
    if(isset($_POST["msg1"])){
    $dato1 = addslashes($_POST["msg1"]);

    //Volvemos a verificamos los datos enviados por el usuario
    $dato1 = mysql_real_escape_string($dato1);
    
    
    if(noTieneInyeccionSQL( $dato1 ) == true ){
        //Bien, todo bien, empezemos a comprobar que accion realizar en la solicitud
        $post_lenguaje = $dato1;
        $selector = new Selector();
        $idioma_bandeja = new Idiomas($post_lenguaje);
        
        $idioma_bandeja = new Idiomas($post_lenguaje);
        //Bien. procedemos a mostrar la bandeja del usuario actual
        $relaciones = $selector->darRelaciones($ID);
        $filas = mysql_num_rows($relaciones);
        if($filas == 0){
            //No tiene BANDEJA DE MENSAJES
            echo "<script>";
            echo "$('#chats').html('<li id = \"no-tiene-mensajes\">".
                //La imagen del otro usuario
                "<img src=\"assets/img/index.png\">".
                "<span class=\"name\">MyLove</span>".
                "<br>".
                "<div class=\"content-container\">".
                "<span class=\"txt\">". $idioma_bandeja->men_no_tiene_bandeja ."</span>".
                "</div>".
                "</li>".
                "');";
            echo "</script>";
        }else{
            //Tiene relaciones
            echo "<script>";
            echo "$('#chats').html('');";
            $contador_friendZone = 1;
            while($relacion = mysql_fetch_array($relaciones)){
                $id_relacion = $relacion["id_relacion"];
                $id_persona_1 = $relacion["id_persona_1"];
                $id_persona_2 = $relacion["id_persona_2"];
                $estado_persona_1 = $relacion["estado_persona_1"];
                $estado_persona_2 = $relacion["estado_persona_2"];
                $nombre_tabla_mensajes = $relacion["nombre_tabla_mensajes"];
                $hora = $relacion["hora"];
                $hora = $relacion["fecha"];
                $definicion = 0;//1 para MyLove, 2 Para FriendZone
                $texto_division_mensajes = "";
                
                
                //Vemos que posision tiene el usuario actual en la tabla, si es el numero 1 o el 2:
                $posision_usuario_actual = 0;
                if($id_persona_1 == $ID){
                    $posision_usuario_actual = 1;
                    $id_otro_usuario = $id_persona_2;
                    $definicion = $estado_persona_1;
                }else{
                    $posision_usuario_actual = 2;
                    $id_otro_usuario = $id_persona_1;
                    $definicion = $estado_persona_2;
                }
                
                //echo "Traera los mensajes";
                $mensajes = $selector->darUltimoMensaje($nombre_tabla_mensajes);
                $filas_mensajes = mysql_num_rows($relaciones);
                
                
                if($filas_mensajes == 0){
                    echo "No tiene msg en la tabla";
                }else{
                    //Acontinuacion vamos a definir la accion que tomara la barra de mensajes
                    switch($definicion){
                        case 1:
                            $texto_division_mensajes = "mensajes_friendzone_". $contador_friendZone . "";
                            $contador_friendZone++;
                            break;
                        case 2:
                            //Lo definio como mylove
                            $texto_division_mensajes = "mensajes_mylove";
                            break;
                        case 3:
                            $texto_division_mensajes = "mensajes_friendzone_". $contador_friendZone . "";
                            $contador_friendZone++;
                            break;
                        default:
                            $texto_division_mensajes = "mensajes_friendzone_". $contador_friendZone . "";
                            $contador_friendZone++;
                            break;
                    }
                    
                    
                    $mensaje = mysql_fetch_assoc($mensajes);
                    $tipo = $mensaje["tipo"];
                    $hora = $mensaje["hora"];
                    $otro_usuario = $selector->darDatosPersona($id_otro_usuario);
                    //Sacamos los dtos del otro usuario
                    $nombre_otro = $otro_usuario["nombre"];
                    $imagen_otro = $otro_usuario["imagen_perfil"];
                                                    
                    if(strcmp($nombre_otro, "") == 0){
                        $nombre_otro = $otro_usuario["correo"];
                        if(strcmp($nombre_otro, "") == 0){
                            $nombre_otro = $otro_usuario["telefono_con_codigo"];
                        }
                    }
                    if(strcmp($imagen_otro, "") == 0){
                        $imagen_otro = "index.png";
                    }
                    
                    
                    
                    
                    
                    
                    
                    
                    //Listo, ahora emos que tipo de mensaje es
                    switch($tipo){
                        case 0:
                        //s un mensaje tipo primero...
                            $msg = "";
                            if($posision_usuario_actual == 1){//Sacamos el mensaje del bot 1
                                $msg = $mensaje["mensaje_bot_usu_1"];
                            }else{
                                //Sacamos el mensaje del bot 2
                                $msg = $mensaje["mensaje_bot_usu_2"];
                            }
                            
                            echo "pedirMensajes(".$id_relacion.", '".$texto_division_mensajes."');";
                            echo "$('#chats').append('<li id=\"bandeja_".$id_relacion."\" onclick = \"ponerMensajesChat( \\'".$texto_division_mensajes."\\', \\'". $imagen_otro ."\\', \\'".$nombre_otro."\\', \\'".$id_relacion."\\')\">".
                            //La imagen del otro usuario
                            "<img src=\"". $idioma_bandeja->ruta_servidor_perfil . $imagen_otro . "\">".
                            "<div class=\"content-container\">".
                            "<span class=\"name\">". $nombre_otro ."</span>".
                            "<span class=\"txt\">". $msg ."</span>".
                            "<span class=\"bandeja_escribiendo\" style=\"display:none\">". $idioma_bandeja->escribiendo ."</span>".
                            "</div>".
                            "<span class=\"time\">".
                            $hora.
                            "</span>".
                            "<input id=\"texto_division_esta_relacion_".$id_relacion."\" hidden value = \"".$texto_division_mensajes."\">".
                            "</li>".
                            "');";
                            break;
                            
                        case 1:
                            //Es un mensaje normal de texto
                            $de = $mensaje["de"];
                            $para = $mensaje["para"];
                            $mensaje = $mensaje["mensaje"];
                            $enviador = "";
                            if($de == $ID){$enviador = $idioma_bandeja->men_tu; }else{$enviador = $nombre_otro . ": ";}
                            
                            //Mostramos la bandeja
                            echo "pedirMensajes(".$id_relacion.", '".$texto_division_mensajes."');";
                            echo "$('#chats').append('<li id=\"bandeja_".$id_relacion."\" onclick = \"ponerMensajesChat( \\'".$texto_division_mensajes."\\', \\'". $imagen_otro ."\\', \\'".$nombre_otro."\\', \\'".$id_relacion."\\')\">".
                            //La imagen del otro usuario
                            "<img src=\"". $idioma_bandeja->ruta_servidor_perfil . $imagen_otro . "\">".
                            "<div class=\"content-container\">".
                            "<span class=\"name\">". $nombre_otro ."</span>".
                            "<span class=\"txt\"><span class =\"negrita\">".$enviador."</span>". $mensaje ."</span>".
                            "<span class=\"bandeja_escribiendo\" style=\"display:none\">". $idioma_bandeja->escribiendo ."</span>".
                            "</div>".
                            "<span class=\"time\">".
                            $hora.
                            "</span>".
                            "<input id=\"texto_division_esta_relacion_".$id_relacion."\" hidden value = \"".$texto_division_mensajes."\">".
                            "</li>".
                            "');";
                            break;
                            
                            
                            
                            
                            
                            
                        default:
                            break;
                    }//Fin de switch
                }//Fin del else tiene mensajes en la tabla actual
                
            }//Fin del while
            echo "</script>";
        }//Fin del else que tiene algo
        
        
    }else{
        echo "Tiene inyecion";
    }
    }else{
        echo "Que paso amiguito";
    }
}else{
    echo "Inicia sesion correctamente...";
}

?>