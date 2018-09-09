<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once 'Selector.php';
include ("conexion/conexion.php");
require_once '../funciones/Idiomas.php';
include ("funcionesbd.php");
include ("Utilidadesbd.php");
include ("EnviadorCodigo.php");


//$conexion = $mlconexion;

class Registro{
    var $usuarioNuevo;
    //var $selector;
    
    
    public function __construct($datos) {
        $this->usuarioNuevo = $datos;
        //$this->selector = new Selector();
        
    }//Fin del constructor
    
    

    /**
     * Esta funcion es la principal de esta clase, registrara un usuario, tiene acciones privilegiadas como de consulta 
     * actualizar y insertar en la base de datos
     */
    public function registrarUsuario(){
        
        //Esta variable es la que indica el estado del registro del nuevo usuario
        $registroExitoso = false;
        $puede_registrarse_con_su_forma_registro_escogida = false;
        $no_puede_con_correo = false;
        $no_puede_con_telefono = false;
        
        //Empezamos sacando los datos recibidos...
        $usuario_nuevo_correo   = $this->usuarioNuevo["c"];
        $usuario_nuevo_telefono = $this->usuarioNuevo["t"];
        $usuario_nuevo_pais = $this->usuarioNuevo["p"];
        $usuario_nuevo_contra = $this->usuarioNuevo["ps"];
        $usuario_nuevo_lenguaje = $this->usuarioNuevo["l"];
        $usuario_nuevo_forma_registro = $this->usuarioNuevo["r"];
        $lenguaje_bd = new Idiomas($usuario_nuevo_lenguaje);
        
        //Cambiamos los datos si son fake a vacios
        //Para el correo...
        if($usuario_nuevo_correo == "fake@fake.com" ){
            $usuario_nuevo_correo = "";
        }
        //Para el telefono
        if($usuario_nuevo_telefono == "1112222333" || $usuario_nuevo_telefono == 1112222333){
            $usuario_nuevo_telefono = "";
        }
        
        
        //Lo primero es comprobar que estos datos ya no esten registrados
        

        //Comprobamos si la forma es correo...
        if($usuario_nuevo_forma_registro == "1" || $usuario_nuevo_forma_registro == 1){
            //Si no existe el correo recibido en la base de datos procedemos a seguir
            if($this->existeCorreoRegistrado($usuario_nuevo_correo) == false){
                //Si entra aqui es porque su correo esta disponible
                $puede_registrarse_con_su_forma_registro_escogida = true;
            } else {
                $puede_registrarse_con_su_forma_registro_escogida = false;
                $no_puede_con_correo = true;
            }
        }//Fin de la comprobacion para saber si escogio correo
        
        
        
        //Comprobamos si la forma es telefono...
        if($usuario_nuevo_forma_registro == "2" || $usuario_nuevo_forma_registro == 2){
            //Si no existe el telefono recibido en la base de datos procedemos a seguir
            if($this->existeTelefonoRegistrado($usuario_nuevo_telefono) == false){
                //Si entra aqui es porque su telefono esta disponible
                $puede_registrarse_con_su_forma_registro_escogida = true;
            } else {
                $puede_registrarse_con_su_forma_registro_escogida = false;
                $no_puede_con_telefono = true;
            }
        }//Fin de la comprobacion para saber si escogio telefono
        
        
        
        //Ya tenemos su forma de registro, ahora procedemos con el registro
        if($puede_registrarse_con_su_forma_registro_escogida == true){
            //Empecemos...
            
            //variabes que contiene codigo dinamico
            $sql_donde = "";
            $sql_dato_de_registro = "";
            $forma_de_activacion = 0;
            
            
            //Sacamos la forma en que se registro para asignar la consulta
            if($usuario_nuevo_forma_registro == "1" || $usuario_nuevo_forma_registro == 1){
                $sql_donde = "correo";
                $sql_dato_de_registro = $usuario_nuevo_correo;
                $forma_de_activacion = 1;
            }else{
                $sql_donde = "telefono";
                $sql_dato_de_registro = $usuario_nuevo_telefono;
                $forma_de_activacion = 2;
            }
            
            //Esta consulta verificara si el usuario habia a registrar habia hecho el proceso antes, o alguien uso su correo
            $sql_verifica_pre_usuario = "SELECT * FROM preusuario WHERE " . $sql_donde . "= '$sql_dato_de_registro'";
            
            //Ejecutamos la consulta anterior
            $resultado_pre_usuario = mysql_query($sql_verifica_pre_usuario) or die ("No pudo verificar al preusuario -> " . mysql_error());
            if (mysql_num_rows($resultado_pre_usuario) > 0){
                
                //Pero antes debemos comprobar que esta cuenta no este activada aun
                $datos_preusuario_nuevamente = mysql_fetch_assoc($resultado_pre_usuario);
                //Obtenemos el id para actualizarlo
                $id_preusuario = $datos_preusuario_nuevamente["id"];
                $estado_pre_usuario = $datos_preusuario_nuevamente["estado"];
                                
                //Verificamos si esta activo, aunque si entro aqui odviamente tiene que estar sin activar
                
                //Para evitar multiples registros iguales, vamos a sobreescribir los datos que se enviaronnuevamente
                
                //Obtenemos los datos nuevamente
                $fecha = date("Y-m-d");
                $hora = date("H:i:s");
                $fecha_y_hora = date("Y-m-d H:i:s");
                
                
                
                //Llamamos a esta funcion que genera el codigo de activacion para este usuario
                $codigo_activacion = generarCodigoActivacion();
                $telefono_solo = $usuario_nuevo_telefono;
                $telefono_con_codigo = "";
                //Codigo del pais para la base de datos
                $pais_codigo = darCodigoPais($usuario_nuevo_pais);
                //Codigo telefonico del pais del usuario
                
                //Ahora manipulamos el telefono paa guardarlo en la base de datos
                if($forma_de_activacion == 2){
                    $telefono_solo = procesarNumeroTelefono($telefono_solo);
                    $telefono_con_codigo = $pais_cod_telefonico . $telefono_solo;
                }else{
                    $telefono_solo = "";
                }

                
                //Encriptamos la contrase�a para guardarla en la base de datos
                $pass_encrip = encriptarContraParaBaseDatos($usuario_nuevo_contra);
                
                //Enviamos el codigo de activacion a la forma de acceso especificada
                //Aqui falta a quien se lo mandara
                enviarCodigoDeActivacion($forma_de_activacion, $codigo_activacion);
                
                //La sentencia para ingresar en la tabla preusuario            
                $sql_actualizar_usuario_pre = "UPDATE preusuario"
                        . " SET  telefono = '$telefono_solo', id_pais = $pais_codigo, pass = '$pass_encrip', hora = '$hora', fecha = '$fecha', hora_fecha = '$fecha_y_hora', estado = 0, telefono_con_codigo = '$telefono_con_codigo', codigo_activacion = '$codigo_activacion', forma_activacion = $forma_de_activacion WHERE id = $id_preusuario;";
                

                
                //Ejecutamos la consulta
                $resultadoActualizarPreUsuario = mysql_query( $sql_actualizar_usuario_pre ) or die("No se registro en la tablas pre Usuario: ".mysql_error());
    
                if($resultadoActualizarPreUsuario == true){
                    //Antes de imprimir el texto, se debe llamar a una funcion para que devuelva el texto a imprimir, a esta funcion se le pasaria el lengiuaje aqui manejado
                    //Texto de informacion
                    
                    //Si entra aqui quiere decir que alguien ya habia preregistrado a ese usuario
                    echo darCodigoDeAlerta1() . $lenguaje_bd->reg_cod_act_reenviado . $lenguaje_bd->IdiomaCorreoTelefono($sql_donde). darCodigoDeAlertaAceptarVirgen() . darCodigoDeAlerta2();
                    
                    echo "<script>";
                    echo "$('#cancel').click(function(eve){eve.preventDefault();";
                    echo    "$('#mensajes').html('');";
                    echo    "$('#registro').fadeOut(1000, function(){";
                    echo        "$('#activacion1').fadeIn(1000);";
                    echo        "$('#activacion_info_2_1').append('" .$lenguaje_bd->IdiomaCorreoTelefono($sql_donde) . ": ". $sql_dato_de_registro ."');";
                    echo        "$('#dato_usuario_para_activacion').val('" . $sql_dato_de_registro ."');";
                    echo    "});";
                    echo "});";
                    echo "</script>";
                    
                    
                    $registroExitoso = true;
                    
                } else {
                    echo darCodigoDeAlerta1(). $lenguaje_bd->reg_err_ins_preusuario. darCodigoDeAlertaAceptar() . darCodigoDeAlerta2();
                }
                
                
            }else{
                //Si entra aqui, el usuario puede preregistrarse correctamente
                //Generamos los datos que se guardaran en la base de datos
                $fecha = date("Y-m-d");
                $hora = date("H:i:s");
                $fecha_y_hora = date("Y-m-d H:i:s");
                //Llamamos a esta funcion que genera el codigo de activacion para este usuario
                $codigo_activacion = generarCodigoActivacion();
                $telefono_solo = $usuario_nuevo_telefono;
                $telefono_con_codigo = "";
                //Codigo del pais para la base de datos
                $pais_codigo = darCodigoPais($usuario_nuevo_pais);
                //Codigo telefonico del pais del usuario
                $pais_cod_telefonico = darCodigoTelefonicoPais($usuario_nuevo_pais);
                
                //Ahora manipulamos el telefono paa guardarlo en la base de datos
                if($forma_de_activacion == 2){
                    $telefono_solo = procesarNumeroTelefono($telefono_solo);
                    $telefono_con_codigo = $pais_cod_telefonico . $telefono_solo;
                }else{
                    $telefono_solo = "";
                }
                
                //Encriptamos la contrase�a para guardarla en la base de datos
                $pass_encrip = encriptarContraParaBaseDatos($usuario_nuevo_contra);
                
                //Enviamos el codigo de activacion a la forma de acceso especificada
                enviarCodigoDeActivacion($forma_de_activacion, $codigo_activacion);
                
                //La sentencia para ingresar en la tabla preusuario            
                $sql_insertar_usuario_pre = "INSERT INTO preusuario"
                        . " (correo, telefono, id_pais, pass, hora, fecha, hora_fecha, estado, telefono_con_codigo, codigo_activacion, forma_Activacion)"
                        . " VALUES"
                        . " ('$usuario_nuevo_correo', '$telefono_solo', $pais_codigo, '$pass_encrip', '$hora', '$fecha', '$fecha_y_hora', 0, '$telefono_con_codigo', '$codigo_activacion', $forma_de_activacion)";
                
                /**
                 * Aqui se debe controlar como se almacenara la activacion, si mediante este script o de otra manera
                 */
                
                //Ejecutamos la consulta
                $resultadoInsertarPreUsuario = mysql_query( $sql_insertar_usuario_pre ) or die("No se registro en la tablas pre Usuario: ".mysql_error());
    
                if($resultadoInsertarPreUsuario == true){
                    //Antes de imprimir el texto, se debe llamar a una funcion para que devuelva el texto a imprimir, a esta funcion se le pasaria el lengiuaje aqui manejado
                    //Texto de informacion
                    
                    echo "<script>";
                    echo    "$('#registro').fadeOut(1000, function(){";
                    echo        "$('#activacion1').fadeIn(1000);";
                    echo        "$('#activacion_info_2_1').append('" .$lenguaje_bd->IdiomaCorreoTelefono($sql_donde) . ": ". $sql_dato_de_registro ."');";
                    echo        "$('#dato_usuario_para_activacion').val('" . $sql_dato_de_registro ."');";
                    echo    "});";
                    echo "</script>";
                    
                    
                    $registroExitoso = true;
                } else {
                    echo darCodigoDeAlerta1(). $lenguaje_bd->reg_err_ins_preusuario. darCodigoDeAlertaAceptar() . darCodigoDeAlerta2();
                }
            }
            
            
            
     
            
            
            
            
            
        } else {
            if($no_puede_con_correo == true){
                //No se puede registrar con el correo recibido
                echo darCodigoDeAlerta1() . $lenguaje_bd->reg_cor_existe. darCodigoDeAlertaAceptar(). darCodigoDeAlerta2();
            }
            if($no_puede_con_telefono == true){
                //No se puede registrar con el correo recibido
                echo darCodigoDeAlerta1() . $lenguaje_bd->reg_tel_existe. darCodigoDeAlertaAceptar(). darCodigoDeAlerta2();
            }
            $registroExitoso = false;
            //echo "No se registro";
        }
        
        
        
        
    }//Fin de la funcion registrar usuario
    
    
    
    
    
    
    
    /**
     * Funcion para saber si en la base de datos existe un usuario con el correo dado, esto para evitar muchas cosas
     * Es muy importante y se llama en cada registro
     * @param type $correo_a_verificar El correo a verificar
     * @return boolean el estado del la consulta, si es true puede registrarse, de lo contrario no
     */
    
    public function existeCorreoRegistrado($correo_a_verificar) {
        $retorno = false;
        $sql = "SELECT * FROM `usuario` WHERE correo = '$correo_a_verificar'";

        $yaEsta = mysql_query($sql) or die("No se pudo ejecutar la consulta para saber si existe el correo en la tabla usuario: " . mysql_error());

        if (mysql_num_rows($yaEsta) > 0){//obtenemos el array de la consulta
        	$retorno = true;
        }else{//si no esta ya el correo en bd
            $retorno = false;
        }

        return $retorno;
    }
    
    public function existeTelefonoRegistrado($telefono_a_verificar) {
        $retorno = false;
        $sql = "SELECT * FROM `usuario` WHERE telefono = '$telefono_a_verificar'";

        $yaEsta = mysql_query($sql) or die("No se pudo ejecutar la consulta para saber si existe el telefono en la tabla usuario: " . mysql_error());

        if (mysql_num_rows($yaEsta) > 0){//obtenemos el array de la consulta
            $retorno = true;
        }else{//si no esta ya el correo en bd
            $retorno = false;
        }

        return $retorno;
    }
    
    
}//Fin de la clase

?>