-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2020 a las 03:35:26
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `cargo` (
  `idCargo` int(11) NOT NULL,
  `cargo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `cotizacion` (
  `idCotizacion` char(10) NOT NULL,
  `nombreCliente` varchar(80) NOT NULL,
  `correoCliente` varchar(80) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idEmpleado` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`idCotizacion`, `nombreCliente`, `correoCliente`, `telefono`, `idEstado`, `idEmpleado`) VALUES
('COT001', 'Critian Pérez ', 'cliente01@gmail.com', '2255-8811', 2, 'EMP02'),
('COT002', 'Axel Rivas', 'cliente02@gmail.com', '2255-6633', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacionproducto`
--

CREATE TABLE `cotizacionproducto` (
  `idCotizacion` varchar(10) NOT NULL,
  `idProducto` varchar(25) NOT NULL,
  `cantidad` int(11) NOT NULL
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

CREATE TABLE `empleado` (
  `idEmpleado` char(10) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `idCargo` int(11) NOT NULL,
  `idEstadoEmpleado` int(11) NOT NULL,
  `contra` varchar(60) NOT NULL
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

CREATE TABLE `estadocotizacion` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL
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

CREATE TABLE `estadoempleado` (
  `idEstadoEmpleado` int(11) NOT NULL,
  `estadoEmpleado` varchar(30) NOT NULL
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

CREATE TABLE `medida` (
  `idMedida` int(11) NOT NULL,
  `medida` varchar(25) NOT NULL
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

CREATE TABLE `producto` (
  `idProducto` varchar(25) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `idTipoProducto` int(11) DEFAULT NULL,
  `idMedida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `descripcion`, `imagen`, `stock`, `idTipoProducto`, `idMedida`) VALUES
('PROD01', 'Guantes', 'Guantes para trabajar', 'gloves.jpg', 20, 3, 2),
('PROD02', 'Guantes Rojos', 'Guantes para trabajar color rojos', 'altura.png', 30, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

CREATE TABLE `tipoproducto` (
  `idTipoProducto` int(11) NOT NULL,
  `tipoProducto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipoproducto`
--

INSERT INTO `tipoproducto` (`idTipoProducto`, `tipoProducto`) VALUES
(1, 'Sistema de Ingeniería'),
(2, 'Altura'),
(3, 'Protección para manos'),
(4, 'Protección facial');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idCargo`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`idCotizacion`),
  ADD KEY `idEmpleado` (`idEmpleado`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `cotizacionproducto`
--
ALTER TABLE `cotizacionproducto`
  ADD KEY `idCotizacion` (`idCotizacion`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD UNIQUE KEY `dui` (`dui`),
  ADD KEY `idCargo` (`idCargo`),
  ADD KEY `idEstadoEmpleado` (`idEstadoEmpleado`);

--
-- Indices de la tabla `estadocotizacion`
--
ALTER TABLE `estadocotizacion`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `estadoempleado`
--
ALTER TABLE `estadoempleado`
  ADD PRIMARY KEY (`idEstadoEmpleado`);

--
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`idMedida`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idMedida` (`idMedida`),
  ADD KEY `idTipoProducto` (`idTipoProducto`);

--
-- Indices de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  ADD PRIMARY KEY (`idTipoProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  MODIFY `idTipoProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
