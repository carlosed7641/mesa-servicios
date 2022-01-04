-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2022 a las 19:45:58
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Mantenimiento inmuebles'),
(2, 'Mantenimiento muebles'),
(3, 'Servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientos`
--

CREATE TABLE `requerimientos` (
  `codigo` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `descripcion` varchar(650) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `detalle` varchar(650) DEFAULT NULL,
  `fecha_creacion` varchar(65) DEFAULT NULL,
  `fecha_atencion` varchar(65) DEFAULT NULL,
  `fecha_fin` varchar(65) DEFAULT NULL,
  `id_usuario_solicitante` int(11) DEFAULT NULL,
  `id_usuario_soporte` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_tipo_servicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `requerimientos`
--

INSERT INTO `requerimientos` (`codigo`, `estado`, `descripcion`, `ubicacion`, `detalle`, `fecha_creacion`, `fecha_atencion`, `fecha_fin`, `id_usuario_solicitante`, `id_usuario_soporte`, `id_categoria`, `id_tipo_servicio`) VALUES
(7, 'Cancelado', 'Se dañó el baño en mi oficina.', 'Oficina', 'Requerimiento cancelado', '31-12-2021 04:18:53 pm', 'Cancelado', 'Cancelado', 20, 1, 1, 1),
(8, 'Atendido', 'Se dañó el archivador de mi oficina.', 'Oficina', 'El requerimiento fue atendido satisfactoriamente', '31-12-2021 04:22:43 pm', '31-12-2021 04:23:28 pm', '31-12-2021 04:23:51 pm', 2, 1, 2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `id_tipo_servicio` int(11) NOT NULL,
  `servicio` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`id_tipo_servicio`, `servicio`, `id_categoria`) VALUES
(1, 'Baños', 1),
(2, 'Cielo Raso', 1),
(3, 'Eléctrico', 1),
(4, 'Pared', 1),
(5, 'Puerta', 1),
(6, 'Aire condicionado', 2),
(7, 'Archivador', 2),
(8, 'Puesto de trabajo', 2),
(9, 'Silla', 2),
(10, 'Aseo', 3),
(11, 'Transporte', 3),
(12, 'Vigilancia', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo`) VALUES
(1, 'Técnico'),
(2, 'Solicitante'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_completo` varchar(55) DEFAULT NULL,
  `direccion` varchar(65) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) NOT NULL,
  `password` varchar(65) NOT NULL,
  `id_tipo_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_completo`, `direccion`, `telefono`, `usuario`, `password`, `id_tipo_usuario`) VALUES
(1, 'Carlos Ilias', 'Cr18 D 80 A-24', '3145568956', 'cilias', '12345', 1),
(2, 'Carlos Castro', 'Calle 19#28A17', '3015569476', 'ccastro46', '12345', 2),
(3, 'Andrés Vega', 'Calle 110 #43-331', '3047686905', 'avega15', '12345', 2),
(5, 'Wilson Castro', 'Calle 19#28A18', '3008778568', 'wcastro11', '12345', 3),
(11, 'Juan Pérez', 'Calle 23#11-C', '3008679528', 'jperez5', '12345', 1),
(19, 'Rubén Castro', 'Calle 33#27B-15', '3038760911', 'rcastro5', '12345', 3),
(20, 'Luisa Ruíz', 'Calle 113 #22-33', '3145567420', 'lruiz9', '12345', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `requerimientos`
--
ALTER TABLE `requerimientos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `id_usuario_solicitante_idx` (`id_usuario_solicitante`),
  ADD KEY `id_usuario_soporte_idx` (`id_usuario_soporte`),
  ADD KEY `id_categoria_idx` (`id_categoria`),
  ADD KEY `id_tipo_servicio_idx` (`id_tipo_servicio`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id_tipo_servicio`),
  ADD KEY `Id_categoria_idx` (`id_categoria`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_tipo_usuario_idx` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `requerimientos`
--
ALTER TABLE `requerimientos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `requerimientos`
--
ALTER TABLE `requerimientos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_servicio` FOREIGN KEY (`id_tipo_servicio`) REFERENCES `tipo_servicio` (`id_tipo_servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_solicitante` FOREIGN KEY (`id_usuario_solicitante`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_soporte` FOREIGN KEY (`id_usuario_soporte`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `id_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
