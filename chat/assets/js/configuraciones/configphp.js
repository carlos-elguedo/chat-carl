/**
Configuraciones PHP
Este archivo es para manejar las distintas configuraciones del usuario
*/



/**
Para enviar la imagen de erfil al servidor y guardarla
*/
$("#subirImagenPerfil").click(function(eve){
	eve.preventDefault();
	if($("#img-perfil-subida").val() !== "" && $("#img-perfil-subida").val() !== null){//verificamos que haya ingresado una imagen
        var f = $(this);
		var formData = new FormData(document.getElementById("form_img"));//obtenemos una referencia al formulario con formData
		formData.append("img", "valor");
		//formData.append(f.attr("name"), $(this)[0].files[0]);
		$("#subirImagenPerfil").remove();
		$("#subiendo-img-perfil").show();
		$.ajax({//enviamos la imagen al servidor por ajax
			url: RUTA_SERVIDOR+"configuraciones/imagenPerfil.php",//url del servidor
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		}).done(function(res){//cuando ya este listo
			$("#respuestas-servidor").html("");
			$("#subiendo-img-perfil").hide();
			$("#respuestas-servidor").html(res);//ponemos la respuesta del servidor en el documeto
            console.log("Envio la imagen, esto recibio:\n" + res);

        });//fin del done
	}else{
		console.log("Esta vacia la imagen");
	}
});




/*
	Esta funcion es para cuando el usuario cambie su nombre de usuario en la app, aque se manda al servidor para que se actualice alla
*/
function cambiarNombrePHP(nombre){
	console.log("Llego");
	if(nombre !== "" && nombre != NaN){
		if(cumpleTallaMaxima(nombre, 30)){
			if(cumpleTalla(nombre, 5)){
				le = darLenguaje();
			
				$.ajax({
					url: RUTA_SERVIDOR+"configuraciones/editarDatos.php",//url del servidor
					type: "post",
					data:{edit1:nombre, edit2:le, edit3:"1"},
				}).done(function(res){//cuando ya este listo
					$("#informaciones-configuraciones > label").html("");
					$("#informaciones-configaraciones > label").html(res);
					console.log("Se ha cambiado el nombre : " + res);
					$("#informaciones-configaraciones").fadeIn(1500, function(){setTimeout(function(){$("#informaciones-configaraciones").fadeOut(2000)}, 2000);});
					
				});//fin del done
			}else{
				alert("El nombre debe tener por lo menos 5 caracteres")
			}
		}else{
			alert("Ingresa un nombreque no supere el limite de caracteres");
		}
	}else{
		console.log("No ha ingresado un nombre");
	}
}


/**
Estafunciones para cerrar la sesion en el servidor
*/
function cerrarSesion(){
    $.ajax({
		url: RUTA_SERVIDOR + "configuraciones/cerrarSesion.php",//url del servidor
		type: "post"
	}).done(function(res){//cuando ya este listo
		$("#respuestas-servidor").html("");
		console.log(res)
		$("#respuestas-servidor").html(res);//ponemos la respuesta del servidor en el documeto
        //console.log("Cerrar la sesion, esto recibio:\n" + res);
	});//fin del done
}