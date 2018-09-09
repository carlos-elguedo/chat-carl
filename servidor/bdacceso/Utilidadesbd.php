<?php



function darCodigoDeAlerta1(){
    return "<div class='modal1'><div class='center1'> ";
}
function darCodigoDeAlerta2(){
    return "</div> </div>";
}

function darCodigoDeAlertaCancelar(){
    return "<br/> <br/> <button id = 'cancel' class='boton-aceptar-cancelar' >Cancelar</button><script> $('#cancel').click(function(eve){eve.preventDefault(); $('#mensajes').html(''); }); </script>";
}

function darCodigoDeAlertaAceptar(){
    return "<br> <br/> <button id = 'cancel' class='boton-aceptar-cancelar' >Aceptar</button><script> $('#cancel').click(function(eve){eve.preventDefault(); location.href='index.html'; }); </script>";
}
function darCodigoDeAlertaAceptarVirgen(){
    return "<br> <br/> <button id = 'cancel' class='boton-aceptar-cancelar' >Aceptar</button>";
}
function darCodigoDeAlertaAceptar_permanecer(){
    return "<br> <br/> <button id = 'cancel' class='boton-aceptar-cancelar' >Aceptar</button><script> $('#cancel').click(function(eve){eve.preventDefault(); $('#mensajes').html(''); }); </script>";
}


?>