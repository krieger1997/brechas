-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-10-2020 a las 06:00:53
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `brechas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `ID_AREA` int(11) NOT NULL,
  `NOMBRE_AREA` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`ID_AREA`, `NOMBRE_AREA`) VALUES
(0, 'Supervision'),
(1, 'Adquisiciones y Abastecimiento'),
(2, 'Mantenimiento'),
(3, 'GPDO'),
(4, 'Producción'),
(5, 'Administración'),
(6, 'Ssoma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brechas`
--

CREATE TABLE `brechas` (
  `id` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `titulo` tinytext CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `autor` tinyint(4) NOT NULL,
  `imagen` varchar(90) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ABIERTA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `brechas`
--

INSERT INTO `brechas` (`id`, `area`, `fecha`, `titulo`, `descripcion`, `autor`, `imagen`, `estado`) VALUES
(2, 1, '2020-09-26', 'sadassda', 'sadasdas', 1, NULL, 'PENDIENTE'),
(3, 6, '2020-09-26', 'NUEVA BRECHA FORMULARIO', 'saddsasda aaaaaaaaaaaaa asda advvvvvvvvvvvvvvvvvvvvvv', 2, NULL, 'ABIERTA'),
(4, 5, '2020-09-26', 'sadsasdasdasdaasdsdadsaasdads', 'sasadsdasaddasasddasadsdassdasda', 1, NULL, 'ABIERTA'),
(5, 4, '2020-09-26', 'kdsfjasñdlk', 'ksdñjflkjañsdlfk', 1, NULL, 'ABIERTA'),
(6, 4, '2020-09-26', 'assasdasd', 'asdsadasdasda', 1, NULL, 'ABIERTA'),
(7, 1, '2020-09-26', 'aasdasdas', 'sadasdasda', 1, NULL, 'PENDIENTE'),
(8, 1, '2020-09-26', 'asdas', 'asdasdsd', 1, NULL, 'ABIERTA'),
(9, 1, '2020-10-02', 'asdsa', 'sadssad', 1, NULL, 'ABIERTA'),
(10, 1, '2020-10-02', 'saddsa', 'dsas', 1, 'velocidad.png', 'ABIERTA'),
(11, 1, '2020-10-02', 'asdsa', 'saddsadsa', 1, 'mas.png', 'ABIERTA'),
(12, 2, '2020-10-06', 'TADASDASDASD', 'ssdmfasdljfasdñjfas ldkjhasldkj fhasdljkf halskj fahsljkfd h lf sjdfhlaskjdfas df', 1, 'L1e_o1Ep.jpg', 'ABIERTA'),
(13, 3, '2020-10-09', 'NUEVA BRECHA FORMULARIO editado x3', 'asdasa asdas das ads adsa dsasda dsadsds editadox3', 1, 'llama.png', 'ABIERTA'),
(14, 3, '2020-10-07', 'assssssssssss', 'sssssssssssssssss', 2, 'ibai.jpg', 'ABIERTA'),
(15, 3, '2020-10-07', 'hkjbllhkj', 'jlhñjl', 2, 'ibai.jpg', 'ABIERTA'),
(16, 3, '2020-10-07', 'asda', 'asdasd', 2, NULL, 'ABIERTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cierres`
--

CREATE TABLE `cierres` (
  `id` int(11) NOT NULL,
  `id_brecha` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `titulo` tinytext NOT NULL,
  `descripcion` text NOT NULL,
  `autor` tinyint(4) NOT NULL,
  `imagen` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cierres`
--

INSERT INTO `cierres` (`id`, `id_brecha`, `fecha`, `titulo`, `descripcion`, `autor`, `imagen`) VALUES
(1, 2, '2020-10-15', 'PRUEBA CIERRE1', 'PRUEBA CIERRE1PRUEBA CIERRE1', 2, '102649.png'),
(2, 7, '2020-10-15', 'location.reload();', 'location.reload();location.reload();', 2, '57164.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_usuario`
--

CREATE TABLE `tipo_de_usuario` (
  `id` tinyint(4) NOT NULL,
  `nombre_tipo` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_de_usuario`
--

INSERT INTO `tipo_de_usuario` (`id`, `nombre_tipo`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` tinyint(4) NOT NULL,
  `nombre_de_usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_de_usuario` tinyint(4) NOT NULL,
  `area` int(11) NOT NULL,
  `rut` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `seg_nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `pri_apellido` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `seg_apellido` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_de_usuario`, `contrasena`, `tipo_de_usuario`, `area`, `rut`, `nombre`, `seg_nombre`, `pri_apellido`, `seg_apellido`, `email`, `telefono`) VALUES
(1, '19598102', 'admin', 1, 3, '19.598.102-7', 'CLAUDIO', 'ALEJANDRO', 'CABRERA', 'MARTÍNEZ', 'claudio_krieger@hotmail.com', '+56979287465'),
(2, '159', '159', 2, 1, '11.111.111-1', 'AAAA', 'BBBBB', 'CCCCC', 'DDDD', 'ABCD@ABCD.COM', '+56900000000'),
(3, 'super', 'super', 2, 0, '00.000.000-0', 'SUPERVISOR', 'SUPERVISOR', 'SUPERVISOR', 'SUPERVISOR', 'supervisor@a.aa', '+56911111111'),
(4, 'asa', 'asdsad', 2, 3, 'asd', 'asd', NULL, 'asd', 'asd', 'asdasdasds@a.com', NULL),
(5, '1592', '1592', 2, 1, '11.111.111-2', 'AAAA', 'BBBBB', 'CCCCC', 'DDDD', 'ABCD@ABCD2.COM', '+56900000000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`ID_AREA`);

--
-- Indices de la tabla `brechas`
--
ALTER TABLE `brechas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_brechas_areas` (`area`),
  ADD KEY `fk_brechas_usuarios` (`autor`);

--
-- Indices de la tabla `cierres`
--
ALTER TABLE `cierres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_brecha` (`id_brecha`),
  ADD KEY `fk_cierre_usuario` (`autor`);

--
-- Indices de la tabla `tipo_de_usuario`
--
ALTER TABLE `tipo_de_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rut` (`rut`),
  ADD KEY `fk_usuarios_tipo` (`tipo_de_usuario`),
  ADD KEY `fk_usuarios_areas` (`area`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brechas`
--
ALTER TABLE `brechas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `cierres`
--
ALTER TABLE `cierres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_de_usuario`
--
ALTER TABLE `tipo_de_usuario`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `brechas`
--
ALTER TABLE `brechas`
  ADD CONSTRAINT `fk_brechas_areas` FOREIGN KEY (`area`) REFERENCES `areas` (`ID_AREA`),
  ADD CONSTRAINT `fk_brechas_usuarios` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `cierres`
--
ALTER TABLE `cierres`
  ADD CONSTRAINT `fk_cierre_brecha` FOREIGN KEY (`id_brecha`) REFERENCES `brechas` (`id`),
  ADD CONSTRAINT `fk_cierre_usuario` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_areas` FOREIGN KEY (`area`) REFERENCES `areas` (`ID_AREA`),
  ADD CONSTRAINT `fk_usuarios_tipo` FOREIGN KEY (`tipo_de_usuario`) REFERENCES `tipo_de_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
