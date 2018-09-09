<?php

include ("conexion/conexion.php");

class Mensajes{
    
    var $id_relacion;
    var $id_persona_actual;
    var $id_otra_persona;
    var $tabla_mensajes;
    var $pocision_persona_en_la_relacion;
 
    public function __construct($id_rel) {
        $this->id_relacion = $id_rel;
        $this->tabla_mensajes;
    }
    
    /**
     * Esta funcion traera de la base de datos los mensajes de una tabla, los cuales los devolvera a quien se los pida
    */
    public function darMensajes(){
        $sql_sacar_mensajes = "SELECT * FROM ". $this->tabla_mensajes;
        $resultado = mysql_query($sql_sacar_mensajes) or die ("No pudo traer los mensajes :" . mysql_error());
        
        return $resultado;
    }
    
    
    /**
     * Este metodo colocara en esta clase la variable tabla_mensajes con su respectivo valor
     * Si no es correcto el id del solicitado en la relacion actual, producira false
     */
    public function setNombreTabla($id_persona){
        $this->id_persona_actual = $id_persona;
        $retorno = false;
        $sql_sacar_nombre_tabla = "SELECT nombre_tabla_mensajes, id_persona_1, id_persona_2 FROM relacion WHERE id_relacion = '$this->id_relacion'";
        
        $res = mysql_query($sql_sacar_nombre_tabla) or die ("No pudo traer el los datos de la relacion: " . mysql_error());
        
        if(mysql_num_rows($res) > 0){
            $datos = mysql_fetch_assoc($res);
            
            if($datos["id_persona_1"] == $id_persona || $datos["id_persona_2"] == $id_persona){
                //Todo correcto, el usuario pertenece a esta relacion
                $this->tabla_mensajes = $datos["nombre_tabla_mensajes"];
                $retorno = true;
                //Ahora comprobamos cual es el id del otro usuario:
                if($datos["id_persona_1"] == $id_persona){
                    $this->pocision_persona_en_la_relacion = 1;
                    $this->id_otra_persona = $datos["id_persona_2"]; 
                }else{
                    $this->id_otra_persona = $datos["id_persona_1"];
                    $this->pocision_persona_en_la_relacion = 2;
                }
            }
        }//Fin del comprobar que sea mayor a 0
        
        return $retorno;
    }//Fin del metodo
      
 }