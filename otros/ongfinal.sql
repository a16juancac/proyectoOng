-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2018 at 12:19 PM
-- Server version: 10.0.34-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `articulo`
--
CREATE DATABASE IF NOT EXISTS `articulo` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `articulo`;

-- --------------------------------------------------------

--
-- Table structure for table `referencias`
--

CREATE TABLE `referencias` (
  `id` int(11) NOT NULL,
  `referencia` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `referencias`
--

INSERT INTO `referencias` (`id`, `referencia`, `descripcion`, `precio`) VALUES
(2, 'asc234', 'Goma', 2.5),
(4, 'CDW', 'Mochila', 20),
(12, 'nb', 'nb', 6),
(20, 'weer', 'pinzas', 5),
(22, 'asc23', 'Goma', 2.5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `referencias`
--
ALTER TABLE `referencias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `referencias`
--
ALTER TABLE `referencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;--
-- Database: `ong`
--
CREATE DATABASE IF NOT EXISTS `ong` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ong`;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Informática'),
(3, 'Libros'),
(4, 'Música'),
(2, 'Ropa');

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id`, `nombre`) VALUES
(2, 'Aceptado'),
(1, 'Propuesto'),
(4, 'Retirado'),
(3, 'Sin existencias');

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `ruta_imagen` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `descripcion`, `ruta_imagen`) VALUES
(1, 'Concierto', 'Concierto de rock', 'img/evento/concierto.jpg'),
(2, 'Teatro', 'Taller de teatro', 'img/evento/teatro.jpg'),
(3, 'Carrera', 'Carrera solidaria', 'img/evento/carrera.jpg'),
(4, 'Senderismo', 'Senderismo en Ribera Sacra', 'img/evento/senderismo.jpg'),
(11, 'Cine', 'Cine para todos', 'img/evento/cine.jpg'),
(16, 'Meditación', 'Conferencia sobre meditación', 'img/evento/conferencia.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `evento_lugar`
--

CREATE TABLE `evento_lugar` (
  `id_evento_lugar` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_lugar` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `aforo` int(11) NOT NULL,
  `precio_entrada` float NOT NULL,
  `entradas_disponibles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evento_lugar`
--

INSERT INTO `evento_lugar` (`id_evento_lugar`, `id_evento`, `id_lugar`, `fecha`, `aforo`, `precio_entrada`, `entradas_disponibles`) VALUES
(1, 1, 4, '2018-07-25', 6, 6, 1),
(2, 2, 3, '2018-10-31', 35, 3, 34),
(3, 3, 4, '2018-05-28', 50, 69, 50),
(4, 3, 3, '2018-08-31', 2, 48, 1),
(5, 4, 1, '2018-07-27', 30, 3, 30),
(9, 2, 4, '2018-05-17', 5, 5, 5),
(11, 2, 3, '2018-05-30', 53, 3, 5),
(12, 1, 4, '2018-05-17', 6, 69, 6),
(14, 11, 3, NULL, 30, 5, 30),
(16, 16, 2, NULL, 50, 20, 50);

-- --------------------------------------------------------

--
-- Table structure for table `evento_participante`
--

CREATE TABLE `evento_participante` (
  `id_evento` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evento_participante`
--

INSERT INTO `evento_participante` (`id_evento`, `id_participante`) VALUES
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(12, 9),
(12, 11),
(14, 9),
(16, 2),
(16, 6),
(16, 8),
(16, 15);

-- --------------------------------------------------------

--
-- Table structure for table `fechas_posibles`
--

CREATE TABLE `fechas_posibles` (
  `id_evento` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fechas_posibles`
--

INSERT INTO `fechas_posibles` (`id_evento`, `fecha`) VALUES
(1, '2018-01-31'),
(1, '2018-05-10'),
(1, '2018-05-14'),
(1, '2018-05-16'),
(1, '2018-05-17'),
(1, '2018-05-18'),
(1, '2018-05-22'),
(1, '2018-05-23'),
(1, '2018-05-31'),
(1, '2018-07-19'),
(1, '2018-07-27'),
(1, '2018-08-03'),
(1, '2018-08-04'),
(1, '2018-09-27'),
(1, '2018-12-31'),
(1, '2019-01-01'),
(1, '2019-01-30'),
(1, '2019-01-31'),
(1, '2019-02-22'),
(2, '2018-05-14'),
(2, '2018-05-17'),
(2, '2018-05-28'),
(2, '2018-05-31'),
(2, '2018-06-29'),
(2, '2018-08-02'),
(2, '2018-08-03'),
(2, '2018-09-05'),
(3, '2018-05-17'),
(3, '2018-07-13'),
(3, '2018-08-03'),
(3, '2018-08-04'),
(3, '2018-10-13'),
(4, '2018-05-17'),
(4, '2018-05-26'),
(4, '2018-05-31'),
(4, '2018-07-27'),
(4, '2018-07-31'),
(4, '2018-12-12'),
(4, '2018-12-24'),
(5, '2018-05-17'),
(5, '2018-05-18'),
(5, '2018-05-25'),
(5, '2018-05-26'),
(5, '2018-05-30'),
(5, '2018-07-27'),
(5, '2018-11-13'),
(9, '2018-05-17'),
(9, '2018-05-18'),
(11, '2018-05-17'),
(11, '2018-05-30'),
(12, '2018-05-17'),
(12, '2018-05-30'),
(14, '2018-07-28'),
(14, '2019-02-12'),
(16, '2019-01-23'),
(16, '2019-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `CIF` varchar(9) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `domicilio_fiscal` varchar(45) CHARACTER SET latin1 NOT NULL,
  `web` varchar(60) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupo`
--

INSERT INTO `grupo` (`id`, `CIF`, `nombre`, `domicilio_fiscal`, `web`) VALUES
(1, '777777Q', 'Metallica', 'c/ Sanjurjo nº 2 , Vigo Pontevedra', 'www.metallica.com'),
(2, '34443D', 'Anima', 'C Aeropuerto', 'www.anima.es');

-- --------------------------------------------------------

--
-- Table structure for table `imagenes_prod`
--

CREATE TABLE `imagenes_prod` (
  `id` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `ruta` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imagenes_prod`
--

INSERT INTO `imagenes_prod` (`id`, `id_prod`, `ruta`) VALUES
(1, 1, 'img/bd/camisa1/camisa1a.jpg'),
(2, 2, 'img/bd/portatil1/portatil1a.jpg'),
(3, 3, 'img/bd/bestiario/bestiario1.jpg'),
(4, 4, 'img/bd/revolver/discoa.jpg'),
(7, 1, 'img/bd/camisa1/camisa1b.jpg'),
(8, 2, 'img/bd/portatil1/portatil1b.jpg'),
(11, 3, 'img/bd/bestiario/bestiario2.jpg'),
(12, 4, 'img/bd/revolver/discob.jpg'),
(13, 5, 'img/bd/pantalon1/pantalon1a.jpg'),
(14, 5, 'img/bd/pantalon1/pantalon1b.jpg'),
(18, 64, 'img/bd/black/disco1.jpg'),
(19, 64, 'img/bd/black/disco2.jpg'),
(20, 65, 'img/bd/movil1/movil1a.jpg'),
(21, 65, 'img/bd/movil1/movil1b.jpg'),
(24, 66, 'img/bd/movil2/movil2a.jpg'),
(25, 66, 'img/bd/movil2/movil2b.jpg'),
(28, 67, 'img/bd/artaud/artaud1.jpg'),
(29, 67, 'img/bd/artaud/artaud2.jpg'),
(30, 68, 'img/bd/clash/disco1.jpg'),
(31, 68, 'img/bd/clash/disco2.jpg'),
(32, 69, 'img/bd/pijama/pijama1.jpg'),
(33, 69, 'img/bd/pijama/pijama2.jpg'),
(34, 70, 'img/bd/ficciones/ficciones1.jpg'),
(35, 70, 'img/bd/ficciones/ficciones2.jpg'),
(36, 71, 'img/bd/ruido/ruido1.jpg'),
(37, 71, 'img/bd/ruido/ruido2.jpg'),
(38, 72, 'img/bd/portatil2/portatil2a.jpg'),
(39, 72, 'img/bd/portatil2/portatil2b.jpg'),
(40, 73, 'img/bd/sudadera/sudadera1a.jpg'),
(41, 73, 'img/bd/sudadera/sudadera1b.jpg'),
(44, 74, 'img/bd/strange/disco1.jpg'),
(45, 74, 'img/bd/strange/disco2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lugar`
--

CREATE TABLE `lugar` (
  `id` int(11) NOT NULL,
  `lugar` varchar(60) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lugar`
--

INSERT INTO `lugar` (`id`, `lugar`) VALUES
(4, 'Coruña'),
(3, 'Ourense'),
(2, 'Pontevedra'),
(1, 'Vigo');

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id` int(11) NOT NULL,
  `NIF` varchar(9) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `apellido1` varchar(45) NOT NULL,
  `apellido2` varchar(45) NOT NULL,
  `email` varchar(60) CHARACTER SET latin1 NOT NULL,
  `telefono` varchar(15) CHARACTER SET latin1 NOT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `localidad` varchar(45) CHARACTER SET latin1 NOT NULL,
  `provincia` varchar(45) CHARACTER SET latin1 NOT NULL,
  `grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participante`
--

INSERT INTO `participante` (`id`, `NIF`, `nombre`, `apellido1`, `apellido2`, `email`, `telefono`, `direccion`, `localidad`, `provincia`, `grupo`) VALUES
(1, '5555555F', 'Pedro', 'Pérez', 'Pérez', 'pedro@pedro.com', '44444444', 'c/ Rosalia de Castro nº 4', 'Vigo', 'Pontevedra', NULL),
(2, '7777777L', 'Miguel', 'García', 'García', 'miguel@miguel.com', '55666666', 'C/ Carballeira nº 8', 'Santiago', 'Coruña', 1),
(3, '88888G', 'Juan', 'López', 'López', 'juan@lopez.com', '7897655', 'rua carballeira nº 2', 'Santiago', 'Coruña', 1),
(4, '99999Q', 'Francisco', 'Milanes', 'Milanes', 'francisco@milanes.com', '4444444', 'av colombia 1', 'Vigo', 'Pontevedra', 1),
(5, '34543433', 'Paco', 'Lucia', 'Lucia', 'paco@gmail.com', '666578899', 'Av castelao nº 5', 'Santiago', 'Coruña', 1),
(6, '45454D', 'Andrés', 'Ramírez', 'Ramírez', 'andres@abc.com', '6767677', 'Av Madrid 5', 'Vigo', 'Pontevedra', 1),
(7, '87676Q', 'José', 'Blanco', 'Blanco', 'jose@abc.com', '657575', 'Av García n 5', 'Pontevedra', 'Pontevedra', 2),
(8, '348484Y', 'Ana', 'Ferreiro', 'Ferreiro', 'ana@abc.com', '5675756', 'Calle Zaragoza n 3', 'Coruña', 'Coruña', 2),
(9, '567897A', 'Mario', 'Bros', 'Bros', 'mario@abc.com', '5454567', 'C/ Ramiro n 8', 'Vigo', 'Vigo', NULL),
(10, '468695T', 'Carlos', 'Rivas', 'Rivas', 'carlos@abc.com', '5678666', 'C/ bienvenido 8', 'Santiago', 'Coruña', NULL),
(11, '89898D', 'Oscar', 'Vil', 'Vil', 'oscar@abc.com', '6766767', 'C/ Santiago n 5', 'Lugo', 'Lugo', NULL),
(12, '78787Y', 'Santiago', 'Berta', 'Berta', 'santiago@abc.com', '8777676', 'Av Galicia n 8', 'Vigo', 'Pontevedra', NULL),
(13, '454454W', 'Rodrigo', 'Rodríguez', 'Rodríguez', 'rodrigo@abc.com', '5656565', 'C/ Aragon n 7', 'Coruña', 'Coruña', NULL),
(14, '76767R', 'Laura', 'Arnoso', 'Arnoso', 'laura@abc.com', '656565', 'c/ Lorenzo n 2', 'Santiago', 'Santiago', NULL),
(15, '434343W', 'Tomas', 'Rivera', 'Rivera', 'tomas@abc.com', '445454', 'C/ Aquino n 3', 'Pontevedra', 'Pontevedra', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `categoria` int(11) NOT NULL,
  `fecha_fin_campania` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `categoria`, `fecha_fin_campania`) VALUES
(1, 'Camisa', 'Camisa de cuadros', 2, '2019-12-30'),
(2, 'Portátil', 'Portátil HP última generación', 1, '2018-06-28'),
(3, 'Libro Bestiario', 'Libro de cuentos', 1, '2018-06-27'),
(4, 'Revolver', 'Disco del grupo The Beatles', 1, '2018-06-26'),
(5, 'Pantalón', 'Pantalón marrón', 2, '2018-10-31'),
(64, 'Black Sabbath', 'Disco grupo Black Sabbath', 4, '2018-12-11'),
(65, 'Móvil', 'Móvil Samsung color negro', 1, '2018-07-30'),
(66, 'Móvil', 'Móvil Samsung color blanco', 1, '2019-03-26'),
(67, 'Libro de Artaud', 'Libro Carta a los poderes', 3, '2018-10-30'),
(68, 'London Calling', 'Disco del grupo The Clash', 4, '2019-02-26'),
(69, 'Pijama', 'Pijama de algodón', 2, '2018-07-31'),
(70, 'Ficciones', 'Libro de Jorge Luis Borges', 3, '2018-09-26'),
(71, 'El ruido y la furia', 'Libro de William Faulkner', 3, '2018-12-29'),
(72, 'Portátil', 'Portátil con ratón', 1, '2019-01-29'),
(73, 'Sudadera', 'Sudadera de algodón', 2, '2018-11-22'),
(74, 'Strange Days', 'Disco del grupo The Doors', 4, '2018-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `producto_tienda`
--

CREATE TABLE `producto_tienda` (
  `id_producto_tienda` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` float NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `producto_tienda`
--

INSERT INTO `producto_tienda` (`id_producto_tienda`, `id_prod`, `id_tienda`, `stock`, `precio`, `estado`) VALUES
(1, 1, 3, 3, 1, 4),
(2, 1, 2, 4, 26, 2),
(3, 1, 3, 40, 3, 2),
(4, 2, 2, 70, 500, 2),
(9, 2, 1, 3, 5, 2),
(10, 2, 3, 12, 600, 2),
(11, 3, 2, 12, 10, 1),
(12, 3, 2, 23, 9, 2),
(13, 3, 3, 31, 8, 2),
(14, 4, 3, 4, 5, 3),
(15, 4, 2, 7, 13, 4),
(16, 4, 3, 7, 10.5, 2),
(17, 5, 2, 3, 2, 2),
(36, 64, 1, 20, 30, 2),
(37, 64, 2, 34, 35, 4),
(38, 64, 3, 0, 34, 3),
(39, 65, 1, 200, 200, 4),
(40, 65, 2, 98, 210, 4),
(41, 65, 3, 56, 215, 4),
(42, 66, 1, 87, 198, 2),
(43, 66, 2, 76, 184, 2),
(44, 66, 3, 0, 182, 3),
(45, 67, 1, 56, 12, 2),
(46, 67, 2, 300, 14, 2),
(47, 67, 3, 67, 13, 2),
(48, 68, 1, 78, 32, 1),
(49, 68, 2, 32, 34, 1),
(50, 68, 3, 45, 0, 1),
(55, 68, 1, 53, 34, 2),
(56, 1, 2, 45, 0, 1),
(57, 68, 2, 67, 21, 2),
(58, 68, 3, 0, 21, 3),
(59, 69, 1, 99, 20, 2),
(60, 69, 2, 0, 21, 3),
(61, 69, 3, 45, 21, 4),
(62, 70, 1, 56, 13, 2),
(63, 70, 2, 45, 11, 2),
(64, 70, 3, 32, 10, 2),
(65, 71, 1, 45, 24, 2),
(66, 71, 2, 56, 20, 2),
(67, 71, 3, 34, 18, 2),
(68, 72, 1, 67, 800, 2),
(69, 72, 2, 0, 780, 3),
(70, 72, 3, 25, 770, 3),
(71, 73, 1, 21, 20, 1),
(72, 73, 2, 45, 21, 2),
(73, 73, 3, 20, 20, 4),
(74, 74, 1, 56, 21, 2),
(75, 74, 2, 32, 20, 2),
(76, 74, 3, 0, 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reserva_event`
--

CREATE TABLE `reserva_event` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserva_event`
--

INSERT INTO `reserva_event` (`id_reserva`, `id_usuario`, `id_evento`, `cantidad`, `precio_total`, `fecha`) VALUES
(3, 15, 1, 12, 20, '2018-05-16'),
(6, 15, 1, 1, 66, '2018-05-27'),
(7, 15, 1, 1, 66, '2018-05-27'),
(8, 19, 1, 1, 6, '2018-05-27'),
(9, 19, 2, 1, 3, '2018-05-27'),
(10, 19, 3, 1, 48888, '2018-05-27'),
(11, 19, 4, 1, 3, '2018-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `reserva_prod`
--

CREATE TABLE `reserva_prod` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserva_prod`
--

INSERT INTO `reserva_prod` (`id_reserva`, `id_usuario`, `id_producto`, `id_tienda`, `cantidad`, `precio_total`, `fecha`) VALUES
(1, 15, 68, 1, 1, 34, '2018-05-27'),
(2, 19, 68, 1, 1, 34, '2018-05-27'),
(3, 19, 1, 2, 1, 26, '2018-05-27'),
(4, 19, 4, 3, 1, 10.5, '2018-05-27'),
(5, 19, 69, 1, 1, 20, '2018-05-27'),
(6, 19, 68, 1, 1, 34, '2018-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `tienda`
--

CREATE TABLE `tienda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `direccion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `ciudad` varchar(45) CHARACTER SET latin1 NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `telefono` varchar(15) CHARACTER SET latin1 NOT NULL,
  `email` varchar(45) CHARACTER SET latin1 NOT NULL,
  `fax` varchar(15) CHARACTER SET latin1 NOT NULL,
  `latitud` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tienda`
--

INSERT INTO `tienda` (`id`, `nombre`, `direccion`, `ciudad`, `codigo_postal`, `telefono`, `email`, `fax`, `latitud`, `longitud`) VALUES
(1, 'Urzaiz', 'Calle Urzaiz num 3', 'Vigo', 36202, '55555555', 'urzais@gmail.com', '55555551', '42.2358184', '-8.719340500000044'),
(2, 'Camelias', 'Av Camelias num 5', 'Vigo', 36021, '66666666', 'camelias@gmail.com', '66666661', '42.2331657', '-8.728873799999974'),
(3, 'Arenal', 'Calle Arenal num 5', 'Vigo', 36203, '88888888', 'arenal@gmail.com', '88888881', '42.2402459', '-8.720811700000013');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo`) VALUES
(1, 'administrador'),
(2, 'gestor'),
(3, 'registrado');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `NIF` varchar(9) DEFAULT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido1` varchar(45) NOT NULL,
  `apellido2` varchar(45) NOT NULL,
  `telefono` varchar(15) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `localidad` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` int(11) NOT NULL,
  `fecha_sesion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `NIF`, `nombre`, `apellido1`, `apellido2`, `telefono`, `email`, `direccion`, `localidad`, `provincia`, `password`, `tipo`, `fecha_sesion`) VALUES
(15, '5647474D', 'prodigy', 'prodigy', 'progigy', '6545454', 'prodigy@abc.com', 'av calle 5', 'Madrid', 'Madrid', '$2y$10$cW.DHx0QyoJmbVlGogOj2u8wgzog4CUO2I9tpeoMJ7KIKsRL8txb2', 1, '2018-05-30 00:23:31'),
(17, '44446T', 'Administrador', 'Admi', 'Admi', '656578', 'administrador@ong.com', 'Av Vigo n 2', 'Pontevedra', 'Pontevedra', '$2y$10$kp6qCj858dTG.0ktCKxOSeoOLg5Q1HPmp4mzF.R/gBWtT5cXzfixe', 1, '2018-05-30 10:18:16'),
(18, '657890D', 'Gestor', 'Gest', 'Gest', '8756565', 'gestor@ong.com', 'Av Galicia n 7', 'Santiago', 'Coruña', '$2y$10$Oopx5oiydV9EfTJerW1I7eY2yODP.Oz/I/ivcdNTRTTuZi5XcLhw.', 2, '2018-05-30 09:50:58'),
(19, '657888P', 'Cliente', 'Cliente', 'Cliente', '6575757', 'cliente@ong.com', 'Av Rosalía', 'Vigo', 'Pontevedra', '$2y$10$bZceuOS/BZ/FYVTxTPqgt.bVRGMx5wX3TibM6BzsvYHB4F3L.eEVy', 3, '2018-05-30 08:36:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evento_lugar`
--
ALTER TABLE `evento_lugar`
  ADD PRIMARY KEY (`id_evento_lugar`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_lugar` (`id_lugar`);

--
-- Indexes for table `evento_participante`
--
ALTER TABLE `evento_participante`
  ADD PRIMARY KEY (`id_evento`,`id_participante`),
  ADD KEY `id_participante` (`id_participante`);

--
-- Indexes for table `fechas_posibles`
--
ALTER TABLE `fechas_posibles`
  ADD PRIMARY KEY (`id_evento`,`fecha`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CIF` (`CIF`);

--
-- Indexes for table `imagenes_prod`
--
ALTER TABLE `imagenes_prod`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruta` (`ruta`),
  ADD KEY `id_prod` (`id_prod`);

--
-- Indexes for table `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lugar` (`lugar`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo` (`grupo`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria` (`categoria`);

--
-- Indexes for table `producto_tienda`
--
ALTER TABLE `producto_tienda`
  ADD PRIMARY KEY (`id_producto_tienda`),
  ADD UNIQUE KEY `id_prod_2` (`id_prod`,`id_tienda`,`estado`),
  ADD KEY `id_prod` (`id_prod`),
  ADD KEY `id_tienda` (`id_tienda`),
  ADD KEY `estado` (`estado`);

--
-- Indexes for table `reserva_event`
--
ALTER TABLE `reserva_event`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_usuario_2` (`id_usuario`,`id_evento`);

--
-- Indexes for table `reserva_prod`
--
ALTER TABLE `reserva_prod`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_tienda` (`id_tienda`),
  ADD KEY `id_usuario_2` (`id_usuario`,`id_producto`,`id_tienda`);

--
-- Indexes for table `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `tipo` (`tipo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `evento_lugar`
--
ALTER TABLE `evento_lugar`
  MODIFY `id_evento_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `imagenes_prod`
--
ALTER TABLE `imagenes_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `lugar`
--
ALTER TABLE `lugar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `participante`
--
ALTER TABLE `participante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `producto_tienda`
--
ALTER TABLE `producto_tienda`
  MODIFY `id_producto_tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `reserva_event`
--
ALTER TABLE `reserva_event`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `reserva_prod`
--
ALTER TABLE `reserva_prod`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `evento_lugar`
--
ALTER TABLE `evento_lugar`
  ADD CONSTRAINT `evento_lugar_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evento_lugar_ibfk_2` FOREIGN KEY (`id_lugar`) REFERENCES `lugar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evento_participante`
--
ALTER TABLE `evento_participante`
  ADD CONSTRAINT `evento_participante_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento_lugar` (`id_evento_lugar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evento_participante_ibfk_2` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fechas_posibles`
--
ALTER TABLE `fechas_posibles`
  ADD CONSTRAINT `fk_evento` FOREIGN KEY (`id_evento`) REFERENCES `evento_lugar` (`id_evento_lugar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imagenes_prod`
--
ALTER TABLE `imagenes_prod`
  ADD CONSTRAINT `imagenes_prod_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `participante_ibfk_1` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `producto_tienda`
--
ALTER TABLE `producto_tienda`
  ADD CONSTRAINT `producto_tienda_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_tienda_ibfk_2` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_tienda_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `reserva_event`
--
ALTER TABLE `reserva_event`
  ADD CONSTRAINT `reserva_event_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_event_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `evento_lugar` (`id_evento_lugar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserva_prod`
--
ALTER TABLE `reserva_prod`
  ADD CONSTRAINT `reserva_prod_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto_tienda` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_prod_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_prod_ibfk_4` FOREIGN KEY (`id_tienda`) REFERENCES `producto_tienda` (`id_tienda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_usuario` (`id`) ON UPDATE CASCADE;
--
-- Database: `ong1`
--
CREATE DATABASE IF NOT EXISTS `ong1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ong1`;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ruta_imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `evento_lugar`
--

CREATE TABLE `evento_lugar` (
  `id_evento_lugar` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_lugar` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `aforo` int(11) NOT NULL,
  `precio_entrada` float NOT NULL,
  `entradas_disponibles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `evento_participante`
--

CREATE TABLE `evento_participante` (
  `id_evento` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fechas_posibles`
--

CREATE TABLE `fechas_posibles` (
  `id_evento` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `CIF` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `domicilio_fiscal` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `imagenes_prod`
--

CREATE TABLE `imagenes_prod` (
  `id` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `ruta` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lugar`
--

CREATE TABLE `lugar` (
  `id` int(11) NOT NULL,
  `lugar` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `participante`
--

CREATE TABLE `participante` (
  `id` int(11) NOT NULL,
  `NIF` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `categoria` int(11) NOT NULL,
  `fecha_fin_campania` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `producto_tienda`
--

CREATE TABLE `producto_tienda` (
  `id_producto_tienda` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` float NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reserva_event`
--

CREATE TABLE `reserva_event` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reserva_prod`
--

CREATE TABLE `reserva_prod` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` float NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tienda`
--

CREATE TABLE `tienda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(45) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fax` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `NIF` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` int(15) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `fecha_sesion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evento_lugar`
--
ALTER TABLE `evento_lugar`
  ADD PRIMARY KEY (`id_evento_lugar`),
  ADD KEY `eventoid` (`id_evento`),
  ADD KEY `lugarid` (`id_lugar`);

--
-- Indexes for table `evento_participante`
--
ALTER TABLE `evento_participante`
  ADD PRIMARY KEY (`id_evento`,`id_participante`),
  ADD KEY `participantekey` (`id_participante`);

--
-- Indexes for table `fechas_posibles`
--
ALTER TABLE `fechas_posibles`
  ADD PRIMARY KEY (`id_evento`,`fecha`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagenes_prod`
--
ALTER TABLE `imagenes_prod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoimg` (`id_prod`);

--
-- Indexes for table `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupoid` (`grupo`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoprodu` (`categoria`);

--
-- Indexes for table `producto_tienda`
--
ALTER TABLE `producto_tienda`
  ADD PRIMARY KEY (`id_producto_tienda`),
  ADD KEY `productoid` (`id_prod`),
  ADD KEY `tiendaid` (`id_tienda`),
  ADD KEY `estadoid` (`estado`);

--
-- Indexes for table `reserva_event`
--
ALTER TABLE `reserva_event`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `idusuario` (`id_usuario`),
  ADD KEY `idevent` (`id_evento`);

--
-- Indexes for table `reserva_prod`
--
ALTER TABLE `reserva_prod`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `usuarioid` (`id_usuario`),
  ADD KEY `productotienda` (`id_producto`);

--
-- Indexes for table `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipouser` (`tipo`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evento_lugar`
--
ALTER TABLE `evento_lugar`
  ADD CONSTRAINT `eventoid` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lugarid` FOREIGN KEY (`id_lugar`) REFERENCES `lugar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evento_participante`
--
ALTER TABLE `evento_participante`
  ADD CONSTRAINT `eventokey` FOREIGN KEY (`id_evento`) REFERENCES `evento_lugar` (`id_evento_lugar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participantekey` FOREIGN KEY (`id_participante`) REFERENCES `participante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fechas_posibles`
--
ALTER TABLE `fechas_posibles`
  ADD CONSTRAINT `idevento` FOREIGN KEY (`id_evento`) REFERENCES `evento_lugar` (`id_evento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imagenes_prod`
--
ALTER TABLE `imagenes_prod`
  ADD CONSTRAINT `productoimg` FOREIGN KEY (`id_prod`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `grupoid` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `categoprodu` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producto_tienda`
--
ALTER TABLE `producto_tienda`
  ADD CONSTRAINT `estadoid` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productoid` FOREIGN KEY (`id_prod`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiendaid` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserva_event`
--
ALTER TABLE `reserva_event`
  ADD CONSTRAINT `idevent` FOREIGN KEY (`id_evento`) REFERENCES `evento_lugar` (`id_evento_lugar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idusuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserva_prod`
--
ALTER TABLE `reserva_prod`
  ADD CONSTRAINT `productotienda` FOREIGN KEY (`id_producto`) REFERENCES `producto_tienda` (`id_producto_tienda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioid` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `tipouser` FOREIGN KEY (`tipo`) REFERENCES `tipo_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `phpmyadmin`
--


