-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2016 a las 13:01:58
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
(1, 6, 1, 127, 200.00, '2011-03-20', '2011-05-20'),
(2, 7, 6, 50, 100.00, '2011-10-20', '2011-12-20'),
(3, 9, 2, 10, 50.00, '2011-10-20', '2011-11-20'),
(4, 6, 6, 127, 500.00, '2010-10-20', '2014-02-20'),
(5, 10, 5, 20, 40.00, '2011-06-05', '2011-09-10');

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
(1, 10),
(1, 11),
(2, 12),
(3, 13),
(4, 9);

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
(9, '87654321b', 'Rafael', 'Fernandez Asencio'),
(10, '53354486a', 'juan diego', 'perez'),
(11, '53354466a', 'Alberto', 'LÃ³pez'),
(12, '59685967u', 'Jose', 'Pruebas'),
(13, '12345678j', 'Rafael', 'Fernandez');

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
(5, 6, 100, 2000.00, '2010-02-10', '2011-02-10'),
(7, 5, 500, 300.00, '2011-01-01', '2014-01-01'),
(8, 3, 200, 600.00, '2012-09-08', '2015-09-08');

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
(1, 1, 1, 'surf_principiante', 'surfing', 255, '2011-12-20', '2012-12-20', 300.00),
(2, 2, 3, 'surf_intermedio', 'surfing', 100, '2011-08-10', '2012-08-10', 100.00),
(3, 3, 4, 'surf_avanzado', 'surfing', 100, '2011-06-20', '2011-09-20', 50.00),
(4, 4, 2, 'longboard_principiante', 'longboard', 255, '2011-09-15', '2011-06-16', 500.00),
(5, 5, 5, 'longboard_avanzado', 'longboard', 200, '2012-12-25', '2013-10-30', 987.00),
(6, 6, 1, 'surf_competicion', 'surfing', 255, '2001-10-12', '2013-10-12', 600.00),
(7, 6, 1, 'bodyboard_intermedio', 'bodyboard', 30, '2011-10-12', '2011-11-12', 50.00),
(8, 1, 1, 'bodyboard_avanzado', 'bodyboard', 255, '2011-10-12', '2013-10-12', 600.00),
(9, 1, 1, 'entrenamiento_personal', 'preparacionfisica', 120, '2010-08-10', '2010-09-10', 100.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event`
--

CREATE TABLE `event` (
  `id` int(4) NOT NULL,
  `body` text NOT NULL,
  `timestamp` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `event`
--

INSERT INTO `event` (`id`, `body`, `timestamp`) VALUES
(15, 'Clases', '1301522400'),
(21, 'hola', '1301094000'),
(22, 'kulunguele', '1301180400');

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
(1, 'performance', 'surfboard', 'soulsurfboar'),
(2, 'cabianca', 'surfboard', 'pukas'),
(3, 'ultraH', 'longboard', 'dhd'),
(4, 'assault', 'bodyboard', 'VZ'),
(5, 'ned kelly', 'longboard', 'all merick'),
(6, 'Mindise', 'bodyboard', 'Rs'),
(7, 'prueba', 'prueba', 'prueba'),
(8, 'prueba1', 'prueba1', 'prueba1'),
(9, 'prueba2', 'prueba2', 'prueba2'),
(10, 'prueba3', 'prueba3', 'prueba3'),
(11, 'tabla', 'prueba', 'yasuniboard'),
(12, 'sup', 'padelboard', 'revenge');

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
(1, '12345678p', 'Alana', 'Blanchard', 'alanablan@gmail.com', 'C/ Sola', '987654321', 'Surfing', '1455786509-carnet1.jpg'),
(2, '12345678o', 'Julian ', 'Wilson', 'julianw@gmail.com', 'C/ snapper', '987654321', 'Surf Competicion', 'carnet2.jpg'),
(3, '12345678i', 'Benito', 'Stewar', 'Benskii@gmail.com', 'C/ Niebla', '987654321', 'Longboard', '1455045496-1455045477-carnet4.jpg'),
(4, '12345678u', 'Guillermo', 'Cobo', 'guicbo@gmail.com', 'C/ Solana', '987654321', 'Bodyboard', 'carnet5.jpg'),
(5, '12345678y', 'Taylor', 'Knox', 'Knox_tay@hotmail.com', 'C/playaeo\r\n', '987654321', 'Surfing', 'carnet7.jpg'),
(6, '12345678t', 'Patricia', 'Vazquez', 'patro_vaq@gmail.com', 'C/ ingreso', '987654321', 'Entrenador P', 'foto9.jpg'),
(8, '53354483a', 'norberto', 'lopez de la rosa', 'delarosa@gmail.com', 'calle pruebas', '658968954', 'surfing', '1964898_630646093675539_1633451151_n.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playas`
--

CREATE TABLE `playas` (
  `id_playa` mediumint(9) NOT NULL,
  `nombre_playa` varchar(50) NOT NULL,
  `longitud_playa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `playas`
--

INSERT INTO `playas` (`id_playa`, `nombre_playa`, `longitud_playa`) VALUES
(1, 'snnaper rocks', '200'),
(2, 'pipeline', '100'),
(3, 'Los caños', '500'),
(4, 'Peniche Beach', '100'),
(5, 'Gimnasio', '50000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(1) NOT NULL,
  `dayColor` varchar(6) NOT NULL,
  `weekendColor` varchar(6) NOT NULL,
  `todayColor` varchar(6) NOT NULL,
  `eventColor` varchar(6) NOT NULL,
  `iteratorColor1` varchar(6) NOT NULL,
  `iteratorColor2` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `dayColor`, `weekendColor`, `todayColor`, `eventColor`, `iteratorColor1`, `iteratorColor2`) VALUES
(1, 'e6e1d3', 'a0a395', 'ffeb45', 'fa0032', 'e6ffab', 'ffffff');

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
(1, 'administrador', 'adk6oNRwypFwA', 'admin'),
(2, 'pepa', 'peCZ6hLRd2cMY', 'gestor'),
(3, 'norberto', 'noSqdRUGZ9.Xk', 'gestor'),
(4, 'norberto1', 'noh2QycLBRdT2', 'gestor'),
(5, 'anacleta', 'ansmUzUNIMOL2', 'gestor'),
(6, 'pruebaso', 'prydxcVtuiceQ', 'gestor');

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
-- Indices de la tabla `event`
--
ALTER TABLE `event`
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
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_alquiler` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `event`
--
ALTER TABLE `event`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_material` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `monitores`
--
ALTER TABLE `monitores`
  MODIFY `id_monitor` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `playas`
--
ALTER TABLE `playas`
  MODIFY `id_playa` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
