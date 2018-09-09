<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Esta funcion es para encriptar la contraseña que sera guardada en la base de datos
 * @param type $contra
 * @return type
 */
function encriptarContraParaBaseDatos($contra){
    $retorno = "";
    
    $retorno = $contra;
    
    return $retorno;
}

/**
 * Esta funcion es para desencriptar la contraseña que sera guardada en la base de datos
 * @param type $contra
 * @return type
 */
function desencriptarContraParaBaseDatos($contra_encrip){
    $retorno = "";
    
    $retorno = $contra_encrip;
    
    return $retorno;
}


/**
 * Funcion para generar codigos de activacion
 */
function generarCodigoActivacion(){
    $retorno = "";
    
    //Array que contendra las letras del codigo de activacion
    $letras =  ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    
    //Array que contendra los numeros del codigo de activacion
    $numeros = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
    
    //Esta variable aleatorea contendra el orden y estructura del codigo
    $forma = rand(0, 4);
    
    //Ahora formamos el codigo con la forma generada aleatoreamente:
    switch($forma){
        case 0:
            $retorno = $letras[rand(0, 25)] . $letras[rand(0, 25)] . $numeros[rand(0,9)] . $numeros[rand(0,9)] . $numeros[rand(0,9)];
        break;
        case 1:
            $retorno = $letras[rand(0, 25)] . $numeros[rand(0,9)] . $letras[rand(0, 25)] . $numeros[rand(0,9)] . $numeros[rand(0,9)];
        break;
        case 2:
            $retorno = $letras[rand(0, 25)] . $numeros[rand(0,9)] . $numeros[rand(0,9)] . $letras[rand(0, 25)] . $numeros[rand(0,9)];
        break;
        case 3:
            $retorno = $numeros[rand(0,9)] . $letras[rand(0, 25)] . $letras[rand(0, 25)] . $numeros[rand(0,9)] . $numeros[rand(0,9)];
        break;
        case 4:
            $retorno = $numeros[rand(0,9)] . $numeros[rand(0,9)] . $numeros[rand(0,9)] . $letras[rand(0, 25)] . $letras[rand(0, 25)];
        break;
        default:
            $retorno = $letras[rand(0, 25)] . $letras[rand(0, 25)] . $numeros[rand(0,9)] . $numeros[rand(0,9)] . $numeros[rand(0,9)];
        break;
    }
    
    
    return $retorno;
}

/**
 * Funcion para el manejo del pais, recibira el nombre de un pais y devolvera el id de dicho pais que esta en la base de datos
 */
 function darCodigoPais($pais){
    $codigo = 0;
    
    switch($pais){
        case "Colombia":
            $codigo = 1;
        break;
        case "Argentina":
            $codigo = 3;
        break;
        case "Bolivia":
            $codigo = 4;
        break;
        case "Brasil":
            $codigo = 5;
        break;
        case "Chile":
            $codigo = 6;
        break;
        case "Ecuador":
            $codigo = 7;
        break;
        case "Paraguay":
            $codigo = 8;
        break;
        case "Peru":
            $codigo = 9;
        break;
        case "Uruguay":
            $codigo = 10;
        break;
        case "Venezuela":
            $codigo = 11;
        break;
        case "Mexico":
            $codigo = 12;
        break;
        default:
            $codigo = 2;
        break;
    }
    
    return $codigo;
 }

/**
 * Funcion para el manejo del pais, recibira el nombre de un pais y devolvera el id de dicho pais que esta en la base de datos
 */
 function darCodigoTelefonicoPais($pais){
    $codigo = "";
    
    switch($pais){
        case "Colombia":
            $codigo = "+57";
        break;
        case "Argentina":
            $codigo = "+55";
        break;
        case "Bolivia":
            $codigo = "+56";
        break;
        case "Brasil":
            $codigo = "+58";
        break;
        case "Chile":
            $codigo = "+59";
        break;
        case "Ecuador":
            $codigo = "+54";
        break;
        case "Paraguay":
            $codigo = "+53";
        break;
        case "Peru":
            $codigo = "+52";
        break;
        case "Uruguay":
            $codigo = "+51";
        break;
        case "Venezuela":
            $codigo = "+50";
        break;
        case "Mexico":
            $codigo = "+60";
        break;
        default:
            $codigo = "+00";
        break;
    }
    
    return $codigo;
 }

/**
 * Esta funcion proicesara un numero telefonico y devolvera solo el numero, sin codigo de pais
 */ 
function procesarNumeroTelefono($telefono){
    
    $retorno = "";
    /*
    //Lo primero es saber si el numero telefonico empieza o tiene el +
    if(strpos($telefono, "+") == 0){
        $retorno = substr($telefono, 3, strlen($telefono));
    }else{
        $retorno = $telefono;         
    }
    */
    $retorno = $telefono;
    
    return $retorno;
    
}















?>