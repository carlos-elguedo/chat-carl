<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include ("conexion/conexion.php");

class Creador{
 
    public function __construct() {
        
    }
    
    
    /**
     * Esta funcion es para crear en la base de datos una tabla por cada relacion que se genere entre usuario
     * La tabla estara compuesta de la siguiente manera:
     * "zmensajes-" + id usuario que acepto solicitud + "-" + id usuario que envio solicitud
     * La z es para ubicarla a lo ultimo del mysql, porque si dejo solo mensajes se ubicaran en el medio y sera muy tedioso despues 
     */
     function crearTablaMensajes($id_solicitado, $id_enviador, $selector, $est_per_1, $est_per_2){
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        $nombre = "". $id_solicitado . "_" . $id_enviador;
        $sql_credor_tabla = "CREATE TABLE IF NOT EXISTS zmensajes_". $nombre . " (".
            "id_mensaje BIGINT(20) AUTO_INCREMENT, ".
            //"id_relacion BIGINT(20), ".
            "de BIGINT(20), ".
            "para BIGINT(20), ".
            "tipo INT, ".
            "mensaje VARCHAR(8192), ".
            "est_entregado INT, ".
            "est_visto INT, ".
            "hora TIME, ".
            "fecha DATE, ".
            "enviado DATETIME, ".
            "entregado DATETIME, ".
            "visto DATETIME, ".
            "estado_enviador INT, ".
            "estado_receptor INT, ".
            "mensaje_bot_usu_1 VARCHAR(2048), ".
            "mensaje_bot_usu_2 VARCHAR(2048), ".
            "PRIMARY KEY(id_mensaje), ".
            "FOREIGN KEY (de) REFERENCES persona(id),".
            "FOREIGN KEY (para) REFERENCES persona(id)".
            //"FOREIGN KEY (id_relacion) REFERENCES relacion(id_relacion)".
            ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            
        $res_crear_tabla = mysql_query($sql_credor_tabla) or die ("No pudo crear la tabla de mensajes: " . mysql_error());
        
        if($res_crear_tabla == true){
            //Bien se ha creado la tabla
            
            //Sacamos los datos de los usuario
            $datos_solicitado = $selector->darDatosPersona($id_solicitado);
            $datos_enviador = $selector->darDatosPersona($id_enviador);
            
            $nombre_solicitado = $datos_solicitado["nombre"];
            $nombre_enviador = $datos_enviador["nombre"];
                                    
            if(strcmp($nombre_solicitado, "") == 0){
                $nombre_solicitado = $datos_solicitado["correo"];
                if(strcmp($nombre_solicitado, "") == 0){
                    $nombre_solicitado = $datos_solicitado["telefono_con_codigo"];
                }
            }
            if(strcmp($nombre_enviador, "") == 0){
                $nombre_enviador = $datos_enviador["correo"];
                if(strcmp($nombre_enviador, "") == 0){
                    $nombre_enviador = $datos_enviador["telefono_con_codigo"];
                }
            }
            
            //Procedemos a crear el primer mensaje
            $bot_mensaje_usu_1 = $nombre_enviador ." y tu se han unido en MyLove";
            $bot_mensaje_usu_2 = $nombre_solicitado ." y tu se han unido en MyLove";
            $nombre_tabla = "zmensajes_" . $nombre;
            
            $sql_primer_mensaje = "INSERT INTO zmensajes_" . $nombre . " (tipo, estado_enviador, estado_receptor, mensaje_bot_usu_1, mensaje_bot_usu_2, hora, fecha) VALUES (0, 1, 1, '$bot_mensaje_usu_1', '$bot_mensaje_usu_2', '$hora', '$fecha')";
            
            $res_primer_mensaje = mysql_query($sql_primer_mensaje) or die ("No se pudo crear el primer mensaje: " . mysql_error());
            
            //Listo, todo bien hasta aqui; procedemos a crear la relacion de estos dos usuario
            $sql_crear_relacion = "INSERT INTO relacion (id_persona_1, id_persona_2, estado, nombre_tabla_mensajes, hora, fecha, estado_persona_1, estado_persona_2) VALUES ('$id_solicitado', '$id_enviador', 1, '$nombre_tabla', '$hora', '$fecha', '$est_per_1', '$est_per_2')";
            
            $res_crear_relacion = mysql_query($sql_crear_relacion) or die ("No pudo crear la relacion de los usuarios: " . mysql_error());
            
        }else{
            echo "No se creo la tabla";
        }
            
        /*
        CREATE TABLE IF NOT EXISTS `friendzone` (
  `id_friendzone` bigint(20) NOT NULL,
  `id_usuario_1` bigint(20) DEFAULT NULL,
  `id_usuario_2` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
*/
     }
 }
 ?>