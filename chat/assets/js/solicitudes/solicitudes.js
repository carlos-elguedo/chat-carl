/**
	solicitud 1: Este tipo es para enviar una solicitud a un usuario
	solicitud 2: Es para traer las solicitudes desde el servidor que tenga el usuario
	solicitud 10: Es para que cuando el usuario halla enviado una solicitud, quede marcada como myLove cuando el otro la acepte
	solicitud 11: Es para cuando el otro usuario acepte la solicitud este otro quede maracado en la friendzone del usuario que la envio
	solicitud 20: Es para aceptar una solicitud como su Love
	solicitud 21: Es para aceptar una solicitud y enviarlo a la friendzone
	solicitud 99: Para rechazar una solicitud recibida
	solicitud 22: Para rechazar y bloquear una soliciud y a quien la envio


Esta funcion es para el envio de solicitudes nuevas al servidor
*/
$("#envsolbotenviar").click(function(eve){
	eve.preventDefault();
	//alert("Enviar");

	dato_solicitud = darDatoSolicitud();
	

	if(dato_solicitud !== "" && dato_solicitud != NaN){
		console.log("Dato:  " + dato_solicitud);

		//$('.list-account > .list').prepend('<li><img src="http://lorempixel.com/100/100/people/1/"><span class="name">' + dato_solicitud + '</span><i class="mdi mdi-menu-down"></i></li>');
		le = darLenguaje();
		closeModal();
		$('.list-account > .list').append('<li id="enviandoSolicitud"><img src="assets/img/cargando.gif"><span class="name">' + darTextoEspecifico(le, 1) + '</span></li>');
		$.ajax({
			url: RUTA_SERVIDOR+"solicitudes/solicitudes.php",//url del servidor
			type: "post",
			data:{solici1:"1", solici2:le, solici3:dato_solicitud},
		}).done(function(res){//cuando ya este listo
			$("#informaciones").html(res);
			$("#enviandoSolicitud").remove();
			$(".aun-no-tiene-solicitudes").remove();

			console.log("Envio la solicitud tipo 1, esto recibio: \n" + res);
			$("#informaciones").fadeIn(1500, function(){
				setTimeout(function() {
		               $('#informaciones').fadeOut(2000);
		        }, 1500);
			});


		});//fin del done
	}
});







/**
Esta funcion devolvera el valor que esta en el campo de envio de solicitudes
*/
function darDatoSolicitud(){
	var opc_selec = 0;
	opc_selec = $("#solicitud-tipo-dato").val();
	var retorno = '';

	if(opc_selec === 1 || opc_selec === 2 || opc_selec === 3 || opc_selec === "1" || opc_selec === "2" || opc_selec === "3"){

		if(opc_selec === 1 || opc_selec === "1"){
			if(cumpleTallaMaxima($("#correo-solicitud").val(), 30)){
				if(validarEmail($("#correo-solicitud").val())){
					retorno = $("#correo-solicitud").val();
				}else{
					alert("Ingresa un correo correcto");
				}
			}else{
				alert("Has superdado el limite en el valor del correo");
			}
		}

		if(opc_selec === 2 || opc_selec === "2"){
			if(cumpleTallaMaxima($("#telefono-solicitud").val(), 20)){
				retorno = $("#telefono-solicitud").val();
			}else{
				alert("Has superdado el limite en el valor del telefono");
			}
		}

		if(opc_selec === 3 || opc_selec === "3"){
			if(cumpleTallaMaxima($("#codigo-solicitud").val(), 30)){
				retorno = $("#codigo-solicitud").val();
			}else{
				alert("Has superdado el limite en el valor del codigo");
			}
		}


	}else{
		alert("No has realizado el proceso correctamente, selecciona un tipo de dato valido");
	}
	return retorno;
}

/**
Esta funcion es para traer las solicitudes desde el servidor y ponerlas en la app
*/
function traerSolicitudes(){
	le = darLenguaje();
	$.ajax({
		url: RUTA_SERVIDOR+"solicitudes/solicitudes.php",//url del servidor
		type: "post",
		data:{solici1:"2", solici2:le, solici3:"0"},
	}).done(function(res){//cuando ya este listo
		//console.log("Solicitudes traidas:  ->" +  res + "<-");
		$("#informaciones").html(res);
	});//Fin del done
}




function ponerPantallaAccionSiAcepta(){
	if ($("#alerta").hasClass('active')) {
            closeAccionesSiAcepta();
            $(this).removeClass('active');

    } else {
        $(this).addClass('active');
        setModal("si-acepta");
        $('#alerta').one('click', '.btn.cancel', function() {
            closeAccionesSiAcepta();
        });
    }
}