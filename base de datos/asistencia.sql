-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-02-2025 a las 03:06:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `iddni` char(8) NOT NULL CHECK (`iddni` regexp '^[0-9]{8}$'),
  `nombres_apellidos` varchar(100) NOT NULL,
  `modalidad_contratacion` varchar(50) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `sueldo` decimal(10,2) DEFAULT NULL,
  `fecha_registro` date DEFAULT curdate(),
  `foto` longtext NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`iddni`, `nombres_apellidos`, `modalidad_contratacion`, `cargo`, `fecha_nacimiento`, `edad`, `sueldo`, `fecha_registro`, `foto`, `estado`) VALUES
('76531084', 'Jose Alexander Yovera Simbala ', 'D.L N°276 - Carrera Administrativa', 'TOPOGRAFO', '2001-05-05', 52, 1200.00, '2025-02-08', 'data:image/jpeg;base64,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', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusudni` char(8) NOT NULL,
  `datos` varchar(255) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rol` char(1) NOT NULL,
  `Telefono` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusudni`, `datos`, `usuario`, `password`, `email`, `rol`, `Telefono`) VALUES
('76531080', 'juan perez camachoqeeeee', 'admin2', 'admin2', 'milos01239@gmail.com', '2', 95201120);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`iddni`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusudni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
