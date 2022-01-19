-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: database
-- Tiempo de generación: 19-01-2022 a las 21:42:11
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
-- Base de datos: `database`
--

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

--
-- Volcado de datos para la tabla `employee`
--

INSERT INTO `employee` (`id`, `name`, `surname`, `identity_card`) VALUES
(299, 'JOSE BENJAMIN', 'GONZALES', NULL),
(300, 'OSCAR ROBERTO', 'EULIARTE', NULL),
(301, 'RICARDO DAVID', 'NARVAEZ', NULL),
(302, 'CRISTINA DEL CARMEN', 'SUAREZ', NULL),
(303, 'ANGEL LEONARDO', 'MORALES', NULL),
(304, 'LUCAS DANIEL', 'ASIS', NULL),
(305, 'JOSE LUIS', 'OCAMPO BRAC', NULL),
(306, 'IGNACIO', 'LUQUE', NULL),
(310, 'ERNESTO OSVALDO', 'PALACIOS', NULL),
(311, 'CRISTIAN FABIAN', 'ALMONACID', NULL),
(313, 'JOSE OSVALDO', 'KORB', NULL),
(314, 'MARIA NOEL', 'MAGI', NULL),
(316, 'ANA PAULA', 'PAEZ SANZ', NULL),
(317, 'MARTIN EZEQUIEL', 'AUCE BORDON', NULL),
(318, 'HERNAN MATIAS', 'RODRIGUEZ', NULL),
(319, 'ALBA ANALIA', 'OVIEDO', NULL),
(320, 'MELANIA', 'MARTINASSO', NULL),
(321, 'MONICA AMALIA', 'ZAVATTI', NULL),
(322, 'JOSE AGUSTIN', 'MEDINA', NULL),
(323, 'VANESA NOEMI', 'GRANILLO PAEZ', NULL),
(325, 'GUILLERMO ANGEL', 'QUINTEROS', NULL),
(326, 'CRISTIAN WALTER', 'MALNATTI', NULL),
(327, 'FRANCISCO', 'SANCHEZ', NULL),
(328, 'ALBERTO EDUARDO NICOLAS', 'HEREDIA SORIA', NULL),
(329, 'MATIAS', 'BUSTOS', NULL),
(332, 'ANGEL ANTONIO', 'CHANAMPA', NULL),
(333, 'FERNANDO ALDO', 'HERRERA', NULL),
(334, 'ELIZABETH', 'KOBER', NULL),
(335, 'ARIEL ESTEBAN', 'OLIVERA', NULL),
(336, 'CRISTIAN ADRIAN', 'VERA', NULL),
(337, 'JOSE EZEQUIEL', 'FIGUEROA OROPEL', NULL),
(338, 'CESAR EDUARDO', 'PELLIZA', NULL),
(339, 'LEONARDO DAVID', 'RUIZ', NULL),
(340, 'FERNANDO ALEXIS', 'OVIEDO', NULL),
(341, 'JUAN CARLOS', 'QUINTERO', NULL),
(342, 'JUAN JOSE', 'ANDRADA', NULL),
(343, 'PAULA ANDREA', 'MAGAQUIAN', NULL),
(346, 'JORGE NICOLAS', 'BORDON', NULL),
(347, 'CRISTIAN GABRIEL', 'BUSTOS', NULL),
(350, 'sin nombre', 'QUINTEROS', NULL),
(351, 'GABRIEL NICOLAS', 'SANCHEZ', NULL),
(352, 'ANTONIO RICARDO', 'SANTELLAN', NULL),
(353, 'RICARDO ALEJANDRO', 'FUNES', NULL),
(354, 'GUILLERMO NICOLAS', 'ZARATE', NULL),
(355, 'SIN NOMBRE', 'ALAMO', NULL),
(356, 'ESTER', 'DUMO', NULL),
(358, 'EMILIO', 'MALDONADO', NULL),
(360, 'ELIANA', 'CARRIZO', NULL),
(361, 'VIRGINIA', 'ROCHIETTI', NULL),
(362, 'BELEN', 'ALTAMIRANO', NULL),
(364, 'BABI', 'ALAMO', NULL),
(368, 'RICARDO', 'RICARDO', NULL),
(370, 'SOFIA', 'MINUE', NULL),
(374, 'GISELA', 'AGUILAR', NULL),
(375, 'DANIEL', 'GRANILLO', NULL),
(377, 'FLORENCIA', 'OCAMPO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `location_costs`
--

CREATE TABLE `location_costs` (
  `id` int NOT NULL,
  `location` varchar(255) NOT NULL,
  `cost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `location_costs`
--

INSERT INTO `location_costs` (`id`, `location`, `cost`) VALUES
(1, 'Interior de la provincia', '1500'),
(2, 'Fuera de la provincia', '5000');

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

--
-- Volcado de datos para la tabla `travel`
--

INSERT INTO `travel` (`id`, `departure_date`, `arrival_date`, `travel_expenses`) VALUES
(80, '1212-12-19', '1212-12-19', '1500'),
(81, '1212-12-19', '1212-12-19', '1500');

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

--
-- Volcado de datos para la tabla `travellers_name`
--

INSERT INTO `travellers_name` (`id`, `employee`, `replacement`, `travel`) VALUES
(59, 299, NULL, 80),
(60, 299, NULL, 81);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `travel_destination`
--

CREATE TABLE `travel_destination` (
  `trip_destination_id` int NOT NULL,
  `travel_id` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `travel_destination`
--

INSERT INTO `travel_destination` (`trip_destination_id`, `travel_id`, `id`) VALUES
(223, 14, 1),
(224, 14, 2),
(256, 15, 3),
(223, 16, 4),
(238, 16, 5),
(228, 17, 6),
(223, 18, 7),
(223, 19, 8),
(227, 19, 9),
(223, 20, 10),
(225, 20, 11),
(226, 21, 12),
(223, 22, 13),
(224, 22, 14),
(223, 30, 15),
(223, 31, 16),
(223, 33, 17),
(226, 34, 18),
(227, 34, 19),
(224, 35, 20),
(224, 36, 21),
(226, 36, 22),
(247, 37, 23),
(247, 38, 24),
(241, 39, 25),
(245, 40, 26),
(242, 41, 27),
(223, 42, 28),
(224, 42, 29),
(223, 43, 30),
(224, 44, 31),
(224, 45, 32),
(224, 46, 33),
(225, 46, 34),
(223, 47, 35),
(223, 48, 36),
(223, 51, 37),
(223, 52, 38),
(223, 55, 39),
(223, 57, 40),
(223, 59, 41),
(223, 61, 42),
(223, 62, 43),
(223, 63, 44),
(223, 66, 45),
(223, 67, 46),
(223, 68, 47),
(223, 69, 48),
(223, 70, 49),
(223, 71, 50),
(223, 72, 51),
(224, 73, 52),
(223, 74, 53),
(223, 75, 54),
(223, 76, 55),
(223, 77, 56),
(223, 78, 57),
(223, 79, 58),
(228, 80, 59),
(223, 81, 60),
(223, 82, 61),
(223, 84, 62),
(223, 86, 63),
(223, 87, 64);

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
-- Volcado de datos para la tabla `trip_destination`
--

INSERT INTO `trip_destination` (`id`, `name`, `location_costs`) VALUES
(223, 'CHILECITO', 1),
(224, 'NONOGASTA', 1),
(225, 'CHAMICAL', 1),
(226, 'CHEPES', 1),
(227, 'SAN BLAS DE LOS SAUCES', 1),
(228, 'VILLA CASTELLI', 1),
(229, 'PORTEZUELO', 1),
(230, 'VINCHINA', 1),
(231, 'CHAÑAR', 1),
(232, 'AIMOGASTA', 1),
(233, 'MILAGRO', 1),
(234, 'GUANDACOL', 1),
(235, 'ANILLACO', 1),
(236, 'BANDA FLORIDA', 1),
(237, 'CASTRO BARROS', 1),
(238, 'PAGANCILLO', 1),
(239, 'OLTA', 1),
(240, 'TAMA', 1),
(241, 'PUNTA DE LOS LLANOS', 1),
(242, 'BAÑADO DE LOS PANTANOS', 1),
(243, 'ULAPES', 1),
(244, 'VILLA MAZAN', 1),
(245, 'PITUIL', 1),
(246, 'CATUNA', 1),
(247, 'MALANZAN', 1),
(248, 'KM. 81 - RUTA N°5', 1),
(249, 'RUTA N°5', 1),
(250, 'FAMATINA', 1),
(251, 'CORONEL FELIPE VARELA', 1),
(252, 'DEPARTAMENTO GENERAL. BELGRANO', 1),
(253, 'ARAUCO', 1),
(255, 'TUCUMAN', 2),
(256, 'CORDOBA', 2),
(257, 'CATAMARCA', 2);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=408;

--
-- AUTO_INCREMENT de la tabla `location_costs`
--
ALTER TABLE `location_costs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `travellers_name`
--
ALTER TABLE `travellers_name`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `travel_destination`
--
ALTER TABLE `travel_destination`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `trip_destination`
--
ALTER TABLE `trip_destination`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

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
