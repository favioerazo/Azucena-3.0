-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2018 a las 01:01:01
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
('1006000002', 'VICTOR HUGO GUERRERO', '0101197700548', 'victor.guerrero@gmail.com', 'M', 'barrio ingles avenida caba?as atras de la iglesia catolica san vicente de paul atras de la pulperia las tres hermanas casa color verde porton negro', '2018-07-19 23:08:40', '2018-07-19 23:10:31', 1),
('1006000003', 'FAVIO JAVIER ERAZO PINEDA', '0101199702810', 'FAVIOERAZO@HOTMAIL.COM', 'M', 'BARRIO INGLES AVENIDA CABAÃ±AS ATRAS DE LA IGLESIA CATOLICA SAN VICENTE DE PAUL ATRAS DE LA PULPERIA LAS TRES HERMANAS CASA COLOR VERDE PORTON NEGRO.', '2018-07-20 12:33:41', '0000-00-00 00:00:00', 1);

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
('2395000001', '1006000003', '0101199702810', 'I', 'FERAZO', NULL, '2018-07-20 12:48:25', '2018-07-20 12:48:25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_reg_vechiculo_objetos_adic`
--

CREATE TABLE `dat_reg_vechiculo_objetos_adic` (
  `c_objeto` int(11) NOT NULL,
  `d_objeto` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `b_registro_activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `dat_reg_vechiculo_objetos_adic`
--

INSERT INTO `dat_reg_vechiculo_objetos_adic` (`c_objeto`, `d_objeto`, `b_registro_activo`) VALUES
(66990000, 'Alfombras', 1),
(66990001, ' Antena', 1),
(66990002, ' Radio', 1),
(66990003, ' Tapa Combustible', 1),
(66990004, ' Boleta revision', 1),
(66990005, ' Copas', 1),
(66990006, ' Encendedor', 1),
(66990007, ' Espejo Exterior', 1),
(66990008, ' Espejo Interior', 1),
(66990009, ' Llave Rueda', 1),
(66990010, ' Gata', 1),
(66990011, ' Herramientas', 1),
(66990012, ' Llanta repuesto', 1),
(66990013, ' Cenicero', 1),
(66990014, ' Triangulos', 1),
(66990015, ' Extintor', 1);

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
('5807000001', '2395000001', 'TOYOTA', 'Corolla', '2.0', 'CAMIONETA', 'TCD2x5', '2017', 'FFCA38', '155000', '25%', '2018-07-20 12:48:25', 0);

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
('01', '1006000003', 'SECUENCIA DE CLIENTES', 1),
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
(23010000, 'FERAZO', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:22:11'),
(23010001, 'ROOT', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:22:31'),
(23010002, 'ROOT', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:22:51'),
(23010003, 'ROOT', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:23:27'),
(55080000, 'ROOT', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 22:40:28'),
(55080001, 'FERAZO', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:17:36'),
(55080002, 'FERAZO', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:17:37'),
(55080003, 'FERAZO', 'FALLO INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:17:47'),
(55080004, 'FERAZO', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:03'),
(55080005, 'FERAZO', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:10'),
(55080006, 'ROOT', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:13'),
(55080007, 'ROOT', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:47'),
(55080008, 'JREYES', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:18:50'),
(55080009, 'JREYES', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '172.20.10.238', '2018-07-19 23:41:10'),
(55080010, 'FERAZO', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 08:33:40'),
(55080011, 'FERAZO', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 08:33:48'),
(55080012, 'ROOT', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 08:33:52'),
(55080013, 'JREYES', 'INGRESO', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1', '192.168.2.214', '2018-07-20 09:19:14'),
(55080014, '', 'SALIDA', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1', '192.168.2.214', '2018-07-20 09:33:56'),
(55080015, 'FERAZO', 'INGRESO', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1', '192.168.2.214', '2018-07-20 09:34:08'),
(55080016, 'FERAZO', 'SALIDA', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1', '192.168.2.214', '2018-07-20 09:34:21'),
(55080017, 'ROOT', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 09:35:32'),
(55080018, 'FERAZO', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 09:35:35'),
(55080019, 'FERAZO', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 09:37:56'),
(55080020, 'JREYES', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 09:38:00'),
(55080021, '', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 09:54:05'),
(55080022, 'FERAZO', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 09:54:08'),
(55080023, 'FERAZO', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 09:54:27'),
(55080024, 'JREYES', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 09:54:31'),
(55080025, 'JREYES', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 09:54:51'),
(55080026, 'JREYES', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 10:35:44'),
(55080027, 'FERAZO', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 10:41:37'),
(55080028, 'FERAZO', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 10:41:42'),
(55080029, 'JREYES', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 10:41:45'),
(55080030, 'JREYES', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 10:43:10'),
(55080031, '', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 10:43:22'),
(55080032, 'ROOT', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 10:43:25'),
(55080037, 'ROOT', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 12:29:55'),
(55080038, 'JREYES', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 12:30:04'),
(55080039, 'JREYES', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 12:30:15'),
(55080040, 'ROOT', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 12:30:17'),
(55080041, 'ROOT', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 12:32:25'),
(55080042, 'FERAZO', 'INGRESO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 12:32:27'),
(0, 'FERAZO', 'SALIDA', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', '192.168.2.200', '2018-07-20 15:23:41');

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
('01', 'USUARIOS', '"#"', '2018-04-01 00:00:00', 1),
('0101', 'INGRESAR', '"GUI.usuarios.ingreso.php"', '2018-04-02 00:00:00', 1),
('0102', 'OPCIONES', '"GUI.usuarios.opciones.usuarios.php"', '2018-04-02 00:00:00', 1),
('0103', 'REGISTRO DE ENTRADAS', '"../core/core.reporte_usuarios.php" target="_blank" onclick="window.open(this.href, this.target, ''width=800,height=800''); return false;"', '2018-04-02 00:00:00', 1),
('02', 'CLIENTES', '"#"', '2018-04-02 00:00:00', 1),
('0201', 'INGRESAR', '"GUI.clientes.ingreso.php"', '2018-04-02 00:00:00', 1),
('0202', 'MODIFICAR', '"GUI.clientes.listado.php"', '2018-04-02 00:00:00', 1),
('03', 'ORDENES', '"#"', '2018-04-02 00:00:00', 1),
('0301', 'INGRESAR', '"GUI.registro.ingreso.php"', '2018-04-02 00:00:00', 1),
('0302', 'MODIFICAR', '"GUI.registro.modificar.php"', '2018-07-16 00:00:00', 1),
('0303', 'ACTUALIZAR', '"#"', '2018-07-16 00:00:00', 1),
('0304', 'PENDIENTES', '"#"', '2018-04-02 00:00:00', 1),
('04', 'MATERIALES', '"#"', '2018-04-02 00:00:00', 1),
('0401', 'INGRESAR', '"#"', '2018-04-02 00:00:00', 1),
('0402', 'MODIFICAR', '"#"', '2018-04-02 00:00:00', 1),
('0403', 'INVENTARIO', '"#"', '2018-07-16 00:00:00', 1),
('05', 'FACTURACION', '"#"', '2018-07-16 00:00:00', 1),
('0501', 'CREAR', '"#"', '2018-07-16 00:00:00', 1),
('0502', 'CONSULTAR', '"#"', '2018-07-16 00:00:00', 1);

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
('JREYES', 'JREYES', '0000-00-00 00:00:00', 1),
('FERAZO', '01', '0000-00-00 00:00:00', 1),
('FERAZO', '0102', '0000-00-00 00:00:00', 1),
('FERAZO', '0103', '0000-00-00 00:00:00', 1),
('FERAZO', '02', '0000-00-00 00:00:00', 1),
('FERAZO', '0201', '0000-00-00 00:00:00', 1),
('FERAZO', '0202', '0000-00-00 00:00:00', 1),
('FERAZO', '03', '0000-00-00 00:00:00', 1),
('FERAZO', '0301', '0000-00-00 00:00:00', 1),
('FERAZO', '0302', '0000-00-00 00:00:00', 1),
('FERAZO', '0303', '0000-00-00 00:00:00', 1),
('FERAZO', '0304', '0000-00-00 00:00:00', 1),
('FERAZO', '04', '0000-00-00 00:00:00', 1),
('FERAZO', '05', '0000-00-00 00:00:00', 1),
('FERAZO', 'FERAZO', '0000-00-00 00:00:00', 1);

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
-- Indices de la tabla `dat_reg_vechiculo_objetos_adic`
--
ALTER TABLE `dat_reg_vechiculo_objetos_adic`
  ADD PRIMARY KEY (`c_objeto`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
