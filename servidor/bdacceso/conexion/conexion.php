<?php
    $servidor = "localhost";
    $usuario = "usuario_mylove";
    $base_de_datos = "premylove";
    $contra = "48nfZ9AYVyQwFKPb";

    
    
    $conexionML = mysql_connect($servidor, $usuario, $contra) or die ("No se conecto al servidor: " . mysql_error());

    mysql_select_db ( $base_de_datos, $conexionML) or die ("No se conecto a la base de datos: " . mysql_error());
    
    



?>