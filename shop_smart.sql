-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2021 at 03:36 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 'Mobile', 1, 1, NULL, '2021-08-31 21:22:01', '2021-08-31 21:22:01');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`, `total_amount`, `due`, `payment`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 'Samsung Mobile', '01767189799', 'amir20277@gmail.com', 'pirgachha', 2000, 250, 1750, 1, 1, NULL, '2021-08-31 21:28:57', '2021-09-02 13:00:56');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expanse_types`
--

INSERT INTO `expanse_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Nosto', 1, 1, NULL, '2021-08-31 21:25:37', '2021-08-31 21:25:37');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `date`, `description`, `status`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, '1', '2021-09-01', NULL, 1, 1, 1, '2021-09-01 17:46:54', '2021-09-01 17:46:58'),
(2, '2', '2021-09-02', NULL, 1, 1, 1, '2021-09-02 12:58:41', '2021-09-02 12:58:47'),
(3, '3', '2021-09-02', NULL, 1, 1, 1, '2021-09-02 13:00:07', '2021-09-02 13:00:56');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `date`, `invoice_id`, `customer_id`, `category_id`, `product_id`, `selling_qty`, `free_selling_qty`, `selling_price`, `serial_no`, `warranty`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, '2021-09-01', 1, 2, 2, 3, 5, NULL, 150, NULL, NULL, 1, 1, NULL, '2021-09-01 17:46:54', '2021-09-01 17:46:58'),
(2, '2021-09-01', 1, 2, 2, 4, 4, NULL, 200, NULL, NULL, 1, 1, NULL, '2021-09-01 17:46:54', '2021-09-01 17:46:58'),
(3, '2021-09-02', 2, 2, 2, 3, 1, NULL, NULL, NULL, NULL, 1, 1, NULL, '2021-09-02 12:58:41', '2021-09-02 12:58:47'),
(4, '2021-09-02', 3, 2, 2, 3, 2, NULL, 150, NULL, NULL, 1, 1, NULL, '2021-09-02 13:00:07', '2021-09-02 13:00:11');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_payments`
--

INSERT INTO `invoice_payments` (`id`, `invoice_id`, `date`, `customer_id`, `paid_status`, `payment_method`, `paid_amount`, `due_amount`, `total_amount`, `discount_amount`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-09-01', 2, 'full_paid', 'HandCash', 1550, 0, 1550, NULL, 1, NULL, NULL, '2021-09-01 17:46:54', '2021-09-01 17:46:54'),
(2, 2, '2021-09-02', 2, 'full_paid', 'HandCash', 0, 0, 0, NULL, 1, NULL, NULL, '2021-09-02 12:58:41', '2021-09-02 12:58:41'),
(3, 3, '2021-09-02', 2, 'partial_paid', 'HandCash', 200, 100, 300, NULL, 1, NULL, NULL, '2021-09-02 13:00:07', '2021-09-02 13:00:56');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_payment_details`
--

INSERT INTO `invoice_payment_details` (`id`, `invoice_id`, `description`, `current_paid_amount`, `date`, `bank_name`, `cheque_no`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1550, '2021-09-01', NULL, NULL, 1, NULL, '2021-09-01 17:46:54', '2021-09-01 17:46:54'),
(2, 2, NULL, 0, '2021-09-02', NULL, NULL, 1, NULL, '2021-09-02 12:58:41', '2021-09-02 12:58:41'),
(3, 3, NULL, 100, '2021-09-02', NULL, NULL, 1, NULL, '2021-09-02 13:00:07', '2021-09-02 13:00:07'),
(4, 3, NULL, 100, '2021-09-02', NULL, NULL, 1, NULL, '2021-09-02 13:00:56', '2021-09-02 13:00:56');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_payment_due_logs`
--

INSERT INTO `invoice_payment_due_logs` (`id`, `invoice_id`, `current_due_amount`, `date`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2021-09-01', 1, NULL, '2021-09-01 17:46:54', '2021-09-01 17:46:54'),
(2, 2, 0, '2021-09-02', 1, NULL, '2021-09-02 12:58:41', '2021-09-02 12:58:41'),
(3, 3, 200, '2021-09-02', 1, NULL, '2021-09-02 13:00:07', '2021-09-02 13:00:07'),
(4, 3, 0, '2021-09-02', NULL, NULL, '2021-09-02 13:00:56', '2021-09-02 13:00:56');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `supplier_id`, `category_id`, `unit_id`, `name`, `quantity`, `status`, `sheif_no`, `free_quantity`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 2, 'Samsung Mobile', 0, 1, NULL, 0, 1, NULL, '2021-08-31 21:22:13', '2021-09-01 06:31:12'),
(3, 3, 2, 2, 'LG Mobile', 2, 1, NULL, 0, 1, NULL, '2021-09-01 11:41:06', '2021-09-02 13:00:11'),
(4, 3, 2, 2, 'Nokia', 18, 1, NULL, 0, 1, NULL, '2021-09-01 11:45:00', '2021-09-01 17:46:58');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `purchase_no`, `date`, `description`, `status`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(4, '43', '2021-09-01', NULL, 1, 1, 1, '2021-09-01 17:42:25', '2021-09-01 17:42:28'),
(5, '23', '2021-09-01', NULL, 1, 1, 1, '2021-09-01 17:46:06', '2021-09-01 17:46:10');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `date`, `purchase_id`, `supplier_id`, `category_id`, `product_id`, `buying_qty`, `unit_price`, `buying_price`, `status`, `selling_price`, `free_quantity`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(4, '2021-09-01', 4, 3, 2, 3, 10, 120, 1200, 1, 150, NULL, 1, NULL, '2021-09-01 17:42:25', '2021-09-01 17:42:28'),
(5, '2021-09-01', 5, 3, 2, 4, 22, 130, 2860, 1, 200, NULL, 1, NULL, '2021-09-01 17:46:06', '2021-09-01 17:46:10');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_payments`
--

INSERT INTO `purchase_payments` (`id`, `purchase_id`, `date`, `supplier_id`, `paid_status`, `payment_method`, `paid_amount`, `due_amount`, `total_amount`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(4, 4, '2021-09-01', 3, 'partial_paid', 'HandCash', 120, 1080, 1200, 0, NULL, NULL, '2021-09-01 17:42:25', '2021-09-01 17:42:25'),
(5, 5, '2021-09-01', 3, 'full_paid', 'HandCash', 2860, 0, 2860, 0, NULL, NULL, '2021-09-01 17:46:06', '2021-09-01 17:46:06');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_payment_details`
--

INSERT INTO `purchase_payment_details` (`id`, `purchase_id`, `current_paid_amount`, `date`, `paid_type`, `bank_name`, `cheque_no`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(4, 4, 120, '2021-09-01', 1, NULL, NULL, 1, NULL, '2021-09-01 17:42:25', '2021-09-01 17:42:25'),
(5, 5, 2860, '2021-09-01', 1, NULL, NULL, 1, NULL, '2021-09-01 17:46:06', '2021-09-01 17:46:06');

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Nosto', 1, 1, NULL, '2021-08-31 21:26:39', '2021-08-31 21:26:39');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_headings`
--

INSERT INTO `report_headings` (`id`, `name`, `mobile`, `address`, `image`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(3, 'Sebanto Telecom', '01700000000', 'Pochum Macho Hari', '25111a7d3c0859ede3dc24c26e1a901b.png', 1, 1, 1, '2021-09-01 10:49:32', '2021-09-02 07:02:10');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_outs`
--

INSERT INTO `stock_outs` (`id`, `stock_invoice_no`, `date`, `status`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(3, '1', '2021-09-01', 1, 1, 1, '2021-09-01 03:27:16', '2021-09-01 03:27:53');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_out_details`
--

INSERT INTO `stock_out_details` (`id`, `stock_out_id`, `reason_id`, `supplier_id`, `category_id`, `product_id`, `status`, `quantity`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(3, '3', 2, 2, 2, 2, 1, 1, 1, NULL, '2021-09-01 03:27:16', '2021-09-01 03:27:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `email`, `address`, `total_amount`, `due`, `payment`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 'Amir Hossain', '01766774626', 'amir20277@gmail.com', 'pirgachha', 1200, 1100, 100, 1, 1, NULL, '2021-08-31 21:21:36', '2021-09-01 03:23:52'),
(3, 'Abul', 'amir20277@gmail.com', 'admin@gmail.com', 'pirgachha', 4060, 1080, 2980, 1, 1, NULL, '2021-09-01 11:40:29', '2021-09-01 17:46:10');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 'Pcs', 1, 1, NULL, '2021-08-31 21:21:52', '2021-08-31 21:21:52');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `usertype`, `email`, `status`, `image`, `password`, `gender`, `mobile`, `address`, `created_by`, `modified_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', 1, '07f128ab51640c276dcf9554128d00fc.png', '$2y$10$gw4v2wwiNm.uaMpNOhjWLeAzMp1jCUYLPhcCk3WgjrtSup6E2/3Da', 'Male', '01766774626', 'pirgachha', 1, 1, 'n0GYu2BZPwuPzP2M9dI5Qp6TrGkt87Z04XAEJqeBlAiPpTwYReyAb80a1dmU', '2018-10-07 18:00:00', '2021-08-30 05:25:55'),
(2, 'Amir Hossain', 'Computer Operator', 'amir@gmail.com', 1, NULL, '$2y$10$l9uiQqpDL6ukCrRQm9txJOb4kqw7WPMgyzyIYKbV9bNJbWfuCyrTa', NULL, NULL, NULL, 1, 1, NULL, '2021-02-27 07:01:24', '2021-08-29 23:39:59'),
(3, 'Abul', 'Computer Operator', 'abul@gmail.com', 1, '31110e8e78b2dd2cf7e4cae455c3ec94.png', '$2y$10$igA9B4REy4FgrCohy4ijYei/kOusoZkqbtTSSoiWeUUkq1tYZZC3S', NULL, NULL, NULL, 1, NULL, NULL, '2021-08-30 02:12:22', '2021-08-30 02:12:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
