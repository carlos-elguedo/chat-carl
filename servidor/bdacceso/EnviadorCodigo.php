<?php



/**
 * Esta funcion mandara al usuario su codigo de activacion
 * Recibe la forma en que se lo mandara, por correo o telefono
 * Recibe el codigo a enviar
 */
function enviarCodigoDeActivacion($forma_activacion, $codigo){
    //Aqui va el codigo para el envio del codigo de activacion
    
    switch($forma_activacion){
        
        case 1:
        //Codigo para enviar correo electronico        
        break;        
        case 2:
        //Codigo para enviar mensaje de texto
        break;        
        default:
        //Hubo algun error
        break;
    } 
}

/**
 * Esta funcion verificarara si el codigo de activacion es correcto y devolvera true si es correcto el codigo
 */
function codigoCorrecto(){
    
}



?>