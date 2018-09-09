
function conectarPHP(){
    
    $.post(
		RUTA_SERVIDOR,
		function(respuesta){
			//console.log("Envio el inicio, esto recibio:\n" + respuesta)
        	//Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
			$("#respuestas-servidor").html("");
			$("#respuestas-servidor").html(respuesta);
			$.ajaxSetup({"cache": false});
			setInterval("cargarEventosPHP()", 1000);
		});//fin del post

    
}//fIN DE LA FUNCION CONECTAR PHP




// Esta funcion es para estar alerta al servidor a que reciba algun nuevo evento, este recibe el tipo de envento y lo procesa
function cargarEventosPHP(){
	if(CONEXION_INTERNET){
		if(PUEDE_PEDIR_EVENTOS){
			$.ajax({
			url: RUTA_SERVIDOR + "eventos.php",//url del servidor
			type: "post"
		}).done(function(res){//cuando ya este listo
			if(res !== ""){
				console.log("Codigo evento: " + res);
				$("#eventos-servidor").html('');
				$("#eventos-servidor").html(res);
			}
			
		});//Fin del done
		}
	}
}


