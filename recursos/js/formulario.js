/**
 * Este archivo de control es el principal de la vista de acceso a la aplicacion
 * Esta funcion se ejecutara automaticamente a iniciarse el archivo
 */
(function(){

//Variable que contiene los idiomas soportados por la aplicacion, esto para el multilenguaje
LENGUAJES_DISPONIBLES = ["en", "es"];


//Este array contiene los paises que estan disponibles en la aplicacion
PAISES_DISPONIBLES = ["Argentina", "Bolivia", "Brasil", "Chile", "Colombia", "Ecuador", "Paraguay", "Peru", "Uruguay", "Venezuela"];

//Esta variable indicara si el usuario ya a editado alguna vez el select de seleccionar metodo de activacion
//0-> no ha escogido nada, 1->registrar con correo, 2->registrar con telefono
var edito_seleccionar_metodo = 0;




/**
 * Funcion que establece el lenguaje de la aplicacion
 * Recibe un parametro, el cual es el lenguaje a establecer
 * Si el parametro es vacio, se establece el lenguaje por defecto del usuario
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
	console.log('Lenguaje del dispositivo: ' + lg);
	//establecerIdioma("en");
}


//Llamamos a esta  funcion para que controle el lenguaje y lo muestre en los campos
controlarLenguaje();

//Ejecutamos esta funcion, la cual consultara si hay un usuario almacenado en la memoria, si lo hay iniciara la sesion
//Siempre y cuando halla conexion a internet
leerDatosMemoria();


/**
 * Estas variables contienen los formularios de la aplicacion con sus respectivos elementos
 */
var formulario_de_registro = document.formulario_registro;
var	formulario_inicio_sesion = document.formulario_acceso;

var elementos_registro = formulario_de_registro.elements;
var elementos_acceso = formulario_inicio_sesion.elements;





/**
*	Funcion que se ejecuta cuando el evento click es activado y se llama desde otra funcion aqui
*	Esto valida que los campos no esten incompletos y vacios
 */
var validarInputs_registro = function(){
	for (var i = 0; i < elementos_registro.length; i++) {
		// Identificamos si el elemento es de tipo texto, email, password, radio o checkbox
		if (elementos_registro[i].type == "email" || elementos_registro[i].type == "password" || elementos_registro[i].type == "number") {
			//Este if podria ir mas arriba. pera ya pa que xdxd
			//Si aun no ha escogido el metodo de registro
			if(edito_seleccionar_metodo == 0){
				console.log('El usuario aun no escogido una opcion de registro');
				alert("Escoge una forma de registro");
				return false;
			}else{//Si ya escogio una forma de registro
				//Aqui comprobamos que si ha escogido registrarse con correo
				if(edito_seleccionar_metodo == 1){
					//Como ha escogido el correo cambiamos el valor del campo numerico a un valor fake
					if(elementos_registro[i].type == "number"){
						elementos_registro[i].value = 1112222333;
					}else{
						//Ahora si empezamos a comprobar los campos del formulario
						// Si es tipo texto, email o password vamos a comprobar que esten completados los input
						if (elementos_registro[i].value.length == 0 ) {
							console.log('El campo ' + elementos_registro[i].name + ' esta incompleto');
							elementos_registro[i].className = elementos_registro[i].className + " error";
							return false;
						} else {
							elementos_registro[i].className = elementos_registro[i].className.replace(" error", "");
						}

					}
					
				}//Fin del if que comprueba si escogio registrarse con correo

				//Aqui comprobamos que si ha escogido registrarse con telefono
				if(edito_seleccionar_metodo == 2){
					//Como ha escogido el telefono cambiamos el valor del campo correo a un valor fake
					if(elementos_registro[i].type == "email"){
						//alert("Entro a comproibar el email");
						elementos_registro[i].value = "fake@fake.com";
					}else{
						//Ahora si empezamos a comprobar los campos del formulario
						// Si es tipo texto, email o password vamos a comprobar que esten completados los input
						if (elementos_registro[i].value.length == 0 ) {
							console.log('El campo ' + elementos_registro[i].name + ' esta incompleto : ' + elementos_registro[i].value);
							elementos_registro[i].className = elementos_registro[i].className + " error";
							return false;
						} else {
							elementos_registro[i].className = elementos_registro[i].className.replace(" error", "");
						}

					}
					
				}//Fin del if que comprueba si escogio registrarse con telefono



			}//Fin del else que comprueba que no haya seleccionado un metodo de registro 
						
		}//Fin del comprobador del tipo de valor del formulario
	}//Fin del for que rectifica los datos del formulario

	return true;
};//Fin de la funcion valdadr entradas del usuario registro


//Validar los datos para el formulario login
var validarInputs_login = function(){
	for (var i = 0; i < elementos_acceso.length; i++) {
		// Identificamos si el elemento es de tipo texto, email, password, radio o checkbox
		if (elementos_acceso[i].type == "text" || elementos_acceso[i].type == "password") {
			// Si es tipo texto, email o password vamos a comprobar que esten completados los input
			if (elementos_acceso[i].value.length == 0) {
				console.log('El campo ' + elementos_acceso[i].name + ' esta incompleto');
				elementos_acceso[i].className = elementos_acceso[i].className + " error";
				return false;
			} else {
				elementos_acceso[i].className = elementos_acceso[i].className.replace(" error", "");
			}
		}
	}

	return true;
};//Fin de la funcion valdadr entradas del usuario login






/**
 * Funcion que valida el elemento de aceptar los terminos
 * El usuario tiene que aceptar los terminos para poder registrarse
 */
var validarCheckbox = function(){
	var opciones = document.getElementsByName('terminos'),
		resultado = false;

	for (var i = 0; i < elementos_registro.length; i++) {
		if(elementos_registro[i].type == "checkbox"){
			for (var o = 0; o < opciones.length; o++) {
				if (opciones[o].checked) {
					resultado = true;
					break;
				}
			}

			if (resultado == false) {
				elementos_registro[i].parentNode.className = elementos_registro[i].parentNode.className + " error";
				console.log('El campo checkbox esta incompleto');
				return false;
			} else {
				// Eliminamos la clase Error del checkbox
				elementos_registro[i].parentNode.className = elementos_registro[i].parentNode.className.replace(" error", "");
				return true;
			}
		}
	}
};//Fin de la funcion valdadrChecked















/**
 * Funcion que es llamada al presionar el boton enviar registro
 * Esta funcion, como es regstro, comprueba las entradas y si estan correctas procede a enviar
 */
var enviar_registro = function(e){
	if (!validarInputs_registro()) {
		console.log('Falto validar los Input');
		e.preventDefault();
	} else if (!validarCheckbox()) {
		console.log('Falto validar Checkbox');
		e.preventDefault();
	} else {
		console.log('Envia');
		e.preventDefault();

		//Tomamos las variables del formulario con jquery
		var dato1 = $("#correo").val();
		var dato2 = $("#pais").val();
		var dato3 = $("#telefono").val();
		var dato4 = $("#pass").val();
		var dato5 = lg;
		var dato6 = $("#registrar-usando").val();
		
		//var dato = $("#").value();

		if(validarEmail(dato1)){
			if(validaPais(dato2)){
				//Vamos a comprobar si la contraseña cumple con el minimo de caracteres
				if(cumpleTalla(dato3, 6)){
					//Ahora comprobaos que la contraseña dada cumpla la talla mminima que es 5
					if(cumpleTalla(dato4, 5)){
						//alert("Entro al envador");
						//Mostramos un mensaje de carga mientrase se envian y procesan los datos
						$("#mensajes").append("<div class='modal1'><div class='center1'> <center> <img src='recursos/img/gif-load.gif'></center><br><button id = 'cancelar-envio-registro' class='boton-aceptar-cancelar' >Cancelar</button></div></div>");
                		$("cancelar-envio-registro").click(function(eve){
		                    //alert("Preiono cancelar");
                                    $("#mensajes").html("");
		                    //location.href = "index.html";
		                });
						//Enviamos los datos al servidor mediante post
						//Desabilitamos el boton para que no reenvie
                        //$("#btn-submit-registro").enable(false);
                        
						$.post(
							"http://localhost/mylove/servidor/registro/registro.php",
							{dato1:dato1, dato2:dato2, dato3:dato3, dato4:dato4, dato5:dato5, dato6:dato6},
							function(respuesta){
	    			        //alert("Envio el post registro.");
							console.log("Envio el post registro.");
							console.log("Esto recibio del servidor:\n " + respuesta);
                        	//Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
			            	//alert(respuesta);
							$("#mensajes").html("");
							$("#mensajes").html(respuesta);
                        	
    		        	});//fin del post
						
					}//Fin de la comprobacion de la talla de la contraseña
				}//Fin de la comprobacion de e telefono no cumple la talla
			}//Fin de la segunda validadcion, la del pais
		}//Fin de la primera validacion, la del correo
		

	}//Fin del else todo los datos llenos
};//Fin de la funcion enviar registro


/**
 * Funcion que es llamada al presionar el boton enviar inicio de sesion
 * Esta funcion comprueba las entradas del login y si estan correctas procede a enviar
 */
var enviar_login = function(e){
	if (!validarInputs_login()) {
		console.log('Falto validar los Input');
		e.preventDefault();
	} else {
		console.log('Envia');
		e.preventDefault();

		//Codigo de envio

		//Tomamos los datos de inicio de sesion
		var acceso1 = $("#dato_de_acceso").val();
		var acceso2 = $("#pass_acceso").val();
		var acceso3 = lg;

		//Empezamos a verificar
		//Verficamos la talla de el acceso correo
		if(cumpleTalla(acceso1, 6)){
			//Si la contraseña cumple el minimo de caracteres
			if(cumpleTalla(acceso2, 5)){
				//Procedemos a encriptar la contraseña para un envio seguro
				var pass_a_enviar = encriptarContra(acceso2);

				//Mostramos un mensaje de carga mientrase se envian y procesan los datos
				$("#mensajes").append("<div class='modal1'><div class='center1'> <center> <img src='recursos/img/gif-load.gif'></center><br><button id = 'cancelar-envio-login' class='boton-aceptar-cancelar' >Cancelar</button></div></div>");
                $("#cancelar-envio-login").click(function(eve){
		            //alert("Preiono cancelar");
		            $("#mensajes").html("");
		        });
				//Enviamos los datos al servidor mediante post
				//Desabilitamos el boton del login para que no reenvie
                //$("#btn-submit-inicio-sesion").enable(false);
                
				$.post(
					"http://localhost/mylove/servidor/acceso/iniciosesion.php",
					{acceso1:acceso1, acceso2:acceso2, acceso3:acceso3},
					function(respuesta){
	    			//alert("Envio el post registro.");
					console.log("Envio el login al servidor, esto recibio:\n" + respuesta)
                    //Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
                    $("#mensajes").html("");
					$("#mensajes").html(respuesta);
    		    });//fin del post
				

			}//Fin de la segunda comprobacion, la de la contraseña para que cumpla el minimo de caracteres
		}//fin de Si el telefono o correo cumple la talla establecda

	}
};//Fin de la funcion enviar login

/**
 * Funcxion que enviara la activacion numero uno, se enviara el codigo de activacion enviado por el usuario
 */
$("#formulario_activacion_1").submit(function(eve){
	eve.preventDefault();

	//Tomamos los datos de la activacion
	var activacion1 = "1";
	var activacion2 = $("#activacion_codigo").val();
	var activacion3 = lg;
	var activacion4 = $("#dato_usuario_para_activacion").val();

	//Enpezamos a comprobar los datos
	if(cumpleTallaEspecifica(activacion2, 5)){
		if(cumpleTallaEspecifica(activacion1, 1) && cumpleTallaEspecifica(activacion3, 2) && cumpleTallaMaxima(activacion4, 35)){
			//Mostramos un mensaje de carga mientrase se envian y procesan los datos
			$("#mensajes").append("<div class='modal1'><div class='center1'> <center> <img src='recursos/img/gif-load.gif'></center><br><button id = 'cancelar-envio-activacion2' class='boton-aceptar-cancelar' >Cancelar</button></div></div>");
            $("#cancelar-envio-activacion1").click(function(eve){
		        //alert("Preiono cancelar");
		        $("#mensajes").html("");
		    });

			//Enviamos los datos
			$.post(
				"http://localhost/mylove/servidor/registro/activarCuenta.php",
				{activacion1:activacion1, activacion2:activacion2, activacion3:activacion3, activacion4:activacion4},
				function(respuesta){
	    			//alert("Envio el post registro.");
					console.log("Envio la activacion 1 al servidor, esto recibio:\n" + respuesta)
                    //Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
                    $("#mensajes").html("");
					$("#mensajes").html(respuesta);
    		    });//fin del post
				
		}else{
			alert("Tus datos sobrepasan el limite permitido");
		}
	}else{
		alert("Ingresa un codigo de activacion de 5 cifras");
	}
	

});

/**
 * Funcxion que enviara la activacion numero dos, se enviara el correo o telefono del usuario
 */
$("#formulario_activacion_2").submit(function(eve){
	eve.preventDefault();

	//Tomamos los datos de la activacion
	var activacion1 = "2";
	var activacion2 = $("#activacion_forma_que_uso").val();
	var activacion3 = lg;
	var activacion4 = ""; 

	//Enpezamos a comprobar los datos
	if(cumpleTallaMaxima(activacion2, 35) && cumpleTalla(activacion2, 6)){
		if(cumpleTallaEspecifica(activacion1, 1) && cumpleTallaEspecifica(activacion3, 2) && cumpleTallaMaxima(activacion4, 1)){
			//Mostramos un mensaje de carga mientrase se envian y procesan los datos
			$("#mensajes").append("<div class='modal1'><div class='center1'> <center> <img src='recursos/img/gif-load.gif'></center><br><button id = 'cancelar-envio-activacion2' class='boton-aceptar-cancelar' >Cancelar</button></div></div>");
            $("#cancelar-envio-activacion2").click(function(eve){
		        //alert("Preiono cancelar");
		        $("#mensajes").html("");
		    });

			//Enviamos los datos
			$.post(
				"http://localhost/mylove/servidor/registro/activarCuenta.php",
				{activacion1:activacion1, activacion2:activacion2, activacion3:activacion3, activacion4:activacion4},
				function(respuesta){
	    			//alert("Envio el post registro.");
					console.log("Envio la activacion 2 al servidor, esto recibio:\n" + respuesta)
                    //Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
                    $("#mensajes").html("");
					$("#mensajes").html(respuesta);
    		    });//fin del post
				
		}else{
			alert("Tus datos sobrepasan el limite permitido");
		}
	}else{
		alert("Ingresa el dato de tu cuenta correctamente");
	}
	

});











/**
 * Funciones para el control de los eventos de focus y blur
 */
var focusInput = function(){
	this.parentElement.children[1].className = "label active";
	this.parentElement.children[0].className = this.parentElement.children[0].className.replace("error", "");
};

var blurInput = function(){
	if (this.value <= 0) {
		this.parentElement.children[1].className = "label";
		this.parentElement.children[0].className = this.parentElement.children[0].className + " error";
	}
};

/**
 * Funciones para el control de datos ingresados por el usuario
 */

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

function validaPais( pais ){
	var ret = false;
	//Verificamos que el pais ingresado este en los paises soportados 
	if(PAISES_DISPONIBLES.contains(pais)) {
        ret = true;
    }
	//alert(pais + " pais: " + ret);
	return ret;
}//Fin de la funcion validar Pais











// --- Eventos ---
//Cuando se quiera enviar el formulario registro
formulario_de_registro.addEventListener("submit", enviar_registro);

//Cuando se quiera enviar el formulario de inicio de sesion, se llama a la funcion respectiva
formulario_inicio_sesion.addEventListener("submit", enviar_login);


/**
 * Este for es para asignar los eventos de blur y focus a los elementos del formulario de regstro
 */
for (var i = 0; i < elementos_registro.length; i++) {
	if (elementos_registro[i].type == "text" || elementos_registro[i].type == "email" || elementos_registro[i].type == "password") {
		elementos_registro[i].addEventListener("focus", focusInput);
		elementos_registro[i].addEventListener("blur", blurInput);
	}
}

/**
 * Este for es para asignar los eventos de blur y focus a los elementos del formulario de inicio de sesion
 */
for (var i = 0; i < elementos_acceso.length; i++) {
	if (elementos_acceso[i].type == "text" || elementos_acceso[i].type == "email" || elementos_acceso[i].type == "password") {
		elementos_acceso[i].addEventListener("focus", focusInput);
		elementos_acceso[i].addEventListener("blur", blurInput);
	}
}

/**
 * Creamos esta funcion para el control de la entrada en registro del tipo de dato
 */
$("#registrar-usando").change(function(eve){
	//Tomamos la opcion elegida
	var opcion_escogida_para_registro = $("#registrar-usando").val();
	//Miramos si la opcion escogida es el correo
	if(opcion_escogida_para_registro === "1" || opcion_escogida_para_registro === 1){
		//Si aun no ha seleccionado nada y es la primera vez
		if(edito_seleccionar_metodo === 0){
			$("#escogio-correo").fadeIn(1000);
			edito_seleccionar_metodo = 1;
		}else{
			$("#escogio-telefono").fadeOut(10, function(){
				$("#escogio-correo").fadeIn(1000);
				edito_seleccionar_metodo = 1;
			});
		}
	}//Fin de seleccionop el metodo por correo
	if(opcion_escogida_para_registro === "2" || opcion_escogida_para_registro === 2){
		//Si aun no ha seleccionado nada y es la primera vez
		if(edito_seleccionar_metodo === 0){
			$("#escogio-telefono").fadeIn(1000);
			edito_seleccionar_metodo = 2;
		}else{
			$("#escogio-correo").fadeOut(10, function(){
				$("#escogio-telefono").fadeIn(1000);
				edito_seleccionar_metodo = 2;
			});
		}
	}//Fin de seleccionop el metodo por telefono
});


/**
 * Asignamos este codigo jquery para controlar el evento click en el boton registrarse que esta en la pantalla
 * de inicio de sesion y redirige al formulario de registro
 * Oculta la pantalla de incio de sesion y muestra la pantalla de registro
 */
$("#btn-registrarse").click(function(eve){
	eve.preventDefault();
	//alert("quiere enviar");
	$("#acceso").fadeOut(1000, function(){
		$("#registro").fadeIn(1000);
		//limpiarCampos(1);
	});
});

/**
 * Asignamos este codigo jquery para controlar el evento click en el boton volver atras que esta en la pantalla
 * de registro y redirige al formulario de inicio de sesion
 * Oculta la pantalla de registro y muestra la pantalla de inicio de sesio
 */
$("#btn-salir-registro").click(function(eve){
	eve.preventDefault();
	//alert("quiere enviar");
	$("#registro").fadeOut(1000, function(){
		$("#acceso").fadeIn(1000);
		//limpiarCampos(2);
	});
});

//Tomamos esta variable para el control de estos dos eventos, el focus y el focusout sobre el campo telefono
var tex = $("#lab-registro-telefono").html();

/**
 * Para controlar el evento focus sobre el campo telefono
 * Si hay algun texto en la en el campo formulario, no se borrara de lo contrario si
 */
$("#telefono").focusin(function(eve){
	var tel = $("#telefono").val();
	if(tel == ""){
		$("#lab-registro-telefono").html("");
	}
});

/**
 * Esta funcion es para contyrolar cuando el campo telefono pierde el foco
 * Si al perder el foco el campo sigue vacio se volvera el texto normal
 */
$("#telefono").focusout(function(eve){
	var tel = $("#telefono").val();
	
	if(tel == ""){
		$("#lab-registro-telefono").html(tex);
	}
});

/**
 * Este manejador de enventos es para las cancelaciones que pararan en la pagina principal
 */
$("#btn-activacion-cancelar-activacion-2").click(function(eve){
	eve.preventDefault();
	$("#activacion2").fadeOut(1000, function(){
		$("#acceso").fadeIn(1000);
	});
});
$("#btn-activacion-cancelar-activacion-1").click(function(eve){
	eve.preventDefault();
	$("#activacion1").fadeOut(1000, function(){
		$("#acceso").fadeIn(1000);
	});
});


/**
 * Eventos para dirigir al usuario a otras pantallas desde el login
 */
//Para la activacion
$("#lab-acceso-olvido").click(function(eve){
	eve.preventDefault();
	alert("No lo he programado aun");
	/*$("#acceso").fadeOut(1000, function(){
		$("#activacion2").fadeIn(1000);
		//limpiarCampos(1);
	});*/
});
//Para la pantalla de ayuda, de perdio la contraseña
$("#lab-acceso-activar").click(function(eve){
	eve.preventDefault();
	$("#acceso").fadeOut(1000, function(){
		$("#activacion2").fadeIn(1000);
		//limpiarCampos(1);
	});
});

$("#cerrar-primera-vez").click(function(eve){
	eve.preventDefault();
	$(".primera-vez").fadeOut(500, function(){
		$(".contenedor-formulario").fadeIn(500);
		localStorage.setItem("pri", "0");
		console.log("Primera vez cerrada");
	});
});


}())