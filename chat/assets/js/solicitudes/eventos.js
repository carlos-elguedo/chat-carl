/*
Esta funcion es para cuando el usuario actual reciba desde el servidor una alerta que ha recibido una nueva solicitud
Aqui se traera desde el servidor y se plasmara en la app
*/
function nuevaSolicitud(){
	le = darLenguaje();
	$.ajax({
		url: RUTA_SERVIDOR+"solicitudes/solicitudes.php",//url del servidor
		type: "post",
		data:{solici1:"30", solici2:le, solici3:"0"},
	}).done(function(res){//cuando ya este listo
		$("#eventos").html('');
		$("#eventos").html(res);
		console.log("Evento: " + res);
		PUEDE_PEDIR_EVENTOS = true;
		NUMERO_NOTIFICACIONES++;
		document.getElementById('solicitud-audio').play();
		$("#num_notificaciones").html(NUMERO_NOTIFICACIONES);
	});//Fin del done
}


/**
Esta funcion es para cuando hayan aceptado una solicitud al usuario, se buscara en el servidor para actualizar las notificaciones locales
*/
function aceptaronSolicitud(){
	le = darLenguaje();
	var id_solicitud = ID_SOLICITUD_ACCION;
	$("#no-tiene-mensajes").remove();
	$.ajax({
		url: RUTA_SERVIDOR+"solicitudes/solicitudes.php",//url del servidor
		type: "post",
		data:{solici1:"31", solici2:le, solici3:id_solicitud},
	}).done(function(res){//cuando ya este listo
		$("#eventos").html('');
		$("#eventos").html(res);
		console.log("Evento: " + res);
		PUEDE_PEDIR_EVENTOS = true;
		NUMERO_NOTIFICACIONES++;
		document.getElementById('solicitud-audio').play();
		$("#num_notificaciones").html(NUMERO_NOTIFICACIONES);
	});//Fin del done
}


/**
Esta funcion es para nostrar al usuario que su solicitud ha sido rechazada por el otro usuario, que sad
*/
function rechazaronSolicitud(){
	le = darLenguaje();
	var id_solicitud = ID_SOLICITUD_ACCION;
	$.ajax({
		url: RUTA_SERVIDOR+"solicitudes/solicitudes.php",//url del servidor
		type: "post",
		data:{solici1:"31", solici2:le, solici3:id_solicitud},
	}).done(function(res){//cuando ya este listo
		$("#eventos").html('');
		$("#eventos").html(res);
		console.log("Evento: " + res);
		PUEDE_PEDIR_EVENTOS = true;
		NUMERO_NOTIFICACIONES++;
		document.getElementById('notificacion-audio').play();
		$("#num_notificaciones").html(NUMERO_NOTIFICACIONES);
	});//Fin del done
}


