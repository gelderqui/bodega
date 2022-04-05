-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2022 a las 08:08:31
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbbodega`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `idproveedor` int(10) UNSIGNED NOT NULL,
  `idusuario` int(10) UNSIGNED NOT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `descuento_nota` decimal(11,2) NOT NULL,
  `flete` decimal(11,2) NOT NULL,
  `condicion` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `id` int(10) UNSIGNED NOT NULL,
  `idproducto` int(10) UNSIGNED NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id`, `idproducto`, `precio`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 1, '50.00', 'primer precio d esal', 1, '2022-02-27 02:18:06', '2022-02-27 02:18:06'),
(2, 2, '45.00', 'primer precio de azucar', 1, NULL, NULL),
(3, 4, '12.54', 'Ingreso desde sistema nuevo', 0, '2022-02-27 08:36:22', '2022-02-27 08:36:22'),
(4, 4, '12.55', 'Ingreso desde sistema Actualizar', 0, '2022-02-27 08:42:20', '2022-02-27 09:09:02'),
(5, 3, '555.00', 'Ingreso desde sistema Actualizar', 1, '2022-02-27 08:45:20', '2022-02-27 08:45:20'),
(6, 5, '13.00', 'Ingreso desde sistema Actualizar', 1, '2022-02-27 09:11:52', '2022-02-27 09:11:52'),
(7, 4, '13.50', 'Ingreso desde sistema Actualizar', 0, '2022-02-27 09:13:54', '2022-02-27 09:13:54'),
(8, 4, '13.55', 'Ingreso desde sistema Actualizar', 0, '2022-02-27 09:15:21', '2022-02-27 09:15:21'),
(9, 4, '13.56', 'Ingreso desde sistema Actualizar', 0, '2022-02-27 09:16:43', '2022-02-27 09:16:43'),
(10, 4, '13.57', 'Ingreso desde sistema Actualizar', 0, '2022-02-27 09:19:14', '2022-03-02 13:07:02'),
(11, 6, '0.00', 'Ingreso nuevo sin precio', 0, '2022-02-27 09:27:22', '2022-02-27 09:27:22'),
(12, 6, '0.01', 'Ingreso desde sistema Actualizar', 0, '2022-02-27 09:31:19', '2022-02-27 09:31:19'),
(13, 6, '0.01', 'Ingreso desde sistema Actualizar', 1, '2022-02-27 09:33:42', '2022-02-27 09:33:42'),
(14, 10, '34.00', 'Ingreso nuevo con precio', 1, '2022-03-02 12:31:02', '2022-03-02 12:31:02'),
(15, 9, '100.00', 'Ingreso al actualizar producto No:1', 1, '2022-03-02 13:15:07', '2022-03-02 13:15:07'),
(16, 4, '150.00', 'Ingreso al actualizar producto No:7', 1, '2022-03-02 13:16:16', '2022-03-02 13:16:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `cantidad`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'sal1', 'sin descripcion', 70, 1, '2022-02-27 02:17:15', '2022-02-27 02:17:15'),
(2, 'azucar2', 'in desc', 12, 1, '2022-02-27 02:17:15', '2022-02-27 08:27:02'),
(3, 'Harinaa3', NULL, 4556, 1, '2022-02-27 08:35:53', '2022-02-27 08:46:40'),
(4, 'sulfato4', NULL, 1, 1, '2022-02-27 08:36:22', '2022-03-02 13:01:47'),
(5, 'panito5', NULL, 34, 1, '2022-02-27 09:19:35', '2022-02-27 09:19:35'),
(6, 'panito6', NULL, 123, 1, '2022-02-27 09:27:22', '2022-02-27 09:27:22'),
(7, 'panito 7', NULL, 12, 1, '2022-03-02 12:23:27', '2022-03-02 12:23:27'),
(8, 'panito8', NULL, 12, 1, '2022-03-02 12:24:36', '2022-03-02 12:24:36'),
(9, 'panito9', NULL, 11, 1, '2022-03-02 12:29:15', '2022-03-02 13:15:06'),
(10, 'panito10', NULL, 34, 0, '2022-03-02 12:31:02', '2022-03-02 13:27:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `contacto`, `telefono`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'gelder', 'qui', '44938093', 1, '2022-02-26 08:25:43', '2022-02-26 08:25:43'),
(2, 'gelder2', 'quiñonez2', '2323', 0, '2022-02-26 15:06:09', '2022-02-26 15:07:50'),
(3, 'manuel1', 'qwqw', '12121', 1, '2022-02-26 15:09:38', '2022-02-26 15:09:38'),
(4, 'edgar1', 'SADFSA', '121212', 1, '2022-02-26 15:09:49', '2022-02-26 15:09:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'todo el sistema', 1, '2022-02-26 20:18:25', '2022-02-26 20:18:25'),
(2, 'digitador', 'casi todo el sistema', 1, '2022-02-26 20:18:46', '2022-02-26 20:18:46'),
(3, 'bodeguero', 'toda la bodega', 1, '2022-02-26 20:18:46', '2022-02-26 20:18:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `nombre`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'AM', 'todo lo de la mañan 1 am a 1159 am', 1, '2022-02-26 20:14:39', '2022-02-26 20:14:39'),
(2, 'PM', 'todo despues de las 12 pm a las 1159 pm', 1, '2022-02-26 20:15:15', '2022-02-26 20:15:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `idrol` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `idrol`, `nombre`, `usuario`, `password`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 1, 'gelder quiñonez', 'gelder', 'gelder', 1, '2022-02-26 20:28:41', '2022-02-26 20:28:41'),
(2, 1, 'edgar lopz', 'edgar', 'edgar', 1, '2022-02-26 20:28:41', '2022-02-26 20:28:41'),
(3, 3, 'jose lopez', 'jose', '$2y$10$5/MtGkqu0vurM.Kg9CfDLOivJzq/2YtpsgbqbUmAY4vIgieO.uzx.', 1, '2022-02-27 04:07:18', '2022-02-27 04:25:56'),
(4, 3, 'gelder2222', 'gelder2222', '$2y$10$5j/Rjp4Pa7ecc6THLsS/6uRYnBF/NxJFSAasI0gCbMCXVTVA/nOSS', 1, '2022-02-27 04:12:54', '2022-02-27 04:42:18'),
(5, 2, 'gelder3', 'gelder4wewr', 'wer', 1, '2022-02-27 04:35:50', '2022-02-27 04:48:40');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `precios_idproducto_foreign` (`idproducto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_idrol_foreign` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `precios`
--
ALTER TABLE `precios`
  ADD CONSTRAINT `precios_idproducto_foreign` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `usuarios_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
