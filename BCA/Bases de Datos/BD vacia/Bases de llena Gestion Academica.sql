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
- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--
-- Creación: 07-05-2018 a las 00:11:57
--
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--
-- Creación: 06-05-2018 a las 21:21:59

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

CREATE TABLE IF NOT EXISTS `clase` (
  `ID_CLASE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_CLASE` varchar(45) NOT NULL,
  `ESTADO_CLASE` int(1) NOT NULL,
  PRIMARY KEY (`ID_CLASE`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `clase`

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasesxgrado`
--
-- Creación: 06-05-2018 a las 21:22:00



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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasexalumno`
--
-- Creación: 06-05-2018 a las 23:28:36

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasexmaestro`
--
-- Creación: 06-05-2018 a las 21:22:00
--


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



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--
-- Creación: 06-05-2018 a las 21:22:01
--


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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_medica`
--
-- Creación: 06-05-2018 a las 21:22:01
--

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--
-- Creación: 06-05-2018 a las 21:22:02

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


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limites`
--

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


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--
-- Creación: 06-05-2018 a las 21:22:02
--

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--
-- Creación: 06-05-2018 a las 21:22:03
--

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--
-- Creación: 06-05-2018 a las 21:22:04
--


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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--
-- Creación: 06-05-2018 a las 21:22:04

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--
-- Creación: 06-05-2018 a las 21:22:05
--

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



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccionesxgrado`
--
-- Creación: 07-05-2018 a las 02:54:44

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
