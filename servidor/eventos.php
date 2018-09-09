<?php

session_start();

include ("bdacceso/Evento.php");

if(isset($_SESSION["ID"])){
    $ID = $_SESSION["ID"];
    
    $evento = new Evento();
    $eventos = $evento->getEvento($ID);
    if($eventos == true){
        $dato = $eventos["dato"];
        $tipo = $eventos["tipo"];
         
        echo "<script>";
        echo "PUEDE_PEDIR_EVENTOS = false;";
        if($tipo == 11 || $tipo == 12 || $tipo == 13){
            //Si es un evento de solicitud que requiere actualizar el valor del id de solicitud del usuario...
            echo "ID_SOLICITUD_ACCION = ". $dato . ";";
        }
        echo "procesarEvento(". $tipo . ")";
        echo "</script>";
    }    


}else{
    echo "<script>";
    echo "PUEDE_PEDIR_EVENTOS = false;";
    echo "</script>"; 
}
?>