-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2024 a las 17:02:19
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
-- Base de datos: `factura`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_precio_producto` (`n_cantidad` INT, `n_precio` DECIMAL(10,2), `codigo` INT)   BEGIN
    	DECLARE nueva_existencia int;
        DECLARE nuevo_total  decimal(10,2);
        DECLARE nuevo_precio decimal(10,2);
        
        DECLARE cant_actual int;
        DECLARE pre_actual decimal(10,2);
        
        DECLARE actual_existencia int;
        DECLARE actual_precio decimal(10,2);
                
        SELECT precio,existencia INTO actual_precio,actual_existencia FROM producto WHERE codproducto = codigo;
        SET nueva_existencia = actual_existencia + n_cantidad;
        SET nuevo_total = (actual_existencia * actual_precio) + (n_cantidad * n_precio);
        SET nuevo_precio = nuevo_total / nueva_existencia;
        
        UPDATE producto SET existencia = nueva_existencia, precio = nuevo_precio WHERE codproducto = codigo;
        
        SELECT nueva_existencia,nuevo_precio;
        
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(25) NOT NULL,
  `nit` varchar(11) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `dateadd` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nit`, `nombre`, `telefono`, `direccion`, `dateadd`, `usuario_id`, `estatus`) VALUES
(1, 'RD5466546', 'Ana Beato', '8298687777', 'Sector Enriquillo, Distrito Nacional', '2024-04-25 20:24:19', 4, 1),
(2, 'SD254654', 'Josefina Almanzar F.', '123456789', 'Sector 30 de Mayo, D. N.', '2024-04-25 19:16:00', 1, 0),
(3, 'RD54665', 'Yeremi Almanzar', '2147483647', 'Sector Enriquillo, Distrito Nacional', '2024-04-25 19:39:47', 4, 0),
(4, 'RD22223', 'Joselito Mateo', '2147483647', 'Santiago', '2024-04-25 20:22:42', 4, 0),
(5, '00117768859', 'Anyeudi Poche', '8095448595', 'Los Mina Sur', '2024-04-25 20:24:02', 4, 1),
(6, 'ST2564889', 'Ericdania Mota', '8095898989', 'Azua de Compostela', '2024-04-26 13:39:24', 1, 1),
(7, '40216263378', 'Stefany De Oleo', '8497774451', 'Barahona, Rep. Dom.', '2024-04-26 13:41:32', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `correlativo` bigint(11) NOT NULL,
  `nofactura` bigint(11) DEFAULT NULL,
  `codproducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `preciototal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `correlativo` int(11) NOT NULL,
  `nofactura` bigint(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciototal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `correlativo` int(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuario_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`correlativo`, `codproducto`, `fecha`, `cantidad`, `precio`, `usuario_id`) VALUES
(1, 1, '2024-04-29 09:09:00', 100, 150.00, 1),
(2, 2, '2024-04-29 09:09:04', 100, 150.00, 1),
(3, 3, '2024-06-10 12:51:33', 30, 25000.00, 1),
(4, 4, '2024-08-04 09:30:48', 50, 50.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nofactura` bigint(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` int(11) DEFAULT NULL,
  `codcliente` int(11) DEFAULT NULL,
  `totaltactura` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `descripcion`, `proveedor`, `precio`, `existencia`, `date_add`, `usuario_id`, `estatus`, `foto`) VALUES
(1, 'USB', 10, 150.00, 100, '2024-04-29 09:09:00', 1, 1, 'usb.jpg'),
(2, 'USB', 10, 150.00, 100, '2024-04-29 09:09:04', 1, 1, 'usb.jpg'),
(3, 'Celular Sony S75', 8, 25000.00, 30, '2024-06-10 12:51:33', 1, 1, 'img_producto.png'),
(4, 'Mouse chino', 16, 50.00, 50, '2024-08-04 09:30:48', 1, 1, 'img_producto.png');

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `entradas_A_I` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
                INSERT INTO entradas (codproducto, cantidad, precio, usuario_id)
                VALUES (new.codproducto, new.existencia, new.precio, new.usuario_id);
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `codproveedor` int(11) NOT NULL,
  `rnc` varchar(11) NOT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono` bigint(11) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`codproveedor`, `rnc`, `proveedor`, `contacto`, `telefono`, `direccion`, `date_add`, `usuario_id`, `estatus`) VALUES
(1, 'C/F', 'BIC', 'Claudia Rosales', 789877889, 'Avenida las Americas', '2024-04-26 19:37:21', 1, 1),
(2, 'C/F', 'CASIO', 'Jorge Herrera', 565656565656, 'Calzada Las Flores', '2024-04-26 19:37:21', 1, 1),
(3, 'C/F', 'Omega', 'Julio Estrada', 982877489, 'Avenida Elena Zona 4, Guatemala', '2024-04-26 19:37:21', 1, 1),
(4, 'C/F', 'Dell Compani', 'Roberto Estrada', 2147483647, 'Guatemala, Guatemala', '2024-04-26 19:37:21', 1, 1),
(5, 'C/F', 'Olimpia S.A', 'Elena Franco Morales', 564535676, '5ta. Avenida Zona 4 Ciudad', '2024-04-26 19:37:21', 1, 1),
(6, 'C/F', 'Oster', 'Fernando Guerra', 78987678, 'Calzada La Paz, Guatemala', '2024-04-26 19:37:21', 1, 1),
(7, 'C/F', 'ACELTECSA S.A', 'Ruben PÃ©rez', 789879889, 'Colonia las Victorias', '2024-04-26 19:37:21', 1, 1),
(8, 'C/F', 'Sony', 'Julieta Contreras', 89476787, 'Antigua Guatemala', '2024-04-26 19:37:21', 1, 1),
(9, 'C/F', 'VAIO', 'Felix Arnoldo Rojas', 476378276, 'Avenida las Americas Zona 13', '2024-04-26 19:37:21', 1, 1),
(10, 'C/F', 'SUMAR', 'Oscar Maldonado', 788376787, 'Colonia San Jose, Zona 5 Guatemala', '2024-04-26 19:37:21', 1, 0),
(11, 'C/F', 'HP', 'Angel Cardona', 2147483647, '5ta. calle zona 4 Guatemala', '2024-04-26 19:37:21', 1, 1),
(12, '131654654', 'KS TECHNOLOGY', 'Yensi Carrasco', 8095808082, 'Capotillo, Santo Domingo', '2024-04-26 23:48:44', 1, 1),
(13, 'C/F', 'PEPELERIA D&C', 'Cesar Peralta', 8098863636, 'Enriquillo, Distrito Nacional', '2024-04-26 23:51:41', 1, 1),
(14, '13456546', 'MACKJESTY', 'Elian Gonzalez', 8095667788, 'Capotillo, Santo Domingo', '2024-04-27 18:54:35', 1, 0),
(15, 'C/F', 'COLGATE', 'Denny Zadel', 8095159310, 'Cayetano Germoson, D. N.', '2024-04-29 09:05:47', 1, 1),
(16, '1315644', 'ANTILLAS F&M', 'Joan Simarro', 8095334444, 'San Pedro', '2024-04-29 15:04:54', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Vendedor'),
(4, 'Administrador'),
(5, 'Supervisor'),
(6, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`) VALUES
(1, 'Junior Serrano F.', 'juniorlisandro@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70', 1),
(4, 'Keilin Serrano', 'keilin@gmail.com', 'kserrano', '202cb962ac59075b964b07152d234b70', 2),
(5, 'Sheyla Sofiq', 'sheyla@gmail.com', 'sserrano', '202cb962ac59075b964b07152d234b70', 1),
(8, 'Pedro Rodríguez', 'pedro@example.com', 'pedrorodriguez', '8cac6cee8223173e9c31d814bdf304b7', 1),
(9, 'Ana Martínez', 'ana@example.com', 'anamartinez', 'f0e88ab9fb980ece24ebe78179f51246', 2),
(11, 'Laura González', 'laura@example.com', 'lauragonzalez', '3114b2a7c2fc9e282d56c3ab6528661e', 2),
(12, 'Carlos López', 'carlos@example.com', 'carloslopez', '3d33d9a0066f4601054bbbfa0e6ff760', 1),
(13, 'Sofía Hernández', 'sofia@example.com', 'sofiahernandez', '380759fb2b96a5904f2a3d4ec571b6ae', 2),
(14, 'Miguel Díaz', 'miguel@example.com', 'migueldiaz', '6df960c10cdaf092c153a6dd4da0424c', 1),
(15, 'Elena Castro', 'elena@example.com', 'elenacastro', '690162610dae5242ca8aebf97720567a', 2),
(16, 'Javier Ruiz', 'javier@example.com', 'javierruiz', 'eb52fc9a4b3a81a2000a9e774d5aa515', 1),
(17, 'Paula Torres', 'paula@example.com', 'paulatorres', 'b984fe77863037ddeb9be2ad7dfb246e', 2),
(18, 'Diego López', 'diego@example.com', 'diegolopez', '8cac6cee8223173e9c31d814bdf304b7', 1),
(19, 'Carmen Martín', 'carmen@example.com', 'carmenmartin', 'f0e88ab9fb980ece24ebe78179f51246', 2),
(21, 'Pablo García', 'pablo@example.com', 'pablogarcia', '3114b2a7c2fc9e282d56c3ab6528661e', 2),
(23, 'Manuel Fernández', 'manuel@example.com', 'manuelfernandez', '380759fb2b96a5904f2a3d4ec571b6ae', 2),
(24, 'Silvia Jiménez', 'silvia@example.com', 'silviajimenez', '6df960c10cdaf092c153a6dd4da0424c', 1),
(25, 'Andrea Pérez', 'andrea@example.com', 'andreaperez', '690162610dae5242ca8aebf97720567a', 2),
(28, 'Maximo Paredes', 'maixmo@gmail.com', 'mparedes', '202cb962ac59075b964b07152d234b70', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`),
  ADD KEY `nofactura` (`nofactura`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `nofactura` (`nofactura`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nofactura`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `codcliente` (`codcliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`),
  ADD KEY `proveedor` (`proveedor`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `usuario_id_2` (`usuario_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codproveedor`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `correlativo` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `codproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nofactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nofactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_temp_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`codcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`codproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
