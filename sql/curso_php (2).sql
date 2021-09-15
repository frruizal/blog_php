-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2021 a las 21:23:46
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curso_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `activo`) VALUES
(1, 'Deportes', 1),
(2, 'Local', 1),
(3, 'Hiberus', 1),
(4, 'Economia', 0),
(5, 'Internacional', 0),
(6, 'Animales', 1),
(20, 'Tecnología', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `contenido` text NOT NULL,
  `fechaPublicacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `idCategoria`, `autor`, `contenido`, `fechaPublicacion`) VALUES
(1, 'Fichaje de Messi', 1, 'Marca', 'Messi ficha por el PSG', '2021-08-05 09:24:38'),
(2, 'Final de Champions', 1, 'Sport', 'El Chelsea gana la final de la champions', '2021-08-08 09:11:20'),
(3, 'Hiberus Tecnología', 3, 'Hiberus', 'Es difícil encontrar una compañía como Hiberus.\r\nNos caracteriza nuestra apuesta por la especialización y la gestión de talento. Con una orientación innata a que nuestros proyectos sean innovadores y orientados desde el primer momento a convertirse en productos y en nuevas áreas de negocio o incluso empresas. Cada área/empresas está especializada en un servicio o producto innovador. Hasta hoy, hemos creado más de 38 áreas de competencia que en Hiberus reciben el nombre de Hiberus Business Units integradas en 6 áreas de negocio que reciben el nombre de Hiberus Management Areas', '2021-07-29 20:48:46'),
(4, 'Digital', 3, 'Hiberus', 'La aparición de nuevos negocios digitales ha revolucionado completamente el mundo IT con nuevas plataformas y formas de conceptualizar productos digitales que no existían hasta hace poco tiempo. Además, los clientes se han vuelto más exigentes ante la amplia oferta existente en el mercado y debemos ser capaces de crear nuevas experiencias que les acompañen de principio a fin.', '2021-07-29 20:48:46'),
(5, 'Soluciones', 3, 'Hiberus Soluciones', 'El éxito en la sociedad digital actual comienza por situar a la tecnología y a los equipos al frente de las organizaciones, utilizando el software como empuje para cubrir todas sus necesidades. Esto permitirá a las empresas ofrecer mejores experiencias a los clientes, con mayor agilidad y con mayor calidad.', '2021-07-29 20:50:45'),
(6, 'Sistemas', 3, 'Hiberus', 'Hiberus  Sistemas es una empresa transversal a todo IT. Ayudamos a tu compañía a alcanzar sus objetivos de negocio manteniéndola al día de los últimos avances tecnológicos que puedan añadir valor. Podrás sacar el máximo partido de tus inversiones en tecnología confiando en nuestros expertos', '2021-07-29 20:50:45'),
(18, 'CMS', 3, 'Francisco', 'Drupal\r\nMagento', '2021-08-08 09:04:28'),
(21, 'Curso PHP', 3, 'Hiberus university', 'Curso PHP de la Hiberus University', '2021-08-08 09:11:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `fecha_sesion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `pass`, `fecha_sesion`) VALUES
(1, 'fruizalejos', '6ee97d40a4d09d35d33280ee9f764445a6963300', '2021-08-08 21:04:14'),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2021-08-08 10:35:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`idCategoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
