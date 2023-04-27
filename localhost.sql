-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2023 at 03:57 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id15865915_2hkdb`
--
CREATE DATABASE IF NOT EXISTS `id15865915_2hkdb` DEFAULT CHARACTER SET utf8mb4 COLLATE  utf8mb4_unicode_ci;
USE `id15865915_2hkdb`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(255) NOT NULL,
  `fullname` varchar(150) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `nbp` varchar(10) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `street` varchar(100) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `first` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `store` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `fullname`, `nbp`, `street`, `city`, `first`, `user_id`, `store`) VALUES
(3, 'test test', '0938928063', 'Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 2, 0),
(4, 'Meow Meow Meow', '0909326188', 'Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 2, 1),
(9, 'Test test', '0938928063', 'Q.Bình Tân', 'TP. Hồ Chí Minh', 1, 12, 0),
(13, 'Nguyễn Thị Đào Hoa', '0938928064', 'Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 1, 0),
(14, 'Nguyễn Văn An', '0902819923', '14 đường 1b, P.7, Q.Tân Bình', 'TP. Hồ Chí Minh', 0, 13, 0),
(15, 'Nguyễn Văn Bính', '0902819925', 'Số 83 đường Nguyễn Bỉnh Khiêm, Q.1', 'TP. Hồ Chí Minh', 0, 14, 0),
(16, 'Nguyễn Văn Canh', '0902819928', '23 đường số 23', 'TP. Hồ Chí Minh', 0, 15, 0),
(17, 'Nguyễn Văn Danh', '0902819912', '1 đường số 30', 'TP. Hồ Chí Minh', 0, 16, 0),
(18, 'Nguyễn Văn Hoàng', '0902819913', '242 Kinh Dương Vương, P.An Lac, Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 17, 0),
(19, 'Nguyễn Văn Toàn Hoàng', '0902819914', '243 Kinh Dương Vương, P.An Lac, Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 18, 0),
(20, 'Nguyễn Văn Toàn', '0902819915', '240 Kinh Dương Vương, P.An Lac, Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 19, 0),
(21, 'Nguyễn Văn Hài', '0902819916', '239 Kinh Dương Vương, P.An Lac, Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 20, 0),
(22, 'Nguyễn Văn Phúc', '0902819917', '238 Kinh Dương Vương, P.An Lac, Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 21, 0),
(23, 'Nguyễn Thị Thị', '0902819918', '237 đường 3/2, P.An Lac, Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 22, 0),
(24, 'Nguyễn Trọng Đăng Khoa', '0938928064', 'Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 1, 1),
(25, 'Lâm Gia Khang', '0904039745', 'nope', 'TP. Hồ Chí Minh', 0, 6, 1),
(29, 'Văn Anh', '0908743881', '93 Nhật Tảo, Phường 4, Quận 10', 'TP. Hồ Chí Minh', 0, 23, 1),
(30, 'meow meow', '0123456789', 'Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 24, 0),
(31, 'meo meo', '0123456789', 'Q.Bình Tân', 'TP. Hồ Chí Minh', 0, 24, 1),
(32, 'Test Test', '0938928066', '123', 'Vĩnh Long', 0, 25, 0),
(33, 'Test123', '0938928066', '123', 'Hậu Giang', 0, 25, 1),
(34, 'test test', '0938928062', '123', 'TP. Hồ Chí Minh', 0, 26, 0),
(35, '12312312', '0938928062', '123', 'TP. Hồ Chí Minh', 0, 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(100) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `actived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `actived`) VALUES
(1, 'Thời trang nam', 1),
(2, 'Điện Thoại & Phụ Kiện', 1),
(3, 'Thiết Bị Điện Tử', 1),
(4, 'Đồ chơi', 1),
(5, 'Máy Tính & Laptop', 1),
(6, 'Nhà Cửa & Đời Sống', 1),
(7, 'Thiết Bị Điện Gia Dụng', 1),
(8, 'Thời Trang Nữ', 1),
(9, 'Giày Dép Nam', 1),
(10, 'Sách', 1),
(11, 'Phụ Kiện Thời Trang', 1),
(12, 'Đồng Hồ', 1),
(13, 'Giày Dép Nữ', 1),
(14, 'Sức Khỏe & Sắc Đẹp', 1),
(15, 'Túi Ví', 1),
(16, 'Bách Hóa Online', 1),
(17, 'Ô tô - xe máy - xe đạp', 1),
(18, 'Chăm sóc thú cưng', 1),
(19, 'Thời Trang Trẻ Em', 1),
(32, 'Sản Phẩm Khác', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(255) NOT NULL,
  `code` varchar(20) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `ship` tinyint(100) DEFAULT NULL,
  `discount` tinyint(100) NOT NULL,
  `amount` int(255) NOT NULL COMMENT 'Số lượng mã giảm giá',
  `damount` int(255) NOT NULL COMMENT 'Lượt dùng mã giảm giá',
  `actived` tinyint(1) NOT NULL COMMENT 'Yes: có hoạt động',
  `infinity` tinyint(1) NOT NULL,
  `forall` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `died_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `ship`, `discount`, `amount`, `damount`, `actived`, `infinity`, `forall`, `created_at`, `died_at`) VALUES
(1, 'GEWNT', 1, 10, 100, 1, 1, 0, 1, '2021-02-27 10:23:01', '2021-02-27'),
(2, 'V43OAF', 1, 10, 100, 1, 1, 0, 1, '2021-02-27 10:23:59', '2021-02-27'),
(3, 'IWUN9', 1, 30, 100, 2, 1, 1, 1, '2021-02-27 10:33:22', '2021-02-28'),
(5, 'FWYPP', 1, 10, 100, 1, 1, 0, 1, '2021-03-11 00:58:52', '2021-03-27'),
(6, 'AAVD40N6E', 1, 10, 100, 100, 1, 0, 1, '2021-03-11 00:59:23', '2021-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(255) NOT NULL,
  `link` text COLLATE  utf8mb4_unicode_ci NOT NULL,
  `product_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `spcart_id` int(255) NOT NULL,
  `type` tinyint(10) NOT NULL,
  `pos` tinyint(3) NOT NULL,
  `status` tinyint(5) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `link`, `product_id`, `user_id`, `spcart_id`, `type`, `pos`, `status`, `created_at`, `updated_at`) VALUES
(1, '/assets/imgs/uploads/99ac9ab4f0291fc3f085ac9c5349705d.jpg', 3, 1, 0, 1, 1, 1, '2021-01-12 16:01:43', '2021-01-12 17:17:23'),
(2, '/assets/imgs/uploads/afffa8b5793d8c6ae07e2238c59fcb43.jpg', 3, 1, 0, 1, 1, 1, '2021-01-12 16:01:43', '2021-01-12 17:17:21'),
(11, '/assets/imgs/uploads/e80a4520f954d5633175f0a15b783b2a.jpg', 2, 1, 0, 1, 1, 1, '2021-01-16 18:09:28', '2021-01-16 18:09:28'),
(12, '/assets/imgs/uploads/510ZZCSBNPL.jpg', 5, 4, 0, 1, 1, 1, '2021-01-20 15:57:05', '2021-01-20 15:57:05'),
(13, '/assets/imgs/uploads/s-l1600 (4).jpg', 6, 8, 0, 1, 1, 1, '2021-01-20 16:16:25', '2021-01-20 16:16:25'),
(14, '/assets/imgs/uploads/12800840.jpg', 7, 4, 0, 1, 1, 1, '2021-01-20 16:24:07', '2021-01-20 16:24:07'),
(15, '/assets/imgs/uploads/136430169_835055193952736_7890011704822527342_o.jpg', 13, 4, 0, 1, 1, 1, '2021-01-20 16:37:04', '2021-01-20 16:37:04'),
(16, '/assets/imgs/uploads/134687329_834683920656530_1791489068105811352_o.jpg', 14, 4, 0, 1, 1, 1, '2021-01-20 16:38:42', '2021-01-20 16:38:42'),
(17, '/assets/imgs/uploads/maxresdefault.jpg', 15, 4, 0, 1, 1, 1, '2021-01-20 16:43:39', '2021-01-20 16:43:39'),
(23, '/assets/imgs/uploads/pngtree-shopping-mall-supermarket-selection-merchandise-poster-background-material-image_133225.jpg', 0, 1, 0, 3, 0, 1, '2021-01-23 06:58:01', '2021-01-23 06:58:01'),
(24, '/assets/imgs/uploads/co-gai-den-tu-hom-qua3-2984-14-6777-2518-1521549733.jpg', 16, 4, 0, 1, 1, 1, '2021-01-27 17:13:39', '2021-01-27 17:13:39'),
(25, '/assets/imgs/uploads/sddasd-179x300.gif', 17, 4, 0, 1, 1, 1, '2021-01-27 17:15:05', '2021-01-27 17:15:05'),
(26, '/assets/imgs/uploads/sach-quan-go-di-len-180x300.jpg', 18, 4, 0, 1, 1, 1, '2021-01-27 17:18:06', '2021-01-27 17:18:06'),
(27, '/assets/imgs/uploads/sach-chu-be-rac-roi-179x300.jpg', 19, 4, 0, 1, 1, 1, '2021-01-27 17:18:54', '2021-01-27 17:18:54'),
(29, '/assets/imgs/uploads/co-hai-con-meo-ngoi-ben-cua-so-1_600x929.jpg', 21, 4, 0, 1, 1, 1, '2021-01-27 17:24:10', '2021-01-27 17:24:10'),
(30, '/assets/imgs/uploads/chuberaroi.jpg', 20, 4, 0, 1, 1, 1, '2021-01-27 17:24:52', '2021-01-27 17:24:52'),
(32, '/assets/imgs/uploads/s-l1600.jpg', 24, 8, 0, 1, 1, 1, '2021-01-29 16:20:04', '2021-01-29 16:20:04'),
(33, '/assets/imgs/uploads/Opera Snapshot_2021-01-29_232733_www.ebay.com.png', 25, 8, 0, 1, 1, 1, '2021-01-29 16:28:19', '2021-01-29 16:28:19'),
(35, '/assets/imgs/uploads/45a1aeab79e5708131ae2c9c80cd6f58.jpg', 23, 1, 0, 1, 1, 1, '2021-01-30 17:36:34', '2021-01-30 17:36:34'),
(36, '/assets/imgs/uploads/Supreme-x-Oreo.jpg', 26, 8, 0, 1, 1, 1, '2021-01-31 13:23:35', '2021-01-31 13:23:35'),
(37, '/assets/imgs/uploads/Screenshot (2).png', 27, 9, 0, 1, 1, 1, '2021-02-02 18:08:37', '2021-02-02 18:08:37'),
(38, '/assets/imgs/uploads/Screenshot (3).png', 27, 9, 0, 1, 1, 1, '2021-02-02 18:08:37', '2021-02-02 18:08:37'),
(43, '/assets/imgs/uploads/macbook-air-space-gray-config-20.jpg', 28, 1, 0, 1, 1, 1, '2021-02-03 15:27:57', '2021-02-03 15:27:57'),
(44, '/assets/imgs/uploads/27da7de9c3ba629595e1de926fdefb00.jpg', 29, 11, 0, 1, 1, 1, '2021-02-09 23:27:35', '2021-02-09 23:27:35'),
(45, '/assets/imgs/uploads/146863772_1340649366295668_1920252117717193197_n.jpg', 0, 1, 0, 4, 0, 1, '2021-02-10 22:29:38', '2021-02-10 22:29:38'),
(46, '/assets/imgs/uploads/taodoc2.png', 0, 1, 0, 4, 0, 1, '2021-02-10 23:24:48', '2021-02-10 23:24:48'),
(50, '/assets/imgs/uploads/1691fa05ecdfe0b2757e8a1460ce6c04.jpg', 32, 1, 0, 1, 1, 1, '2021-02-16 01:15:33', '2021-02-16 01:15:33'),
(51, '/assets/imgs/uploads/ac827fe54b5cf3b8cdb3d6dcc564559c.jpg', 32, 1, 0, 1, 1, 1, '2021-02-16 01:15:33', '2021-02-16 01:15:33'),
(52, '/assets/imgs/uploads/bbf8ce976e699b3776627d72a320068d.jpg', 32, 1, 0, 1, 1, 1, '2021-02-16 01:15:33', '2021-02-16 01:15:33'),
(53, '/assets/imgs/uploads/6ac430e12e4d3b38bd40cb01bf4c2901.jpg', 33, 1, 0, 1, 1, 1, '2021-02-16 01:22:43', '2021-02-16 01:22:43'),
(54, '/assets/imgs/uploads/d5bb0fc15807f449d3ca48cc11e7873f.jpg', 33, 1, 0, 1, 1, 1, '2021-02-16 01:22:43', '2021-02-16 01:22:43'),
(55, '/assets/imgs/uploads/dc5b70b8234b1f03bf36ef70d7ba3b9b.jpg', 33, 1, 0, 1, 1, 1, '2021-02-16 01:22:43', '2021-02-16 01:22:43'),
(56, '/assets/imgs/uploads/e5404d9a9a8aaf99e4830a0ac9b383da.jpg', 34, 1, 0, 1, 1, 1, '2021-02-16 01:27:20', '2021-02-16 01:27:20'),
(57, '/assets/imgs/uploads/5c2a2e4203467d034dfefd52e5b232a2.jpg', 35, 1, 0, 1, 1, 1, '2021-02-16 01:30:16', '2021-02-16 01:30:16'),
(58, '/assets/imgs/uploads/9ad8a8a8fc4895a0f426129009dc3e81.jpg', 36, 1, 0, 1, 1, 1, '2021-02-16 01:32:14', '2021-02-16 01:32:14'),
(59, '/assets/imgs/uploads/3787f32451597d0e470381bb08e38b67.jpg', 37, 1, 0, 1, 1, 1, '2021-02-16 01:37:29', '2021-02-16 01:37:29'),
(60, '/assets/imgs/uploads/ae23ff0792a8745ea7cd4718821eecbd.jpg', 37, 1, 0, 1, 1, 1, '2021-02-16 01:37:29', '2021-02-16 01:37:29'),
(61, '/assets/imgs/uploads/e73dc8f5298348f8839372d29deb3881.jpg', 37, 1, 0, 1, 2, 1, '2021-02-16 01:37:29', '2021-02-16 01:37:29'),
(62, '/assets/imgs/uploads/95fe614cabed1588e21e13d82daa6be5.jpg', 38, 1, 0, 1, 1, 1, '2021-02-16 01:37:58', '2021-02-16 01:37:58'),
(63, '/assets/imgs/uploads/a374584d11fbcc71e05df8a061b09903.jpg', 38, 1, 0, 1, 2, 1, '2021-02-16 01:37:58', '2021-02-16 01:37:58'),
(64, '/assets/imgs/uploads/aa1db068be87ff0068d9d0bbd8bdef28.jpg', 38, 1, 0, 1, 1, 1, '2021-02-16 01:37:58', '2021-02-16 01:37:58'),
(65, '/assets/imgs/uploads/e753bd48b3044d6b226fc03b264c9915.jpg', 38, 1, 0, 1, 1, 1, '2021-02-16 01:37:58', '2021-02-16 01:37:58'),
(66, '/assets/imgs/uploads/299bfec9b6a7dcfd028a38798c517591.jpg', 39, 1, 0, 1, 1, 1, '2021-02-16 01:41:08', '2021-02-16 01:41:08'),
(67, '/assets/imgs/uploads/109804983_1168519670166532_828181516106231180_n.jpg', 0, 6, 0, 4, 0, 1, '2021-02-16 01:43:44', '2021-02-16 01:43:44'),
(68, '/assets/imgs/uploads/a7580ceb309c05c857e90226996e8c04_tn.jpg', 42, 1, 0, 1, 1, 1, '2021-02-19 17:05:24', '2021-02-19 17:05:24'),
(69, '/assets/imgs/uploads/c8f6e60593cf8ca447e55a7536ef4799_tn.jpg', 42, 1, 0, 1, 1, 1, '2021-02-19 17:05:24', '2021-02-19 17:05:24'),
(70, '/assets/imgs/uploads/db32803210ac4ada9e79d710de10aeb7.jpg', 42, 1, 0, 1, 2, 1, '2021-02-19 17:05:25', '2021-02-19 17:05:25'),
(71, '/assets/imgs/uploads/ddc570b9167022c850b766e024b7abef.jpg', 42, 1, 0, 1, 1, 1, '2021-02-19 17:05:25', '2022-02-08 15:48:49'),
(75, '/assets/imgs/uploads/139602544_439163297271670_780467239043843334_n.jpg', 0, 1, 0, 4, 0, 1, '2021-02-25 20:51:02', '2021-02-25 20:51:02'),
(76, '/assets/imgs/uploads/143633902_213127607158554_6004014810033208616_n.jpg', 0, 1, 0, 4, 0, 1, '2021-02-25 20:51:02', '2021-02-25 20:51:02'),
(77, '/assets/imgs/uploads/145939038_415675133038476_3583669616493430479_n.jpg', 0, 1, 0, 4, 0, 1, '2021-02-26 15:54:03', '2021-02-26 15:54:03'),
(78, '/assets/imgs/uploads/121968484_687754288521696_1314409391722605855_n.jpg', 0, 1, 0, 4, 0, 1, '2021-02-26 15:55:36', '2022-02-08 15:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `lstcoupon`
--

CREATE TABLE `lstcoupon` (
  `id` int(255) NOT NULL,
  `category_id` int(255) DEFAULT 0,
  `product_id` int(255) NOT NULL DEFAULT 0,
  `coupon_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lstfollow`
--

CREATE TABLE `lstfollow` (
  `id` int(255) UNSIGNED NOT NULL,
  `store_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lstfollow`
--

INSERT INTO `lstfollow` (`id`, `store_id`, `product_id`, `user_id`) VALUES
(81, 0, 28, 11),
(82, 0, 29, 11),
(89, 1, 0, 1),
(91, 0, 32, 1),
(92, 1, 0, 15),
(93, 4, 0, 1),
(97, 0, 17, 1),
(98, 2, 0, 1),
(99, 0, 39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` text COLLATE  utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE  utf8mb4_unicode_ci NOT NULL,
  `price` bigint(255) NOT NULL,
  `view` int(255) UNSIGNED NOT NULL DEFAULT 0,
  `sale` int(100) DEFAULT NULL,
  `amount` int(255) NOT NULL,
  `actived` tinyint(1) NOT NULL,
  `fcity` varchar(110) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `freeship` tinyint(1) NOT NULL DEFAULT 0,
  `bfrom` text COLLATE  utf8mb4_unicode_ci DEFAULT NULL,
  `discount` text COLLATE  utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(255) NOT NULL,
  `store_id` int(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `view`, `sale`, `amount`, `actived`, `fcity`, `freeship`, `bfrom`, `discount`, `category_id`, `store_id`, `created_at`, `updated_at`) VALUES
(2, '[ Giày chính hãng ] Giày Domba Sneaker Hàn auth - Domba Korea CÓ SẴN', 'Gi&agrave;y thể thao Domba với kiểu d&aacute;ng thời trang đến từ thương hiệu Domba H&agrave;n Quốc. Sử dụng chất liệu da PU v&agrave; đế l&agrave;m bằng EVA nhẹ, &ecirc;m gi&uacute;p cho bước ch&acirc;n của bạn trở l&ecirc;n thoải m&aacute;i, dễ chịu khi mang. Đồng thời đế gi&agrave;y độn chiều cao l&ecirc;n đến 4.5cm gi&uacute;p cho d&aacute;ng bạn trở l&ecirc;n thanh tho&aacute;t v&agrave; tự tin hơn nếu như chiều cao của bạn hơi khi&ecirc;m tốn. Phần g&oacute;t sau phối lớp da tạo điểm nhất cho đ&ocirc;i gi&agrave;y th&ecirc;m phần trẻ trung v&agrave; năng động hơn.\n\nCam kết b&aacute;n h&agrave;ng auth nhập H&agrave;n c&oacute; tag đầy đủ ạ.\nH&agrave;ng c&oacute; sẵn ạ. \nHỗ trợ đổi trả khi c&oacute; sự cố ( với điều kiện c&ograve;n nguy&ecirc;n box   tag)\nKh&aacute;ch cần giao liền trong nội th&agrave;nh TPHCM th&igrave; chọn Nowship v&agrave; nhắn tin cho shop biết nha.\nKh&aacute;ch ngoại tỉnh cần giao sớm th&igrave; lưu &yacute; gi&uacute;p shop l&agrave; h&agrave;ng đến tay kh&aacute;ch cần 2 - 3 ng&agrave;y ạ. Kh&aacute;ch inbox shop v&agrave; hẹn gi&uacute;p m&igrave;nh.\nBạn cần th&ecirc;m th&ocirc;ng tin g&igrave; cứ inbox ngay cho shop nh&eacute;.\nShop c&ograve;n rất nhiều mẫu &aacute;o ADLV c&ugrave;ng c&aacute;c loại sneaker nhập H&agrave;n, Nhật,&hellip; c&ugrave;ng nhiều khuyến m&atilde;i hấp dẫn. C&aacute;c bạn h&atilde;y follow shop ngay nh&eacute;!\nTh&ocirc;ng tin sản phẩm: \n-       Thương hiệu: Domba ( V&igrave; kh&ocirc;ng c&oacute; n&ecirc;n m&igrave;nh để no brand, bạn n&agrave;o cần kiểm h&agrave;ng c&oacute; tag inbox m&igrave;nh)\n-	Chất liệu: Da\n-	M&agrave;u sắc: Đen, Trắng, Hồng, X&aacute;m\n-	Xuất xứ: H&agrave;n Quốc.\n-	Size: 35 -&gt; 45\n\n#domba.vn #domba #sneaker #auth #streetwear\n#giayauth #gi&agrave;y_sneaker_auth #giaydomba #giay_domba_han_quoc #giaydomba #giay_domba #giay_domba_auth  #giaydombachuanauth #giaysneakerauth  #giaydombachinhhang #giay_domba_real #domba_giay #giay_domba_nu #giay_don_de #giaynu #giaynam #giaynudep #domba_real\n\nGi&agrave;y Thể Thao Auth : Gi&agrave;y Auth : Gi&agrave;y Sneaker Auth :Gi&agrave;y Domba Auth : Gi&agrave;y Domba Ch&iacute;nh H&atilde;ng : Gi&agrave;y Domba Authentic : Gi&agrave;y Domba : Gi&agrave;y Domba Auth : Gi&agrave;y Nữ H&agrave;n Quốc : Gi&agrave;y Ch&iacute;nh H&atilde;ng: Gi&agrave;y Domba Korea : Gi&agrave;y Domba H&agrave;n Quốc Chuẩn Auth : Gi&agrave;y Domba Real : Domba High Point : Domba G&oacute;t Bạc : Domba Trắng Đen ', 690000, 7, 0, 100, 1, '', 0, '0', '0', 1, 1, '2021-01-20 15:57:18', '2021-02-28 16:31:08'),
(3, 'Loa Bluetooth di động LG XBOOMGo PN1 - Hàng chính hãng', 'Loa Bluetooth di động LG XBOOMGo PN1\nTh&ocirc;ng tin sản phẩm\nModel: PN1\nK&iacute;ch thước (mm): 138x74.6x38.3\nTrọng lượng: 0.28 kg\nDung lượng pin: 730 mAH\nThời gian sử dụng: 5 giờ\n\nTh&ocirc;ng tin bảo h&agrave;nh\nThời gian bảo h&agrave;nh: 12 th&aacute;ng\nXem chi tiết tại: https://www.lg.com/vn/tro-giup/bao-hanh', 690000, 5, 0, 8023, 1, '', 0, '0', '0', 3, 1, '2021-01-20 15:57:18', '2021-02-28 16:31:12'),
(5, 'Không gia đình', 'Không gia đình (tiếng Pháp: Sans famille), còn được dịch là Vô gia đình, có thể được xem là tiểu thuyết nổi tiếng nhất của nhà văn Pháp Hector Malot, được xuất bản năm 1878. Tác phẩm đã được giải thưởng của Viện Hàn lâm Văn học Pháp. Nhiều nước trên thế giới đã dịch lại tác phẩm và xuất bản nhiều lần. Từ một trăm năm nay, Không gia đình đã trở thành quen thuộc đối với thiếu nhi Pháp và thế giới. Kiệt tác này đã được xuất hiện nhiều lần trên phim ảnh và truyền hình.', 290000, 4, 0, 99999999, 1, '', 0, '0', '0', 10, 2, '2021-01-20 15:57:18', '2023-02-18 01:39:56'),
(6, 'CHROME HEARTS x Rick Owens GEOBASKET High Cut Leather Sneakers Black', 'Condition: Pre-owned<br />\r\nShipping:FREE Standard International Shipping | See details<br />\r\nInternational shipment of items may be subject to customs processing and additional charges.  <br />\r\n <br />\r\nItem location:<br />\r\nTokyo, Japan<br />\r\n <br />\r\nShips to:<br />\r\nWorldwide See exclusions<br />\r\nDelivery:<br />\r\nEstimated between Tue. Feb. 2 and Mon. Mar. 15<br />\r\nSeller ships within 2 days after receiving cleared payment- opens in a new window or tab.  <br />\r\nPayments:<br />\r\nPayPal Visa Master Card Amex Discover<br />\r\nReturns:<br />\r\n30 day returns. Buyer pays for return shipping |  See details<br />\r\n', 75000000, 8, 0, 2, 1, '', 0, '0', '0', 9, 4, '2021-01-20 16:04:35', '2021-03-11 00:44:41'),
(7, 'Lá nằm trong lá ', 'Một sản phẩm từ Nguyễn  Nhật Ánh', 199000, 5, 0, 99999, 1, '', 0, '0', '0', 10, 2, '2021-01-20 16:22:06', '2021-02-28 16:31:24'),
(13, 'Mức gừng', 'Mức gừng đặc sản miền trung, thơm ngon,mỏng dòn,uống với nước trà nóng thật tuyệt  cùng nhau nhâm nhi những ngày tết sum vầy. Ngoài ra mức gừng giữ ấm cơ thể thật tốt cho sức khỏe nếu bạn dùng thường xuyên. 100k/ kg bạn nhé . 0909174598 - 0938114422', 100000, 3, 0, 99999999, 1, '', 0, '0', '0', 32, 2, '2021-01-20 16:36:25', '2021-02-28 16:31:27'),
(14, 'Kẹo đậu phộng', 'Kẹo đậu phộng thơm ngon ,giòn tan, ngon như ngày têt.  Dùng ăn  vặt hay làm quà  ngày tết  cho gia đình và người thân.chỉ  có 70k /kg thôi nhé   Đặt 3 kg ship miễn phí  tại Tp hcm. Mại vô mọi người.  0909174598 -0938114422.', 70000, 3, 0, 99999, 1, '', 0, '0', '0', 32, 2, '2021-01-20 16:38:15', '2021-02-28 16:34:53'),
(15, 'EM là tất cả ', 'Một sản phẩm đầy vui nhộn đầy pop punk đến từ band nhạc Đá Số Tới', 9999999999999, 3, 0, 1, 1, '', 0, '0', '0', 32, 2, '2021-01-20 16:43:08', '2021-03-11 00:49:18'),
(16, 'Cô gái đến từ hôm qua', 'Nguyễn Nhật Ánh', 199000, 2, 0, 999, 1, '', 0, '0', '0', 10, 2, '2021-01-27 17:12:36', '2021-02-28 16:34:23'),
(17, 'Cho tôi xin một vé đi tuổi thơ', 'Nguyễn Nhật Ánh', 199000, 7, 0, 999, 1, '', 0, '0', '0', 10, 2, '2021-01-27 17:14:40', '2023-02-18 01:40:04'),
(18, 'Quán gò đi lên', 'Nguyễn Nhật Ánh', 190000, 1, 0, 999, 1, '', 0, '0', '0', 10, 2, '2021-01-27 17:15:43', '2021-02-28 16:35:07'),
(20, 'Chú bé rắc rối', 'Nguyễn Nhật Ánh', 199000, 1, 0, 999, 1, '', 0, '0', '0', 10, 2, '2021-01-27 17:18:37', '2021-02-28 16:35:11'),
(21, 'Có hai con mèo ngồi bên cửa sổ', 'Nguyễn Nhật Ánh', 199000, 1, 0, 999, 1, '', 0, '0', '0', 10, 2, '2021-01-27 17:20:03', '2021-02-28 16:35:13'),
(23, 'Dầu Thơm Playboy New York Eau De Toilette 100Ml', 'Playboy New York: zesty lime top notes, a refreshing heart of green apple and a sharp vetiver base.<br />\r\nRock your style. London For Him Eau De Toilette is a gentleman\\\'s agreement of grapefruit top notes, cinnamon heart notes and a smooth base of pisco brandy., the masculine signature scent of New York For Him is as distinctive and diverse as its namesake. Size: 100ml<br />\r\nGeneral Information<br />\r\nPlayboy New York: zesty lime top notes, a refreshing heart of green apple and a sharp vetiver base.<br />\r\n<br />\r\nRock your style. London For Him Eau De Toilette is a gentleman\\\'s agreement of grapefruit top notes, cinnamon heart notes and a smooth base of pisco brandy., the masculine signature scent of New York For Him is as distinctive and diverse as its namesake.<br />\r\nSize: 100ml<br />\r\n<br />\r\nIngredients<br />\r\nALCOHOL DENAT., AQUA/WATER/EAU, PARFUM/FRAGRANCE, ETHYLHEXYL METHOXYCINNAMATE, BENZOPHENONE-3, ETHYLHEXYL SALICYLATE, CITRONELLOL, LINALOOL, BUTYL METHOXYDIBENZOYLMETHANE, COUMARIN, PROPYLENE GLYCOL, BHT, DISODIUM EDTA, ACRYLATES/OCTYLACRYLAMIDE COPOLYMER, HYDROLYZED JOJOBA ESTERS, EXT. D&C VIOLET NO. 2 (CI 60730), D&C RED NO. 33 (CI 17200), FD&C YELLOW NO. 5 (CI 19140).', 600000, 2, 0, 69696, 1, '', 0, '0', '0', 1, 4, '2021-01-29 16:13:25', '2021-03-11 00:32:46'),
(24, 'Virgil Abloh Off White x Evian Water Bottle \"Rainbow Inside\" 750 mL', 'Condition: New: A brand-new, unused, unopened, undamaged item in its original packaging <br />\r\nBrand: Evian<br />\r\nCapacity: 750 mL	<br />\r\nType: Water Bottle<br />\r\nVolume:	0.75 L<br />\r\nColor: White<br />\r\nMaterial: Glass', 1000000, 4, 0, 69, 1, '', 0, '0', '0', 16, 4, '2021-01-29 16:19:25', '2021-01-30 20:47:12'),
(25, 'Authentic CHROME HEARTS Sterling Silver 925 Pentagon CH Plus Ring', 'Brand	CHROME HEARTS<br />\r\nMaterial	Sterling Silver 925<br />\r\nSize (approx.)	#8.5 (US size)<br />\r\n#17 (Japanese size)<br />\r\nWidth: 0.43 inches (11 mm)<br />\r\nWeight	18.1 grams<br />\r\nComes with	The dust bag<br />\r\nInvoice (the personal information has been painted over)<br />\r\nSeller Notes	There are minor scratches, dents, dullness and discoloration as features of silver products.<br />\r\n<br />\r\n*Please be noted that the color of the real product is slightly different from the images depending on your device\\\'s screen display.<br />\r\n*Returns accepted. The security tag and sticker cannot be removed.<br />\r\nPlease contact us within 30 days after purchasing.', 18000000, 1, 0, 2, 1, '', 0, '0', '0', 11, 4, '2021-01-29 16:22:39', '2021-02-28 16:34:37'),
(26, 'Bánh Oreo x Supreme', 'đây là bánh, chỉ ăn và ăn', 1200000, 3, 0, 55, 1, '', 0, '0', '0', 16, 4, '2021-01-31 13:07:58', '2021-03-07 18:59:53'),
(27, 'Nick LMHT', 'ib de lay tai khoan, mat khau <br />\r\nhttps://www.facebook.com/profile.php?id=100005642176156', 700000, 25, 10, 1, 1, 'TP. Hồ Chí Minh', 1, '0', '0%', 4, 5, '2021-02-02 18:02:09', '2021-09-12 00:06:18'),
(28, 'Apple MacBook Air 13 256GB 2020 Chính Hãng Apple Việt Nam', 'Máy tính xách tay mỏng và nhẹ nhất của Apple, nay siêu mạnh mẽ với chip Apple M1. Xử lý công việc giúp bạn với CPU 8 lõi nhanh như chớp. <br />\r\n <br />\r\nTính năng nổi bật <br />\r\n•       Chip M1 do Apple thiết kế tạo ra một cú nhảy vọt về hiệu năng máy học, CPU và GPU <br />\r\n•       Tăng thời gian sử dụng với thời lượng pin lên đến 18 giờ (1) <br />\r\n•       CPU 8 lõi cho tốc độ nhanh hơn đến 3.5x, xử lý công việc nhanh chóng hơn bao giờ hết (2)  <br />\r\n•       GPU lên đến 8 lõi với tốc độ xử lý đồ họa nhanh hơn đến 5x cho các ứng dụng và game đồ họa khủng (2)  <br />\r\n•       Neural Engine 16 lõi cho công nghệ máy học hiện đại <br />\r\n•       Bộ nhớ thống nhất 8GB giúp bạn làm việc gì cũng nhanh chóng và trôi chảy  <br />\r\n•       Ổ lưu trữ SSD siêu nhanh giúp mở các ứng dụng và tập tin chỉ trong tích tắc <br />\r\n•       Thiết kế không quạt giảm tối đa tiếng ồn khi sử dụng  <br />\r\n•       Màn hình Retina 13.3 inch với dải màu rộng P3 cho hình ảnh sống động và chi tiết ấn tượng (3)<br />\r\n•       Camera FaceTime HD với bộ xử lý tín hiệu hình ảnh tiên tiến cho các cuộc gọi video đẹp hình, rõ tiếng hơn <br />\r\n•       Bộ ba micro phối hợp tập trung thu giọng nói của bạn, không thu tạp âm môi trường <br />\r\n•       Wi-Fi 6 thế hệ mới giúp kết nối nhanh hơn <br />\r\n•       Hai cổng Thunderbolt / USB 4 để sạc và kết nối phụ kiện <br />\r\n•       Bàn phím Magic Keyboard có đèn nền và Touch ID giúp mở khóa và thanh toán an toàn hơn <br />\r\n•       macOS Big Sur với thiết kế mới đầy táo bạo cùng nhiều cập nhật quan trọng cho các ứng dụng Safari, Messages và Maps <br />\r\n•       Hiện có màu vàng kim, xám bạc và bạc <br />\r\n<br />\r\nThông tin bảo hành:<br />\r\nBảo hành: 12 tháng kể từ ngày kích hoạt sản phẩm.<br />\r\nKích hoạt bảo hành tại: https://checkcoverage.apple.com/vn/en/<br />\r\n<br />\r\nHướng dẫn kiểm tra địa điểm bảo hành gần nhất:<br />\r\nBước 1: Truy cập vào đường link https://getsupport.apple.com/?caller=grl&amp;locale=en_VN <br />\r\nBước 2: Chọn sản phẩm.<br />\r\nBước 3: Điền Apple ID, nhập mật khẩu.<br />\r\nSau khi hoàn tất, hệ thống sẽ gợi ý những trung tâm bảo hành gần nhất.<br />\r\n*Lưu ý: <br />\r\n✔Mọi sản phẩm Apple được Ben bán ra đều là hàng mới 100% Nguyên Seal<br />\r\n✔Phiếu xuất kho có đầy đủ thông tin và Seri sản phẩm hỗ trợ quá trình bảo hành<br />\r\n✔Quý khách vui lòng quay video mở hộp sản phẩm làm bằng chứng giải quyết trong trường hợp xảy ra sự cố<br />\r\n✔Ben Computer không chấp nhận đổi trả với lý do chủ quan như: thay đổi màu, dung lượng,...<br />\r\n✔Hàng chính hãng được Apple phân phối qua các bên Synnex FPT, Viettel Xuất Nhập Khẩu, Digiworld và Petrosetco. Giá đã bao gồm Hóa đơn VAT.<br />\r\nT✔rường hợp sản phẩm xảy ra lỗi khách hàng được đảm bảo 100% quyền lợi theo đúng chính sách của Apple, khách hàng có thể mang qua trực tiếp qua Ben Computer hoặc Trung tâm bảo hành Apple trên toàn quốc để được hỗ trợ<br />\r\n<br />\r\nBen Computer - Thương hiệu 19 năm khách hàng tín nhiệm<br />\r\n☎ Hotline/Zalo: 0966.400.069<br />\r\n☎ Bảo hành   : 0899.179.992<br />\r\n? Website     : Ben.com.vn<br />\r\n------------<br />\r\n? Địa chỉ: Số 7 Ngõ 92 Nguyễn Khánh Toàn - Cầu Giấy - Hà Nội<br />\r\n✈ Free Ship Toàn Quốc<br />\r\n? UY TÍN LÀ SỐ 1<br />\r\n? BẢO ĐẢM HÀNG CHẤT LƯỢNG, AN TÂM TUYỆT ĐỐI<br />\r\n<br />\r\nNGUỒN:  https://shopee.vn/Apple-MacBook-Air-(2020)-M1-Chip-13.3-inch-8GB-256GB-SSD-SA-A-Hàng-Chính-Hãng-Bảo-Hành-Apple-tại-Việt-Nam-i.311276229.8814518510', 33300000, 25, 0, 3000, 1, 'Hà Nội', 0, '0', '0%', 5, 1, '2021-02-03 15:27:35', '2022-05-18 00:40:18'),
(29, 'Dép Quai Ngang POSEE PS4602 Đế Bệt Chống Trượt', 'Thời gian giao hàng dự kiến cho sản phẩm này là từ 7-9 ngày<br />\r\n  <br />\r\n  Thương hiệu: Posee<br />\r\n  Size dép: 35-36, 37-38, 39-40, 40-41, 42-43, 44-45<br />\r\n  Phong cách: Đơn giản<br />\r\n  Phân loại màu: hồng nhạt, vàng, trắng đen, đen xám<br />\r\n  Thích hợp để: Mang trong nhà<br />\r\n  Chất liệu đế: EVA<br />\r\n  Mẫu sản phẩm: PS4602<br />\r\n  Thích hợp để mang trong mùa: Mùa hè<br />\r\n  Mùa ra mắt: Mùa hè năm 2020<br />\r\n  Đối tượng sử dụng: Các cặp đôi<br />\r\n  Chất liệu lót giữa: EVA<br />\r\n  Phong cách: In họa tiết chữ<br />\r\n  Chất liệu mặt dép: EVA<br />\r\n  Độ dày bên trong: 1.5cm (đã bao gồm) - 3.5cm (không bao gồm)', 119000, 7, 0, 30, 1, '', 0, '0', '0', 9, 1, '2021-02-09 23:27:27', '2021-12-11 04:12:27'),
(32, 'Robot hút bụi lau nhà Ecovacs T5 Hero - Deebot DX96 chính hãng giá rẻ nhất new 100%', '? THÔNG TIN SẢN PHẨM:<br />\r\nNhắc đến robot hút bụi lau nhà không thể không nhắc đến robot hút bụi lau nhà Ecovacs Deebot thuộc sở hữu của Ecovacs Robotics. Thật không quá khi nói trong thị trường đầy rẫy các dòng robot hút bụi lau nhà như robot hút bụi xiaomi, robot hút bụi philips, robot hút bụi waibo, robot hút bụi lau nhà Ecovacs Deebot là tối ưu nhất và hoàn thiện nhất. Và Robot hút bụi lau nhà Ecovacs Deebot T5 HERO (DX96) hội tụ đầy đủ các tính năng ưu việt đó.<br />\r\n✔ Những điểm nổi bật của robot Ecovacs T5 Hero (Ecovacs Deebot DX96):<br />\r\n- Thực hiện đồng thời 3 chức năng: quét, hút và lau<br />\r\n- Thân máy 9cm, dễ len lỏi tại các khu vực chật hẹp, thêm bánh xe cao khoảng 10.5cm <br />\r\n- Độ ồn thấp (66dB), đảm bảo sự riêng tư cho không gian gia đình.<br />\r\n- Chế độ làm việc linh hoạt, có thể làm sạch diện tích trên 120 mét vuông.<br />\r\n- Chế độ hút bụi trên thảm được nâng cấp đặc biệt.<br />\r\n- Điều khiển qua ứng dụng điện thoại.<br />\r\n- Pin siêu khủng lên tới 5200mAh<br />\r\n- Ở chế độ auto lực hút là 1500pA, tăng lực hút robot ở chế độ MAX là 2000pA<br />\r\n- Hệ thống điều hướng Smart Navi 2.0 giúp cho robot hút bụi T5 Hero có khả năng quét 360 độ xung quanh căn nhà để vẽ bản đồ di chuyển theo kế hoạch sao cho phù hợp và hiệu quả nhất.<br />\r\n- Bộ nhớ Multimap giúp cho Robot hút bụi thông minh ghi nhớ nhiều bản đồ trong gia đình bạn.<br />\r\n- Vi điều khiển hộp nước mới giúp Ecovacs Deebot DX96 điều tiết nước thông minh hơn.<br />\r\n- Chế độ làm việc linh hoạt, robot lau nhà Ecovacs T5 Hero có thể làm sạch diện tích lên tới 350 mét vuông.<br />\r\n✔ Bộ sản phẩm gồm: Robot, 2 đôi chổi cạnh; 2 khăn lau Xanh và 5 khăn trắng 1 dock sạc, 1 bình lau ướt; 1 lọc bụi dự phòng.<br />\r\n<br />\r\nHOTLINE, 0706415678<br />\r\n<br />\r\n#robot_hút_bụi, #robothutbui, #robot_hút_bụi_lau_nhà, #robothutbuilaunha, #robot_hút_bụi_xiaomi, #robothutbuixiaomi, #robot_hút_bụi_philips, #robothutbuiphilips, #robot_hút_bụi_thông_minh, #robothutbuithongminh, #robot_hút_bụi_philip, #robot_hút_bụi_bowai, #robot_hút_bụi_ecovacs, #robothutbuiecovacs, #t5_hero, #ecovacs, #deebot_T5_hero, #ecovac_t5_hero<br />\r\n<br />\r\nNguồn: https://shopee.vn/Robot-hút-bụi-lau-nhà-Ecovacs-T5-Hero-Deebot-DX96-chính-hãng-giá-rẻ-nhất-new-100--i.201055740.4017564592', 6290000, 11, 0, 200, 1, 'Hà Nội', 1, '0', '0đ', 7, 1, '2021-02-16 01:03:46', '2021-03-11 00:44:32'),
(33, 'Máy Lọc Không Khí Sharp FP-J30E plasma diệt khuẩn , khử mùi - Bảo hành chính hãng 12 tháng', 'VUI LÒNG GỠ LỚP NILONG CỦA MÀNG LỌC TRƯỚC KHI SỬ DỤNG<br />\r\nTHÔNG TIN SẢN PHẨM:<br />\r\nKiểu dáng hiện đại<br />\r\nMáy lọc không khí Sharp FP-J30E có kiểu dáng hiện đại, tô điểm cho căn nhà trở nên sang trọng. Bên cạnh đó, máy lọc không khí còn được tích hợp thêm tính năng hẹn giờ tắt với 2 mốc thời gian là 4h và 8h. Máy còn được tích hợp thêm đèn báo thay màng lọc để giúp bạn có thể thay thế đúng thời gian nhằm đạt hiệu quả cao trong sử dụng. Với chiếc máy lọc không khí này, không gian căn phòng của bạn sẽ luôn trong lành, giúp bảo vệ sức khỏe cho chính bản thân và những người thân yêu trong gia đình.<br />\r\n<br />\r\nChế độ Haze mang lại không khí trong lành<br />\r\nVới chế độ HAZE, thiết bị tự động vận hành quạt với tốc độ cao trong 60 phút đầu tiên, sau đó hoạt động luân phiên giữa hai cấp độ thấp và cao trong vòng 20 phút, để tăng khả năng lọc khí và thải phóng Plasmacluster ion ra ngoài không khí nhằm lọc bụi bẩn và khử mùi hôi một cách hiệu quả nhất.<br />\r\n<br />\r\nMàng lọc Hepa chất lượng<br />\r\nMàng lọc của máy lọc không khí Sharp FP-J30E được trang bị màng lọc thô và Hepa dày dặn, chắc chắn và cực kỳ hiệu quả. Với các lớp màng lọc Hepa thông minh giúp máy có thể ngăn chặn gần như tuyệt đối tạp chất có trong không khí, mang đến không gian sống, làm việc trong lành và an toàn đối với con người.<br />\r\n<br />\r\nCông nghệ không khí Ion Plasma<br />\r\nKhả năng phát ion nhờ bộ phát cường độ cao vẫn là thế mạnh của dòng máy lọc không khí Sharp. Ở máy lọc không khí Sharp FP-J30E được tích hộp bộ phát Ion Plasma mật độ cao tạo ra các hạt điện tích bù vào không khí có tác dụng diệt khuẩn mạnh mẽ, tạo cảm giác thư thái, trong lành như trong các rừng cây giữa ngôi nhà của bạn.<br />\r\n<br />\r\nPhù hợp với nhiều không gian<br />\r\nMáy lọc không khí FP-J30E có công suất tiêu thụ tối đa 50W, sử dụng trong phạm vi 23m2, thế nên thiết bị hoàn toàn thích ứng và đáp ứng tốt nhu cầu lọc khí trong các hộ gia đình, văn phòng làm việc hay bệnh việ với mỗi không gian khác nhau, mức độ ô nhiễm khác nhau nhưng chất lượng không khí sau lọc bởi máy đều đảm bảo, trong lành và an toàn với sức khỏe con người.<br />\r\n<br />\r\nTHÔNG SỐ KỸ THUẬT:<br />\r\nThương hiệu	Sharp<br />\r\nXuất xứ thương hiệu	Nhật Bản<br />\r\nNơi sản xuất	Thái Lan<br />\r\nMàu sắc :  <br />\r\nFP-J30E-A : Màu xanh<br />\r\nFP-J30E-B : Màu đen<br />\r\nTrọng lượng	4kg<br />\r\nĐiện áp	220V-240V<br />\r\nKích thước: 41.1 x 43.1 x 21.1 cm (Rộng x Cao x Sâu)<br />\r\nCông suất:: 50/30/13<br />\r\nĐộ ồn:	44/36/23<br />\r\nDiện tích lọc khí: 23 m²<br />\r\nBộ lọc:	Hepa<br />\r\nKhử mùi: Có<br />\r\nKháng khuẩn: Có<br />\r\nCông nghệ Inverter: Không<br />\r\n<br />\r\nBảo hành 12 tháng , bằng phiếu bảo hành trên toàn quốc<br />\r\n<br />\r\n<br />\r\nNguồn: https://shopee.vn/Máy-Lọc-Không-Khí-Sharp-FP-J30E-plasma-diệt-khuẩn-khử-mùi-Bảo-hành-chính-hãng-12-tháng-i.4046711.6314335444', 1925000, 13, 8, 50, 1, 'TP. Hồ Chí Minh', 0, '3', '10000đ', 7, 1, '2021-02-16 01:22:23', '2023-02-18 01:39:44'),
(34, 'Túi sưởi chườm nóng lạnh giữ nhiệt mini', 'TÚI CHƯỜM NÓNG LẠNH<br />\r\n<br />\r\nTúi chườm loại mới dáng củ hành cực cưng với tông màu sáng bắt mắt cho bà con. Đang trái gió trở trời, sắm về 1 bé là tuyệt vời ông mặt trời luôn nhá bà con.<br />\r\n<br />\r\nChất nhựa an toàn, chịu nhiệt lên đến 80 độ ( nhiệt độ chườm nóng thích hợp là 40 độ để tránh bỏng nhé). Chườm nóng thích hợp để thư giãn, giảm mệt mỏi chườm cho mùa dâu các bạn gái....<br />\r\n<br />\r\nNgoài ra, miệng túi rộng nên các bạn bỏ đá vào chườm lạnh trong các trường hợp sưng, bầm cũng rất tiện nhé. Rất thích hợp cho các bạn gái đến ngày phải dùng nước nóng chườm bụng<br />\r\n<br />\r\nKích thước: 11*15cm<br />\r\n<br />\r\nĐổ nước nóng hoặc đựng đá để chườm đau bụng, bầm, bong gân, nhức tay nhức chân,.. tiện lợi lắm nhé<br />\r\n<br />\r\nNguồn: https://shopee.vn/Túi-sưởi-chườm-nóng-lạnh-giữ-nhiệt-mini-i.8797658.2898438160', 8000, 5, 0, 300, 1, 'TP. Hồ Chí Minh', 0, '10', '3000đ', 7, 1, '2021-02-16 01:27:04', '2021-11-13 01:00:34'),
(35, 'Đèn Nhấp Nháy 5m Trang Trí Nhiều Màu, Hàng Loại 1, Ánh Sáng Đẹp', 'Đèn nhấp nháy trang trí nhiều màu, hàng loại 1, ánh sáng đẹp<br />\r\n<br />\r\nĐèn có 4 loại: trắng/xanh/vàng/đổi màu<br />\r\n<br />\r\nDây dài: 5 mét<br />\r\n<br />\r\nCó bộ điều khiển nhấp nháy nhiều chế độ<br />\r\n<br />\r\nĐiện áp: 220V/50Hz<br />\r\n<br />\r\nNguồn: https://shopee.vn/Đèn-Nhấp-Nháy-5m-Trang-Trí-Nhiều-Màu-Hàng-Loại-1-Ánh-Sáng-Đẹp-i.55298205.2006420409', 25000, 6, 24, 116753, 1, 'Hà Nội', 0, '0', '0%', 6, 1, '2021-02-16 01:29:59', '2021-02-16 01:29:59'),
(36, 'Ly giữ nhiệt inox 900ml hình doraemon, kitty tặng kèm ống hút và túi vải NPP Shoptido', '- Shoptido bên Em có video sản phẩm, ảnh thật cầm trên tay cho Anh Chị dể hình dung <br />\r\n- Anh Chị lướt qua xem thêm nhiều ảnh để hiểu rỏ thêm về sản phẩm nhé !<br />\r\n<br />\r\nLưu ý: Bên shop Em vẫn sẽ giao hình doraemon và kitty đúng như A/C đặt, nhưng về hình doraemon hoặc kitty sẽ có nhiều kiểu hình khác nhau.<br />\r\n- Hình của túi đựng cũng sẽ trùng với hình ly A/C chọn nhé.<br />\r\n<br />\r\nLy giữ nhiệt combo gồm: 1 ly + 1 túi đựng + 1 bộ ống hút (gồm 2 ống hút)<br />\r\nMàu sắc: hồng và xanh<br />\r\nChất liệu: inox 304<br />\r\nDung tích: 900ml<br />\r\nNắp đậy nhựa PP an toàn trong suốt <br />\r\nPhụ kiện: kèm túi xách treo cao cấp cực đẹp và cứng cáp, ống hút kim loại sang trọng và que cọ rửa<br />\r\nKích thước: 10 x 20cm<br />\r\nLy 900 ml đựng được khoảng 3 lon bia hoặc 3 ly trà đá<br />\r\nGiữ đá 12 tiếng, có thể lên đến 24 tiếng<br />\r\nGiữ nóng 6 tiếng, có thể lên đến 12 tiếng<br />\r\nLòng cốc to vệ sinh rất dễ dàng, sạch sẽ, chắc chắn<br />\r\n<br />\r\nTính năng nổi bật:<br />\r\n-Công dụng: giữ nhiệt nóng hoặc lạnh cho thức uống (nước, sinh tố…) hoặc nước nóng. <br />\r\n-Chất liệu 3 lớp: inox 304-loại inox cao cấp, tuyệt đối an toàn cho sức khỏe người dùng. <br />\r\n-Khả năng giữ nhiệt: giữ nóng 3h (từ 90độ-40độ), giữ lạnh 3h (từ 5độ-20độ). <br />\r\n-Kiểu dáng giống cốc trà sữa đơn giản và sang trọng, cực kỳ gọn nhẹ<br />\r\n<br />\r\n<br />\r\nLưu ý khi sử dụng: <br />\r\nTrước khi sử dụng, bạn nên rửa sạch ruột cốc bằng nước rửa chén hoặc nước nóng. <br />\r\nĐể có thể đạt được hiệu quả tốt trong việc giữ nhiệt, trước khi sử dụng bạn nên cho một chút nước nóng (hoặc nước lạnh) vào trong bình trước để làm nóng (lạnh) trong khoảng 2 phút.<br />\r\n<br />\r\n#ly #giu #nhiet #kitty #doremon #doraemon<br />\r\n<br />\r\nNếu có điều gì thắc mắc, Anh Chị hảy inbox cho Shop Em nhé, Shop em sẻ giải đáp hết tất cả thắc mắc của Anh Chị 1 cách nhanh nhất<br />\r\n<br />\r\nLời cam kết của Shoptido với tất cả Khách Hàng<br />\r\n- 100% hàng hóa nguồn gốc xuất xứ rỏ ràng, chính hãng, Auth<br />\r\n- 100% Hàng thật giống hình và luôn có ảnh thật trên tay<br />\r\n- Tất cả đơn hàng của Anh Chỉ đều được đóng gói cẩn thận và Shop Em sẻ giao hàng cho bên vận chuyển nhanh nhất<br />\r\n- Đổi trả miễn phí tận nhà nếu hàng hóa lỗi do nhà sản xuất, nhà bán hàng, vận chuyển<br />\r\n- #shoptido #free #ship #50k #99k #suc #khoe #sac #dep<br />\r\n<br />\r\n<br />\r\nNguồn: https://shopee.vn/Ly-giữ-nhiệt-inox-900ml-hình-doraemon-kitty-tặng-kèm-ống-hút-và-túi-vải-NPP-Shoptido-i.8616850.2338939041', 168000, 5, 33, 800, 1, 'TP. Hồ Chí Minh', 0, '0', '0%', 6, 1, '2021-02-16 01:32:05', '2021-03-11 00:44:36'),
(37, 'Xe địa hình chất lừ 4*4 125cc 4-stroke atv - Hàng nhập khẩu', 'Dung tích xi lanh: 110cc / 125cc / 200cc / 250cc 4 cầu<br />\nĐánh lửa: CDI<br />\nHệ thống khởi động: điện<br />\nHộp số: tự động 4 stroke / air cooling<br />\nPhanh: trống / đĩa thủy lực<br />\nAbsorber:Spring-absorber<br />\nLốp xe: 16x8.0-7 / 16x8.0-7<br />\n<br />\nDung tích nhiên liệu: 4L<br />\nĐế bánh xe: 870mm<br />\n<br />\nN.W: 82kg<br />\n<br />\nG.W: 94kg<br />\n<br />\nTốc độ tối đa: 65 - 150 km/h<br />\n<br />\nKhả năng chở tối đa: 120Kgs<br />\n<br />\n<br />\nNguồn: https://shopee.vn/Xe-địa-hình-chất-lừ-4*4-125cc-4-stroke-atv-Hàng-nhập-khẩu-i.41254211.7619378699', 53000000, 41, 5, 5, 1, 'TP. Hồ Chí Minh', 0, '0', '0%', 4, 1, '2021-02-16 01:35:15', '2021-12-21 03:21:03'),
(38, '[Hàng có sẵn] Bảng vẽ điện tử gaomon GM156HD 2020', 'GOMA SHOP XIN KÍNH CHÀO QUÝ KHÁCH.<br />\r\nBạn đang xem sản phẩm bảng vẽ điện tử Gaomon GM156HD được sử dụng rộng rãi để<br />\r\n- Vẽ trên máy tính<br />\r\n- Dậy học online<br />\r\n- Ghi chú. v.v..<br />\r\n- bộ cơ bản bao gồm: 1 Máy, 1 Bút, cáp kết nối, 8 ngòi bút thay thế, cốc cắm bút.<br />\r\n<br />\r\n- bộ nâng cao bao gồm: 1 bảng vẽ 2 bút 1 bộ dây 1 cốc cắm bút, 48 ngòi dự phòng, miếng dán bảo vệ màn hình, 1 quạt tản nhiệt, 1 túi đựng, 1 khăn lau, 1 bao tay gaomon.<br />\r\n<br />\r\nKhách hàng khu vực nội thành Hà Nội mua hàng có thể chọn hình thức vận chuyển hỏa tốc Grap hoặc Nowship trong phần tanh toán để nhận được hàng trong vòng 2 tiếng.<br />\r\n<br />\r\nSản phẩm được bảo hành 12 tháng, lỗi trong vòng 7 ngày đầu sẽ được đổi mới.<br />\r\n- Trường hợp quý khách có nhu cầu sửa chữa hoặc mua thêm phụ kiện vui lòng liên hệ với shop qua:<br />\r\nSDT: 0906 25 35 45, zalo: 0906 25 35 45 Dương Nguyễn.<br />\r\n- Quý khách có quyền trả lại sản phẩm trong vòng 3 ngày nếu sản phẩm không đúng như mô tả hoặc không giống với hình ảnh trong bài viết.<br />\r\n- Trường hợp khách hàng cần thay đổi mục đích sử dụng hoặc lựa chọn sản phẩm khác vui lòng liên hệ trước với bộ phận chăm sóc khách hàng của shop.<br />\r\nMr: Nguyễn Xuân Dương<br />\r\nSĐT: 0906253545<br />\r\n- Khách hàng đóng gói sản phẩm và gửi lại về công ty theo địa chỉ:<br />\r\nGoma<br />\r\nsố 41, ngõ 72 nguyễn trãi, quan nhân, thanh xuân, hà nội.<br />\r\n<br />\r\nSAU ĐÂY LÀ THÔNG TIN VỀ SẢN PHẨM<br />\r\n<br />\r\nBảng vẽ Gaomon GM156HD là bảng vẽ có màn hình hiển thị. Độ phân giải màn hình đạt 1920x1080 (FullHD) công nghệ tấm nền IPS kích thước 15.6inches đạt góc nhìn rộng chuẩn 178 độ.<br />\r\nCảm ứng lực bút nhấn đạt 8192 cấp độ <br />\r\nKèm với 8 nút vật lý bằng nhựa mềm tạo cảm giác thoải mái khi thao tác.<br />\r\nTốc độ quét bút đạt 266 điểm/s<br />\r\nĐộ phân giải điểm ảnh đạt 5080LPI<br />\r\nTương thích với hệ thống Windows và Mac OS<br />\r\nSản phẩm bắt buộc phải sử dụng kèm với máy tính với hoạt động<br />\r\nSản phẩm này là một trong những sản phẩm đáng được sở hữu nhất trong tầm giá, nó đem lại cho người dùng sở hữu trải nghiệm vượt trội, vượt xa giới hạn gó buộc, thả hồn theo những tác phẩm tuyệt vời điều làm nên cho một người chủ sở hữu GM156HD.<br />\r\nSản phẩm có sẵn tại shop<br />\r\n<br />\r\n<br />\r\nNguồn: https://shopee.vn/-Hàng-có-sẵn-Bảng-vẽ-điện-tử-gaomon-GM156HD-2020-i.43471671.4534492600', 5400000, 16, 0, 20, 1, 'Hà Nội', 1, '0', '0%', 5, 1, '2021-02-16 01:36:58', '2021-12-11 04:12:03'),
(39, 'Quạt Kimetsu no Yaiba Thanh gươm diệt quỷ nan 31cm cầm tay in hình anime chibi 2 mặt', 'Quạt Kimetsu no Yaiba Thanh gươm diệt quỷ nan 31cm cầm tay in hình anime chibi 2 mặt<br />\r\nThích hợp làm quà tặng cho bạn bè và người thân<br />\r\nSản phẩm đang hot trên thị trường và được các bạn trẻ vô cùng yêu thích.<br />\r\nSản phẩm cập nhật theo mốt mới nhất và update thường xuyên<br />\r\nRing ngay sản phẩm về bổ sung cho bộ sưu tập của bạn nhé<br />\r\nQuà tặng đặc biệt dành cho Fan<br />\r\n#tuiqua #bookmark #hoppostcard #postcard #hopqua #lomocard #poster #sticker #standee #Madaotosu #Toukenranbu #Onepiece #DaoHaiTac #Bokunohero #19days #Oldxian #Amduongsu #Ghibli #Tokyoghoul #Miku #Sakura #Conan #IdentityV #Gintama #Kimetsunoyaiba #Naruto #Datealive #Ngoisaothoitrang #BungouStrayDogs #Vănhàolưulạc #BokunoHeroAcademia #Họcviệnanhhùng #Acquytrongnhaxi #Toilet-boundHanako-kun #Arknights #Kiminonawa #Deathnote #Attackontitan #HonkaiImpact3 #SakuraCardcaptor #SwordArtOnline #NatsumeYuujinchou #Neko  #Contimrungdong #quạt<br />\r\n<br />\r\nNguồn: https://shopee.vn/Quạt-Kimetsu-no-Yaiba-Thanh-gươm-diệt-quỷ-nan-31cm-cầm-tay-in-hình-anime-chibi-2-mặt-i.141993043.4929713692', 50000, 53, 0, 50, 1, 'Hà Nội', 0, '0', '0%', 16, 1, '2021-02-16 01:40:59', '2021-12-11 04:09:53'),
(42, 'Điện Thoại Vsmart Live 4 6GB/64GB - Hàng Chính Hãng', 'Điện Thoại Vsmart Live 4 6GB/64GB - Hàng Chính Hãng<br />\nBộ sản phẩm bao gồm: Thân máy, sạc, cáp USB, tai nghe, ốp lưng, dụng cụ lấy sim, sách hướng dẫn sử dụng.<br />\n<br />\nVSMART LIVE 4<br />\nCẤU HÌNH ĐỈNH, GIẢI TRÍ HẾT MÌNH<br />\nCPU mạnh mẽ<br />\nChipset Snapdragon 675<br />\n4 camera AI 48MP<br />\nSiêu chụp đêm <br />\nPin 5000mAh<br />\nSạc nhanh 3.0 18W<br />\nMàn hình 6.53 inch<br />\nCẤU HÌNH ĐỈNH CAO<br />\nSINH RA DÀNH CHO TÍN ĐỒ GIẢI TRÍ<br />\nĐược phát triển bởi Qualcomm nhằm phục vụ nhu cầu giải trí bất tận, Chip Snapdragon 675 đem tới trải nghiệm mượt mà cũng như giảm thiểu độ trễ, sở hữu sức mạnh hiệu năng hàng đầu phân khúc!<br />\n<br />\n5000mAh PIN KHỦNG SIÊU “TRÂU”<br />\nPin “khủng” là yếu tố tất yếu để chinh phục chuỗi “combat” đỉnh cao hay thỏa mãn đam mê “cày” phim suốt ngày dài. Thấu hiểu nỗi lòng của các tín đồ giải trí, được nâng cấp dung lượng pin lên đến 5000mAh để tạo nên trải nghiệm giải trí không gián đoạn, với thời lượng đàm thoại và giải trí lâu hơn tới 30% so với phiên bản trước.<br />\n<br />\n18W SẠC NHANH TÊN LỬA<br />\nCông nghệ sạc nhanh Quick Charge 3.0 công suất 18W sẵn sàng đồng hành cùng bạn suốt cả ngày dài xem phim hay “săn boss”, với khả năng hồi pin siêu nhanh chỉ trong 5 phút sạc. Có Vsmart Live 4, yên tâm giải trí hết mình!<br />\n<br />\nTRẢI NGHIỆM GIẢI TRÍ ĐỈNH CAO VỚI MÀN HÌNH ĐỤC LỖ 6.5”<br />\nMàn hình được mở rộng lên 6.5” với thiết kế đục lỗ tinh tế thời thượng. Từ đó tối đa hóa không gian hiển thị, đảm bảo trải nghiệm trọn vẹn cho những pha combat xuất thần hay những phân cảnh phim hành động xuất sắc.<br />\n<br />\nBỘ 4 CAMERA AI ẤN TƯỢNG<br />\nThỏa sức lưu lại những khoảnh khắc đêm huyền ảo sống động, sắc nét với camera bóng đêm 48MP. Biến mọi khung cảnh trở nên hùng vĩ, sống động hơn với camera 8MP góc rộng lên tới 1200. Chụp cận cảnh chưa bao giờ dễ hơn với camera macro 2MP. Sở hữu những bức ảnh xóa phông ấn tượng với camera xóa phông 5MP.<br />\n<br />\nXÓA PHÔNG VI DIỆU<br />\nSở hữu những bức ảnh xóa phông thu hút mọi ánh nhìn giờ đây dễ dàng hơn bao giờ hết với camera 5MP cho phép bạn tùy chỉnh mức độ xóa phông theo ý thích.<br />\nCAMERA MACRO CẬN CẢNH<br />\nVới camera macro 2MP cực đỉnh, thỏa sức sáng tạo những bức ảnh cận cảnh sắc nét như chụp bằng máy ảnh chuyên nghiệp.<br />\nCHỤP ĐÊM SIÊU SẮC NÉT<br />\nKhẩu độ f/1.79, độ phân giải vượt trội 48MP kết hợp cùng với thuật toán trí tuệ nhân tạo AI sẽ đem đến cho bạn những bức ảnh nghệ thuật đa chiều biến hóa, sắc nét từng chi tiết dù là ngày hay đêm.<br />\n<br />\nMÀU SẮC SANG TRỌNG<br />\nHơn cả một “chiến hữu\\&quot; tin cậy trong đấu trường giải trí. Tỏa sáng như một phụ kiện thời trang đẳng cấp, giúp bạn luôn giữ được thần thái lịch lãm và cá tính với bộ ba màu sắc thời thượng:<br />\n- Đen Lam Ngọc<br />\n- Xanh Lục Bảo<br />\n- Trắng Tinh Thạch<br />\n<br />\nVOS 3.0 CÔNG NGHỆ VIỆT, TRÍ TUỆ VIỆT<br />\nVOS là hệ điều hành riêng của điện thoại Vsmart, được nghiên cứu và phát triển hoàn toàn bởi đội ngũ kỹ sư Việt Nam nhằm đem tới một sản phẩm được tối ưu cả về phần cứng lẫn phần mềm. Với phiên bản VOS 3.0 mới nhất, được trang bị công nghệ bảo mật tiên tiến, cửa hàng chủ đề phong phú và bàn phím được tối ưu hóa cho từng giao diện được thiết lập - chắc chắn sẽ mang đến cho bạn trải nghiệm tiện lợi và thông minh.<br />\nĐiện Thoại Vsmart Live 4 6GB/64GB - Hàng Chính Hãng<br />\n<br />\nCảm ơn quý khách đã quan tâm đến sản phẩm bên shop, quý khách vui lòng dành ít thời gian đọc kĩ chính sách bảo hành đổi trả:<br />\n- Sản phẩm được bao test 7 ngày kể từ ngày nhận được sản phẩm và sẽ được đổi máy mới cùng model hoặc giá trị tương đương sau khi được thẩm định lỗi kĩ thuật.<br />\n- Sản phẩm lỗi kĩ thuật được xác nhận bởi trung tâm bảo hành ủy quyền chính hãng (bằng văn bản); khách hàng có thể gửi lại shop để xác nhận lỗi hoặc tới trạm bảo hành gần nhất để thẩm định lỗi.<br />\n- Sản phẩm đổi trả phải còn nguyên hiện trạng máy không trầy xước, không bể vỡ, vô nước, gãy chân sim, khung thẻ nhớ… (tất cả các tác động ngoại lực từ phía khách hàng đều TỪ CHỐI BẢO HÀNH)<br />\n- Sản phẩm đổi trả phải còn nguyên hộp trùng imei, phụ kiện kèm theo máy không trầy xước, cháy nổ, đứt dây (nếu trầy xước shop không đổi phụ kiện mới)<br />\n- Sau 7 ngày bao test, sản phẩm vẫn nhận chính sách bảo hành 18 tháng kể từ ngày kích hoạt bảo hành (khách chịu phí vận chuyển tới shop bảo hành hộ hoặc tự đến trung tâm bảo hành gần nhất để được hỗ trợ)<br />\n- Trong một số trường hợp sản phẩm đã được kích hoạt bảo hành điện tử để tham gia chương trình khuyến mãi có giá tốt cho khách hàng. Vui lòng chat với nhân viên tư vấn để được hỗ trợ thêm thông tin.<br />\n- Sản phẩm bị TỪ CHỐI BẢO HÀNH khi cháy nổ, bể vỡ, tác động ngoại lực vào thân và bên trong máy, có thay đổi sửa chữa bên ngoài.<br />\n- Các sản phẩm bị khóa tài khoản như Gmail, Samsung account… Khách tự chịu phí mở khóa nếu không nhớ mật khẩu.<br />\nĐiện Thoại Vsmart Live 4 6GB/64GB - Hàng Chính Hãng<br />\n#điện_thoại #dienthoai #di_động #didong #điện_thoại_di_động #dien_thoai_di_dong #điện_thoại_chính_hãng #hàng_chính_hãng #điện_thoại_giá_rẻ #dien_thoai_gia_re #giá rẻ #khuyen_mai #freeship #mobile #smartphone #điện_thoại_vsmart #vsmart #vsmart_ live_4<br />\n<br />\n<br />\nNguồn:  https://shopee.vn/Điện-Thoại-Vsmart-Live-4-6GB-64GB-Hàng-Chính-Hãng-i.193124085.6848952163', 4490000, 236, 17, 500, 1, 'Bến Tre', 0, '0', '0%', 2, 1, '2021-02-18 11:23:46', '2023-02-18 01:39:01'),
(51, 'Smart Tivi QLED Samsung 8K 75 inch QA75Q950T', 'Quý khách hàng mua hàng - Xin liên hệ với ĐIỆN MÁY LINH VƯƠNG - Để có giá tốt nhất thời điểm hiển tại. <br />\n- VẬN CHUYỂN LẮP ĐẶT TẠI NHÀ HÀ NỘI - Bảo hành chính hãng tại nhà toàn Quốc như siêu thị. <br />\n- HÀNG NGUYÊN ĐAI NGUYÊN KIỆN HÀNG MỚI 100%.<br />\n- SĐT TƯ VẤN MIỄN PHÍ ; 082.479.2222 / zalo .<br />\n- Web; dienmaylinhvuong.com<br />\nCảm ơn quý khách hàng đã quan tâm đến ĐIỆN MÁY LINH VƯƠNG.<br />\n---------------------------------------------<br />\nSmart Tivi QLED Samsung 8K 75 inch QA75Q950T<br />\nTrong thời đại công nghệ ngày càng được ưa chuộng như hiện nay, tivi đã trở thành người bạn vô cùng thân thiết không thể thiếu trong những gia đình Việt. Ngoài để phục vụ nhu cầu giải trí cho các thành viên trong gia đình, chiếc tivi còn có thể là điểm nhấn cho không gian nhà bạn. Trên thị trường hiện nay, những dòng tivi đời mới luôn được cập nhật liên tục, nếu như tivi Sony thu hút người dùng bởi tầm giá rộng, phục vụ đa nhu cầu thì tivi Samsung lại hấp dẫn các ánh mắt bởi vẻ ngoài tinh tế cùng chất lượng hình ảnh tuyệt hảo. <br />\n<br />\nTivi Samsung làm say đắm người bởi những tính năng nổi trội đặc biệt, hãy cùng chúng tôi tìm hiểu về chiếc Smart Tivi QLED 8K 75 inch 75Q950T đến từ thương hiệu Samsung để thấy rõ hơn điều này.<br />\n<br />\nThiết kế tinh tế, màn hình tràn viền ấn tượng<br />\nSmart Tivi QLED 8K 75 inch QA75Q950T sở hữu thiết kế hiện đại với những đường nét tinh xảo, góc vuông đẹp mắt và đặc biệt là màn hình tràn viền 99% táo bạo cho khung hình trải rộng mọi góc nhìn, người dùng có thể  tận hưởng nội dung giải trí sâu sắc, chân thật đến bất ngờ.<br />\n<br />\nTivi Samsung QLED QA75Q950T còn là điểm nhấn hoàn hảo cho những phòng có không gian rộng như: phòng khách, phòng họp, sảnh nhà hàng, khách sạn,...<br />\n<br />\nHình ảnh sắc nét gấp 4 lần 4K với độ phân giải 8K<br />\n<br />\nLuôn dẫn đầu các xu thế và thường xuyên cập nhật những công nghệ tiên tiến nhất ở những chiếc tivi của mình, chiếc Smart Tivi QLED 8K 75 inch QA75Q950T của Samsung có độ phân giải 8K là độ phân giải cao nhất hiện nay, gấp 4 lần tivi 4K và 16 lần với Full HD thông thường, mở ra kỷ nguyên chất lượng hình ảnh chân thực bạn chưa từng thấy.<br />\n<br />\nHiển thị dải màu rộng, thuần khiết với công nghệ màn hình chấm lượng tử Quantum Dot (QLED)<br />\nMàn hình chấm lượng tử là thiết bị hiển thị sử dụng các chấm lượng tử, các tinh thể nano bán dẫn có thể tạo ra ánh sáng đơn sắc đỏ, lục và lam. Công nghệ này có thể khiến người dùng trầm trồ thưởng thức những hình ảnh mang độ tương phản cao, hiển thị rõ ràng gần như tuyệt đối các dải màu, mang đến cho bạn một trải nghiệm xem sống động, chân thực như đang diễn ra trước mắt.<br />\n<br />\nTối ưu hóa độ tương phản, cho hình ảnh chi tiết hơn với công nghệ Quantum HDR 4000 nits<br />\n<br />\nCông nghệ Quantum HDR 4000 nits trong đó nits là đơn vị đo ánh sáng màn hình, có thể hoàn toàn tối ưu hóa dải tương phản HDR theo mỗi phân cảnh khác nhau, tái hiện tỉ mỉ từng chi tiết nhỏ nhất và tạo nên chất lượng hình ảnh đỉnh cao theo đúng ý từ nhà sản xuất.<br />\n#muativiSamsung #tivisamsung #muativi #muaTiviQLEDSamsung8K75inchQA75Q950t #tivi75Q950t<br />\n<br />\nNGUỒN: https://bit.ly/30Rn2yV', 119000000, 8, 0, 10, 1, 'TP. Hồ Chí Minh', 0, '1', '10%', 3, 10, '2021-03-17 13:52:52', '2022-11-07 02:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `spcart`
--

CREATE TABLE `spcart` (
  `id` int(255) NOT NULL,
  `score` tinyint(5) NOT NULL DEFAULT 0,
  `evaluate` text CHARACTER SET utf8mb4 COLLATE  utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(255) NOT NULL,
  `typepid` text COLLATE  utf8mb4_unicode_ci NOT NULL,
  `store_id` int(255) NOT NULL,
  `coupon_id` int(255) NOT NULL DEFAULT 0,
  `amount` int(255) NOT NULL,
  `price` bigint(255) NOT NULL,
  `address_id` int(255) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `status` tinyint(10) NOT NULL,
  `description` varchar(100) COLLATE  utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spcart`
--

INSERT INTO `spcart` (`id`, `score`, `evaluate`, `product_id`, `typepid`, `store_id`, `coupon_id`, `amount`, `price`, `address_id`, `user_id`, `status`, `description`, `created_at`, `updated_at`) VALUES
(39, 0, NULL, 29, '0', 1, 0, 3, 119000, 22, 21, 5, '', '2020-01-23 16:50:32', '2020-01-23 19:00:02'),
(40, 0, NULL, 6, '0', 4, 0, 1, 75000000, 22, 21, 5, '', '2020-02-23 19:00:03', '2020-02-23 19:00:03'),
(41, 0, NULL, 28, '0', 1, 0, 1, 33300000, 21, 20, 5, '', '2020-02-23 19:00:09', '2020-02-23 19:00:09'),
(42, 0, NULL, 38, '0', 1, 0, 1, 5400000, 20, 19, 5, '', '2020-02-23 19:00:15', '2020-02-23 19:00:15'),
(43, 0, NULL, 28, '0', 1, 0, 1, 33300000, 20, 19, 5, '', '2020-03-23 19:00:15', '2020-03-23 19:00:15'),
(44, 0, NULL, 32, '0', 1, 0, 5, 6290000, 19, 18, 5, '', '2020-03-23 19:00:20', '2020-03-23 19:00:20'),
(45, 0, NULL, 14, '0', 2, 0, 10, 70000, 18, 17, 5, '', '2020-04-23 19:00:26', '2020-04-23 19:00:26'),
(46, 0, NULL, 24, '0', 4, 0, 2, 1000000, 18, 17, 5, '', '2020-04-23 19:00:25', '2020-04-23 19:00:25'),
(47, 0, NULL, 6, '0', 4, 0, 1, 75000000, 17, 16, 5, '', '2020-04-23 19:00:31', '2020-04-23 19:00:31'),
(48, 0, NULL, 39, '0', 1, 0, 3, 50000, 16, 15, 5, '', '2020-05-24 16:23:49', '2020-05-24 16:23:49'),
(49, 0, NULL, 38, '0', 1, 0, 1, 5400000, 16, 15, 5, '', '2020-05-24 16:23:49', '2020-05-24 16:23:49'),
(50, 0, NULL, 37, '0', 1, 0, 2, 52000000, 16, 15, 5, '', '2020-06-24 16:23:49', '2020-06-24 16:23:49'),
(51, 0, NULL, 36, '0', 1, 0, 5, 112560, 16, 15, 5, '', '2020-06-24 16:23:49', '2020-06-24 16:23:49'),
(52, 0, NULL, 35, '0', 1, 0, 14, 19000, 16, 15, 5, '', '2020-07-24 16:23:49', '2020-07-24 16:23:49'),
(53, 0, NULL, 34, '0', 1, 0, 5, 8000, 16, 15, 5, '', '2020-08-24 16:23:49', '2020-08-24 16:23:49'),
(54, 0, NULL, 33, '0', 1, 0, 4, 1771000, 16, 15, 5, '', '2020-08-24 16:23:49', '2020-08-24 16:23:49'),
(55, 0, NULL, 32, '0', 1, 0, 4, 6290000, 16, 15, 5, '', '2020-08-24 16:23:49', '2020-08-24 10:48:31'),
(56, 0, NULL, 29, '0', 1, 0, 2, 119000, 16, 15, 5, '', '2020-09-24 16:23:49', '2020-09-24 16:23:49'),
(57, 0, NULL, 28, '0', 1, 0, 3, 33300000, 16, 15, 5, '', '2020-09-24 16:23:49', '2020-09-24 16:23:49'),
(58, 0, NULL, 27, '0', 5, 0, 1, 630000, 16, 15, 5, '', '2020-09-24 16:23:49', '2020-09-24 16:23:49'),
(59, 0, NULL, 26, '0', 4, 0, 5, 1200000, 16, 15, 5, '', '2020-09-24 16:23:49', '2020-09-24 16:23:49'),
(60, 0, NULL, 25, '0', 4, 0, 1, 18000000, 16, 15, 5, '', '2020-10-24 16:23:49', '2020-10-24 16:23:49'),
(61, 0, NULL, 24, '0', 4, 0, 10, 1000000, 16, 15, 5, '', '2020-10-24 16:23:49', '2020-10-24 16:23:49'),
(62, 0, NULL, 23, '0', 4, 0, 14, 600000, 16, 15, 5, '', '2020-10-24 16:23:49', '2020-10-24 16:23:49'),
(63, 0, NULL, 21, '0', 2, 0, 1, 199000, 16, 15, 5, '', '2020-11-01 10:42:35', '2020-11-02 16:23:49'),
(64, 0, NULL, 20, '0', 2, 0, 1, 199000, 16, 15, 5, '', '2020-11-14 16:23:49', '2020-11-15 16:23:49'),
(65, 0, NULL, 18, '0', 2, 0, 1, 190000, 16, 15, 5, '', '2020-11-23 16:23:49', '2020-11-24 16:23:49'),
(66, 0, NULL, 17, '0', 2, 0, 1, 199000, 16, 15, 5, '', '2020-12-22 16:23:49', '2020-12-24 16:23:49'),
(67, 0, NULL, 16, '0', 2, 0, 1, 199000, 16, 15, 5, '', '2021-01-15 16:23:49', '2021-01-16 16:23:49'),
(68, 0, NULL, 14, '0', 2, 0, 1, 70000, 16, 15, 5, '', '2021-01-22 16:23:49', '2021-01-24 16:23:49'),
(69, 0, NULL, 13, '0', 2, 0, 6, 100000, 16, 15, 5, '', '2021-01-22 16:23:49', '2021-01-24 16:23:49'),
(70, 0, NULL, 7, '0', 2, 0, 1, 199000, 16, 15, 5, '', '2021-02-22 16:23:49', '2021-02-24 16:23:49'),
(71, 0, NULL, 6, '0', 4, 0, 1, 75000000, 16, 15, 5, '', '2021-02-22 16:23:49', '2021-02-24 16:23:49'),
(72, 0, NULL, 2, '0', 1, 0, 2, 690000, 16, 15, 5, '', '2021-02-22 16:23:49', '2021-02-24 16:23:49'),
(73, 0, NULL, 3, '0', 1, 0, 1, 690000, 16, 15, 5, '', '2021-02-22 16:23:49', '2021-02-24 16:23:49'),
(74, 0, NULL, 5, '0', 2, 0, 1, 290000, 16, 15, 5, '', '2021-02-22 16:23:49', '2021-02-24 16:23:49'),
(90, 0, NULL, 6, '0', 4, 3, 1, 75000000, 13, 1, 0, 'Hết hàng', '2021-02-22 07:58:41', '2021-02-27 20:59:29'),
(91, 5, 'Giao h&agrave;ng nhanh<br />\nSản phẩm đ&uacute;ng m&ocirc; tả', 42, '9', 1, 0, 1, 3726700, 13, 1, 10, '', '2021-02-22 18:21:17', '2021-02-23 18:21:17'),
(92, 0, NULL, 42, '10', 1, 0, 1, 3726700, 24, 1, 5, '', '2021-02-22 09:41:26', '2021-02-27 20:58:38'),
(93, 0, NULL, 15, '0', 2, 0, 1, 9999999999999, 30, 24, 0, '', '2021-02-26 16:37:48', '2021-02-26 16:37:48'),
(94, 0, NULL, 38, '0', 1, 0, 1, 5400000, 30, 24, 5, '', '2021-02-26 16:39:42', '2021-02-26 16:52:34'),
(96, 0, NULL, 42, '9', 1, 3, 1, 3726700, 24, 1, 2, '', '2021-02-27 13:40:44', '2021-02-27 21:23:06'),
(97, 0, NULL, 39, '0', 1, 0, 1, 50000, 24, 1, 2, '', '2021-02-27 14:00:38', '2021-02-27 21:23:06'),
(98, 0, NULL, 27, '0', 5, 4, 1, 630000, 13, 1, 2, '', '2021-03-04 00:43:44', '2021-03-04 00:52:42'),
(119, 0, NULL, 33, '0', 1, 6, 1, 1771000, 34, 26, 2, '', '2021-03-11 00:50:13', '2021-03-11 01:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(255) NOT NULL,
  `name` varchar(100) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `icon` int(255) NOT NULL DEFAULT 0,
  `cover` int(255) NOT NULL DEFAULT 0,
  `address_id` int(255) NOT NULL,
  `follow` int(10) UNSIGNED NOT NULL,
  `actived` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `icon`, `cover`, `address_id`, `follow`, `actived`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'NghienDo', 45, 46, 2, 0, 1, 1, '2021-02-06 14:32:06', '2021-02-11 17:31:37'),
(2, 'Neto', 76, 75, 0, 0, 1, 4, '2021-02-07 11:38:52', '2021-02-10 19:40:45'),
(3, 'Lâm Gia', 67, 0, 0, 0, 1, 6, '2021-02-09 23:24:42', '2021-02-16 01:43:56'),
(4, 'Meow Meow Meow', 77, 78, 0, 0, 1, 8, '2021-02-10 19:41:35', '2021-02-10 19:41:35'),
(5, 'tmqluyun', 0, 0, 0, 0, 1, 9, '2021-02-10 19:44:04', '2021-02-10 19:44:04'),
(9, 'Văn Anh', 0, 0, 29, 0, 0, 23, '2021-02-21 17:16:51', '2022-03-19 16:37:53'),
(10, 'meo meo', 79, 0, 31, 0, 1, 24, '2021-02-26 16:43:47', '2021-03-10 23:52:28'),
(11, 'Test123', 0, 0, 33, 0, 1, 25, '2021-02-27 20:56:07', '2021-03-10 23:52:28'),
(12, '12312312', 0, 0, 35, 0, 1, 26, '2021-03-11 01:32:10', '2021-03-11 01:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(1) NOT NULL,
  `name` varchar(50) COLLATE  utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE  utf8mb4_unicode_ci NOT NULL,
  `view` text COLLATE  utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE  utf8mb4_unicode_ci NOT NULL,
  `nbp` varchar(10) COLLATE  utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` int(255) DEFAULT NULL,
  `poster` int(255) DEFAULT NULL,
  `ship` mediumint(255) DEFAULT NULL,
  `actived` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `name`, `description`, `view`, `email`, `nbp`, `favicon`, `poster`, `ship`, `actived`, `created_at`, `updated_at`) VALUES
(1, '2HK Shop', 'Mua Sắm trực tuyến đồ Điện tử, Điện Lạnh, Công Nghệ, gia dụng, thực phẩm giá tốt mỗi ngày. Cam kết hàng chính hãng giá cạnh tranh, giao nhanh trong ngày, giảm giá siêu rẻ, Mua ngay! Giao Hàng Toàn Quốc Nhanh. Mua Ngay Để Được Ưu Đãi.', '0', 'support2hk@2hkinformatics.com', '0000000000', 0, 0, 60000, 1, '2021-01-28 03:08:27', '2021-03-18 01:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `types_of_products`
--

CREATE TABLE `types_of_products` (
  `id` int(255) NOT NULL,
  `name` varchar(30) COLLATE  utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE  utf8mb4_unicode_ci DEFAULT NULL,
  `price` text COLLATE  utf8mb4_unicode_ci NOT NULL,
  `product_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types_of_products`
--

INSERT INTO `types_of_products` (`id`, `name`, `type`, `price`, `product_id`) VALUES
(9, 'Màu Sắc', ' Black/Đen Lam Ngọc', '4490000', 42),
(10, 'Màu Sắc', 'E Blue/Xanh Lục Bảo', '4490000', 42),
(11, 'Màu Sắc', 'White/Trắng T Thạch Số Lượng', '4490000', 42),
(32, 'Dung Tích', '110CC', '23000000', 37),
(33, 'Dung Tích', '125CC', '30000000', 37),
(34, 'Dung Tích', '150CC - 4 Cầu', '34000000', 37),
(35, 'Dung Tích', '200CC - 4 Cầu', '43000000', 37),
(36, 'Dung Tích', '250CC - 4 Cầu', '52000000', 37);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `surname` varchar(100) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE  utf8mb4_unicode_ci NOT NULL,
  `nbp` varchar(10) COLLATE  utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE  utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `dob` date NOT NULL,
  `permission` tinyint(5) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `password`, `nbp`, `email`, `gender`, `dob`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Trọng Đăng', 'Khoa', 'd2c54b5ef7bc089f395e376ab4f11032', '093824344', 'hp09.com@gmail.com', 0, '2003-05-15', 5, '2020-01-07 08:46:24', '2023-03-23 22:41:58'),
(4, 'Neto', 'Huy', '91f91a83ba84c9e3c85fdf7ce13de520', '0931544642', 'caubesieiquay222@gmail.com', 0, '2003-10-06', 5, '2020-01-14 15:53:34', '2021-01-28 08:20:22'),
(6, 'Lâm Gia', 'Khang', '0cc175b9c0f1b6a831c399e269772661', '0904039745', 'Giakhang9745@gmail.com', 0, '2003-01-01', 5, '2020-01-15 17:57:25', '2021-02-28 16:00:53'),
(7, 'Tran', 'Hoa', 'f8ee3da5b30a5534053363995beb6b15', '0000000000', 'tinhoc5@tkn.edu.vn', 1, '1999-01-01', 5, '2020-01-18 16:11:55', '2021-03-18 13:52:25'),
(8, 'Nguyễn', 'Hoàng Huy', '41791b738cea4e4a6c75e7e06614c8b9', '0909326188', 'nhhuy130@gmail.com', 0, '2003-08-13', 5, '2020-01-20 15:41:11', '2021-02-26 16:52:13'),
(9, 'Truong', 'Quang', '6de6b656bce0bd351583d6147a4dbc5c', '0942543079', 'heropanda91@gmail.com', 0, '2003-01-26', 5, '2020-02-02 17:52:21', '2021-02-03 00:52:45'),
(13, 'Nguyễn Văn', 'An', 'b9d53d8ab14d18b1e7147ef832fdd1bb', '0902819923', 'nguyenvanan@gmail.com', 0, '1988-01-01', 1, '2020-03-12 20:54:20', '2021-02-12 20:54:20'),
(14, 'Nguyễn Văn', 'Bính', '8cfd26e7161b75586f17fb7a3fc6ad59', '0902819925', 'nguyenvanbinh@gmail.com', 0, '1989-03-15', 1, '2020-03-12 21:19:36', '2021-02-12 21:19:36'),
(15, 'Nguyễn Văn', 'Canh', '1dd882eebb83b2eb9b96c5c13e61589e', '0902819928', 'nguyenvancanh@gmail.com', 0, '1989-03-15', 1, '2020-04-12 21:20:15', '2021-02-16 02:28:07'),
(16, 'Nguyễn Văn', 'Danh', 'dd50d617d0b0f9bb65c13c2bc9f90587', '0902819912', 'nguyenvandanh@gmail.com', 0, '1989-03-15', 1, '2020-05-12 21:20:41', '2021-02-16 02:27:40'),
(17, 'Nguyễn Văn', 'Hoàng', 'd62deb691a65655b3d527a718591c82d', '0902819913', 'nguyenvanhoang@gmail.com', 0, '1989-03-15', 1, '2020-06-12 21:21:46', '2021-02-16 02:27:07'),
(18, 'Nguyễn Văn Toàn', 'Hoàng', '26a380f0845cb159840cf0eb3e80cc4c', '0902819914', 'nguyenvantoanhoang@gmail.com', 0, '1989-03-15', 1, '2020-07-12 21:23:33', '2021-02-16 02:26:41'),
(19, 'Nguyễn Văn', 'Toàn', '5acf3f6232858dab69e318704fe9029c', '0902819915', 'nguyenvantoan@gmail.com', 0, '1999-09-23', 1, '2020-08-12 21:24:25', '2021-02-16 02:26:06'),
(20, 'Nguyễn Văn', 'Hài', '8f0ec3f4fbcc73e1c50a93fedfb43cb2', '0902819916', 'nguyenvanhai@gmail.com', 0, '1998-12-23', 1, '2020-09-12 21:24:56', '2021-02-16 02:23:19'),
(21, 'Nguyễn Văn', 'Phúc', '40cf1bd3872a5bf24623879440023a1b', '0902819917', 'nguyenvanphuc@gmail.com', 0, '1994-02-23', 1, '2020-10-12 21:25:22', '2021-02-16 02:22:28'),
(22, 'Nguyễn Thị', 'Thị', '9fefa0562ace896995506e7b033ecaf2', '0902819918', 'nguyenthithi@gmail.com', 1, '2004-06-29', 1, '2020-11-12 21:26:12', '2021-02-16 02:21:37'),
(23, 'Mai Văn', 'Anh', '5692ffc870ca8a0eb7d030c29346e9a0', '0908743881', 'maivananh003@gmail.com', 1, '1990-09-13', 3, '2020-12-21 16:35:45', '2021-02-28 16:01:08'),
(24, 'meow', 'meow', '57b135cbd4d195d7c80dcb8653625abb', '0123456789', 'nhhuy13082003@gmail.com', 0, '2000-12-12', 3, '2021-02-26 16:37:11', '2021-03-17 20:37:39'),
(25, 'Hi', 'Lô', '202cb962ac59075b964b07152d234b70', '0938928066', 'test@gmail.com', 0, '2000-05-15', 3, '2021-02-27 20:53:52', '2021-02-27 20:56:07'),
(26, 'test', 'test', '202cb962ac59075b964b07152d234b70', '0938928062', 'test@test.com', 0, '2003-05-15', 3, '2021-03-11 00:28:03', '2021-03-11 01:32:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`,`user_id`);

--
-- Indexes for table `lstcoupon`
--
ALTER TABLE `lstcoupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lstfollow`
--
ALTER TABLE `lstfollow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`category_id`);

--
-- Indexes for table `spcart`
--
ALTER TABLE `spcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types_of_products`
--
ALTER TABLE `types_of_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `lstcoupon`
--
ALTER TABLE `lstcoupon`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lstfollow`
--
ALTER TABLE `lstfollow`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `spcart`
--
ALTER TABLE `spcart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  

--
-- AUTO_INCREMENT for table `types_of_products`
--
ALTER TABLE `types_of_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
