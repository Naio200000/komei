-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2023 a las 17:53:52
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
-- Base de datos: `pii_komei`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `name`) VALUES
(1, 'semanal'),
(2, 'personas'),
(3, 'color'),
(4, 'material'),
(5, 'cantidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caraval_x_producto`
--

CREATE TABLE `caraval_x_producto` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `id_cate_valor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caraval_x_producto`
--

INSERT INTO `caraval_x_producto` (`id`, `id_producto`, `id_cate_valor`) VALUES
(33, 4, 7),
(34, 4, 19),
(37, 6, 11),
(38, 6, 19),
(43, 9, 17),
(44, 10, 8),
(45, 10, 18),
(46, 11, 11),
(47, 11, 18),
(48, 12, 9),
(49, 12, 16),
(52, 15, 11),
(53, 15, 19),
(60, 16, 1),
(61, 16, 26),
(66, 21, 9),
(67, 21, 27),
(78, 2, 2),
(79, 2, 21),
(80, 3, 3),
(81, 3, 21),
(82, 17, 2),
(83, 17, 26),
(84, 18, 3),
(85, 18, 26),
(100, 7, 11),
(101, 7, 13),
(102, 13, 11),
(103, 13, 12),
(104, 8, 7),
(105, 8, 14),
(106, 14, 1),
(107, 14, 21),
(108, 19, 2),
(109, 19, 21),
(110, 20, 3),
(111, 20, 21),
(112, 5, 10),
(113, 5, 15),
(126, 1, 1),
(127, 1, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `descript` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `name`, `descript`) VALUES
(1, 'clases', '    <p>\r\n      Sumérgete en el fascinante mundo del <strong>Iaido</strong>, un antiguo arte marcial japonés centrado en la precisión y la gracia en el manejo de la katana. Nuestras clases de Iaido ofrecen a los estudiantes la oportunidad de explorar la conexión entre mente, cuerpo y espada, desarrollando habilidades que van más allá de la destreza física. Guiados por instructores expertos, los participantes aprenderán las técnicas esenciales para desenvainar, cortar y volver a guardar la katana con elegancia y eficacia.\r\n    </p>\r\n    <p>\r\n      Las lecciones se centran no solo en el dominio técnico, sino también en la <em>disciplina mental</em>, la concentración y el respeto por la tradición. Únete a nosotros y descubre cómo el Iaido puede ser una vía única para el autodescubrimiento y el perfeccionamiento personal.\r\n    </p>\r\n'),
(2, 'ropa', '    <p>\r\n      En la disciplina del Iaido, la vestimenta juega un papel crucial, proporcionando comodidad, tradición y funcionalidad durante la práctica. Aquí describimos las prendas esenciales utilizadas en nuestras clases:\r\n    </p>\r\n\r\n    <p>\r\n      El <strong>dogi</strong> es la chaqueta tradicional japonesa que se usa en la práctica de Iaido. Fabricada generalmente en algodón resistente, el gi permite libertad de movimiento mientras mantiene una apariencia elegante. Su diseño se adapta a las exigencias del entrenamiento, brindando transpirabilidad y durabilidad.\r\n    </p>\r\n\r\n    <p>\r\n      Complementando el gi, el <strong>hakama</strong> es un pantalón tradicional japonés que se amarra alrededor de la cintura y se pliega de manera distintiva. Usado tanto por hombres como por mujeres, el hakama simboliza el nivel de habilidad del practicante y ofrece una capa adicional de dignidad a la práctica de Iaido.\r\n    </p>\r\n\r\n    <p>\r\n      El <strong>obi</strong> es el cinturón que se ata alrededor del gi para mantenerlo en su lugar y ajustar la prenda a la forma del cuerpo. Además de su función práctica, el obi es un elemento simbólico en la progresión del estudiante, reflejando su nivel de experiencia en la disciplina.\r\n    </p>\r\n'),
(3, 'equipos', '    <p>\r\n      La <strong>katana</strong> es la espada japonesa emblemática utilizada en las prácticas de Iaido. Con su hoja afilada y su diseño elegante, la katana es una obra maestra de artesanía que representa la tradición y la destreza. En nuestras clases, fomentamos el respeto y el cuidado adecuado de esta poderosa arma, enseñando a los estudiantes no solo a dominar las técnicas, sino también a apreciar la importancia cultural de la katana.\r\n    </p>\r\n\r\n    <p>\r\n      El <strong>iaito</strong> es una versión no afilada de la katana, diseñada específicamente para la práctica segura del Iaido. Aunque no tiene filo, mantiene el equilibrio y la apariencia auténtica de una katana real. Los estudiantes utilizan el iaito para perfeccionar sus movimientos sin el riesgo de lesiones, permitiendo un entrenamiento más intensivo y preciso.\r\n    </p>\r\n\r\n    <p>\r\n      Además de la katana, los <strong>bokkenes</strong> (espadas de madera) son herramientas esenciales en las clases de Iaido. Estas réplicas de madera imitan la forma y el peso de una katana, permitiendo a los estudiantes practicar técnicas de corte y bloqueo de manera segura. El uso del bokken promueve el control del cuerpo y la concentración, elementos fundamentales en el desarrollo de habilidades en Iaido.\r\n    </p>\r\n'),
(4, 'seminario', 'Seminarios anuales que se organizan por la escuela y se trae a diferentes Senseis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `id` int(10) UNSIGNED NOT NULL,
  `seminario` date DEFAULT NULL,
  `resto` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`id`, `seminario`, `resto`) VALUES
(1, '2024-05-01', NULL),
(2, NULL, '0'),
(3, NULL, '7'),
(4, NULL, '120'),
(5, NULL, '20'),
(6, NULL, '30'),
(7, NULL, '15'),
(12, NULL, '90'),
(13, NULL, '3'),
(14, NULL, '78'),
(28, NULL, '3423'),
(29, '2023-11-15', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_x_productos`
--

CREATE TABLE `imagenes_x_productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `id_imagen` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes_x_productos`
--

INSERT INTO `imagenes_x_productos` (`id`, `id_producto`, `id_imagen`) VALUES
(10, 4, 4),
(11, 4, 5),
(12, 4, 6),
(16, 6, 10),
(17, 6, 11),
(18, 6, 12),
(25, 9, 19),
(26, 9, 20),
(27, 9, 21),
(28, 10, 22),
(29, 10, 23),
(30, 10, 12),
(31, 11, 25),
(32, 11, 26),
(33, 11, 6),
(34, 12, 28),
(35, 12, 29),
(36, 12, 30),
(43, 15, 31),
(44, 15, 32),
(45, 15, 6),
(46, 16, 1),
(47, 16, 2),
(48, 16, 3),
(61, 21, 34),
(62, 21, 35),
(63, 21, 36),
(79, 2, 2),
(80, 2, 3),
(81, 2, 42),
(82, 3, 2),
(83, 3, 3),
(84, 3, 43),
(85, 17, 2),
(86, 17, 3),
(87, 17, 41),
(88, 18, 2),
(89, 18, 3),
(90, 18, 40),
(113, 7, 13),
(114, 7, 49),
(115, 7, 50),
(116, 13, 13),
(117, 13, 49),
(118, 13, 50),
(119, 8, 16),
(120, 8, 49),
(121, 8, 50),
(122, 14, 44),
(123, 14, 47),
(124, 14, 48),
(125, 19, 45),
(126, 19, 47),
(127, 19, 48),
(128, 20, 46),
(129, 20, 47),
(130, 20, 48),
(131, 5, 7),
(132, 5, 8),
(133, 5, 51),
(147, 1, 1),
(148, 1, 2),
(149, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `descript` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `name`, `descript`) VALUES
(1, '1700593128', 'Banner de 1 clase personal de Iaido'),
(2, '1700660093', 'Baner de clases de Iaido'),
(3, '1700660164', 'Segundo Banner de clases de Iaido'),
(4, '1700594250', 'Chaqueta azul de entrenamiento'),
(5, 'keikogi-a-02', 'Chaqueta azul de entrenamiento'),
(6, 'keikogi-03', 'Planilla de tamaños de las chaquetas'),
(7, 'obi-c-01', 'Cinturon de entrenamiento'),
(8, 'obi-c-02', 'Cinturon de entrenamiento'),
(10, 'hakama-01', 'Persona usando Hakama de entrenamiento'),
(11, 'hakama-02', 'Hakama de entrenamiento'),
(12, 'hakama-03', 'Planilla de tamanños de las Hakamas'),
(13, 'katana-01', 'Banner mostrando partes de un Shinken'),
(16, 'iaito-01', '4 Iaitos de diversos colores'),
(19, 'bokuto-01', 'Bokkuto con Saya'),
(20, 'bokuto-02', '3 Bokkutos con Sayas'),
(21, 'bokuto-03', 'Bokkuto con Saya'),
(22, 'hakama-gala-01', 'Persona usando Hakama de gala'),
(23, 'hakama-gala-02', 'Hakama de Gala'),
(25, 'montsuki-01', 'Persona usando un Montsuki negro para galas'),
(26, 'montsuki-02', 'Montuski negro'),
(28, 'setta-01', 'Persona usando un Setta'),
(29, 'setta-02', 'Setta de Igusa'),
(30, 'setta-03', 'Setta con tiras blancas'),
(31, 'keikogi-n-01', 'Chaqueta negra de entrenamiento'),
(32, 'keikogi-n-02', 'Chaqueta negra de entrenamiento'),
(34, 'obi-01', 'Cinturon de entrenamiento'),
(35, 'obi-02', 'Cinturon de entrenamiento'),
(36, 'obi-03', 'Cinturon de entrenamiento'),
(40, '1700660207', 'Banner de 3 clases personales de Iaido'),
(41, '1700660039', 'Banner de 2 clases personales de Iaido'),
(42, '1700660241', 'Banner de 2 clase grupales de Iaido'),
(43, '1700660285', 'Banner de 3 clases personales de Iaido'),
(44, '1700660324', 'Banner de 1 clase de Seminario de Iaido'),
(45, '1700660346', 'Banner de 2 clases de Seminario de Iaido'),
(46, '1700660363', 'Banner de 3 clases de Seminario de Iaido'),
(47, '1700660387', 'Banner de Seminario Komei Juku de Iaido'),
(48, '1700660398', 'Banner de Seminario Komei Juku de Iaido'),
(49, '1700660784', 'Katana sobre un fondo oscuro'),
(50, '1700660964', 'Katana sobre un fondo blanco'),
(51, '1700709418', 'Obi de ceda con patron de nubes.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `links_validos`
--

CREATE TABLE `links_validos` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `links_validos`
--

INSERT INTO `links_validos` (`id`, `link`, `title`) VALUES
(1, 'home', 'Bienvenidos'),
(2, 'nosotros', 'Contactate con nuestros Dojos'),
(3, 'tienda', 'Nuestro catalogo de Productos'),
(4, 'item', 'Producto seleccionado'),
(5, 'rtaForm', 'Gracias por Comunicarte'),
(6, 'dojos', 'Contactate con nuestros Dojos'),
(7, 'dash', 'Panel de Control'),
(8, 'categoria', 'Lista de Categorias de Productos'),
(9, 'tipo', 'Lista de Tipos de Productos'),
(10, 'producto', 'Lista de los Productos'),
(11, 'abm-categoria', 'ABM de las categorias de Producto'),
(12, 'abm-tipo', 'ABM de los Tipos de Producto'),
(13, 'caraval', 'Lista de las caracteristicas y sus valores'),
(14, 'abm-caraval', 'ABM de las caracteristicas y sus valores'),
(15, 'abm-caracteristica', 'ABM de las caracteristicas'),
(16, 'abm-valor', 'ABM de los valores '),
(17, 'abm-imagenes', 'ABM de Imagenes'),
(18, 'imagenes', 'Lista de Todas las imagenes'),
(19, 'producto', 'Lista de Todos los productos'),
(20, 'abm-producto', 'ABM de los productos'),
(21, 'login', 'Inicie sesion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `descript` text NOT NULL,
  `id_tipo` int(10) UNSIGNED NOT NULL,
  `precio` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `name`, `descript`, `id_tipo`, `precio`) VALUES
(1, '1 Clase grupal', 'Disfruta de una clase por semana en los días que prefieras    ;     Te invitamos a participar una clase semanal para el uso de la <span lang=\'ja\'>katana</span> japonesa (esgrima samurai). En la misma podrás ver los fundamentos básicos de uso de la katana japonés. Todo el material lo provee el dojo, solo necesitas ropa cómoda.', 1, 7000.00),
(2, '2 Clase grupal', 'Disfruta de dos clase por semana en los días que prefieras; Te invitamos a participar dos clase semanal para el uso de la <span lang=\'ja\'>katana</span> japonesa (esgrima samurai). En la misma podrás ver los fundamentos básicos de uso de la katana japonés. Todo el material lo provee el dojo, solo necesitas ropa cómoda.', 1, 8000.00),
(3, '3 Clase grupal', 'Disfruta de tres clase por semana en los días que prefieras; Te invitamos a participar una clase semanal para el uso de la <span lang=\'ja\'>katana</span> japonesa (esgrima samurai). En la misma podrás ver los fundamentos básicos de uso de la katana japonés. Todo el material lo provee el dojo, solo necesitas ropa cómoda.', 1, 9000.00),
(4, 'Iaidogi Azul', 'Keikogi para entrenamiento, 100% Tetron; Elaborado en tetron: 65% poliéster +35% rayon, esta chaqueta está especialmente diseñada para la práctica de iaido. No achica, no pierde color y es fácil de mantener.', 3, 5000.00),
(5, 'Obi de Ceda', 'Elegante Cintuon de Ceda ;  Elaborado en ceda de alta calidad con dimenciones de 15cm de ancho y 4 metros de largo', 4, 5000.00),
(6, 'Hakama', 'Hakama para entrenamiento, 100% Tetron; Excelentes hakamas de tetrón para el entrenamiento de <span lang=\'ja\'>iaido, kendo, aikido</span> y demas artes marciales. Tela antiarrugas con una composición de 65% poliester y 35% de rayón que asegura la permanencia de las tablas sin mayor esfuerzo de planchado. Elaboradas a mano y cosidas individualmente.', 5, 6000.00),
(7, 'Shinken Premuim', 'Katana de entenamiento con filo, Hecha en acero 1095; Una katanas hechas de manera tradicional es <span lang=\'ja\'>nihonto</span> (literalmente \'espada japonesa\'). forjada a partir de acero <span lang=\'ja\'>tamahagane</span>.', 6, 60000.00),
(8, 'Iaito', 'Katana de entenamiento sin filo, hecha dealeacion de Aluminio; Una katanas hechas de manera moderna es <span lang=\'ja\'>mugito</span> (literalmente \'espada de exhhibición). forjada a partir de una aleación de aluminio.', 7, 45000.00),
(9, 'Bokuto', 'Katana de madera para entrenamiento, con saya de plastico; Una katanas hechas de madera es <span lang=\'ja\'>bokuto</span> (literalmente \'espada de madera). tallada en diversas maderas para mejorar su relación con el peso', 8, 20000.00),
(10, 'Hakama de Gala', 'Hakama para exibicion, 100% Lana; Excelentes hakamas de Lana para seremoñas o exibiciones de <span lang=\'ja\'>iaido, aikido</span> y demas artes marciales. 100% Hilos de lana Mercerizada con un patron a rayas. Elaboradas a mano y cosidas individualmente.', 5, 14000.00),
(11, 'Montsuki', 'Kimono de Gala, 100% Lana; Excelentes Kimono de Lana para seremoñas o exibiciones de <span lang=\'ja\'>iaido, aikido</span> y demas artes marciales. 100% Lana con interior de Ceda . Elaboradas a mano y cosidas individualmente.', 3, 17000.00),
(12, 'Setta', 'Sandalia de Igusa y Algodón; <span lang=\'ja\'>Setta</span> es una fina y elegante sandalia japonesa hecha de Igusa, una planta utilizada para hacer tatamis tradicionales, y una tira de algodón mullido', 9, 8000.00),
(13, 'Shinken', 'Katana de entenamiento con filo, Hecha en acero 1060; Una katana hecah de manera industrial con acero de alta calidad. LLevada a filo de navaja.', 6, 45000.00),
(14, '1 clase de Seminario', 'Disfruta de 1 clase en nuestro seminario anual con Sekiguchi Sensei; Te invitamos a participar una clase de nuestro seminario de 3 dias con Sekiguchi Sensei, que nos visita una vez al año. Recivimos a Sensei con una gran seminario.', 10, 12000.00),
(15, 'Iaidogi Negro', 'Keikogi para entrenamiento, 100% Tetron; Elaborado en tetron: 65% poliéster +35% rayon, esta chaqueta está especialmente diseñada para la práctica de iaido. No achica, no pierde color y es fácil de mantener.', 3, 5000.00),
(16, '1 Clase personal', 'Disfruta clase personal una vez por semana en los días que prefieras; Te invitamos a participar de 1 clase personales por semana para aprender el uso de la <span lang=\'ja\'>katana</span> japonesa (esgrima samurai). En la misma podrás ver los fundamentos básicos de uso de la katana japonés. Todo el material lo provee el dojo, solo necesitas ropa cómoda.', 1, 9000.00),
(17, '2 Clases personales', 'Disfruta de 2 clases personales por semana en los días que prefieras; Te invitamos a participar de 3 clases personales por semana para aprender el uso de la <span lang=\'ja\'>katana</span> japonesa (esgrima samurai). En la misma podrás ver los fundamentos básicos de uso de la katana japonés. Todo el material lo provee el dojo, solo necesitas ropa cómoda.', 1, 11000.00),
(18, '3 Clases personales', 'Disfruta de 3 clase personales por semana en los días que prefieras; Te invitamos a participar de 3 clases personales por semana para aprender el uso de la <span lang=\'ja\'>katana</span> japonesa (esgrima samurai). En la misma podrás ver los fundamentos básicos de uso de la katana japonés. Todo el material lo provee el dojo, solo necesitas ropa cómoda.', 1, 13000.00),
(19, '2 clases de Seminario', 'Disfruta de 2 clase en nuestro seminario anual con Sekiguchi Sensei; Te invitamos a participar de 2 clases de nuestro seminario de 3 dias con Sekiguchi Sensei, que nos visita una vez al año. Recivimos a Sensei con una gran seminario.', 10, 20000.00),
(20, '3 clases de Seminario', 'Disfruta de 3 clases en nuestro seminario anual con Sekiguchi Sensei; Te invitamos a participar de nuestro seminario completo de 3 dias con Sekiguchi Sensei, que nos visita una vez al año. Recivimos a Sensei con una gran seminario.', 10, 25000.00),
(21, 'Obi de algodón', 'Cituron de entrenamiento, 100% Algodón; Elaborado en gabardina de 8 oz, posee una dimensión de 9 cm de ancho y 4 metros de largo.', 4, 3000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `roles` enum('usuario','admin','superadmin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `roles`) VALUES
(1, 'usuario'),
(2, 'admin'),
(3, 'superadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `descript` text DEFAULT NULL,
  `id_disponible` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `name`, `descript`, `id_disponible`) VALUES
(1, 'Clase', NULL, 2),
(3, 'Dogi', NULL, 7),
(4, 'Obi', NULL, 3),
(5, 'Hakama', '', 5),
(6, 'Shinken', NULL, 4),
(7, 'Iaito', NULL, 4),
(8, 'Bokkuto', NULL, 6),
(9, 'Calzado', '', 5),
(10, 'Seminario', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_x_categorias`
--

CREATE TABLE `tipo_x_categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tipo` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_x_categorias`
--

INSERT INTO `tipo_x_categorias` (`id`, `id_tipo`, `id_categoria`) VALUES
(2, 10, 4),
(3, 3, 2),
(4, 4, 2),
(5, 5, 2),
(6, 6, 3),
(7, 7, 3),
(8, 8, 3),
(9, 9, 2),
(21, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(256) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rol` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `full_name`, `username`, `email`, `password`, `rol`) VALUES
(1, 'Nicolas Alsinet', 'nalsinet_sa', 'nicolas.alsinet@davinci.edu.ar', '$2y$10$nz31V64TQjmQjczlS0eB9.6lgtQpmIjiA5sKKMLKszmhUthrX9C/a', 3),
(2, 'Nicolas Alsinet', 'nalsinet_a', 'nicolas.alsinet@davinci.edu.ar', '$2y$10$nz31V64TQjmQjczlS0eB9.6lgtQpmIjiA5sKKMLKszmhUthrX9C/a', 2),
(3, 'Nicolas Alsinet', 'nalsinet_u', 'nicolas.alsinet@davinci.edu.ar', '$2y$10$nz31V64TQjmQjczlS0eB9.6lgtQpmIjiA5sKKMLKszmhUthrX9C/a', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores`
--

CREATE TABLE `valores` (
  `id` int(10) UNSIGNED NOT NULL,
  `valor` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valores`
--

INSERT INTO `valores` (`id`, `valor`) VALUES
(11, '1'),
(12, '2'),
(13, '3'),
(14, '1 Clase'),
(15, '2 Clases'),
(16, '3 Clases'),
(17, 'personal'),
(18, 'grupal'),
(19, 'azul'),
(20, 'negro'),
(21, 'rayada'),
(22, 'gris'),
(23, 'blanco'),
(24, 'algodon'),
(25, 'tetron'),
(26, 'acero1060'),
(27, 'acero1095'),
(28, 'igusa'),
(29, 'lana'),
(30, 'incienso'),
(31, 'aluminio'),
(32, 'ceda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_x_caracteristica`
--

CREATE TABLE `valor_x_caracteristica` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_caracteristica` int(10) UNSIGNED NOT NULL,
  `id_valor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valor_x_caracteristica`
--

INSERT INTO `valor_x_caracteristica` (`id`, `id_caracteristica`, `id_valor`) VALUES
(1, 1, 11),
(2, 1, 12),
(3, 1, 13),
(4, 5, 14),
(5, 5, 15),
(6, 5, 16),
(7, 3, 19),
(8, 3, 21),
(9, 3, 23),
(10, 3, 22),
(11, 3, 20),
(12, 4, 26),
(13, 4, 27),
(14, 4, 31),
(15, 4, 32),
(16, 4, 28),
(17, 4, 30),
(18, 4, 29),
(19, 4, 25),
(21, 2, 18),
(26, 2, 17),
(27, 4, 24);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caraval_x_producto`
--
ALTER TABLE `caraval_x_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cate_valor` (`id_cate_valor`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes_x_productos`
--
ALTER TABLE `imagenes_x_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_imagen` (`id_imagen`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `links_validos`
--
ALTER TABLE `links_validos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_tipo_2` (`id_tipo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_disponible` (`id_disponible`);

--
-- Indices de la tabla `tipo_x_categorias`
--
ALTER TABLE `tipo_x_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`rol`);

--
-- Indices de la tabla `valores`
--
ALTER TABLE `valores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valor_x_caracteristica`
--
ALTER TABLE `valor_x_caracteristica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_caracteristica` (`id_caracteristica`),
  ADD KEY `id_valor` (`id_valor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `caraval_x_producto`
--
ALTER TABLE `caraval_x_producto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `imagenes_x_productos`
--
ALTER TABLE `imagenes_x_productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `links_validos`
--
ALTER TABLE `links_validos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `tipo_x_categorias`
--
ALTER TABLE `tipo_x_categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `valores`
--
ALTER TABLE `valores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `valor_x_caracteristica`
--
ALTER TABLE `valor_x_caracteristica`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caraval_x_producto`
--
ALTER TABLE `caraval_x_producto`
  ADD CONSTRAINT `caraval_x_producto_ibfk_2` FOREIGN KEY (`id_cate_valor`) REFERENCES `valor_x_caracteristica` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `caraval_x_producto_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes_x_productos`
--
ALTER TABLE `imagenes_x_productos`
  ADD CONSTRAINT `imagenes_x_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `imagenes_x_productos_ibfk_2` FOREIGN KEY (`id_imagen`) REFERENCES `images` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD CONSTRAINT `tipos_ibfk_1` FOREIGN KEY (`id_disponible`) REFERENCES `disponibilidad` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipo_x_categorias`
--
ALTER TABLE `tipo_x_categorias`
  ADD CONSTRAINT `tipo_x_categorias_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_x_categorias_ibfk_3` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `valor_x_caracteristica`
--
ALTER TABLE `valor_x_caracteristica`
  ADD CONSTRAINT `valor_x_caracteristica_ibfk_1` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristicas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `valor_x_caracteristica_ibfk_2` FOREIGN KEY (`id_valor`) REFERENCES `valores` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
