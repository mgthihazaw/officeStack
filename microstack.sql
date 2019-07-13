-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 13, 2019 at 05:26 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `microstack`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_groups`
--

CREATE TABLE `attribute_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_type_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_groups`
--

INSERT INTO `attribute_groups` (`id`, `name`, `item_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Interface Type', 1, '2019-07-13 14:46:00', '2019-07-13 14:46:00'),
(2, 'Storage Capacity', 1, '2019-07-13 14:46:01', '2019-07-13 14:46:01'),
(3, 'Storage Type', 1, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(4, 'Form Factor', 1, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(5, 'Disk Rotatiional Speed', 1, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(6, 'Series', 1, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(7, 'Cache Memory', 1, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(8, 'RAM Type', 2, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(9, 'Storage Capacity', 2, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(10, 'RAM Speed', 2, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(11, 'Chipset Type', 3, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(12, 'RAM Memory Technology', 3, '2019-07-13 14:46:02', '2019-07-13 14:46:02'),
(13, 'Processor Socket', 3, '2019-07-13 14:46:02', '2019-07-13 14:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_item`
--

CREATE TABLE `attribute_item` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Windows တင္', '2019-07-13 14:55:14', '2019-07-13 14:55:14'),
(2, 'သီခ်င္းထည့္', '2019-07-13 14:55:39', '2019-07-13 14:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `brand_item_type`
--

CREATE TABLE `brand_item_type` (
  `brand_id` int(10) UNSIGNED NOT NULL,
  `item_type_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_item_type`
--

INSERT INTO `brand_item_type` (`brand_id`, `item_type_id`) VALUES
(1, 4),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `id` int(10) UNSIGNED NOT NULL,
  `person_business_id` int(10) UNSIGNED NOT NULL,
  `business_type_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`id`, `person_business_id`, `business_type_id`) VALUES
(1, 4, 1),
(2, 5, 2),
(3, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `business_has_departments`
--

CREATE TABLE `business_has_departments` (
  `business_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_has_departments`
--

INSERT INTO `business_has_departments` (`business_id`, `department_id`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL),
(3, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 2, NULL, NULL),
(2, 3, NULL, NULL),
(3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_types`
--

CREATE TABLE `business_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_types`
--

INSERT INTO `business_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'KTV', '2019-07-13 14:45:51', '2019-07-13 14:45:51'),
(2, 'MI Office', '2019-07-13 14:45:51', '2019-07-13 14:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `person_business_id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Sale & Marketing'),
(2, 'Software Development'),
(3, 'Service');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `total_price` int(11) NOT NULL,
  `invoiceable_id` int(10) UNSIGNED NOT NULL,
  `invoiceable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opened_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `total_price`, `invoiceable_id`, `invoiceable_type`, `opened_date`) VALUES
(1, 20000, 1, 'App\\Service', '2019-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `price_one` int(11) NOT NULL,
  `price_two` int(11) DEFAULT NULL,
  `price_three` int(11) DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `item_type_id` int(10) UNSIGNED NOT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `price_one`, `price_two`, `price_three`, `brand_id`, `item_type_id`, `model_no`, `created_at`, `updated_at`) VALUES
(1, 5000, NULL, NULL, 1, 4, NULL, '2019-07-13 14:55:14', '2019-07-13 14:55:14'),
(2, 5000, NULL, NULL, 2, 4, NULL, '2019-07-13 14:55:39', '2019-07-13 14:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hard Disk', '2019-07-13 14:46:00', '2019-07-13 14:46:00'),
(2, 'Memory(RAM)', '2019-07-13 14:46:00', '2019-07-13 14:46:00'),
(3, 'Motherboard', '2019-07-13 14:46:00', '2019-07-13 14:46:00'),
(4, 'Service', '2019-07-13 14:54:50', '2019-07-13 14:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(150, '2014_10_12_000000_create_users_table', 1),
(151, '2014_10_12_100000_create_password_resets_table', 1),
(152, '2019_03_21_092995_create_state_table', 1),
(153, '2019_03_21_092996_create_township_table', 1),
(154, '2019_03_21_093103_create_person_business_table', 1),
(155, '2019_03_25_031719_create_business_type_table', 1),
(156, '2019_03_25_031807_create_businesses_table', 1),
(157, '2019_03_25_031808_create_customer_table', 1),
(158, '2019_03_25_031809_create_departments_table', 1),
(159, '2019_03_25_031810_business_has_departments', 1),
(160, '2019_03_25_031811_create_staff_table', 1),
(161, '2019_03_25_031812_entrust_setup_tables', 1),
(162, '2019_03_25_031815_create_service_table', 1),
(163, '2019_06_17_072740_create_brands_table', 1),
(164, '2019_06_17_072741_create_item_types_table', 1),
(165, '2019_06_17_072742_create_brand_item_type_table', 1),
(166, '2019_06_17_072842_create_items_table', 1),
(167, '2019_06_17_073610_create_attribute_group_table', 1),
(168, '2019_06_24_051115_create_attributes_table', 1),
(169, '2019_06_24_100204_create_attribute_item_table', 1),
(170, '2019_07_02_063113_create_service_item_table', 1),
(171, '2019_07_13_044546_create_invoices_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'role-create', 'Create Role', 'Create New Role', '2019-07-13 14:45:53', '2019-07-13 14:45:53'),
(2, 'role-list', 'Display Role Listing', 'List All Roles', '2019-07-13 14:45:53', '2019-07-13 14:45:53'),
(3, 'role-update', 'Update Role', 'Update Role Information', '2019-07-13 14:45:53', '2019-07-13 14:45:53'),
(4, 'role-delete', 'Delete Role', 'Delete Role', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(5, 'staff-create', 'Create Staff', 'Create New Staff', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(6, 'staff-list', 'Display Staff Listing', 'List All Staff', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(7, 'staff-update', 'Update Staff', 'Update Staff Information', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(8, 'staff-delete', 'Delete Staff', 'Delete Staff', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(9, 'service-create', 'Create Service', 'Create New Service', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(10, 'service-list', 'Display Service Listing', 'List All Service', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(11, 'service-update', 'Update Service', 'Update Service Information', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(12, 'service-delete', 'Delete Service', 'Delete Service Information', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(13, 'item-create', 'Create Item', 'Create New Item', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(14, 'item-list', 'Display Item Listing', 'List All Item', '2019-07-13 14:45:54', '2019-07-13 14:45:54'),
(15, 'item-update', 'Update Item', 'Update Item Information', '2019-07-13 14:45:55', '2019-07-13 14:45:55'),
(16, 'item-delete', 'Delete Item', 'Delete Item Information', '2019-07-13 14:45:55', '2019-07-13 14:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(9, 4),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(12, 1),
(12, 2),
(12, 4),
(13, 1),
(13, 2),
(13, 4),
(14, 1),
(14, 2),
(14, 4),
(15, 1),
(15, 2),
(15, 4),
(16, 1),
(16, 2),
(16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `person_business`
--

CREATE TABLE `person_business` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line` text COLLATE utf8mb4_unicode_ci,
  `township_id` int(10) UNSIGNED DEFAULT NULL,
  `person_business_id` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `person_business`
--

INSERT INTO `person_business` (`id`, `name`, `phone`, `address_line`, `township_id`, `person_business_id`) VALUES
(1, 'Root', NULL, NULL, NULL, 1),
(2, 'Person', NULL, NULL, NULL, 1),
(3, 'Business', NULL, NULL, NULL, 1),
(4, 'Jazz Palace', '09-3738743434,09-43847348734', 'Ma-7/21, Block A, 62nd Street,Between Theikpan Street & Sabal Street', 1, 3),
(5, 'Microstack Office(Mandalay)', '09-3738743434,09-43847348734', '၆၃လမ္းx၆၄လမ္းၾကား ပိေတာက္လမ္း', 1, 3),
(6, 'Microstack Office(Yangon)', '09-3738743434,09-43847348734', 'အမွတ္(၂၃) နတ္ေခ်ာင္းလမ္း', 6, 3),
(7, 'သန္႕ဇင္စိုး', '09-978225762,09-692694043', 'ဆားခ်က္ရပ္ကြက္', 4, 2),
(8, 'သီဟေဇာ္', '၀၉-၆၉၂၅၈၆၀၉၅', 'အမွတ္(၃) ရပ္ကြက္', 10, 2),
(9, 'မိုးဆန္းဦး', '၀၉-၉၉၈၈၇၇၈၈', 'အမွတ္(၈) ရပ္ကြက္', 10, 2),
(10, 'ေမာင္ေမာင္', '၀၉_၉၇၈၂၂၅၇၆၂,၀၉_၆၉၂၆၉၄၀၄၃', 'ေအာင္ခ်မ္းသာရပ္ကြက္', 3, 2),
(11, 'ေဇာ္ေဇာ္', '၀၉-၆၉၂၅၈၆၀၉၅', 'ေစ်းခ်ိဳရပ္ကြက္', 2, 2),
(12, 'ေက်ာ္ေက်ာ္', '၀၉_၉၉၈၈၇၇၈၈', 'ျမင့္မိုရ္ရပ္ကြက္', 1, 2),
(13, 'Administrator', NULL, NULL, NULL, 2),
(14, 'Service Engineer One', '09-111111111', 'ေဇယ်ာရပ္', 11, 2),
(15, 'Service Engineer Two', '09-222222222', 'သလႅာ၀တီရပ္', 10, 2),
(16, 'Receptionist_One', '09-222222222', 'အမွတ္(၁)', 12, 2),
(17, 'Receptionist_Two', '09-222222222', 'ေဇယ်ာရပ္', 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Full Permission', NULL, '2019-07-13 14:45:55', '2019-07-13 14:45:55'),
(2, 'developer', 'Developer', 'Full Permission', 2, '2019-07-13 14:45:57', '2019-07-13 14:45:57'),
(3, 'service_engineer', 'Service Engineer', 'Associated with services', 3, '2019-07-13 14:45:58', '2019-07-13 14:45:58'),
(4, 'receptionist', 'Receptionist', 'Associated with services and Item Sales', 1, '2019-07-13 14:45:58', '2019-07-13 14:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `role_staff`
--

CREATE TABLE `role_staff` (
  `staff_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_staff`
--

INSERT INTO `role_staff` (`staff_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(3, 3),
(4, 4),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `service_engineer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_description` text COLLATE utf8mb4_unicode_ci,
  `received_remark` text COLLATE utf8mb4_unicode_ci,
  `service_description` text COLLATE utf8mb4_unicode_ci,
  `service_remark` text COLLATE utf8mb4_unicode_ci,
  `pending` tinyint(1) NOT NULL DEFAULT '0',
  `received_date` timestamp NULL DEFAULT NULL,
  `finished_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `staff_id`, `service_engineer_id`, `customer_id`, `business_id`, `customer_name`, `customer_phone`, `customer_address`, `received_description`, `received_remark`, `service_description`, `service_remark`, `pending`, `received_date`, `finished_date`) VALUES
(1, 4, 2, NULL, 2, 'Customer One', '09-989898989', 'Mandalay', 'LOL', 'LOL', 'updated', 'updated', 1, '2019-07-13 14:51:15', '2019-07-13 14:52:16'),
(2, 5, NULL, NULL, 2, 'Customer Two', '09-222222222', 'Yangon', 'OLO', 'OLO', NULL, NULL, 0, '2019-07-13 14:51:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_item`
--

CREATE TABLE `service_item` (
  `service_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_item`
--

INSERT INTO `service_item` (`service_id`, `item_id`, `price`, `quantity`) VALUES
(1, 1, 5000, 2),
(1, 2, 5000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `person_business_id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$2y$10$4kWBmBRkBzBq1SEuwv5hWOpKVxoEGW3rdq993HLiuCUwL0il2WNhm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `person_business_id`, `business_id`, `username`, `password`, `secret`, `created_at`, `updated_at`) VALUES
(1, 13, 2, 'administrator', '$2y$10$v9PRieEDtiCKb9jISTCJ0OLzXjoE7IkC3ki1xCqepnrZWuZ1XxJeO', '$2y$10$4kWBmBRkBzBq1SEuwv5hWOpKVxoEGW3rdq993HLiuCUwL0il2WNhm', '2019-07-13 14:46:00', '2019-07-13 14:46:00'),
(2, 14, 2, 'service_engineer_one', '$2y$10$zVfB.rE2nvGNeZUZd8Yf..WcyCa.JSIXC7Lz3YjJS30/79DpFCtYC', '$2y$10$4kWBmBRkBzBq1SEuwv5hWOpKVxoEGW3rdq993HLiuCUwL0il2WNhm', '2019-07-13 14:47:48', '2019-07-13 14:47:48'),
(3, 15, 2, 'service_engineer_two', '$2y$10$u2SOFGUBla5L80sDSFqp.OMx6Fluukqk.dC4cYOVZCzjAjANCuYP.', '$2y$10$4kWBmBRkBzBq1SEuwv5hWOpKVxoEGW3rdq993HLiuCUwL0il2WNhm', '2019-07-13 14:48:45', '2019-07-13 14:48:45'),
(4, 16, 2, 'receptionist_one', '$2y$10$9hBVLIkU5ZNe3S5gbTZyHe32UdiuQ0B1dHJ17gRHAf5z8DJEKqQc.', '$2y$10$4kWBmBRkBzBq1SEuwv5hWOpKVxoEGW3rdq993HLiuCUwL0il2WNhm', '2019-07-13 14:49:46', '2019-07-13 14:49:46'),
(5, 17, 2, 'receptionist_two', '$2y$10$ImVZeLohrkH2RHOIZpHt6uVJtvIFRJPOxToO8cO8lGseRKYw7BQd6', '$2y$10$4kWBmBRkBzBq1SEuwv5hWOpKVxoEGW3rdq993HLiuCUwL0il2WNhm', '2019-07-13 14:50:31', '2019-07-13 14:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'တနသၤာရီတိုင္း'),
(2, 'မြန္ျပည္နယ္'),
(3, 'ရန္ကုန္တိုင္း'),
(4, 'ဧရာ၀တီတိုင္း'),
(5, 'ကရင္ျပည္နယ္'),
(6, 'ပဲခူးတိုင္း'),
(7, 'ရခိုင္ျပည္နယ္'),
(8, 'မေကြးတိုင္း'),
(9, 'မႏၱေလးတိုင္း'),
(10, 'ကယားျပည္နယ္'),
(11, 'ရွမ္းျပည္နယ္'),
(12, 'စစ္ကုိင္းတိုင္း'),
(13, 'ခ်င္းျပည္နယ္'),
(14, 'ကခ်င္ျပည္နယ္'),
(15, 'ေနျပည္ေတာ္');

-- --------------------------------------------------------

--
-- Table structure for table `townships`
--

CREATE TABLE `townships` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `townships`
--

INSERT INTO `townships` (`id`, `name`, `state_id`) VALUES
(1, 'ခ်မ္းျမသာစည္ ျမိဳ႕နယ္', 9),
(2, 'ခ်မ္းေအးသာဇံ ျမိဳ႕နယ္', 9),
(3, 'မဟာေအာင္ေျမ ျမိဳ႕နယ္', 9),
(4, 'အမရပူရ ျမိဳ႕နယ္', 9),
(5, 'ကမာရြတ္ ျမိဳ႕နယ္', 3),
(6, 'တာေမြ ျမိဳ႕နယ္', 3),
(7, 'အင္းစိန္ ျမိဳ႕နယ္', 3),
(8, 'ဖားကန္႕ ျမိဳ႕နယ္', 12),
(9, 'ကန္႕ဘလူ ျမိဳ႕နယ္', 12),
(10, 'မုံရြာ ျမိဳ႕နယ္', 12),
(11, 'ေတာင္ၾကီးျမိဳ႕', 11),
(12, 'ဂန္႕ ေဂါျမိဳ႕', 13),
(13, 'ျမစ္ၾကီးနားျမိဳ႕', 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attributes_attribute_group_id_foreign` (`attribute_group_id`);

--
-- Indexes for table `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_groups_name_item_type_id_unique` (`name`,`item_type_id`),
  ADD KEY `attribute_groups_item_type_id_foreign` (`item_type_id`);

--
-- Indexes for table `attribute_item`
--
ALTER TABLE `attribute_item`
  ADD KEY `attribute_item_item_id_foreign` (`item_id`),
  ADD KEY `attribute_item_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_item_type`
--
ALTER TABLE `brand_item_type`
  ADD UNIQUE KEY `brand_item_type_brand_id_item_type_id_unique` (`brand_id`,`item_type_id`),
  ADD KEY `brand_item_type_item_type_id_foreign` (`item_type_id`);

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `businesses_person_business_id_foreign` (`person_business_id`),
  ADD KEY `businesses_business_type_id_foreign` (`business_type_id`);

--
-- Indexes for table `business_has_departments`
--
ALTER TABLE `business_has_departments`
  ADD KEY `business_has_departments_business_id_foreign` (`business_id`),
  ADD KEY `business_has_departments_department_id_foreign` (`department_id`);

--
-- Indexes for table `business_types`
--
ALTER TABLE `business_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_person_business_id_foreign` (`person_business_id`),
  ADD KEY `customers_business_id_foreign` (`business_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_brand_id_foreign` (`brand_id`),
  ADD KEY `items_item_type_id_foreign` (`item_type_id`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `person_business`
--
ALTER TABLE `person_business`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_business_township_id_foreign` (`township_id`),
  ADD KEY `person_business_person_business_id_foreign` (`person_business_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD KEY `roles_department_id_foreign` (`department_id`);

--
-- Indexes for table `role_staff`
--
ALTER TABLE `role_staff`
  ADD PRIMARY KEY (`staff_id`,`role_id`),
  ADD KEY `role_staff_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_business_id_foreign` (`business_id`),
  ADD KEY `services_staff_id_foreign` (`staff_id`),
  ADD KEY `services_service_engineer_id_foreign` (`service_engineer_id`),
  ADD KEY `services_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `service_item`
--
ALTER TABLE `service_item`
  ADD KEY `service_item_service_id_foreign` (`service_id`),
  ADD KEY `service_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staffs_business_id_foreign` (`business_id`),
  ADD KEY `staffs_person_business_id_foreign` (`person_business_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `townships`
--
ALTER TABLE `townships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `townships_state_id_foreign` (`state_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_groups`
--
ALTER TABLE `attribute_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_types`
--
ALTER TABLE `business_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_types`
--
ALTER TABLE `item_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `person_business`
--
ALTER TABLE `person_business`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `attributes_attribute_group_id_foreign` FOREIGN KEY (`attribute_group_id`) REFERENCES `attribute_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD CONSTRAINT `attribute_groups_item_type_id_foreign` FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_item`
--
ALTER TABLE `attribute_item`
  ADD CONSTRAINT `attribute_item_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brand_item_type`
--
ALTER TABLE `brand_item_type`
  ADD CONSTRAINT `brand_item_type_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brand_item_type_item_type_id_foreign` FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `businesses`
--
ALTER TABLE `businesses`
  ADD CONSTRAINT `businesses_business_type_id_foreign` FOREIGN KEY (`business_type_id`) REFERENCES `business_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `businesses_person_business_id_foreign` FOREIGN KEY (`person_business_id`) REFERENCES `person_business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business_has_departments`
--
ALTER TABLE `business_has_departments`
  ADD CONSTRAINT `business_has_departments_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_has_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_person_business_id_foreign` FOREIGN KEY (`person_business_id`) REFERENCES `person_business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_item_type_id_foreign` FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `person_business`
--
ALTER TABLE `person_business`
  ADD CONSTRAINT `person_business_person_business_id_foreign` FOREIGN KEY (`person_business_id`) REFERENCES `person_business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `person_business_township_id_foreign` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_staff`
--
ALTER TABLE `role_staff`
  ADD CONSTRAINT `role_staff_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_staff_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_service_engineer_id_foreign` FOREIGN KEY (`service_engineer_id`) REFERENCES `staffs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_item`
--
ALTER TABLE `service_item`
  ADD CONSTRAINT `service_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_item_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staffs`
--
ALTER TABLE `staffs`
  ADD CONSTRAINT `staffs_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staffs_person_business_id_foreign` FOREIGN KEY (`person_business_id`) REFERENCES `person_business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `townships`
--
ALTER TABLE `townships`
  ADD CONSTRAINT `townships_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
