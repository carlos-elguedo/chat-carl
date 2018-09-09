<?php
/**
 *      Esta clase es la mas solicitada de la aplicacion, ya que el cada usuario la llama cada 1 segundo
 *      Es para consultar en la base de datos el valor del campo evento del usuario, para que cuando se produsca alguno en la base de datos
 *      Se le haga saber al usuario y este lo pida con su resectivo metodo
 * 
 *      Lista de eventos:
 * 
 *      0:  No hay eventos
 * 
 * 
 *      Solicitudes:
 *          10: Ha recibido una nueva solicitud
 *          11: Han aceptado tu solicitud como mylove o friendZone, no se puede decir xd
 *          12: Han rechazado y bloqueado la solicitud que el usuario envio
 *          13: Han rechazado la solicitud que el usuario envio
 * 
 *      Mensajes:
 *          20: Un usuario esta escribiendo en el chat
 *          21: Nuevo mensaje a sido recibido
 *          22: Un mensaje enviado a sido entregado
 * 
 * 
 */


include ("conexion/conexion.php");

class Evento{
 
    public function __construct() {
        
    }
    
    
    /**
     * Esta funcion es para pbtener de la base de datos el valo del evento del usuario
     */
    public function getEvento($id_persona){
        
        $sql_sacar_evento = "SELECT tipo, dato FROM eventos WHERE id_persona = '$id_persona' AND estado = 1";
        
        $res = mysql_query($sql_sacar_evento) or die ("No pudo sacar el evento: " . mysql_error());
        
        if (mysql_num_rows($res) > 0){
            $datos = mysql_fetch_assoc($res);
            return $datos;
        }else{
            return false;
        }
        
        
    }
    
    
    /**
     * Esta funcion devolvera un tipo de evento especifico, similar al enterior, pero este devuelve los activos y de un determinado tipo
     */
    public function getEventoEspecifico($id_persona, $tipo){
        
        $sql_sacar_evento = "SELECT dato, tabla, dato_2 FROM eventos WHERE id_persona = '$id_persona' AND estado = 1 AND tipo = '$tipo'";
        
        $res = mysql_query($sql_sacar_evento) or die ("No pudo sacar el evento especifico: " . mysql_error());
        
        if (mysql_num_rows($res) > 0){
            $datos = mysql_fetch_assoc($res);
            return $datos;
        }else{
            return false;
        }
        
        
    } 
    
    /**
     * Esta funcion actualizara en la base de datos el valor de campo del estado de un evento
     * O sea, cuando ya el otro usuario haya procesado un evento, le tiene que cambiar el estado a este
     */
    public function setEvento($estado, $id_persona_a_quien_va_dirido_el_evento){
        $sql_actualizar_evento = "UPDATE evento SET estado = '$estado' WHERE id_persona = '$id_persona_a_quien_va_dirido_el_evento'";
        
        $res = mysql_query($sql_actualizar_evento) or die ("No pudo actualizar el evento: " . mysql_error());
        
    }
    
    /**
     * Esta funcion inserta un evento
     */
     public function insertarEvento($id_persona_dirigida, $tipo, $dato, $tabla, $dato_2){
        $sql_insertar_evento = "INSERT INTO eventos (id_persona, tipo, estado, dato, tabla, dato_2) VALUES ($id_persona_dirigida, $tipo, 1, '$dato', '$tabla', '$dato_2')";
        
        $res = mysql_query($sql_insertar_evento) or die ("No pudo insertar el evento de mensaje entregado: " . mysql_error());
        
     }
}
?>