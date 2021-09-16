-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2021 at 07:25 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pr`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 'Mobile', 1, 1, NULL, '2021-08-31 21:22:01', '2021-08-31 21:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`, `total_amount`, `due`, `payment`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 'Samsung Mobile', '01767189799', 'amir20277@gmail.com', 'pirgachha', 2000, 250, 1750, 1, 1, NULL, '2021-08-31 21:28:57', '2021-09-02 13:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `expanses`
--

CREATE TABLE `expanses` (
  `id` int(10) UNSIGNED NOT NULL,
  `expanse_type_id` int(11) DEFAULT NULL,
  `amount` varchar(51) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expanse_types`
--

CREATE TABLE `expanse_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expanse_types`
--

INSERT INTO `expanse_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Nosto', 1, 1, NULL, '2021-08-31 21:25:37', '2021-08-31 21:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(111) NOT NULL,
  `date` date DEFAULT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `paid_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `due_amount` decimal(8,2) GENERATED ALWAYS AS (`grand_total` - `paid_amount`) VIRTUAL,
  `discount_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Approved,2=Repayment Pending',
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `intertest_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `customer_id`, `date`, `total_amount`, `paid_amount`, `discount_amount`, `status`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `intertest_amount`, `grand_total`) VALUES
(42, '0000001', 2, '2021-09-15', '750.00', '750.00', '0.00', 1, ' ', 1, 1, '2021-09-15 08:16:14', '2021-09-15 08:22:44', '0.00', '750.00'),
(43, '0000002', 2, '2021-09-15', '1350.00', '1350.00', '0.00', 0, ' ', 1, 1, '2021-09-15 13:38:39', '2021-09-15 13:38:39', '0.00', '1350.00'),
(44, '0000003', 2, '2021-09-15', '1350.00', '100.00', '0.00', 0, ' ', 1, 1, '2021-09-15 13:41:44', '2021-09-15 13:41:44', '0.00', '1350.00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `selling_qty` decimal(8,2) NOT NULL DEFAULT 0.00,
  `free_selling_qty` decimal(8,2) NOT NULL DEFAULT 0.00,
  `unit_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `selling_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `atcual_total_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `category_id`, `product_id`, `selling_qty`, `free_selling_qty`, `unit_price`, `selling_price`, `total_price`, `atcual_total_price`, `serial_no`, `warranty`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(35, 42, 2, 3, '5.00', '0.00', '150.00', '150.00', '750.00', '750.00', '0', '0', 1, 1, 1, '2021-09-15 08:16:14', '2021-09-15 08:16:14'),
(36, 43, 2, 3, '4.00', '0.00', '150.00', '150.00', '600.00', '600.00', '0', '0', 1, 1, 1, '2021-09-15 13:38:39', '2021-09-15 13:38:39'),
(37, 43, 2, 3, '5.00', '0.00', '150.00', '150.00', '750.00', '750.00', '0', '0', 1, 1, 1, '2021-09-15 13:38:39', '2021-09-15 13:38:39'),
(38, 44, 2, 3, '9.00', '0.00', '150.00', '150.00', '1350.00', '1350.00', '0', '0', 1, 1, 1, '2021-09-15 13:41:44', '2021-09-15 13:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_installments`
--

CREATE TABLE `invoice_installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `paid_date` date DEFAULT NULL,
  `interest` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `due_amount` decimal(8,2) GENERATED ALWAYS AS (`amount` - `paid_amount`) VIRTUAL,
  `cross_days` int(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_installments`
--

INSERT INTO `invoice_installments` (`id`, `customer_id`, `payment_id`, `invoice_id`, `date`, `status`, `amount`, `paid_amount`, `paid_date`, `interest`, `created_at`, `updated_at`, `cross_days`) VALUES
(41, 2, 18, 44, '2021-09-16', 0, '1250.00', '0.00', NULL, 4, '2021-09-15 13:41:44', '2021-09-15 13:41:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

CREATE TABLE `invoice_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `paid_status` varchar(51) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(91) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Due,1=Paid',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_payments`
--

INSERT INTO `invoice_payments` (`id`, `invoice_id`, `customer_id`, `paid_status`, `payment_method`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(16, 42, 2, 'full_paid', 'HandCash', 0, 1, 1, '2021-09-15 08:16:14', '2021-09-15 08:16:14'),
(17, 43, 2, 'full_paid', 'HandCash', 0, 1, 1, '2021-09-15 13:38:39', '2021-09-15 13:38:39'),
(18, 44, 2, 'partial_paid', 'HandCash', 0, 1, 1, '2021-09-15 13:41:44', '2021-09-15 13:41:44');

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
(80, '2021_08_18_153306_create_reasons_table', 33),
(83, '2021_09_04_120528_create_installments_table', 34),
(84, '2021_09_08_124509_add_customer_id_to_invoices_table', 35),
(85, '2021_09_09_092405_modify_invoice', 36),
(86, '2021_09_09_092406_modify_invoice', 37),
(87, '2021_09_09_092407_modify_invoice', 38),
(88, '2021_09_09_092408_modify_invoice', 39),
(89, '2021_09_09_092409_modify_invoice', 40),
(90, '2021_09_09_092410_modify_invoice', 41),
(91, '2021_09_09_092411_modify_invoice', 42),
(92, '2021_09_09_092412_modify_invoice', 43),
(93, '2021_09_09_092413_modify_invoice', 44),
(94, '2021_09_09_152144_create_invoice_installment', 45),
(95, '2021_09_09_152444_add_due_amount_to_invoice_installments_table', 46),
(96, '2021_09_10_134205_add_interest_amount_to_invoices_table', 47),
(97, '2021_09_12_141612_add_addtional_cloumn_to_products_table', 48);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `model_Of_vehicle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_Of_vehicle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chasiss_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `none_of_cylineder_with_cc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colour` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_manufacture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourse_power` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laden_weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wheel_base` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seating_capacity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `makers_Name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `supplier_id`, `category_id`, `unit_id`, `name`, `quantity`, `status`, `sheif_no`, `free_quantity`, `created_by`, `modified_by`, `created_at`, `updated_at`, `model_Of_vehicle`, `class_Of_vehicle`, `chasiss_no`, `engine_no`, `key_no`, `none_of_cylineder_with_cc`, `colour`, `size`, `year_of_manufacture`, `hourse_power`, `laden_weight`, `wheel_base`, `seating_capacity`, `makers_Name`, `unit_price`) VALUES
(2, 2, 2, 2, 'Samsung Mobile', 9, 1, NULL, 0, 1, NULL, '2021-08-31 21:22:13', '2021-09-01 06:31:12', '234', '234', '234234', '234wsf', '234dsf', '234234wsdf', 'red', '32', '2', '234', '2342', '234', '234234', '234324', '234234'),
(3, 3, 2, 2, 'LG Mobile', 20, 1, NULL, 0, 1, NULL, '2021-09-01 11:41:06', '2021-09-02 13:00:11', '234234', '234324', 'sddfs', 'sdf23523', NULL, 'sdf', 'bbl', '324', '324', '234', 'sdfdf', '234', '234324', 'sdf', '3rwe'),
(4, 3, 2, 2, 'Nokia', 18, 1, NULL, 0, 1, NULL, '2021-09-01 11:45:00', '2021-09-01 17:46:58', '234234', '234234', '234c32', 'sdf23432', NULL, 'dsfewr', 'dfsd', '32', NULL, 'sfdsdf', 'wesdf', 'werwer', 'sdfsdf', 'sdffsd', 'sddf'),
(5, 3, 2, 2, '234324', 0, 1, '234', 0, 1, NULL, '2021-09-15 08:01:29', '2021-09-15 08:01:29', 'wqeqwe', 'qweqwe', 'qweqwe', 'qwe', 'qweqwe', 'qweqwe', 'qweqwe', '2123', '324', '234', '23423', '234', '324324', '234324', '234324'),
(7, 3, 2, 2, 'AbcDf', 0, 1, '234', 0, 1, NULL, '2021-09-15 08:03:01', '2021-09-15 08:03:17', 'wqeqwe', 'qweqwe', 'qweqwe', 'qwe', 'qweqwe', 'qweqwe', 'qweqwe', '2123', '324', '234', '23423', '234', '324324', '234324', '234324');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Approved,2=Repayment Pending',
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `purchase_details` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `purchase_payments` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `purchase_payment_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `current_paid_amount` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `paid_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = invoice, 0=advance purchase',
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `purchase_repayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Nosto', 1, 1, NULL, '2021-08-31 21:26:39', '2021-08-31 21:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `report_headings`
--

CREATE TABLE `report_headings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_headings`
--

INSERT INTO `report_headings` (`id`, `name`, `mobile`, `address`, `image`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(3, 'Sebanto Telecom', '01700000000', 'Pochum Macho Hari', '25111a7d3c0859ede3dc24c26e1a901b.png', 1, 1, 1, '2021-09-01 10:49:32', '2021-09-02 07:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `stock_outs`
--

CREATE TABLE `stock_outs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_outs`
--

INSERT INTO `stock_outs` (`id`, `stock_invoice_no`, `date`, `status`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(3, '1', '2021-09-01', 1, 1, 1, '2021-09-01 03:27:16', '2021-09-01 03:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_details`
--

CREATE TABLE `stock_out_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_out_details`
--

INSERT INTO `stock_out_details` (`id`, `stock_out_id`, `reason_id`, `supplier_id`, `category_id`, `product_id`, `status`, `quantity`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(3, '3', 2, 2, 2, 2, 1, 1, 1, NULL, '2021-09-01 03:27:16', '2021-09-01 03:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 'Pcs', 1, 1, NULL, '2021-08-31 21:21:52', '2021-08-31 21:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `usertype`, `email`, `status`, `image`, `password`, `gender`, `mobile`, `address`, `created_by`, `modified_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', 1, '07f128ab51640c276dcf9554128d00fc.png', '$2y$10$j03MEubAq70EquzcXLHR3eaFrT1VrkdNDVsCTz18F8yt2O9Znw4PG', 'Male', '01766774626', 'pirgachha', 1, 1, 'n0GYu2BZPwuPzP2M9dI5Qp6TrGkt87Z04XAEJqeBlAiPpTwYReyAb80a1dmU', '2018-10-07 18:00:00', '2021-08-30 05:25:55'),
(2, 'Amir Hossain', 'Computer Operator', 'amir@gmail.com', 1, NULL, '$2y$10$l9uiQqpDL6ukCrRQm9txJOb4kqw7WPMgyzyIYKbV9bNJbWfuCyrTa', NULL, NULL, NULL, 1, 1, NULL, '2021-02-27 07:01:24', '2021-08-29 23:39:59'),
(3, 'Abul', 'Computer Operator', 'abul@gmail.com', 1, '31110e8e78b2dd2cf7e4cae455c3ec94.png', '$2y$10$igA9B4REy4FgrCohy4ijYei/kOusoZkqbtTSSoiWeUUkq1tYZZC3S', NULL, NULL, NULL, 1, NULL, NULL, '2021-08-30 02:12:22', '2021-08-30 02:12:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expanses`
--
ALTER TABLE `expanses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expanse_types`
--
ALTER TABLE `expanse_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expanse_types_name_unique` (`name`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_created_by_foreign` (`created_by`),
  ADD KEY `invoices_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_details_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_details_category_id_foreign` (`category_id`),
  ADD KEY `invoice_details_product_id_foreign` (`product_id`),
  ADD KEY `invoice_details_created_by_foreign` (`created_by`),
  ADD KEY `invoice_details_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `invoice_installments`
--
ALTER TABLE `invoice_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_installments_customer_id_foreign` (`customer_id`),
  ADD KEY `invoice_installments_payment_id_foreign` (`payment_id`),
  ADD KEY `invoice_installments_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_payments_customer_id_foreign` (`customer_id`),
  ADD KEY `invoice_payments_created_by_foreign` (`created_by`),
  ADD KEY `invoice_payments_updated_by_foreign` (`updated_by`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchases_purchase_no_unique` (`purchase_no`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_payment_details`
--
ALTER TABLE `purchase_payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_repayments`
--
ALTER TABLE `purchase_repayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reasons_name_unique` (`name`);

--
-- Indexes for table `report_headings`
--
ALTER TABLE `report_headings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_outs`
--
ALTER TABLE `stock_outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_out_details`
--
ALTER TABLE `stock_out_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expanses`
--
ALTER TABLE `expanses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expanse_types`
--
ALTER TABLE `expanse_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `invoice_installments`
--
ALTER TABLE `invoice_installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_payment_details`
--
ALTER TABLE `purchase_payment_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_repayments`
--
ALTER TABLE `purchase_repayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `report_headings`
--
ALTER TABLE `report_headings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_outs`
--
ALTER TABLE `stock_outs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_out_details`
--
ALTER TABLE `stock_out_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `invoice_details_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invoice_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `invoice_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `invoice_details_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice_installments`
--
ALTER TABLE `invoice_installments`
  ADD CONSTRAINT `invoice_installments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `invoice_installments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `invoice_installments_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `invoice_payments` (`id`);

--
-- Constraints for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD CONSTRAINT `invoice_payments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invoice_payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `invoice_payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `invoice_payments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
