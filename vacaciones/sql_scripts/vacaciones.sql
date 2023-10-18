-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2023 a las 22:06:11
-- Versión del servidor: 8.0.26
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vacaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--
create database vacaciones;
use vacaciones;
CREATE TABLE `personas` (
  `Id` int NOT NULL,
  `Nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Fecha_registro` date NOT NULL,
  `Fecha_inicio_laboral` date NOT NULL,
  `Dias_vacaciones` int NOT NULL,
  `sector` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`Id`, `Nombre`, `Fecha_registro`, `Fecha_inicio_laboral`, `Dias_vacaciones`, `sector`) VALUES
(1, 'Anabella', '2016-02-01', '2016-02-01', 25, 1),
(2, 'Ailen', '2019-05-01', '2019-05-01', 20, 1),
(4, 'Luciano', '2023-06-08', '2023-06-08', 5, 2),
(5, 'Eduardo', '2019-05-01', '2019-05-01', 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `politicavac`
--

CREATE TABLE `politicavac` (
  `IdVac` int NOT NULL,
  `CantMin` int DEFAULT NULL,
  `CantMax` int DEFAULT NULL,
  `SectorEsp` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `id` int NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`id`, `Nombre`) VALUES
(1, 'Sistemas'),
(2, 'Administrativo'),
(3, 'RRHH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int NOT NULL,
  `persona_id` int NOT NULL,
  `tipo_solicitud` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'VS',
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'S',
  `fecha_registro` date NOT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  `observa_notifica` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `persona_id`, `tipo_solicitud`, `estado`, `fecha_registro`, `fecha_desde`, `fecha_hasta`, `observa_notifica`) VALUES
(1, 1, 'VS', 'A', '2018-05-01', '2022-06-08', '2022-06-28', NULL),
(2, 1, 'VS', 'A', '2023-09-20', '2023-10-10', '2023-10-20', NULL),
(3, 2, 'VS', 'R', '2019-06-01', '2019-06-01', '2019-06-20', 'RRHH- No corresponde dias de vacaciones'),
(4, 1, 'VS', 'S', '2023-10-01', '2023-11-05', '2023-11-10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `persona_id` int NOT NULL,
  `habilitado` bit(1) NOT NULL,
  `es_admin` bit(1) NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `fecha_registro`, `persona_id`, `habilitado`, `es_admin`, `imagen`) VALUES
(1, 'ana', 'Anabella', '123', '2023-10-07', 1, b'1', b'0', NULL),
(2, 'edu', 'Eduardo', '123', '2023-10-07', 5, b'1', b'1', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Fk_persona_sector_idx` (`sector`);

--
-- Indices de la tabla `politicavac`
--
ALTER TABLE `politicavac`
  ADD PRIMARY KEY (`IdVac`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Sol_Pers_idx` (`persona_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `politicavac`
--
ALTER TABLE `politicavac`
  MODIFY `IdVac` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `Fk_persona_sector` FOREIGN KEY (`sector`) REFERENCES `sectores` (`id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `k_sol_per` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
