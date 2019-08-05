-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-08-2019 a las 14:45:41
-- Versión del servidor: 10.1.40-MariaDB-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tablero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CIUDAD`
--

CREATE TABLE `CIUDAD` (
  `codCiudad` int(3) NOT NULL COMMENT 'Código Ciudad',
  `codEstado` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Código Estado',
  `nomCiudad` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ciudad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='CIUDAD';

--
-- Volcado de datos para la tabla `CIUDAD`
--

INSERT INTO `CIUDAD` (`codCiudad`, `codEstado`, `nomCiudad`) VALUES
(1, 'A', 'ASUNCION'),
(2, 'A', 'CIUDAD DEL ESTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `COTIZACION`
--

CREATE TABLE `COTIZACION` (
  `codCotizacion` int(3) NOT NULL COMMENT 'Código Cotización',
  `codEstado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código Estado',
  `codSucursal` int(3) NOT NULL COMMENT 'Código Sucursal',
  `codMonedaBase` int(3) NOT NULL COMMENT 'Código Moneda Base',
  `codMonedaRelacion` int(3) NOT NULL COMMENT 'Código Moneda Relación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='COTIZACION';

--
-- Volcado de datos para la tabla `COTIZACION`
--

INSERT INTO `COTIZACION` (`codCotizacion`, `codEstado`, `codSucursal`, `codMonedaBase`, `codMonedaRelacion`) VALUES
(1, 'A', 1, 2, 1),
(2, 'A', 1, 3, 1),
(3, 'A', 1, 5, 1),
(4, 'A', 1, 4, 1),
(5, 'A', 1, 2, 3),
(6, 'A', 1, 2, 5),
(7, 'A', 1, 4, 2),
(8, 'A', 2, 2, 1),
(9, 'A', 2, 3, 1),
(10, 'A', 2, 5, 1),
(11, 'A', 2, 4, 1),
(12, 'A', 2, 2, 3),
(13, 'A', 2, 2, 5),
(14, 'A', 2, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `COTIZACIONDETALLE`
--

CREATE TABLE `COTIZACIONDETALLE` (
  `codCotizacionDetalle` int(6) NOT NULL COMMENT 'Código Cotización Detalle',
  `codEstado` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Código Estado',
  `codCotizacion` int(3) NOT NULL COMMENT 'Código Cotización',
  `codCotizacionTipo` int(3) NOT NULL COMMENT 'Código Cotización Tipo',
  `impCompra` decimal(10,5) NOT NULL COMMENT 'Importe Compra',
  `impVenta` decimal(10,5) NOT NULL COMMENT 'Importe Venta',
  `fecPizarra` datetime NOT NULL COMMENT 'Fecha Hora Pizarra',
  `fecAlta` date NOT NULL COMMENT 'Fecha Alta',
  `horAlta` char(8) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Hora Alta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='COTIZACIÓN DETALLE';

--
-- Volcado de datos para la tabla `COTIZACIONDETALLE`
--

INSERT INTO `COTIZACIONDETALLE` (`codCotizacionDetalle`, `codEstado`, `codCotizacion`, `codCotizacionTipo`, `impCompra`, `impVenta`, `fecPizarra`, `fecAlta`, `horAlta`) VALUES
(1, 'H', 1, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-03', '12:39:23'),
(2, 'H', 2, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-03', '12:39:23'),
(3, 'H', 3, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-03', '12:39:23'),
(4, 'H', 4, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-03', '12:39:23'),
(5, 'H', 5, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-03', '12:39:23'),
(6, 'H', 6, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-03', '12:39:23'),
(7, 'H', 7, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-03', '12:39:23'),
(8, 'A', 1, 1, '5820.00000', '5920.00000', '2019-08-05 09:36:00', '2019-08-05', '10:44:55'),
(9, 'A', 4, 1, '6550.00000', '6850.00000', '2019-08-05 09:36:00', '2019-08-05', '10:45:30'),
(10, 'A', 3, 1, '122.00000', '135.00000', '2019-08-05 09:36:00', '2019-08-05', '10:45:54'),
(11, 'H', 2, 1, '1420.00000', '1480.00000', '2019-08-05 09:36:00', '2019-08-05', '10:46:49'),
(12, 'H', 2, 1, '1420.00000', '1480.00000', '2019-08-05 09:36:00', '2019-08-05', '10:48:29'),
(13, 'H', 2, 1, '1420.00000', '1480.00000', '2019-08-05 09:36:00', '2019-08-05', '10:48:30'),
(14, 'A', 2, 1, '1420.00000', '1480.00000', '2019-08-05 09:36:00', '2019-08-05', '10:49:55'),
(15, 'A', 5, 1, '4.00000', '4.08000', '2019-08-05 09:36:00', '2019-08-05', '10:50:19'),
(16, 'A', 6, 1, '45.00000', '48.00000', '2019-09-05 09:36:00', '2019-08-05', '10:50:43'),
(17, 'H', 7, 1, '1.11000', '1.18000', '2019-08-05 09:36:00', '2019-08-05', '10:51:13'),
(18, 'H', 7, 1, '1.11000', '1.18000', '2019-08-05 09:36:00', '2019-08-05', '10:56:13'),
(19, 'H', 7, 1, '1.11000', '1.18000', '2019-08-05 09:36:00', '2019-08-05', '11:01:14'),
(20, 'H', 7, 1, '1.11000', '1.18000', '2019-08-05 09:36:00', '2019-08-05', '11:06:15'),
(21, 'H', 7, 1, '1.11000', '1.18000', '2019-08-05 09:36:00', '2019-08-05', '11:07:16'),
(22, 'H', 7, 1, '1.11000', '1.18000', '2019-08-05 09:36:00', '2019-08-05', '11:08:17'),
(23, 'H', 7, 1, '1.11000', '1.18000', '2019-08-05 09:36:00', '2019-08-05', '11:09:18'),
(24, 'A', 7, 1, '1.11000', '1.18000', '2019-08-05 09:36:00', '2019-08-05', '11:10:19'),
(25, 'H', 8, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-05', '11:14:34'),
(26, 'A', 9, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-05', '11:14:34'),
(27, 'A', 10, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-05', '11:14:34'),
(28, 'A', 11, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-05', '11:14:34'),
(29, 'A', 12, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-05', '11:14:34'),
(30, 'A', 13, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-05', '11:14:34'),
(31, 'A', 14, 1, '0.00000', '0.00000', '2019-01-01 00:00:00', '2019-08-05', '11:14:34'),
(32, 'H', 8, 1, '5800.00000', '5900.00000', '2019-08-05 10:23:00', '2019-08-05', '11:17:37'),
(33, 'H', 8, 1, '5800.00000', '5900.00000', '2019-08-05 10:23:00', '2019-08-05', '11:18:37'),
(34, 'A', 8, 1, '5800.00000', '5900.00000', '2019-08-05 10:23:00', '2019-08-05', '11:19:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `COTIZACIONTIPO`
--

CREATE TABLE `COTIZACIONTIPO` (
  `codCotizacionTipo` int(3) NOT NULL COMMENT 'Código Cotización Tipo',
  `codEstado` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Código Estado',
  `nomCotizacionTipo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Cotización Tipo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='COTIZACIÓN TIPO';

--
-- Volcado de datos para la tabla `COTIZACIONTIPO`
--

INSERT INTO `COTIZACIONTIPO` (`codCotizacionTipo`, `codEstado`, `nomCotizacionTipo`) VALUES
(1, 'A', 'EFECTIVO'),
(2, 'A', 'CHEQUE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EMPRESA`
--

CREATE TABLE `EMPRESA` (
  `codEmpresa` int(3) NOT NULL COMMENT 'Código Empresa',
  `codEstado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Estado',
  `nomEmpresa` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Empresa',
  `urlEmpresa` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Sitio Web'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='EMPRESA';

--
-- Volcado de datos para la tabla `EMPRESA`
--

INSERT INTO `EMPRESA` (`codEmpresa`, `codEstado`, `nomEmpresa`, `urlEmpresa`) VALUES
(1, 'A', 'CAMBIOS CHACO', 'HTTPS://WWW.CAMBIOSCHACO.COM.PY/'),
(2, 'A', 'MAXICAMBIOS', 'HTTP://WWW.MAXICAMBIOS.COM.PY/'),
(3, 'A', 'MYDCAMBIOS', 'HTTPS://WWW.MYDCAMBIOS.COM.PY/'),
(4, 'A', 'BASA', 'HTTPS://WWW.BANCOBASA.COM.PY/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MONEDA`
--

CREATE TABLE `MONEDA` (
  `codMoneda` int(3) NOT NULL COMMENT 'Código Moneda',
  `codEstado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código Estado',
  `nomMoneda` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Moneda',
  `bcpMoneda` char(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'BCP',
  `patMoneda` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Imagen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='MONEDA';

--
-- Volcado de datos para la tabla `MONEDA`
--

INSERT INTO `MONEDA` (`codMoneda`, `codEstado`, `nomMoneda`, `bcpMoneda`, `patMoneda`) VALUES
(1, 'A', 'GUARANIES', 'PYG', NULL),
(2, 'A', 'DOLAR AMERICANO', 'USD', NULL),
(3, 'A', 'REAL BRASILERO', 'BRL', NULL),
(4, 'A', 'EURO', 'EUR', NULL),
(5, 'A', 'PESO ARGENTINO', 'ARS', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SUCURSAL`
--

CREATE TABLE `SUCURSAL` (
  `codSucursal` int(3) NOT NULL COMMENT 'Código Sucursal',
  `codEstado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código Estado',
  `codEmpresa` int(3) NOT NULL COMMENT 'Código Empresa',
  `codCiudad` int(3) NOT NULL COMMENT 'Código Ciudad',
  `nomSucursal` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Sucursal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SUCURSAL';

--
-- Volcado de datos para la tabla `SUCURSAL`
--

INSERT INTO `SUCURSAL` (`codSucursal`, `codEstado`, `codEmpresa`, `codCiudad`, `nomSucursal`) VALUES
(1, 'A', 1, 1, 'CASA CENTRAL'),
(2, 'A', 2, 1, 'CASA MATRIZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TABLERO`
--

CREATE TABLE `TABLERO` (
  `codTablero` int(6) NOT NULL COMMENT 'Código Tablero',
  `codEstado` char(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código Estado',
  `nomTablero` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tablero'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='TABLERO';

--
-- Volcado de datos para la tabla `TABLERO`
--

INSERT INTO `TABLERO` (`codTablero`, `codEstado`, `nomTablero`) VALUES
(1, 'A', 'TABLERO ASUNCION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TABLERODETALLE`
--

CREATE TABLE `TABLERODETALLE` (
  `codTableroDetalle` int(6) NOT NULL,
  `codEstado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código Estado',
  `codTablero` int(6) NOT NULL COMMENT 'Código Tablero',
  `codSucursal` int(3) NOT NULL COMMENT 'Código Sucursal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='TABLERO DETALLE';

--
-- Volcado de datos para la tabla `TABLERODETALLE`
--

INSERT INTO `TABLERODETALLE` (`codTableroDetalle`, `codEstado`, `codTablero`, `codSucursal`) VALUES
(1, 'A', 1, 1),
(2, 'A', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CIUDAD`
--
ALTER TABLE `CIUDAD`
  ADD PRIMARY KEY (`codCiudad`);

--
-- Indices de la tabla `COTIZACION`
--
ALTER TABLE `COTIZACION`
  ADD PRIMARY KEY (`codCotizacion`),
  ADD UNIQUE KEY `codSucursal_2` (`codSucursal`,`codMonedaBase`,`codMonedaRelacion`) USING BTREE,
  ADD KEY `codMonedaBase` (`codMonedaBase`) USING BTREE,
  ADD KEY `codMonedaRelacion` (`codMonedaRelacion`) USING BTREE,
  ADD KEY `codSucursal` (`codSucursal`) USING BTREE;

--
-- Indices de la tabla `COTIZACIONDETALLE`
--
ALTER TABLE `COTIZACIONDETALLE`
  ADD PRIMARY KEY (`codCotizacionDetalle`),
  ADD KEY `codCotizacion` (`codCotizacion`),
  ADD KEY `codCotizacionTipo` (`codCotizacionTipo`);

--
-- Indices de la tabla `COTIZACIONTIPO`
--
ALTER TABLE `COTIZACIONTIPO`
  ADD PRIMARY KEY (`codCotizacionTipo`);

--
-- Indices de la tabla `EMPRESA`
--
ALTER TABLE `EMPRESA`
  ADD PRIMARY KEY (`codEmpresa`);

--
-- Indices de la tabla `MONEDA`
--
ALTER TABLE `MONEDA`
  ADD PRIMARY KEY (`codMoneda`);

--
-- Indices de la tabla `SUCURSAL`
--
ALTER TABLE `SUCURSAL`
  ADD PRIMARY KEY (`codSucursal`),
  ADD KEY `codEmpresa` (`codEmpresa`),
  ADD KEY `codCiudad` (`codCiudad`);

--
-- Indices de la tabla `TABLERO`
--
ALTER TABLE `TABLERO`
  ADD PRIMARY KEY (`codTablero`);

--
-- Indices de la tabla `TABLERODETALLE`
--
ALTER TABLE `TABLERODETALLE`
  ADD PRIMARY KEY (`codTableroDetalle`) USING BTREE,
  ADD KEY `codTablero` (`codTablero`),
  ADD KEY `codEmpresa` (`codSucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `CIUDAD`
--
ALTER TABLE `CIUDAD`
  MODIFY `codCiudad` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Código Ciudad', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `COTIZACION`
--
ALTER TABLE `COTIZACION`
  MODIFY `codCotizacion` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Código Cotización', AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `COTIZACIONDETALLE`
--
ALTER TABLE `COTIZACIONDETALLE`
  MODIFY `codCotizacionDetalle` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Código Cotización Detalle', AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `COTIZACIONTIPO`
--
ALTER TABLE `COTIZACIONTIPO`
  MODIFY `codCotizacionTipo` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Código Cotización Tipo', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `EMPRESA`
--
ALTER TABLE `EMPRESA`
  MODIFY `codEmpresa` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Código Empresa', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `MONEDA`
--
ALTER TABLE `MONEDA`
  MODIFY `codMoneda` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Código Moneda', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `SUCURSAL`
--
ALTER TABLE `SUCURSAL`
  MODIFY `codSucursal` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Código Sucursal', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `TABLERO`
--
ALTER TABLE `TABLERO`
  MODIFY `codTablero` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Código Tablero', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `TABLERODETALLE`
--
ALTER TABLE `TABLERODETALLE`
  MODIFY `codTableroDetalle` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `COTIZACION`
--
ALTER TABLE `COTIZACION`
  ADD CONSTRAINT `COTIZACION_ibfk_1` FOREIGN KEY (`codSucursal`) REFERENCES `SUCURSAL` (`codSucursal`),
  ADD CONSTRAINT `COTIZACION_ibfk_2` FOREIGN KEY (`codMonedaBase`) REFERENCES `MONEDA` (`codMoneda`),
  ADD CONSTRAINT `COTIZACION_ibfk_3` FOREIGN KEY (`codMonedaRelacion`) REFERENCES `MONEDA` (`codMoneda`);

--
-- Filtros para la tabla `COTIZACIONDETALLE`
--
ALTER TABLE `COTIZACIONDETALLE`
  ADD CONSTRAINT `COTIZACIONDETALLE_ibfk_1` FOREIGN KEY (`codCotizacion`) REFERENCES `COTIZACION` (`codCotizacion`),
  ADD CONSTRAINT `COTIZACIONDETALLE_ibfk_2` FOREIGN KEY (`codCotizacionTipo`) REFERENCES `COTIZACIONTIPO` (`codCotizacionTipo`);

--
-- Filtros para la tabla `SUCURSAL`
--
ALTER TABLE `SUCURSAL`
  ADD CONSTRAINT `SUCURSAL_ibfk_1` FOREIGN KEY (`codEmpresa`) REFERENCES `EMPRESA` (`codEmpresa`),
  ADD CONSTRAINT `SUCURSAL_ibfk_2` FOREIGN KEY (`codCiudad`) REFERENCES `CIUDAD` (`codCiudad`);

--
-- Filtros para la tabla `TABLERODETALLE`
--
ALTER TABLE `TABLERODETALLE`
  ADD CONSTRAINT `TABLERODETALLE_ibfk_1` FOREIGN KEY (`codTablero`) REFERENCES `TABLERO` (`codTablero`),
  ADD CONSTRAINT `TABLERODETALLE_ibfk_2` FOREIGN KEY (`codSucursal`) REFERENCES `SUCURSAL` (`codSucursal`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
