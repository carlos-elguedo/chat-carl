<?php
session_start();
//require_once 'Selector.php';
include ("conexion/conexion.php");
require_once '../funciones/Idiomas.php';
include ("funcionesbd.php");
include ("Utilidadesbd.php");



//$conexion = $mlconexion;

class Activacion{
    
    //Variable id del usuario
    var $ID;
    
    public function __construct() {
        
    }//Fin del constructor
    
    
    public function activarUsuario($lenguaje, $codigo, $telefono_o_correo){
        //Listo, a lo que venimos...
        
        //Los datos recibimos los convertimos en minusculas
        $lenguaje = strtolower($lenguaje);
        $codigo = strtolower($codigo);
        $telefono_o_correo = strtolower($telefono_o_correo);
        $lenguaje_bd = new Idiomas($lenguaje);
        
        
        //Lo primero sera consultar si el correo o telefono existe y ademas, empezar a activar al usuario
        
        //Empezamos primero por el..., mejor comprobamos los dos de una vez...
        $sql_consultar_usuario_pre = "SELECT * FROM preusuario WHERE telefono ='$telefono_o_correo' OR telefono_con_codigo = '$telefono_o_correo' OR correo = '$telefono_o_correo';";
        
        //Ejecutamos la sentencia anterior:
        $resultado_activacion = mysql_query($sql_consultar_usuario_pre)or die ("No pudo consultar el dato recibido en la tabla preusuario: " . mysql_error());
        
        //Comprobamos si la consulta arrojo algun resultado                
        if(mysql_num_rows($resultado_activacion) > 0){
            //echo "Entro aqui en la clase activacion, en el metodo 1";
            //La consulta si arrojo resultados, procedemos a sacarlos
            $datos_preusuario = mysql_fetch_assoc($resultado_activacion);
            $pre_correo = $datos_preusuario["correo"];
            $pre_telefono = $datos_preusuario["telefono"];
            $pre_tele_con_codigo = $datos_preusuario["telefono_con_codigo"];
            $pre_codigo = $datos_preusuario["codigo_activacion"];
            $pre_id_pais = $datos_preusuario["id_pais"];
            $pre_pass = $datos_preusuario["pass"];
            $pre_id = $datos_preusuario["id"];
            $pre_estado = $datos_preusuario["estado"];
            $dato_de_acceso_usuario = "";
            
            
            if($pre_estado == 0 || $pre_estado == "0"){
                //Variables nuevas
                $valido_telefono = 0;
                $valido_correo = 0;
                
                //Esta variable indicara que forma uso el usuario para activar
                $forma_usada_para_activar = 0;
                
                
                if(strcmp($pre_correo, "")== 0 ){
                    //Como esta vacia la variable correo, la forma usada para activar fue el telefono
                    $forma_usada_para_activar = 2;
                    $dato_de_acceso_usuario = $pre_telefono;
                    $valido_telefono = 1;
                    
                }else{
                    $valido_correo = 1;
                    $dato_de_acceso_usuario = $pre_correo;
                }
                
                //Comprobamos el codigo para saber si es igual
                if(strcmp($codigo, $pre_codigo) == 0){
                    //El codigo fue correcto y empezamos a crear el usuario
                    
                    
                    //Bien, lo primero es actualizar los datos del preusuario. para eso...
                    $fecha = date("Y-m-d");
                    $hora = date("H:i:s");
                    $fecha_y_hora_activacion = date("Y-m-d H:i:s");
                    
                    //Creamos la consulta
                    $sql_actualizar_pre_usuario = "UPDATE preusuario SET estado = 1, hora_fecha_activacion = '$fecha_y_hora_activacion' WHERE id = $pre_id;";
                    
                    //Ejecutamos la consulta actualizadora
                    mysql_query($sql_actualizar_pre_usuario) or die ("No se actualizo al preusuario: " . mysql_error());
                    
                    
                    //Ahora procedemos a registrar el nuevo usuario
                    
                    //Preparamos la sentecia
                    $sql_registrar_nueva_persona = "INSERT INTO persona"
                        ."(correo, telefono, pais, pais_nombre, telefono_con_codigo, contrasenia, codigo, hora_registro, fecha_registro, estado, estado_correo, estado_telefono)"
                        ."VALUES"
                        ."('$pre_correo', '$pre_telefono', $pre_id_pais, (SELECT nombre FROM pais WHERE id_pais = $pre_id_pais),  '$pre_tele_con_codigo', '$pre_pass', '$pre_codigo', '$hora', '$fecha', 1, $valido_correo, $valido_telefono);";
                        
                    
                    //Ejecutamos la consulta anterior
                    $resultado_crear_persona = mysql_query($sql_registrar_nueva_persona) or die ("No se pudo registrar la persona: " . mysql_error());
                    
                    if($resultado_crear_persona == true){
                        echo darCodigoDeAlerta1() . $lenguaje_bd->reg_act_cod_correcto. darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
                        
                        //lLAMAMOS A ESTA FUNCION PARA QUE CONSULTE EL ID DEL USUARIO RECIEN CREADO
                        $this->ID = $this->darIdUsuario($dato_de_acceso_usuario);
                        $_SESSION["ID"] = $this->ID;
                        //Redireccionarlo aqui
                        echo "<script>";
                        //Guardar los datos del usuario en la memoria interna...
                        //Guardamos el dato de acceso
                        echo "localStorage.setItem('dus', '".$dato_de_acceso_usuario ."');";
                        //La contraseña
                        echo "localStorage.setItem('cus', '".$pre_pass ."');";
                        //Guardamos el indicador de inicio de sesion
                        echo "localStorage.setItem('sav', '1');";
                        //Primera vez
                        echo "localStorage.setItem('pri', '1');";
                        echo "location.href = 'chat/';";
                        echo "</script>";
                        
                        //Bien ahora procedemos a insertarlo en los usuarios en linea
                        $this->InsertarEnlinea($this->ID);
                        $this->InsertarConfiguracion($this->ID, $pre_id_pais);

                        
                        
                    }else{
                        echo darCodigoDeAlerta1(). $lenguaje_bd->reg_act_error . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
                    }    
                    
                    
                }else{
                    echo darCodigoDeAlerta1() . $lenguaje_bd->reg_act_cod_malo . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
                }
            
            
            }else{
                echo darCodigoDeAlerta1() . $lenguaje_bd->reg_act_cue_ya_activada . darCodigoDeAlertaAceptar() . darCodigoDeAlerta2();
            }            
            
        }else{
            echo darCodigoDeAlerta1() . $lenguaje_bd->reg_act_cor_tel_no_existe. darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
        }
        
    }//Fin de la funcion activar usuario
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function verificarDatoDeActivacion($lenguaje, $telefono_o_correo){
        //Listo, a lo que venimos...
        $lenguaje_bd = new Idiomas(strtolower($lenguaje)); 
        
        //Empezamos comprobamos los dos de una vez...
        $sql_consultar_pre_registro = "SELECT * FROM preusuario WHERE telefono ='$telefono_o_correo' OR telefono_con_codigo = '$telefono_o_correo' OR correo = '$telefono_o_correo';";
        
        //Ejecutamos la sentencia anterior:
        $resultado_verificar_existencia_preusuario = mysql_query($sql_consultar_pre_registro)or die ("No pudo consultar el dato para seguir con la activacion en la tabla preusuario: " . mysql_error());
        
        //Comprobamos si la consulta arrojo algun resultado                
        if(mysql_num_rows($resultado_verificar_existencia_preusuario) > 0){
            //echo "Entro aqui en la clase activacion, en el metodo 1";
            //La consulta si arrojo resultados, procedemos a sacarlos
            $datos_preusuario = mysql_fetch_assoc($resultado_verificar_existencia_preusuario);
            $pre_correo = $datos_preusuario["correo"];
            $pre_telefono = $datos_preusuario["telefono"];
            $pre_tele_con_codigo = $datos_preusuario["telefono_con_codigo"];
            $pre_codigo = $datos_preusuario["codigo_activacion"];
            $pre_dato = "";
            $pre_dato_forma = "";
            
            //Verificamos para saber que dato uso el usuario para pre registrarse 
            if($pre_correo == ""){
                if($pre_telefono == ""){
                    $pre_dato = $pre_tele_con_codigo;
                    $pre_dato_forma = "teléfono";
                }else{
                    $pre_dato = $pre_correo;
                    $pre_dato_forma = "teléfono";
                }
            }else{
                $pre_dato = $pre_correo;
                $pre_dato_forma = "correo";
            }
            
            //echo "Puede segruir";
            //Ahora, mandamops al ususario a la siguiente pantalla
            echo "<script>";
            echo    "$('#activacion2').fadeOut(1000, function(){";
            echo        "$('#activacion1').fadeIn(1000);";
            echo        "$('#activacion_info_2_1').append('" . $lenguaje_bd->IdiomaCorreoTelefono($pre_dato_forma) . ": ". $telefono_o_correo ."');";
            echo        "$('#dato_usuario_para_activacion').val('" . $telefono_o_correo ."');";
            echo    "});";
            echo "</script>";
            
            
        }else{
            echo darCodigoDeAlerta1() . $lenguaje_bd->reg_act_cor_tel_no_existe . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
        }
        
    }//Fin de la funcion verificar el dato de activacion 
    
    
    
    public function darIdUsuario($usu){
        
        $sql_traerId = "SELECT id from persona WHERE correo = '$usu' OR telefono = '$usu'";
        
        $res = mysql_query($sql_traerId) or die ("No pudo traer el id: " . mysql_error());
        
        $datos = mysql_fetch_assoc($res);
        
        return $datos["id"];
    }
    
    /**
    * Esta funcion es para ingresar en la tabla usuario a una nueva persona registrada en el sistema
    */
    public function InsertarEnlinea($id_persona){
        $sql_insertar_enlinea = "INSERT enlinea (id_persona, estado) VALUES ('$id_persona', 1);";
        $res = mysql_query($sql_insertar_enlinea) or die ("No pudo insertar el usuario en linea: " . mysql_error());
    }
    
    /**
     * Esta funcion es para registrar las configuraciones del usuario
     */
    public function InsertarConfiguracion($id_persona, $id_pais){
        $sql_insertar_configuracion = "INSERT configuraciones (id_persona, lenguaje) VALUES ('$id_persona', (SELECT lenguaje_pais FROM pais WHERE id_pais = $id_pais));";
        $res = mysql_query($sql_insertar_configuracion) or die ("No pudo insertar el usuario en configuracion: " . mysql_error());
    }

}
?>