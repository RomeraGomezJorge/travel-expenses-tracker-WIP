-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: database
-- Tiempo de generación: 01-02-2022 a las 15:26:31
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database_test`
--
CREATE DATABASE IF NOT EXISTS `database_test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `database_test`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `identity_card` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `location_costs`
--

CREATE TABLE `location_costs` (
  `id` int NOT NULL,
  `location` varchar(255) NOT NULL,
  `cost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resolution`
--

CREATE TABLE `resolution` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `year` int DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `travel_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `travel`
--

CREATE TABLE `travel` (
  `id` int NOT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `travel_expenses` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `travellers_name`
--

CREATE TABLE `travellers_name` (
  `id` int NOT NULL,
  `employee` int NOT NULL,
  `replacement` int DEFAULT NULL,
  `travel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `travel_destination`
--

CREATE TABLE `travel_destination` (
  `trip_destination_id` int NOT NULL,
  `travel_id` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trip_destination`
--

CREATE TABLE `trip_destination` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `location_costs` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `location_costs`
--
ALTER TABLE `location_costs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `location` (`location`);

--
-- Indices de la tabla `resolution`
--
ALTER TABLE `resolution`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `travel_id` (`travel_id`),
  ADD KEY `travel_fk` (`travel_id`);

--
-- Indices de la tabla `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `travellers_name`
--
ALTER TABLE `travellers_name`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `employee_id` (`employee`),
  ADD KEY `replacement_id` (`id`),
  ADD KEY `travel_id` (`travel`),
  ADD KEY `travellers_name_ibfk_2` (`replacement`);

--
-- Indices de la tabla `travel_destination`
--
ALTER TABLE `travel_destination`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trip_destination`
--
ALTER TABLE `trip_destination`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `location_costs_id` (`location_costs`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `location_costs`
--
ALTER TABLE `location_costs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `travellers_name`
--
ALTER TABLE `travellers_name`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `travel_destination`
--
ALTER TABLE `travel_destination`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trip_destination`
--
ALTER TABLE `trip_destination`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `travellers_name`
--
ALTER TABLE `travellers_name`
  ADD CONSTRAINT `travellers_name_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `travellers_name_ibfk_2` FOREIGN KEY (`replacement`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `travellers_name_ibfk_3` FOREIGN KEY (`travel`) REFERENCES `travel` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `trip_destination`
--
ALTER TABLE `trip_destination`
  ADD CONSTRAINT `trip_destination_ibfk_1` FOREIGN KEY (`location_costs`) REFERENCES `location_costs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
