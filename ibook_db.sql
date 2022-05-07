-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2022 at 03:23 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `title`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Abdullaziz Bin Baz Rahimahullah', NULL, 'be30992937d081b85ffc8bbd520fa8a661dbdab7-binbaz.png', 'active', '2022-05-07 15:08:38', NULL),
(2, 'Elyes Ismael', NULL, '1fd6a3cc536aa295004bcba5c81ba2b544edfe19-empty.jpg', 'active', '2022-05-07 15:11:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_id` int(200) DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ISBN` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher_id` int(11) DEFAULT NULL,
  `publish_year` longtext COLLATE utf8mb4_unicode_ci,
  `price` double DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` float DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `book_file_review` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `book_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `author_id`, `title`, `ISBN`, `category_id`, `publisher_id`, `publish_year`, `price`, `image`, `size`, `page`, `book_file_review`, `book_file`, `detail`, `created_at`, `updated_at`) VALUES
(5, 2, 'áž€áž¶ážšážŸáŸ’áž‚áž¶áž›áŸ‹áž¢áž›áŸ‹áž¡áŸ„áŸ‡', '001', '3', 1, '2013', 0, 'e5a775d92e1a55120ce3aacd29c74f99286d4588-know_allah.png', NULL, 107, '', '', 'Nothing', '2022-05-07 15:21:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Language', NULL, '53f36bc61dc4e9e1b0d15194b2eb1aa450e50a15-language.png', 'active', '2022-05-07 02:02:01', NULL),
(2, 'Tafseer', NULL, '478b632c22c2f32569ebd7b4fcd0ac637d3826ec-tafshir.jpeg', 'active', '2022-05-07 02:02:32', NULL),
(3, 'Fiqh', NULL, '07eb89e9c4b18db31095868d7cbd91fd4ce45f29-fiqah.jpeg', 'active', '2022-05-07 02:02:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

DROP TABLE IF EXISTS `publishers`;
CREATE TABLE IF NOT EXISTS `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `title`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ážŸáž˜áž¶áž‚áž˜ážŸáž˜áŸ’ážšáž”ážŸáž˜áŸ’ážšáž½áž›ážŸáž„áŸ’áž‚áž˜áž“áŸƒážšážŠáŸ’áž‹áž‚áž»áž™ážœáŸ‰áŸ‚áž', NULL, '0ddd5473d6c2adbd8c5fcfe015b305cddfe91221-ážŸáž˜áž¶áž‚áž˜ážŸáž˜áŸ’ážšáž”ážŸáž˜áŸ’ážšáž½áž›ážŸáž„áŸ’áž‚áž˜áž“áŸƒážšážŠáŸ’áž‹áž‚áž»áž™ážœáŸ‰áŸ‚áž.jpg', 'active', '2022-05-07 15:10:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `image` text COLLATE utf8_bin,
  `status` enum('active','inactive') COLLATE utf8_bin DEFAULT NULL,
  `created_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `image`, `status`, `created_dt`, `update_dt`) VALUES
(1, 'Slide1', '865768fa0ad8e9cece95e94b2e04a609f2426be9-slide1.jpg', 'active', '2022-05-07 09:08:33', NULL),
(2, 'Slide2', '68ffcbaf2f451365250168afbfee54983b0c6349-1.png', 'active', '2022-05-07 09:08:44', NULL),
(3, 'Slide3', '63283e53cbff28710334af367ea818e9599b2b86-s3.jpg', 'active', '2022-05-07 09:09:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_level` varchar(16) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `img_profile` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='admin and customer users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `address`, `password`, `access_level`, `access_code`, `status`, `img_profile`, `created`, `modified`) VALUES
(1, 'Mike', 'Dalisay', 'mike@example.com', '0999999999', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', '$2y$10$AUBptrm9sQF696zr8Hv31On3x4wqnTihdCLocZmGLbiDvyLpyokL.', 'Admin', '', 1, NULL, '2015-03-24 07:00:21', '2016-06-13 11:17:47'),
(2, 'Lauro', 'Abogne', 'lauro@eacomm.com', '08888888', 'Pasig City', '$2y$10$it4i11kRKrB19FfpPRWsRO5qtgrgajL7NnxOq180MsIhCKhAmSdDa', 'Customer', '', 1, NULL, '2015-03-24 07:00:21', '2015-03-24 00:00:21'),
(4, 'Darwin', 'Dalisay', 'darwin@example.com', '9331868359', 'Blk 24 A Lot 6 Ph 3\r\nPeace Village, San Luis', '$2y$10$tLq9lTKDUt7EyTFhxL0QHuen/BgO9YQzFYTUyH50kJXLJ.ISO3HAO', 'Customer', 'ILXFBdMAbHVrJswNDnm231cziO8FZomn', 1, NULL, '2014-10-29 17:31:09', '2016-06-13 11:18:25'),
(7, 'Marisol Jane', 'Dalisay', 'mariz@gmail.com', '09998765432', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', 'mariz', 'Customer', '', 1, NULL, '2015-02-25 09:35:52', '2015-03-24 00:00:21'),
(9, 'Marykris', 'De Leon', 'marykrisdarell.deleon@gmail.com', '09194444444', 'Project 4, QC', '$2y$10$uUy7D5qmvaRYttLCx9wnU.WOD3/8URgOX7OBXHPpWyTDjU4ZteSEm', 'Customer', '', 1, NULL, '2015-02-27 14:28:46', '2015-03-23 23:51:03'),
(10, 'Merlin', 'Duckerberg', 'merlin@gmail.com', '09991112333', 'Project 2, Quezon City', '$2y$10$VHY58eALB1QyYsP71RHD1ewmVxZZp.wLuhejyQrufvdy041arx1Kq', 'Admin', '', 1, NULL, '2015-03-18 06:45:28', '2015-03-24 00:00:21'),
(14, 'Charlon', 'Ignacio', 'charlon@gmail.com', '09876543345', 'Tandang Sora, QC', '$2y$10$Fj6O1tPYI6UZRzJ9BNfFJuhURN9DnK5fQGHEsfol5LXRu.tCYYggu', 'Customer', '', 1, NULL, '2015-03-24 08:06:57', '2015-03-24 00:48:00'),
(15, 'Kobe Bro', 'Bryant', 'kobe@gmail.com', '09898787674', 'Los Angeles, California', '$2y$10$fmanyjJxNfJ8O3p9jjUixu6EOHkGZrThtcd..TeNz2g.XZyCIuVpm', 'Customer', '', 1, NULL, '2015-03-26 11:28:01', '2015-03-25 20:39:52'),
(20, 'Tim', 'Duncan', 'tim@example.com', '9999999', 'San Antonio, Texas, USA', '$2y$10$9OSKHLhiDdBkJTmd3VLnQeNPCtyH1IvZmcHrz4khBMHdxc8PLX5G6', 'Customer', '0X4JwsRmdif8UyyIHSOUjhZz9tva3Czj', 1, NULL, '2016-05-26 01:25:59', '2016-05-25 10:25:59'),
(21, 'Tony', 'Parker', 'tony@example.com', '8888888', 'Blk 24 A Lot 6 Ph 3\r\nPeace Village, San Luis', '$2y$10$lBJfvLyl/X5PieaztTYADOxOQeZJCqETayF.O9ld17z3hcKSJwZae', 'Customer', 'THM3xkZzXeza5ISoTyPKl6oLpVa88tYl', 1, NULL, '2016-05-26 01:29:01', '2016-06-13 10:46:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
