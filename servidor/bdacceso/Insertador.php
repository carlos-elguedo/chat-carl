<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include ("conexion/conexion.php");

class Insertador{
    
    var $hora;
    var $fecha;
    var $fecha_hora;
 
    public function __construct() {
        $this->fecha = date("Y-m-d");
        $this->hora = date("H:i:s");
        $this->fecha_hora = date("Y-m-d H:i:s");
    }
    
    
    
    /**
     * Esta funcion insertera una fila de la imagen de perfil en la base de datos
     */
    public function guadarImagenPerfilPersona($id_persona, $ruta, $contador){
        //echo "Llego: " . $id_persona . ":-:" . $ruta . ":--:" . $contador;
        $sql_guardar_imagen_perfil = "INSERT INTO imgperfil".
        "(id_persona, nombre, contador, estado, fecha_creacion, hora_creacion)".
        "VALUES".
        "($id_persona, '$ruta', $contador, 1, '$this->fecha', '$this->hora')";
        
        $resultado = mysql_query($sql_guardar_imagen_perfil) or die ("No se guardo la imagen de perfil " . mysql_error());
        
        return "OK";
    }
    
    /**
     * Este metodo es para el almacenamiento en la bse de datos las solicitudes enviadas
     */
     public function registrarSolicitud($id_enviador, $id_solicitado){
        $sql_insertar_solicitud = "INSERT INTO solicitud".
        "(id_enviador, id_solicitado, tipo, estado, estado_enviador, estado_solicitado, fecha, hora, fecha_hora)".
        "VALUES".
        "($id_enviador, $id_solicitado, 1, 1, 1, 1, '$this->fecha', '$this->hora', '$this->fecha_hora')";
        
        $resultado = mysql_query($sql_insertar_solicitud) or die ("No inserto la solicitud: " . mysql_error());
        
        return "ok";
     }
     
     /**
      * Este metodo es para ingresar en la tabla eventos un nuevo evento
      */
     public function insertarEvento($tipo_evento, $id_persona_dirigida){
        $sql_insertar_evento = "INSERT INTO eventos (id_persona, tipo, estado) VALUES ($id_persona_dirigida, $tipo_evento, 1)";
        
        $res = mysql_query($sql_insertar_evento) or die ("No pudo insertar el evento: " . mysql_error());
     }
     
     /**
      * Este metodo es igual que el anterio, pero recibe un dato del evento el cual es el id de la solicitud o mensaje que lo produce
      */
     public function insertarEventoConDato($tipo_evento, $id_persona_dirigida, $dato){
        $sql_insertar_evento = "INSERT INTO eventos (id_persona, tipo, estado, dato) VALUES ($id_persona_dirigida, $tipo_evento, 1, '$dato')";
        
        $res = mysql_query($sql_insertar_evento) or die ("No pudo insertar el evento: " . mysql_error());
     }
     /**
      * Esto es para los eventos de mensajes
     */
     public function insertarEventoConDatoCadena($tipo_evento, $id_persona_dirigida, $dato, $tabla){
        $sql_insertar_evento = "INSERT INTO eventos (id_persona, tipo, estado, dato, tabla) VALUES ($id_persona_dirigida, $tipo_evento, 1, '$dato', '$tabla')";
        
        $res = mysql_query($sql_insertar_evento) or die ("No pudo insertar el evento de nuevo mensaje: " . mysql_error());
     }
     
     /**
      * Este metodo es igual que el anterio, pero actualizara un registro ya existente en vez de registrarlo
      */
     public function actualizarEventoConDato($tipo_evento, $id_persona_dirigida, $dato){
        $sql_insertar_evento = "UPDATE eventos SET estado = 1, dato = '$dato' WHERE id_persona = '$id_persona_dirigida' AND tipo = $tipo_evento";
        
        $res = mysql_query($sql_insertar_evento) or die ("No pudo Actualizar el evento el evento: " . mysql_error());
     }
     
     
     
     /**
      * Esta funcion es para el envio de mensajes normales
      */
     function insertarMensaje($id_persona, $id_otro, $msg, $nombre_tabla){
        echo "Nombre tabla" . $nombre_tabla;
        $sql_ins_mensaje = "INSERT INTO ".$nombre_tabla." (de, para, tipo, estado_enviador, estado_receptor, mensaje, hora, fecha, enviado, entregado, visto)".
        " VALUES ('$id_persona', '$id_otro', 1, 1, 1, '$msg', '$this->hora', '$this->fecha', '$this->fecha_hora', 0, 0)";
        
        $resultado_enviar_mensaje = mysql_query($sql_ins_mensaje) or die ("No pudo envar el mensaje: " . mysql_error());
        
        return "ok";
     }
 
 
}//Fin de la clase
?>