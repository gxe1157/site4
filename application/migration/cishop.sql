-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2017 at 11:46 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cishop`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `page_url`, `page_title`, `page_keywords`, `page_description`, `page_content`, `status`, `date_published`, `author`, `picture`) VALUES
(1, 'First-Blog-entry', 'First Blog entry', '                                                                              Blog Keywords                                                                            ', '                                                                              Blog Description                                                                 ', '<span xss=removed>Lorem ipsum dolor sit amet, phasellus tempor, sed ligula faucibus non. Magna venenatis, at in ut porttitor sem et sed, pede risus. Mollis penatibus. Eu nibh aliquam felis, voluptate orci eu praesent, varius a dui eleifend neque vel, vitae nunc nisl dictumst ea lectus cum, in purus litora praesent aliquam gravida in. Metus at ac. Ante aliquam malesuada arcu egestas lorem justo, amet fusce tortor diam proin mattis imperdiet, per quis ante in nibh nam. Enim eget tempus vitae, dolor porttitor enim, mattis rhoncus pretium cras, amet libero elit. Dui enim at magna. At dictum. Purus dui vestibulum turpis, aenean in aliquet wisi dui, vel morbi sem nulla etiam lacus.</span>', '', 1494046800, 'Evelio Velez Jr.', 'CwVS6qx5sas7q8a5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `store_accounts`
--

CREATE TABLE IF NOT EXISTS `store_accounts` (
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
  `create_date` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_accounts`
--

INSERT INTO `store_accounts` (`id`, `firstname`, `lastname`, `company`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone`, `email`, `create_date`, `password`) VALUES
(2, 'Michael', 'Velez', '', '123 Street', 'APT 11', 'Saddle Brook', 'NJ', '07663', 'USA', '973-478-8813', 'evelio', 1493675969, 'wass'),
(3, 'Leury', 'Velez', '', '123 Street', 'APT 11', 'Saddle Brook', 'NJ', '07663', 'United States', '9734788813', 'evelio@mailers.com', 1493675969, '$2y$11$wYnKLMocfZdaJ7m4EUJN7ug0xBY9Kv2QWngkdItJY.EC4FyLZ86ZO');

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

CREATE TABLE IF NOT EXISTS `store_categories` (
  `id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `parent_cat_id` int(11) DEFAULT NULL,
  `category_url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_categories`
--

INSERT INTO `store_categories` (`id`, `cat_title`, `parent_cat_id`, `category_url`) VALUES
(1, 'Category One', 0, 'Category-One'),
(2, 'Category Two', 1, 'Category-Two'),
(3, 'Category Three', 0, 'Category-Three');

-- --------------------------------------------------------

--
-- Table structure for table `store_cat_assign`
--

CREATE TABLE IF NOT EXISTS `store_cat_assign` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_cat_assign`
--

INSERT INTO `store_cat_assign` (`id`, `cat_id`, `item_id`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE IF NOT EXISTS `store_items` (
  `id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `item_url` varchar(255) NOT NULL,
  `item_price` decimal(7,2) NOT NULL,
  `item_description` text NOT NULL,
  `big_pic` varchar(255) DEFAULT NULL,
  `small_pic` varchar(255) DEFAULT NULL,
  `was_price` decimal(7,2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`id`, `item_title`, `item_url`, `item_price`, `item_description`, `big_pic`, `small_pic`, `was_price`, `status`) VALUES
(1, 'Galaxy Phone 1', 'Galaxy-Phone-1', '900.00', '                              Galaxy III &nbsp;Phone<div><br></div>                         ', 'Penguins.jpg', 'Penguins.jpg', '1200.00', 1),
(2, 'Galaxy Phone 2', 'Pen', '2.00', 'This a mighty pen.', 'Hydrangeas.jpg', 'Hydrangeas.jpg', '2.50', 1),
(3, 'Galaxy Phone 3', 'Galaxy-Phone-III', '900.00', '      Galaxy III &nbsp;Phone<div><br></div>     ', 'Chrysanthemum.jpg', 'Chrysanthemum.jpg', '1200.00', 1),
(4, 'Galaxy Phone 4', 'Galaxy-Phone-4', '2.00', '      This a mighty pen.     ', 'Lighthouse1.jpg', 'Lighthouse1.jpg', '2.50', 1),
(5, 'Galaxy Phone 5', 'Galaxy-Phone-III', '900.00', '      Galaxy III &nbsp;Phone<div><br></div>     ', 'Chrysanthemum.jpg', 'Chrysanthemum.jpg', '0.00', 1),
(6, 'Galaxy Phone 6', 'Galaxy-Phone-6', '2.00', '      This a mighty pen.     ', 'Hydrangeas.jpg', 'Hydrangeas.jpg', '2.50', 1),
(7, 'Galaxy Phone 7', 'Galaxy-Phone-7', '900.00', '            Galaxy III &nbsp;Phone<div><br></div>          ', 'Chrysanthemum.jpg', 'Chrysanthemum.jpg', '1200.00', 1),
(8, 'Galaxy Phone 8', 'Galaxy-Phone-8', '2.00', '      This a mighty pen.     ', 'Hydrangeas.jpg', 'Hydrangeas.jpg', '2.50', 1),
(9, 'Galaxy Phone 9', 'Galaxy-Phone-9', '900.00', '            Galaxy III &nbsp;Phone<div><br></div>          ', 'Chrysanthemum.jpg', 'Chrysanthemum.jpg', '1200.00', 1),
(10, 'Galaxy Phone 10', 'Galaxy-Phone-10', '2.00', '      This a mighty pen.     ', 'personalized.gif', 'personalized.gif', '2.50', 1),
(11, 'Galaxy Phone 11', 'Galaxy-Phone-11', '900.00', '            Galaxy III &nbsp;Phone<div><br></div>          ', 'DIY_DirectMail1.jpg', 'DIY_DirectMail1.jpg', '1200.00', 1),
(12, 'Galaxy Phone 12', 'Galaxy-Phone-12', '2.00', '            This a mighty pen.          ', 'Hydrangeas.jpg', 'Hydrangeas.jpg', '2.50', 1),
(13, 'Galaxy Phone 13', 'Galaxy-Phone-III', '900.00', '      Galaxy III &nbsp;Phone<div><br></div>     ', 'Chrysanthemum.jpg', 'Chrysanthemum.jpg', '1200.00', 1),
(14, 'Galaxy Phone 14', 'Galaxy-Phone-14', '2.00', '      This a mighty pen.     ', 'Hydrangeas.jpg', 'Hydrangeas.jpg', '2.50', 1),
(15, 'Galaxy Phone 15', 'Galaxy-Phone-15', '900.00', '            Galaxy III &nbsp;Phone<div><br></div>          ', 'Chrysanthemum.jpg', 'Chrysanthemum.jpg', '1200.00', 1),
(16, 'Galaxy Phone 16', 'Galaxy-Phone-16', '2.00', '      This a mighty pen.     ', 'Hydrangeas.jpg', 'Hydrangeas.jpg', '2.50', 1),
(17, 'Galaxy Phone 17', 'Galaxy-Phone-III', '900.00', '      Galaxy III &nbsp;Phone<div><br></div>     ', 'Chrysanthemum.jpg', 'Chrysanthemum.jpg', '1200.00', 1),
(18, 'Galaxy Phone 18', 'Galaxy-Phone-18', '2.00', '      This a mighty pen.     ', 'Hydrangeas.jpg', 'Hydrangeas.jpg', '2.50', 1),
(19, 'Galaxy Phone 19', 'Galaxy-Phone-III', '900.00', '      Galaxy III &nbsp;Phone<div><br></div>     ', 'Chrysanthemum.jpg', 'Chrysanthemum.jpg', '1200.00', 1),
(20, 'Galaxy Phone 20', 'Galaxy-Phone-20', '2.00', '      This a mighty pen.     ', 'Hydrangeas.jpg', 'Hydrangeas.jpg', '2.50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_item_colors`
--

CREATE TABLE IF NOT EXISTS `store_item_colors` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_color` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_item_sizes`
--

CREATE TABLE IF NOT EXISTS `store_item_sizes` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_size` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `webpages`
--

CREATE TABLE IF NOT EXISTS `webpages` (
  `id` int(11) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_keywords` text NOT NULL,
  `page_description` text NOT NULL,
  `page_content` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `webpages`
--

INSERT INTO `webpages` (`id`, `page_url`, `page_title`, `page_keywords`, `page_description`, `page_content`, `status`) VALUES
(1, '', 'The Home Page', '           ', '           ', '      Home content     ', ''),
(2, 'contactus', 'Contact Us', 'keywords here', 'Description Here', 'Page Content - Form', ''),
(3, 'page-title-two-Three', 'page title two Three', '            keywords                     ', '            description                     ', '<h1>            This is the headlline</h1>', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `store_accounts`
--
ALTER TABLE `store_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `store_categories`
--
ALTER TABLE `store_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `store_cat_assign`
--
ALTER TABLE `store_cat_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
