-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2018 a las 22:53:45
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

CREATE TABLE `administracion` (
  `ID_ADMINISTRACION` int(11) NOT NULL,
  `SALARIO` decimal(10,0) NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `CARGO` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `ID_ALUMNO` int(11) NOT NULL,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `ESCUELA_PROCEDENCIA` varchar(45) DEFAULT NULL,
  `UTILIZA_TRANSPORTE` bit(1) DEFAULT NULL,
  `NOTAS` varchar(100) DEFAULT NULL,
  `CROQUIS` blob,
  `ACTIVO_ALUMNO` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`ID_ALUMNO`, `NOMBRE`, `ESCUELA_PROCEDENCIA`, `UTILIZA_TRANSPORTE`, `NOTAS`, `CROQUIS`, `ACTIVO_ALUMNO`) VALUES
(1, 'Alumno 1', 'Ninguna', b'1', ' ', '', b'1'),
(2, 'alumno 2', 'Ninguna', b'1', ' ', '', b'0'),
(3, 'Alumno 3', 'Ninguna', b'1', ' ', NULL, b'1'),
(4, 'Alumno 4', 'Ninguna', b'1', ' ', NULL, b'1'),
(5, 'Alumno 5', 'Ninguna', b'1', ' ', NULL, b'1'),
(6, 'Alumno 6', 'Ninguna', b'1', ' ', NULL, b'1'),
(7, 'Alumno 7', 'Ninguna', b'1', ' ', NULL, b'1'),
(8, 'Alumno 8', 'Ninguna', b'1', ' ', NULL, b'1'),
(9, 'Alumno 9', 'Ninguna', b'1', ' ', NULL, b'1'),
(10, 'Alumno 10', 'Ninguna', b'1', ' ', NULL, b'1'),
(11, 'Alumno 11', 'Ninguna', b'1', ' ', NULL, b'1'),
(12, 'Alumno 12', 'Ninguna', b'1', ' ', NULL, b'1'),
(13, 'Alumno 13', 'Ninguna', b'1', ' ', NULL, b'1'),
(14, 'Alumno 14', 'Ninguna', b'1', ' ', NULL, b'1'),
(15, 'Alumno 15', 'Ninguna', b'1', ' ', NULL, b'1'),
(16, 'Alumno 16', 'Ninguna', b'1', ' ', NULL, b'1'),
(17, 'Alumno 17', 'Ninguna', b'1', ' ', NULL, b'1'),
(18, 'Alumno 18', 'Ninguna', b'1', ' ', NULL, b'1'),
(19, 'Alumno 19', 'Ninguna', b'1', ' ', NULL, b'1'),
(20, 'Alumno 20', 'Ninguna', b'1', ' ', NULL, b'1'),
(21, 'Alumno 21', 'Ninguna', b'1', ' ', NULL, b'1'),
(22, 'Alumno 22', 'Ninguna', b'1', ' ', NULL, b'1'),
(23, 'Alumno 23', 'Ninguna', b'1', ' ', NULL, b'1'),
(24, 'Alumno 24', 'Ninguna', b'1', ' ', NULL, b'1'),
(25, 'Alumno 25', 'Ninguna', b'1', ' ', NULL, b'1'),
(26, 'Alumno 26', 'Ninguna', b'1', ' ', NULL, b'1'),
(27, 'Alumno 27', 'Ninguna', b'1', ' ', NULL, b'1'),
(28, 'Alumno 28', 'Ninguna', b'1', ' ', NULL, b'1'),
(29, 'Alumno 29', 'Ninguna', b'1', ' ', NULL, b'1'),
(30, 'Alumno 30', 'Ninguna', b'1', ' ', NULL, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `ID_CALIFICACIONES` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  `ID_PARCIAL` int(11) NOT NULL,
  `ID_CLASE` int(11) NOT NULL,
  `ID_CATEGORIA` int(11) NOT NULL,
  `ID_SECCION` int(11) NOT NULL,
  `HOMEWORK` int(2) NOT NULL DEFAULT '0',
  `CLASSWORK` int(2) NOT NULL DEFAULT '0',
  `CLASSWORK_EVALUATION` int(2) NOT NULL DEFAULT '0',
  `TEST` int(2) NOT NULL DEFAULT '0',
  `PUNTAJE` decimal(10,0) NOT NULL,
  `NOTA` decimal(10,0) NOT NULL,
  `FECHA_TAREA` date NOT NULL,
  `ANIO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`ID_CALIFICACIONES`, `ID_ALUMNO`, `ID_PARCIAL`, `ID_CLASE`, `ID_CATEGORIA`, `ID_SECCION`, `HOMEWORK`, `CLASSWORK`, `CLASSWORK_EVALUATION`, `TEST`, `PUNTAJE`, `NOTA`, `FECHA_TAREA`, `ANIO`) VALUES
(3, 1, 3, 3, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(7, 1, 1, 3, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(8, 1, 2, 3, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(9, 1, 4, 3, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(10, 1, 4, 6, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(11, 1, 3, 6, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(12, 1, 2, 6, 0, 1, 0, 0, 20, 0, '0', '0', '0000-00-00', '0000-00-00'),
(13, 1, 1, 6, 0, 1, 10, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(15, 1, 1, 7, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(16, 1, 2, 7, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(17, 1, 3, 7, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(18, 1, 4, 7, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(19, 1, 4, 8, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(20, 1, 3, 8, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(21, 1, 2, 8, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(22, 1, 1, 8, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(23, 1, 1, 9, 0, 1, 1, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(24, 1, 2, 9, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(25, 1, 3, 9, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00'),
(26, 1, 4, 9, 0, 1, 0, 0, 0, 0, '0', '0', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOMBRE_CATEGORIA` varchar(45) NOT NULL,
  `PORCENTAJE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `ID_CLASE` int(11) NOT NULL,
  `NOMBRE_CLASE` varchar(45) NOT NULL,
  `ESTADO_CLASE` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`ID_CLASE`, `NOMBRE_CLASE`, `ESTADO_CLASE`) VALUES
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
(26, '	CONVERSATION K5', 1),
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

CREATE TABLE `clasesxgrado` (
  `ID_CLASESXGRADO` int(11) NOT NULL,
  `ID_GRADO` int(11) NOT NULL,
  `ID_CLASE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clasesxgrado`
--

INSERT INTO `clasesxgrado` (`ID_CLASESXGRADO`, `ID_GRADO`, `ID_CLASE`) VALUES
(24, 1, 6),
(25, 1, 7),
(26, 1, 8),
(27, 1, 9),
(28, 1, 9),
(29, 1, 10),
(30, 1, 10),
(31, 1, 11),
(32, 1, 13),
(33, 1, 14),
(34, 1, 15),
(35, 1, 16),
(36, 1, 18),
(37, 1, 17),
(38, 1, 19),
(39, 2, 4),
(40, 2, 20),
(41, 2, 21),
(42, 2, 22),
(43, 2, 23),
(44, 2, 24),
(45, 2, 25),
(46, 2, 26),
(47, 2, 27),
(48, 2, 28),
(49, 2, 29),
(50, 2, 30),
(51, 3, 5),
(52, 3, 12),
(53, 3, 31),
(54, 3, 32),
(55, 3, 33),
(56, 3, 43),
(57, 3, 37),
(58, 3, 34),
(59, 3, 35),
(60, 3, 36),
(61, 3, 38),
(62, 3, 39),
(63, 3, 40),
(64, 3, 41),
(65, 3, 42),
(66, 6, 83),
(67, 6, 79),
(68, 6, 74),
(69, 6, 75),
(70, 6, 76),
(71, 6, 78),
(72, 5, 82),
(73, 5, 77),
(74, 5, 73),
(75, 5, 72),
(76, 5, 71),
(77, 5, 70),
(78, 5, 69),
(79, 5, 68),
(80, 5, 67),
(81, 5, 66),
(82, 5, 61),
(83, 5, 65),
(84, 5, 64),
(85, 5, 63),
(86, 5, 59),
(87, 5, 62),
(88, 5, 60),
(89, 1, 80),
(90, 4, 44),
(91, 4, 45),
(92, 4, 46),
(93, 4, 47),
(94, 4, 48),
(95, 4, 49),
(96, 4, 50),
(97, 4, 51),
(98, 4, 52),
(99, 4, 53),
(100, 4, 54),
(101, 4, 55),
(102, 4, 56),
(103, 4, 57),
(104, 4, 58),
(105, 4, 81),
(106, 4, 0),
(107, 4, 0),
(108, 4, 0),
(109, 4, 0),
(110, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasexalumno`
--

CREATE TABLE `clasexalumno` (
  `ID_CLASEXALUMNO` int(11) NOT NULL,
  `ID_CLASE` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clasexalumno`
--

INSERT INTO `clasexalumno` (`ID_CLASEXALUMNO`, `ID_CLASE`, `ID_ALUMNO`) VALUES
(19, 6, 1),
(20, 7, 1),
(21, 8, 1),
(22, 9, 1),
(23, 10, 1),
(24, 11, 1),
(25, 6, 5),
(26, 7, 5),
(27, 8, 5),
(28, 9, 5),
(29, 10, 5),
(30, 11, 5),
(31, 6, 4),
(32, 7, 4),
(33, 8, 4),
(34, 9, 4),
(35, 10, 4),
(36, 11, 4),
(37, 6, 3),
(38, 7, 3),
(39, 8, 3),
(40, 9, 3),
(41, 10, 3),
(42, 11, 3),
(43, 6, 2),
(44, 7, 2),
(45, 8, 2),
(46, 9, 2),
(47, 10, 2),
(48, 11, 2),
(49, 13, 2),
(50, 14, 2),
(51, 15, 2),
(52, 16, 2),
(53, 17, 2),
(54, 18, 2),
(55, 19, 2),
(56, 80, 2),
(57, 13, 1),
(58, 14, 1),
(59, 15, 1),
(60, 16, 1),
(61, 17, 1),
(62, 18, 1),
(63, 19, 1),
(64, 80, 1),
(65, 13, 3),
(66, 14, 3),
(67, 15, 3),
(68, 16, 3),
(69, 17, 3),
(70, 18, 3),
(71, 19, 3),
(72, 80, 3),
(73, 13, 4),
(74, 14, 4),
(75, 15, 4),
(76, 16, 4),
(77, 17, 4),
(78, 18, 4),
(79, 19, 4),
(80, 80, 4),
(81, 13, 5),
(82, 14, 5),
(83, 15, 5),
(84, 16, 5),
(85, 17, 5),
(86, 18, 5),
(87, 19, 5),
(88, 80, 5),
(89, 4, 5),
(90, 20, 6),
(91, 21, 6),
(92, 22, 6),
(93, 23, 6),
(94, 24, 6),
(95, 25, 6),
(96, 26, 6),
(97, 27, 6),
(98, 28, 6),
(99, 29, 6),
(100, 30, 6),
(101, 4, 6),
(102, 20, 6),
(103, 21, 6),
(104, 22, 6),
(105, 23, 6),
(106, 24, 6),
(107, 25, 6),
(108, 26, 6),
(109, 27, 6),
(110, 28, 6),
(111, 29, 6),
(112, 30, 6),
(113, 4, 7),
(114, 20, 7),
(115, 21, 7),
(116, 22, 7),
(117, 23, 7),
(118, 24, 7),
(119, 25, 7),
(120, 26, 7),
(121, 27, 7),
(122, 28, 7),
(123, 29, 7),
(124, 30, 7),
(125, 4, 8),
(126, 20, 8),
(127, 21, 8),
(128, 22, 8),
(129, 23, 8),
(130, 24, 8),
(131, 25, 8),
(132, 26, 8),
(133, 27, 8),
(134, 28, 8),
(135, 29, 8),
(136, 30, 8),
(137, 4, 9),
(138, 20, 9),
(139, 21, 9),
(140, 22, 9),
(141, 23, 9),
(142, 24, 9),
(143, 25, 9),
(144, 26, 9),
(145, 27, 9),
(146, 28, 9),
(147, 29, 9),
(148, 30, 9),
(149, 4, 10),
(150, 20, 10),
(151, 21, 10),
(152, 22, 10),
(153, 23, 10),
(154, 24, 10),
(155, 25, 10),
(156, 26, 10),
(157, 27, 10),
(158, 28, 10),
(159, 29, 10),
(160, 30, 10),
(161, 5, 11),
(162, 12, 11),
(163, 31, 11),
(164, 32, 11),
(165, 33, 11),
(166, 43, 11),
(167, 37, 11),
(168, 34, 11),
(169, 35, 11),
(170, 36, 11),
(171, 38, 11),
(172, 39, 11),
(173, 40, 11),
(174, 41, 11),
(175, 42, 11),
(176, 5, 12),
(177, 12, 12),
(178, 31, 12),
(179, 32, 12),
(180, 33, 12),
(181, 43, 12),
(182, 37, 12),
(183, 34, 12),
(184, 35, 12),
(185, 36, 12),
(186, 38, 12),
(187, 39, 12),
(188, 40, 12),
(189, 41, 12),
(190, 42, 12),
(191, 5, 13),
(192, 12, 13),
(193, 31, 13),
(194, 32, 13),
(195, 33, 13),
(196, 43, 13),
(197, 37, 13),
(198, 34, 13),
(199, 35, 13),
(200, 36, 13),
(201, 38, 13),
(202, 39, 13),
(203, 40, 13),
(204, 41, 13),
(205, 42, 13),
(206, 5, 14),
(207, 12, 14),
(208, 31, 14),
(209, 32, 14),
(210, 33, 14),
(211, 43, 14),
(212, 37, 14),
(213, 34, 14),
(214, 35, 14),
(215, 36, 14),
(216, 38, 14),
(217, 39, 14),
(218, 40, 14),
(219, 41, 14),
(220, 42, 14),
(221, 5, 15),
(222, 12, 15),
(223, 31, 15),
(224, 32, 15),
(225, 33, 15),
(226, 43, 15),
(227, 37, 15),
(228, 34, 15),
(229, 35, 15),
(230, 36, 15),
(231, 38, 15),
(232, 39, 15),
(233, 40, 15),
(234, 41, 15),
(235, 42, 15),
(236, 44, 15),
(237, 45, 15),
(238, 46, 15),
(239, 47, 15),
(240, 48, 15),
(241, 49, 15),
(242, 50, 15),
(243, 51, 15),
(244, 52, 15),
(245, 53, 15),
(246, 54, 15),
(247, 55, 15),
(248, 56, 15),
(249, 57, 15),
(250, 58, 15),
(251, 81, 15),
(252, 44, 16),
(253, 45, 16),
(254, 46, 16),
(255, 47, 16),
(256, 48, 16),
(257, 49, 16),
(258, 50, 16),
(259, 51, 16),
(260, 52, 16),
(261, 53, 16),
(262, 54, 16),
(263, 55, 16),
(264, 56, 16),
(265, 57, 16),
(266, 58, 16),
(267, 81, 16),
(268, 44, 17),
(269, 45, 17),
(270, 46, 17),
(271, 47, 17),
(272, 48, 17),
(273, 49, 17),
(274, 50, 17),
(275, 51, 17),
(276, 52, 17),
(277, 53, 17),
(278, 54, 17),
(279, 55, 17),
(280, 56, 17),
(281, 57, 17),
(282, 58, 17),
(283, 81, 17),
(284, 44, 18),
(285, 45, 18),
(286, 46, 18),
(287, 47, 18),
(288, 48, 18),
(289, 49, 18),
(290, 50, 18),
(291, 51, 18),
(292, 52, 18),
(293, 53, 18),
(294, 54, 18),
(295, 55, 18),
(296, 56, 18),
(297, 57, 18),
(298, 58, 18),
(299, 81, 18),
(300, 44, 19),
(301, 45, 19),
(302, 46, 19),
(303, 47, 19),
(304, 48, 19),
(305, 49, 19),
(306, 50, 19),
(307, 51, 19),
(308, 52, 19),
(309, 53, 19),
(310, 54, 19),
(311, 55, 19),
(312, 56, 19),
(313, 57, 19),
(314, 58, 19),
(315, 81, 19),
(316, 44, 20),
(317, 45, 20),
(318, 46, 20),
(319, 47, 20),
(320, 48, 20),
(321, 49, 20),
(322, 50, 20),
(323, 51, 20),
(324, 52, 20),
(325, 53, 20),
(326, 54, 20),
(327, 55, 20),
(328, 56, 20),
(329, 57, 20),
(330, 58, 20),
(331, 81, 20),
(332, 82, 21),
(333, 77, 21),
(334, 73, 21),
(335, 72, 21),
(336, 71, 21),
(337, 70, 21),
(338, 69, 21),
(339, 68, 21),
(340, 67, 21),
(341, 66, 21),
(342, 61, 21),
(343, 65, 21),
(344, 64, 21),
(345, 63, 21),
(346, 59, 21),
(347, 62, 21),
(348, 60, 21),
(349, 82, 22),
(350, 77, 22),
(351, 73, 22),
(352, 72, 22),
(353, 71, 22),
(354, 70, 22),
(355, 69, 22),
(356, 68, 22),
(357, 67, 22),
(358, 66, 22),
(359, 61, 22),
(360, 65, 22),
(361, 64, 22),
(362, 63, 22),
(363, 59, 22),
(364, 62, 22),
(365, 60, 22),
(366, 82, 23),
(367, 77, 23),
(368, 73, 23),
(369, 72, 23),
(370, 71, 23),
(371, 70, 23),
(372, 69, 23),
(373, 68, 23),
(374, 67, 23),
(375, 66, 23),
(376, 61, 23),
(377, 65, 23),
(378, 64, 23),
(379, 63, 23),
(380, 59, 23),
(381, 62, 23),
(382, 60, 23),
(383, 82, 24),
(384, 77, 24),
(385, 73, 24),
(386, 72, 24),
(387, 71, 24),
(388, 70, 24),
(389, 69, 24),
(390, 68, 24),
(391, 67, 24),
(392, 66, 24),
(393, 61, 24),
(394, 65, 24),
(395, 64, 24),
(396, 63, 24),
(397, 59, 24),
(398, 62, 24),
(399, 60, 24),
(400, 82, 25),
(401, 77, 25),
(402, 73, 25),
(403, 72, 25),
(404, 71, 25),
(405, 70, 25),
(406, 69, 25),
(407, 68, 25),
(408, 67, 25),
(409, 66, 25),
(410, 61, 25),
(411, 65, 25),
(412, 64, 25),
(413, 63, 25),
(414, 59, 25),
(415, 62, 25),
(416, 60, 25),
(417, 74, 26),
(418, 75, 26),
(419, 76, 26),
(420, 78, 26),
(421, 79, 26),
(422, 83, 26),
(423, 74, 27),
(424, 75, 27),
(425, 76, 27),
(426, 78, 27),
(427, 79, 27),
(428, 83, 27),
(429, 74, 28),
(430, 75, 28),
(431, 76, 28),
(432, 78, 28),
(433, 79, 28),
(434, 83, 28),
(435, 74, 29),
(436, 75, 29),
(437, 76, 29),
(438, 78, 29),
(439, 79, 29),
(440, 83, 29),
(441, 74, 30),
(442, 75, 30),
(443, 76, 30),
(444, 78, 30),
(445, 79, 30),
(446, 83, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasexmaestro`
--

CREATE TABLE `clasexmaestro` (
  `id` int(11) NOT NULL,
  `id_clase` int(10) NOT NULL,
  `id_maestro` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clasexmaestro`
--

INSERT INTO `clasexmaestro` (`id`, `id_clase`, `id_maestro`) VALUES
(1, 1, 2),
(7, 3, 4),
(96, 4, 6),
(97, 6, 5),
(98, 9, 5),
(99, 7, 5),
(100, 10, 5),
(101, 11, 5),
(102, 8, 5),
(103, 16, 2),
(104, 19, 2),
(106, 5, 2),
(107, 12, 2),
(108, 15, 5),
(109, 42, 2),
(110, 13, 5),
(111, 14, 5),
(112, 17, 5),
(113, 18, 5),
(114, 20, 6),
(115, 21, 6),
(116, 22, 6),
(117, 23, 6),
(118, 24, 6),
(119, 25, 6),
(120, 26, 6),
(121, 27, 6),
(122, 28, 6),
(123, 29, 6),
(124, 30, 6),
(125, 31, 2),
(126, 32, 2),
(127, 33, 2),
(128, 34, 2),
(129, 35, 2),
(130, 36, 2),
(131, 37, 2),
(132, 38, 2),
(133, 39, 2),
(134, 40, 2),
(135, 41, 2),
(136, 43, 2),
(137, 44, 3),
(138, 45, 3),
(139, 46, 3),
(140, 47, 3),
(141, 48, 3),
(142, 49, 3),
(143, 80, 5),
(144, 83, 7),
(145, 82, 4),
(146, 81, 3),
(147, 50, 3),
(148, 51, 3),
(149, 52, 3),
(150, 53, 3),
(151, 54, 3),
(152, 55, 3),
(153, 56, 3),
(154, 57, 3),
(155, 58, 3),
(156, 59, 4),
(157, 79, 7),
(158, 78, 5),
(159, 77, 4),
(160, 76, 7),
(161, 75, 7),
(162, 74, 7),
(163, 73, 4),
(164, 71, 4),
(165, 72, 4),
(166, 70, 4),
(167, 69, 4),
(168, 60, 4),
(169, 61, 4),
(170, 62, 4),
(171, 63, 4),
(172, 64, 4),
(173, 66, 4),
(174, 65, 4),
(175, 67, 4),
(176, 68, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--

CREATE TABLE `encargado` (
  `ID_ENCARGADO` int(11) NOT NULL,
  `CARGO` varchar(45) NOT NULL,
  `LUGAR_TRABAJO` varchar(45) NOT NULL,
  `PROFESION` varchar(45) DEFAULT NULL,
  `TELE_OFICINA` int(11) DEFAULT NULL,
  `PARENTESCO` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargadoxalumno`
--

CREATE TABLE `encargadoxalumno` (
  `ID_ENCARGADOXALUMNO` varchar(45) NOT NULL,
  `ALUMNO_ID_ALUMNO` int(11) NOT NULL,
  `ENCARGADO_ID_ENCARGADO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `ID_GRADO` int(11) NOT NULL,
  `NOMBRE_GRADO` varchar(45) NOT NULL,
  `GRADO_ACTIVO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(7, 'Quinto', 0),
(8, 'Sexto', 0),
(9, 'Septimo', 0),
(10, 'Octavo', 0),
(11, 'Noveno', 0),
(12, 'Decimo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_medica`
--

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
-- Volcado de datos para la tabla `informacion_medica`
--

INSERT INTO `informacion_medica` (`ID_INFO_MEDICA`, `ALERGIAS`, `TIPO_SANGRE`, `PROBLEMAS_VISUALES`, `ENFERMEDADES`, `MEDICO_FAMILIAR`, `MEDICAMENTOS`, `CLINICA`, `ATENCIONES_ESPECIALES`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

CREATE TABLE `jornada` (
  `ID_JORNADA` int(11) NOT NULL,
  `NOMBRE_JORNADA` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`ID_JORNADA`, `NOMBRE_JORNADA`) VALUES
(1, 'MATUTINA'),
(2, 'VESPERTINA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE `maestro` (
  `ID_MAESTRO` int(11) NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `SALARIO` decimal(10,0) NOT NULL,
  `CARGO` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `maestro`
--

INSERT INTO `maestro` (`ID_MAESTRO`, `FECHA_INGRESO`, `SALARIO`, `CARGO`) VALUES
(1, '0000-00-00', '10000', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestroxclase`
--

CREATE TABLE `maestroxclase` (
  `ID_MAESTROXCLASE` int(11) NOT NULL,
  `ID_MAESTRO` int(11) NOT NULL,
  `ID_CLASE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `ID_MATRICULA` int(11) NOT NULL,
  `ID_GRADO` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcial`
--

CREATE TABLE `parcial` (
  `ID_PARCIAL` int(11) NOT NULL,
  `NOMBRE_PARCIAL` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `ID_PERSONA` int(11) NOT NULL,
  `PRIVILEGIO_ID_PRIVILEGIO` int(11) NOT NULL,
  `INFO_MEDICA` int(11) NOT NULL,
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
  `CONTRASENIA` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ID_PERSONA`, `PRIVILEGIO_ID_PRIVILEGIO`, `INFO_MEDICA`, `NOMBRES`, `APELLIDOS`, `FECHA_NACIMIENTO`, `EDAD`, `LUGAR_NACIMIENTO`, `CIUDAD`, `DEPARTAMENTO`, `COLONIA`, `CALLE_AVENIDA`, `TELEFONO_CASA`, `BLOQUE`, `NO_CASA`, `FOTO`, `NO_IDENTIDAD`, `EMAIL`, `USUARIO`, `CONTRASENIA`) VALUES
(1, 2, 1, 'admin', 'admin', '0000-00-00', 0, ' ', ' ', ' ', ' ', ' ', 0, ' ', 0, '', '0', 'admin@gmail.com', 'admin', 'admin'),
(2, 1, 1, 'profesor', '1', '0000-00-00', 0, ' ', ' ', ' ', ' ', ' ', 0, ' ', 0, '', '0', 'profesor@gmail.com', 'profesor1', 'profesor'),
(3, 1, 1, 'profesor', '2', '0000-00-00', 0, ' ', ' ', ' ', ' ', ' ', 0, ' ', 0, NULL, '0', 'profesor@gmail.com', 'profesor2', 'profesor'),
(4, 1, 1, 'profesor', '3', '0000-00-00', 0, ' ', ' ', ' ', ' ', ' ', 0, ' ', 0, NULL, '0', 'profesor@gmail.com', 'profesor3', 'profesor'),
(5, 1, 1, 'profesor', '4', '0000-00-00', 0, ' ', ' ', ' ', ' ', ' ', 0, ' ', 0, NULL, '0', 'profesor@gmail.com', 'profesor4', 'profesor'),
(6, 1, 1, 'profesor', '5', '0000-00-00', 0, ' ', ' ', ' ', ' ', ' ', 0, ' ', 0, NULL, '0', 'profesor@gmail.com', 'profesor5', 'profesor'),
(7, 1, 1, 'profesor', '6', '0000-00-00', 0, ' ', ' ', ' ', ' ', ' ', 0, ' ', 0, NULL, '0', 'profesor@gmail.com', 'profesor6', 'profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

CREATE TABLE `privilegio` (
  `ID_PRIVILEGIO` int(11) NOT NULL,
  `NOMBRE_PRIVILEGIO` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `privilegio`
--

INSERT INTO `privilegio` (`ID_PRIVILEGIO`, `NOMBRE_PRIVILEGIO`) VALUES
(1, 'Profesor'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `ID_SECCION` int(11) NOT NULL,
  `NOMBRE_SECCION` varchar(45) NOT NULL,
  `SECCION_ACTIVO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `seccionesxgrado` (
  `ID_SECCIONESXGRADO` int(11) NOT NULL,
  `ID_SECCION` int(10) NOT NULL,
  `ID_GRADO` int(10) NOT NULL,
  `ID_JORNADA` int(11) NOT NULL,
  `ESTADO` int(2) NOT NULL DEFAULT '1',
  `ANIO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seccionesxgrado`
--

INSERT INTO `seccionesxgrado` (`ID_SECCIONESXGRADO`, `ID_SECCION`, `ID_GRADO`, `ID_JORNADA`, `ESTADO`, `ANIO`) VALUES
(1, 1, 1, 1, 1, '0000-00-00'),
(2, 2, 1, 1, 1, '0000-00-00'),
(3, 1, 2, 1, 1, '0000-00-00'),
(4, 2, 2, 1, 1, '0000-00-00'),
(5, 1, 3, 1, 1, '0000-00-00'),
(6, 2, 3, 1, 1, '0000-00-00'),
(7, 1, 4, 1, 1, '0000-00-00'),
(8, 2, 4, 1, 1, '0000-00-00'),
(9, 1, 4, 1, 1, '0000-00-00'),
(10, 2, 4, 1, 1, '0000-00-00'),
(11, 1, 5, 1, 1, '0000-00-00'),
(12, 2, 5, 1, 1, '0000-00-00'),
(13, 1, 6, 1, 1, '0000-00-00'),
(14, 2, 6, 1, 1, '0000-00-00'),
(15, 1, 7, 0, 1, '0000-00-00'),
(16, 2, 7, 0, 1, '0000-00-00'),
(17, 1, 8, 0, 1, '0000-00-00'),
(18, 2, 8, 0, 1, '0000-00-00'),
(19, 1, 9, 0, 1, '0000-00-00'),
(20, 2, 9, 0, 1, '0000-00-00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`ID_ADMINISTRACION`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`ID_ALUMNO`),
  ADD KEY `fk_ALUMNO_PERSONA_idx` (`ID_ALUMNO`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`ID_CALIFICACIONES`),
  ADD KEY `fk_CALIFICACIONES_CATEGORIA1_idx` (`ID_CATEGORIA`),
  ADD KEY `fk_CALIFICACIONES_CLASE1_idx` (`ID_CLASE`),
  ADD KEY `fk_CALIFICACIONES_PARCIAL1_idx` (`ID_PARCIAL`),
  ADD KEY `fk_CALIFICACIONES_ALUMNO1_idx` (`ID_ALUMNO`);

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
  ADD PRIMARY KEY (`ID_CLASESXGRADO`);

--
-- Indices de la tabla `clasexalumno`
--
ALTER TABLE `clasexalumno`
  ADD PRIMARY KEY (`ID_CLASEXALUMNO`),
  ADD KEY `fk_CLASEXALUMNO_CLASE1_idx` (`ID_CLASE`),
  ADD KEY `fk_CLASEXALUMNO_ALUMNO1_idx` (`ID_ALUMNO`);

--
-- Indices de la tabla `clasexmaestro`
--
ALTER TABLE `clasexmaestro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `encargado`
--
ALTER TABLE `encargado`
  ADD PRIMARY KEY (`ID_ENCARGADO`),
  ADD KEY `fk_ENCARGADO_PERSONA1_idx` (`ID_ENCARGADO`);

--
-- Indices de la tabla `encargadoxalumno`
--
ALTER TABLE `encargadoxalumno`
  ADD PRIMARY KEY (`ID_ENCARGADOXALUMNO`),
  ADD KEY `fk_ENCARGADOXALUMNO_ENCARGADO1_idx` (`ENCARGADO_ID_ENCARGADO`),
  ADD KEY `fk_ENCARGADOXALUMNO_ALUMNO1` (`ALUMNO_ID_ALUMNO`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`ID_GRADO`);

--
-- Indices de la tabla `informacion_medica`
--
ALTER TABLE `informacion_medica`
  ADD PRIMARY KEY (`ID_INFO_MEDICA`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`ID_JORNADA`);

--
-- Indices de la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD PRIMARY KEY (`ID_MAESTRO`),
  ADD KEY `fk_MAESTRO_PERSONA1_idx` (`ID_MAESTRO`);

--
-- Indices de la tabla `parcial`
--
ALTER TABLE `parcial`
  ADD PRIMARY KEY (`ID_PARCIAL`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID_PERSONA`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`ID_SECCION`);

--
-- Indices de la tabla `seccionesxgrado`
--
ALTER TABLE `seccionesxgrado`
  ADD PRIMARY KEY (`ID_SECCIONESXGRADO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `ID_ALUMNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `ID_CALIFICACIONES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `ID_CLASE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `clasesxgrado`
--
ALTER TABLE `clasesxgrado`
  MODIFY `ID_CLASESXGRADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `clasexalumno`
--
ALTER TABLE `clasexalumno`
  MODIFY `ID_CLASEXALUMNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

--
-- AUTO_INCREMENT de la tabla `clasexmaestro`
--
ALTER TABLE `clasexmaestro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT de la tabla `parcial`
--
ALTER TABLE `parcial`
  MODIFY `ID_PARCIAL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `ID_PERSONA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `seccionesxgrado`
--
ALTER TABLE `seccionesxgrado`
  MODIFY `ID_SECCIONESXGRADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `persona` 
ADD COLUMN `ACTIVO_PERSONA` BIT(1);

UPDATE `alumno` SET `NOTAS`='89' WHERE `ID_ALUMNO`='1';
UPDATE `alumno` SET `NOTAS`='98' WHERE `ID_ALUMNO`='2';
UPDATE `alumno` SET `NOTAS`='75' WHERE `ID_ALUMNO`='3';
UPDATE `alumno` SET `NOTAS`='36' WHERE `ID_ALUMNO`='4';
UPDATE `alumno` SET `NOTAS`='72' WHERE `ID_ALUMNO`='5';
UPDATE `alumno` SET `NOTAS`='65' WHERE `ID_ALUMNO`='6';
UPDATE `alumno` SET `NOTAS`='35' WHERE `ID_ALUMNO`='7';
UPDATE `alumno` SET `NOTAS`='45' WHERE `ID_ALUMNO`='8';
