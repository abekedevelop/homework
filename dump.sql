-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.24-0ubuntu0.18.04.1 - (Ubuntu)
-- Операционная система:         Linux
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных homework
CREATE DATABASE IF NOT EXISTS `homework` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `homework`;

-- Дамп структуры для таблица homework.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_name_ru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_has_connection` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы homework.cities: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`id`, `city_name_ru`, `city_name_en`, `city_has_connection`, `created_at`, `updated_at`) VALUES
	(1, 'Алматы', 'Almaty', 1, '2019-01-19 19:20:12', '2019-01-19 19:20:12'),
	(2, 'Астана', 'Astana', 1, '2019-01-19 19:20:12', '2019-01-19 19:20:12'),
	(3, 'Москва', 'Moscow', 0, '2019-01-19 19:20:12', '2019-01-19 19:20:12');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Дамп структуры для таблица homework.city_country_links
CREATE TABLE IF NOT EXISTS `city_country_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы homework.city_country_links: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `city_country_links` DISABLE KEYS */;
INSERT INTO `city_country_links` (`id`, `city_id`, `country_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2019-01-19 19:20:12', '2019-01-19 19:20:12'),
	(2, 1, 2, '2019-01-19 19:20:12', '2019-01-19 19:20:12'),
	(3, 2, 1, '2019-01-19 19:20:12', '2019-01-19 19:20:12'),
	(4, 2, 3, '2019-01-19 19:20:12', '2019-01-19 19:20:12');
/*!40000 ALTER TABLE `city_country_links` ENABLE KEYS */;

-- Дамп структуры для таблица homework.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_name_ru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_country_name_ru_unique` (`country_name_ru`),
  UNIQUE KEY `countries_country_name_en_unique` (`country_name_en`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы homework.countries: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `country_name_ru`, `country_name_en`, `created_at`, `updated_at`) VALUES
	(1, 'Турция', 'Turkey', '2019-01-19 19:20:12', '2019-01-19 19:20:12'),
	(2, 'Таиланд', 'Thailand', '2019-01-19 19:20:12', '2019-01-19 19:20:12'),
	(3, 'Чехия', 'Czech Republic', '2019-01-19 19:20:12', '2019-01-19 19:20:12');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Дамп структуры для таблица homework.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы homework.migrations: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(13, '2019_01_18_120609_create_countries_table', 1),
	(14, '2019_01_18_124413_create_cities_table', 1),
	(15, '2019_01_18_125026_create_city_country_links_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
