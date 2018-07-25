-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2018 a las 07:43:05
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `azucena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_cli_clientes`
--

CREATE TABLE `dat_cli_clientes` (
  `c_cliente` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `d_nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `d_identidad` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `d_correo` varchar(145) COLLATE latin1_spanish_ci NOT NULL,
  `d_genero` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `d_direccion` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `f_ingreso` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `f_modificacion` datetime NOT NULL,
  `b_activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `dat_cli_clientes`
--

INSERT INTO `dat_cli_clientes` (`c_cliente`, `d_nombre`, `d_identidad`, `d_correo`, `d_genero`, `d_direccion`, `f_ingreso`, `f_modificacion`, `b_activo`) VALUES
('1006000002', 'VICTOR HUGO GUERRERO', '0101197700548', 'victor.guerrero@gmail.com', 'M', 'barrio ingles avenida caba?as atras de la iglesia catolica san vicente de paul atras de la pulperia las tres hermanas casa color verde porton negro', '2018-07-19 23:08:40', '2018-07-19 23:10:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_cli_telefono`
--

CREATE TABLE `dat_cli_telefono` (
  `c_registro` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `d_identidad` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `d_telefono` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `dat_cli_telefono`
--

INSERT INTO `dat_cli_telefono` (`c_registro`, `d_identidad`, `d_telefono`) VALUES
('', '0101197700548', '9445-3053');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_reg_registro_ordenes`
--

CREATE TABLE `dat_reg_registro_ordenes` (
  `c_registro` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `c_cliente` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `d_identidad` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `c_estatus_solicitud` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `c_usuario_ingreso` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `c_usuario_modifico` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `f_fecha_ingreso` datetime NOT NULL,
  `f_fecha_modifico` datetime DEFAULT NULL,
  `b_registro_activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `dat_reg_registro_ordenes`
--

INSERT INTO `dat_reg_registro_ordenes` (`c_registro`, `c_cliente`, `d_identidad`, `c_estatus_solicitud`, `c_usuario_ingreso`, `c_usuario_modifico`, `f_fecha_ingreso`, `f_fecha_modifico`, `b_registro_activo`) VALUES
('2395000001', '1006000002', '0101197700548', 'I', 'JREYES', NULL, '2018-07-19 23:39:14', '2018-07-19 23:39:14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_reg_vehiculo`
--

CREATE TABLE `dat_reg_vehiculo` (
  `c_vehiculo` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `c_registro` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `d_marca` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `d_modelo` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `d_motor` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `d_tipo_vehiculo` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `d_numero_placa` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `d_anio` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `c_color` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `d_kilometraje` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `d_combustible` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `f_fecha_ingreso` datetime DEFAULT NULL,
  `b_registro_activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `dat_reg_vehiculo`
--

INSERT INTO `dat_reg_vehiculo` (`c_vehiculo`, `c_registro`, `d_marca`, `d_modelo`, `d_motor`, `d_tipo_vehiculo`, `d_numero_placa`, `d_anio`, `c_color`, `d_kilometraje`, `d_combustible`, `f_fecha_ingreso`, `b_registro_activo`) VALUES
('5807000001', '2395000001', 'FORD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-19 23:39:14', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sist_correlativos`
--

CREATE TABLE `sist_correlativos` (
  `c_registro` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `c_correlativo` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `d_correlativo` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `b_activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sist_correlativos`
--

INSERT INTO `sist_correlativos` (`c_registro`, `c_correlativo`, `d_correlativo`, `b_activo`) VALUES
('01', '1006000002', 'SECUENCIA DE CLIENTES', 1),
('02', '2395000001', 'SECUENCIA DE ORDENES', 1),
('03', '5807000001', 'SECUENCIA DE AUTOMOVILES', 1),
('04', '3025000000', 'SECUENCIA DE MATERIALES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sist_log_login`
--

CREATE TABLE `sist_log_login` (
  `c_registro` int(11) NOT NULL DEFAULT '0',
  `c_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `d_accion` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `d_dispositivo_navegador` varchar(180) COLLATE latin1_spanish_ci NOT NULL,
  `d_direccion` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `f_ingreso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sist_log_login`
--

INSERT INTO `sist_log_login` (`c_registro`, `c_usuario`, `d_accion`, `d_dispositivo_navegador`, `d_direccion`, `f_ingreso`) VALUES
(0, 'ROOT', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:40:28'),
(23010000, 'FERAZO', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:22:11'),
(23010001, 'ROOT', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:22:31'),
(23010002, 'ROOT', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:22:51'),
(23010003, 'ROOT', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:23:27'),
(0, 'FERAZO', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:17:36'),
(0, 'FERAZO', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:17:37'),
(0, 'FERAZO', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:17:47'),
(0, 'FERAZO', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:03'),
(0, 'FERAZO', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:10'),
(0, 'ROOT', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:13'),
(0, 'ROOT', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:47'),
(0, 'JREYES', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:50'),
(0, 'JREYES', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:41:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sist_usuarios`
--

CREATE TABLE `sist_usuarios` (
  `c_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `d_usuario` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `d_correo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `d_pass` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `b_activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sist_usuarios`
--

INSERT INTO `sist_usuarios` (`c_usuario`, `d_usuario`, `d_correo`, `d_pass`, `b_activo`) VALUES
('FERAZO', 'FAVIO JAVIER ERAZO PINEDA', 'erazo.favio@gmail.com', '123', 1),
('JREYES', 'JOSE ALBERTO REYES TORRES', 'JREYES@SAMAPP.COM', '123', 1),
('ROOT', 'ADMINISTRADOR', 'favioerazo@hotmail.com', '123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_modulo_opciones`
--

CREATE TABLE `web_modulo_opciones` (
  `c_opcion` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `d_opcion` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `d_direccion` varchar(160) COLLATE latin1_spanish_ci NOT NULL,
  `f_ingreso` datetime NOT NULL,
  `b_activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `web_modulo_opciones`
--

INSERT INTO `web_modulo_opciones` (`c_opcion`, `d_opcion`, `d_direccion`, `f_ingreso`, `b_activo`) VALUES
('01', 'USUARIOS', '\"#\"', '2018-04-01 00:00:00', 1),
('0101', 'INGRESAR', '\"GUI.usuarios.ingreso.php\"', '2018-04-02 00:00:00', 1),
('0102', 'OPCIONES', '\"GUI.usuarios.opciones.usuarios.php\"', '2018-04-02 00:00:00', 1),
('0103', 'REGISTRO DE ENTRADAS', '\"../core/core.reporte_usuarios.php\" target=\"_blank\" onclick=\"window.open(this.href, this.target, \'width=800,height=800\'); return false;\"', '2018-04-02 00:00:00', 1),
('02', 'CLIENTES', '\"#\"', '2018-04-02 00:00:00', 1),
('0201', 'INGRESAR', '\"GUI.clientes.ingreso.php\"', '2018-04-02 00:00:00', 1),
('0202', 'MODIFICAR', '\"GUI.clientes.listado.php\"', '2018-04-02 00:00:00', 1),
('03', 'ORDENES', '\"#\"', '2018-04-02 00:00:00', 1),
('0301', 'INGRESAR', '\"GUI.registro.ingreso.php\"', '2018-04-02 00:00:00', 1),
('0302', 'MODIFICAR', '\"GUI.registro.modificar.php\"', '2018-07-16 00:00:00', 1),
('0303', 'ACTUALIZAR', '\"#\"', '2018-07-16 00:00:00', 1),
('0304', 'PENDIENTES', '\"#\"', '2018-04-02 00:00:00', 1),
('04', 'MATERIALES', '\"#\"', '2018-04-02 00:00:00', 1),
('0401', 'INGRESAR', '\"#\"', '2018-04-02 00:00:00', 1),
('0402', 'MODIFICAR', '\"#\"', '2018-04-02 00:00:00', 1),
('0403', 'INVENTARIO', '\"#\"', '2018-07-16 00:00:00', 1),
('05', 'FACTURACION', '\"#\"', '2018-07-16 00:00:00', 1),
('0501', 'CREAR', '\"#\"', '2018-07-16 00:00:00', 1),
('0502', 'CONSULTAR', '\"#\"', '2018-07-16 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_opciones_x_usuario_modulo`
--

CREATE TABLE `web_opciones_x_usuario_modulo` (
  `c_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `c_opcion` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `f_ingreso` datetime NOT NULL,
  `b_activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `web_opciones_x_usuario_modulo`
--

INSERT INTO `web_opciones_x_usuario_modulo` (`c_usuario`, `c_opcion`, `f_ingreso`, `b_activo`) VALUES
('', '', '0000-00-00 00:00:00', 102),
('FERAZO', '01', '0000-00-00 00:00:00', 1),
('FERAZO', '02', '0000-00-00 00:00:00', 1),
('FERAZO', '0201', '0000-00-00 00:00:00', 1),
('FERAZO', '0202', '0000-00-00 00:00:00', 1),
('FERAZO', '03', '0000-00-00 00:00:00', 1),
('FERAZO', '04', '0000-00-00 00:00:00', 1),
('FERAZO', '05', '0000-00-00 00:00:00', 1),
('FERAZO', 'FERAZO', '0000-00-00 00:00:00', 1),
('ROOT', '01', '0000-00-00 00:00:00', 1),
('ROOT', '0101', '0000-00-00 00:00:00', 1),
('ROOT', '0102', '0000-00-00 00:00:00', 1),
('ROOT', '0103', '0000-00-00 00:00:00', 1),
('ROOT', '02', '0000-00-00 00:00:00', 1),
('ROOT', '0201', '0000-00-00 00:00:00', 1),
('ROOT', '0202', '0000-00-00 00:00:00', 1),
('ROOT', '03', '0000-00-00 00:00:00', 1),
('ROOT', '0301', '0000-00-00 00:00:00', 1),
('ROOT', '0302', '0000-00-00 00:00:00', 1),
('ROOT', '0303', '0000-00-00 00:00:00', 1),
('ROOT', '0304', '0000-00-00 00:00:00', 1),
('ROOT', '04', '0000-00-00 00:00:00', 1),
('ROOT', '0401', '0000-00-00 00:00:00', 1),
('ROOT', '0402', '0000-00-00 00:00:00', 1),
('ROOT', '0403', '0000-00-00 00:00:00', 1),
('ROOT', '05', '0000-00-00 00:00:00', 1),
('ROOT', '0501', '0000-00-00 00:00:00', 1),
('ROOT', '0502', '0000-00-00 00:00:00', 1),
('ROOT', 'ROOT', '0000-00-00 00:00:00', 1),
('JREYES', '01', '0000-00-00 00:00:00', 1),
('JREYES', '02', '0000-00-00 00:00:00', 1),
('JREYES', '03', '0000-00-00 00:00:00', 1),
('JREYES', '0301', '0000-00-00 00:00:00', 1),
('JREYES', '0302', '0000-00-00 00:00:00', 1),
('JREYES', '04', '0000-00-00 00:00:00', 1),
('JREYES', '05', '0000-00-00 00:00:00', 1),
('JREYES', 'JREYES', '0000-00-00 00:00:00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dat_cli_clientes`
--
ALTER TABLE `dat_cli_clientes`
  ADD PRIMARY KEY (`c_cliente`),
  ADD UNIQUE KEY `c_cliente_UNIQUE` (`c_cliente`);

--
-- Indices de la tabla `dat_cli_telefono`
--
ALTER TABLE `dat_cli_telefono`
  ADD PRIMARY KEY (`c_registro`);

--
-- Indices de la tabla `dat_reg_registro_ordenes`
--
ALTER TABLE `dat_reg_registro_ordenes`
  ADD PRIMARY KEY (`c_registro`),
  ADD UNIQUE KEY `c_registro_UNIQUE` (`c_registro`);

--
-- Indices de la tabla `dat_reg_vehiculo`
--
ALTER TABLE `dat_reg_vehiculo`
  ADD PRIMARY KEY (`c_vehiculo`),
  ADD UNIQUE KEY `c_vehiculo_UNIQUE` (`c_vehiculo`);

--
-- Indices de la tabla `sist_correlativos`
--
ALTER TABLE `sist_correlativos`
  ADD PRIMARY KEY (`c_registro`);

--
-- Indices de la tabla `sist_usuarios`
--
ALTER TABLE `sist_usuarios`
  ADD PRIMARY KEY (`c_usuario`);

--
-- Indices de la tabla `web_modulo_opciones`
--
ALTER TABLE `web_modulo_opciones`
  ADD PRIMARY KEY (`c_opcion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
