/**
 * Este documento controlara varias acciones para la aplicacion, en especial a la pantalla de chat
 * @type type
 */


$("document").ready(function(){
	//alert("Todo listo por aqui");
	//Variable que contiene los idiomas soportados por la aplicacion, esto para el multilenguaje
	LENGUAJES_DISPONIBLES = ["en", "es"];


	//Variable que almacenara el tipo de texto si emoticones o texto
	var TEXTOEMOTICONES = 2;

	//Variable que indicara si la barra de mas elementos se encuentra abierta
	var OPCIONES_DE_CHAT = 2;


    //setInterval("cargarMensajes()", 10000);

    //En esta variable almacenamos el estado de la red
    CONEXION_INTERNET = conexionInternet();

    console.log("Internet: " + CONEXION_INTERNET);

    //Ahora, si hay conexion a internet traemos los datos del servidor para actualizar los locales y ponerlos en la app
    if(CONEXION_INTERNET === true){
        //Hay internet...
        //Llamamos a esta funcion para que se conecte al servidor
        conectarPHP();
        //Llamamos a esta funcion para que traiga las solicitudes e historial que va en la pantalla 1, la de solicitudes y notificaciones
        traerSolicitudes();
        //Llamamos a esta funcion para que traiga desde el servidor la bandeja de mensajes
        traerBandejaMensajes();
        

    }else{
        //No hay internet
        setName(localStorage.getItem('username'));
        setImagenUsuario(localStorage.getItem('img-perfil'));
    }


	//Llamamos a esta  funcion para que controle el lenguaje y lo muestre en los campos
	controlarLenguaje();
    //setInterval("conexionInternet()", 2000);//Funcion que esta pendiente a la conexion a internet:
	


    $("#informaciones > label").fadeOut(2000);
	
        /**
         * Esta funcion es para el manejo y control de la accion de ver los demas tipos de mensajes
         * Esto muestra y oculta la barra de mas opciones, la de imgs, juegos, texto, etc
         */
	$("#mas-opciones").click(function(){
		if((OPCIONES_DE_CHAT % 2) === 0){
			//No esta abierta, hay que mostrarla
			$("#mas-opciones").removeClass("mdi-plus");
			$("#mas-opciones").addClass("mdi-minus");

			$("#footer").css("height", "100px");
			$("#mensajeT0").show();
		}else{
			//Esta abierta hay que cerrarla			
			$("#mas-opciones").removeClass("mdi-minus");
			$("#mas-opciones").addClass("mdi-plus");
			$("#footer").css("height", "60px");
			$("#mensajeT0").hide();
			
		}
		OPCIONES_DE_CHAT++;
	});

        /**
         * Esta funcion es la que mostrara y ocultara el panel de emoticones
         */
	$("#boton-cambiar-emo-txt").click(function(){

		if((TEXTOEMOTICONES % 2) == 0){
			//MOSTREMOS LOS EMOTICONES
			$("#footer").css("bottom", "160px");
			$("#content").css("padding-bottom", "280px");
			$("#boton-cambiar-emo-txt").removeClass("mdi-emoticon-excited");
			$("#boton-cambiar-emo-txt").addClass("mdi-format-text");
			$("#mensajeT4").show();
			console.log("Emoticones");
		}else{
			//Ocultemos los emoticones
			$("#footer").css("bottom", "0");
			$("#content").css("padding-bottom", "120px");
			$("#boton-cambiar-emo-txt").removeClass("mdi-format-text");
			$("#boton-cambiar-emo-txt").addClass("mdi-emoticon-excited");
			$("#mensajeT4").hide();
			console.log("Texto");
		}
		TEXTOEMOTICONES++;
	});


        /**
         * Esta funcion estara pendiente si la barra de texto recibe el foco
         * si al recibirlo, el panel de texto tiene ... se borrara y estara vacio
         */
	$("#area_de_texto").focusin(function(eve){
                eve.preventDefault();
                if($("#area_de_texto").html() === "..." && HAESCRITO === false){
                    $("#area_de_texto").html("");
                }
                if((TEXTOEMOTICONES % 2) !== 0){
                    //La barra esta abierta, hay que cerrarla
                    $("#footer").css("bottom", "0");
                    $("#content").css("padding-bottom", "120px");
                    $("#boton-cambiar-emo-txt").removeClass("mdi-format-text");
                    $("#boton-cambiar-emo-txt").addClass("mdi-emoticon-excited");
                    $("#mensajeT4").hide();
                    console.log("Texto");
                    TEXTOEMOTICONES = 2;
                }
        });
        /**
         * Esta funcion estara pendiente si la barra de texto pierda el foco
         * si al perderlo, el panel de texto tiene se encuentra vacio, se colocara el texto por defecto ...
         */
        $("#area_de_texto").focusout(function(eve){
            eve.preventDefault();
            if($("#area_de_texto").html() === "" && $("#area_de_texto").text() === "" ){
                $("#area_de_texto").html("...");
                $("#ENVIAR").removeClass("mdi-send");
                $("#ENVIAR").addClass("mdi-heart");
                HAESCRITO = false;
            }
        });
        
        /**
         * Tambien manejara el estado de escribiendo del usuario actual
         * Esta funcion es para controlar el boton de envio de mensajes
         * Si el texto esta vacio, se establecera un corazon, si hay texto se procedera a poner el icono de enviar
         */
        $("#area_de_texto").keyup(function (eve){
            
            if($("#area_de_texto").html() === "" && $("#area_de_texto").text() === "" ){
                //Si el campo esta vacio, si no hay texto deberia ponerse el corazon
                if($("#ENVIAR").hasClass("mdi-send")){
                    $("#ENVIAR").removeClass("mdi-send");
                    $("#ENVIAR").addClass("mdi-heart");
                }
                HAESCRITO = false;
            }else{
                if($("#ENVIAR").hasClass("mdi-heart")){
                    $("#ENVIAR").removeClass("mdi-heart");
                    $("#ENVIAR").addClass("mdi-send");
                    
                }
                //TEXTO_MENSAJE = $("#area_de_texto").text();
                //eve.which;
                
                HAESCRITO = true;
            }
            //console.log("TEXTO: " + $("#area_de_texto").html());
        });
	
        
        /*
        Para quitar los menus abiertos si se hace click sobre la pantalla de chat
        */
        $("#pantalla_chat").click(function(eve){
            console.log("Click");
            if(!(MENU_OTRO% 2) == 0){
                toogleMenuOtro(1);
            }
        })


        /**
         * Para controlar ver las diferentes opciones sobre u mensaje
        */
        $(".chat-box-right").click(function (eve){
            if ($(this).hasClass('active')) {
            	closeDetallesMensaje();
            $(this).removeClass('active');

        } else {
            $(this).addClass('active');
            setModal("detalles-msg");
            $('#detalles-su-mensaje').one('click', '.btn.cancel', function() {
                closeDetallesMensaje();
            });
        }
            
        });


        /**
        Para controlar las pulsasiones sobre el boton borrar un emoticon
        */
        $("#eliminar-emoticon").click(function(eve){
        	//$("#area_de_texto").trigger("keyup", "8");
        });
        

        /**
        Para los clices sobre la img superior para ver y esconder las opciones del menu
        */
        $("#img-otro, #cerrarMenuOtro").click(function(eve){
        	eve.preventDefault();
        	toogleMenuOtro();
        });


        /**
        Para ontrolar el evento de pulsasiones sobre la imagen de perfil que esta en las configuraciones
        */
        $("#IMAGEN-PERFIL-OPC").click(function(eve){
            eve.preventDefault();
            console.log("Ver imagen de perfil");
            if ($(this).hasClass('active')) {
                cerrarTeatro();
                $(this).removeClass('active');
            } else {
                $(this).addClass('active');
                //ponerTeatro(1, 0);
                setModal("foto");
                $('.foto-superior').one('click', function() {
                    cerrarTeatro();
                });
            }//Fi del else

        });

        //Para cancelar la subida de una imagen
        $("#cancelar-proceso-3").click(function(eve){
            eve.preventDefault();
            $("#img-perfil-vista-subida").hide();
                $('.overlay').removeClass('add');
                $("#img-perfil-vista-subida").removeClass('abierto');
        });

        /**
        Para las pulsasones sobre el boton de subir una imagen, esto muestra el panel de vista previa de las imagenes del usuario que
        hasta ahora es un simple formulario normal
        */
        $("#cambiar-foto-perfil").click(function(eve){
            if($("#img-perfil-vista-subida").hasClass('abierto') ){
                $("#img-perfil-vista-subida").hide();
                $('.overlay').removeClass('add');
                $("#img-perfil-vista-subida").removeClass('abierto');
            }else{
                $('.overlay').addClass('add');
                $("#img-perfil-vista-subida").show();
                $("#img-perfil-vista-subida").addClass('abierto');

            }
        });
        
        //Para cambiar el tema de los mensajes
        $("#cambiarEstilo").click(function(eve){
            //$(".chat-box-right").addClass("chat-box-right2");
            //$(".chat-box-right").removeClass("chat-box-right");
            //location.href = 'http://localhost/mylove/index.html';
            console.log("Primera opcion");
            //$(this).addClass("chat-box-right2")
            
        });
        
       
       /**
        * Esta funcion para controlar los cambios sobre el tipo de dato del otro usuario para la solicitud
        */
       var cambio_solici_tip_dat = 1;
       $("#solicitud-tipo-dato").change(function(eve){
	//Tomamos la opcion elegida
	var opcion_escogida_para_solicitud = $("#solicitud-tipo-dato").val();
	//Miramos si la opcion escogida es el correo
	if(opcion_escogida_para_solicitud == "1" || opcion_escogida_para_solicitud == 1){
		//Si aun no ha seleccionado nada y es la primera vez
		if(cambio_solici_tip_dat !== 1){
                    //Si lo anterior era el telefono,  lo cambiamos por el del correo
                    if(cambio_solici_tip_dat === 2){
                        $("#telefono-solicitud").fadeOut(10, function(){
                            $("#correo-solicitud").fadeIn(1000);
                        });
                    }
                    //Si la opcion escogida anteriormente era el codigo, lo cambiamos
                    if(cambio_solici_tip_dat === 3){
                        $("#codigo-solicitud").fadeOut(10, function(){
                            $("#correo-solicitud").fadeIn(1000);
                        });
                    }
                    //Establecemos el cambio en el correo
                    cambio_solici_tip_dat = 1;
                }
	}//Fin de seleccionop el metodo por correo
	if(opcion_escogida_para_solicitud == "2" || opcion_escogida_para_solicitud == 2){
		//Si aun no ha seleccionado nada y es la primera vez
		if(cambio_solici_tip_dat !== 2){
                    //Si lo anterior era el telefono,  lo cambiamos por el del correo
                    if(cambio_solici_tip_dat === 1){
                        $("#correo-solicitud").fadeOut(10, function(){
                            $("#telefono-solicitud").fadeIn(1000);
                        });
                    }
                    //Si la opcion escogida anteriormente era el codigo, lo cambiamos
                    if(cambio_solici_tip_dat === 3){
                        $("#codigo-solicitud").fadeOut(10, function(){
                            $("#telefono-solicitud").fadeIn(1000);
                        });
                    }
                    //Establecemos el cambio en el correo
                    cambio_solici_tip_dat = 2;
                }
	}//Fin de seleccionop el metodo por correo
        if(opcion_escogida_para_solicitud == "3" || opcion_escogida_para_solicitud == 3){
		//Si aun no ha seleccionado nada y es la primera vez
		if(cambio_solici_tip_dat !== 3){
                    //Si lo anterior era el telefono,  lo cambiamos por el del correo
                    if(cambio_solici_tip_dat === 1){
                        $("#correo-solicitud").fadeOut(10, function(){
                            $("#codigo-solicitud").fadeIn(1000);
                        });
                    }
                    //Si la opcion escogida anteriormente era el codigo, lo cambiamos
                    if(cambio_solici_tip_dat === 2){
                        $("#telefono-solicitud").fadeOut(10, function(){
                            $("#codigo-solicitud").fadeIn(1000);
                        });
                    }
                    //Establecemos el cambio en el correo
                    cambio_solici_tip_dat = 3;
                }
	}//Fin de seleccionop el metodo por codigo
});



    $(".ir-perfil").click(function(eve){
        eve.preventDefault();
        $('.card.menu > .header > img').addClass('excite');        
        setTimeout(function() {
            $('.card.menu > .header > img').removeClass('excite');
            $("#opcion_2").click();
        }, 800);

    });

    $(".cerrar-sesion").click(function(eve){
        eve.preventDefault();
        cerrarSesion();
    });





});//Fin del documento ready
































/**
Esta funcion es para el show y hide del menu flotante sobre la imagen de perfil del otro usuario
*/
function toogleMenuOtro(quitar){
	if(quitar === 1){
		$(".dropdown-menu").fadeOut(500);
		MENU_OTRO = 2;

	}else{
		if((MENU_OTRO% 2) == 0){
		    $(".dropdown-menu").fadeIn(500);
		    MENU_OTRO++;
		}else{
		    $(".dropdown-menu").fadeOut(500);
		    MENU_OTRO++;
		}
	}
	
}




            /**
            Esta funcion es para poner los emoticones en el area de texto
            */
            function ponerEmoticon(clave){
                //alert(clave);
                var emoticon = clave;

                var texto_viejo = $("#area_de_texto").html();

                if(texto_viejo === "..." && HAESCRITO === false){
                    var codigo_unicode = emojione.shortnameToUnicode(emoticon);
                    var output = emojione.toImage(emoticon);
                    $("#area_de_texto").html(output);
                    $("#area_de_texto").trigger("keyup");
                    //TEXTO_MENSAJE = emoticon;
                    //transformar();
                }else{
                    var codigo_unicode = emojione.shortnameToUnicode(emoticon);
                    var output = emojione.toImage(emoticon);
                    $("#area_de_texto").append(output);
                    $("#area_de_texto").trigger("keyup");

                    //TEXTO_MENSAJE = TEXTO_MENSAJE + emoticon;

                }
                HAESCRITO === true;

            }//fin de la funcion ponerEmoticon







/**
* Esta funcion es para establecer el lenguaje en la aplicacion definido por el usuario
*/
controlarLenguaje = function(lenguaje_establecido) {
    //variable que sacara el lenguaje del usuario
	var lenguaje = window.navigator.language;
    
	//Si no recibio ningun parametro esta vacio, se buscara el idioma por defecto 
	if (typeof lenguaje_establecido === 'undefined') {
		//Si la variable lenguaje del usuario tiene algo, sacamos su lenguaje en dos letras
        if(typeof lenguage === 'undefined') {
             lg = lenguaje.substring(0,2); 
        //Si no se pudo sacar, se estanlecera el lenguaje por defecto
		} else {
             lg = 'en';
        }

		//Ahora comprobamos que ese variable este dentro de nuestros lenguajes soportados
        if(!LENGUAJES_DISPONIBLES.contains(lg)) {
            lg = 'en';//If the language is not available : english by default
        }
    } else {
		//Si se ha recibido un lenguaje como parametro, lo establecemos 
        lg = lenguaje_establecido;
    }


	//Llamamos a esta funcion para que rellene los datos de la variable que contiene los textos
	establecerIdioma(lg);	
	//Mostramos el lenguaje del usuario en la consola
    console.log('Lenguaje del dispositivo primero: ' + lg);
}

