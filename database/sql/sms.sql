-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `activations`;
CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1,	1,	'pRtMRkxmHgQDUYZ1hgN31VeHGWVZsMkj',	1,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(2,	2,	'JicDLRzrA3eavtcWei4MU8OyjLT0whPS',	1,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(3,	3,	'sAaIMXzkIZtmcELLawngo4y2sFeAQ8tD',	1,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(4,	4,	'1CfZUsxptT9ln2YxDG2Dhqengd94YSFc',	1,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(5,	5,	'p31VwCbsqTzf8ztBhAU1P35YeG1RybEl',	1,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(6,	6,	'Qt1q3EYc5Gl925BcpnWUIR95R1zFWl4m',	1,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(7,	7,	'muz80nqZd3D7ss4RRkySeswahOEfaWhY',	1,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(8,	8,	'Vi2lu55q2iP75lJ4U5OSoczp1LfP11nD',	1,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42');

DROP TABLE IF EXISTS `activity_details`;
CREATE TABLE `activity_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `assignment`;
CREATE TABLE `assignment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` int(10) unsigned NOT NULL,
  `attendance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `present_count` int(11) NOT NULL,
  `del_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `attendance_batch_id_foreign` (`batch_id`),
  CONSTRAINT `attendance_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batch_details` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `batch_details`;
CREATE TABLE `batch_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `batch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `syllabus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_shift` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `in_charge` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `batch_details_in_charge_foreign` (`in_charge`),
  CONSTRAINT `batch_details_in_charge_foreign` FOREIGN KEY (`in_charge`) REFERENCES `faculty_details` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blog_cont` text COLLATE utf8_unicode_ci NOT NULL,
  `blog_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `buses`;
CREATE TABLE `buses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `bus_fee`;
CREATE TABLE `bus_fee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `class_details`;
CREATE TABLE `class_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `exam_details`;
CREATE TABLE `exam_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `exam_date` date NOT NULL,
  `total_mark` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `exam_details_type_id_foreign` (`type_id`),
  CONSTRAINT `exam_details_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `exam_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `exam_type`;
CREATE TABLE `exam_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `faculty_details`;
CREATE TABLE `faculty_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_details_user_id_foreign` (`user_id`),
  CONSTRAINT `faculty_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `fee_paid`;
CREATE TABLE `fee_paid` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `last_date` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `del_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fee_paid_type_id_index` (`type_id`),
  KEY `fee_paid_user_id_index` (`user_id`),
  CONSTRAINT `fee_paid_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `fee_types` (`id`),
  CONSTRAINT `fee_paid_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `fee_types`;
CREATE TABLE `fee_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `mark_details`;
CREATE TABLE `mark_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `exam_id` int(10) unsigned NOT NULL,
  `mark` int(11) NOT NULL,
  `total_mark` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `mark_details_user_id_foreign` (`user_id`),
  KEY `mark_details_exam_id_foreign` (`exam_id`),
  CONSTRAINT `mark_details_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exam_details` (`id`),
  CONSTRAINT `mark_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_07_02_230147_migration_cartalyst_sentinel',	1),
('2014_10_12_100000_create_password_resets_table',	1),
('2016_08_16_101655_create_faculty_details_table',	1),
('2016_08_16_101755_create_batch_details_table',	1),
('2016_08_17_090334_create_student_details_table',	1),
('2016_08_17_095814_create_notice_table',	1),
('2016_08_17_104133_create_attendance_table',	1),
('2016_08_17_104233_create_fee_types_table',	1),
('2016_08_17_111747_create_fee_paid_table',	1),
('2016_08_17_111847_create_Exam_type_table',	1),
('2016_08_17_210403_create_exam_details_table',	1),
('2016_08_17_213836_create_mark_details_table',	1),
('2017_11_20_101235_banner_table',	1),
('2017_11_20_101504_event_table',	1),
('2017_11_20_101816_blog_table',	1),
('2017_11_20_104757_class_details',	1),
('2017_11_20_105155_activity_details_table',	1),
('2017_11_20_105404_assignment_table',	1),
('2017_11_20_105622_buses_table',	1),
('2017_11_20_105633_bus_fee_table',	1),
('2017_11_20_105850_fee_status_table',	1),
('2017_11_20_105915_library_table',	1),
('2017_11_20_105956_slots_table',	1),
('2017_11_20_110022_sms_history_table',	1),
('2017_11_20_110040_store_detail_table',	1),
('2017_11_20_110055_store_type_table',	1),
('2017_11_20_110148_subject_table',	1),
('2017_11_20_110329_time_table_table',	1),
('2017_11_20_110345_time_table_config_table',	1),
('2017_11_20_110406_batch_table_config_table',	1),
('2017_11_20_110428_variables_table',	1),
('2017_11_20_111741_images_table',	1);

DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `batch_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `notice_batch_id_foreign` (`batch_id`),
  CONSTRAINT `notice_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batch_details` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `persistences`;
CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `reminders`;
CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1,	'management',	'Management',	NULL,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(2,	'administrator',	'Administrator',	NULL,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(3,	'admins',	'Admins',	NULL,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(4,	'faculty',	'Faculty',	NULL,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(5,	'student',	'Student',	NULL,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(6,	'parent',	'Parent',	NULL,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(7,	'pta',	'PTA',	NULL,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41'),
(8,	'alumni',	'Alumni',	NULL,	'2017-11-20 22:43:41',	'2017-11-20 22:43:41');

DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(2,	2,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(3,	3,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(4,	4,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(5,	5,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(6,	6,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(7,	7,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42'),
(8,	8,	'2017-11-20 22:43:42',	'2017-11-20 22:43:42');

DROP TABLE IF EXISTS `student_details`;
CREATE TABLE `student_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `batch_id` int(10) unsigned NOT NULL,
  `gender` date NOT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guardian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `school` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cee_rank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percentage` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_details_user_id_foreign` (`user_id`),
  KEY `student_details_batch_id_foreign` (`batch_id`),
  CONSTRAINT `student_details_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batch_details` (`id`),
  CONSTRAINT `student_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'management@management.com',	'$2y$10$IZ7KjRlicfZh74dOl/ssheD2XX0NB4BHVjjO0veDgTOd/pm1uI9ze',	NULL,	NULL,	'ManagementFirstName',	'ManagementLastName',	'2017-11-20 22:43:41',	'2017-11-20 22:43:41',	NULL),
(2,	'administrator@administrator.com',	'$2y$10$4u8h9wr3gVX1Xfup0uZcXu4XBNpK0fIQa6hqUrF0ezKbQt1qvEldC',	NULL,	NULL,	'AdministratorFirstName',	'AdministratorLastName',	'2017-11-20 22:43:41',	'2017-11-20 22:43:41',	NULL),
(3,	'admin@admin.com',	'$2y$10$fsBaJ4t76V7ChubLiptOaOtz5phrlc4B/WSoVYSgocvuiEYobSEWa',	NULL,	NULL,	'AdminFirstName',	'AdminLastName',	'2017-11-20 22:43:41',	'2017-11-20 22:43:41',	NULL),
(4,	'faculty@faculty.com',	'$2y$10$TkTbxc.yqxBEDO.EptVcvuAEeGNYSVOAVwPCrrdQ0YrYrxqWwwP1m',	NULL,	NULL,	'FacultyFirstName',	'FacultyLastName',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	NULL),
(5,	'student@student.com',	'$2y$10$vkIYw5bCn.2eaQCMpTqAFemVkV9zWSq9SNhxaNWHiI7kfzoDhVZfi',	NULL,	NULL,	'StudentFirstName',	'StudentLastName',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	NULL),
(6,	'parent@parent.com',	'$2y$10$lg1dUDGXaj.MEqchhFkIyuzRjKVEgfCws7FdMu1GZDxZDjdfckiue',	NULL,	NULL,	'ParentFirstName',	'ParentLastName',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	NULL),
(7,	'pta@pta.com',	'$2y$10$.nVc4.x5cnARoqsiUlXY7.6kVOnd0KguEevYeDOhUKRRpqca7Vmfa',	NULL,	NULL,	'PTAFirstName',	'PTALastName',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	NULL),
(8,	'alumni@alumni.com',	'$2y$10$kDCvt.hoaZPDwBxd3qyQEOC8WLoa7KZxe5G21/IuTy5xTznxXaaZa',	NULL,	NULL,	'AlumniFirstName',	'AlumniLastName',	'2017-11-20 22:43:42',	'2017-11-20 22:43:42',	NULL);

-- 2017-11-21 04:57:28
