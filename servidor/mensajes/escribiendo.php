<?php

session_start();

include ("../bdacceso/Selector.php");
include ("../bdacceso/Mensajes.php");
include ("../bdacceso/Insertador.php");
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
        $post_dato_relacion = $dato2;
        
        $selector = new Selector();
        $insertador = new Insertador();
        $idioma = new Idiomas($post_lenguaje);
        
        
        //Comprobamos si ya consulto en la base de datos la relacion recibida
        if(isset($_SESSION["ID_RELACION"])){
            
            //La variable existe por lo tanto esta en memoria la relacion y el id del otro usuario
            //Ahora comprobamos que el almacenado en memoria sea el que se quire mandar el escribiendo
            if($_SESSION["ID_RELACION"] == $post_dato_relacion){
                
                //Si es el mismo que tiene en la sesion...
                //Listo, si el otro usuario esta en linea, generamos el evento para que lo capture
                if($selector->estaEnLinea($_SESSION["ID_OTRO"]) == true){
                    //El otro usuario esta en linea...
                    //Lo insertamos en la tabla eventos
                    $insertador->actualizarEventoConDato(20, $_SESSION["ID_OTRO"], $_SESSION["ID_RELACION"]);
                }//Si no esta en liena, no hay necesidad de crear el evento
                else{
                    echo "Entro en escribiendo offline:" . $_SESSION["ID_OTRO"] . "<-";
                }
            }else{
                //No es el mismo que tiene en la sesion
                $relacion = $selector->darRelacion($post_dato_relacion, $ID);
                $filas = mysql_num_rows($relacion);
                if($filas == 0){
                    echo "No encontro la solicitud recibida";
                }else{
                    $datos_relacion = mysql_fetch_array($relacion);
                    $id_otro = "";
                    //Averiguamos el id del otro usuario para guardarlo en memoria y generar el evento de escribiendo
                    if($datos_relacion["id_persona_1"] == $ID){
                        $id_otro = $datos_relacion["id_persona_2"];
                    }else{
                        $id_otro = $datos_relacion["id_persona_1"];
                    }
                    //Guardamos los datos en memoria
                    $_SESSION["ID_RELACION"] = $post_dato_relacion;
                    $_SESSION["ID_OTRO"] = $id_otro;
                    
                    //Listo, ahora generamos el evento de escribiendo si el otro usuario esta en linea
                    if($selector->estaEnLinea($id_otro) == true){
                        //El otro usuario esta en linea...
                        //Lo insertamos en la tabla eventos
                        $insertador->insertarEventoConDato(20, $id_otro, $post_dato_relacion);
                    }//Si no esta en liena, no hay necesidad de crear el evento 
                }
            }
            
            
        }else{
            //La variable no existe por lo tanto hay que sacarla y definirla
            //Bien ahora buscamos la relacion que recibimos para generar el evento escribiendo
            $relacion = $selector->darRelacion($post_dato_relacion, $ID);
            $filas = mysql_num_rows($relacion);
            if($filas == 0){
                echo "No encontro la solicitud recibida";
            }else{
                $datos_relacion = mysql_fetch_array($relacion);
                $id_otro = "";
                //Averiguamos el id del otro usuario para guardarlo en memoria y generar el evento de escribiendo
                if($datos_relacion["id_persona_1"] == $ID){
                    $id_otro = $datos_relacion["id_persona_2"];
                }else{
                    $id_otro = $datos_relacion["id_persona_1"];
                }
                //Guardamos los datos en memoria
                $_SESSION["ID_RELACION"] = $post_dato_relacion;
                $_SESSION["ID_OTRO"] = $id_otro;
                
                //Listo, ahora generamos el evento de escribiendo si el otro usuario esta en linea
                if($selector->estaEnLinea($id_otro) == true){
                    //El otro usuario esta en linea...
                    //Lo insertamos en la tabla eventos
                    $insertador->insertarEventoConDato(20, $id_otro, $post_dato_relacion);
                }//Si no esta en liena, no hay necesidad de crear el evento 
            }
            
        }//Fin del else que no esta el id de relacion en memoria
        
        
        
        
    }
    else{
        echo "Tiene Inyeccion";
    }
}else{
    echo "Inicia sesion correctamente...";
}
?>