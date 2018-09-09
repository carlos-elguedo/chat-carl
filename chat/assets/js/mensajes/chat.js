//Bien, ya estamos en el javascript del chat, Dios ayudame!

//Vamos primero con el evento escribiendo
$("#area_de_texto").on('keyup', function(event) {
        event.preventDefault();
        console.log("Presiono una tecla: "+ event.which);
        NUMERO_CARACTERES_ESCRITOS++;
        if(NUMERO_CARACTERES_ESCRITOS >= 2 && event.which != 8){
        	$.ajax({
				url: RUTA_SERVIDOR+"mensajes/escribiendo.php",//url del servidor
				type: "post",
				data:{msg1:lg, msg2:ID_RELACION_MENSAJE_CHAT}
			}).done(function(res){//cuando ya este listo
				console.log("Mando el escribiendo:\n" + res);
			});//Fin del done
			NUMERO_CARACTERES_ESCRITOS = 0;
        }
        
		
    });

/**
Bien, ahora vamos a enviar los mensajes de texto, Dios!
Esta funcion tomara el texto y lo enviara al servidor para enviar un nuevo mensajes
*/
$("#ENVIAR").click(function(eve){
	eve.preventDefault();
	
	if($("#ENVIAR").hasClass('mdi-send')){
		//Quiere enviar un texto
		//console.log("Quiere envair texto: ");
		//Sacamos el texto total que esta en el area de escritura y el cual el usuario ve
		var texto = $("#area_de_texto").html();

		//Si el texto es diferente de vacio y si ha escrito en el area
		if(texto !== "" && HAESCRITO === true){
			//Definimos la variable mensaje, la cual sera la que se envie al servidor como un mensaje
			var mensaje = texto.trim();
			//Definimos otra variable para saber si el texto que se quiere enviar es solo emoticon
			var texto_posible_emoticon = $("#area_de_texto").text();

			//Controlamos la variable mensaje que se va a enviar quitando codigo innecesario
			/*while(mensaje.endsWith("<div><br></div>")){
                mensaje = mensaje.substring(0, mensaje.length - 15);
            }*/

            if(texto_posible_emoticon === ""){
            	//eS UN MENSAJE de solo emoticones, el cual al pasarse a texto no genera nada de texto sino queesta vacio

            }else{
            	//Es un mensaje que contiene texto, y tambien posiblemente revuelto con emoticones
            	ponerEnChatPreview(mensaje);
            	var resultado = $.ajax({
                    url: RUTA_SERVIDOR + "mensajes/enviarMensaje.php",//url del servidor
                    type: "post",
                    data:{msg1 : "1", msg2: mensaje, msg3:ID_RELACION_MENSAJE_CHAT}
                }).done(function(res){//cuando ya este listo
                    //alert(res);
                    console.log("msg respuesta del servidor" + res);
                    //$("envio-mensajes").append(res);
                });//fin del done

                console.log(resultado);

                $("#area_de_texto").html("...");
                HAESCRITO = false;
                var altura = $('#pantalla_chat').prop("scrollHeight");
                console.log("Altura: " + altura);
                $("#pantalla_chat").scrollTop(altura);
            }



		}
	}else{
		//Quiere enviar un corazon
		console.log("Quiere envair corazon");
	}
});





















/*
----------          ------------------------------------------------------------------------------------------------------------------------------------------------------
----------          ------------------------------------------------------------------------------------------------------------------------------------------------------
----------   --------------------------------------------------------------------------------------------------------------------------------------------------------------
----------   --------------------------------------------------------------   -----------------------------------------------------------------------------------------------
----------   ----------------------------          -----------------------------------------------------------------------------------------------------------------------------
----------          ----   -------   ----            -------            ---   ---------------------------------------------------------------------------------------------------------------------------------------
----------          ----   -------   ----   -------   ----   --------------   -----------------------------------------------------------------------------------------------------------
----------   -----------   -------   ----   -------   ----   --------------   --------------------------------------------------------------------------------------------------------------
----------   -----------   -------   ----   -------   ----   --------------   ------------------------------------------------------------------------------------------------------------
----------   -----------   -------   ----   -------   ----   --------------   ------------------------------------------------------------------------------------------------------------
----------   ------------   -----   -----   -------   -----   -------------   ----------------------------------------------------------------------------------------------------------
----------   -------------        -------   -------   ------            ---   ------------------------------------------------------------------------------------------------------------------------
*/


function ponerEnChatPreview(mensaje){
    $(DIVISION_MENSAJES_ACTUAL).append("<div class='datos_usuario_principal mensaje-enviando'>"+
    		"<div class='chat-box-right style-bg'>"+
    			"<div class='mensaje'>" + mensaje + "</div>"+
    			"<div class='datos-der'>"+
    				"<div><i class='mdi mdi-heart'></i></div>"+
    			"</div>"+
    		"</div>"+
    	"</div>");
              
}

function ponerMensajeEnChat(mensaje, hora, id){
    $(DIVISION_MENSAJES_ACTUAL).append("<div class='datos_usuario_principal mensaje-enviando'>"+
    		"<div class='chat-box-right style-bg'>"+
    			"<div class='mensaje'>" + mensaje + "</div>"+
    			"<div class='datos-der'>"+
    				"<div><i class='mdi mdi-heart'></i></div>"+
    			"</div>"+
    		"</div>"+
    	"</div>");
              
}

String.prototype.endsWith = function(str) 
{return (this.match(str+"$")==str)}

String.prototype.startsWith = function(str) 
{return (this.match("^"+str)==str)}