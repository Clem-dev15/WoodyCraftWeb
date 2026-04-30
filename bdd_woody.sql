-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour woodycraft
CREATE DATABASE IF NOT EXISTS `woodycraft` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `woodycraft`;

-- Listage de la structure de table woodycraft. adresse_livraisons
CREATE TABLE IF NOT EXISTS `adresse_livraisons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_rue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_rue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adresse_livraisons_user_id_foreign` (`user_id`),
  CONSTRAINT `adresse_livraisons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.adresse_livraisons : ~20 rows (environ)
INSERT INTO `adresse_livraisons` (`id`, `user_id`, `ville`, `departement`, `nom_rue`, `numero_rue`, `created_at`, `updated_at`) VALUES
	(1, 1, 'genilac', '42800', 'rue', '42', '2026-04-30 10:29:16', '2026-04-30 10:29:16'),
	(2, 1, 'genilac', '42800', 'rue', '42', '2026-04-30 10:30:27', '2026-04-30 10:30:27'),
	(3, 1, 'genilac', '42800', 'rue', '42', '2026-04-30 10:30:40', '2026-04-30 10:30:40'),
	(4, 1, 'genilac', '42800', 'rue', '42', '2026-04-30 10:30:55', '2026-04-30 10:30:55'),
	(5, 1, 'lyon', '69000', 'rue', '69', '2026-04-30 10:33:22', '2026-04-30 10:33:22'),
	(6, 1, 'genilac', '42800', 'rue', '42', '2026-04-30 10:35:10', '2026-04-30 10:35:10'),
	(7, 1, 'genilac', '42800', 'rue', '42', '2026-04-30 10:37:23', '2026-04-30 10:37:23'),
	(8, 1, 'genilac', '42800', 'rue', '42', '2026-04-30 10:37:34', '2026-04-30 10:37:34'),
	(9, 1, 'g', '42800', 'h', '4', '2026-04-30 10:38:11', '2026-04-30 10:38:11'),
	(10, 1, 'dtyj', '42000', 'dtyu,', '58', '2026-04-30 10:39:05', '2026-04-30 10:39:05'),
	(11, 1, 'tyj', '58420', 'lkn', '96', '2026-04-30 10:39:40', '2026-04-30 10:39:40'),
	(12, 1, 'dutk', '48521', 'yduk', '854', '2026-04-30 10:41:12', '2026-04-30 10:41:12'),
	(13, 1, 'dutk', '48521', 'yduk', '854', '2026-04-30 10:41:54', '2026-04-30 10:41:54'),
	(14, 1, 'ydfukd', '48521', 'fyukdfyu', '856', '2026-04-30 10:43:07', '2026-04-30 10:43:07'),
	(15, 1, 'srtsn', '47596', 'uip', '632', '2026-04-30 10:43:33', '2026-04-30 10:43:33'),
	(16, 1, 'qrthjn', '42159', 'rstj', '63', '2026-04-30 10:44:39', '2026-04-30 10:44:39'),
	(17, 1, 'tièuilr', '45874', 'jop', '20', '2026-04-30 10:45:25', '2026-04-30 10:45:25'),
	(18, 1, 'tièuilr', '45874', 'jop', '20', '2026-04-30 10:50:24', '2026-04-30 10:50:24'),
	(19, 1, 'genilac', '42800', 'reue', '569', '2026-04-30 11:04:38', '2026-04-30 11:04:38'),
	(20, 1, 'ftuykdyukl', '42800', 'gui:fui:', '569', '2026-04-30 11:07:04', '2026-04-30 11:07:04');

-- Listage de la structure de table woodycraft. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.categories : ~3 rows (environ)
INSERT INTO `categories` (`id`, `nom`, `created_at`, `updated_at`) VALUES
	(1, 'bois', NULL, NULL),
	(2, 'carton', NULL, NULL),
	(3, 'Fabriqué en France', NULL, NULL);

-- Listage de la structure de table woodycraft. commandes
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commandes_user_id_foreign` (`user_id`),
  CONSTRAINT `commandes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.commandes : ~0 rows (environ)

-- Listage de la structure de table woodycraft. commande_articles
CREATE TABLE IF NOT EXISTS `commande_articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `commande_id` bigint unsigned NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_articles_commande_id_foreign` (`commande_id`),
  CONSTRAINT `commande_articles_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.commande_articles : ~0 rows (environ)

-- Listage de la structure de table woodycraft. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Listage des données de la table woodycraft.failed_jobs : ~0 rows (environ)

-- Listage de la structure de table woodycraft. fournisseurs
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.fournisseurs : ~3 rows (environ)
INSERT INTO `fournisseurs` (`id`, `nom`, `adresse`, `created_at`, `updated_at`) VALUES
	(1, 'FournisseurDeBois', 'Genilac', NULL, NULL),
	(2, 'FournisseurDeCarton', 'Rive de Gier', NULL, NULL),
	(3, 'FournisseurFrancais', 'Lorette', NULL, NULL);

-- Listage de la structure de table woodycraft. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.migrations : ~14 rows (environ)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_10_09_125622_create_categories_table', 1),
	(6, '2025_10_09_125701_create_puzzles_table', 1),
	(7, '2025_10_09_130533_create_paniers_table', 1),
	(8, '2025_10_09_130543_create_commandes_table', 1),
	(9, '2025_10_09_130548_create_adresse_livraisons_table', 1),
	(10, '2025_10_09_130556_create_paiements_table', 1),
	(11, '2025_10_09_130601_create_commande_articles_table', 1),
	(12, '2025_10_09_144732_update_adresse_livraison_table', 2),
	(13, '2026_04_30_120857_create_fournisseurs_table', 2),
	(14, '2026_04_30_120913_add_fournisseur_id_to_puzzles_table', 2);

-- Listage de la structure de table woodycraft. paiements
CREATE TABLE IF NOT EXISTS `paiements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `commande_id` bigint unsigned NOT NULL,
  `methode` enum('paypal','cheque','carte') COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paiements_commande_id_foreign` (`commande_id`),
  CONSTRAINT `paiements_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.paiements : ~0 rows (environ)

-- Listage de la structure de table woodycraft. paniers
CREATE TABLE IF NOT EXISTS `paniers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `puzzle_id` bigint unsigned DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  `prix` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paniers_user_id_foreign` (`user_id`),
  CONSTRAINT `paniers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.paniers : ~0 rows (environ)

-- Listage de la structure de table woodycraft. password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.password_reset_tokens : ~0 rows (environ)

-- Listage de la structure de table woodycraft. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
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

-- Listage des données de la table woodycraft.personal_access_tokens : ~0 rows (environ)

-- Listage de la structure de table woodycraft. puzzles
CREATE TABLE IF NOT EXISTS `puzzles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` bigint unsigned NOT NULL,
  `fournisseur_id` bigint unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `puzzles_categorie_id_foreign` (`categorie_id`),
  KEY `puzzles_fournisseur_id_foreign` (`fournisseur_id`),
  CONSTRAINT `puzzles_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `puzzles_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.puzzles : ~3 rows (environ)
INSERT INTO `puzzles` (`id`, `nom`, `categorie_id`, `fournisseur_id`, `description`, `image`, `prix`, `created_at`, `updated_at`) VALUES
	(2, 'puzzle1', 1, 1, 'description', 'puzzles/xoKFz8Qlvk9bA0JqHwjCAQMylxh0Yu5xurOA0JnS.jpg', 150.00, '2026-04-30 10:21:39', '2026-04-30 10:21:39'),
	(3, 'puzzle2', 2, 2, 'puzzle 2 description', 'puzzles/eSQXDfIbbX0KrQ3tNlWUEyaajdcOnrycJ8lCFqe1.jpg', 89.99, '2026-04-30 10:32:44', '2026-04-30 10:58:05'),
	(4, 'puzzle 3', 1, 3, '3', 'puzzles/eYFWzNySbql0v1TlR0ompoabcAvqXYxZDgGHkDCn.jpg', 500.00, '2026-04-30 10:57:47', '2026-04-30 10:57:47');

-- Listage de la structure de table woodycraft. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table woodycraft.users : ~1 rows (environ)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'clement', 'c@c.fr', NULL, '$2y$12$lVW4zchCh.5XYRYv3.xWQ.kmDO4JFMezpXXJkuB2x4aFihBqpBcu2', NULL, '2026-04-30 09:07:24', '2026-04-30 09:07:24');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
