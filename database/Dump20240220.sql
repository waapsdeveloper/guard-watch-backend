-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: guard-watch
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dial_code` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,NULL,40,'Hamza','+93','3132565985','2024-02-19 09:49:57','2024-02-19 09:49:57'),(2,NULL,40,'vgfdgdg','+672','5645646645646','2024-02-19 09:52:31','2024-02-19 09:52:31'),(3,NULL,40,'jhghjghjg','+93','565464645654','2024-02-19 09:53:11','2024-02-19 09:53:11'),(4,NULL,40,'dasda','+244','4546545646','2024-02-19 09:54:38','2024-02-19 09:54:38');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (1,1,'id','number','ID',1,0,0,0,0,0,NULL,1),(2,1,'name','text','Name',1,1,1,1,1,1,NULL,2),(3,1,'email','text','Email',1,1,1,1,1,1,NULL,3),(4,1,'password','password','Password',1,0,0,1,1,0,NULL,4),(5,1,'remember_token','text','Remember Token',0,0,0,0,0,0,NULL,5),(6,1,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,6),(7,1,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,7),(8,1,'avatar','image','Avatar',0,1,1,1,1,1,NULL,8),(9,1,'user_belongsto_role_relationship','relationship','Role',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}',10),(10,1,'user_belongstomany_role_relationship','relationship','Roles',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}',11),(11,1,'settings','hidden','Settings',0,0,0,0,0,0,NULL,12),(12,2,'id','number','ID',1,0,0,0,0,0,NULL,1),(13,2,'name','text','Name',1,1,1,1,1,1,NULL,2),(14,2,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,3),(15,2,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(16,3,'id','number','ID',1,0,0,0,0,0,NULL,1),(17,3,'name','text','Name',1,1,1,1,1,1,NULL,2),(18,3,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,3),(19,3,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(20,3,'display_name','text','Display Name',1,1,1,1,1,1,NULL,5),(21,1,'role_id','text','Role',1,1,1,1,1,1,NULL,9);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `display_name_singular` varchar(255) NOT NULL,
  `display_name_plural` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `policy_name` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (1,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy','TCG\\Voyager\\Http\\Controllers\\VoyagerUserController','',1,0,NULL,'2023-11-24 07:11:02','2023-11-24 07:11:02'),(2,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,NULL,'2023-11-24 07:11:02','2023-11-24 07:11:02'),(3,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController','',1,0,NULL,'2023-11-24 07:11:02','2023-11-24 07:11:02');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invite_contacts`
--

DROP TABLE IF EXISTS `invite_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invite_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `invite_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `qrcode` varchar(45) DEFAULT NULL,
  `is_scanned` int(1) DEFAULT 0,
  `dial_code` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invite_contacts`
--

LOCK TABLES `invite_contacts` WRITE;
/*!40000 ALTER TABLE `invite_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `invite_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invite_requests`
--

DROP TABLE IF EXISTS `invite_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invite_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `space_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `dial_code` varchar(4) DEFAULT NULL,
  `space_name` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `status` int(11) DEFAULT -1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invite_requests`
--

LOCK TABLES `invite_requests` WRITE;
/*!40000 ALTER TABLE `invite_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `invite_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invite_scan_histories`
--

DROP TABLE IF EXISTS `invite_scan_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invite_scan_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invite_id` int(11) DEFAULT NULL,
  `invite_contact_id` int(11) DEFAULT NULL,
  `scan_by_user_id` int(11) DEFAULT NULL,
  `scan_date_time` datetime DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invite_scan_histories`
--

LOCK TABLES `invite_scan_histories` WRITE;
/*!40000 ALTER TABLE `invite_scan_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `invite_scan_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invites`
--

DROP TABLE IF EXISTS `invites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `space_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `dial_code` int(3) DEFAULT NULL,
  `space` varchar(200) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `validity` int(11) NOT NULL DEFAULT 1,
  `pass_type` varchar(10) NOT NULL,
  `visitor_type` varchar(100) NOT NULL,
  `comments` varchar(100) NOT NULL DEFAULT 'lorem ipsum',
  `created_by` int(11) DEFAULT 7,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invites`
--

LOCK TABLES `invites` WRITE;
/*!40000 ALTER TABLE `invites` DISABLE KEYS */;
/*!40000 ALTER TABLE `invites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `parameters` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','','_self','voyager-boat',NULL,NULL,1,'2023-11-24 07:11:02','2023-11-24 07:11:02','voyager.dashboard',NULL),(2,1,'Media','','_self','voyager-images',NULL,NULL,5,'2023-11-24 07:11:02','2023-11-24 07:11:02','voyager.media.index',NULL),(3,1,'Users','','_self','voyager-person',NULL,NULL,3,'2023-11-24 07:11:02','2023-11-24 07:11:02','voyager.users.index',NULL),(4,1,'Roles','','_self','voyager-lock',NULL,NULL,2,'2023-11-24 07:11:02','2023-11-24 07:11:02','voyager.roles.index',NULL),(5,1,'Tools','','_self','voyager-tools',NULL,NULL,9,'2023-11-24 07:11:02','2023-11-24 07:11:02',NULL,NULL),(6,1,'Menu Builder','','_self','voyager-list',NULL,5,10,'2023-11-24 07:11:02','2023-11-24 07:11:02','voyager.menus.index',NULL),(7,1,'Database','','_self','voyager-data',NULL,5,11,'2023-11-24 07:11:02','2023-11-24 07:11:02','voyager.database.index',NULL),(8,1,'Compass','','_self','voyager-compass',NULL,5,12,'2023-11-24 07:11:02','2023-11-24 07:11:02','voyager.compass.index',NULL),(9,1,'BREAD','','_self','voyager-bread',NULL,5,13,'2023-11-24 07:11:02','2023-11-24 07:11:02','voyager.bread.index',NULL),(10,1,'Settings','','_self','voyager-settings',NULL,NULL,14,'2023-11-24 07:11:02','2023-11-24 07:11:02','voyager.settings.index',NULL);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2023-11-24 07:11:02','2023-11-24 07:11:02');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2016_01_01_000000_add_voyager_user_fields',2),(6,'2016_01_01_000000_create_data_types_table',2),(7,'2016_05_19_173453_create_menu_table',2),(8,'2016_10_21_190000_create_roles_table',2),(9,'2016_10_21_190000_create_settings_table',2),(10,'2016_11_30_135954_create_permission_table',2),(11,'2016_11_30_141208_create_permission_role_table',2),(12,'2016_12_26_201236_data_types__add__server_side',2),(13,'2017_01_13_000000_add_route_to_menu_items_table',2),(14,'2017_01_14_005015_create_translations_table',2),(15,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',2),(16,'2017_03_06_000000_add_controller_to_data_types_table',2),(17,'2017_04_21_000000_add_order_to_data_rows_table',2),(18,'2017_07_05_210000_add_policyname_to_data_types_table',2),(19,'2017_08_05_000000_add_group_to_settings_table',2),(20,'2017_11_26_013050_add_user_role_relationship',2),(21,'2017_11_26_015000_create_user_roles_table',2),(22,'2018_03_11_000000_add_user_settings',2),(23,'2018_03_14_000000_add_details_to_data_types_table',2),(24,'2018_03_16_000000_make_settings_value_nullable',2),(25,'2016_06_01_000001_create_oauth_auth_codes_table',3),(26,'2016_06_01_000002_create_oauth_access_tokens_table',3),(27,'2016_06_01_000003_create_oauth_refresh_tokens_table',3),(28,'2016_06_01_000004_create_oauth_clients_table',3),(29,'2016_06_01_000005_create_oauth_personal_access_clients_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('004319a591f23eddf2e78200b50719836b2e4e8007e2838d1f7e0d9564fef2fbd60fe6042777ea98',21,3,'ZUUL Systems','[]',0,'2023-12-22 19:38:37','2023-12-22 19:38:37','2024-12-22 12:38:37'),('01dd1cf6fcfbbe7e51ccdb30604d6b11f5453b1111440dbf2c50eaf6f8b8c92aec727571e5d1dda0',20,7,'ZUUL Systems','[]',0,'2024-01-02 16:21:22','2024-01-02 16:21:22','2025-01-02 09:21:22'),('06154126f73925ac52147edf4416c9a724bbe75dd7fea338c8076cf35748937eb1b3ee2fb9d89c71',40,7,'ZUUL Systems','[]',0,'2024-02-20 05:16:47','2024-02-20 05:16:47','2025-02-20 10:16:47'),('06640be3f8baf8be9e347ff0d6d95c11902b70fd30f6ab2aa795cb8e469a3d3069b676547e0fac5e',20,7,'ZUUL Systems','[]',0,'2024-01-01 19:10:37','2024-01-01 19:10:37','2025-01-01 12:10:37'),('06f8770c99db9e862b79a14b343c7ac132e3c6cf85d2733a6302b480e4cb4233383abe2a4badaae5',20,7,'ZUUL Systems','[]',0,'2024-01-01 19:37:17','2024-01-01 19:37:17','2025-01-01 12:37:17'),('07a2f0116e3a5af50319623f60e9bcd706a616979ecf77e53070df5214b7fd5651821870b844e421',28,7,'ZUUL Systems','[]',0,'2023-12-26 19:53:56','2023-12-26 19:53:56','2024-12-26 12:53:56'),('07d58001f68ad8041e4a54ca5f8c2d6a113b8858eaf1646f9a7bda2bdfebd134fd4991c27b87cb19',8,3,'ZUUL Systems','[]',0,'2023-11-27 22:17:58','2023-11-27 22:17:58','2024-11-27 15:17:58'),('07e4472c3f8c0e000ff825aa960caced0edcd6330f65a1e33a5f851eae6c9de85db9e2170f527dcd',2,7,'ZUUL Systems','[]',0,'2024-01-10 18:03:39','2024-01-10 18:03:39','2025-01-10 11:03:39'),('080707cc6c971948f74df8594dd19cda3243d6544d45bf552c1178351734632f16477e7f89898f71',6,1,'ZUUL Systems','[]',0,'2023-11-25 02:26:20','2023-11-25 02:26:20','2024-11-25 07:26:20'),('0893a83a435a1449703f862e75ad19738f7796fbd172747b7c2d0be2858d4771e5abe32a76073574',21,3,'ZUUL Systems','[]',0,'2023-11-29 19:28:25','2023-11-29 19:28:25','2024-11-29 12:28:25'),('09f8a0156c07cadcccdb4cf954010ddb691d82f2680f101c8ab56c411c7e0a3f1428a129d4844278',36,7,'ZUUL Systems','[]',0,'2024-01-03 17:46:07','2024-01-03 17:46:07','2025-01-03 10:46:07'),('0ce01c2ec4f4f264b4425b4b14be2cd668bdd51c1079966bbe53c138fd623da0f2ceffa111ff9bd3',21,3,'ZUUL Systems','[]',0,'2023-12-01 17:30:44','2023-12-01 17:30:44','2024-12-01 10:30:44'),('0dae3a1bbaedcbd9c1ef77619fc02dbfb12f4780cb25dd0f9ad614cd389918daf3f6c603e201564e',20,7,'ZUUL Systems','[]',0,'2024-01-09 20:51:07','2024-01-09 20:51:07','2025-01-09 13:51:07'),('0e220d9d887b0dfcbee368173e0511e8be6367c6d439a8618471753c58ce37d154ea15d954c64560',39,7,'ZUUL Systems','[]',0,'2024-01-08 20:59:17','2024-01-08 20:59:17','2025-01-08 13:59:17'),('0ee23c575229c4c45628eb03684b0dc5af5eb7dad4c668098a20ae7d0e1cb89460fa8a7634018c98',23,3,'ZUUL Systems','[]',0,'2023-12-22 20:21:19','2023-12-22 20:21:19','2024-12-22 13:21:19'),('107f005bc9f0134cd27c8340b8843aadb8e4be6c01470d25eff73bae4f5ec8396c75e859265a606e',20,7,'ZUUL Systems','[]',0,'2024-01-02 15:01:43','2024-01-02 15:01:43','2025-01-02 08:01:43'),('1150a393562be11ade5f448b1df39790770f442cd244cb546bd7094c6b9e10af5c833db2a41fdce2',2,7,'ZUUL Systems','[]',0,'2024-01-09 19:46:53','2024-01-09 19:46:53','2025-01-09 12:46:53'),('116e6f1b8f90e8c20adbccde94233e19548a5fa5a664911212ff424f0aea529576bb16cc64531f16',39,7,'ZUUL Systems','[]',0,'2024-01-05 17:07:34','2024-01-05 17:07:34','2025-01-05 10:07:34'),('122f349b1b5568c3ab17489e5d364b38cbe9796848a42ee908cffaf687da25586ed026102d905020',6,3,'ZUUL Systems','[]',0,'2023-12-21 18:32:37','2023-12-21 18:32:37','2024-12-21 11:32:37'),('1234fc43f297f9f5df6de8f1f4851c8c9bee2b87609278875cc8984a614ca456b4dd8ebe714f916b',21,3,'ZUUL Systems','[]',0,'2023-12-01 17:42:13','2023-12-01 17:42:13','2024-12-01 10:42:13'),('12b4ec8329e30665556da436c62a5f0ec581326ba5a473180b21b36826b8ff4f07e98ff0a717e394',20,7,'ZUUL Systems','[]',0,'2024-01-09 19:55:29','2024-01-09 19:55:29','2025-01-09 12:55:29'),('13fcdfbf207b1994eb2936512605fced324e7fa52768f57a8359144058cafecc4e40769588d5844b',30,7,'ZUUL Systems','[]',0,'2023-12-29 14:35:02','2023-12-29 14:35:02','2024-12-29 07:35:02'),('157f148e95b4f28b07b3ad8c9e6e48bc7c7494a79328ee63e05dd32f7a350f9ca6275512fc48407b',20,7,'ZUUL Systems','[]',0,'2024-01-01 21:10:54','2024-01-01 21:10:54','2025-01-01 14:10:54'),('175dbf751127d04b54ac0a4567075c0ebc85dffc36255ef9f080f8e6ff0acfe3853673db65f93a0c',20,7,'ZUUL Systems','[]',0,'2023-12-28 18:37:46','2023-12-28 18:37:46','2024-12-28 11:37:46'),('19a27a8284fb54b7656cc01da9dacddaaa46224f02842b6792a602ff6030dcc1242a36ef5472d787',27,7,'ZUUL Systems','[]',0,'2024-01-05 14:22:57','2024-01-05 14:22:57','2025-01-05 07:22:57'),('1a3288f2cac1f3a7c870a228d4181ca931cf8596fa124495eb71504d0d35f5b22a41e8dc799d349f',20,7,'ZUUL Systems','[]',0,'2024-01-01 19:58:09','2024-01-01 19:58:09','2025-01-01 12:58:09'),('1a4a7ae5fcc31ced28fdae5d0f7c404405ab890c1ee8e4b7c6330c569fb288ac3d87a6104e17d917',21,3,'ZUUL Systems','[]',0,'2023-12-01 18:38:05','2023-12-01 18:38:05','2024-12-01 11:38:05'),('1abf6bfe67cafd7d781825adb4fb432dd8955848a8e2ffd1384748132c842da14fd34fcf5078648f',6,1,'ZUUL Systems','[]',0,'2023-11-25 04:53:36','2023-11-25 04:53:36','2024-11-25 09:53:36'),('1addde2ec78c15c3441d4aeb8f979f239c41f2487d55e7dca7e462d6d6b592b288c86b80d083f6f7',36,7,'ZUUL Systems','[]',0,'2024-01-03 18:12:43','2024-01-03 18:12:43','2025-01-03 11:12:43'),('1ba5239d5e5769c5d555c397faf9f2cd2e1ee0b82b21bbe1ff577f69288430cdadaa20c5c68ed82f',30,7,'ZUUL Systems','[]',0,'2023-12-28 15:09:17','2023-12-28 15:09:17','2024-12-28 08:09:17'),('1cb5bce2cc043096ae753f2f4cd4a17f55de287bf82e97d20269b2c66a3bea87cae01241cdeb673d',38,7,'ZUUL Systems','[]',0,'2024-01-10 20:55:39','2024-01-10 20:55:39','2025-01-10 13:55:39'),('1e13600bb2dc6155c71ef4e9c6715bc1d7f95ed0b3f60281ddaa771ff5011eb0777a411fc47a4a05',22,7,'ZUUL Systems','[]',0,'2023-12-26 15:59:37','2023-12-26 15:59:37','2024-12-26 08:59:37'),('1eecc306248d3fa96143b5d7edc05e46208b8f90a41c90740f315d2ebeb9f9a276c142f814fa3c5d',20,7,'ZUUL Systems','[]',0,'2024-01-09 20:03:10','2024-01-09 20:03:10','2025-01-09 13:03:10'),('1f59ce2984e752fec43a740ae14b4fdef178992dbd53201ba45663123d201d753f349f3b8504aebd',40,7,'ZUUL Systems','[]',0,'2024-02-20 08:00:20','2024-02-20 08:00:20','2025-02-20 13:00:20'),('1fea97c79c1081ad72c35f7698dff9ce47889eaaf55619ebe2b334cadb61019af5cde2d7f136247a',20,7,'ZUUL Systems','[]',0,'2024-01-01 20:03:26','2024-01-01 20:03:26','2025-01-01 13:03:26'),('216e7f6b2e6266236b94696afc917ef098a5d873bd8556f92fccdd4ea45d1ce924417dfe6fa25ff2',28,7,'ZUUL Systems','[]',0,'2024-01-01 18:06:30','2024-01-01 18:06:30','2025-01-01 11:06:30'),('22c2ed1b74cbfaeb39a111a65c03b93d49f8ca3855eb7c0836ecba7c2146cff27e50d646a8badf0b',28,7,'ZUUL Systems','[]',0,'2023-12-29 19:43:14','2023-12-29 19:43:14','2024-12-29 12:43:14'),('232cf4ea84bb45e977ffa1bb236279480ae7d69eae510c05eb1be029daf67ad4dfcf5eb53eea52d7',17,7,'ZUUL Systems','[]',0,'2024-01-04 22:45:59','2024-01-04 22:45:59','2025-01-04 15:45:59'),('24f438c5e4f0942380b867d152fd4474903fcdab60042bd9209cac2db7aff6fedf944b4a26374b54',21,3,'ZUUL Systems','[]',0,'2023-11-29 19:28:37','2023-11-29 19:28:37','2024-11-29 12:28:37'),('26fcd6f4ff4d9a486a7e766fd551ffa1cfa727b8a07438a9e5d932641af246f39b1a426a2f3f14cb',20,7,'ZUUL Systems','[]',0,'2024-01-15 18:18:02','2024-01-15 18:18:02','2025-01-15 11:18:02'),('277262ae4ffa292b26ad9ed44e973b1691bb33d0c3c80e75357f1aa3ce343535a0c8e4014f50743c',20,7,'ZUUL Systems','[]',0,'2024-01-01 21:48:26','2024-01-01 21:48:26','2025-01-01 14:48:26'),('29053bfa2f77e1f91c64afc2e8b659de7af787d9d1725592c0d6d9fe095ace6ba320bab1f698f0e6',39,7,'ZUUL Systems','[]',0,'2024-01-09 14:14:12','2024-01-09 14:14:12','2025-01-09 07:14:12'),('29d4c85560c6738ef2c80f4e66fee2c3693e1573d87e5b44fdb399e33996b732eebb8ececb74e536',20,7,'ZUUL Systems','[]',0,'2023-12-26 22:51:23','2023-12-26 22:51:23','2024-12-26 15:51:23'),('29debff6d91f7e0804243601eb1a9fc9140d844b79ccf00b0e25b7654abf4e982735d260151c169e',20,7,'ZUUL Systems','[]',0,'2024-01-02 17:37:08','2024-01-02 17:37:08','2025-01-02 10:37:08'),('2a0bbcb667460c040384b77e04e20d7cbbcffc1861b906db6813cb625c581587c70dc48d24375ec4',36,7,'ZUUL Systems','[]',0,'2024-01-03 18:23:55','2024-01-03 18:23:55','2025-01-03 11:23:55'),('2c9bfb32d0611299ea3938aec7a7030b365429c80da999c111f70d3681ed660109569d38ab94b45d',22,3,'ZUUL Systems','[]',0,'2023-12-26 14:12:16','2023-12-26 14:12:16','2024-12-26 07:12:16'),('2e324a6abb3cc814d4a57281d4d053b93cc22f1463795e52ff540bcda6fcd2c4cb55c893fba9042e',28,7,'ZUUL Systems','[]',0,'2023-12-26 21:33:25','2023-12-26 21:33:25','2024-12-26 14:33:25'),('2ee7572c2887812ec5ea088615446fa5e09b6b616b4934100c3c460dc26ffec4e378ba57c91e936c',38,7,'ZUUL Systems','[]',0,'2024-01-10 18:01:01','2024-01-10 18:01:01','2025-01-10 11:01:01'),('2effbd1673443b045c7a0c15596b439a1a45a6a9d2ff7054288d299ab290aebe848a7d082e0280a0',20,7,'ZUUL Systems','[]',0,'2024-01-04 15:01:42','2024-01-04 15:01:42','2025-01-04 08:01:42'),('2fcfe740122a1e3669e6c7715c11d13cff12e6e5547a65f107d9ec88e9b5c63063b17c373ecb1246',20,7,'ZUUL Systems','[]',0,'2023-12-28 20:40:10','2023-12-28 20:40:10','2024-12-28 13:40:10'),('3281e5b7b392bfad672e8ac0b286368dff5bf65faea14be83211f4ab68a800b1f35f083a537dcf26',20,7,'ZUUL Systems','[]',0,'2024-01-15 18:21:14','2024-01-15 18:21:14','2025-01-15 11:21:14'),('34a85a9c55423fd8d9fd8e71993f090c4217d9199c82ec725bc9268031683b9fce4abd148a467721',22,7,'ZUUL Systems','[]',0,'2023-12-26 15:55:26','2023-12-26 15:55:26','2024-12-26 08:55:26'),('35778ee56182a9a37ecd4b34a06f541b1f808dc67a52a035f8a28378d36857bd087c73e981d676c6',20,7,'ZUUL Systems','[]',0,'2024-01-01 21:46:16','2024-01-01 21:46:16','2025-01-01 14:46:16'),('376df5efc219670390b61c6efa0043ec8bc35676448583b7f67f283b7d8314e03dbd94a5d8212c52',21,3,'ZUUL Systems','[]',0,'2023-12-05 15:35:44','2023-12-05 15:35:44','2024-12-05 08:35:44'),('3852b91cbd8475a588f42349da987f6aa11675eeac252160aaaff1591a904c1c911766704ffa465a',28,7,'ZUUL Systems','[]',0,'2023-12-26 19:53:27','2023-12-26 19:53:27','2024-12-26 12:53:27'),('3a5859e2093f142999b215fc7229c5bc1c22260faa430fbf52ba557ab787c76dc179b60658a5ac5f',38,7,'ZUUL Systems','[]',0,'2024-01-11 14:47:00','2024-01-11 14:47:00','2025-01-11 07:47:00'),('3bdc13bd3bc6dc9214883361372fe3c9f8888d40e50b10692ae28c43c17bd6d1eab63a0eae168378',20,7,'ZUUL Systems','[]',0,'2024-01-04 14:06:43','2024-01-04 14:06:43','2025-01-04 07:06:43'),('3ce48fbcbcdbc8cb42fb7a918a6c01b7662c22b5d2db2e60038b65e6c72e7ae28253d930341865c8',8,3,'ZUUL Systems','[]',0,'2023-11-27 22:33:37','2023-11-27 22:33:37','2024-11-27 15:33:37'),('3d6e416aadfac450f6ac62ee6b593a2bede704c0dc4fb23faa49381da07b0b273b9295da5719f6da',30,7,'ZUUL Systems','[]',0,'2023-12-29 16:57:29','2023-12-29 16:57:29','2024-12-29 09:57:29'),('3de056f5499351d79314e6551477e226c092912430c7fd04d09d9132d3c68b2ab86245226d4f3ab0',20,7,'ZUUL Systems','[]',0,'2024-01-01 20:03:58','2024-01-01 20:03:58','2025-01-01 13:03:58'),('3e408be200968604d5df658f56f238abb6bd85177b9b9b7a033769ce9d38d0f71b3beb79f57f41f6',20,7,'ZUUL Systems','[]',0,'2024-01-09 19:42:02','2024-01-09 19:42:02','2025-01-09 12:42:02'),('403847f0987392e0d36caaa16d24aceb8f667d1b552f0647706a72e550fd15deb620035b8c21df65',28,7,'ZUUL Systems','[]',0,'2023-12-27 15:42:05','2023-12-27 15:42:05','2024-12-27 08:42:05'),('40dffb0d58acf6b0205f1dea6abefe82fc0724fb8d4bcb3b3c0a4504ed6894445add4fe2894cc5f1',2,7,'ZUUL Systems','[]',0,'2024-01-10 18:39:36','2024-01-10 18:39:36','2025-01-10 11:39:36'),('412e0d36f072eada3b658f716139d8fe5e13016ff6abff20d5850d9354a02c3d1b4a2994beac01e2',31,7,'ZUUL Systems','[]',0,'2024-01-04 19:20:12','2024-01-04 19:20:12','2025-01-04 12:20:12'),('41e52bacc394a6a14367da1e4b9307d5403c9059fee5b5a03c9b101147734ae555902acb85eeaa98',31,7,'ZUUL Systems','[]',0,'2024-01-04 16:47:19','2024-01-04 16:47:19','2025-01-04 09:47:19'),('4291daaf3f9a5ccb87c2d9e32b7475b44b258e47b6e432c691385954725cdb504c5ba686c0d5a8c0',2,7,'ZUUL Systems','[]',0,'2024-01-09 17:18:05','2024-01-09 17:18:05','2025-01-09 10:18:05'),('44e30cc9e0cc831759c07205af8040fed39abc26226eee80194aeaac3785ec460dc7b212dbe27265',20,7,'ZUUL Systems','[]',0,'2023-12-26 22:53:35','2023-12-26 22:53:35','2024-12-26 15:53:35'),('46343f0ddea45c2b348c96e41843271afb807b0a2dd20d68fa56c2da54f7f2ff2ac7cf0e16769513',6,1,'ZUUL Systems','[]',0,'2023-11-25 02:25:40','2023-11-25 02:25:40','2024-11-25 07:25:40'),('47340fe7fff0181cb0a0c47c6999a146cd2a3fb50f70cd6a07656bea26b2659f348a4ab3b1d86ba8',2,7,'ZUUL Systems','[]',0,'2024-01-12 13:44:53','2024-01-12 13:44:53','2025-01-12 06:44:53'),('47afef43ac70938056e624f7cf50ad0f1884f77a0af002c5ca2d004b1d31d105dcb9ef105476929f',21,3,'ZUUL Systems','[]',0,'2023-12-22 17:18:10','2023-12-22 17:18:10','2024-12-22 10:18:10'),('4aa5a59b8aad2fec3216c62ebb0eb633f7d2858e32452df5e6ae87015ae2c2f226f54a5a8aacafc6',21,3,'ZUUL Systems','[]',0,'2023-11-29 19:37:57','2023-11-29 19:37:57','2024-11-29 12:37:57'),('4f50cccd8bb494a0c5202e22946d5d335202e380f5c4be780032dda47a27e1116e85876ed0792945',20,7,'ZUUL Systems','[]',0,'2024-01-02 16:46:40','2024-01-02 16:46:40','2025-01-02 09:46:40'),('4fbba4c543302cf732fa49a2d87d40808d0f9630302a735ee7b1c953744f4972483e51a72e2c5b1e',38,7,'ZUUL Systems','[]',0,'2024-01-09 22:23:39','2024-01-09 22:23:39','2025-01-09 15:23:39'),('4fc7d9111b7851124a585413d07b0796c94b945c7b1949da5ab80f3733f08f98b03a0076012e48f8',21,3,'ZUUL Systems','[]',0,'2023-12-05 15:54:58','2023-12-05 15:54:58','2024-12-05 08:54:58'),('514e415fbb606dd6d614369331c5ddb988530e3bbab3fac7c6ebfb36210d2088dc6197d40ae0e97c',21,3,'ZUUL Systems','[]',0,'2023-12-05 18:33:20','2023-12-05 18:33:20','2024-12-05 11:33:20'),('51ded094a8ad6fbde238fdbc26a2d7985503926ea17b4ef5ac67c483541794fbd8454e997fc2bbb9',21,3,'ZUUL Systems','[]',0,'2023-11-29 23:34:35','2023-11-29 23:34:35','2024-11-29 16:34:35'),('5460d9b3649e4cf20fb6538fdbc5496bbf88a8091d4a0d422b7b373ec2723caf6037c90db216540a',20,7,'ZUUL Systems','[]',0,'2024-01-01 18:36:35','2024-01-01 18:36:35','2025-01-01 11:36:35'),('54b7aa43cf34cbd23f991e2d6253ea930cd4834c2527baa76977979e21b00953bc3f949b3ac69785',2,7,'ZUUL Systems','[]',0,'2024-01-12 16:55:50','2024-01-12 16:55:50','2025-01-12 09:55:50'),('55bc0d371a695b8bef300924b884059cdfb3dace2dacbdf05243b2a3fb07eef904f1e08b1f2ed62a',40,7,'ZUUL Systems','[]',0,'2024-02-17 03:43:55','2024-02-17 03:43:55','2025-02-17 08:43:55'),('55e3ef1892f4f1711278c87c4ce2da6203bc1f61e4290f81e635a8856856aabb08362d73092cc93d',2,7,'ZUUL Systems','[]',0,'2024-01-10 17:49:12','2024-01-10 17:49:12','2025-01-10 10:49:12'),('564c9a2169b9439bf6162245c89ff8e5c28e46a6174c026f904a1d23563b62ba310aaaa415277972',2,7,'ZUUL Systems','[]',0,'2024-01-10 19:08:24','2024-01-10 19:08:24','2025-01-10 12:08:24'),('580cb4d8bfa8751a4b40f214a432df7136b91a04b584b8acb13dca1bed6fce80f3a41fc34bfdcd2d',23,3,'ZUUL Systems','[]',0,'2023-12-22 19:52:22','2023-12-22 19:52:22','2024-12-22 12:52:22'),('58cd72f8d961bc925461eea35c6a8a06da06170352e447999d5391c2f2c579cb4ff4e9032146f0f4',20,3,'ZUUL Systems','[]',0,'2023-12-05 18:32:28','2023-12-05 18:32:28','2024-12-05 11:32:28'),('58d6c02c7397d628202fc0ac376a58abbdff6055901e11c747800d8c386935617007c6f811028903',30,7,'ZUUL Systems','[]',0,'2024-01-10 16:33:36','2024-01-10 16:33:36','2025-01-10 09:33:36'),('58e99bf6a25046504b2376ea13240bbc1c1af72a77e7ebf1a0c174fd5686c44a2e266557e53a688b',38,7,'ZUUL Systems','[]',0,'2024-01-10 19:22:23','2024-01-10 19:22:24','2025-01-10 12:22:23'),('5b58c91479aeae1dbf443845c95f1b6c9e561b358592fd629f2b23e580329d665bb550076d863751',2,7,'ZUUL Systems','[]',0,'2024-01-10 17:23:53','2024-01-10 17:23:53','2025-01-10 10:23:53'),('5d2dea63f766b8bd66da174aeac4bb2f4c59a6c390d2445416fdcb0e03198b33e1838e1aea655be8',2,7,'ZUUL Systems','[]',0,'2024-01-10 19:16:10','2024-01-10 19:16:10','2025-01-10 12:16:10'),('5e9d2d8b37d6bcf8f7295381a2fd7944baf0b93aa77384c4c420ecedf0f13000167c3b6ac470e214',20,7,'ZUUL Systems','[]',0,'2024-01-15 18:07:43','2024-01-15 18:07:43','2025-01-15 11:07:43'),('5fce67cd7e8b45186d320fc253f5ab24ef7e0f99674027eb36bec7e417f13486a49e71fdb31a29ad',22,7,'ZUUL Systems','[]',0,'2023-12-26 15:48:43','2023-12-26 15:48:43','2024-12-26 08:48:43'),('6046495251c6a45f8d8d41ba33617f26ab993e8261c68f253b6e5de95ef84b102f80871037152cc6',27,7,'ZUUL Systems','[]',0,'2024-01-02 21:32:33','2024-01-02 21:32:34','2025-01-02 14:32:33'),('67603e7b11522c281811ff00fc78eebaa06eba3e5bf318f3fa88c14f62cc5cb745a25eeb28fdebf1',20,7,'ZUUL Systems','[]',0,'2024-01-02 15:27:29','2024-01-02 15:27:29','2025-01-02 08:27:29'),('67b45daa44bbfa99edf70c62a7ddc94d0f9cfc0ccee7393bda0a4d30ada952d5cb22a3fc7f14d9d7',20,7,'ZUUL Systems','[]',0,'2024-01-01 21:10:48','2024-01-01 21:10:48','2025-01-01 14:10:48'),('69b78a65e14d05d2b4404fd98ed4a94b475e311688768e6d8d8d9f341bc8fc2fd2c5ad430acc13fc',21,3,'ZUUL Systems','[]',0,'2023-12-06 15:18:13','2023-12-06 15:18:13','2024-12-06 08:18:13'),('69c0038580d40af49fbffdbd248c499ab0ca2a898488fd6d0bc952fe27ba51b22b248f57950d776d',40,7,'ZUUL Systems','[]',0,'2024-02-20 05:17:21','2024-02-20 05:17:21','2025-02-20 10:17:21'),('6b07f9a87814ce3ffc39263ae8e107ff5b97d62b0ef87c6aa4a188f2ee8fd244f97adab14b18a981',28,7,'ZUUL Systems','[]',0,'2023-12-26 21:50:25','2023-12-26 21:50:25','2024-12-26 14:50:25'),('6cd7bee99b1e251a3978f7f305fbcd2217fba9cd18b003dc8baa1ac7da58637310ace8e5f020306f',28,7,'ZUUL Systems','[]',0,'2023-12-26 20:37:42','2023-12-26 20:37:42','2024-12-26 13:37:42'),('706bff8ff825f64264a079f8d0830a6298614c3ad9f06ab4db093e369ca29fdf401b74282b14a18d',30,7,'ZUUL Systems','[]',0,'2023-12-29 17:43:36','2023-12-29 17:43:36','2024-12-29 10:43:36'),('70e66011ea58547bc8d22afd066612fb3c763141a57ee75bbc34649215311a8270a3e1d020884154',21,3,'ZUUL Systems','[]',0,'2023-11-29 23:23:14','2023-11-29 23:23:14','2024-11-29 16:23:14'),('71ad88feb86ac08baf4be890184a5fb37cac62335b0de78d747b85959e718865277547e56d9827c5',20,7,'ZUUL Systems','[]',0,'2024-01-01 21:59:34','2024-01-01 21:59:34','2025-01-01 14:59:34'),('7307748588eb0d6eba8b2bd347891fc209424c380aeda9e1461dc9b5e50391db63f83e708e2edce7',20,7,'ZUUL Systems','[]',0,'2024-01-02 15:01:03','2024-01-02 15:01:04','2025-01-02 08:01:03'),('73b7fe6d7ebf8fd31bc5fce57b7b3e3377b20c97b22faf3c634e1e3de22cf14add5ac8a8b370149a',28,7,'ZUUL Systems','[]',0,'2023-12-26 20:33:49','2023-12-26 20:33:49','2024-12-26 13:33:49'),('75a393d910bdee6e8b5469cca2d2dedcef16032395acf28682b0a0eef4b24e7011dce3930675ff57',31,7,'ZUUL Systems','[]',0,'2024-01-04 15:25:49','2024-01-04 15:25:49','2025-01-04 08:25:49'),('75ba73ad88573aeab930b0f3297930a9089775a2971270288a65237f97b884523cb7fb848ede5e0f',21,3,'ZUUL Systems','[]',0,'2023-12-22 09:43:31','2023-12-22 09:43:31','2024-12-22 02:43:31'),('75f3506200cb7d78ad31dcc4209c143fd2eb58bd68415d5d0c76a98ddaa51e35c4e32ed31e5e7d1f',2,7,'ZUUL Systems','[]',0,'2024-01-11 13:45:36','2024-01-11 13:45:36','2025-01-11 06:45:36'),('763e0cc0a82283caf59303280731d59823b094b40f04f52772cc7e412ce39562c8b7b26a39fc4a83',28,7,'ZUUL Systems','[]',0,'2024-01-01 18:26:45','2024-01-01 18:26:45','2025-01-01 11:26:45'),('7680ae434ec21dc3bbd5a492727155b5e184f90e7eba60b25aa4622b7d03f51d02e82e10de11ba0d',28,7,'ZUUL Systems','[]',0,'2023-12-26 17:46:27','2023-12-26 17:46:27','2024-12-26 10:46:27'),('78a6d7eb0512dbb345386b6f457763e328e64525a1eaecbc95356ec0e7715cb642a944098f3eecfa',21,3,'ZUUL Systems','[]',0,'2023-11-29 23:22:09','2023-11-29 23:22:09','2024-11-29 16:22:09'),('7ae86b6acc89145484c4f00a9e0ab6bd7b9360865d6096932657c228f479fee2b37fa4575f96a433',20,7,'ZUUL Systems','[]',0,'2024-01-12 21:27:49','2024-01-12 21:27:49','2025-01-12 14:27:49'),('7bb32f66d09b6fa8f59822f96488a9279948253ecd30d3ea347d0fb20e01d31e72235357e8bbb4bb',30,7,'ZUUL Systems','[]',0,'2023-12-28 14:42:33','2023-12-28 14:42:33','2024-12-28 07:42:33'),('7f70cf54c18b0404dc8e001ee7769e161f4f30f05de682bfae336b89655eba8fb093eb9b94eeb090',20,7,'ZUUL Systems','[]',0,'2023-12-26 22:48:44','2023-12-26 22:48:44','2024-12-26 15:48:44'),('80b5906f4924081301f553d8131f9ada9ee3fa7ff526c1a468deabec33e4035b8aa15fd1d3a32eaf',28,7,'ZUUL Systems','[]',0,'2023-12-28 17:32:09','2023-12-28 17:32:09','2024-12-28 10:32:09'),('81a52009facc8144efccc1479dd9499cc54f5d96bd81571e5225f11bf74808bcfb0d64288c7aae92',35,7,'ZUUL Systems','[]',0,'2024-01-02 16:48:09','2024-01-02 16:48:09','2025-01-02 09:48:09'),('83a6dff8a8c4f7d36db5cd4ee03a8c764d0d675ad868211061a524334b3ae4207a2e00f6490f261d',28,7,'ZUUL Systems','[]',0,'2023-12-26 23:11:44','2023-12-26 23:11:44','2024-12-26 16:11:44'),('83fc46928da694a58d8636c608b1fc02f916d8573f86cb6456c4c3720526a19075b1c079d14b26a2',30,7,'ZUUL Systems','[]',0,'2023-12-28 14:45:11','2023-12-28 14:45:11','2024-12-28 07:45:11'),('847886b8ad3dd7a0bc60904e80345f28ccb6f4e5e8dec683a5079b2c990971d92c4976423a68837d',28,7,'ZUUL Systems','[]',0,'2023-12-29 18:21:57','2023-12-29 18:21:57','2024-12-29 11:21:57'),('848eb14d13d6e11374b372123c93ac9b43eb0f30a59ed3c33bf28ba7656c88f8274f6942fa037abc',20,7,'ZUUL Systems','[]',0,'2024-01-12 17:16:34','2024-01-12 17:16:34','2025-01-12 10:16:34'),('87d5d0ef685aad2be710ec0ff09c84c2eb0c0e803e7f08ef6f014fb1604a37da4cfc598a607bc914',21,3,'ZUUL Systems','[]',0,'2023-11-29 22:11:50','2023-11-29 22:11:50','2024-11-29 15:11:50'),('89a3a35e4f208cc72684431de40362c75c453b4aa792a19d260ba167c95f5f5e40b0ea3c97f6a382',20,7,'ZUUL Systems','[]',0,'2024-01-12 21:06:52','2024-01-12 21:06:52','2025-01-12 14:06:52'),('8a5f6d7a23e45a8ccab244389bdb5b78dc301e4ab3bc35a30fa562dd6239d1d7801c397c6bb09567',28,7,'ZUUL Systems','[]',0,'2023-12-26 19:52:50','2023-12-26 19:52:50','2024-12-26 12:52:50'),('8c3f2eed64877c3c4e1044be0ef365cecfb1a707672103bfe33edabb0400cb89b97386f6a45a7d82',40,7,'ZUUL Systems','[]',0,'2024-02-18 10:12:01','2024-02-18 10:12:01','2025-02-18 15:12:01'),('8cd66e984f79dc0fcb253b2cc890f9861ce00643e96cd671337f60701a1ebcb0039d92db2a4e58e7',39,7,'ZUUL Systems','[]',0,'2024-01-04 16:42:13','2024-01-04 16:42:13','2025-01-04 09:42:13'),('8fa079c82148c976e074eeab59f4211ebdf8be4ab0bc0386564ab28e24d8ad83b3ece5950a69f462',22,3,'ZUUL Systems','[]',0,'2023-12-26 14:14:47','2023-12-26 14:14:47','2024-12-26 07:14:47'),('911ac976785eee85b2a2448f52da2a05087973a574bd1bbe95e9b3c4dcea704d9454e4d6d27f2212',20,7,'ZUUL Systems','[]',0,'2024-01-02 21:10:35','2024-01-02 21:10:35','2025-01-02 14:10:35'),('940fd59d7f8477207ae96fac6bd48ca604f3c31d360ca125f823a9cd981d0e8da89db2dd67a4c59d',20,7,'ZUUL Systems','[]',0,'2024-01-01 20:03:20','2024-01-01 20:03:20','2025-01-01 13:03:20'),('9414e2b5aaa9949a8be20eda8f01809d4dc0277a98bff3c236919cf9d1ad82a2e9deaf14a7ad89cd',22,3,'ZUUL Systems','[]',0,'2023-12-05 15:54:47','2023-12-05 15:54:47','2024-12-05 08:54:47'),('94b2b9b4f663d501a8fde9a6ae9152571e9f8b1ad69023403ba9b2e475240c59d23eb9abd7a17c07',21,3,'ZUUL Systems','[]',0,'2023-11-29 19:36:14','2023-11-29 19:36:14','2024-11-29 12:36:14'),('958a91ffb63844a3bfb93fad6ded6afe5836db6e22312e33bd1e8c4233595ce5b8cf870064f94b8b',28,7,'ZUUL Systems','[]',0,'2023-12-27 15:11:38','2023-12-27 15:11:38','2024-12-27 08:11:38'),('968ed05bc791aa0dd2755b276bf4bbcb33811cad96050115a5dc332c8722fcb3d985991ed8da198d',21,3,'ZUUL Systems','[]',0,'2023-12-01 17:24:33','2023-12-01 17:24:33','2024-12-01 10:24:33'),('9842cbc2172d5d34d37733ffafc4385ce4ba8d9c292cea57868e8362850a2c5e9947eea0b531d15d',28,7,'ZUUL Systems','[]',0,'2023-12-28 20:51:10','2023-12-28 20:51:10','2024-12-28 13:51:10'),('98b18033cadf00cc3ef6eb1945e3e1f39f27ccfae11872f0aa98acb8c29c3d67d151f46cc3d98e00',23,3,'ZUUL Systems','[]',0,'2023-12-22 20:58:10','2023-12-22 20:58:10','2024-12-22 13:58:10'),('98fbadf09ef17cd66738297b241fa65e1b29200dc3048f973aa9ab3a0cdaa8880bd035f197627387',27,7,'ZUUL Systems','[]',0,'2024-01-03 14:06:45','2024-01-03 14:06:45','2025-01-03 07:06:45'),('9ae215b9033659d6aa3d889e1b75fde4a9c9312edb90ab758bb5a744f77c2665faea2fe40296a672',27,7,'ZUUL Systems','[]',0,'2023-12-28 14:24:46','2023-12-28 14:24:47','2024-12-28 07:24:46'),('9b566d03032494c47a1dcffd00a25a845911a9d8115cf1c101c287ce9c7446c6644baaf9414fd07d',20,3,'ZUUL Systems','[]',0,'2023-12-08 19:44:55','2023-12-08 19:44:55','2024-12-08 12:44:55'),('9c0d9ab06f7a2459727d3606a703ded22fed4a47f8fe8428d5b8a58597f992cf4a17b34bca00a49a',27,7,'ZUUL Systems','[]',0,'2024-01-08 15:55:13','2024-01-08 15:55:13','2025-01-08 08:55:13'),('9d5a1f30f66dbdcb855d4c798ae1db477053d80bd308f68d032434b10dfdec3a2e430c1d0d933f08',28,7,'ZUUL Systems','[]',0,'2023-12-26 21:45:26','2023-12-26 21:45:26','2024-12-26 14:45:26'),('9d7453e8dc44dcbc00dcd349fde1e7ff29399066319916feda6a42edf64199ed9f5c06d1ca0830b9',20,7,'ZUUL Systems','[]',0,'2024-01-09 20:35:32','2024-01-09 20:35:32','2025-01-09 13:35:32'),('9f3e3e1b1c770c67afc5217983a8df10dd3f3822f7d971cbeb4cf4097fea894e5270e9e4d7f1a0a9',38,7,'ZUUL Systems','[]',0,'2024-01-10 18:05:49','2024-01-10 18:05:49','2025-01-10 11:05:49'),('a10fe1cf896d7bde1506c326a31d12e89b4240415a6a66ed4ba82b02ea72011484738501ba360fa8',40,7,'ZUUL Systems','[]',0,'2024-02-18 10:22:21','2024-02-18 10:22:21','2025-02-18 15:22:21'),('a19bb98c3bbcade12501d7d5863c5240bd383d42eb21ea89d1a5e8d03665eedd15e2500a82adb120',40,7,'ZUUL Systems','[]',0,'2024-02-20 05:19:04','2024-02-20 05:19:04','2025-02-20 10:19:04'),('a1ce9003105d4063a50446c76df66e00df3b817d8bb7e1d4290f5ab4607a21927f571dfdc611ec1d',23,7,'ZUUL Systems','[]',0,'2023-12-26 17:42:41','2023-12-26 17:42:41','2024-12-26 10:42:41'),('a2a4b6536170179bc6a3dec67ca3cca41cec2bb0f92af958a1b09fb7cb6187ece0587bb16d5bd7a0',2,7,'ZUUL Systems','[]',0,'2024-01-10 19:31:37','2024-01-10 19:31:37','2025-01-10 12:31:37'),('a546ac9f3db953042616248e1c92666e9e4631ceea5af6bd2a9eea2455461ed4f31bae20b5a85c5e',40,7,'ZUUL Systems','[]',0,'2024-02-18 10:10:41','2024-02-18 10:10:41','2025-02-18 15:10:41'),('a69259f2cbd8aede012b0559c796be8ad92c43ec0dd1f207a889ebea2fbc6b5e59c666c63366bea2',2,7,'ZUUL Systems','[]',0,'2024-01-10 18:35:10','2024-01-10 18:35:10','2025-01-10 11:35:10'),('a923429af56827175c2677b2b9a8c8bf43087fd386ae5d7486ba41937b249398479cba1240c1cad1',2,7,'ZUUL Systems','[]',0,'2024-01-10 19:34:21','2024-01-10 19:34:21','2025-01-10 12:34:21'),('ac01b0fc3585c5ec7d9cbee26bf19fa431a936b1b833532221f3e6384be852a4827620a7891db4e7',23,7,'ZUUL Systems','[]',0,'2023-12-26 17:36:39','2023-12-26 17:36:39','2024-12-26 10:36:39'),('ad5a6c332ee9002149341f8926c95c63467a6db518a9bc5021273cd30fc6088deff79bc24d5610d7',39,7,'ZUUL Systems','[]',0,'2024-01-05 14:52:48','2024-01-05 14:52:49','2025-01-05 07:52:48'),('ade931a974e7c5114022237ae17bca2b0204f6316675dbd569f6a4a966f3dc3bb88853fc4d4300e7',2,7,'ZUUL Systems','[]',0,'2024-01-11 14:52:29','2024-01-11 14:52:29','2025-01-11 07:52:29'),('ae374e276eb0db142042a430fb8b1bfb4f7cd1dccf4ee8e07313f8f230817e092c007dc621e8a825',30,7,'ZUUL Systems','[]',0,'2023-12-28 20:38:38','2023-12-28 20:38:38','2024-12-28 13:38:38'),('b299996e6b5b2856117da4eec42ec484864127d11940a16a85323e86fb58d94b582f7b295cc8f1bf',23,3,'ZUUL Systems','[]',0,'2023-12-22 20:24:06','2023-12-22 20:24:06','2024-12-22 13:24:06'),('b3015e5c3c6b013d454f55c7dc3ea412edb19cb69477d43c3fb535c3706c797d4b12347226ef34e6',27,7,'ZUUL Systems','[]',0,'2024-01-02 14:43:11','2024-01-02 14:43:12','2025-01-02 07:43:11'),('b469d021001a5849256c8a7775eda6f6439a61a67bb38f8358f82d304a4ed556dd27cea44e01eec9',21,3,'ZUUL Systems','[]',0,'2023-12-01 17:38:07','2023-12-01 17:38:08','2024-12-01 10:38:07'),('b4d3d0bfd90b49acaa8a056bee3d8d003c2217146f12d369d5cef60bb7f2931edc0bb593ecdccf51',2,7,'ZUUL Systems','[]',0,'2024-01-09 17:10:18','2024-01-09 17:10:18','2025-01-09 10:10:18'),('b5126d0abfc8ff8db2a42d541b3e3af119ee56b5fa8c64cd8bf180280cfb8176894aaf6882b5e31c',2,7,'ZUUL Systems','[]',0,'2024-01-08 18:44:11','2024-01-08 18:44:11','2025-01-08 11:44:11'),('b57ffbbc7e7e848295bcaf284b4e5415973225b0b7fb1b69478edf5c509a3bb4e8739d7f7107e447',22,7,'ZUUL Systems','[]',0,'2023-12-26 15:54:06','2023-12-26 15:54:06','2024-12-26 08:54:06'),('b6441c1637666ade3a7e43dd7381bd92b83edb7f0523fd57a90d0c87f3d0f3bdd04e052eeabd3912',40,7,'ZUUL Systems','[]',0,'2024-02-20 05:16:30','2024-02-20 05:16:30','2025-02-20 10:16:30'),('b8b15049283461ba74ec41e2a40c4b6c440af1ee114f28e4b4f685801bae71d82dfe5bc1b831b6b9',27,7,'ZUUL Systems','[]',0,'2023-12-26 15:20:53','2023-12-26 15:20:53','2024-12-26 08:20:53'),('ba720f8159a2de1b0eac744d123bf473fc5c407d24b370b8cf6cddd98eb247d257b9177546905dfe',20,7,'ZUUL Systems','[]',0,'2024-01-02 13:37:02','2024-01-02 13:37:02','2025-01-02 06:37:02'),('baab004ee826aa6b88aa1d7f03e47922a44cfcddb581da226c9beb154ab6768b32aa8672c21db480',6,1,'ZUUL Systems','[]',0,'2023-11-25 02:27:27','2023-11-25 02:27:27','2024-11-25 07:27:27'),('bbdc675a5b5c89a5c7e1238d68097b7fb32db5128da50fe55d25bcdcd25c4be2be784b82e924f939',2,7,'ZUUL Systems','[]',0,'2024-01-11 13:55:43','2024-01-11 13:55:43','2025-01-11 06:55:43'),('bf8877737313352f3e4ed9ee8e9f389bca778639023bec3aed10244ca9d003a136decc442604053b',20,3,'ZUUL Systems','[]',0,'2023-12-26 14:10:50','2023-12-26 14:10:51','2024-12-26 07:10:50'),('c03e09b329a702c5b6415d06a7cb5e969f521c35611b073069360cb52388aa85c1fb16cdd9996d3e',21,3,'ZUUL Systems','[]',0,'2023-12-22 21:06:17','2023-12-22 21:06:17','2024-12-22 14:06:17'),('c0ae2c107f0da7cca0d1843a0aae236b64250e5cc00d5ccf2d28a3f7ecdeb6ddde030a90308be3d7',20,7,'ZUUL Systems','[]',0,'2023-12-27 22:26:26','2023-12-27 22:26:26','2024-12-27 15:26:26'),('c1219cdaa9c1f9ad02fe73226553b233f04e4b8071de618f84f024540464bd838b7e50f876c5ed60',28,7,'ZUUL Systems','[]',0,'2023-12-28 17:32:09','2023-12-28 17:32:09','2024-12-28 10:32:09'),('c1da8094f5d28d4994fe6a8dcb12f421d1f99674189222a09fae68dd2200c52aa5fd85ee7b995997',8,3,'ZUUL Systems','[]',0,'2023-11-27 22:36:13','2023-11-27 22:36:13','2024-11-27 15:36:13'),('c1dadc30d9003fffab5b47c4f993e3efbc7d7c867b5b872ff81ff33906b836cfc42a227a48a96e7d',21,3,'ZUUL Systems','[]',0,'2023-12-21 17:03:09','2023-12-21 17:03:09','2024-12-21 10:03:09'),('c36478c9d877c934c3bd21f60ca7e6ec89d67465cfb92502de787ea8bd6a5cc35b6305849db8c22f',20,7,'ZUUL Systems','[]',0,'2023-12-28 21:23:34','2023-12-28 21:23:34','2024-12-28 14:23:34'),('c5bded57bbc535bf0f7f94704eb08695662c6eae9599eca629a9d8e81a169ca42c6ca7cf587e3363',23,7,'ZUUL Systems','[]',0,'2023-12-26 17:43:43','2023-12-26 17:43:43','2024-12-26 10:43:43'),('c5f528e005fa69bbd93aada09ae2361c30b526fc2a4d9bdbc4055168cb257743a76b88495b7a3306',39,7,'ZUUL Systems','[]',0,'2024-01-08 18:43:14','2024-01-08 18:43:14','2025-01-08 11:43:14'),('c76e28a3dea5e5709999ddb51091bfc8ffc5422b100f463980ddb8dbddfec1efd20de92e58003d9f',38,7,'ZUUL Systems','[]',0,'2024-01-09 22:25:32','2024-01-09 22:25:32','2025-01-09 15:25:32'),('c82327078c78c96852b1b34cdba79138d5a98c7bc122d4d4e0b5c6fb8054e7099089785c51d51e6a',20,7,'ZUUL Systems','[]',0,'2024-01-09 21:59:44','2024-01-09 21:59:44','2025-01-09 14:59:44'),('c8a524413470d025f35d0624e67a07266aa1dea0fd4e518f633035d0f3b004430b1fdc4e0bc678de',20,7,'ZUUL Systems','[]',0,'2023-12-29 18:35:03','2023-12-29 18:35:03','2024-12-29 11:35:03'),('c92a24d00723191d96858d0e8910714305e7530b11c4432c99d09dac5e12ebf0acd22c0cdaeb1754',20,7,'ZUUL Systems','[]',0,'2023-12-29 14:32:19','2023-12-29 14:32:19','2024-12-29 07:32:19'),('c93cfed4eedb7e0ba330249f57ef48130d3cef7009f7466dd14d834c365d4c19fe604109ac8d1a87',2,7,'ZUUL Systems','[]',0,'2024-01-12 14:36:44','2024-01-12 14:36:44','2025-01-12 07:36:44'),('ca8d40c15b124d41a8eee3dd89631c643e0ef2416077d29a6177fe85eda86468179b192709cafe70',38,7,'ZUUL Systems','[]',0,'2024-01-10 17:23:29','2024-01-10 17:23:29','2025-01-10 10:23:29'),('cb8b69e7e04271391b535938c8c52a34b22eb3a19a79a6606089e98ac159ef707a3a5d21231de49e',20,7,'ZUUL Systems','[]',0,'2024-01-01 19:58:52','2024-01-01 19:58:52','2025-01-01 12:58:52'),('cb977d0cea1ed4f02b98cb05b24f3196d2bb9bc7ad8f065253001f1ca6e0f6202be8af9e74ce1f71',21,3,'ZUUL Systems','[]',0,'2023-12-22 21:03:34','2023-12-22 21:03:34','2024-12-22 14:03:34'),('cc47029a3d12ccb5f9c563aca682ce057a2b09090d7cbfa753387b1f85ae5139a2bcec46ab7b1511',21,3,'ZUUL Systems','[]',0,'2023-12-22 21:35:18','2023-12-22 21:35:18','2024-12-22 14:35:18'),('ccc46fe6131ef948b75afdbfc8124b151260dd07aa5af4464c5985769f342f11576903285bb3815b',20,7,'ZUUL Systems','[]',0,'2024-01-10 19:26:44','2024-01-10 19:26:44','2025-01-10 12:26:44'),('ccf5123b299b9e1bcd616fc55207fbd3d5203a3d9f5510dbae9ad1abc93a24fa75aa4fbe9187d473',2,7,'ZUUL Systems','[]',0,'2024-01-10 19:12:02','2024-01-10 19:12:02','2025-01-10 12:12:02'),('ce5fa7b330dff759641364bee552f89e51cd92511c0ca6298d9ced5f7a9e8776c93db523e800ee0f',30,7,'ZUUL Systems','[]',0,'2023-12-28 14:56:55','2023-12-28 14:56:55','2024-12-28 07:56:55'),('cf87dab4e434ddb66b62591f66f789000ff8150300b4d74d2cff9732fa1623acc7ffa86e93384dcf',23,3,'ZUUL Systems','[]',0,'2023-12-26 14:12:35','2023-12-26 14:12:35','2024-12-26 07:12:35'),('d0b5791d7720171deead06fdf174ff5237d43c2f4e806c83d486747e78dac5ec380777dff21056b7',20,7,'ZUUL Systems','[]',0,'2024-01-16 15:05:47','2024-01-16 15:05:47','2025-01-16 08:05:47'),('d0f1009329f1d82161a49474524a82806c50726feb7a95088aee5c8c76520d90abc33fc66bf78963',39,7,'ZUUL Systems','[]',0,'2024-01-05 14:53:20','2024-01-05 14:53:21','2025-01-05 07:53:20'),('d17ca0ac773d49e8b4dd21417676499ac469da99905ec24df95a8d773ccb3d09f75ff18e02d0d1fc',20,7,'ZUUL Systems','[]',0,'2024-01-09 20:34:24','2024-01-09 20:34:24','2025-01-09 13:34:24'),('d279074e3e65a7d5e5d65429ff8be9eebd6e387164dcc57e98c93854408e7eed5aa8bb55b709cee7',20,7,'ZUUL Systems','[]',0,'2024-01-03 16:26:44','2024-01-03 16:26:44','2025-01-03 09:26:44'),('d2aec90708fbea8db6e0554ee07bd3993ccba192def4f2c6cb1f132255583a788b35bd8c2aa7d10e',20,7,'ZUUL Systems','[]',0,'2024-01-15 18:09:06','2024-01-15 18:09:06','2025-01-15 11:09:06'),('d4b2da35826119121945dcb383b6cf1dcd7b50270394ab20eda073285878d360e0161d3513ae914d',21,3,'ZUUL Systems','[]',0,'2023-11-29 19:53:07','2023-11-29 19:53:07','2024-11-29 12:53:07'),('d4d5280f322e8021c58eac5ce1eb25dfaddd2cc8bf7c5785fb10d986a069de3bba778004e79c8bba',20,7,'ZUUL Systems','[]',0,'2024-01-01 19:38:21','2024-01-01 19:38:21','2025-01-01 12:38:21'),('d63ac6f39e3214eadfb53d8c0ec4983f3273a3d551d5e53048d56f1dfaa490b8d3ef90f86706ee6c',28,7,'ZUUL Systems','[]',0,'2023-12-26 21:55:28','2023-12-26 21:55:28','2024-12-26 14:55:28'),('d7b215f7dee79aac572a530b95404a9192b8f6244af15eed5c79eaeb468c5cf881e72df7e8ed3777',23,3,'ZUUL Systems','[]',0,'2023-12-22 21:40:53','2023-12-22 21:40:53','2024-12-22 14:40:53'),('d7de86daa8834af10423410b9ffccbd6fc3f80387367b382610ace7325453127b4f0ae048b02642e',27,7,'ZUUL Systems','[]',0,'2024-01-03 17:38:54','2024-01-03 17:38:55','2025-01-03 10:38:54'),('d83bf8682019de68024a7418b13897f3aa3978ae1c8ba5ae4874342c738bba55e0ba331ceafbd05b',2,7,'ZUUL Systems','[]',0,'2024-01-10 20:50:45','2024-01-10 20:50:45','2025-01-10 13:50:45'),('d9af68b3fd674527f6c04a561a208fdba5027dde2bea3a6d7ce58e754af2c5d843bd9d57bf7c7b09',20,7,'ZUUL Systems','[]',0,'2024-01-04 17:21:21','2024-01-04 17:21:21','2025-01-04 10:21:21'),('d9baf8d012aec5105ddb1eb929d305d618aa29b49b480b70ac820a4d08d1527efb735e0984d43800',2,7,'ZUUL Systems','[]',0,'2024-01-10 17:19:12','2024-01-10 17:19:12','2025-01-10 10:19:12'),('dd4b7e83b13d6835061acf60b8104bc87789fe346c8ed4466ae9fa09aa3771ccfa2073bbcbdf18e1',2,7,'ZUUL Systems','[]',0,'2024-01-11 14:37:12','2024-01-11 14:37:12','2025-01-11 07:37:12'),('de05127daa6853f335672380ef49a3a0fd7badfef4d6074155fa0c0f3b02fe2c3dcff1bc6a53e8cc',20,7,'ZUUL Systems','[]',0,'2024-01-01 21:43:14','2024-01-01 21:43:14','2025-01-01 14:43:14'),('df5fbc77477aed11bef2f90e4f349870899bf66768f1acea9503ce5ad8c106c8a754f0c2a0a9627d',20,7,'ZUUL Systems','[]',0,'2024-01-01 19:35:22','2024-01-01 19:35:22','2025-01-01 12:35:22'),('dff06ae43e2fa1fb6fea72b7ac1f9c7ff570a8ea159c04c48d789834ff3a896d6b84f4582648ac18',6,1,'ZUUL Systems','[]',0,'2023-11-25 05:03:09','2023-11-25 05:03:09','2024-11-25 10:03:09'),('e475a71e17b90d65ec022fc4bf7c1a199a36b37deef8fccdffb97c897eb9e54a17cdc813e8ba4e1d',2,7,'ZUUL Systems','[]',0,'2024-01-01 18:29:46','2024-01-01 18:29:46','2025-01-01 11:29:46'),('e47671d4040e4f63fcf7b48939e7261eee92b0f1cdb8ab658612d42eea55171a7c0635c86f875c92',6,1,'ZUUL Systems','[]',0,'2023-11-25 02:27:08','2023-11-25 02:27:08','2024-11-25 07:27:08'),('e556f5ce63ba18c512a8b92fbf387d770369af7870590db2249b3c773465644067851dba88f79cba',36,7,'ZUUL Systems','[]',0,'2024-01-04 22:43:10','2024-01-04 22:43:10','2025-01-04 15:43:10'),('e6580784b3362ff5a1563ba6690daecf7d1c848e632f2c5a2a073572ab27c6668a34fa647343f919',20,7,'ZUUL Systems','[]',0,'2024-01-02 16:44:01','2024-01-02 16:44:01','2025-01-02 09:44:01'),('ea5bec994767c934190fb7a9a98e303e072a2a41913526d88634764195bc6a896e9c4bae1cb7d8d5',21,3,'ZUUL Systems','[]',0,'2023-11-29 21:05:57','2023-11-29 21:05:57','2024-11-29 14:05:57'),('ebc7432971bb1d9964fa7253ca6f32e83bd306644d13904c049e7bda8ff47bc028c0ff848c212744',20,7,'ZUUL Systems','[]',0,'2024-01-02 13:35:22','2024-01-02 13:35:22','2025-01-02 06:35:22'),('ecc4861f3f6cfe7d2231606d5eead1704f10de19a1ab9166d2ecfe83f2a32bc6ca69b64211205544',20,7,'ZUUL Systems','[]',0,'2024-01-01 20:03:52','2024-01-01 20:03:52','2025-01-01 13:03:52'),('ecde0add806d72cfafe2d2d442be6bc83c207e5800fbef3ec5d10d926b28bc25d028ff8e5575168b',21,3,'ZUUL Systems','[]',0,'2023-11-29 23:20:43','2023-11-29 23:20:43','2024-11-29 16:20:43'),('ef8fb4fcf47213e1d2b826d411a6107018462087c8d8ed58f3c55949d60a8173e8737cab15c48d8d',21,3,'ZUUL Systems','[]',0,'2023-11-30 20:39:01','2023-11-30 20:39:01','2024-11-30 13:39:01'),('f314f36f72a3ff1408ccffae2f9daeef0320e83c258b018f5be50780972aeea4713bcc634e16e2c1',20,7,'ZUUL Systems','[]',0,'2024-01-15 18:10:41','2024-01-15 18:10:41','2025-01-15 11:10:41'),('f5ea5c73819d6934c85dfa3fa0b7a0b772d2f37e46528f4c76121918db7a78fd2bf57316033945d4',8,3,'ZUUL Systems','[]',0,'2023-11-27 22:39:12','2023-11-27 22:39:12','2024-11-27 15:39:12'),('f644d4c173a7d6a407198cef79c6fc3b4df37a15ec2b7ab74025a2d3a2f93beeb2b8b7a9c34d41c9',23,3,'ZUUL Systems','[]',0,'2023-12-22 21:41:32','2023-12-22 21:41:32','2024-12-22 14:41:32'),('f6476a636dddb4b7c78e2f4176fbc4e501ea71ab75fceb420659cf8061c4dbb2b9ce830931d5fb02',27,7,'ZUUL Systems','[]',0,'2024-01-05 18:00:32','2024-01-05 18:00:32','2025-01-05 11:00:32'),('f70cbd42c57154175e2b429e6d85646238a8b0e6d5fe2541cdca5449124ae81829d2fbdece4de044',20,7,'ZUUL Systems','[]',0,'2024-01-03 17:42:55','2024-01-03 17:42:55','2025-01-03 10:42:55'),('f73ef5a555ecc8ad523b20a828c75f486def8fe8c6edf1b4089a294a00361872e8d1058cada1e8e7',30,7,'ZUUL Systems','[]',0,'2023-12-28 14:52:32','2023-12-28 14:52:33','2024-12-28 07:52:32'),('fa8489483344519dfb5507420cb724a090d462090ba356b1e09c4d0f24b5cf3a8078d2017f61eff3',21,3,'ZUUL Systems','[]',0,'2023-11-29 19:50:45','2023-11-29 19:50:45','2024-11-29 12:50:45'),('fae400f09a13f17e59e30b5fb1420015795f0553e7e3112c964720e812e603211b68987dd147a4f7',28,7,'ZUUL Systems','[]',0,'2023-12-26 22:04:02','2023-12-26 22:04:02','2024-12-26 15:04:02'),('fc86b7b14e7acf31f366c666515e25577fdd0394dd17456a53f6259795dc2bb927f8e41fbf7ca884',38,7,'ZUUL Systems','[]',0,'2024-01-04 16:45:44','2024-01-04 16:45:44','2025-01-04 09:45:44'),('fd3dacbaeb41e2540bef09456ea76c289528ab7fa9f1913720b7b2ecf2469b76f0ee2b9e6758e13b',28,7,'ZUUL Systems','[]',0,'2023-12-27 21:59:22','2023-12-27 21:59:22','2024-12-27 14:59:22'),('feaae2ae3cc3a784078d9c96846b72c06c8c1383f68789f851df971adf9f05f621f046a95570b59e',28,7,'ZUUL Systems','[]',0,'2023-12-28 20:50:21','2023-12-28 20:50:21','2024-12-28 13:50:21');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Laravel Personal Access Client','ZS6DUyAyYhMXAD4sOvK5jMv9H1AvAyrIvB1tkPIY',NULL,'http://localhost',1,0,0,'2023-11-24 07:13:01','2023-11-24 07:13:01'),(2,NULL,'Laravel Password Grant Client','3xRHpNCyv6YTUDr90SEE1jOihzZXThA92zk3rije','users','http://localhost',0,1,0,'2023-11-24 07:13:01','2023-11-24 07:13:01'),(3,NULL,'Laravel Personal Access Client','pxIvFG6bcAU963KdeQtJSNUd13hIuzm8712bEmXw',NULL,'http://localhost',1,0,0,'2023-11-27 22:17:37','2023-11-27 22:17:37'),(4,NULL,'Laravel Password Grant Client','1UK5awle8zL84TKdJvl7sl5WZ7yyxlTMvMag2x4w','users','http://localhost',0,1,0,'2023-11-27 22:17:37','2023-11-27 22:17:37'),(5,NULL,'Laravel Personal Access Client','ueiU4RPLWofadS1e8mySuLZ3I7NY4II8UKRsK7n4',NULL,'http://localhost',1,0,0,'2023-12-26 14:20:08','2023-12-26 14:20:08'),(6,NULL,'Laravel Password Grant Client','deVv0YC3kefKS5227fyh4TZlvFjeappkvpW1Rgxg','users','http://localhost',0,1,0,'2023-12-26 14:20:08','2023-12-26 14:20:08'),(7,NULL,'Laravel Personal Access Client','eOVFw1OUsYgaEpAUDwhKYzRaIXhKZCg2CFMQFhEf',NULL,'http://localhost',1,0,0,'2023-12-26 15:15:49','2023-12-26 15:15:49'),(8,NULL,'Laravel Password Grant Client','pCnz7FXUWBNsn6QBguQJMlueoUxlC11iEOpbJQCn','users','http://localhost',0,1,0,'2023-12-26 15:15:49','2023-12-26 15:15:49');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2023-11-24 07:13:01','2023-11-24 07:13:01'),(2,3,'2023-11-27 22:17:37','2023-11-27 22:17:37'),(3,5,'2023-12-26 14:20:08','2023-12-26 14:20:08'),(4,7,'2023-12-26 15:15:49','2023-12-26 15:15:49');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_facilities`
--

DROP TABLE IF EXISTS `package_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `package_facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_facilities`
--

LOCK TABLES `package_facilities` WRITE;
/*!40000 ALTER TABLE `package_facilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `package_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_users`
--

DROP TABLE IF EXISTS `package_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `package_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_users`
--

LOCK TABLES `package_users` WRITE;
/*!40000 ALTER TABLE `package_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `package_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2023-11-24 07:11:02','2023-11-24 07:11:02'),(2,'browse_bread',NULL,'2023-11-24 07:11:02','2023-11-24 07:11:02'),(3,'browse_database',NULL,'2023-11-24 07:11:02','2023-11-24 07:11:02'),(4,'browse_media',NULL,'2023-11-24 07:11:02','2023-11-24 07:11:02'),(5,'browse_compass',NULL,'2023-11-24 07:11:02','2023-11-24 07:11:02'),(6,'browse_menus','menus','2023-11-24 07:11:02','2023-11-24 07:11:02'),(7,'read_menus','menus','2023-11-24 07:11:02','2023-11-24 07:11:02'),(8,'edit_menus','menus','2023-11-24 07:11:02','2023-11-24 07:11:02'),(9,'add_menus','menus','2023-11-24 07:11:02','2023-11-24 07:11:02'),(10,'delete_menus','menus','2023-11-24 07:11:02','2023-11-24 07:11:02'),(11,'browse_roles','roles','2023-11-24 07:11:02','2023-11-24 07:11:02'),(12,'read_roles','roles','2023-11-24 07:11:02','2023-11-24 07:11:02'),(13,'edit_roles','roles','2023-11-24 07:11:02','2023-11-24 07:11:02'),(14,'add_roles','roles','2023-11-24 07:11:02','2023-11-24 07:11:02'),(15,'delete_roles','roles','2023-11-24 07:11:02','2023-11-24 07:11:02'),(16,'browse_users','users','2023-11-24 07:11:02','2023-11-24 07:11:02'),(17,'read_users','users','2023-11-24 07:11:02','2023-11-24 07:11:02'),(18,'edit_users','users','2023-11-24 07:11:02','2023-11-24 07:11:02'),(19,'add_users','users','2023-11-24 07:11:02','2023-11-24 07:11:02'),(20,'delete_users','users','2023-11-24 07:11:02','2023-11-24 07:11:02'),(21,'browse_settings','settings','2023-11-24 07:11:02','2023-11-24 07:11:02'),(22,'read_settings','settings','2023-11-24 07:11:02','2023-11-24 07:11:02'),(23,'edit_settings','settings','2023-11-24 07:11:02','2023-11-24 07:11:02'),(24,'add_settings','settings','2023-11-24 07:11:02','2023-11-24 07:11:02'),(25,'delete_settings','settings','2023-11-24 07:11:02','2023-11-24 07:11:02');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `last_active_hour` time DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qrcodes`
--

DROP TABLE IF EXISTS `qrcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qrcodes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `space_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `qr_code` varchar(191) NOT NULL,
  `is_scan` int(11) DEFAULT NULL,
  `scan_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qrcodes`
--

LOCK TABLES `qrcodes` WRITE;
/*!40000 ALTER TABLE `qrcodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `qrcodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','2023-11-24 07:11:02','2023-11-24 07:11:02'),(2,'user','Normal User','2023-11-24 07:11:02','2023-11-24 07:11:02'),(3,'guard','Guard','2023-11-24 07:11:02','2023-11-24 07:11:02'),(4,'space_admin','Space Admin','2023-12-27 22:56:21','2023-12-27 22:56:21'),(5,'space_owner','Space Owner','2023-12-27 22:56:47','2023-12-27 22:56:47'),(6,'space_guard','Space Guard','2023-12-27 22:56:47','2023-12-27 22:56:47');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site.title','Site Title','Site Title','','text',1,'Site'),(2,'site.description','Site Description','Site Description','','text',2,'Site'),(3,'site.logo','Site Logo','','','image',3,'Site'),(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID','','','text',4,'Site'),(5,'admin.bg_image','Admin Background Image','','','image',5,'Admin'),(6,'admin.title','Admin Title','Voyager','','text',1,'Admin'),(7,'admin.description','Admin Description','Welcome to Voyager. The Missing Admin for Laravel','','text',2,'Admin'),(8,'admin.loader','Admin Loader','','','image',3,'Admin'),(9,'admin.icon_image','Admin Icon Image','','','image',4,'Admin'),(10,'admin.google_analytics_client_id','Google Analytics Client ID (used for admin dashboard)','','','text',1,'Admin');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `space_admins`
--

DROP TABLE IF EXISTS `space_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `space_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `space_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `space_admins`
--

LOCK TABLES `space_admins` WRITE;
/*!40000 ALTER TABLE `space_admins` DISABLE KEYS */;
INSERT INTO `space_admins` VALUES (1,40,NULL,1,5,'2024-02-19 10:34:02','2024-02-19 10:34:02'),(2,40,NULL,2,5,'2024-02-19 10:34:38','2024-02-19 10:34:38'),(3,40,NULL,3,5,'2024-02-19 10:42:47','2024-02-19 10:42:47'),(4,40,NULL,4,5,'2024-02-20 10:21:39','2024-02-20 10:21:39');
/*!40000 ALTER TABLE `space_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spaces`
--

DROP TABLE IF EXISTS `spaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `spaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spaces`
--

LOCK TABLES `spaces` WRITE;
/*!40000 ALTER TABLE `spaces` DISABLE KEYS */;
INSERT INTO `spaces` VALUES (1,40,'hfghfh','hfghfgh',NULL,'ghfghgf','2024-02-19 10:34:02','2024-02-19 10:34:02'),(2,40,'gsdfgdsjh1','ghjhgkjfdh',NULL,'ghjhgkjgfrd','2024-02-19 10:34:38','2024-02-19 10:34:38'),(3,40,'tet','ertete',NULL,'tet','2024-02-19 10:42:47','2024-02-19 10:42:47'),(4,40,'roudi','rewatertre',NULL,'fdsafsds','2024-02-20 10:21:39','2024-02-20 10:21:39');
/*!40000 ALTER TABLE `spaces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) NOT NULL,
  `column_name` varchar(255) NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_codes`
--

DROP TABLE IF EXISTS `user_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_codes`
--

LOCK TABLES `user_codes` WRITE;
/*!40000 ALTER TABLE `user_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_id_index` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `dial_code` varchar(10) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `settings` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Super Admin','superadmin@email.com',NULL,NULL,'users/default.png',NULL,'$2y$12$SnRJdWddHhn/bpJHHgOHk.6I/6o/szIRbqN94keeX9.SA0gydlSAy',NULL,NULL,'2024-02-17 03:08:54','2024-02-17 03:08:54'),(40,2,'shoaib uddin','shoaibuddin12fx@gmail.com','03432322008','+92','users/default.png',NULL,'$2y$12$lsdXdjdDr26TQVHSyYLnr.v2rpsNwS6b/2OJxAi2lsI86ruZYDOHm',NULL,NULL,'2024-02-17 03:43:31','2024-02-17 03:43:31');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(191) DEFAULT NULL,
  `model` varchar(191) DEFAULT NULL,
  `year` varchar(191) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `licence_plate` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `space_id` int(10) DEFAULT NULL,
  `activation_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `vehicle_type` varchar(191) DEFAULT NULL,
  `tag` varchar(191) DEFAULT NULL,
  `policy_number` int(11) DEFAULT NULL,
  `policy_expiration_date` date DEFAULT NULL,
  `Insurance_company_name` varchar(191) DEFAULT NULL,
  `Windshield_parking_sticker` varchar(191) DEFAULT NULL,
  `traffic_tickets-count` int(11) DEFAULT NULL,
  `traffic_tickets-count_ten_digits` int(11) DEFAULT NULL,
  `user_full_name` varchar(191) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-20 21:02:59