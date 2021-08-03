-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2020 a las 23:29:34
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto2020`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbingredientes`
--

CREATE TABLE `tbingredientes` (
  `cnIngrediente` varchar(255) NOT NULL,
  `cnUnidad` varchar(255) NOT NULL,
  `cnTieneMarca` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbingredientes`
--

INSERT INTO `tbingredientes` (`cnIngrediente`, `cnUnidad`, `cnTieneMarca`) VALUES
('Aceite', 'mililitros', 'Si'),
('Aceitunas verdes', 'gramos', 'Si'),
('Ajo', 'unidades', 'No'),
('Carne picada', 'gramos', 'Si'),
('Cebolla', 'unidades', 'No'),
('Fideos', 'gramos', 'Si'),
('Huevos', 'unidades', 'No'),
('Jengibre', 'unidades', 'No'),
('Morron rojo', 'unidades', 'No'),
('Morron verde', 'unidades', 'No'),
('Oregano', 'gramos', 'Si'),
('Pan rallado', 'gramos', 'Si'),
('Pechuga de pollo', 'gramos', 'No'),
('Perejil', 'gramos', 'No'),
('Pimienta', 'gramos', 'Si'),
('Pure de tomate', 'gramos', 'Si'),
('Sal', 'gramos', 'Si'),
('Salsa de soja', 'mililitros', 'Si'),
('Tapa de empanada', 'unidades', 'Si'),
('Tomate', 'unidades', 'No'),
('Zanahoria', 'unidades', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbingredientesenreceta`
--

CREATE TABLE `tbingredientesenreceta` (
  `cnReceta` varchar(255) NOT NULL,
  `cnIngrediente` varchar(255) NOT NULL,
  `cnCantidad` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbingredientesenreceta`
--

INSERT INTO `tbingredientesenreceta` (`cnReceta`, `cnIngrediente`, `cnCantidad`) VALUES
('Empanada de carne media docena', 'Tapa de empanada', 6),
('Empanada de carne media docena', 'Aceitunas verdes', 75),
('Empanada de carne media docena', 'Ajo', 0.25),
('Empanada de carne media docena', 'Carne picada', 250),
('Empanada de carne media docena', 'Cebolla', 0.5),
('Empanada de carne media docena', 'Morron rojo', 0.25),
('Empanada de carne media docena', 'Pure de tomate', 30),
('Empanada de carne media docena', 'Tomate', 0.5),
('Albóndigas con salsa de tomate 4 personas', 'Carne picada', 500),
('Albóndigas con salsa de tomate 4 personas', 'Huevos', 1),
('Albóndigas con salsa de tomate 4 personas', 'Perejil', 15),
('Albóndigas con salsa de tomate 4 personas', 'Pan rallado', 40),
('Albóndigas con salsa de tomate 4 personas', 'Sal', 35),
('Albóndigas con salsa de tomate 4 personas', 'Pimienta', 10),
('Albóndigas con salsa de tomate 4 personas', 'Aceite', 20),
('Albóndigas con salsa de tomate 4 personas', 'Pure de tomate', 80),
('Fideos a la bolognesa 2 personas', 'Cebolla', 1),
('Fideos a la bolognesa 2 personas', 'Morron rojo', 0.5),
('Fideos a la bolognesa 2 personas', 'Carne picada', 300),
('Fideos a la bolognesa 2 personas', 'Oregano', 7),
('Fideos a la bolognesa 2 personas', 'Sal', 8),
('Fideos a la bolognesa 2 personas', 'Pure de tomate', 500),
('Fideos a la bolognesa 2 personas', 'Fideos', 250),
('Salteado de pollo con verduras 2 personas', 'Pechuga de pollo', 500),
('Salteado de pollo con verduras 2 personas', 'Cebolla', 1),
('Salteado de pollo con verduras 2 personas', 'Morron rojo', 0.5),
('Salteado de pollo con verduras 2 personas', 'Morron verde', 0.5),
('Salteado de pollo con verduras 2 personas', 'Zanahoria', 1),
('Salteado de pollo con verduras 2 personas', 'Ajo', 0.25),
('Salteado de pollo con verduras 2 personas', 'Perejil', 50),
('Salteado de pollo con verduras 2 personas', 'Aceite', 50),
('Salteado de pollo con verduras 2 personas', 'Salsa de soja', 50),
('Salteado de pollo con verduras 2 personas', 'Sal', 35),
('Salteado de pollo con verduras 2 personas', 'Pimienta', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpedidos`
--

CREATE TABLE `tbpedidos` (
  `cnID` mediumint(8) UNSIGNED NOT NULL,
  `cnCliente` varchar(255) NOT NULL,
  `cnRecetas` varchar(535) NOT NULL,
  `cnPedido` varchar(255) NOT NULL,
  `cnOpcion` varchar(255) NOT NULL,
  `cnPrecio` int(10) UNSIGNED NOT NULL,
  `cnDireccion` varchar(255) NOT NULL,
  `cnHorario` varchar(255) NOT NULL,
  `cnEstado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbpedidos`
--

INSERT INTO `tbpedidos` (`cnID`, `cnCliente`, `cnRecetas`, `cnPedido`, `cnOpcion`, `cnPrecio`, `cnDireccion`, `cnHorario`, `cnEstado`) VALUES
(1, 'Alejo', 'Empanada de carne media docenax 2', 'Tapa de empanada La Salteña 12 unidades x 1, Aceitunas verdes Castell 180 gramos x 1, Ajo x 1, Carne picada 600 gramos x 1, Cebolla x 1, Morron rojo x 1, Pure de tomate La Campagnola 520 gramos x 1, Tomate x 1, ', 'Premium', 609, 'b', '10-11-2020 (12:01:19)', 'Pendiente'),
(2, 'Alejo', 'Empanada de carne media docenax 2, Albóndigas con salsa de tomate 4 personasx 1', 'Tapa de empanada Mendia 12 unidades x 1   $53 c/u, Aceitunas verdes Castell 180 gramos x 1   $77 c/u, Ajo x 1   $50 c/u, Carne picada Común 600 gramos x 2   $120 c/u, Cebolla x 1   $19 c/u, Morron rojo x 1   $84 c/u, Pure de tomate La Campagnola 520 gramo', 'Económico', 603, 'noo', '21-11-2020 (12:05:27)', 'Pendiente'),
(3, 'Alejo', 'Fideos a la bolognesa 2 personasx 1, Albóndigas con salsa de tomate 4 personasx 1', 'Cebolla x 1   $19 c/u, Morron rojo x 1   $84 c/u, Carne picada Especial 600 gramos x 2   $200 c/u, Oregano La Campagnola 25 gramos x 1   $50 c/u, Sal Celusal fina 100 gramos x 1   $50 c/u, Pure de tomate La Campagnola 520 gramos x 2   $46 c/u, Fideos Mata', 'Premium', 1322, 'Av. Libertador 6796', '26-11-2020 (15:02:12)', 'Pendiente'),
(4, 'Alejo', 'Salteado de pollo con verduras 2 personasx 1', 'Pechuga de pollo 500 gramos x 1   $160 c/u, Cebolla x 1   $19 c/u, Morron rojo x 1   $84 c/u, Morron verde x 1   $26 c/u, Zanahoria x 1   $10 c/u, Ajo x 1   $50 c/u, Perejil 50 gramos x 1   $60 c/u, Aceite Carrefour girasol 900 mililitros x 1   $88 c/u, S', 'Económico', 752, 'Av. Libertador 6796', '28-11-2020 (19:21:45)', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductos`
--

CREATE TABLE `tbproductos` (
  `cnIngrediente` varchar(255) NOT NULL,
  `cnMarca` varchar(255) NOT NULL,
  `cnCantidad` int(255) UNSIGNED NOT NULL,
  `cnPrecio` int(255) UNSIGNED NOT NULL,
  `cnCalidad` int(255) UNSIGNED NOT NULL,
  `cnStock` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbproductos`
--

INSERT INTO `tbproductos` (`cnIngrediente`, `cnMarca`, `cnCantidad`, `cnPrecio`, `cnCalidad`, `cnStock`) VALUES
('Tapa de empanada', 'La Salteña', 12, 72, 3, 'Si'),
('Tapa de empanada', 'Mendia', 12, 53, 2, 'Si'),
('Cebolla', '-', 1, 19, 3, 'Si'),
('Morron rojo', '-', 1, 84, 3, 'Si'),
('Tomate', '-', 1, 34, 3, 'Si'),
('Aceitunas verdes', 'Castell', 180, 77, 3, 'Si'),
('Ajo', '-', 1, 50, 3, 'Si'),
('Pure de tomate', 'Arcor', 520, 56, 3, 'Si'),
('Pure de tomate', 'La Campagnola', 520, 46, 3, 'Si'),
('Carne picada', 'Común', 600, 120, 2, 'Si'),
('Carne picada', 'Especial', 600, 200, 3, 'Si'),
('Huevos', '-', 6, 70, 3, 'Si'),
('Perejil', '-', 50, 60, 3, 'Si'),
('Pan rallado', 'Lucchetti', 500, 60, 3, 'Si'),
('Pan rallado', 'Carrefour', 500, 58, 2, 'Si'),
('Sal', 'Celusal fina', 100, 50, 3, 'Si'),
('Sal', 'Celusal fina', 250, 87, 3, 'Si'),
('Pimienta', '-', 25, 35, 3, 'Si'),
('Aceite', 'Oliovita oliva', 250, 345, 3, 'Si'),
('Aceite', 'Carrefour girasol', 900, 88, 2, 'Si'),
('Fideos', 'Carrefour', 500, 50, 2, 'Si'),
('Fideos', 'Matarazzo', 500, 57, 3, 'Si'),
('Oregano', 'La Campagnola', 25, 50, 3, 'Si'),
('Pechuga de pollo', '-', 500, 160, 3, 'Si'),
('Morron verde', '-', 1, 26, 3, 'Si'),
('Zanahoria', '-', 1, 10, 3, 'Si'),
('Salsa de soja', 'Darama', 180, 170, 3, 'Si'),
('Salsa de soja', 'Darama', 500, 270, 2, 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbrecetas`
--

CREATE TABLE `tbrecetas` (
  `cnReceta` varchar(255) NOT NULL,
  `cnPreparacion` text NOT NULL,
  `cnImagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbrecetas`
--

INSERT INTO `tbrecetas` (`cnReceta`, `cnPreparacion`, `cnImagen`) VALUES
('Albóndigas con salsa de tomate 4 personas', 'En un bol mezclar muy bien la carne molida, huevo, pan rallado, hierbas, sal y pimienta. \r\nSe puede hacer con las manos, o también se puede usar la batidora con las aspas de amasar o mezclar.\r\nHacer albóndigas del tamaño de pelotas de pingpong. \r\nSaldrán 20 aproximadamente. \r\nEn una sartén amplia, calentar a fuego medio-alto, una cucharada de aceite. \r\nColocar las bolitas y dejar dorar por 3 minutos, voltear y dorar por todos lados, unos 3-5 minutos más. \r\nAgregar la salsa de tomates sobre las albóndigas. \r\nRevolver, y cuando empiece a hervir, bajar el fuego y dejar cocinar tapado por 15 minutos.', '../IMG/albondigas.jpg'),
('Empanada de carne media docena', 'En una olla con aceite caliente agregar la cebolla y el morrón. \r\nDejar dorar unos minutos y cuando estén a medio cocer, agregar el ajo y un poco de sal. \r\nSubir el fuego y agregar de una toda la carne picada. \r\nMover la carne para que no quede pegada. \r\nCuando la carne esté sellada agregar el tomate en cubos y las 2 cucharadas de puré de tomates. \r\nCondimentar y mezclar bien. \r\nTapar (no del todo) y dejar cocinar media hora revolviendo de a poco. \r\nSacar del fuego y dejar enfriar en la olla. Agregar las aceitunas picadas y mezclar bien.\r\nRepartir el relleno en las tapas de empanada,  y cerrar con un repulgue. \r\nPoner nuestras empanadas de carne en una placa y llevar a horno fuerte hasta que estén doradas.', '../IMG/empanada-de-carne.png'),
('Fideos a la bolognesa 2 personas', 'Picamos la cebolla y el morrón para ponerla en aceite (ya pre-calentada unos minutos antes en el sartén).\r\nUna vez que estén blanditos le agregaremos la carne picada y revolvemos de mientras que le ponemos el orégano y la sal a gusto.\r\nDe mientras que la carne se va haciendo le agregamos el puré de tomate con 1 vaso de agua. \r\nAl mismo tiempo ponemos aparte a hacer nuestra pasta. \r\nCuando nuestra pasta esta al dente se la agregaremos al sartén con los demás ingredientes. ', '../IMG/bolognesa.jpg'),
('Salteado de pollo con verduras 2 personas', ' Cortamos el pollo en trozos pequeños y los colocamos a marinar junto a la salsa de soja. \r\nLlevamos a la nevera por un espacio de tres horas como mínimo. \r\nCortamos la cebolla, el calabacín, los pimentones y la zanahoria en juliana, y reservamos. \r\nColocamos una sartén onda o un wok al fuego, añadimos un poco de aceite y agregamos el ajo pisado junto a la cebolla por unos 2 minutos o hasta que la cebolla se torne de un color transparente. \r\nLuego, agregamos los pimientos, la zanahoria, y seguimos moviendo hasta que las verduras estén blandas. \r\nDespués, agregamos el calabacín, añadimos un poco de sal y pimienta, mezclamos y dejamos por unos minutos. \r\nPor último, agregamos el pollo, un poco de jengibre en polvo, y dejamos que se cocine bien. \r\nFinalmente, agregamos los brotes de soja, un poco de perejil o cilantro fresco, cubrimos todos los ingredientes con la salsa de soja, y dejamos reducir de unos 3 a 5 minutos.', '../IMG/pollo-con-verduras.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `cnUsername` varchar(255) NOT NULL,
  `cnPassword` varchar(255) NOT NULL,
  `cnDireccion1` varchar(255) NOT NULL,
  `cnDireccion2` varchar(255) NOT NULL,
  `cnDireccion3` varchar(255) NOT NULL,
  `cnJerarquia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbusuarios`
--

INSERT INTO `tbusuarios` (`cnUsername`, `cnPassword`, `cnDireccion1`, `cnDireccion2`, `cnDireccion3`, `cnJerarquia`) VALUES
('Alejo', '$2y$10$TSY4.if/G7NBJYXSRJBxf.ZtFndT8UJF0e5AMPbxNzMknoBFrcHkO', 'Av. Libertador 6796', 'Av. Maipú 957', 'Av. Santa Fe 1014', 'Cliente'),
('Enrique', '$2y$10$O2dMjF/9/pZbDP0lJQT8beXgCckCz.oLgToyfAGwk97xjCf67gZzS', '', '', '', 'Cliente'),
('Hola', '$2y$10$rAKntXih0MhNebTKZe7EI.lmDb67pSh5PomxTMY4DJy4UjpBuuCZ2', '', '', '', 'Cliente'),
('Pilosio', '$2y$10$HkQRXNpOVlCiSys/yud7E.OIrjsghKcQ9YyV3QXalShCB3lHojhpK', '', '', '', 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbingredientes`
--
ALTER TABLE `tbingredientes`
  ADD PRIMARY KEY (`cnIngrediente`),
  ADD KEY `cnIngrediente` (`cnIngrediente`);

--
-- Indices de la tabla `tbingredientesenreceta`
--
ALTER TABLE `tbingredientesenreceta`
  ADD KEY `cnIngrediente` (`cnIngrediente`),
  ADD KEY `cnReceta` (`cnReceta`);

--
-- Indices de la tabla `tbpedidos`
--
ALTER TABLE `tbpedidos`
  ADD KEY `cnCliente` (`cnCliente`),
  ADD KEY `cnDireccion` (`cnDireccion`);

--
-- Indices de la tabla `tbproductos`
--
ALTER TABLE `tbproductos`
  ADD KEY `cnIngrediente` (`cnIngrediente`);

--
-- Indices de la tabla `tbrecetas`
--
ALTER TABLE `tbrecetas`
  ADD PRIMARY KEY (`cnReceta`),
  ADD KEY `cnReceta` (`cnReceta`);

--
-- Indices de la tabla `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD UNIQUE KEY `cnUsername` (`cnUsername`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbingredientesenreceta`
--
ALTER TABLE `tbingredientesenreceta`
  ADD CONSTRAINT `tbingredientesenreceta_ibfk_1` FOREIGN KEY (`cnIngrediente`) REFERENCES `tbingredientes` (`cnIngrediente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbingredientesenreceta_ibfk_2` FOREIGN KEY (`cnReceta`) REFERENCES `tbrecetas` (`cnReceta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbpedidos`
--
ALTER TABLE `tbpedidos`
  ADD CONSTRAINT `tbpedidos_ibfk_1` FOREIGN KEY (`cnCliente`) REFERENCES `tbusuarios` (`cnUsername`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbproductos`
--
ALTER TABLE `tbproductos`
  ADD CONSTRAINT `tbproductos_ibfk_1` FOREIGN KEY (`cnIngrediente`) REFERENCES `tbingredientes` (`cnIngrediente`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
