-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2017 a las 03:09:43
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `premylove`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE IF NOT EXISTS `configuraciones` (
  `id_cofigracion` bigint(20) NOT NULL,
  `id_persona` bigint(20) DEFAULT NULL,
  `lenguaje` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id_cofigracion`, `id_persona`, `lenguaje`) VALUES
(1, 18, 'es'),
(2, 19, 'es'),
(3, 20, 'es'),
(4, 21, 'es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlinea`
--

CREATE TABLE IF NOT EXISTS `enlinea` (
  `id_enlinea` bigint(20) NOT NULL,
  `id_persona` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enlinea`
--

INSERT INTO `enlinea` (`id_enlinea`, `id_persona`, `estado`, `ip`) VALUES
(2, 17, 0, NULL),
(3, 18, 0, NULL),
(4, 19, 0, NULL),
(5, 20, 0, NULL),
(6, 21, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` bigint(40) NOT NULL,
  `id_persona` bigint(20) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `dato` bigint(20) NOT NULL,
  `tabla` varchar(140) NOT NULL,
  `dato_2` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_persona`, `tipo`, `estado`, `dato`, `tabla`, `dato_2`) VALUES
(1, 19, 20, 0, 15, '', 0),
(2, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(3, 20, 20, 0, 15, '', 0),
(4, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(5, 20, 20, 0, 15, '', 0),
(6, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(7, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(8, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(9, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(10, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(11, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(12, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(13, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(14, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(15, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(16, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(17, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(18, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(19, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(20, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(21, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(22, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(23, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(24, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(25, 19, 20, 0, 15, '', 0),
(26, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(27, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(28, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(29, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(30, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(31, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(32, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(33, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(34, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(35, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(36, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(37, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(38, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(39, 19, 22, 0, 36, 'zmensajes_20_19', 0),
(40, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(41, 20, 22, 0, 37, 'zmensajes_20_19', 0),
(42, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(43, 20, 22, 0, 38, 'zmensajes_20_19', 0),
(44, 19, 21, 0, 15, 'zmensajes_20_19', 0),
(45, 20, 22, 0, 39, 'zmensajes_20_19', 0),
(46, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(47, 19, 22, 0, 40, 'zmensajes_20_19', 15),
(48, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(49, 19, 22, 0, 41, 'zmensajes_20_19', 15),
(50, 20, 21, 0, 15, 'zmensajes_20_19', 0),
(51, 19, 22, 0, 42, 'zmensajes_20_19', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friendzone`
--

CREATE TABLE IF NOT EXISTS `friendzone` (
  `id_friendzone` bigint(20) NOT NULL,
  `id_usuario_1` bigint(20) DEFAULT NULL,
  `id_usuario_2` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `friendzone`
--

INSERT INTO `friendzone` (`id_friendzone`, `id_usuario_1`, `id_usuario_2`, `estado`, `hora`, `fecha`) VALUES
(6, 19, 20, 1, '15:02:37', '2017-02-11'),
(7, 19, 18, 1, '15:03:08', '2017-02-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgperfil`
--

CREATE TABLE IF NOT EXISTS `imgperfil` (
  `id_img_perfil` bigint(20) NOT NULL,
  `id_persona` bigint(20) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `contador` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `hora_creacion` time DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imgperfil`
--

INSERT INTO `imgperfil` (`id_img_perfil`, `id_persona`, `nombre`, `contador`, `estado`, `fecha_creacion`, `hora_creacion`) VALUES
(1, 17, '17-h62s8-1.jpeg', 1, 1, '2017-01-30', '16:08:36'),
(2, 17, '17-h62s8-2.jpeg', 2, 1, '2017-01-30', '16:18:55'),
(3, 17, '17-h62s8-3.jpeg', 3, 1, '2017-01-30', '16:38:17'),
(4, 18, '18-m91o8-1.jpeg', 1, 1, '2017-01-30', '17:08:40'),
(5, 19, '19-p0a81-1.jpeg', 1, 1, '2017-01-30', '17:10:13'),
(6, 20, '20-b3h44-1.jpeg', 1, 1, '2017-01-30', '17:12:08'),
(7, 21, '21-v7n27-1.jpeg', 1, 1, '2017-02-03', '00:55:51'),
(8, 18, '18-m91o8-2.jpeg', 2, 1, '2017-02-10', '00:07:00');

--
-- Disparadores `imgperfil`
--
DELIMITER $$
CREATE TRIGGER `actualizar_imagen_usuario` AFTER INSERT ON `imgperfil`
 FOR EACH ROW UPDATE persona SET imagen_perfil = NEW.nombre WHERE persona.id = NEW.id_persona
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mylove`
--

CREATE TABLE IF NOT EXISTS `mylove` (
  `id_mylove` bigint(20) NOT NULL,
  `id_usuario_1` bigint(20) DEFAULT NULL,
  `id_usuario_2` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mylove`
--

INSERT INTO `mylove` (`id_mylove`, `id_usuario_1`, `id_usuario_2`, `estado`, `hora`, `fecha`) VALUES
(24, 20, 19, 1, '15:02:37', '2017-02-11'),
(25, 18, 19, 1, '15:03:08', '2017-02-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `nombre_corto` varchar(12) DEFAULT NULL,
  `abreviacion` varchar(5) DEFAULT NULL,
  `codigo_telefonico` varchar(10) DEFAULT NULL,
  `lenguaje_pais` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `nombre`, `nombre_corto`, `abreviacion`, `codigo_telefonico`, `lenguaje_pais`) VALUES
(1, 'Colombia', 'Colombia', 'col', '+57', 'es'),
(2, 'no identificado', 'no existe', 'nnn', '+00', 'en'),
(3, 'Argentina', 'Argentina', 'arg', '+55', 'es'),
(4, 'Bolivia', 'Bolivia', 'bol', '+56', 'es'),
(5, 'Brazil', 'Brazil', 'bra', '+58', 'es'),
(6, 'Chile', 'Chile', 'chi', '+59', 'es'),
(7, 'Ecuador', 'Ecuador', 'ecu', '+54', 'es'),
(8, 'Paraguay', 'Paraguay', 'par', '+53', 'es'),
(9, 'Peru', 'Peru', 'per', '+52', 'es'),
(10, 'Uruguay', 'Uruguay', 'uru', '+51', 'es'),
(11, 'Venezuela', 'Venezuela', 'ven', '+50', 'es'),
(12, 'Mexico', 'Mexico', 'mex', '+60', 'es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` bigint(20) NOT NULL,
  `correo` varchar(40) DEFAULT NULL,
  `telefono` varchar(40) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `pais_nombre` varchar(40) DEFAULT NULL,
  `telefono_con_codigo` varchar(50) DEFAULT NULL,
  `imagen_perfil` varchar(100) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `contrasenia` varchar(200) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `hora_registro` time NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int(11) NOT NULL,
  `estado_correo` int(11) NOT NULL,
  `estado_telefono` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `correo`, `telefono`, `pais`, `pais_nombre`, `telefono_con_codigo`, `imagen_perfil`, `nombre`, `sexo`, `fecha_nacimiento`, `edad`, `contrasenia`, `codigo`, `hora_registro`, `fecha_registro`, `estado`, `estado_correo`, `estado_telefono`) VALUES
(17, 'carlos-elguedo@hotmail.com', '', 1, 'Colombia', '', '17-h62s8-3.jpeg', 'Carlos Elguedo Padilla', NULL, NULL, NULL, '123123', 'h62s8', '21:15:02', '2017-01-29', 1, 1, 0),
(18, 'juliana@hotmail.com', '', 1, 'Colombia', '', '18-m91o8-2.jpeg', 'Julii', NULL, NULL, NULL, '123123', 'm91o8', '17:07:44', '2017-01-30', 1, 1, 0),
(19, '', '3126790481', 1, 'Colombia', '+573126790481', '19-p0a81-1.jpeg', 'Armando Muros', NULL, NULL, NULL, '123123', 'p0a81', '17:09:52', '2017-01-30', 1, 0, 1),
(20, '', '3001110000', 1, 'Colombia', '+573001110000', '20-b3h44-1.jpeg', 'Jimena Alvarez', NULL, NULL, NULL, '123123', 'b3h44', '17:11:53', '2017-01-30', 1, 0, 1),
(21, 'helena@hotmail.com', '', 1, 'Colombia', '', '21-v7n27-1.jpeg', 'Helena Maria', NULL, NULL, NULL, '123123', 'v7n27', '00:55:14', '2017-02-03', 1, 1, 0);

--
-- Disparadores `persona`
--
DELIMITER $$
CREATE TRIGGER `insertarUsuario` AFTER INSERT ON `persona`
 FOR EACH ROW INSERT INTO usuario
(id_persona, correo, telefono, telefono_con_codigo, contrasenia)
VALUES
(NEW.id, NEW.correo, NEW.telefono, NEW.telefono_con_codigo, NEW.contrasenia)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preusuario`
--

CREATE TABLE IF NOT EXISTS `preusuario` (
  `id` bigint(20) NOT NULL COMMENT 'Indice primario para el usuario no registrado',
  `correo` varchar(40) NOT NULL,
  `telefono` varchar(40) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `hora_fecha` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `telefono_con_codigo` varchar(40) NOT NULL,
  `codigo_activacion` varchar(50) NOT NULL,
  `forma_activacion` int(11) NOT NULL,
  `hora_fecha_activacion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preusuario`
--

INSERT INTO `preusuario` (`id`, `correo`, `telefono`, `id_pais`, `pass`, `hora`, `fecha`, `hora_fecha`, `estado`, `telefono_con_codigo`, `codigo_activacion`, `forma_activacion`, `hora_fecha_activacion`) VALUES
(2, 'carlos-elguedo@hotmail.com', '', 1, '123123', '21:14:35', '2017-01-29', '2017-01-29 21:14:35', 1, '', 'h62s8', 1, '2017-01-29 21:15:02'),
(3, 'juliana@hotmail.com', '', 1, '123123', '17:07:15', '2017-01-30', '2017-01-30 17:07:15', 1, '', 'm91o8', 1, '2017-01-30 17:07:44'),
(4, '', '3126790481', 1, '123123', '17:09:34', '2017-01-30', '2017-01-30 17:09:34', 1, '+573126790481', 'p0a81', 2, '2017-01-30 17:09:52'),
(5, '', '3001110000', 1, '123123', '17:11:15', '2017-01-30', '2017-01-30 17:11:15', 1, '+573001110000', 'b3h44', 2, '2017-01-30 17:11:53'),
(6, 'helena@hotmail.com', '', 1, '123123', '00:54:17', '2017-02-03', '2017-02-03 00:54:17', 1, '', 'v7n27', 1, '2017-02-03 00:55:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion`
--

CREATE TABLE IF NOT EXISTS `relacion` (
  `id_relacion` bigint(20) NOT NULL,
  `id_persona_1` bigint(20) DEFAULT NULL,
  `id_persona_2` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `nombre_tabla_mensajes` varchar(80) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado_persona_1` int(11) NOT NULL,
  `estado_persona_2` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `relacion`
--

INSERT INTO `relacion` (`id_relacion`, `id_persona_1`, `id_persona_2`, `estado`, `nombre_tabla_mensajes`, `hora`, `fecha`, `estado_persona_1`, `estado_persona_2`) VALUES
(15, 20, 19, 1, 'zmensajes_20_19', '15:02:37', '2017-02-11', 2, 1),
(16, 18, 19, 1, 'zmensajes_18_19', '15:03:08', '2017-02-11', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE IF NOT EXISTS `solicitud` (
  `id_solicitud` bigint(20) NOT NULL,
  `id_enviador` bigint(20) DEFAULT NULL,
  `id_solicitado` bigint(20) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `estado_enviador` int(11) DEFAULT NULL,
  `estado_solicitado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `hora_respuesta` time NOT NULL,
  `fecha_respuesta` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_solicitud`, `id_enviador`, `id_solicitado`, `tipo`, `estado`, `estado_enviador`, `estado_solicitado`, `fecha`, `hora`, `fecha_hora`, `hora_respuesta`, `fecha_respuesta`) VALUES
(14, 19, 18, 1, 0, 1, 2, '2017-02-11', '14:53:10', '2017-02-11 14:53:10', '15:03:08', '2017-02-11'),
(15, 19, 20, 1, 0, 1, 2, '2017-02-11', '14:53:27', '2017-02-11 14:53:27', '15:02:37', '2017-02-11');

--
-- Disparadores `solicitud`
--
DELIMITER $$
CREATE TRIGGER `crear_relaciones_respuesta_positiva` BEFORE UPDATE ON `solicitud`
 FOR EACH ROW IF NEW.estado_solicitado = 2 AND NEW.estado = 0 THEN
	INSERT INTO mylove
	(id_usuario_1, id_usuario_2, estado, hora, fecha)
	VALUES
	(OLD.id_solicitado, OLD.id_enviador, 1, NEW.hora_respuesta, NEW.fecha_respuesta);

ELSEIF NEW.estado_solicitado = 3  AND NEW.estado = 0 THEN
	INSERT INTO friendzone
	(id_usuario_1, id_usuario_2, estado, hora, fecha)
	VALUES
	(OLD.id_solicitado, OLD.id_enviador, 1, NEW.hora_respuesta, NEW.fecha_respuesta);
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `crear_relaciones_respuesta_positiva_enviador` AFTER UPDATE ON `solicitud`
 FOR EACH ROW IF OLD.estado_enviador = 2  AND NEW.estado = 0 THEN
	INSERT INTO mylove
	(id_usuario_1, id_usuario_2, estado, hora, fecha)
	VALUES
	(old.id_enviador, old.id_solicitado, 1, NEW.hora_respuesta, NEW.fecha_respuesta);

ELSEIF OLD.estado_enviador = 3  AND NEW.estado = 0 THEN
	INSERT INTO friendzone
	(id_usuario_1, id_usuario_2, estado, hora, fecha)
	VALUES
	(OLD.id_enviador, OLD.id_solicitado, 1, NEW.hora_respuesta, NEW.fecha_respuesta);

ELSEIF OLD.estado_enviador = 1 AND NEW.estado = 0 THEN
	INSERT INTO friendzone
	(id_usuario_1, id_usuario_2, estado, hora, fecha)
	VALUES
	(OLD.id_enviador, OLD.id_solicitado, 1, NEW.hora_respuesta, NEW.fecha_respuesta);

END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` bigint(20) NOT NULL,
  `id_persona` bigint(20) DEFAULT NULL,
  `correo` varchar(40) DEFAULT NULL,
  `telefono` varchar(40) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `telefono_con_codigo` varchar(50) DEFAULT NULL,
  `contrasenia` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_persona`, `correo`, `telefono`, `pais`, `telefono_con_codigo`, `contrasenia`) VALUES
(2, 17, 'carlos-elguedo@hotmail.com', '', NULL, '', '123123'),
(3, 18, 'juliana@hotmail.com', '', NULL, '', '123123'),
(4, 19, '', '3126790481', NULL, '+573126790481', '123123'),
(5, 20, '', '3001110000', NULL, '+573001110000', '123123'),
(6, 21, 'helena@hotmail.com', '', NULL, '', '123123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zmensajes_18_19`
--

CREATE TABLE IF NOT EXISTS `zmensajes_18_19` (
  `id_mensaje` bigint(20) NOT NULL,
  `de` bigint(20) DEFAULT NULL,
  `para` bigint(20) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `estado_enviador` int(11) DEFAULT NULL,
  `estado_receptor` int(11) DEFAULT NULL,
  `mensaje` varchar(8192) DEFAULT NULL,
  `mensaje_bot_usu_1` varchar(2048) DEFAULT NULL,
  `mensaje_bot_usu_2` varchar(2048) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `enviado` datetime DEFAULT NULL,
  `entregado` datetime DEFAULT NULL,
  `visto` datetime DEFAULT NULL,
  `est_entregado` int(11) NOT NULL,
  `est_visto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `zmensajes_18_19`
--

INSERT INTO `zmensajes_18_19` (`id_mensaje`, `de`, `para`, `tipo`, `estado_enviador`, `estado_receptor`, `mensaje`, `mensaje_bot_usu_1`, `mensaje_bot_usu_2`, `hora`, `fecha`, `enviado`, `entregado`, `visto`, `est_entregado`, `est_visto`) VALUES
(1, NULL, NULL, 0, 1, 1, NULL, 'Armando Muros y tu se han unido en MyLove', 'Julii y tu se han unido en MyLove', '15:03:08', '2017-02-11', NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zmensajes_20_19`
--

CREATE TABLE IF NOT EXISTS `zmensajes_20_19` (
  `id_mensaje` bigint(20) NOT NULL,
  `de` bigint(20) DEFAULT NULL,
  `para` bigint(20) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `estado_enviador` int(11) DEFAULT NULL,
  `estado_receptor` int(11) DEFAULT NULL,
  `mensaje` varchar(8192) DEFAULT NULL,
  `mensaje_bot_usu_1` varchar(2048) DEFAULT NULL,
  `mensaje_bot_usu_2` varchar(2048) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `enviado` datetime DEFAULT NULL,
  `entregado` datetime DEFAULT NULL,
  `visto` datetime DEFAULT NULL,
  `est_entregado` int(11) NOT NULL,
  `est_visto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `zmensajes_20_19`
--

INSERT INTO `zmensajes_20_19` (`id_mensaje`, `de`, `para`, `tipo`, `estado_enviador`, `estado_receptor`, `mensaje`, `mensaje_bot_usu_1`, `mensaje_bot_usu_2`, `hora`, `fecha`, `enviado`, `entregado`, `visto`, `est_entregado`, `est_visto`) VALUES
(1, NULL, NULL, 0, 1, 1, NULL, 'Armando Muros y tu se han unido en MyLove', 'Jimena Alvarez y tu se han unido en MyLove', '15:02:37', '2017-02-11', NULL, NULL, NULL, 0, 0),
(9, 19, 20, 1, 1, 1, 'Hola armando', NULL, NULL, '18:27:47', '2017-02-16', '2017-02-16 18:27:47', '2017-02-16 18:27:48', '0000-00-00 00:00:00', 1, 0),
(10, 20, 19, 1, 1, 1, 'Hola hola jime', NULL, NULL, '18:28:07', '2017-02-16', '2017-02-16 18:28:07', '2017-02-16 18:28:08', '0000-00-00 00:00:00', 1, 0),
(11, 20, 19, 1, 1, 1, 'dasdasdadasd', NULL, NULL, '18:29:09', '2017-02-16', '2017-02-16 18:29:09', '2017-02-16 18:29:10', '0000-00-00 00:00:00', 1, 0),
(12, 19, 20, 1, 1, 1, 'Bien bsdadadadasd', NULL, NULL, '18:29:13', '2017-02-16', '2017-02-16 18:29:13', '2017-02-16 18:29:14', '0000-00-00 00:00:00', 1, 0),
(13, 19, 20, 1, 1, 1, 'dasda', NULL, NULL, '18:29:16', '2017-02-16', '2017-02-16 18:29:16', '2017-02-16 18:29:17', '0000-00-00 00:00:00', 1, 0),
(14, 20, 19, 1, 1, 1, 'Bien bien', NULL, NULL, '18:30:35', '2017-02-16', '2017-02-16 18:30:35', '2017-02-16 18:30:35', '0000-00-00 00:00:00', 1, 0),
(15, 19, 20, 1, 1, 1, 'No nodada', NULL, NULL, '18:30:43', '2017-02-16', '2017-02-16 18:30:43', '2017-02-16 18:30:44', '0000-00-00 00:00:00', 1, 0),
(16, 20, 19, 1, 1, 1, 'dasdadadasd', NULL, NULL, '18:31:04', '2017-02-16', '2017-02-16 18:31:04', '2017-02-16 18:31:05', '0000-00-00 00:00:00', 1, 0),
(17, 19, 20, 1, 1, 1, 'dasdasdasda', NULL, NULL, '18:31:15', '2017-02-16', '2017-02-16 18:31:15', '2017-02-16 18:31:16', '0000-00-00 00:00:00', 1, 0),
(18, 20, 19, 1, 1, 1, 'estoy escribiendo', NULL, NULL, '18:33:07', '2017-02-16', '2017-02-16 18:33:07', '2017-02-16 18:33:08', '0000-00-00 00:00:00', 1, 0),
(19, 19, 20, 1, 1, 1, 'Que bueno', NULL, NULL, '18:33:19', '2017-02-16', '2017-02-16 18:33:19', '2017-02-16 18:33:20', '0000-00-00 00:00:00', 1, 0),
(20, 20, 19, 1, 1, 1, 'Sii que bien', NULL, NULL, '18:35:42', '2017-02-16', '2017-02-16 18:35:42', '2017-02-16 18:35:43', '0000-00-00 00:00:00', 1, 0),
(21, 20, 19, 1, 1, 1, 'Ecelente', NULL, NULL, '18:37:03', '2017-02-16', '2017-02-16 18:37:03', '2017-02-16 18:37:04', '0000-00-00 00:00:00', 1, 0),
(22, 19, 20, 1, 1, 1, 'Esta muy bien gracias a Dios', NULL, NULL, '18:39:02', '2017-02-16', '2017-02-16 18:39:02', '2017-02-16 18:39:03', '0000-00-00 00:00:00', 1, 0),
(24, 20, 19, 1, 1, 1, 'Hola, como estas', NULL, NULL, '01:56:16', '2017-02-21', '2017-02-21 01:56:16', '2017-02-21 01:56:17', '0000-00-00 00:00:00', 1, 0),
(25, 19, 20, 1, 1, 1, 'Muy bien armando', NULL, NULL, '01:56:56', '2017-02-21', '2017-02-21 01:56:56', '2017-02-21 01:56:56', '0000-00-00 00:00:00', 1, 0),
(26, 20, 19, 1, 1, 1, 'que bueno', NULL, NULL, '01:57:16', '2017-02-21', '2017-02-21 01:57:16', '2017-02-21 01:57:16', '0000-00-00 00:00:00', 1, 0),
(27, 20, 19, 1, 1, 1, 'dasdasd dasda dads', NULL, NULL, '01:57:24', '2017-02-21', '2017-02-21 01:57:24', '2017-02-21 01:57:25', '0000-00-00 00:00:00', 1, 0),
(28, 20, 19, 1, 1, 1, 'dadasdaasda', NULL, NULL, '01:57:31', '2017-02-21', '2017-02-21 01:57:31', '2017-02-21 01:57:32', '0000-00-00 00:00:00', 1, 0),
(29, 19, 20, 1, 1, 1, 'dasddasdsdas', NULL, NULL, '01:57:45', '2017-02-21', '2017-02-21 01:57:45', '2017-02-21 01:57:46', '0000-00-00 00:00:00', 1, 0),
(30, 20, 19, 1, 1, 1, 'jakaj asda a d', NULL, NULL, '01:57:46', '2017-02-21', '2017-02-21 01:57:46', '2017-02-21 01:57:47', '0000-00-00 00:00:00', 1, 0),
(31, 20, 19, 1, 1, 1, 'estas ahi?', NULL, NULL, '02:01:33', '2017-02-21', '2017-02-21 02:01:33', '2017-02-21 02:02:02', '0000-00-00 00:00:00', 1, 0),
(32, 20, 19, 1, 1, 1, 'contestame por favor!', NULL, NULL, '02:01:44', '2017-02-21', '2017-02-21 02:01:44', '2017-02-21 02:02:02', '0000-00-00 00:00:00', 1, 0),
(33, 20, 19, 1, 1, 1, 'xdxd', NULL, NULL, '02:01:50', '2017-02-21', '2017-02-21 02:01:50', '2017-02-21 02:02:02', '0000-00-00 00:00:00', 1, 0),
(34, 19, 20, 1, 1, 1, 'fdsfsdfsdfsdfdsfsdfs', NULL, NULL, '02:06:39', '2017-02-21', '2017-02-21 02:06:39', '2017-02-21 02:06:40', '0000-00-00 00:00:00', 1, 0),
(35, 19, 20, 1, 1, 1, 'dsdsds', NULL, NULL, '02:07:52', '2017-02-21', '2017-02-21 02:07:52', '2017-02-21 02:07:53', '0000-00-00 00:00:00', 1, 0),
(36, 19, 20, 1, 1, 1, 'bien ps', NULL, NULL, '02:52:28', '2017-02-21', '2017-02-21 02:52:28', '2017-02-21 02:52:29', '0000-00-00 00:00:00', 1, 0),
(37, 20, 19, 1, 1, 1, 'Bien&nbsp;', NULL, NULL, '02:56:00', '2017-02-21', '2017-02-21 02:56:00', '2017-02-21 02:56:00', '0000-00-00 00:00:00', 1, 0),
(38, 20, 19, 1, 1, 1, 'Mal mal&nbsp;', NULL, NULL, '02:57:25', '2017-02-21', '2017-02-21 02:57:25', '2017-02-21 02:57:26', '0000-00-00 00:00:00', 1, 0),
(39, 20, 19, 1, 1, 1, 'bien', NULL, NULL, '02:59:14', '2017-02-21', '2017-02-21 02:59:14', '2017-02-21 02:59:15', '0000-00-00 00:00:00', 1, 0),
(40, 19, 20, 1, 1, 1, 'dasdasd', NULL, NULL, '02:59:49', '2017-02-21', '2017-02-21 02:59:49', '2017-02-21 02:59:49', '0000-00-00 00:00:00', 1, 0),
(41, 19, 20, 1, 1, 1, 'bien ps asdasdasdadasda dasdas dasdas', NULL, NULL, '03:03:29', '2017-02-21', '2017-02-21 03:03:29', '2017-02-21 03:03:30', '0000-00-00 00:00:00', 1, 0),
(42, 19, 20, 1, 1, 1, 'dasdas', NULL, NULL, '03:03:41', '2017-02-21', '2017-02-21 03:03:41', '2017-02-21 03:03:41', '0000-00-00 00:00:00', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`id_cofigracion`), ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `enlinea`
--
ALTER TABLE `enlinea`
  ADD PRIMARY KEY (`id_enlinea`), ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`), ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `friendzone`
--
ALTER TABLE `friendzone`
  ADD PRIMARY KEY (`id_friendzone`), ADD KEY `id_usuario_1` (`id_usuario_1`);

--
-- Indices de la tabla `imgperfil`
--
ALTER TABLE `imgperfil`
  ADD PRIMARY KEY (`id_img_perfil`), ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `mylove`
--
ALTER TABLE `mylove`
  ADD PRIMARY KEY (`id_mylove`), ADD KEY `id_usuario_1` (`id_usuario_1`), ADD KEY `id_usuario_2` (`id_usuario_2`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`), ADD KEY `pais` (`pais`);

--
-- Indices de la tabla `preusuario`
--
ALTER TABLE `preusuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `relacion`
--
ALTER TABLE `relacion`
  ADD PRIMARY KEY (`id_relacion`), ADD KEY `id_persona_1` (`id_persona_1`), ADD KEY `id_persona_2` (`id_persona_2`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id_solicitud`), ADD KEY `id_enviador` (`id_enviador`), ADD KEY `id_solicitado` (`id_solicitado`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`), ADD KEY `pais` (`pais`), ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `zmensajes_18_19`
--
ALTER TABLE `zmensajes_18_19`
  ADD PRIMARY KEY (`id_mensaje`), ADD KEY `de` (`de`), ADD KEY `para` (`para`);

--
-- Indices de la tabla `zmensajes_20_19`
--
ALTER TABLE `zmensajes_20_19`
  ADD PRIMARY KEY (`id_mensaje`), ADD KEY `de` (`de`), ADD KEY `para` (`para`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `id_cofigracion` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `enlinea`
--
ALTER TABLE `enlinea`
  MODIFY `id_enlinea` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` bigint(40) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT de la tabla `friendzone`
--
ALTER TABLE `friendzone`
  MODIFY `id_friendzone` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `imgperfil`
--
ALTER TABLE `imgperfil`
  MODIFY `id_img_perfil` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `mylove`
--
ALTER TABLE `mylove`
  MODIFY `id_mylove` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `preusuario`
--
ALTER TABLE `preusuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Indice primario para el usuario no registrado',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `relacion`
--
ALTER TABLE `relacion`
  MODIFY `id_relacion` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id_solicitud` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `zmensajes_18_19`
--
ALTER TABLE `zmensajes_18_19`
  MODIFY `id_mensaje` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `zmensajes_20_19`
--
ALTER TABLE `zmensajes_20_19`
  MODIFY `id_mensaje` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
ADD CONSTRAINT `configuraciones_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `enlinea`
--
ALTER TABLE `enlinea`
ADD CONSTRAINT `enlinea_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `friendzone`
--
ALTER TABLE `friendzone`
ADD CONSTRAINT `friendzone_ibfk_1` FOREIGN KEY (`id_usuario_1`) REFERENCES `persona` (`id`),
ADD CONSTRAINT `friendzone_ibfk_2` FOREIGN KEY (`id_usuario_1`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `imgperfil`
--
ALTER TABLE `imgperfil`
ADD CONSTRAINT `imgperfil_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `mylove`
--
ALTER TABLE `mylove`
ADD CONSTRAINT `mylove_ibfk_1` FOREIGN KEY (`id_usuario_1`) REFERENCES `persona` (`id`),
ADD CONSTRAINT `mylove_ibfk_2` FOREIGN KEY (`id_usuario_2`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`pais`) REFERENCES `pais` (`id_pais`);

--
-- Filtros para la tabla `relacion`
--
ALTER TABLE `relacion`
ADD CONSTRAINT `relacion_ibfk_1` FOREIGN KEY (`id_persona_1`) REFERENCES `persona` (`id`),
ADD CONSTRAINT `relacion_ibfk_2` FOREIGN KEY (`id_persona_2`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`id_enviador`) REFERENCES `persona` (`id`),
ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`id_solicitado`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`pais`) REFERENCES `pais` (`id_pais`),
ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `zmensajes_18_19`
--
ALTER TABLE `zmensajes_18_19`
ADD CONSTRAINT `zmensajes_18_19_ibfk_1` FOREIGN KEY (`de`) REFERENCES `persona` (`id`),
ADD CONSTRAINT `zmensajes_18_19_ibfk_2` FOREIGN KEY (`para`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `zmensajes_20_19`
--
ALTER TABLE `zmensajes_20_19`
ADD CONSTRAINT `zmensajes_20_19_ibfk_1` FOREIGN KEY (`de`) REFERENCES `persona` (`id`),
ADD CONSTRAINT `zmensajes_20_19_ibfk_2` FOREIGN KEY (`para`) REFERENCES `persona` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
