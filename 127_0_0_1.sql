-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-03-2024 a las 10:48:14
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `turnos`
--
CREATE DATABASE IF NOT EXISTS `turnos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `turnos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accused`
--

DROP TABLE IF EXISTS `accused`;
CREATE TABLE IF NOT EXISTS `accused` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint UNSIGNED NOT NULL,
  `people_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accused_ticket_id_index` (`ticket_id`),
  KEY `accused_people_id_index` (`people_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `accused`
--

INSERT INTO `accused` (`id`, `ticket_id`, `people_id`, `created_at`, `updated_at`) VALUES
(1, 26, 2, '2024-03-05 01:24:27', '2024-03-05 01:24:27'),
(2, 27, 3, '2024-03-05 02:29:15', '2024-03-05 02:29:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finish_reasons`
--

DROP TABLE IF EXISTS `finish_reasons`;
CREATE TABLE IF NOT EXISTS `finish_reasons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `finish_reasons`
--

INSERT INTO `finish_reasons` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Libertad Plena', '', 1, '2023-09-04 20:31:33', '2023-09-04 20:31:33', NULL),
(2, 'Medida Cautelar Sustitutiva de Libertad', '', 1, '2023-09-04 20:31:51', '2023-09-04 20:31:51', NULL),
(3, 'Diferimiento', '', 1, '2023-09-04 20:32:01', '2023-09-04 20:32:01', NULL),
(4, 'Auto de Apertura de Juicio', '', 1, '2023-09-04 20:32:16', '2023-09-04 20:32:16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(45, '2014_10_12_000000_create_users_table', 1),
(46, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(47, '2014_10_12_100000_create_password_resets_table', 1),
(48, '2019_08_19_000000_create_failed_jobs_table', 1),
(49, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(50, '2023_07_31_131947_create_permission_tables', 1),
(51, '2023_08_02_112703_create_offices_table', 1),
(52, '2023_08_02_165301_create_people_table', 1),
(53, '2023_08_03_123144_create_reasons_table', 1),
(54, '2023_08_03_175046_create_finish_reasons_table', 1),
(55, '2023_08_03_234541_create_tickets_table', 1),
(56, '2023_10_14_163909_add_prosecutor_to_office_table', 2),
(57, '2023_10_15_105819_add_prosecutors_fields_to_people_table', 3),
(58, '2023_10_15_124134_add_prosecutor_field_to_tickets_table', 4),
(59, '2023_10_15_202358_change_type_field_to_offices_table', 5),
(60, '2023_10_13_085512_create_accused_table', 6),
(61, '2023_10_13_152156_change_people_id_to_tickets_table', 7),
(62, '2023_09_22_100106_add_finish_comment_to_tickets_table', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(6, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9),
(4, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 12),
(4, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 16),
(4, 'App\\Models\\User', 17),
(4, 'App\\Models\\User', 18),
(4, 'App\\Models\\User', 19),
(4, 'App\\Models\\User', 20),
(4, 'App\\Models\\User', 21),
(4, 'App\\Models\\User', 22),
(4, 'App\\Models\\User', 23),
(4, 'App\\Models\\User', 24),
(4, 'App\\Models\\User', 25),
(4, 'App\\Models\\User', 26),
(4, 'App\\Models\\User', 27),
(4, 'App\\Models\\User', 28),
(4, 'App\\Models\\User', 29),
(4, 'App\\Models\\User', 30),
(4, 'App\\Models\\User', 31),
(4, 'App\\Models\\User', 32),
(4, 'App\\Models\\User', 33),
(4, 'App\\Models\\User', 34),
(4, 'App\\Models\\User', 35),
(4, 'App\\Models\\User', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offices`
--

DROP TABLE IF EXISTS `offices`;
CREATE TABLE IF NOT EXISTS `offices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Defines office type: 1 => control, 2 => juridico',
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `prosecutor` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  UNIQUE KEY `offices_name_unique` (`name`),
  KEY `offices_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `offices`
--

INSERT INTO `offices` (`id`, `name`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`, `prosecutor`) VALUES
(1, 'Control-1', '1', 1, NULL, NULL, NULL, 'N'),
(2, 'Control-2', '1', 1, NULL, NULL, NULL, 'N'),
(3, 'Control-3', '1', 1, NULL, NULL, NULL, 'N'),
(4, 'Control-4', '1', 1, NULL, NULL, NULL, 'N'),
(5, 'Control-5', '1', 1, NULL, NULL, NULL, 'N'),
(6, 'Control-6', '1', 1, NULL, NULL, NULL, 'N'),
(7, 'Control-7', '1', 1, NULL, NULL, NULL, 'N'),
(8, 'Control-8', '1', 1, NULL, NULL, NULL, 'N'),
(9, 'Control-9', '1', 1, NULL, NULL, NULL, 'N'),
(10, 'Control-10', '1', 1, NULL, NULL, NULL, 'N'),
(11, 'Control-11', '1', 1, NULL, NULL, NULL, 'N'),
(12, 'TPM-3', '1', 1, NULL, '2023-09-14 15:00:44', NULL, 'N'),
(13, 'TPM-5', '1', 1, NULL, '2023-09-14 15:00:58', NULL, 'N'),
(14, 'Juicio-4', '1', 1, '2023-09-14 13:31:04', '2023-09-14 13:31:04', NULL, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('M','F') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `people_type` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_card` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prosecutor` enum('S','N') COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `prosecutor_office` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `people_name_index` (`name`),
  KEY `people_lastname_index` (`lastname`),
  KEY `people_people_type_index` (`people_type`),
  KEY `people_id_card_index` (`id_card`),
  KEY `people_prosecutor_office_index` (`prosecutor_office`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`id`, `name`, `lastname`, `gender`, `people_type`, `id_card`, `address`, `status`, `deleted_at`, `created_at`, `updated_at`, `prosecutor`, `prosecutor_office`) VALUES
(1, 'PEDRO', 'PEREZ', 'M', 'INPRE', '123456789', '6666', 1, NULL, '2023-09-04 22:10:12', '2023-09-04 22:10:12', 'N', NULL),
(2, 'Maria', 'Peña', 'F', 'INPRE', '123456666', 'edfgdf', 1, NULL, '2023-09-04 22:34:08', '2023-09-04 22:34:08', 'N', NULL),
(3, 'Mariano', 'Rivera', 'M', 'INPRE', '11111111', 'aaa', 1, NULL, '2023-09-04 22:40:57', '2023-09-04 22:40:57', 'N', NULL),
(4, 'Curt', 'Schilling', 'M', 'INPRE', '22222', '2222', 1, NULL, '2023-09-04 22:41:29', '2023-09-04 22:41:29', 'N', NULL),
(5, 'Pedro', 'Martinez', 'M', 'INPRE', '333333', 'dddd', 1, NULL, '2023-09-04 22:42:02', '2023-09-04 22:42:02', 'N', NULL),
(6, 'Pedro', 'Marquez', 'M', 'INPRE', '1111', 'fgvgfgg', 1, NULL, '2023-09-04 22:54:04', '2023-09-04 22:54:04', 'N', NULL),
(7, 'Sebastian', 'Rojas', 'M', 'INPRE', '3333333', 'asdasd', 1, NULL, '2023-09-05 14:02:06', '2023-09-05 14:02:06', 'N', NULL),
(8, 'Maria', 'Bermudez', 'F', 'INPRE', '44444', 'ddfg', 1, NULL, '2023-09-05 14:02:43', '2023-09-05 14:02:43', 'N', NULL),
(9, 'Paola', 'Manrique', 'F', 'INPRE', '999999', 'dfgdfg', 1, NULL, '2023-09-05 14:03:21', '2023-09-05 14:03:21', 'N', NULL),
(10, 'Teresa', 'Muñoz', 'F', 'INPRE', '666666', 'fghfgh', 1, NULL, '2023-09-05 14:03:47', '2023-09-05 14:03:47', 'N', NULL),
(11, 'Vanessa', 'Millan', 'F', 'INPRE', '5555555', 'ggg', 1, NULL, '2023-09-05 14:04:31', '2023-09-05 14:04:31', 'N', NULL),
(12, 'Briseida', 'Hernandez', 'F', 'INPRE', '00000', 'gggg', 1, NULL, '2023-09-05 14:05:08', '2023-09-05 14:05:08', 'N', NULL),
(13, 'CARLOS', 'GUANCHEZ', 'M', 'INPRE', '20232023', 'GGG', 1, NULL, '2023-09-05 19:16:02', '2023-09-05 19:16:02', 'N', NULL),
(14, 'JULIO', 'PADRON', 'M', 'INPRE', '20292029', 'FF', 1, NULL, '2023-09-05 19:16:38', '2023-09-05 19:16:38', 'N', NULL),
(15, 'HINGRID', 'PANTOJA', 'F', 'INPRE', '301671', 'VALENCIA', 1, NULL, '2023-09-11 14:44:34', '2023-09-11 14:44:34', 'N', NULL),
(16, 'ESTEBAN ', 'JEREZ', 'M', 'INPRE', '231904', 'GUIGUE, MUNICIPIO CARLOS ARVELO ', 1, NULL, '2023-09-11 14:46:28', '2023-09-11 14:46:28', 'N', NULL),
(17, 'JOSE', 'GUERRA', 'M', 'V', '17031766', 'MUNICIPIO VALENCIA', 1, NULL, '2023-09-11 15:01:33', '2023-09-11 15:01:33', 'N', NULL),
(18, 'LUIS ', 'RANGEL', 'M', 'INPRE', '250461', 'MUNICIPIO CARLOS ARVELO', 1, NULL, '2023-09-11 15:04:48', '2023-09-11 15:04:48', 'N', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `module`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'finish-reason-list', 'Motivo de finalizacion', 'web', '2023-09-04 19:16:11', '2023-09-04 19:16:11'),
(2, 'finish-reason-create', 'Motivo de finalizacion', 'web', '2023-09-04 19:16:11', '2023-09-04 19:16:11'),
(3, 'finish-reason-read', 'Motivo de finalizacion', 'web', '2023-09-04 19:16:11', '2023-09-04 19:16:11'),
(4, 'finish-reason-update', 'Motivo de finalizacion', 'web', '2023-09-04 19:16:11', '2023-09-04 19:16:11'),
(5, 'finish-reason-delete', 'Motivo de finalizacion', 'web', '2023-09-04 19:16:11', '2023-09-04 19:16:11'),
(6, 'offices-list', 'Oficinas', 'web', '2023-09-04 19:16:25', '2023-09-04 19:16:25'),
(7, 'offices-create', 'Oficinas', 'web', '2023-09-04 19:16:25', '2023-09-04 19:16:25'),
(8, 'offices-read', 'Oficinas', 'web', '2023-09-04 19:16:25', '2023-09-04 19:16:25'),
(9, 'offices-update', 'Oficinas', 'web', '2023-09-04 19:16:25', '2023-09-04 19:16:25'),
(10, 'offices-delete', 'Oficinas', 'web', '2023-09-04 19:16:25', '2023-09-04 19:16:25'),
(11, 'people-list', 'Personas', 'web', '2023-09-04 19:16:35', '2023-09-04 19:16:35'),
(12, 'people-create', 'Personas', 'web', '2023-09-04 19:16:35', '2023-09-04 19:16:35'),
(13, 'people-read', 'Personas', 'web', '2023-09-04 19:16:35', '2023-09-04 19:16:35'),
(14, 'people-update', 'Personas', 'web', '2023-09-04 19:16:35', '2023-09-04 19:16:35'),
(15, 'people-delete', 'Personas', 'web', '2023-09-04 19:16:35', '2023-09-04 19:16:35'),
(16, 'reason-list', 'Motivos', 'web', '2023-09-04 19:16:43', '2023-09-04 19:16:43'),
(17, 'reason-create', 'Motivos', 'web', '2023-09-04 19:16:43', '2023-09-04 19:16:43'),
(18, 'reason-read', 'Motivos', 'web', '2023-09-04 19:16:43', '2023-09-04 19:16:43'),
(19, 'reason-update', 'Motivos', 'web', '2023-09-04 19:16:43', '2023-09-04 19:16:43'),
(20, 'reason-delete', 'Motivos', 'web', '2023-09-04 19:16:43', '2023-09-04 19:16:43'),
(21, 'roles-list', 'Roles', 'web', '2023-09-04 19:16:53', '2023-09-04 19:16:53'),
(22, 'roles-create', 'Roles', 'web', '2023-09-04 19:16:53', '2023-09-04 19:16:53'),
(23, 'roles-read', 'Roles', 'web', '2023-09-04 19:16:53', '2023-09-04 19:16:53'),
(24, 'roles-update', 'Roles', 'web', '2023-09-04 19:16:53', '2023-09-04 19:16:53'),
(25, 'roles-delete', 'Roles', 'web', '2023-09-04 19:16:53', '2023-09-04 19:16:53'),
(26, 'tickets-list', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(27, 'tickets-create', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(28, 'tickets-read', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(29, 'tickets-update', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(30, 'tickets-delete', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(31, 'tickets-attention', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(32, 'tickets-attend', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(33, 'tickets-disattend', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(34, 'tickets-recall', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(35, 'tickets-finish', 'Tickets', 'web', '2023-09-04 19:17:03', '2023-09-04 19:17:03'),
(36, 'users-list', 'Usuarios', 'web', '2023-09-04 19:17:13', '2023-09-04 19:17:13'),
(37, 'users-create', 'Usuarios', 'web', '2023-09-04 19:17:13', '2023-09-04 19:17:13'),
(38, 'users-read', 'Usuarios', 'web', '2023-09-04 19:17:13', '2023-09-04 19:17:13'),
(39, 'users-update', 'Usuarios', 'web', '2023-09-04 19:17:13', '2023-09-04 19:17:13'),
(40, 'users-delete', 'Usuarios', 'web', '2023-09-04 19:17:13', '2023-09-04 19:17:13'),
(41, 'users-change-password', 'Usuarios', 'web', '2023-09-04 19:17:13', '2023-09-04 19:17:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reasons`
--

DROP TABLE IF EXISTS `reasons`;
CREATE TABLE IF NOT EXISTS `reasons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reasons`
--

INSERT INTO `reasons` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Audiencia Especial de Presentación', '', 1, '2023-09-04 20:29:56', '2023-09-04 20:29:56', NULL),
(2, 'Audiencia Preliminar', '', 1, '2023-09-04 20:30:11', '2023-09-04 20:30:11', NULL),
(3, 'Audiencia de Entrega de Vehículo', '', 1, '2023-09-04 20:30:34', '2023-09-04 20:30:34', NULL),
(4, 'Audiencia Plazo Prudencial', '', 1, '2023-09-04 20:30:48', '2023-09-04 20:30:48', NULL),
(5, 'Información', '', 1, '2023-09-05 19:32:55', '2023-09-05 19:32:55', NULL),
(6, 'Verificación de Condiciones', '', 1, '2023-09-05 19:33:23', '2023-09-05 19:33:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'web', '2023-09-04 19:13:22', '2023-09-04 19:13:22'),
(2, 'Administradores', 'web', '2023-09-04 19:13:22', '2023-09-04 19:13:22'),
(3, 'Usuarios', 'web', '2023-09-04 19:13:22', '2023-09-04 19:13:22'),
(4, 'Secretarias', 'web', '2023-09-04 19:54:17', '2023-09-04 19:54:17'),
(5, 'Recepcionistas', 'web', '2023-09-04 19:54:45', '2023-09-04 19:54:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(12, 5),
(26, 5),
(27, 5),
(29, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `people_id` bigint UNSIGNED DEFAULT NULL,
  `office_id` bigint UNSIGNED NOT NULL,
  `reason_id` bigint UNSIGNED NOT NULL,
  `finish_reason_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `record` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('a','b','c','i') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'a' COMMENT 'a: Sin atenter,b: Atendiendo, c: Atendido, i: Anulado',
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attended` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `prosecutor_id` bigint UNSIGNED DEFAULT NULL,
  `finish_comment` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `tickets_ticket_index` (`ticket`),
  KEY `tickets_people_id_index` (`people_id`),
  KEY `tickets_office_id_index` (`office_id`),
  KEY `tickets_reason_id_index` (`reason_id`),
  KEY `tickets_finish_reason_id_index` (`finish_reason_id`),
  KEY `tickets_user_id_index` (`user_id`),
  KEY `tickets_record_index` (`record`),
  KEY `tickets_prosecutor_id_index` (`prosecutor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `ticket`, `people_id`, `office_id`, `reason_id`, `finish_reason_id`, `user_id`, `record`, `status`, `comments`, `attended`, `finished`, `created_at`, `updated_at`, `deleted_at`, `prosecutor_id`, `finish_comment`) VALUES
(1, 'Control-5-1', 1, 5, 2, 3, 1, '12354', 'c', '', NULL, '2023-09-04 18:39:15', '2023-09-04 22:10:30', '2023-09-04 22:39:15', NULL, NULL, NULL),
(2, 'Control-5-2', 2, 5, 2, 1, 1, 'ssss', 'c', '', NULL, '2023-09-04 18:42:33', '2023-09-04 22:34:21', '2023-09-04 22:42:33', NULL, NULL, NULL),
(3, 'Control-1-1', 3, 1, 1, 3, 1, '11111', 'c', '', NULL, '2023-09-04 18:56:26', '2023-09-04 22:41:08', '2023-09-04 22:56:26', NULL, NULL, NULL),
(4, 'Control-1-2', 4, 1, 2, 1, 1, '22222', 'c', '', NULL, '2023-09-05 10:07:58', '2023-09-04 22:41:43', '2023-09-05 14:07:58', NULL, NULL, NULL),
(5, 'Control-1-3', 5, 3, 4, 3, 1, 'gfffgf', 'c', '', NULL, '2023-09-04 18:55:22', '2023-09-04 22:42:16', '2023-09-04 22:55:22', NULL, NULL, NULL),
(6, 'Control-5-3', 6, 5, 2, NULL, 1, '66666', 'a', 'gggg', NULL, NULL, '2023-09-04 22:54:18', '2023-09-05 14:08:23', '2023-09-05 14:08:23', NULL, NULL),
(7, 'Control-1-1', 1, 1, 2, NULL, 1, 'sssss', 'b', '', NULL, NULL, '2023-09-05 14:17:35', '2023-09-05 14:55:43', NULL, NULL, NULL),
(8, 'Control-2-1', 2, 2, 2, NULL, 1, 'ssss', 'b', '', NULL, NULL, '2023-09-05 14:19:56', '2023-09-05 14:59:38', NULL, NULL, NULL),
(9, 'Control-3-1', 3, 3, 2, NULL, 1, 'ssss', 'b', '', NULL, NULL, '2023-09-05 14:22:55', '2023-09-05 15:03:02', NULL, NULL, NULL),
(10, 'Control-4-1', 4, 4, 2, 3, 1, 'ssss', 'c', '', NULL, '2023-09-14 10:08:29', '2023-09-05 14:23:13', '2023-09-14 14:08:29', NULL, NULL, NULL),
(11, 'Control-5-1', 5, 5, 2, 1, 1, 'ssss', 'c', 'ss', NULL, '2023-09-05 15:29:26', '2023-09-05 14:23:41', '2023-09-05 19:29:26', NULL, NULL, NULL),
(12, 'Control-6-1', 6, 6, 2, 1, 1, 'ssss', 'c', 's', NULL, '2023-09-14 16:10:31', '2023-09-05 14:26:01', '2023-09-14 20:10:31', NULL, NULL, NULL),
(13, 'Control-7-1', 7, 7, 2, 1, 1, 'SSSSSSSSSSSS', 'c', 'SSSSSSSS', NULL, '2023-09-14 10:39:36', '2023-09-05 14:38:51', '2023-09-14 14:39:36', NULL, NULL, NULL),
(14, 'Control-8-1', 8, 8, 4, NULL, 1, 'RRRRRRRRRR', 'b', '', NULL, NULL, '2023-09-05 14:39:21', '2023-09-05 15:07:40', NULL, NULL, NULL),
(15, 'Control-9-1', 9, 9, 2, 1, 1, 'ssssss', 'c', '', NULL, '2023-09-14 11:22:01', '2023-09-05 14:49:04', '2023-09-14 15:22:01', NULL, NULL, NULL),
(16, 'Control-10-1', 10, 10, 2, 1, 1, 'sssss', 'c', '', NULL, '2023-09-14 11:50:12', '2023-09-05 14:49:26', '2023-09-14 15:50:12', NULL, NULL, NULL),
(17, 'Control-11-1', 11, 11, 2, NULL, 1, 'ssss', 'b', 'sss', NULL, NULL, '2023-09-05 14:49:46', '2023-09-05 15:15:08', NULL, NULL, NULL),
(18, 'TPM-1-1', 12, 12, 2, 1, 1, 'ooooooooo', 'c', '', NULL, '2023-09-14 10:55:05', '2023-09-05 14:50:10', '2023-09-14 14:55:05', NULL, NULL, NULL),
(19, 'TPM-1-2', 4, 12, 2, NULL, 1, '33333', 'a', '', NULL, NULL, '2023-09-05 18:51:33', '2023-09-05 18:51:33', NULL, NULL, NULL),
(20, 'Control-1-2', 7, 1, 1, NULL, 1, '321654321', 'a', 'UNA OBSERVACION', NULL, NULL, '2023-09-05 19:00:18', '2023-09-05 19:00:18', NULL, NULL, NULL),
(21, 'Control-5-2', 13, 5, 4, 1, 1, '654KJHG-5', 'c', 'CAUSA DE MARACAY', NULL, '2023-09-12 09:45:59', '2023-09-05 19:22:18', '2023-09-12 13:45:59', NULL, NULL, NULL),
(22, 'Control-1-1', 15, 1, 1, NULL, 5, 'CI-2023-12340', 'a', 'PROCEDIMIENTO DE GUARDIA', NULL, NULL, '2023-09-11 14:50:01', '2023-09-11 14:50:01', NULL, NULL, NULL),
(23, 'Control-4-1', 17, 4, 4, NULL, 9, 'CI-2023-123456', 'a', 'ENTREGA DE MATERIALES', NULL, NULL, '2023-09-11 15:03:02', '2023-09-11 15:03:02', NULL, NULL, NULL),
(24, 'Control-4-2', 18, 4, 2, NULL, 9, 'CI-2023-455678', 'a', '', NULL, NULL, '2023-09-11 15:05:09', '2023-09-11 15:05:09', NULL, NULL, NULL),
(25, 'TPM-3-1', 18, 12, 2, 1, 1, '852369', 'c', 'Anything', NULL, '2024-03-04 21:25:41', '2024-03-05 01:23:10', '2024-03-05 01:25:41', NULL, NULL, 'Free'),
(26, 'TPM-3-2', 18, 12, 2, 3, 1, '8523691', 'c', 'Anything', NULL, '2024-03-04 21:26:14', '2024-03-05 01:24:27', '2024-03-05 01:26:14', NULL, NULL, 'Feee'),
(27, 'TPM-3-3', 18, 12, 2, 1, 1, '852369852', 'c', '', NULL, '2024-03-04 22:30:18', '2024-03-05 02:29:15', '2024-03-05 02:30:18', NULL, NULL, 'Free');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_id` int DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `email_verified_at`, `password`, `office_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrador', '', 'admin@admin.com', '2023-09-04 19:15:27', '$2y$10$X.huHDsrPydstYNaiKFGHOHIwPSF6BnbbLsxnRzmQHGk3QSWX3kOq', 12, 'gESXhVCRaTtWrKaRdbophKiIicAQJgyagLqlMyP3EVEMCf3JaIyzSVC5CRcj', '2023-09-04 19:15:27', '2023-09-04 19:15:27', NULL),
(5, 'YERIBETH', 'GARCIA', 'YERIBETH.GARCIA@turnos.local', NULL, '$2y$10$VrJ/DJJRKJemXQIjRWG9B.MEiirn8tkazMrhYBzYVbSkrq74urETa', NULL, NULL, '2023-09-04 20:00:19', '2023-09-11 15:41:16', NULL),
(6, 'JESUS ', 'JIMENEZ', 'JESUS.JIMENEZ@TURNOS.LOCAL', NULL, '$2y$10$2SyIVxkdziWH/ZIqFBu88u1vK.DI3yjh2ybLMRuWp7fSZPjE5hcvi', 1, NULL, '2023-09-05 18:56:42', '2023-09-05 18:56:42', NULL),
(7, 'MILITZA', 'INFANTE', 'MILITZA.INFANTE@TURNOS.LOCAL', NULL, '$2y$10$L.HPq1CPVuRqtqqWYBmdJuNbl7IYM9ubYhTzTgUhh0IXvZGYBrQZq', 1, NULL, '2023-09-05 18:58:28', '2023-09-05 18:58:28', NULL),
(8, 'GIOMAR', 'PEREZ', 'GIOMAR@TURNOS.LOCAL', NULL, '$2y$10$pgcC8eJG5IztuUAN.voZluP/.ET8/RYFuurmuVjPD6DJx3xGvuT2u', NULL, NULL, '2023-09-05 19:58:51', '2023-09-05 19:58:51', NULL),
(9, 'REBECA', 'APONTE', 'REBECA.APONTE@TURNOS.LOCAL', NULL, '$2y$10$wDGJpwHdf4COakhJ8mprLOIbNHxI/JLDXoix26o98y//CCj2H7gP6', NULL, NULL, '2023-09-11 14:39:04', '2023-09-14 15:04:25', NULL),
(10, 'LEDIS', 'MIRANDA', 'LEDIS.MIRANDA@TURNOS.LOCAL', NULL, '$2y$10$GfD.B/N5NwIj43KIS9EpneZRtvjBHpqeqsByHUDJRKn7JdtNkYzye', 3, NULL, '2023-09-13 15:17:51', '2023-09-13 15:17:51', NULL),
(11, 'YAJAIRA', 'JAIME', 'YAJAIRA.JAIME@TURNOS.LOCAL', NULL, '$2y$10$.G3Mn.RN7QdQu/pYvlXpU.X1597noje3VU9.nQFzel2Vcn65x7mgW', 3, NULL, '2023-09-13 15:32:08', '2023-09-13 15:32:08', NULL),
(12, 'ROSANGEL', 'ESTRADA', 'ROSANGEL.ESTRADA@TURNOS.LOCAL', NULL, '$2y$10$i25y.aXMJ7VH7dfrMHBf1O34f3Mw0F9MV./vYIcUYlSV3FukxIYtG', 2, NULL, '2023-09-13 19:35:28', '2023-09-13 19:43:56', NULL),
(13, 'FRANCIS', 'PERAZA', 'FRANCIS.PERAZA@TURNOS.LOCAL', NULL, '$2y$10$BEqM39FjevhdoQ/aPFv6kuHhDUahvU8d/fsSxELvF6wYkwjflAzk.', 2, NULL, '2023-09-13 20:32:18', '2023-09-13 20:32:18', NULL),
(14, 'JOSE', 'PALENCIA', 'JOSE.PALENCIA@TURNOS.LOCAL', NULL, '$2y$10$kr4sW4B6DPrLFg5BPitl.eiBjYR2OSGxv4JAv1YnFHx/r9p4fq5fu', 2, NULL, '2023-09-13 20:34:05', '2023-09-13 20:34:05', NULL),
(15, 'CARMEN', 'LINAREZ', 'CARMEN.LINAREZ@TURNOS.LOCAL', NULL, '$2y$10$HJQ.H4oH5WPE31BSAE4Aku50mtC.cctMrzOnGcDR.BP5cX3gjBGHa', 6, NULL, '2023-09-14 12:42:54', '2023-09-14 20:01:27', NULL),
(16, 'MILAGROS', 'PINA', 'MILAGROS.PINA@TURNOS.LOCAL', NULL, '$2y$10$2Z4bX1tIGNNatFNcid/Ya.lmrotbKKhfwcix0TuHCa6z16ywTCG7y', 6, NULL, '2023-09-14 12:44:41', '2023-09-14 12:46:36', NULL),
(17, 'ERNESTO', 'MARTINEZ', 'ERNESTO.MARTINEZ@TURNOS.LOCAL', NULL, '$2y$10$T228PEfC5qDcymq5xIoMcOZdmHnK2ICTJzBJ/ntM6yY1xmlh1cQ0y', 6, NULL, '2023-09-14 12:46:14', '2023-09-14 12:46:14', NULL),
(18, 'DENNYS', 'OVALLES', 'DENNYS.OVALLES@TURNOS.LOCAL', NULL, '$2y$10$6wlQcNWGzZON5kzemlAzLe7fGG3lrJ67r1D2Y2ugYzonDQ6INcyBO', 12, NULL, '2023-09-14 13:02:29', '2023-09-14 13:03:43', NULL),
(19, 'JAIRIBITH', 'ROMERO', 'JAIRIBITH.ROMERO@TURNOS.LOCAL', NULL, '$2y$10$e7X27Xfq8oqDth1Oteo3GuIqgi0pw.RuTLT7Bbu9WKoMP8dc7EK/G', 12, NULL, '2023-09-14 13:05:09', '2023-09-14 13:05:09', NULL),
(20, 'ORIANA', 'VALENZUELA', 'ORIANA.VALENZUELA@TURNOS.LOCAL', NULL, '$2y$10$pVueFp83GK/Mex2dT5bDSO3K0zI0sUW6CVLZT0g.DHjykD85zRx2m', 13, NULL, '2023-09-14 13:06:29', '2023-09-14 13:06:29', NULL),
(21, 'ZENAIDA', 'GOMEZ', 'ZENAIDA.GOMEZ@TURNOS.LOCAL', NULL, '$2y$10$8Yzs2JuJJXRADyINIVaGFOSmlImXO8ReG3/DyyH6bRBw5rWt7yprK', 13, NULL, '2023-09-14 13:07:40', '2023-09-14 13:07:40', NULL),
(22, 'STEFHANIE', 'MADARIAGA', 'STEFHANIE.MADARIAGA@TURNOS.LOCAL', NULL, '$2y$10$TB0owmLxTNg6sb3YiWQFqe0QYT8TvTaeYmZjGpk/3TyB89IzYFMb6', 4, NULL, '2023-09-14 13:10:04', '2023-09-14 13:11:42', NULL),
(23, 'JOSE', 'CORONA', 'JOSE.CORONA@TURNOS.LOCAL', NULL, '$2y$10$zFaTXzY3npq19OTDm123x.uRyXJx3ej7NwMUe09A0sErcYBUeO07u', 4, NULL, '2023-09-14 13:11:19', '2023-09-14 13:11:19', NULL),
(24, 'ALEXIS', 'ROBERTIS', 'ALEXIS.ROBERTIS@TURNOS.LOCAL', NULL, '$2y$10$NPc.Wg7ypfrVbh66WKYhVO1HRjtdy9B5RvY4pns3WHVm6hB41ut8G', 7, NULL, '2023-09-14 13:13:01', '2023-09-14 14:36:43', NULL),
(25, 'DARWIS', 'MIRELES', 'DARWIN.MIRELES@TURNOS.LOCAL', NULL, '$2y$10$ww4vfyfJXgbK4R2Xcy9KweQhisPOI.7cSwKeVoqy44z0kHq8cVo4S', 7, NULL, '2023-09-14 13:14:06', '2023-09-14 14:36:23', NULL),
(26, 'CESAR', 'GUACACHE', 'CESAR.GUACACHE@TURNOS.LOCAL', NULL, '$2y$10$x5Y8nBPMG.KGBKOryBHPUewQtRrGiqzDQUPd.zP8uk58xA1Jof8zy', 8, NULL, '2023-09-14 13:21:45', '2023-09-14 14:22:47', NULL),
(27, 'CARLOS', 'LOPEZ', 'CARLOS.LOPEZ@TURNOS.LOCAL', NULL, '$2y$10$xOOIUJR17Hv4D770oTkLc.yWXN1OKUYyOOcI39FH6wL50XW005eui', 9, NULL, '2023-09-14 13:23:04', '2023-09-14 13:23:04', NULL),
(28, 'JHON', 'SUNIAGA', 'JHON.SUNIAGA@TURNOS.LOCAL', NULL, '$2y$10$2177thEwmOJ3/pjFMrZ31.c7YxKvYmk.8/F12YZORbWPXmsAUIeBq', 9, NULL, '2023-09-14 13:24:13', '2023-09-14 13:24:13', NULL),
(29, 'TENAXI', 'RODRIGUEZ', 'TENAXI.RODRIGUEZ@TURNOS.LOCAL', NULL, '$2y$10$7rob4XFCWq0BaIW/J1dq..IexBWGsnhQ3lRoAUCJ1Xggm5Ud.vBcu', 10, NULL, '2023-09-14 13:25:27', '2023-09-14 15:58:37', NULL),
(30, 'MERLYS', 'INFANTE', 'MERLYS.INFANTE@TURNOS.LOCAL', NULL, '$2y$10$y6Il23YE0CLK/ceQD7fBAe5MgApJ9Ol/kfOKUVj1HLP7wXDBTBLFi', 10, NULL, '2023-09-14 13:26:23', '2023-09-14 15:59:22', NULL),
(31, 'JHOANGEL', 'BRAVO', 'JHOANGEL.BRAVO@TURNOS.LOCAL', NULL, '$2y$10$wQvXXaNaW.rnSqIdjS8KHuLxyVpJ4h8nWWARGe6Ydxay/bfB7QfXG', 11, NULL, '2023-09-14 13:27:36', '2023-09-14 13:27:36', NULL),
(32, 'EUKARIZ', 'ALVARADO', 'EUKARIZ.ALVARADO@TURNOS.LOCAL', NULL, '$2y$10$mFIvQKaMxHGu7xY0JMd1v.14HZfhqv4nwx4nEUfM8r421g8IGfWq2', 11, NULL, '2023-09-14 13:28:54', '2023-09-14 13:28:54', NULL),
(33, 'YORBELY', 'UGARTE', 'YORBELY.UGARTE@TURNOS.LOCAL', NULL, '$2y$10$yU4s1D4WinBHsrRppExYieCEJQ2SoFMEctCLdJ6PCIQQhCLzao5n2', 11, NULL, '2023-09-14 13:30:10', '2023-09-14 13:30:10', NULL),
(34, 'YULEYMA', 'PEREZ', 'YULEYMA.PEREZ@TURNOS.LOCAL', NULL, '$2y$10$kIlocpWp8hvhWfiWtdEL.eFStgcnf1yzkjFB7xcgFCtZiQRn.siga', 14, NULL, '2023-09-14 13:32:46', '2023-09-14 14:23:12', NULL),
(35, 'RODMELYS', 'AHMAD', 'RODMELYS.AHMAD@TURNOS.LOCAL', NULL, '$2y$10$oHQgbgXpIqETs1Y0IQQSYuzmDLBL3jj8PlSIG2dyrbjC/n8ScKh/m', 14, NULL, '2023-09-14 13:33:57', '2023-09-14 13:33:57', NULL),
(36, 'JESUS', 'CONTRERAS', 'JESUS.CONTRERAS@TURNOS.LOCAL', NULL, '$2y$10$urZ1cKxrBh7HrHSb2Ei7LuLZTmH8kXW5oki3Latw9WYkPDs0RctMy', 4, NULL, '2023-09-14 14:15:41', '2023-09-14 14:15:41', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accused`
--
ALTER TABLE `accused`
  ADD CONSTRAINT `accused_people_id_foreign` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accused_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `people_prosecutor_office_foreign` FOREIGN KEY (`prosecutor_office`) REFERENCES `offices` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_finish_reason_id_foreign` FOREIGN KEY (`finish_reason_id`) REFERENCES `finish_reasons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_people_id_foreign` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_prosecutor_id_foreign` FOREIGN KEY (`prosecutor_id`) REFERENCES `people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_reason_id_foreign` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
