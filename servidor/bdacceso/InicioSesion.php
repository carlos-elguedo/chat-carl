<?php

session_start();

include ("conexion/conexion.php");
require_once '../funciones/Idiomas.php';
include ("funcionesbd.php");
include ("Utilidadesbd.php");

//$conexion = $mlconexion;

class InicioSesion{
    var $usuario;
    //var $selector;
    var $ID;
    
    
    public function __construct($datos) {
        $this->usuario = $datos;
        //$this->selector = new Selector();
        
    }//Fin del constructor
    
    
    /**
     * Esta funcion es la principal de esta clase e iniciara la sesion del usuario recibido recibido en su constructor
     */
     public function iniciarSesion(){
        
        //Tomamos esta variable para el control y funcionamiento de la uncion
        $estado_inicio_sesion = 0;
        /* 0->nada
         * 1->correcto
         * 2->contraseña incorrecta
         * 3->dato de acceso no existe
         * 4->Esta en los Preusuarios
         * 
         */
        //Esta variable indica de que forma accedio el usuario, si por correo o por telefono
        $tipo_acceso = 0;
        
        //Esta variable indicara si el usuario se encuentra registrado
        $usuario_registrado = false;

        //Tomamos las variables recibidas desde el usuario
        $usuario_dato_acceso   = $this->usuario["a"];
        $usuario_contra_acceso   = $this->usuario["c"];
        $usuario_lenguaje_acceso   = $this->usuario["l"];
        
        //Dato usado para el inicio de sesion
        $acceso = "";
        
        //Definimos el objeto lenguaje
        $lenguaje_db = new Idiomas($usuario_lenguaje_acceso);
                

        //Creamos las consultas para obtener la forma de acceso
        $sql_correo = "SELECT contrasenia, id_usuario, id_persona FROM usuario WHERE correo ='$usuario_dato_acceso';";//sentencia de la consulta
        $sql_telefono = "SELECT contrasenia, id_usuario, id_persona FROM usuario WHERE telefono ='$usuario_dato_acceso' OR telefono_con_codigo = '$usuario_dato_acceso'";
        
        //Primero comprobamos para el correo
        //Ejecutamnos la consulata y comprobamos que haya sido exitosa
        $resultado_buscar_usuario_correo =  mysql_query($sql_correo) or die ("No pudo buscar el correo en la tabla usuario: " . mysql_error());
        
        //Si el numero de filas es mayor a 0, quiere decir que si existe en la tabla usuario un correo como el recibido
        if (mysql_num_rows($resultado_buscar_usuario_correo) > 0){
            //Indicamos que el ipo de acceso fue el correo
            $tipo_acceso = 1;                
            
            //obtnrmos los datos de la consulta y los almacenamos en esta variable
            $datos = mysql_fetch_assoc($resultado_buscar_usuario_correo);
            //separamos los datos de la consulta
            $usuPass = $datos["contrasenia"];
            $usuID = $datos["id_usuario"];
            $this->ID = $datos["id_persona"];
                
            //Cambiomos el valor de esta variable para indicar que el usuario si esta registrado
            $usuario_registrado = true;
                
            //Desencriptamos la contraseña sacada para comprobarla con la recibida desde el usuario
            $contra = desencriptarContraParaBaseDatos($usuPass);
                
            //Ahora compramos que las contraseñas sean iguales
            if(strcmp($usuario_contra_acceso, $contra) == 0){
                //Puede acceder con su correo
                $estado_inicio_sesion = 1;
                
            }else{
            //contraseña incorrecta
            $estado_inicio_sesion = 2;
            }
        }else{
            //si ese correo no existe como correo en la tabla usuarios
        }
        
        
        
        //Después comprobamos para el telefono
        if($tipo_acceso == 0){
        //Ejecutamnos la consulata y comprobamos que haya sido exitosa
        $resultado_buscar_usuario_telefono = mysql_query($sql_telefono) or die ("No pudo buscar al usuario por su telefono: " . mysql_error());
        
        //Si el numero de filas es mayor a 0, quiere decir que si existe en la tabla usuario un telefono como el recibido
        if (mysql_num_rows($resultado_buscar_usuario_telefono) > 0){
            //Indicamos que el ipo de acceso fue el telefono
            $tipo_acceso = 2;
                
            //obtnrmos los datos de la consulta y los almacenamos en esta variable
            $datos = mysql_fetch_assoc($resultado_buscar_usuario_telefono);
            //separamos los datos de la consulta
            $usuPass = $datos["contrasenia"];
            $usuID = $datos["id_usuario"];
            $this->ID = $datos["id_persona"];
                
            //Cambiomos el valor de esta variable para indicar que el usuario si esta registrado
            $usuario_registrado = 1;
                
                
            //Desencriptamos la contraseña sacada para comprobarla con la recibida desde el usuario
            $contra = desencriptarContraParaBaseDatos($usuPass);
                
            //Ahora compramos que las contraseñas sean iguales
            if(strcmp($usuario_contra_acceso, $contra) == 0){
                //Puede acceder con su telefono
                $estado_inicio_sesion = 1;
            }else{
                //contraseña incorrecta
                $estado_inicio_sesion = 2;
            }
        }else{
            //si ese telefono no existe como tal en la tabla usuarios
        }
    }//Fin de la comprobacion ed que no entro en el correo
        
        //Ahora hacemos esta comprobacion para saber si el usuario trato de ingresar pero no estaba registrado en la tabla}
        //usuario sino en la preusuario
        if($usuario_registrado == false){
            //Esta consulta verificara si el usuario esta en la tabla preusuarios
            $sql_veriica_preusuario = "SELECT * FROM preusuario WHERE correo = '$usuario_dato_acceso' OR telefono = '$usuario_dato_acceso' OR telefono_con_codigo = '$usuario_dato_acceso'";
            
            //Ejecutamos la anterior consulta
            $resultado_saber_esta_preregistrado = mysql_query($sql_veriica_preusuario) or die ("No puedo verificar en preusuario: ". mysql_error());
            
            //Preguntamos si la consulta trajo algunas filas
            if (mysql_num_rows($resultado_saber_esta_preregistrado) > 0){
                //Si entra aqui quiere decir que esa cuenta esta preregistrada aunque no aparexca en los usuarios
                $estado_inicio_sesion = 3;
            }else{
                //Estos datos no aparecen en ninguna parte, no se ha preregistrado, o no ha confirmado ese correo o telefono en su perdil
                $estado_inicio_sesion = 4;
            }
            
            
        }
        
        switch ($estado_inicio_sesion){
            
            //Antes de imprimir se debe manejar el IDIOMA
            
            case 0:
                //No ingreso a ninguna parte no se cambio el valor de esta varibale
                echo darCodigoDeAlerta1() . $lenguaje_db->ini_alg_sal_mal . darCodigoDeAlerta2();
                break;
            case 1:
                //Fue exitoso el inicio de sesion y puede ingresar al sistema
                //echo darCodigoDeAlerta1() . $lenguaje_db->ini_adelante. darCodigoDeAlerta2();
                //Redireccionamos a la pagina principal de la aplicacion
                $_SESSION["ID"] = $this->ID;
                echo "<script>";
                //Guardar los datos del usuario en la memoria interna...
                //Guardamos el dato de acceso
                echo "localStorage.setItem('dus', '".$usuario_dato_acceso ."');";
                //La contraseña
                echo "localStorage.setItem('cus', '".$usuario_contra_acceso ."');";
                //Guardamos el indicador de inicio de sesion
                echo "localStorage.setItem('sav', '1');";
                echo "location.href = 'chat/';";
                echo "</script>";
                
                //Bien, ahora lo añadimos o cambiemos su estado en la tabla de los que estan enlinea
                $this->enlinea($this->ID, 1);
                break;
            case 2:
                //La contraseña del usuario es incorrecta
                echo darCodigoDeAlerta1() . $lenguaje_db->ini_cont_incorrecta. darCodigoDeAlertaAceptar_permanecer(). darCodigoDeAlerta2();
                break;
            case 3:
                //Esta preregistrado, no ha activado la cuenta
                echo darCodigoDeAlerta1() . $lenguaje_db->ini_no_act_cuenta. darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
                break;
            case 4:
                //Ese dato con el que quizo acceder no esta en nuestra base de datos
                echo darCodigoDeAlerta1() . $lenguaje_db->ini_cor_tel_no_existe. darCodigoDeAlertaAceptar_permanecer(). darCodigoDeAlerta2();// if($tipo_acceso == 1){echo "Correo ";}else{echo "Telefono";}
                break;
            default :
                echo darCodigoDeAlerta1() . $lenguaje_db->ini_alg_sal_mal. darCodigoDeAlerta2();
                break;
                
        }
        
        
    }//Fin de la funcion principal inicio de sesion
     
     
    
    /**
    * Esta funciuon es para actualizar el estado de conexion de un usuario
    */
    public function enlinea($id_persona, $estado){
        $sql_actualizar_enlinea = "UPDATE enlinea SET estado = '$estado' WHERE id_persona = '$id_persona'";
        $res = mysql_query($sql_actualizar_enlinea) or die ("No se actualizo el estado de la conexion: " . mysql_error());
    }
    
    
    
}//Fin de la clase

?>