-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2019 a las 07:36:43
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rnf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristica`
--

CREATE TABLE `caracteristica` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caracteristica`
--

INSERT INTO `caracteristica` (`id`, `nombre`, `descripcion`) VALUES
(12, 'Eficiencia de desempeño', 'Esta característica representa el desempeño relativo a la cantidad de recursos utilizados bajo determinadas condiciones'),
(13, 'Compatibilidad', 'Capacidad de dos o más sistemas o componentes para intercambiar información y/o llevar a cabo sus funciones requeridas cuando comparten el mismo entorno hardware o software'),
(14, 'Usabilidad', 'Capacidad del producto software para ser entendido, aprendido, usado y resultar atractivo para el usuario, cuando se usa bajo determinadas condiciones'),
(16, 'Fiabilidad', 'Capacidad de un sistema'),
(17, 'Seguridad', 'Capacidad de protección de la información y los datos de manera que personas o sistemas no autorizados no puedan leerlos o modificarlos'),
(18, 'Mantenibilidad', 'Esta característica representa la capacidad del producto software para ser modificado efectiva y eficientemente, debido a necesidades evolutivas, correctivas o perfectivas'),
(19, 'Portabilidad', 'Capacidad del producto o componente de ser transferido de forma efectiva y eficiente de un entorno hardware, software, operacional o de utilización a otro\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `id` int(11) NOT NULL,
  `pagina_id` int(11) NOT NULL,
  `width` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `height` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `top` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `left_position` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `source` varchar(300) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `icono`
--

CREATE TABLE `icono` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf16 COLLATE utf16_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `icono`
--

INSERT INTO `icono` (`id`, `nombre`, `direccion`, `descripcion`) VALUES
(1, 'Circulo', '1552960486', 'Es un círculo'),
(2, 'Triángulo', '1552960683', 'Es un triángulo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interfaz`
--

CREATE TABLE `interfaz` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo` int(11) NOT NULL,
  `detalle_tipo` text NOT NULL,
  `proceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `interfaz`
--

INSERT INTO `interfaz` (`id`, `nombre`, `descripcion`, `tipo`, `detalle_tipo`, `proceso`) VALUES
(2, 'Compras', 'se comunica con el proceso de compras', 1, 'automaticamente se realiza la comunicacion ', 2),
(11, 'Prueba', 'Interfaz de prueba', 2, '', 5),
(12, 'Prueba 1234', 'Descripción de la prueba denominada 1234', 1, '', 2),
(13, 'Interfaz Prueba', 'Descripción de prueba', 3, 'Detalle de prueba', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lienzos`
--

CREATE TABLE `lienzos` (
  `id` int(11) NOT NULL,
  `proceso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `normativa`
--

CREATE TABLE `normativa` (
  `idnormativa` int(11) NOT NULL,
  `idproceso` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `normativa`
--

INSERT INTO `normativa` (`idnormativa`, `idproceso`, `nombre`, `descripcion`) VALUES
(1, 5, 'ISO 29148', 'Ciclo de vida'),
(2, 7, 'Iso 25010', 'Es una norma, denominada ISO 25010, se tienen en cuenta los RNF'),
(3, 2, 'Norma Salud ', 'Resolución por medio de la cual se especifican los nombres de los procedimientos de salud que pueden ser realizados en Colombia.'),
(4, 3, 'Norma Prueba', 'Prueba - MerlinApp RNF'),
(5, 5, 'Iso 9001', 'Norma empleada en Calidad '),
(6, 5, 'Iso 9000', 'Norma empleada en calidad'),
(7, 5, 'Norma 15504', 'Se emplea para la mejora del proceso de Sw'),
(8, 5, '27000', 'Norma que habla acerca de la seguridad'),
(9, 5, 'Prueba', 'La descripción de la prueba'),
(10, 10, 'Normatividad ', 'La normatividad debe ser cumplida'),
(11, 11, 'Norma 9001', 'Esta descripción es una prueba'),
(12, 11, 'Norma 9001111', 'Norma de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE `paginas` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `lienzo_id` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paralelos`
--

CREATE TABLE `paralelos` (
  `proceso` int(11) NOT NULL,
  `paralelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paralelos`
--

INSERT INTO `paralelos` (`proceso`, `paralelo`) VALUES
(5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(10) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `id_sub_caracteristica` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `nombre`, `id_sub_caracteristica`) VALUES
(14, 'Tiempos de respuesta de consultas a base de datos, o estructuras de almacenamiento de datos, colecciones', 5),
(15, 'Tiempos de operaciones de guardado de datos, registros en estructuras de almacenamiento', 5),
(16, 'Cantidades de recursos utilizados durante procesos del sistema como por ejemplo: espacio en disco de los registros insertados, archivos de log, archivos de filesystem, nivel de paginación de memoria, nivel de canales y ancho de banda, procesador del ', 6),
(17, 'Para paràmetros del sistema, definir niveles mìnimo y màximo acorde a reglas del negocio (estos paràmetros muy posiblemente deban estar disponibles al administrador del sistema, para que pueda ser configurados de manera flexible buscando no quemarlos en la implementaciòn)', 7),
(18, ' Identificaciòn y medida de respuesta de los recursos compartidos con otros sistemas de información en los puntos de interfaz', 8),
(19, 'Identificación y buen uso de los datos de entrada a un componente interno o externo del sistema de información', 9),
(20, ' identificar paràmetros de aceptación del sistema de información, que se entiendan las funciones, es facil su uso, da los innformes que quiere, acceder facil a la informacion sin tantas vueltas, es rapido, compatible con el equipo de computo que lo van a utilizar, las pantallas son agradables', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `idproceso` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `prioridad` int(3) NOT NULL,
  `orden_secuencia` int(11) NOT NULL,
  `id_role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`idproceso`, `nombre`, `descripcion`, `prioridad`, `orden_secuencia`, `id_role`) VALUES
(2, 'reclutamiento de personal', 'agregar nuevo personal a la empresa', 1, 7, 1),
(3, 'comprar equipos', 'compra de dispositivos hardware', 3, 4, 1),
(5, 'consultar certificados', 'verificar estado financiero de los aspirantess', 2, 1, 1),
(7, 'comprar ups', 'compra para evitar que los equipos fallen cuando no hay energia', 1, 2, 7),
(9, 'depuración de actividades', 'verificar las actividades ', 1, 3, 1),
(10, 'repartir responsabilidades', 'asignar Roles y tareas a los integrantes del equipo ', 2, 4, 1),
(11, 'Prueba de Reporte PDF', 'Este proceso es una prueba', 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(10) NOT NULL,
  `id_pregunta` int(10) NOT NULL,
  `id_proceso` int(10) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `id_pregunta`, `id_proceso`, `descripcion`) VALUES
(1, 14, 5, 'aaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `idrole` int(11) NOT NULL,
  `encargado` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`nombre`, `descripcion`, `idrole`, `encargado`) VALUES
('Tester', 'Encargado de realizar las pruebas de caja negra y caja blanca', 1, 'Francy'),
('Product Owner', 'Comunica al equipo del proyecto con el cliente', 2, 'Laura'),
('Cliente', 'Este rol, da a conocer las necesidades de su organización', 6, 'asddddddd'),
('Tester', 'Realiza las pruebas de caja negra y caja blanca', 7, 'hhhh'),
('Desarrollador ', 'Realiza la codificación de las funcionalidades', 10, 'Pedro'),
('Analista', 'Persona que analiza los requerimientos y realiza especificación', 11, 'Juan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_negocio`
--

CREATE TABLE `rol_negocio` (
  `id_rol_negocio` int(11) NOT NULL,
  `nombre_rol_negocio` varchar(18) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `descripcion_rol_negocio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_negocio`
--

INSERT INTO `rol_negocio` (`id_rol_negocio`, `nombre_rol_negocio`, `descripcion_rol_negocio`) VALUES
(100, 'Diseñador', 'Diseña la app web'),
(101, 'Porfavor', 'Que'),
(102, 'AA', 'AA'),
(103, 'Tester', 'La persona que se encarga de probar los desarrollo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_caracteristica`
--

CREATE TABLE `sub_caracteristica` (
  `id_sub` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `id_caract` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sub_caracteristica`
--

INSERT INTO `sub_caracteristica` (`id_sub`, `nombre`, `descripcion`, `id_caract`) VALUES
(5, 'Comportamiento temporal', 'Los tiempos de respuesta y procesamiento y los ratios de throughput de un sistema cuando lleva a cabo sus funciones bajo condiciones determinadas en relación con un banco de pruebas (benchmark) establecido', 12),
(6, 'Utilización de recursos', 'Las cantidades y tipos de recursos utilizados cuando el software lleva a cabo su función bajo condiciones determinadas', 12),
(7, 'Capacidad', 'Grado en que los límites máximos de un parámetro de un producto o sistema software cumplen con los requisitos', 12),
(8, 'Coexistencia', 'Capacidad del producto para coexistir con otro software independiente, en un entorno común, compartiendo recursos comunes sin detrimento.', 13),
(9, 'Interoperabilidad', 'Capacidad de dos o más sistemas o componentes para intercambiar información y utilizar la información intercambiada', 13),
(10, 'Madurez', 'Capacidad del sistema para satisfacer las necesidades de fiabilidad en condiciones normales', 16),
(11, 'Disponibilidad', 'Capacidad del sistema o componente de estar operativo y accesible para su uso cuando se requiere', 16),
(12, 'Tolerancia a fallos', 'Capacidad del sistema o componente para operar según lo previsto en presencia de fallos hardware o software.', 16),
(13, 'Capacidad de recuperación', 'Capacidad del producto software para recuperar los datos directamente afectados y reestablecer el estado deseado del sistema en caso de interrupción o fallo', 16),
(14, 'A', 'A', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_interfaz`
--

CREATE TABLE `tipo_interfaz` (
  `id_tipo` int(10) NOT NULL,
  `nombre_interfaz` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_interfaz`
--

INSERT INTO `tipo_interfaz` (`id_tipo`, `nombre_interfaz`) VALUES
(1, 'Automatica'),
(2, 'Semiautomatica'),
(3, 'Manual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipousu` int(11) NOT NULL,
  `nombre_tipousu` varchar(20) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipousu`, `nombre_tipousu`) VALUES
(1, 'Administrador'),
(2, 'Elicitador'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `user_apellido` varchar(20) COLLATE utf8_bin NOT NULL,
  `user_email` varchar(40) COLLATE utf8_bin NOT NULL,
  `user_login` varchar(20) COLLATE utf8_bin NOT NULL,
  `user_password` varchar(40) COLLATE utf8_bin NOT NULL,
  `user_type` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`user_id`, `user_name`, `user_apellido`, `user_email`, `user_login`, `user_password`, `user_type`) VALUES
(1, 'Johan', 'Ordoñez', 'joan@unicauca.edu.co', 'johan', 'df7d3f6008e5ddbea40df09931b33007ee0d2ab5', '1'),
(3, 'proyecto', 'II', 'admin@rnf.com', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1'),
(4, 'Lucero', 'Cruz', 'luceroc@unicauca.edu.co', 'luceroC', '06b8abdc1bed263dcce2f8b6cde6c5189e61e582', '3'),
(5, 'alejandra', 'Tapia', 'alejandraTap@unicauca.edu.co', 'alejandraTp', '5563c629a6666d259e97e42b3ae5538ea402350f', '2'),
(6, 'Daniela', 'Jácome', 'danitpk@unicauca.edu.co', 'danitpk', '141f87be1330a105a87923f4ee6383bd7de46541', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristica`
--
ALTER TABLE `caracteristica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagina_id` (`pagina_id`);

--
-- Indices de la tabla `icono`
--
ALTER TABLE `icono`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `interfaz`
--
ALTER TABLE `interfaz`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lienzos`
--
ALTER TABLE `lienzos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proceso_id` (`proceso_id`);

--
-- Indices de la tabla `normativa`
--
ALTER TABLE `normativa`
  ADD PRIMARY KEY (`idnormativa`);

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lienzo_id` (`lienzo_id`);

--
-- Indices de la tabla `paralelos`
--
ALTER TABLE `paralelos`
  ADD PRIMARY KEY (`paralelo`,`proceso`) USING BTREE;

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`idproceso`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD UNIQUE KEY `idrole` (`idrole`);

--
-- Indices de la tabla `rol_negocio`
--
ALTER TABLE `rol_negocio`
  ADD PRIMARY KEY (`id_rol_negocio`);

--
-- Indices de la tabla `sub_caracteristica`
--
ALTER TABLE `sub_caracteristica`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indices de la tabla `tipo_interfaz`
--
ALTER TABLE `tipo_interfaz`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipousu`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristica`
--
ALTER TABLE `caracteristica`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `elementos`
--
ALTER TABLE `elementos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `icono`
--
ALTER TABLE `icono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `interfaz`
--
ALTER TABLE `interfaz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `lienzos`
--
ALTER TABLE `lienzos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `normativa`
--
ALTER TABLE `normativa`
  MODIFY `idnormativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rol_negocio`
--
ALTER TABLE `rol_negocio`
  MODIFY `id_rol_negocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de la tabla `sub_caracteristica`
--
ALTER TABLE `sub_caracteristica`
  MODIFY `id_sub` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipo_interfaz`
--
ALTER TABLE `tipo_interfaz`
  MODIFY `id_tipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD CONSTRAINT `elementos_ibfk_1` FOREIGN KEY (`pagina_id`) REFERENCES `paginas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lienzos`
--
ALTER TABLE `lienzos`
  ADD CONSTRAINT `lienzos_ibfk_1` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`idproceso`);

--
-- Filtros para la tabla `paginas`
--
ALTER TABLE `paginas`
  ADD CONSTRAINT `paginas_ibfk_1` FOREIGN KEY (`lienzo_id`) REFERENCES `lienzos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
