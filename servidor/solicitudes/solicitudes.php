<?php

/**
 * Si el estado de la solicitud es:
 *      1: La solicitud apenas ha sido enviada no se ha modificado
 *      0: La solicitud fue respondida por ambas partes, cada quien la marco como quiso
 *      98: La solicitud fue rechazada normalmente
 *      99: La solicitud fue rechazada por el destinatario y bloqueo al usuario enviador
 * 
 * 
 * 
 * Si el estado del enviador es:
 *      1: El enviador no ha realizado acciones por lo tanto cuando la solicitudse acepte tomara el valor por defecto MyLove, si el que 
 *         la envio aun no tiene MyLove, si ya tiene se mandara a la friendzone
 *      2: El enviador quiere marcar como Su Love al destinatario
 *      3: El enviador quiere poner en la friendzone a quien le envio la solicitud
 *      22: La solicitud fue eliminada de la vista del menu de este usuario
 * 
 * Si el estado del solicitado es:
 *      1: El solicitado aun no ha realizado acciones sobre la solicitud que recibio
 *      2: El usuario que recibio la solicitud la acepto y marco como su Love al que envio la solicitud
 *      3: El usuario que recibio la solicitud la acepto y mando a la fiendZone a quien la envio
 *      98: El usuario que recibio la solicitud LA RECHAZO normalmente
 *      99: El usuario que recibio la solicitud la RECHAZO Y BLOQUEO al usuario que envio la solicitud
 *      22: La solicitud fue eliminada del menu de solicitudes de este usuario  
 * 
 */




session_start();

include ("../bdacceso/Insertador.php");
include ("../bdacceso/Selector.php");
include ("../bdacceso/Actualizador.php");
include ("../bdacceso/Creador.php");
include ("../bdacceso/Evento.php");
include ("../funciones/tieneInyeccion.php");
include ("traerSolicitudes.php");
require_once '../funciones/Idiomas.php';


if(isset($_SESSION["ID"])){
    
    $ID = $_SESSION["ID"];
    //Empezamos a sacar los datos
    $dato1 = addslashes($_POST["solici1"]);
    $dato2 = addslashes($_POST["solici2"]);
    $dato3 = addslashes($_POST["solici3"]);


    //Volvemos a verificamos los datos enviados por el usuario
    $dato1 = mysql_real_escape_string($dato1);
    $dato2 = mysql_real_escape_string($dato2);
    $dato3 = mysql_real_escape_string($dato3);
    
    
    
    if(
                noTieneInyeccionSQL( $dato1 ) == true &&
                noTieneInyeccionSQL( $dato2 ) == true &&
                noTieneInyeccionSQL( $dato3 ) == true 
    ){
        //Bien, todo bien, empezemos a comprobar que accion realizar en la solicitud
        $post_tipo_solicitud = $dato1;
        $post_lenguaje_solicitud = $dato2;
        $post_dato_solicitud = $dato3;
        
        
        
        $idioma_solicitud = new Idiomas($post_lenguaje_solicitud);
        
        //echo "Bien: " . " - " . $post_tipo_solicitud . " - " . $post_dato_solicitud;
        
        switch($post_tipo_solicitud){
            //Caso uno, para enviar una solicitud a un usuario
            case 1:
                $selector = new Selector();
        
                $insertador = new Insertador();
            
                $id_otro_usuario = $selector->darIdPersona($post_dato_solicitud);
            
                if($id_otro_usuario != ""){
                
                    //Comprobamos si no es el mismo que se esta enviado la solicitud
                    if(strcmp($id_otro_usuario, $ID)== 0){
                        echo "<label>". $idioma_solicitud->sol_mismo_usuario ."</label>";
                    }else{
                        //Traemos los datos del otro usuario
                        $otro_usuario = $selector->darDatosPersona($id_otro_usuario);
                        
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
                        
                        //Bien, ahoraahi que comprobar que esa solicitud no se haya enviado antes...
                        
                        $existe_solicitud = $selector->existeSolicitud($ID, $id_otro_usuario);
                        
                        //Si esa variable anterior es uno significa que no existe y se puede registrar
                        if($existe_solicitud == 1){
                            $estado_solicitud = $insertador->registrarSolicitud($ID, $id_otro_usuario);
                        
                            if($estado_solicitud == "ok" || (strcmp($estado_solicitud, "ok") == 0)){
                                
                                $id_solicitud = $selector->darIdSolicitud($ID, $id_otro_usuario);
                                
                                
                                echo "<label>". $idioma_solicitud->sol_correcta ."</label>";
                                echo "<script>";
                                echo "ponerPantallaAccionSiAcepta();";
                                echo    "$('.list-account > .list').append('<li class = \"solicitud-suya virgen\" onclick = \"AccionSolicitud(" . $id_solicitud . ")\"><img src=\"". $idioma_solicitud->ruta_servidor_perfil . $imagen_otro . "\"><span class=\"name\">" . $idioma_solicitud->sol_has_enviado_solicitud . $nombre_otro . "</span> <span id = \"texto-estado-".$id_solicitud."\" class = \"estado-solicitud\"> ". $idioma_solicitud->sol_est_si_acepta_friendZone ."<span> </li>');";
                                echo "</script>";
                                
                                //Ahora, generamos el evento para el otro usuario, si este esta en linea
                                //Si el usuario a quien se envio la solicitud no esta en linea, no hay necesidad de insertar el evento
                                if($selector->estaEnLinea($id_otro_usuario) == true){
                                    //El otro usuario esta en linea...
                                    //Lo insertamos en la tabla eventos
                                    $insertador->insertarEvento(10, $id_otro_usuario);
                                }//Si no esta en liena, no hay necesidad de crear el evento, ya que recogeran la solicitud automaticamente al iniciar sesion
                                 
                                 
                            }else{
                                echo "<label>". $idioma_solicitud->sol_error ."</label>";
                            }
                        }//Fin de no existe la solicitud previamente y si la puede enviar
                        
                        
                        //Ahora comprobamos si ese usuario fue el que envio la solicitud
                        if($existe_solicitud == 2){
                            echo    "<label>". $idioma_solicitud->sol_ya_enviada . $nombre_otro . " </label>";
                        }
                        
                        
                        //Si el otro ya le ha enviado una solicitud a este usuario
                        if($existe_solicitud == 3){
                            echo    "<label> ". $nombre_otro . $idioma_solicitud->sol_otro_ya_envio ." </label>";
                        }
                        
                    }
                    
                }else{
                    echo    "<label>". $idioma_solicitud->sol_no_existe_ese_usuario ."</label>";
                }
                break;
                
            /**
            * ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
            * ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
            */     
            //Caso dos, para cuando un usuario inicie sesion y pida sus solicitudes enviadas y recibidas
            case 2:
                $selector = new Selector();
            
                $solicitudes = $selector->traerSolicitudes($ID);
            
                $filas = mysql_num_rows($solicitudes);
                if($filas == 0){
                    //No tiene solicitudes
                    echo "<script>";
                    echo    "$('.list-account > .list').append('<li class = \"aun-no-tiene-solicitudes\"><img src=\"assets/img/index.png\"><span class=\"name\">".$idioma_solicitud->sol_no_tiene ."</span> </li>');";
                    echo "</script>";
                }else{
                    //echo "Entro en algo". $solicitudes;
                    darSolicitudes($solicitudes, $ID, $selector, $idioma_solicitud);
                }
                break;
            /**
            * ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
            * ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
            */     
            //Acciones para las solicitudes enviadas
            case 10:
                //Bien, lo que vamos a hacer aqui es marcar una solicitud como mylove para el usuario que la envio, para que cuando el otro
                //responda positivamente este otro sea el Love del usuario que la envio, el cual es el que realiza esta accion
            
                //Lo primero es saber si el id de la solicitud recibida existe o si en verdad este usuario principal fue el que la envio
                //Definimos los objetos a utilizar
                $selector = new Selector();
                
                $actualizador = new Actualizador();
                
                //Antes que todo, comprobamos que el usuario no tenga un Love definido
                if($selector->tieneLove($ID) == true){
                    //Este usuario tiene un love ya definido
                    echo "Ya tienes un love definido";
                }else{
                     //Si no tiene love definido, continuamos con el proceso
                    $resultado_solicitud = $selector->traerSolicitud($post_dato_solicitud);
            
                    if (mysql_num_rows($resultado_solicitud) > 0){
                        //Si existe ese id y ahora hay que comprobar que el usuario actual fue el que la envio
                        $datos_solicitud = mysql_fetch_assoc($resultado_solicitud);
                        
                        //Bien ahora para realizar la accion pertinente comprobamo9s que el usuario actual sea el enviador de la solicitud
                        if($datos_solicitud["id_enviador"] == $ID){
                            //Todo correcto, a marcar la solicitud como MyLove
                            $estado_solicitud = $datos_solicitud["estado"];
                            
                            if(strcmp($estado_solicitud, "99") == 0){
                                //El otro usuario ya ha rechazado la solicitud
                                echo "El destinatario ha rechazado tu solicitud";
                            }else{
                                if(strcmp($estado_solicitud, "0") == 0){
                                    //Quiere decir que la solicitud ya fue accionada anteriormente yno se puede realzar mas acciones
                                    echo "Esta solicitud ya fue respondda por ambos";
                                }else{
                                    //Bien Ahora comprobamos que el estado sea 1 y que el otro usuario no haya realizado acciones
                                    if(strcmp($estado_solicitud, "1") == 0){
                                        $actualizo_solicitud = $actualizador->cambiarSolicitudEstadoEnviador($post_dato_solicitud, 2);
                                        
                                        if($actualizo_solicitud == true){                                        
                                            echo "Si aceptan tu solicitud sera tu nuevo Love...";
                                            echo "<script>";
                                            echo    "$('#texto-estado-". $post_dato_solicitud."').html('". $idioma_solicitud->sol_est_si_acepta_mylove ."');";
                                            echo    "ponerCorazones();";
                                            echo "</script>";
                                        }else{
                                            echo "No se pudo marcar como tu Love...";
                                        }
                                        
                                    }
                                    
                                }//Fin del else de solicitud ya respondida
                            }//Fin del else de rechazo
                            
                        }else{
                            //No es el usuario actual que la envio, por lo tanto no puede realizar estaaccion
                            echo "Tu no has enviado esta solicitud";
                        }
                        
                    }else{
                        //No existe ese id de solicitud en la base de datos 
                        echo "No existe el id";
                    }
                }
                break;
                
            /**
             * oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
             * oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
             */
             case 11:
                //Lo que vamos a hacer aqui es marcar una solicitud como frienzone para el usuario que la envio, para que cuando el otro
                //responda positivamente este otro sea el friendzonado por el usuario que la envio, el cual es el que realiza esta accion
                
                //Lo primero es saber si el id de la solicitud recibida existe o si en verdad este usuario principal fue el que la envio
                //Definimos los objetos a utilizar
                $selector = new Selector();
                
                $actualizador = new Actualizador();
                
                
                $resultado_solicitud = $selector->traerSolicitud($post_dato_solicitud);
                
                if (mysql_num_rows($resultado_solicitud) > 0){
                    //Si existe ese id y ahora hay que comprobar que el usuario actual fue el que la envio
                    $datos_solicitud = mysql_fetch_assoc($resultado_solicitud);
                    
                    //Bien ahora para realizar la accion pertinente comprobamo9s que el usuario actual sea el enviador de la solicitud
                    if($datos_solicitud["id_enviador"] == $ID){
                        //Todo correcto, a marcar la solicitud como MyLove
                        $estado_solicitud = $datos_solicitud["estado"];
                        
                        if(strcmp($estado_solicitud, "99") == 0){
                            //El otro usuario ya ha rechazado la solicitud
                            echo "El destinatario ha rechazado tu solicitud";
                        }else{
                            if(strcmp($estado_solicitud, "0") == 0){
                                //Quiere decir que la solicitud ya fue accionada anteriormente yno se puede realzar mas acciones
                                echo "Esta solicitud ya fue respondda por ambos";
                            }else{
                                
                                $actualizo_solicitud = $actualizador->cambiarSolicitudEstadoEnviador($post_dato_solicitud, 3);
                                    
                                if($actualizo_solicitud == true){
                                    echo "Si aceptan tu solicitud quedara en la friendZone...";
                                    echo "<script>";
                                    echo    "$('#texto-estado-". $post_dato_solicitud."').html('". $idioma_solicitud->sol_est_si_acepta_friendZone ."');";
                                    echo "</script>";
                                }else{
                                    echo "No se pudo marcar como friendzone...";
                                }    
                            }//Fin del else de solicitud ya respondida
                        }//Fin del else de rechazo
                        
                    }else{
                        //No es el usuario actual que la envio, por lo tanto no puede realizar estaaccion
                        echo "Tu no has enviado esta solicitud";
                    }    
                    
                }else{
                    //No existe ese id de solicitud en la base de datos 
                    echo "No existe el id";
                }
                break;
                
             /**
              * ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
              * ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
              */
              //Acciones sobre las solicitudes recibidas
             //Para aceptar una solicitud como Su Love
             case 20:
                //Bien, aqui debemos tomar al usuario que recibe la solicitud y mararla como su nuevo Love
                //Definimos los objetos a utilizar
                $selector = new Selector();
                
                $actualizador = new Actualizador();
                
                $insertador = new Insertador();
                
                //Antes que todo, comprobamos que el usuario no tenga un Love definido
                if($selector->tieneLove($ID) == true){
                    //Este usuario tiene un love ya definido
                    echo "Ya tienes un love definido";
                }else{
                    $resultado_solicitud = $selector->traerSolicitud($post_dato_solicitud);
                
                    //Veos si existe la solicitud en cuestion
                    if (mysql_num_rows($resultado_solicitud) > 0){
                        //Si existe ese id y ahora hay que comprobar que el usuario actual fue el que la envio
                        $datos_solicitud = mysql_fetch_assoc($resultado_solicitud);
                        
                        //Bien ahora para realizar la accion pertinente comprobamo9s que el usuario actual es el que recibio la solicitud
                        if($datos_solicitud["id_solicitado"] == $ID){
                            //Todo correcto, a marcar la solicitud como MyLove
                            $estado_solicitud = $datos_solicitud["estado"];
                            $estado_enviador = $datos_solicitud["estado_enviador"];
                            $estado_solicitado = $datos_solicitud["estado_solicitado"];
                            $id_enviador = $datos_solicitud["id_enviador"];
                            
                            //Empezamos a actuar verificando los cuatros estados posibles de una solicitud
                            switch($estado_solicitud){
                                //La solicitud ya fue respondida por ambas partes positivamente
                                case 0:
                                    echo "Esta solicitud ya ha sido respondida por ambas partes...";
                                    break;
                                //La solicitud aun se encuentra en espera de respuesta
                                case 1:
                                    //Bien, vamos a aceptar la solicitud y marcar la respuesta del destinatario como su love
                                    
                                    $responder_solicitud = $actualizador->responderSolicitudRecibida($post_dato_solicitud, 2, 0);
                                    
                                    if($responder_solicitud == true){
                                        echo "Listo, has definido a tu Love...";
                                        //Pegamos la animacion...
                                        echo "<script>";
                                        echo    "$('#texto-estado-". $post_dato_solicitud."').html('". $idioma_solicitud->sol_est_acepto_mylove ."');";
                                        echo    "$('#cancelar-proceso-2').html('".$idioma_solicitud->aceptar."');";
                                        echo    "ponerCorazones();";
                                        echo    "$('#no-tiene-mensajes').remove();";
                                        echo    "traerBandejaMensajes();";
                                        echo "</script>";
                                        
                                        //Creamos la tabla que almacenara los mensajes de estos usuario
                                        $creador = new Creador();
                                        $creador->crearTablaMensajes($ID, $id_enviador, $selector, 2, $estado_enviador);
                                        
                                        //Si el usuario a quien se envio la solicitud no esta en linea, no hay necesidad de insertar el evento
                                        if($selector->estaEnLinea($id_enviador) == true){
                                            //El otro usuario esta en linea...
                                            //Lo insertamos en la tabla eventos
                                            $insertador->insertarEventoConDato(11, $id_enviador, $post_dato_solicitud);
                                        }//Si no esta en liena, no hay necesidad de crear el e
                                        
                                        
                                    }else{
                                        echo "No se ha podido responder la solicitud";
                                    }
                                    
                                    break;
                                //La solicitud fue rechazada normalmente por el usuario destinatario
                                case 98:
                                    echo "Ya lo ha rechazado";
                                    break;
                                //La solicitud fue rechazada y bloqueada por el usuario destinatario
                                case 99:
                                    echo "Ya lo ha bloqueado";
                                    break;
                                //No entyro a ninguno de los casos posibles
                                default:
                                    break;
                            }//Fin del switch
                            
                            
                            
                            
                        }else{
                            //El usuario actual no ha recibido esta solicitud
                            echo "Tu no fuistes el que envio esta solicitud";
                        }
                    }else{
                        echo "No existe esa solicitud";
                    }
                }
                break;
                
                
                
                
                
             //Para aceptar una solicitud y enviarlo a la friendZone
             case 21:
                //Bien, aqui debemos tomar al usuario que recibe la solicitud y marCarla como su FRIENDZONADO
                //Definimos los objetos a utilizar
                $selector = new Selector();
                
                $actualizador = new Actualizador();
                
                $insertador = new Insertador();
                
                //Bien, comprobamos que numero de friendZonados tiene para saber si los supera
                if($selector->darNumeroFriendzonados($ID) >= 7){
                    //Has superado el numero maximo de friendZonados
                    echo "Ups, haz superado el numero maximo de friendZonados, no puedes aceptar esta solicitud, a menos que desactives a alguien activo";
                }else{
                    $resultado_solicitud = $selector->traerSolicitud($post_dato_solicitud);
                
                    //Veos si existe la solicitud en cuestion
                    if (mysql_num_rows($resultado_solicitud) > 0){
                        //Si existe ese id y ahora hay que comprobar que el usuario actual fue el que la envio
                        $datos_solicitud = mysql_fetch_assoc($resultado_solicitud);
                        
                        //Bien ahora para realizar la accion pertinente comprobamo9s que el usuario actual es el que recibio la solicitud
                        if($datos_solicitud["id_solicitado"] == $ID){
                            //Todo correcto, a marcar la solicitud como MyLove
                            $estado_solicitud = $datos_solicitud["estado"];
                            $estado_enviador = $datos_solicitud["estado_enviador"];
                            $estado_solicitado = $datos_solicitud["estado_solicitado"];
                            $id_enviador = $datos_solicitud["id_enviador"];
                            
                            //Empezamos a actuar verificando los cuatros estados posibles de una solicitud
                            switch($estado_solicitud){
                                //La solicitud ya fue respondida por ambas partes positivamente
                                case 0:
                                    echo "Esta solicitud ya ha sido respondida por ambas partes...";
                                    break;
                                //La solicitud aun se encuentra en espera de respuesta
                                case 1:
                                    //Bien, vamos a aceptar la solicitud y marcar la respuesta del destinatario como su love
                                    
                                    $responder_solicitud = $actualizador->responderSolicitudRecibida($post_dato_solicitud, 3, 0);
                                    
                                    if($responder_solicitud == true){
                                        echo "Listo, lo has añadido a tu friendzone...";
                                        echo "<script>";
                                        echo    "$('#texto-estado-". $post_dato_solicitud."').html('". $idioma_solicitud->sol_est_acepto_frienzone ."');";
                                        echo    "$('#cancelar-proceso-2').html('".$idioma_solicitud->aceptar."');";
                                        echo    "$('#no-tiene-mensajes').remove();";
                                        echo    "traerBandejaMensajes();";
                                        echo "</script>";
                                        
                                        //Creamos la tabla que almacenara los mensajes de estos usuario
                                        $creador = new Creador();
                                        $creador->crearTablaMensajes($ID, $id_enviador, $selector, 3, $estado_enviador);
                                        
                                        //Si el usuario a quien se envio la solicitud no esta en linea, no hay necesidad de insertar el evento
                                        if($selector->estaEnLinea($id_enviador) == true){
                                            //El otro usuario esta en linea...
                                            //Lo insertamos en la tabla eventos
                                            $insertador->insertarEventoConDato(11, $id_enviador, $post_dato_solicitud);
                                        }//Si no esta en liena, no hay necesidad de crear el e
                                        
                                    }else{
                                        echo "No se ha podido responder la solicitud";
                                    }
                                    
                                    break;
                                //La solicitud fue rechazada normalmente por el usuario destinatario
                                case 98:
                                    echo "Ya lo ha rechazado";
                                    break;
                                //La solicitud fue rechazada y bloqueada por el usuario destinatario
                                case 99:
                                    echo "Ya lo ha bloqeuado";
                                    break;
                                //No entyro a ninguno de los casos posibles
                                default:
                                    break;
                            }//Fin del switch
                            
                            
                            
                            
                        }else{
                            //El usuario actual no ha recibido esta solicitud
                            echo "Tu no fuistes el que envio esta solicitud";
                        }
                    }else{
                        echo "No existe esa solicitud";
                    }
                }
                break;
             
             //Para eliminar una solicitud
             case 22:
             
                break;   
             //Para los eventos de las solicitudes 
             case 30:
                //El usuario esta online y ha recibido una nueva solicitud, la cual viene a pedir
                $selector = new Selector();
                $solicitudes = $selector->traerSolicitudes($ID);
            
                $filas = mysql_num_rows($solicitudes);
                if($filas == 0){
                    //No tiene solicitudes
                    echo "<script>";
                    echo    "$('.list-account > .list').append('<li class = \"aun-no-tiene-solicitudes\"><img src=\"assets/img/index.png\"><span class=\"name\">".$idioma_solicitud->sol_no_tiene ."</span> </li>');";
                    echo "</script>";
                }else{
                    //echo "Entro en algo". $solicitudes;
                    darSolicitudesNuevas($solicitudes, $ID, $selector, $idioma_solicitud);
                }
                break;
            
            //Para pedir una solicitud aceptada
            case 31:
                $selector = new Selector();
                
                $resultado_solicitud = $selector->traerSolicitud($post_dato_solicitud);
                
                //Veos si existe la solicitud en cuestion
                if (mysql_num_rows($resultado_solicitud) > 0){
                    //Si existe ese id y ahora hay que comprobar que el usuario actual fue el que la envio
                    $datos_solicitud = mysql_fetch_assoc($resultado_solicitud);
                    
                    //Bien ahora para realizar la accion pertinente comprobamo9s que el usuario actual es el que envio la solicitud
                    if($datos_solicitud["id_enviador"] == $ID){
                        //Todo correcto, cambiar el estado de la solicitud y decirle que ya se la aceptaron
                        $estado_solicitud = $datos_solicitud["estado"];
                        $estado_enviador = $datos_solicitud["estado_enviador"];
                        $estado_solicitado = $datos_solicitud["estado_solicitado"];
                        $id_solicitado = $datos_solicitud["id_solicitado"];
                        $tipo_nuevo_chat = 0;
                        
                        //Vemos como lo acepto el enviador para mostrarla correctamente
                        if($estado_enviador == 1 || $estado_enviador == 3){
                            $tipo_nuevo_chat = -2;
                        }
                        if($estado_enviador == 2){
                            $tipo_nuevo_chat = -1;
                        }
                        
                        //Empezamos a actuar verificando los cuatros estados posibles de una solicitud
                        switch($estado_solicitud){
                            //La solicitud ya fue respondida por ambas partes positivamente
                            case 0:
                                //La solicitud ya se encuentra finalizada
                                echo "<script>";
                                echo    "$('#texto-estado-". $post_dato_solicitud."').html('". $idioma_solicitud->sol_est_finalizada ."');";
                                echo    "traerBandejaMensajes();";
                                echo "</script>";
                                //darBandejaPrimerMensaje($id_solicitado, $selector, $idioma_solicitud, $tipo_nuevo_chat);
                                
                                //Listo, ya mostro las solicitudes nuevas, ahora a actualizar el valor del campo de solicitud
                                $selector->seleccionarEventoYCambiarEstado($ID, 11);
                                break;
                            //La solicitud aun se encuentra en espera de respuesta
                            case 1:
                            
                                break;
                            //La solicitud fue rechazada normalmente por el usuario destinatario
                            case 98:
                                echo "<script>";
                                echo    "$('#texto-estado-". $post_dato_solicitud."').html('". $idioma_solicitud->sol_est_no_acepto ."');";
                                echo "</script>";
                                //Listo, ya mostro las solicitudes nuevas, ahora a actualizar el valor del campo de solicitud
                                $selector->seleccionarEventoYCambiarEstado($ID, 13);
                                break;
                            //La solicitud fue rechazada y bloqueada por el usuario destinatario
                            case 99:
                                echo "<script>";
                                echo    "$('#texto-estado-". $post_dato_solicitud."').html('". $idioma_solicitud->sol_est_no_acepto_bloqueo ."');";
                                echo "</script>";
                                //Listo, ya mostro las solicitudes nuevas, ahora a actualizar el valor del campo de solicitud
                                $selector->seleccionarEventoYCambiarEstado($ID, 12);
                                break;
                            //No entyro a ninguno de los casos posibles
                            default:
                                break;
                        }//Fin del switch
                        
                        
                        
                    }else{
                        //El usuario actual no ha recibido esta solicitud
                        echo "Tu no fuistes el que envio esta solicitud";
                    }
                }else{
                    echo "No existe esa solicitud: " . $post_dato_solicitud;
                }
                break;
             
             //Para rechazar una solicitud
             case 98:
                $selector = new Selector();
                
                $actualizador = new Actualizador();
                
                $insertador = new Insertador();
                
                $resultado_solicitud = $selector->traerSolicitud($post_dato_solicitud);
                
                //Veos si existe la solicitud en cuestion
                if (mysql_num_rows($resultado_solicitud) > 0){
                    //Si existe ese id y ahora hay que comprobar que el usuario actual fue el que la envio
                    $datos_solicitud = mysql_fetch_assoc($resultado_solicitud);
                    
                    //Bien ahora para realizar la accion pertinente comprobamo9s que el usuario actual es el que recibio la solicitud
                    if($datos_solicitud["id_solicitado"] == $ID){
                        //Todo correcto, a marcar la solicitud como MyLove
                        $estado_solicitud = $datos_solicitud["estado"];
                        $estado_enviador = $datos_solicitud["estado_enviador"];
                        $estado_solicitado = $datos_solicitud["estado_solicitado"];
                        $id_enviador = $datos_solicitud["id_enviador"];
                        
                        //Empezamos a actuar verificando los cuatros estados posibles de una solicitud
                        switch($estado_solicitud){
                            //La solicitud ya fue respondida por ambas partes positivamente
                            case 0:
                                echo "Esta solicitud ya ha sido respondida por ambas partes...";
                                break;
                            //La solicitud aun se encuentra en espera de respuesta
                            case 1:
                                //Bien, vamos a aceptar la solicitud y marcar la respuesta del destinatario como su love
                                
                                $responder_solicitud = $actualizador->responderSolicitudRecibida($post_dato_solicitud, 98, 98);
                                
                                if($responder_solicitud == true){
                                    echo "Listo, has rechazado esta solicitud";
                                    //Pegamos la animacion...
                                    echo "<script>";
                                    echo    "$('#texto-estado-". $post_dato_solicitud."').html('". $idioma_solicitud->sol_est_rechazada ."');";
                                    echo    "$('#cancelar-proceso-2').html('".$idioma_solicitud->aceptar."');";
                                    echo "</script>";
                                                                        //Si el usuario a quien se envio la solicitud no esta en linea, no hay necesidad de insertar el evento
                                    if($selector->estaEnLinea($id_enviador) == true){
                                        //El otro usuario esta en linea...
                                        //Lo insertamos en la tabla eventos
                                        $insertador->insertarEventoConDato(13, $id_enviador, $post_dato_solicitud);
                                    }//Si no esta en liena, no hay necesidad de crear el e
                                    
                                    
                                }else{
                                    echo "No se ha podido responder la solicitud";
                                }
                                //La solicitud fue rechazada normalmente por el usuario destinatario
                            case 98:
                                echo "Ya ha rechazado";
                                break;
                            //La solicitud fue rechazada y bloqueada por el usuario destinatario
                            case 99:
                                echo "Ya ha bloqueado";
                                break;
                            //No entyro a ninguno de los casos posibles
                            default:
                                break;
                        }//Fin del switch
                        
                        
                    }else{
                        //El usuario actual no ha recibido esta solicitud
                        echo "Tu no fuistes el que envio esta solicitud";
                    }
                }else{
                    echo "No existe esa solicitud";
                }
                break;
                
             //Para rechazar y bloquear a el usuario que la envio
             case 99:
                $selector = new Selector();
                
                $actualizador = new Actualizador();
                
                $insertador = new Insertador();
                
                $resultado_solicitud = $selector->traerSolicitud($post_dato_solicitud);
                
                //Veos si existe la solicitud en cuestion
                if (mysql_num_rows($resultado_solicitud) > 0){
                    //Si existe ese id y ahora hay que comprobar que el usuario actual fue el que la envio
                    $datos_solicitud = mysql_fetch_assoc($resultado_solicitud);
                    
                    //Bien ahora para realizar la accion pertinente comprobamo9s que el usuario actual es el que recibio la solicitud
                    if($datos_solicitud["id_solicitado"] == $ID){
                        //Todo correcto, a marcar la solicitud como MyLove
                        $estado_solicitud = $datos_solicitud["estado"];
                        $estado_enviador = $datos_solicitud["estado_enviador"];
                        $estado_solicitado = $datos_solicitud["estado_solicitado"];
                        $id_enviador = $datos_solicitud["id_enviador"];
                        
                        //Empezamos a actuar verificando los cuatros estados posibles de una solicitud
                        switch($estado_solicitud){
                            //La solicitud ya fue respondida por ambas partes positivamente
                            case 0:
                                echo "Esta solicitud ya ha sido respondida por ambas partes...";
                                break;
                            //La solicitud aun se encuentra en espera de respuesta
                            case 1:
                                //Bien, vamos a aceptar la solicitud y marcar la respuesta del destinatario como su love
                                
                                $responder_solicitud = $actualizador->responderSolicitudRecibida($post_dato_solicitud, 99, 99);
                                
                                if($responder_solicitud == true){
                                    echo "Listo, has bloqueado ha este usuario";
                                    //Pegamos la animacion...
                                    echo "<script>";
                                    echo    "$('#texto-estado-". $post_dato_solicitud."').html('". $idioma_solicitud->sol_est_rechazada_bloqueo ."');";
                                    echo    "$('#cancelar-proceso-2').html('".$idioma_solicitud->aceptar."');";
                                    echo "</script>";
                                                                        //Si el usuario a quien se envio la solicitud no esta en linea, no hay necesidad de insertar el evento
                                    if($selector->estaEnLinea($id_enviador) == true){
                                        //El otro usuario esta en linea...
                                        //Lo insertamos en la tabla eventos
                                        $insertador->insertarEventoConDato(12, $id_enviador, $post_dato_solicitud);
                                    }//Si no esta en liena, no hay necesidad de crear el e
                                    
                                    
                                }else{
                                    echo "No se ha podido responder la solicitud";
                                }
                                //La solicitud fue rechazada normalmente por el usuario destinatario
                            case 98:
                                
                                break;
                            //La solicitud fue rechazada y bloqueada por el usuario destinatario
                            case 99:
                                
                                break;
                            //No entyro a ninguno de los casos posibles
                            default:
                                break;
                        }//Fin del switch
                        
                        
                    }else{
                        //El usuario actual no ha recibido esta solicitud
                        echo "Tu no fuistes el que envio esta solicitud";
                    }
                }else{
                    echo "No existe esa solicitud";
                }
                break;
                
             
             //Para aceptar una solicitud como Su Love
             default:
                //No entro en ninguno de los casos permitidos a las solicitudes
                break;
            
        }//Fin del switch
        
        
        
    }else{
        echo "Tiene inyeccion xd";
    }
}else{
    echo "<label>Inicia sesion...</label>";
    echo "<script>";
    echo "PUEDE_PEDIR_EVENTOS = false;";
    echo "</script>"; 
}

?>