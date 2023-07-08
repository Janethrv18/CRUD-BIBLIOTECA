-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2023 a las 02:48:13
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
-- Base de datos: `crud-biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `CodAlumno` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellidos` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`CodAlumno`, `Nombre`, `Apellidos`, `Email`) VALUES
(1, 'Janeth', 'Ruiz Vicente', 'diana.ruiz@espoch.edu.ec'),
(2, 'Gisselly', 'Barragan Quezada', 'eilyn.barragan@espoch.edu.ec'),
(3, 'Nicole', 'Barahona', 'nicole.barahona@espoch.edu.ec'),
(4, 'Stalin', 'Vicente Correa', 'stalin@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `ISBN` varchar(50) NOT NULL,
  `Titulo` varchar(100) DEFAULT NULL,
  `Autor` varchar(100) DEFAULT NULL,
  `Editorial` varchar(100) DEFAULT NULL,
  `Nropaginas` int(11) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`ISBN`, `Titulo`, `Autor`, `Editorial`, `Nropaginas`, `Stock`) VALUES
('1FGME5FGP', 'La Era de Hielo', 'Pepito', 'Pepito', 530, 1),
('DJKVDF6NGDFNK4V-D', 'la Dama ', 'Ecf', 'hjwef', 245, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `CodPrestamo` int(11) NOT NULL,
  `ISBN` varchar(50) DEFAULT NULL,
  `CodAlumno` int(11) DEFAULT NULL,
  `Fechadeprestamo` date DEFAULT NULL,
  `Fechadedevolucion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`CodPrestamo`, `ISBN`, `CodAlumno`, `Fechadeprestamo`, `Fechadedevolucion`) VALUES
(1, '1FGME5FGP', 3, '2023-07-07', '2023-07-08'),
(2, '1FGME5FGP', 1, '2023-07-07', '2023-07-08'),
(3, '1FGME5FGP', 4, '2023-08-12', '2023-09-15'),
(4, '1FGME5FGP', 2, '2023-08-12', '2023-09-15'),
(5, 'DJKVDF6NGDFNK4V-D', 3, '2023-07-18', '2023-08-18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`CodAlumno`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`CodPrestamo`),
  ADD KEY `ISBN` (`ISBN`),
  ADD KEY `CodAlumno` (`CodAlumno`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `libro` (`ISBN`),
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`CodAlumno`) REFERENCES `estudiante` (`CodAlumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
