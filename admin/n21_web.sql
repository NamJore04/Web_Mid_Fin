-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 13, 2024 lúc 05:57 AM
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
  `activate_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `firstname`, `lastname`, `email`, `password`, `role`, `activated`, `locked`, `activate_token`) VALUES
('admin', 'Huynh', 'Nam', 'namhuynhfree@gmail.com', '$2y$10$ISazLV1f0ePm2YF67GivmehOnL08toO3Y2MFZxzT0G/GZ/6gIMdUq', 'admin', b'1', b'0', '300535c734cd18a6282573dad7495c38'),
('caolam', 'Cao', 'Lam', 'caochinhlam@gmail.com', '$2y$10$vQcTMpgaVKQLYvEEWRO8Yes7BzdqWpYbj0IfECJul7aVEU.eSc36C', 'employee', b'1', b'0', '622d5f9f8950110067b428e476cf2fcf'),
('kimthiet', 'Kim', 'Thiết', 'kimthiet44@gmail.com', '$2y$10$g0BqLXeIXMY4MNTFpxNi.OsKFfpGokWrJWKJa8QD7LxTRThvvSfV2', 'employee', b'1', b'0', '92727d8bcbe1f92918a28ee889045d42'),
('trian', 'Trị', 'An', 'triminhan471999@gmail.com', '$2y$10$7TjfeSyo0ClaeKNlajfHo.yGGWOyNWnN/yf2/Iqc30AN1zi/sVoDm', 'employee', b'1', b'0', '36e534d9f4c679a7a60e00d0c6f983b7');

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
(1, '0376985763', 'Huỳnh Hoài Nam', 'Tiền Giang'),
(10, '7678765343', 'Jack', 'Bến Dừa'),
(11, '0999999999', 'Trị Minh An', 'Long Xuyên'),
(12, '0323043345', 'Minh Muôn', 'Hồ Chí Minh'),
(13, '0705744599', 'lập trình hướng đối tượng', 'Bến Dừa');

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
(2, '2006-06-22', '0999999999', 'trian', 'uploads/avatar_trian.png'),
(3, '2005-06-22', '0129210101', 'kimthiet', ''),
(4, '2007-06-22', '012921010', 'caolam', 'uploads/avatar_caolam.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`) VALUES
(39, 1, '2024-05-09 07:12:07'),
(41, 1, '2024-05-09 07:16:17'),
(42, 13, '2024-05-09 07:30:45'),
(43, 13, '2024-05-09 07:31:36'),
(44, 1, '2024-05-09 07:54:40');

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

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `unit_price`, `total_amount`) VALUES
(146, 39, 53, 1, 20990000.00, 20990000.00),
(148, 41, 49, 2, 26890000.00, 53780000.00),
(149, 42, 49, 3, 26890000.00, 80670000.00),
(150, 43, 53, 1, 20990000.00, 20990000.00),
(151, 44, 50, 10, 19290000.00, 99999999.99);

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
('Kết Nối', 30);

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
(49, 'Samsung Galaxy S24 Ultra 12GB 256GB', 28, 33990000.00, 26890000.00, '<p>Mở khoá giới hạn tiềm năng với AI - Hỗ trợ phiên dịch cuộc gọi, khoanh vùng tìm kiếm, Trợ lí Note và chình sửa anh</p>', 'Samsung Galaxy S24 Ultra 12GB 256GB.jpg', 0, '2024-05-04 14:35:12', 'd557e6b14b7299133bb74c5d9250d652'),
(50, 'iPhone 15 128GB', 23, 22990000.00, 19290000.00, '<p>6.1 inch, OLED, Super Retina XDR, 2556 x 1179 Pixels</p>', 'iPhone 15 128GB.jpg', 0, '2024-05-04 14:35:12', '665536ca8d5c7765e7240b144627bc20'),
(53, 'MI 14', 28, 22990000.00, 20990000.00, '<p>Mạnh mẽ cân mọi tác vụ, đa nhiệm cực đỉnh - Chip Snapdragon 8 Gen 3 (4nm) mượt mà đi kèm RAM 12GB</p>', 'mi14_demo.jpg', 0, '2024-05-04 15:02:42', '8ddca5705223e33b20b9b415e55e9de6'),
(55, 'Nokia C32 4GB 128GB', 29, 2390000.00, 3290000.00, '<p>Dung lượng pin 5050mAh cùng công nghệ tiết kiệm pin AI cho thời gian sử dụng đến 3 ngày</p>', 'Nokia C32 4GB 128GB.jpg', 0, '2024-05-06 10:14:53', '744ace9ad038a0f2a812396139e1e3d3');

--
-- Bẫy `tbl_product`
--
DELIMITER $$
CREATE TRIGGER `generate_barcode` BEFORE INSERT ON `tbl_product` FOR EACH ROW BEGIN
    SET NEW.barcode = MD5(CONCAT(NEW.product_name, NEW.product_id));
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
(55, 'Nokia C32 4GB 128GB_desc.jpg');

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
  `unit_price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `product_id`, `customer_id`, `quantity`, `unit_price`, `total_amount`, `payment_date`, `order_id`, `order_detail_id`) VALUES
(56, 53, 1, 1, 20990000.00, 20990000.00, '2024-05-09', 0, 0),
(57, 49, 1, 2, 26890000.00, 53780000.00, '2024-05-09', 0, 0),
(58, 49, 13, 3, 26890000.00, 80670000.00, '2024-05-09', 0, 0),
(59, 53, 13, 1, 20990000.00, 20990000.00, '2024-05-09', 0, 0),
(60, 50, 1, 10, 19290000.00, 99999999.99, '2024-05-09', 0, 0);

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
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `info_page`
--
ALTER TABLE `info_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

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
  MODIFY `cartegory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `tbl_employees`
--
ALTER TABLE `tbl_employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `tbl_slide`
--
ALTER TABLE `tbl_slide`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
