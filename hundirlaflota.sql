-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-02-2019 a las 14:03:22
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hundirlaflota`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casillas`
--

CREATE TABLE `casillas` (
  `IDCasilla` int(10) UNSIGNED NOT NULL,
  `Letra` int(1) DEFAULT NULL,
  `Numero` int(1) UNSIGNED NOT NULL,
  `IDTablero` int(7) UNSIGNED NOT NULL,
  `IDTipoBarco` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadospartida`
--

CREATE TABLE `estadospartida` (
  `IDEstadoPartida` int(1) UNSIGNED NOT NULL,
  `Descripcion` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadospartida`
--

INSERT INTO `estadospartida` (`IDEstadoPartida`, `Descripcion`) VALUES
(1, 'Host Preparando Barcos'),
(2, 'Contrincante Preparando Barcos'),
(3, 'Finalizada-Ganador Host'),
(4, 'Empezada - Turno Host'),
(5, 'Empezada - Turno Contrincante'),
(6, 'Finalizada'),
(7, 'Finalizada'),
(8, 'Creada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `IDJugador` int(3) UNSIGNED NOT NULL,
  `Usuario` varchar(50) DEFAULT NULL COMMENT 'email del usuario',
  `Password` varchar(50) DEFAULT NULL COMMENT 'Contrase?a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `IDPartida` int(6) UNSIGNED NOT NULL,
  `IDHost` int(3) UNSIGNED NOT NULL COMMENT 'ID del jugador Host',
  `IDContrincante` int(3) UNSIGNED DEFAULT NULL COMMENT 'ID del jugador Contrincante',
  `IDEstadoPartida` int(1) UNSIGNED DEFAULT NULL,
  `nombrePartida` varchar(20) DEFAULT NULL,
  `passwordPartida` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tableros`
--

CREATE TABLE `tableros` (
  `IDTablero` int(7) UNSIGNED NOT NULL,
  `IDJugador` int(3) UNSIGNED NOT NULL,
  `IDPartida` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casillas`
--
ALTER TABLE `casillas`
  ADD PRIMARY KEY (`IDCasilla`),
  ADD KEY `FK_casillas_tableros` (`IDTablero`);

--
-- Indices de la tabla `estadospartida`
--
ALTER TABLE `estadospartida`
  ADD PRIMARY KEY (`IDEstadoPartida`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`IDJugador`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`IDPartida`),
  ADD KEY `FK_partidas_jugadores` (`IDHost`),
  ADD KEY `FK_partidas_jugadores_2` (`IDContrincante`),
  ADD KEY `FK_partidas_estadospartida` (`IDEstadoPartida`);

--
-- Indices de la tabla `tableros`
--
ALTER TABLE `tableros`
  ADD PRIMARY KEY (`IDTablero`),
  ADD KEY `FK_tableros_jugadores` (`IDJugador`),
  ADD KEY `FK_tableros_partidas` (`IDPartida`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casillas`
--
ALTER TABLE `casillas`
  MODIFY `IDCasilla` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT de la tabla `estadospartida`
--
ALTER TABLE `estadospartida`
  MODIFY `IDEstadoPartida` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `IDJugador` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `IDPartida` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `casillas`
--
ALTER TABLE `casillas`
  ADD CONSTRAINT `FK_casillas_tableros` FOREIGN KEY (`IDTablero`) REFERENCES `tableros` (`IDTablero`);

--
-- Filtros para la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD CONSTRAINT `FK_partidas_estadospartida` FOREIGN KEY (`IDEstadoPartida`) REFERENCES `estadospartida` (`IDEstadoPartida`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_partidas_jugadores` FOREIGN KEY (`IDHost`) REFERENCES `jugadores` (`IDJugador`),
  ADD CONSTRAINT `FK_partidas_jugadores_2` FOREIGN KEY (`IDContrincante`) REFERENCES `jugadores` (`IDJugador`);

--
-- Filtros para la tabla `tableros`
--
ALTER TABLE `tableros`
  ADD CONSTRAINT `FK_tableros_jugadores` FOREIGN KEY (`IDJugador`) REFERENCES `jugadores` (`IDJugador`),
  ADD CONSTRAINT `FK_tableros_partidas` FOREIGN KEY (`IDPartida`) REFERENCES `partidas` (`IDPartida`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
