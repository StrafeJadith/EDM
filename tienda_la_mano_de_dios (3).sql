-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2025 a las 15:29:01
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

--
-- Volcado de datos para la tabla `abono_credito`
--

INSERT INTO `abono_credito` (`ID_AC`, `Fecha_AC`, `Monto_AC`, `Telefono_AC`, `ID_US`, `ID_CR`) VALUES
(82, '2025-05-09 15:46:37', 5000, NULL, 1042458, 86),
(83, '2025-05-12 14:52:44', 1000, NULL, 1042458, 86),
(84, '2025-05-12 15:03:07', 100, NULL, 1042458, 86),
(85, '2025-06-05 16:49:12', 1000, NULL, 1042458, 86);

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

--
-- Volcado de datos para la tabla `credito`
--

INSERT INTO `credito` (`ID_CR`, `Nombre_CR`, `Correo_CR`, `Telefono_CR`, `Direccion_CR`, `Estado_CR`, `Fecha_CR`, `Valor_CR`, `ID_US`, `Valor_Total`, `Estado_ACT`, `NDeCreditos_ACT`) VALUES
(86, 'Julissa', 'julissa@gmail.com', 2147483647, 'DG 50B #17-54', 'Aceptado', '2025-04-22 14:54:49', 0, 1042458, 10000, 1, 1),
(87, 'Julissa', 'julissa@gmail.com', 2147483647, 'DG 50B #17-54', 'Aceptado', '2025-04-22 15:02:38', 0, 1042458, 20000, 0, 1);

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

--
-- Volcado de datos para la tabla `detalle_de_venta`
--

INSERT INTO `detalle_de_venta` (`ID_DV`, `FECHA_DV`, `TOTAL_DV`, `ID_US`, `ID_MTP`) VALUES
(130, '2025-04-22', 10000, 1042458, 2),
(131, '2025-04-22', 10000, 1042458, 2),
(132, '2025-04-22', 10000, 1042458, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto_credito`
--

CREATE TABLE `gasto_credito` (
  `ID_GC` int(10) NOT NULL,
  `Valor_GC` int(10) NOT NULL,
  `Fecha_GC` date NOT NULL,
  `ID_US` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gasto_credito`
--

INSERT INTO `gasto_credito` (`ID_GC`, `Valor_GC`, `Fecha_GC`, `ID_US`) VALUES
(63, 10000, '2025-04-22', 1042458),
(64, 10000, '2025-04-22', 1042458),
(65, 10000, '2025-04-22', 1042458);

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
(1, 'Carne', 'Carne de res x LB', 'Granos', 20000, 20, 20, '2025-05-02', '2025-05-10', 11223344, 2, 'public/img/Administrador/Productos/1.webp'),
(2, 'Arroz', 'Arroz en bolsa', 'Granos', 2000, 10, 10, '0000-00-00', '0000-00-00', 11223344, 3, 'public/img/Administrador/Productos/2.webp'),
(3, 'Pechuga', 'Pechuga de pollo', 'Proteinas', 10000, 20, 20, '0000-00-00', '0000-00-00', 11223344, 2, 'public/img/Administrador/Productos/3.jpg'),
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
(101, 'Saray', 'saray@gmail.com', 'Los robles', 2147483647, '$2y$10$SxXh8oVFaMu2SvWbLdHx4uT.mS5TaHLw28HYHtTqj2NAPabx7tNzO', 2, NULL, NULL),
(102, 'Cachita', 'cachita@gmail.com', 'Villa Katango', 31361309, '$2y$10$tZt479oza6snmJTD2bc.i.CPQ0Go1vezPyMwaKopgovpQsA/Za9T6', 2, NULL, NULL),
(103, 'JASDA', 'jasdja@gmail.com', 'asjdajsd', 121212, '$2y$10$V5i8tqD9xjuj51wriZNfW.sLxd.MnI0OKKOVcnaw.O8w01c2I5n2a', 2, NULL, NULL),
(102121, 'asdasdasd', 'asdsad@gmail.com', 'sadasd', 13131313, '$2y$10$tDd9286lUQ0Tb.BeyEPcs.G6EEj1KC0hOm2B.J31wIPHzb4VRqnMu', 3, NULL, NULL),
(1042458, 'Julissa xd', 'julissa@gmail.com', 'DG 50B #17-54', 2147483647, '$2y$10$dTX8rTGIWVreNXsWbAUkcePd8R1.JvopqYnp9h9f.PQvtL7uxjRXS', 3, NULL, NULL),
(1101010, 'asdasd', 'asdasd@gmail.com', 'diagonao', 121212122, '$2y$10$ntz.SHIx5Q7Nv2u5qzPmreHBbKkpG/EJmollju57HSRwTWYfTCOzW', 3, NULL, NULL),
(11223344, 'Ali', 'ali@gmail.com', 'Soledad cra 10b #17-54', 1234567890, '$2y$10$/x.aXqCVKAVijfteSnu3Q.IRI1UG7ycETEoH3k2qifB3B20fkcw4u', 1, NULL, NULL),
(1072608622, 'Ali Erazo', 'el.aliherazo@gmail.com', 'Cra 22B #55-42', 2147483647, '$2y$10$ARD0Q9AEV4e43yf80L6tw.tIyJ7HXyG437sf2pSLKYt4my/fEll5O', 3, NULL, NULL),
(1212121212, 'sadasdsad', 'sadsadsa@gmail.com', '12sadsad', 1213212, '$2y$10$uamq.bLo2N4qfBf5GcDBXuj/JOmwPvc.eebB8L0B6zYxu0.RplT6y', 3, NULL, NULL);

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
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ID_VENT`, `Fecha_VENT`, `Nombre_VENT`, `Precio_VENT`, `Cantidad_VENT`, `Valor_total`, `Estado_VENT`, `ID_US`, `ID_PRO`) VALUES
(185, '2025-06-06', 'Carne', 20000, 2, 40000, 'Proceso', 1042458, 1);

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
  ADD KEY `ID_US` (`ID_US`);

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
  MODIFY `ID_AC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `ID_CR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `detalle_de_venta`
--
ALTER TABLE `detalle_de_venta`
  MODIFY `ID_DV` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `gasto_credito`
--
ALTER TABLE `gasto_credito`
  MODIFY `ID_GC` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID_VENT` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

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
