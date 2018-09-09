/*
	Esta funcion traera desde el servidor la bandeja de mensajes actualizada del usuario
*/
function traerBandejaMensajes(){
	le = darLenguaje();
	$.ajax({
		url: RUTA_SERVIDOR + "mensajes/bandeja.php",//url del servidor
		type: "post",
		data:{msg1:le}
	}).done(function(res){//cuando ya este listo
		//console.log("Bandeja: " + res);
		$("#informaciones-mensajes").html('');
		$("#informaciones-mensajes").html(res);
	});//Fin del done
}