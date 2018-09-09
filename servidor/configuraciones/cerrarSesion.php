<?php
session_start();

include ("../bdacceso/Actualizador.php");

if(isset($_SESSION["ID"])){
    $ID = $_SESSION["ID"];



    $actualizador = new Actualizador();
    $actualizador->enlinea($ID, 0);


    echo "<script>
        //alert('cerrar sesion correctamente');
        localStorage.setItem('cus', '');
        localStorage.setItem('dus', '');
        localStorage.setItem('sav', '0');
        localStorage.setItem('img-perfil', '');
        localStorage.setItem('username', '');
        localStorage.setItem('color', '[200,0,0]');
        
        location.href = '../index.html';
        </script>";
        
    //require("../bdacceso/conexion/cerrar.php");
    
    session_destroy();
}else{
    echo "Inicia sesion primero...";
}
?>