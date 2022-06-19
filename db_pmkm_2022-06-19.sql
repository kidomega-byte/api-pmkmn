# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.5.6-MariaDB)
# Database: db_pmkm
# Generation Time: 2022-06-19 06:18:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table db_ahliwaris
# ------------------------------------------------------------

DROP TABLE IF EXISTS `db_ahliwaris`;

CREATE TABLE `db_ahliwaris` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `hubungan` varchar(255) DEFAULT NULL,
  `alm_id` int(11) unsigned DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alm_id` (`alm_id`),
  CONSTRAINT `db_ahliwaris_ibfk_1` FOREIGN KEY (`alm_id`) REFERENCES `db_alm` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `db_ahliwaris` WRITE;
/*!40000 ALTER TABLE `db_ahliwaris` DISABLE KEYS */;

INSERT INTO `db_ahliwaris` (`id`, `nik`, `nama`, `alamat`, `gender`, `tanggal_lahir`, `hubungan`, `alm_id`, `agama`, `created_at`, `updated_at`)
VALUES
	(3,'2','b','jkt','laki-laki','2022-02-02','kakak',2,'islam',NULL,NULL),
	(4,'123','ok','bjhrg','laki-laki','2022-02-02','istri',1,'islam','2022-06-18 07:38:41','2022-06-18 07:38:41');

/*!40000 ALTER TABLE `db_ahliwaris` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table db_alm
# ------------------------------------------------------------

DROP TABLE IF EXISTS `db_alm`;

CREATE TABLE `db_alm` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` varchar(255) DEFAULT NULL,
  `meninggal_id` int(11) unsigned DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `db_alm` WRITE;
/*!40000 ALTER TABLE `db_alm` DISABLE KEYS */;

INSERT INTO `db_alm` (`id`, `nik`, `nama`, `alamat`, `gender`, `tempat_lahir`, `tanggal_lahir`, `meninggal_id`, `agama`, `created_at`, `updated_at`)
VALUES
	(1,'2','b','cjr','laki-laki','Cianjur','2022-01-02',1,'Islam',NULL,NULL),
	(2,'3','v','jkt','laki-laki','Jakarta','2022-02-02',2,'Islam',NULL,NULL),
	(3,'12','kk','cjr','laki-laki','jtk','2022-01-01',1,'islam','2022-06-19 06:04:34','2022-06-19 06:04:34');

/*!40000 ALTER TABLE `db_alm` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(9,'2014_10_12_000000_create_users_table',1),
	(10,'2014_10_12_100000_create_password_resets_table',1),
	(11,'2019_08_19_000000_create_failed_jobs_table',1),
	(12,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`)
VALUES
	(2,'App\\Models\\User',3,'auth_token','5274d0c49238ccb96b2d33e4be3c782d26f429d43d9444129a983577f254f4f7','[\"*\"]',NULL,'2022-06-18 04:44:18','2022-06-18 04:44:18'),
	(5,'App\\Models\\User',2,'auth_token','3caedc38cccc943428587ff4c1e2b9612dab2e14fc7309d99a7df1e46cbb8f4a','[\"*\"]','2022-06-19 05:49:14','2022-06-18 09:47:08','2022-06-19 05:49:14'),
	(6,'App\\Models\\User',2,'auth_token','ac81ed2e4ee33c3865e76d6e3c2a783ca42573d05ab6a56c497b992d1ab04105','[\"*\"]',NULL,'2022-06-18 13:17:37','2022-06-18 13:17:37'),
	(7,'App\\Models\\User',2,'auth_token','14b97fcd839183b7645782ed3adc3dc41c98375071e872a7039311678e0a84ea','[\"*\"]',NULL,'2022-06-18 14:13:14','2022-06-18 14:13:14'),
	(8,'App\\Models\\User',2,'auth_token','69f8f3906a1f40938d403e874b96e3c7cc80cb05dde4597925121527a0c2e318','[\"*\"]','2022-06-19 05:51:35','2022-06-19 05:50:30','2022-06-19 05:51:35');

/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `photo`, `name`, `email`, `email_verified_at`, `phone_number`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(2,'images/users/1655526996_cndk.png','ilham','ilhamtaufiq97@gmail.com',NULL,'6285217795994','$2y$10$5DIUHgYKyxmRd3U6CNohOeOn8b6.mgOxAzrJgvGvMcRZkx4QDvIli',NULL,'2022-06-18 04:36:38','2022-06-18 04:36:38'),
	(3,'images/users/1655527449_cndk.png','anugrah','anugrahrachman8@gmail.com',NULL,'6287869962755','$2y$10$bNWI07xTmzYGZZIgFbN6DevmXLkR2JZGINF5.mbDDqydWsEJguFKq',NULL,'2022-06-18 04:44:10','2022-06-18 04:44:10');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
