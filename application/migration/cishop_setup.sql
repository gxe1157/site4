-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2017 at 04:42 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cishop`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_keywords` text NOT NULL,
  `page_description` text NOT NULL,
  `page_content` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_published` int(11) NOT NULL,
  `author` varchar(65) NOT NULL,
  `picture` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_accounts`
--

CREATE TABLE `store_accounts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` int(11) NOT NULL,
  `mod_dt` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

CREATE TABLE `store_categories` (
  `id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `parent_cat_id` int(11) DEFAULT NULL,
  `category_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_cat_assign`
--

CREATE TABLE `store_cat_assign` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `item_url` varchar(255) NOT NULL,
  `item_price` decimal(7,2) NOT NULL,
  `item_description` text NOT NULL,
  `product_id` varchar(60) NOT NULL,
  `model_no` varchar(90) NOT NULL,
  `big_pic` varchar(255) DEFAULT NULL,
  `small_pic` varchar(255) DEFAULT NULL,
  `was_price` decimal(7,2) NOT NULL,
  `status` int(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `mod_dt` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_items_commercial`
--

CREATE TABLE `store_items_commercial` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_type` varchar(25) NOT NULL,
  `unit_pkg_count` int(11) NOT NULL,
  `unit_pkg_wgt` float(6,2) NOT NULL,
  `unit_pkg_ctn` int(11) NOT NULL,
  `level1_qty` int(11) NOT NULL,
  `level1_pricing` float(7,2) NOT NULL,
  `level2_qty` int(11) NOT NULL,
  `level2_pricing` float(7,2) NOT NULL,
  `level3_qty` int(11) NOT NULL,
  `level3_pricing` float(7,2) NOT NULL,
  `level4_qty` int(11) NOT NULL,
  `level4_pricing` float(7,2) NOT NULL,
  `level5_qty` int(11) NOT NULL,
  `level5_pricing` float(7,2) NOT NULL,
  `mod_dt` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_item_colors`
--

CREATE TABLE `store_item_colors` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_color` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_item_sizes`
--

CREATE TABLE `store_item_sizes` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_size` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `webpages`
--

CREATE TABLE `webpages` (
  `id` int(11) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_keywords` text NOT NULL,
  `page_description` text NOT NULL,
  `page_content` text NOT NULL,
  `status` int(1) NOT NULL,
  `create_date` int(11) NOT NULL,
  `mod_dt` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `webpages`
--

INSERT INTO `webpages` (`id`, `page_url`, `page_title`, `page_keywords`, `page_description`, `page_content`, `status`, `create_date`, `mod_dt`, `userid`) VALUES
(1, '', 'The Home Page', '           ', '           ', '      Home content     ', 0, 0, 0, 0),
(2, 'contactus', 'Contact Us', 'keywords here', 'Description Here', 'Page Content - Form', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_accounts`
--
ALTER TABLE `store_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_categories`
--
ALTER TABLE `store_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_cat_assign`
--
ALTER TABLE `store_cat_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_items_commercial`
--
ALTER TABLE `store_items_commercial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_item_colors`
--
ALTER TABLE `store_item_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_item_sizes`
--
ALTER TABLE `store_item_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webpages`
--
ALTER TABLE `webpages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_accounts`
--
ALTER TABLE `store_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_categories`
--
ALTER TABLE `store_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_cat_assign`
--
ALTER TABLE `store_cat_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_items_commercial`
--
ALTER TABLE `store_items_commercial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_item_colors`
--
ALTER TABLE `store_item_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_item_sizes`
--
ALTER TABLE `store_item_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `webpages`
--
ALTER TABLE `webpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
