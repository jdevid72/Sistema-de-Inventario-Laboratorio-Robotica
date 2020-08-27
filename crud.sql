-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-08-2020 a las 20:25:20
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caracteristicas` text COLLATE utf8mb4_unicode_ci,
  `cantidad_total` bigint(20) NOT NULL,
  `cantidad_prestamo` bigint(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `imagen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materials`
--

INSERT INTO `materials` VALUES
(1, 'Node', 'PCI', '1 GB', 7, 5, '2020-08-26', 'backEnd/assets/img/material/1598549776.jpeg', '1'),
(2, 'Rasberry Pi', 'B+', '512 MB Sin Fuente EXterna', 10, 5, '2020-08-26', 'backEnd/assets/img/material/1598549803.jpeg', '1'),
(3, 'Servo', 'Metalico', '180°', 20, 0, '2020-08-26', 'backEnd/assets/img/material/1598549836.jpeg', '1'),
(4, 'Servo', 'Plastico', '90°', 10, 10, '2020-08-26', 'backEnd/assets/img/material/1598549852.jpeg', '1'),
(5, 'Arduino', 'Uno', '10 mB', 20, 20, '2020-08-26', 'backEnd/assets/img/material/1598549895.jpeg', '1'),
(6, 'Arduino', 'Nano', 'Sin Memoria', 25, 15, '2020-08-27', 'backEnd/assets/img/material/1598549916.jpeg', '1'),
(7, 'LET LCD', '2.5 volts', '3 Pines', 5, 5, '2020-08-26', 'backEnd/assets/img/material/1598549939.jpeg', '1'),
(8, 'Node', 'MCU', '10 MB', 9, 9, '2020-08-26', 'backEnd/assets/img/material/1598549959.jpeg', '1'),
(9, 'Sensor', 'MC78', 'Sonido', 7, 7, '2020-08-26', 'backEnd/assets/img/material/1598549976.jpeg', '1'),
(10, 'Sensor', 'OH2', 'Temperatura', 9, 9, '2020-08-26', 'backEnd/assets/img/material/1598549990.jpeg', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2020_04_07_150044_create_employees_table', 1),
(5, '2020_04_07_231347_create_suppliers_table', 1),
(6, '2020_04_08_144336_create_categories_table', 1),
(7, '2020_04_08_152147_create_products_table', 1),
(8, '2020_04_08_193128_create_expenses_table', 1),
(9, '2020_04_08_201634_create_salaries_table', 1),
(10, '2020_04_09_170109_create_customers_table', 1),
(11, '2020_04_11_165907_create_carts_table', 1),
(12, '2020_04_11_214224_create_orders_table', 1),
(13, '2020_04_11_214616_create_order_details_table', 1),
(14, '2020_08_24_085347_create_tipos_table', 1),
(15, '2020_08_24_112313_create_personas_table', 1),
(16, '2020_08_24_150816_create_materials_table', 1),
(17, '2020_08_24_232313_create_prestamos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_id` bigint(20) NOT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `telefono` bigint(20) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `perfil` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_respaldo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_respaldo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` VALUES
(1, 'José', 'Duran', '165465464', '45657654564', 1, 'Barrio Capital s/n', 63747747, '2020-08-26', 'backEnd/assets/img/perfiles/1598550759.jpeg', 'Jose', 63747747),
(2, 'David', 'Esscalante', '645635413', '54676513143', 3, 'Petrolero', 8765454654651, '1990-08-25', 'backEnd/assets/img/perfiles/1598550911.jpeg', 'Enrrique Esscalante', 789455354),
(3, 'antonio', 'garcia', '654654654', '646546547', 2, 'Barrio Santo Domingo', 76454654, '2019-06-25', 'backEnd/assets/img/perfiles/1598550922.jpeg', 'carmen garzia', 78464654354),
(8, 'juan', 'lopez', '78964654654', '7984465787', 2, 'Barrio Santo Domingo', 46846445564, '2019-06-25', 'backEnd/assets/img/perfiles/1598550936.jpeg', 'pedro garzia', 789465445),
(9, 'francisco', 'pimienta', '431234123', '12342354', 2, 'Barrio Santo Domingo', 5432534, '2019-06-25', 'backEnd/assets/img/perfiles/1598550957.jpeg', 'antonio rodriguez', 432545235),
(10, 'jose', 'jimenez', '46456', '111-185', 2, 'Barrio Santo Domingo', 36546354, '2019-06-25', 'backEnd/assets/img/perfiles/1598550977.jpeg', 'david navarro', 34534256),
(11, 'javier', 'diaz', '465446456', '111-789', 2, 'Barrio Santo Domingo', 756746, '2019-06-25', 'backEnd/assets/img/perfiles/1598550993.jpeg', 'alejandro serrano', 67547567),
(12, 'Sara', 'ruiz', '35324563', '222-789', 2, 'Barrio Santo Domingo', 56474564756, '2019-06-25', 'backEnd/assets/img/perfiles/1598551014.jpeg', 'angel gomez', 67567865),
(13, 'Marisol', 'zeballos', '7894651', '458-789', 2, 'San Pedro', 7456128, '2020-08-27', 'backEnd/assets/img/perfiles/1598551042.jpeg', 'don quijote', 7894561235879),
(14, 'Godoñes', 'padrino', '79845648', '155-785', 3, 'Don jose', 789654127, '2020-08-27', 'backEnd/assets/img/perfiles/1598550893.jpeg', 'quien sabe', 78541787);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `persona_id` bigint(20) NOT NULL,
  `material_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `cantidad_prestamo` bigint(20) DEFAULT NULL,
  `persona_idev` bigint(20) DEFAULT NULL,
  `fecha_prestamo` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` VALUES
(1, 1, 1, 1, 2, NULL, '2020-08-27', NULL, '1'),
(2, 1, 2, 1, 0, 3, '2020-08-26', '2020-08-15', '2'),
(3, 2, 7, 2, 2, NULL, '2020-08-21', NULL, '1'),
(4, 12, 8, 2, 5, NULL, '2020-08-15', NULL, '1'),
(5, 2, 6, 1, 0, 2, '2020-08-20', '2020-08-27', '2'),
(6, 8, 10, 2, 5, NULL, '2020-08-15', NULL, '1'),
(7, 8, 4, 1, 5, NULL, '2020-08-15', NULL, '1'),
(8, 9, 3, 1, 2, NULL, '2020-08-15', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` VALUES
(1, 'Docente'),
(2, 'Estudiante'),
(3, 'Practicante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` VALUES
(1, 'José Duran', 'jdevid72@gmail.com', NULL, '$2y$10$9RbfoU1s4DKEHn/hh9zxAOmdSDiEdqzebYcKS8F7IyhAOlqRVqB8q', NULL, '2020-08-26 09:02:43', '2020-08-26 09:02:43'),
(2, 'Enrique Iglesias', 'quiensabe@mail.com', NULL, '$2y$10$doSytiQzJx4PMf9j1.Pixe.F2rhxGvkyabFWbLhtIz/itg7EwJ2Fy', NULL, '2020-08-27 01:27:14', '2020-08-27 01:27:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personas_ci_unique` (`ci`),
  ADD UNIQUE KEY `personas_cu_unique` (`cu`),
  ADD UNIQUE KEY `personas_telefono_unique` (`telefono`),
  ADD UNIQUE KEY `personas_telefono_respaldo_unique` (`telefono_respaldo`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipos_descripcion_unique` (`descripcion`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
