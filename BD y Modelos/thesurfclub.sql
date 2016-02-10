-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2016 a las 12:24:25
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `thesurfclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler`
--

CREATE TABLE `alquiler` (
  `id_alquiler` mediumint(8) UNSIGNED NOT NULL,
  `id_cliente` mediumint(8) UNSIGNED NOT NULL,
  `id_material` mediumint(8) UNSIGNED NOT NULL,
  `duracion_alquiler` tinyint(4) NOT NULL,
  `costo_alquiler` float(6,2) NOT NULL,
  `fecha_inicio_alquiler` date NOT NULL,
  `fecha_fin_alquiler` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`id_alquiler`, `id_cliente`, `id_material`, `duracion_alquiler`, `costo_alquiler`, `fecha_inicio_alquiler`, `fecha_fin_alquiler`) VALUES
(1, 6, 1, 127, 200.00, '2014-07-01', '2014-07-09'),
(2, 7, 6, 50, 100.00, '2014-09-02', '2014-09-13'),
(3, 9, 2, 10, 50.00, '2014-07-22', '2014-07-30'),
(4, 6, 6, 127, 500.00, '2014-09-01', '2014-09-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientecursos`
--

CREATE TABLE `clientecursos` (
  `id_curso` mediumint(9) NOT NULL,
  `id_cliente` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientecursos`
--

INSERT INTO `clientecursos` (`id_curso`, `id_cliente`) VALUES
(1, 6),
(1, 7),
(1, 8),
(38, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` mediumint(8) UNSIGNED NOT NULL,
  `dni_cliente` varchar(9) NOT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `apellidos_cliente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `dni_cliente`, `nombre_cliente`, `apellidos_cliente`) VALUES
(6, '12345678l', 'Alfonso', 'Suarez Casado'),
(7, '12345678k', 'Juan', 'Salado Perez'),
(8, '87654321q', 'Adrian', 'Rey Salado'),
(9, '87654321b', 'Rafael', 'Fernandez Asencio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `id_contrato` mediumint(8) UNSIGNED NOT NULL,
  `id_monitor` mediumint(9) NOT NULL,
  `duracion_contrato` smallint(5) UNSIGNED NOT NULL,
  `costo_contrato` float(6,2) NOT NULL,
  `fecha_inicio_contrato` date NOT NULL,
  `fecha_fin_contrato` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`id_contrato`, `id_monitor`, `duracion_contrato`, `costo_contrato`, `fecha_inicio_contrato`, `fecha_fin_contrato`) VALUES
(2, 1, 600, 1500.00, '2009-08-10', '2014-08-10'),
(3, 2, 700, 6000.00, '2010-10-20', '2012-10-20'),
(4, 2, 200, 1000.00, '2007-03-20', '2010-03-20'),
(5, 6, 100, 2000.00, '2010-02-10', '2011-02-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` mediumint(9) NOT NULL,
  `id_monitor` mediumint(9) NOT NULL,
  `id_playa` mediumint(9) NOT NULL,
  `nombre_curso` varchar(50) NOT NULL,
  `deporte` varchar(50) NOT NULL,
  `duracion_cursos` tinyint(3) UNSIGNED NOT NULL,
  `fecha_inicio_cursos` date NOT NULL,
  `fecha_fin_curso` date NOT NULL,
  `costo_curso` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `id_monitor`, `id_playa`, `nombre_curso`, `deporte`, `duracion_cursos`, `fecha_inicio_cursos`, `fecha_fin_curso`, `costo_curso`) VALUES
(1, 1, 1, 'surf_principiante', 'surfing', 255, '2014-06-12', '2014-08-06', 300.00),
(2, 2, 3, 'surf_intermedio', 'surfing', 100, '2014-04-01', '2014-04-07', 100.00),
(37, 3, 4, 'surf_avanzado', 'surfing', 100, '2014-08-03', '2014-08-11', 50.00),
(38, 4, 2, 'longboard_intermedio', 'longboard', 255, '2014-08-09', '2014-08-13', 500.00),
(39, 5, 5, 'longboard_avanzado', 'longboard', 200, '2014-06-05', '2014-06-17', 987.00),
(40, 6, 1, 'surf_nivel_competicion', 'surfing', 255, '2014-10-01', '2014-10-31', 600.00),
(41, 6, 1, 'bodyboard_intermedio', 'bodyboard', 30, '2014-04-01', '2014-04-16', 50.00),
(42, 1, 1, 'bodyboard_avanzado', 'bodyboard', 255, '2014-07-01', '2014-07-09', 600.00),
(43, 1, 1, 'entrenamiento_personal', 'entrenamiento_personal', 120, '2014-07-01', '2014-09-30', 100.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(4) NOT NULL,
  `body` text NOT NULL,
  `timestamp` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `body`, `timestamp`) VALUES
(15, 'Campeonato principiantes-todas las categorias', '1301522400'),
(21, 'Campeonato intermedios', '1301094000'),
(22, 'Campeonatos avanzados', '1301180400');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id_material` mediumint(8) UNSIGNED NOT NULL,
  `nombre_material` varchar(50) NOT NULL,
  `tipo_material` varchar(50) NOT NULL,
  `modelo_material` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id_material`, `nombre_material`, `tipo_material`, `modelo_material`) VALUES
(1, 'performance d2', 'surfboard', 'soulsurfboards'),
(2, 'Cabianca', 'surfboard', 'pukas'),
(3, 'ultrahigh', 'longboard', 'dhd'),
(4, 'assault v1', 'bodyboard', 'VZ'),
(5, 'ned kelly', 'longboard', 'all merick'),
(6, 'm inside', 'bodyboard', 'RS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitores`
--

CREATE TABLE `monitores` (
  `id_monitor` mediumint(9) NOT NULL,
  `dni_monitor` varchar(9) NOT NULL,
  `nombre_monitor` varchar(50) NOT NULL,
  `apellidos_monitor` varchar(50) NOT NULL,
  `email_monitor` varchar(50) NOT NULL,
  `direccion_monitor` varchar(100) DEFAULT NULL,
  `telefono_monitor` varchar(9) DEFAULT NULL,
  `actividad_monitor` varchar(50) NOT NULL,
  `foto_monitor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `monitores`
--

INSERT INTO `monitores` (`id_monitor`, `dni_monitor`, `nombre_monitor`, `apellidos_monitor`, `email_monitor`, `direccion_monitor`, `telefono_monitor`, `actividad_monitor`, `foto_monitor`) VALUES
(1, '12345678p', 'Norberto', 'López', 'ndelarosa@gmail.com', 'C/ junco', '987654321', 'surfing', 'carnet1.jpg'),
(2, '12345678o', 'Juan Diego', 'Perez', 'jdperez@gmail.com', 'C/ Luna', '987654321', 'longboard', 'carnet2.jpg'),
(3, '12345678i', 'Juanjo', 'Fernandez', 'jfernandez@gmail.com', 'C/ Niebla', '987654321', 'surfing', 'carnet4.jpg'),
(4, '12345678u', 'Alberto', 'Fernandez', 'alberto_f@gmail.com', 'C/ Solana', '987654321', 'longboard', 'carnet5.jpg'),
(5, '12345678y', 'Carlos', 'Estevez', 'estevez_carlos@hotmail.com', 'C/Salado', '987654321', 'bodyboard', 'carnet7.jpg'),
(6, '12345678t', 'Ana', 'Perez', 'anapr@gmail.com', 'C/ mar salada', '987654321', 'entrenamiento personal', 'foto9.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playas`
--

CREATE TABLE `playas` (
  `id_playa` mediumint(9) NOT NULL,
  `nombre_playa` varchar(50) NOT NULL,
  `tipo_playa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `playas`
--

INSERT INTO `playas` (`id_playa`, `nombre_playa`, `tipo_playa`) VALUES
(1, 'snnaper rocks', 'arena'),
(2, 'pipeline', 'arrecife'),
(3, 'el palmar', 'arena'),
(4, 'peniche beach', 'arena/roca'),
(5, 'Gimnasio', 'Entrenamiento personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `tipo` enum('admin','gestor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `tipo`) VALUES
(1, 'administrador', 'adk6oNRwypFwA', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD PRIMARY KEY (`id_alquiler`),
  ADD KEY `clientesAlquilan` (`id_cliente`),
  ADD KEY `materialesSeAlquilan` (`id_material`);

--
-- Indices de la tabla `clientecursos`
--
ALTER TABLE `clientecursos`
  ADD PRIMARY KEY (`id_curso`,`id_cliente`),
  ADD KEY `cursosClientes2` (`id_cliente`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `monitoresTienenContrato` (`id_monitor`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `cursosUsanPistas` (`id_playa`),
  ADD KEY `monitoresDanCursos` (`id_monitor`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `monitores`
--
ALTER TABLE `monitores`
  ADD PRIMARY KEY (`id_monitor`);

--
-- Indices de la tabla `playas`
--
ALTER TABLE `playas`
  ADD PRIMARY KEY (`id_playa`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `id_alquiler` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_material` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `monitores`
--
ALTER TABLE `monitores`
  MODIFY `id_monitor` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `playas`
--
ALTER TABLE `playas`
  MODIFY `id_playa` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD CONSTRAINT `clientesAlquilan` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materialesSeAlquilan` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clientecursos`
--
ALTER TABLE `clientecursos`
  ADD CONSTRAINT `cursosClientes1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursosClientes2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `monitoresTienenContrato` FOREIGN KEY (`id_monitor`) REFERENCES `monitores` (`id_monitor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursosUsanPistas` FOREIGN KEY (`id_playa`) REFERENCES `playas` (`id_playa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoresDanCursos` FOREIGN KEY (`id_monitor`) REFERENCES `monitores` (`id_monitor`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
