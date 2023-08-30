-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `device_type` varchar(191) NOT NULL,
  `device_token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `devices` (`id`, `user_id`, `device_type`, `device_token`, `created_at`, `updated_at`) VALUES
(5,	3,	'Android',	'123',	'2023-08-04 07:27:32',	'2023-08-04 07:27:32');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('rn@yopmail.com',	'$2y$10$J4iCXRynPyLDihxBxebqkOPr0EwSSAkhJOSKEzKlinOBjaflrXhnm',	'2023-08-04 07:17:31');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1,	'App\\Models\\User',	2,	'authToken',	'0849dd705c7a6c9346f1d78eba1e2f08cf9c0981cbcba4f6541f14c83c6042e5',	'[\"*\"]',	NULL,	NULL,	'2023-08-04 03:54:47',	'2023-08-04 03:54:47'),
(2,	'App\\Models\\User',	3,	'authToken',	'04105821b94355d4f43629b3c836802e51d733d11b7236a7d0b6921a1977c0a3',	'[\"*\"]',	NULL,	NULL,	'2023-08-04 03:55:47',	'2023-08-04 03:55:47'),
(3,	'App\\Models\\User',	3,	'authToken',	'280303f294cf02b38bd163e7b1bf498a86fffe74752ee2839b051bf632c1aa97',	'[\"*\"]',	'2023-08-04 05:12:41',	NULL,	'2023-08-04 03:59:33',	'2023-08-04 05:12:41'),
(4,	'App\\Models\\User',	3,	'authToken',	'332e901fabe58366815af6c5e7de4f87ec51cc026e3d0b1d0bc4b3b16d3fae49',	'[\"*\"]',	NULL,	NULL,	'2023-08-04 05:11:10',	'2023-08-04 05:11:10'),
(5,	'App\\Models\\User',	3,	'authToken',	'289ef1cbd31b533b08ba81af2b97370400d516728cd41c37449e77ec51c7bcb4',	'[\"*\"]',	NULL,	NULL,	'2023-08-04 07:07:10',	'2023-08-04 07:07:10'),
(6,	'App\\Models\\User',	3,	'authToken',	'5111c583315f47cd6791a6fad21ec65df420af22c77c094824c649043f89ed15',	'[\"*\"]',	'2023-08-04 07:32:19',	NULL,	'2023-08-04 07:27:32',	'2023-08-04 07:32:19');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_type` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inActive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `panel_mode` tinyint NOT NULL DEFAULT '1',
  `locale` enum('en','ar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `user_type`, `name`, `email`, `image`, `email_verified_at`, `password`, `status`, `panel_mode`, `locale`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'Super Admin',	'admin@gmail.com',	NULL,	NULL,	'$2y$10$mPDZOdGmIngIzcRf1zMtgOzSHvJDL43FUFj.xfRMxw5USEQEmRsCC',	'active',	1,	'en',	NULL,	'2023-08-03 12:15:12',	'2023-08-06 23:16:09'),
(3,	'user',	'rn',	'rn@gmail.com',	NULL,	NULL,	'$2y$10$PH1XM.JSodz6I9hFbL1gf.Z7K3PqVccNpK9ttdW3zHNfMFwDY8pc6',	'active',	1,	'en',	NULL,	'2023-08-04 03:55:47',	'2023-08-04 07:32:19');

-- 2023-08-07 04:56:22
