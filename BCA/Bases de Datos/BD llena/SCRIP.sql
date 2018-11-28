-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2018 a las 19:29:45
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
-- Creación: 07-05-2018 a las 20:44:34
--

DROP TABLE IF EXISTS `administracion`;
CREATE TABLE `administracion` (
  `ID_ADMINISTRACION` int(11) NOT NULL,
  `SALARIO` decimal(10,0) NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `CARGO` varchar(45) NOT NULL
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
-- Creación: 07-05-2018 a las 20:44:34
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE `alumno` (
  `ID_ALUMNO` int(11) NOT NULL,
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
  `NO_IDENTIDAD` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `alumno`:
--

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`ID_ALUMNO`, `ID_INFO_MEDICA`, `NOMBRE`, `ESCUELA_PROCEDENCIA`, `UTILIZA_TRANSPORTE`, `NOTAS`, `CROQUIS`, `ACTIVO_ALUMNO`, `DIRECCION`, `LUGAR_NACIMIENTO`, `FECHA_NACIMIENTO`, `RELIGION`, `NO_IDENTIDAD`) VALUES
(1, 1, 'Darwin Hernandez', ' ', b'1', '56', 0x20, b'1', ' ', ' ', '2013-05-12', ' ', '1'),
(4, 1, 'Celeste Andino', '', b'1', '0', 0x4e2f41, b'1', '', ' ', '2014-04-12', '', ''),
(10, 1, 'Ingrid Lopez', 'Esc.Honduras', b'1', '0', 0x4e2f41, b'1', 'NA', ' ', '2010-05-12', 'Catolica', '0801201000021');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--
-- Creación: 07-05-2018 a las 20:44:35
--

DROP TABLE IF EXISTS `calificaciones`;
CREATE TABLE `calificaciones` (
  `ID_CALIFICACIONES` int(11) NOT NULL,
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
  `ANIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `calificaciones`:
--

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`ID_CALIFICACIONES`, `ID_PARCIAL`, `ID_CATEGORIA`, `ID_SECCION`, `ID_ALUMNO`, `ID_CLASE`, `HOMEWORK`, `CLASSWORK`, `CLASSWORK_EVALUATION`, `TEST`, `PUNTAJE`, `NOTA`, `FECHA_TAREA`, `ANIO`) VALUES
(1, 1, 0, 1, 1, 6, 10, 20, 0, 0, '1', '0', '0000-00-00', 48),
(2, 2, 0, 1, 1, 6, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(3, 3, 0, 1, 1, 6, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(4, 4, 0, 1, 1, 6, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(5, 1, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(6, 2, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(7, 3, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(8, 4, 0, 1, 1, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(9, 1, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(10, 2, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(11, 3, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(12, 4, 0, 1, 1, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(13, 1, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(14, 2, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(15, 3, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(16, 4, 0, 1, 1, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(17, 1, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(18, 2, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(19, 3, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(20, 4, 0, 1, 1, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(21, 1, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(22, 2, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(23, 3, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(24, 4, 0, 1, 1, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(25, 1, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(26, 2, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(27, 3, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(28, 4, 0, 1, 1, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(29, 1, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(30, 2, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(31, 3, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(32, 4, 0, 1, 1, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(33, 1, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(34, 2, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(35, 3, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(36, 4, 0, 1, 1, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(37, 1, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(38, 2, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(39, 3, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(40, 4, 0, 1, 1, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(41, 1, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(42, 2, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(43, 3, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(44, 4, 0, 1, 1, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(45, 1, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(46, 2, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(47, 3, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(48, 4, 0, 1, 1, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(49, 1, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(50, 2, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(51, 3, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(52, 4, 0, 1, 1, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(53, 1, 0, 1, 10, 6, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(54, 2, 0, 1, 10, 6, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(55, 3, 0, 1, 10, 6, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(56, 4, 0, 1, 10, 6, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(57, 1, 0, 1, 10, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(58, 2, 0, 1, 10, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(59, 3, 0, 1, 10, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(60, 4, 0, 1, 10, 7, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(61, 1, 0, 1, 10, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(62, 2, 0, 1, 10, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(63, 3, 0, 1, 10, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(64, 4, 0, 1, 10, 8, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(65, 1, 0, 1, 10, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(66, 2, 0, 1, 10, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(67, 3, 0, 1, 10, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(68, 4, 0, 1, 10, 9, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(69, 1, 0, 1, 10, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(70, 2, 0, 1, 10, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(71, 3, 0, 1, 10, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(72, 4, 0, 1, 10, 10, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(73, 1, 0, 1, 10, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(74, 2, 0, 1, 10, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(75, 3, 0, 1, 10, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(76, 4, 0, 1, 10, 11, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(77, 1, 0, 1, 10, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(78, 2, 0, 1, 10, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(79, 3, 0, 1, 10, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(80, 4, 0, 1, 10, 13, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(81, 1, 0, 1, 10, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(82, 2, 0, 1, 10, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(83, 3, 0, 1, 10, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(84, 4, 0, 1, 10, 14, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(85, 1, 0, 1, 10, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(86, 2, 0, 1, 10, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(87, 3, 0, 1, 10, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(88, 4, 0, 1, 10, 15, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(89, 1, 0, 1, 10, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(90, 2, 0, 1, 10, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(91, 3, 0, 1, 10, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(92, 4, 0, 1, 10, 16, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(93, 1, 0, 1, 10, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(94, 2, 0, 1, 10, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(95, 3, 0, 1, 10, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(96, 4, 0, 1, 10, 17, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(97, 1, 0, 1, 10, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(98, 2, 0, 1, 10, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(99, 3, 0, 1, 10, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(100, 4, 0, 1, 10, 18, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(101, 1, 0, 1, 10, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(102, 2, 0, 1, 10, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(103, 3, 0, 1, 10, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 48),
(104, 4, 0, 1, 10, 19, 0, 0, 0, 0, '0', '0', '0000-00-00', 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--
-- Creación: 07-05-2018 a las 20:44:35
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOMBRE_CATEGORIA` varchar(45) NOT NULL,
  `PORCENTAJE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `categoria`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--
-- Creación: 07-05-2018 a las 20:44:35
--

DROP TABLE IF EXISTS `clase`;
CREATE TABLE `clase` (
  `ID_CLASE` int(11) NOT NULL,
  `NOMBRE_CLASE` varchar(45) NOT NULL,
  `ESTADO_CLASE` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Creación: 07-05-2018 a las 20:44:36
--

DROP TABLE IF EXISTS `clasesxgrado`;
CREATE TABLE `clasesxgrado` (
  `ID_GRADO` int(11) NOT NULL,
  `ID_CLASE` int(11) NOT NULL
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
-- Creación: 12-05-2018 a las 14:55:56
--

DROP TABLE IF EXISTS `clasexalumno`;
CREATE TABLE `clasexalumno` (
  `ID` int(10) NOT NULL,
  `ID_CLASE` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  `ID_SECCION` int(10) NOT NULL,
  `ID_JORNADA` int(10) NOT NULL,
  `ID_PERIODO` int(10) NOT NULL,
  `ESTADO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

INSERT INTO `clasexalumno` (`ID`, `ID_CLASE`, `ID_ALUMNO`, `ID_SECCION`, `ID_JORNADA`, `ID_PERIODO`, `ESTADO`) VALUES
(1, 6, 1, 1, 1, 48, 1),
(2, 7, 1, 1, 1, 48, 1),
(3, 8, 1, 1, 1, 48, 1),
(4, 9, 1, 1, 1, 48, 1),
(5, 10, 1, 1, 1, 48, 1),
(6, 11, 1, 1, 1, 48, 1),
(7, 13, 1, 1, 1, 48, 1),
(8, 14, 1, 1, 1, 48, 1),
(9, 15, 1, 1, 1, 48, 1),
(10, 16, 1, 1, 1, 48, 1),
(11, 17, 1, 1, 1, 48, 1),
(12, 18, 1, 1, 1, 48, 1),
(13, 19, 1, 1, 1, 48, 1),
(14, 6, 10, 1, 1, 48, 1),
(15, 7, 10, 1, 1, 48, 1),
(16, 8, 10, 1, 1, 48, 1),
(17, 9, 10, 1, 1, 48, 1),
(18, 10, 10, 1, 1, 48, 1),
(19, 11, 10, 1, 1, 48, 1),
(20, 13, 10, 1, 1, 48, 1),
(21, 14, 10, 1, 1, 48, 1),
(22, 15, 10, 1, 1, 48, 1),
(23, 16, 10, 1, 1, 48, 1),
(24, 17, 10, 1, 1, 48, 1),
(25, 18, 10, 1, 1, 48, 1),
(26, 19, 10, 1, 1, 48, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasexmaestro`
--
-- Creación: 07-05-2018 a las 20:44:37
--

DROP TABLE IF EXISTS `clasexmaestro`;
CREATE TABLE `clasexmaestro` (
  `ID_CLASE` int(11) NOT NULL,
  `ID_MAESTRO` int(11) NOT NULL
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
-- Creación: 07-05-2018 a las 20:44:37
--

DROP TABLE IF EXISTS `encargado`;
CREATE TABLE `encargado` (
  `ID_ENCARGADO` int(11) NOT NULL,
  `CARGO` varchar(45) NOT NULL,
  `LUGAR_TRABAJO` varchar(45) NOT NULL,
  `PROFESION` varchar(45) DEFAULT NULL,
  `TELE_OFICINA` int(11) DEFAULT NULL,
  `PARENTESCO` varchar(45) NOT NULL
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
-- Creación: 07-05-2018 a las 20:44:37
--

DROP TABLE IF EXISTS `encargadoxalumno`;
CREATE TABLE `encargadoxalumno` (
  `ID_ENCARGADO` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL
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
-- Creación: 07-05-2018 a las 20:44:37
--

DROP TABLE IF EXISTS `grado`;
CREATE TABLE `grado` (
  `ID_GRADO` int(11) NOT NULL,
  `NOMBRE_GRADO` varchar(45) NOT NULL,
  `GRADO_ACTIVO` int(1) NOT NULL
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
-- Creación: 07-05-2018 a las 20:44:37
--

DROP TABLE IF EXISTS `informacion_medica`;
CREATE TABLE `informacion_medica` (
  `ID_INFO_MEDICA` int(11) NOT NULL,
  `ALERGIAS` varchar(100) DEFAULT NULL,
  `TIPO_SANGRE` varchar(45) DEFAULT NULL,
  `PROBLEMAS_VISUALES` varchar(100) DEFAULT NULL,
  `ENFERMEDADES` varchar(100) DEFAULT NULL,
  `MEDICO_FAMILIAR` varchar(100) DEFAULT NULL,
  `MEDICAMENTOS` varchar(100) DEFAULT NULL,
  `CLINICA` varchar(100) DEFAULT NULL,
  `ATENCIONES_ESPECIALES` varchar(100) DEFAULT NULL
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
-- Creación: 07-05-2018 a las 20:44:38
--

DROP TABLE IF EXISTS `jornada`;
CREATE TABLE `jornada` (
  `ID_JORNADA` int(11) NOT NULL,
  `NOMBRE_JORNADA` varchar(45) NOT NULL
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
-- Creación: 07-05-2018 a las 20:44:38
--

DROP TABLE IF EXISTS `limites`;
CREATE TABLE `limites` (
  `id_limite` int(10) NOT NULL,
  `homework` int(3) NOT NULL,
  `id_grado` int(10) NOT NULL,
  `classwork` int(11) NOT NULL,
  `classwork_evaluation` int(11) NOT NULL,
  `test` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Creación: 07-05-2018 a las 20:44:38
--

DROP TABLE IF EXISTS `maestro`;
CREATE TABLE `maestro` (
  `ID_MAESTRO` int(11) NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `SALARIO` decimal(10,0) NOT NULL,
  `CARGO` varchar(45) NOT NULL
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
-- Creación: 07-05-2018 a las 20:44:39
--

DROP TABLE IF EXISTS `matricula`;
CREATE TABLE `matricula` (
  `ID_MATRICULA` int(11) NOT NULL,
  `ID_GRADO` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL
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
-- Creación: 07-05-2018 a las 20:44:39
--

DROP TABLE IF EXISTS `parcial`;
CREATE TABLE `parcial` (
  `ID_PARCIAL` int(11) NOT NULL,
  `NOMBRE_PARCIAL` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Creación: 07-05-2018 a las 21:24:43
--

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE `periodo` (
  `id_periodo` int(10) NOT NULL,
  `anio` int(4) NOT NULL,
  `periodo` int(1) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `periodo`:
--

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `anio`, `periodo`, `estado`) VALUES
(48, 2018, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--
-- Creación: 07-05-2018 a las 20:47:53
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `ID_PERSONA` int(11) NOT NULL,
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
  `ACTIVO_PERSONA` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Creación: 07-05-2018 a las 21:24:44
--

DROP TABLE IF EXISTS `privilegio`;
CREATE TABLE `privilegio` (
  `ID_PRIVILEGIO` int(11) NOT NULL,
  `NOMBRE_PRIVILEGIO` varchar(45) NOT NULL
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
-- Creación: 07-05-2018 a las 21:24:44
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE `seccion` (
  `ID_SECCION` int(11) NOT NULL,
  `NOMBRE_SECCION` varchar(45) NOT NULL,
  `SECCION_ACTIVO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `seccion`:
--

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`ID_SECCION`, `NOMBRE_SECCION`, `SECCION_ACTIVO`) VALUES
(1, 'A', 1),
(2, 'B', 1),
(3, 'C', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccionesxgrado`
--
-- Creación: 07-05-2018 a las 21:24:45
--

DROP TABLE IF EXISTS `seccionesxgrado`;
CREATE TABLE `seccionesxgrado` (
  `ID` int(10) NOT NULL,
  `ESTADO` int(2) NOT NULL DEFAULT '1',
  `ID_JORNADA` int(11) NOT NULL,
  `ID_GRADO` int(11) NOT NULL,
  `ID_SECCION` int(11) NOT NULL,
  `ID_PERIODO` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `seccionesxgrado`:
--

--
-- Volcado de datos para la tabla `seccionesxgrado`
--

INSERT INTO `seccionesxgrado` (`ID`, `ESTADO`, `ID_JORNADA`, `ID_GRADO`, `ID_SECCION`, `ID_PERIODO`) VALUES
(8, 1, 1, 1, 1, 48);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`ID_ADMINISTRACION`),
  ADD KEY `fk_administracion_persona1_idx` (`ID_ADMINISTRACION`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`ID_ALUMNO`) USING BTREE;

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`ID_CALIFICACIONES`) USING BTREE;

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`ID_CLASE`);

--
-- Indices de la tabla `clasesxgrado`
--
ALTER TABLE `clasesxgrado`
  ADD PRIMARY KEY (`ID_GRADO`,`ID_CLASE`),
  ADD KEY `fk_grado_has_clase_clase1_idx` (`ID_CLASE`),
  ADD KEY `fk_grado_has_clase_grado1_idx` (`ID_GRADO`);

--
-- Indices de la tabla `clasexalumno`
--
ALTER TABLE `clasexalumno`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_clase_has_alumno_alumno1_idx` (`ID_ALUMNO`),
  ADD KEY `fk_clase_has_alumno_clase1_idx` (`ID_CLASE`);

--
-- Indices de la tabla `clasexmaestro`
--
ALTER TABLE `clasexmaestro`
  ADD PRIMARY KEY (`ID_CLASE`,`ID_MAESTRO`),
  ADD KEY `fk_clase_has_maestro_maestro1_idx` (`ID_MAESTRO`),
  ADD KEY `fk_clase_has_maestro_clase1_idx` (`ID_CLASE`);

--
-- Indices de la tabla `encargado`
--
ALTER TABLE `encargado`
  ADD PRIMARY KEY (`ID_ENCARGADO`),
  ADD KEY `fk_encargado_persona1_idx` (`ID_ENCARGADO`);

--
-- Indices de la tabla `encargadoxalumno`
--
ALTER TABLE `encargadoxalumno`
  ADD PRIMARY KEY (`ID_ENCARGADO`,`ID_ALUMNO`),
  ADD KEY `fk_encargado_has_alumno_alumno2_idx` (`ID_ALUMNO`),
  ADD KEY `fk_encargado_has_alumno_encargado1_idx` (`ID_ENCARGADO`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`ID_GRADO`);

--
-- Indices de la tabla `informacion_medica`
--
ALTER TABLE `informacion_medica`
  ADD PRIMARY KEY (`ID_INFO_MEDICA`),
  ADD KEY `fk_informacion_medica_alumno1_idx` (`ID_INFO_MEDICA`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`ID_JORNADA`);

--
-- Indices de la tabla `limites`
--
ALTER TABLE `limites`
  ADD PRIMARY KEY (`id_limite`);

--
-- Indices de la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD PRIMARY KEY (`ID_MAESTRO`),
  ADD KEY `fk_maestro_persona1_idx` (`ID_MAESTRO`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`ID_GRADO`,`ID_ALUMNO`),
  ADD KEY `fk_matricula_alumno1_idx` (`ID_ALUMNO`);

--
-- Indices de la tabla `parcial`
--
ALTER TABLE `parcial`
  ADD PRIMARY KEY (`ID_PARCIAL`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID_PERSONA`,`PRIVILEGIO_ID_PRIVILEGIO`),
  ADD KEY `fk_persona_privilegio1_idx` (`PRIVILEGIO_ID_PRIVILEGIO`);

--
-- Indices de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  ADD PRIMARY KEY (`ID_PRIVILEGIO`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`ID_SECCION`);

--
-- Indices de la tabla `seccionesxgrado`
--
ALTER TABLE `seccionesxgrado`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `ID_ALUMNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `ID_CALIFICACIONES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `ID_CLASE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `clasexalumno`
--
ALTER TABLE `clasexalumno`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `limites`
--
ALTER TABLE `limites`
  MODIFY `id_limite` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `parcial`
--
ALTER TABLE `parcial`
  MODIFY `ID_PARCIAL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `ID_PERSONA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `seccionesxgrado`
--
ALTER TABLE `seccionesxgrado`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
