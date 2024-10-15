-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2024 a las 02:27:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento`
--

CREATE TABLE `asiento` (
  `fila` varchar(1) NOT NULL,
  `columna` int(11) NOT NULL,
  `bloque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `asiento`
--

INSERT INTO `asiento` (`fila`, `columna`, `bloque`) VALUES
('A', 1, 1),
('A', 2, 1),
('A', 3, 1),
('B', 1, 2),
('B', 2, 2),
('B', 3, 2),
('C', 1, 3),
('C', 2, 3),
('C', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `cantidad` int(11) NOT NULL,
  `Cliente_idCliente` int(11) NOT NULL,
  `Ticket_idTicket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`) VALUES
(1, 'Conciertos'),
(2, 'Festivales'),
(3, 'Conferencias y '),
(4, 'Eventos Cultura'),
(5, 'Comedia y Stand'),
(6, 'Ocio y Fantasia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idciudad` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idciudad`, `nombre`) VALUES
(1, 'Bogota'),
(2, 'Cartagena'),
(3, 'Bucaramanga'),
(4, 'Medellin'),
(5, 'Cali'),
(6, 'Barranquilla'),
(7, 'Pasto'),
(8, 'Pereira'),
(9, 'Manizales'),
(10, 'Tunja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `cc` bigint(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `idEvento` int(11) NOT NULL,
  `sitio` varchar(50) NOT NULL,
  `flayer` int(11) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `edadMinima` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fechaEvento` date NOT NULL,
  `horaEvento` time NOT NULL,
  `Proveedor` int(11) NOT NULL,
  `ciudad_idciudad` int(11) NOT NULL,
  `categoria_idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`idEvento`, `sitio`, `flayer`, `logo`, `edadMinima`, `nombre`, `fechaEvento`, `horaEvento`, `Proveedor`, `ciudad_idciudad`, `categoria_idCategoria`) VALUES
(1, 'Movistar Arena', 0, '', 18, 'Gira Rata Blanca', '2024-10-20', '20:00:00', 1, 1, 1),
(2, 'Movistar Arena', 0, '', 18, 'Gira Rata Blanca', '2024-10-31', '20:00:00', 1, 1, 1),
(3, 'Movistar Arena', NULL, NULL, 10, 'Concierto Armonica', '2024-10-31', '16:00:00', 1, 1, 1),
(4, 'Movistar Arena', NULL, NULL, 10, 'Festival de la salchipapa', '2024-10-28', '12:00:00', 1, 1, 4),
(5, 'Movistar Arena', NULL, NULL, 18, 'Acidez en vivo', '2024-10-24', '18:30:00', 1, 1, 1),
(6, 'Teatro Colón', NULL, NULL, 21, 'Rock en tu idioma', '2024-11-05', '20:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventozona`
--

CREATE TABLE `eventozona` (
  `valor` decimal(10,0) NOT NULL,
  `aforo` int(11) NOT NULL,
  `Evento_idEvento` int(11) NOT NULL,
  `Zona_idZona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `eventozona`
--

INSERT INTO `eventozona` (`valor`, `aforo`, `Evento_idEvento`, `Zona_idZona`) VALUES
(15000, 10, 1, 1),
(15000, 10, 1, 2),
(15000, 10, 6, 1),
(15000, 10, 6, 2),
(15000, 10, 6, 3),
(15000, 10, 6, 4),
(15000, 10, 6, 5),
(15000, 10, 6, 6),
(15000, 10, 6, 7),
(15000, 10, 6, 8),
(15000, 10, 6, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `precioTotal` varchar(45) NOT NULL,
  `cantidadTotal` varchar(45) NOT NULL,
  `IVA` int(11) NOT NULL,
  `Cliente_idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nit` bigint(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nit`, `nombre`, `apellido`, `usuario`, `password`, `telefono`, `email`) VALUES
(1, 1056879980, '', '', 'katherin', 'cris123', 715869, 'carpov@outlook.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL,
  `valor` double NOT NULL,
  `Asiento_fila` varchar(1) NOT NULL,
  `Asiento_columna` int(11) NOT NULL,
  `Evento_idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticketfactura`
--

CREATE TABLE `ticketfactura` (
  `precioVenta` double NOT NULL,
  `Factura_idFactura` int(11) NOT NULL,
  `Ticket_idTicket` int(11) NOT NULL,
  `Cliente_idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `idTipo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `idZona` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `Asiento_fila` varchar(1) NOT NULL,
  `Asiento_columna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`idZona`, `nombre`, `Asiento_fila`, `Asiento_columna`) VALUES
(1, 'Zona A', 'A', 1),
(2, 'Zona A', 'A', 2),
(3, 'Zona A', 'A', 3),
(4, 'Zona B', 'B', 1),
(5, 'Zona B', 'B', 2),
(6, 'Zona B', 'B', 3),
(7, 'Zona C', 'C', 1),
(8, 'Zona C', 'C', 2),
(9, 'Zona C', 'C', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asiento`
--
ALTER TABLE `asiento`
  ADD PRIMARY KEY (`fila`,`columna`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`Cliente_idCliente`,`Ticket_idTicket`),
  ADD KEY `fk_Carrito_Ticket1_idx` (`Ticket_idTicket`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idciudad`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `fk_Evento_Proveedor1_idx` (`Proveedor`),
  ADD KEY `fk_Evento_ciudad1_idx` (`ciudad_idciudad`,`categoria_idCategoria`) USING BTREE,
  ADD KEY `fk_Evento_categoria1` (`categoria_idCategoria`);

--
-- Indices de la tabla `eventozona`
--
ALTER TABLE `eventozona`
  ADD KEY `fk_id_evento` (`Evento_idEvento`),
  ADD KEY `fk_id_zona` (`Zona_idZona`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_Factura_Cliente1_idx` (`Cliente_idCliente`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `fk_Ticket_Asiento1_idx` (`Asiento_fila`,`Asiento_columna`),
  ADD KEY `fk_Ticket_Evento1_idx` (`Evento_idEvento`);

--
-- Indices de la tabla `ticketfactura`
--
ALTER TABLE `ticketfactura`
  ADD PRIMARY KEY (`Factura_idFactura`,`Ticket_idTicket`,`Cliente_idCliente`),
  ADD KEY `fk_TicketFactura_Ticket1_idx` (`Ticket_idTicket`),
  ADD KEY `fk_TicketFactura_Cliente1_idx` (`Cliente_idCliente`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`idZona`),
  ADD KEY `fk_id_fila` (`Asiento_fila`) USING BTREE,
  ADD KEY `fk_id_columna` (`Asiento_columna`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_Carrito_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Carrito_Ticket1` FOREIGN KEY (`Ticket_idTicket`) REFERENCES `ticket` (`idTicket`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_Evento_Proveedor1` FOREIGN KEY (`Proveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Evento_categoria1` FOREIGN KEY (`categoria_idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `fk_Evento_ciudad1` FOREIGN KEY (`ciudad_idciudad`) REFERENCES `ciudad` (`idciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `eventozona`
--
ALTER TABLE `eventozona`
  ADD CONSTRAINT `fk_id_evento` FOREIGN KEY (`Evento_idEvento`) REFERENCES `evento` (`idEvento`),
  ADD CONSTRAINT `fk_id_zona` FOREIGN KEY (`Zona_idZona`) REFERENCES `zona` (`idZona`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Factura_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_Ticket_Asiento1` FOREIGN KEY (`Asiento_fila`,`Asiento_columna`) REFERENCES `asiento` (`fila`, `columna`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ticket_Evento1` FOREIGN KEY (`Evento_idEvento`) REFERENCES `evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ticketfactura`
--
ALTER TABLE `ticketfactura`
  ADD CONSTRAINT `fk_TicketFactura_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TicketFactura_Factura1` FOREIGN KEY (`Factura_idFactura`) REFERENCES `factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TicketFactura_Ticket1` FOREIGN KEY (`Ticket_idTicket`) REFERENCES `ticket` (`idTicket`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `zona`
--
ALTER TABLE `zona`
  ADD CONSTRAINT `fk_id_fila` FOREIGN KEY (`Asiento_fila`) REFERENCES `asiento` (`fila`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
