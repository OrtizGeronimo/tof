-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2022 a las 20:52:46
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `todooficio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_servicio`
--

CREATE TABLE `archivo_servicio` (
  `idArchivo_Servicio` int(11) NOT NULL,
  `archivo` varchar(45) NOT NULL,
  `FK_idServicio` int(11) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `tipo`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
('49', 'Albañileria', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('50', 'Delivery', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('51', 'Electricista', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('52', 'Herrería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('53', 'Limpieza', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('54', 'Pintor', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('55', 'Arreglo de Electrodomésticos', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('56', 'Cadetería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('57', 'Carpintería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('58', 'Catering', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('59', 'Centro de Estética', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('60', 'Cerrajería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('61', 'Desinfección y Control de Plagas', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('62', 'DJ, Sonido y Animación', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('63', 'Diseño Gráfico', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('64', 'Empresas Constructoras', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('65', 'Enfermería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('66', 'Estilista', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('67', 'Filmación y Fotografía', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('68', 'Gasista', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('69', 'Guardería Canina', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('70', 'Guardería Infantil', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('71', 'Inflables', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('72', 'Jardines Maternales', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('73', 'Librería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('74', 'Maestro/a Particular', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('75', 'Masajes', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('76', 'Mecánica', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('77', 'Mudanza y Fletes', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('78', 'Niñera Infantil', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('79', 'Odontología', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('80', 'Paisajismo y Jardinería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('81', 'Peloteros', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('82', 'Peluquería Canina', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('83', 'Personal Trainer', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('84', 'Planos y Dirección Técnica', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('85', 'Plomería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('86', 'Profesor/a', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('87', 'Remisería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('88', 'Repostería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('89', 'Salones de Fiesta', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('90', 'Salud', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('91', 'Servicios Financieros', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('92', 'Software', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('93', 'Sublimación', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('94', 'Tapicería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('95', 'Técnico de Aire', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('96', 'Técnico de PC', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
('97', 'Viandas', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_servicio`
--

CREATE TABLE `comentario_servicio` (
  `idComentario_Servicio` int(11) NOT NULL,
  `comentario` varchar(45) NOT NULL,
  `puntaje` varchar(45) NOT NULL,
  `FK_idServicio` int(11) NOT NULL,
  `user_nombre` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentario_servicio`
--

INSERT INTO `comentario_servicio` (`idComentario_Servicio`, `comentario`, `puntaje`, `FK_idServicio`, `user_nombre`, `user_email`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
('3', 'Muy buen servicio! ', '5', '12', 'Tomas Cannatella', 'tomas742011@gmail.com', 'DESARROLLO', '2022-11-08 16:16:39', NULL, NULL, NULL, NULL),
('4', 'Muy buen servicio!', '5', '15', 'Tomas Cannatella', 'tomas742011@gmail.com', 'DESARROLLO', '2022-12-01 18:39:53', NULL, NULL, NULL, NULL);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `Departamento` varchar(45) NOT NULL,
  `usr_alta` varchar(45) DEFAULT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL,
  `FK_idProvincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `Departamento`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`, `FK_idProvincia`) VALUES
('1', 'Capital', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('2', 'General Alvear', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('3', 'General San Martín', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('4', 'Godoy Cruz', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('5', 'Guaymallén', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('6', 'Junín', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('7', 'La Paz', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('8', 'Las Heras', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('9', 'Lavalle', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('10', 'Luján de Cuyo', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('11', 'Maipú', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('12', 'Malargüe', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('13', 'Rivadavia', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('14', 'San Carlos', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('15', 'San Rafael', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('16', 'Santa Rosa', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('17', 'Tunuyán', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25'),
('18', 'Tupungato', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, '25');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_servicio`
--

CREATE TABLE `foto_servicio` (
  `foto` varchar(45) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL,
  `idFoto_Servicio` int(10) NOT NULL,
  `FK_idServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `idProvincia` int(11) NOT NULL,
  `provincia_name` varchar(45) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idProvincia`, `provincia_name`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
('25', 'Mendoza', 'DESARROLLO', '2022-11-08 00:03:48', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red_social`
--

CREATE TABLE `red_social` (
  `idRedSocial` int(11) NOT NULL,
  `redSocial_Instagram` varchar(45) NOT NULL,
  `redSocial_LinkedIn` varchar(45) NOT NULL,
  `redSocial_Facebook` varchar(45) NOT NULL,
  `FK_idUsuario` int(11) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `red_social`
--

INSERT INTO `red_social` (`idRedSocial`, `redSocial_Instagram`, `redSocial_LinkedIn`, `redSocial_Facebook`, `FK_idUsuario`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `fec_baja`, `usr_baja`) VALUES
('21', '--', '--', '--', '25', 'DESARROLLO', '2022-11-07 21:37:08', NULL, NULL, NULL, NULL),
('22', '--', '--', '--', '26', 'DESARROLLO', '2022-11-07 21:54:32', NULL, NULL, NULL, NULL),
('23', '--', '--', '--', '27', 'DESARROLLO', '2022-11-07 21:58:24', NULL, NULL, NULL, NULL),
('24', '--', '--', '--', '28', 'DESARROLLO', '2022-11-07 22:27:13', NULL, NULL, NULL, NULL),
('25', '--', '--', '--', '29', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('26', '--', '--', '--', '30', 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL),
('27', '--', '--', '--', '31', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `rol` varchar(45) DEFAULT NULL,
  `usr_alta` varchar(45) DEFAULT NULL,
  `fec_alta` datetime DEFAULT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `rol`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
('4', 'basico', 'DESARROLLO', '2022-11-08 00:15:41', NULL, NULL, NULL, NULL),
('5', 'pro', 'DESARROLLO', '2022-11-08 00:15:41', NULL, NULL, NULL, NULL),
('6', 'gratis', 'DESARROLLO', '2022-11-08 00:15:41', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` int(11) NOT NULL,
  `servicio_descripcion` varchar(500) NOT NULL,
  `FK_idCategoria` int(11) NOT NULL,
  `FK_idProvincia` int(11) NOT NULL,
  `FK_idDepartamento` int(11) NOT NULL,
  `FK_idUsuario` int(11) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL,
  `servicio_email` varchar(45) DEFAULT NULL,
  `servicio_web` varchar(45) DEFAULT NULL,
  `servicio_nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idServicio`, `servicio_descripcion`, `FK_idCategoria`, `FK_idProvincia`, `FK_idDepartamento`, `FK_idUsuario`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`, `servicio_email`, `servicio_web`, `servicio_nombre`) VALUES
('11', 'Desarrollador Backend', '92', '25', '4', '25', 'DESARROLLO', '2022-11-07 21:37:08', NULL, NULL, NULL, NULL, 'tomas742011@gmail.com', '--', 'Software'),
('12', 'Desarrollador IOS', '92', '25', '11', '26', 'DESARROLLO', '2022-11-07 21:54:32', NULL, NULL, NULL, NULL, 'geroschmidt@gmail.com', '--', 'Software'),
('13', 'Desarrollador movile', '92', '25', '1', '27', 'DESARROLLO', '2022-11-07 21:58:24', NULL, NULL, NULL, NULL, 'santiagovargas@gmail.com', '--', 'Software'),
('14', 'Cuidamos lo que mas quieres\r\nBienvenidos a Cuidarte Salud.\r\n\r\nSomos una empresa de cuidados domiciliarios que nació en el 2016 en el sur de nuestro país, y hoy seguimos creciendo en la provincia de Mendoza.\r\n\r\nNos perfeccionamos día a día para estar a la altura de sus necesidades.\r\n\r\nNuestro equipo multidisciplinario evoluciona continuamente para estar a la vanguardia.\r\n\r\nGracias por visitarnos, por favor explora este sitio y descubre todo lo que tenemos para ti.', '90', '25', '4', '28', 'DESARROLLO', '2022-11-07 22:27:13', NULL, NULL, NULL, NULL, 'cuidarte@gmail.com', '--', 'Cuidarte Salud'),
('15', 'Soy Carla, tengo 20 años, soy estudiante y estoy buscando trabajo de niñera de fin de semana (con opción en días de semana según horarios), con disponibilidad para ayudar en tareas nivel primario y secundario, cuento con curso de Primeros Auxilios.', '78', '25', '4', '29', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL, 'carlita@gmail.com', '--', 'Niñera Infantil'),
('16', 'Técnica en economia social y desarrollo local', '91', '25', '5', '30', 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL, 'martagonzales@gmail.com', '--', 'Técnica en economia social y desarrollo local'),
('17', 'Desarrollo mi profesión de Arquitecto, con más de 15 años de experiencia en el diseño de proyectos de arquitectura  y la confección de documentación técnica ejecutiva de planos de arquitectura, estructura e instalaciones eléctrica, sanitaria y servicio contra incendio, además  de la dirección y supervisión general de obras.', '54', '25', '11', '31', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL, 'arquitecto@gmail.com', '--', 'Pintor');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_dias`
--

CREATE TABLE `servicio_dias` (
  `idDias` int(11) NOT NULL,
  `dia` varchar(45) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio_dias`
--

INSERT INTO `servicio_dias` (`idDias`, `dia`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
('1', 'Lunes', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
('2', 'Martes', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
('3', 'Miercoles', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
('4', 'Jueves', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
('5', 'Viernes', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
('6', 'Sabado', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
('7', 'Domingo', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_horario`
--

CREATE TABLE `servicio_horario` (
  `idServicio_horario` int(11) NOT NULL,
  `servicio_tipo_hora_desde` varchar(45) NOT NULL,
  `servicio_tipo_hora_hasta` varchar(45) NOT NULL,
  `FK_idServicio` int(11) NOT NULL,
  `FK_idDias` int(11) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` varchar(45) DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio_horario`
--

INSERT INTO `servicio_horario` (`idServicio_horario`, `servicio_tipo_hora_desde`, `servicio_tipo_hora_hasta`, `FK_idServicio`, `FK_idDias`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
('21', 'Abierto todo el día', '--', '15', '1', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('22', 'Abierto todo el día', '--', '15', '2', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('23', 'Abierto todo el día', '--', '15', '3', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('24', 'Abierto todo el día', '--', '15', '4', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('25', 'Abierto todo el día', '--', '15', '5', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('26', 'Abierto todo el día', '--', '15', '6', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('27', 'Abierto todo el día', '--', '15', '7', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('28', 'Abierto todo el día', '--', '16', '1', 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL),
('29', 'Abierto todo el día', '--', '16', '2', 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL),
('30', 'Abierto todo el día', '--', '16', '3', 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL),
('31', 'Abierto todo el día', '--', '16', '4', 'DESARROLLO', '2022-11-07 22:41:48', NULL, NULL, NULL, NULL),
('32', 'Abierto todo el día', '--', '16', '5', 'DESARROLLO', '2022-11-07 22:41:48', NULL, NULL, NULL, NULL),
('33', '10:30', '15:30', '16', '6', 'DESARROLLO', '2022-11-07 22:41:48', NULL, NULL, NULL, NULL),
('34', '19:00', '21:15', '16', '6', 'DESARROLLO', '2022-11-07 22:41:48', NULL, NULL, NULL, NULL),
('35', 'Solo con turnos', '--', '16', '7', 'DESARROLLO', '2022-11-07 22:41:48', NULL, NULL, NULL, NULL),
('36', 'Abierto todo el día', '--', '17', '1', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
('37', 'Abierto todo el día', '--', '17', '2', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
('38', 'Abierto todo el día', '--', '17', '3', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
('39', 'Abierto todo el día', '--', '17', '4', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
('40', 'Abierto todo el día', '--', '17', '5', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
('41', 'Abierto todo el día', '--', '17', '6', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
('42', 'Abierto todo el día', '--', '17', '7', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
('43', '7:00', '12:30', '11', '1', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, '2');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_tags`
--

CREATE TABLE `servicio_tags` (
  `idTags` int(11) NOT NULL,
  `tags` varchar(45) NOT NULL,
  `FK_idServicio` int(11) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `servicio_tags` VALUES
('4', 'Acepta Mercado Pago', '11', 'DESARROLLO', '2022-11-07 21:37:08', NULL, NULL, NULL, NULL),
('5', 'Acepta Mercado Pago', '14', 'DESARROLLO', '2022-11-07 22:27:13', NULL, NULL, NULL, NULL),
('6', 'Acepta Mercado Pago', '15', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('7', 'Acepta Mercado Pago', '16', 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL),
('8', 'Acepta Mercado Pago', '17', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_tipo`
--

CREATE TABLE `servicio_tipo` (
  `idTipo` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `FK_idServicio` int(11) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio_tipo`
--

INSERT INTO `servicio_tipo` (`idTipo`, `tipo`, `FK_idServicio`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
('9', 'Freelance', '11', 'DESARROLLO', '2022-11-07 21:37:08', NULL, NULL, NULL, NULL),
('10', 'Full-time', '14', 'DESARROLLO', '2022-11-07 22:27:13', NULL, NULL, NULL, NULL),
('11', 'Cama adentro', '15', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('12', 'Full-time', '16', 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL),
('13', 'Freelance', '17', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `user_login` varchar(45) NOT NULL,
  `user_pass` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_img_perfil` varchar(45) NOT NULL,
  `user_img_banner` varchar(45) NOT NULL,
  `user_telefono` varchar(45) NOT NULL,
  `user_nombre` varchar(45) NOT NULL,
  `FK_idRol` int(11) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `user_login`, `user_pass`, `user_email`, `user_img_perfil`, `user_img_banner`, `user_telefono`, `user_nombre`, `FK_idRol`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
('25', 'tomascanna', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'tomas742011@gmail.com', 'archivos/user_tomascanna/1613648215310.jpg', 'archivos/user_tomascanna/2355cd02b42ca6ea2dedf59c5af36e67.jpg', '2615571674', 'Tomas Cannatella', '4', 'DESARROLLO', '2022-11-07 21:37:08', NULL, NULL, NULL, NULL),
('26', 'geroschmidt', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'geroschmidt@gmail.com', 'archivos/user_geroschmidt/1613648215310.jpg', 'assets/img/hero-bg-abstract.jpg', '2615571674', 'Geronimo Schmidt', '5', 'DESARROLLO', '2022-11-07 21:54:32', NULL, NULL, NULL, NULL),
('27', 'santivargas', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'santiagovargas@gmail.com', 'archivos/user_santivargas/1613648215310.jpg', 'assets/img/hero-bg-abstract.jpg', '2615571674', 'Santiago Vargas', '6', 'DESARROLLO', '2022-11-07 21:58:24', NULL, NULL, NULL, NULL),
('28', 'cuidartesalud', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'cuidarte@gmail.com', 'archivos/user_cuidartesalud/Logo-cuidarte-salud.jpg', 'archivos/user_cuidartesalud/Logo-cuidarte-salud.jpg', '2615571674', 'CUIDARTESALUD', '5', 'DESARROLLO', '2022-11-07 22:27:13', NULL, NULL, NULL, NULL),
('29', 'carla', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'carlita@gmail.com', 'archivos/user_carla/FOTO-CARNET-CARLA.png', 'archivos/user_carla/476549.jpg', '2615571674', 'Carla Funes', '4', 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
('30', 'martagonzales', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'martagonzales@gmail.com', 'archivos/user_martagonzales/16649932158773969943844150309382-scaled.jpg', 'archivos/user_martagonzales/16649932158773969943844150309382-scaled.jpg', '2615571674', 'Marta Gonzales', '4', 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL),
('31', 'arquitecto', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'arquitecto@gmail.com', 'archivos/user_arquitecto/comments-5.jpg', 'assets/img/hero-bg-abstract.jpg', '2615571674', 'Arquitecto asd', '5', 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL);


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo_servicio`
--
ALTER TABLE `archivo_servicio`
  ADD PRIMARY KEY (`idArchivo_Servicio`),
  ADD KEY `fk_Archivo_Servicio_Servicio1_idx` (`FK_idServicio`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `comentario_servicio`
--
ALTER TABLE `comentario_servicio`
  ADD PRIMARY KEY (`idComentario_Servicio`),
  ADD KEY `fk_Comentario_Servicio_Servicio1_idx` (`FK_idServicio`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`),
  ADD KEY `fk_Departamento_Provincia1_idx` (`FK_idProvincia`);

--
-- Indices de la tabla `foto_servicio`
--
ALTER TABLE `foto_servicio`
  ADD PRIMARY KEY (`idFoto_Servicio`),
  ADD KEY `fk_Foto_Servicio_Servicio1_idx` (`FK_idServicio`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idProvincia`);

--
-- Indices de la tabla `red_social`
--
ALTER TABLE `red_social`
  ADD PRIMARY KEY (`idRedSocial`),
  ADD KEY `fk_Red Social_Usuario_idx` (`FK_idUsuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idServicio`),
  ADD KEY `fk_Servicio_Categoria1_idx` (`FK_idCategoria`),
  ADD KEY `fk_Servicio_Provincia1_idx` (`FK_idProvincia`),
  ADD KEY `fk_Servicio_Usuario1_idx` (`FK_idUsuario`);

--
-- Indices de la tabla `servicio_dias`
--
ALTER TABLE `servicio_dias`
  ADD PRIMARY KEY (`idDias`);

--
-- Indices de la tabla `servicio_horario`
--
ALTER TABLE `servicio_horario`
  ADD PRIMARY KEY (`idServicio_horario`),
  ADD KEY `fk_servicio_tipo_Servicio1_idx` (`FK_idServicio`),
  ADD KEY `fk_servicio_horarios_servicio_dias1_idx` (`FK_idDias`);

--
-- Indices de la tabla `servicio_tags`
--
ALTER TABLE `servicio_tags`
  ADD PRIMARY KEY (`idTags`),
  ADD KEY `fk_Tags_Servicio1_idx` (`FK_idServicio`);

--
-- Indices de la tabla `servicio_tipo`
--
ALTER TABLE `servicio_tipo`
  ADD PRIMARY KEY (`idTipo`),
  ADD KEY `fk_Tipo_Servicio1_idx` (`FK_idServicio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_Usuario_rol1_idx` (`FK_idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivo_servicio`
--
ALTER TABLE `archivo_servicio`
  MODIFY `idArchivo_Servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `comentario_servicio`
--
ALTER TABLE `comentario_servicio`
  MODIFY `idComentario_Servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `foto_servicio`
--
ALTER TABLE `foto_servicio`
  MODIFY `idFoto_Servicio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `idProvincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `red_social`
--
ALTER TABLE `red_social`
  MODIFY `idRedSocial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `servicio_dias`
--
ALTER TABLE `servicio_dias`
  MODIFY `idDias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicio_horario`
--
ALTER TABLE `servicio_horario`
  MODIFY `idServicio_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `servicio_tags`
--
ALTER TABLE `servicio_tags`
  MODIFY `idTags` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio_tipo`
--
ALTER TABLE `servicio_tipo`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo_servicio`
--
ALTER TABLE `archivo_servicio`
  ADD CONSTRAINT `fk_Archivo_Servicio_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comentario_servicio`
--
ALTER TABLE `comentario_servicio`
  ADD CONSTRAINT `fk_Comentario_Servicio_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_Departamento_Provincia1` FOREIGN KEY (`FK_idProvincia`) REFERENCES `provincia` (`idProvincia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `foto_servicio`
--
ALTER TABLE `foto_servicio`
  ADD CONSTRAINT `fk_Foto_Servicio_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `red_social`
--
ALTER TABLE `red_social`
  ADD CONSTRAINT `fk_Red Social_Usuario` FOREIGN KEY (`FK_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_Servicio_Categoria1` FOREIGN KEY (`FK_idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Servicio_Provincia1` FOREIGN KEY (`FK_idProvincia`) REFERENCES `provincia` (`idProvincia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Servicio_Usuario1` FOREIGN KEY (`FK_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_horario`
--
ALTER TABLE `servicio_horario`
  ADD CONSTRAINT `fk_servicio_horarios_servicio_dias1` FOREIGN KEY (`FK_idDias`) REFERENCES `servicio_dias` (`idDias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicio_tipo_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_tags`
--
ALTER TABLE `servicio_tags`
  ADD CONSTRAINT `fk_Tags_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_tipo`
--
ALTER TABLE `servicio_tipo`
  ADD CONSTRAINT `fk_Tipo_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_rol1` FOREIGN KEY (`FK_idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
