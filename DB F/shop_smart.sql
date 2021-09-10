-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 07:52 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double DEFAULT 0,
  `due` double DEFAULT 0,
  `payment` double DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expanses`
--

CREATE TABLE IF NOT EXISTS `expanses` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `expanse_type_id` int(11) DEFAULT NULL,
  `amount` varchar(51) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expanse_types`
--

CREATE TABLE IF NOT EXISTS `expanse_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expanse_types_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Approved,2=Repayment Pending',
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `selling_qty` double DEFAULT NULL,
  `free_selling_qty` double DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

CREATE TABLE IF NOT EXISTS `invoice_payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `paid_status` varchar(51) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Due,1=Paid',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment_details`
--

CREATE TABLE IF NOT EXISTS `invoice_payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_paid_amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment_due_logs`
--

CREATE TABLE IF NOT EXISTS `invoice_payment_due_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `current_due_amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_repayments`
--

CREATE TABLE IF NOT EXISTS `invoice_repayments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `due_paid_amount` double DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_08_094740_create_roles_table', 1),
(4, '2018_10_08_094800_create_menus_table', 1),
(5, '2018_10_08_094814_create_menu_permissions_table', 1),
(6, '2018_10_14_121808_create_categories_table', 2),
(9, '2019_12_03_113408_create_suppliers_table', 2),
(10, '2019_12_03_113541_create_units_table', 2),
(15, '2019_12_03_115829_create_customers_table', 2),
(16, '2018_10_16_054931_create_products_table', 3),
(17, '2019_12_05_154328_create_report_headings_table', 4),
(20, '2019_12_10_173702_create_expanses_table', 6),
(35, '2021_02_12_110521_create_purchase_payments_table', 14),
(36, '2021_02_12_111115_create_purchase_details_table', 14),
(42, '2019_12_03_114020_create_purchases_table', 15),
(43, '2020_02_08_104757_create_payment_due_logs_table', 15),
(44, '2021_02_12_111153_create_purchase_payment_details_table', 15),
(45, '2021_02_12_111226_create_purchase_due_logs_table', 15),
(50, '2021_02_15_132712_create_stock_outs_table', 18),
(51, '2021_02_15_133611_create_stock_out_details_table', 18),
(54, '2021_03_12_124421_create_expanse_types_table', 20),
(67, '2021_08_10_055238_create_purchase_repayments_table', 26),
(74, '2019_12_03_114915_create_invoices_table', 31),
(75, '2021_02_14_100910_create_invoice_payment_details_table', 31),
(76, '2021_02_14_101214_create_invoice_payment_due_logs_table', 31),
(77, '2021_08_10_141323_create_invoice_repayments_table', 31),
(78, '2021_08_17_093556_create_invoice_payments_table', 31),
(79, '2019_12_03_115136_create_invoice_details_table', 32),
(80, '2021_08_18_153306_create_reasons_table', 33);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `sheif_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_quantity` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Approved,2=Repayment Pending',
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchases_purchase_no_unique` (`purchase_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE IF NOT EXISTS `purchase_details` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `buying_qty` int(11) DEFAULT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `buying_price` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `selling_price` double DEFAULT NULL,
  `free_quantity` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payments`
--

CREATE TABLE IF NOT EXISTS `purchase_payments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `paid_status` varchar(51) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(91) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` int(11) DEFAULT NULL,
  `due_amount` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Due,1=Paid',
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payment_details`
--

CREATE TABLE IF NOT EXISTS `purchase_payment_details` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `current_paid_amount` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `paid_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = invoice, 0=advance purchase',
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_repayments`
--

CREATE TABLE IF NOT EXISTS `purchase_repayments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `new_paid_amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE IF NOT EXISTS `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reasons_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_headings`
--

CREATE TABLE IF NOT EXISTS `report_headings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_headings`
--

INSERT INTO `report_headings` (`id`, `name`, `mobile`, `address`, `image`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Sebanto Telecom', '01766-774626', 'Pirgachha,Rangpur', '1262b659d77e667688a5b426e375bbeb.png', 1, NULL, 1, NULL, '2021-08-28 06:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `stock_outs`
--

CREATE TABLE IF NOT EXISTS `stock_outs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stock_invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_details`
--

CREATE TABLE IF NOT EXISTS `stock_out_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stock_out_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Approved',
  `quantity` double DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double DEFAULT 0,
  `due` double DEFAULT 0,
  `payment` double DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usertype` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT 1,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `usertype`, `email`, `status`, `image`, `password`, `gender`, `mobile`, `address`, `created_by`, `modified_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', 1, '201f88669e13178245d93a390552d579.jpg', '$2y$10$gw4v2wwiNm.uaMpNOhjWLeAzMp1jCUYLPhcCk3WgjrtSup6E2/3Da', 'Male', '01928511049', 'Nagua mor,Kishoreganj,Dhaka', 1, 1, '6sPHGNKIPPEHWmmzFP1eoFKJoSZAxcwynh42TW6zDJ2OiMQC2v6lMdaK3xlY', '2018-10-07 18:00:00', '2021-08-28 21:36:13'),
(2, 'Amir Hossain', 'Computer Operator', 'amir@gmail.com', 0, NULL, '$2y$10$l9uiQqpDL6ukCrRQm9txJOb4kqw7WPMgyzyIYKbV9bNJbWfuCyrTa', NULL, NULL, NULL, 1, 1, NULL, '2021-02-27 07:01:24', '2021-08-29 23:39:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
