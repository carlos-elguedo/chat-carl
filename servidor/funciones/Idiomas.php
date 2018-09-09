<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Idiomas{
    
    var $idioma;
    //Aceptar y cancelar
    var $aceptar;
    var $cancelar;
    
    //Escribiendo
    var $escribiendo;
    
    //Rutas del servidor
    var $ruta_servidor;
    var $ruta_servidor_perfil;
    
    //Registro
    var $reg_no_pas_inyecctiones;
    var $reg_idi_sup_talla;
    var $reg_pais_no_tex_cor_sup_talla;
    var $reg_ult_comprobaciones;
    var $reg_opc_esc_no_existe;
    //...
    var $reg_cor_existe;
    var $reg_tel_existe;
    var $reg_cod_act_reenviado;
    var $reg_err_ins_preusuario;
    var $reg_no_pro_peticion;
    var $reg_cod_tal_incorrecto;
    var $reg_idi_cor_tel_sup_talla;
    //...
    var $reg_act_cod_correcto;
    var $reg_act_error;
    var $reg_act_cod_malo;
    var $reg_act_cue_ya_activada;
    var $reg_act_cor_tel_no_existe;
    
    //Inicio de sesion
    var $ini_cont_sup_talla;
    var $ini_corr_o_tele_sup_talla;
    var $ini_alg_sal_mal;
    var $ini_adelante;
    var $ini_cont_incorrecta;
    var $ini_no_act_cuenta;
    var $ini_cor_tel_no_existe;
    
    //Edicion de datos personales
    var $edi_nom_correctamente;
    
    //solicitudes
    var $sol_mismo_usuario;
    var $sol_no_tiene;
    var $sol_correcta;
    var $sol_error;
    var $sol_ya_enviada;
    var $sol_otro_ya_envio;
    var $sol_no_existe_ese_usuario;
    var $sol_has_enviado_solicitud;
    var $sol_has_recibido_solicitud;
    var $sol_est_aun_no_responde_recibida;
    var $sol_est_si_acepta_mylove;
    var $sol_est_si_acepta_friendZone;
    var $sol_est_marcado_mylove;
    var $sol_est_marcado_friendzone;
    var $sol_est_acepto_mylove;
    var $sol_est_acepto_frienzone;
    var $sol_est_no_acepto;
    var $sol_est_no_acepto_bloqueo;
    var $sol_est_rechazada;
    var $sol_est_rechazada_bloqueo;
    var $sol_est_finalizada;
    var $sol_est_error;
    
    //Mensajes...
    var $men_primer_mensaje;
    var $men_justo_ahora;
    var $men_no_tiene_bandeja;
    var $men_tu;
    
    
    
    
    /**
     * Este sera el contructor de la clase idioma
     * @param type $idioma_recibido recibe el idioma recibido desde el usuario
     */
    public function __construct($idioma_recibido = 'en') {
        $this->idioma = $idioma_recibido;
        $this->llenar_propiedades_texto();
    }
    /**
     * El segundo constructor para cuando aun no se ha comrpobado el idioma del usuario
     */
    public function __construct2() {
        $this->idioma = 'en';
        $this->llenar_propiedades_texto();
    }
    
    
    
    /**
     * Esta funcion instancia las propiedades de la clase con su respectivo valo en el idioma recibido
     */
    public function llenar_propiedades_texto(){
        
        //Llenamos las variables noermales:
        $this->ruta_servidor = "http://localhost/mylove/servidor/";
        $this->ruta_servidor_perfil = "http://localhost/mylove/servidor/archivos/imagenesPerfil/";
        
        //Hacemos un switch para saber que idioma es y asi inicializar las varables de la clase
        switch ($this->idioma){
            //Caso de español
            case 'es':
            
                $this->aceptar = "Aceptar";
                $this->cancelar = "Cancelar";
                
                $this->escribiendo = "Esta escribiendo...";
                
                $this->reg_no_pas_inyecctiones = "No paso las comprobaciones de inyecciones";
                $this->reg_idi_sup_talla= "El lenguaje recibido supera la talla permitida";
                $this->reg_pais_no_tex_cor_sup_talla = "Comprobacion de que el pais sea texto y el correo tiene la talla correcta no paso";
                $this->reg_ult_comprobaciones = "Ultimas comprobaciones no paso";
                $this->reg_opc_esc_no_existe = "La opcion escogida como registro no corresponde a ninguna disponible";
                $this->reg_cor_existe = "Ese correo ya esta registrado";
                $this->reg_tel_existe = "Ese telefono ya esta registrado";
                $this->reg_cod_act_reenviado = "Hemos vuelto a enviar un codigo de activacion a este ";
                $this->reg_err_ins_preusuario = "Ha ocurrido un error registrandote... :(\n Intentalo de nuevo";
                $this->reg_no_pro_peticion = "No podemos procesar tu solicitud, por favor hazla correctamente";
                $this->reg_cod_tal_incorrecto= "El codigo que recibimos no es correcto, son 5 cifras";
                $this->reg_idi_cor_tel_sup_talla= "El correo o telefono que recibimos sobrepasa la talla permitida";
                $this->reg_act_cod_correcto = "El codigo Esta correcto, has activado tu cuenta";
                $this->reg_act_error = "No se ha procesado tu solicitud, intentalo de nuevo";
                $this->reg_act_cod_malo = "El codigo ingresado es erroneo";
                $this->reg_act_cue_ya_activada = "Ya has activado la cuenta";
                $this->reg_act_cor_tel_no_existe = "El dato recibido como tu cuenta, no existe en nuestra base de datos";
                //...
                $this->ini_cont_sup_talla = "Contraseña supera la talla";
                $this->ini_corr_o_tele_sup_talla = "El correo suppera la talla";
                $this->ini_alg_sal_mal = "Ha ocurrido un error mientras inicias sesion, intentalo de nuevo";
                $this->ini_adelante = "Adelante";
                $this->ini_cont_incorrecta = "La contraseña es incorrecta";
                $this->ini_no_act_cuenta = "Aun no has activado tu cuenta, para ingresar tienes que activarla";
                $this->ini_cor_tel_no_existe = "Ese dato que ingresaste no existe en nuestros registros";
                
                //...
                $this->edi_nom_correctamente = "Se ha actualizado tu nombre";
                
                //...
                $this->sol_mismo_usuario = "No te puedes enviar una solicitud a ti mismo...";
                $this->sol_no_tiene = "Aun no tienes solicitudes";
                $this->sol_correcta = "Se ha enviado la solicitud";
                $this->sol_error = "Error enviado la solicitud";
                $this->sol_ya_enviada = "Ya le has enviado una solicitud a ";
                $this->sol_otro_ya_envio = " ya te envio una solicitud";
                $this->sol_no_existe_ese_usuario = "No existe ese usuario";
                $this->sol_has_enviado_solicitud = "Has enviado una solicitud a ";
                $this->sol_has_recibido_solicitud = " te ha enviado una solicitud";
                $this->sol_est_si_acepta_mylove = "Si acepta, es MyLove";
                $this->sol_est_si_acepta_friendZone = "Si acepta, enviarlo a la friendZone";
                $this->sol_est_si_marcado_mylove = "Marcaste como tu Love";
                $this->sol_est_si_marcado_friendZone = "Marastes en la friendZone";
                $this->sol_est_acepto_mylove = "Aceptado como MyLove";
                $this->sol_est_acepto_frienzone = "Aceptado en la friendZone";
                $this->sol_est_no_acepto = "tu solicitud fue rechazada";
                $this->sol_est_no_acepto_bloqueo = "Tu solicitud fue rechazada y bloqueada";
                $this->sol_est_rechazada = "Solicitud rechazada";
                $this->sol_est_rechazada_bloqueo = "Solicitud rechazada y bloqueada";
                $this->sol_est_finalizada = "Ambos han contestado esta solicitud";
                $this->sol_est_error = "Estado de la solicitud";
                $this->sol_est_aun_no_responde_recibida = "Aun no has respondido esta solicitud";
                
                //...
                $this->men_primer_mensaje = " y tu se han unido en MyLove";
                $this->men_justo_ahora = "Hace un momento";
                $this->men_no_tiene_bandeja = "No has establecido una relacion MyLove";
                $this->men_tu = "Tu: ";
                
                
                break;
            //Caso de ingles
            case 'en':
            
                $this->aceptar = "Done";
                $this->cancelar = "Cancel";
                
                $this->escribiendo = "is typing...";
                
                $this->reg_no_pas_inyecctiones = "Not pass checking of sql injection";
                $this->reg_idi_sup_talla= "The language received over the length permited";
                $this->reg_pais_no_tex_cor_sup_talla = "The country is wrong or email over the length";
                $this->reg_ult_comprobaciones = "Not pass last checking";
                $this->reg_opc_esc_no_existe = "The option you choosen for register is wrong";
                $this->reg_cor_existe = "The email is registerd";
                $this->reg_tel_existe = "The number phone is registerd";
                $this->reg_cod_act_reenviado = "We'll back to send a code activation to ";
                $this->reg_err_ins_preusuario = "Error while you register :(";
                $this->reg_no_pro_peticion = "we could't work your request, please do it correctly";
                $this->reg_cod_tal_incorrecto= "The register code exceeds allowed  ize";
                $this->reg_idi_cor_tel_sup_talla= "The email or your languaje received exceeds allowed size";
                $this->reg_act_cod_correcto = "The code is correct, you'll activate the account";
                $this->reg_act_error = "Has not been processed the  request, please check your entry";
                $this->reg_act_cod_malo = "The code is wrong";
                $this->reg_act_cue_ya_activada = "The account that you want activate, has been activated";
                $this->reg_act_cor_tel_no_existe = "The email or number phone does not exist in our database";
                //...
                $this->ini_cont_sup_talla = "The password your enter exceeds allowed size";
                $this->ini_corr_o_tele_sup_talla = "The email o number phone exceeds the allowed size";
                $this->ini_alg_sal_mal = "Sorry, something has bad, please check your entry";
                $this->ini_adelante = "Let's go";
                $this->ini_cont_incorrecta = "Wrong password";
                $this->ini_no_act_cuenta = "Your does not activate the account";
                $this->ini_cor_tel_no_existe = "The email or number phone does not exist in our database";
                
                //...
                $this->edi_nom_correctamente = "Your name has been update";
                
                //...
                $this->sol_mismo_usuario = "Your want send request to you? No no";
                $this->sol_no_tiene = "You Don't have request";
                $this->sol_correcta = "Request has been send succesfull";
                $this->sol_error = "Error send request, please check your entry";
                $this->sol_ya_enviada = "The request already exist, your has send";
                $this->sol_otro_ya_envio = "The other user send this request";
                $this->sol_no_existe_ese_usuario = "Not exist the other user";
                $this->sol_has_enviado_solicitud = "Has send the request to ";
                $this->sol_has_recibido_solicitud = " sent you a request";
                $this->sol_est_si_acepta_mylove = "";
                $this->sol_est_si_acepta_friendZone = "";
                $this->sol_est_si_marcado_mylove = "";
                $this->sol_est_si_marcado_friendZone = "";
                $this->sol_est_acepto_mylove = "";
                $this->sol_est_acepto_frienzone = "";
                $this->sol_est_no_acepto = "";
                $this->sol_est_no_acepto_bloqueo = "";
                $this->sol_est_rechazada = "";
                $this->sol_est_rechazada_bloqueo = "";
                $this->sol_est_finalizada = "";
                $this->sol_est_error = "";
                $this->sol_est_aun_no_responde_recibida = "";
                
                //...
                $this->men_primer_mensaje = " and You has been join at MyLove";
                $this->men_justo_ahora = "Just now";
                $this->men_no_tiene_bandeja = "You Don't have messages";
                $this->men_tu = "You: "; 
                
                break;
            //Caso por default se tomara el ingles
            default :
                
                $this->aceptar = "Done";
                $this->cancelar = "Cancel";
                
                $this->escribiendo = "is typing...";
                
                $this->reg_no_pas_inyecctiones = "Not pass checking of sql injection";
                $this->reg_idi_sup_talla= "The language received over the length permited";
                $this->reg_pais_no_tex_cor_sup_talla = "The country is wrong or email over the length";
                $this->reg_ult_comprobaciones = "Not pass last checking";
                $this->reg_opc_esc_no_existe = "The option you choosen for register is wrong";
                $this->reg_cor_existe = "The email is registerd default";
                $this->reg_tel_existe = "The number phone is registerd default";
                $this->reg_cod_act_reenviado = "We'll back to send a code activation to ";
                $this->reg_err_ins_preusuario = "Error while you register :(";
                $this->reg_no_pro_peticion = "we could't work your request, please do it correctly";
                $this->reg_cod_tal_incorrecto= "The register code exceeds allowed  ize";
                $this->reg_idi_cor_tel_sup_talla= "The email or your languaje received exceeds allowed size";
                $this->reg_act_cod_correcto = "The code is correct, you'll activate the account";
                $this->reg_act_error = "Has not been processed the  request, please check your entry";
                $this->reg_act_cod_malo = "The code is wrong";
                $this->reg_act_cue_ya_activada = "The account that you want activate, has been activated";
                $this->reg_act_cor_tel_no_existe = "The email or number phone does not exist in our database";
                //...
                $this->ini_cont_sup_talla = "The password your enter exceeds allowed size";
                $this->ini_corr_o_tele_sup_talla = "The email o number phone exceeds the allowed size";
                $this->ini_alg_sal_mal = "Sorry, something has bad, please check your entry";
                $this->ini_adelante = "Let's go";
                $this->ini_cont_incorrecta = "Wrong password";
                $this->ini_no_act_cuenta = "Your does not activate the account";
                $this->ini_cor_tel_no_existe = "The email or number phone does not exist in our database";
                
                //...
                $this->edi_nom_correctamente = "Your name has been update";
                
                //...
                $this->sol_mismo_usuario = "Your want send request to you? No no";
                $this->sol_no_tiene = "You Don't have request";
                $this->sol_correcta = "Request has been send succesfull";
                $this->sol_error = "Error send request, please check your entry";
                $this->sol_ya_enviada = "The request already exist, your has send";
                $this->sol_otro_ya_envio = "The other user send this request";
                $this->sol_no_existe_ese_usuario = "Not exist the other user";
                $this->sol_has_enviado_solicitud = "Has send the request to ";
                $this->sol_has_recibido_solicitud = " sent you a request";
                
                break;
        }
        
    }
    
    /**
     * Este metodo dara el texto en el idioma definido para el correo o el telefono
     */
    public function IdiomaCorreoTelefono($dato){
        $retorno = "";
        
        switch($this->idioma){
            case 'es':
                if(strcmp($dato, "correo") == 0){
                    $retorno = "correo";
                }else{
                    $retorno = "telefono";
                }
                break;
            case 'en':
                if(strcmp($dato, "correo") == 0){
                    $retorno = "email";
                }else{
                    $retorno = "number phone";
                }
                break;
            default:
                if(strcmp($dato, "correo") == 0){
                    $retorno = "email";
                }else{
                    $retorno = "number phone";
                }
                break;
        }//Fin del switch
        
        return $retorno;
    }//Fin del metodo
    
    //Getters y Setetrs
    
    
    
}

?>