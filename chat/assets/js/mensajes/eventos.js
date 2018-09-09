/**
Esta funcion es para cuando el usuario reciba el evento de escribiendo generado por otro usuario
*/
function estanEscribiendo(){
	le = darLenguaje();
	$.ajax({
		url: RUTA_SERVIDOR+"mensajes/eventosEM.php",//url del servidor
		type: "post",
		data:{msg1:lg, msg2:"10"}
	}).done(function(res){//cuando ya este listo
		console.log("Recibio el escribiendo: " + res);
		$("#eventos-escribiendo").append(res);
		
		PUEDE_PEDIR_EVENTOS = true;
	});//Fin del done
}

/**
Funcion para cuando el usuario reciba un nuevo mensaje desde el servidor
*/
function nuevoMensaje(){
	le = darLenguaje();
	$.ajax({
		url: RUTA_SERVIDOR+"mensajes/eventosNM.php",//url del servidor
		type: "post",
		data:{msg1:lg, msg2:"10"}
	}).done(function(res){//cuando ya este listo
		console.log("Recibio el nuevo mensaje: " + res);
		$("#eventos-mensajes-recibe").append(res);
		PUEDE_PEDIR_EVENTOS = true;
	});//Fin del done
}

/**
Funcion para cuando un mensaje a sido etregado al otro usuario
*/
function mensajeEntregado(){
	le = darLenguaje();
	$.ajax({
		url: RUTA_SERVIDOR+"mensajes/eventosME.php",//url del servidor
		type: "post",
		data:{msg1:lg, msg2:"10"}
	}).done(function(res){//cuando ya este listo
		console.log("Entrego un mensaje: " + res);
		$("#eventos-mensajes-entregados").append(res);
		PUEDE_PEDIR_EVENTOS = true;
	});//Fin del done
}