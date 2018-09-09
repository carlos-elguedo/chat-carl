<?php

session_start();

include ("../bdacceso/Selector.php");
include ("../bdacceso/Insertador.php");
include ("../funciones/tieneInyeccion.php");
require_once '../funciones/Idiomas.php';

if(isset($_SESSION["ID"])){
    $ID = $_SESSION["ID"];
    //Empezamos a sacar los datos
    
    if(isset($_POST["msg1"]) && isset($_POST["msg2"])  && isset($_POST["msg3"])){
    $dato1 = addslashes($_POST["msg1"]);
    $dato2 = addslashes($_POST["msg2"]);
    $dato3 = addslashes($_POST["msg3"]);
    //Volvemos a verificamos los datos enviados por el usuario
    $dato1 = mysql_real_escape_string($dato1);
    $dato2 = mysql_real_escape_string($dato2);
    $dato3 = mysql_real_escape_string($dato3);
    
    
    if( noTieneInyeccionSQL( $dato1 ) == true &&
        noTieneInyeccionSQL( $dato2 ) == true &&
        noTieneInyeccionSQL( $dato3 ) == true){
        //Bien, todo bien, empezemos a comprobar que accion realizar en la solicitud
        $post_tipo = $dato1;
        $post_dato_mensaje = $dato2;
        $post_dato_relacion = $dato3;
        
        
        
        //echo "Llego con los datos: 1.$post_tipo 2. $post_dato_mensaje 3. $post_dato_relacion";
                
        //Listo, comprobamos que tipo de accion vamos a realizar
        switch($post_tipo){
            case 1:
                $selector = new Selector();
                $insertador = new Insertador();
                //Vamos a enviar un mensaje normal...
                //Lo primero sera comprobar la relacion, vemos si esta definida anteriormente
                if(isset($_SESSION["ID_RELACION"])){
                    //Si tiene una relacion ya comprobada anteriro
                    //Comprobamos si es igual a la que se quiere enviar
                    if($_SESSION["ID_RELACION"] == $post_dato_relacion){
                        //Si es igual a la relacion del nuevo mensaje que se quiere enviar
                        $tabla = "";
                        if(!isset($_SESSION["TABLA_MENSAJES"])){
                            //Si la vaiable mensaje esta vacia vamos a sacar el nombre de la tabla
                            $tabla = $selector->darNombreTablaRelacion($post_dato_relacion);
                        }
                        if($tabla != ""){
                            $estado_enviar_mensaje = $insertador->insertarMensaje($ID, $_SESSION["ID_OTRO"], $post_dato_mensaje, $tabla);
                            if($estado_enviar_mensaje == true){
                                echo "Se envio";
                                
                                //Listo, ahora generemos el evento
                                if($selector->estaEnLinea($_SESSION["ID_OTRO"]) == true){
                                    //El otro usuario esta en linea...
                                    //Lo insertamos en la tabla eventos
                                    $insertador->insertarEventoConDatoCadena(21, $_SESSION["ID_OTRO"], $post_dato_relacion, $tabla);
                                }//Si no esta en liena, no hay necesidad de crear el evento 
                            }
                        }
                    }else{
                        //No es igual por lo tanto se tiene que comprobar la relacion y volverla a definir en la sesion
                        $relacion = $selector->darRelacion($post_dato_relacion, $ID);
                        $filas = mysql_num_rows($relacion);
                        if($filas == 0){
                            echo "No encontro la relacion recibida";
                        }else{
                            $datos_relacion = mysql_fetch_array($relacion);
                            $id_otro = "";
                            //Averiguamos el id del otro usuario para guardarlo en memoria y guardar el mensaje y el evento
                            if($datos_relacion["id_persona_1"] == $ID){
                                $id_otro = $datos_relacion["id_persona_2"];
                            }else{
                                $id_otro = $datos_relacion["id_persona_1"];
                            }
                            //Sacamos el nombre de la tabla
                            $tabla_mens = $datos_relacion["nombre_tabla_mensajes"];
                            
                            //Guardamos los datos en memoria
                            $_SESSION["ID_RELACION"] = $post_dato_relacion;
                            $_SESSION["ID_OTRO"] = $id_otro;
                            $_SESSION["TABLA_MENSAJES"] = $tabla_mens;
                            
                            $estado_enviar_mensaje = $insertador->insertarMensaje($ID, $id_otro, $post_dato_mensaje, $tabla_mens);
                            if($estado_enviar_mensaje == true){
                                echo "Se envio";
                                //Listo, ahora generemos el evento
                                if($selector->estaEnLinea($id_otro) == true){
                                    //El otro usuario esta en linea...
                                    //Lo insertamos en la tabla eventos
                                    $insertador->insertarEventoConDatoCadena(21, $id_otro, $tabla_mens);
                                }//Si no esta en liena, no hay necesidad de crear el evento 
                            }
                            
                        }//Fin del else que no tiene relacion igual a la recibida 
                    }
                }else{
                    //Aun no se a definido una relacion en la sesion, vamos a definirla
                    $relacion = $selector->darRelacion($post_dato_relacion, $ID);
                    $filas = mysql_num_rows($relacion);
                    if($filas == 0){
                        echo "No encontro la relacion recibida";
                    }else{
                        $datos_relacion = mysql_fetch_array($relacion);
                        $id_otro = "";
                        //Averiguamos el id del otro usuario para guardarlo en memoria y guardar el mensaje y el evento
                        if($datos_relacion["id_persona_1"] == $ID){
                            $id_otro = $datos_relacion["id_persona_2"];
                        }else{
                            $id_otro = $datos_relacion["id_persona_1"];
                        }
                        //Sacamos el nombre de la tabla
                        $tabla_mens = $datos_relacion["nombre_tabla_mensajes"];
                            
                        //Guardamos los datos en memoria
                        $_SESSION["ID_RELACION"] = $post_dato_relacion;
                        $_SESSION["ID_OTRO"] = $id_otro;
                        $_SESSION["TABLA_MENSAJES"] = $tabla_mens;
                        
                        $estado_enviar_mensaje = $insertador->insertarMensaje($ID, $id_otro, $post_dato_mensaje, $tabla_mens);
                        if($estado_enviar_mensaje == true){
                            echo "Se envio";
                            if($selector->estaEnLinea($id_otro) == true){
                                //El otro usuario esta en linea...
                                //Lo insertamos en la tabla eventos
                                $insertador->insertarEventoConDatoCadena(21, $id_otro, $post_dato_relacion,$tabla_mens);
                            }//Si no esta en liena, no hay necesidad de crear el evento
                        }
                    }//Fin del else que no tiene relacion igual a la recibida 
                }
                break;
            default:
                break;
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