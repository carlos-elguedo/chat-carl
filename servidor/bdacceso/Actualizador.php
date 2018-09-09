<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include ("conexion/conexion.php");

class Actualizador{
    var $hora;
    var $fecha;
    var $fecha_hora;
 
    public function __construct() {
        $this->fecha = date("Y-m-d");
        $this->hora = date("H:i:s");
        $this->fecha_hora = date("Y-m-d H:i:s");
    }
    
    
    
    
    /**
     * Este metodo de la clase es para actualizar el nombre del usuario en la base de datos
     */
     public function cambiarNombre($id_persona, $nombre){
        $sql_act_nombre = "UPDATE persona SET nombre = '$nombre' WHERE id = '$id_persona'";
        
        $res = mysql_query($sql_act_nombre) or die ("No se actualizo el nombre del usuario: " .  mysql_error());
        
        return $res;
     }//Fin de la funcion
     
     
     /**
      * Esre metodo cambiara el estado del enviador en una solicitud a el valor recibido
      */
      public function cambiarSolicitudEstadoEnviador($id_solicitud, $estado_enviador){
        $sql_act_estado_enviador_solicitud = "UPDATE solicitud SET estado_enviador = '$estado_enviador' WHERE id_solicitud = '$id_solicitud'";
        
        $res = mysql_query($sql_act_estado_enviador_solicitud) or die ("No pudo actualizar el estado del enviador: " . mysql_error());
        
        return $res;
      }
     
     /**
      * Esta funcion es para actualizar el estado, la hora y fehca de una solicitud recibida por el usuario
      */
     public function responderSolicitudRecibida($id_solicitud, $estado_sol_respuesta, $estado_solicitud){
        //Creamos la fecha de la respuesta
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        
        //Creamos la consulta que actualizara la solicitud
        $sql_reponder_solicitud = "UPDATE solicitud SET ".
         "estado_solicitado = '$estado_sol_respuesta', ".
         "estado = '$estado_solicitud', ".
         "hora_respuesta = '$hora', ".
         "fecha_respuesta = '$fecha' ".
         "WHERE id_solicitud = '$id_solicitud'";
         
         $res = mysql_query($sql_reponder_solicitud) or die ("No se pudo responder la solicitud: " . mysql_error());
         
         return $res;
     }
     
     /**
      * Esta funciuon es para actualizar el estado de conexion de un usuario
      */
      public function enlinea($id_persona, $estado){
        $sql_actualizar_enlinea = "UPDATE enlinea SET estado = '$estado' WHERE id_persona = '$id_persona'";
        $res = mysql_query($sql_actualizar_enlinea) or die ("No se actualizo el estado de la conexion: " . mysql_error());
      }
      
      /**
       * Esta funcion es para cambiar el estado del mensaje que ya a sido entregado
       */
      public function mensajeEntregado($id_mensaje, $tabla){
        $sql_mensaje_entregado = "UPDATE ". $tabla . " SET est_entregado = 1, entregado = '$this->fecha_hora' WHERE id_mensaje = '$id_mensaje'";
        $res = mysql_query($sql_mensaje_entregado) or die ("No pudo actualizar el entregado");
      }
     
     
 }