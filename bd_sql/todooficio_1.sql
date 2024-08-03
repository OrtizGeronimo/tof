-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-03-2023 a las 17:36:17
-- Versión del servidor: 8.0.28
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `todooficio_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_servicio`
--

CREATE TABLE `archivo_servicio` (
  `idArchivo_Servicio` int NOT NULL,
  `archivo` varchar(45) NOT NULL,
  `FK_idServicio` int NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `tipo`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(49, 'Albañileria', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(50, 'Delivery', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(51, 'Electricista', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(52, 'Herrería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(53, 'Limpieza', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(54, 'Pintor', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(55, 'Arreglo de Electrodomésticos', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(56, 'Cadetería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(57, 'Carpintería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(58, 'Catering', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(59, 'Centro de Estética', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(60, 'Cerrajería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(61, 'Desinfección y Control de Plagas', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(62, 'DJ, Sonido y Animación', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(63, 'Diseño Gráfico', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(64, 'Empresas Constructoras', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(65, 'Enfermería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(66, 'Estilista', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(67, 'Filmación y Fotografía', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(68, 'Gasista', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(69, 'Guardería Canina', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(70, 'Guardería Infantil', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(71, 'Inflables', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(72, 'Jardines Maternales', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(73, 'Librería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(74, 'Maestro/a Particular', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(75, 'Masajes', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(76, 'Mecánica', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(77, 'Mudanza y Fletes', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(78, 'Niñera Infantil', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(79, 'Odontología', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(80, 'Paisajismo y Jardinería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(81, 'Peloteros', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(82, 'Peluquería Canina', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(83, 'Personal Trainer', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(84, 'Planos y Dirección Técnica', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(85, 'Plomería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(86, 'Profesor/a', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(87, 'Remisería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(88, 'Repostería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(89, 'Salones de Fiesta', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(90, 'Salud', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(91, 'Servicios Financieros', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(92, 'Software', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(93, 'Sublimación', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(94, 'Tapicería', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(95, 'Técnico de Aire', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(96, 'Técnico de PC', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL),
(97, 'Viandas', 'DESARROLLO', '2022-11-08 00:02:34', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_servicio`
--

CREATE TABLE `categoria_servicio` (
  `FK_idCategoria` int NOT NULL,
  `FK_idServicio` int NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categoria_servicio`
--

INSERT INTO `categoria_servicio` (`FK_idCategoria`, `FK_idServicio`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(92, 11, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(92, 12, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(92, 13, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(96, 11, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(96, 12, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(96, 13, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(70, 14, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(78, 14, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(54, 17, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(64, 17, 'DESARROLLO', '2023-02-23 18:30:37', NULL, NULL, NULL, NULL),
(49, 25, 'Tomas Cannatella', '2023-02-24 16:51:02', NULL, NULL, NULL, NULL),
(50, 25, 'Tomas Cannatella', '2023-02-24 16:51:02', NULL, NULL, NULL, NULL),
(51, 25, 'Tomas Cannatella', '2023-02-24 16:51:02', NULL, NULL, NULL, NULL),
(49, 26, 'Tomas Cannatella', '2023-02-24 16:52:36', NULL, NULL, NULL, NULL),
(50, 26, 'Tomas Cannatella', '2023-02-24 16:52:36', NULL, NULL, NULL, NULL),
(51, 26, 'Tomas Cannatella', '2023-02-24 16:52:36', NULL, NULL, NULL, NULL),
(49, 27, 'Tomas Cannatella', '2023-02-24 16:53:39', NULL, NULL, NULL, NULL),
(50, 27, 'Tomas Cannatella', '2023-02-24 16:53:39', NULL, NULL, NULL, NULL),
(51, 27, 'Tomas Cannatella', '2023-02-24 16:53:39', NULL, NULL, NULL, NULL),
(92, 28, 'Tomas Cannatella', '2023-02-25 11:16:37', NULL, NULL, 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Tomas Cannatella', '2023-02-25 11:16:37', NULL, NULL, 'Tomas Cannatella', '2023-03-07 23:35:51'),
(49, 29, 'Tomas Cannatella', '2023-02-26 11:11:08', NULL, NULL, 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 30, 'Tomas Cannatella', '2023-02-26 11:11:41', NULL, NULL, 'Tomas Cannatella', '2023-02-27 17:13:18'),
(49, 31, 'Tomas Cannatella', '2023-02-26 11:20:13', NULL, NULL, 'Tomas Cannatella', '2023-02-27 16:44:16'),
(96, 28, 'Modificacion', '2023-03-04 13:05:02', 'Tomas Cannatella', '2023-03-04 13:05:02', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 13:05:41', 'Tomas Cannatella', '2023-03-04 13:05:41', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 13:07:24', 'Tomas Cannatella', '2023-03-04 13:07:24', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 13:08:03', 'Tomas Cannatella', '2023-03-04 13:08:03', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 14:23:04', 'Tomas Cannatella', '2023-03-04 14:23:04', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 14:23:19', 'Tomas Cannatella', '2023-03-04 14:23:19', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 14:39:57', 'Tomas Cannatella', '2023-03-04 14:39:57', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 14:47:30', 'Tomas Cannatella', '2023-03-04 14:47:30', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 14:58:54', 'Tomas Cannatella', '2023-03-04 14:58:54', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 14:59:13', 'Tomas Cannatella', '2023-03-04 14:59:13', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 14:59:46', 'Tomas Cannatella', '2023-03-04 14:59:46', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 15:00:15', 'Tomas Cannatella', '2023-03-04 15:00:15', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-04 15:00:23', 'Tomas Cannatella', '2023-03-04 15:00:23', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Modificacion', '2023-03-05 08:03:26', 'Tomas Cannatella', '2023-03-05 08:03:26', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(49, 29, 'Modificacion', '2023-03-05 08:03:41', 'Tomas Cannatella', '2023-03-05 08:03:41', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Modificacion', '2023-03-05 08:03:59', 'Tomas Cannatella', '2023-03-05 08:03:59', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Modificacion', '2023-03-05 08:06:21', 'Tomas Cannatella', '2023-03-05 08:06:21', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Modificacion', '2023-03-05 08:07:11', 'Tomas Cannatella', '2023-03-05 08:07:11', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Modificacion', '2023-03-05 08:07:23', 'Tomas Cannatella', '2023-03-05 08:07:23', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Modificacion', '2023-03-05 08:11:04', 'Tomas Cannatella', '2023-03-05 08:11:04', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Tomas Cannatella', '2023-03-05 08:31:24', 'Tomas Cannatella', '2023-03-05 08:31:24', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(50, 29, 'Tomas Cannatella', '2023-03-05 08:31:24', 'Tomas Cannatella', '2023-03-05 08:31:24', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Tomas Cannatella', '2023-03-05 08:36:28', 'Tomas Cannatella', '2023-03-05 08:36:28', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(50, 29, 'Tomas Cannatella', '2023-03-05 08:36:28', 'Tomas Cannatella', '2023-03-05 08:36:28', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Tomas Cannatella', '2023-03-05 09:05:50', 'Tomas Cannatella', '2023-03-05 09:05:50', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(50, 29, 'Tomas Cannatella', '2023-03-05 09:05:50', 'Tomas Cannatella', '2023-03-05 09:05:50', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(52, 29, 'Tomas Cannatella', '2023-03-05 09:05:51', 'Tomas Cannatella', '2023-03-05 09:05:51', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Tomas Cannatella', '2023-03-05 09:26:49', 'Tomas Cannatella', '2023-03-05 09:26:49', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(50, 29, 'Tomas Cannatella', '2023-03-05 09:26:49', 'Tomas Cannatella', '2023-03-05 09:26:49', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(52, 29, 'Tomas Cannatella', '2023-03-05 09:26:49', 'Tomas Cannatella', '2023-03-05 09:26:49', 'Tomas Cannatella', '2023-03-05 09:26:57'),
(49, 29, 'Tomas Cannatella', '2023-03-05 09:26:57', 'Tomas Cannatella', '2023-03-05 09:26:57', NULL, NULL),
(50, 29, 'Tomas Cannatella', '2023-03-05 09:26:57', 'Tomas Cannatella', '2023-03-05 09:26:57', NULL, NULL),
(52, 29, 'Tomas Cannatella', '2023-03-05 09:26:57', 'Tomas Cannatella', '2023-03-05 09:26:57', NULL, NULL),
(78, 15, 'Carla Funes', '2023-03-06 23:57:55', 'Carla Funes', '2023-03-06 23:57:55', 'Carla Funes', '2023-03-07 00:10:31'),
(78, 15, 'Carla Funes', '2023-03-07 00:01:32', 'Carla Funes', '2023-03-07 00:01:32', 'Carla Funes', '2023-03-07 00:10:31'),
(78, 15, 'Carla Funes', '2023-03-07 00:04:08', 'Carla Funes', '2023-03-07 00:04:08', 'Carla Funes', '2023-03-07 00:10:31'),
(78, 15, 'Carla Funes', '2023-03-07 00:08:45', 'Carla Funes', '2023-03-07 00:08:45', 'Carla Funes', '2023-03-07 00:10:31'),
(78, 15, 'Carla Funes', '2023-03-07 00:10:31', 'Carla Funes', '2023-03-07 00:10:31', NULL, NULL),
(97, 16, 'Marta Gonzales', '2023-03-07 18:32:54', 'Marta Gonzales', '2023-03-07 18:32:54', 'Marta Gonzales', '2023-03-07 18:36:30'),
(97, 16, 'Marta Gonzales', '2023-03-07 18:33:34', 'Marta Gonzales', '2023-03-07 18:33:34', 'Marta Gonzales', '2023-03-07 18:36:30'),
(97, 16, 'Marta Gonzales', '2023-03-07 18:34:07', 'Marta Gonzales', '2023-03-07 18:34:07', 'Marta Gonzales', '2023-03-07 18:36:30'),
(97, 16, 'Marta Gonzales', '2023-03-07 18:34:18', 'Marta Gonzales', '2023-03-07 18:34:18', 'Marta Gonzales', '2023-03-07 18:36:30'),
(97, 16, 'Marta Gonzales', '2023-03-07 18:34:30', 'Marta Gonzales', '2023-03-07 18:34:30', 'Marta Gonzales', '2023-03-07 18:36:30'),
(97, 16, 'Marta Gonzales', '2023-03-07 18:34:57', 'Marta Gonzales', '2023-03-07 18:34:57', 'Marta Gonzales', '2023-03-07 18:36:30'),
(97, 16, 'Marta Gonzales', '2023-03-07 18:35:38', 'Marta Gonzales', '2023-03-07 18:35:38', 'Marta Gonzales', '2023-03-07 18:36:30'),
(91, 16, 'Marta Gonzales', '2023-03-07 18:35:57', 'Marta Gonzales', '2023-03-07 18:35:57', 'Marta Gonzales', '2023-03-07 18:36:30'),
(91, 16, 'Marta Gonzales', '2023-03-07 18:36:30', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(96, 28, 'Tomas Cannatella', '2023-03-07 23:35:18', 'Tomas Cannatella', '2023-03-07 23:35:18', 'Tomas Cannatella', '2023-03-07 23:35:51'),
(96, 28, 'Tomas Cannatella', '2023-03-07 23:35:51', 'Tomas Cannatella', '2023-03-07 23:35:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_servicio`
--

CREATE TABLE `comentario_servicio` (
  `idComentario_Servicio` int NOT NULL,
  `comentario` varchar(45) NOT NULL,
  `puntaje` varchar(45) NOT NULL,
  `FK_idServicio` int NOT NULL,
  `user_nombre` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `comentario_servicio`
--

INSERT INTO `comentario_servicio` (`idComentario_Servicio`, `comentario`, `puntaje`, `FK_idServicio`, `user_nombre`, `user_email`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(3, 'Muy buen servicio! ', '5', 12, 'Tomas Cannatella', 'tomas742011@gmail.com', 'DESARROLLO', '2022-11-08 16:16:39', NULL, NULL, NULL, NULL),
(4, 'Muy buen servicio!', '5', 15, 'Tomas Cannatella', 'tomas742011@gmail.com', 'DESARROLLO', '2022-12-01 18:39:53', NULL, NULL, NULL, NULL),
(5, 'excelente servicio', '5', 29, 'Tomas Cannatella', 'tomas742011@gmail.com', 'DESARROLLO', '2023-03-03 19:52:27', NULL, NULL, NULL, NULL),
(6, 'muy bueno', '5', 28, 'Tomas Cannatella', 'tomas742011@gmail.com', 'DESARROLLO', '2023-03-07 23:41:12', NULL, NULL, NULL, NULL),
(7, 'asd', '5', 28, 'Tomas Cannatella', 'tomas742018@gmail.com', 'DESARROLLO', '2023-03-07 23:41:34', NULL, NULL, NULL, NULL),
(8, 'zxc', '5', 28, 'zxc', 'email@gmail.com', 'DESARROLLO', '2023-03-07 23:42:34', NULL, NULL, NULL, NULL),
(9, 'a', '5', 28, 'aa', 'a@gmail.com', 'DESARROLLO', '2023-03-07 23:43:38', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int NOT NULL,
  `Departamento` varchar(45) NOT NULL,
  `usr_alta` varchar(45) DEFAULT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL,
  `FK_idProvincia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `Departamento`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`, `FK_idProvincia`) VALUES
(1, 'Capital', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(2, 'General Alvear', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(3, 'General San Martín', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(4, 'Godoy Cruz', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(5, 'Guaymallén', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(6, 'Junín', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(7, 'La Paz', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(8, 'Las Heras', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(9, 'Lavalle', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(10, 'Luján de Cuyo', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(11, 'Maipú', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(12, 'Malargüe', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(13, 'Rivadavia', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(14, 'San Carlos', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(15, 'San Rafael', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(16, 'Santa Rosa', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(17, 'Tunuyán', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25),
(18, 'Tupungato', 'DESARROLLO', '2022-10-29 20:53:09', NULL, NULL, NULL, NULL, 25);

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
  `idFoto_Servicio` int NOT NULL,
  `FK_idServicio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `idProvincia` int NOT NULL,
  `provincia_name` varchar(45) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idProvincia`, `provincia_name`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(25, 'Mendoza', 'DESARROLLO', '2022-11-08 00:03:48', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red_social`
--

CREATE TABLE `red_social` (
  `idRedSocial` int NOT NULL,
  `redSocial_Instagram` varchar(45) DEFAULT NULL,
  `redSocial_LinkedIn` varchar(45) DEFAULT NULL,
  `redSocial_Facebook` varchar(45) DEFAULT NULL,
  `FK_idServicio` int NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `red_social`
--

INSERT INTO `red_social` (`idRedSocial`, `redSocial_Instagram`, `redSocial_LinkedIn`, `redSocial_Facebook`, `FK_idServicio`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `fec_baja`, `usr_baja`) VALUES
(29, 'https://instagram.com/', 'https://linkedin.com/', 'https://facebook.com', 28, 'DESARROLLO', '2023-02-25 11:16:37', 'Tomas Cannatella', '2023-03-07 23:35:51', NULL, NULL),
(30, 'https://instagram.com/', 'https://linkedin.com/', 'https://facebook.com', 29, 'Tomas Cannatella', '2023-02-26 11:11:08', 'Tomas Cannatella', '2023-03-05 09:26:57', NULL, NULL),
(31, 'https://instagram.com/', 'https://linkedin.com/', 'https://facebook.com', 30, 'Tomas Cannatella', '2023-02-26 11:11:41', NULL, NULL, NULL, NULL),
(32, 'https://instagram.com/', 'https://linkedin.com/', 'https://facebook.com', 31, 'Tomas Cannatella', '2023-02-26 11:20:13', NULL, NULL, NULL, NULL),
(33, '', '', '', 15, 'Carla Funes', '2023-03-07 00:04:08', 'Carla Funes', '2023-03-07 00:10:31', NULL, NULL),
(34, 'null', 'null', 'null', 16, 'Marta Gonzales', '2023-03-07 18:32:54', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(35, 'null', 'null', 'null', 16, 'Marta Gonzales', '2023-03-07 18:33:34', NULL, NULL, NULL, NULL),
(36, 'null', 'null', 'null', 16, 'Marta Gonzales', '2023-03-07 18:34:07', NULL, NULL, NULL, NULL),
(37, 'null', 'null', 'null', 16, 'Marta Gonzales', '2023-03-07 18:34:18', NULL, NULL, NULL, NULL),
(38, 'null', 'null', 'null', 16, 'Marta Gonzales', '2023-03-07 18:34:30', NULL, NULL, NULL, NULL),
(39, 'null', 'null', 'null', 16, 'Marta Gonzales', '2023-03-07 18:34:57', NULL, NULL, NULL, NULL),
(40, 'null', 'null', 'null', 16, 'Marta Gonzales', '2023-03-07 18:35:38', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int NOT NULL,
  `rol` varchar(45) DEFAULT NULL,
  `usr_alta` varchar(45) DEFAULT NULL,
  `fec_alta` datetime DEFAULT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `rol`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(4, 'basico', 'DESARROLLO', '2022-11-08 00:15:41', NULL, NULL, NULL, NULL),
(5, 'pro', 'DESARROLLO', '2022-11-08 00:15:41', NULL, NULL, NULL, NULL),
(6, 'gratis', 'DESARROLLO', '2022-11-08 00:15:41', NULL, NULL, NULL, NULL),
(7, 'admin', 'DESARROLLO', '2023-03-04 20:07:57', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` int NOT NULL,
  `servicio_descripcion` varchar(500) NOT NULL,
  `FK_idProvincia` int NOT NULL,
  `FK_idDepartamento` int NOT NULL,
  `FK_idUsuario` int NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL,
  `servicio_email` varchar(45) DEFAULT NULL,
  `servicio_web` varchar(45) DEFAULT NULL,
  `servicio_nombre` varchar(45) NOT NULL,
  `servicio_imagen` varchar(500) DEFAULT NULL,
  `servicio_banner` varchar(500) DEFAULT NULL,
  `servicio_telefono` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idServicio`, `servicio_descripcion`, `FK_idProvincia`, `FK_idDepartamento`, `FK_idUsuario`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`, `servicio_email`, `servicio_web`, `servicio_nombre`, `servicio_imagen`, `servicio_banner`, `servicio_telefono`) VALUES
(11, 'Desarrollador Backend', 25, 4, 25, 'DESARROLLO', '2022-11-07 21:37:08', NULL, NULL, NULL, NULL, 'tomas742011@gmail.com', '--', 'Software', NULL, NULL, NULL),
(12, 'Desarrollador IOS', 25, 11, 26, 'DESARROLLO', '2022-11-07 21:54:32', NULL, NULL, NULL, NULL, 'geroschmidt@gmail.com', '--', 'Software', NULL, NULL, NULL),
(13, 'Desarrollador movile', 25, 1, 27, 'DESARROLLO', '2022-11-07 21:58:24', NULL, NULL, NULL, NULL, 'santiagovargas@gmail.com', '--', 'Software', NULL, NULL, NULL),
(14, 'Cuidamos lo que mas quieres\r\nBienvenidos a Cuidarte Salud.\r\n\r\nSomos una empresa de cuidados domiciliarios que nació en el 2016 en el sur de nuestro país, y hoy seguimos creciendo en la provincia de Mendoza.\r\n\r\nNos perfeccionamos día a día para estar a la altura de sus necesidades.\r\n\r\nNuestro equipo multidisciplinario evoluciona continuamente para estar a la vanguardia.\r\n\r\nGracias por visitarnos, por favor explora este sitio y descubre todo lo que tenemos para ti.', 25, 4, 28, 'DESARROLLO', '2022-11-07 22:27:13', NULL, NULL, NULL, NULL, 'cuidarte@gmail.com', '--', 'Cuidarte Salud', NULL, NULL, NULL),
(15, 'Soy Carla, tengo 20 años, soy estudiante y estoy buscando trabajo de niñera de fin de semana (con opción en días de semana según horarios), con disponibilidad para ayudar en tareas nivel primario y secundario, cuento con curso de Primeros Auxilios.', 25, 4, 29, 'DESARROLLO', '2022-11-07 22:35:23', 'Carla Funes', '2023-03-07 00:10:31', NULL, NULL, 'carlita@gmail.com', 'https://www.youtube.com/', 'Niñera Infantil', 'img_Niñera Infantil.webp', 'imgBanner_Niñera Infantil.webp', '2611234568'),
(16, 'Técnica en economia social y desarrollo local', 25, 5, 30, 'DESARROLLO', '2022-11-07 22:41:47', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL, 'martagonzales@gmail.com', '', 'Técnica en economia social y desarrollo local', 'img_Técnica en economia social y desarrollo local.webp', 'imgBanner_Técnica en economia social y desarrollo local.webp', '2614392775'),
(17, 'Desarrollo mi profesión de Arquitecto, con más de 15 años de experiencia en el diseño de proyectos de arquitectura  y la confección de documentación técnica ejecutiva de planos de arquitectura, estructura e instalaciones eléctrica, sanitaria y servicio contra incendio, además  de la dirección y supervisión general de obras.', 25, 11, 31, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL, 'arquitecto@gmail.com', '--', 'Pintor', NULL, NULL, NULL),
(20, 'test', 25, 4, 25, 'Tomas Cannatella', '2023-02-20 11:56:17', NULL, NULL, 'Tomas Cannatella', '2023-02-27 17:10:34', 'test@gmail.com', 'http://www.google.com', 'Servicio test', NULL, NULL, NULL),
(21, 'test', 25, 9, 25, 'Tomas Cannatella', '2023-02-20 12:02:53', NULL, NULL, 'Tomas Cannatella', '2023-02-27 17:06:31', 'test@gmail.com', 'http://www.google.com', 'Servicio test', NULL, NULL, NULL),
(22, 'desc test', 25, 10, 25, 'Tomas Cannatella', '2023-02-22 16:50:39', NULL, NULL, NULL, NULL, 'test@gmail.com', 'http://www.google.com', 'Servicio test', NULL, NULL, NULL),
(23, 'DESC', 25, 13, 25, 'Tomas Cannatella', '2023-02-22 20:14:10', NULL, NULL, NULL, NULL, 'test@gmail.com', 'http://www.google.com', 'Servicio test', NULL, NULL, NULL),
(24, 'PHP,JAVASCRIPT,node', 25, 18, 25, 'Tomas Cannatella', '2023-02-22 20:15:22', NULL, NULL, NULL, NULL, 'test@gmail.com', 'http://www.google.com', 'Desarrollador test', NULL, NULL, NULL),
(25, 'desc', 25, 4, 25, 'Tomas Cannatella', '2023-02-24 16:51:02', NULL, NULL, NULL, NULL, 'test@gmail.com', 'http://www.google.com', 'Servicio test', NULL, NULL, NULL),
(26, 'desc', 25, 4, 25, 'Tomas Cannatella', '2023-02-24 16:52:36', NULL, NULL, NULL, NULL, 'test@gmail.com', 'http://www.google.com', 'Servicio test', NULL, NULL, NULL),
(27, 'desc', 25, 4, 25, 'Tomas Cannatella', '2023-02-24 16:53:39', NULL, NULL, NULL, NULL, 'test@gmail.com', 'http://www.google.com', 'Servicio test', NULL, NULL, NULL),
(28, 'Se trabajaron en proyectos importantes como TodoOficio', 25, 4, 25, 'Tomas Cannatella', '2023-02-25 11:16:37', 'Tomas Cannatella', '2023-03-07 23:35:51', NULL, NULL, 'test@gmail.com', 'http://www.google.com', 'Desarrollador freelance', 'img_Desarrollador freelance.webp', 'imgBanner_Desarrollador freelance.webp', '2615571674'),
(29, 'Fabricación de churrasqueras a domicilios', 25, 10, 25, 'Tomas Cannatella', '2023-02-26 11:11:08', 'Tomas Cannatella', '2023-03-05 09:26:57', NULL, NULL, 'tomas742011@gmail.com', 'http://www.google.com', 'Albañileria', 'img_Albañileria.webp', 'imgBanner_Albañileria.webp', '2614392775'),
(30, 'Fabricación de churrasqueras a domicilios', 25, 10, 25, 'Tomas Cannatella', '2023-02-26 11:11:41', NULL, NULL, 'Tomas Cannatella', '2023-02-27 17:13:18', 'tomas742011@gmail.com', 'http://www.google.com', 'Albañileria', 'img_Albañileria.webp', 'img_Albañileriawebp', NULL),
(31, 'Fabricación de churrasqueras a domicilios', 25, 10, 25, 'Tomas Cannatella', '2023-02-26 11:20:13', NULL, NULL, 'Tomas Cannatella', '2023-02-27 16:44:16', 'tomas742011@gmail.com', 'http://www.google.com', 'Albañileria', 'img_Albañileria.webp', 'imgBanner_Albañileria.webp', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_dias`
--

CREATE TABLE `servicio_dias` (
  `idDias` int NOT NULL,
  `dia` varchar(45) NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `servicio_dias`
--

INSERT INTO `servicio_dias` (`idDias`, `dia`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(1, 'Lunes', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
(2, 'Martes', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
(3, 'Miercoles', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
(4, 'Jueves', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
(5, 'Viernes', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
(6, 'Sabado', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL),
(7, 'Domingo', 'DESARROLLO', '2022-11-04 18:59:12', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_horario`
--

CREATE TABLE `servicio_horario` (
  `idServicio_horario` int NOT NULL,
  `servicio_tipo_hora_desde` varchar(45) NOT NULL,
  `servicio_tipo_hora_hasta` varchar(45) NOT NULL,
  `FK_idServicio` int NOT NULL,
  `FK_idDias` int NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` varchar(45) DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `servicio_horario`
--

INSERT INTO `servicio_horario` (`idServicio_horario`, `servicio_tipo_hora_desde`, `servicio_tipo_hora_hasta`, `FK_idServicio`, `FK_idDias`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(21, 'Abierto Todo el Día', '--', 15, 1, 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
(22, 'Abierto Todo el Día', '--', 15, 2, 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
(23, 'Abierto Todo el Día', '--', 15, 3, 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
(24, 'Abierto Todo el Día', '--', 15, 4, 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
(25, 'Abierto Todo el Día', '--', 15, 5, 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
(26, 'Abierto Todo el Día', '--', 15, 6, 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
(27, 'Abierto Todo el Día', '--', 15, 7, 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
(28, 'Abierto Todo el Día', '--', 16, 1, 'DESARROLLO', '2022-11-07 22:41:47', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(29, 'Abierto Todo el Día', '--', 16, 2, 'DESARROLLO', '2022-11-07 22:41:47', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(30, 'Abierto Todo el Día', '--', 16, 3, 'DESARROLLO', '2022-11-07 22:41:47', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(31, 'Abierto Todo el Día', '--', 16, 4, 'DESARROLLO', '2022-11-07 22:41:48', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(32, 'Abierto Todo el Día', '--', 16, 5, 'DESARROLLO', '2022-11-07 22:41:48', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(33, '10:30', '15:30', 16, 6, 'DESARROLLO', '2022-11-07 22:41:48', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(34, '19:00', '21:15', 16, 6, 'DESARROLLO', '2022-11-07 22:41:48', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(35, 'Solo con turnos', '--', 16, 7, 'DESARROLLO', '2022-11-07 22:41:48', NULL, NULL, NULL, NULL),
(36, 'Abierto Todo el Día', '--', 17, 1, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
(37, 'Abierto Todo el Día', '--', 17, 2, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
(38, 'Abierto Todo el Día', '--', 17, 3, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
(39, 'Abierto Todo el Día', '--', 17, 4, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
(40, 'Abierto Todo el Día', '--', 17, 5, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
(41, 'Abierto Todo el Día', '--', 17, 6, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
(42, 'Abierto Todo el Día', '--', 17, 7, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
(43, '7:00', '12:30', 11, 1, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, '2'),
(47, 'Abierto Todo el Día', '--', 22, 2, 'Tomas Cannatella', '2023-02-22 18:49:44', NULL, NULL, NULL, NULL),
(48, 'Cerrado Todo el Día', '--', 22, 3, 'Tomas Cannatella', '2023-02-22 18:49:44', NULL, NULL, NULL, NULL),
(49, 'Solo con Turnos', '--', 22, 4, 'Tomas Cannatella', '2023-02-22 18:49:44', NULL, NULL, NULL, NULL),
(50, 'Abierto Todo el Día', '--', 22, 2, 'Tomas Cannatella', '2023-02-22 18:50:56', NULL, NULL, NULL, NULL),
(51, 'Cerrado Todo el Día', '--', 22, 3, 'Tomas Cannatella', '2023-02-22 18:50:56', NULL, NULL, NULL, NULL),
(52, 'Solo con Turnos', '--', 22, 4, 'Tomas Cannatella', '2023-02-22 18:50:56', NULL, NULL, NULL, NULL),
(53, '03:00', '07:30', 22, 1, 'Tomas Cannatella', '2023-02-22 19:17:26', NULL, NULL, NULL, NULL),
(54, '12:30', '15:30', 22, 1, 'Tomas Cannatella', '2023-02-22 19:17:27', NULL, NULL, NULL, NULL),
(55, '03:00', '07:30', 22, 1, 'Tomas Cannatella', '2023-02-22 19:43:18', NULL, NULL, NULL, NULL),
(56, '12:30', '15:30', 22, 1, 'Tomas Cannatella', '2023-02-22 19:43:19', NULL, NULL, NULL, NULL),
(57, '03:00', '07:30', 23, 1, 'Tomas Cannatella', '2023-02-22 20:14:10', NULL, NULL, NULL, NULL),
(58, '12:30', '15:30', 23, 1, 'Tomas Cannatella', '2023-02-22 20:14:10', NULL, NULL, NULL, NULL),
(59, '03:45', '09:00', 24, 1, 'Tomas Cannatella', '2023-02-22 20:15:22', NULL, NULL, NULL, NULL),
(60, 'Abierto Todo el Día', '--', 24, 2, 'Tomas Cannatella', '2023-02-22 20:15:22', NULL, NULL, NULL, NULL),
(61, 'Abierto Todo el Día', '--', 24, 3, 'Tomas Cannatella', '2023-02-22 20:15:22', NULL, NULL, NULL, NULL),
(62, 'Abierto Todo el Día', '--', 24, 4, 'Tomas Cannatella', '2023-02-22 20:15:22', NULL, NULL, NULL, NULL),
(63, 'Abierto Todo el Día', '--', 24, 5, 'Tomas Cannatella', '2023-02-22 20:15:22', NULL, NULL, NULL, NULL),
(64, 'Abierto Todo el Día', '--', 24, 6, 'Tomas Cannatella', '2023-02-22 20:15:22', NULL, NULL, NULL, NULL),
(65, 'Abierto Todo el Día', '--', 24, 7, 'Tomas Cannatella', '2023-02-22 20:15:22', NULL, NULL, NULL, NULL),
(66, '14:00', '14:00', 28, 1, 'Tomas Cannatella', '2023-02-25 11:16:37', 'Tomas Cannatella', '2023-03-07 23:35:51', NULL, NULL),
(67, '18:00', '18:00', 28, 1, 'Tomas Cannatella', '2023-02-25 11:16:37', 'Tomas Cannatella', '2023-03-07 23:35:51', NULL, NULL),
(68, 'Abierto Todo el Día', '--', 28, 2, 'Tomas Cannatella', '2023-02-25 11:16:37', 'Tomas Cannatella', '2023-03-07 23:35:51', NULL, NULL),
(69, '--', '--', 28, 3, 'Tomas Cannatella', '2023-02-25 11:16:37', 'Tomas Cannatella', '2023-03-04 14:23:04', NULL, NULL),
(70, '--', '--', 28, 4, 'Tomas Cannatella', '2023-02-25 11:16:37', 'Tomas Cannatella', '2023-03-04 14:23:04', NULL, NULL),
(71, '--', '--', 28, 5, 'Tomas Cannatella', '2023-02-25 11:16:37', 'Tomas Cannatella', '2023-03-04 14:23:04', NULL, NULL),
(72, '--', '--', 28, 6, 'Tomas Cannatella', '2023-02-25 11:16:38', 'Tomas Cannatella', '2023-03-04 14:23:04', NULL, NULL),
(73, '--', '--', 28, 7, 'Tomas Cannatella', '2023-02-25 11:16:38', 'Tomas Cannatella', '2023-03-04 14:23:04', NULL, NULL),
(74, '04:00', '04:00', 29, 1, 'Tomas Cannatella', '2023-03-05 08:11:04', 'Tomas Cannatella', '2023-03-05 09:26:57', NULL, NULL),
(75, 'Solo con Turnos', '--', 29, 4, 'Tomas Cannatella', '2023-03-05 08:11:04', 'Tomas Cannatella', '2023-03-05 09:26:57', NULL, NULL),
(81, 'Solo con Turnos', '--', 29, 2, 'Tomas Cannatella', '2023-03-05 09:26:57', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_tags`
--

CREATE TABLE `servicio_tags` (
  `idTags` int NOT NULL,
  `tags` varchar(45) NOT NULL,
  `FK_idServicio` int NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `servicio_tags`
--

INSERT INTO `servicio_tags` (`idTags`, `tags`, `FK_idServicio`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(4, 'Acepta Mercado Pago', 11, 'DESARROLLO', '2022-11-07 21:37:08', NULL, NULL, NULL, NULL),
(5, 'Acepta Mercado Pago', 14, 'DESARROLLO', '2022-11-07 22:27:13', NULL, NULL, NULL, NULL),
(6, 'Acepta Mercado Pago', 15, 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
(7, 'Acepta Mercado Pago', 16, 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL),
(8, 'Acepta Mercado Pago', 17, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_tipo`
--

CREATE TABLE `servicio_tipo` (
  `idTipo` int NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `FK_idServicio` int NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `servicio_tipo`
--

INSERT INTO `servicio_tipo` (`idTipo`, `tipo`, `FK_idServicio`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(9, 'Freelance', 11, 'DESARROLLO', '2022-11-07 21:37:08', NULL, NULL, NULL, NULL),
(10, 'Full-time', 14, 'DESARROLLO', '2022-11-07 22:27:13', NULL, NULL, NULL, NULL),
(11, 'Cama adentro', 15, 'DESARROLLO', '2022-11-07 22:35:23', 'Carla Funes', '2023-03-07 00:10:31', NULL, NULL),
(12, 'Full-time', 16, 'DESARROLLO', '2022-11-07 22:41:47', 'Marta Gonzales', '2023-03-07 18:36:30', NULL, NULL),
(13, 'Freelance', 17, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
(15, 'Cama adentro', 23, 'Tomas Cannatella', '2023-02-22 20:14:10', NULL, NULL, NULL, NULL),
(16, 'Freelance', 24, 'Tomas Cannatella', '2023-02-22 20:15:22', NULL, NULL, NULL, NULL),
(17, 'Cama adentro', 27, 'Tomas Cannatella', '2023-02-24 16:53:39', NULL, NULL, NULL, NULL),
(18, 'Cama adentro', 28, 'Tomas Cannatella', '2023-02-25 11:16:38', 'Tomas Cannatella', '2023-03-07 23:35:51', NULL, NULL),
(19, 'Cama adentro', 29, 'Tomas Cannatella', '2023-02-26 11:11:08', 'Tomas Cannatella', '2023-03-05 09:26:57', NULL, NULL),
(20, 'Cama adentro', 30, 'Tomas Cannatella', '2023-02-26 11:11:41', NULL, NULL, 'Tomas Cannatella', '2023-02-27 17:13:18'),
(21, 'Cama adentro', 31, 'Tomas Cannatella', '2023-02-26 11:20:13', NULL, NULL, 'Tomas Cannatella', '2023-02-27 16:44:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int NOT NULL,
  `user_login` varchar(45) NOT NULL,
  `user_pass` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_img_perfil` varchar(45) NOT NULL,
  `user_img_banner` varchar(45) NOT NULL,
  `user_telefono` varchar(45) NOT NULL,
  `user_nombre` varchar(45) NOT NULL,
  `FK_idRol` int NOT NULL,
  `usr_alta` varchar(45) NOT NULL,
  `fec_alta` datetime NOT NULL,
  `usr_mod` varchar(45) DEFAULT NULL,
  `fec_mod` datetime DEFAULT NULL,
  `usr_baja` varchar(45) DEFAULT NULL,
  `fec_baja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `user_login`, `user_pass`, `user_email`, `user_img_perfil`, `user_img_banner`, `user_telefono`, `user_nombre`, `FK_idRol`, `usr_alta`, `fec_alta`, `usr_mod`, `fec_mod`, `usr_baja`, `fec_baja`) VALUES
(25, 'tomascanna', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'tomas742011@gmail.com', '/user_profile.webp', 'archivos/user_tomascanna/2355cd02b42ca6ea2ded', '2615571674', 'Tomas Cannatella', 4, 'DESARROLLO', '2022-11-07 21:37:08', 'tomascanna', '2023-03-09 00:12:51', NULL, NULL),
(26, 'geroschmidt', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'geroschmidt@gmail.com', 'user_profile.webp', 'assets/img/hero-bg-abstract.jpg', '2615571674', 'Geronimo Schmidt', 5, 'DESARROLLO', '2022-11-07 21:54:32', NULL, NULL, NULL, NULL),
(27, 'santivargas', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'santiagovargas@gmail.com', 'user_profile.webp', 'assets/img/hero-bg-abstract.jpg', '2615571674', 'Santiago Vargas', 6, 'DESARROLLO', '2022-11-07 21:58:24', NULL, NULL, NULL, NULL),
(28, 'cuidartesalud', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'cuidarte@gmail.com', 'user_profile.webp', 'archivos/user_cuidartesalud/Logo-cuidarte-sal', '2615571674', 'CUIDARTESALUD', 5, 'DESARROLLO', '2022-11-07 22:27:13', NULL, NULL, NULL, NULL),
(29, 'carla', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'carlita@gmail.com', 'user_profile.webp', 'archivos/user_carla/476549.jpg', '2615571674', 'Carla Funes', 4, 'DESARROLLO', '2022-11-07 22:35:23', NULL, NULL, NULL, NULL),
(30, 'martagonzales', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'martagonzales@gmail.com', 'user_profile.webp', 'archivos/user_martagonzales/16649932158773969', '2615571674', 'Marta Gonzales', 4, 'DESARROLLO', '2022-11-07 22:41:47', NULL, NULL, NULL, NULL),
(31, 'arquitecto', '516713fc33c8c8b529d98afa9d9a3aeff3b2a010', 'arquitecto@gmail.com', 'user_profile.webp', 'assets/img/hero-bg-abstract.jpg', '2615571674', 'Arquitecto asd', 5, 'DESARROLLO', '2022-11-07 22:55:16', NULL, NULL, NULL, NULL),
(97, 'acannatella', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'test@gmail.com', 'user_profile.webp', '--', '2615571674', 'Alejandro', 4, 'DESARROLLO', '2023-02-25 11:37:57', NULL, NULL, NULL, NULL),
(100, 'test123', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'test@gmail.com', 'user_profile.webp', '--', '2615571674', 'test test', 4, 'DESARROLLO', '2023-02-25 11:52:53', NULL, NULL, NULL, NULL),
(108, 'mcannatella', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'test@gmail.com', 'user_profile.webp', '--', '2615571674', 'Milagros Cannatella', 4, 'DESARROLLO', '2023-02-25 12:06:18', NULL, NULL, NULL, NULL);

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
-- Indices de la tabla `categoria_servicio`
--
ALTER TABLE `categoria_servicio`
  ADD KEY `fk_Categoria_has_Servicio_Servicio1_idx` (`FK_idServicio`),
  ADD KEY `fk_Categoria_has_Servicio_Categoria1_idx` (`FK_idCategoria`);

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
  ADD KEY `fk_Red Social_Servicio_idx` (`FK_idServicio`);

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
  ADD UNIQUE KEY `user_login_UNIQUE` (`user_login`),
  ADD KEY `fk_Usuario_rol1_idx` (`FK_idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivo_servicio`
--
ALTER TABLE `archivo_servicio`
  MODIFY `idArchivo_Servicio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `comentario_servicio`
--
ALTER TABLE `comentario_servicio`
  MODIFY `idComentario_Servicio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `foto_servicio`
--
ALTER TABLE `foto_servicio`
  MODIFY `idFoto_Servicio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `idProvincia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `red_social`
--
ALTER TABLE `red_social`
  MODIFY `idRedSocial` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idServicio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `servicio_dias`
--
ALTER TABLE `servicio_dias`
  MODIFY `idDias` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicio_horario`
--
ALTER TABLE `servicio_horario`
  MODIFY `idServicio_horario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `servicio_tags`
--
ALTER TABLE `servicio_tags`
  MODIFY `idTags` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `servicio_tipo`
--
ALTER TABLE `servicio_tipo`
  MODIFY `idTipo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo_servicio`
--
ALTER TABLE `archivo_servicio`
  ADD CONSTRAINT `fk_Archivo_Servicio_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `categoria_servicio`
--
ALTER TABLE `categoria_servicio`
  ADD CONSTRAINT `fk_Categoria_has_Servicio_Categoria1` FOREIGN KEY (`FK_idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `fk_Categoria_has_Servicio_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `comentario_servicio`
--
ALTER TABLE `comentario_servicio`
  ADD CONSTRAINT `fk_Comentario_Servicio_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_Departamento_Provincia1` FOREIGN KEY (`FK_idProvincia`) REFERENCES `provincia` (`idProvincia`);

--
-- Filtros para la tabla `foto_servicio`
--
ALTER TABLE `foto_servicio`
  ADD CONSTRAINT `fk_Foto_Servicio_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `red_social`
--
ALTER TABLE `red_social`
  ADD CONSTRAINT `fk_Red Social_Servicio` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_Servicio_Provincia1` FOREIGN KEY (`FK_idProvincia`) REFERENCES `provincia` (`idProvincia`),
  ADD CONSTRAINT `fk_Servicio_Usuario1` FOREIGN KEY (`FK_idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `servicio_horario`
--
ALTER TABLE `servicio_horario`
  ADD CONSTRAINT `fk_servicio_horarios_servicio_dias1` FOREIGN KEY (`FK_idDias`) REFERENCES `servicio_dias` (`idDias`),
  ADD CONSTRAINT `fk_servicio_tipo_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `servicio_tags`
--
ALTER TABLE `servicio_tags`
  ADD CONSTRAINT `fk_Tags_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `servicio_tipo`
--
ALTER TABLE `servicio_tipo`
  ADD CONSTRAINT `fk_Tipo_Servicio1` FOREIGN KEY (`FK_idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_rol1` FOREIGN KEY (`FK_idRol`) REFERENCES `rol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
