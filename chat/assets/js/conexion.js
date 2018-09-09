var socket = io("ws://localhost:8888");

var suyo = false;




//Enviar un mensaje tipo texto PRINCIPAL
$("#ENVIAR").click(function(eve){

	var t = $('#area_de_texto').html();

	socket.emit('chat message', t);



});





socket.on('connect', function () {
	console.log("Conectado Satisfactoriamente");
});


socket.on('connecting', function () {
	console.log("Conectando...");
});


socket.on('disconnect', function () {
	console.log("Desconectado del servidor");
});

socket.on('connect_failed', function () {
	console.log("La conecion ha fallado");
});

socket.on('error', function (data) {
	console.log("Ha ocurrido un error, MayDey MayDey: " + data.code);
});

socket.on('message', function (data) {
	console.log("Nuevo mensaje: " + data);
});





//Este metodo es para cuando el usuario actual reciba un nuevo mensaje desde el servidor
socket.on('mensaje', function(msg){

});

//Este metodo es para cuando el tipo de evento sea una notificacion
socket.on('notificacion', function(msg){
	
});

//Este evento es para cuando el usuario reciba una solicitud
socket.on('solicitud', function(msg){

});

//Cuando se produce un evento de juego
socket.on('juego', function(msg){

});


//Cuando se produce un evento de actualizacon de un mensaje del usuario actual (visto, entregado etc)
socket.on('datos-mensaje', function(msg){

});