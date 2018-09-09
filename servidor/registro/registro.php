<?php

    require_once '../bdacceso/Registro.php';
    
    require_once '../funciones/tieneInyeccion.php';
    require_once '../funciones/verificacionDatos.php';
    require_once '../funciones/manejodatos.php';
    
    
    
    
    
    //Verificamos los datos enviados por el usuario
    $dato1 = addslashes($_POST["dato1"]);
    $dato2 = addslashes($_POST["dato2"]);
    $dato3 = addslashes($_POST["dato3"]);
    $dato4 = addslashes($_POST["dato4"]);
    $dato5 = addslashes($_POST["dato5"]);
    $dato6 = addslashes($_POST["dato6"]);
    
    //Volvemos a verificamos los datos enviados por el usuario
    $dato1 = mysql_real_escape_string($dato1);
    $dato2 = mysql_real_escape_string($dato2);
    $dato3 = mysql_real_escape_string($dato3);
    $dato4 = mysql_real_escape_string($dato4);
    $dato5 = mysql_real_escape_string($dato5);
    $dato6 = mysql_real_escape_string($dato6);
    
    //Llamamos a esta funcion para saber si los datos recibidos desde el usuario son maliciosos
    if(
            noTieneInyeccionSQL( $dato1 ) == true &&
            noTieneInyeccionSQL( $dato2 ) == true &&
            noTieneInyeccionSQL( $dato3 ) == true &&
            noTieneInyeccionSQL( $dato4 ) == true &&
            noTieneInyeccionSQL( $dato5 ) == true &&
            noTieneInyeccionSQL( $dato6 ) == true
    ){
        
        //El correo electronico del usuario enviado desde la app
        $post_correo_usuario_nuevo = $dato1;
        
        //Tomamos el pais del usuario
        $post_pais_del_usuario = $dato2;
        
        //El numero telefonico del usuario
        $post_numero_telefono = $dato3;
                
        //Tomamos la contraseña enviada de manera encriptada desde la app
        $post_contra_encriptada = $dato4;
        
        //Lenguaje establecido por el usuario en la app
        $post_lenguaje_usuario_nuevo = $dato5;
        
        //Recibimos la opcion escogida para registrarse
        $post_opcion_escogida_para_registro = $dato6;
        
                
        //Primeramente comprobamos la variable lenguaje, si es texto y si cumple la talla
        if(esTexto($post_lenguaje_usuario_nuevo) == true && tieneTallaEspecifica($post_lenguaje_usuario_nuevo, 2)){
            //Variable del idioma
            $lenguaje = new Idiomas($post_lenguaje_usuario_nuevo);

            
            //Ahora comprobamos que el correo no tenga una talla mayor a 25
            //Y que el pais sea texto
            if(tieneTalla($post_correo_usuario_nuevo, 25) == true && esTexto($post_pais_del_usuario)){
                
                //Rectificamos que los demas datos tambien no se pasen de talla
                if(tieneTalla($post_contra_encriptada, 100) == true &&
                        tieneTalla($post_numero_telefono, 20 ) == true &&
                        tieneTalla($post_pais_del_usuario, 25) == true &&
                        tieneTalla($post_opcion_escogida_para_registro, 10) == true
                    ){
                    //Listo, todos los datos estan correctos
                    
                    /*La contraseña recibida la desencriptamos, ya que viene encriptada desde el usuario y la volvemos 
                    a encriptar para guardarla en la base de datos*/
                    $post_contra_encriptada = desencriptarContra($post_contra_encriptada);
                    
                    //Llenamos este array para el manejo de datos
                    $nuevoUsuario = array(
                        "c"=> $post_correo_usuario_nuevo,
                        "t"=> $post_numero_telefono,
                        "p"=> $post_pais_del_usuario,
                        "ps"=> $post_contra_encriptada,
                        "l"=> $post_lenguaje_usuario_nuevo,
                        "r"=> $post_opcion_escogida_para_registro);
                    
                    if($post_opcion_escogida_para_registro == 1 || $post_opcion_escogida_para_registro == "1" || $post_opcion_escogida_para_registro == 2 || $post_opcion_escogida_para_registro == "2"){
                        //Creamos el objeto registro para registrar al usuario
                        $ObjRegistro = new Registro($nuevoUsuario);
                        
                        $ObjRegistro->registrarUsuario();
                        
                        
                    } else {
                        //Si la opcion de registro escogida no corresponde a ninguna establecida, cancelamos el registro
                        echo $lenguaje->reg_opc_esc_no_existe;
                    }
                    
                    
                }else{
                    //Para las ultimas comprobaciones
                    //Codigo aqui...
                    echo $lenguaje->reg_ult_comprobaciones;
                }
                
            } else {
                // Para la comprobacion de que el pais sea texto y el correo tiene la talla correcta
                // Codigo aqui...
                echo $lenguaje->reg_pais_no_tex_cor_sup_talla;
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



?>