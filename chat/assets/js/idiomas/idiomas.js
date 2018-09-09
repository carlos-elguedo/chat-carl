/**
 * Este archivo es el encargado de establecer los textos en la aplicacion con el idioma previamente establecido
 * El objeto MyLove, es el que contiene los texto de la app
 * Este objeto maneja los diferentes textos como sus propiedades
 */
var MyLove = new Array();

    //Definimos las propiedades del objeto idioma
    MyLove.titulo = "";

    MyLove.cancelar = "";
    MyLove.aceptar = "";

    MyLove.barra_lateral_opcion1 = "";
    MyLove.barra_lateral_opcion2 = "";
    MyLove.barra_lateral_opcion3 = "";
    MyLove.barra_lateral_opcion4 = "";

    MyLove.opc_config_titulo = "";
    MyLove.opc_config_opc_1 = "";
    MyLove.opc_config_opc_2 = "";
    MyLove.opc_config_opc_3 = "";

    MyLove.mensaje_texto = "";
    
    MyLove.enviar_solicitud_titulo = "";
    MyLove.enviar_solicitud_descripcion = "";
    MyLove.enviar_solicitud_opcion1 = "";
    MyLove.enviar_solicitud_opcion2 = "";
    MyLove.enviar_solicitud_opcion3 = "";
    MyLove.enviar_solicitud_enviada_esc_accion = "";
    MyLove.enviar_solicitud_cancelar = "";
    MyLove.enviar_solicitud = "";

    MyLove.cuenta_cambiar_img_perfil = "";
    MyLove.cuenta_opc_1 = "";
    MyLove.cuenta_opc_2 = "";
    MyLove.cuenta_opc_3 = "";
    MyLove.cuenta_opc_4 = "";

    MyLove.configuraciones_titulo = "";
    MyLove.configuraciones_descripcion = "";
    MyLove.configuraciones_opcion1 = "";
    MyLove.configuraciones_opcion2 = "";
    MyLove.configuraciones_opcion3 = "";
    MyLove.configuraciones_opcion4 = "";
    MyLove.configuraciones_opcion5 = "";
    MyLove.configuraciones_opcion6 = "";


    MyLove.nombre_usuario_no_definido = "";
    

/**
 * Esta funcion da el idioma a la variable MyLove que manejara y establecera los textos de la aplicacion llamando a otra funcion
 * recibe el idioma a establecer
 */

function establecerIdioma(idioma){
    //Aqui manejamos el idioma recibido para instanciar las propiedades de la variable que contiene los texts de la app
    switch(idioma){
        //En caso de que el idioma recibido por esta funcion sea es, español, se instancian las variables con el texto en español
        case "es":
            MyLove.titulo = "Chat";

            MyLove.cancelar = "Cancelar";
            MyLove.aceptar = "Aceptar";
            
            MyLove.barra_lateral_opcion1 = "Mylove";
            MyLove.barra_lateral_opcion2 = "Perfil";
            MyLove.barra_lateral_opcion3 = "Configuraciones";
            MyLove.barra_lateral_opcion4 = "Acerca de Mylove";

            MyLove.opc_cuenta_opc_1 = "Tu nombre:";

            MyLove.opc_config_titulo = "Configura tu aplicación";
            MyLove.opc_config_opc_1 = "Color";
            MyLove.opc_config_opc_2 = "Imagen de fondo";
            MyLove.opc_config_opc_3 = "Fuente";

            MyLove.mensaje_texto = "...";
            
            MyLove.enviar_solicitud_titulo = "Enviar una solicitud";
            MyLove.enviar_solicitud_descripcion = "Escoge el telefono, correo o codigo del otro usuario";
            MyLove.enviar_solicitud_opcion1 = "Correo eléctronico";
            MyLove.enviar_solicitud_opcion2 = "Numero telefonico";
            MyLove.enviar_solicitud_opcion3 = "Codigo";
            MyLove.enviar_solicitud_enviada_esc_accion = "La solicitud se ha enviado, presiona sobre ella para lo que quieres hacer cuando la respondan positivamente";
            MyLove.enviar_solicitud_cancelar = "Cancelar";
            MyLove.enviar_solicitud = "Enviar";

            MyLove.cuenta_cambiar_img_perfil = "Cambiar imagen";
            MyLove.cuenta_opc_1 = "cuenta opcion 1";
            MyLove.cuenta_opc_2 = "cuenta opcion 2";
            MyLove.cuenta_opc_3 = "cuenta opcion 3";
            MyLove.cuenta_opc_4 = "Cerrar sesion";

            MyLove.configuraciones_titulo = "Perzonaliza tu aplicación";
            MyLove.configuraciones_descripcion = "Por favor escoge lo que quieres cambiar, es muy simple, escoge y sigue los pasos para tener la aplicacion como mas te guste";
            MyLove.configuraciones_opcion1 = "Estilos";
            MyLove.configuraciones_opcion2 = "Opcion 2";
            MyLove.configuraciones_opcion3 = "Opcion 3";
            MyLove.configuraciones_opcion4 = "Opcion 4";
            MyLove.configuraciones_opcion5 = "Opcion 5";
            MyLove.configuraciones_opcion6 = "Tipo de aplicación";

            MyLove.nombre_usuario_no_definido = "No has ingresado correctamente...";

            //Se llama a esta funcion para que establesca los textos de la app
            establecerTextos();
            break;

        //En caso de que el idioma recibido por esta funcion sea en, ingles, se instancian las variables con el texto en ingles
        case "en":
            MyLove.titulo = "My Love"; 

            MyLove.cancelar = "Cancel";  
            MyLove.aceptar = "Acept";
            
            MyLove.barra_lateral_opcion1 = "My Love";
            MyLove.barra_lateral_opcion2 = "Your perfil";
            MyLove.barra_lateral_opcion3 = "Set up";
            MyLove.barra_lateral_opcion4 = "About MyLove";

            MyLove.mensaje_texto = "...";
            
            MyLove.enviar_solicitud_titulo = "Send a request";
            MyLove.enviar_solicitud_descripcion = "If the user you want send request used MyLove, chosen his bind date: email, number phone or code";
            MyLove.enviar_solicitud_opcion1 = "Email";
            MyLove.enviar_solicitud_opcion2 = "Nomber phone";
            MyLove.enviar_solicitud_opcion3 = "Code";
            MyLove.enviar_solicitud_enviada_esc_accion = "The request has been send, chosse your want for accept positivamente exitoo";
            MyLove.enviar_solicitud_cancelar = "Cancel";
            MyLove.enviar_solicitud = "Send";

            MyLove.cuenta_cambiar_img_perfil = "Change your picture";
            MyLove.cuenta_opc_1 = "account option 1";
            MyLove.cuenta_opc_2 = "account option 2";
            MyLove.cuenta_opc_3 = "account option 3";
            MyLove.cuenta_opc_4 = "lagout";

            MyLove.configuraciones_titulo = "Customize your app";
            MyLove.configuraciones_descripcion = "Chosse it you want change, is very simple, follow the step and give the app how you like... Exito!!!";
            MyLove.configuraciones_opcion1 = "Styles";
            MyLove.configuraciones_opcion2 = "Option 2";
            MyLove.configuraciones_opcion3 = "Option 3";
            MyLove.configuraciones_opcion4 = "Option 4";
            MyLove.configuraciones_opcion5 = "Option 5";
            MyLove.configuraciones_opcion6 = "Bind of app";

            MyLove.nombre_usuario_no_definido = "Your don't login...";

            //Se llama a esta funcion para que establesca los textos de la app
            establecerTextos();
            break;
        //En caso de que el idioma recibido sea distintos a las opciones del switch, se establecera el idioma ingles como por defecto de
        //la aplicacion, esto para hacerla universal
        default:
            MyLove.titulo = "My Love";

            MyLove.cancelar = "Cancel";
            MyLove.aceptar = "Acept";

            MyLove.barra_lateral_opcion1 = "My Love";
            MyLove.barra_lateral_opcion2 = "Your perfil";
            MyLove.barra_lateral_opcion3 = "Set up";
            MyLove.barra_lateral_opcion4 = "About MyLove";

            MyLove.mensaje_texto = "...";

            MyLove.enviar_solicitud_titulo = "Send a request";
            MyLove.enviar_solicitud_descripcion = "If the user you want send request used MyLove, chosen his bind date: email, number phone or code";
            MyLove.enviar_solicitud_opcion1 = "Email";
            MyLove.enviar_solicitud_opcion2 = "Nomber phone";
            MyLove.enviar_solicitud_opcion3 = "Code";
            MyLove.enviar_solicitud_enviada_esc_accion = "The request has been send, chosse your want for accept positivamente exitoo";
            MyLove.enviar_solicitud_cancelar = "Cancel";
            MyLove.enviar_solicitud = "Send";

            MyLove.cuenta_cambiar_img_perfil = "Change your picture";
            MyLove.cuenta_opc_1 = "account option 1";
            MyLove.cuenta_opc_2 = "account option 2";
            MyLove.cuenta_opc_3 = "account option 3";
            MyLove.cuenta_opc_4 = "lagout";

            MyLove.configuraciones_titulo = "Customize your app";
            MyLove.configuraciones_descripcion = "Chosse it you want change, is very simple, follow the step and give the app how you like... Exito!!!";
            MyLove.configuraciones_opcion1 = "Styles";
            MyLove.configuraciones_opcion2 = "Option 2";
            MyLove.configuraciones_opcion3 = "Option 3";
            MyLove.configuraciones_opcion4 = "Option 4";
            MyLove.configuraciones_opcion5 = "Option 5";
            MyLove.configuraciones_opcion6 = "Bind of app";


            MyLove.nombre_usuario_no_definido = "Your don't login...";
            
            //Se llama a esta funcion para que establesca los textos de la app
            establecerTextos();
            break;
    }
}//Fin de la funcion establecerIdioma

/**
 * Esta funcion establece los texto en la app, con ayuda de la variable MyLove previamente establecida
 */
function establecerTextos(){
    //Empezamos a establecer el idioma en los elementos de la aplicación
    
    //Para el titulo de la pagina
    document.getElementById("titulo-pagina").innerHTML = MyLove.titulo;

    //Para los botones de cancelar
    document.getElementById("cancelar-proceso-1").innerHTML = MyLove.cancelar;
    document.getElementById("cancelar-proceso-2").innerHTML = MyLove.cancelar;
    document.getElementById("cancelar-proceso-3").innerHTML = MyLove.cancelar;
    document.getElementById("aceptar-alerta").innerHTML = MyLove.aceptar;

    //Para la barra lateral
	document.getElementById("barra-opc-1").innerHTML = MyLove.barra_lateral_opcion1;
	document.getElementById("barra-opc-2").innerHTML = MyLove.barra_lateral_opcion2;
	document.getElementById("barra-opc-3").innerHTML = MyLove.barra_lateral_opcion3;
	document.getElementById("barra-opc-4").innerHTML = MyLove.barra_lateral_opcion4;
        
    document.getElementById("lab-solicitud-titulo").innerHTML = MyLove.enviar_solicitud_titulo;
    document.getElementById("lab-solicitud-descripcion").innerHTML = MyLove.enviar_solicitud_descripcion;
    document.getElementById("envsolval1").innerHTML = MyLove.enviar_solicitud_opcion1;
    document.getElementById("envsolval2").innerHTML = MyLove.enviar_solicitud_opcion2;
    document.getElementById("envsolval3").innerHTML = MyLove.enviar_solicitud_opcion3;
    document.getElementById("solicitud-enviada-escoger-accion").innerHTML = MyLove.enviar_solicitud_enviada_esc_accion;
    document.getElementById("envsolbotcancel").innerHTML = MyLove.enviar_solicitud_cancelar;
    document.getElementById("envsolbotenviar").innerHTML = MyLove.enviar_solicitud;

    document.getElementById("cambiar-foto-perfil").innerHTML = MyLove.cuenta_cambiar_img_perfil;
    document.getElementById("cuenta-opc-1").innerHTML = MyLove.cuenta_opc_1;
    document.getElementById("cuenta-opc-2").innerHTML = MyLove.cuenta_opc_2;
    document.getElementById("cuenta-opc-3").innerHTML = MyLove.cuenta_opc_3;
    document.getElementById("cuenta-opc-4").innerHTML = MyLove.cuenta_opc_4;

    document.getElementById("opc-titulo-config").innerHTML = MyLove.configuraciones_titulo;
    document.getElementById("opc-descrip-config").innerHTML = MyLove.configuraciones_descripcion;
    document.getElementById("opc-conf-opc-1").innerHTML = MyLove.configuraciones_opcion1;
    document.getElementById("opc-conf-opc-2").innerHTML = MyLove.configuraciones_opcion2;
    document.getElementById("opc-conf-opc-3").innerHTML = MyLove.configuraciones_opcion3;
    document.getElementById("opc-conf-opc-4").innerHTML = MyLove.configuraciones_opcion4;
    document.getElementById("opc-conf-opc-5").innerHTML = MyLove.configuraciones_opcion5;
    document.getElementById("opc-conf-opc-6").innerHTML = MyLove.configuraciones_opcion6;
        

	document.getElementById("area_de_texto").innerHTML = MyLove.mensaje_texto;

    
}//Fin de la fincion establecerTextos