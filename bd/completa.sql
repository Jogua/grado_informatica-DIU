-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2016 a las 04:19:14
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `diu`
--
CREATE DATABASE IF NOT EXISTS `diu` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `diu`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `cif` varchar(45) NOT NULL,
  `descripcion` text,
  `web` varchar(45) DEFAULT NULL,
  `imagen` varchar(45) NOT NULL,
  `idResponsable` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `cif`, `descripcion`, `web`, `imagen`, `idResponsable`, `estado`, `tipo`) VALUES
(1, 'ImpresiÃ³n 3D', 'B20202020', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'www.impresion3d.es', 'assets/images/empresas/empresa_1.jpeg', 2, 1, 'Empresa'),
(2, 'Total Eventos', 'B20202021', 'Pellentesque non aliquet mi, ut sollicitudin arcu. Donec id mollis lacus. Fusce id velit eget ipsum sollicitudin tempus sit amet ut leo. Morbi nec nunc eget nisl convallis finibus. In condimentum suscipit consectetur. Fusce consectetur lectus nisi, fringilla finibus arcu fermentum ac. In quam tellus, eleifend volutpat tempus vitae, aliquet nec quam. Maecenas vitae eros mi. Curabitur condimentum lacus eu mi auctor, tincidunt rhoncus quam pharetra. Vivamus aliquet dui ac condimentum dignissim. Integer ut leo id lorem lobortis eleifend nec vel ante. Pellentesque in consequat magna, faucibus auctor felis. Etiam sed purus rutrum, lobortis elit ac, laoreet arcu. Suspendisse feugiat malesuada interdum. Nullam vel libero justo.', 'www.totaleventos.es', 'assets/images/empresas/empresa_2.jpeg', 3, 1, 'Organizador'),
(3, 'TecnoRevoluciÃ³n', 'B20202022', 'In hac habitasse platea dictumst. Vestibulum hendrerit, odio eget mollis tincidunt, quam velit vehicula ex, a lobortis arcu nunc sed enim. Ut nisi felis, egestas et fermentum eget, cursus sit amet odio. Duis volutpat purus ut elit tincidunt, vel finibus nulla pellentesque. In est nisi, porta id magna vitae, convallis consequat sem. Mauris aliquet ante dignissim, condimentum tellus nec, consectetur ipsum. Quisque sed semper mauris.', 'www.tecnorevolucion.es', 'assets/images/empresas/empresa_3.jpeg', 4, 1, 'Empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_usa_sala`
--

CREATE TABLE IF NOT EXISTS `empresa_usa_sala` (
`id` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `idSala` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa_usa_sala`
--

INSERT INTO `empresa_usa_sala` (`id`, `idEmpresa`, `idSala`, `fechaInicio`, `fechaFin`) VALUES
(1, 1, 3, '2016-01-24 00:00:00', '2016-01-24 23:59:00'),
(2, 1, 2, '2016-01-18 00:00:00', '2016-01-22 23:59:00'),
(3, 2, 3, '2016-02-16 00:00:00', '2016-02-16 23:59:00'),
(7, 3, 3, '2016-02-09 00:00:00', '2016-02-09 23:59:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `descripcion` text,
  `precio` float DEFAULT NULL,
  `plazas` int(11) DEFAULT NULL,
  `imagen` varchar(45) DEFAULT NULL,
  `idEmpresa` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `fecha`, `descripcion`, `precio`, `plazas`, `imagen`, `idEmpresa`, `estado`) VALUES
(1, 'Modelado 3ds Max', '2016-02-24 12:30:00', 'In hac habitasse platea dictumst. Vestibulum hendrerit, odio eget mollis tincidunt, quam velit vehicula ex, a lobortis arcu nunc sed enim. Ut nisi felis, egestas et fermentum eget, cursus sit amet odio. Duis volutpat purus ut elit tincidunt, vel finibus nulla pellentesque. In est nisi, porta id magna vitae, convallis consequat sem. Mauris aliquet ante dignissim, condimentum tellus nec, consectetur ipsum. Quisque sed semper mauris.', 20, 20, 'assets/images/eventos/evento_1.jpeg', 1, 1),
(2, 'Taller de acupuntura', '2016-02-16 16:00:00', 'Maecenas nulla nulla, molestie sit amet accumsan ut, dapibus sit amet massa. Phasellus at fringilla orci. Quisque ultricies finibus felis.', 50, 10, 'assets/images/eventos/evento_2.jpeg', 2, 1),
(3, 'Conferencia mindfulness', '2016-02-05 20:00:00', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam id bibendum felis, sit amet mollis tellus. Nunc arcu odio, consequat tempus urna sit amet, tristique interdum orci. Ut nec diam dui. Aliquam ultricies efficitur velit, ut tincidunt enim dictum ac. In sagittis finibus ipsum, et iaculis massa eleifend in. Proin imperdiet, sapien non auctor finibus, justo dolor sagittis dui, vel vestibulum ante ligula dapibus lectus. Nunc pellentesque vehicula congue.', 5, 150, 'assets/images/eventos/evento_3.jpeg', 2, 1),
(4, 'Tu robot con arduino', '2016-02-09 17:30:00', 'Maecenas nulla nulla, molestie sit amet accumsan ut, dapibus sit amet massa. Phasellus at fringilla orci. Quisque ultricies finibus felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam id bibendum felis, sit amet mollis tellus. Nunc arcu odio, consequat tempus urna sit amet, tristique interdum orci. Ut nec diam dui. Aliquam ultricies efficitur velit, ut tincidunt enim dictum ac. In sagittis finibus ipsum, et iaculis massa eleifend in. Proin imperdiet, sapien non auctor finibus, justo dolor sagittis dui, vel vestibulum ante ligula dapibus lectus. Nunc pellentesque vehicula congue.', 0, 20, 'assets/images/eventos/evento_4.jpeg', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE IF NOT EXISTS `sala` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `ubicacion` varchar(45) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id`, `nombre`, `descripcion`, `ubicacion`, `capacidad`, `imagen`, `estado`) VALUES
(1, 'SalÃ³n de Actos', 'Integer lacinia egestas fringilla. Suspendisse id molestie metus, eu dictum dui. Quisque aliquam iaculis urna, gravida efficitur ligula aliquet sit amet. Aliquam gravida elit enim, et placerat dolor sagittis a. In hac habitasse platea dictumst. Nunc erat orci, dapibus vitae felis laoreet, tristique auctor lectus. Aenean porta, libero ac pretium porttitor, ligula risus dignissim erat, vel porta risus elit congue turpis. Nulla non consequat tellus. Cras vulputate risus nisi, at vulputate turpis aliquet vitae. Integer imperdiet dapibus luctus. Vivamus vel commodo eros, sed congue mauris. Morbi at ipsum varius, fringilla ex scelerisque, pulvinar ligula. Nullam erat purus, pulvinar eget efficitur at, volutpat non lectus.', 'Primera planta', 150, 'assets/images/salas/sala_1.jpeg', 1),
(2, 'TrÃ©bol', 'Donec suscipit, dolor quis aliquam condimentum, felis turpis congue purus, ac euismod risus sapien quis felis. Praesent pellentesque ac erat sit amet dignissim. Suspendisse non dignissim massa. Ut maximus libero sit amet magna scelerisque, ut accumsan sem condimentum. In pretium tortor at eleifend interdum. Sed sapien orci, condimentum vitae arcu et, dignissim ultricies leo. Etiam auctor lorem vitae elit luctus, id vulputate nisi dapibus.', 'Planta baja', 50, 'assets/images/salas/sala_2.jpeg', 1),
(3, 'Rustica', 'Sed eu eros elit. Morbi accumsan id nunc ut consequat. Proin dapibus arcu mauris, ut efficitur turpis aliquet at. Morbi dictum sem ac ligula lobortis pretium. Nulla dictum nulla nec porttitor eleifend. Fusce dignissim turpis sit amet augue vestibulum tincidunt. Vivamus et imperdiet lectus. Phasellus sed arcu metus. Sed sed nunc eget mi laoreet pharetra non sit amet velit. Mauris nec dolor sapien.', 'Planta baja', 20, 'assets/images/salas/sala_3.jpeg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala_aloja_evento`
--

CREATE TABLE IF NOT EXISTS `sala_aloja_evento` (
  `idEvento` int(11) NOT NULL,
  `idSala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sala_aloja_evento`
--

INSERT INTO `sala_aloja_evento` (`idEvento`, `idSala`) VALUES
(3, 1),
(1, 3),
(2, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `correo` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `idEmpresa` int(11) DEFAULT NULL,
  `tipo` varchar(45) NOT NULL DEFAULT 'Usuario'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `correo`, `password`, `telefono`, `idEmpresa`, `tipo`) VALUES
(1, '', '', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', NULL, 'Administrador'),
(2, '', '', 'empresa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 1, 'Empresa'),
(3, '', '', 'organizador@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 2, 'Organizador'),
(4, '', '', 'empresa2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 3, 'Empresa'),
(5, '', '', 'usuario@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', NULL, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_asiste_evento`
--

CREATE TABLE IF NOT EXISTS `usuario_asiste_evento` (
  `idUsuario` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_asiste_evento`
--

INSERT INTO `usuario_asiste_evento` (`idUsuario`, `idEvento`) VALUES
(1, 1),
(5, 1),
(5, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `cif_UNIQUE` (`cif`);

--
-- Indices de la tabla `empresa_usa_sala`
--
ALTER TABLE `empresa_usa_sala`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_Empresa_has_Sala_Sala1_idx` (`idSala`), ADD KEY `fk_Empresa_has_Sala_Empresa1_idx` (`idEmpresa`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `fk_Evento_Empresa1_idx` (`idEmpresa`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sala_aloja_evento`
--
ALTER TABLE `sala_aloja_evento`
 ADD PRIMARY KEY (`idEvento`,`idSala`), ADD KEY `fk_Evento_has_Sala_Sala1_idx` (`idSala`), ADD KEY `fk_Evento_has_Sala_Evento1_idx` (`idEvento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `correo_UNIQUE` (`correo`), ADD KEY `fk_Usuario_Empresa_idx` (`idEmpresa`);

--
-- Indices de la tabla `usuario_asiste_evento`
--
ALTER TABLE `usuario_asiste_evento`
 ADD PRIMARY KEY (`idUsuario`,`idEvento`), ADD KEY `fk_Usuario_has_Evento_Evento1_idx` (`idEvento`), ADD KEY `fk_Usuario_has_Evento_Usuario1_idx` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `empresa_usa_sala`
--
ALTER TABLE `empresa_usa_sala`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sala`
--
ALTER TABLE `sala`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresa_usa_sala`
--
ALTER TABLE `empresa_usa_sala`
ADD CONSTRAINT `fk_Empresa_has_Sala_Empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Empresa_has_Sala_Sala1` FOREIGN KEY (`idSala`) REFERENCES `sala` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
ADD CONSTRAINT `fk_Evento_Empresa1` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sala_aloja_evento`
--
ALTER TABLE `sala_aloja_evento`
ADD CONSTRAINT `fk_Evento_has_Sala_Evento1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Evento_has_Sala_Sala1` FOREIGN KEY (`idSala`) REFERENCES `sala` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_Usuario_Empresa` FOREIGN KEY (`idEmpresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_asiste_evento`
--
ALTER TABLE `usuario_asiste_evento`
ADD CONSTRAINT `fk_Usuario_has_Evento_Evento1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Usuario_has_Evento_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
