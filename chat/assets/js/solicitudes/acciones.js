function SiAceptaMyLove(){
	var id_solicitud = ID_SOLICITUD_ACCION;
	
    ponerPantallaEnviando();

    //Enviamos la accion al servidor
	$.ajax({
        url: RUTA_SERVIDOR + "solicitudes/solicitudes.php",//url del servidor
        type: "post",
        data:{solici1:"10", solici2:lg, solici3:id_solicitud}
    }).done(function(res){//cuando ya este listo
        $("#accion-solicitud-respuesta").html(res);
        $("#img-enviando-datos").fadeOut(700);
        console.log("Envio la accion solicitud tipo 10, esto recibio: \n" + res);
    });
}//Fin de la funcion aceptar como MyLove




/**
    Para cuando el otro usuario la acepte quedemarcado en la friendZone del usuario actual
*/
function SiAceptaFriendZone(){
    var id_solicitud = ID_SOLICITUD_ACCION;

    ponerPantallaEnviando();

    //Enviamos la accion al servidor
    $.ajax({
        url: RUTA_SERVIDOR + "solicitudes/solicitudes.php",//url del servidor
        type: "post",
        data:{solici1:"11", solici2:lg, solici3:id_solicitud}
    }).done(function(res){//cuando ya este listo
        $("#accion-solicitud-respuesta").html(res);
        $("#img-enviando-datos").fadeOut(700);
        console.log("Envio la accion solicitud tipo 11, esto recibio: \n" + res);
    });
}//Fin de la funcion de si acepta es para la friendzone




/**
    Esta funcion es para aceptar una solicitud como su Love
*/
function aceptarMyLove(){
    var id_solicitud = ID_SOLICITUD_ACCION;

    ponerPantallaEnviando();

    //Enviamos la accion al servidor
    $.ajax({
        url: RUTA_SERVIDOR + "solicitudes/solicitudes.php",//url del servidor
        type: "post",
        data:{solici1:"20", solici2:lg, solici3:id_solicitud}
    }).done(function(res){//cuando ya este listo
        $("#accion-solicitud-respuesta").html(res);
        $("#img-enviando-datos").fadeOut(700);
        //$("#cancelar-proceso-2").fadeOut(700);
        console.log("Envio la accion solicitud tipo 20, esto recibio: \n" + res);
    });
}


/**
    Esta funcion es para aceptar una solicitud y enviarlo a la friendZone
*/
function aceptarFriendZone(){
    var id_solicitud = ID_SOLICITUD_ACCION;

    ponerPantallaEnviando();

    //Enviamos la accion al servidor
    $.ajax({
        url: RUTA_SERVIDOR_PERFIL + "solicitudes/solicitudes.php",//url del servidor
        type: "post",
        data:{solici1:"21", solici2:lg, solici3:id_solicitud}
    }).done(function(res){//cuando ya este listo
        $("#accion-solicitud-respuesta").html(res);
        $("#img-enviando-datos").fadeOut(700);
        console.log("Envio la accion solicitud tipo 21, esto recibio: \n" + res);
    });
}

/**
    Esta funcion es para rechazar una solicitud
*/
function rechazar(){
    var id_solicitud = ID_SOLICITUD_ACCION;

    ponerPantallaEnviando();

    //Enviamos la accion al servidor
    $.ajax({
        url: RUTA_SERVIDOR + "solicitudes/solicitudes.php",//url del servidor
        type: "post",
        data:{solici1:"98", solici2:lg, solici3:id_solicitud}
    }).done(function(res){//cuando ya este listo
        $("#accion-solicitud-respuesta").html(res);
        $("#img-enviando-datos").fadeOut(700);
        console.log("Envio la accion solicitud tipo 98, esto recibio: \n" + res);
    });
}


/**
    Esta funcion es para rechazar una solicitud
*/
function rechazarBloquear(){
    var id_solicitud = ID_SOLICITUD_ACCION;

    ponerPantallaEnviando();

    //Enviamos la accion al servidor
    $.ajax({
        url: RUTA_SERVIDOR + "solicitudes/solicitudes.php",//url del servidor
        type: "post",
        data:{solici1:"99", solici2:lg, solici3:id_solicitud}
    }).done(function(res){//cuando ya este listo
        $("#accion-solicitud-respuesta").html(res);
        $("#img-enviando-datos").fadeOut(700);
        console.log("Envio la accion solicitud tipo 99, esto recibio: \n" + res);
    });
}













function ponerPantallaEnviando(){
    if ($("#enviando-datos").hasClass('active')) {
            closeEnviandoDatos();
            $(this).removeClass('active');

    } else {
        $(this).addClass('active');
        setModal("enviando");
        $('#enviando-datos').one('click', '.btn.cancel', function() {
            closeEnviandoDatos();
        });
    }
}