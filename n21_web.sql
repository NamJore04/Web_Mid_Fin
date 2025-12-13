-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 26, 2024 lúc 11:11 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `n21_web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL DEFAULT 'employee',
  `activated` bit(1) DEFAULT b'0',
  `locked` bit(1) NOT NULL DEFAULT b'0',
  `activate_token` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `firstname`, `lastname`, `email`, `password`, `role`, `activated`, `locked`, `activate_token`, `created_at`) VALUES
('admin', 'Huynh', 'Nam', 'namhuynhfree@gmail.com', '$2y$10$ISazLV1f0ePm2YF67GivmehOnL08toO3Y2MFZxzT0G/GZ/6gIMdUq', 'admin', b'1', b'0', '300535c734cd18a6282573dad7495c38', NULL),
('caochinhlam', 'Cao', 'Lam', 'caochinhlam@gmail.com', '$2y$10$v8xYqatkHmAYmOzMRBCJDe2laU/DgrUnuGkKO1syKh9UDxNfbzRam', 'employee', b'0', b'0', '8931f4d752d3b666d8185836d74570d9', 1716630297),
('kimthiet', 'Kim', 'Thiết', 'kimthiet44@gmail.com', '$2y$10$CwauO2tgZSbKfjEtSVgsgOmK5woJmjDtgahcALe8rpsw48yALewzq', 'employee', b'1', b'0', 'fa49c9e4c8ddac9564180cc9d0abd46c', 1716177253),
('triminhan471999', 'Trị', 'An', 'triminhan471999@gmail.com', '$2y$10$K6.uYAocvhuCLOC0li/JKOY0/OpWcUgwPBZNU2f4/Wu3FNWl5GLiO', 'employee', b'1', b'0', '9bde214a6439f3b010a3cf9928a349ac', 1716632558);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`customer_id`, `phone_number`, `full_name`, `address`) VALUES
(1, '0376985763', 'Huynh Hoai Nam', 'Tien Giang'),
(11, '0999999999', 'Tri Minh An', 'Long Xuyen'),
(12, '0323043345', 'Minh Chien', 'Ho Chi Minh'),
(14, '0862030929', 'Le Hong Quang', 'Dong Nai'),
(17, '7678765343', 'Long Ly', 'Dong Nai'),
(18, '0705744599', 'Nguyen Trang', 'Tien Giang'),
(19, '53544534', 'Huỳnh Hoài Nam', 'fdsfds');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `info_page`
--

CREATE TABLE `info_page` (
  `id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `info_page`
--

INSERT INTO `info_page` (`id`, `dob`, `phone`, `username`, `img`) VALUES
(1, '2004-06-22', '0376985763', 'admin', 'uploads/avatar_admin.png'),
(17, '2024-05-01', '0129210101', 'kimthiet', 'uploads/avatar_kimthiet.png'),
(21, '2024-05-08', '0383649206', 'caochinhlam', 'uploads/avatar_caochinhlam.png'),
(23, '0000-00-00', '', 'triminhan471999', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_order` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `is_order`) VALUES
(139, 1, '2024-05-16 14:26:44', 0),
(140, 12, '2024-05-16 14:27:10', 0),
(141, 1, '2024-05-16 14:29:01', 0),
(142, 1, '2024-05-17 05:52:54', 0),
(143, 1, '2024-05-17 05:57:01', 0),
(144, 1, '2024-05-17 06:07:29', 0),
(145, 12, '2024-05-17 06:09:14', 0),
(148, 12, '2024-05-17 07:14:27', 0),
(149, 12, '2024-05-17 07:15:43', 0),
(151, 1, '2024-05-17 11:04:30', 0),
(152, 14, '2024-05-17 15:11:54', 0),
(153, 14, '2024-05-17 15:14:37', 0),
(154, 14, '2024-05-17 15:15:42', 0),
(155, 14, '2024-05-19 02:43:41', 0),
(156, 12, '2024-05-19 02:56:29', 0),
(157, 12, '2024-05-19 02:56:46', 0),
(158, 1, '2024-05-19 06:43:17', 0),
(159, 11, '2024-05-19 08:24:44', 0),
(160, 14, '2024-05-19 08:37:45', 0),
(162, 1, '2024-05-19 08:47:00', 0),
(164, 17, '2024-05-19 08:54:37', 0),
(165, 1, '2024-05-19 09:03:21', 0),
(166, 11, '2024-05-19 09:20:04', 0),
(167, 1, '2024-05-19 09:23:23', 0),
(168, 1, '2024-05-19 09:25:57', 0),
(169, 12, '2024-05-19 09:28:04', 0),
(170, 1, '2024-05-19 09:28:39', 0),
(171, 14, '2024-05-19 13:02:36', 0),
(172, 18, '2024-05-19 15:36:59', 1),
(173, 18, '2024-05-19 15:37:37', 0),
(174, 12, '2024-05-19 15:39:39', 0),
(175, 11, '2024-05-19 15:41:38', 0),
(176, 11, '2024-05-19 15:43:41', 0),
(177, 11, '2024-05-20 11:16:22', 0),
(178, 19, '2024-05-20 12:02:02', 0),
(179, 1, '2024-05-20 12:09:13', 1),
(180, 1, '2024-05-24 10:49:14', 0),
(181, 12, '2024-05-24 10:51:08', 0),
(182, 12, '2024-05-24 10:58:29', 1),
(183, 12, '2024-05-24 11:19:00', 0),
(184, 12, '2024-05-24 11:26:21', 0),
(185, 12, '2024-05-24 11:35:11', 0),
(186, 12, '2024-05-24 11:36:57', 1),
(187, 12, '2024-05-24 11:37:38', 0),
(188, 14, '2024-05-24 11:39:56', 1),
(189, 12, '2024-05-24 11:45:38', 1),
(190, 12, '2024-05-24 11:48:11', 1),
(191, 12, '2024-05-24 11:52:13', 0),
(192, 12, '2024-05-24 12:55:34', 1),
(193, 1, '2024-05-24 12:55:56', 1),
(194, 12, '2024-05-24 12:56:24', 0),
(195, 12, '2024-05-24 12:59:28', 1),
(196, 12, '2024-05-24 13:00:05', 1),
(197, 12, '2024-05-24 13:00:55', 1),
(198, 12, '2024-05-24 13:01:54', 1),
(199, 12, '2024-05-24 13:02:19', 0),
(200, 14, '2024-05-24 13:04:44', 1),
(201, 12, '2024-05-24 13:05:14', 1),
(202, 12, '2024-05-24 13:06:28', 0),
(203, 1, '2024-05-24 13:06:44', 0),
(204, 17, '2024-05-24 13:07:01', 0),
(205, 1, '2024-05-24 13:07:21', 1),
(206, 1, '2024-05-24 13:08:38', 1),
(207, 17, '2024-05-24 13:15:03', 1),
(208, 12, '2024-05-24 13:39:50', 1),
(209, 14, '2024-05-24 13:40:18', 0),
(210, 1, '2024-05-24 13:52:06', 0),
(211, 12, '2024-05-24 14:10:36', 1),
(212, 12, '2024-05-24 14:12:28', 1),
(213, 12, '2024-05-24 14:25:47', 0),
(214, 1, '2024-05-24 15:12:52', 1),
(215, 12, '2024-05-24 15:13:13', 1),
(216, 1, '2024-05-24 15:13:29', 1),
(217, 1, '2024-05-24 15:14:06', 1),
(218, 12, '2024-05-25 07:44:30', 1),
(219, 1, '2024-05-25 07:45:01', 1),
(220, 12, '2024-05-25 07:45:19', 1),
(221, 1, '2024-05-25 08:00:33', 1),
(222, 12, '2024-05-25 08:04:14', 0),
(223, 14, '2024-05-25 08:04:33', 0),
(224, 12, '2024-05-25 08:14:42', 1),
(225, 12, '2024-05-25 08:15:56', 0),
(226, 12, '2024-05-25 08:17:16', 1),
(227, 1, '2024-05-25 08:17:31', 0),
(228, 1, '2024-05-25 10:27:47', 1),
(229, 1, '2024-05-25 10:51:18', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_summary`
--

CREATE TABLE `order_summary` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_detail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchase_history`
--

CREATE TABLE `purchase_history` (
  `purchase_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `cartegory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `cartegory_id`) VALUES
(2, 'iPhone 15 series', 23),
(3, 'Facebook', 30),
(6, 'Samsung Galaxy A', 25),
(7, 'Giảm giá nhân dịp...', 29),
(10, 'Facebook', 31),
(11, 'Xiaomi Redmi', 28),
(12, 'Xiaomi POCO', 28),
(13, 'iPhone 14 series', 23),
(14, 'Samsung Galaxy Note', 25);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cartegory`
--

CREATE TABLE `tbl_cartegory` (
  `cartegory_name` varchar(255) NOT NULL,
  `cartegory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cartegory`
--

INSERT INTO `tbl_cartegory` (`cartegory_name`, `cartegory_id`) VALUES
('IPHONE', 23),
('SAM SUNG', 25),
('XIAOMI', 28),
('NOKIA', 29),
('Kết Nối', 30),
('GOOGLE PIXEL', 33),
('ROG', 34);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_employees`
--

CREATE TABLE `tbl_employees` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_employees`
--

INSERT INTO `tbl_employees` (`employee_id`, `employee_name`, `employee_email`, `token`, `activated`) VALUES
(1, 'Hoài Nam', 'namhuynhfree@gmail.com', 'd18fe685f881d13d48a7fe8f38418432', 0),
(2, 'Hoài Nam', 'namhuynhfree@gmail.com', '98ab9d192c6592f0b9b989ff9954efdb', 0),
(3, 'Hoài Nam', 'namhuynhfree@gmail.com', 'c8b6f11e738d590089881de431754505', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `cartegory_id` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_price_new` decimal(10,2) NOT NULL,
  `product_desc` varchar(5000) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `order_quantity` int(11) NOT NULL DEFAULT 0,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `barcode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `cartegory_id`, `product_price`, `product_price_new`, `product_desc`, `product_img`, `order_quantity`, `creation_date`, `barcode`) VALUES
(49, 'Samsung Galaxy S24 Ultra 12GB 256GB', 28, 33990000.00, 26890000.00, '<p>Mở khoá giới hạn tiềm năng với AI - Hỗ trợ phiên dịch cuộc gọi, khoanh vùng tìm kiếm, Trợ lí Note và chình sửa anh</p>', 'Samsung Galaxy S24 Ultra 12GB 256GB.jpg', 0, '2024-05-04 14:35:12', '7956783032'),
(50, 'iPhone 15 128GB', 23, 22990000.00, 19290000.00, '<p>6.1 inch, OLED, Super Retina XDR, 2556 x 1179 Pixels</p>', 'iPhone 15 128GB.jpg', 0, '2024-05-04 14:35:12', '3226566656'),
(53, 'Xiaomi Mi 14', 28, 22990000.00, 20990000.00, '                <p>Mạnh mẽ cân mọi tác vụ, đa nhiệm cực đỉnh - Chip Snapdragon 8 Gen 3 (4nm) mượt mà đi kèm RAM 12GB</p>            ', 'mi14_demo.jpg', 0, '2024-05-04 15:02:42', '9262484461'),
(55, 'Nokia C32 4GB 128GB', 29, 2390000.00, 3290000.00, '<p>Dung lượng pin 5050mAh cùng công nghệ tiết kiệm pin AI cho thời gian sử dụng đến 3 ngày</p>', 'Nokia C32 4GB 128GB.jpg', 0, '2024-05-06 10:14:53', '8632722613'),
(59, 'Rog 8', 34, 22990000.00, 21900000.00, '                                <p>Hàng chính hãng</p>                        ', 'rogphone-8-demo.jpg', 0, '2024-05-20 10:53:15', '5376159957'),
(71, 'Google-Pixel-8-Pro-SonPixel', 33, 22990000.00, 20990000.00, '<p>demo</p>', 'Google-Pixel-8-Pro-SonPixel.jpg', 0, '2024-05-24 14:06:00', '8982632227'),
(74, 'Frieren', 33, 22990000.00, 20990000.00, '<p>demo</p>', 'avatar_caochinhlam.png', 0, '2024-05-25 10:47:16', '4942968930');

--
-- Bẫy `tbl_product`
--
DELIMITER $$
CREATE TRIGGER `before_insert_products` BEFORE INSERT ON `tbl_product` FOR EACH ROW BEGIN
    DECLARE barcode_generated VARCHAR(255);
   
    SET barcode_generated = LPAD(FLOOR(RAND() * 10000000000), 10, '0');
    
    WHILE EXISTS (SELECT 1 FROM tbl_product WHERE barcode = barcode_generated) DO
        SET barcode_generated = LPAD(FLOOR(RAND() * 10000000000), 10, '0');
    END WHILE;
    
    SET NEW.barcode = barcode_generated;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product_img_desc`
--

CREATE TABLE `tbl_product_img_desc` (
  `product_id` int(11) NOT NULL,
  `product_img_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product_img_desc`
--

INSERT INTO `tbl_product_img_desc` (`product_id`, `product_img_desc`) VALUES
(49, 'mimix2.jpg'),
(50, 'test.png'),
(53, 'mi144.jpg'),
(55, 'Nokia C32 4GB 128GB_desc.jpg'),
(59, 'rogphone-8-demo.jpg'),
(71, 'GG-Pixel-8-Pro_demo.jpg'),
(74, 'avatar_trian.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slide`
--

CREATE TABLE `tbl_slide` (
  `slide_id` int(11) NOT NULL,
  `slide_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_slide`
--

INSERT INTO `tbl_slide` (`slide_id`, `slide_name`) VALUES
(12, 'upload_slide/slide1.png'),
(13, 'upload_slide/slide1.png'),
(14, 'upload_slide/slide1.png'),
(15, 'upload_slide/slide1.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `payment_date` date NOT NULL,
  `order_id` int(11) NOT NULL,
  `is_order` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `product_id`, `customer_id`, `quantity`, `unit_price`, `total_amount`, `payment_date`, `order_id`, `is_order`) VALUES
(233, 50, 1, 3, 19290000.00, 57870000.00, '2024-05-16', 139, 0),
(234, 55, 1, 5, 3290000.00, 16450000.00, '2024-05-16', 139, 0),
(235, 49, 12, 3, 26890000.00, 80670000.00, '2024-05-16', 140, 0),
(236, 55, 1, 3, 3290000.00, 9870000.00, '2024-05-16', 141, 0),
(237, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-17', 142, 0),
(238, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-17', 142, 0),
(239, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-17', 142, 0),
(240, 53, 1, 1, 20990000.00, 20990000.00, '2024-05-17', 143, 0),
(241, 50, 1, 1, 19290000.00, 19290000.00, '2024-05-17', 143, 0),
(242, 53, 1, 1, 20990000.00, 20990000.00, '2024-05-17', 144, 0),
(243, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-17', 145, 0),
(246, 53, 12, 1, 20990000.00, 20990000.00, '2024-05-17', 148, 0),
(247, 50, 12, 2, 19290000.00, 38580000.00, '2024-05-17', 148, 0),
(248, 50, 12, 1, 19290000.00, 19290000.00, '2024-05-17', 149, 0),
(250, 49, 1, 3, 26890000.00, 80670000.00, '2024-05-17', 151, 0),
(251, 50, 1, 1, 19290000.00, 19290000.00, '2024-05-17', 151, 0),
(252, 49, 14, 5, 26890000.00, 134450000.00, '2024-05-17', 152, 0),
(254, 50, 14, 4, 19290000.00, 77160000.00, '2024-05-17', 153, 0),
(255, 49, 14, 4, 26890000.00, 107560000.00, '2024-05-17', 154, 0),
(256, 49, 14, 3, 26890000.00, 80670000.00, '2024-05-19', 155, 0),
(257, 53, 14, 3, 20990000.00, 62970000.00, '2024-05-19', 155, 0),
(259, 55, 14, 5, 3290000.00, 16450000.00, '2024-05-19', 155, 0),
(260, 49, 12, 2, 26890000.00, 53780000.00, '2024-05-19', 156, 0),
(261, 50, 12, 3, 19290000.00, 57870000.00, '2024-05-19', 157, 0),
(262, 49, 1, 3, 26890000.00, 80670000.00, '2024-05-19', 158, 0),
(264, 53, 14, 10, 20990000.00, 209900000.00, '2024-05-19', 160, 0),
(265, 49, 14, 2, 26890000.00, 53780000.00, '2024-05-19', 160, 0),
(266, 50, 1, 2, 19290000.00, 38580000.00, '2024-05-19', 161, 0),
(267, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-19', 162, 0),
(272, 49, 17, 3, 26890000.00, 80670000.00, '2024-05-19', 164, 0),
(273, 49, 17, 2, 26890000.00, 53780000.00, '2024-05-19', 164, 0),
(274, 49, 17, 3, 26890000.00, 80670000.00, '2024-05-19', 164, 0),
(275, 49, 1, 4, 26890000.00, 107560000.00, '2024-05-19', 165, 0),
(277, 49, 1, 3, 26890000.00, 80670000.00, '2024-05-19', 167, 0),
(278, 49, 1, 2, 26890000.00, 53780000.00, '2024-05-19', 167, 0),
(279, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-19', 168, 0),
(280, 49, 1, 3, 26890000.00, 80670000.00, '2024-05-19', 168, 0),
(281, 49, 12, 3, 26890000.00, 80670000.00, '2024-05-19', 169, 0),
(282, 50, 1, 2, 19290000.00, 38580000.00, '2024-05-19', 170, 0),
(283, 49, 14, 3, 26890000.00, 80670000.00, '2024-05-19', 171, 0),
(286, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-19', 174, 0),
(287, 49, 11, 1, 26890000.00, 26890000.00, '2024-05-19', 175, 0),
(288, 55, 11, 1, 3290000.00, 3290000.00, '2024-05-19', 175, 0),
(289, 55, 11, 1, 3290000.00, 3290000.00, '2024-05-19', 175, 0),
(290, 49, 11, 1, 26890000.00, 26890000.00, '2024-05-19', 176, 0),
(291, 53, 11, 1000, 20990000.00, 20990000000.00, '2024-05-19', 176, 0),
(292, 59, 11, 5, 21900000.00, 109500000.00, '2024-05-20', 177, 0),
(293, 49, 19, 4, 26890000.00, 107560000.00, '2024-05-20', 178, 0),
(294, 55, 19, 3, 3290000.00, 9870000.00, '2024-05-20', 178, 0),
(295, 55, 1, 8, 3290000.00, 26320000.00, '2024-05-20', 179, 0),
(296, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-24', 180, 0),
(297, 59, 12, 4, 21900000.00, 87600000.00, '2024-05-24', 181, 0),
(298, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 182, 0),
(299, 50, 12, 1, 19290000.00, 19290000.00, '2024-05-24', 183, 0),
(300, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 184, 0),
(301, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 184, 0),
(302, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 184, 0),
(303, 50, 12, 1, 19290000.00, 19290000.00, '2024-05-24', 185, 0),
(304, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 186, 0),
(305, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 187, 0),
(306, 49, 14, 1, 26890000.00, 26890000.00, '2024-05-24', 188, 0),
(307, 53, 12, 1, 20990000.00, 20990000.00, '2024-05-24', 189, 0),
(308, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 190, 0),
(309, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 191, 0),
(310, 49, 12, 122, 26890000.00, 3280580000.00, '2024-05-24', 192, 0),
(311, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-24', 193, 0),
(312, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 183, 0),
(313, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 194, 0),
(314, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 195, 0),
(315, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 196, 0),
(316, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 197, 0),
(317, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 198, 0),
(318, 53, 12, 1, 20990000.00, 20990000.00, '2024-05-24', 199, 0),
(319, 49, 14, 1, 26890000.00, 26890000.00, '2024-05-24', 200, 0),
(320, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 201, 0),
(321, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 202, 0),
(322, 55, 1, 1, 3290000.00, 3290000.00, '2024-05-24', 203, 0),
(323, 55, 17, 1, 3290000.00, 3290000.00, '2024-05-24', 204, 0),
(324, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-24', 205, 0),
(325, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-24', 206, 0),
(326, 49, 17, 1, 26890000.00, 26890000.00, '2024-05-24', 207, 1),
(328, 55, 14, 1, 3290000.00, 3290000.00, '2024-05-24', 209, 0),
(329, 59, 1, 1, 21900000.00, 21900000.00, '2024-05-24', 210, 0),
(333, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-24', 213, 0),
(334, 50, 12, 1, 19290000.00, 19290000.00, '2024-05-24', 213, 0),
(335, 53, 12, 3, 20990000.00, 62970000.00, '2024-05-24', 213, 0),
(345, 49, 12, 1, 26890000.00, 26890000.00, '2024-05-25', 222, 0),
(346, 59, 14, 1, 21900000.00, 21900000.00, '2024-05-25', 223, 0),
(347, 71, 14, 1, 20990000.00, 20990000.00, '2024-05-25', 223, 0),
(349, 55, 12, 1, 3290000.00, 3290000.00, '2024-05-25', 225, 0),
(350, 59, 12, 3, 21900000.00, 65700000.00, '2024-05-25', 225, 0),
(353, 59, 1, 1, 21900000.00, 21900000.00, '2024-05-25', 227, 0),
(354, 55, 1, 1, 3290000.00, 3290000.00, '2024-05-25', 227, 0),
(355, 53, 1, 4, 20990000.00, 83960000.00, '2024-05-25', 228, 0),
(356, 59, 1, 3, 21900000.00, 65700000.00, '2024-05-25', 228, 0),
(357, 49, 1, 1, 26890000.00, 26890000.00, '2024-05-25', 229, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `info_page`
--
ALTER TABLE `info_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `fk_purchase_history_customer_id` (`customer_id`),
  ADD KEY `fk_purchase_history_transaction_id` (`transaction_id`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  ADD PRIMARY KEY (`cartegory_id`);

--
-- Chỉ mục cho bảng `tbl_employees`
--
ALTER TABLE `tbl_employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_slide`
--
ALTER TABLE `tbl_slide`
  ADD PRIMARY KEY (`slide_id`);

--
-- Chỉ mục cho bảng `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `info_page`
--
ALTER TABLE `info_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT cho bảng `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  MODIFY `cartegory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `tbl_employees`
--
ALTER TABLE `tbl_employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT cho bảng `tbl_slide`
--
ALTER TABLE `tbl_slide`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `info_page`
--
ALTER TABLE `info_page`
  ADD CONSTRAINT `info_page_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`);

--
-- Các ràng buộc cho bảng `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD CONSTRAINT `fk_purchase_history_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_purchase_history_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
