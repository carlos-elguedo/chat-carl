/**
 * Este archivo es el encargado de establecer los textos en la aplicacion con el idioma previamente establecido
 * El objeto MyLove, es el que contiene los texto de la app
 * Este objeto maneja los diferentes textos como sus propiedades
 */
var MyLove = new Array();
    MyLove.titulo = "";

    MyLove.acceso_usuario = "";
    MyLove.acceso_contra = "";
    MyLove.acceso_boton = "";
    MyLove.acceso_registrar = "";
    MyLove.acceso_olvpass = "";
    MyLove.acceso_activacion = "";

    MyLove.registro_correo = "";
    MyLove.registro_pais_1 = "";
    MyLove.registro_telefono = "";
    MyLove.registro_contra = "";
    MyLove.registro_aceptar_terminos = "";
    MyLove.registro_leer_terminos = "";
    MyLove.registro_boton = "";
    MyLove.registro_volver_atras = "";

    MyLove.activacion_1_info_1 = "";
    MyLove.activacion_1_info_2 = "";
    MyLove.activacion_1_lab_codigo = "";
    MyLove.activacion_1_boton_enviar = "";
    MyLove.activacion_1_boton_reenviar = "";
    MyLove.activacion_1_boton_cancelar = "";

    MyLove.activacion_2_info_1 = "";
    MyLove.activacion_2_info_2 = "";
    MyLove.activacion_2_info_3 = "";
    MyLove.activacion_2_lab_forma_activacion = "";
    MyLove.activacion_2_enviar_forma = "";
    MyLove.activacion_2_candelar = "";



/**
 * Esta funcion da el idioma a la variable MyLove que manejara y establecera los textos de la aplicacion llamando a otra funcion
 * recibe el idioma a establecer
 */

function establecerIdioma(idioma){
    //Aqui manejamos el idioma recibido para instanciar las propiedades de la variable que contiene los texts de la app
    switch(idioma){
        //En caso de que el idioma recibido por esta funcion sea es, español, se instancian las variables con el texto en español
        case "es":
            MyLove.titulo = "My love - Acceso";
            MyLove.acceso_usuario = "Número de teléfono o correo:";
            MyLove.acceso_contra = "Contraseña:";
            MyLove.acceso_boton = "Ingresar";
            MyLove.acceso_registrar = "Registrarme";
            MyLove.acceso_olvpass = "Olvide mi contraseña";
            MyLove.acceso_activacion = "Activar mi cuenta";

            MyLove.registro_info_1 = "Selecciona un metodo para registrarte";
            MyLove.registro_opcion_correo = "Crear cuenta usando correo";
            MyLove.registro_opcion_telefono = "Crear cuenta usando teléfono";
            MyLove.registro_correo = "Correo:";
            MyLove.registro_pais_1 = "Selecciona tu pais";
            MyLove.registro_telefono = "Tu teléfono:";
            MyLove.registro_contra = "Contraseña";
            MyLove.registro_aceptar_terminos = "Acepto los Terminos y Condiciones";
            MyLove.registro_leer_terminos = "Leer los terminos";
            MyLove.registro_boton = "Enviar";
            MyLove.registro_volver_atras = "Volver atrás";

            MyLove.activacion_1_info_1 = "Listo, solo un paso más...";
            MyLove.activacion_1_info_2 = "Hemos enviado un codigo de activación al ";
            MyLove.activacion_1_lab_codigo = "Escribe el código aquí";
            MyLove.activacion_1_boton_enviar = "Enviar";
            MyLove.activacion_1_boton_reenviar = "Reenviar codigo";
            MyLove.activacion_1_boton_cancelar = "Cancelar";

            MyLove.activacion_2_info_1 = "Activar cuenta";
            MyLove.activacion_2_info_2 = "Si ya habias realizado el registro pero no has activado aún, por favor sigue esta instrucciones";
            MyLove.activacion_2_info_3 = "Ingresa el dato que usastes para registrarte";
            MyLove.activacion_2_lab_forma_activacion = "Correo o numero telefonico";
            MyLove.activacion_2_enviar_forma = "Verificar";
            MyLove.activacion_2_candelar = "Cancelar";
            //Se llama a esta funcion para que establesca los textos de la app
            establecerTextos();
            break;

        //En caso de que el idioma recibido por esta funcion sea en, ingles, se instancian las variables con el texto en ingles
        case "en":
            MyLove.titulo = "My Love - Access";   
            MyLove.acceso_usuario = "Number of phone or email";
            MyLove.acceso_contra = "Password";
            MyLove.acceso_boton = "Enter";
            MyLove.acceso_registrar = "Register";
            MyLove.acceso_olvpass = "Forget my password";
            MyLove.acceso_activacion = "Activate my account";

            MyLove.registro_info_1 = "Select a method for register";//-------------------------------------
            MyLove.registro_opcion_correo = "Email";
            MyLove.registro_opcion_telefono = "Phone";
            MyLove.registro_correo = "Email";
            MyLove.registro_pais_1 = "Select your country";
            MyLove.registro_telefono = "Your phone";
            MyLove.registro_contra = "Password";
            MyLove.registro_aceptar_terminos = "I accept the Terms and Conditions";
            MyLove.registro_leer_terminos = "Read the terms";
            MyLove.registro_boton = "Send";
            MyLove.registro_volver_atras = "Go back";

            //Exito...
            MyLove.activacion_1_info_1 = "Ok, only one step more...";
            MyLove.activacion_1_info_2 = "We'll send the code activation at the";
            MyLove.activacion_1_lab_codigo = "Write code here";
            MyLove.activacion_1_boton_enviar = "Send";
            MyLove.activacion_1_boton_reenviar = "resend the code";
            MyLove.activacion_1_boton_cancelar = "Cancel";

            MyLove.activacion_2_info_1 = "Activate account";
            MyLove.activacion_2_info_2 = "If you will register process, but not activate account, let's follows the instruction";
            MyLove.activacion_2_info_3 = "Get date you will for register";
            MyLove.activacion_2_lab_forma_activacion = "Number of phone or email";
            MyLove.activacion_2_enviar_forma = "Verificate";
            MyLove.activacion_2_candelar = "Cancel";
            //Se llama a esta funcion para que establesca los textos de la app
            establecerTextos();
            break;
        //En caso de que el idioma recibido sea distintos a las opciones del switch, se establecera el idioma ingles como por defecto de
        //la aplicacion, esto para hacerla universal
        default:
            MyLove.titulo = "My Love - Access";
            MyLove.acceso_usuario = "Number of phone or email";
            MyLove.acceso_contra = "Password";
            MyLove.acceso_boton = "Enter";
            MyLove.acceso_registrar = "Register";
            MyLove.acceso_olvpass = "Forget my password";
            MyLove.acceso_activacion = "Activate my account";

            MyLove.registro_info_1 = "Select a method for register";//------------------
            MyLove.registro_opcion_correo = "Email";
            MyLove.registro_opcion_telefono = "Phone";
            MyLove.registro_correo = "Email";
            MyLove.registro_pais_1 = "Select your country";
            MyLove.registro_telefono = "Your phone";
            MyLove.registro_contra = "Password";
            MyLove.registro_aceptar_terminos = "I accept the Terms and Conditions";
            MyLove.registro_leer_terminos = "Read the terms";
            MyLove.registro_boton = "Send";
            MyLove.registro_volver_atras = "Go back";

            //Exito...
            MyLove.activacion_1_info_1 = "Ok, only one step more...";
            MyLove.activacion_1_info_2 = "We'll send the code activation at the";
            MyLove.activacion_1_lab_codigo = "Write code here";
            MyLove.activacion_1_boton_enviar = "Send";
            MyLove.activacion_1_boton_reenviar = "resend the code";
            MyLove.activacion_1_boton_cancelar = "Cancel";

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

    //Para los elementos del login
    document.getElementById("lab-acceso-nombre").innerHTML = MyLove.acceso_usuario;
    document.getElementById("lab-acceso-contra").innerHTML = MyLove.acceso_contra;
    document.getElementById("btn-submit-inicio-sesion").value = MyLove.acceso_boton;
    document.getElementById("lab-acceso-olvido").innerHTML = MyLove.acceso_olvpass;
    document.getElementById("lab-acceso-activar").innerHTML = MyLove.acceso_activacion;
    document.getElementById("btn-registrarse").innerHTML = MyLove.acceso_registrar;
    
    //Para los elementos del registro
    document.getElementById("registrar-usando-opcion-1").innerHTML = MyLove.registro_info_1;
    document.getElementById("registrar-usando-opcion-2").innerHTML = MyLove.registro_opcion_correo;
    document.getElementById("registrar-usando-opcion-3").innerHTML = MyLove.registro_opcion_telefono;

    document.getElementById("lab-registro-correo").innerHTML = MyLove.registro_correo;
    document.getElementById("pais-primero").value = MyLove.registro_pais_1;
    document.getElementById("pais-primero").innerHTML = MyLove.registro_pais_1;
    document.getElementById("lab-registro-telefono").innerHTML = MyLove.registro_telefono;
    document.getElementById("lab-registro-contra").innerHTML = MyLove.registro_contra;
    document.getElementById("lab-registro-terminos").innerHTML = MyLove.registro_aceptar_terminos;
    document.getElementById("lab-registro-leer-terminos").innerHTML = MyLove.registro_leer_terminos;
    document.getElementById("btn-submit-registro").value = MyLove.registro_boton;
    document.getElementById("btn-salir-registro").innerHTML = MyLove.registro_volver_atras;

    document.getElementById("activacion_info_1_1").innerHTML = MyLove.activacion_1_info_1;
    document.getElementById("activacion_info_2_1").innerHTML = MyLove.activacion_1_info_2;    
    $("#activacion_codigo").prop("placeholder", "" + MyLove.activacion_1_lab_codigo);
    document.getElementById("btn-submit-enviar-codigo-1").value = MyLove.activacion_1_boton_enviar;
    document.getElementById("btn-activacion-reenviar-codigo-1").innerHTML = MyLove.activacion_1_boton_reenviar;
    document.getElementById("btn-activacion-cancelar-activacion-1").innerHTML = MyLove.activacion_1_boton_cancelar;

    document.getElementById("activacion_info_1_2").innerHTML = MyLove.activacion_2_info_1;
    document.getElementById("activacion_info_2_2").innerHTML = MyLove.activacion_2_info_2;
    document.getElementById("activacion_info_3_2").innerHTML = MyLove.activacion_2_info_3;
    $("#activacion_forma_que_uso").prop("placeholder", "" + MyLove.activacion_2_lab_forma_activacion);
    document.getElementById("btn-submit-enviar-forma-activacion-2").value = MyLove.activacion_2_enviar_forma;
    document.getElementById("btn-activacion-cancelar-activacion-2").innerHTML = MyLove.activacion_2_candelar;

    

}//Fin de la fincion establecerTextos