<?php

require_once '../bdacceso/Activacion.php';
require_once '../funciones/tieneInyeccion.php';
require_once '../funciones/verificacionDatos.php';
require_once '../funciones/manejodatos.php';


//Obtenemos el tipo de solicitud recibida. para saber que accion realizar
$dato1 = addslashes($_POST["activacion1"]);
$dato2 = addslashes($_POST["activacion2"]);
$dato3 = addslashes($_POST["activacion3"]);
$dato4 = addslashes($_POST["activacion4"]);
    
//Volvemos a verificamos los datos enviados por el usuario
$dato1 = mysql_real_escape_string($dato1);
$dato2 = mysql_real_escape_string($dato2);
$dato3 = mysql_real_escape_string($dato3);
$dato4 = mysql_real_escape_string($dato4);
    
//Llamamos a esta funcion para saber si los datos recibidos desde el usuario son maliciosos
if(
    noTieneInyeccionSQL( $dato1 ) == true &&
    noTieneInyeccionSQL( $dato2 ) == true &&
    noTieneInyeccionSQL( $dato3 ) == true &&
    noTieneInyeccionSQL( $dato4 ) == true
    ){
        
        //echo "Entro y paso las inyecciones";
        //Asignamos la accion a realizar por este script
        $post_tipo_accion_a_realizar = $dato1;
        
        //El dato enviado desde el cliente, puede ser un correo un telefono o un codigo de activacion
        $post_dato_recibido = $dato2;
        
        //Lenguaje del usuario
        $post_lenguaje_usuario = $dato3;
        
        //el dato del usuario, telefono o correo
        $post_telefono_o_correo = $dato4;
        
        //Comprobamos si el dato recibido es correcto
        if(tieneTallaEspecifica($post_tipo_accion_a_realizar, 1) == true){
            //Comprobamos que tipo de accion es
            //Entonces comprobamos si es una acticacion con el codigo
            if($post_tipo_accion_a_realizar == "1" || $post_tipo_accion_a_realizar == 1){
                //Listo ahora verificamos que los datos sean correctos
                if(tieneTallaEspecifica($post_dato_recibido, 5)){
                    //Verificamos los datos restantes
                    if(tieneTalla($post_lenguaje_usuario, 2) && tieneTalla($post_telefono_o_correo, 25)){
                        //Listo, todos los datos correctos
                        
                        //Creamos el objeto registro para activar al usuario
                        $ObjActivacion = new Activacion();
                        
                        $ObjActivacion->activarUsuario($post_lenguaje_usuario, $post_dato_recibido, $post_telefono_o_correo);
                        
                        
                        
                        
                        
                        
                    }else{
                        echo darCodigoDeAlerta1() . $leng->reg_idi_cor_tel_sup_talla . darCodigoDeAlertaAceptar() . darCodigoDeAlerta2();
                    }
                    
                }else{
                    //El codigo recibido tiene que tener cinco cifras
                    $leng = new Idiomas();
                    echo darCodigoDeAlerta1() . $leng->reg_cod_tal_incorrecto . darCodigoDeAlertaAceptar() . darCodigoDeAlerta2();
                }
                
                
                
                
                
                
                
            }else{
                //Si es una verificacion del dato...
                if($post_tipo_accion_a_realizar == "2" || $post_tipo_accion_a_realizar == 2){
                    
                    //Vamos a comprobar si ese correo o telefono escrito por el usuario existe, para procesar la peticion de activacion
                    
                    //Creamos el objeto registro para activar al usuario
                    $ObjActivacion = new Activacion();
                    
                    $ObjActivacion->verificarDatoDeActivacion($post_lenguaje_usuario, $post_dato_recibido);
                    
                }else{
                    //Si no entro en ninguna de las dos
                    $leng = new Idiomas();
                    echo darCodigoDeAlerta1() . $leng->reg_no_pro_peticion . darCodigoDeAlertaCancelar() . darCodigoDeAlerta2();
                }
            }
            
            
        }else{
            //Se ha enviado desde el servidor un dato mayor al permitido
            $leng = new Idiomas();
            echo darCodigoDeAlerta1() . $leng->reg_no_pro_peticion . darCodigoDeAlertaCancelar() . darCodigoDeAlerta2();
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
    }else{
        $leng = new Idiomas();
        echo darCodigoDeAlerta1() . $leng->reg_no_pas_inyecctiones . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2(); 
    }
 



?>