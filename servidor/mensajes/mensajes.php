<?php

session_start();

include ("../bdacceso/Selector.php");
include ("../bdacceso/Mensajes.php");
include ("../funciones/tieneInyeccion.php");
require_once '../funciones/Idiomas.php';

if(isset($_SESSION["ID"])){
    $ID = $_SESSION["ID"];
    //Empezamos a sacar los datos
    
    if(isset($_POST["msg1"]) && isset($_POST["msg2"])){
    $dato1 = addslashes($_POST["msg1"]);
    $dato2 = addslashes($_POST["msg2"]);
    //Volvemos a verificamos los datos enviados por el usuario
    $dato1 = mysql_real_escape_string($dato1);
    $dato2 = mysql_real_escape_string($dato2);
    
    
    if( noTieneInyeccionSQL( $dato1 ) == true &&
        noTieneInyeccionSQL( $dato2 ) == true){
        //Bien, todo bien, empezemos a comprobar que accion realizar en la solicitud
        $post_lenguaje = $dato1;
        $post_dato_mensaje = $dato2;
                
            $obje_mensaje = new Mensajes($post_dato_mensaje);
            $selector = new Selector();
            $idioma = new Idiomas($post_lenguaje);
            
            
            if($obje_mensaje->setNombreTabla($ID)){
                //Bien, pedimos todos los mensajes a la base de datos
                $mensajes = $obje_mensaje->darMensajes();
                $filas = mysql_num_rows($mensajes);
                if($filas == 0){
                    echo "Esta vacia la tabla";
                }else{
                    //Bien antes de mostrar todos los mensajes, adecuamos los mas comunes, los cuales se utilizaran en todo el proceso
                    //esto para evitar trabajo repetitivo
                    $otro_usuario = $selector->darDatosPersona($obje_mensaje->id_otra_persona);
                    $imagen_usuario = $selector->darDatoPersona("imagen_perfil", $ID);
                    //Sacamos los dtos del otro usuario
                    $nombre_otro = $otro_usuario["nombre"];
                    $imagen_otro = $otro_usuario["imagen_perfil"];
                                                        
                    if(strcmp($nombre_otro, "") == 0){$nombre_otro = $otro_usuario["correo"];
                        if(strcmp($nombre_otro, "") == 0){
                            $nombre_otro = $otro_usuario["telefono_con_codigo"];
                        }
                    }
                    if(strcmp($imagen_otro, "") == 0){$imagen_otro = "index.png";}
                    if(strcmp($imagen_usuario, "") == 0){$imagen_usuario = "index.png";}
                    
                    //Tiene mensajes, procedemos a mostrarlos
                    while($mensaje = mysql_fetch_array($mensajes) ){
                        //Sacamos los datos de los mensajes para procesarlos...
                        $id_mensaje = $mensaje["id_mensaje"];
                        $de         = $mensaje["de"];
                        $para       = $mensaje["para"];
                        $tipo       = $mensaje["tipo"]; 
                        
                        
                        //Bien, ya tenemos los datos principales de un mensaje, ahora averiguamos que tipo de mensaje es para mostrarlo correctamente
                        switch($tipo){
                            //caso 0, es el primer mensaje que se crea automaticamente
                            case 0:
                                //Sacamos los datos para este mensaje...
                                //Para este tipo de mensaje solo necesitaremos mostrar el texto del mensaje solamente
                                $msg_texto = "";
                                $hora = $mensaje["hora"];
                                $fecha = $mensaje["fecha"];
                                
                                //Instanciamos el valor del texto del mensaje que se mostrara
                                if($obje_mensaje->pocision_persona_en_la_relacion == 1){
                                    $msg_texto = $mensaje["mensaje_bot_usu_1"];
                                }else{
                                    $msg_texto = $mensaje["mensaje_bot_usu_2"];
                                }
                                
                                //Bien, ya tenemos los datos necesarios para mostrar este tipo de mensajes, procedemos a mostrarlo
                                echo "<div class=\"inicio style-bg\">".
                                        "<div class=\"imagenes-union\">".
                                            "<img src=\"".$idioma->ruta_servidor_perfil.$imagen_usuario."\" />".
                                            "<img src=\"".$idioma->ruta_servidor_perfil.$imagen_otro."\" />".
                                        "</div>".
                                        "<div class=\"texto-union\">".$msg_texto."</div>".
                                    "</div>";
                                break;
                                
                            
                            
                            //Caso 1: para un mensaje normal, de texto
                            case 1:
                                $msg = $mensaje["mensaje"];
                                $hora = $mensaje["hora"];
                                $fecha = $mensaje["fecha"];
                                $de = $mensaje["de"];
                                $para = $mensaje["para"];
                                $id_mensaje = $mensaje["id_mensaje"]; 
                                
                                if($de == $ID){
                                    //Es un mensaje propio
                                    echo "<div class='datos_usuario_principal'>".
                                            "<div class='chat-box-right style-bg'>".
                                                "<div class='mensaje'>$msg</div>".
                                                "<div class='datos-der'>".
                                                    "<div><i id='est_msg_$id_mensaje' class='mdi mdi-heart'></i></div>".
                                                    "<div>$hora</div>".
                                                "</div>".
                                            "</div>".
                                        "</div>";
                                }else{
                                    //Es un mensaje del otro usuario, el secundario
                                    echo "<div class='datos_usuario_secundario'>".
                                            "<div class='chat-box-left'>".
                                                "<div class='mensaje'>$msg</div>".
                                                "<div class='datos-izq'>".
                                                    "<div>$hora</div>".
                                                "</div>".
                                            "</div>".
                                        "</div>";
                                }
                                break;
                                
                                
                                
                                
                                
                                
                            default:
                                echo "No entro en ningun tipo: " . $tipo;
                                break;
                        }//Fin del switch que comprueba que tipo de mensaje es
                        
                        
                    }//Fin del while
                }
            }else{
                echo "Este usuario ha ingresado a una relacion que no es la de el";
            }
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