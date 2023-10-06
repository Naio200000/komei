-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2023 a las 17:08:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pii_komei_prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descript` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `descript`) VALUES
(1, 'semanal'),
(2, 'semanal'),
(3, 'personas'),
(4, 'color'),
(5, 'material');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(10) UNSIGNED NOT NULL,
  `direccion` varchar(256) NOT NULL,
  `descript` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `direccion`, `descript`) VALUES
(1, 'clases-01', 'Banner de clases de Iaido'),
(2, 'clases-02', 'Imagen de un sensei sentado en frente a sus alumnos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `categoria` enum('clases','ropa','equipos') NOT NULL,
  `id_tipo` int(10) UNSIGNED NOT NULL,
  `descript` text DEFAULT NULL,
  `disponible` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `precio` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `categoria`, `id_tipo`, `descript`, `disponible`, `precio`) VALUES
(1, '1 Clase grupal', 'clases', 1, 'Disfruta de una clase por semana en los días que prefieras - Te invitamos a participar una clase semanal para el uso de la <span lang=\'ja\'>katana</span> japonesa (esgrima samurai). En la misma podrás ver los fundamentos básicos de uso de la katana japonés. Todo el material lo provee el dojo, solo necesitas ropa cómoda.', '2023-10-06 14:10:07', 7000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_categoria_valor`
--

CREATE TABLE `producto_categoria_valor` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `id_valor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_categoria_valor`
--

INSERT INTO `producto_categoria_valor` (`id_producto`, `id_categoria`, `id_valor`) VALUES
(1, 1, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagen`
--

CREATE TABLE `producto_imagen` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `id_imagen` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `descript` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`, `descript`) VALUES
(1, 'Clase', NULL),
(2, 'dogi', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores`
--

CREATE TABLE `valores` (
  `id` int(11) UNSIGNED NOT NULL,
  `descript` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valores`
--

INSERT INTO `valores` (`id`, `descript`) VALUES
(1, 'azul'),
(2, 'negro'),
(3, 'Blanco'),
(4, 'Gris'),
(5, 'Rayada'),
(6, 'Tetrón'),
(7, 'Algodón'),
(8, 'Lana'),
(9, 'Ceda'),
(10, 'Igusa'),
(11, 'Acero 1060'),
(12, 'Acero 1095'),
(13, 'Aluminio'),
(14, 'Incienso'),
(15, 'Clases personales'),
(16, 'Clases grupales'),
(17, '1 Clase'),
(18, '2 Clases'),
(19, '3 Clases');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`categoria`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `producto_categoria_valor`
--
ALTER TABLE `producto_categoria_valor`
  ADD PRIMARY KEY (`id_producto`,`id_categoria`,`id_valor`),
  ADD UNIQUE KEY `id_valor` (`id_valor`),
  ADD UNIQUE KEY `id_categoria` (`id_categoria`),
  ADD UNIQUE KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  ADD PRIMARY KEY (`id_producto`,`id_imagen`),
  ADD UNIQUE KEY `id_producto` (`id_producto`),
  ADD UNIQUE KEY `id_imagen` (`id_imagen`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valores`
--
ALTER TABLE `valores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `valores`
--
ALTER TABLE `valores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_categoria_valor`
--
ALTER TABLE `producto_categoria_valor`
  ADD CONSTRAINT `producto_categoria_valor_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `caracteristicas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_categoria_valor_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_categoria_valor_ibfk_3` FOREIGN KEY (`id_valor`) REFERENCES `valores` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  ADD CONSTRAINT `producto_imagen_ibfk_1` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_imagen_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
