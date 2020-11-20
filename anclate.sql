-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 19-11-2020 a las 02:59:51
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `anclate`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE IF NOT EXISTS `cargo` (
  `idCargo` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`idCargo`, `cargo`) VALUES
(1, 'Administrador'),
(2, 'Atención al cliente'),
(3, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

DROP TABLE IF EXISTS `cotizacion`;
CREATE TABLE IF NOT EXISTS `cotizacion` (
  `idCotizacion` char(10) NOT NULL,
  `nombreCliente` varchar(80) NOT NULL,
  `correoCliente` varchar(80) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idEmpleado` char(10) DEFAULT NULL,
  PRIMARY KEY (`idCotizacion`),
  KEY `idEmpleado` (`idEmpleado`),
  KEY `idEstado` (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`idCotizacion`, `nombreCliente`, `correoCliente`, `telefono`, `idEstado`, `idEmpleado`) VALUES
('COT001', 'Critian Pérez ', 'cliente01@gmail.com', '2255-8811', 2, 'EMP02'),
('COT002', 'Axel Rivas', 'cliente02@gmail.com', '2255-6633', 1, 'EMP04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacionproducto`
--

DROP TABLE IF EXISTS `cotizacionproducto`;
CREATE TABLE IF NOT EXISTS `cotizacionproducto` (
  `idCotizacion` varchar(10) NOT NULL,
  `idProducto` varchar(25) NOT NULL,
  `cantidad` int(11) NOT NULL,
  KEY `idCotizacion` (`idCotizacion`),
  KEY `idProducto` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cotizacionproducto`
--

INSERT INTO `cotizacionproducto` (`idCotizacion`, `idProducto`, `cantidad`) VALUES
('COT001', 'PROD01', 2),
('COT001', 'PROD02', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `idEmpleado` char(10) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `idCargo` int(11) NOT NULL,
  `idEstadoEmpleado` int(11) NOT NULL,
  `contra` varchar(60) NOT NULL,
  PRIMARY KEY (`idEmpleado`),
  UNIQUE KEY `dui` (`dui`),
  KEY `idCargo` (`idCargo`),
  KEY `idEstadoEmpleado` (`idEstadoEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombres`, `apellidos`, `telefono`, `correo`, `dui`, `idCargo`, `idEstadoEmpleado`, `contra`) VALUES
('EMP01', 'Alexander', 'Soriano', '7801-3145', 'alex.soriano@gmail.com', '12345678-9', 1, 1, '$2y$10$zz0U962E/soFUu.59YoDOe0DZ8oq4CL89JUyaK5IQ8Hxjl1cAmhU6'),
('EMP02', 'Carlos', 'Rivas', '22558833', 'vendedor1@gmail.com', '11234567-8', 3, 1, '$2y$10$zz0U962E/soFUu.59YoDOe0DZ8oq4CL89JUyaK5IQ8Hxjl1cAmhU6'),
('EMP03', 'Sergio', 'Cuellar', '2255-6655', 'sergio.cuellar@gmail.com', '12345677-8', 2, 1, '$2y$10$zNjefbd0QubNgi3qOO0F5OD9lSoxmiHO7W2g4BXQR1obfUBNEzLHO'),
('EMP04', 'Jose', 'Rivas', '2255-6677', 'jose.rivas@gmail.com', '12345677-1', 3, 1, '$2y$10$OjB2Em/8L54sLWtFo09B9unCssFVoi7S2ikuuTIPYZOEzNDzqupZK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocotizacion`
--

DROP TABLE IF EXISTS `estadocotizacion`;
CREATE TABLE IF NOT EXISTS `estadocotizacion` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadocotizacion`
--

INSERT INTO `estadocotizacion` (`idEstado`, `estado`) VALUES
(1, 'En espera'),
(2, 'En desarrollo'),
(3, 'Finalizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoempleado`
--

DROP TABLE IF EXISTS `estadoempleado`;
CREATE TABLE IF NOT EXISTS `estadoempleado` (
  `idEstadoEmpleado` int(11) NOT NULL,
  `estadoEmpleado` varchar(30) NOT NULL,
  PRIMARY KEY (`idEstadoEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadoempleado`
--

INSERT INTO `estadoempleado` (`idEstadoEmpleado`, `estadoEmpleado`) VALUES
(1, 'Activo'),
(2, 'No Disponible'),
(3, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida`
--

DROP TABLE IF EXISTS `medida`;
CREATE TABLE IF NOT EXISTS `medida` (
  `idMedida` int(11) NOT NULL,
  `medida` varchar(25) NOT NULL,
  PRIMARY KEY (`idMedida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`idMedida`, `medida`) VALUES
(1, 'Unidad'),
(2, 'Pares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` varchar(25) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `idTipoProducto` int(11) DEFAULT NULL,
  `idMedida` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `idMedida` (`idMedida`),
  KEY `idTipoProducto` (`idTipoProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `descripcion`, `imagen`, `stock`, `idTipoProducto`, `idMedida`) VALUES
('HRA-7081', 'ARNES EN H DE 3 PUNTOS', 'Arnes en h de 3 puntos con acolchonamientos y soporte lumbar', 'arnes-multiproposito-dielectrico-con-soporte-lumbar-en-h-de-4-puntos-de-anclaje-tipo-d-dinamik.jpg', 5, 2, 1),
('HREA-795', 'SISTEMAS CERTIFICADOS.', 'Sistemas certificados instalados sobre techo', 'sisInge.jpg', 1, 1, 1),
('HRF-3600', 'LENTE DE PROTECCION CARIBU.', 'Lente de proteccion caribu, aro negro,disponible en claros y oscuros.', 'lentes.jpg', 2, 4, 1),
('HRG-4833', 'GUANTE TEJIDO DE NYLON.', 'Guante tejido de nylon con recubrimiento de latex espumado ironwear', 'guante.jpg', 5, 3, 2),
('PROD01', 'Guantes', 'Guantes para trabajar', 'gloves.jpg', 21, 1, 1),
('PROD02', 'Guantes Rojos', 'Guantes para trabajar color rojos', 'altura.png', 30, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

DROP TABLE IF EXISTS `tipoproducto`;
CREATE TABLE IF NOT EXISTS `tipoproducto` (
  `idTipoProducto` int(11) NOT NULL AUTO_INCREMENT,
  `tipoProducto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idTipoProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipoproducto`
--

INSERT INTO `tipoproducto` (`idTipoProducto`, `tipoProducto`) VALUES
(1, 'Sistema de Ingeniería'),
(2, 'Altura'),
(3, 'Protección para manos'),
(4, 'Protección facial');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  ADD CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`idEstado`) REFERENCES `estadocotizacion` (`idEstado`);

--
-- Filtros para la tabla `cotizacionproducto`
--
ALTER TABLE `cotizacionproducto`
  ADD CONSTRAINT `cotizacionproducto_ibfk_1` FOREIGN KEY (`idCotizacion`) REFERENCES `cotizacion` (`idCotizacion`),
  ADD CONSTRAINT `cotizacionproducto_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idCargo`) REFERENCES `cargo` (`idCargo`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`idEstadoEmpleado`) REFERENCES `estadoempleado` (`idEstadoEmpleado`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idMedida`) REFERENCES `medida` (`idMedida`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idTipoProducto`) REFERENCES `tipoproducto` (`idTipoProducto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
