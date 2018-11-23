-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2018 a las 06:08:39
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--
CREATE DATABASE IF NOT EXISTS `sistema` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sistema`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--
-- Creación: 06-05-2018 a las 21:21:58
--

DROP TABLE IF EXISTS `administracion`;
CREATE TABLE IF NOT EXISTS `administracion` (
  `ID_ADMINISTRACION` int(11) NOT NULL,
  `SALARIO` decimal(10,0) NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `CARGO` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_ADMINISTRACION`),
  KEY `fk_administracion_persona1_idx` (`ID_ADMINISTRACION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `administracion`:
--   `ID_ADMINISTRACION`
--       `persona` -> `ID_PERSONA`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--
-- Creación: 06-05-2018 a las 21:21:58
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `ID_ALUMNO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_INFO_MEDICA` int(11) NOT NULL,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `ESCUELA_PROCEDENCIA` varchar(45) DEFAULT NULL,
  `UTILIZA_TRANSPORTE` bit(1) DEFAULT NULL,
  `NOTAS` varchar(100) DEFAULT NULL,
  `CROQUIS` blob,
  `ACTIVO_ALUMNO` bit(1) NOT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `LUGAR_NACIMIENTO` varchar(100) DEFAULT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL,
  `RELIGION` varchar(45) DEFAULT NULL,
  `NO_IDENTIDAD` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_ALUMNO`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `alumno`:
--

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`ID_ALUMNO`, `ID_INFO_MEDICA`, `NOMBRE`, `ESCUELA_PROCEDENCIA`, `UTILIZA_TRANSPORTE`, `NOTAS`, `CROQUIS`, `ACTIVO_ALUMNO`, `DIRECCION`, `LUGAR_NACIMIENTO`, `FECHA_NACIMIENTO`, `RELIGION`, `NO_IDENTIDAD`) VALUES
(0, 1, '$nombre', '$esc', b'1', '0', 0x4e2f41, b'1', '$direccion', ' ', '0000-00-00', '$religion', '$identAlum'),
(1, 1, 'Darwin Hernandez', ' ', b'1', '56', 0x20, b'1', ' ', ' ', '0000-00-00', ' ', '1'),
(2, 1, '', '', b'1', '0', 0x4e2f41, b'1', '', ' ', '0000-00-00', '', ''),
(3, 1, '', '', b'1', '0', 0x4e2f41, b'1', '', ' ', '0000-00-00', '', ''),
(4, 1, 'Epaz', '', b'1', '0', 0x4e2f41, b'1', '', ' ', '0000-00-00', '', ''),
(5, 1, '', '', b'1', '0', 0x4e2f41, b'1', '', ' ', '0000-00-00', '', '0801199109792'),
(6, 1, 'erick', '', b'1', '0', 0x4e2f41, b'1', '', ' ', '2018-05-31', '', '0801199827873'),
(7, 1, '', '', b'1', '0', 0x4e2f41, b'1', '', ' ', '0000-00-00', '', '5645609832478'),
(8, 1, 'Alumno 1', '', b'1', '0', 0x4e2f41, b'1', '', ' ', '1995-01-31', '', '0810912873678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--
-- Creación: 07-05-2018 a las 00:11:57
--

DROP TABLE IF EXISTS `calificaciones`;
CREATE TABLE IF NOT EXISTS `calificaciones` (
  `ID_CALIFICACIONES` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PARCIAL` int(11) NOT NULL,
  `ID_CATEGORIA` int(11) NOT NULL,
  `ID_SECCION` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  `ID_CLASE` int(11) NOT NULL,
  `HOMEWORK` int(2) NOT NULL DEFAULT '0',
  `CLASSWORK` int(2) NOT NULL DEFAULT '0',
  `CLASSWORK_EVALUATION` int(2) NOT NULL DEFAULT '0',
  `TEST` int(2) NOT NULL DEFAULT '0',
  `PUNTAJE` decimal(10,0) NOT NULL,
  `NOTA` decimal(10,0) NOT NULL,
  `FECHA_TAREA` date NOT NULL,
  `ANIO` int(11) NOT NULL,
  PRIMARY KEY (`ID_CALIFICACIONES`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `calificaciones`:
--

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`ID_CALIFICACIONES`, `ID_PARCIAL`, `ID_CATEGORIA`, `ID_SECCION`, `ID_ALUMNO`, `ID_CLASE`, `HOMEWORK`, `CLASSWORK`, `CLASSWORK_EVALUATION`, `TEST`, `PUNTAJE`, `NOTA`, `FECHA_TAREA`, `ANIO`) VALUES
(1, 1, 0, 1, 1, 6, 10, 10, 10, 10, '1', '0', '0000-00-00', 45),
(2, 2, 0, 1, 1, 6, 20, 20, 20, 20, '1', '0', '0000-00-00', 45),
(3, 3, 0, 1, 1, 6, 15, 15, 15, 15, '1', '0', '0000-00-00', 45),
(4, 4, 0, 1, 1, 6, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(5, 1, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(6, 2, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(7, 3, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(8, 4, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(9, 1, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(10, 2, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(11, 3, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(12, 4, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(13, 1, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(14, 2, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(15, 3, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(16, 4, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(17, 1, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(18, 2, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(19, 3, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(20, 4, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(21, 1, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(22, 2, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(23, 3, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(24, 4, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(25, 1, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(26, 2, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(27, 3, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(28, 4, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(29, 1, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(30, 2, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(31, 3, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(32, 4, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(33, 1, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(34, 2, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(35, 3, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(36, 4, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(37, 1, 0, 1, 1, 16, 10, 0, 0, 0, '1', '0', '0000-00-00', 45),
(38, 2, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(39, 3, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(40, 4, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(41, 1, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(42, 2, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(43, 3, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(44, 4, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(45, 1, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(46, 2, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(47, 3, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(48, 4, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(49, 1, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(50, 2, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(51, 3, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(52, 4, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 45),
(53, 1, 0, 1, 1, 6, 10, 10, 10, 10, '1', '0', '0000-00-00', 9),
(54, 2, 0, 1, 1, 6, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(55, 3, 0, 1, 1, 6, 10, 20, 15, 20, '1', '0', '0000-00-00', 9),
(56, 4, 0, 1, 1, 6, 0, 0, 0, 5, '1', '0', '0000-00-00', 9),
(57, 1, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(58, 2, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(59, 3, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(60, 4, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(61, 1, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(62, 2, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(63, 3, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(64, 4, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(65, 1, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(66, 2, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(67, 3, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(68, 4, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(69, 1, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(70, 2, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(71, 3, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(72, 4, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(73, 1, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(74, 2, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(75, 3, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(76, 4, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(77, 1, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(78, 2, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(79, 3, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(80, 4, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(81, 1, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(82, 2, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(83, 3, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(84, 4, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(85, 1, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(86, 2, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(87, 3, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(88, 4, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(89, 1, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(90, 2, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(91, 3, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(92, 4, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(93, 1, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(94, 2, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(95, 3, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(96, 4, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(97, 1, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(98, 2, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(99, 3, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(100, 4, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(101, 1, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(102, 2, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(103, 3, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 9),
(104, 4, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--
-- Creación: 06-05-2018 a las 21:21:59
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOMBRE_CATEGORIA` varchar(45) NOT NULL,
  `PORCENTAJE` int(11) NOT NULL,
  PRIMARY KEY (`ID_CATEGORIA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `categoria`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--
-- Creación: 06-05-2018 a las 21:21:59
--

DROP TABLE IF EXISTS `clase`;
CREATE TABLE IF NOT EXISTS `clase` (
  `ID_CLASE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_CLASE` varchar(45) NOT NULL,
  `ESTADO_CLASE` int(1) NOT NULL,
  PRIMARY KEY (`ID_CLASE`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `clase`:
--

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`ID_CLASE`, `NOMBRE_CLASE`, `ESTADO_CLASE`) VALUES
(1, 'WRITING 5', 1),
(3, 'ENGLISH', 0),
(4, 'ESPAÑOL K5', 1),
(5, 'HEALTH 1', 1),
(6, 'LANGUAGE K4', 1),
(7, 'MATH K4', 1),
(8, 'PHONICS K4', 1),
(9, 'READING K4', 1),
(10, 'SCIENCE K4', 1),
(11, 'SOCIAL STUDIES K4', 1),
(12, 'SPELLING 1', 1),
(13, 'ENGLISH K4', 1),
(14, 'WRITING K4', 1),
(15, 'COMPUTACIÓN K4', 1),
(16, 'PHYSICAL EDUCATION K4', 1),
(17, 'BIBLE K4', 1),
(18, 'MUSICA K4', 1),
(19, 'CONVERSATION K4', 1),
(20, 'LANGUAGE K5', 1),
(21, 'READING K5', 1),
(22, 'MATH K5', 1),
(23, 'SCIENCE K5', 1),
(24, 'WRITING K5', 1),
(25, 'SOCIAL STUDIES K5', 1),
(26, '  CONVERSATION K5', 1),
(27, 'COMPUTACION K5', 1),
(28, 'PHONICS K5', 1),
(29, 'PHYSICAL EDUCATION K5', 1),
(30, 'BIBLE K5', 1),
(31, 'SCIENCE 1', 1),
(32, 'ESPAÑOL 1', 1),
(33, 'MATH 1', 1),
(34, 'READING 1', 1),
(35, 'PHONICS 1', 1),
(36, 'SOCIAL STUDIES 1', 1),
(37, 'ART 1', 1),
(38, 'MATH/PRACTICE 1', 1),
(39, 'LANGUAGE 1', 1),
(40, 'BIBLE 1', 1),
(41, 'CIENCIAS SOCIALES 1', 1),
(42, 'COMPUTACIÓN 1', 1),
(43, 'MUSIC 1', 1),
(44, 'ESPAÑOL 2', 1),
(45, 'MATH 2', 1),
(46, 'HEALTH 2', 1),
(47, 'SCIENCE 2', 1),
(48, 'READING 2', 1),
(49, 'PHONICS 2', 1),
(50, 'LANGUAGE 2', 1),
(51, 'ART 2', 1),
(52, 'BIBLE 2', 1),
(53, 'SOCIAL STUDIES 2', 1),
(54, 'COMPUTACIÓN 2', 1),
(55, 'CIENCIAS SOCIALES 2', 1),
(56, 'SPELLING 2', 1),
(57, 'MUSICA 2', 1),
(58, 'MATH/PRACTICE 2', 1),
(59, 'MATH 3', 1),
(60, 'SOCIAL STUDIES 3', 1),
(61, 'BIBLE 3', 1),
(62, 'ESPAÑOL 3', 1),
(63, 'CIENCIAS SOCIALES 3', 1),
(64, 'PHONICS 3', 1),
(65, 'LANGUAGE 3', 1),
(66, 'PHYSICAL EDUCATION 3', 1),
(67, 'SCIENCE 3', 1),
(68, 'READING 3', 1),
(69, 'HEALTH 3', 1),
(70, 'MUSIC 3', 1),
(71, 'SPELLING 3', 1),
(72, 'COMPUTACIÓN 3', 1),
(73, 'ART 3', 1),
(74, 'SPELLING 4', 1),
(75, 'ESPAÑOL 4', 1),
(76, 'READING 4', 1),
(77, 'MATH/PRACTICE 3', 1),
(78, 'MATH 4', 1),
(79, 'MATH/PRACTICE 4', 1),
(80, 'WRITING 1', 1),
(81, 'WRITING 2', 1),
(82, 'WRITING 3', 1),
(83, 'WRITING 4', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasesxgrado`
--
-- Creación: 06-05-2018 a las 21:22:00
--

DROP TABLE IF EXISTS `clasesxgrado`;
CREATE TABLE IF NOT EXISTS `clasesxgrado` (
  `ID_GRADO` int(11) NOT NULL,
  `ID_CLASE` int(11) NOT NULL,
  PRIMARY KEY (`ID_GRADO`,`ID_CLASE`),
  KEY `fk_grado_has_clase_clase1_idx` (`ID_CLASE`),
  KEY `fk_grado_has_clase_grado1_idx` (`ID_GRADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `clasesxgrado`:
--   `ID_CLASE`
--       `clase` -> `ID_CLASE`
--   `ID_GRADO`
--       `grado` -> `ID_GRADO`
--

--
-- Volcado de datos para la tabla `clasesxgrado`
--

INSERT INTO `clasesxgrado` (`ID_GRADO`, `ID_CLASE`) VALUES
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(2, 4),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(3, 5),
(3, 12),
(3, 31),
(3, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 36),
(3, 37),
(3, 38),
(3, 39),
(3, 40),
(3, 41),
(3, 42),
(3, 43),
(3, 80),
(4, 44),
(4, 45),
(4, 46),
(4, 47),
(4, 48),
(4, 49),
(4, 50),
(4, 51),
(4, 52),
(4, 53),
(4, 54),
(4, 55),
(4, 56),
(4, 57),
(4, 58),
(4, 81),
(5, 59),
(5, 60),
(5, 61),
(5, 62),
(5, 63),
(5, 64),
(5, 65),
(5, 66),
(5, 67),
(5, 68),
(5, 69),
(5, 70),
(5, 71),
(5, 72),
(5, 73),
(5, 77),
(5, 82),
(6, 74),
(6, 75),
(6, 76),
(6, 78),
(6, 79),
(6, 83),
(7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasexalumno`
--
-- Creación: 06-05-2018 a las 23:28:36
--

DROP TABLE IF EXISTS `clasexalumno`;
CREATE TABLE IF NOT EXISTS `clasexalumno` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ID_CLASE` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  `ID_SECCION` int(10) NOT NULL,
  `ID_JORNADA` int(10) NOT NULL,
  `ID_PERIODO` int(10) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_clase_has_alumno_alumno1_idx` (`ID_ALUMNO`),
  KEY `fk_clase_has_alumno_clase1_idx` (`ID_CLASE`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `clasexalumno`:
--   `ID_ALUMNO`
--       `alumno` -> `ID_ALUMNO`
--   `ID_CLASE`
--       `clase` -> `ID_CLASE`
--

--
-- Volcado de datos para la tabla `clasexalumno`
--

INSERT INTO `clasexalumno` (`ID`, `ID_CLASE`, `ID_ALUMNO`, `ID_SECCION`, `ID_JORNADA`, `ID_PERIODO`) VALUES
(1, 6, 1, 1, 1, 9),
(2, 7, 1, 1, 1, 9),
(3, 8, 1, 1, 1, 9),
(4, 9, 1, 1, 1, 9),
(5, 10, 1, 1, 1, 9),
(6, 11, 1, 1, 1, 9),
(7, 13, 1, 1, 1, 9),
(8, 14, 1, 1, 1, 9),
(9, 15, 1, 1, 1, 9),
(10, 16, 1, 1, 1, 9),
(11, 17, 1, 1, 1, 9),
(12, 18, 1, 1, 1, 9),
(13, 19, 1, 1, 1, 9),
(14, 6, 1, 1, 1, 45),
(15, 7, 1, 1, 1, 45),
(16, 8, 1, 1, 1, 45),
(17, 9, 1, 1, 1, 45),
(18, 10, 1, 1, 1, 45),
(19, 11, 1, 1, 1, 45),
(20, 13, 1, 1, 1, 45),
(21, 14, 1, 1, 1, 45),
(22, 15, 1, 1, 1, 45),
(23, 16, 1, 1, 1, 45),
(24, 17, 1, 1, 1, 45),
(25, 18, 1, 1, 1, 45),
(26, 19, 1, 1, 1, 45),
(27, 6, 1, 1, 1, 45),
(28, 7, 1, 1, 1, 45),
(29, 8, 1, 1, 1, 45),
(30, 9, 1, 1, 1, 45),
(31, 10, 1, 1, 1, 45),
(32, 11, 1, 1, 1, 45),
(33, 13, 1, 1, 1, 45),
(34, 14, 1, 1, 1, 45),
(35, 15, 1, 1, 1, 45),
(36, 16, 1, 1, 1, 45),
(37, 17, 1, 1, 1, 45),
(38, 18, 1, 1, 1, 45),
(39, 19, 1, 1, 1, 45),
(40, 6, 1, 1, 1, 45),
(41, 7, 1, 1, 1, 45),
(42, 8, 1, 1, 1, 45),
(43, 9, 1, 1, 1, 45),
(44, 10, 1, 1, 1, 45),
(45, 11, 1, 1, 1, 45),
(46, 13, 1, 1, 1, 45),
(47, 14, 1, 1, 1, 45),
(48, 15, 1, 1, 1, 45),
(49, 16, 1, 1, 1, 45),
(50, 17, 1, 1, 1, 45),
(51, 18, 1, 1, 1, 45),
(52, 19, 1, 1, 1, 45),
(53, 6, 1, 1, 1, 9),
(54, 7, 1, 1, 1, 9),
(55, 8, 1, 1, 1, 9),
(56, 9, 1, 1, 1, 9),
(57, 10, 1, 1, 1, 9),
(58, 11, 1, 1, 1, 9),
(59, 13, 1, 1, 1, 9),
(60, 14, 1, 1, 1, 9),
(61, 15, 1, 1, 1, 9),
(62, 16, 1, 1, 1, 9),
(63, 17, 1, 1, 1, 9),
(64, 18, 1, 1, 1, 9),
(65, 19, 1, 1, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasexmaestro`
--
-- Creación: 06-05-2018 a las 21:22:00
--

DROP TABLE IF EXISTS `clasexmaestro`;
CREATE TABLE IF NOT EXISTS `clasexmaestro` (
  `ID_CLASE` int(11) NOT NULL,
  `ID_MAESTRO` int(11) NOT NULL,
  PRIMARY KEY (`ID_CLASE`,`ID_MAESTRO`),
  KEY `fk_clase_has_maestro_maestro1_idx` (`ID_MAESTRO`),
  KEY `fk_clase_has_maestro_clase1_idx` (`ID_CLASE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `clasexmaestro`:
--   `ID_CLASE`
--       `clase` -> `ID_CLASE`
--   `ID_MAESTRO`
--       `persona` -> `ID_PERSONA`
--

--
-- Volcado de datos para la tabla `clasexmaestro`
--

INSERT INTO `clasexmaestro` (`ID_CLASE`, `ID_MAESTRO`) VALUES
(1, 9),
(3, 10),
(4, 10),
(5, 10),
(6, 10),
(7, 10),
(8, 10),
(9, 10),
(10, 10),
(11, 10),
(13, 10),
(14, 10),
(15, 10),
(16, 10),
(17, 10),
(18, 10),
(19, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--
-- Creación: 06-05-2018 a las 21:22:01
--

DROP TABLE IF EXISTS `encargado`;
CREATE TABLE IF NOT EXISTS `encargado` (
  `ID_ENCARGADO` int(11) NOT NULL,
  `CARGO` varchar(45) NOT NULL,
  `LUGAR_TRABAJO` varchar(45) NOT NULL,
  `PROFESION` varchar(45) DEFAULT NULL,
  `TELE_OFICINA` int(11) DEFAULT NULL,
  `PARENTESCO` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_ENCARGADO`),
  KEY `fk_encargado_persona1_idx` (`ID_ENCARGADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `encargado`:
--   `ID_ENCARGADO`
--       `persona` -> `ID_PERSONA`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargadoxalumno`
--
-- Creación: 06-05-2018 a las 21:22:01
--

DROP TABLE IF EXISTS `encargadoxalumno`;
CREATE TABLE IF NOT EXISTS `encargadoxalumno` (
  `ID_ENCARGADO` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  PRIMARY KEY (`ID_ENCARGADO`,`ID_ALUMNO`),
  KEY `fk_encargado_has_alumno_alumno2_idx` (`ID_ALUMNO`),
  KEY `fk_encargado_has_alumno_encargado1_idx` (`ID_ENCARGADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `encargadoxalumno`:
--   `ID_ALUMNO`
--       `alumno` -> `ID_ALUMNO`
--   `ID_ENCARGADO`
--       `encargado` -> `ID_ENCARGADO`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--
-- Creación: 06-05-2018 a las 21:22:01
--

DROP TABLE IF EXISTS `grado`;
CREATE TABLE IF NOT EXISTS `grado` (
  `ID_GRADO` int(11) NOT NULL,
  `NOMBRE_GRADO` varchar(45) NOT NULL,
  `GRADO_ACTIVO` int(1) NOT NULL,
  PRIMARY KEY (`ID_GRADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `grado`:
--

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`ID_GRADO`, `NOMBRE_GRADO`, `GRADO_ACTIVO`) VALUES
(1, 'K4', 1),
(2, 'K5', 1),
(3, 'Primero', 1),
(4, 'Segundo', 1),
(5, 'Tercero', 1),
(6, 'Cuarto', 1),
(7, 'Quinto', 1),
(8, 'Sexto', 0),
(9, 'Septimo', 0),
(10, 'Octavo', 0),
(11, 'Noveno', 0),
(12, 'Decimo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_medica`
--
-- Creación: 06-05-2018 a las 21:22:01
--

DROP TABLE IF EXISTS `informacion_medica`;
CREATE TABLE IF NOT EXISTS `informacion_medica` (
  `ID_INFO_MEDICA` int(11) NOT NULL,
  `ALERGIAS` varchar(100) DEFAULT NULL,
  `TIPO_SANGRE` varchar(45) DEFAULT NULL,
  `PROBLEMAS_VISUALES` varchar(100) DEFAULT NULL,
  `ENFERMEDADES` varchar(100) DEFAULT NULL,
  `MEDICO_FAMILIAR` varchar(100) DEFAULT NULL,
  `MEDICAMENTOS` varchar(100) DEFAULT NULL,
  `CLINICA` varchar(100) DEFAULT NULL,
  `ATENCIONES_ESPECIALES` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_INFO_MEDICA`),
  KEY `fk_informacion_medica_alumno1_idx` (`ID_INFO_MEDICA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `informacion_medica`:
--

--
-- Volcado de datos para la tabla `informacion_medica`
--

INSERT INTO `informacion_medica` (`ID_INFO_MEDICA`, `ALERGIAS`, `TIPO_SANGRE`, `PROBLEMAS_VISUALES`, `ENFERMEDADES`, `MEDICO_FAMILIAR`, `MEDICAMENTOS`, `CLINICA`, `ATENCIONES_ESPECIALES`) VALUES
(1, 'No', 'O+', 'NO', 'No', 'Medico', 'No', 'Clinica', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--
-- Creación: 06-05-2018 a las 21:22:02
--

DROP TABLE IF EXISTS `jornada`;
CREATE TABLE IF NOT EXISTS `jornada` (
  `ID_JORNADA` int(11) NOT NULL,
  `NOMBRE_JORNADA` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_JORNADA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `jornada`:
--

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`ID_JORNADA`, `NOMBRE_JORNADA`) VALUES
(1, 'MATUTINA'),
(2, 'VESPERTINA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limites`
--
-- Creación: 07-05-2018 a las 01:56:23
--

DROP TABLE IF EXISTS `limites`;
CREATE TABLE IF NOT EXISTS `limites` (
  `id_limite` int(10) NOT NULL AUTO_INCREMENT,
  `homework` int(3) NOT NULL,
  `id_grado` int(10) NOT NULL,
  `classwork` int(11) NOT NULL,
  `classwork_evaluation` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  PRIMARY KEY (`id_limite`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `limites`:
--

--
-- Volcado de datos para la tabla `limites`
--

INSERT INTO `limites` (`id_limite`, `homework`, `id_grado`, `classwork`, `classwork_evaluation`, `test`) VALUES
(1, 20, 1, 20, 30, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--
-- Creación: 06-05-2018 a las 21:22:02
--

DROP TABLE IF EXISTS `maestro`;
CREATE TABLE IF NOT EXISTS `maestro` (
  `ID_MAESTRO` int(11) NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `SALARIO` decimal(10,0) NOT NULL,
  `CARGO` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_MAESTRO`),
  KEY `fk_maestro_persona1_idx` (`ID_MAESTRO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `maestro`:
--   `ID_MAESTRO`
--       `persona` -> `ID_PERSONA`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--
-- Creación: 06-05-2018 a las 21:22:03
--

DROP TABLE IF EXISTS `matricula`;
CREATE TABLE IF NOT EXISTS `matricula` (
  `ID_MATRICULA` int(11) NOT NULL,
  `ID_GRADO` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  PRIMARY KEY (`ID_GRADO`,`ID_ALUMNO`),
  KEY `fk_matricula_alumno1_idx` (`ID_ALUMNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `matricula`:
--   `ID_ALUMNO`
--       `alumno` -> `ID_ALUMNO`
--   `ID_GRADO`
--       `grado` -> `ID_GRADO`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcial`
--
-- Creación: 06-05-2018 a las 21:22:03
--

DROP TABLE IF EXISTS `parcial`;
CREATE TABLE IF NOT EXISTS `parcial` (
  `ID_PARCIAL` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_PARCIAL` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_PARCIAL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `parcial`:
--

--
-- Volcado de datos para la tabla `parcial`
--

INSERT INTO `parcial` (`ID_PARCIAL`, `NOMBRE_PARCIAL`) VALUES
(1, 'PRIMERO'),
(2, 'SEGUNDO'),
(3, 'TERCERO'),
(4, 'CUARTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--
-- Creación: 06-05-2018 a las 21:22:03
--

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE IF NOT EXISTS `periodo` (
  `id_periodo` int(10) NOT NULL AUTO_INCREMENT,
  `anio` int(4) NOT NULL,
  `periodo` int(1) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `periodo`:
--

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `anio`, `periodo`, `estado`) VALUES
(9, 2018, 4, 0),
(10, 2018, 2, 0),
(44, 2018, 1, 0),
(45, 2018, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--
-- Creación: 06-05-2018 a las 21:22:04
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `ID_PERSONA` int(11) NOT NULL AUTO_INCREMENT,
  `PRIVILEGIO_ID_PRIVILEGIO` int(11) NOT NULL,
  `NOMBRES` varchar(100) NOT NULL,
  `APELLIDOS` varchar(100) NOT NULL,
  `FECHA_NACIMIENTO` date NOT NULL,
  `EDAD` int(11) NOT NULL,
  `LUGAR_NACIMIENTO` varchar(100) NOT NULL,
  `CIUDAD` varchar(45) NOT NULL,
  `DEPARTAMENTO` varchar(45) NOT NULL,
  `COLONIA` varchar(45) DEFAULT NULL,
  `CALLE_AVENIDA` varchar(45) DEFAULT NULL,
  `TELEFONO_CASA` int(11) DEFAULT NULL,
  `BLOQUE` varchar(45) DEFAULT NULL,
  `NO_CASA` int(11) DEFAULT NULL,
  `FOTO` blob,
  `NO_IDENTIDAD` varchar(45) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `USUARIO` varchar(45) DEFAULT NULL,
  `CONTRASENIA` varchar(45) DEFAULT NULL,
  `ACTIVO_PERSONA` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID_PERSONA`,`PRIVILEGIO_ID_PRIVILEGIO`),
  KEY `fk_persona_privilegio1_idx` (`PRIVILEGIO_ID_PRIVILEGIO`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `persona`:
--   `PRIVILEGIO_ID_PRIVILEGIO`
--       `privilegio` -> `ID_PRIVILEGIO`
--

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ID_PERSONA`, `PRIVILEGIO_ID_PRIVILEGIO`, `NOMBRES`, `APELLIDOS`, `FECHA_NACIMIENTO`, `EDAD`, `LUGAR_NACIMIENTO`, `CIUDAD`, `DEPARTAMENTO`, `COLONIA`, `CALLE_AVENIDA`, `TELEFONO_CASA`, `BLOQUE`, `NO_CASA`, `FOTO`, `NO_IDENTIDAD`, `EMAIL`, `USUARIO`, `CONTRASENIA`, `ACTIVO_PERSONA`) VALUES
(9, 1, 'Maria', 'Gonzalez', '0000-00-00', 0, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'admin@gmail.com', 'admin', 'admin', b'1'),
(10, 2, 'Luis', 'Perez', '0000-00-00', 0, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'admin@gmail.com', 'luis', 'luis', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--
-- Creación: 06-05-2018 a las 21:22:04
--

DROP TABLE IF EXISTS `privilegio`;
CREATE TABLE IF NOT EXISTS `privilegio` (
  `ID_PRIVILEGIO` int(11) NOT NULL,
  `NOMBRE_PRIVILEGIO` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_PRIVILEGIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `privilegio`:
--

--
-- Volcado de datos para la tabla `privilegio`
--

INSERT INTO `privilegio` (`ID_PRIVILEGIO`, `NOMBRE_PRIVILEGIO`) VALUES
(1, 'Administrador'),
(2, 'Maestro'),
(3, 'Encargado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--
-- Creación: 06-05-2018 a las 21:22:05
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
  `ID_SECCION` int(11) NOT NULL,
  `NOMBRE_SECCION` varchar(45) NOT NULL,
  `SECCION_ACTIVO` int(1) NOT NULL,
  PRIMARY KEY (`ID_SECCION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `seccion`:
--

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`ID_SECCION`, `NOMBRE_SECCION`, `SECCION_ACTIVO`) VALUES
(1, 'A', 0),
(2, 'B', 1),
(3, 'C', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccionesxgrado`
--
-- Creación: 07-05-2018 a las 02:54:44
--

DROP TABLE IF EXISTS `seccionesxgrado`;
CREATE TABLE IF NOT EXISTS `seccionesxgrado` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ESTADO` int(2) NOT NULL DEFAULT '1',
  `ID_JORNADA` int(11) NOT NULL,
  `ID_GRADO` int(11) NOT NULL,
  `ID_SECCION` int(11) NOT NULL,
  `ID_PERIODO` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `seccionesxgrado`:
--

--
-- Volcado de datos para la tabla `seccionesxgrado`
--

INSERT INTO `seccionesxgrado` (`ID`, `ESTADO`, `ID_JORNADA`, `ID_GRADO`, `ID_SECCION`, `ID_PERIODO`) VALUES
(1, 1, 1, 1, 1, 9),
(2, 1, 1, 1, 2, 9),
(3, 1, 1, 4, 1, 9),
(4, 1, 2, 4, 2, 9),
(5, 1, 1, 1, 1, 45);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD CONSTRAINT `fk_administracion_persona1` FOREIGN KEY (`ID_ADMINISTRACION`) REFERENCES `persona` (`ID_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clasesxgrado`
--
ALTER TABLE `clasesxgrado`
  ADD CONSTRAINT `fk_grado_has_clase_clase1` FOREIGN KEY (`ID_CLASE`) REFERENCES `clase` (`ID_CLASE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grado_has_clase_grado1` FOREIGN KEY (`ID_GRADO`) REFERENCES `grado` (`ID_GRADO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clasexalumno`
--
ALTER TABLE `clasexalumno`
  ADD CONSTRAINT `fk_clase_has_alumno_alumno1` FOREIGN KEY (`ID_ALUMNO`) REFERENCES `alumno` (`ID_ALUMNO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clase_has_alumno_clase1` FOREIGN KEY (`ID_CLASE`) REFERENCES `clase` (`ID_CLASE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clasexmaestro`
--
ALTER TABLE `clasexmaestro`
  ADD CONSTRAINT `fk_clase_has_maestro_clase1` FOREIGN KEY (`ID_CLASE`) REFERENCES `clase` (`ID_CLASE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clase_has_maestro_maestro1` FOREIGN KEY (`ID_MAESTRO`) REFERENCES `persona` (`ID_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `encargado`
--
ALTER TABLE `encargado`
  ADD CONSTRAINT `fk_encargado_persona1` FOREIGN KEY (`ID_ENCARGADO`) REFERENCES `persona` (`ID_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `encargadoxalumno`
--
ALTER TABLE `encargadoxalumno`
  ADD CONSTRAINT `fk_encargado_has_alumno_alumno2` FOREIGN KEY (`ID_ALUMNO`) REFERENCES `alumno` (`ID_ALUMNO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_encargado_has_alumno_encargado1` FOREIGN KEY (`ID_ENCARGADO`) REFERENCES `encargado` (`ID_ENCARGADO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD CONSTRAINT `fk_maestro_persona1` FOREIGN KEY (`ID_MAESTRO`) REFERENCES `persona` (`ID_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_matricula_alumno1` FOREIGN KEY (`ID_ALUMNO`) REFERENCES `alumno` (`ID_ALUMNO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_grado1` FOREIGN KEY (`ID_GRADO`) REFERENCES `grado` (`ID_GRADO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_privilegio1` FOREIGN KEY (`PRIVILEGIO_ID_PRIVILEGIO`) REFERENCES `privilegio` (`ID_PRIVILEGIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla administracion
--

--
-- Metadatos para la tabla alumno
--

--
-- Metadatos para la tabla calificaciones
--

--
-- Metadatos para la tabla categoria
--

--
-- Metadatos para la tabla clase
--

--
-- Metadatos para la tabla clasesxgrado
--

--
-- Metadatos para la tabla clasexalumno
--

--
-- Metadatos para la tabla clasexmaestro
--

--
-- Metadatos para la tabla encargado
--

--
-- Metadatos para la tabla encargadoxalumno
--

--
-- Metadatos para la tabla grado
--

--
-- Metadatos para la tabla informacion_medica
--

--
-- Metadatos para la tabla jornada
--

--
-- Metadatos para la tabla limites
--

--
-- Metadatos para la tabla maestro
--

--
-- Metadatos para la tabla matricula
--

--
-- Metadatos para la tabla parcial
--

--
-- Metadatos para la tabla periodo
--

--
-- Metadatos para la tabla persona
--

--
-- Metadatos para la tabla privilegio
--

--
-- Metadatos para la tabla seccion
--

--
-- Metadatos para la tabla seccionesxgrado
--

--
-- Metadatos para la base de datos sistema
--

--
-- Volcado de datos para la tabla `pma__central_columns`
--

INSERT INTO `pma__central_columns` (`db_name`, `col_name`, `col_type`, `col_length`, `col_collation`, `col_isNull`, `col_extra`, `col_default`) VALUES
('sistema', 'ID_MAESTRO', 'int', '11', '', 0, ',', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
