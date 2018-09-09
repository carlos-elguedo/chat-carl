<?php

function darSolicitudes($solicitudes, $id, $selector, $idioma_solicitud){
    //Bien, procedemos a mostrar las solicitudes
    while($solicitud = mysql_fetch_array($solicitudes) ){
        $id_solicitud = $solicitud["id_solicitud"];
        $enviador = $solicitud["id_enviador"];
        $solicitado = $solicitud["id_solicitado"];
        $estado = $solicitud["estado"];
        $estado_enviador = $solicitud["estado_enviador"];
        $estado_solicitado = $solicitud["estado_solicitado"];
        $class_estado = "";
        $texto_estado = "";
                        
        if($enviador == $id){
            //Si la solicitud encontrada fue enviada por el usuario actual...
            $otro_usuario = $selector->darDatosPersona($solicitado);
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
            
            //Para el estado general de la solicitud
            switch($estado){
                //La solicitud ya esta finalizada
                case 0:
                    //Si el estado de la solicitud es 0 es porque ya ambas partes la respondieron
                    $texto_estado = $idioma_solicitud->sol_est_finalizada;
                    if($estado_enviador == 1 || $estado_enviador == 2){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_marcado_mylove;
                    }
                    if($estado_enviador == 3){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_marcado_friendzone;
                    }
                    break;
                case 1:
                    //La solicitud esta normal, aun en espera
                    $class_estado = "virgen";
                    if($estado_enviador == 2){
                        $texto_estado = $idioma_solicitud->sol_est_si_acepta_mylove;
                    }
                    if($estado_enviador == 1 || $estado_enviador == 3){
                        $texto_estado = $idioma_solicitud->sol_est_si_acepta_friendZone;
                    }
                    break;
                case 98:
                    //El estado de su solicitud fue rechazada por el otro usuario
                    $texto_estado = $idioma_solicitud->sol_est_no_acepto;
                    break;
                case 99:
                    //Su solicitud fue bloqueada por el otro usuario 
                    $texto_estado = $idioma_solicitud->sol_est_no_acepto_bloqueo;
                    break;
                default:
                    $texto_estado = $idioma_solicitud->sol_est_error;
                    break;
            }//Fin del switch
            
            //Procedemos a mostrar la solicitud:
            echo "<script>";
            echo    "$('.list-account > .list').append('<li  class = \"solicitud-suya virgen\" onclick = \"AccionSolicitud(" . $id_solicitud . ")\"><img src=\"http://localhost/mylove/servidor/archivos/imagenesPerfil/" . $imagen_otro . "\"><span class=\"name\">" . $idioma_solicitud->sol_has_enviado_solicitud . $nombre_otro . "</span> <span  id = \"texto-estado-".$id_solicitud."\" class = \"estado-solicitud\">" . $texto_estado . "</span> </li>');";
            //<input val=\"" .$id_solicitud ."\" class = \"id-solicitud\" hidden/>
            echo "</script>";
                            
        }else{
            //Entonces es una solicitud recibida
            $otro_usuario = $selector->darDatosPersona($enviador);
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
            
            //Para el estado general de la solicitud
            switch($estado){
                //La solicitud ya esta finalizada
                case 0:
                    //Si el estado de la solicitud es 0 es porque ya ambas partes la respondieron
                    $texto_estado = $idioma_solicitud->sol_est_finalizada;
                    if($estado_solicitado == 1){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_error;
                    }
                    if($estado_solicitado == 2){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_acepto_mylove;
                    }
                    if($estado_solicitado == 3){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_acepto_frienzone;
                    }
                    if($estado_solicitado == 98){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_rechazada;
                    }
                    if($estado_solicitado == 99){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_rechazada_bloqueo;
                    }
                    
                    break;
                case 1:
                    //La solicitud esta normal, aun en espera
                    $class_estado = "virgen";
                    if($estado_solicitado == 1){
                        $texto_estado = $idioma_solicitud->sol_est_aun_no_responde_recibida;
                    }
                    break;
                case 98:
                    //El estado de su solicitud fue rechazada por este usuario
                    $texto_estado = $idioma_solicitud->sol_est_rechazada;
                    break;
                case 99:
                    //Su solicitud fue bloqueada por este usuario
                    $texto_estado = $idioma_solicitud->sol_est_rechazada_bloqueo;
                    break;
                default:
                    $texto_estado = $idioma_solicitud->sol_est_error;
                    break;
            }//Fin del switch
            
            //Procedemos a mostrar la solicitud:
            echo "<script>";
            echo    "$('.list-account > .list').append('<li class = \"solicitud-recibida virgen\" onclick = \"AccionSolicitud(" . $id_solicitud . ")\"><img src=\"http://localhost/mylove/servidor/archivos/imagenesPerfil/" . $imagen_otro . "\"><span class=\"name\">" . $nombre_otro . $idioma_solicitud->sol_has_recibido_solicitud ."</span> <span  id = \"texto-estado-".$id_solicitud."\" class = \"estado-solicitud\">".$texto_estado."</span> </li>');";
            echo "</script>";
        }
    }//Fin del while
    
}//Fin de la funcion





function darSolicitudesNuevas($solicitudes, $id, $selector, $idioma_solicitud){
    //Bien, procedemos a mostrar las solicitudes
    echo "<script>";
    echo "$('.list-account > .list').html('');";
    while($solicitud = mysql_fetch_array($solicitudes) ){
        $id_solicitud = $solicitud["id_solicitud"];
        $enviador = $solicitud["id_enviador"];
        $solicitado = $solicitud["id_solicitado"];
        $estado = $solicitud["estado"];
        $estado_enviador = $solicitud["estado_enviador"];
        $estado_solicitado = $solicitud["estado_solicitado"];
        $class_estado = "";
        $texto_estado = "";
                        
        if($enviador == $id){
            //Si la solicitud encontrada fue enviada por el usuario actual...
            $otro_usuario = $selector->darDatosPersona($solicitado);
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
            
            //Para el estado general de la solicitud
            switch($estado){
                //La solicitud ya esta finalizada
                case 0:
                    //Si el estado de la solicitud es 0 es porque ya ambas partes la respondieron
                    $texto_estado = $idioma_solicitud->sol_est_finalizada;
                    if($estado_enviador == 2){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_marcado_mylove;
                    }
                    if($estado_enviador == 1 || $estado_enviador == 3){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_marcado_friendzone;
                    }
                    break;
                case 1:
                    //La solicitud esta normal, aun en espera
                    $class_estado = "virgen";
                    if($estado_enviador == 1 || $estado_enviador == 2){
                        $texto_estado = $idioma_solicitud->sol_est_si_acepta_mylove;
                    }
                    if($estado_enviador == 3){
                        $texto_estado = $idioma_solicitud->sol_est_si_acepta_friendZone;
                    }
                    break;
                case 98:
                    //El estado de su solicitud fue rechazada por el otro usuario
                    $texto_estado = $idioma_solicitud->sol_est_no_acepto;
                    break;
                case 99:
                    //Su solicitud fue bloqueada por el otro usuario 
                    $texto_estado = $idioma_solicitud->sol_est_no_acepto_bloqueo;
                    break;
                default:
                    $texto_estado = $idioma_solicitud->sol_est_error;
                    break;
            }//Fin del switch
            
            //Procedemos a mostrar la solicitud:
            echo    "$('.list-account > .list').append('<li  class = \"solicitud-suya virgen\" onclick = \"AccionSolicitud(" . $id_solicitud . ")\"><img src=\"http://localhost/mylove/servidor/archivos/imagenesPerfil/" . $imagen_otro . "\"><span class=\"name\">" . $idioma_solicitud->sol_has_enviado_solicitud . $nombre_otro . "</span> <span  id = \"texto-estado-".$id_solicitud."\" class = \"estado-solicitud\">" . $texto_estado . "</span> </li>');";
            //<input val=\"" .$id_solicitud ."\" class = \"id-solicitud\" hidden/>
                            
        }else{
            //Entonces es una solicitud recibida
            $otro_usuario = $selector->darDatosPersona($enviador);
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
            
            //Para el estado general de la solicitud
            switch($estado){
                //La solicitud ya esta finalizada
                case 0:
                    //Si el estado de la solicitud es 0 es porque ya ambas partes la respondieron
                    $texto_estado = $idioma_solicitud->sol_est_finalizada;
                    if($estado_solicitado == 1){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_error;
                    }
                    if($estado_solicitado == 2){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_acepto_mylove;
                    }
                    if($estado_solicitado == 3){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_acepto_frienzone;
                    }
                    if($estado_solicitado == 98){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_rechazada;
                    }
                    if($estado_solicitado == 99){
                        $texto_estado .= " " . $idioma_solicitud->sol_est_rechazada_bloqueo;
                    }
                    
                    break;
                case 1:
                    //La solicitud esta normal, aun en espera
                    $class_estado = "virgen";
                    if($estado_solicitado == 1){
                        $texto_estado = $idioma_solicitud->sol_est_aun_no_responde_recibida;
                    }
                    break;
                case 98:
                    //El estado de su solicitud fue rechazada por este usuario
                    $texto_estado = $idioma_solicitud->sol_est_rechazada;
                    break;
                case 99:
                    //Su solicitud fue bloqueada por este usuario
                    $texto_estado = $idioma_solicitud->sol_est_rechazada_bloqueo;
                    break;
                default:
                    $texto_estado = $idioma_solicitud->sol_est_error;
                    break;
            }//Fin del switch
            
            //Procedemos a mostrar la solicitud:
            echo    "$('.list-account > .list').append('<li class = \"solicitud-recibida virgen\" onclick = \"AccionSolicitud(" . $id_solicitud . ")\"><img src=\"http://localhost/mylove/servidor/archivos/imagenesPerfil/" . $imagen_otro . "\"><span class=\"name\">" . $nombre_otro . $idioma_solicitud->sol_has_recibido_solicitud ."</span> <span  id = \"texto-estado-".$id_solicitud."\" class = \"estado-solicitud\">".$texto_estado."</span> </li>');";
        }
    }//Fin del while
    echo "</script>";
    
    //Listo, ya mostro las solicitudes nuevas, ahora a actualizar el valor del campo de solicitud
    $selector->seleccionarEventoYCambiarEstado($id, 10);
    
}//Fin de la funcion

?>