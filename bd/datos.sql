-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2016 a las 17:45:37
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

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `cif`, `descripcion`, `web`, `imagen`, `idResponsable`) VALUES
(7, 'Nombre empresa', 'b202020', 'descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion ', 'paginaweb.es', 'assets/images/pasteleria.jpg', 1),
(8, 'Nombre empresa', 'b202021', 'descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion ', 'paginaweb.es', 'assets/images/impresora3d.jpg', 1),
(9, 'Nombre empresa', 'b202022', 'descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion ', 'paginaweb.es', 'assets/images/manualidades.jpg', 1),
(10, 'Nombre empresa', 'b202023', 'descripcion descripcion descripcion descripcion', 'paginaweb.es', 'assets/images/plano.jpg', 1),
(11, 'Nombre empresa', 'b202024', 'descripcion descripcion ', 'paginaweb.es', 'assets/images/plano.jpg', 1);

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `fecha`, `descripcion`, `precio`, `plazas`, `imagen`, `idEmpresa`) VALUES
(1, 'Evento', '2015-12-29 18:30:00', 'descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion ', 10, 25, NULL, 8),
(2, 'Evento2', '2015-12-28 10:00:00', 'descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion descripcion ', 5, 100, NULL, 10);

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id`, `nombre`, `descripcion`, `ubicacion`, `capacidad`, `imagen`, `estado`) VALUES
(1, 'Salon de Actos', 'Lorem ipsum dolor sit amet, sapien etiam, nunc amet dolor ac odio mauris justo. Luctus arcu, urna praesent at id quisque ac. Arcu massa vestibulum malesuada, integer vivamus elit eu mauris eu, cum eros quis aliquam nisl wisi.', 'Primera planta', 25, 'assets/images/salas/sala_1.jpeg', 0),
(2, 'Mediana', 'Lorem ipsum dolor sit amet, sapien etiam, nunc amet dolor ac odio mauris justo. Luctus arcu, urna praesent at id quisque ac. Arcu massa vestibulum malesuada, integer vivamus elit eu mauris eu, cum eros quis aliquam nisl wisi.\r\n\r\nNulla wisi laoreet suspendisse hendrerit facilisi, mi mattis pariatur adipiscing aliquam pharetra eget. Aenean urna ipsum donec tellus tincidunt, quam curabitur metus, pretium purus facilisis enim id, integer eleifend vitae volutpat consequat per leo.', 'Planta baja', 50, 'assets/images/salas/sala_2.jpeg', 1),
(3, 'TrÃ©bol', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'Primera planta', 100, 'assets/images/salas/sala_3.jpeg', 1);

--
-- Volcado de datos para la tabla `sala_aloja_evento`
--

INSERT INTO `sala_aloja_evento` (`idEvento`, `idSala`) VALUES
(2, 2);

--
-- Volcado de datos para la tabla `empresa_usa_sala`
--

INSERT INTO `empresa_usa_sala` (`id`, `idEmpresa`, `idSala`, `fechaInicio`, `fechaFin`) VALUES
(2, 7, 1, '2015-12-24', '2015-12-26'),
(3, 7, 2, '2016-01-03', '2016-01-05');

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `correo`, `password`, `telefono`, `idEmpresa`, `tipo`) VALUES
(1, '', '', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'Administrador'),
(4, '', '', 'empresa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 7, 'Empresa'),
(5, '', '', 'organizador@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 11, 'Organizador'),
(6, '', NULL, 'usuario@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'Usuario');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
