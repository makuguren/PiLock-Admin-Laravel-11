
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint DEFAULT '0' COMMENT '0=None, 1=Male, 2=Female',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Super','Admin','superadmin@gmail.com',0,NULL,'$2y$12$0.vGkQAbgC4PP27F4nnFKOd8iNzkZnUNLC4pX96bIFZHPF5TLJc4a',NULL,'2024-11-12 05:05:45','2024-11-12 05:05:45','light'),(2,'Mark Glen','Miguel','mamiguel@mail.com',1,NULL,'$2y$12$T45oHGJgWSctyIc4dazJ8Ohjr7oCcKX3b/ZpnQXWSBHEBwRITlQRS',NULL,'2024-11-20 02:32:05','2024-11-20 05:34:38',NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `archives` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `snapshot_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `snapshot_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` enum('First','Second') COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Inactive, 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `archives` WRITE;
/*!40000 ALTER TABLE `archives` DISABLE KEYS */;
/*!40000 ALTER TABLE `archives` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned DEFAULT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `time_attend` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `isPresent` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=Absent, 1=Present',
  `isCurrent` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=No, 1=Yes',
  `isMakeUp` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=Regular, 1=MakeUp',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_student_id_foreign` (`student_id`),
  KEY `attendances_course_id_foreign` (`course_id`),
  CONSTRAINT `attendances_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,44,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(2,41,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(3,46,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(4,42,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(5,40,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(6,52,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(7,45,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(8,50,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(9,55,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(10,49,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(11,48,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(12,58,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(13,57,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(14,51,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(15,43,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(16,65,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(17,47,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(18,64,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(19,56,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(20,62,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(21,67,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(22,63,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(23,39,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(24,69,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(25,66,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(26,71,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(27,68,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(28,72,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(29,73,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(30,60,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(31,61,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(32,54,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(33,53,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(34,59,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(35,70,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL),(36,75,20,NULL,'2024-11-12','16:00:00','0','1','0',NULL,NULL);
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `blocked_student_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocked_student_courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blocked_student_courses_course_id_foreign` (`course_id`),
  KEY `blocked_student_courses_student_id_foreign` (`student_id`),
  CONSTRAINT `blocked_student_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `blocked_student_courses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `blocked_student_courses` WRITE;
/*!40000 ALTER TABLE `blocked_student_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocked_student_courses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:55:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"View Dashboard\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"View RFID Checker\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:14:\"View Analytics\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:16:\"View Attendances\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:24:\"View Current Attendances\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"View Sections\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"Create Sections\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"Update Sections\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"Delete Sections\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"View Courses\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:14:\"Create Courses\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:14:\"Update Courses\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:14:\"Delete Courses\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:13:\"View Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"Create Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"Update Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:15:\"Delete Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:23:\"Add Tag UID to Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:12:\"Disable RFID\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:16:\"View Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:18:\"Create Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:18:\"Update Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:18:\"Delete Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:26:\"Add Tag UID to Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:11:\"View Events\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:13:\"Create Events\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:13:\"Update Events\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:13:\"Delete Events\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:22:\"View Regular Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:24:\"Create Regular Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:24:\"Update Regular Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:24:\"Delete Regular Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:22:\"View Make-Up Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:24:\"Create Make-Up Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:24:\"Update Make-Up Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:24:\"Delete Make-Up Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:27:\"View Make-Up SchedApprovals\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:30:\"Approve Make-Up SchedApprovals\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:30:\"Decline Make-Up SchedApprovals\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:11:\"View Admins\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:13:\"Create Admins\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:13:\"Update Admins\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:13:\"Delete Admins\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:15:\"Add Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:10:\"View Roles\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:12:\"Create Roles\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:12:\"Update Roles\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:12:\"Delete Roles\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:16:\"View Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:18:\"Create Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:18:\"Update Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:18:\"Delete Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:9:\"View Logs\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:13:\"View Settings\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:15:\"Update Settings\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"Super-Admin\";s:1:\"c\";s:5:\"admin\";}}}',1732157784);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` bigint unsigned DEFAULT NULL,
  `faculty_id` bigint unsigned DEFAULT NULL,
  `course_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_section_id_foreign` (`section_id`),
  KEY `courses_faculty_id_foreign` (`faculty_id`),
  CONSTRAINT `courses_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  CONSTRAINT `courses_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'ITA 215','Networking 1',5,1,'eyJpdiI6IkV5b3dOdzhiZTZvSGx1UkxwZHNZV1E9PSIsInZhbHVlIjoiOUN4LzIrVkh2WWV4Tzlldlc1T3ZFdz09IiwibWFjIjoiYzg4M2Q3MDZlYTJkOWZhMWE5ZjM0Yjg4YjA0MzFmNWUyODExMDE1OTA4NjFhY2NhMDQwOGUzN2Q3MDNjYWZjMyIsInRhZyI6IiJ9','2024-11-12 05:12:50','2024-11-12 05:12:50'),(20,'IT 213','Object Oriented Programming',11,2,'eyJpdiI6IjY3K0s4NUtGOHBTU3lXL3J2RzFkWHc9PSIsInZhbHVlIjoiOFd5WTVtVHZvaDhMalk3OTBEQS9Pdz09IiwibWFjIjoiMTRkN2I3NTNiYzc2ZDRhNmU5YjI0M2I5MWEwNmM0ZTU1NWI0OGEzY2FiY2VlMDhkZjk4OWMwZWRjODA0ZDQ3ZiIsInRhZyI6IiJ9','2024-11-12 05:14:04','2024-11-12 05:23:43');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `enrolledcourses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrolledcourses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned DEFAULT NULL,
  `student_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enrolledcourses_course_id_foreign` (`course_id`),
  KEY `enrolledcourses_student_id_foreign` (`student_id`),
  CONSTRAINT `enrolledcourses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `enrolledcourses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `enrolledcourses` WRITE;
/*!40000 ALTER TABLE `enrolledcourses` DISABLE KEYS */;
INSERT INTO `enrolledcourses` VALUES (1,1,5,'2024-10-14 17:25:40','2024-10-14 17:25:40'),(2,1,3,'2024-10-14 17:26:02','2024-10-14 17:26:02'),(3,1,2,'2024-10-14 17:26:20','2024-10-14 17:26:20'),(4,1,4,'2024-10-14 17:26:37','2024-10-14 17:26:37'),(5,1,1,'2024-10-14 17:27:57','2024-10-14 17:27:57'),(6,1,6,'2024-10-14 17:28:02','2024-10-14 17:28:02'),(7,1,7,'2024-10-14 17:42:14','2024-10-14 17:42:14'),(8,1,9,'2024-10-14 17:46:42','2024-10-14 17:46:42'),(9,1,8,'2024-10-14 17:47:06','2024-10-14 17:47:06'),(10,1,12,'2024-10-14 17:47:29','2024-10-14 17:47:29'),(11,1,11,'2024-10-14 17:47:47','2024-10-14 17:47:47'),(12,1,13,'2024-10-14 17:48:15','2024-10-14 17:48:15'),(13,1,10,'2024-10-14 17:48:40','2024-10-14 17:48:40'),(14,1,15,'2024-10-14 17:51:50','2024-10-14 17:51:50'),(15,1,17,'2024-10-14 17:52:10','2024-10-14 17:52:10'),(16,1,16,'2024-10-14 17:54:09','2024-10-14 17:54:09'),(17,1,19,'2024-10-14 17:54:28','2024-10-14 17:54:28'),(18,1,14,'2024-10-14 17:54:44','2024-10-14 17:54:44'),(19,1,18,'2024-10-14 17:55:01','2024-10-14 17:55:01'),(20,1,20,'2024-10-14 17:56:06','2024-10-14 17:56:06'),(21,2,22,'2024-10-14 17:57:36','2024-10-14 17:57:36'),(22,1,20,'2024-10-14 17:58:08','2024-10-14 17:58:08'),(23,1,23,'2024-10-14 17:59:17','2024-10-14 17:59:17'),(24,1,24,'2024-10-14 17:59:35','2024-10-14 17:59:35'),(25,1,25,'2024-10-14 17:59:53','2024-10-14 17:59:53'),(26,1,28,'2024-10-14 18:02:22','2024-10-14 18:02:22'),(27,1,24,'2024-10-14 18:02:42','2024-10-14 18:02:42'),(28,1,29,'2024-10-14 18:03:07','2024-10-14 18:03:07'),(29,1,27,'2024-10-14 18:03:22','2024-10-14 18:03:22'),(30,1,26,'2024-10-14 18:03:42','2024-10-14 18:03:42'),(31,1,17,'2024-10-14 18:04:02','2024-10-14 18:04:02'),(32,1,21,'2024-10-14 18:04:20','2024-10-14 18:04:20'),(33,1,30,'2024-10-14 18:04:36','2024-10-14 18:04:36'),(34,1,31,'2024-10-14 18:04:56','2024-10-14 18:04:56'),(35,1,32,'2024-10-14 18:05:31','2024-10-14 18:05:31'),(36,1,34,'2024-10-14 18:07:09','2024-10-14 18:07:09'),(37,1,33,'2024-10-14 18:07:38','2024-10-14 18:07:38'),(38,1,35,'2024-10-14 18:08:52','2024-10-14 18:08:52'),(39,1,37,'2024-10-14 18:09:58','2024-10-14 18:09:58'),(40,1,36,'2024-10-14 18:11:27','2024-10-14 18:11:27'),(41,20,44,'2024-10-14 22:17:39','2024-10-14 22:17:39'),(42,20,41,'2024-10-14 22:17:43','2024-10-14 22:17:43'),(43,20,46,'2024-10-14 22:17:53','2024-10-14 22:17:53'),(44,20,42,'2024-10-14 22:18:05','2024-10-14 22:18:05'),(45,20,40,'2024-10-14 22:18:06','2024-10-14 22:18:06'),(46,20,52,'2024-10-14 22:18:10','2024-10-14 22:18:10'),(47,20,45,'2024-10-14 22:18:18','2024-10-14 22:18:18'),(48,20,50,'2024-10-14 22:18:34','2024-10-14 22:18:34'),(49,20,55,'2024-10-14 22:18:37','2024-10-14 22:18:37'),(50,20,49,'2024-10-14 22:18:50','2024-10-14 22:18:50'),(51,20,48,'2024-10-14 22:18:51','2024-10-14 22:18:51'),(52,20,58,'2024-10-14 22:19:09','2024-10-14 22:19:09'),(53,20,57,'2024-10-14 22:19:26','2024-10-14 22:19:26'),(54,20,51,'2024-10-14 22:19:42','2024-10-14 22:19:42'),(55,20,43,'2024-10-14 22:20:07','2024-10-14 22:20:07'),(56,20,65,'2024-10-14 22:20:18','2024-10-14 22:20:18'),(57,20,47,'2024-10-14 22:20:32','2024-10-14 22:20:32'),(58,20,64,'2024-10-14 22:20:36','2024-10-14 22:20:36'),(59,20,56,'2024-10-14 22:20:39','2024-10-14 22:20:39'),(60,20,62,'2024-10-14 22:20:39','2024-10-14 22:20:39'),(61,20,67,'2024-10-14 22:20:40','2024-10-14 22:20:40'),(62,20,63,'2024-10-14 22:20:42','2024-10-14 22:20:42'),(63,20,39,'2024-10-14 22:21:08','2024-10-14 22:21:08'),(64,20,69,'2024-10-14 22:21:11','2024-10-14 22:21:11'),(65,20,66,'2024-10-14 22:21:45','2024-10-14 22:21:45'),(66,20,71,'2024-10-14 22:23:39','2024-10-14 22:23:39'),(67,20,68,'2024-10-14 22:24:07','2024-10-14 22:24:07'),(68,20,72,'2024-10-14 22:24:36','2024-10-14 22:24:36'),(69,20,73,'2024-10-14 22:24:37','2024-10-14 22:24:37'),(70,20,60,'2024-10-14 22:25:29','2024-10-14 22:25:29'),(71,20,61,'2024-10-14 22:25:43','2024-10-14 22:25:43'),(72,20,54,'2024-10-14 22:25:48','2024-10-14 22:25:48'),(73,20,53,'2024-10-14 22:25:50','2024-10-14 22:25:50'),(74,20,59,'2024-10-14 22:26:02','2024-10-14 22:26:02'),(75,20,70,'2024-10-14 22:27:54','2024-10-14 22:27:54'),(76,20,75,'2024-11-12 05:28:07','2024-11-12 05:28:07');
/*!40000 ALTER TABLE `enrolledcourses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `event_start` time NOT NULL,
  `event_end` time NOT NULL,
  `isCurrent` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `faculties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faculties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tag_uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `gender` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=None, 1=Male, 2=Female',
  `faculty_theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isDefaultPass` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=No, 1=Yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `faculties_email_unique` (`email`),
  UNIQUE KEY `faculties_tag_uid_unique` (`tag_uid`),
  UNIQUE KEY `faculties_google_id_unique` (`google_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `faculties` WRITE;
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` VALUES (1,NULL,'Rey','Cortez','recortez@cspc.edu.ph',NULL,'$2y$12$mpeXytr8veLPsEXZkDLgIekLAmT8MSxRnaDR3dUXww/F3gpdfx49y',NULL,'2024-08-19 23:15:28','2024-10-14 22:23:17',NULL,NULL,NULL,'0',NULL,'0'),(2,NULL,'Jayvee','Sias','jvsias@cspc.edu.ph',NULL,'$2y$12$hfZLlI4zFhVdaBIs0euKQOAr7jdI1IwilbfLXabTQyec36tIXE5ue',NULL,'2024-08-19 23:15:50','2024-10-14 22:23:47','0725633421',NULL,NULL,'1','light','0'),(3,NULL,'Mark Joseph','Narvadez','manarvadez@cspc.edu.ph',NULL,'$2y$12$5mdwg9jWjPyiWIbFjashw.XrLtjfMws7ahoEMYTrt1zC6E9hWJMOK',NULL,'2024-08-19 23:16:25','2024-08-19 23:16:25',NULL,NULL,NULL,'0',NULL,'1'),(4,NULL,'Eisen Rose','Galvante','eigalvante@cspc.edu.ph',NULL,'$2y$12$jQkf3vTznoIj8QHttva/hetqajs41n9gshDRMrTw/3l8WYCzUdx4O',NULL,'2024-08-19 23:16:49','2024-08-19 23:16:49',NULL,NULL,NULL,'0',NULL,'1'),(5,NULL,'Vencel','Sanglay','vesanglay@cspc.edu.ph',NULL,'$2y$12$IGRIh5IR8nrNNSEjKd6ujuuEaCVLU5YqFi9P9kKke39pLU5EvSZFa',NULL,'2024-08-19 23:17:13','2024-08-19 23:17:13',NULL,NULL,NULL,'0',NULL,'1'),(6,NULL,'Derick','Parañal','deparanal@cspc.edu.ph',NULL,'$2y$12$H1OqtIJxZ4tA31o9rkbmtuwQ6FmKFcU1kg2SPRduE15Z7zSPTP/Y.',NULL,'2024-08-19 23:17:35','2024-08-19 23:17:35',NULL,NULL,NULL,'0',NULL,'1'),(7,NULL,'Mark Anthony','Taduran','mataduran@cspc.edu.ph',NULL,'$2y$12$VAYKCDnaatNCoinXPUWBvOkk.pg98mL5J2f7Rlv/.pyOEr3f2/Bne',NULL,'2024-08-19 23:17:55','2024-08-19 23:17:55',NULL,NULL,NULL,'0',NULL,'1'),(8,NULL,'Philip Alger','Serrano','phserrano@cspc.edu.ph',NULL,'$2y$12$rZNirXdmnkWiUwHAOkLrsOavDI7Bp4x4co0nOtbzpjwpgI0os2wcK',NULL,'2024-10-15 02:01:49','2024-10-15 02:01:49',NULL,NULL,NULL,'0',NULL,'1');
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `faculty_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faculty_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_logs_course_id_foreign` (`course_id`),
  CONSTRAINT `faculty_logs_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `faculty_logs` WRITE;
/*!40000 ALTER TABLE `faculty_logs` DISABLE KEYS */;
INSERT INTO `faculty_logs` VALUES (1,20,'14:40:03','14:44:02','2024-10-15','2024-10-14 22:40:03','2024-10-14 22:44:02'),(2,20,'14:49:18','14:49:39','2024-10-15','2024-10-14 22:49:18','2024-10-14 22:49:39'),(3,20,'14:52:09','15:00:07','2024-10-15','2024-10-14 22:52:09','2024-10-14 23:00:07');
/*!40000 ALTER TABLE `faculty_logs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned DEFAULT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_student_id_foreign` (`student_id`),
  KEY `logs_course_id_foreign` (`course_id`),
  CONSTRAINT `logs_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `logs_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,44,20,'14:40:23',NULL,'2024-10-15','2024-10-14 22:40:23','2024-10-14 22:40:23'),(2,71,20,'14:40:38',NULL,'2024-10-15','2024-10-14 22:40:38','2024-10-14 22:40:38'),(3,67,20,'14:40:49','14:56:17','2024-10-15','2024-10-14 22:40:49','2024-10-14 22:56:17'),(4,41,20,'14:40:57',NULL,'2024-10-15','2024-10-14 22:40:57','2024-10-14 22:40:57'),(5,41,20,'14:40:58',NULL,'2024-10-15','2024-10-14 22:40:58','2024-10-14 22:40:58'),(6,52,20,'14:41:02',NULL,'2024-10-15','2024-10-14 22:41:02','2024-10-14 22:41:02'),(7,69,20,'14:41:12',NULL,'2024-10-15','2024-10-14 22:41:12','2024-10-14 22:41:12'),(8,57,20,'14:41:22',NULL,'2024-10-15','2024-10-14 22:41:22','2024-10-14 22:41:22'),(9,57,20,'14:41:23',NULL,'2024-10-15','2024-10-14 22:41:23','2024-10-14 22:41:23'),(10,47,20,'14:41:26',NULL,'2024-10-15','2024-10-14 22:41:26','2024-10-14 22:41:26'),(11,47,20,'14:41:27',NULL,'2024-10-15','2024-10-14 22:41:27','2024-10-14 22:41:27'),(12,45,20,'14:41:30',NULL,'2024-10-15','2024-10-14 22:41:30','2024-10-14 22:41:30'),(13,45,20,'14:41:31',NULL,'2024-10-15','2024-10-14 22:41:31','2024-10-14 22:41:31'),(14,46,20,'14:41:34',NULL,'2024-10-15','2024-10-14 22:41:34','2024-10-14 22:41:34'),(15,46,20,'14:41:36',NULL,'2024-10-15','2024-10-14 22:41:36','2024-10-14 22:41:36'),(16,56,20,'14:41:38',NULL,'2024-10-15','2024-10-14 22:41:38','2024-10-14 22:41:38'),(17,60,20,'14:41:44',NULL,'2024-10-15','2024-10-14 22:41:44','2024-10-14 22:41:44'),(18,39,20,'14:41:58',NULL,'2024-10-15','2024-10-14 22:41:58','2024-10-14 22:41:58'),(19,50,20,'14:42:03',NULL,'2024-10-15','2024-10-14 22:42:03','2024-10-14 22:42:03'),(20,50,20,'14:42:05',NULL,'2024-10-15','2024-10-14 22:42:05','2024-10-14 22:42:05'),(21,48,20,'14:42:07',NULL,'2024-10-15','2024-10-14 22:42:07','2024-10-14 22:42:07'),(22,49,20,'14:42:11',NULL,'2024-10-15','2024-10-14 22:42:11','2024-10-14 22:42:11'),(23,49,20,'14:42:13',NULL,'2024-10-15','2024-10-14 22:42:13','2024-10-14 22:42:13'),(24,68,20,'14:42:15',NULL,'2024-10-15','2024-10-14 22:42:15','2024-10-14 22:42:15'),(25,68,20,'14:42:17',NULL,'2024-10-15','2024-10-14 22:42:17','2024-10-14 22:42:17'),(26,64,20,'14:42:29',NULL,'2024-10-15','2024-10-14 22:42:29','2024-10-14 22:42:29'),(27,64,20,'14:42:31',NULL,'2024-10-15','2024-10-14 22:42:31','2024-10-14 22:42:31'),(28,72,20,'14:42:34',NULL,'2024-10-15','2024-10-14 22:42:34','2024-10-14 22:42:34'),(29,58,20,'14:42:46',NULL,'2024-10-15','2024-10-14 22:42:46','2024-10-14 22:42:46'),(30,58,20,'14:42:48',NULL,'2024-10-15','2024-10-14 22:42:48','2024-10-14 22:42:48'),(31,59,20,'14:43:04',NULL,'2024-10-15','2024-10-14 22:43:04','2024-10-14 22:43:04'),(32,59,20,'14:43:05',NULL,'2024-10-15','2024-10-14 22:43:05','2024-10-14 22:43:05'),(33,54,20,'14:43:18',NULL,'2024-10-15','2024-10-14 22:43:18','2024-10-14 22:43:18'),(34,54,20,'14:43:19',NULL,'2024-10-15','2024-10-14 22:43:19','2024-10-14 22:43:19'),(35,63,20,'14:43:33',NULL,'2024-10-15','2024-10-14 22:43:33','2024-10-14 22:43:33'),(36,63,20,'14:43:34',NULL,'2024-10-15','2024-10-14 22:43:34','2024-10-14 22:43:34'),(37,61,20,'14:43:46',NULL,'2024-10-15','2024-10-14 22:43:46','2024-10-14 22:43:46'),(38,61,20,'14:43:48',NULL,'2024-10-15','2024-10-14 22:43:48','2024-10-14 22:43:48'),(39,44,20,'14:53:27',NULL,'2024-10-15','2024-10-14 22:53:27','2024-10-14 22:53:27');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `makeup_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `makeup_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned DEFAULT NULL,
  `days` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `lateDuration` int DEFAULT NULL,
  `isApproved` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=Pending, 1=Approved, 2=Declined',
  `isCurrent` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isAttend` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `makeup_schedules_course_id_foreign` (`course_id`),
  CONSTRAINT `makeup_schedules_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `makeup_schedules` WRITE;
/*!40000 ALTER TABLE `makeup_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `makeup_schedules` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_sections_table',1),(2,'0001_01_01_000001_create_users_table',1),(3,'0001_01_01_000002_create_cache_table',1),(4,'0001_01_01_000003_create_jobs_table',1),(5,'2024_05_17_091021_create_admins_table',1),(6,'2024_05_17_093515_create_faculties_table',1),(7,'2024_05_19_102610_create_courses_table',1),(8,'2024_05_19_103812_create_events_table',1),(9,'2024_05_27_093609_create_schedules_table',1),(10,'2024_05_27_100343_create_logs_table',1),(11,'2024_05_28_031304_create_personal_access_tokens_table',1),(12,'2024_06_09_002233_add_details_to_admins_table',1),(13,'2024_06_09_002505_create_settings_table',1),(14,'2024_06_11_023145_create_attendances_table',1),(15,'2024_07_27_185649_create_students_seat_plan_table',1),(16,'2024_08_01_103528_create_permission_tables',1),(17,'2024_08_14_003436_create_enrolledcourses_table',1),(18,'2024_08_31_155102_create_blocked_student_courses_table',1),(19,'2024_10_12_120432_create_makeup_schedules_table',1),(20,'2024_10_14_123249_create_faculty_logs_table',1),(21,'2024_10_19_014600_create_archives_table',1),(22,'2024_10_30_043546_create_seats_configuration_table',1),(23,'2024_11_05_022252_create_seats_backup_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\Admin',1),(2,'App\\Models\\Admin',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'View Dashboard','admin','2024-11-12 05:05:34','2024-11-12 05:05:34'),(2,'View RFID Checker','admin','2024-11-12 05:05:35','2024-11-12 05:05:35'),(3,'View Analytics','admin','2024-11-12 05:05:35','2024-11-12 05:05:35'),(4,'View Attendances','admin','2024-11-12 05:05:35','2024-11-12 05:05:35'),(5,'View Current Attendances','admin','2024-11-12 05:05:35','2024-11-12 05:05:35'),(6,'View Sections','admin','2024-11-12 05:05:35','2024-11-12 05:05:35'),(7,'Create Sections','admin','2024-11-12 05:05:36','2024-11-12 05:05:36'),(8,'Update Sections','admin','2024-11-12 05:05:36','2024-11-12 05:05:36'),(9,'Delete Sections','admin','2024-11-12 05:05:36','2024-11-12 05:05:36'),(10,'View Courses','admin','2024-11-12 05:05:36','2024-11-12 05:05:36'),(11,'Create Courses','admin','2024-11-12 05:05:36','2024-11-12 05:05:36'),(12,'Update Courses','admin','2024-11-12 05:05:36','2024-11-12 05:05:36'),(13,'Delete Courses','admin','2024-11-12 05:05:36','2024-11-12 05:05:36'),(14,'View Students','admin','2024-11-12 05:05:37','2024-11-12 05:05:37'),(15,'Create Students','admin','2024-11-12 05:05:37','2024-11-12 05:05:37'),(16,'Update Students','admin','2024-11-12 05:05:37','2024-11-12 05:05:37'),(17,'Delete Students','admin','2024-11-12 05:05:37','2024-11-12 05:05:37'),(18,'Add Tag UID to Students','admin','2024-11-12 05:05:37','2024-11-12 05:05:37'),(19,'Disable RFID','admin','2024-11-12 05:05:37','2024-11-12 05:05:37'),(20,'View Instructors','admin','2024-11-12 05:05:38','2024-11-12 05:05:38'),(21,'Create Instructors','admin','2024-11-12 05:05:38','2024-11-12 05:05:38'),(22,'Update Instructors','admin','2024-11-12 05:05:38','2024-11-12 05:05:38'),(23,'Delete Instructors','admin','2024-11-12 05:05:38','2024-11-12 05:05:38'),(24,'Add Tag UID to Instructors','admin','2024-11-12 05:05:38','2024-11-12 05:05:38'),(25,'View Events','admin','2024-11-12 05:05:38','2024-11-12 05:05:38'),(26,'Create Events','admin','2024-11-12 05:05:38','2024-11-12 05:05:38'),(27,'Update Events','admin','2024-11-12 05:05:39','2024-11-12 05:05:39'),(28,'Delete Events','admin','2024-11-12 05:05:39','2024-11-12 05:05:39'),(29,'View Regular Schedules','admin','2024-11-12 05:05:39','2024-11-12 05:05:39'),(30,'Create Regular Schedules','admin','2024-11-12 05:05:39','2024-11-12 05:05:39'),(31,'Update Regular Schedules','admin','2024-11-12 05:05:39','2024-11-12 05:05:39'),(32,'Delete Regular Schedules','admin','2024-11-12 05:05:39','2024-11-12 05:05:39'),(33,'View Make-Up Schedules','admin','2024-11-12 05:05:40','2024-11-12 05:05:40'),(34,'Create Make-Up Schedules','admin','2024-11-12 05:05:40','2024-11-12 05:05:40'),(35,'Update Make-Up Schedules','admin','2024-11-12 05:05:40','2024-11-12 05:05:40'),(36,'Delete Make-Up Schedules','admin','2024-11-12 05:05:40','2024-11-12 05:05:40'),(37,'View Make-Up SchedApprovals','admin','2024-11-12 05:05:40','2024-11-12 05:05:40'),(38,'Approve Make-Up SchedApprovals','admin','2024-11-12 05:05:40','2024-11-12 05:05:40'),(39,'Decline Make-Up SchedApprovals','admin','2024-11-12 05:05:41','2024-11-12 05:05:41'),(40,'View Admins','admin','2024-11-12 05:05:41','2024-11-12 05:05:41'),(41,'Create Admins','admin','2024-11-12 05:05:41','2024-11-12 05:05:41'),(42,'Update Admins','admin','2024-11-12 05:05:41','2024-11-12 05:05:41'),(43,'Delete Admins','admin','2024-11-12 05:05:41','2024-11-12 05:05:41'),(44,'Add Permissions','admin','2024-11-12 05:05:42','2024-11-12 05:05:42'),(45,'View Roles','admin','2024-11-12 05:05:42','2024-11-12 05:05:42'),(46,'Create Roles','admin','2024-11-12 05:05:42','2024-11-12 05:05:42'),(47,'Update Roles','admin','2024-11-12 05:05:42','2024-11-12 05:05:42'),(48,'Delete Roles','admin','2024-11-12 05:05:42','2024-11-12 05:05:42'),(49,'View Permissions','admin','2024-11-12 05:05:42','2024-11-12 05:05:42'),(50,'Create Permissions','admin','2024-11-12 05:05:43','2024-11-12 05:05:43'),(51,'Update Permissions','admin','2024-11-12 05:05:43','2024-11-12 05:05:43'),(52,'Delete Permissions','admin','2024-11-12 05:05:43','2024-11-12 05:05:43'),(53,'View Logs','admin','2024-11-12 05:05:43','2024-11-12 05:05:43'),(54,'View Settings','admin','2024-11-12 05:05:43','2024-11-12 05:05:43'),(55,'Update Settings','admin','2024-11-12 05:05:43','2024-11-12 05:05:43');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (14,'App\\Models\\Admin',2,'Mark Glen Miguel','715982154d86e8e95d26aa65c98b1bd90ec18b4c1a863caae9b181fbc18768ed','[\"*\"]',NULL,NULL,'2024-11-20 04:12:37','2024-11-20 04:12:37');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super-Admin','admin','2024-11-12 05:05:44','2024-11-12 05:05:44'),(2,'Admin','admin','2024-11-12 05:05:44','2024-11-12 05:05:44'),(3,'Staff','admin','2024-11-12 05:05:44','2024-11-12 05:05:44');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned DEFAULT NULL,
  `days` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `lateDuration` int DEFAULT NULL,
  `isMakeUp` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Regular, 1=MakeUp',
  `isApproved` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=Pending, 1=Approved, 2=Declined',
  `isCurrent` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isAttend` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_course_id_foreign` (`course_id`),
  CONSTRAINT `schedules_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,20,'Tuesday','13:00:00','16:00:00',NULL,'0','1','1','1','2024-11-12 05:34:02','2024-11-12 05:34:21');
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `seat_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seat_plan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned DEFAULT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `seat_number` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seat_plan_student_id_foreign` (`student_id`),
  KEY `seat_plan_course_id_foreign` (`course_id`),
  CONSTRAINT `seat_plan_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `seat_plan_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `seat_plan` WRITE;
/*!40000 ALTER TABLE `seat_plan` DISABLE KEYS */;
INSERT INTO `seat_plan` VALUES (1,44,20,13,'2024-11-12 05:24:13','2024-11-14 00:33:07'),(2,41,20,12,'2024-11-12 05:24:13','2024-11-14 00:33:09'),(3,46,20,11,'2024-11-12 05:24:13','2024-11-14 00:33:10'),(4,42,20,23,'2024-11-12 05:24:13','2024-11-14 00:33:13'),(5,40,20,24,'2024-11-12 05:24:13','2024-11-14 00:33:15'),(6,52,20,25,'2024-11-12 05:24:13','2024-11-14 00:33:19'),(7,45,20,26,'2024-11-12 05:24:13','2024-11-14 00:33:21'),(8,50,20,27,'2024-11-12 05:24:13','2024-11-14 00:33:23'),(9,55,20,14,'2024-11-12 05:24:13','2024-11-14 00:33:05'),(10,49,20,16,'2024-11-12 05:24:13','2024-11-14 00:33:01'),(11,48,20,18,'2024-11-12 05:24:13','2024-11-14 00:32:56'),(12,58,20,20,'2024-11-12 05:24:13','2024-11-14 00:32:51'),(13,57,20,22,'2024-11-12 05:24:13','2024-11-14 00:32:47'),(14,51,20,9,'2024-11-12 05:24:13','2024-11-14 00:32:43'),(15,43,20,7,'2024-11-12 05:24:13','2024-11-14 00:32:39'),(16,65,20,5,'2024-11-12 05:24:13','2024-11-14 00:32:33'),(17,47,20,4,'2024-11-12 05:24:13','2024-11-14 00:32:30'),(18,64,20,6,'2024-11-12 05:24:13','2024-11-14 00:32:36'),(19,56,20,8,'2024-11-12 05:24:13','2024-11-14 00:32:41'),(20,62,20,10,'2024-11-12 05:24:14','2024-11-14 00:32:45'),(21,67,20,21,'2024-11-12 05:24:14','2024-11-14 00:32:49'),(22,63,20,19,'2024-11-12 05:24:14','2024-11-14 00:32:54'),(23,39,20,17,'2024-11-12 05:24:14','2024-11-14 00:32:59'),(24,69,20,15,'2024-11-12 05:24:14','2024-11-14 00:33:03'),(25,66,20,28,'2024-11-12 05:24:14','2024-11-14 00:33:25'),(26,71,20,3,'2024-11-12 05:24:14','2024-11-14 00:32:29'),(27,68,20,1,'2024-11-12 05:24:14','2024-11-14 00:32:23'),(28,72,20,2,'2024-11-12 05:24:14','2024-11-14 00:32:25'),(29,73,20,29,'2024-11-12 05:24:14','2024-11-14 00:33:28'),(30,60,20,30,'2024-11-12 05:24:14','2024-11-14 00:33:30'),(31,61,20,31,'2024-11-12 05:24:14','2024-11-14 00:33:33'),(32,54,20,32,'2024-11-12 05:24:14','2024-11-14 00:33:34'),(33,53,20,33,'2024-11-12 05:24:14','2024-11-14 00:33:36'),(34,59,20,34,'2024-11-12 05:24:14','2024-11-14 00:33:38'),(35,70,20,40,'2024-11-12 05:24:14','2024-11-14 00:33:41');
/*!40000 ALTER TABLE `seat_plan` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `seats_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seats_backup` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `seats_backup` WRITE;
/*!40000 ALTER TABLE `seats_backup` DISABLE KEYS */;
INSERT INTO `seats_backup` VALUES (1,'hackdog','app/public/seats_configuration/hackdog.json','2024-11-20 05:26:33','2024-11-20 05:26:33');
/*!40000 ALTER TABLE `seats_backup` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `seats_configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seats_configuration` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `seat_number` int DEFAULT NULL,
  `row` int DEFAULT NULL,
  `column` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `seats_configuration` WRITE;
/*!40000 ALTER TABLE `seats_configuration` DISABLE KEYS */;
INSERT INTO `seats_configuration` VALUES (1,0,0,0),(2,0,0,1),(3,40,0,2),(4,39,0,3),(5,38,0,4),(6,37,0,5),(7,0,0,6),(8,0,1,0),(9,36,1,1),(10,35,1,2),(11,0,1,3),(12,0,1,4),(13,0,1,5),(14,0,1,6),(15,23,2,0),(16,24,2,1),(17,25,2,2),(18,26,2,3),(19,27,2,4),(20,28,2,5),(21,0,2,6),(22,0,3,0),(23,29,3,1),(24,30,3,2),(25,31,3,3),(26,32,3,4),(27,33,3,5),(28,34,3,6),(29,22,4,0),(30,21,4,1),(31,20,4,2),(32,19,4,3),(33,18,4,4),(34,17,4,5),(35,0,4,6),(36,0,5,0),(37,16,5,1),(38,15,5,2),(39,14,5,3),(40,13,5,4),(41,12,5,5),(42,11,5,6),(43,1,6,0),(44,2,6,1),(45,3,6,2),(46,4,6,3),(47,5,6,4),(48,0,7,0),(49,6,7,1),(50,7,7,2),(51,8,7,3),(52,9,7,4),(53,10,7,5),(54,0,7,6);
/*!40000 ALTER TABLE `seats_configuration` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'BSIT','4','A','2024-10-14 15:54:15','2024-10-14 15:54:15'),(2,'BSIT','2','G','2024-10-14 16:54:16','2024-10-14 16:54:16'),(3,'BSIT','2','C','2024-10-14 16:54:16','2024-10-14 16:54:16'),(4,'BSIT','1','E','2024-10-14 16:54:16','2024-10-14 16:54:16'),(5,'BSIT','2','H','2024-10-14 16:54:16','2024-10-14 16:54:16'),(6,'BSIT','2','E','2024-10-14 16:54:16','2024-10-14 16:54:16'),(7,'BSIS','3','A','2024-10-14 16:54:16','2024-10-14 16:54:16'),(8,'BSIT','2','F','2024-10-14 16:54:16','2024-10-14 16:54:16'),(9,'BSIT','1','D','2024-10-14 16:54:16','2024-10-14 16:54:16'),(10,'BSIT','2','D','2024-10-14 16:54:16','2024-10-14 16:54:16'),(11,'BSIT','2','A','2024-10-14 16:54:16','2024-10-14 16:54:16'),(12,'BSIT','1','C','2024-10-14 16:54:16','2024-10-14 16:54:16'),(13,'BSIT','2','B','2024-10-14 16:54:16','2024-10-14 16:54:16'),(14,'BSIS','3','C','2024-10-14 16:54:16','2024-10-14 16:54:16'),(15,'BSIT','1','B','2024-10-14 16:54:16','2024-10-14 16:54:16'),(16,'BSIS','3','B','2024-10-14 16:54:16','2024-10-14 16:54:16'),(17,'BSIT','1','A','2024-10-14 16:54:16','2024-10-14 16:54:16');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('B9NFrYx9saqHPdcvbpnvwJrzFcqMGuOhUE4oBfcN',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0','YToyOntzOjY6Il90b2tlbiI7czo0MDoiZU1GbjgxVmtjS3B1RjlWcUN0Q1ZxVEF4S3RqRENyVkpTUTh5V3JJMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1732082786),('BKp7uYIIIGBGq7HpncbhEXErtmT8XxT4xPEnpqt7',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0','YToyOntzOjY6Il90b2tlbiI7czo0MDoid1huRjVXTThaMGVjSTNqUjR1QzdSbTdObktpdzAzVlBraE84MTZ1YSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1732080946),('KR1r6ftOXyQt1ldsNkEUWGIpggUT2OUbScomEtAC',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiekpKVXVUV2JCbGdFWkkwUlBRZDdoaEIzRVFkenFYOGh1TVV6enJGYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2FyY2hpdmVzIjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1732082898);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `website_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isMaintenance` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isDevInteg` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isRegStud` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isRegLoginStud` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isRegInst` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isRegAdmins` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Pi:Lock | Admin','0','0','0','1','0','0','2024-11-12 05:05:46','2024-11-20 04:38:40');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` bigint unsigned DEFAULT NULL,
  `gender` tinyint DEFAULT '0' COMMENT '0=None, 1=Male, 2=Female',
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `user_theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_student_id_unique` (`student_id`),
  UNIQUE KEY `users_tag_uid_unique` (`tag_uid`),
  UNIQUE KEY `users_google_id_unique` (`google_id`),
  KEY `users_section_id_foreign` (`section_id`),
  CONSTRAINT `users_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'erlaresma@my.cspc.edu.ph',NULL,'$2y$12$pW7bxcMLKGLPT0rwa/.w5u4QJpbKtm8Uxjd/FsRyERhdWbCa.x9JK',NULL,'2024-10-14 17:13:32','2024-10-14 17:15:15','231003703','Erica May','Laresma','1453599534',5,2,NULL,NULL,NULL),(2,NULL,'jotoldanes@my.cspc.edu.ph',NULL,'$2y$12$W0lEmAbYlGf3BuDiukIW4uBWanOgO69o2XGU5WI5p8utcyvd.vCnG',NULL,'2024-10-14 17:14:32','2024-10-14 17:15:31','231002254','John Michael','Toldanes','4170167386',5,1,NULL,NULL,NULL),(3,NULL,'anmedrano@my.cspc.edu.ph',NULL,'$2y$12$PfoqtIUluY3tgD8xNE1KReZTEd4IqOI/u4BI5T5lwxBenAIngHaXG',NULL,'2024-10-14 17:16:47','2024-10-14 17:18:17','231002017','Anele','Medrano','1455810206',5,2,NULL,NULL,NULL),(4,NULL,'joellorde@my.cspc.edu.ph',NULL,'$2y$12$WhT2JheoKiO4R17oAupnBOXrnpDXRTAKwIxIj1gz372v.9Chnz.ka',NULL,'2024-10-14 17:19:21','2024-10-14 17:20:32','231004092','Joanne Faye','Ellorde','3111397747',5,2,NULL,NULL,NULL),(5,NULL,'reespeleta@my.cspc.edu.ph',NULL,'$2y$12$1ECh.MxQ8D9KedPfUZIUveWkKs9jQ1jH8s3OgFrwTvBQ8c/f5dlum',NULL,'2024-10-14 17:20:03','2024-10-14 17:22:45','231002012','Rene','Espeleta','1812379357',5,2,NULL,NULL,NULL),(6,NULL,'cacezar@my.cspc.edu.ph',NULL,'$2y$12$IOxUocoZhRJRS26vw07RiOo1whQyK33WRMEqMPvcHgSH6JO9A451e',NULL,'2024-10-14 17:20:24','2024-10-14 17:21:18','231002112','Carla','Cezar','1813121405',5,2,NULL,NULL,NULL),(7,NULL,'jalucena@my.cspc.edu.ph',NULL,'$2y$12$GdmTXBLB3N.cjPe7F/GIDeBp9xgBEqya408WDyizGaMk0FHcT5qdW',NULL,'2024-10-14 17:40:45','2024-10-14 17:41:14','231005444','Jan Russel','Lucena','1477355310',5,1,NULL,NULL,NULL),(8,NULL,'allitradio@my.cspc.edu.ph',NULL,'$2y$12$woyx7rpQHVygaK7lGbvuhef4yIRxfQqmY5vvMn/Ox0x6/LH04Tfm.',NULL,'2024-10-14 17:43:28','2024-10-14 17:43:56','231003884','Alliah','Tradio','3800653402',5,2,NULL,NULL,NULL),(9,NULL,'ashberdio@my.cspc.edu.ph',NULL,'$2y$12$XE07Gp8riggUpopXes1.9O8oFmMsMKERbCPi8w6ZD1dqYIDgFIAGG',NULL,'2024-10-14 17:44:46','2024-10-14 17:45:03','231002082','Ashley','Berido','4170600218',5,2,NULL,NULL,NULL),(10,NULL,'jolagriada@my.cspc.edu.ph',NULL,'$2y$12$9ZirI5VCZlPDOu3Aj2YsU.fkh96i.buqUv798/H5FImsIrEhy928m',NULL,'2024-10-14 17:45:01','2024-10-14 17:47:53','C20101178','John Albert','Lagriada','3886575036',5,1,NULL,NULL,NULL),(11,NULL,'lifrancisco@my.cspc.edu.ph',NULL,'$2y$12$SYMEPA/ISWKzU9zROy9ijeDSS/XdkT9OclnP1N35x4Ojs4ai465yK',NULL,'2024-10-14 17:45:48','2024-10-14 17:47:18','231002141','Lizzie','Francisco','1473045918',5,2,NULL,NULL,NULL),(12,NULL,'luisorbon@my.cspc.edu.ph',NULL,'$2y$12$Bd4j.LT.nBTkuYWF1k9USefMCnKUOY8GyvYn/TrzdX0q3QLK9QJrS',NULL,'2024-10-14 17:46:28','2024-10-14 17:46:43','231002189','Luis Gabriel','Orbon','1473736206',5,1,NULL,NULL,NULL),(13,NULL,'shangeles@my.cspc.edu.ph',NULL,'$2y$12$7VIY7IQRqsEX8sO.QQv4aONqX6MCZP696BkWvGHwBngbVYoPaZ/Au',NULL,'2024-10-14 17:46:57','2024-10-14 17:47:35','231002056','Shaniah','Angeles','1454465006',5,2,NULL,NULL,NULL),(14,NULL,'desendon@my.cspc.edu.ph',NULL,'$2y$12$soW5K2eZF62hsAUU0PbkRebphPrgWiNC5lEq4htk8sMZx8Gfs9Yfe',NULL,'2024-10-14 17:48:10','2024-10-14 17:54:24','231003118','Deanne','Sendon','1471364142',5,2,NULL,NULL,NULL),(15,NULL,'paullandagan@my.cspc.edu.ph',NULL,'$2y$12$rKKXL5Igea9ryby0jlbfxuS7fYo/sYNBz7FjptsClXqBw7mtJquEC',NULL,'2024-10-14 17:49:09','2024-10-14 17:51:19','231004136','Paul Robert','Landagan','1454436798',5,1,NULL,NULL,NULL),(16,NULL,'kubermejo@my.cspc.edu.ph',NULL,'$2y$12$wB5FuKgo5MJQ6LqagzhSeuusyW5o5A2SK2XmkTwgpIyPN95GmlVBi',NULL,'2024-10-14 17:49:17','2024-10-14 17:53:46','231002268','Kurt','Bermejo','1457307598',5,1,NULL,NULL,NULL),(17,NULL,'jeoliveros@my.cspc.edu.ph',NULL,'$2y$12$KvGZ2gZqCqVNTVtuDfRYvO7m9seQ6huRuazUMEELht7RgF.gdM5/S',NULL,'2024-10-14 17:50:18','2024-10-14 17:51:32','231002021','Jeroboam','Oliveros','1454145374',5,1,NULL,NULL,NULL),(18,NULL,'rasacueza@my.cspc.edu.ph',NULL,'$2y$12$yJF14eXsKqZP0OO.YXirl.7Ai3vDCzKHGKIUK.XwRrYBDL5ofEq2K',NULL,'2024-10-14 17:51:27','2024-10-14 17:54:41','231005354','Raynell','Sacueza','1834892638',5,1,NULL,NULL,NULL),(19,NULL,'jualipio@my.cspc.edu.ph',NULL,'$2y$12$q4Va25SckzCLGuV6NhtlV.HRv4K6gg8e1v1sSh3F/EqSPkYg4D7LG',NULL,'2024-10-14 17:52:43','2024-10-14 17:54:02','231002053','Julianne','Alipio','1455338750',5,2,NULL,NULL,NULL),(20,NULL,'jhdianela@my.cspc.edu.ph',NULL,'$2y$12$FMK8rW60SBx0YP9G5ZnRbuYOMBrhRmibjerOd0D.INhSJNQbIo8ne',NULL,'2024-10-14 17:54:02','2024-10-14 17:54:57','231002128','Jhyzzeel','Dianela','1457894862',5,2,NULL,NULL,NULL),(21,NULL,'mibaluca@my.cspc.edu.ph',NULL,'$2y$12$YhJOeN0MhC2VS45f8afi9Ogna1my.JZxXEZAWiozXK6aJNipAU66K',NULL,'2024-10-14 17:55:02','2024-10-14 17:55:42','231003869','Miguela','Baluca','1476858206',5,2,NULL,NULL,NULL),(22,NULL,'shmagbanua@my.cspc.edu.ph',NULL,'$2y$12$h6hbCzmGRajhsc/4V3FJ3OBTUiEFGFIvrj6svgof8tJIrO5nYQvLy',NULL,'2024-10-14 17:55:57','2024-10-14 17:57:57','231002168','Shanice','Magbanua','2181866971',5,2,NULL,NULL,NULL),(23,NULL,'mipraxides@my.cspc.edu.ph',NULL,'$2y$12$jEYKOOo2hu4kWro.IdTxXelVJk0g/lahFFqkvIGrY2qGGH1yWqwfa',NULL,'2024-10-14 17:57:27','2024-10-14 17:58:10','231002204','Mikailla','Praxides','1458556014',5,2,NULL,NULL,NULL),(24,NULL,'joagravante@my.cspc.edu.ph',NULL,'$2y$12$ySNNXDYx/xhRupv1TpAsVOXhRsuJJ1VcH47TlHsqk2gTJdXMKAmGq',NULL,'2024-10-14 17:58:19','2024-10-14 17:58:44','231002046','Joemle','Agravante','1476973134',5,1,NULL,NULL,NULL),(25,NULL,'mahernandez@my.cspc.edu.ph',NULL,'$2y$12$7Rdv4WGjTZ0miyYNG5H0VOcy.gtH1EogBg.zRfM4bKsMtvl0IDQtm',NULL,'2024-10-14 17:59:06','2024-10-14 17:59:34','231003029','Mariel','Hernandez','2188188891',5,2,NULL,NULL,NULL),(26,NULL,'josalcedo@my.cspc.edu.ph',NULL,'$2y$12$59riKjRpaOvDo3XjKUoaUO9DyUAJNNgOf5QhZN0im/bZJ7WxUPLjO',NULL,'2024-10-14 17:59:46','2024-10-14 18:00:08','231002036','John','Salcedo','1455962094',5,1,NULL,NULL,NULL),(27,NULL,'jibolalin@my.cspc.edu.ph',NULL,'$2y$12$N6Bn2.wRfSD0Qh8F3qd53eRm2tk31S08Loq5S2v7sbcR/q0hUS0xe',NULL,'2024-10-14 18:00:37','2024-10-14 18:01:58','231002087','Jim','Bolalin','1460296334',5,1,NULL,NULL,NULL),(28,NULL,'casaulon@my.cspc.edu.ph',NULL,'$2y$12$AVHaOoVKjg6DUAy8RPc97.FKO8MNYWzkU4qH4gqMYbchBxCEaHvi.',NULL,'2024-10-14 18:01:17','2024-10-14 18:01:33','231002231','Carl','Saulon','1459425950',5,1,NULL,NULL,NULL),(29,NULL,'jhcastillo@my.cspc.edu.ph',NULL,'$2y$12$Brg6BOblWgw8Vl/jGCqOcORcVgHlHHr0SnCvad.Hht8zAviejWMtG',NULL,'2024-10-14 18:01:34','2024-10-14 18:02:15','231005309','Jhondel','Castillo','2190846155',5,1,NULL,NULL,NULL),(30,NULL,'ephbantillo@my.cspc.edu.ph',NULL,'$2y$12$ralEr0xSCJcfQIUiL5U.eeTrktQqgf9JdQ00oTilhj6J96fIJpog6',NULL,'2024-10-14 18:02:59','2024-10-14 18:03:17','231002069','Ephraim','Bantillo','1453904238',5,1,NULL,NULL,NULL),(31,NULL,'ivdaguinod@my.cspc.edu.ph',NULL,'$2y$12$AGsN4jeVHVNvtNs5QRAe8epiYx6PfqOnx0BOWibLKN4zZJRNs.FJC',NULL,'2024-10-14 18:04:13','2024-10-14 18:04:25','231002122','Ivan','Daguinod','1478596606',5,1,NULL,NULL,NULL),(32,NULL,'chaguilar@my.cspc.edu.ph',NULL,'$2y$12$eqbn37bvpMeYaB5yjMomre3XYlTW7fBU7hr5vDD3e3ktUgsTV.gbu',NULL,'2024-10-14 18:05:07','2024-10-14 18:05:21','231002048','Charles','Aguilar','1473478046',5,1,NULL,NULL,NULL),(33,NULL,'direlleve@my.cspc.edu.ph',NULL,'$2y$12$i4ReDipK5vowbKboAkecO.W0cWf19Usk4gQtbKBNgqMyd0/GyVQpy',NULL,'2024-10-14 18:05:54','2024-10-14 18:06:10','231004281','Dion','Relleve','1455493982',5,1,NULL,NULL,NULL),(34,NULL,'eldelafuente@my.cspc.edu.ph',NULL,'$2y$12$omlrNAL8qSY.KMz92jwzBObbdtkmyatnBpdzLP3pVZa3WK5JuaMHS',NULL,'2024-10-14 18:06:51','2024-10-14 18:06:51','231003760','Elijah','Dela Fuente',NULL,5,1,NULL,NULL,NULL),(35,NULL,'nibermudo@my.cspc.edu.ph',NULL,'$2y$12$F8np2wq5EYmhuNDnxgN1jO8D781vOiFcRgKaJHny9qif.zaLeFgIK',NULL,'2024-10-14 18:08:23','2024-10-14 18:08:23','231002083','Nino','Bermudo',NULL,5,1,NULL,NULL,NULL),(36,NULL,'addaduya@my.cspc.edu.ph',NULL,'$2y$12$lZLgCs2S.x768Hd1kSJZf.q8ZHuAF8xgPMeXictdOfywJWu4QPd8e',NULL,'2024-10-14 18:09:00','2024-10-14 18:09:16','231002119','Adrian','Daduya','1453976270',5,1,NULL,NULL,NULL),(37,NULL,'laroaring@my.cspc.edu.ph',NULL,'$2y$12$QpgeO6/trxY3oVqGsr6fIeR9kfCsalVVt0a/Vf6PYOZIdX.OupBt.',NULL,'2024-10-14 18:09:37','2024-10-14 18:09:37','231002221','Lawrence','Roaring',NULL,5,1,NULL,NULL,NULL),(38,NULL,'kristagle@my.cspc.edu.ph',NULL,'$2y$12$4H35t67MnYB6SrGCwEd2JOa3.O84vQ6c.YJh6ZlMjmnLZ4voP1yWS',NULL,'2024-10-14 18:10:04','2024-10-14 18:10:17','231002244','Kristine','Tagle','2309383197',5,2,NULL,NULL,NULL),(39,'Joshua Daliva','jodaliva@my.cspc.edu.ph',NULL,'$2y$12$RffwO/bwRp8ANdRWowrvEueQ1gvBgp6lE9Q6rpnyi/aZg/7epijmK',NULL,'2024-10-14 22:12:10','2024-10-14 22:26:21','231002123','Joshua','Daliva','1477952958',11,1,'106950034129197582068','https://lh3.googleusercontent.com/a/ACg8ocJhB_ikN1iJ6-sqpEl2xf4BK5RsDf0qOuLWSBNgD0UypdQ3UnY=s96-c','dark'),(40,'FRANK ESTRELLADO','frestrellado@my.cspc.edu.ph',NULL,'$2y$12$AfXemtAZ8V3vhdVgXSiRU.vJpoKRkiPP5r.J8/bPHQPBNv3aVq6Q2',NULL,'2024-10-14 22:14:44','2024-10-14 22:27:40','231002137','FRANK','ESTRELLADO','1474886670',11,1,'102329234529685939297','https://lh3.googleusercontent.com/a/ACg8ocIkXCFhYZ04X_LNmBM3YQiETGM9EYt2fNDi-FEhDCnta5Jkfw=s96-c',NULL),(41,'Mary Grace Audal','maaudal@my.cspc.edu.ph',NULL,'$2y$12$Qn5K1SzCoY774KK4Uc/B8edsQdrzJl5eJcFwSaNhU0NesTq21I1Cq',NULL,'2024-10-14 22:15:11','2024-10-14 22:29:07','231003210','Mary Grace','Audal','1474884382',11,2,'115253381381247464519','https://lh3.googleusercontent.com/a/ACg8ocIQu5Pwmx0IW-6ksQn3kbeSofO0pc7OHekQ9r5oNi0th3CKCcE=s96-c',NULL),(42,'Faith Meca Puyawan','fapuyawan@my.cspc.edu.ph',NULL,'$2y$12$bb6xRVYZ5Jfelzwgy636MuC4vmEBrMnuBiC5OyfRfHxIOJeM6f/8m',NULL,'2024-10-14 22:15:17','2024-10-14 22:35:12','231002027','Faith Meca','Puyawan','1460006126',11,2,'107039647337995025507','https://lh3.googleusercontent.com/a/ACg8ocI2QStwZn6wyywUK9dyHj3UnCWOkxl1UOnw2w1q3Vz8qnG8r5U=s96-c','dark'),(43,'Mary Rose Ababa','maababa@my.cspc.edu.ph',NULL,'$2y$12$Ugsok/U0xNLV5RiA/HzyaeV8.CQxbHwgyHbWu.liG12bTUr9ZlP2S',NULL,'2024-10-14 22:15:56','2024-10-14 22:33:08','231002043','Mary Rose','Ababa','1454606366',11,2,'103876667985497166038','https://lh3.googleusercontent.com/a/ACg8ocJywNcLMY3eI7AM-_l5Fu8-hFdOJIhi1XTLgOK3duhJu9JiI7I=s96-c',NULL),(44,'Lea an Tandaan','letandaan@my.cspc.edu.ph',NULL,'$2y$12$pDhvcK2Ar2Skky2u9MuWheQqjNfqlEeXNSbpedX5MfwL5uHMoMqSS',NULL,'2024-10-14 22:16:03','2024-10-14 22:26:51','231002250','Lea an','Tandaan','2192135883',11,2,'102366106129414540948','https://lh3.googleusercontent.com/a/ACg8ocJTh2IJutaTzqmw_oLKAlLecm0Rk_xNj-qHXraV1OfujV3JQPTa=s96-c','light'),(45,'Manylene Bolano','mabolano@my.cspc.edu.ph',NULL,'$2y$12$zZ3u2AGnipe309M1F8qruunLopxMoGEkDHqRb.XiLKVWxBOJ0QhyK',NULL,'2024-10-14 22:16:13','2024-10-14 22:34:01','231002088','Manylene','Bolano','1476144254',11,2,'116786254847269926342','https://lh3.googleusercontent.com/a/ACg8ocIl8g_BHQbstLOapkLJ-gZG841byynszJodBROwNcxcfcW1Gg=s96-c',NULL),(46,'Norilene Clemeno','noclemeno@my.cspc.edu.ph',NULL,'$2y$12$KA.cF7o4KpAtPLxvztAiqedurMpdfcatheYCSgR2mLP4sJzPuNYAC',NULL,'2024-10-14 22:16:22','2024-10-14 22:33:49','231003299','Norilene','Clemeno','2188632523',11,2,'106053566826460261490','https://lh3.googleusercontent.com/a/ACg8ocLuj2FH_7qXWh-35mxDMyq3APzdsTEDNq5ROzzdAlw9Tdf1cA=s96-c',NULL),(47,'Jeanelle Divilles','jedivilles@my.cspc.edu.ph',NULL,'$2y$12$aP0bHH6y7niD2DQ45pYRBOa8qoFKkJKnPzlOwENoDYkVE7zshcuNK',NULL,'2024-10-14 22:16:26','2024-10-14 22:34:16','231002130','Jeanelle','Divilles','2029216141',17,2,'102633113045516697093','https://lh3.googleusercontent.com/a/ACg8ocJCpHbOX2s_PUAPgGMbJmEaCcgHfgIC3VQv8VQcMjfvj2nmRRfm=s96-c',NULL),(48,'Edlyn Valiente','edvaliente@my.cspc.edu.ph',NULL,'$2y$12$fUI3kFb13/9kcsczC5BQm.FCLOcMmDD/WG7KGa.26zKv0LtO5Ftiu',NULL,'2024-10-14 22:16:30','2024-10-14 22:29:49','231002260','Edlyn','Valiente','1478464222',11,2,'104120331327252004122','https://lh3.googleusercontent.com/a/ACg8ocKiBQo5_2oVO3xbGxpDkC6YBTv9MccIEzJc36ODqDUCnuvo05s=s96-c',NULL),(49,'Sandara Mae Llanes','sallanes@my.cspc.edu.ph',NULL,'$2y$12$56qcXeepgvqO2h2V5YvlcOGwwvzkpn7XmwbwDrxnVWLLxqyNuSeWW',NULL,'2024-10-14 22:16:34','2024-10-14 22:33:22','231002163','Sandara Mae','Llanes','1477852558',11,2,'115982711779014616244','https://lh3.googleusercontent.com/a/ACg8ocIfeB92_YPCydXAKmSXu8TFo_A1vwbkZQEwgvKMnI4HharhOw=s96-c',NULL),(50,'Hans Isaac Tolin','hatolin@my.cspc.edu.ph',NULL,'$2y$12$zNd5Te7HqaUZwPNfzwr7fOhYeZnSFup9FU99Wb5MsRTPFIGJUlnty',NULL,'2024-10-14 22:16:41','2024-10-14 22:27:25','231002040','Hans Isaac','Tolin','1455518654',11,1,'116853824325382285794','https://lh3.googleusercontent.com/a/ACg8ocKvAxoURX0SOP_4nzpL3zVkOCafyKLWDOLQz-xrGcu0gxBY4Oo=s96-c',NULL),(51,'Maica Burgos','maburgos@my.cspc.edu.ph',NULL,'$2y$12$VlpxwSUYNaN3urlrYaQ4juA5GkP1ZhHJzlWdGWMwIVTAsoQ2RDIbm',NULL,'2024-10-14 22:16:53','2024-10-14 22:32:54','231002096','Maica','Burgos','2031341117',11,2,'109811199487757389045','https://lh3.googleusercontent.com/a/ACg8ocKfZwoJwLpqR8P9rRLfkuDtdoAMPlyV6GRhT-KeYbIzivFPBFM=s96-c',NULL),(52,'HARLENE JOY LARCENA','halarcena@my.cspc.edu.ph',NULL,'$2y$12$2VMuBUd0xWFe3pS30yDdL.iqu07W9HgyFmhEQYBSP9o0hmyJEf9De',NULL,'2024-10-14 22:17:02','2024-10-14 22:28:55','231002159','HARLENE JOY','LARCENA','1811475453',11,2,'107911346960445492139','https://lh3.googleusercontent.com/a/ACg8ocJX_ralGVkLzlhnKPLI3Po5HtwW6G3PHdwUdi6W-SS4xyNBdGU=s96-c',NULL),(53,'Mike Jay Carulla','micarulla@my.cspc.edu.ph',NULL,'$2y$12$e5tuv5QFNWXb1jnrDvBtxeOdwUJt2hOYunKYxMTSEfQhxeWP2HOnC',NULL,'2024-10-14 22:17:09','2024-10-14 22:31:48','231004645','Mike Jay','Carulla','1834479886',11,1,'100007951942521040151','https://lh3.googleusercontent.com/a/ACg8ocJ9CMciCTEfU9hdsXb8OArmPhsFUrYpjeVt0iUOigQbpvzQfA=s96-c','light'),(54,'Mark Angelo Gregorio','magregorio@my.cspc.edu.ph',NULL,'$2y$12$fn6j9RpNuO7KYFnC4cumdO2EkogtdxWVVJOsD21MFrEOpbWAKiFC2',NULL,'2024-10-14 22:17:19','2024-10-14 22:32:42','231004285','Mark Angelo','Gregorio','1475583838',11,1,'116543067393571568821','https://lh3.googleusercontent.com/a/ACg8ocLEtDs6E2xPGWSJD6YlKnNJcFHoelt-wGx0A-P_T659CSO7svo=s96-c','light'),(55,'Erika Barandon','erbarandon@my.cspc.edu.ph',NULL,'$2y$12$FmqPqpONlCRvF8Lh8u47seTNcjT2nvpr7CVxZr6s0vlWFcGTtOSsC',NULL,'2024-10-14 22:17:30','2024-10-14 22:35:57','231002071','Erika','Barandon','1812239229',11,2,'118331072159711462043','https://lh3.googleusercontent.com/a/ACg8ocK50SKzqjfFCx8DnTAAzKl39WL6Pc3daZH8CLKqtivNai3oB9k=s96-c',NULL),(56,'Jamheyca Marcaida','jamarcaida@my.cspc.edu.ph',NULL,'$2y$12$vfgcixfQBjam9vXL7kJL7Oz0DN2zLe4sQbtrmPLboFmBfRF5mocoW',NULL,'2024-10-14 22:17:57','2024-10-14 22:33:34','231002173','Jamheyca','Marcaida','2182103755',11,2,'116632023254805955986','https://lh3.googleusercontent.com/a/ACg8ocJXcS390Cqe9KdT05wCV2tMtnzkOXOqCLZI1o0xHvgDySQsIXBO=s96-c',NULL),(57,'Francine Nicole Dalaodao','frdalaodao@my.cspc.edu.ph',NULL,'$2y$12$uTJTza8390J3V.kd8Agab.uPGEwKHvYtnAFaD43VfPx.hJA6WT7rW',NULL,'2024-10-14 22:18:00','2024-10-14 22:34:53','231000519','Francine Nicole','Dalaodao','2335412073',11,2,'104294236285169336527','https://lh3.googleusercontent.com/a/ACg8ocJaSb7yteFdGUIve0Mi2Mga4Hu4dJs_Na16OO4Rz79RWlFDIgA=s96-c',NULL),(58,'ANDREI PRADES','andprades@my.cspc.edu.ph',NULL,'$2y$12$PBlHDI8kfhrODsluAWMX/eWcu2L6YEF5QyUmIzAaVUIgH8wavdu3y',NULL,'2024-10-14 22:18:02','2024-10-14 22:30:45','231002026','ANDREI','PRADES','1454730686',11,1,'114362030609706766615','https://lh3.googleusercontent.com/a/ACg8ocIWfPzgkX5YyjFo4J-GUfjAP3adVhWdYto63Ncq-7evaxZ-obQ8=s96-c',NULL),(59,'Mark Jerrian Morillo','markjmorillo@my.cspc.edu.ph',NULL,'$2y$12$sN3OxIeWsxrFfHlRlXJYLOlDguMjSCNSIV1IIBL.uwh7MT6dq0DLu',NULL,'2024-10-14 22:18:12','2024-10-14 22:32:29','231002177','Mark Jerrian','Morillo','2055878750',11,1,'107929473768724900442','https://lh3.googleusercontent.com/a/ACg8ocIpFr3LCBIqemXnrLqgeJBcQNrE1fxB_dExFfBKH-ozxFAks1E=s96-c',NULL),(60,'Joshua Tandaan','jotandaan@my.cspc.edu.ph',NULL,'$2y$12$u9qnA8J8nwFjg3GvqC5q6.sN.wZhE70ua.Yl6bEASH21bQlT2H28C',NULL,'2024-10-14 22:18:36','2024-10-14 22:30:31','231002249','Joshua','Tandaan','1474728542',11,1,'107841529057063269436','https://lh3.googleusercontent.com/a/ACg8ocJi6tnCEtJuuk9YONilEJbb2Dt66cEul0YY-5kJ2ywTlpFdWmoL=s96-c',NULL),(61,'Gil Rexis Realubit','girealubit@my.cspc.edu.ph',NULL,'$2y$12$61dv/.qAUseNyPb/xNuQSedTueQQEvdsiKN./JQ95O7.dl05tmaFu',NULL,'2024-10-14 22:18:36','2024-10-14 22:31:01','231005330','Gil Rexis','Realubit','1834649454',11,1,'108592044885721722005','https://lh3.googleusercontent.com/a/ACg8ocJXgz2z273sX22Vh9N1kKP-fo4YQyF6cUrpgquMW7uWhaCiCZc=s96-c','light'),(62,'Benedith Reofrio','bereofrio@my.cspc.edu.ph',NULL,'$2y$12$EjxBh0rCoilGA7LdTME9/eZBJxxQJOm2hfWlPem1not73yq/0hLK.',NULL,'2024-10-14 22:18:51','2024-10-14 22:19:37','231003767','Benedith','Reofrio',NULL,11,2,'115063907376221245241','https://lh3.googleusercontent.com/a/ACg8ocLk9LoNBNI48XrqLnAdmviG4P-h_BDeoO2Xp-by-lqR3jPYWHY=s96-c',NULL),(63,'Emman James Sanchez','emsanchez@my.cspc.edu.ph',NULL,'$2y$12$Wv9XrC7E0/VBDWn3CV1NW.EI.5z4N9nX163A2j50TpSJTgX8WpUX2',NULL,'2024-10-14 22:19:03','2024-10-14 22:31:34','231003222','Emman James','Sanchez','1455973470',11,1,'105110449719568697466','https://lh3.googleusercontent.com/a/ACg8ocKVRhw6SC-CPOPT0f_f-zozh0nh83LssJSHqz14_5FT1UyuJJc=s96-c','light'),(64,'J. Christian Pius Simon Sotaso','j.sotaso@my.cspc.edu.ph',NULL,'$2y$12$qIeGlNKg3cmMm9oBsVyOAuSrh1enANUF0TozYNQl3dCLeb6k4nabm',NULL,'2024-10-14 22:19:06','2024-10-14 22:32:16','231002240','J. Christian Pius Simon','Sotaso','1454801358',11,1,'101507576170851487308','https://lh3.googleusercontent.com/a/ACg8ocJ58cQpaN9lRoAUFjvPGPJtohHyvC11Hh8fNvqmmXbYAgdpUQEX=s96-c','dark'),(65,'Mark Angelo Fulledo','mafulledo@my.cspc.edu.ph',NULL,'$2y$12$9fi6DVYA/7uP41SErKlOa.ROI9AZnA8.YYnFPwqWwFeYKWt0GQNJC',NULL,'2024-10-14 22:19:11','2024-10-14 22:19:35','C21101131','Mark Angelo','Fulledo',NULL,11,1,'118349898489946158652','https://lh3.googleusercontent.com/a/ACg8ocLq0h7ZGw9x-c5IWz5vqXkNd7WKJIihw8NpAzuN17SHD4L-AaZE=s96-c',NULL),(66,'John Andrey Cimini','jocimini@my.cspc.edu.ph',NULL,'$2y$12$lM1B25mosMVIV3WI5GONB.NnkFclslMqRPVMUhsQ4dUBkbbekuYaa',NULL,'2024-10-14 22:19:19','2024-10-14 22:22:23','2410866','John Andrey','Cimini',NULL,11,1,'109038277820909103509','https://lh3.googleusercontent.com/a/ACg8ocKbCR2SiTwBVDUqNOW81ti2e6xx0t1IALC1XJkpaYlNGFhlLQ=s96-c','dark'),(67,'Angelie Benosa','anbenosa@my.cspc.edu.ph',NULL,'$2y$12$la5JOB51lmoHF6vJ2KnBXOWQmD8/0qr2cl/hHdR1cboKyU49Ql3uq',NULL,'2024-10-14 22:19:30','2024-10-14 22:35:40','231002081','Angelie','Benosa','2029018221',11,2,'104654586560707021115','https://lh3.googleusercontent.com/a/ACg8ocIOOzTaIYnVKQFxcSMvzwLbBmW2jBfJU7AzoriSRgpWLRneAQ=s96-c',NULL),(68,'Mark Kenneth Ellorde','maellorde@my.cspc.edu.ph',NULL,'$2y$12$oUR33GSqLnYhNsgN0i9vuedK0h9einmA2GHWch2hI80SDy5nzBUf.',NULL,'2024-10-14 22:19:44','2024-10-14 22:35:25','231002133','Mark Kenneth','Ellorde','1471746414',11,1,'112886837479727572248','https://lh3.googleusercontent.com/a/ACg8ocISWoPoRoSw-nEiAXxnIjti-SI7EKEgY6Hqe8lkwT-XE8ZTA60=s96-c','dark'),(69,'IRISH RUIN','irruin@my.cspc.edu.ph',NULL,'$2y$12$/3tVp0/vaBA0zJkGXEakv.kyU3.3wsWAT2NHgvA0n4NZT9ANPep0m',NULL,'2024-10-14 22:19:51','2024-10-14 22:29:19','231004017','IRISH','RUIN','1471121294',11,2,'117284177200644271774','https://lh3.googleusercontent.com/a/ACg8ocJbwaoIJEd2zOUfka96OWYHPo-ZhWnL3RZ2P7reuLT5zsebAVM=s96-c',NULL),(70,'LEANNE PRENCIS LIAO','leliao@my.cspc.edu.ph',NULL,'$2y$12$0mmpt.f2JZwuTzDfaWm64uc8VW19Ixa7oSVpK7SGdrPM./AE11Z0m',NULL,'2024-10-14 22:22:21','2024-10-14 22:31:19','231002277','LEANNE PRENCIS','LIAO','1459830670',11,2,'114845875333804977376','https://lh3.googleusercontent.com/a/ACg8ocKAYzs_p2foQeFhy6i6aY56D7l5aavgIIeha2NCHgWNWSW6dGY=s96-c',NULL),(71,'Frances Bascon','frbascon@my.cspc.edu.ph',NULL,'$2y$12$gB2bmMVSdR0RmbaqhMK89.M.E/uUGsPh2dL4ngBtvkk5xZk1QgQOW',NULL,'2024-10-14 22:22:24','2024-10-14 22:30:08','231002075','Frances','Bascon','1455309902',11,1,'101726416241925923605','https://lh3.googleusercontent.com/a/ACg8ocI8pDBQEb6HDOourl_xi49J8dWm-IYjLsITc0qlQ94ZwPc88d8=s96-c','light'),(72,'Dobert Pariña','doparina@my.cspc.edu.ph',NULL,'$2y$12$RQ6Mjns.SaRw7.qzrRJ0MOl8BFJPtGgEF4PB9UzAX0e6TYSQbAOLe',NULL,'2024-10-14 22:23:16','2024-10-14 22:36:31','231002022','Dobert','Pariña','1455570206',17,1,'104873314084923221528','https://lh3.googleusercontent.com/a/ACg8ocKgwcniguBfAu3H0wOTRUDOBZ9iq43rad38A5KeFnnPEmXThNQ=s96-c',NULL),(73,'Dominic Castroverde','docastroverde@my.cspc.edu.ph',NULL,'$2y$12$CAYWuaL3AzFr5NNo0HRfferJolWgZoTgIGtyM7VdUr4tBCwpbKkiy',NULL,'2024-10-14 22:23:35','2024-10-14 22:36:18','231002108','Dominic','Castroverde','1473447166',11,1,'109740816292630011102','https://lh3.googleusercontent.com/a/ACg8ocK0uwCVGybn8BR1hKy6eAXUf9W1s3TXOVAon3aTZr9W1icjN5wh=s96-c',NULL),(74,'Cherrie Mae Panton','chpanton@my.cspc.edu.ph',NULL,'$2y$12$1z2P4k7jEXVqgIgTDbW3u.1YJRA.xzkQ7F3ZMw/TxM3C2.2ki.p/2',NULL,'2024-10-14 22:24:48','2024-10-14 22:29:29','231004315','Cherrie Mae','Panton','1457764510',11,2,'110353394294704549359','https://lh3.googleusercontent.com/a/ACg8ocKOIWqfem9xFPrFGH7ki5iYuKgqcCV6CpX7_HNK7TR5VawRtfEn=s96-c',NULL),(75,NULL,'mamiguel@my.cspc.edu.ph',NULL,'$2y$12$JgPFGc6JuTf86u7/ZYXvWuH1zkzEB/NVR4pOUv8t4uyMJzUw0UVza',NULL,'2024-11-12 05:26:54','2024-11-12 05:26:54','C21101173','Mark Glen','Miguel',NULL,1,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

