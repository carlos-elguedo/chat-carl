<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include ("conexion/conexion.php");

class Selector{
 
    public function __construct() {
        
    }
    
    
    /**
     * Esta funcion es para sacar de la base de datos el id de un usuario, recibiendo como parametro
     * El correo, telefono o codigo de el
     * Si no existe devolvera false
     */
     public function darIdPersona($dato){
        $sql_sacar_id_de_usuarios = "SELECT id_persona FROM usuario WHERE correo = '$dato' OR telefono = '$dato' OR telefono_con_codigo = '$dato'";
        
        $res = mysql_query($sql_sacar_id_de_usuarios) or die ("No pudo traer el id del usuario: " . mysql_error());
        
        $datos = mysql_fetch_assoc($res);
        
        return $datos["id_persona"];
     }
    
    
    
    /**
     * Funcion que devolvera el dato pedido como parametro
     */
     public function darDatoPersona($dato_a_consultar='', $id_persona){
        $sql_traer_Dato = "SELECT " . $dato_a_consultar . " FROM persona WHERE id = '$id_persona'";
        
        $resultado = mysql_query($sql_traer_Dato) or die ("No pudo traer el dato pedido, dato:" . $dato_a_consultar . mysql_error());
        
        $datos = mysql_fetch_assoc($resultado);
        
        
        return $datos[$dato_a_consultar];
     }
     
     /**
     * Funcion que devolvera todos lod datos de una persona
     */
     public function darDatosPersona( $id_persona){
        $sql_traer_datos = "SELECT * FROM persona WHERE id = '$id_persona'";
        
        $resultado = mysql_query($sql_traer_datos) or die ("No pudo traer los datos de la persona:" . $dato_a_consultar . mysql_error());
        
        $datos = mysql_fetch_assoc($resultado);
        
        return $datos;
     }
     
     
     
     
     /**
      * Esta funcion devolvera el numero de imagenes de perfil que tiene un usuario
      */
      function darNumeroImagenPerfil($id_persona){
        
        $sql_sacar_contador = "SELECT MAX(contador) AS contador FROM imgPerfil WHERE id_persona = '$id_persona'";
        
        $resultado = mysql_query($sql_sacar_contador) or die ("No trajo el contador " . mysql_error());
        
        $datos = mysql_fetch_assoc($resultado);
        
        return $datos["contador"];
      }
      
       
       
       
       /**
        * Esta funcion es para saber si en la tabla de solicitudes existe una solicitud registrada con los usuarios en cuestion
        */
        public function existeSolicitud($usuario_1, $usuario_2){
            $retorno = 0;
            
            $sql_consultar_solicitudes = "SELECT * FROM solicitud WHERE (id_enviador = '$usuario_1' AND id_solicitado = '$usuario_2') OR (id_enviador = '$usuario_2' AND id_solicitado = '$usuario_1')";
            
            $resultado = mysql_query($sql_consultar_solicitudes) or die ("  No realizo la consulta de solicitudes: " . mysql_error());
            
            if (mysql_num_rows($resultado) > 0){
                $datos = mysql_fetch_assoc($resultado);
                
                //Ahora comprobamos que el estado de la solicitud no sea 1
                //99 es el estado que indica que una solicitud no tiene valides, ya sea que fue rechazada normalmente 
                if($datos["estado"] == 99){
                    $retorno = 1;
                }else{
                    if($datos["id_enviador"] == $usuario_1){
                        //Esto quiere decir que ya este usuario le mando la solicitud a quien planea enviarsela
                        //Osea sel la quiere enviar nuevamente
                        $retorno = 2;
                    }else{
                        $retorno = 3;
                    }
                }
                
            }else{
                //Puede insertarse la nueva solicitud, ya que no existe
                $retorno = 1;
            }
            
            return $retorno;
        }
        
        
        /**
         * Esta funcion es para sacar de la base da datos las solicirrudes de los isaros
         */
         public function traerSolicitudes($id_persona){
            $sql_solicitudes = "SELECT * FROM solicitud WHERE id_enviador = '$id_persona' OR id_solicitado = '$id_persona'";
            
            $resultado = mysql_query($sql_solicitudes) or die ("No pudo traer las solicitudes desde el servidor");
            
            return $resultado;
         }
    
        /**
         * Esta funcion es para traer una solicitud especifica de la base de datos
         * Recibe el id de la solicitud y retorna todos los datos de la solicitud en cuestion
         */
         public function traerSolicitud($id_solicitud){
            $sql_traer_solicitud = "SELECT * FROM solicitud WHERE id_solicitud = '$id_solicitud'";
            
            $resultado = mysql_query($sql_traer_solicitud) or die ("No pudo traer la solicitud: " . mysql_error());
            
            return $resultado;
         }
         
         
         /**
          * Esta funcion es para consultar el id de una solicitud en espicifico, recibe el id del enviador y id del solicitado
          */
         function darIdSolicitud($id_1, $id_2){
            $retorno = 0;
            
            $sql_traer_id = "SELECT id_solicitud FROM solicitud WHERE id_enviador = '$id_1' AND id_solicitado = '$id_2'";
            
            $resultado = mysql_query($sql_traer_id) or die ("No pudo  traer el id de la solicitud: " . mysql_error()); 
            
            if (mysql_num_rows($resultado) > 0){
                $datos = mysql_fetch_assoc($resultado);
                $retorno = $datos["id_solicitud"];
            }
            
            return $retorno;
         }
         
         /**
          * Este metodo es para saber si una persona esta en linea o no lo esta
          */
         public function estaEnLinea($id_persona){
            $retorno = false;
            
            $sql_esta_enlinea = "SELECT estado FROM enlinea WHERE id_persona = '$id_persona'";
            
            $res = mysql_query($sql_esta_enlinea) or die ("No pudo traer e estado de enlinea : " . mysql_error());
            
            if (mysql_num_rows($res) > 0){
                $dato = mysql_fetch_assoc($res);
                
                if($dato["estado"] == 1){
                    //Esta en linea
                    $retorno = true;
                }
            }
            return $retorno;
         }
    
        /**
         * Esta funcion es para seleccionar y actualizar el estado de un evento
         */
        public function seleccionarEventoYCambiarEstado($id_persona_eve_dirigido, $tipo_evento){
            $sql_selec_y_actualizar_evento = "UPDATE eventos SET estado = 0 WHERE id_persona = '$id_persona_eve_dirigido' AND tipo = '$tipo_evento'";
            $ree = mysql_query($sql_selec_y_actualizar_evento) or die ("No pudo seleccionar ni actualizar el evento: " . mysql_error());
        }
        
        /**
         * Esta funcion es para traer desde la base de datos las relaciones activas que tiene un usuario las cuales se mostraran en la bandeja
         * de mensajes, devuelve el array
         */ 
        public function darRelaciones($id_persona){
            $sql_traer_relaciones = "SELECT * FROM relacion WHERE (id_persona_1 = '$id_persona' OR id_persona_2 = '$id_persona') AND (estado = 1)";            
            
            $resultado = mysql_query($sql_traer_relaciones) or die ("No pudo traer las relciones del usuario : " . mysql_error());
            
            
            return $resultado;
        }
        
        /**
         * Esta funcion es para obtener desde la base de datos una relacion especifica
         * Recibe el id de la relacion la cual quiere sacar y el id del usuario para control del proceso
         */
        public function darRelacion($id_relacion, $id_persona){
            $sql_traer_relacion = "SELECT * FROM relacion WHERE (id_persona_1 = '$id_persona' OR id_persona_2 = '$id_persona') AND (estado = 1) AND (id_relacion = '$id_relacion')";            
            
            $resultado = mysql_query($sql_traer_relacion) or die ("No pudo traer la relcion del usuario : " . mysql_error());
            
            
            return $resultado;
        }
        

        /**
         * Este metodo es importantisimo, traera los mensajes de una tabla para mostrarlos...
         * Recibe el nombre de la tabla
         */
        public function darUltimoMensaje($nombre_tabla){
            $sql_traer_mensajes = "SELECT * FROM ". $nombre_tabla . " WHERE id_mensaje = (SELECT MAX(id_mensaje) FROM " . $nombre_tabla .");";
            $resultado = mysql_query($sql_traer_mensajes) or die ("No pudo traer el ultimo mensaje de la tabla: " . $nombre_tabla . " : " . mysql_error());
            return $resultado;
        }
        
        
        /**
         * Esta funcion es para consultar en la tabla MyLove si un usuario tiene ya un love definido, si ya tiene retorna verdadero
         */
        public function tieneLove($id_persona){
            $retorno = false;
            $sql_traer_mylove = "SELECT id_mylove FROM mylove WHERE id_usuario_1 = '$id_persona' AND estado = 1";
            
            $res = mysql_query($sql_traer_mylove) or die ("No busco si tenia love: " . mysql_error());
            
            if(mysql_num_rows($res) > 0){
                $retorno = true;
            }
            return $retorno;
        }
        
        /**
         * Esta funcion es para conocer el numero de friendZonados que tiene una persona, esta funcion solo devuelve el numero de friendZonados
         */
        public function darNumeroFriendzonados($id_persona){
            $sql_traer_mylove = "SELECT id_friendzone FROM friendzone WHERE id_usuario_1 = '$id_persona' AND estado = 1";
            
            $res = mysql_query($sql_traer_mylove) or die ("No busco el numero de friendZonados: " . mysql_error());
            
            return mysql_num_rows($res);
        }
        
        /**
         * Esta funcion es para devolverdesde la base de datos el nombre de una tabla de mensajes ubicada en una relacion
         */
        public function darNombreTablaRelacion($id_relacion){
            $retorno = "";
            $sq_sacar_nombre_tabla = "SELECT nombre_tabla_mensajes FROM relacion WHERE id_relacion = '$id_relacion'";
            
            $resultado = mysql_query($sq_sacar_nombre_tabla) or die ("No pudo consultar el nombre de la tabla: " . mysql_error());
            
            if(mysql_num_rows($resultado) > 0){
                $dato = mysql_fetch_assoc($resultado);
                $retorno = $dato["nombre_tabla_mensajes"];
            }
            return $retorno;
        }

        /**
         * Seleccionar mensajes nuevos de la base de datos, recibiendo el id del usuario qu los recibio y el nombre de la tabla
         */
        public function nuevoMensaje($id_persona, $tabla){
            $sql_sacar_nuevos_mensajes = "SELECT * FROM ".$tabla." WHERE para = '$id_persona' AND est_entregado = 0";
            
            $resultado = mysql_query($sql_sacar_nuevos_mensajes) or die ("No pudo traer los nuevos mensajes recibidos...: " . mysql_error());
            return $resultado;
        }
        
        /**
         * Esta funcion trae un mensaje especifico de la tabla recibida como parametro
         */
         public function traerMensaje($id_persona_enviadora, $tabla, $id_mensaje){
            $sql_sacar_mensaje = "SELECT * FROM ".$tabla." WHERE de = '$id_persona_enviadora' AND est_entregado = 1 AND id_mensaje = '$id_mensaje'";
            
            $resultado = mysql_query($sql_sacar_mensaje) or die ("No pudo traer el mensaje entregado...: " . mysql_error());
            return $resultado;
        }
         



}//Fin de la clase

