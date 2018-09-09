//variable del lenguaje a establecer
var lg;

//Esta variable indica la ruta del servidor
var RUTA_SERVIDOR = "http://localhost/mylove/servidor/";

//Esta variable indica la ruta donde se guardan las imagenes de perfil
var RUTA_SERVIDOR_PERFIL = "http://localhost/mylove/servidor/archivos/imagenesPerfil/";

//Variable para controlar la vista del menu sobre la imagen del otro usuario
var MENU_OTRO = 2;

//Esta variable indicara si el usuario ha escrito algo
var HAESCRITO = false;

//Variable que indicara el estado de conexion del usuario
var CONEXION_INTERNET = false;

//Esta variabe almanecera el id de solicitud para los distintos eventos de solicitudes
var ID_SOLICITUD_ACCION = 0;

//Esta variable indicara que los corazones sobre la pantalla estan activados
var CORAZONES_ACTIVADOS = false;

//Esta variable indicara el numero de notificaciones del usuario
var NUMERO_NOTIFICACIONES = 0;

//Esta variable indcara que el usuario puede pedir una solicitud nueva al servidor, si es true puede, si es false, ya esta procesando una
var PUEDE_PEDIR_EVENTOS = true;

//Esta variable indicara el id de la relacion en cuestion
var ID_RELACION_ACCION = 0;

//esta variable indica la posision del mensaje actual que vera el usuario
var POSICION_MENSAJES_ACTUAL = "";

//Contadores y controladores para los eventos de escribiendo
var NUMERO_CARACTERES_ESCRITOS = 0;

var ESCRIBIENDO = new Array();
ESCRIBIENDO.mensajes_mylove = false;
ESCRIBIENDO.mensajes_friendzone_1 = false;
ESCRIBIENDO.mensajes_friendzone_2 = false;
ESCRIBIENDO.mensajes_friendzone_3 = false;
ESCRIBIENDO.mensajes_friendzone_4 = false;
ESCRIBIENDO.mensajes_friendzone_5 = false;
ESCRIBIENDO.mensajes_friendzone_6 = false;
ESCRIBIENDO.mensajes_friendzone_7 = false;

//Esta variable sera el texto del mensaje que se enviara al servidor
var TEXTO_MENSAJE = "";

//eSTA VARIABLE INDICARA EL CHAT EN EL CUAL SE ENCUENTRA EL usuario
var DIVISION_MENSAJES_ACTUAL = "";
var ID_RELACION_MENSAJE_CHAT = "";