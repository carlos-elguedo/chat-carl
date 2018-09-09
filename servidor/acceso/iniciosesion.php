<?php

require_once '../bdacceso/InicioSesion.php';
require_once '../funciones/tieneInyeccion.php';
require_once '../funciones/verificacionDatos.php';
require_once '../funciones/manejodatos.php';


if(isset($_POST["acceso1"]) && isset($_POST["acceso2"]) && isset($_POST["acceso3"])){
$dato1 = addslashes($_POST["acceso1"]);
$dato2 = addslashes($_POST["acceso2"]);
$dato3 = addslashes($_POST["acceso3"]);


//Volvemos a verificamos los datos enviados por el usuario
$dato1 = mysql_real_escape_string($dato1);
$dato2 = mysql_real_escape_string($dato2);
$dato3 = mysql_real_escape_string($dato3);



if(
            noTieneInyeccionSQL( $dato1 ) == true &&
            noTieneInyeccionSQL( $dato2 ) == true &&
            noTieneInyeccionSQL( $dato3 ) == true 
){
    
    //Empezamos a tomar los datos recibidos en variables
    //El identificador de acceso, el correo o el telefono
    $post_forma_acceso = $dato1;
    
    //La contrase�a, recibida difrada desde el cliente
    $post_contra_acceso = $dato2;
    
    //Lenguaje establecido por el usuario en la app
    $post_lenguaje_usuario = $dato3;
    
    //Primeramente comprobamos la variable lenguaje, si es texto y si cumple la talla
    if(esTexto($post_lenguaje_usuario) == true && tieneTallaEspecifica($post_lenguaje_usuario, 2)){
        //Definimos el obejeto del idioma
        $lenguaje = new Idiomas($post_lenguaje_usuario);
        
        if(tieneTalla($post_contra_acceso, 100) == true){
            if(tieneTalla($post_forma_acceso, 25) == true){
                
                //Listo, todo normal
                
                /*La contrase�a recibida la desencriptamos, ya que viene encriptada desde el usuario y la volvemos 
                a encriptar para guardarla en la base de datos*/
                $post_contra_acceso = desencriptarContra($post_contra_acceso);
                
                //Llenamos este array para el manejo de datos de la iniciada de sesion
                $usuario = array(
                        "a"=> $post_forma_acceso,
                        "c"=> $post_contra_acceso,
                        "l"=> $post_lenguaje_usuario);
                
                //Creamos este objeto inicio sesion del usuari, pasandole los datos recibidos                        
                $objInicioSesion = new InicioSesion($usuario);
                
                //Llamamos a este metodo que se encarga de terminar la tarea de iniciar sesion
                $objInicioSesion->iniciarSesion();
                
                
            }else{
                //El correo suppera la talla
                echo $lenguaje->ini_corr_o_tele_sup_talla;
            }
        }else{
            //La contrase�a recibida supera la talla
            echo $lenguaje->ini_cont_sup_talla;
        } 
    
    }else{
        //Para el llenguaje recibido supera la talla Codigo...
        $leng = new Idiomas();
        echo $leng->reg_idi_sup_talla;
    }
    
    
    
    
    
    
    
    
    
    
}//Fin de la funcion primera que evita las inyecciones sql desde la funcion en el archivo 'tieneInyeccion.php'
else{
    $leng = new Idiomas();
    echo $leng->reg_no_pas_inyecctiones;
}
}else{
    echo "Que paso amiguito...";
}

?>