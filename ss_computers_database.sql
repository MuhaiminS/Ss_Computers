-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2019 at 07:17 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ss_computers`
--

-- --------------------------------------------------------

--
-- Table structure for table `credit_sale`
--

CREATE TABLE `credit_sale` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `number` varchar(50) NOT NULL,
  `type` enum('credit','debit') NOT NULL,
  `amount` double(10,2) NOT NULL DEFAULT '0.00',
  `paid_date` datetime NOT NULL,
  `sale_order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_sale`
--

INSERT INTO `credit_sale` (`id`, `customer_id`, `name`, `number`, `type`, `amount`, `paid_date`, `sale_order_id`, `user_id`, `shop_id`) VALUES
(1, 4, 'fsghhdhdfh', '426623', 'credit', 8.00, '2018-03-15 09:50:30', 7, 1, 1),
(2, 4, 'fsghhdhdfh', '426623', 'debit', 8.40, '2018-03-15 10:05:01', 0, 1, 1),
(3, 4, 'fsghhdhdfh', '426623', 'debit', 2.00, '2018-03-15 11:34:25', 0, 1, 1),
(4, 5, 'sdgshgh', '52246246', 'credit', 7.00, '2018-03-15 12:23:31', 19, 1, 1),
(5, 5, 'sdgshgh', '52246246', 'debit', 7.35, '2018-03-15 12:24:08', 0, 1, 1),
(6, 1, 'test', '657567567567', 'credit', 560.00, '2018-03-15 18:26:36', 25, 1, 1),
(7, 6, 'Jeff besoz', '787244645', 'credit', 710.00, '2018-03-24 10:08:34', 29, 1, 1),
(8, 6, 'Jeff besoz', '787244645', 'debit', 745.50, '2018-03-24 10:13:00', 0, 1, 1),
(9, 1, 'test', '657567567567', 'debit', 100.00, '2018-05-07 13:24:52', 0, 1, 1),
(10, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:43', 0, 0, 0),
(11, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:44', 0, 0, 0),
(12, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:44', 0, 0, 0),
(13, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:44', 0, 0, 0),
(14, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:45', 0, 0, 0),
(15, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:45', 0, 0, 0),
(16, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:45', 0, 0, 0),
(17, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:45', 0, 0, 0),
(18, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:46', 0, 0, 0),
(19, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:46', 0, 0, 0),
(20, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:46', 0, 0, 0),
(21, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:46', 0, 0, 0),
(22, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 14:46:46', 0, 0, 0),
(23, 5, 'sdgshgh', '52246246', 'debit', 10.00, '2018-07-23 14:46:55', 0, 0, 0),
(24, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:22', 0, 0, 0),
(25, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:23', 0, 0, 0),
(26, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:23', 0, 0, 0),
(27, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:23', 0, 0, 0),
(28, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:23', 0, 0, 0),
(29, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:25', 0, 0, 0),
(30, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:25', 0, 0, 0),
(31, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:25', 0, 0, 0),
(32, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:25', 0, 0, 0),
(33, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:26', 0, 0, 0),
(34, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:26', 0, 0, 0),
(35, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:26', 0, 0, 0),
(36, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:43', 0, 1, 1),
(37, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:20:51', 0, 1, 1),
(38, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:22:03', 0, 1, 1),
(39, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-23 15:26:58', 0, 1, 1),
(40, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-24 16:07:17', 0, 1, 1),
(41, 6, 'Jeff besoz', '787244645', 'debit', 10.00, '2018-07-24 16:07:25', 0, 1, 1),
(42, 5, 'sdgshgh', '52246246', 'debit', 100.00, '2018-07-24 16:07:42', 0, 1, 1),
(43, 1, 'test', '657567567567', 'debit', 88.00, '2018-10-28 09:53:38', 0, 1, 1),
(44, 8, 'Anand', '0562324789', 'credit', 44.00, '2018-10-28 10:19:29', 55, 1, 1),
(45, 8, 'Anand', '0562324789', 'debit', 0.20, '2018-10-28 10:19:58', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int(11) NOT NULL,
  `customer_number` varchar(15) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` varchar(225) NOT NULL,
  `customer_email` varchar(225) DEFAULT NULL,
  `customer_trn_no` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customer_id`, `customer_number`, `customer_name`, `customer_address`, `customer_email`, `customer_trn_no`) VALUES
(1, '657567567567', 'test', 'test', NULL, '4645646234234'),
(2, '564466', 'gfhu', '', NULL, ''),
(3, '0559279901', 'mustan', 'deira', NULL, '3563586'),
(4, '426623', 'fsghhdhdfh', '', NULL, ''),
(5, '52246246', 'sdgshgh', '', NULL, ''),
(6, '787244645', 'Jeff besoz', 'san francisco USA', '', '235346548'),
(7, '4646546666', 'new', 'chennai', NULL, ''),
(8, '0562324789', 'Anand', 'test', NULL, '100236547899552');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `manufacturing_unit_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `qualification` varchar(225) DEFAULT NULL,
  `country` varchar(250) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `license` varchar(225) DEFAULT NULL,
  `passport` varchar(225) DEFAULT NULL,
  `idproof` varchar(225) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `doj` date DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `manufacturing_unit_id`, `email`, `phone`, `qualification`, `country`, `state`, `city`, `address`, `zip`, `license`, `passport`, `idproof`, `image`, `doj`, `is_active`, `date_added`, `date_updated`) VALUES
(1, 'Franciss', 0, 'anandbe13@gmail.com', '1234567890', 'B.E', 'India', 'Tamil nadu', 'Chennai', 'testing addresss', '607 402', '20170922110501_license.jpg', NULL, NULL, 'd1.png', '2017-09-12', 1, NULL, '2018-01-24 16:11:29'),
(2, 'sdf', 1, 'dfddff@gmail.com', '9750082703', 'B.com', 'India', 'tamil nadu', 'chennai', 'chennai id', '9750082703', '20180721110508_license.jpg', '20180721110508_passport.jpg', '20180721110508_idproof.jpg', '20180721110508_image.jpg', '1970-01-02', 0, '2018-07-21 11:04:41', '2018-07-21 11:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `trn_no` varchar(225) DEFAULT NULL,
  `reference_id` varchar(225) DEFAULT NULL,
  `company_name` varchar(225) DEFAULT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `payment_status` enum('not_paid','paid') NOT NULL DEFAULT 'not_paid',
  `purchase_date` date DEFAULT NULL,
  `supplier_vat` varchar(225) DEFAULT NULL,
  `description` text,
  `expense_category_id` int(11) NOT NULL,
  `sub_total` varchar(50) DEFAULT NULL,
  `vat_amount` varchar(50) DEFAULT NULL,
  `net_total` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `trn_no`, `reference_id`, `company_name`, `invoice_no`, `payment_status`, `purchase_date`, `supplier_vat`, `description`, `expense_category_id`, `sub_total`, `vat_amount`, `net_total`, `is_active`, `date_added`, `date_updated`) VALUES
(1, '878577', '55511', 'Google', NULL, 'paid', '2018-03-24', '5', 'test', 1, '50.555', '2.52775', '53.08275', 1, '2018-03-24 10:12:13', '2018-07-24 16:01:40'),
(2, '', '', '', NULL, 'paid', '0000-00-00', '5', '', 1, '52.6', '2.63', '55.230000000000004', 1, '2018-10-28 09:53:17', '2018-10-28 09:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(11) NOT NULL,
  `expense_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`id`, `expense_name`, `date_added`) VALUES
(1, 'General things', '2017-11-29 00:00:00'),
(2, 'Others', '2017-11-29 00:00:00'),
(3, 'none', '0000-00-00 00:00:00'),
(4, 'testtest', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `floor_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `floor_name` varchar(200) NOT NULL,
  `floor_no` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`floor_id`, `shop_id`, `floor_name`, `floor_no`, `date_added`, `date_updated`) VALUES
(1, 1, 'Indoor', 1, '2018-01-21 00:00:00', '2018-01-24 09:14:27'),
(2, 1, 'Outdoor', 2, '2018-01-24 09:13:53', '2018-01-24 09:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `other_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `cost_price` double(10,2) NOT NULL,
  `image` varchar(250) CHARACTER SET utf8 NOT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `barcode_id` varchar(20) NOT NULL,
  `CGST` double DEFAULT NULL,
  `SGST` double DEFAULT NULL,
  `stock` varchar(20) DEFAULT NULL,
  `manuf_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `inward_date` date DEFAULT NULL,
  `lose_item` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `other_name`, `cat_id`, `price`, `cost_price`, `image`, `weight`, `unit`, `active`, `barcode_id`, `CGST`, `SGST`, `stock`, `manuf_date`, `expiry_date`, `inward_date`, `lose_item`) VALUES
(1, 'Samsung Monitor', NULL, 1, 4000.00, 3800.00, '20190208104937_items.jpg', '1', 'no', '1', '', NULL, NULL, '30', NULL, NULL, NULL, 0),
(2, 'Samsung CPU', NULL, 2, 7000.00, 6300.00, '20190208105046_items.jpg', '1', 'no', '1', '21212', NULL, NULL, '91', NULL, NULL, NULL, 0),
(3, 'Lenevo Mouse', NULL, 4, 450.00, 350.00, '20190208105208_items._SX425_.jpg', '1', 'no', '1', '2121212', NULL, NULL, '39', NULL, NULL, NULL, 0),
(4, 'Berklin Mouse Pad', NULL, 5, 150.00, 100.00, '20190208105311_items.jpg', '1', 'no', '1', '111111', NULL, NULL, '48', NULL, NULL, NULL, 0),
(5, 'Microtek UPS', NULL, 6, 5000.00, 4300.00, '20190208105421_items.jpg', '1', 'no', '1', '10', NULL, NULL, '32', NULL, NULL, NULL, 0),
(6, 'Kingston 8 GB RAM', NULL, 7, 5500.00, 500.00, '20190208105753_items.jpg', '1', 'no', '1', '444444', NULL, NULL, '56', NULL, NULL, NULL, 0),
(7, 'Samsung 4 GB RAM', NULL, 7, 3500.00, 3000.00, '20190208105846_items.jpg', '1', 'no', '1', '', NULL, NULL, '21', NULL, NULL, NULL, 0),
(8, 'Nvidia Graphics Card 8GB', NULL, 8, 6500.00, 5850.00, '20190208110014_items._SX425_.jpg', '1', 'no', '1', '4646464', NULL, NULL, '1121218', NULL, NULL, NULL, 0),
(9, 'Water neck.', NULL, 2, 60.00, 50.00, '20181024040205_items.jpg', '1', 'no', '0', '1121212', NULL, NULL, '50', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(11) NOT NULL,
  `category_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `category_slug` varchar(200) CHARACTER SET utf8 NOT NULL,
  `category_img` varchar(200) CHARACTER SET utf8 NOT NULL,
  `category_details` text CHARACTER SET utf8 NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `category_title`, `category_slug`, `category_img`, `category_details`, `active`) VALUES
(1, 'Monitor', 'monitor', '', '', '1'),
(2, 'CPU', 'cpu', '', '', '1'),
(3, 'KeyBoard', 'keyboard', '', '', '1'),
(4, 'Mouse', 'mouse', '', '', '1'),
(5, 'Mouse Pad', 'mouse-pad', '', '', '1'),
(6, 'UPS', 'ups', '', '', '1'),
(7, 'RAM', 'ram', '', '', '1'),
(8, 'Graphics Card', 'graphics-card', '', '', '1'),
(9, 'test', 'test', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `item_units`
--

CREATE TABLE `item_units` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(225) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_units`
--

INSERT INTO `item_units` (`id`, `unit_name`) VALUES
(1, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `locations_manufacturing_units`
--

CREATE TABLE `locations_manufacturing_units` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `location` varchar(150) NOT NULL,
  `country` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations_manufacturing_units`
--

INSERT INTO `locations_manufacturing_units` (`id`, `name`, `location`, `country`) VALUES
(1, 'yyyyyyyyyyy', '', ''),
(2, 'yyyyyyy', 'jjjjjjjj', 'cccccc');

-- --------------------------------------------------------

--
-- Table structure for table `locations_shops`
--

CREATE TABLE `locations_shops` (
  `id` int(11) NOT NULL,
  `shop_name` varchar(200) NOT NULL,
  `shop_location` varchar(150) NOT NULL,
  `shop_country` varchar(150) NOT NULL,
  `shop_lable` text NOT NULL,
  `phone` varchar(250) NOT NULL,
  `trn` varchar(250) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `bill_footer` varchar(225) NOT NULL,
  `api_key` varchar(250) NOT NULL,
  `owner_num` varchar(250) NOT NULL,
  `client_logo` varchar(250) NOT NULL,
  `bill_tax_val` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations_shops`
--

INSERT INTO `locations_shops` (`id`, `shop_name`, `shop_location`, `shop_country`, `shop_lable`, `phone`, `trn`, `currency`, `bill_footer`, `api_key`, `owner_num`, `client_logo`, `bill_tax_val`) VALUES
(1, 'Al Masafi', 'Dubai', 'UAE', 'AAM-', '+971 26452008', 'TRN : 100231752500003', 'AED', 'Thank you and come again', '2sYDrDoDx9z4', '', '', '5');

-- --------------------------------------------------------

--
-- Table structure for table `pay_back`
--

CREATE TABLE `pay_back` (
  `id` int(11) NOT NULL,
  `sale_order_item_id` int(11) NOT NULL,
  `sale_order_id` int(11) NOT NULL,
  `receipt_id` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `weight` int(11) NOT NULL,
  `lose_item` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `payback_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay_back`
--

INSERT INTO `pay_back` (`id`, `sale_order_item_id`, `sale_order_id`, `receipt_id`, `item_id`, `qty`, `amount`, `weight`, `lose_item`, `user_id`, `shop_id`, `payback_date`) VALUES
(1, 20, 5, 'AAM5', 1, 1, '1', 1, 0, 1, 1, '2018-03-15 09:48:05'),
(2, 19, 4, 'AAM4', 4, 1, '3.5', 1, 0, 1, 1, '2018-03-15 09:48:43'),
(3, 18, 4, 'AAM4', 3, 1, '4.5', 1, 0, 1, 1, '2018-03-15 09:48:43'),
(4, 17, 4, 'AAM4', 2, 1, '2', 1, 0, 1, 1, '2018-03-15 09:48:43'),
(5, 16, 4, 'AAM4', 1, 1, '1', 1, 0, 1, 1, '2018-03-15 09:48:43'),
(6, 23, 7, 'AAM7', 4, 1, '3.5', 1, 0, 1, 1, '2018-03-15 11:34:10'),
(7, 34, 12, 'AAM12', 1, 4, '1', 1, 0, 1, 1, '2018-03-15 11:39:29'),
(8, 41, 14, 'AAM14', 1, 1, '1', 1, 0, 1, 1, '2018-03-15 11:52:02'),
(9, 42, 14, 'AAM14', 2, 1, '2', 1, 0, 1, 1, '2018-03-15 11:52:02'),
(10, 43, 14, 'AAM14', 3, 1, '4.5', 1, 0, 1, 1, '2018-03-15 11:52:02'),
(11, 55, 18, 'AAM18', 4, 1, '3.5', 1, 0, 1, 1, '2018-03-15 12:11:32'),
(12, 53, 18, 'AAM18', 2, 1, '2', 1, 0, 1, 1, '2018-03-15 12:11:36'),
(13, 54, 18, 'AAM18', 3, 1, '4.5', 1, 0, 1, 1, '2018-03-15 12:11:36'),
(14, 76, 30, 'AAM30', 239, 1, '150', 1, 0, 1, 1, '2018-03-24 10:14:20'),
(15, 96, 36, 'fgdg', 0, 1, '10.00', 1, 0, 1, 1, '2018-03-25 11:19:57'),
(16, 96, 36, 'fgdg', 0, 1, '10.00', 1, 0, 1, 1, '2018-03-25 11:20:03'),
(17, 96, 36, 'AAM36', 0, 1, '10.00', 1, 0, 1, 1, '2018-03-25 11:20:15'),
(18, 94, 36, 'AAM36', 239, 1, '150', 1, 0, 1, 1, '2018-03-25 11:20:21'),
(19, 96, 36, 'AAM36', 0, 1, '10.00', 1, 0, 1, 1, '2018-03-25 11:20:35'),
(22, 95, 36, 'klk;;', 240, 1, '150', 1, 0, 1, 1, '2018-03-25 11:45:23'),
(23, 103, 38, '123123', 236, 1, '560', 1, 0, 1, 1, '2018-05-07 13:23:34'),
(24, 147, 51, 'AM51', 1, 1, '20', 1, 0, 1, 1, '2018-10-28 09:52:01'),
(25, 149, 51, 'AM51', 1, 1, '20', 1, 0, 1, 1, '2018-10-28 10:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL,
  `trn_no` varchar(225) DEFAULT NULL,
  `supplier_name` varchar(225) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_number` int(11) NOT NULL,
  `customer_address` text NOT NULL,
  `reference_id` varchar(225) DEFAULT NULL,
  `company_name` varchar(225) DEFAULT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `payment_status` enum('not_paid','paid') NOT NULL DEFAULT 'not_paid',
  `status` enum('pending','ordered','received') NOT NULL DEFAULT 'pending',
  `purchase_date` date DEFAULT NULL,
  `supplier_vat` varchar(225) DEFAULT NULL,
  `sub_total` varchar(50) DEFAULT NULL,
  `vat_amount` varchar(50) DEFAULT NULL,
  `net_total` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `trn_no`, `supplier_name`, `customer_id`, `customer_name`, `customer_number`, `customer_address`, `reference_id`, `company_name`, `invoice_no`, `payment_status`, `status`, `purchase_date`, `supplier_vat`, `sub_total`, `vat_amount`, `net_total`, `is_active`, `date_added`, `date_updated`) VALUES
(1, '', '', 1, 'test', 2147483647, 'test', '333', 'Boardex', NULL, 'paid', 'received', '2019-02-26', NULL, NULL, NULL, '0', 1, '2019-02-08 21:54:08', '2019-02-08 22:02:11'),
(2, '000', '', 5, 'sdgshgh', 52246246, '', 'SS-531777', 'Boardex', NULL, 'paid', 'received', '2019-03-01', NULL, NULL, NULL, '0', 1, '2019-02-09 22:58:04', '2019-02-09 22:58:04'),
(3, '000', '', 3, 'mustan', 559279901, 'deira', 'SS-120020', 'Boardexkk', NULL, 'paid', 'received', '2019-02-27', NULL, NULL, NULL, '0', 1, '2019-02-09 22:58:29', '2019-02-09 22:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `purchase_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `qty` int(11) DEFAULT '0',
  `unit_price` decimal(9,2) DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `tax` decimal(9,2) DEFAULT NULL,
  `payment_type` enum('cash','credit') NOT NULL DEFAULT 'cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `product_name`, `purchase_id`, `item_id`, `qty`, `unit_price`, `total_amount`, `tax`, `payment_type`) VALUES
(13, 'Bonnet/hood', 1, 10, 10, '10.00', '100.00', '5.00', 'cash'),
(14, 'Bumper', 1, 11, 11, '22.00', '242.00', '5.00', 'cash'),
(15, 'Cowl screen', 1, 12, 12, '22.00', '264.00', '5.00', 'cash'),
(16, 'Berklin Mouse Pad111111', 2, 4, 11, '150.00', '1650.00', '0.00', 'cash'),
(17, 'Microtek UPS10', 3, 5, 1, '5000.00', '5000.00', '0.00', 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` int(11) NOT NULL,
  `receipt_id` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `customer_email` varchar(225) DEFAULT NULL,
  `customer_trn_no` varchar(50) DEFAULT NULL,
  `order_type` enum('counter_sale','delivery','dine_in','take_away','website_order') CHARACTER SET utf8 NOT NULL,
  `payment_type` enum('cash','card','cod','credit') NOT NULL,
  `card_num` int(11) DEFAULT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `amount_given` float DEFAULT NULL,
  `balance_amount` float DEFAULT NULL,
  `status` enum('pending','conform','out_for_delivery','delivered','reject','hold') NOT NULL,
  `remarks` text,
  `delivered_in` varchar(100) DEFAULT NULL,
  `reject_reason` text,
  `driver_id` int(11) NOT NULL,
  `ordered_date` datetime NOT NULL,
  `paid_date` datetime NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL,
  `num_members` int(11) DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `without_tax` double DEFAULT '0',
  `tax_amount` double DEFAULT NULL,
  `with_tax` double DEFAULT NULL,
  `without_tax_cost` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `receipt_id`, `user_id`, `shop_id`, `customer_id`, `contact_name`, `contact_number`, `address`, `customer_email`, `customer_trn_no`, `order_type`, `payment_type`, `card_num`, `payment_status`, `discount`, `amount_given`, `balance_amount`, `status`, `remarks`, `delivered_in`, `reject_reason`, `driver_id`, `ordered_date`, `paid_date`, `table_id`, `floor_id`, `num_members`, `vat`, `without_tax`, `tax_amount`, `with_tax`, `without_tax_cost`) VALUES
(1, 'AAM1', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 4, 0, 'pending', '', NULL, NULL, 0, '2018-03-14 19:40:01', '0000-00-00 00:00:00', 0, 0, 0, 5, 3, 0.15, 3.15, 0),
(2, 'AAM2', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 10, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 09:31:17', '0000-00-00 00:00:00', 0, 0, 0, 5, 7.5, 0.38, 7.88, 0),
(3, 'AAM3', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 60000, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 09:32:16', '0000-00-00 00:00:00', 0, 0, 0, 5, 56572, 2828.6, 59400.6, 55),
(4, 'AAM4', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 15, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 09:32:21', '0000-00-00 00:00:00', 0, 0, 0, 5, 11, 0.55, 11.55, 45),
(5, 'AAM5', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 10, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 09:44:35', '0000-00-00 00:00:00', 0, 0, 0, 5, 1, 0.05, 1.05, 0),
(6, 'AAM6', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 10, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 09:46:12', '0000-00-00 00:00:00', 0, 0, 0, 5, 3.5, 0.18, 3.68, 45),
(7, 'AAM7', 1, 1, 4, 'fsghhdhdfh', '426623', '', NULL, '', 'counter_sale', 'credit', 0, 'paid', 0, 0, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 09:50:30', '0000-00-00 00:00:00', 0, 0, 0, 5, 8, 0.4, 8.4, 45),
(8, 'AAM8', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 10, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 09:51:51', '0000-00-00 00:00:00', 0, 0, 0, 5, 7.5, 0.38, 7.88, 0),
(9, 'AAM9', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 10, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 09:52:14', '0000-00-00 00:00:00', 0, 0, 0, 5, 7.5, 0.38, 7.88, 0),
(10, 'AAM10', 1, 1, 3, 'mustan', '0559279901', 'deira', NULL, '3563586', 'counter_sale', 'cash', 0, 'paid', 1, 2.15, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 11:23:48', '0000-00-00 00:00:00', 0, 0, 0, 5, 3, 0.15, 2.15, 0),
(11, 'AAM11', 1, 1, 3, 'mustan', '0559279901', 'deira', NULL, '3563586', 'counter_sale', 'cash', 0, 'paid', 0, 7, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 11:35:15', '0000-00-00 00:00:00', 0, 0, 0, 5, 6, 0.3, 6.3, 0),
(12, 'AAM12', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 8, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 11:38:31', '0000-00-00 00:00:00', 0, 0, 0, 5, 7, 0.35, 7.35, 0),
(13, 'AAM13', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 100, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 11:45:22', '0000-00-00 00:00:00', 0, 0, 0, 5, 72, 3.6, 75.6, 0),
(14, 'AAM14', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 10, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 11:49:45', '0000-00-00 00:00:00', 0, 0, 0, 5, 7.5, 0.38, 7.88, 0),
(15, 'AAM15', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 12, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 12:02:02', '0000-00-00 00:00:00', 0, 0, 0, 5, 9, 0.45, 9.45, 45),
(16, 'AAM16', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 7, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 12:04:23', '0000-00-00 00:00:00', 0, 0, 0, 5, 6.5, 0.33, 6.83, 45),
(17, 'AAM17', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 35, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 12:05:02', '0000-00-00 00:00:00', 0, 0, 0, 5, 33, 1.65, 34.65, 0),
(18, 'AAM18', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 11, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 12:05:27', '0000-00-00 00:00:00', 0, 0, 0, 5, 10, 0.5, 10.5, 45),
(19, 'AAM19', 1, 1, 5, 'sdgshgh', '52246246', '', NULL, '', 'counter_sale', 'credit', 0, 'paid', 0, 0, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 12:23:31', '0000-00-00 00:00:00', 0, 0, 0, 5, 7, 0.35, 7.35, 0),
(20, 'AAM20', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 50, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 16:11:25', '0000-00-00 00:00:00', 0, 0, 0, 5, 11, 0.55, 11.55, 45),
(21, 'AAM21', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 1000, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 16:58:04', '0000-00-00 00:00:00', 0, 0, 0, 5, 560, 28, 588, 535),
(22, 'AAM22', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 500, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 17:01:21', '0000-00-00 00:00:00', 0, 0, 0, 5, 0, 0, 0, 0),
(23, 'AAM23', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 700, 8000, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 17:03:50', '0000-00-00 00:00:00', 0, 0, 0, 5, 0, 0, 0, 0),
(24, 'AAM24', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 400, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 17:04:54', '0000-00-00 00:00:00', 0, 0, 0, 5, 0, 0, 0, 0),
(25, 'AAM25', 1, 1, 1, 'test', '657567567567', 'test', NULL, '4645646234234', 'counter_sale', 'credit', 0, 'paid', 0, 0, 0, 'pending', '', NULL, NULL, 0, '2018-03-15 18:26:36', '0000-00-00 00:00:00', 0, 0, 0, 5, 560, 28, 588, 535),
(26, 'AAM26', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 10, 1103, 0, 'pending', '', NULL, NULL, 0, '2018-03-23 19:20:15', '0000-00-00 00:00:00', 0, 0, 0, 5, 1060, 53, 1103, 1015),
(27, 'AAM27', 1, 1, 6, 'Jeff besoz', '787244645', 'san francisco USA', NULL, '235346548', 'counter_sale', 'cash', 0, 'paid', 13, 1500, 0, 'pending', '', NULL, NULL, 0, '2018-03-24 10:02:42', '0000-00-00 00:00:00', 0, 0, 0, 5, 1060, 53, 1100, 1015),
(28, 'AAM28', 1, 1, 6, 'Jeff besoz', '787244645', 'san francisco USA', NULL, '235346548', 'counter_sale', 'card', 3333, 'paid', 0, 1000, 0, 'pending', '', NULL, NULL, 0, '2018-03-24 10:06:15', '0000-00-00 00:00:00', 0, 0, 0, 5, 650, 32.5, 682.5, 605),
(29, 'AAM29', 1, 1, 6, 'Jeff besoz', '787244645', 'san francisco USA', NULL, '235346548', 'counter_sale', 'credit', 0, 'paid', 4.5, 0, 0, 'pending', '', NULL, NULL, 0, '2018-03-24 10:08:34', '0000-00-00 00:00:00', 0, 0, 0, 5, 710, 35.5, 741, 660),
(30, 'AAM30', 1, 1, 6, 'Jeff besoz', '787244645', 'san francisco USA', NULL, '235346548', 'counter_sale', 'cash', 0, 'paid', 0, 2000, 0, 'pending', '', NULL, NULL, 0, '2018-03-24 10:09:55', '0000-00-00 00:00:00', 0, 0, 0, 5, 1360, 68, 1428, 1265),
(31, 'AAM31', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 1000, 0, 'pending', '', NULL, NULL, 0, '2018-03-24 10:25:54', '0000-00-00 00:00:00', 0, 0, 0, 5, 750, 37.5, 787.5, 700),
(32, 'AAM32', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 555, 0, 'pending', '', NULL, NULL, 0, '2018-03-24 18:57:51', '0000-00-00 00:00:00', 0, 0, 0, 5, 300, 15, 315, 250),
(33, 'AAM33', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 400, 0, 'pending', '', NULL, NULL, 0, '2018-03-25 10:13:53', '0000-00-00 00:00:00', 0, 0, 0, 5, 300, 15, 315, 250),
(34, 'AAM34', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 1110, 0, 'pending', '', NULL, NULL, 0, '2018-03-25 11:06:06', '0000-00-00 00:00:00', 0, 0, 0, 5, 1010, 50.5, 1060.5, 910),
(35, 'AAM35', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 200, 0, 'pending', '', NULL, NULL, 0, '2018-03-25 11:07:33', '0000-00-00 00:00:00', 0, 0, 0, 5, 184, 9.2, 193.2, 125),
(36, 'AAM36', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 400, 0, 'pending', '', NULL, NULL, 0, '2018-03-25 11:08:36', '0000-00-00 00:00:00', 0, 0, 0, 5, 310, 15.5, 325.5, 250),
(46, 'AM46', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 50, 0, 'pending', '', NULL, NULL, 0, '2018-10-24 16:56:27', '0000-00-00 00:00:00', 0, 0, 0, 5, 45, 2.25, 47.25, 40),
(38, 'AAM38', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 35, 1500, 0, 'pending', '', NULL, NULL, 0, '2018-05-07 13:21:12', '0000-00-00 00:00:00', 0, 0, 0, 5, 1460, 73, 1498, 1360),
(39, 'AAM39', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 6000, 0, 'pending', '', NULL, NULL, 0, '2018-07-24 14:06:49', '0000-00-00 00:00:00', 0, 0, 0, 5, 5601, 280.05, 5881.05, 5351),
(40, 'AAM40', 1, 1, 7, 'new', '4646546666', 'chennai', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 6038.55, 0, 'pending', '', NULL, NULL, 0, '2018-07-24 14:26:40', '0000-00-00 00:00:00', 0, 0, 0, 5, 5751, 287.55, 6038.55, 5476),
(41, 'AAM41', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 475, 0, 'pending', '', NULL, NULL, 0, '2018-10-24 15:10:36', '0000-00-00 00:00:00', 0, 0, 0, 5, 450, 22.5, 472.5, 375),
(42, 'AM42', 1, 0, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 73.5, 0, 'pending', '', NULL, NULL, 0, '2018-10-24 15:45:55', '0000-00-00 00:00:00', 0, 0, 0, 5, 70, 3.5, 73.5, 62),
(43, 'AM43', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 84, 0, 'pending', '', NULL, NULL, 0, '2018-10-24 15:54:08', '0000-00-00 00:00:00', 0, 0, 0, 5, 80, 4, 84, 72),
(44, 'AM44', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 600, 0, 'pending', '', NULL, NULL, 0, '2018-10-24 16:02:22', '0000-00-00 00:00:00', 0, 0, 0, 5, 560, 28, 588, 75),
(45, 'AM45', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 89, 0, 'pending', '', NULL, NULL, 0, '2018-10-24 16:19:29', '0000-00-00 00:00:00', 0, 0, 0, 5, 85, 4.25, 89.25, 72),
(47, 'AM47', 0, 0, 0, '', '0', '', NULL, '', 'counter_sale', 'card', 0, 'paid', 0, 90, 0, 'pending', '', NULL, NULL, 0, '2018-10-24 17:29:49', '0000-00-00 00:00:00', 0, 0, 0, 5, 75, 3.75, 78.75, 22),
(48, 'AM48', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 150, 0, 'pending', '', NULL, NULL, 0, '2018-10-24 17:30:28', '0000-00-00 00:00:00', 0, 0, 0, 5, 135, 6.75, 141.75, 62),
(49, 'AM49', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 90, 0, 'pending', '', NULL, NULL, 0, '2018-10-28 09:24:13', '0000-00-00 00:00:00', 0, 0, 0, 5, 75, 3.75, 78.75, 65),
(50, 'AM50', 1, 1, 8, 'Anand', '0562324789', 'test', NULL, '100236547899552', 'counter_sale', 'card', 5623, 'paid', 2, 100, 0, 'pending', '', NULL, NULL, 0, '2018-10-28 09:27:41', '0000-00-00 00:00:00', 0, 0, 0, 5, 40, 2, 40, 36),
(51, 'AM51', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 50, 0, 'pending', '', NULL, NULL, 0, '2018-10-28 09:31:06', '0000-00-00 00:00:00', 0, 0, 0, 5, 45, 2.25, 47.25, 54),
(52, 'AM52', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 50, 0, 'pending', '', NULL, NULL, 0, '2018-10-28 10:02:44', '0000-00-00 00:00:00', 0, 0, 0, 5, 45, 2.25, 47.25, 40),
(53, 'AM53', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 150, 0, 'pending', '', NULL, NULL, 0, '2018-10-28 10:03:12', '0000-00-00 00:00:00', 0, 0, 0, 5, 135, 6.75, 141.75, 116),
(54, 'AM54', 1, 1, 0, '', '0', '', NULL, '', 'counter_sale', 'cash', 0, 'paid', 0, 80, 0, 'pending', '', NULL, NULL, 0, '2018-10-28 10:04:13', '0000-00-00 00:00:00', 0, 0, 0, 5, 70, 3.5, 73.5, 62),
(55, 'AM55', 1, 1, 8, 'Anand', '0562324789', 'test', NULL, '100236547899552', 'counter_sale', 'credit', 0, 'paid', 0.2, 50, 0, 'pending', '', NULL, NULL, 0, '2018-10-28 10:19:29', '0000-00-00 00:00:00', 0, 0, 0, 5, 44, 2.2, 46, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_items`
--

CREATE TABLE `sale_order_items` (
  `id` int(11) NOT NULL,
  `sale_order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_add_price_id` int(11) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `other_item_name` text CHARACTER SET utf8,
  `weight` varchar(225) DEFAULT NULL,
  `unit_price` varchar(225) DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `cost_price` varchar(50) NOT NULL,
  `tax_without_price` double DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `CGST` double DEFAULT NULL,
  `SGST` double DEFAULT NULL,
  `lose_item` int(11) NOT NULL,
  `ime_no` varchar(225) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_order_items`
--

INSERT INTO `sale_order_items` (`id`, `sale_order_id`, `item_id`, `item_add_price_id`, `item_name`, `other_item_name`, `weight`, `unit_price`, `price`, `cost_price`, `tax_without_price`, `qty`, `CGST`, `SGST`, `lose_item`, `ime_no`) VALUES
(4, 1, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(3, 1, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(5, 2, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(6, 2, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(7, 2, 3, 0, 'Mobile 3', NULL, '1', '4.50', '4.5', '0.00', 4.5, 1, 0, 0, 0, NULL),
(15, 3, 6, 0, 'Service 2ghj', NULL, '1', '56564.00', '56564', '55.00', 56564, 1, 0, 0, 0, NULL),
(14, 3, 5, 0, 'Service 1', NULL, '1', '4.00', '4', '0.00', 4, 2, 0, 0, 0, NULL),
(19, 4, 4, 0, 'Mobile 4', NULL, '1', '3.50', '3.5', '45.00', 3.5, 1, 0, 0, 0, NULL),
(18, 4, 3, 0, 'Mobile 3', NULL, '1', '4.50', '4.5', '0.00', 4.5, 1, 0, 0, 0, NULL),
(17, 4, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(16, 4, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(20, 5, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(21, 6, 4, 0, 'Mobile 4', NULL, '1', '3.50', '3.5', '45.00', 3.5, 1, 0, 0, 0, NULL),
(22, 7, 3, 0, 'Mobile 3', NULL, '1', '4.50', '4.5', '0.00', 4.5, 1, 0, 0, 0, NULL),
(23, 7, 4, 0, 'Mobile 4', NULL, '1', '3.50', '3.5', '45.00', 3.5, 1, 0, 0, 0, NULL),
(24, 8, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(25, 8, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(26, 8, 3, 0, 'Mobile 3', NULL, '1', '4.50', '4.5', '0.00', 4.5, 1, 0, 0, 0, NULL),
(27, 9, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(28, 9, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(29, 9, 3, 0, 'Mobile 3', NULL, '1', '4.50', '4.5', '0.00', 4.5, 1, 0, 0, 0, NULL),
(30, 10, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(31, 10, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(32, 11, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 2, 0, 0, 0, NULL),
(33, 11, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 2, 0, 0, 0, NULL),
(34, 12, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 7, 0, 0, 0, NULL),
(40, 13, 0, 0, 'eryery', NULL, '1', '45.00', '45.00', '0', 45, 1, 0, 0, 0, NULL),
(39, 13, 0, 0, 'gsgs', NULL, '1', '17.00', '17.00', '0', 17, 1, 0, 0, 0, NULL),
(38, 13, 0, 0, 'hdhh', NULL, '1', '10.00', '10.00', '0', 10, 1, 0, 0, 0, NULL),
(41, 14, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(42, 14, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(43, 14, 3, 0, 'Mobile 3', NULL, '1', '4.50', '4.5', '0.00', 4.5, 1, 0, 0, 0, NULL),
(44, 15, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(45, 15, 3, 0, 'Mobile 3', NULL, '1', '4.50', '4.5', '0.00', 4.5, 1, 0, 0, 0, NULL),
(46, 15, 4, 0, 'Mobile 4', NULL, '1', '3.50', '3.5', '45.00', 3.5, 1, 0, 0, 0, NULL),
(47, 16, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(48, 16, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(49, 16, 4, 0, 'Mobile 4', NULL, '1', '3.50', '3.5', '45.00', 3.5, 1, 0, 0, 0, NULL),
(50, 17, 0, 0, 'gshdh', NULL, '1', '10.00', '10.00', '0', 10, 1, 0, 0, 0, NULL),
(51, 17, 0, 0, 'sdhfh', NULL, '1', '15.00', '15.00', '0', 15, 1, 0, 0, 0, NULL),
(52, 17, 0, 0, 'dghg', NULL, '1', '8.00', '8.00', '0', 8, 1, 0, 0, 0, NULL),
(53, 18, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(54, 18, 3, 0, 'Mobile 3', NULL, '1', '4.50', '4.5', '0.00', 4.5, 1, 0, 0, 0, NULL),
(55, 18, 4, 0, 'Mobile 4', NULL, '1', '3.50', '3.5', '45.00', 3.5, 1, 0, 0, 0, NULL),
(56, 19, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(57, 19, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 3, 0, 0, 0, NULL),
(58, 20, 1, 0, 'Mobile 1', NULL, '1', '1.00', '1', '0.00', 1, 1, 0, 0, 0, NULL),
(59, 20, 2, 0, 'Mobile 2', NULL, '1', '2.00', '2', '0.00', 2, 1, 0, 0, 0, NULL),
(60, 20, 3, 0, 'Mobile 3', NULL, '1', '4.50', '4.5', '0.00', 4.5, 1, 0, 0, 0, NULL),
(61, 20, 4, 0, 'Mobile 4', NULL, '1', '3.50', '3.5', '45.00', 3.5, 1, 0, 0, 0, NULL),
(62, 21, 236, 0, 'J56', NULL, '1', '560.00', '560', '535.00', 560, 1, 0, 0, 0, NULL),
(63, 25, 236, 0, 'J56', NULL, '1', '560.00', '560', '535.00', 560, 1, 0, 0, 0, NULL),
(67, 26, 236, 0, 'J56', NULL, '1', '560.00', '560', '535.00', 560, 1, 0, 0, 0, '45656456456456'),
(66, 26, 237, 0, 'J5', NULL, '1', '500.00', '500', '480.00', 500, 1, 0, 0, 0, '95675675675675'),
(68, 27, 236, 0, 'Galaxy s7', NULL, '1', '560.00', '560', '535.00', 560, 1, 0, 0, 0, '798745645'),
(69, 27, 237, 0, 'J2 Gold', NULL, '1', '500.00', '500', '480.00', 500, 1, 0, 0, 0, '7973216849'),
(73, 28, 237, 0, 'J2 Gold', NULL, '1', '500.00', '500', '480.00', 500, 1, 0, 0, 0, '34758586'),
(72, 28, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, '45746865'),
(74, 29, 240, 0, 'Charger white', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, '536368'),
(75, 29, 236, 0, 'Galaxy s7', NULL, '1', '560.00', '560', '535.00', 560, 1, 0, 0, 0, '86768768'),
(76, 30, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, '43253'),
(77, 30, 240, 0, 'Charger white', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, '354353'),
(78, 30, 236, 0, 'Galaxy s7', NULL, '1', '560.00', '560', '535.00', 560, 1, 0, 0, 0, '4353'),
(79, 30, 237, 0, 'J2 Gold', NULL, '1', '500.00', '500', '480.00', 500, 1, 0, 0, 0, '453563'),
(80, 31, 242, 0, 'Huawei 9 lite', NULL, '1', '750.00', '750', '700.00', 750, 1, 0, 0, 0, '1111111111'),
(81, 32, 240, 0, 'Charger white', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, '43'),
(82, 32, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, '34'),
(83, 33, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, '34555'),
(84, 33, 240, 0, 'Charger white', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, '34'),
(85, 34, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, ''),
(86, 34, 240, 0, 'Charger white', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, 'asdsaf'),
(87, 34, 240, 0, 'Charger white', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, 'wer'),
(88, 34, 236, 0, 'Galaxy s7', NULL, '1', '560.00', '560', '535.00', 560, 1, 0, 0, 0, ''),
(89, 35, 0, 0, 'saff', NULL, '1', '34.00', '34.00', '0', 34, 1, 0, 0, 0, '45'),
(90, 35, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, ''),
(95, 36, 240, 0, 'Charger white', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, 'klk;;'),
(94, 36, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, ''),
(96, 36, 0, 0, 'dsf', NULL, '1', '10.00', '10.00', '0', 10, 1, 0, 0, 0, 'fgdg'),
(128, 46, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(105, 38, 242, 0, 'Huawei 9 lite', NULL, '1', '750.00', '750', '700.00', 750, 1, 0, 0, 0, ''),
(104, 38, 240, 0, 'Charger white', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, ''),
(103, 38, 236, 0, 'Galaxy s7', NULL, '1', '560.00', '560', '535.00', 560, 1, 0, 0, 0, '123123'),
(106, 39, 236, 0, 'Galaxy s7 v', NULL, '1', '5601.00', '5601', '5351.00', 5601, 1, 0, 0, 0, '244547878454'),
(107, 40, 236, 0, 'Galaxy s7 v', NULL, '1', '5601.00', '5601', '5351.00', 5601, 1, 0, 0, 0, ''),
(108, 40, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, ''),
(109, 41, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, ''),
(110, 41, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, ''),
(111, 41, 239, 0, 'Charger black', NULL, '1', '150.00', '150', '125.00', 150, 1, 0, 0, 0, ''),
(112, 42, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(113, 42, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(114, 42, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(115, 43, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(116, 43, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(117, 43, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(118, 43, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(137, 44, 3, 0, 'Cowl screen', NULL, '1', '30.00', '30', '25.00', 30, 1, 0, 0, 0, ''),
(136, 44, 3, 0, 'Cowl screen', NULL, '1', '30.00', '500', '25.00', 500, 1, 0, 0, 0, ''),
(127, 45, 3, 0, 'Cowl screen', NULL, '1', '30.00', '30', '25.00', 30, 1, 0, 0, 0, ''),
(126, 45, 3, 0, 'Cowl screen', NULL, '1', '30.00', '30', '25.00', 30, 1, 0, 0, 0, ''),
(125, 45, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(129, 46, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(130, 47, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(131, 47, 0, 0, 'tttt', NULL, '1', '50.00', '50.00', '0', 50, 1, 0, 0, 0, ''),
(132, 48, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(133, 48, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(134, 48, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(135, 48, 0, 0, 'gfgsdb', NULL, '1', '65.00', '65.00', '0', 65, 1, 0, 0, 0, ''),
(138, 44, 3, 0, 'Cowl screen', NULL, '1', '30.00', '30', '25.00', 30, 1, 0, 0, 0, ''),
(139, 49, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(140, 49, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(141, 49, 3, 0, 'Cowl screen', NULL, '1', '30.00', '30', '25.00', 30, 1, 0, 0, 0, ''),
(142, 50, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(143, 50, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(148, 51, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '5', '18.00', 5, 1, 0, 0, 0, '51651651'),
(147, 51, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, '56516515'),
(149, 51, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, '51615651'),
(150, 52, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, '56222'),
(151, 52, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, '56461561'),
(152, 53, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(153, 53, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, ''),
(154, 53, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(155, 53, 3, 0, 'Cowl screen', NULL, '1', '30.00', '30', '25.00', 30, 1, 0, 0, 0, ''),
(156, 53, 3, 0, 'Cowl screen', NULL, '1', '30.00', '30', '25.00', 30, 1, 0, 0, 0, ''),
(157, 53, 4, 0, 'Decklid', NULL, '1', '10.00', '10', '8.00', 10, 1, 0, 0, 0, ''),
(158, 54, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, '4646'),
(159, 54, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, '6456465'),
(160, 54, 2, 0, 'Bumper', NULL, '1', '25.00', '25', '22.00', 25, 1, 0, 0, 0, ''),
(161, 55, 1, 0, 'Bonnet/hood', NULL, '1', '20.00', '20', '18.00', 20, 1, 0, 0, 0, '565'),
(162, 55, 7, 0, 'Cooling Fan', NULL, '1', '12.00', '12', '1000.00', 12, 1, 0, 0, 0, '5646'),
(163, 55, 7, 0, 'Cooling Fan', NULL, '1', '12.00', '12', '1000.00', 12, 1, 0, 0, 0, '54646+');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `set_name` varchar(150) NOT NULL,
  `id` int(11) NOT NULL,
  `set_value` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`set_name`, `id`, `set_value`) VALUES
('CLIENT_NAMEE', 1, 'SS Computers'),
('CLIENT_ADDRESS', 2, 'Erode, Tamilnadu'),
('CLIENT_NUMBER', 3, '+91 8870073539'),
('CLIENT_WEBSITE', 4, 'TRN: 000000000000'),
('RECIPT_PRE', 5, 'SS'),
('CURRENCY', 6, 'INR'),
('BILL_FOOTER', 7, 'Thank you and come again'),
('API_KEY', 8, '2sYDrDoDx9z4'),
('OWNER_NUM', 9, '8870073539'),
('CLIENT_LOGO', 10, ''),
('BILL_TAX_VAL', 11, '5');

-- --------------------------------------------------------

--
-- Table structure for table `settle_sale`
--

CREATE TABLE `settle_sale` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `cash_at_starting` varchar(50) NOT NULL,
  `cash_sale` varchar(50) NOT NULL,
  `card_sale` varchar(50) NOT NULL,
  `credit_sale` varchar(50) NOT NULL,
  `delivery_sale` varchar(50) NOT NULL,
  `delivery_recover` varchar(50) DEFAULT NULL,
  `online_order_recovery` varchar(50) DEFAULT NULL,
  `credit_recover` varchar(50) NOT NULL,
  `cg_advance` varchar(50) NOT NULL,
  `cg_recover` varchar(50) NOT NULL,
  `total_vat` varchar(50) DEFAULT NULL,
  `gross_total` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `net_total` varchar(50) NOT NULL,
  `cash_drawer` varchar(50) NOT NULL,
  `settle_date` datetime NOT NULL,
  `pay_back` varchar(225) NOT NULL,
  `expense` varchar(225) NOT NULL,
  `local_purchase` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settle_sale`
--

INSERT INTO `settle_sale` (`id`, `user_id`, `shop_id`, `cash_at_starting`, `cash_sale`, `card_sale`, `credit_sale`, `delivery_sale`, `delivery_recover`, `online_order_recovery`, `credit_recover`, `cg_advance`, `cg_recover`, `total_vat`, `gross_total`, `discount`, `net_total`, `cash_drawer`, `settle_date`, `pay_back`, `expense`, `local_purchase`) VALUES
(1, 1, 1, '0.0', '0.0', '0.0', '0.0', '0.0', NULL, NULL, '0.0', '0.00', '0.00', NULL, '0.0', '0.0', '0.00', '0.0', '2017-06-07 20:17:00', '', '', ''),
(33, 1, 1, '', '47.25', '0', '0', '0', '0', '0', '88', '', '', '1.25', '26.25', '0', '26.25', '59.02', '2018-10-28 09:53:59', '21', '55.23', '0'),
(32, 1, 1, '', '81750.7', '722.5', '1344.75', '0', '0', '0', '1023.25', '', '', '3940.1', '82742.1', '65.5', '82676.6', '81579.51725', '2018-10-28 09:28:25', '1141.35', '53.08275', '0');

-- --------------------------------------------------------

--
-- Table structure for table `stock_management_history`
--

CREATE TABLE `stock_management_history` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `action_type` enum('add','sub') NOT NULL DEFAULT 'add',
  `stock_value` double NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_management`
--

CREATE TABLE `table_management` (
  `table_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  `no_of_seats` int(11) NOT NULL,
  `filled_seats` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_management`
--

INSERT INTO `table_management` (`table_id`, `floor_id`, `table_no`, `no_of_seats`, `filled_seats`) VALUES
(30, 1, 1, 4, 0),
(2, 1, 2, 4, 1),
(3, 1, 3, 4, 1),
(4, 1, 4, 4, 0),
(5, 1, 5, 4, 1),
(6, 1, 6, 4, 0),
(7, 1, 7, 4, 0),
(8, 1, 8, 4, 2),
(9, 1, 9, 4, 0),
(10, 1, 10, 2, 0),
(11, 1, 11, 2, 0),
(12, 1, 12, 4, 0),
(13, 1, 13, 4, 0),
(14, 1, 14, 4, 0),
(15, 1, 15, 4, 0),
(16, 1, 16, 4, 0),
(17, 1, 17, 4, 1),
(18, 2, 1, 4, 0),
(19, 2, 2, 4, 0),
(20, 2, 3, 4, 0),
(21, 2, 4, 4, 0),
(22, 2, 5, 4, 0),
(23, 2, 6, 4, 1),
(24, 2, 7, 4, 0),
(25, 2, 8, 4, 0),
(26, 2, 9, 4, 0),
(27, 2, 10, 4, 0),
(28, 2, 11, 4, 0),
(29, 2, 12, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_pass` text NOT NULL,
  `role_id` int(11) NOT NULL,
  `manufacturing_unit_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `status` enum('0','1') DEFAULT '0',
  `user_action` text,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fcm_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_pass`, `role_id`, `manufacturing_unit_id`, `shop_id`, `first_name`, `last_name`, `email`, `phone`, `is_active`, `status`, `user_action`, `created_at`, `updated_at`, `fcm_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1, 'Admin', '', 'anandbe13@gmail.com', '123456789', '1', '1', 'counter_sale,delivery_sale,dine_in,take_away,reports,expense,credit_sale,settle_sale,cod_log,online_order_log,sale_order_details,cash_back,barcode_print', '2016-03-30 10:13:18', '2016-03-30 10:13:18', ''),
(2, 'User1', '04b9d2f155fce078a8edd0535d84d64f', 2, 1, 1, 'User1', '', 'anandbe13@gmail.com', '123456789', '1', '1', 'counter_sale,delivery_sale,dine_in,take_away,reports,expense,credit_sale,settle_sale,cod_log,online_order_log,sale_order_details,cash_back,barcode_print', '2016-03-30 10:13:18', '2016-03-30 10:13:18', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(25) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'User', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credit_sale`
--
ALTER TABLE `credit_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_units`
--
ALTER TABLE `item_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations_manufacturing_units`
--
ALTER TABLE `locations_manufacturing_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations_shops`
--
ALTER TABLE `locations_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_back`
--
ALTER TABLE `pay_back`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_id` (`receipt_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `contact_number` (`contact_number`),
  ADD KEY `order_type` (`order_type`),
  ADD KEY `payment_type` (`payment_type`),
  ADD KEY `status` (`status`),
  ADD KEY `table_id` (`table_id`),
  ADD KEY `floor_id` (`floor_id`);

--
-- Indexes for table `sale_order_items`
--
ALTER TABLE `sale_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_order_id` (`sale_order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settle_sale`
--
ALTER TABLE `settle_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_management_history`
--
ALTER TABLE `stock_management_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `table_management`
--
ALTER TABLE `table_management`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credit_sale`
--
ALTER TABLE `credit_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `item_units`
--
ALTER TABLE `item_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `locations_manufacturing_units`
--
ALTER TABLE `locations_manufacturing_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `locations_shops`
--
ALTER TABLE `locations_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pay_back`
--
ALTER TABLE `pay_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `sale_order_items`
--
ALTER TABLE `sale_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `settle_sale`
--
ALTER TABLE `settle_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `stock_management_history`
--
ALTER TABLE `stock_management_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_management`
--
ALTER TABLE `table_management`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
