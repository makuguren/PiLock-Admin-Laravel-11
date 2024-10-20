
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
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint DEFAULT '0' COMMENT '0=None, 1=Male, 2=Female',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_theme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Super','Admin','superadmin@gmail.com',0,NULL,'$2y$12$Lmhxe0RmNHjIKrAgSNRpGeG13rxEGL3oDg7Tn4.OsXdug0RILWhOe',NULL,'2024-10-19 02:03:42','2024-10-19 02:03:42','light');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `archives` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `snapshot_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `snapshot_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` enum('First','Second') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Inactive, 1=Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  `isPresent` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=Absent, 1=Present',
  `isCurrent` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=No, 1=Yes',
  `isMakeUp` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=Regular, 1=MakeUp',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_student_id_foreign` (`student_id`),
  KEY `attendances_course_id_foreign` (`course_id`),
  CONSTRAINT `attendances_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
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
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:55:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"View Dashboard\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"View RFID Checker\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:14:\"View Analytics\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:16:\"View Attendances\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:24:\"View Current Attendances\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"View Sections\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"Create Sections\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"Update Sections\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"Delete Sections\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"View Courses\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:14:\"Create Courses\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:14:\"Update Courses\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:14:\"Delete Courses\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:13:\"View Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"Create Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"Update Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:15:\"Delete Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:23:\"Add Tag UID to Students\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:12:\"Disable RFID\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:16:\"View Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:18:\"Create Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:18:\"Update Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:18:\"Delete Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:26:\"Add Tag UID to Instructors\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:11:\"View Events\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:13:\"Create Events\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:13:\"Update Events\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:13:\"Delete Events\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:22:\"View Regular Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:24:\"Create Regular Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:24:\"Update Regular Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:24:\"Delete Regular Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:22:\"View Make-Up Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:24:\"Create Make-Up Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:24:\"Update Make-Up Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:24:\"Delete Make-Up Schedules\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:27:\"View Make-Up SchedApprovals\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:30:\"Approve Make-Up SchedApprovals\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:30:\"Decline Make-Up SchedApprovals\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:11:\"View Admins\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:13:\"Create Admins\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:13:\"Update Admins\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:13:\"Delete Admins\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:15:\"Add Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:10:\"View Roles\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:12:\"Create Roles\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:12:\"Update Roles\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:12:\"Delete Roles\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:16:\"View Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:18:\"Create Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:18:\"Update Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:18:\"Delete Permissions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:9:\"View Logs\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:13:\"View Settings\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:15:\"Update Settings\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"Super-Admin\";s:1:\"c\";s:5:\"admin\";}}}',1729507484);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `course_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` bigint unsigned DEFAULT NULL,
  `instructor_id` bigint unsigned DEFAULT NULL,
  `course_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_section_id_foreign` (`section_id`),
  KEY `courses_instructor_id_foreign` (`instructor_id`),
  CONSTRAINT `courses_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`),
  CONSTRAINT `courses_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'ITA 215','Networking 1',5,8,'eyJpdiI6Im5LVXp3T3hlcjRTMENiTHptZGhpSEE9PSIsInZhbHVlIjoiNGhjazBNZGFPR241cHZOSUlUbFF5QT09IiwibWFjIjoiMDQzZDhkYWY3YmE4NTZiMGUyOWZiODg2NDY0ZDI2YmE3NWVjMjQ5MmQ5ZWM1YmQzZTQ4NjM0YzE4OWIxNzRjZiIsInRhZyI6IiJ9','2024-10-19 16:07:04','2024-10-19 16:07:04'),(2,'ITA 213','Object Oriented Programming',11,2,'eyJpdiI6IlZwQmdYTGVKMzJHQi9uYkczK3RkaFE9PSIsInZhbHVlIjoiVlZMVmxiMThwRzVSc1M0MGVIcFdjZz09IiwibWFjIjoiZjZiN2RkOTg0NGY0NmJlNzBjZDU4NTBhZjAwYThiNzI3NDAyMWU5NTQ1NjM2NDRjZWUyYWNhYjA0NWRkZGRkNCIsInRhZyI6IiJ9','2024-10-19 16:07:47','2024-10-19 16:07:47');
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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `enrolledcourses` WRITE;
/*!40000 ALTER TABLE `enrolledcourses` DISABLE KEYS */;
INSERT INTO `enrolledcourses` VALUES (1,1,5,'2024-10-14 17:25:40','2024-10-14 17:25:40'),(2,1,3,'2024-10-14 17:26:02','2024-10-14 17:26:02'),(3,1,2,'2024-10-14 17:26:20','2024-10-14 17:26:20'),(4,1,4,'2024-10-14 17:26:37','2024-10-14 17:26:37'),(5,1,1,'2024-10-14 17:27:57','2024-10-14 17:27:57'),(6,1,6,'2024-10-14 17:28:02','2024-10-14 17:28:02'),(7,1,7,'2024-10-14 17:42:14','2024-10-14 17:42:14'),(8,1,9,'2024-10-14 17:46:42','2024-10-14 17:46:42'),(9,1,8,'2024-10-14 17:47:06','2024-10-14 17:47:06'),(10,1,12,'2024-10-14 17:47:29','2024-10-14 17:47:29'),(11,1,11,'2024-10-14 17:47:47','2024-10-14 17:47:47'),(12,1,13,'2024-10-14 17:48:15','2024-10-14 17:48:15'),(13,1,10,'2024-10-14 17:48:40','2024-10-14 17:48:40'),(14,1,15,'2024-10-14 17:51:50','2024-10-14 17:51:50'),(15,1,17,'2024-10-14 17:52:10','2024-10-14 17:52:10'),(16,1,16,'2024-10-14 17:54:09','2024-10-14 17:54:09'),(17,1,19,'2024-10-14 17:54:28','2024-10-14 17:54:28'),(18,1,14,'2024-10-14 17:54:44','2024-10-14 17:54:44'),(19,1,18,'2024-10-14 17:55:01','2024-10-14 17:55:01'),(20,1,20,'2024-10-14 17:56:06','2024-10-14 17:56:06'),(21,2,22,'2024-10-14 17:57:36','2024-10-14 17:57:36'),(22,1,20,'2024-10-14 17:58:08','2024-10-14 17:58:08'),(23,1,23,'2024-10-14 17:59:17','2024-10-14 17:59:17'),(24,1,24,'2024-10-14 17:59:35','2024-10-14 17:59:35'),(25,1,25,'2024-10-14 17:59:53','2024-10-14 17:59:53'),(26,1,28,'2024-10-14 18:02:22','2024-10-14 18:02:22'),(27,1,24,'2024-10-14 18:02:42','2024-10-14 18:02:42'),(28,1,29,'2024-10-14 18:03:07','2024-10-14 18:03:07'),(29,1,27,'2024-10-14 18:03:22','2024-10-14 18:03:22'),(30,1,26,'2024-10-14 18:03:42','2024-10-14 18:03:42'),(31,1,17,'2024-10-14 18:04:02','2024-10-14 18:04:02'),(32,1,21,'2024-10-14 18:04:20','2024-10-14 18:04:20'),(33,1,30,'2024-10-14 18:04:36','2024-10-14 18:04:36'),(34,1,31,'2024-10-14 18:04:56','2024-10-14 18:04:56'),(35,1,32,'2024-10-14 18:05:31','2024-10-14 18:05:31'),(36,1,34,'2024-10-14 18:07:09','2024-10-14 18:07:09'),(37,1,33,'2024-10-14 18:07:38','2024-10-14 18:07:38'),(38,1,35,'2024-10-14 18:08:52','2024-10-14 18:08:52'),(39,1,37,'2024-10-14 18:09:58','2024-10-14 18:09:58'),(40,1,36,'2024-10-14 18:11:27','2024-10-14 18:11:27'),(41,2,44,'2024-10-14 22:17:39','2024-10-14 22:17:39'),(42,2,41,'2024-10-14 22:17:43','2024-10-14 22:17:43'),(43,2,46,'2024-10-14 22:17:53','2024-10-14 22:17:53'),(44,2,42,'2024-10-14 22:18:05','2024-10-14 22:18:05'),(45,2,40,'2024-10-14 22:18:06','2024-10-14 22:18:06'),(46,2,52,'2024-10-14 22:18:10','2024-10-14 22:18:10'),(47,2,45,'2024-10-14 22:18:18','2024-10-14 22:18:18'),(48,2,50,'2024-10-14 22:18:34','2024-10-14 22:18:34'),(49,2,55,'2024-10-14 22:18:37','2024-10-14 22:18:37'),(50,2,49,'2024-10-14 22:18:50','2024-10-14 22:18:50'),(51,2,48,'2024-10-14 22:18:51','2024-10-14 22:18:51'),(52,2,58,'2024-10-14 22:19:09','2024-10-14 22:19:09'),(53,2,57,'2024-10-14 22:19:26','2024-10-14 22:19:26'),(54,2,51,'2024-10-14 22:19:42','2024-10-14 22:19:42'),(55,2,43,'2024-10-14 22:20:07','2024-10-14 22:20:07'),(56,2,65,'2024-10-14 22:20:18','2024-10-14 22:20:18'),(57,2,47,'2024-10-14 22:20:32','2024-10-14 22:20:32'),(58,2,64,'2024-10-14 22:20:36','2024-10-14 22:20:36'),(59,2,56,'2024-10-14 22:20:39','2024-10-14 22:20:39'),(60,2,62,'2024-10-14 22:20:39','2024-10-14 22:20:39'),(61,2,67,'2024-10-14 22:20:40','2024-10-14 22:20:40'),(62,2,63,'2024-10-14 22:20:42','2024-10-14 22:20:42'),(63,2,39,'2024-10-14 22:21:08','2024-10-14 22:21:08'),(64,2,69,'2024-10-14 22:21:11','2024-10-14 22:21:11'),(65,2,66,'2024-10-14 22:21:45','2024-10-14 22:21:45'),(66,2,71,'2024-10-14 22:23:39','2024-10-14 22:23:39'),(67,2,68,'2024-10-14 22:24:07','2024-10-14 22:24:07'),(68,2,72,'2024-10-14 22:24:36','2024-10-14 22:24:36'),(69,2,73,'2024-10-14 22:24:37','2024-10-14 22:24:37'),(70,2,60,'2024-10-14 22:25:29','2024-10-14 22:25:29'),(71,2,61,'2024-10-14 22:25:43','2024-10-14 22:25:43'),(72,2,54,'2024-10-14 22:25:48','2024-10-14 22:25:48'),(73,2,53,'2024-10-14 22:25:50','2024-10-14 22:25:50'),(74,2,59,'2024-10-14 22:26:02','2024-10-14 22:26:02'),(75,2,70,'2024-10-14 22:27:54','2024-10-14 22:27:54');
/*!40000 ALTER TABLE `enrolledcourses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `event_start` time NOT NULL,
  `event_end` time NOT NULL,
  `isCurrent` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'SUNTUKAN SA CCS GROUNDS','SUNTUKAN SA CCS GROUNDS','2024-10-19','07:00:00','19:00:00','0','2024-10-19 16:20:10','2024-10-19 16:20:10');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
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
INSERT INTO `faculty_logs` VALUES (1,2,'14:40:03','14:44:02','2024-10-15','2024-10-14 22:40:03','2024-10-14 22:44:02'),(2,2,'14:49:18','14:49:39','2024-10-15','2024-10-14 22:49:18','2024-10-14 22:49:39'),(3,2,'14:52:09','15:00:07','2024-10-15','2024-10-14 22:52:09','2024-10-14 23:00:07');
/*!40000 ALTER TABLE `faculty_logs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tag_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=None, 1=Male, 2=Female',
  `instructor_theme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isDefaultPass` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=No, 1=Yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `instructors_email_unique` (`email`),
  UNIQUE KEY `instructors_tag_uid_unique` (`tag_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `instructors` WRITE;
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
INSERT INTO `instructors` VALUES (1,'Vincent','Cortez','vicortez@cspc.edu.ph',NULL,'$2y$12$ob4ZEztcNoDpgbIkfKLeJ.89g/sUKZFqOyR5uM.aQYVWkDwqiD.n6',NULL,'2024-08-20 07:15:28','2024-08-20 07:16:03',NULL,'0',NULL,'1'),(2,'Jayvee','Sias','jvsias@cspc.edu.ph',NULL,'$2y$12$SRMDQhJM7/f7WdLztsc6kO3bmvcYaeiS50Hq7Jz5KN50afHIvLB5K',NULL,'2024-08-20 07:15:50','2024-10-19 15:55:04',NULL,'1',NULL,'1'),(3,'Mark Joseph','Narvadez','manarvadez@cspc.edu.ph',NULL,'$2y$12$5mdwg9jWjPyiWIbFjashw.XrLtjfMws7ahoEMYTrt1zC6E9hWJMOK',NULL,'2024-08-20 07:16:25','2024-08-20 07:16:25',NULL,'0',NULL,'1'),(4,'Eisen Rose','Galvante','eigalvante@cspc.edu.ph',NULL,'$2y$12$jQkf3vTznoIj8QHttva/hetqajs41n9gshDRMrTw/3l8WYCzUdx4O',NULL,'2024-08-20 07:16:49','2024-08-20 07:16:49',NULL,'0',NULL,'1'),(5,'Vencel','Sanglay','vesanglay@cspc.edu.ph',NULL,'$2y$12$IGRIh5IR8nrNNSEjKd6ujuuEaCVLU5YqFi9P9kKke39pLU5EvSZFa',NULL,'2024-08-20 07:17:13','2024-08-20 07:17:13',NULL,'0',NULL,'1'),(6,'Derick','Parañal','deparanal@cspc.edu.ph',NULL,'$2y$12$H1OqtIJxZ4tA31o9rkbmtuwQ6FmKFcU1kg2SPRduE15Z7zSPTP/Y.',NULL,'2024-08-20 07:17:35','2024-08-20 07:17:35',NULL,'0',NULL,'1'),(7,'Mark Anthony','Taduran','mataduran@cspc.edu.ph',NULL,'$2y$12$VAYKCDnaatNCoinXPUWBvOkk.pg98mL5J2f7Rlv/.pyOEr3f2/Bne',NULL,'2024-08-20 07:17:55','2024-08-20 07:17:55',NULL,'0',NULL,'1'),(8,'Rey','Cortez','recortez@cspc.edu.ph',NULL,'$2y$12$8Of9dMo7rpgPEH9dhM3cpOmoU1Cr.XBGHD1JHbG7MHgi9mkfHsyli',NULL,'2024-10-19 16:06:08','2024-10-19 16:06:08',NULL,'1',NULL,'1');
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `logs` VALUES (1,44,2,'14:40:23',NULL,'2024-10-15','2024-10-14 22:40:23','2024-10-14 22:40:23'),(2,71,2,'14:40:38',NULL,'2024-10-15','2024-10-14 22:40:38','2024-10-14 22:40:38'),(3,67,2,'14:40:49','14:56:17','2024-10-15','2024-10-14 22:40:49','2024-10-14 22:56:17'),(4,41,2,'14:40:57',NULL,'2024-10-15','2024-10-14 22:40:57','2024-10-14 22:40:57'),(5,41,2,'14:40:58',NULL,'2024-10-15','2024-10-14 22:40:58','2024-10-14 22:40:58'),(6,52,2,'14:41:02',NULL,'2024-10-15','2024-10-14 22:41:02','2024-10-14 22:41:02'),(7,69,2,'14:41:12',NULL,'2024-10-15','2024-10-14 22:41:12','2024-10-14 22:41:12'),(8,57,2,'14:41:22',NULL,'2024-10-15','2024-10-14 22:41:22','2024-10-14 22:41:22'),(9,57,2,'14:41:23',NULL,'2024-10-15','2024-10-14 22:41:23','2024-10-14 22:41:23'),(10,47,2,'14:41:26',NULL,'2024-10-15','2024-10-14 22:41:26','2024-10-14 22:41:26'),(11,47,2,'14:41:27',NULL,'2024-10-15','2024-10-14 22:41:27','2024-10-14 22:41:27'),(12,45,2,'14:41:30',NULL,'2024-10-15','2024-10-14 22:41:30','2024-10-14 22:41:30'),(13,45,2,'14:41:31',NULL,'2024-10-15','2024-10-14 22:41:31','2024-10-14 22:41:31'),(14,46,2,'14:41:34',NULL,'2024-10-15','2024-10-14 22:41:34','2024-10-14 22:41:34'),(15,46,2,'14:41:36',NULL,'2024-10-15','2024-10-14 22:41:36','2024-10-14 22:41:36'),(16,56,2,'14:41:38',NULL,'2024-10-15','2024-10-14 22:41:38','2024-10-14 22:41:38'),(17,60,2,'14:41:44',NULL,'2024-10-15','2024-10-14 22:41:44','2024-10-14 22:41:44'),(18,39,2,'14:41:58',NULL,'2024-10-15','2024-10-14 22:41:58','2024-10-14 22:41:58'),(19,50,2,'14:42:03',NULL,'2024-10-15','2024-10-14 22:42:03','2024-10-14 22:42:03'),(20,50,2,'14:42:05',NULL,'2024-10-15','2024-10-14 22:42:05','2024-10-14 22:42:05'),(21,48,2,'14:42:07',NULL,'2024-10-15','2024-10-14 22:42:07','2024-10-14 22:42:07'),(22,49,2,'14:42:11',NULL,'2024-10-15','2024-10-14 22:42:11','2024-10-14 22:42:11'),(23,49,2,'14:42:13',NULL,'2024-10-15','2024-10-14 22:42:13','2024-10-14 22:42:13'),(24,68,2,'14:42:15',NULL,'2024-10-15','2024-10-14 22:42:15','2024-10-14 22:42:15'),(25,68,2,'14:42:17',NULL,'2024-10-15','2024-10-14 22:42:17','2024-10-14 22:42:17'),(26,64,2,'14:42:29',NULL,'2024-10-15','2024-10-14 22:42:29','2024-10-14 22:42:29'),(27,64,2,'14:42:31',NULL,'2024-10-15','2024-10-14 22:42:31','2024-10-14 22:42:31'),(28,72,2,'14:42:34',NULL,'2024-10-15','2024-10-14 22:42:34','2024-10-14 22:42:34'),(29,58,2,'14:42:46',NULL,'2024-10-15','2024-10-14 22:42:46','2024-10-14 22:42:46'),(30,58,2,'14:42:48',NULL,'2024-10-15','2024-10-14 22:42:48','2024-10-14 22:42:48'),(31,59,2,'14:43:04',NULL,'2024-10-15','2024-10-14 22:43:04','2024-10-14 22:43:04'),(32,59,2,'14:43:05',NULL,'2024-10-15','2024-10-14 22:43:05','2024-10-14 22:43:05'),(33,54,2,'14:43:18',NULL,'2024-10-15','2024-10-14 22:43:18','2024-10-14 22:43:18'),(34,54,2,'14:43:19',NULL,'2024-10-15','2024-10-14 22:43:19','2024-10-14 22:43:19'),(35,63,2,'14:43:33',NULL,'2024-10-15','2024-10-14 22:43:33','2024-10-14 22:43:33'),(36,63,2,'14:43:34',NULL,'2024-10-15','2024-10-14 22:43:34','2024-10-14 22:43:34'),(37,61,2,'14:43:46',NULL,'2024-10-15','2024-10-14 22:43:46','2024-10-14 22:43:46'),(38,61,2,'14:43:48',NULL,'2024-10-15','2024-10-14 22:43:48','2024-10-14 22:43:48'),(39,44,2,'14:53:27',NULL,'2024-10-15','2024-10-14 22:53:27','2024-10-14 22:53:27');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `makeup_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `makeup_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned DEFAULT NULL,
  `days` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `lateDuration` int DEFAULT NULL,
  `isApproved` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=Pending, 1=Approved, 2=Declined',
  `isCurrent` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isAttend` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
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
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_sections_table',1),(2,'0001_01_01_000001_create_users_table',1),(3,'0001_01_01_000002_create_cache_table',1),(4,'0001_01_01_000003_create_jobs_table',1),(5,'2024_05_17_091021_create_admins_table',1),(6,'2024_05_17_093515_create_instructors_table',1),(7,'2024_05_19_102610_create_courses_table',1),(8,'2024_05_19_102610_create_subjects_table',1),(9,'2024_05_19_103812_create_events_table',1),(10,'2024_05_27_093609_create_schedules_table',1),(11,'2024_05_27_100343_create_logs_table',1),(12,'2024_05_28_031304_create_personal_access_tokens_table',1),(13,'2024_06_09_002233_add_details_to_admins_table',1),(14,'2024_06_09_002505_create_settings_table',1),(15,'2024_06_11_023145_create_attendances_table',1),(16,'2024_07_27_185649_create_students_seat_plan_table',1),(17,'2024_08_01_103528_create_permission_tables',1),(18,'2024_08_14_003436_create_enrolledcourses_table',1),(19,'2024_08_31_155102_create_blocked_student_courses_table',1),(20,'2024_10_12_120432_create_makeup_schedules_table',1),(21,'2024_10_14_123249_create_faculty_logs_table',1),(23,'2024_10_19_014600_create_archives_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\Admin',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'View Dashboard','admin','2024-10-19 02:03:26','2024-10-19 02:03:26'),(2,'View RFID Checker','admin','2024-10-19 02:03:26','2024-10-19 02:03:26'),(3,'View Analytics','admin','2024-10-19 02:03:26','2024-10-19 02:03:26'),(4,'View Attendances','admin','2024-10-19 02:03:26','2024-10-19 02:03:26'),(5,'View Current Attendances','admin','2024-10-19 02:03:27','2024-10-19 02:03:27'),(6,'View Sections','admin','2024-10-19 02:03:27','2024-10-19 02:03:27'),(7,'Create Sections','admin','2024-10-19 02:03:27','2024-10-19 02:03:27'),(8,'Update Sections','admin','2024-10-19 02:03:27','2024-10-19 02:03:27'),(9,'Delete Sections','admin','2024-10-19 02:03:28','2024-10-19 02:03:28'),(10,'View Courses','admin','2024-10-19 02:03:28','2024-10-19 02:03:28'),(11,'Create Courses','admin','2024-10-19 02:03:28','2024-10-19 02:03:28'),(12,'Update Courses','admin','2024-10-19 02:03:28','2024-10-19 02:03:28'),(13,'Delete Courses','admin','2024-10-19 02:03:28','2024-10-19 02:03:28'),(14,'View Students','admin','2024-10-19 02:03:28','2024-10-19 02:03:28'),(15,'Create Students','admin','2024-10-19 02:03:29','2024-10-19 02:03:29'),(16,'Update Students','admin','2024-10-19 02:03:29','2024-10-19 02:03:29'),(17,'Delete Students','admin','2024-10-19 02:03:29','2024-10-19 02:03:29'),(18,'Add Tag UID to Students','admin','2024-10-19 02:03:29','2024-10-19 02:03:29'),(19,'Disable RFID','admin','2024-10-19 02:03:29','2024-10-19 02:03:29'),(20,'View Instructors','admin','2024-10-19 02:03:29','2024-10-19 02:03:29'),(21,'Create Instructors','admin','2024-10-19 02:03:30','2024-10-19 02:03:30'),(22,'Update Instructors','admin','2024-10-19 02:03:30','2024-10-19 02:03:30'),(23,'Delete Instructors','admin','2024-10-19 02:03:30','2024-10-19 02:03:30'),(24,'Add Tag UID to Instructors','admin','2024-10-19 02:03:30','2024-10-19 02:03:30'),(25,'View Events','admin','2024-10-19 02:03:30','2024-10-19 02:03:30'),(26,'Create Events','admin','2024-10-19 02:03:31','2024-10-19 02:03:31'),(27,'Update Events','admin','2024-10-19 02:03:31','2024-10-19 02:03:31'),(28,'Delete Events','admin','2024-10-19 02:03:31','2024-10-19 02:03:31'),(29,'View Regular Schedules','admin','2024-10-19 02:03:31','2024-10-19 02:03:31'),(30,'Create Regular Schedules','admin','2024-10-19 02:03:31','2024-10-19 02:03:31'),(31,'Update Regular Schedules','admin','2024-10-19 02:03:32','2024-10-19 02:03:32'),(32,'Delete Regular Schedules','admin','2024-10-19 02:03:32','2024-10-19 02:03:32'),(33,'View Make-Up Schedules','admin','2024-10-19 02:03:32','2024-10-19 02:03:32'),(34,'Create Make-Up Schedules','admin','2024-10-19 02:03:33','2024-10-19 02:03:33'),(35,'Update Make-Up Schedules','admin','2024-10-19 02:03:33','2024-10-19 02:03:33'),(36,'Delete Make-Up Schedules','admin','2024-10-19 02:03:33','2024-10-19 02:03:33'),(37,'View Make-Up SchedApprovals','admin','2024-10-19 02:03:34','2024-10-19 02:03:34'),(38,'Approve Make-Up SchedApprovals','admin','2024-10-19 02:03:34','2024-10-19 02:03:34'),(39,'Decline Make-Up SchedApprovals','admin','2024-10-19 02:03:34','2024-10-19 02:03:34'),(40,'View Admins','admin','2024-10-19 02:03:34','2024-10-19 02:03:34'),(41,'Create Admins','admin','2024-10-19 02:03:35','2024-10-19 02:03:35'),(42,'Update Admins','admin','2024-10-19 02:03:36','2024-10-19 02:03:36'),(43,'Delete Admins','admin','2024-10-19 02:03:36','2024-10-19 02:03:36'),(44,'Add Permissions','admin','2024-10-19 02:03:37','2024-10-19 02:03:37'),(45,'View Roles','admin','2024-10-19 02:03:37','2024-10-19 02:03:37'),(46,'Create Roles','admin','2024-10-19 02:03:37','2024-10-19 02:03:37'),(47,'Update Roles','admin','2024-10-19 02:03:38','2024-10-19 02:03:38'),(48,'Delete Roles','admin','2024-10-19 02:03:38','2024-10-19 02:03:38'),(49,'View Permissions','admin','2024-10-19 02:03:39','2024-10-19 02:03:39'),(50,'Create Permissions','admin','2024-10-19 02:03:39','2024-10-19 02:03:39'),(51,'Update Permissions','admin','2024-10-19 02:03:39','2024-10-19 02:03:39'),(52,'Delete Permissions','admin','2024-10-19 02:03:39','2024-10-19 02:03:39'),(53,'View Logs','admin','2024-10-19 02:03:39','2024-10-19 02:03:39'),(54,'View Settings','admin','2024-10-19 02:03:40','2024-10-19 02:03:40'),(55,'Update Settings','admin','2024-10-19 02:03:40','2024-10-19 02:03:40');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super-Admin','admin','2024-10-19 02:03:40','2024-10-19 02:03:40'),(2,'Admin','admin','2024-10-19 02:03:40','2024-10-19 02:03:40'),(3,'Staff','admin','2024-10-19 02:03:40','2024-10-19 02:03:40');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned DEFAULT NULL,
  `days` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `lateDuration` int DEFAULT NULL,
  `isMakeUp` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=Regular, 1=MakeUp',
  `isApproved` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=Pending, 1=Approved, 2=Declined',
  `isCurrent` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isAttend` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_course_id_foreign` (`course_id`),
  CONSTRAINT `schedules_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,1,'Sunday','07:00:00','10:00:00',NULL,'0','1','0','0','2024-10-19 16:19:08','2024-10-19 16:19:08'),(2,2,'Monday','10:00:00','13:00:00',NULL,'0','1','0','0','2024-10-19 16:19:24','2024-10-19 16:19:33');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `seat_plan` WRITE;
/*!40000 ALTER TABLE `seat_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `seat_plan` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `block` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('ElGLABldDAwcjgc5SA3Bw2wKJRJ7BaSSRFD9fYvw',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWUFaeERpclNXQXVsd1ZsSXpYUFVRY01GSFB1V2tWbnNYbTByRGI3YyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL3NldHRpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1729425326),('EorbzANK0QKxRYhLkY83PXdicNFj5cRj7kzKngKm',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY3IyZkNBb2MwSldVNDR0WHZpb0NDQmZCTmJhbmg3YXg3RjR5QUxTayI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1729425797),('OnJUXXinLYMHaYlSZV00VyUKhG4N8stTa8Vf0zTy',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ2pFRTRoTHV0QUFJMzJTVzMzZDNVUjJQS1EyTlpESHdMTnlHYUE4UyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1729425326),('skLJPOGSOwrhBeMnLKPxLMooV6ROmOcq41LALNz8',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGt2WFFMT25Ud2U5azdlazVNU1NnNGpyMVNXTjNsWHJqWVFudExiciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL3NldHRpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1729425797),('vnUwqg2cGm82ye6SI7MFA3Svjz6EfjY4HUmo4IZb',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoidGVJRFdTM2NwNWJ4dGpZVGhlUzE2N0ZaY2xsWkxyRzhXWkxwb0x0cCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL2FyY2hpdmVzIjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1729426592);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `website_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isMaintenance` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isDevInteg` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isRegStud` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isRegLoginStud` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isRegInst` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `isRegAdmins` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=No, 1=Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Pi:Lock | Admin','0','0','0','0','0','0','2024-10-19 02:03:43','2024-10-19 02:03:43');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` bigint unsigned DEFAULT NULL,
  `gender` tinyint DEFAULT '0' COMMENT '0=None, 1=Male, 2=Female',
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_theme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_student_id_unique` (`student_id`),
  UNIQUE KEY `users_tag_uid_unique` (`tag_uid`),
  UNIQUE KEY `users_google_id_unique` (`google_id`),
  KEY `users_section_id_foreign` (`section_id`),
  CONSTRAINT `users_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'erlaresma@my.cspc.edu.ph',NULL,'$2y$12$pW7bxcMLKGLPT0rwa/.w5u4QJpbKtm8Uxjd/FsRyERhdWbCa.x9JK',NULL,'2024-10-14 17:13:32','2024-10-14 17:15:15','231003703','Erica May','Laresma','1453599534',5,2,NULL,NULL,NULL),(2,NULL,'jotoldanes@my.cspc.edu.ph',NULL,'$2y$12$W0lEmAbYlGf3BuDiukIW4uBWanOgO69o2XGU5WI5p8utcyvd.vCnG',NULL,'2024-10-14 17:14:32','2024-10-14 17:15:31','231002254','John Michael','Toldanes','4170167386',5,1,NULL,NULL,NULL),(3,NULL,'anmedrano@my.cspc.edu.ph',NULL,'$2y$12$PfoqtIUluY3tgD8xNE1KReZTEd4IqOI/u4BI5T5lwxBenAIngHaXG',NULL,'2024-10-14 17:16:47','2024-10-14 17:18:17','231002017','Anele','Medrano','1455810206',5,2,NULL,NULL,NULL),(4,NULL,'joellorde@my.cspc.edu.ph',NULL,'$2y$12$WhT2JheoKiO4R17oAupnBOXrnpDXRTAKwIxIj1gz372v.9Chnz.ka',NULL,'2024-10-14 17:19:21','2024-10-14 17:20:32','231004092','Joanne Faye','Ellorde','3111397747',5,2,NULL,NULL,NULL),(5,NULL,'reespeleta@my.cspc.edu.ph',NULL,'$2y$12$1ECh.MxQ8D9KedPfUZIUveWkKs9jQ1jH8s3OgFrwTvBQ8c/f5dlum',NULL,'2024-10-14 17:20:03','2024-10-14 17:22:45','231002012','Rene','Espeleta','1812379357',5,2,NULL,NULL,NULL),(6,NULL,'cacezar@my.cspc.edu.ph',NULL,'$2y$12$IOxUocoZhRJRS26vw07RiOo1whQyK33WRMEqMPvcHgSH6JO9A451e',NULL,'2024-10-14 17:20:24','2024-10-14 17:21:18','231002112','Carla','Cezar','1813121405',5,2,NULL,NULL,NULL),(7,NULL,'jalucena@my.cspc.edu.ph',NULL,'$2y$12$GdmTXBLB3N.cjPe7F/GIDeBp9xgBEqya408WDyizGaMk0FHcT5qdW',NULL,'2024-10-14 17:40:45','2024-10-14 17:41:14','231005444','Jan Russel','Lucena','1477355310',5,1,NULL,NULL,NULL),(8,NULL,'allitradio@my.cspc.edu.ph',NULL,'$2y$12$woyx7rpQHVygaK7lGbvuhef4yIRxfQqmY5vvMn/Ox0x6/LH04Tfm.',NULL,'2024-10-14 17:43:28','2024-10-14 17:43:56','231003884','Alliah','Tradio','3800653402',5,2,NULL,NULL,NULL),(9,NULL,'ashberdio@my.cspc.edu.ph',NULL,'$2y$12$XE07Gp8riggUpopXes1.9O8oFmMsMKERbCPi8w6ZD1dqYIDgFIAGG',NULL,'2024-10-14 17:44:46','2024-10-14 17:45:03','231002082','Ashley','Berido','4170600218',5,2,NULL,NULL,NULL),(10,NULL,'jolagriada@my.cspc.edu.ph',NULL,'$2y$12$9ZirI5VCZlPDOu3Aj2YsU.fkh96i.buqUv798/H5FImsIrEhy928m',NULL,'2024-10-14 17:45:01','2024-10-14 17:47:53','C20101178','John Albert','Lagriada','3886575036',5,1,NULL,NULL,NULL),(11,NULL,'lifrancisco@my.cspc.edu.ph',NULL,'$2y$12$SYMEPA/ISWKzU9zROy9ijeDSS/XdkT9OclnP1N35x4Ojs4ai465yK',NULL,'2024-10-14 17:45:48','2024-10-14 17:47:18','231002141','Lizzie','Francisco','1473045918',5,2,NULL,NULL,NULL),(12,NULL,'luisorbon@my.cspc.edu.ph',NULL,'$2y$12$Bd4j.LT.nBTkuYWF1k9USefMCnKUOY8GyvYn/TrzdX0q3QLK9QJrS',NULL,'2024-10-14 17:46:28','2024-10-14 17:46:43','231002189','Luis Gabriel','Orbon','1473736206',5,1,NULL,NULL,NULL),(13,NULL,'shangeles@my.cspc.edu.ph',NULL,'$2y$12$7VIY7IQRqsEX8sO.QQv4aONqX6MCZP696BkWvGHwBngbVYoPaZ/Au',NULL,'2024-10-14 17:46:57','2024-10-14 17:47:35','231002056','Shaniah','Angeles','1454465006',5,2,NULL,NULL,NULL),(14,NULL,'desendon@my.cspc.edu.ph',NULL,'$2y$12$soW5K2eZF62hsAUU0PbkRebphPrgWiNC5lEq4htk8sMZx8Gfs9Yfe',NULL,'2024-10-14 17:48:10','2024-10-14 17:54:24','231003118','Deanne','Sendon','1471364142',5,2,NULL,NULL,NULL),(15,NULL,'paullandagan@my.cspc.edu.ph',NULL,'$2y$12$rKKXL5Igea9ryby0jlbfxuS7fYo/sYNBz7FjptsClXqBw7mtJquEC',NULL,'2024-10-14 17:49:09','2024-10-14 17:51:19','231004136','Paul Robert','Landagan','1454436798',5,1,NULL,NULL,NULL),(16,NULL,'kubermejo@my.cspc.edu.ph',NULL,'$2y$12$wB5FuKgo5MJQ6LqagzhSeuusyW5o5A2SK2XmkTwgpIyPN95GmlVBi',NULL,'2024-10-14 17:49:17','2024-10-14 17:53:46','231002268','Kurt','Bermejo','1457307598',5,1,NULL,NULL,NULL),(17,NULL,'jeoliveros@my.cspc.edu.ph',NULL,'$2y$12$KvGZ2gZqCqVNTVtuDfRYvO7m9seQ6huRuazUMEELht7RgF.gdM5/S',NULL,'2024-10-14 17:50:18','2024-10-14 17:51:32','231002021','Jeroboam','Oliveros','1454145374',5,1,NULL,NULL,NULL),(18,NULL,'rasacueza@my.cspc.edu.ph',NULL,'$2y$12$yJF14eXsKqZP0OO.YXirl.7Ai3vDCzKHGKIUK.XwRrYBDL5ofEq2K',NULL,'2024-10-14 17:51:27','2024-10-14 17:54:41','231005354','Raynell','Sacueza','1834892638',5,1,NULL,NULL,NULL),(19,NULL,'jualipio@my.cspc.edu.ph',NULL,'$2y$12$q4Va25SckzCLGuV6NhtlV.HRv4K6gg8e1v1sSh3F/EqSPkYg4D7LG',NULL,'2024-10-14 17:52:43','2024-10-14 17:54:02','231002053','Julianne','Alipio','1455338750',5,2,NULL,NULL,NULL),(20,NULL,'jhdianela@my.cspc.edu.ph',NULL,'$2y$12$FMK8rW60SBx0YP9G5ZnRbuYOMBrhRmibjerOd0D.INhSJNQbIo8ne',NULL,'2024-10-14 17:54:02','2024-10-14 17:54:57','231002128','Jhyzzeel','Dianela','1457894862',5,2,NULL,NULL,NULL),(21,NULL,'mibaluca@my.cspc.edu.ph',NULL,'$2y$12$YhJOeN0MhC2VS45f8afi9Ogna1my.JZxXEZAWiozXK6aJNipAU66K',NULL,'2024-10-14 17:55:02','2024-10-14 17:55:42','231003869','Miguela','Baluca','1476858206',5,2,NULL,NULL,NULL),(22,NULL,'shmagbanua@my.cspc.edu.ph',NULL,'$2y$12$h6hbCzmGRajhsc/4V3FJ3OBTUiEFGFIvrj6svgof8tJIrO5nYQvLy',NULL,'2024-10-14 17:55:57','2024-10-14 17:57:57','231002168','Shanice','Magbanua','2181866971',5,2,NULL,NULL,NULL),(23,NULL,'mipraxides@my.cspc.edu.ph',NULL,'$2y$12$jEYKOOo2hu4kWro.IdTxXelVJk0g/lahFFqkvIGrY2qGGH1yWqwfa',NULL,'2024-10-14 17:57:27','2024-10-14 17:58:10','231002204','Mikailla','Praxides','1458556014',5,2,NULL,NULL,NULL),(24,NULL,'joagravante@my.cspc.edu.ph',NULL,'$2y$12$ySNNXDYx/xhRupv1TpAsVOXhRsuJJ1VcH47TlHsqk2gTJdXMKAmGq',NULL,'2024-10-14 17:58:19','2024-10-14 17:58:44','231002046','Joemle','Agravante','1476973134',5,1,NULL,NULL,NULL),(25,NULL,'mahernandez@my.cspc.edu.ph',NULL,'$2y$12$7Rdv4WGjTZ0miyYNG5H0VOcy.gtH1EogBg.zRfM4bKsMtvl0IDQtm',NULL,'2024-10-14 17:59:06','2024-10-14 17:59:34','231003029','Mariel','Hernandez','2188188891',5,2,NULL,NULL,NULL),(26,NULL,'josalcedo@my.cspc.edu.ph',NULL,'$2y$12$59riKjRpaOvDo3XjKUoaUO9DyUAJNNgOf5QhZN0im/bZJ7WxUPLjO',NULL,'2024-10-14 17:59:46','2024-10-14 18:00:08','231002036','John','Salcedo','1455962094',5,1,NULL,NULL,NULL),(27,NULL,'jibolalin@my.cspc.edu.ph',NULL,'$2y$12$N6Bn2.wRfSD0Qh8F3qd53eRm2tk31S08Loq5S2v7sbcR/q0hUS0xe',NULL,'2024-10-14 18:00:37','2024-10-14 18:01:58','231002087','Jim','Bolalin','1460296334',5,1,NULL,NULL,NULL),(28,NULL,'casaulon@my.cspc.edu.ph',NULL,'$2y$12$AVHaOoVKjg6DUAy8RPc97.FKO8MNYWzkU4qH4gqMYbchBxCEaHvi.',NULL,'2024-10-14 18:01:17','2024-10-14 18:01:33','231002231','Carl','Saulon','1459425950',5,1,NULL,NULL,NULL),(29,NULL,'jhcastillo@my.cspc.edu.ph',NULL,'$2y$12$Brg6BOblWgw8Vl/jGCqOcORcVgHlHHr0SnCvad.Hht8zAviejWMtG',NULL,'2024-10-14 18:01:34','2024-10-14 18:02:15','231005309','Jhondel','Castillo','2190846155',5,1,NULL,NULL,NULL),(30,NULL,'ephbantillo@my.cspc.edu.ph',NULL,'$2y$12$ralEr0xSCJcfQIUiL5U.eeTrktQqgf9JdQ00oTilhj6J96fIJpog6',NULL,'2024-10-14 18:02:59','2024-10-14 18:03:17','231002069','Ephraim','Bantillo','1453904238',5,1,NULL,NULL,NULL),(31,NULL,'ivdaguinod@my.cspc.edu.ph',NULL,'$2y$12$AGsN4jeVHVNvtNs5QRAe8epiYx6PfqOnx0BOWibLKN4zZJRNs.FJC',NULL,'2024-10-14 18:04:13','2024-10-14 18:04:25','231002122','Ivan','Daguinod','1478596606',5,1,NULL,NULL,NULL),(32,NULL,'chaguilar@my.cspc.edu.ph',NULL,'$2y$12$eqbn37bvpMeYaB5yjMomre3XYlTW7fBU7hr5vDD3e3ktUgsTV.gbu',NULL,'2024-10-14 18:05:07','2024-10-14 18:05:21','231002048','Charles','Aguilar','1473478046',5,1,NULL,NULL,NULL),(33,NULL,'direlleve@my.cspc.edu.ph',NULL,'$2y$12$i4ReDipK5vowbKboAkecO.W0cWf19Usk4gQtbKBNgqMyd0/GyVQpy',NULL,'2024-10-14 18:05:54','2024-10-14 18:06:10','231004281','Dion','Relleve','1455493982',5,1,NULL,NULL,NULL),(34,NULL,'eldelafuente@my.cspc.edu.ph',NULL,'$2y$12$omlrNAL8qSY.KMz92jwzBObbdtkmyatnBpdzLP3pVZa3WK5JuaMHS',NULL,'2024-10-14 18:06:51','2024-10-14 18:06:51','231003760','Elijah','Dela Fuente',NULL,5,1,NULL,NULL,NULL),(35,NULL,'nibermudo@my.cspc.edu.ph',NULL,'$2y$12$F8np2wq5EYmhuNDnxgN1jO8D781vOiFcRgKaJHny9qif.zaLeFgIK',NULL,'2024-10-14 18:08:23','2024-10-14 18:08:23','231002083','Nino','Bermudo',NULL,5,1,NULL,NULL,NULL),(36,NULL,'addaduya@my.cspc.edu.ph',NULL,'$2y$12$lZLgCs2S.x768Hd1kSJZf.q8ZHuAF8xgPMeXictdOfywJWu4QPd8e',NULL,'2024-10-14 18:09:00','2024-10-14 18:09:16','231002119','Adrian','Daduya','1453976270',5,1,NULL,NULL,NULL),(37,NULL,'laroaring@my.cspc.edu.ph',NULL,'$2y$12$QpgeO6/trxY3oVqGsr6fIeR9kfCsalVVt0a/Vf6PYOZIdX.OupBt.',NULL,'2024-10-14 18:09:37','2024-10-14 18:09:37','231002221','Lawrence','Roaring',NULL,5,1,NULL,NULL,NULL),(38,NULL,'kristagle@my.cspc.edu.ph',NULL,'$2y$12$4H35t67MnYB6SrGCwEd2JOa3.O84vQ6c.YJh6ZlMjmnLZ4voP1yWS',NULL,'2024-10-14 18:10:04','2024-10-14 18:10:17','231002244','Kristine','Tagle','2309383197',5,2,NULL,NULL,NULL),(39,'Joshua Daliva','jodaliva@my.cspc.edu.ph',NULL,'$2y$12$RffwO/bwRp8ANdRWowrvEueQ1gvBgp6lE9Q6rpnyi/aZg/7epijmK',NULL,'2024-10-14 22:12:10','2024-10-14 22:26:21','231002123','Joshua','Daliva','1477952958',11,1,'106950034129197582068','https://lh3.googleusercontent.com/a/ACg8ocJhB_ikN1iJ6-sqpEl2xf4BK5RsDf0qOuLWSBNgD0UypdQ3UnY=s96-c','dark'),(40,'FRANK ESTRELLADO','frestrellado@my.cspc.edu.ph',NULL,'$2y$12$AfXemtAZ8V3vhdVgXSiRU.vJpoKRkiPP5r.J8/bPHQPBNv3aVq6Q2',NULL,'2024-10-14 22:14:44','2024-10-14 22:27:40','231002137','FRANK','ESTRELLADO','1474886670',11,1,'102329234529685939297','https://lh3.googleusercontent.com/a/ACg8ocIkXCFhYZ04X_LNmBM3YQiETGM9EYt2fNDi-FEhDCnta5Jkfw=s96-c',NULL),(41,'Mary Grace Audal','maaudal@my.cspc.edu.ph',NULL,'$2y$12$Qn5K1SzCoY774KK4Uc/B8edsQdrzJl5eJcFwSaNhU0NesTq21I1Cq',NULL,'2024-10-14 22:15:11','2024-10-14 22:29:07','231003210','Mary Grace','Audal','1474884382',11,2,'115253381381247464519','https://lh3.googleusercontent.com/a/ACg8ocIQu5Pwmx0IW-6ksQn3kbeSofO0pc7OHekQ9r5oNi0th3CKCcE=s96-c',NULL),(42,'Faith Meca Puyawan','fapuyawan@my.cspc.edu.ph',NULL,'$2y$12$bb6xRVYZ5Jfelzwgy636MuC4vmEBrMnuBiC5OyfRfHxIOJeM6f/8m',NULL,'2024-10-14 22:15:17','2024-10-14 22:35:12','231002027','Faith Meca','Puyawan','1460006126',11,2,'107039647337995025507','https://lh3.googleusercontent.com/a/ACg8ocI2QStwZn6wyywUK9dyHj3UnCWOkxl1UOnw2w1q3Vz8qnG8r5U=s96-c','dark'),(43,'Mary Rose Ababa','maababa@my.cspc.edu.ph',NULL,'$2y$12$Ugsok/U0xNLV5RiA/HzyaeV8.CQxbHwgyHbWu.liG12bTUr9ZlP2S',NULL,'2024-10-14 22:15:56','2024-10-14 22:33:08','231002043','Mary Rose','Ababa','1454606366',11,2,'103876667985497166038','https://lh3.googleusercontent.com/a/ACg8ocJywNcLMY3eI7AM-_l5Fu8-hFdOJIhi1XTLgOK3duhJu9JiI7I=s96-c',NULL),(44,'Lea an Tandaan','letandaan@my.cspc.edu.ph',NULL,'$2y$12$pDhvcK2Ar2Skky2u9MuWheQqjNfqlEeXNSbpedX5MfwL5uHMoMqSS',NULL,'2024-10-14 22:16:03','2024-10-14 22:26:51','231002250','Lea an','Tandaan','2192135883',11,2,'102366106129414540948','https://lh3.googleusercontent.com/a/ACg8ocJTh2IJutaTzqmw_oLKAlLecm0Rk_xNj-qHXraV1OfujV3JQPTa=s96-c','light'),(45,'Manylene Bolano','mabolano@my.cspc.edu.ph',NULL,'$2y$12$zZ3u2AGnipe309M1F8qruunLopxMoGEkDHqRb.XiLKVWxBOJ0QhyK',NULL,'2024-10-14 22:16:13','2024-10-14 22:34:01','231002088','Manylene','Bolano','1476144254',11,2,'116786254847269926342','https://lh3.googleusercontent.com/a/ACg8ocIl8g_BHQbstLOapkLJ-gZG841byynszJodBROwNcxcfcW1Gg=s96-c',NULL),(46,'Norilene Clemeno','noclemeno@my.cspc.edu.ph',NULL,'$2y$12$KA.cF7o4KpAtPLxvztAiqedurMpdfcatheYCSgR2mLP4sJzPuNYAC',NULL,'2024-10-14 22:16:22','2024-10-14 22:33:49','231003299','Norilene','Clemeno','2188632523',11,2,'106053566826460261490','https://lh3.googleusercontent.com/a/ACg8ocLuj2FH_7qXWh-35mxDMyq3APzdsTEDNq5ROzzdAlw9Tdf1cA=s96-c',NULL),(47,'Jeanelle Divilles','jedivilles@my.cspc.edu.ph',NULL,'$2y$12$aP0bHH6y7niD2DQ45pYRBOa8qoFKkJKnPzlOwENoDYkVE7zshcuNK',NULL,'2024-10-14 22:16:26','2024-10-14 22:34:16','231002130','Jeanelle','Divilles','2029216141',17,2,'102633113045516697093','https://lh3.googleusercontent.com/a/ACg8ocJCpHbOX2s_PUAPgGMbJmEaCcgHfgIC3VQv8VQcMjfvj2nmRRfm=s96-c',NULL),(48,'Edlyn Valiente','edvaliente@my.cspc.edu.ph',NULL,'$2y$12$fUI3kFb13/9kcsczC5BQm.FCLOcMmDD/WG7KGa.26zKv0LtO5Ftiu',NULL,'2024-10-14 22:16:30','2024-10-14 22:29:49','231002260','Edlyn','Valiente','1478464222',11,2,'104120331327252004122','https://lh3.googleusercontent.com/a/ACg8ocKiBQo5_2oVO3xbGxpDkC6YBTv9MccIEzJc36ODqDUCnuvo05s=s96-c',NULL),(49,'Sandara Mae Llanes','sallanes@my.cspc.edu.ph',NULL,'$2y$12$56qcXeepgvqO2h2V5YvlcOGwwvzkpn7XmwbwDrxnVWLLxqyNuSeWW',NULL,'2024-10-14 22:16:34','2024-10-14 22:33:22','231002163','Sandara Mae','Llanes','1477852558',11,2,'115982711779014616244','https://lh3.googleusercontent.com/a/ACg8ocIfeB92_YPCydXAKmSXu8TFo_A1vwbkZQEwgvKMnI4HharhOw=s96-c',NULL),(50,'Hans Isaac Tolin','hatolin@my.cspc.edu.ph',NULL,'$2y$12$zNd5Te7HqaUZwPNfzwr7fOhYeZnSFup9FU99Wb5MsRTPFIGJUlnty',NULL,'2024-10-14 22:16:41','2024-10-14 22:27:25','231002040','Hans Isaac','Tolin','1455518654',11,1,'116853824325382285794','https://lh3.googleusercontent.com/a/ACg8ocKvAxoURX0SOP_4nzpL3zVkOCafyKLWDOLQz-xrGcu0gxBY4Oo=s96-c',NULL),(51,'Maica Burgos','maburgos@my.cspc.edu.ph',NULL,'$2y$12$VlpxwSUYNaN3urlrYaQ4juA5GkP1ZhHJzlWdGWMwIVTAsoQ2RDIbm',NULL,'2024-10-14 22:16:53','2024-10-14 22:32:54','231002096','Maica','Burgos','2031341117',11,2,'109811199487757389045','https://lh3.googleusercontent.com/a/ACg8ocKfZwoJwLpqR8P9rRLfkuDtdoAMPlyV6GRhT-KeYbIzivFPBFM=s96-c',NULL),(52,'HARLENE JOY LARCENA','halarcena@my.cspc.edu.ph',NULL,'$2y$12$2VMuBUd0xWFe3pS30yDdL.iqu07W9HgyFmhEQYBSP9o0hmyJEf9De',NULL,'2024-10-14 22:17:02','2024-10-14 22:28:55','231002159','HARLENE JOY','LARCENA','1811475453',11,2,'107911346960445492139','https://lh3.googleusercontent.com/a/ACg8ocJX_ralGVkLzlhnKPLI3Po5HtwW6G3PHdwUdi6W-SS4xyNBdGU=s96-c',NULL),(53,'Mike Jay Carulla','micarulla@my.cspc.edu.ph',NULL,'$2y$12$e5tuv5QFNWXb1jnrDvBtxeOdwUJt2hOYunKYxMTSEfQhxeWP2HOnC',NULL,'2024-10-14 22:17:09','2024-10-14 22:31:48','231004645','Mike Jay','Carulla','1834479886',11,1,'100007951942521040151','https://lh3.googleusercontent.com/a/ACg8ocJ9CMciCTEfU9hdsXb8OArmPhsFUrYpjeVt0iUOigQbpvzQfA=s96-c','light'),(54,'Mark Angelo Gregorio','magregorio@my.cspc.edu.ph',NULL,'$2y$12$fn6j9RpNuO7KYFnC4cumdO2EkogtdxWVVJOsD21MFrEOpbWAKiFC2',NULL,'2024-10-14 22:17:19','2024-10-14 22:32:42','231004285','Mark Angelo','Gregorio','1475583838',11,1,'116543067393571568821','https://lh3.googleusercontent.com/a/ACg8ocLEtDs6E2xPGWSJD6YlKnNJcFHoelt-wGx0A-P_T659CSO7svo=s96-c','light'),(55,'Erika Barandon','erbarandon@my.cspc.edu.ph',NULL,'$2y$12$FmqPqpONlCRvF8Lh8u47seTNcjT2nvpr7CVxZr6s0vlWFcGTtOSsC',NULL,'2024-10-14 22:17:30','2024-10-14 22:35:57','231002071','Erika','Barandon','1812239229',11,2,'118331072159711462043','https://lh3.googleusercontent.com/a/ACg8ocK50SKzqjfFCx8DnTAAzKl39WL6Pc3daZH8CLKqtivNai3oB9k=s96-c',NULL),(56,'Jamheyca Marcaida','jamarcaida@my.cspc.edu.ph',NULL,'$2y$12$vfgcixfQBjam9vXL7kJL7Oz0DN2zLe4sQbtrmPLboFmBfRF5mocoW',NULL,'2024-10-14 22:17:57','2024-10-14 22:33:34','231002173','Jamheyca','Marcaida','2182103755',11,2,'116632023254805955986','https://lh3.googleusercontent.com/a/ACg8ocJXcS390Cqe9KdT05wCV2tMtnzkOXOqCLZI1o0xHvgDySQsIXBO=s96-c',NULL),(57,'Francine Nicole Dalaodao','frdalaodao@my.cspc.edu.ph',NULL,'$2y$12$uTJTza8390J3V.kd8Agab.uPGEwKHvYtnAFaD43VfPx.hJA6WT7rW',NULL,'2024-10-14 22:18:00','2024-10-14 22:34:53','231000519','Francine Nicole','Dalaodao','2335412073',11,2,'104294236285169336527','https://lh3.googleusercontent.com/a/ACg8ocJaSb7yteFdGUIve0Mi2Mga4Hu4dJs_Na16OO4Rz79RWlFDIgA=s96-c',NULL),(58,'ANDREI PRADES','andprades@my.cspc.edu.ph',NULL,'$2y$12$PBlHDI8kfhrODsluAWMX/eWcu2L6YEF5QyUmIzAaVUIgH8wavdu3y',NULL,'2024-10-14 22:18:02','2024-10-14 22:30:45','231002026','ANDREI','PRADES','1454730686',11,1,'114362030609706766615','https://lh3.googleusercontent.com/a/ACg8ocIWfPzgkX5YyjFo4J-GUfjAP3adVhWdYto63Ncq-7evaxZ-obQ8=s96-c',NULL),(59,'Mark Jerrian Morillo','markjmorillo@my.cspc.edu.ph',NULL,'$2y$12$sN3OxIeWsxrFfHlRlXJYLOlDguMjSCNSIV1IIBL.uwh7MT6dq0DLu',NULL,'2024-10-14 22:18:12','2024-10-14 22:32:29','231002177','Mark Jerrian','Morillo','2055878750',11,1,'107929473768724900442','https://lh3.googleusercontent.com/a/ACg8ocIpFr3LCBIqemXnrLqgeJBcQNrE1fxB_dExFfBKH-ozxFAks1E=s96-c',NULL),(60,'Joshua Tandaan','jotandaan@my.cspc.edu.ph',NULL,'$2y$12$u9qnA8J8nwFjg3GvqC5q6.sN.wZhE70ua.Yl6bEASH21bQlT2H28C',NULL,'2024-10-14 22:18:36','2024-10-14 22:30:31','231002249','Joshua','Tandaan','1474728542',11,1,'107841529057063269436','https://lh3.googleusercontent.com/a/ACg8ocJi6tnCEtJuuk9YONilEJbb2Dt66cEul0YY-5kJ2ywTlpFdWmoL=s96-c',NULL),(61,'Gil Rexis Realubit','girealubit@my.cspc.edu.ph',NULL,'$2y$12$61dv/.qAUseNyPb/xNuQSedTueQQEvdsiKN./JQ95O7.dl05tmaFu',NULL,'2024-10-14 22:18:36','2024-10-14 22:31:01','231005330','Gil Rexis','Realubit','1834649454',11,1,'108592044885721722005','https://lh3.googleusercontent.com/a/ACg8ocJXgz2z273sX22Vh9N1kKP-fo4YQyF6cUrpgquMW7uWhaCiCZc=s96-c','light'),(62,'Benedith Reofrio','bereofrio@my.cspc.edu.ph',NULL,'$2y$12$EjxBh0rCoilGA7LdTME9/eZBJxxQJOm2hfWlPem1not73yq/0hLK.',NULL,'2024-10-14 22:18:51','2024-10-14 22:19:37','231003767','Benedith','Reofrio',NULL,11,2,'115063907376221245241','https://lh3.googleusercontent.com/a/ACg8ocLk9LoNBNI48XrqLnAdmviG4P-h_BDeoO2Xp-by-lqR3jPYWHY=s96-c',NULL),(63,'Emman James Sanchez','emsanchez@my.cspc.edu.ph',NULL,'$2y$12$Wv9XrC7E0/VBDWn3CV1NW.EI.5z4N9nX163A2j50TpSJTgX8WpUX2',NULL,'2024-10-14 22:19:03','2024-10-14 22:31:34','231003222','Emman James','Sanchez','1455973470',11,1,'105110449719568697466','https://lh3.googleusercontent.com/a/ACg8ocKVRhw6SC-CPOPT0f_f-zozh0nh83LssJSHqz14_5FT1UyuJJc=s96-c','light'),(64,'J. Christian Pius Simon Sotaso','j.sotaso@my.cspc.edu.ph',NULL,'$2y$12$qIeGlNKg3cmMm9oBsVyOAuSrh1enANUF0TozYNQl3dCLeb6k4nabm',NULL,'2024-10-14 22:19:06','2024-10-14 22:32:16','231002240','J. Christian Pius Simon','Sotaso','1454801358',11,1,'101507576170851487308','https://lh3.googleusercontent.com/a/ACg8ocJ58cQpaN9lRoAUFjvPGPJtohHyvC11Hh8fNvqmmXbYAgdpUQEX=s96-c','dark'),(65,'Mark Angelo Fulledo','mafulledo@my.cspc.edu.ph',NULL,'$2y$12$9fi6DVYA/7uP41SErKlOa.ROI9AZnA8.YYnFPwqWwFeYKWt0GQNJC',NULL,'2024-10-14 22:19:11','2024-10-14 22:19:35','C21101131','Mark Angelo','Fulledo',NULL,11,1,'118349898489946158652','https://lh3.googleusercontent.com/a/ACg8ocLq0h7ZGw9x-c5IWz5vqXkNd7WKJIihw8NpAzuN17SHD4L-AaZE=s96-c',NULL),(66,'John Andrey Cimini','jocimini@my.cspc.edu.ph',NULL,'$2y$12$lM1B25mosMVIV3WI5GONB.NnkFclslMqRPVMUhsQ4dUBkbbekuYaa',NULL,'2024-10-14 22:19:19','2024-10-14 22:22:23','2410866','John Andrey','Cimini',NULL,11,1,'109038277820909103509','https://lh3.googleusercontent.com/a/ACg8ocKbCR2SiTwBVDUqNOW81ti2e6xx0t1IALC1XJkpaYlNGFhlLQ=s96-c','dark'),(67,'Angelie Benosa','anbenosa@my.cspc.edu.ph',NULL,'$2y$12$la5JOB51lmoHF6vJ2KnBXOWQmD8/0qr2cl/hHdR1cboKyU49Ql3uq',NULL,'2024-10-14 22:19:30','2024-10-14 22:35:40','231002081','Angelie','Benosa','2029018221',11,2,'104654586560707021115','https://lh3.googleusercontent.com/a/ACg8ocIOOzTaIYnVKQFxcSMvzwLbBmW2jBfJU7AzoriSRgpWLRneAQ=s96-c',NULL),(68,'Mark Kenneth Ellorde','maellorde@my.cspc.edu.ph',NULL,'$2y$12$oUR33GSqLnYhNsgN0i9vuedK0h9einmA2GHWch2hI80SDy5nzBUf.',NULL,'2024-10-14 22:19:44','2024-10-14 22:35:25','231002133','Mark Kenneth','Ellorde','1471746414',11,1,'112886837479727572248','https://lh3.googleusercontent.com/a/ACg8ocISWoPoRoSw-nEiAXxnIjti-SI7EKEgY6Hqe8lkwT-XE8ZTA60=s96-c','dark'),(69,'IRISH RUIN','irruin@my.cspc.edu.ph',NULL,'$2y$12$/3tVp0/vaBA0zJkGXEakv.kyU3.3wsWAT2NHgvA0n4NZT9ANPep0m',NULL,'2024-10-14 22:19:51','2024-10-14 22:29:19','231004017','IRISH','RUIN','1471121294',11,2,'117284177200644271774','https://lh3.googleusercontent.com/a/ACg8ocJbwaoIJEd2zOUfka96OWYHPo-ZhWnL3RZ2P7reuLT5zsebAVM=s96-c',NULL),(70,'LEANNE PRENCIS LIAO','leliao@my.cspc.edu.ph',NULL,'$2y$12$0mmpt.f2JZwuTzDfaWm64uc8VW19Ixa7oSVpK7SGdrPM./AE11Z0m',NULL,'2024-10-14 22:22:21','2024-10-14 22:31:19','231002277','LEANNE PRENCIS','LIAO','1459830670',11,2,'114845875333804977376','https://lh3.googleusercontent.com/a/ACg8ocKAYzs_p2foQeFhy6i6aY56D7l5aavgIIeha2NCHgWNWSW6dGY=s96-c',NULL),(71,'Frances Bascon','frbascon@my.cspc.edu.ph',NULL,'$2y$12$gB2bmMVSdR0RmbaqhMK89.M.E/uUGsPh2dL4ngBtvkk5xZk1QgQOW',NULL,'2024-10-14 22:22:24','2024-10-14 22:30:08','231002075','Frances','Bascon','1455309902',11,1,'101726416241925923605','https://lh3.googleusercontent.com/a/ACg8ocI8pDBQEb6HDOourl_xi49J8dWm-IYjLsITc0qlQ94ZwPc88d8=s96-c','light'),(72,'Dobert Pariña','doparina@my.cspc.edu.ph',NULL,'$2y$12$RQ6Mjns.SaRw7.qzrRJ0MOl8BFJPtGgEF4PB9UzAX0e6TYSQbAOLe',NULL,'2024-10-14 22:23:16','2024-10-14 22:36:31','231002022','Dobert','Pariña','1455570206',17,1,'104873314084923221528','https://lh3.googleusercontent.com/a/ACg8ocKgwcniguBfAu3H0wOTRUDOBZ9iq43rad38A5KeFnnPEmXThNQ=s96-c',NULL),(73,'Dominic Castroverde','docastroverde@my.cspc.edu.ph',NULL,'$2y$12$CAYWuaL3AzFr5NNo0HRfferJolWgZoTgIGtyM7VdUr4tBCwpbKkiy',NULL,'2024-10-14 22:23:35','2024-10-14 22:36:18','231002108','Dominic','Castroverde','1473447166',11,1,'109740816292630011102','https://lh3.googleusercontent.com/a/ACg8ocK0uwCVGybn8BR1hKy6eAXUf9W1s3TXOVAon3aTZr9W1icjN5wh=s96-c',NULL),(74,'Cherrie Mae Panton','chpanton@my.cspc.edu.ph',NULL,'$2y$12$1z2P4k7jEXVqgIgTDbW3u.1YJRA.xzkQ7F3ZMw/TxM3C2.2ki.p/2',NULL,'2024-10-14 22:24:48','2024-10-14 22:29:29','231004315','Cherrie Mae','Panton','1457764510',11,2,'110353394294704549359','https://lh3.googleusercontent.com/a/ACg8ocKOIWqfem9xFPrFGH7ki5iYuKgqcCV6CpX7_HNK7TR5VawRtfEn=s96-c',NULL);
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

