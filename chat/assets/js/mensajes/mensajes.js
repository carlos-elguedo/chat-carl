/*
Esta funcion pondra en el panel de mensajes los mensajes de un respectivo chat
*/
function ponerMensajesChat(texto_division, img_otro, nombre_otro, relacion){
	//console.log("Llego a poner los mensajes: " + texto_division + "\n\n\n img:" + img_otro + "\n\n\n");
	$("#nombre-usuario-chat").html(nombre_otro);
	$("#nombre-usuario-chat").addClass("nombre-otro-usuario");
	$("#img-otro").prop("src", RUTA_SERVIDOR_PERFIL + img_otro);

	var id_division = "#" + texto_division;
	DIVISION_MENSAJES_ACTUAL = id_division;
	ID_RELACION_MENSAJE_CHAT = relacion;

	setTimeout(function() {
		$('.shown').removeClass('shown');
		$('.list-chat').addClass('shown');
		$(id_division).show();
		setRoute('.list-chat');
	}, 300);
		
	
}


/**
	Esta funcion pedira desde el servidor todos, TODOS los mensajes del usuario para pegarlos en las divisiones del chat respectivo
*/
function pedirMensajes(id_relacion, texto_division){
	ID_RELACION_ACCION = id_relacion;
	//console.log("Llego a pedir los mensajes: " + ID_RELACION_ACCION + " - " + texto_division);
	var id_division = "#" + texto_division;
	$.post(
		RUTA_SERVIDOR +"mensajes/mensajes.php",
		{msg1:lg, msg2:id_relacion},
		function(respuesta){
			//console.log("Trajo los mensajes:\n" + respuesta);
			$(id_division).html("");
			$(id_division).html(respuesta);
		});//fin del post



}