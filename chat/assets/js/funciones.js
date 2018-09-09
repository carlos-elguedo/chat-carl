
/**
 * Esta variable indicara si el usuario a escrito algo en el campo mensaje de texto
 * @param {type} element
 * @returns {Boolean}
 */


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
Para comprobar si el equipo tiene conexion a internet
*/
function conexionInternet(){
    var retorno = false;
    if(navigator.onLine){
        console.log("Esta en liena");
        retorno = true;
        //$("#estado_superior").html("");

    }else{
        console.log("Sin conexion a internet");
        retorno = false;
        //$("#estado_superior").html("Sin conexion a internet");
    }

    retorno = true;
    return retorno;
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
* Esta funcion es para conocer el lenguaje del navegador
* Devolvera el lenguaje del equipo en dos caracteres al que se lo pida
*/
 function darLenguaje() {
    //variable que sacara el lenguaje del usuario
    var leng = window.navigator.language;
    var len;
    LENGUAJES_DISPONIBLES_PEDIDOS = ["en", "es"];

    
    //Si la variable lenguaje del usuario tiene algo, sacamos su lenguaje en dos letras
    if(!(typeof leng === 'undefined')) {
        len = leng.substring(0,2); 
    //Si no se pudo sacar, se estanlecera el lenguaje por defecto
    } else {
        len = 'en';
    }

    //Ahora comprobamos que ese variable este dentro de nuestros lenguajes soportados
    if(LENGUAJES_DISPONIBLES_PEDIDOS.contains(len) === false) {
        len = 'en';
    }

    //Mostramos el lenguaje del usuario en la consola
    //console.log('Lenguaje del dispositivo pedido: ' + len);
    return len;
}




/**
 * Funcion para validar y comprobar que un correo sea correcto
 * Recibe el correo a verficar
 */
function validarEmail( email ) {
    var ret = false;
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ){
        console.log("Error: La dirección de correo " + email + " es incorrecta.");
        ret = false;
    }else{
        ret = true;
        //alert("correo correcto: " + email);
        //alert("Email correcto");
    }
    return ret;
}//Fin de la funcion validar correo



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
Esta funcion devolvera un texto especifico pedido en el idioma solicitado
*/
function darTextoEspecifico(idi, id_texto){
    var retorno = "";
    switch(idi){
        case "es":
            if(id_texto == 1){
                //Para el texto de enviando solicitud
                retorno = "Enviando solicitud...";
            }
            if(id_texto == 2){
                //Para el texto de solicitud respondida y caducada
                retorno = "Ya los dos han respondido esta solicitud";
            }
            if(id_texto == 3){
                //Para el texto de estado de subida de la imagen
                retorno = "Tu imagen de perfil fue actualizada";
            }
            break;
        case "en":
            if(id_texto == 1){
                retorno = "Sending request...";
            }
            if(id_texto == 2){
                retorno = "This request is ready";
            }
            if(id_texto == 3){
                //Para el texto de estado de subida de la imagen
                retorno = "Your profile photo was been update";
            }
            break;
        default:
            if(id_texto == 1){
                retorno = "Sending request...";
            }
            if(id_texto == 2){
                retorno = "This request is ready";
            }
            if(id_texto == 3){
                //Para el texto de estado de subida de la imagen
                retorno = "Your profile photo was been update";
            }
            break;
    }

    return retorno;
}

/*
Esta funcion es para poer codigo en la division de mirar fotografia
dependiendo del tipo de vision, se mandara el codigo correspondiente a dicha division
*/
function ponerTeatro(tipo, foto){
    switch(tipo){
        case 1:
            $("#foto").html('<div>'+
            '<div class="foto-superior">'+
              '<label>Cerrar</label>'+
            '</div>'+
            '<picture>'+
              '<source srcset="assets/img/index.png">'+
              '<img src="assets/img/index.png" alt="cargando...">'+
            '</picture>  '+
            '<div class="foto-inferior">'+
              '<label>Siguiente</label>'+
              '<label>Anterior</label>'+
            '</div>'+
          '</div>');
            break;
        default:

            break;
    }


    
}


function AccionSolicitud(id_solicitud){
    ID_SOLICITUD_ACCION = id_solicitud;
}
function AccionMesajesRelaciones(id_relacion){
    ID_RELACION_ACCION = id_relacion;
}


function ponerCorazones(){
    
    if(CORAZONES_ACTIVADOS === false){
        $("#accion-solicitud-respuesta").append("<script>"+
          "if(!image_urls){"+
            "var image_urls=Array()"+
          "}"+
          "if(!flash_urls){"+
            "var flash_urls=Array()"+
          "}"+
          "image_urls['corazon']='assets/img/corazon-cayendo.png';"+
          "image_urls['corazon2']='assets/img/corazon-cayendo2.png';"+
          "image_urls['corazon3']='assets/img/corazon-cayendo3.png';"+
          "$(document).ready(function(){"+
            "var c=$(window).width();"+
            "var d=$(window).height();"+
            "var e=function(a,b){"+
              "return Math.round(a+(Math.random()*(b-a)))"+
            "};"+
            "var f=function(a){"+
              "setTimeout(function(){"+
                "a.css({left:e(0,c)+'px',top:'-30px',display:'block',opacity:'0.'+e(10,100)}).animate({top:(d-10)+'px'},e(8500,10000),function(){$(this).fadeOut('slow',function(){f(a)})})},e(1,9000)"+
                ")};"+
              "$('<div></div>').attr('id','corazonDiv').css({position:'fixed',width:(c-20)+'px',height:'1px',left:'0px',top:'-5px',display:'block'}).appendTo('body');"+
              "for(var i=1;i<=15;i++){"+

                //imagen_ramdom = Math.round(1,3);
                /*var myNumeroAleatorio = Math.floor(Math.random()*(4-1))+1;
                imagen_aleatorea = "";
                switch(myNumeroAleatorio){
                  case 1:
                    imagen_aleatorea = image_urls['corazon'];
                    break;
                  case 2:
                    imagen_aleatorea = image_urls['corazon2'];
                    break;
                  case 3:
                    imagen_aleatorea = image_urls['corazon3'];
                    break;
                  default:
                    imagen_aleatorea = image_urls['corazon'];
                    break;
                }*/
                "imagen_aleatorea = image_urls['corazon'];"+
                "var g=$('<img/>').attr('src',imagen_aleatorea).css({position:'absolute',left:e(0,c)+'px',top:'-30px',display:'block',opacity:'0.'+e(10,100),'margin-left':0}).addClass('corazonDrop').appendTo('#corazonDiv');"+
                "f(g);"+
                "g=null"+
              "};"+
              "var h=0;"+
              "var j=0;"+
              "$(window).resize(function(){"+
                "c=$(window).width();"+
                "d=$(window).height()"+
              "})"+
            "});"+
        "</script>");
        CORAZONES_ACTIVADOS = true;

        setTimeout(function() {
            if(CORAZONES_ACTIVADOS === true){
                $('#corazonDiv').fadeOut(3000, function(){
                   $('#corazonDiv').remove();
                });
                CORAZONES_ACTIVADOS = false;
            }
        }, 60000);//5 minutos de corazones
    }

    
    
}



/**
Esta funcion es para definir que accion realizar al recibir un nuevo evento
*/
function procesarEvento(res){
    var evento = parseInt(res);
        switch(evento){
            case 0:
                console.log("Evento 0: " + res);
                break;
            //Eventos relacionados con solicitudes:
            case 10:
                //ha recibido una nueva solicitud
                nuevaSolicitud();
                break;
            case 11:
                //han aceptado una solicitud que este usuario envio
                aceptaronSolicitud();
                break;
            case 12, 13:
                //han aceptado una solicitud que este usuario envio
                rechazaronSolicitud();
                break;

            case 20:
                //Un usuario relacionado con este esta escribiendo algo en el panel
                estanEscribiendo();
                break;
            case 21:
                //El usuario ha recibido un nuevo mensaje
                nuevoMensaje();
                break;

            case 22:
                //Un mensaje enviado por este usuario, ha sido entregado
                mensajeEntregado();
                break;
            
            case 'NaN':
                console.error("Error: " + res);
                break;
            default:
                console.log("Evento default: " + res);
                break;

        }
}


/**
Esta funcion es para controlar los escribiendo que apareceran en la app
*/
function estaEscribiendo(relacion){
    var bandera_1 = "#texto_division_esta_relacion_" + relacion;
    var bandera_txt = "#bandeja_" + relacion + " > .content-container > .txt";
    var bandera_esc = "#bandeja_" + relacion + " > .content-container > .bandeja_escribiendo";
    var bandeja = "bandeja_" + relacion;

    var division = '#' + $(bandera_1).val();
    var division_2 = $(bandera_1).val();
    //var texto_poner_escribiendo = division + ' > .datos_usuario_secundario > .chat-box-left-escribiendo';

    eval('ESCRIBIENDO.' + $(bandera_1).val() + ' = true');
    
    $(bandera_txt).hide();
    $(bandera_esc).show();
    //Listo, ahora añadimos el escribiendo...
    if($(division).hasClass('escribiendo')){

    }else{

        var altura = $('#pantalla_chat').prop("scrollHeight");
        
        $(division).append("<div class='datos_usuario_secundario escribiendo_msg_"+relacion+"'>"+
                            "<div class='chat-box-left-escribiendo'>"+
                                "<div class='mensaje escribiendo'> <img src = 'assets/img/escribiendo-peq.gif' </div>"+
                            "</div>"+
                        "</div>");
        $(division).addClass('escribiendo');
        var altura_dos = $('#pantalla_chat').prop("scrollHeight");
        console.error("Alturas: " + altura + "-" + altura_dos);

        if(altura !== altura_dos){
            $("#pantalla_chat").scrollTop(altura_dos);
        }
        
    }
    //$(texto_poner_escribiendo).show();
    $(quitarEscribiendo()).finish();
    quitarEscribiendo(bandera_txt, bandera_esc, division, division_2, relacion);
    
    setTimeout(function(){
        eval('ESCRIBIENDO.' + $(bandera_1).val() + ' = false');
    }, 2000)

    

}


function quitarEscribiendo(t_txt, t_esc, division, division_2, relacion){
    
    
    setTimeout(function(){
        if($(division).hasClass('escribiendo')){
            //Si la division en la que se esta escribiendo tiene la clase que detonota este evento:
            if(eval('ESCRIBIENDO.' + division_2)  == false){
                $(t_txt).show();
                $(t_esc).hide();
                id_escribiendo = ".escribiendo_msg_"+relacion;
                $(id_escribiendo).remove();
                $(division).removeClass('escribiendo');
                //$(t_pon_esc).hide();
            }
            
        }
    }, 2000)

}


/**
Esta funcion es para colocar un mensaje recibido en la correspondiente division
*/
function colocarNuevoMensaje(mensaje, division, bandeja, hora, relacion){
    //console.log("::::::::::::::::::::::::Nuevo mensaje::::::::::::::::::::::::\n\n" + mensaje + "\n" + division + "\n" + bandeja + "\n" + relacion + "\n\n" );
    division = '#' + division;
    bandeja  = '#' + bandeja + " > .content-container > .txt";;
    id_escribiendo = ".escribiendo_msg_"+relacion;

    var altura = $('#pantalla_chat').prop("scrollHeight");

    $(id_escribiendo).remove();
    $(division).append("<div class='datos_usuario_secundario'>"+
        "<div class='chat-box-left'>"+
        "<div class='mensaje'>"+ mensaje +"</div>"+
        "<div class='datos-izq'>"+
        "<div>"+hora+"</div>"+
        "</div>"+
        "</div>"+
        "</div>");
    var altura_dos = $('#pantalla_chat').prop("scrollHeight");
    console.error("Alturas: " + altura + "-" + altura_dos);

    if(altura !== altura_dos){
        $("#pantalla_chat").scrollTop(altura_dos);
    }

    $(bandeja).html(mensaje);
}

function colocarMensajeEntregado(id_mensaje, division, relacion){
    console.log("::::::::::::::::::::::::Mensaje entregado::::::::::::::::::::::::\n\n" + id_mensaje + "\n" + division + "\n" + relacion + "\n\n" );
    
}