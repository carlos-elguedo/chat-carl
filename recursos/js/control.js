/**
 * Funcion para saber si un elemnto esta en un array
 */
Array.prototype.contains = function(element) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == element) {
            return true;
        }
    }
    return false;
}



/**
 * Esta funcion es para limpiar los campos del formulario especifico
 * Recibe una variable numerica que indica el formulario a limpiar
 */
function limpiarCampos(caso){
    switch(caso){
        case 1:
            document.getElementById("dato_de_acceso").value = "";
            document.getElementById("pass_acceso").value = "";

        break;
        case 2:

        break;
        default:

        break;
    }
}


/**
 * Funcion para saber si una determinada variable cumple con la longitud dada
 * Recibe la cadena a comprobar
 * Recibe la talla a saber 
 */
function cumpleTalla(cadena, minimo){
    var ret = false;


    if(cadena.length >= minimo){
        ret = true;
    }else{
        
    }
    //alert(minimo + " - Talla menor bless: " + cadena.length);
    return ret;
}

/**
 * Funcion para saber si una determinada variable cumple con la longitud dada
 * Recibe la cadena a comprobar
 * Recibe la talla a saber 
 */
function cumpleTallaMaxima(cadena, maxima){
    var ret = false;


    if(cadena.length <= maxima){
        ret = true;
    }else{
        
    }
    //alert(minimo + " - Talla menor bless: " + cadena.length);
    return ret;
}

/**
 * Funcion para saber si una determinada variable cumple con la longitud especifica dada
 * Recibe la cadena a comprobar
 * Recibe la talla especifica 
 */
function cumpleTallaEspecifica(cadena, talla){
    var ret = false;


    if(cadena.length == talla){
        ret = true;
        //alert("La talla de: " + cadena + "Es correcta: " + cadena.length + "->" + talla);
    }else{
        //alert("La talla de: " + cadena + "Es mala: " + cadena.length + "->" + talla);
    }
    //alert(minimo + " - Talla menor bless: " + cadena.length);
    return ret;
}


/**
 * Funcion para encriptar la contraseña
 * recibe la contraseña sin encriptar y devuelve la encriptada
 */
function encriptarContra(contra){
    var ret = "";

    ret = contra;

    return ret; 
}



function conexionInternet(){
    var ret = false;
    if(navigator.onLine){
        console.log("Esta en liena");
        ret = true;
    }else{
        console.log("Sin conexion a internet");
        ret = false;
    }
    return  ret;
}




function leerDatosMemoria(){
	//localStorage.clear();
    //console.log("Se borrado la memoria")
    total = localStorage.length;
	
    if(total === 0){
        //Primera vez que se ejecuta la aplicacion
        //alert("Primera vez eh");
        //$(".contenedor-formulario").hide();
        $(".primera-vez").show();
        console.log("Primera vez mostrada");
	}

    if(total >= 1){
        var entro_en_tiene_datos_guardados = false;
        for(var f = 0; f < localStorage.length; f++){
            var clave = localStorage.key(f);
            var valor = localStorage.getItem(clave);
            //alert(clave + "-<->-" + valor);


            //If para saber si hay datos guardados de inicio de sesion
            if(clave === "sav" && valor === "1"){
                //Mostramos el mensaje de espera
                $("#mensajes").append("<div class='modal1'><div class='center1'> <center> <img src='recursos/img/gif-load.gif'></center><br><button id = 'cancelar-envio-login' class='boton-aceptar-cancelar' >Cancelar</button></div></div>");
                $("#cancelar-envio-login").click(function(eve){
		            //alert("Preiono cancelar");
		            $("#mensajes").html("");
                    $(".contenedor-formulario").show();
		        });
                //Tendremos que hacer otro if para recorrer el almacenamiento y sacar los datos de inicio de sesion
                var correo_usuario = "", pass_usuario = "";
                for(var i = 0; i<localStorage.length; i++){
                    var clave_2 = localStorage.key(i);
                    var valor_2 = localStorage.getItem(clave_2);
                    if(clave_2 === "dus"){correo_usuario = valor_2;}
                    if(clave_2 === "cus"){pass_usuario = valor_2;}
                }
                //Si ya tenemos los datos sacados desde la memoria, enviamos el formulario de inicio de sesion
                if(cumpleTalla(correo_usuario, 6)){
			        //Si la contraseña cumple el minimo de caracteres
			        if(cumpleTalla(pass_usuario, 5)){
				        //Procedemos a encriptar la contraseña para un envio seguro
				        var pass_a_enviar = encriptarContra(pass_usuario);
				        $.post(
					        "http://localhost/mylove/servidor/acceso/iniciosesion.php",
					        {acceso1:correo_usuario, acceso2:pass_usuario, acceso3:lg},
					        function(respuesta){
	    			            //alert("Envio el post registro.");
					            console.log("Envio el login guardado al servidor, esto recibio:\n" + respuesta)
                                //Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
                                $("#mensajes").html("");
					            $("#mensajes").html(respuesta);
    		                });//fin del post
				
			        }//Fin de la segunda comprobacion, la de la contraseña para que cumpla el minimo de caracteres
    		    }//fin de Si el telefono o correo cumple la talla establecda

                //Cambiamos el valor de la variable que indica que tiene datos guardados de inicio de sesion
                entro_en_tiene_datos_guardados = true;
                console.log("Se cambio la variable: " + entro_en_tiene_datos_guardados);

			}//Fin de if saber inicio de sesion

		}//Fin del for que recorre los elementos de el almacenamiento

        //Ahoraconsultamos si se cambio el valor e esta variable para mostrar la pantalla correcta
        if(entro_en_tiene_datos_guardados === false){
            console.log("Se mostroooooooooooooooooooo" + total);
            $(".contenedor-formulario").show();
        }

    }//Fin del if para saber si hay algo en la memoria


}//Fin de la funcion que consulta en la memoria interna del dispositivo