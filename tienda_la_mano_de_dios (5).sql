-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2025 a las 16:55:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_la_mano_de_dios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono_credito`
--

CREATE TABLE `abono_credito` (
  `ID_AC` int(11) NOT NULL,
  `Fecha_AC` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Monto_AC` int(10) NOT NULL,
  `Telefono_AC` int(11) DEFAULT NULL,
  `ID_US` int(10) NOT NULL,
  `ID_CR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `ID_CAT` int(11) NOT NULL,
  `Nombre_CAT` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`ID_CAT`, `Nombre_CAT`) VALUES
(1, 'Verduras'),
(2, 'Proteinas'),
(3, 'Granos'),
(4, 'Frutas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `ID_CR` int(11) NOT NULL,
  `Nombre_CR` varchar(250) NOT NULL,
  `Correo_CR` varchar(250) NOT NULL,
  `Telefono_CR` int(20) NOT NULL,
  `Direccion_CR` varchar(250) NOT NULL,
  `Estado_CR` varchar(250) NOT NULL,
  `Fecha_CR` datetime NOT NULL,
  `Valor_CR` decimal(50,0) NOT NULL,
  `ID_US` int(20) NOT NULL,
  `Valor_Total` int(10) NOT NULL,
  `Estado_ACT` int(10) NOT NULL,
  `NDeCreditos_ACT` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_de_venta`
--

CREATE TABLE `detalle_de_venta` (
  `ID_DV` int(10) NOT NULL,
  `FECHA_DV` date NOT NULL,
  `TOTAL_DV` int(52) NOT NULL,
  `ID_US` int(10) NOT NULL,
  `ID_MTP` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto_credito`
--

CREATE TABLE `gasto_credito` (
  `ID_GC` int(10) NOT NULL,
  `Valor_GC` int(10) NOT NULL,
  `Fecha_GC` date NOT NULL,
  `ID_US` int(10) NOT NULL,
  `ID_CR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `ID_MTP` int(10) NOT NULL,
  `Tipo_Pago_MTP` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`ID_MTP`, `Tipo_Pago_MTP`) VALUES
(1, 'Efectivo'),
(2, 'Credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_PRO` int(10) NOT NULL,
  `Nombre_PRO` varchar(20) NOT NULL,
  `Descripcion_PRO` varchar(50) DEFAULT NULL,
  `Categoria_PRO` varchar(20) NOT NULL,
  `Valor_Unitario` int(10) NOT NULL,
  `Cantidad_Total` int(5) NOT NULL,
  `Cantidad_Existente` int(5) NOT NULL,
  `Fecha_Entrada` date NOT NULL,
  `Fecha_Expedicion` date NOT NULL,
  `ID_US` int(10) NOT NULL,
  `ID_CAT` int(11) NOT NULL,
  `Img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_PRO`, `Nombre_PRO`, `Descripcion_PRO`, `Categoria_PRO`, `Valor_Unitario`, `Cantidad_Total`, `Cantidad_Existente`, `Fecha_Entrada`, `Fecha_Expedicion`, `ID_US`, `ID_CAT`, `Img`) VALUES
(1, 'Carne', 'Carne de res x LB', 'Granos', 20000, 20, 17, '2025-05-02', '2025-05-10', 11223344, 2, 'public/img/Administrador/Productos/1.webp'),
(2, 'Arroz', 'Arroz en bolsa', 'Granos', 2000, 10, 9, '0000-00-00', '0000-00-00', 11223344, 3, 'public/img/Administrador/Productos/2.webp'),
(3, 'Pechuga', 'Pechuga de pollo', 'Proteinas', 10000, 20, 16, '0000-00-00', '0000-00-00', 11223344, 2, 'public/img/Administrador/Productos/3.jpg'),
(4, 'asdas', 'adasd', 'Proteinas', 1000, 10, 10, '0000-00-00', '0000-00-00', 11223344, 2, 'public/img/Administrador/Productos/4.jpg'),
(5, 'juan', 'alberto', 'Proteinas', 10000, 5, 5, '0000-00-00', '0000-00-00', 11223344, 2, 'public/img/Administrador/Productos/5.webp'),
(6, 'asdasdadasdasd', 'asdasdadsasda', 'Verduras', 10, 20, 20, '0000-00-00', '0000-00-00', 11223344, 1, 'public/img/Administrador/Productos/6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `ID_TU` int(10) NOT NULL,
  `Nombre_TU` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`ID_TU`, `Nombre_TU`) VALUES
(1, 'Administrador'),
(2, 'Vendedor'),
(3, 'Usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_US` int(20) NOT NULL,
  `Nombre_US` varchar(250) NOT NULL,
  `Correo_US` varchar(250) NOT NULL,
  `Direccion_US` varchar(250) NOT NULL,
  `Telefono_US` int(20) NOT NULL,
  `Contrasena_US` varchar(250) NOT NULL,
  `ID_TU` int(20) NOT NULL,
  `Codigo_US` varchar(10) DEFAULT NULL,
  `CodigoExp_US` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_US`, `Nombre_US`, `Correo_US`, `Direccion_US`, `Telefono_US`, `Contrasena_US`, `ID_TU`, `Codigo_US`, `CodigoExp_US`) VALUES
(11223344, 'Ali', 'ali@gmail.com', 'Soledad cra 10b #17-54', 1234567890, '$2y$10$/x.aXqCVKAVijfteSnu3Q.IRI1UG7ycETEoH3k2qifB3B20fkcw4u', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID_VENT` int(10) NOT NULL,
  `Fecha_VENT` date NOT NULL,
  `Nombre_VENT` varchar(255) NOT NULL,
  `Precio_VENT` int(20) NOT NULL,
  `Cantidad_VENT` int(20) NOT NULL,
  `Valor_total` int(10) NOT NULL,
  `Estado_VENT` varchar(255) NOT NULL,
  `ID_US` int(11) NOT NULL,
  `ID_PRO` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono_credito`
--
ALTER TABLE `abono_credito`
  ADD PRIMARY KEY (`ID_AC`),
  ADD KEY `ID_US` (`ID_US`),
  ADD KEY `ID_CR` (`ID_CR`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`ID_CAT`);

--
-- Indices de la tabla `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`ID_CR`),
  ADD KEY `ID_US` (`ID_US`);

--
-- Indices de la tabla `detalle_de_venta`
--
ALTER TABLE `detalle_de_venta`
  ADD PRIMARY KEY (`ID_DV`),
  ADD KEY `ID_US` (`ID_US`),
  ADD KEY `ID_MTP` (`ID_MTP`);

--
-- Indices de la tabla `gasto_credito`
--
ALTER TABLE `gasto_credito`
  ADD PRIMARY KEY (`ID_GC`),
  ADD KEY `ID_US` (`ID_US`),
  ADD KEY `ID_CR` (`ID_CR`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`ID_MTP`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_PRO`),
  ADD KEY `ID_US` (`ID_US`),
  ADD KEY `ID_CAT` (`ID_CAT`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`ID_TU`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_US`),
  ADD KEY `ID_TU` (`ID_TU`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_VENT`),
  ADD KEY `ID_US` (`ID_US`),
  ADD KEY `ID_PRO` (`ID_PRO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abono_credito`
--
ALTER TABLE `abono_credito`
  MODIFY `ID_AC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `ID_CR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `detalle_de_venta`
--
ALTER TABLE `detalle_de_venta`
  MODIFY `ID_DV` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `gasto_credito`
--
ALTER TABLE `gasto_credito`
  MODIFY `ID_GC` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID_VENT` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abono_credito`
--
ALTER TABLE `abono_credito`
  ADD CONSTRAINT `abono_credito_ibfk_1` FOREIGN KEY (`ID_US`) REFERENCES `usuarios` (`ID_US`),
  ADD CONSTRAINT `abono_credito_ibfk_2` FOREIGN KEY (`ID_CR`) REFERENCES `credito` (`ID_CR`);

--
-- Filtros para la tabla `credito`
--
ALTER TABLE `credito`
  ADD CONSTRAINT `credito_ibfk_1` FOREIGN KEY (`ID_US`) REFERENCES `usuarios` (`ID_US`);

--
-- Filtros para la tabla `detalle_de_venta`
--
ALTER TABLE `detalle_de_venta`
  ADD CONSTRAINT `ID_MTP` FOREIGN KEY (`ID_MTP`) REFERENCES `metodo_pago` (`ID_MTP`),
  ADD CONSTRAINT `detalle_de_venta_ibfk_2` FOREIGN KEY (`ID_US`) REFERENCES `usuarios` (`ID_US`);

--
-- Filtros para la tabla `gasto_credito`
--
ALTER TABLE `gasto_credito`
  ADD CONSTRAINT `ID_CR` FOREIGN KEY (`ID_CR`) REFERENCES `credito` (`ID_CR`),
  ADD CONSTRAINT `gasto_credito_ibfk_1` FOREIGN KEY (`ID_US`) REFERENCES `usuarios` (`ID_US`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ID_US`) REFERENCES `usuarios` (`ID_US`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`ID_CAT`) REFERENCES `categoria_producto` (`ID_CAT`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID_TU`) REFERENCES `tipo_usuario` (`ID_TU`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ID_PRO` FOREIGN KEY (`ID_PRO`) REFERENCES `productos` (`ID_PRO`),
  ADD CONSTRAINT `ID_US` FOREIGN KEY (`ID_US`) REFERENCES `usuarios` (`ID_US`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
