-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 28, 2023 lúc 04:22 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommerce_php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute`
--

CREATE TABLE `attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute`
--

INSERT INTO `attribute` (`id`, `name`, `display_name`) VALUES
(20, 'rom', 'Dung lượng'),
(21, 'ram', 'Ram'),
(23, 'color', 'Màu sắc'),
(32, 'pin', 'Dung lượng pin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `attribute_id`, `value_name`) VALUES
(16, 20, '64GB'),
(17, 20, ' 256GB'),
(18, 20, ' 512GB'),
(19, 21, '4GB'),
(20, 21, ' 8GB'),
(21, 21, ' 16GB'),
(22, 23, 'Màu trắng ngà'),
(23, 23, ' Màu xanh lá'),
(24, 23, ' Màu hồng'),
(25, 23, ' Màu tím'),
(26, 23, 'Titan xanh'),
(27, 23, ' Titan đen'),
(28, 23, ' Titan tự nhiên'),
(29, 23, ' Titan trắng'),
(30, 20, '1TB'),
(31, 20, ' 2TB'),
(32, 21, '32GB'),
(33, 21, ' 64GB'),
(34, 21, ' 128GB'),
(35, 21, ' 2GB'),
(36, 21, ' 1GB'),
(37, 21, ' 512MB'),
(38, 21, '16GB'),
(39, 23, 'Màu xám'),
(40, 23, ' Màu bạc'),
(41, 23, ' Màu xanh dương'),
(42, 23, 'Màu vàng nhạt'),
(43, 23, 'Màu đen'),
(44, 23, 'Màu trắng'),
(45, 32, '10000 mAh'),
(46, 32, '5000 mAh'),
(47, 32, ' 3000 mAh'),
(48, 32, ' 2000 mAh'),
(49, 32, ' 20000 mAh'),
(50, 21, '3TB'),
(51, 21, '4TB');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `title`, `description`, `cate_id`, `create_at`, `update_at`) VALUES
(1, 'Thị trường Điện Thoại lớn nhất', 'Khám phá, sưu tập và bán Điện thoại đặc biệt', 29, '2023-11-22 14:07:45', '2023-11-22 14:07:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Apple'),
(2, 'Asus'),
(3, 'Acer'),
(4, 'Samsung'),
(20, 'Binance'),
(21, 'Lenovo'),
(22, 'HP'),
(23, 'MSI'),
(25, 'Dell'),
(26, 'LG'),
(29, 'Samsung'),
(30, 'Xiaomi'),
(31, 'Oppo'),
(40, 'Casio');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `totalPrice`, `create_at`, `update_at`) VALUES
(25, 9, 22990000, '2023-12-09 10:41:29', '2023-12-09 10:41:29'),
(29, 4, 3690000, '2023-12-28 19:19:10', '2023-12-28 19:19:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL,
  `product_variant_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_item`
--

INSERT INTO `cart_item` (`id`, `product_variant_id`, `quantity`, `cart_id`) VALUES
(58, 14, 1, 25),
(72, 26, 1, 29);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `image`, `name`) VALUES
(1, 'elec-8.png', 'Gaming'),
(2, 'elec-7.png', 'Mạng'),
(3, 'elec-1.png', 'Đồng hồ '),
(4, 'elec-9.png', 'Tai nghe'),
(6, 'elec-10.png', 'Camera & Photo'),
(9, 'elec-11.png', 'Phụ kiện'),
(10, 'elec-6.png', 'Laptops'),
(24, 'elec-2.png', 'Màn hình'),
(29, 'elec-4.png', 'Điện thoại'),
(30, 'elec-5.png', 'PC'),
(31, 'nft.jpg', 'Tranh kĩ thuật số'),
(32, 'google-tivi-hisense-4k-40-inch-40a4200g.jpg', 'TV'),
(33, 'TAB-S7-FE-12.4_T733_MCBLK_1.jpg', 'Máy tính bảng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `thumb` varchar(500) NOT NULL,
  `title` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `min_amount` int(11) NOT NULL,
  `expired` datetime NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `thumb`, `title`, `value`, `min_amount`, `expired`, `quantity`, `status`) VALUES
(1, 'WINTER23', 'https://kachabazar-store-nine.vercel.app/_next/image?url=https%3A%2F%2Fi.ibb.co%2FwBBYm7j%2Fins4.jpg&w=128&q=75', 'Winter Gift Voucher Áp dụng mọi ngành hàng siêu hấ', '10%', 500000, '2023-11-30 20:00:26', 10, 0),
(4, 'TNNC001', 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700142289/uploads_ecommerce_php_5_1/phpBC56_ezkikk.jpg', 'Mã giảm giá giảm giá cựa sâu lên tới 10% cho mọi n', '10%', 900000, '2023-12-26 22:43:00', 12, 1),
(5, 'CK8830', 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025851/uploads_ecommerce_php_5_1/php2B5B_x86ku1.jpg', 'Mã giảm giá hấp dẫn: Tiết kiệm ngay 20% cho mọi mu', '20%', 20000000, '2024-01-16 15:57:00', 20, 1),
(6, 'C93345K', 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025939/uploads_ecommerce_php_5_1/php8231_ofwhzi.png', 'Mã giảm giá mùa đông áp dụng cho mọi ngành hàng', '500000', 10000000, '2023-12-23 15:58:00', 20, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images_product`
--

CREATE TABLE `images_product` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `images_product`
--

INSERT INTO `images_product` (`id`, `image`, `prod_id`) VALUES
(1, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490495/uploads_ecommerce_php_5_1/phpF4D6_plpzym.jpg', 83),
(2, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490497/uploads_ecommerce_php_5_1/phpF4D7_tgqwe2.jpg', 83),
(3, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490503/uploads_ecommerce_php_5_1/phpF4D8_vebojj.jpg', 83),
(4, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490508/uploads_ecommerce_php_5_1/phpF4D9_ar8wyl.jpg', 83),
(5, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490515/uploads_ecommerce_php_5_1/phpF4DA_l0ktkq.jpg', 83),
(6, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490529/uploads_ecommerce_php_5_1/phpF4EC_rfezxn.jpg', 83),
(7, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490532/uploads_ecommerce_php_5_1/phpF4ED_tpjuca.jpg', 83),
(8, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490534/uploads_ecommerce_php_5_1/phpF4EE_lyikid.jpg', 83),
(9, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490537/uploads_ecommerce_php_5_1/phpF4EF_caiokp.jpg', 83),
(10, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491212/uploads_ecommerce_php_5_1/phpEE79_og9dve.jpg', 84),
(11, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491226/uploads_ecommerce_php_5_1/phpEE7A_cvhawg.jpg', 84),
(12, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491229/uploads_ecommerce_php_5_1/phpEE8B_lhjlzj.jpg', 84),
(13, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491243/uploads_ecommerce_php_5_1/phpEE8C_sbgwig.jpg', 84),
(14, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491248/uploads_ecommerce_php_5_1/phpEE8D_oq3r2l.jpg', 84),
(15, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491254/uploads_ecommerce_php_5_1/phpEE8E_yh09de.jpg', 84),
(16, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491901/uploads_ecommerce_php_5_1/php8E25_c6uip9.jpg', 85),
(17, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491904/uploads_ecommerce_php_5_1/php8E26_jy34nv.jpg', 85),
(18, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491907/uploads_ecommerce_php_5_1/php8E27_fcmsyd.jpg', 85),
(19, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491910/uploads_ecommerce_php_5_1/php8E38_fq20ty.jpg', 85),
(20, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491922/uploads_ecommerce_php_5_1/php8E39_llutqj.jpg', 85),
(21, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491926/uploads_ecommerce_php_5_1/php8E3A_hxhd8p.jpg', 85),
(22, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491942/uploads_ecommerce_php_5_1/php8E3B_tlnrgv.jpg', 85),
(23, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491956/uploads_ecommerce_php_5_1/php8E3C_wlmwff.jpg', 85),
(24, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491967/uploads_ecommerce_php_5_1/php8E3D_lrjw1n.jpg', 85),
(25, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491992/uploads_ecommerce_php_5_1/php8E4D_tqkkcw.jpg', 85),
(26, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700492846/uploads_ecommerce_php_5_1/php206B_urgton.jpg', 86),
(27, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700492860/uploads_ecommerce_php_5_1/php207B_uslk3j.jpg', 86),
(28, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700492863/uploads_ecommerce_php_5_1/php207C_khwpxh.jpg', 86),
(29, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700492866/uploads_ecommerce_php_5_1/php207D_cumji0.jpg', 86),
(30, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700492868/uploads_ecommerce_php_5_1/php207E_dcumii.jpg', 86),
(31, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700492883/uploads_ecommerce_php_5_1/php207F_witrwv.jpg', 86),
(32, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700492885/uploads_ecommerce_php_5_1/php2080_txxjjm.jpg', 86),
(33, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700492888/uploads_ecommerce_php_5_1/php2081_lju9rn.jpg', 86),
(34, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493425/uploads_ecommerce_php_5_1/phpCBF8_mfft79.jpg', 87),
(35, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493435/uploads_ecommerce_php_5_1/phpCC09_e0ipkp.jpg', 87),
(36, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493454/uploads_ecommerce_php_5_1/phpCC0A_azev2i.jpg', 87),
(37, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493470/uploads_ecommerce_php_5_1/phpCC0B_r8i0kc.jpg', 87),
(38, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493476/uploads_ecommerce_php_5_1/phpCC0C_un6eu0.jpg', 87),
(39, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493485/uploads_ecommerce_php_5_1/phpCC0D_kugfiv.jpg', 87),
(40, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493492/uploads_ecommerce_php_5_1/phpCC0E_pjxwfe.jpg', 87),
(41, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493510/uploads_ecommerce_php_5_1/phpCC1E_fsuqat.jpg', 87),
(42, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493521/uploads_ecommerce_php_5_1/phpCC1F_wgjiho.jpg', 87),
(43, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493924/uploads_ecommerce_php_5_1/php2878_xwevhf.jpg', 88),
(44, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493947/uploads_ecommerce_php_5_1/phpEA81_ilekld.jpg', 88),
(45, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493969/uploads_ecommerce_php_5_1/phpEA92_rq7bys.jpg', 88),
(46, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493983/uploads_ecommerce_php_5_1/phpEA93_pwawp6.jpg', 88),
(47, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493987/uploads_ecommerce_php_5_1/phpEAA3_xq6znd.jpg', 88),
(48, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493996/uploads_ecommerce_php_5_1/phpEAA4_uyfta0.jpg', 88),
(49, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494003/uploads_ecommerce_php_5_1/phpEAA5_z0yffc.jpg', 88),
(50, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494007/uploads_ecommerce_php_5_1/phpEAA6_neb3fk.jpg', 88),
(51, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494017/uploads_ecommerce_php_5_1/phpEAA7_dqplma.jpg', 88),
(52, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494376/uploads_ecommerce_php_5_1/php3B3D_eo2c6x.jpg', 89),
(53, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494392/uploads_ecommerce_php_5_1/php3B3E_zdeerj.jpg', 89),
(54, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494396/uploads_ecommerce_php_5_1/php3B4F_fdxbia.jpg', 89),
(55, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494458/uploads_ecommerce_php_5_1/phpC2DA_trn4dl.jpg', 89),
(56, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494482/uploads_ecommerce_php_5_1/phpC2DB_kv6vbk.jpg', 89),
(57, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494497/uploads_ecommerce_php_5_1/phpC2EC_fzwzun.jpg', 89),
(58, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494505/uploads_ecommerce_php_5_1/phpC2FC_lsm7uc.jpg', 89),
(59, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494515/uploads_ecommerce_php_5_1/phpC2FD_bunqw7.jpg', 89),
(60, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494529/uploads_ecommerce_php_5_1/phpC2FE_yf2die.jpg', 89),
(61, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494537/uploads_ecommerce_php_5_1/phpC2FF_wfz3pp.jpg', 89),
(62, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495424/uploads_ecommerce_php_5_1/php54DD_rx0aie.jpg', 90),
(63, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495431/uploads_ecommerce_php_5_1/php54DE_zhfpva.jpg', 90),
(64, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495435/uploads_ecommerce_php_5_1/php54DF_wwx28n.jpg', 90),
(65, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495450/uploads_ecommerce_php_5_1/php54E0_brqsnk.jpg', 90),
(66, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495454/uploads_ecommerce_php_5_1/php54F1_phmuuw.jpg', 90),
(67, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495502/uploads_ecommerce_php_5_1/phpAEB5_r4xk77.jpg', 90),
(68, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495506/uploads_ecommerce_php_5_1/phpAEB6_enqswt.jpg', 90),
(69, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495516/uploads_ecommerce_php_5_1/phpAEB7_pyezub.jpg', 90),
(70, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495521/uploads_ecommerce_php_5_1/phpAEC8_bkxa58.jpg', 90),
(71, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495535/uploads_ecommerce_php_5_1/phpAEC9_ya2cxf.jpg', 90),
(72, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495541/uploads_ecommerce_php_5_1/phpAECA_snmo7f.jpg', 90),
(73, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700559868/uploads_ecommerce_php_5_1/php3052_wub5dn.jpg', 91),
(74, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700559871/uploads_ecommerce_php_5_1/php3053_ldvtyc.jpg', 91),
(75, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700559875/uploads_ecommerce_php_5_1/php3054_nj1t0q.jpg', 91),
(76, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700559879/uploads_ecommerce_php_5_1/php3065_d6d0rm.jpg', 91),
(77, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700559882/uploads_ecommerce_php_5_1/php3066_sqg2db.jpg', 91),
(78, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700559885/uploads_ecommerce_php_5_1/php3067_ri7bfz.jpg', 91),
(79, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700559889/uploads_ecommerce_php_5_1/php3068_sd7x03.jpg', 91),
(80, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700559893/uploads_ecommerce_php_5_1/php3069_tjdxig.jpg', 91),
(81, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701428695/uploads_ecommerce_php_5_1/phpDC2D_bwytwc.jpg', 92),
(82, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701428701/uploads_ecommerce_php_5_1/phpDC2E_ig8ea9.jpg', 92),
(83, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701428715/uploads_ecommerce_php_5_1/phpDC2F_pgbjsm.jpg', 92),
(84, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701428718/uploads_ecommerce_php_5_1/phpDC40_gralg0.jpg', 92),
(85, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701428721/uploads_ecommerce_php_5_1/phpDC41_uuhvt8.jpg', 92),
(86, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701428723/uploads_ecommerce_php_5_1/phpDC42_esyjdq.jpg', 92),
(87, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429056/uploads_ecommerce_php_5_1/php650B_tx7me0.jpg', 94),
(88, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429058/uploads_ecommerce_php_5_1/php650C_xozgnj.jpg', 94),
(89, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429060/uploads_ecommerce_php_5_1/php650D_bah2ts.jpg', 94),
(90, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429062/uploads_ecommerce_php_5_1/php650E_vrqtkl.jpg', 94),
(91, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429065/uploads_ecommerce_php_5_1/php650F_khvve9.jpg', 94),
(92, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429067/uploads_ecommerce_php_5_1/php6510_ih3xk3.jpg', 94),
(93, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429070/uploads_ecommerce_php_5_1/php6511_vm8j4i.jpg', 94),
(94, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429502/uploads_ecommerce_php_5_1/php3BC5_kmdwdn.jpg', 96),
(95, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429506/uploads_ecommerce_php_5_1/php3BD6_zqjwdq.jpg', 96),
(96, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429509/uploads_ecommerce_php_5_1/php3BD7_kfv9f6.jpg', 96),
(97, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429512/uploads_ecommerce_php_5_1/php3BD8_lulkii.jpg', 96),
(98, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429515/uploads_ecommerce_php_5_1/php3BD9_d4fzr2.jpg', 96),
(99, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429732/uploads_ecommerce_php_5_1/phpBBCA_nvqtgg.jpg', 97),
(100, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429734/uploads_ecommerce_php_5_1/phpBBCB_kvqzln.jpg', 97),
(101, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429736/uploads_ecommerce_php_5_1/phpBBDC_krgeqe.jpg', 97),
(102, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429738/uploads_ecommerce_php_5_1/phpBBDD_eozygo.jpg', 97),
(103, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429741/uploads_ecommerce_php_5_1/phpBBDE_qysjh4.jpg', 97),
(104, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429743/uploads_ecommerce_php_5_1/phpBBDF_yckum6.jpg', 97),
(105, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701435404/uploads_ecommerce_php_5_1/php410C_wpginy.jpg', 98),
(106, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701435407/uploads_ecommerce_php_5_1/php410D_uihxdc.jpg', 98),
(107, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701435422/uploads_ecommerce_php_5_1/php410E_llbmtl.jpg', 98),
(108, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701435433/uploads_ecommerce_php_5_1/php411F_qmixjh.jpg', 98),
(109, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701435440/uploads_ecommerce_php_5_1/php4130_kuo7t9.jpg', 98),
(110, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701435444/uploads_ecommerce_php_5_1/php4131_shbd91.jpg', 98),
(111, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701435450/uploads_ecommerce_php_5_1/php4132_mx3gyc.jpg', 98),
(112, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702021954/uploads_ecommerce_php_5_1/phpA3AE_bnx6mx.jpg', 99),
(113, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702021956/uploads_ecommerce_php_5_1/phpA3AF_yin64p.jpg', 99),
(114, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702021957/uploads_ecommerce_php_5_1/phpA3B0_xf3dy8.jpg', 99),
(115, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702021959/uploads_ecommerce_php_5_1/phpA3B1_bgelyq.jpg', 99),
(116, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702022519/uploads_ecommerce_php_5_1/php4962_gk5ccq.jpg', 100),
(117, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702022521/uploads_ecommerce_php_5_1/php4972_t2siim.jpg', 100),
(118, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702022523/uploads_ecommerce_php_5_1/php4973_jhwqx9.jpg', 100),
(119, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702022526/uploads_ecommerce_php_5_1/php4974_ddutmy.jpg', 100),
(120, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702022528/uploads_ecommerce_php_5_1/php4985_yqzkph.jpg', 100),
(121, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702022530/uploads_ecommerce_php_5_1/php4986_jm5jnj.jpg', 100),
(122, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702022533/uploads_ecommerce_php_5_1/php4997_cvwkdp.jpg', 100),
(123, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023090/uploads_ecommerce_php_5_1/php1C6_vsqhx1.jpg', 101),
(124, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023093/uploads_ecommerce_php_5_1/php1C7_vejg4w.jpg', 101),
(125, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023095/uploads_ecommerce_php_5_1/php1C8_nrgsbi.jpg', 101),
(126, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023097/uploads_ecommerce_php_5_1/php1C9_t68he7.jpg', 101),
(127, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023100/uploads_ecommerce_php_5_1/php1CA_dmvsp4.jpg', 101),
(128, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023104/uploads_ecommerce_php_5_1/php1CB_gvacls.jpg', 101),
(129, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023108/uploads_ecommerce_php_5_1/php1EB_dc8mrf.jpg', 101),
(130, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023378/uploads_ecommerce_php_5_1/php677A_dvhxui.jpg', 102),
(131, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023380/uploads_ecommerce_php_5_1/php677B_cndatl.jpg', 102),
(132, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023382/uploads_ecommerce_php_5_1/php677C_ut4ymw.jpg', 102),
(133, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023384/uploads_ecommerce_php_5_1/php679C_v2ousq.jpg', 102),
(134, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023532/uploads_ecommerce_php_5_1/phpC13E_ldwp60.jpg', 103),
(135, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023533/uploads_ecommerce_php_5_1/phpC13F_bgfrcp.jpg', 103),
(136, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023535/uploads_ecommerce_php_5_1/phpC140_zz4l1t.jpg', 103),
(137, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023741/uploads_ecommerce_php_5_1/phpF16B_wdlhk6.jpg', 104),
(138, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023742/uploads_ecommerce_php_5_1/phpF16C_dsdmjg.jpg', 104),
(139, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023744/uploads_ecommerce_php_5_1/phpF16D_watzy6.jpg', 104),
(140, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023746/uploads_ecommerce_php_5_1/phpF16E_or4knf.jpg', 104),
(141, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024033/uploads_ecommerce_php_5_1/php6843_nay2to.jpg', 105),
(142, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024036/uploads_ecommerce_php_5_1/php6844_xu7n7f.jpg', 105),
(143, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024039/uploads_ecommerce_php_5_1/php6845_n8wmlu.jpg', 105),
(144, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024041/uploads_ecommerce_php_5_1/php6846_s69lo6.jpg', 105),
(145, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024043/uploads_ecommerce_php_5_1/php6847_qhmj5n.jpg', 105),
(146, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024046/uploads_ecommerce_php_5_1/php6857_nqoxa8.jpg', 105),
(147, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024047/uploads_ecommerce_php_5_1/php6858_ug8nbn.jpg', 105),
(148, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024345/uploads_ecommerce_php_5_1/php2752_ss73nm.jpg', 106),
(149, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024348/uploads_ecommerce_php_5_1/php2753_lj4wd1.jpg', 106),
(150, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024351/uploads_ecommerce_php_5_1/php2754_ancl1r.jpg', 106),
(151, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024354/uploads_ecommerce_php_5_1/php2764_s5agwh.jpg', 106),
(152, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024356/uploads_ecommerce_php_5_1/php2765_dtv80r.jpg', 106),
(153, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024359/uploads_ecommerce_php_5_1/php2776_nwvaur.jpg', 106),
(154, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024362/uploads_ecommerce_php_5_1/php2777_qkp8s4.jpg', 106),
(155, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024758/uploads_ecommerce_php_5_1/php7638_kujgsx.jpg', 107),
(156, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024760/uploads_ecommerce_php_5_1/php7639_yn8jwr.jpg', 107),
(157, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024762/uploads_ecommerce_php_5_1/php763A_qwg4qu.jpg', 107),
(158, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024765/uploads_ecommerce_php_5_1/php763B_lhwvps.jpg', 107),
(159, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024767/uploads_ecommerce_php_5_1/php764C_fnqugx.jpg', 107),
(160, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024771/uploads_ecommerce_php_5_1/php764D_ifd9b0.jpg', 107),
(161, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024773/uploads_ecommerce_php_5_1/php765D_p4blew.jpg', 107),
(162, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024776/uploads_ecommerce_php_5_1/php765E_sax6gp.jpg', 107),
(163, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024995/uploads_ecommerce_php_5_1/php1457_hlzhz8.jpg', 108),
(164, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024998/uploads_ecommerce_php_5_1/php1458_wytkon.jpg', 108),
(165, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025002/uploads_ecommerce_php_5_1/php1459_vyunkx.jpg', 108),
(166, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025005/uploads_ecommerce_php_5_1/php145A_zpm6an.jpg', 108),
(167, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025007/uploads_ecommerce_php_5_1/php146B_r8bo7y.jpg', 108),
(168, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025011/uploads_ecommerce_php_5_1/php146C_szucgr.jpg', 108),
(169, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025013/uploads_ecommerce_php_5_1/php146D_mbroin.jpg', 108),
(170, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025351/uploads_ecommerce_php_5_1/php6F39_uslrrz.png', 109),
(171, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025357/uploads_ecommerce_php_5_1/php6F3A_nxaf98.png', 109),
(172, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025364/uploads_ecommerce_php_5_1/php6F4A_nmetoa.png', 109),
(173, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025368/uploads_ecommerce_php_5_1/php6F5B_kdeeej.png', 109),
(174, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025373/uploads_ecommerce_php_5_1/php6F5C_lcazdc.png', 109),
(175, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025375/uploads_ecommerce_php_5_1/php6F6C_pt4qk6.png', 109),
(176, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025377/uploads_ecommerce_php_5_1/php6F6D_objqna.png', 109),
(177, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025381/uploads_ecommerce_php_5_1/php6F6E_wtd1kv.png', 109),
(178, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702028241/uploads_ecommerce_php_5_1/php9C6A_urmxhu.webp', 110),
(179, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702028242/uploads_ecommerce_php_5_1/php9C6B_fcho6u.webp', 110),
(180, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702028243/uploads_ecommerce_php_5_1/php9C7C_hvck5u.webp', 110),
(181, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702028245/uploads_ecommerce_php_5_1/php9C7D_y9csvw.webp', 110),
(182, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702028246/uploads_ecommerce_php_5_1/php9C7E_ncijut.webp', 110),
(183, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702028248/uploads_ecommerce_php_5_1/php9C7F_aqwtw6.webp', 110),
(184, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702028249/uploads_ecommerce_php_5_1/php9C80_nedeaj.webp', 110),
(185, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1703253458/uploads_ecommerce_php_5_1/phpE205_o10nmi.jpg', 111),
(186, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1703253460/uploads_ecommerce_php_5_1/phpE206_rra6hl.jpg', 111),
(187, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1703592618/uploads_ecommerce_php_5_1/phpBA50_bj2jje.jpg', 112),
(188, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1703592633/uploads_ecommerce_php_5_1/phpBA61_xd8oj3.jpg', 112);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `view` smallint(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `user_id`, `title`, `content`, `thumb`, `slug`, `view`, `status`, `create_at`, `update_at`) VALUES
(1, 4, 'Poco C65 - điện thoại bộ nhớ 256 GB giá 3 triệu đồng', '<p>C65 có cấu hình tốt, màn hình lớn 6,74 inch so với tầm giá nhưng chất lượng camera và loa ngoài chưa tốt.</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4520-1699960658.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Az8CLAOOjo-A9LsnPKEw3g 1x, https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4520-1699960658.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=NwCcNk2AiOMNDovTGZZcQw 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4520-1699960658.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Az8CLAOOjo-A9LsnPKEw3g\" alt=\"\"></picture></p><p>Poco C65 là điện thoại giá rẻ mới nhất từ thương hiệu con của Xiaomi với điểm mạnh truyền thống là cấu hình so với các đối thủ cùng phân khúc. Đây là model rẻ nhất trang bị bộ nhớ 256 GB, RAM 8 GB với giá 3 triệu đồng, gấp đôi các đối thủ. Ngoài ra, máy còn một lựa chọn khác là bộ nhớ 128 GB, RAM 6 GB giá 2,75 triệu đồng.</p><p>Sản phẩm có giá tốt một phần nhờ chiến lược chỉ bán trực tuyến thay vì đưa cả vào hệ thống bán lẻ lớn như các hãng điện thoại thường làm. Đây có thể coi là bản nâng cấp nhẹ của Redmi 12C và có thông số phần cứng, kiểu dáng gần giống Redmi 13C cũng chuẩn bị bán ra tại Việt Nam.</p><p>Sau hơn một năm trầm lắng, phân khúc điện thoại tầm giá 3 triệu đồng sôi động trở lại khi có sự góp mặt của nhiều model trong nửa cuối 2023. Ngoài Samsung Galaxy A14, đa số các model còn lại đều từ các thương hiệu Trung Quốc như Infinix Hot 30, Tecno Spark 10 Pro, Realme C51 hay Oppo A18.</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4581-1699960662.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=zsfGOzF4bI7tVuRsQD-7mA 1x, https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4581-1699960662.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=CKizsuJzENrv0h73bDspmg 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4581-1699960662.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=zsfGOzF4bI7tVuRsQD-7mA\" alt=\"\"></picture></p><p>Máy có màn hình lớn 6,74 inch, tấm nền IPS và ưu điểm tần số quét 90 Hz tốt so với mức giá. Tuy nhiên, độ phân giải màn hình chỉ là HD+ (720 x 1.600 pixel) nên độ sắc nét chưa cao, có thể quan sát kỹ răng cưa viền chi tiết bằng mắt thường. Bù lại, màu sắc được cân chỉnh tốt, khá rực rỡ và cho phép chọn các tông màu ấm, lạnh. Độ sáng màn hình chỉ đạt 450 nit (độ sáng điểm 600 nit) nên khá khó sử dụng ngoài trời khi có nắng chiếu trực tiếp, hiển thị bóng.</p><p>C65 cũng chuyển sang thiết kế cạnh vuông vức, đi kèm viền màn hình nhô lên khỏi cạnh máy khiến trải nghiệm cầm không thực sự thoải mái, hơi cấn tay. Do khung bằng nhựa, máy có trọng lượng nhẹ, chỉ 192 gram nên có thể sử dụng lâu ít gây mỏi.</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4545-1699960660.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=9X7VsPlnCTZQ5yfDA0C2iQ 1x, https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4545-1699960660.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=L1-cfuv129qYTOEOcyHizA 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4545-1699960660.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=9X7VsPlnCTZQ5yfDA0C2iQ\" alt=\"\"></picture></p><p>Mặt sau được hoàn thiện tốt với bề mặt nhám nhẹ chống bám vân tay gần giống chất lượng gương mờ dù thực tế chỉ bằng nhựa thông thường. Máy có điểm nhấn logo Poco và cụm camera có ống kính lớn giống dòng Redmi 13C.</p><p>Chip xử lý Mediatek MT6769Z Helio G85 cho điểm hiệu năng khá tốt so với tầm giá, khoảng 280.000 điểm với AnTuTu Benchmark. Điểm nhấn của máy nằm ở bộ nhớ với chuẩn tốc độ đọc, ghi eMMC 5.1.</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4538-1699960659.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=BNGGtor4r9pL3vYk317VVw 1x, https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4538-1699960659.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=pmpCnc2vDghZjGFBGHRNMQ 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4538-1699960659.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=BNGGtor4r9pL3vYk317VVw\" alt=\"\"></picture></p><p>C65 có độ mỏng ấn tượng 8,1 mm so với mức 8,7-9,4 mm của các đối thủ cùng phân khúc dù sở hữu viên pin 5.000 mAh. Máy cũng có cảm biến vân tay một chạm đặt trên nút nguồn ở cạnh phải. Điện thoại mới của Poco chạy hệ điều hành Android 13 với bộ giao diện MIUI 14 rút gọn. Máy có ba màu để lựa chọn là xanh, đen và tím.</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4537-1699960659.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=f7F6gd0RX4ma6MdDFlcYhQ 1x, https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4537-1699960659.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=rxGuA0ySu6gghrdiyWmNnA 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4537-1699960659.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=f7F6gd0RX4ma6MdDFlcYhQ\" alt=\"\"></picture></p><p>C65 vẫn giữ đầy đủ cổng kết nối, bao gồm cả giắc cắm tai nghe 3,5 mm trên đỉnh máy. Cổng USB-C phía dưới chỉ là chuẩn 2.0 và hỗ trợ sạc nhanh tối đa có dây là 18 W (chuẩn PD). Nhược điểm của máy nằm ở hệ thống loa ngoài với một loa bên dưới thay vì stereo. Ngoài ra, âm thanh cho cảm giác hơi rè khi đặt mức chỉnh khoảng trên 60%</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4568-1699960661.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=_LywNGOWvi0QRC5JSRtbRg 1x, https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4568-1699960661.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=p9RjsUxB1V5s4DyazTd59A 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4568-1699960661.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=_LywNGOWvi0QRC5JSRtbRg\" alt=\"\"></picture></p><p>Cụm camera phía sau lớn hơn cả các mẫu điện thoại cao cấp gồm một camera chính độ phân giải 50 megapixel, f/1.8, lấy nét PDAF nhưng góc hơi hẹp là 28 mm (tiêu chuẩn thường là 24 mm), một ống kính macro đo độ sâu trường ảnh 2 megapixel và đèn flash LED. Máy có thể quay video độ phân giải Full HD tốc độ 30 hình/giây.</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4593-1699960662.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=_smNc-wbUeomg5ss8Ib-VA 1x, https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4593-1699960662.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=0yUJqY2v_q-lYyfgL3Xjvw 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4593-1699960662.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=_smNc-wbUeomg5ss8Ib-VA\" alt=\"\"></picture></p><p>Độ phân giải cao nhưng chất lượng chụp ảnh chưa tương xứng khi không khác biệt so với các đối thủ với thông số kém hơn. Ảnh chụp ổn ở điều kiện ngoài trời, đủ sáng nhưng độ chi tiết giảm nhiều với môi trường ánh sáng yếu. So với model giá rẻ \"hot\" nhất trước đây của Xiaomi là Redmi 12C, Poco C65 nhỉnh hơn ở khả năng cân bằng trắng, xử lý HDR nhưng chất lượng tổng thể không nâng cấp đáng kể.</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4576-1699960661.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=E6sWoDe5KPmUjbFHi-kl1Q 1x, https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4576-1699960661.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=HtWMJk8AOOYmDv9kcsvo0g 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4576-1699960661.jpg?w=1200&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=E6sWoDe5KPmUjbFHi-kl1Q\" alt=\"\"></picture></p><p>&nbsp;</p><p>Phụ kiện có bộ sạc, cáp USB-C nhưng không có tai nghe và ốp silicon trong suốt. C65 hỗ trợ sạc nhanh tối đa 18 W nhưng củ sạc đi kèm có công suất chỉ 10 W.</p>', 'https://i1-sohoa.vnecdn.net/2023/11/14/DSCF4520-1699960658.jpg?w=1200&h=0&q=100&dpr=1&fit=crop&s=Az8CLAOOjo-A9LsnPKEw3g', 'poco-c65---dien-thoai-bo-nho-256-gb-gia-3-trieu-dong-6572de0bf08f1', 38, 1, '2023-11-15 20:53:51', '2023-11-15 20:53:51'),
(2, 9, 'Google xác nhận trả tiền tỷ cho Apple để mặc định công cụ tìm kiếm', '<p>Sundar Pichai, CEO Google, thừa nhận hãng chia sẻ cho Apple 36% doanh thu có được từ việc đặt công cụ tìm kiếm mặc định trên trình duyệt Safari.</p><p>Ngày 14/11, trong buổi làm chứng liên quan đến <a href=\"https://vnexpress.net/nha-san-xuat-game-fortnite-kien-apple-google-4146591.html\">vụ kiện</a> giữa Google và Epic Games về vấn đề độc quyền trên Google Play, nhà sản xuất game đứng sau trò chơi <i>Fortnite</i>, một nhân chứng đề cập con số 36% doanh thu từ tìm kiếm thông qua Safari mà Apple được hưởng.</p><p>Luật sư của Epic Games hỏi Pichai điều này có chính xác không. CEO Google đáp: \"Đúng vậy!\".</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/11/15/WIIEYS6NCVKV7B55UWTH4ZVUTY-2708-1700019077.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Mqf_2wSVeutdhFBRweTIyA 1x, https://i1-sohoa.vnecdn.net/2023/11/15/WIIEYS6NCVKV7B55UWTH4ZVUTY-2708-1700019077.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=FT829C6TEaTCcf4P9MQfbg 1.5x, https://i1-sohoa.vnecdn.net/2023/11/15/WIIEYS6NCVKV7B55UWTH4ZVUTY-2708-1700019077.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=AfArnaNhcdEf08katKZJ3g 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/11/15/WIIEYS6NCVKV7B55UWTH4ZVUTY-2708-1700019077.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Mqf_2wSVeutdhFBRweTIyA\" alt=\"CEO Alphabet Sundar Pichai. Ảnh: Reuters\"></picture></p><p>CEO Alphabet Sundar Pichai. Ảnh: <i>Reuters</i></p><p>Luật sư tiếp tục hỏi Pichai tại sao hãng trả cho Samsung, đối tác phần cứng lớn nhất về Android, số tiền chưa bằng một nửa so với cho Apple. CEO Google nói ông không nắm rõ một cách chắc chắn, nhưng điều này \"có thể\" xảy ra.</p><p>\"Nó giống như việc vận chuyển táo với cam vậy\", Pichai nói. \"Với các giao dịch, đôi khi bạn phải trả tiền khác nhau cho các hãng vận chuyển\".</p><p>Đại diện pháp luật của Epic Games sau đó hỏi Pichai về số tiền chính xác mà họ trả cho Apple. Pichai nói \"hơn 10 tỷ USD\". Luật sư cho rằng ông trả lời không chính xác, con số thực tế phải là 18 tỷ USD.</p><p>Google, Samsung và Apple không đưa ra bình luận.</p><p>Alphabet hiện đối mặt với nhiều cuộc chiến pháp lý liên quan đến hành vi độc quyền công cụ tìm kiếm và kho ứng dụng. Hai vụ kiện với Bộ Tư pháp Mỹ (DOJ) và Epic Games đang diễn ra đồng thời. Hồi tháng 9, trong phiên tòa liên quan đến vụ kiện do Bộ Tư pháp Mỹ là nguyên đơn, các công tố viên cho biết Google nắm 90% thị phần tìm kiếm trực tuyến. Ưu thế đó có được một phần nhờ <a href=\"https://vnexpress.net/chu-de/google-1539\">Google</a> bắt tay với Apple trong thương vụ đã kéo dài 18 năm.</p><p>Một số nguồn tin cho biết Google chi 9,5 tỷ USD vào năm 2018, 11 tỷ USD năm 2020 và 15 tỷ USD năm 2021 để là công cụ tìm kiếm mặc định trên sản phẩm của Apple. Còn theo <a href=\"https://vnexpress.net/apple-co-the-mat-hang-ty-usd-neu-google-thua-kien-4663756.html\">thống kê mới nhất</a> được DOJ đưa ra hồi tháng 10, con số này là 18-20 tỷ USD.</p><p>Theo <i>Washington Post</i>, nếu Google bị chứng minh vi phạm pháp luật trong vụ kiện với DOJ, tòa án có quyền ra lệnh thay đổi điều khoản hoặc hủy bỏ hợp đồng của công ty với Apple. Hiện Liên minh châu Âu cũng đề nghị các thiết bị phải cài đặt \"giao diện lựa chọn\" ngay từ đầu để người dùng truy cập những công cụ tìm kiếm ngoài Google.</p>', 'https://i1-sohoa.vnecdn.net/2023/11/15/WIIEYS6NCVKV7B55UWTH4ZVUTY-2708-1700019077.png?w=680&h=0&q=100&dpr=1&fit=crop&s=Mqf_2wSVeutdhFBRweTIyA', 'google-xac-nhan-tra-tien-ty-cho-apple-de-mac-dinh-cong-cu-tim-kiem-655df3d2882b0', 13, 1, '2023-11-15 20:53:51', '2023-11-15 20:53:51'),
(5, 4, 'Cuộc đua độ sáng màn hình không hồi kết: OnePlus ra mắt smartphone có màn hình sáng 4500 nits cao nhất thế giới', '<p>OnePlus mới đây đã giới thiệu mẫu flagship mới nhất có tên OnePlus 12. Máy có ưu điểm về hiệu năng mạnh mẽ, màn hình độ sáng cao và sạc nhanh 100W, mức giá khởi điểm chỉ từ khoảng hơn 14 triệu đồng.</p><p>&nbsp;</p><p><a href=\"https://genk.mediacdn.vn/139269124445442048/2023/12/7/006ruxyjgy1hkj529x04mj31kw11xauw-1701934879448-170193487962356397422.jpg\"><img src=\"https://genk.mediacdn.vn/thumb_w/640/139269124445442048/2023/12/7/006ruxyjgy1hkj529x04mj31kw11xauw-1701934879448-170193487962356397422.jpg\" alt=\"Cuộc đua độ sáng màn hình không hồi kết: OnePlus ra mắt smartphone có màn hình sáng 4500 nits cao nhất thế giới- Ảnh 1.\"></a></p><p>&nbsp;</p><p>Ngôn ngữ thiết kế của OnePlus 12 khá quen thuộc. Máy có mặt lưng hoàn thiện từ kính, cong 2 cạnh viền, khung viền hoàn thiện từ kim loại. Ở mặt trước, OnePlus 12 trang bị màn hình 6,82 inch LTPO AMOLED với độ phân giải QHD+, tần số quét 1-120Hz. Màn hình này do BOE sản xuất, được quảng cáo là có thể đạt độ sáng lên tới 4500 nits, cao nhất trên thế giới. Trước đó, Redmi K70 series phá vỡ kỷ lục của Xiaomi 14 với màn hình 4000 nits, tuy nhiên danh hiệu smartphone có màn hình sáng nhất giờ đây đã thuộc về OnePlus 12.<br>&nbsp;</p><p>&nbsp;</p><p><a href=\"https://genk.mediacdn.vn/139269124445442048/2023/12/7/006ruxyjgy1hkj529l1z7j31kw11xtii-1701934886444-17019348865981913026044.jpg\"><img src=\"https://genk.mediacdn.vn/thumb_w/640/139269124445442048/2023/12/7/006ruxyjgy1hkj529l1z7j31kw11xtii-1701934886444-17019348865981913026044.jpg\" alt=\"Cuộc đua độ sáng màn hình không hồi kết: OnePlus ra mắt smartphone có màn hình sáng 4500 nits cao nhất thế giới- Ảnh 2.\"></a></p><p>&nbsp;</p><p>Ở mặt lưng, OnePlus 12 trang bị hệt hống 3 camera chính gồm góc rộng 50MP, góc siêu rộng 48MP và tele 3X 64MP. Cụm camera này được tinh chỉnh bởi Hasselblad tương tự như các smartphone OPPO cao cấp.<br>&nbsp;</p><p>&nbsp;</p><p><a href=\"https://genk.mediacdn.vn/139269124445442048/2023/12/7/006ruxyjgy1hkj529z5edj31kw11xhdt-1701934872998-1701934873618866890869.jpg\"><img src=\"https://genk.mediacdn.vn/thumb_w/640/139269124445442048/2023/12/7/006ruxyjgy1hkj529z5edj31kw11xhdt-1701934872998-1701934873618866890869.jpg\" alt=\"Cuộc đua độ sáng màn hình không hồi kết: OnePlus ra mắt smartphone có màn hình sáng 4500 nits cao nhất thế giới- Ảnh 3.\"></a></p><p>&nbsp;</p><p>Về hiệu năng, OnePlus 12 trang bị chip Snapdragon 8 Gen 3, máy có RAM lên tới 24GB, bộ nhớ lưu trữ lên tới 1TB. Viên pin của máy có dung lượng 5400mAh, hỗ trợ sạc nhanh 100W có dây và 50W không dây. Máy chạy trên nền tảng ColorOS 14.0 dựa trên Android 14.<br>&nbsp;</p><p>&nbsp;</p><p><a href=\"https://genk.mediacdn.vn/139269124445442048/2023/12/7/006ruxyjgy1hkj529kd2tj31kw11xai2-1701934902816-17019349029551998457206.jpg\"><img src=\"https://genk.mediacdn.vn/thumb_w/640/139269124445442048/2023/12/7/006ruxyjgy1hkj529kd2tj31kw11xai2-1701934902816-17019349029551998457206.jpg\" alt=\"Cuộc đua độ sáng màn hình không hồi kết: OnePlus ra mắt smartphone có màn hình sáng 4500 nits cao nhất thế giới- Ảnh 4.\"></a></p><p>&nbsp;</p><p>Về giá bán, OnePlus 12 lên kệ tại thị trường Trung Quốc với giá khởi điểm từ 4299 tệ, tương đương khoảng 14,6 triệu đồng. Phiên bản cao cấp nhất 24GB/1TB có giá 5799 tệ, tương đương 19,8 triệu đồng.</p>', 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702026567/uploads_ecommerce_php_5_1/php16F5_fdtjcv.webp', 'cuoc-dua-do-sang-man-hinh-khong-hoi-ket-oneplus-ra-mat-smartphone-co-man-hinh-sang-4500-nits-cao-nhat-the-gioi-6572dd4875adf', 7, 1, '2023-12-08 16:09:30', '2023-12-08 16:09:30'),
(6, 4, 'Thay đổi trong thiết kế của Galaxy S24 Ultra', '<p>Smartphone cao cấp nhất dòng Galaxy S24 được cho là sẽ mỏng hơn, khay cắm bút S Pen, loa ngoài và nút bấm được thiết kế lại.</p><p>Trang công nghệ <i>PhoneArena </i>đăng một số hình ảnh nguyên mẫu của <a href=\"https://vnexpress.net/chu-de/samsung-galaxy-s24-ultra-6858\">Galaxy S24 Ultra</a> và so sánh với S23 Ultra hiện tại. Hai model có thiết kế giống nhau, nhưng Samsung đã tinh chỉnh nhiều chi tiết để tạo ra sự khác biệt, cải thiện trải nghiệm của người dùng.</p><p>Điểm cải tiến đầu tiên là bút S Pen trên S24 Ultra có phần đuôi phẳng, khi gắn vào sẽ ngang bằng với đế máy thay vì lồi lên như ở S23 Ultra. Nhờ đó khi sử dụng, phần tay để đỡ máy sẽ không bị còn bị cấn.</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/12/07/S24-Ultra-vs-S23-Ultra-leak-jp-1133-9558-1701962234.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=BPinmllLeswNh04OgUIIRg 1x, https://i1-sohoa.vnecdn.net/2023/12/07/S24-Ultra-vs-S23-Ultra-leak-jp-1133-9558-1701962234.jpg?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=1aY20Y2Ku8LHgUQmVWkXVw 1.5x, https://i1-sohoa.vnecdn.net/2023/12/07/S24-Ultra-vs-S23-Ultra-leak-jp-1133-9558-1701962234.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=MGQc7EXVcFd3pExgAHYvIQ 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/12/07/S24-Ultra-vs-S23-Ultra-leak-jp-1133-9558-1701962234.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=BPinmllLeswNh04OgUIIRg\" alt=\"Samsung Galaxy S23 Ultra (màu đen) và Galaxy S24 Ultra. Ảnh: PhoneArena\"></picture></p><p>Galaxy S23 Ultra (màu đen) và nguyên mẫy được cho là Galaxy S24 Ultra. Ảnh: <i>PhoneArena</i></p><p>Loa ngoài cũng được điều chỉnh, không còn thiết kế khoét nhiều lỗ mà chuyển thành đường cắt nhỏ gọn và đẹp mắt. Cổng USB-C và khay cắm sim vẫn giữ nguyên như trước.</p><p>Khung viền của S24 Ultra dày và ít bo cong hơn, nhưng độ dày tổng thể lại giảm từ 8,9 xuống 8,6 mm do thiết bị mới sử dụng màn hình phẳng. Hai nút bấm cứng là nút nguồn và âm lượng cũng có kích thước lớn hơn thế hệ trước. Trong khi đó, pin vẫn duy trì dung lượng 5.000 mAh.</p><p>Khi nhìn qua ảnh khó xác định vật liệu khung sườn, nhưng theo \"chuyên gia tin đồn\" Ice Universe, Galaxy S24 Ultra chắc chắn được trang bị khung bằng hợp kim titanium với độ bền cao hơn và tạo cảm giác cầm mượt hơn.</p><p><picture><source srcset=\"https://i1-sohoa.vnecdn.net/2023/12/07/S24-Ultra-vs-S23-Ultra-leak-2-1948-4760-1701962234.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=kaLASnY9dQ6_w4WLP7rDfg 1x, https://i1-sohoa.vnecdn.net/2023/12/07/S24-Ultra-vs-S23-Ultra-leak-2-1948-4760-1701962234.jpg?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=zd6kHvKfBRkHzmO4p4U3Lg 1.5x, https://i1-sohoa.vnecdn.net/2023/12/07/S24-Ultra-vs-S23-Ultra-leak-2-1948-4760-1701962234.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=SI5-LMtX57xI8--UnIQ2_A 2x\"><img src=\"https://i1-sohoa.vnecdn.net/2023/12/07/S24-Ultra-vs-S23-Ultra-leak-2-1948-4760-1701962234.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=kaLASnY9dQ6_w4WLP7rDfg\" alt=\"Samsung Galaxy S23 Ultra (màu đen) và Galaxy S24 Ultra. Ảnh: PhoneArena\"></picture></p><p>Galaxy S23 Ultra (đen) và Galaxy S24 Ultra. Ảnh: <i>PhoneArena</i></p><p>Về cấu hình, Galaxy S24 Ultra sẽ sử dụng chip xử lý mới nhất của Qualcomm là Snapdragon 8 Gen 3, còn điểm nâng cấp nổi bật trên hệ thống camera sau là ống kính tiềm vọng 50 megapixel với khả năng zoom quang 5x, thay cho ống tiềm vọng 10 megapixel hỗ trợ zoom quang 10x trên S23 Ultra.</p><p>Samsung dự kiến công dòng <a href=\"https://vnexpress.net/chu-de/samsung-galaxy-s24-6857\">Galaxy S24</a> với ba phiên bản S24, S24+ và S24 Ultra vào ngày 17/1 tại Mỹ.</p>', 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702026628/uploads_ecommerce_php_5_1/php703_ezyvzj.jpg', 'thay-doi-trong-thiet-ke-cua-galaxy-s24-ultra-6572dd85e5979', 10, 1, '2023-12-08 16:10:31', '2023-12-08 16:10:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status_id` int(11) NOT NULL DEFAULT 1,
  `total_money` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `fullname`, `phone`, `address`, `note`, `order_date`, `order_status_id`, `total_money`, `coupon_id`) VALUES
(3, 'EQdXo1700735589', 9, 'Trần Văn B', '0332225678', 'tanvnwdwdwd', '', '2023-11-23 17:33:09', 5, 250360000, 0),
(4, 'zbnbJ1700735682', 9, 'Trần Văn B', '0332225678', 'tanvnwdwdwd', '', '2023-10-23 17:35:26', 4, 147750000, 0),
(5, 'nXe9V1700742943', 4, 'tân', '0223339904', 'Dong anh HA NOI', '', '2023-11-23 19:35:43', 4, 133770000, 0),
(6, 'DF2Q91700743034', 4, 'tân ', '0332228859', 'Dong anh HA NOI', '', '2023-11-23 19:37:14', 4, 18861000, 0),
(7, 'Ujfhw1700924705', 10, 'tan c', '0990006780', 'Hà Nội', '', '2023-11-25 22:05:50', 5, 11270000, 0),
(8, 'cnz5M1700968091', 10, 'tan c', '0990006780', 'Hà Nội', '', '2023-11-26 10:10:33', 3, 7680000, 0),
(9, '5ZFhw1700968352', 10, 'tan c', '0990006780', 'Hà Nội 2', '', '2023-11-26 10:13:25', 3, 50980000, 0),
(10, 'ZRdR61701012945', 4, 'tân', '0333949402', 'Dong anh HA NOI', '', '2023-11-26 22:35:45', 4, 78560000, 1),
(11, 'EobYE1701436932', 4, 'Tân', '0332225690', 'Dong anh HA NOI', '', '2023-12-01 20:24:41', 4, 12960000, 0),
(12, 'fw5rB1701572590', 10, 'tan c', '0990006780', 'Hà nội', '', '2023-12-03 10:03:10', 5, 89800000, 0),
(13, 'mXoks1701572798', 10, 'tan c', '0990006780', 'Hà nội', '', '2023-12-03 10:06:38', 4, 75390000, 0),
(14, 'kdzPu1701745192', 10, 'tan c', '0990006780', 'Thanh hoá', '', '2023-12-05 10:01:06', 3, 2190000, 0),
(15, 'KLKxC1701872429', 10, 'tan c', '0990006780', 'Đông anh hà nội', '', '2023-12-06 21:20:29', 5, 808553647, 0),
(16, 'uZtQS1702047431', 4, 'Tân', '0332225690', 'Dong anh HA NOI', '', '2023-12-08 21:57:46', 4, 19976000, 5),
(17, '7GB5U1702089133', 9, 'Trần Văn B', '0332225678', 'Việt trì, Phú thọ', '', '2023-12-09 09:32:13', 4, 268470000, 0),
(18, 'eHb9f1702092444', 9, 'Trần Văn B', '0332229409', 'Việt trì, Phú thọ', '', '2023-12-09 10:27:48', 4, 27176000, 5),
(19, '4qdPd1702783078', 4, 'Tân ', '0992788902', 'Ha Noiu', '', '2023-12-17 10:17:58', 1, 126540000, 0),
(20, 'WfHlV1703253067', 34, 'Tan', '0993338590', 'Ha Noi', 'Giao nhanh giup toi', '2023-12-22 20:51:58', 4, 42380000, 6),
(21, 'vjOK91703592291', 35, 'Tan', '0332225690', 'Ha noi', 'Giao nhnah giup minh', '2023-12-26 19:05:15', 4, 22376000, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_variant_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_variant_id`, `price`, `quantity`, `total_money`) VALUES
(3, 2, 12, 35690000, 1, 35690000),
(4, 2, 13, 34890000, 2, 69780000),
(5, 2, 11, 5690000, 1, 5690000),
(6, 2, 9, 7990000, 2, 15980000),
(7, 3, 12, 35690000, 2, 71380000),
(8, 3, 1, 44900000, 2, 89800000),
(9, 3, 2, 44590000, 2, 89180000),
(10, 4, 2, 44590000, 3, 133770000),
(11, 4, 9, 7990000, 1, 7990000),
(12, 4, 8, 5990000, 1, 5990000),
(13, 5, 2, 44590000, 3, 133770000),
(14, 6, 32, 9990000, 1, 9990000),
(15, 6, 26, 3690000, 1, 3690000),
(16, 6, 29, 5181000, 1, 5181000),
(17, 7, 25, 3590000, 1, 3590000),
(18, 7, 26, 3690000, 1, 3690000),
(19, 7, 28, 3990000, 1, 3990000),
(20, 8, 26, 3690000, 1, 3690000),
(21, 8, 28, 3990000, 1, 3990000),
(22, 9, 18, 25990000, 1, 25990000),
(23, 9, 21, 24990000, 1, 24990000),
(24, 10, 28, 3990000, 1, 3990000),
(25, 10, 21, 24990000, 3, 74970000),
(26, 11, 25, 3590000, 3, 10770000),
(27, 11, 33, 2190000, 1, 2190000),
(28, 12, 1, 44900000, 2, 89800000),
(29, 13, 25, 3590000, 21, 75390000),
(30, 14, 33, 2190000, 1, 2190000),
(31, 15, 42, 23490000, 33, 775170000),
(32, 15, 15, 21990000, 3, 65970000),
(33, 16, 28, 3990000, 2, 7980000),
(34, 16, 75, 16990000, 1, 16990000),
(35, 17, 1, 44900000, 3, 134700000),
(36, 17, 2, 44590000, 3, 133770000),
(37, 18, 61, 11990000, 1, 11990000),
(38, 18, 63, 10990000, 2, 21980000),
(39, 19, 25, 3590000, 1, 3590000),
(40, 19, 14, 22990000, 2, 45980000),
(41, 19, 21, 24990000, 1, 24990000),
(42, 19, 18, 25990000, 2, 51980000),
(43, 20, 13, 34890000, 1, 34890000),
(44, 20, 72, 7990000, 1, 7990000),
(45, 21, 8, 5990000, 1, 5990000),
(46, 21, 60, 10990000, 2, 21980000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `description`) VALUES
(1, 'Chờ xác nhận', 'Chờ xác nhận từ người bán'),
(2, 'Đang chuẩn bị', 'Chuẩn bị giao hàng'),
(3, 'Đang giao hàng', 'Đang giao hàng'),
(4, 'Đã giao hàng', 'Giao hàng hoàn tất'),
(5, 'Đã huỷ', 'Huỷ giao hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `payment_transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `payment_method_id`, `payment_transaction_id`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 1),
(3, 3, 1, 0),
(4, 4, 2, 2),
(5, 5, 1, 0),
(6, 6, 1, 0),
(7, 7, 2, 3),
(8, 8, 3, 4),
(9, 9, 3, 5),
(10, 10, 1, 0),
(11, 11, 2, 6),
(12, 12, 1, 0),
(13, 13, 1, 0),
(14, 14, 3, 7),
(15, 15, 1, 0),
(16, 16, 2, 8),
(17, 17, 1, 0),
(18, 18, 2, 9),
(19, 19, 1, 0),
(20, 20, 2, 10),
(21, 21, 2, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `display_name`, `description`, `thumb`, `status`) VALUES
(1, 'cash_on_delivery', 'Thanh toán khi nhận hàng', 'Thanh toán bằng tiền mặt khi giao hàng.', 'https://phuhungthinh.com/wp-content/uploads/2022/08/thanh-toan.png', 1),
(2, 'vnpay', 'VNPAY', 'Thanh toán qua VNPAY, bạn có thể thanh toán bằng thẻ tín dụng nếu bạn không có tài khoản VNPAY.', 'https://vnpay.vn/s1/statics.vnpay.vn/2023/6/0oxhzjmxbksr1686814746087.png', 1),
(3, 'momo', 'MOMO', 'Thanh toán qua MOMO, bạn có thể thanh toán bằng thẻ tín dụng nếu bạn không có tài khoản MOMO.', 'https://developers.momo.vn/v3/assets/images/icon-52bd5808cecdb1970e1aeec3c31a3ee1.png', 1),
(4, 'onepay', 'ONEPAY', 'Thanh toán qua ONEPAY, bạn có thể thanh toán bằng thẻ tín dụng nếu bạn không có tài khoản ONEPAY.', 'https://play-lh.googleusercontent.com/mvedVCbQg6ADKUYYraVLOlmOfOy2Rz66kEPvbmxt5xZ2TTa90Go9jBD2dJrwWmEo5g8', 0),
(6, 'thu nghiem', 'Thử nghiệm', 'ưdwdwdwdw', 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700730034/uploads_ecommerce_php_5_1/php2420_ww14or.png', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_transactions`
--

CREATE TABLE `payment_transactions` (
  `id` int(11) NOT NULL,
  `bankCode` varchar(50) NOT NULL,
  `bankTranNo` varchar(50) NOT NULL,
  `cardType` varchar(50) NOT NULL,
  `payDate` bigint(11) NOT NULL,
  `transactionNo` varchar(50) NOT NULL,
  `secureHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_transactions`
--

INSERT INTO `payment_transactions` (`id`, `bankCode`, `bankTranNo`, `cardType`, `payDate`, `transactionNo`, `secureHash`) VALUES
(1, 'NCB', 'VNP14190170', 'ATM', 2147483647, '14190170', '46354236749fe0d42ce472b676e9e7fef15c4066baf4cce52a678afae085bb1f4f1875273bdf637195df90700b8e1950254dd8ff1b3a831c023192e449d28d46'),
(2, 'NCB', 'VNP14195094', 'ATM', 2147483647, '14195094', '2589e637f110a2b0b34797ac488a8e21ada7c658e3cb65ede570121367a849c26885246f3e2365fcf0b58c5dc93242fe7d4d03b361dbaacaafe7e5ec01a6bc9b'),
(3, 'NCB', 'VNP14200362', 'ATM', 2147483647, '14200362', 'fc0bae76b46bed13909d170f23f384e87686656a435b6f42686ff91b0ebb3f33fe92e5f54420f3df236dd12fc92070b4637933f0c05dfcee407edb72710c0ece'),
(4, 'SML', '3135486376', 'napas', 2147483647, '3135486376', 'd31b283780b9a651118939cfc1f7f4f1972609388fe084686ea077c5a1a00ef6'),
(5, 'SML', '3135486464', 'napas', 1700968410, '3135486464', '3634134f31e7d9f8fc69cdd3c28aabdd7413b6db2c61afb3c1a928a492985322'),
(6, 'NCB', 'VNP14214760', 'ATM', 20231201202350, '14214760', '4036f8ba7a0653bad86325fa58140be84e7069b119cd7728fb7553281017552155222d45a775894bce8368a2731d32c7a02bc343347ea85fa302b0345653bf32'),
(7, 'SML', '3105810206', 'napas', 1701745266, '3105810206', 'c5dfd56ee6194ed72dd4b955559ad1fc8b8a70862055294aed34fac9c15563b2'),
(8, 'NCB', 'VNP14229434', 'ATM', 20231208215739, '14229434', '9dfb04c4b18e779a21c79dc2100ab5166045499dcf53fb73b67d90d0201b82be0ec61108469ab87d9484d8dee819e6114e593afe0f3f45840b75cc8bbc1a6c27'),
(9, 'NCB', 'VNP14230340', 'ATM', 20231209102740, '14230340', '6e5ea93201b2804a5d2ecf0518a5e29aed7813d63c457b09225231f57f61d50c2f3c14aae99eeab2fc76e36f15a4b73c3a4a9e6a9a6e748e237cc95b3ff5cbfa'),
(10, 'NCB', 'VNP14257261', 'ATM', 20231222205146, '14257261', 'ab85cc90de41da6538c60631961b96872234c5c22d24c867f6f592a9da0d89dfd339e7e2458904988f0738b9f905004ad37a5d0fa440442db781c1eb82db9981'),
(11, 'NCB', 'VNP14261397', 'ATM', 20231226190501, '14261397', '1e52342333d3cb2f3c3494f681c67f9bfc9d145bdaf792b9fab74597ab375d9941e093d9630ae6c284a66cc1dd73fe84f9594ac41c89d8c367e29f90b01ed99a');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` smallint(6) NOT NULL DEFAULT 0,
  `isVariant` tinyint(4) NOT NULL DEFAULT 0,
  `sold` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `thumb` text NOT NULL,
  `totalRatings` float NOT NULL DEFAULT 0,
  `totalUserRatings` mediumint(9) NOT NULL DEFAULT 0,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `cate_id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `view` mediumint(9) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `title`, `brand_id`, `price`, `discount`, `isVariant`, `sold`, `quantity`, `thumb`, `totalRatings`, `totalUserRatings`, `short_description`, `description`, `cate_id`, `slug`, `status`, `view`, `create_at`, `update_at`) VALUES
(83, 'Điện thoại iPhone 15 Pro Max 256GB', 1, 34990000, 0, 1, 9, 190, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700490487/uploads_ecommerce_php_5_1/phpF4DB_duz3b2.jpg', 4.33, 3, '<p>iPhone 15 Pro Max&nbsp;1 TB thực sự là một siêu phẩm kết hợp đầy đủ các tinh hoa trên một chiếc flagship của Apple. Với bộ vi xử lý Apple A17 Pro mạnh mẽ đang đi đầu trong cuộc đua về hiệu năng và camera 48 MP siêu sắc nét, từ đó bạn có thể trải nghiệm mọi ứng dụng và tác vụ một cách mượt mà và nhanh chóng hay thực hiện việc quay chụp với nội dung cho ra được chất lượng cao.</p>', '<figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-131023-034959.jpg\" alt=\"iPhone 15 Pro Max Tổng quan\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-131023-035001.jpg\" alt=\"iPhone 15 Pro Max Thông số kỹ thuật và tính năng\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-131023-035003.jpg\" alt=\"iPhone 15 Pro Max So sánh\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-131023-035005.jpg\" alt=\"iPhone 15 Pro Max Chuyển đổi\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-131023-035007.jpg\" alt=\"iPhone 15 Pro Max Phụ kiện\"></figure><h3><strong>So sánh iPhone 15 Pro Max 1 TB và các sản phẩm iPhone 15 Series khác?</strong></h3><figure class=\"table\"><table><tbody><tr><td><strong>Tiêu chí</strong></td><td><strong>iPhone 15 Pro Max 1 TB</strong></td><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-pro-1tb\"><strong>iPhone 15 Pro 1 TB</strong></a></td><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-plus-512gb\"><strong>iPhone 15 Plus 512 GB</strong></a></td><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-512gb\"><strong>iPhone 15 512 GB</strong></a></td></tr><tr><td>Màn hình</td><td><p>&nbsp; &nbsp;• Kích thước: 6.7 inch</p><p>&nbsp; &nbsp;• Super Retina XDR OLED</p><p>&nbsp; &nbsp;• Công nghệ ProMotion</p><p>&nbsp; &nbsp;• Dynamic Island</p><p>&nbsp; &nbsp;• 2796 x 1290 pixels</p></td><td><p>&nbsp; &nbsp;• Kích thước: 6.1 inch</p><p>&nbsp; &nbsp;• Super Retina XDR OLED</p><p>&nbsp; &nbsp;• Công nghệ ProMotion</p><p>&nbsp; &nbsp;• Dynamic Island</p><p>&nbsp; &nbsp;• 2556 x 1179 pixels</p></td><td><p>&nbsp; &nbsp;• Kích thước: 6.7 inch</p><p>&nbsp; &nbsp;• Super Retina XDR OLED</p><p>&nbsp; &nbsp;• Dynamic Island</p><p>&nbsp; &nbsp;• 2796 x 1290 pixels</p></td><td><p>&nbsp; &nbsp;• Kích thước: 6.1 inch</p><p>&nbsp; &nbsp;• Super Retina XDR OLED</p><p>&nbsp; &nbsp;• Dynamic Island</p><p>&nbsp; &nbsp;• 2556 x 1179 pixels</p></td></tr><tr><td>Kích thước và khối lượng</td><td><p>&nbsp; &nbsp;• 159.9 mm x 76.7 mm x 8.25 mm</p><p>&nbsp; &nbsp;• 221 gram</p></td><td><p>&nbsp; &nbsp;• 146.6 mm x 70.6 mm x 8.25 mm</p><p>&nbsp; &nbsp;• 187g</p></td><td><p>&nbsp; &nbsp;• 160.9 mm x 77.8 mm x 7.8 mm</p><p>&nbsp; &nbsp;• 201 gram</p></td><td><p>&nbsp; &nbsp;• 147.6 mm x 71.6 mm x 7.8 mm</p><p>&nbsp; &nbsp;• 171 gram</p></td></tr><tr><td>Khung viền</td><td>Titanium</td><td>Titanium</td><td>Nhôm</td><td>Nhôm</td></tr><tr><td>Chip</td><td>Apple A17 Pro</td><td>Apple A17 Pro</td><td>Apple A16 Bionic</td><td>Apple A16 Bionic</td></tr><tr><td>Dung lượng</td><td><p>&nbsp; &nbsp;• 256GB</p><p>&nbsp; &nbsp;• 512GB</p><p>&nbsp; &nbsp;• 1TB</p></td><td><p>&nbsp; &nbsp;• 128GB</p><p>&nbsp; &nbsp;• 256GB</p><p>&nbsp; &nbsp;• 512GB</p><p>&nbsp; &nbsp;• 1TB</p></td><td><p>&nbsp; &nbsp;• 128GB</p><p>&nbsp; &nbsp;• 256GB</p><p>&nbsp; &nbsp;• 512GB</p></td><td><p>&nbsp; &nbsp;• 128GB</p><p>&nbsp; &nbsp;• 256GB</p><p>&nbsp; &nbsp;• 512GB</p></td></tr><tr><td>Camera</td><td><p>&nbsp; &nbsp;• Camera trước: 12MP, f/1.9</p><p>&nbsp; &nbsp;• Camera chính: 48MP, f/1.78</p><p>&nbsp; &nbsp;• Camera góc siêu rộng: 12MP, f/2.2</p><p>&nbsp; &nbsp;• Camera Telephoto: 12MP, f/2.8, khả năng zoom 2x và 5x</p></td><td><p>&nbsp; &nbsp;• Camera trước: 12MP, f/1.9</p><p>&nbsp; &nbsp;• Camera chính: 48MP, f/1.78</p><p>&nbsp; &nbsp;• Camera góc siêu rộng: 12MP, f/2.2</p><p>&nbsp; &nbsp;• Camera Telephoto: 12MP, f/2.8, khả năng zoom 2x và 3x</p></td><td><p>&nbsp; &nbsp;• Camera trước: 12MP, f/1.9</p><p>&nbsp; &nbsp;• Camera chính: 48MP, f/1.6</p><p>&nbsp; &nbsp;• Camera góc siêu rộng: 12MP, f/2.4</p></td><td><p>&nbsp; &nbsp;• Camera trước: 12MP, f/1.9</p><p>&nbsp; &nbsp;• Camera chính: 48MP, f/1.6</p><p>&nbsp; &nbsp;• Camera góc siêu rộng: 12MP, f/2.4</p></td></tr><tr><td>Nút tác vụ</td><td>Có</td><td>Có</td><td>Không</td><td>Không</td></tr><tr><td>Thời lượng pin</td><td><p>&nbsp; &nbsp;• Nghe nhạc: 95 tiếng</p><p>&nbsp; &nbsp;• Xem video: 29 tiếng</p><p>&nbsp; &nbsp;• Xem video (trực tuyến): 25 tiếng</p></td><td><p>&nbsp; &nbsp;• Nghe nhạc: 75 tiếng</p><p>&nbsp; &nbsp;• Xem video: 23 tiếng</p><p>&nbsp; &nbsp;• Xem video (trực tuyến): 20 tiếng</p></td><td><p>&nbsp; &nbsp;• Nghe nhạc: 100 tiếng</p><p>&nbsp; &nbsp;• Xem video: 26 tiếng</p><p>&nbsp; &nbsp;• Xem video (trực tuyến): 20 tiếng</p></td><td><p>&nbsp; &nbsp;• Nghe nhạc: 80 tiếng</p><p>&nbsp; &nbsp;• Xem video: 20 tiếng</p><p>&nbsp; &nbsp;• Xem video (trực tuyến): 16 tiếng</p></td></tr><tr><td>Cảm biến</td><td>Cảm biến tiệm cận</td><td>Cảm biến tiệm cận</td><td>Cảm biến tiệm cận</td><td>Cảm biến tiệm cận</td></tr><tr><td>Cổng kết nối</td><td>USB-C hỗ trợ USB 3</td><td>USB-C hỗ trợ USB 3</td><td>USB-C hỗ trợ USB 2</td><td>USB-C hỗ trợ USB 2</td></tr><tr><td>Màu sắc</td><td>Titan tự nhiên (Natural Titanium), Titan trắng (White Titanium), Titan đen (Black Titanium), Titan xanh (Blue Titanium)</td><td>Titan tự nhiên (Natural Titanium), Titan trắng (White Titanium), Titan đen (Black Titanium), Titan xanh (Blue Titanium)</td><td>Đen (Black), Xanh lá (Green), Vàng (Yellow), Hồng (Pink) và Xanh dương (Blue)</td><td>Đen (Black), Xanh lá (Green), Vàng (Yellow), Hồng (Pink) và Xanh dương (Blue)</td></tr></tbody></table></figure><h3><br>So sánh iPhone 15 Pro Max&nbsp;1 TB và iPhone 14 Pro Max 1 TB: Có đáng để nâng cấp?</h3><p>Dưới đây sẽ là bảng tổng hợp thông số kỹ thuật giữa hai thế hệ&nbsp;<a href=\"https://www.thegioididong.com/dtdd-apple-iphone\">điện thoại iPhone</a>:</p><figure class=\"table\"><table><tbody><tr><td><strong>Tiêu chí</strong></td><td><strong>iPhone 15 Pro Max 1 TB</strong></td><td><strong>iPhone 14 Pro Max 1 TB</strong></td></tr><tr><td><strong>Màn hình</strong></td><td><p>&nbsp; •&nbsp;Kích thước: 6.7 inch</p><p>&nbsp; •&nbsp;Super Retina XDR OLED</p><p>&nbsp; •&nbsp;Công nghệ ProMotion</p><p>&nbsp; •&nbsp;Công nghệ True Tone</p><p>&nbsp; •&nbsp;Dynamic Island</p><p>&nbsp; •&nbsp;2796 x 1290 pixels</p></td><td><p>&nbsp; •&nbsp;Kích thước: 6.7 inch</p><p>&nbsp; •&nbsp;Super Retina XDR OLED</p><p>&nbsp; •&nbsp;Công nghệ True Tone</p><p>&nbsp; •&nbsp;Công nghệ ProMotion</p><p>&nbsp; •&nbsp;Dynamic Island</p><p>&nbsp; •&nbsp;2796 x 1290 pixels</p></td></tr><tr><td><strong>Kích thước và khối lượng</strong></td><td><p>&nbsp;<strong>&nbsp;•&nbsp;159.9 mm x 76.7 mm x 8.25 mm</strong></p><p><strong>&nbsp; •&nbsp;221 gram</strong></p></td><td><p>&nbsp; •&nbsp;160.7 mm x 77.6 mm x 7.85 mm</p><p>&nbsp; •&nbsp;240 gram</p></td></tr><tr><td><strong>Khung viền</strong></td><td><strong>Titanium</strong></td><td>Kim loại thép không gỉ</td></tr><tr><td><strong>Chip</strong></td><td><strong>Apple A17 Pro</strong></td><td>Apple A16 Bionic</td></tr><tr><td><strong>RAM</strong></td><td><strong>8 GB</strong></td><td>6 GB</td></tr><tr><td><strong>Bộ nhớ trong</strong></td><td>256 GB, 512 GB, 1 TB</td><td><strong>128 GB</strong>, 256 GB, 512 GB, 1 TB</td></tr><tr><td><strong>Camera</strong></td><td><p>&nbsp; •&nbsp;Camera trước: 12MP, f/1.9</p><p>&nbsp; •&nbsp;Camera chính: 48MP, f/1.78</p><p>&nbsp; •&nbsp;Camera góc siêu rộng: 12MP, f/2.2</p><p>&nbsp; •<strong>&nbsp;Camera Telephoto: 12MP, f/2.8, khả năng zoom 2x và 5x</strong></p></td><td><p>&nbsp; •&nbsp;Camera trước: 12MP</p><p>&nbsp; •&nbsp;Camera chính: 48MP, f/1.78</p><p>&nbsp; •&nbsp;Camera góc siêu rộng: 12MP, f/2.2</p><p>&nbsp; •&nbsp;Camera Telephoto: 12MP, f/2.8 khả năng zoom 2x, 3x</p></td></tr><tr><td><strong>Nút tác vụ</strong></td><td><strong>Action Button</strong></td><td>Cần gạt</td></tr><tr><td><strong>Dung lượng pin</strong></td><td><strong>4422 mAh</strong></td><td>4323 mAh</td></tr><tr><td><strong>Thời lượng pin</strong></td><td><p>&nbsp; •&nbsp;Nghe nhạc: 95 tiếng</p><p>&nbsp; •&nbsp;Xem video: 29 tiếng</p><p>&nbsp; •&nbsp;Xem video (trực tuyến): 25 tiếng</p></td><td><p>&nbsp; •&nbsp;Nghe nhạc: 95 tiếng</p><p>&nbsp; •&nbsp;Xem video: 29 tiếng</p><p>&nbsp; •&nbsp;Xem video (trực tuyến): 25 tiếng</p></td></tr><tr><td><strong>Cảm biến</strong></td><td><p>&nbsp; •&nbsp;LiDAR Scanner</p><p>&nbsp; •&nbsp;Face ID</p><p>&nbsp; •&nbsp;Con quay hồi chuyển độ lệch tương phản cao</p><p>&nbsp; •&nbsp;Gia tốc kế lực G cao</p><p>&nbsp; •&nbsp;Cảm biến tiệm cận</p><p>&nbsp; •&nbsp;Hai cảm biến ánh sáng môi trường</p><p>&nbsp; •&nbsp;Áp kế</p></td><td><p>&nbsp; •&nbsp;LiDAR Scanner</p><p>&nbsp; •&nbsp;Face ID</p><p>&nbsp; •&nbsp;Con quay hồi chuyển độ lệch tương phản cao</p><p>&nbsp; •&nbsp;Gia tốc kế lực G cao</p><p>&nbsp; •&nbsp;Cảm biến tiệm cận</p><p>&nbsp; •&nbsp;Hai cảm biến ánh sáng môi trường</p><p>&nbsp; •&nbsp;Áp kế</p></td></tr><tr><td><strong>Cổng kết nối</strong></td><td><strong>USB-C hỗ trợ USB 3</strong></td><td>Lightning hỗ trợ USB 2</td></tr><tr><td><strong>Công suất sạc</strong></td><td>20 W</td><td>20 W</td></tr><tr><td><strong>Thời gian sạc</strong></td><td>Sạc tới 50% trong 35 phút</td><td>Sạc tới 50% trong 35 phút</td></tr><tr><td><strong>Màu sắc</strong></td><td><strong>Titan tự nhiên (Natural Titanium), Titan trắng (White Titanium), Titan đen (Black Titanium), Titan xanh (Blue Titanium)</strong></td><td>Vàng, Đen, Bạc, Tím</td></tr><tr><td><strong>Kết nối</strong></td><td><strong>Wi‑Fi 6E</strong>, 5G</td><td>Wi‑Fi 6, 5G</td></tr></tbody></table></figure><h3>Trong thế giới công nghệ ngày càng phát triển, <a href=\"https://www.thegioididong.com/dtdd/iphone-15-pro-max-1tb\">iPhone 15&nbsp;Pro&nbsp;Max&nbsp;1 TB</a> nổi bật như một điện thoại thông minh hoàn hảo, kết hợp sự mạnh mẽ của công nghệ và sự sáng tạo không giới hạn. Chiếc điện thoại này không chỉ đem lại hiệu năng vượt trội mà còn mang đến khả năng chụp ảnh xuất sắc, tạo nên một trải nghiệm hoàn hảo cho người dùng.</h3><h3>Diện mạo sang trọng, cứng cáp</h3><p>iPhone 15 Pro Max&nbsp;1 TB vẫn duy trì thiết kế vuông vắn và đẳng cấp đã làm nên tên tuổi của dòng sản phẩm này. Việc giữ nguyên dáng vẻ truyền thống không chỉ thể hiện sự sang trọng, thanh lịch mà còn giúp người dùng nhận ra ngay lập tức rằng đây là một chiếc iPhone.<br>&nbsp;<br>Là một sự thay đổi quan trọng, iPhone 15 Pro Max&nbsp;1 TB đã từ bỏ chất liệu khung thép không gỉ quen thuộc để chuyển sang sử dụng khung Titanium. Điều này không chỉ làm cho chiếc điện thoại trở nên cứng cáp hơn mà còn giúp giảm khối lượng tổng thể, mang lại sự thoải mái hơn khi sử dụng trong thời gian dài.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-130923-102854.jpg\" alt=\"Thiết kế điện thoại - iPhone 15 Pro Max\"></figure><p>Mặt lưng của iPhone 15 Pro Max&nbsp;1 TB được làm từ kính cường lực cao cấp và chế tạo theo kiểu nhám, tạo nên một vẻ đẹp độc đáo và tạo điểm nhấn cho thiết kế tổng thể. Đồng thời, vật liệu này cũng làm cho chiếc điện thoại trở nên kháng trầy xước và hạn chế bám vân tay tốt hơn.</p><p>Dynamic Island là một tính năng độc đáo trên iPhone 15 Pro Max&nbsp;1 TB. Đây là tính năng hoạt động trên phần hình notch dạng viên thuốc của màn hình, cho phép người dùng truy cập nhanh các ứng dụng và chức năng thông qua các biểu tượng động. Điều này giúp tối ưu hóa sự tiện lợi và tăng hiệu suất của người dùng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-130923-103025.jpg\" alt=\"Thiết kế điện thoại - iPhone 15 Pro Max\"></figure><h3>Sử dụng cổng Type-C thay vì Lightning</h3><p>Một trong những sự thay đổi quan trọng nhất trong thiết kế của iPhone 15 Pro Max&nbsp;1 TB là việc chuyển từ cổng Lightning quen thuộc sang cổng Type-C tiêu chuẩn. Quyết định này đánh dấu sự tiến bộ và sự đổi mới của Apple trong việc cung cấp cho người dùng một trải nghiệm kết nối hiện đại và linh hoạt hơn.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/usb-type-c-chuan-muc-cong-ket-noi-moi-723760\">USB Type C là gì? Có ưu nhược điểm gì so với những USB truyền thống?</a></p><p>Với cổng Type-C trên iPhone 15 Pro Max&nbsp;1 TB, người dùng có thể nhanh chóng chia sẻ dữ liệu, sạc pin và kết nối với các phụ kiện mà họ có thể sử dụng hằng ngày mà không cần phải tìm kiếm cáp chuyển đổi.</p><h3>Trang bị ba camera sau đỉnh cao</h3><p>Về phần máy ảnh, điện thoại tích hợp 3 camera trong đó bao gồm: Camera chính 48 MP, camera tele 12 MP và camera góc siêu rộng 12 MP.</p><p>Với độ phân giải 48 MP, những chi tiết nhỏ nhất được tái tạo một cách tinh tế và khả năng chụp ảnh trong điều kiện ánh sáng yếu là điểm đáng chú ý. Cho dù bạn đang chụp cảnh thiên nhiên tươi đẹp hay chia sẻ những khoảnh khắc gia đình, camera chính luôn mang lại những bức ảnh sắc nét và sống động.</p><p>iPhone 15 Pro Max&nbsp;1 TB không chỉ là một công cụ tuyệt vời cho nhiếp ảnh mà còn cho việc quay video chất lượng cao. Với khả năng quay video 4K ở tốc độ khung hình 60 fps, bạn sẽ có những video mượt mà và sắc nét.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-130923-103905.jpg\" alt=\"Camera điện thoại - iPhone 15 Pro Max\"></figure><p>Nếu bạn là người yêu thích thể thao và hoạt động ngoài trời, tính năng quay video 2.8K Action Mode sẽ là sự lựa chọn hoàn hảo. Đây là một công cụ mạnh mẽ để bạn ghi lại những hoạt động mạo hiểm và độc đáo của mình với hình ảnh ổn định và sắc nét.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-130923-103910.jpg\" alt=\"Camera điện thoại - iPhone 15 Pro Max\"></figure><h3>Sử dụng màn hình OLED tần số quét cao</h3><p>Với công nghệ OLED, màn hình trên iPhone 15 Pro Max&nbsp;1 TB cung cấp màu sắc với độ tương phản và độ sáng đỉnh cao. Điều này làm cho mọi màu sắc trở nên sống động và chân thực. Bạn có thể thấy từng gam màu với độ tinh tế và phong cách riêng biệt.</p><p>Công nghệ OLED hoạt động bằng cách tự phát sáng từ từng điểm ảnh trên màn hình. Điều này có nghĩa là mỗi điểm ảnh có khả năng tự điều chỉnh độ sáng của mình mà không cần đèn nền. Kết quả là màu sắc được tái hiện vô cùng chính xác và màn hình có thể tắt từng pixel độc lập để cho ra độ tương phản cao.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-oled-la-gi-905762\">Màn hình OLED là gì? Có gì nổi bật? Thiết bị nào có màn hình OLED?</a></p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-130923-104241.jpg\" alt=\"Màn hình điện thoại - iPhone 15 Pro Max\"></figure><p>Màn hình của iPhone 15 có độ phân giải 1290 x 2796 pixels, có nghĩa là mọi điểm ảnh trên màn hình rất nhỏ và gần như không thể thấy bằng mắt thường. Mỗi pixel nhỏ xíu này đều hoạt động cùng nhau để tái hiện mọi chi tiết và đường nét với sự chính xác tuyệt đối. Điều này tạo nên hình ảnh sắc nét và sâu lắng, cho phép bạn thấy từng đặc điểm nhỏ nhất trong mọi hình ảnh.</p><p>Với kích thước lớn lên đến 6.7 inch, màn hình của iPhone 15 Pro Max&nbsp;1 TB cung cấp một không gian rộng rãi và thoải mái để xem nội dung. Điều này làm cho việc duyệt web, xem video, thậm chí chơi game trên điện thoại trở nên đặc biệt thú vị. Bạn có thể đắm chìm hoàn toàn vào nội dung mà bạn yêu thích và màn hình lớn giúp tận hưởng mọi chi tiết một cách tối ưu.</p><p>Màn hình iPhone 15 Pro Max&nbsp;1 TB được hỗ trợ tần số quét lên tới 120 Hz, giúp mang lại trải nghiệm mượt mà và đáng kinh ngạc cho việc cuộn trang, chơi game và xem video. Khả năng hiển thị nhanh mượt này làm cho mọi tương tác trên màn hình trở nên thích tay và đã mắt hơn.</p><p>Độ sáng của màn hình iPhone 15 Pro Max&nbsp;1 TB cũng ấn tượng, với khả năng đạt tới 2000 nits. Điều này cho phép bạn sử dụng điện thoại một cách dễ dàng dù trong điều kiện ánh sáng mặt trời mạnh mẽ và nội dung trên màn hình luôn rõ ràng và dễ đọc.</p><h3>Hỗ trợ sạc nhanh</h3><p>iPhone 15 Pro Max&nbsp;1 TB được trang bị một viên pin dung lượng lớn, giúp bạn sử dụng điện thoại một cách thoải mái suốt cả ngày. Dù bạn đang duyệt web, xem video hoặc sử dụng ứng dụng nặng, pin của chiếc iPhone này sẽ đảm bảo bạn không bị gián đoạn bởi việc phải sạc lại liên tục.</p><p>Để đảm bảo bạn không mất quá nhiều thời gian để sạc lại pin, iPhone 15 Pro Max&nbsp;1 TB hỗ trợ công nghệ sạc nhanh 20 W. Điều này có nghĩa là bạn có thể sạc từ 0% lên đến mức đủ dùng trong thời gian ngắn, giúp bạn tiết kiệm thời gian và luôn sẵn sàng cho mọi nhiệm vụ.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-130923-104602.jpg\" alt=\"Pin và sạc điện thoại - iPhone 15 Pro Max\"></figure><p>Không chỉ có dung lượng pin lớn và sạc nhanh, iPhone 15 Pro Max&nbsp;1 TB còn được trang bị tính năng quản lý năng lượng thông minh thông qua iOS 17. Điều này giúp tối ưu hóa hiệu suất pin, đảm bảo rằng năng lượng được sử dụng hiệu quả mà không lãng phí. Bạn có thể sử dụng điện thoại một cách thông minh mà không cần lo lắng về việc pin sẽ cạn sớm.</p><h3>Hiệu năng bức phá mọi giới hạn</h3><p>Apple luôn nắm vững quyền kiểm soát và phát triển chip xử lý riêng và Apple A17 Pro không phải là ngoại lệ. Với hiệu năng mạnh mẽ, bộ vi xử lý này giúp iPhone 15 Pro Max&nbsp;1 TB chạy mượt mà, đáng tin cậy và nhanh chóng. Bạn có thể thực hiện nhiều tác vụ khó khăn mà không gặp trở ngại nào.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chip-a17-bionic-tien-trinh-3nm-tien-tien-1522727\">Chip Apple A17 Pro - Tiến trình 3nm tiên tiến, hiệu năng cực khủng</a></p><p>Với 8 GB RAM, chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd-choi-game\">điện thoại chơi game cấu hình cao</a>&nbsp;này&nbsp;sẽ không bao giờ bị gián đoạn hay giật lag. Điều này đặc biệt hữu ích khi bạn chơi game, chỉnh sửa video hoặc xử lý ứng dụng đòi hỏi tài nguyên nhiều. Bạn có thể dễ dàng chuyển đổi giữa các ứng dụng mà không gặp trục trặc.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/299033/iphone-15-pro-130923-104358.jpg\" alt=\"Cấu hình điện thoại - iPhone 15 Pro Max\"></figure><p>Hệ điều hành iOS 17 mang đến nhiều cải tiến đáng kể về tính năng và hiệu năng. Nó tối ưu hóa tương tác giữa phần cứng và phần mềm, giúp điện thoại hoạt động mượt mà và tiết kiệm pin. Các tính năng mới và cải tiến trong iOS 17 giúp bạn làm việc, giải trí và duyệt web một cách nhanh chóng và thuận tiện.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/toan-bo-thong-tin-ve-ios-17-ngay-ra-mat-tinh-nang-1525071\">iOS 17 chính thức: Khi nào ra mắt, có gì mới, hỗ trợ máy nào?</a></p><h3>Có nên mua iPhone 15 Pro Max&nbsp;1 TB?</h3><p>iPhone 15 Pro Max&nbsp;1 TB là một chiếc điện thoại thông minh cao cấp với nhiều ưu điểm nổi bật, bao gồm thiết kế đẹp mắt, hiệu năng mạnh mẽ, camera tuyệt vời và mức giá hợp lý. Nếu bạn đang tìm kiếm một chiếc điện thoại có thể đáp ứng tốt mọi nhu cầu sử dụng, thì iPhone 15 Pro Max là một lựa chọn đáng cân nhắc.</p><h3>Lý do chọn mua iPhone 15 Pro Max&nbsp;1 TB tại Thế Giới Di Động</h3><p>iPhone 15 Pro Max&nbsp;1 TB là một chiếc điện thoại thông minh cao cấp được mong đợi nhất năm 2023. Với nhiều tính năng mới và cải tiến, iPhone 15&nbsp;Pro Max&nbsp;1 TB chắc chắn sẽ là một lựa chọn tuyệt vời cho những người dùng đang tìm kiếm một chiếc điện thoại có hiệu năng mạnh mẽ, camera chất lượng và thiết kế sang trọng.</p><p><strong>•&nbsp;Sản phẩm chính hãng, đảm bảo chất lượng:&nbsp;</strong>Thế Giới Di Động là nhà bán lẻ điện thoại di động lớn nhất Việt Nam, cam kết cung cấp sản phẩm chính hãng, đảm bảo chất lượng. Bạn có thể yên tâm về xuất xứ sản phẩm và có thể tận hưởng trải nghiệm sử dụng tốt nhất.</p><p><strong>•&nbsp;Ưu đãi và khuyến mãi hấp dẫn:</strong>&nbsp;Thế Giới Di Động thường xuyên có các chương trình khuyến mãi, giảm giá và tặng quà kèm, giúp bạn tiết kiệm được một khoản tiền khi mua iPhone 15&nbsp;Pro Max&nbsp;1 TB.</p><p><strong>•&nbsp;Hệ thống cửa hàng rộng khắp:</strong>&nbsp;Thế Giới Di Động có mạng lưới cửa hàng rộng khắp trên toàn quốc, giúp bạn dễ dàng tìm được một cửa hàng gần nhà để mua sắm. Bạn cũng có thể trực tiếp kiểm tra sản phẩm và nhận sự hỗ trợ từ nhân viên tại cửa hàng.</p><p><strong>•&nbsp;Dịch vụ hậu mãi chuyên nghiệp:&nbsp;</strong>Thế Giới Di Động cung cấp dịch vụ hậu mãi chuyên nghiệp, bao gồm bảo hành, sửa chữa và hỗ trợ kỹ thuật. Điều này giúp bạn yên tâm về việc sử dụng trong thời gian dài.</p><p><strong>•&nbsp;Trả góp linh hoạt:</strong>&nbsp;Thế Giới Di Động cung cấp các lựa chọn trả góp phù hợp với ngân sách của bạn, giúp bạn mua được sản phẩm với giá iPhone 15 Pro Max 1 TB theo như mong muốn mà không cần thanh toán toàn bộ số tiền một lúc.</p><p><strong>•&nbsp;Uy tín và kinh nghiệm lâu năm:&nbsp;</strong>Với hơn 15 năm hoạt động trên thị trường, Thế Giới Di Động đã xây dựng được một uy tín mạnh mẽ trong ngành công nghiệp điện thoại di động. Điều này giúp bạn yên tâm về việc mua sắm tại Thế Giới Di Động.</p><h3>Câu hỏi thường gặp trước khi mua iPhone 15 Pro Max&nbsp;1 TB</h3><p><strong>iPhone 15 Pro Max&nbsp;1 TB​ có mấy màu?</strong></p><p>Chiếc điện thoại dòng&nbsp;<a href=\"https://www.thegioididong.com/dtdd-apple-iphone-15-series\">iPhone 15</a>&nbsp;này&nbsp;được ra mắt với 4 màu sắc: Titan tự nhiên (Natural Titanium), Titan trắng (White Titanium), Titan đen (Black Titanium), Titan xanh (Blue Titanium). Các màu sắc này được thiết kế với tone màu huyền bí, lịch lãm, toát lên vẻ đẹp sang trọng và đẳng cấp.</p><p><strong>Camera của iPhone 15 Pro&nbsp;Max&nbsp;1 TB có chụp ảnh tốt không?</strong></p><p>Câu trả lời là có. Camera của iPhone 15 Pro&nbsp;Max&nbsp;1 TB có độ phân giải lên đến 48 MP, khẩu độ lớn và nhiều tính năng chụp ảnh tiên tiến. Điều này giúp iPhone 15 Pro&nbsp;Max&nbsp;1 TB có thể chụp ảnh sắc nét, sống động và chuyên nghiệp.</p><p><strong>iPhone 15 Pro Max&nbsp;1 TB chạy chip gì và mạnh mẽ ra sao?</strong></p><p>iPhone 15 Pro&nbsp;Max&nbsp;1 TB sử dụng con chip A17 Pro, là con chip mạnh mẽ nhất hiện nay của Apple. A17 Pro mang đến hiệu năng xử lý vượt trội, giúp iPhone 15 Pro&nbsp;Max có thể chạy mượt mà mọi ứng dụng và game.</p><h3>Giá bán iPhone 15 Pro&nbsp;Max&nbsp;1 TB</h3><p>Dưới đây là bảng tổng hợp giá bán iPhone 15 Pro&nbsp;Max&nbsp;1 TB cho từng phiên bản bộ nhớ ở thị trường Quốc Tế và Việt Nam:</p><figure class=\"table\"><table><tbody><tr><td><strong>Các phiên bản</strong></td><td><strong>Giá bán thị trường quốc tế</strong></td><td><strong>Giá bán tại Thế Giới Di Động</strong></td></tr><tr><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-pro-max\">iPhone 15 Pro&nbsp;Max 256 GB</a></td><td>1.199 USD</td><td>34.490.000đ</td></tr><tr><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-pro-max-512gb\">iPhone 15 Pro&nbsp;Max 512 GB</a></td><td>1.399 USD</td><td>40.990.000đ</td></tr><tr><td>iPhone 15&nbsp;Pro&nbsp;Max&nbsp;1 TB</td><td>1.599 USD</td><td>46.990.000đ</td></tr></tbody></table></figure><h3>Video giới thiệu điện thoại iPhone 15 Pro và iPhone 15 Pro Max</h3><p>iPhone 15 Pro Max&nbsp;1 TB thực sự là một siêu phẩm kết hợp đầy đủ các tinh hoa trên một chiếc flagship của Apple. Với bộ vi xử lý Apple A17 Pro mạnh mẽ đang đi đầu trong cuộc đua về hiệu năng và camera 48 MP siêu sắc nét, từ đó bạn có thể trải nghiệm mọi ứng dụng và tác vụ một cách mượt mà và nhanh chóng hay thực hiện việc quay chụp với nội dung cho ra được chất lượng cao.</p>', 29, 'dien-thoai-iphone-15-pro-max-256gb-6561f5b15c77b', 1, 382, '2023-11-20 21:28:01', '2023-12-09 09:33:59'),
(84, 'Đồng hồ Edifice Casio 48.2 mm Nam ECB-2200DC-1ADF', 40, 5181000, 6, 1, 1, 223, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700573728/uploads_ecommerce_php_5_1/phpBAC5_eijvlp.webp', 5, 1, '<p>Với đầy đủ các đặc trưng của đồng hồ Casio truyền thống, Edifice&nbsp;Casio&nbsp;còn được tích hợp nhiều chức năng hiện đại, giá trị ứng dụng cao, mang đến cho phái mạnh dòng sản phẩm thông minh đáng mơ ước.</p>', '<figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7264/315211/edifice-casio-ecb-2200dc-1adf-nam-21.jpg\" alt=\"Tổng quan về thương hiệu của mẫu đồng hồ\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7264/315211/edifice-casio-ecb-2200dc-1adf-nam-22.jpg\" alt=\"Chất liệu mặt kính và khung viền của mẫu đồng hồ\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7264/315211/edifice-casio-ecb-2200dc-1adf-nam-23.jpg\" alt=\"Chất liệu dây đeo của mẫu đồng hồ\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7264/315211/edifice-casio-ecb-2200dc-1adf-nam-24.jpg\" alt=\"Khả năng kháng nước của mẫu đồng hồ\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7264/315211/edifice-casio-ecb-2200dc-1adf-nam-25.jpg\" alt=\"Tiện ích của mẫu đồng hồ \"></figure><p>•&nbsp;<a href=\"https://www.thegioididong.com/dong-ho-deo-tay/edifice-casio-ecb-2200dc-1adf-nam\">Đồng hồ Edifice Casio 48.2 mm Nam ECB-2200DC-1ADF</a> là một sản phẩm của thương hiệu Edifice Casio, nổi tiếng đến từ Nhật Bản. Được tạo ra đặc biệt để phục vụ các quý ông đam mê tập luyện thể dục, sản phẩm này sở hữu một loạt tính năng tiện ích.</p><p>•&nbsp;Sự tinh tế của chiếc <a href=\"https://www.thegioididong.com/dong-ho-deo-tay-edifice-casio\">đồng hồ EDIFICE CASIO</a> này thể hiện qua sự kết hợp hoàn hảo giữa công nghệ, thiết kế đẹp mắt và tính năng độc đáo. Thiết kế ngoại hình của nó được chia thành hai khu vực với nhiều chức năng khác nhau, và tên thương hiệu được in chìm tinh tế ở vị trí 12 giờ, tạo nên một sự thu hút sâu sắc.</p><p>•&nbsp;Dây đeo được làm từ thép không gỉ bóng bẩy, không chỉ sáng đẹp mà còn chống va đập và ăn mòn tốt, giúp các quý ông có thể thoải mái sử dụng hàng ngày. Khung viền của đồng hồ được làm từ chất liệu carbon và thép không gỉ, đảm bảo độ bền và khả năng chịu nhiệt, cho phép bạn đeo nó bất kể nơi đâu và trong bất kỳ hoàn cảnh nào.</p><p>•&nbsp;Với đường kính mặt <a href=\"https://www.thegioididong.com/dong-ho-deo-tay\">đồng hồ</a>&nbsp;lên đến <strong>48.2 mm</strong>, phù hợp cho cả những người có cổ tay lớn và nhỏ, nhưng đều muốn thể hiện phong cách ấn tượng và nổi bật. Mặt kính được làm từ kính khoáng, có khả năng chống va đập tốt và dễ dàng đánh bóng lại khi bị trầy xước nhẹ, giúp đồng hồ luôn giữ được vẻ đẹp sáng bóng.</p><p>•&nbsp;Điều đặc biệt là <a href=\"https://www.thegioididong.com/dong-ho-deo-tay-nam\">đồng hồ nam</a>&nbsp;này có khả năng chống nước lên đến <strong>10 ATM</strong>, cho phép bạn sử dụng trong các hoạt động hàng ngày như rửa tay, đi mưa, tắm hoặc bơi lội. Tuy nhiên, hãy tránh đeo nó khi lặn hoặc vặn các nút khi dưới nước.</p><p>•&nbsp;Sản phẩm này của thương hiệu Edifice Casio, với nhiều ưu điểm vượt trội, được trang bị đầy đủ các tính năng tiện ích như lịch ngày và thứ, báo thức, đồng hồ 24 giờ, bấm giờ thể thao, 2 đèn LED, và bấm giờ đếm ngược. Sản phẩm còn hỗ trợ kết nối Bluetooth và có kim dạ quang, đảm bảo tính chính xác và đáng tin cậy trong việc quản lý thời gian.</p>', 3, 'dong-ho-edifice-casio-482-mm-nam-ecb-2200dc-1adf-655df400315e3', 1, 58, '2023-11-20 21:34:44', '2023-12-05 10:08:16'),
(85, 'Máy tính bảng Samsung Galaxy Tab A9+ 5G ', 4, 6990000, 9, 1, 1, 34, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700491651/uploads_ecommerce_php_5_1/phpF22B_o2qmfc.jpg', 5, 1, '<p>Thiết kế của Galaxy Tab A9+ 5G đem đến một sự tươi mới và tinh tế. Máy sở hữu một ngoại hình hiện đại và thanh lịch với mặt lưng phẳng và khung kim loại. Các góc bo tròn mềm mại làm cho máy có sự đối lập với những đường nét phẳng phiu nên trông khá thú vị.&nbsp;</p>', '<h3>Với giá cả phải chăng,&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-bang/samsung-galaxy-tab-a9-plus-5g\">Samsung Galaxy Tab A9+ 5G</a>&nbsp;là một sản phẩm máy tính bảng của Samsung dành cho người dùng muốn sở hữu một thiết bị giải trí cơ bản với màn hình rộng và khả năng kết nối mạng toàn diện để truy cập internet bất kỳ lúc nào và ở bất kỳ đâu.</h3><h3>Ngoại hình sang trọng, cứng cáp</h3><p>Thiết kế của Galaxy Tab A9+ 5G đem đến một sự tươi mới và tinh tế. Máy sở hữu một ngoại hình hiện đại và thanh lịch với mặt lưng phẳng và khung kim loại. Các góc bo tròn mềm mại làm cho máy có sự đối lập với những đường nét phẳng phiu nên trông khá thú vị.&nbsp;</p><p>Vỏ ngoài của Galaxy Tab A9+&nbsp;5G&nbsp;được làm từ kim loại, tạo nên một vẻ ngoài sang trọng và đẳng cấp. Chất liệu kim loại cung cấp sự cứng cáp và độ bền cho máy tính bảng, giúp tăng thêm độ bền bỉ để hạn chế hư hại cho va đập. Đặc biệt, việc làm nhám bề mặt này giúp ngăn máy trượt tay và mang lại cảm giác thoải mái khi cầm máy.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/315390/samsung-galaxy-tab-a9-251023-103947.jpg\" alt=\"Thiết kế máy tính bảng - Samsung Galaxy Tab A9+ 5G\"></figure><p>Galaxy Tab A9+&nbsp;5G&nbsp;có sự đa dạng trong lựa chọn màu sắc, bao gồm Xám, Bạc và Xanh Navy. Điều này cho phép người dùng thể hiện cá tính của họ thông qua màu sắc yêu thích. Các tùy chọn màu sắc này mang đến sự đa dạng và thú vị trong việc tùy chỉnh máy tính bảng theo phong cách cá nhân.</p><p>Đặc biệt, Galaxy Tab A9+&nbsp;5G được&nbsp;trang bị công nghệ Dolby Atmos trên bộ loa, đưa đến trải nghiệm âm thanh đỉnh cao. Với âm thanh xuất sắc và chi tiết, bạn có thể thỏa sức thưởng thức âm nhạc, xem phim hoặc chơi game mà không cần lo lắng về chất lượng âm thanh. Các loa tích hợp sẽ tái tạo mọi chi tiết âm thanh một cách rõ ràng và sống động.</p><p>Galaxy Tab A9+&nbsp;5G&nbsp;tiếp tục cung cấp sự tiện lợi với cổng sạc Type-C, giúp bạn nạp nhanh thiết bị. Đồng thời, thiết bị vẫn giữ nguyên cổng tai nghe 3.5 mm, cho phép bạn kết nối với các tai nghe và loa ngoài không cần sử dụng bộ chuyển đổi. Điều này làm cho&nbsp;chiếc&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-bang-samsung\">máy tính bảng Samsung</a>&nbsp;này&nbsp;thực sự linh hoạt trong việc sử dụng và kết nối với các phụ kiện âm thanh.</p><p>Phiên bản này hỗ trợ gắn SIM, tạo sự tiện lợi cho người dùng khi cần kết nối internet khi không có Wi-Fi. Với khả năng kết nối 5G, bạn có thể truy cập internet mọi lúc, mọi nơi và không bị giới hạn bởi việc phải tìm điểm Wi-Fi công cộng. Điều này làm cho Galaxy Tab A9+&nbsp;5G&nbsp;trở nên linh hoạt và đáng tin cậy hơn cho cả công việc và giải trí.</p><h3>Trang bị màn hình lớn lên đến 11 inch</h3><p>Màn hình của Galaxy Tab A9+&nbsp;5G&nbsp;được trang bị công nghệ TFT LCD, một sự kết hợp độc đáo giữa chất lượng hình ảnh và khả năng tiết kiệm năng lượng. Màn hình TFT LCD không chỉ hiển thị màu sắc tự nhiên và sáng rõ mà còn tiết kiệm điện năng, giúp kéo dài thời gian sử dụng máy. Điều này làm cho Galaxy Tab A9+ 5G trở thành một lựa chọn thông minh khi người dùng muốn kết hợp chất lượng hình ảnh và hiệu suất pin tối ưu.</p><p>Kích thước màn hình 11 inch trên Galaxy Tab A9+&nbsp;5G&nbsp;làm cho thiết bị trở nên lý tưởng trong việc xem phim, đọc sách và làm việc. Với không gian rộng rãi này, bạn có thể thỏa sức thưởng thức nội dung mà không cần phải zoom in hoặc di chuyển qua lại nhiều lần. Kích thước lớn này tạo ra một trải nghiệm thú vị và thoải mái.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/315390/samsung-galaxy-tab-a9-251023-103949.jpg\" alt=\"Kích thước màn hình - Samsung Galaxy Tab A9+ 5G\"></figure><p>Màn hình của Galaxy Tab A9+&nbsp;5G&nbsp;được trang bị độ phân giải cao lên đến 1200 x 1920 pixels, mang đến hình ảnh rõ nét. Độ phân giải cao này đảm bảo mọi chi tiết trên màn hình được hiển thị một cách rõ ràng và sắc nét. Điều này làm cho việc xem video, xem hình ảnh và làm việc trên máy tính bảng trở nên thú vị hơn.</p><h3>Bổ sung đầy đủ camera trước và sau</h3><p>Galaxy Tab A9+&nbsp;5G&nbsp;không phải là một thiết bị chuyên về nhiếp ảnh, nhưng vẫn mang lại khả năng sử dụng camera ổn định và tiện dụng cho nhiều mục đích. Với camera sau 8 MP, máy&nbsp;đủ tốt để chụp rõ văn bản, tài liệu cho công việc hoặc học tập.&nbsp;</p><p>Đây là một tính năng hữu ích khi bạn cần sao chép hoặc lưu trữ thông tin từ sách, bài giảng hoặc các tài liệu công việc. Máy tính bảng này cho phép bạn chụp ảnh rõ ràng và sắc nét của văn bản, giúp bạn tiết kiệm thời gian và nâng cao hiệu suất công việc hoặc học tập.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/315390/samsung-galaxy-tab-a9-251023-103951.jpg\" alt=\"Camera máy tính bảng - Samsung Galaxy Tab A9+ 5G\"></figure><p>Camera trước 5 MP cung cấp khả năng chụp ảnh rõ ràng và tương đối sáng. Đây là một lựa chọn tốt cho cuộc gọi video, họp trực tuyến hoặc việc chia sẻ ảnh cá nhân lên mạng xã hội. Tuy nhiên, vì là dòng máy tính bảng giá rẻ nên máy không được trang bị nhiều tính năng, cho nên để có bức ảnh đẹp nhất có lẽ cần qua bước hậu kỳ để giúp ảnh mịn màng và đẹp mắt hơn.</p><p>Máy tính bảng này cung cấp khả năng quay video Full HD ở camera sau, cho phép bạn ghi lại các sự kiện và khoảnh khắc quan trọng trong cuộc sống. Mặc dù không phải là chất lượng video chuyên nghiệp, nhưng nó đủ để lưu giữ những khoảnh khắc đáng nhớ và tạo ra nội dung video cá nhân.</p><h3>Hiệu năng đáp ứng tốt các tác vụ cơ bản</h3><p>Một trong những điểm đáng chú ý nhất của Galaxy Tab A9+&nbsp;5G&nbsp;là sự hiện diện của chip&nbsp;Snapdragon 695, một thành phần quan trọng quyết định hiệu năng của thiết bị. Chip được thiết kế để đáp ứng tốt nhu cầu của người dùng và giúp máy tính bảng thực hiện các tác vụ cơ bản một cách nhanh chóng và hiệu quả.</p><p>Với chip&nbsp;Snapdragon 695, Galaxy Tab A9+&nbsp;5G&nbsp;hoạt động mượt mà và ít khi gặp khó khăn khi mở các ứng dụng hoặc thực hiện các tác vụ hằng ngày như lướt web, soạn thảo văn bản. Việc xem video, duyệt web, lướt qua các ứng dụng và trải nghiệm giải trí trên&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-bang\">máy tính bảng</a>&nbsp;trở nên trơn tru và thú vị hơn bao giờ hết.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/315390/samsung-galaxy-tab-a9-251023-103952.jpg\" alt=\"Hiệu năng máy tính bảng - Samsung Galaxy Tab A9+ 5G\"></figure><p>Là mẫu&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-bang-ram-4gb\">máy tính bảng RAM 4 GB</a>, vì thế máy khá đuối trong việc mở nhiều ứng dụng cùng lúc khi có nhiều ứng dụng chạy ngầm gây tốn bộ nhớ đệm. Vậy nên để máy tính bảng hoạt động ở trạng thái tốt nhất, người dùng nên hạn chế mở nhiều ứng dụng không cần thiết và đảm bảo được tắt hoàn toàn khi không sử dụng.</p><p>Bên cạnh đó, khả năng lưu trữ là một yếu tố quan trọng và Galaxy Tab A9+&nbsp;5G&nbsp;không làm bạn thất vọng. Với 64 GB bộ nhớ trong, người dùng có đủ không gian để lưu giữ hàng trăm ảnh, video và tệp tin. Điều tuyệt vời hơn, khả năng mở rộng thêm 1 TB qua thẻ Micro SD cho phép bạn thỏa sức lưu trữ mà không cần lo lắng về việc thiếu không gian.</p><h3>Năng lượng đáp ứng đủ cho cả ngày dài</h3><p>Dung lượng pin lớn 7040 mAh trên Galaxy Tab A9+&nbsp;5G&nbsp;là một trong những yếu tố quan trọng đáng chú ý. Với dung lượng này, thiết bị có thể đảm bảo hiệu suất liên tục trong suốt một ngày, cho phép bạn sử dụng nhiều tính năng mà không cần lo lắng về việc cạn pin.</p><p>Điều đáng kể là, viên pin 7040 mAh trên Galaxy Tab A9+&nbsp;5G&nbsp;đủ để hỗ trợ các nhiệm vụ cơ bản suốt cả ngày. Cho dù bạn đang duyệt web, xem video, thực hiện cuộc gọi video hoặc thậm chí làm việc từ xa, viên pin này hoạt động một cách xuất sắc, mang lại trải nghiệm suôn sẻ. Bạn có thể sử dụng máy tính bảng thoải mái mà không cần lo lắng về tình trạng pin.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/315390/samsung-galaxy-tab-a9-251023-103954.jpg\" alt=\"Pin trên máy tính bảng - Samsung Galaxy Tab A9+ 5G\"></figure><p>Tuy nhiên, một điểm yếu của thiết bị là công suất sạc chỉ hỗ trợ 15 W. Điều này có nghĩa là việc sạc đầy viên pin 7040 mAh có thể mất một thời gian khá lâu. Mặc dù bạn có viên pin dung lượng lớn, nhưng việc sạc pin vẫn đòi hỏi kiên nhẫn khi bạn muốn nạp nhanh để tiếp tục sử dụng. Tuy nhiên, bằng cách quản lý thời gian sạc, bạn vẫn có thể vượt qua một ngày mà không gặp nhiều khó khăn lớn.</p><p>Tổng kết, Samsung Galaxy Tab A9+ 5G hoàn toàn đáp ứng tốt nhu cầu giải trí của người dùng thông thường trên màn hình lớn, thay thế cho việc sử dụng điện thoại di động. Sản phẩm này thích hợp làm thiết bị giải trí cho cả gia đình, phù hợp cho trẻ em học tập và giải trí, cũng như cho người lớn sử dụng để đọc báo và cập nhật tin tức hằng ngày.</p>', 33, 'may-tinh-bang-samsung-galaxy-tab-a9-5g-6569e1bdc54fe', 1, 22, '2023-11-20 21:47:25', '2023-12-05 10:07:42');
INSERT INTO `product` (`id`, `title`, `brand_id`, `price`, `discount`, `isVariant`, `sold`, `quantity`, `thumb`, `totalRatings`, `totalUserRatings`, `short_description`, `description`, `cate_id`, `slug`, `status`, `view`, `create_at`, `update_at`) VALUES
(86, 'Điện thoại iPhone 15 Plus 512GB', 1, 34569000, 5, 1, 1, 190, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700492842/uploads_ecommerce_php_5_1/php206A_m6c13s.jpg', 4, 1, '<p>iPhone 15 Plus&nbsp;512 GB sẽ khuấy đảo thị trường công nghệ trong thời gian tới với bộ thông số hoàn hảo trong giới smartphone hiện nay. Điện thoại không chỉ mang lối thiết kế trẻ trung, mà đi cùng với đó là hiệu năng mạnh mẽ đủ sức cân mọi tác vụ.</p>', '<figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303812/iphone-15-512gb-131023-110624.jpg\" alt=\"iPhone 15 Plus Tổng quan\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303812/iphone-15-512gb-131023-110626.jpg\" alt=\"iPhone 15 Plus Thông số kỹ thuật và tính năng\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303812/iphone-15-512gb-131023-110629.jpg\" alt=\"iPhone 15 Plus So sánh\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303812/iphone-15-512gb-131023-110631.jpg\" alt=\"iPhone 15 Plus Chuyển đổi\"></figure><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303812/iphone-15-512gb-131023-110633.jpg\" alt=\"iPhone 15 Plus Phụ kiện\"></figure><h3>Bảng so sánh thông số kỹ thuật iPhone 15 Plus 512 GB và các sản phẩm khác thuộc iPhone 15 series:</h3><figure class=\"table\"><table><tbody><tr><td><strong>Tiêu chí</strong></td><td><strong>iPhone 15 Plus 512 GB</strong></td><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-512gb\"><strong>iPhone 15 512 GB</strong></a></td><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-pro-512gb\"><strong>iPhone 15 Pro 512 GB</strong></a></td><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-pro-max-512gb\"><strong>iPhone 15 Pro Max 512 GB</strong></a></td></tr><tr><td><strong>Màn hình</strong></td><td><p>&nbsp; &nbsp;•&nbsp;6.7 inch</p><p>&nbsp; &nbsp;•&nbsp;Màn hình Super Retina XDR</p><p>&nbsp; &nbsp;•&nbsp;Độ phân giải 2796x1290 pixel với mật độ điểm ảnh 460 ppi</p></td><td><p>&nbsp; &nbsp;•&nbsp;6.1 inch</p><p>&nbsp; &nbsp;•&nbsp;Màn hình Super Retina XDR</p><p>&nbsp; &nbsp;•&nbsp;Độ phân giải 2556x1179 pixel với mật độ điểm ảnh 460 ppi</p></td><td><p>&nbsp; •&nbsp;6.1 inch</p><p>&nbsp; •&nbsp;Màn hình Super Retina XDR</p><p>&nbsp; •&nbsp;Độ phân giải 2556x1179 pixel với mật độ điểm ảnh 460 ppi</p></td><td><p>&nbsp; &nbsp;•&nbsp;6.7 inch</p><p>&nbsp; &nbsp;•&nbsp;Màn hình Super Retina XDR</p><p>&nbsp; &nbsp;•&nbsp;Độ phân giải 2796x1290 pixel với mật độ điểm ảnh 460 ppi</p></td></tr><tr><td><strong>Kích thước và khối lượng</strong></td><td><p>&nbsp; &nbsp;•&nbsp;160,9 x 77,8 x 7,80 mm (Dài x Rộng x&nbsp;Dày)</p><p>&nbsp; &nbsp;•&nbsp;201 gram</p></td><td><p>&nbsp;&nbsp; •&nbsp;147,6 x 71,6 x 7,80 mm (Dài x Rộng x&nbsp;Dày)</p><p>&nbsp; &nbsp;•&nbsp;171 gram</p></td><td><p>&nbsp; &nbsp;•&nbsp;146,6 x 70,6 x 8,25 mm (Dài x Rộng x&nbsp;Dày)</p><p>&nbsp; &nbsp;•&nbsp;187 gram</p></td><td><p>&nbsp; &nbsp;•&nbsp;159.9 x 76.7 x 8.25 mm (Dài x Rộng x&nbsp;Dày)</p><p>&nbsp; &nbsp;•&nbsp;221 gram</p></td></tr><tr><td><strong>Khung viền</strong></td><td>Nhôm với mặt sau bằng kính pha màu</td><td>Nhôm với mặt sau bằng kính pha màu</td><td>Titan với mặt sau bằng kính nhám</td><td>Titan với mặt sau bằng kính nhám</td></tr><tr><td><strong>Chip</strong></td><td>Chip A16 Bionic</td><td>Chip A16 Bionic</td><td>Chip A17 Pro</td><td>Chip A17 Pro</td></tr><tr><td><strong>Bộ nhớ lưu trữ</strong></td><td>&nbsp;128 GB, 256 GB, 512 GB</td><td>&nbsp;128 GB, 256 GB, 512 GB</td><td>&nbsp;128 GB, 256 GB, 512 GB, 1 TB</td><td>256 GB, 512 GB, 1 TB</td></tr><tr><td><strong>Camera</strong></td><td><p>&nbsp; •&nbsp;Hệ thống camera kép tiên tiến (Chính 48MP và Ultra Wide 12MP)</p><p>&nbsp; •&nbsp;Camera trước TrueDepth</p><p>&nbsp;•&nbsp;Các lựa chọn thu phóng quang học&nbsp; 0,5x, 1x, 2x</p></td><td><p>&nbsp; •&nbsp;Hệ thống camera kép tiên tiến (Chính 48MP và Ultra Wide 12MP)</p><p>&nbsp; •&nbsp;Camera trước TrueDepth</p><p>&nbsp; •&nbsp;Các lựa chọn thu phóng quang học 0,5x, 1x, 2x</p></td><td><p>&nbsp; •&nbsp;Hệ thống camera chuyên nghiệp (Chính 48MP, Ultra Wide 12MP và Telephoto 12MP)</p><p>&nbsp; •&nbsp;Camera trước TrueDepth</p><p>&nbsp; •&nbsp;Các lựa chọn thu phóng quang học 0,5x, 1x, 2x, 3x</p></td><td><p>&nbsp; &nbsp;•&nbsp;Hệ thống camera chuyên nghiệp&nbsp;(Chính 48MP, Ultra Wide 12MP và Telephoto 12MP)</p><p>&nbsp; •&nbsp;Camera trước TrueDepth</p><p>&nbsp; •&nbsp;Các lựa chọn thu phóng quang học 0,5x, 1x, 2x, 5x</p></td></tr><tr><td><strong>Nút tác vụ</strong></td><td>Nút chuyển đổi Chuông/Im Lặng</td><td>Nút chuyển đổi Chuông/Im Lặng</td><td>Nút Action Button</td><td>Nút Action Button</td></tr><tr><td><strong>Thời lượng pin</strong></td><td><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video: 26 giờ</p><p>&nbsp; •&nbsp;Thời gian xem video (trực tuyến): 20 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian nghe nhạc: 100 giờ</p></td><td><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video: 20 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video (trực tuyến): 16 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian nghe nhạc: 80 giờ</p></td><td><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video: 23 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video (trực tuyến): 20 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian nghe nhạc: 75 giờ</p></td><td><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video lên đến 29 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video (trực tuyến) lên đến 25 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian nghe nhạc lên đến 95 giờ</p></td></tr><tr><td><strong>Cảm biến</strong></td><td>Con quay hồi chuyển độ lệch tương phản cao</td><td>Con quay hồi chuyển độ lệch tương phản cao</td><td><p>&nbsp; &nbsp;•&nbsp;LiDAR Scanner</p><p>&nbsp; •&nbsp;Con quay hồi chuyển độ lệch tương&nbsp;phản cao</p></td><td><p>&nbsp; &nbsp;•&nbsp;LiDAR Scanner</p><p>&nbsp; •&nbsp;Con quay hồi chuyển độ lệch tương&nbsp;phản cao</p></td></tr><tr><td><strong>Cổng kết nối</strong></td><td><p>&nbsp; &nbsp;•&nbsp;USB-C</p><p>&nbsp; &nbsp;•&nbsp;Hỗ trợ USB 2</p></td><td><p>&nbsp; &nbsp;•&nbsp;USB-C</p><p>&nbsp; &nbsp;•&nbsp;Hỗ trợ USB 2</p></td><td><p>&nbsp; &nbsp;•&nbsp;USB-C</p><p>&nbsp; &nbsp;•&nbsp;Hỗ trợ USB 3 (lên đến 10Gb/s)</p></td><td><p>&nbsp; &nbsp;•&nbsp;USB-C</p><p>&nbsp; &nbsp;•&nbsp;Hỗ trợ USB 3 (lên đến 10Gb/s)</p></td></tr><tr><td><strong>Màu sắc</strong></td><td>Đen (Black), Xanh lá (Green), Vàng (Yellow), Hồng (Pink) và Xanh dương (Blue)</td><td>Đen (Black), Xanh lá (Green), Vàng (Yellow), Hồng (Pink) và Xanh dương (Blue)</td><td>Titan tự nhiên (Natural Titanium), Titan trắng (White Titanium), Titan đen (Black Titanium), Titan xanh (Blue Titanium)</td><td>Titan tự nhiên (Natural Titanium), Titan trắng (White Titanium), Titan đen (Black Titanium), Titan xanh (Blue Titanium)</td></tr></tbody></table></figure><h3>Bảng so sánh thông số&nbsp;phiên bản iPhone 15 Plus 512 GB và iPhone 14 Plus 512 GB</h3><p>Dưới đây sẽ là bảng tổng hợp thông số kỹ thuật giữa hai thế hệ điện thoại&nbsp;iPhone:</p><figure class=\"table\"><table><tbody><tr><td><strong>Tiêu chí</strong></td><td><strong>iPhone 15 Plus 512 GB</strong></td><td><a href=\"https://www.thegioididong.com/dtdd/iphone-14-plus-512gb\"><strong>iPhone 14 Plus 512 GB</strong></a></td></tr><tr><td><strong>Màn hình</strong></td><td><p>&nbsp; &nbsp;•&nbsp;6.7 inch</p><p>&nbsp; &nbsp;•&nbsp;Màn hình Super Retina XDR</p><p>&nbsp; &nbsp;•&nbsp;Độ phân giải 2796x1290 pixel với mật độ điểm ảnh 460 ppi</p></td><td><p>&nbsp; &nbsp;•&nbsp;6.7 inch</p><p>&nbsp; &nbsp;•&nbsp;Màn hình Super Retina XDR</p><p>&nbsp; &nbsp;•&nbsp;Độ phân giải 2778x1284 pixel với mật độ điểm ảnh 458 ppi</p></td></tr><tr><td><strong>Kích thước và khối lượng</strong></td><td><p>&nbsp; &nbsp;•&nbsp;160,9 x 77,8 x 7,80 mm (Dài x Rộng x Dày)</p><p>&nbsp; &nbsp;•&nbsp;201 gram</p></td><td><p>&nbsp; &nbsp;•&nbsp;160,8 x 78,1 x 7,80 mm (Dài x Rộng x Dày)</p><p>&nbsp; &nbsp;•&nbsp;203 gam</p></td></tr><tr><td><strong>Chip</strong></td><td>Chip A16 Bionic</td><td>Chip A15 Bionic</td></tr><tr><td><strong>Camera</strong></td><td><p>&nbsp; &nbsp;•&nbsp;Hệ thống camera kép tiên tiến (Chính 48MP và Ultra Wide 12MP)</p><p>&nbsp; &nbsp;•&nbsp;Camera trước TrueDepth</p><p>&nbsp; &nbsp;•&nbsp;Các lựa chọn thu phóng quang học 0,5x, 1x, 2x</p></td><td><p>&nbsp; &nbsp;•&nbsp;Hệ thống camera kép 12MP (Chính và Ultra Wide)</p><p>&nbsp; &nbsp;•&nbsp;Camera trước TrueDepth</p><p>&nbsp; &nbsp;•&nbsp;Các lựa chọn thu phóng quang học học 0,5x, 1x</p></td></tr><tr><td><strong>Thời lượng pin</strong></td><td><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video: 26 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video (trực tuyến): 20 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian nghe nhạc: 100 giờ</p></td><td><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video: 26 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian xem video (trực tuyến): 20 giờ</p><p>&nbsp; &nbsp;•&nbsp;Thời gian nghe nhạc: 100 giờ</p></td></tr><tr><td><strong>Cổng kết nối</strong></td><td><p>&nbsp; &nbsp;•&nbsp;USB-C</p><p>&nbsp; &nbsp;•&nbsp;Hỗ trợ USB 2</p></td><td><p>&nbsp; &nbsp;•&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\">Lightning</a></p><p>&nbsp; &nbsp;•&nbsp;Hỗ trợ USB 2</p></td></tr><tr><td><strong>Màu sắc</strong></td><td>Đen (Black), Xanh lá (Green), Vàng (Yellow), Hồng (Pink) và Xanh dương (Blue)</td><td>Vàng, Đen, Trắng, Tím Nhạt, Xanh Dương</td></tr><tr><td><strong>Bộ nhớ lưu trữ</strong></td><td>&nbsp;128 GB, 256 GB, 512 GB</td><td>&nbsp;128 GB, 256 GB, 512 GB</td></tr></tbody></table></figure><h3>Đến hẹn lại lên, tháng 9/2023 Apple đã chính thức ra mắt&nbsp;<a href=\"https://www.thegioididong.com/dtdd-apple-iphone-15-series\">iPhone 15 series</a>&nbsp;mới nhất tại sự kiện Wonderlust. Trong đó, iPhone 15 Plus có sự nâng cấp mạnh mẽ về màu sắc cùng với lối thiết kế đẹp mắt, hiệu năng cũng như khả năng chụp ảnh trên máy. Điểm đặc&nbsp;biệt của lần ra mắt này là hãng đã loại bỏ hoàn toàn cổng Lightning và thay thế bằng cổng Type-C.</h3><h3>Thiết kế trẻ trung, màu sắc cuốn hút</h3><p>Apple mang đến cho người dùng một sản phẩm iPhone 15 Plus&nbsp;512 GB với lối thiết kế đẹp mắt. Chính vì thế nên <a href=\"https://www.thegioididong.com/dtdd/iphone-15-plus-512gb\">iPhone 15 Plus 512GB</a> sở hữu vẻ ngoài vô cùng thời trang khi có cạnh viền được làm phẳng, cụm camera đặt gọn trong cụm modem ở góc trái mặt lưng được mang từ những mẫu iPhone 14, làm cho tổng thể chiếc máy hài hòa và đẹp mắt.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303825/iphone-15-plus-512gb-200923-104514.jpg\" alt=\"Thiết kế đẹp mắt - iPhone 15 Plus 512GB\"></figure><p>Apple cũng đã làm mới lớp áo trên iPhone 15 Plus&nbsp;512 GB với những màu sắc đẹp mắt và cực kỳ trendy. Hãng đã cho ra mắt 5 tùy chọn về màu sắc cho sản phẩm và mỗi tùy chọn đều đem lại sự mới lạ mà trước đó chưa từng xuất hiện trên các sản phẩm của Apple. Bạn sẽ tỏa sáng giữa đám đông khi cầm trên tay iPhone 15 Plus với những màu sắc đẹp mắt như vậy.</p><p>Một sự thay đổi đáng chú ý trên mặt trước của iPhone 15 Plus&nbsp;512 GB là việc thay thế tai thỏ ở các thế hệ trước bằng hình viên thuốc, tạo sự tinh tế hơn và mở rộng không gian hiển thị, mang đến trải nghiệm xem nội dung liền mạch hơn.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303825/iphone-15-plus-512gb-200923-104513.jpg\" alt=\"Ngoại hình đổi mới thu hút ánh nhìn - iPhone 15 Plus 512GB\"></figure><p>Các công nghệ quan trọng như Face ID và các ứng dụng khác giúp hỗ trợ cho người dùng đều được hãng tích hợp vào Dynamic Island. Với Dynamic Island, bạn sẽ có trải nghiệm sử dụng điện thoại thuận tiện hơn, có thể điều khiển âm nhạc, nhận thông báo cuộc gọi và kiểm tra thông tin cá nhân mà không cần rời khỏi ứng dụng hoặc công việc đang thực hiện.</p><p>Xem thêm:&nbsp;<a href=\"https://thegioididong.com/hoi-dap/dynamic-island-tren-iphone-14-dong-pro-la-gi-hoat-1468356\">Dynamic Island trên iPhone dòng \"Pro\" là gì? Hoạt động như thế nào?</a></p><h3>Truyền dữ liệu nhanh hơn với cổng Type-C</h3><p>Nhằm hướng đến sự phát triển toàn diện và mục tiêu bảo vệ môi trường giúp giảm sự nóng lên toàn cầu. Đồng thời, hãng cũng muốn mang đến sự đồng bộ trong các sản phẩm của mình và truyền tải dữ liệu nhanh hơn nên đã thay thế cổng Lightning bằng cổng Type-C hiện đại với khả năng truyền tải vượt trội.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303825/iphone-15-plus-512gb-200923-104511.jpg\" alt=\"Cổng Type-C tiện lợi - iPhone 15 Plus 512GB\"></figure><p>Cổng Type-C không chỉ giúp truyền tải dữ liệu nhanh hơn mà còn hỗ trợ sạc nhanh đáng kể. Điều này mang lại lợi ích lớn về tiết kiệm thời gian và tăng cường hiệu suất sử dụng của sản phẩm.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/usb-type-c-chuan-muc-cong-ket-noi-moi-723760\">USB Type C là gì? Có ưu nhược điểm gì so với những USB truyền thống?</a></p><h3>Chụp ảnh sắc nét với camera 48 MP</h3><p>Đã có sự cải tiến ở camera chính trên iPhone 15 Plus&nbsp;512 GB khi hãng đã tăng gấp 4 lần so với năm ngoái lên đến 48 MP. Giờ đây, bạn có thể quay video lên đến 4K 60 fps giúp bạn lưu lại những khoảnh khắc đáng nhớ trong cuộc sống. Bạn có thể chụp những bức ảnh nổi bật, với độ chi tiết cao một cách dễ dàng nhờ camera chính 48 MP với khả năng zoom tele 2X – từ ảnh chụp nhanh đến ảnh phong cảnh tuyệt đẹp.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303825/iphone-15-plus-512gb-200923-104510.jpg\" alt=\"Camera chụp ảnh đỉnh cao - iPhone 15 Plus 512GB\"></figure><p>Ngoài ra, khả năng chụp ảnh góc siêu rộng trên iPhone được cải thiện đáng kể với camera 12 MP kết hợp với các thuật toán mới mang đến những bức ảnh góc rộng tự nhiên và chân thực hơn.</p><p>Khả năng chụp chân dung cũng được Apple nâng cấp lên một đẳng cấp mới trên các dòng sản phẩm của mình mang đến khả năng chụp ảnh đỉnh cao. Đồng thời, nếu bạn chụp một chủ thể nhất định nào đó trên iPhone 15 Plus&nbsp;512 GB nó sẽ tự động nhận biết chiều sâu của hình ảnh và biến nó thành một bức ảnh chân dung với khả năng xóa phông tuyệt vời.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303825/iphone-15-plus-512gb-200923-104508.jpg\" alt=\"Ảnh chân dung sắc nét - iPhone 15 Plus 512GB\"></figure><p>Camera trước trên điện thoại cũng vô cùng mạnh mẽ với độ phân giải lên đến 12 MP. Đồng thời hỗ trợ quay video 4K mang lại độ phân giải cao, màu sắc rực rỡ và chi tiết tốt, đặc biệt nó rất phù hợp khi bạn muốn ghi lại những khoảnh khắc đáng nhớ hoặc chia sẻ nội dung chất lượng cao trên các mạng xã hội.</p><h3>Chìm đắm vào những thước phim với màn hình sắc nét</h3><p><a href=\"https://www.thegioididong.com/dtdd-apple-iphone\">Điện thoại iPhone</a> này trang bị một màn hình OLED và có kích thước 6.7 inch lớn cùng độ phân giải cao 1290 x&nbsp;2796&nbsp;pixels, giúp hình ảnh được tái tạo một cách sắc nét, màu sắc sống động giúp bạn có những trải nghiệm thị giác tuyệt.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-oled-la-gi-905762\">Màn hình OLED là gì? Có gì nổi bật? Thiết bị nào có màn hình OLED?</a></p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303825/iphone-15-plus-512gb-200923-104506.jpg\" alt=\"Hiển thị hình ảnh sắc nét - iPhone 15 Plus 512GB\"></figure><p>Mặt trước sẽ cho không gian hiển thị rộng lớn với kiểu thiết kế viên thuốc như trên <a href=\"https://www.thegioididong.com/dtdd/iphone-14-pro\">iPhone 14 Pro</a>. Mọi nội dung sẽ được truyền tải tốt hơn và đầy đủ hơn với kiểu thiết kế này, giúp bạn thực sự đắm chìm vào màn ảnh với iPhone 15 Plus&nbsp;512 GB.</p><p>Một điểm đáng chú ý khác trong lần ra mắt này là mức độ sáng của màn hình đã được nâng lên đến 2000 nits, giúp bạn dễ dàng sử dụng điện thoại ở các môi trường với độ sáng cao như ngoài trời nắng.</p><h3>Hiệu năng mạnh mẽ cân mọi tác vụ</h3><p>Vi xử lý A16 Bionic trên các sản phẩm iPhone 14 Pro tiếp tục được chọn để trang bị trên iPhone 15 Plus&nbsp;512 GB và sức mạnh của nó đã được kiểm chứng. Chip được sản xuất trên tiến trình 4 nm, đây là phiên bản nâng cấp của A15 Bionic vì thế chip mang lại hiệu năng mạnh mẽ để xử lý mọi tác vụ, từ nhẹ đến nặng. Điều này giúp bạn chơi game một cách mượt mà và vẫn duy trì tối ưu hoá, tiết kiệm năng lượng.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chip-a16-bionic-giup-iphone-14-lan-at-hieu-nang-1461587\">Đánh giá chip Apple A16 Bionic chi tiết về thông số và hiệu năng</a></p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303825/iphone-15-plus-512gb-200923-104505.jpg\" alt=\"Hiệu năng mạnh mẽ - iPhone 15 Plus 512GB\"></figure><p>Máy có dung lượng RAM cao và được chạy trên hệ điều hành iOS 17 mới nhất, điều đó giúp cho điện thoại trở nên mượt mà hơn với thao tác đa nhiệm cũng như giao diện thân thiện với người dùng, giúp bạn tối ưu hóa quá trình làm việc và giải trí của mình.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/toan-bo-thong-tin-ve-ios-17-ngay-ra-mat-tinh-nang-1525071\">iOS 17 chính thức: Khi nào ra mắt, có gì mới, hỗ trợ máy nào?</a></p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303825/iphone-15-plus-512gb-200923-104503.jpg\" alt=\"Hệ dideuf hành mượt mà - iPhone 15 Plus 512GB\"></figure><p>Đồng thời, đây là mẫu <a href=\"https://www.thegioididong.com/dtdd-rom-512gb\">điện thoại ROM 512 GB</a> giúp cho việc lưu trữ tài liệu hay hình ảnh trở nên đơn giản và dễ dàng hơn bao giờ hết. Bạn không còn phải bận tâm về việc muốn lưu nhiều thứ nhưng lại sợ hết dung lượng như trước đây nữa.</p><h3>Viên pin đáp ứng tốt cho ngày dài năng động</h3><p>Viên pin trên iPhone 15 Plus&nbsp;512 GB được đánh giá là có mức dung lượng cao. Hãng cũng cho biết thêm là máy có khả năng xem video liên tục lên đến 26 tiếng, giúp bạn trải nghiệm liền mạch mọi nội dung trên iPhone 15 Plus&nbsp;512 GB mà không bị gián đoạn. Hơn thế nữa với viên pin lớn bạn cũng không phải lo lắng về việc sạc pin liên tục trong ngày gây ảnh hưởng đến trải nghiệm cũng như tuổi thọ của pin.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/303825/iphone-15-plus-512gb-200923-104502.jpg\" alt=\"Viên pin đáp ứng tốt cho ngày năng động - iPhone 15 Plus 512GB\"></figure><p>Ngoài ra, <a href=\"https://www.thegioididong.com/dtdd\">điện thoại</a> cũng hỗ trợ sạc nhanh 20 W, cho phép bạn nạp pin lên đến 50% chỉ trong vòng 30 phút. Hoặc bạn có thể tận dụng các công nghệ sạc không dây tiên tiến như chuẩn Qi hoặc MagSafe để cung cấp nguồn điện một cách tiện lợi và nhanh chóng.</p><h3>Lý do chọn mua iPhone 15 Plus&nbsp;512 GB tại Thế Giới Di Động</h3><p>•&nbsp;<strong>Đáng tin cậy và uy tín</strong>: Thế Giới Di Động là một trong những nhà bán lẻ điện thoại di động lớn nhất và uy tín nhất tại Việt Nam. Đây là nơi cung cấp các sản phẩm chất lượng và dịch vụ khách hàng xuất sắc.</p><p>•&nbsp;<strong>Sự lựa chọn đa dạng</strong>: Thế Giới Di Động thường có sẵn một loạt các phiên bản và màu sắc của iPhone, giúp bạn dễ dàng lựa chọn sản phẩm phù hợp với nhu cầu và sở thích cá nhân của mình.</p><p>•&nbsp;<strong>Chương trình khuyến mãi và ưu đãi</strong>: Thế Giới Di Động thường có các chương trình khuyến mãi, giảm giá và ưu đãi đặc biệt cho các sản phẩm điện thoại mới, giúp bạn tiết kiệm được một phần chi phí mua sắm nhằm mang đến giá iPhone 15 Plus 512GB tốt nhất.</p><p>•&nbsp;<strong>Dịch vụ sau bán hàng</strong>: Thế Giới Di Động là nơi cung cấp dịch vụ sau bán hàng tốt, bao gồm bảo hành và hỗ trợ kỹ thuật, giúp bạn yên tâm sử dụng sản phẩm một cách thoải mái.</p><p>•&nbsp;<strong>Mạng lưới cửa hàng rộng khắp</strong>: Thế Giới Di Động có nhiều cửa hàng trên khắp Việt Nam, giúp bạn dễ dàng tiếp cận và mua iPhone 15 Plus&nbsp;512 GB ở địa điểm gần nhất.</p><h3>Câu hỏi thường gặp trước khi mua iPhone 15 Plus&nbsp;512 GB</h3><p><strong>iPhone 15 Plus&nbsp;512 GB có bao nhiêu phiên bản và màu sắc</strong>: iPhone 15 Plus&nbsp;512 GB có tổng cộng 3 phiên bản và 5 tùy chọn màu sắc. Điều này cho phép bạn có nhiều sự lựa chọn để phù hợp với nhu cầu và sở thích của mình.</p><p><strong>iPhone 15 Plus&nbsp;512 GB có hiệu năng và tính năng như thế nào</strong>: iPhone 15 Plus&nbsp;512 GB được trang bị con chip Apple A16 Bionic, một con chip mạnh mẽ mang lại hiệu năng ấn tượng, cho phép điện thoại xử lý mọi tác vụ từ nhẹ đến nặng một cách mượt mà bao gồm: chơi game, xem video 4K và sử dụng các ứng dụng đa nhiệm mà không gặp trở ngại.</p><p><strong>Khả năng chụp ảnh trên iPhone 15 Plus&nbsp;512 GB</strong>:<strong>&nbsp;</strong>Việc nâng cấp độ phân giải camera lên đến 48 MP và khẩu độ lớn trên iPhone 15 Plus&nbsp;512 GB là một bước tiến đáng chú ý. Điều này đồng nghĩa với việc bạn có thể chụp những bức ảnh sắc nét và rõ ràng hơn bao giờ hết, với chi tiết cực kỳ sắc nét. Khả năng chụp ảnh với độ phân giải cao cũng đi kèm với khả năng quay video chất lượng, giúp bạn ghi lại những khoảnh khắc đáng nhớ với độ nét và màu sắc xuất sắc.</p><h3>Giá bán iPhone 15 Plus&nbsp;512 GB tại Thế Giới Di Động</h3><p>Dưới đây là bảng tổng hợp giá bán iPhone 15 Plus&nbsp;512 GB cho từng phiên bản bộ nhớ thị trường Quốc Tế và Việt Nam:</p><figure class=\"table\"><table><tbody><tr><td><strong>Các phiên bản iPhone 15 Plus</strong></td><td><strong>Giá bán thị trường quốc tế</strong></td><td><strong>Giá bán tại Thế Giới Di Động</strong></td></tr><tr><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-plus\">iPhone 15 Plus 128 GB</a></td><td>899 USD</td><td>25.990.000đ</td></tr><tr><td>iPhone 15 Plus 256 GB</td><td>999 USD</td><td>28.990.000đ</td></tr><tr><td><a href=\"https://www.thegioididong.com/dtdd/iphone-15-plus-512gb\">iPhone 15 Plus 512 GB</a></td><td>1199 USD</td><td>34.990.000đ</td></tr></tbody></table></figure>', 29, 'dien-thoai-iphone-15-plus-512gb-6561f5a86f62c', 1, 39, '2023-11-20 22:07:16', '2023-12-05 10:08:01'),
(87, 'Điện thoại OPPO Find N3 Flip 5G Hồng', 31, 22990000, 0, 1, 0, 222, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493155/uploads_ecommerce_php_5_1/php907F_lhhnqy.jpg', 0, 0, '<p>OPPO Find N3 Flip 5G Hồng là một chiếc điện thoại gập đáng sắm nhờ sở hữu nhiều điểm nổi bật. Máy vừa có cấu hình mạnh, vừa sở hữu camera chất lượng cùng một thiết kế có vẻ đẹp khó cưỡng, rất phù hợp cho những bạn trẻ năng động đang cần tìm một sự phá cách độc đáo thông qua điện thoại gập.</p>', '<h3><a href=\"https://www.thegioididong.com/dtdd/oppo-find-n3-flip-hong\">OPPO Find N3 Flip 5G Hồng</a>&nbsp;được OPPO cho ra mắt chính thức tại thị trường Việt Nam vào tháng 10/2023.&nbsp;Sản phẩm được hãng đầu tư mạnh mẽ về camera với độ phân giải lên đến 50 MP, cấu hình sử dụng chip Dimensity 9200 5G và thiết kế được thay đổi với bản lề gập mở tốt hơn cùng màu hồng sang trọng và nữ tính.</h3><p>Bảng so sánh thông số kỹ thuật giữa&nbsp;OPPO Find N3 Flip 5G Hồng và&nbsp;OPPO Find N2 Flip</p><p>Dưới đây sẽ là bảng tổng hợp thông số kỹ thuật giữa hai thế hệ điện thoại gập của OPPO:</p><figure class=\"table\"><table><tbody><tr><td><strong>Tiêu chí</strong></td><td><strong>OPPO Find N3 Flip 5G Hồng</strong></td><td><strong>OPPO Find N2 Flip</strong></td></tr><tr><td><strong>Màn hình chính</strong></td><td><p>&nbsp; &nbsp;•&nbsp;Tấm nền&nbsp;AMOLED</p><p>&nbsp; &nbsp;• Độ phân giải&nbsp;Full HD+ (1080 x 2520 Pixels)</p><p>&nbsp; &nbsp;•&nbsp;Kích thước&nbsp;6.8 inch</p></td><td><p>&nbsp; &nbsp;•&nbsp;​Tấm nền&nbsp;AMOLED</p><p>&nbsp; &nbsp;•&nbsp;Độ phân giải&nbsp;Full HD+ (1080 x&nbsp;2520 Pixels)</p><p>&nbsp; &nbsp;•&nbsp;Kích thước&nbsp;6.8 inch</p></td></tr><tr><td><strong>Màn hình phụ</strong></td><td><p>&nbsp; &nbsp; •&nbsp;Tấm nền&nbsp;AMOLED</p><p>&nbsp; &nbsp;• Độ phân giải&nbsp;382 x&nbsp;720 Pixels</p><p>&nbsp; &nbsp;•&nbsp;Kích thước&nbsp;3.26&nbsp;inch</p></td><td><p>&nbsp; &nbsp; •&nbsp;Tấm nền&nbsp;AMOLED</p><p>&nbsp; &nbsp;• Độ phân giải&nbsp;382 x&nbsp;720 Pixels</p><p>&nbsp; &nbsp;•&nbsp;Kích thước&nbsp;3.26&nbsp;inch</p></td></tr><tr><td><strong>Camera</strong></td><td><p>&nbsp; &nbsp;•&nbsp;<strong>Camera chính 50 MP (chống rung OIS)</strong></p><p>&nbsp; &nbsp;•&nbsp;<strong>Camera góc siêu rộng 48 MP</strong></p><p>&nbsp; &nbsp;•&nbsp;<strong>Camera tele 32 MP</strong></p><p>&nbsp; &nbsp;•&nbsp;Camera trước 32 MP</p></td><td><p>&nbsp; &nbsp;•&nbsp;​Camera chính 50 MP</p><p>&nbsp; &nbsp;•&nbsp;Camera góc siêu rộng 8 MP</p><p>&nbsp; &nbsp;•&nbsp;Camera trước 32 MP</p></td></tr><tr><td><strong>Chip xử lý</strong></td><td><strong>Dimensity 9200 5G</strong></td><td>Dimensity 9000+ 5G</td></tr><tr><td><strong>Thời lượng pin</strong></td><td>​4300 mAh</td><td>4300 mAh</td></tr><tr><td><strong>Bộ nhớ</strong></td><td><p>&nbsp; &nbsp;•&nbsp;<strong>​RAM 12 GB</strong></p><p>&nbsp; &nbsp;•&nbsp;​ROM 256 GB</p></td><td><p>&nbsp; &nbsp;•&nbsp;RAM 8 GB</p><p>&nbsp; &nbsp;•&nbsp;​ROM 256 GB</p></td></tr><tr><td><strong>Chất liệu mặt lưng</strong></td><td><strong>Kính cường lực Gorilla Glass 7</strong></td><td>Kính cường lực Gorilla Glass 5</td></tr></tbody></table></figure><h3>Thiết kế trẻ trung, sang trọng</h3><p>OPPO Find N3 Flip 5G Hồng sở hữu thiết kế gập độc đáo, giúp điện thoại trở nên nhỏ gọn và tiện lợi. Người dùng có thể dễ dàng gấp gọn điện thoại để cầm nắm và lưu trữ thuận tiện. Điều này mang lại trải nghiệm sử dụng dễ dàng và tiện lợi, đặc biệt khi di chuyển hoặc muốn tiết kiệm không gian.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/317981/oppo-find-n3-flip-hong-271023-120840.jpg\" alt=\"Thiết kế điện thoại - OPPO Find N3 Flip 5G Hồng\"></figure><p>OPPO Find N3 Flip 5G Hồng&nbsp;gây ấn tượng với thiết kế mỏng chỉ 7.79 mm (khi mở), tạo nên sự tinh tế và thanh lịch. Thiết kế này không chỉ mang lại giá trị thẩm mỹ mà còn là minh chứng cho sự tiến bộ trong công nghệ sản xuất điện thoại gập.</p><p>Khung viền kim loại sáng bóng và mặt lưng kính cao cấp mang đến cho&nbsp;<a href=\"https://www.thegioididong.com/dtdd\">điện thoại</a>&nbsp;vẻ ngoài sang trọng và đẳng cấp. Chất liệu này không chỉ tạo nên vẻ đẹp tinh tế mà còn đảm bảo sự chắc chắn và bền bỉ.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/317981/oppo-find-n3-flip-hong-271023-014958.jpg\" alt=\"Khung viền điện thoại - OPPO Find N3 Flip 5G Hồng\"></figure><p>OPPO Find N3 Flip 5G Hồng&nbsp;có bản lề Flex được làm từ chất liệu kim loại cao cấp, đảm bảo độ bền cao giúp máy trở nên chắc chắn và cứng cáp. Phần này được cải tiến để mang đến trải nghiệm mở ra và đóng lại một cách êm ái, ổn định.</p><p>Một trong những điểm đặc biệt của OPPO Find N3 Flip&nbsp;5G Hồng là việc trang bị màn hình phụ kích thước lớn ở mặt lưng. Màn hình này giúp người dùng dễ dàng thao tác các tính năng khi điện thoại đang gập. Người dùng có thể kiểm tra thông báo, trả lời cuộc gọi hoặc sử dụng ứng dụng như chụp ảnh, quay video,... mà không cần mở hoàn toàn điện thoại.</p><h3>Camera hợp tác với Hasselblad</h3><p>OPPO Find N3 Flip 5G Hồng&nbsp;sở hữu bộ 3 camera sau với độ phân giải lần lượt là 50 MP, 48 MP và 32 MP. Với sự đa dạng về ống kính và chế độ chụp, sản phẩm cho phép người dùng khám phá nhiều khía cạnh khác nhau trong nhiếp ảnh, từ chụp ảnh chân dung, phong cảnh đến chụp ảnh zoom xa.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/317981/oppo-find-n3-flip-hong-271023-020251.jpg\" alt=\"Camera điện thoại - OPPO Find N3 Flip 5G Hồng\"></figure><p>OPPO Find N3 Flip 5G Hồng&nbsp;được trang bị camera chính với độ phân giải 50 MP và khẩu độ f/1.8. Với sự kết hợp này, camera chính của máy có thể chụp ảnh sắc nét và chi tiết trong nhiều điều kiện ánh sáng khác nhau.</p><p>Trong điều kiện thiếu sáng, camera chính của Find N3 Flip 5G Hồng&nbsp;vẫn có thể chụp được những bức ảnh sáng rõ nhờ khả năng thu sáng tốt. Còn trong điều kiện ánh sáng mạnh, camera chính của máy sẽ giúp bạn chụp được những bức ảnh rực rỡ, không bị cháy sáng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/317981/oppo-find-n3-flip-hong-271023-014954.jpg\" alt=\"Camera điện thoại - OPPO Find N3 Flip 5G Hồng\"></figure><p>Camera góc siêu rộng 48 MP của Find N3 Flip 5G Hồng&nbsp;cho phép bạn chụp ảnh với độ bao quát rộng hơn, lên đến 114 độ. Điều này đặc biệt hữu ích khi bạn muốn chụp ảnh phong cảnh hoặc chụp ảnh nhóm đông người. Với độ phân giải cao, camera này cũng có thể chụp ảnh chi tiết và sắc nét, ngay cả khi chụp ở khoảng cách xa.</p><p>Camera tele 32 MP của Find N3 Flip 5G Hồng&nbsp;cho phép bạn chụp ảnh cận cảnh hoặc chụp ảnh từ xa. Với công nghệ chống rung tiên tiến, bạn có thể chụp ảnh rõ ràng và sắc nét, hạn chế được tình trạng rung lắc gây nhòe mờ.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/309835/oppo-find-n3-flip-071023-072714.jpg\" alt=\"Camera của điện thoại - OPPO Find N3 Flip\"></figure><p>OPPO Find N3 Flip 5G Hồng&nbsp;không chỉ ấn tượng về cấu hình camera mà còn với việc hợp tác độc đáo với Hasselblad - một thương hiệu danh tiếng trong lĩnh vực máy ảnh. Điều này đảm bảo rằng Find N3 Flip 5G Hồng&nbsp;không chỉ chụp ảnh sắc nét và chi tiết, mà còn tái hiện chính xác màu sắc và tính năng độc đáo của các sản phẩm Hasselblad.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/309835/oppo-find-n3-flip-071023-072716.jpg\" alt=\"Camera của điện thoại - OPPO Find N3 Flip\"></figure><p>OPPO Find N3 Flip&nbsp;5G Hồng là một chiếc điện thoại thông minh đa năng, không chỉ chụp ảnh tốt mà còn quay video ấn tượng. Với khả năng quay video 4K ở tốc độ 30 khung hình/giây, bạn có thể ghi lại những khoảnh khắc đáng nhớ một cách sống động và chân thực thông qua&nbsp;chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd-oppo\">điện thoại OPPO</a>&nbsp;này.</p><p>Ngoài ra, camera trước 32 MP của Find N3 Flip&nbsp;5G Hồng cũng rất ấn tượng, phù hợp cho những người yêu thích chụp ảnh selfie. Camera này được trang bị chế độ làm đẹp và xóa phông, giúp bạn dễ dàng có được những bức ảnh tự sướng đẹp mắt và cuốn hút.</p><h3>Màn hình AMOLED kích thước lớn</h3><p>Màn hình của chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd-oppo-find-n\">điện thoại OPPO Find N</a>&nbsp;này là một trong những điểm đặc biệt và ấn tượng, với nhiều tính năng và công nghệ hiện đại đảm bảo mang lại trải nghiệm tuyệt vời cho người dùng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/317981/oppo-find-n3-flip-hong-271023-014956.jpg\" alt=\"Màn hình điện thoại - OPPO Find N3 Flip 5G Hồng\"></figure><p>OPPO Find N3 Flip&nbsp;5G Hồng được trang bị màn hình AMOLED với độ phân giải Full HD+ (1080 x 2520 Pixels). Với tấm nền này, Find N3 Flip&nbsp;5G Hồng mang đến trải nghiệm màu sắc rực rỡ và sống động, với độ tương phản cao và màu đen sâu thẳm. Điều này giúp bạn tận hưởng những bộ phim, video và trò chơi yêu thích của mình với chất lượng hình ảnh tuyệt vời.</p><p>Ngoài ra, màn hình chính của Find N3 Flip 5G Hồng&nbsp;có kích thước lên đến 6.8 inch, tạo nên một không gian hiển thị rộng rãi. Điều này giúp bạn có thể thoải mái xem nội dung mà không cần phải lo lắng về việc bị che khuất tầm nhìn.</p><p>OPPO Find N3 Flip 5G Hồng&nbsp;được trang bị tốc độ làm mới 120 Hz, giúp cải thiện đáng kể độ nhạy và độ mượt của màn hình. Điều này mang lại trải nghiệm sử dụng mượt mà và thú vị hơn khi cuộn màn hình, chơi game hoặc duyệt web.</p><p>Ngoài ra, màn hình chính của Find N3 Flip 5G Hồng&nbsp;còn có độ sáng tối đa lên đến 1600 nits, giúp bạn có thể xem nội dung rõ ràng ngay cả trong điều kiện ánh sáng mạnh. Tính năng này đặc biệt hữu ích khi bạn sử dụng điện thoại ngoài trời nắng gắt.</p><p>Bên cạnh màn hình chính, Find N3 Flip 5G Hồng&nbsp;còn được trang bị màn hình phụ 3.26 inch ở mặt lưng. Màn hình phụ này giúp bạn có thể xem thông báo và điều khiển điện thoại ngay cả khi màn hình chính đang đóng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/317981/oppo-find-n3-flip-hong-271023-014953.jpg\" alt=\"Màn hình phụ điện thoại - OPPO Find N3 Flip 5G Hồng\"></figure><p>Để đảm bảo sự bền vững và độ bảo vệ tối ưu cho màn hình chính, OPPO Find N3 Flip 5G Hồng&nbsp;sử dụng kính siêu mỏng Schott Ultra Thin Glass, lớp kính này giúp bảo vệ màn hình khỏi trầy xước và hạn chế nguy cơ hỏng hóc trong quá trình sử dụng nhằm kéo dài tuổi thọ của điện thoại.</p><h3>Cấu hình mạnh mẽ trong phân khúc giá</h3><p>Sức mạnh của OPPO Find N3 Flip&nbsp;5G Hồng bắt đầu từ việc tích hợp chip MediaTek Dimensity 9200 5G 8 nhân. Với hiệu suất mạnh mẽ và khả năng đa nhiệm ưu việt, chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd?g=android\">điện thoại Android</a>&nbsp;này sẽ không gặp khó khăn trong việc xử lý mọi tác vụ, từ công việc hằng ngày đến giải trí đa phương tiện.</p><p>MediaTek Dimensity 9200 là vi xử lý (CPU) được sản xuất dựa trên tiến trình 4 nm và mạnh mẽ nhất hiện tại của MediaTek (10/2023). Đây cũng là con chip đầu tiên sở hữu nhân hiệu năng Armv9 độc quyền cùng sự tối ưu hoá nhiệt độ bởi MediaTek, nhằm đem đến cho chiếc smartphone hiệu năng tối đa mà vẫn giữ ổn định được nhiệt độ.</p><p>Với kiến trúc Armv9 và tiến trình 4 nm, Dimensity 9200 mang lại hiệu năng vượt trội so với các thế hệ chip MediaTek trước đây. Con chip này có thể dễ dàng xử lý các tác vụ nặng như chơi game, chỉnh sửa video và đồ họa,...</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/309835/oppo-find-n3-flip-071023-072719.jpg\" alt=\"Hiệu năng của điện thoại - OPPO Find N3 Flip\"></figure><p>OPPO Find N3 Flip 5G Hồng&nbsp;hỗ trợ RAM lên đến 12 GB, cho phép bạn mở nhiều ứng dụng cùng lúc mà không gặp chậm trễ. Điều này rất hữu ích khi bạn cần thực hiện nhiều công việc cùng một lúc hoặc khi bạn muốn chuyển đổi nhanh giữa các ứng dụng mà không bị gián đoạn.</p><p>Với sức mạnh của chip MediaTek Dimensity 9200 và RAM lớn, OPPO Find N3 Flip 5G Hồng&nbsp;là một lựa chọn tuyệt vời cho các game thủ. Bạn có thể chơi những tựa game đòi hỏi đồ họa cao mà không phải lo lắng về hiệu suất. Thấy hình ảnh chuyển động mượt mà và đẹp mắt sẽ làm cho trải nghiệm chơi game trở nên hấp dẫn hơn bao giờ hết.</p><p>OPPO Find N3 Flip&nbsp;5G Hồng sử dụng hệ điều hành Android 13, mang lại tính tiện lợi cao cấp và khả năng tùy biến mạnh mẽ. Bạn sẽ có trải nghiệm mượt mà, giao diện đẹp mắt và cập nhật bảo mật thường xuyên từ Google.</p><h3>Sở hữu viên pin 4300 mAh cùng khả năng sạc 44 W</h3><p>Một trong những yếu tố quan trọng nhất mà người dùng điện thoại di động quan tâm là thời lượng pin. OPPO Find N3 Flip 5G Hồng&nbsp;đã đáp ứng mọi kỳ vọng về pin bằng việc trang bị viên pin lớn với dung lượng lên đến 4300 mAh, đảm bảo bạn luôn có đủ năng lượng để sử dụng suốt một ngày dài mà không cần lo lắng về việc sạc pin.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/317981/oppo-find-n3-flip-hong-271023-020245.jpg\" alt=\"Pin trên điện thoại - OPPO Find N3 Flip 5G Hồng\"></figure><p>OPPO Find N3 Flip 5G Hồng&nbsp;đã tận dụng không gian bên trong để tích hợp viên pin lớn một cách thông minh, mà không làm ảnh hưởng đến thiết kế mỏng và sang trọng của chiếc điện thoại. Việc này giúp cho OPPO Find N3 Flip 5G Hồng không chỉ là một thiết bị mạnh mẽ mà còn là một chiếc điện thoại đẹp mắt.</p><p>Ngoài việc có viên pin lớn, OPPO Find N3 Flip 5G Hồng&nbsp;còn hỗ trợ sạc nhanh với công suất tối đa lên đến 44 W. Điều này có nghĩa là bạn có thể nạp đầy pin trong thời gian ngắn, giúp bạn sẵn sàng cho mọi cuộc hành trình và công việc mà không cần phải chờ đợi lâu. Khả năng sạc nhanh này làm cho việc sạc pin trở nên tiện lợi hơn bao giờ hết.</p><h3>Giá bán của&nbsp;OPPO Find N3 Flip 5G Hồng</h3><p>Từ ngày 26/10 - 10/11, Thế Giới Di Động triển khai chương trình khuyến mãi hấp dẫn dành cho OPPO Find N3 Flip 5G Hồng. Theo đó, khách hàng mua sản phẩm sẽ được hưởng các ưu đãi sau:<br><br><strong>Tai nghe OPPO Enco Air 3 (Trị giá 1.59 triệu)</strong></p><p>Khách hàng mua OPPO Find N3 Flip 5G Hồng sẽ được tặng kèm tai nghe OPPO Enco Air 3 trị giá 1.59 triệu đồng. Tai nghe có thiết kế thời trang, nhỏ gọn, cùng chất lượng âm thanh sống động, đáp ứng nhu cầu giải trí và nghe gọi của người dùng.</p><p><strong>Thu cũ đổi mới trợ giá đến 2 triệu</strong></p><p>Khách hàng có thể đổi máy cũ lấy máy mới OPPO Find N3 Flip 5G Hồng với mức trợ giá lên đến 2 triệu đồng. Đây là chương trình hỗ trợ thiết thực giúp khách hàng tiết kiệm chi phí khi mua sắm.</p><p><strong>Trả góp 0%</strong></p><p>Thế Giới Di Động hỗ trợ trả góp 0% lãi suất cho OPPO Find N3 Flip 5G Hồng. Khách hàng có thể mua máy với số tiền nhỏ hơn mỗi tháng, phù hợp với khả năng tài chính.</p><p><strong>Premium Service (Trị giá 1.2 Triệu)</strong></p><p>Thế Giới Di Động cung cấp dịch vụ Premium Service trị giá 1.2 triệu đồng cho OPPO Find N3 Flip 5G Hồng. Dịch vụ này bao gồm các ưu đãi độc quyền, bảo dưỡng định kỳ và hỗ trợ từ đội ngũ chuyên nghiệp.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/trai-nghiem-premium-service-va-oppo-care-khi-mua-oppo-find-n3-1552182\">Trải nghiệm ngay dịch vụ Premium Service và OPPO Care khi mua OPPO Find N3 Series</a></p><p><strong>OPPO Care (Trị giá 4.5 Triệu)</strong></p><p>Khi mua OPPO Find N3 Flip 5G Hồng tại Thế Giới Di Động, bạn sẽ được tặng gói dịch vụ OPPO Care trị giá 4.5 triệu đồng.&nbsp;Khách hàng sẽ được bảo hành màn hình nếu vô tình xảy ra rơi vỡ, hoàn toàn miễn phí trong vòng 12 tháng tính từ lúc mua.&nbsp;</p><p>Giá bán điện thoại: Dự kiến khoảng <strong>22.990.000đ</strong>&nbsp;(cập nhật ngày 01/11).</p><p>Tổng kết, OPPO Find N3 Flip 5G Hồng là một chiếc điện thoại gập đáng sắm nhờ sở hữu nhiều điểm nổi bật. Máy vừa có cấu hình mạnh, vừa sở hữu camera chất lượng cùng một thiết kế có vẻ đẹp khó cưỡng, rất phù hợp cho những bạn trẻ năng động đang cần tìm một sự phá cách độc đáo thông qua điện thoại gập.</p>', 29, 'dien-thoai-oppo-find-n3-flip-5g-hong-655df3ef20f4a', 1, 15, '2023-11-20 22:12:28', '2023-11-20 22:12:28'),
(88, 'Điện thoại Xiaomi 13T 5G 8GB', 30, 10990000, 7, 1, 0, 222, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700493909/uploads_ecommerce_php_5_1/php2877_rtpcey.jpg', 0, 0, '<p>Xiaomi 13T không chỉ là một công cụ hoàn hảo cho nhiếp ảnh, mà còn là một thiết bị đa năng và linh hoạt, phục vụ nhiều mục đích khác nhau. Đây là một trong những chiếc điện thoại cận flagship đáng chú ý nhất của năm 2023 nhờ hội tụ đầy đủ các thông số hàng đầu phân khúc.</p>', '<h3><a href=\"https://www.thegioididong.com/dtdd/xiaomi-13t\">Xiaomi 13T 5G</a>&nbsp;là một thiết bị độc đáo được ra mắt tại thị trường Việt Nam vào tháng 09/2023. Sản phẩm này đang thu hút sự chú ý lớn từ cộng đồng người dùng, đặc biệt là những người yêu nhiếp ảnh và đang tìm kiếm một trải nghiệm độc đáo với camera nhờ sự hợp tác với Leica, một trong những thương hiệu sản xuất máy ảnh hàng đầu.</h3><h3>Thiết kế tinh tế, sang trọng</h3><p>Mặt lưng của Xiaomi 13T có hai phiên bản cho bạn lựa chọn: da và kính. Mặt lưng da mang đến sự sang trọng và ấm áp, trong khi mặt lưng kính là một lựa chọn hiện đại và lịch lãm.&nbsp;</p><p>Dù là da hay kính, thiết kế mặt lưng của Xiaomi 13T đều theo kiểu phẳng và được bo cong nhẹ ở vùng rìa, giúp cầm nắm thoải mái hơn bao giờ hết. Sự cân nhắc trong việc bo cong rìa không chỉ tạo điểm nhấn thẩm mỹ mà còn mang lại cảm giác an toàn khi cầm nắm sản phẩm.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/309814/xiaomi-13t-270923-091835.jpg\" alt=\"Thiết kế điện thoại - Xiaomi 13T 5G\"></figure><p>Khung của Xiaomi 13T được làm từ chất liệu kim loại cứng cáp, cùng với đó là cách làm phẳng để tạo ra một sự kết hợp hoàn hảo với mặt lưng, giúp bảo vệ tối ưu cho các thành phần bên trong, đảm bảo Xiaomi 13T luôn hoạt động ổn định và bền bỉ với thời gian.</p><p>Với sự hợp tác đến từ Leica, một dòng chữ mang tên thương hiệu này đã được in lên trên cụm camera, điều này giúp Xiaomi 13T trở nên dễ nhận diện hơn và còn có thể tỏa sáng để bất kỳ ai nhìn vào cũng biết được đây là một chiếc <a href=\"https://www.thegioididong.com/dtdd-chup-anh-quay-phim\">điện thoại chụp ảnh, quay phim</a> cao cấp.</p><h3>Màn hình sống động đầy sắc nét</h3><p>Màn hình trên Xiaomi 13T là một tuyệt tác của công nghệ, đem đến cho người dùng một trải nghiệm hình ảnh vượt trội. Với công nghệ màn hình AMOLED, độ phân giải 1.5K (1220 x&nbsp;2712 Pixels) và kích thước lớn 6.67 inch.</p><p>Công nghệ AMOLED không chỉ mang lại sự sống động và đẹp mắt mà còn tái hiện sắc màu với độ chính xác tuyệt đối, tạo nên những gam màu rực rỡ và tự nhiên. Từ đó mang đến những trải nghiệm xem nội dung cực kỳ đã mắt, thích hợp để xem phim chất lượng cao hay chơi những tựa game có đồ họa khủng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/309814/xiaomi-13t-270923-091852.jpg\" alt=\"Màn hình điện thoại - Xiaomi 13T 5G\"></figure><p>Màn hình Xiaomi 13T được trang bị tần số quét lên đến 144 Hz, được xem là mức cao nhất trên thị trường <a href=\"https://www.thegioididong.com/dtdd\">điện thoại</a> kinh doanh chính hãng tại Việt Nam, giúp tạo ra một hiệu ứng mượt mà và tự nhiên trong mọi hoạt động trên màn hình. Điều này đặc biệt quan trọng khi bạn chơi game hoặc xem video chất lượng cao, giúp giảm thiểu hiện tượng bóng mờ, khựng khung hình để tạo ra trải nghiệm thú vị hơn.</p><p>Để đảm bảo rằng màn hình Xiaomi 13T luôn đẹp và bền bỉ, nó được bảo vệ bằng kính cường lực Corning Gorilla Glass 5. Đây là một trong những loại kính cường lực hàng đầu trên thị trường, giúp chống trầy xước, bảo vệ màn hình khỏi những va đập không mong muốn.&nbsp;</p><h3>Cấu hình top đầu phân khúc</h3><p>Đằng sau hiệu suất mạnh mẽ của Xiaomi 13T là bộ xử lý MediaTek Dimensity 8200-Ultra. Với tốc độ xử lý nhanh chóng và khả năng đa nhiệm xuất sắc, Dimensity 8200-Ultra đảm bảo rằng bạn có thể thực hiện mọi tác vụ một cách mượt mà và hiệu quả. Từ chơi game đầy thách thức đến xem video chất lượng cao, bạn sẽ luôn cảm nhận được sự mạnh mẽ của chip này.</p><p>Là mẫu <a href=\"https://www.thegioididong.com/dtdd-ram-8gb\">điện thoại RAM 8 GB</a>, Xiaomi 13T sẵn sàng đối mặt với mọi nhiệm vụ bạn đặt ra. Dung lượng RAM lớn này không chỉ giúp bạn mở đồng thời nhiều ứng dụng mà còn tạo ra trải nghiệm mượt mà và không giật lag. Bất kể bạn đang xem video, duyệt web hay sử dụng ứng dụng đòi hỏi tài nguyên cao thì Xiaomi 13T luôn đảm bảo hiệu suất tối ưu.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/309814/xiaomi-13t-270923-091900.jpg\" alt=\"Cấu hình điện thoại - Xiaomi 13T 5G\"></figure><p>Xiaomi 13T được trang bị hệ điều hành Android 13, phiên bản mới nhất của hệ điều hành di động phổ biến tính đến 09/2023. Điều này đồng nghĩa với việc bạn sẽ có được những tính năng mới nhất, bảo mật tốt hơn và trải nghiệm người dùng được tối ưu hóa.</p><h3>Nắm bắt trọn vẹn mọi khoảnh khắc với camera 50 MP</h3><p>Xiaomi 13T trang bị hệ thống camera đa dạng với 3 ống kính chất lượng. Camera chính có độ phân giải lên tới 50 MP, đảm bảo bạn có thể bắt lấy mọi chi tiết và màu sắc trong mỗi bức ảnh. Camera tele 50 MP hỗ trợ thu phóng kỹ thuật số 20x giúp bạn khám phá thế giới tinh tế và thú vị mà không cần di chuyển gần chủ thể. Cuối cùng là camera góc siêu rộng 12 MP cho phép bạn chụp những khung hình rộng, chân thực và mở rộng góc nhìn</p><p>Không chỉ là một công cụ chụp ảnh xuất sắc, chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd-xiaomi\">điện thoại Xiaomi</a>&nbsp;này&nbsp;còn cho phép bạn quay video 4K với độ nét tuyệt đỉnh. Tận dụng sự mạnh mẽ của camera, bạn có thể ghi lại những khoảnh khắc đáng nhớ với độ chi tiết và độ sắc nét xuất sắc. Chất lượng video 4K sẽ mang đến cho bạn trải nghiệm xem video chất lượng cao như trong phòng chiếu phim.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/309814/xiaomi-13t-270923-091909.jpg\" alt=\"Camera điện thoại - Xiaomi 13T 5G\"></figure><p>Xiaomi 13T đã hợp tác cùng với hãng nhiếp ảnh danh tiếng Leica để tinh chỉnh máy ảnh. Điều này đảm bảo rằng mọi bức ảnh và video bạn chụp đều được cân chỉnh với sự chuyên nghiệp và đẳng cấp của Leica. Từ việc cân chỉnh màu sắc cho đến sự tối ưu hóa của ống kính, Xiaomi 13T mang đến cho bạn một trải nghiệm nhiếp ảnh đỉnh cao mà bạn không thể tìm thấy ở bất kỳ nơi nào khác.</p><h3>Sử dụng pin lớn cùng khả năng sạc nhanh</h3><p>Một trong những điểm đáng tự hào của Xiaomi 13T chính là dung lượng pin lớn cực khủng lên đến 5000 mAh. Điều này đồng nghĩa với việc bạn có thể sử dụng điện thoại suốt cả ngày mà không cần phải lo lắng về việc hết pin. Dung lượng pin này đủ để bạn thực hiện mọi công việc, chơi game, xem video và duyệt web mà không cần phải tìm kiếm nguồn sạc liên tục.</p><p>Với công nghệ sạc nhanh 67 W, Xiaomi 13T giúp bạn tiết kiệm thời gian đáng kể trong việc sạc pin. Theo thông tin từ hãng, máy có thể sạc pin từ 0% đến 100% chỉ khoảng 42 phút một cách nhanh chóng và hiệu quả.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/309814/xiaomi-13t-270923-091843.jpg\" alt=\"Pin và sạc của điện thoại - Xiaomi 13T 5G\"></figure><p>Xiaomi 13T không chỉ là một công cụ hoàn hảo cho nhiếp ảnh, mà còn là một thiết bị đa năng và linh hoạt, phục vụ nhiều mục đích khác nhau. Đây là một trong những chiếc điện thoại cận flagship đáng chú ý nhất của năm 2023 nhờ hội tụ đầy đủ các thông số hàng đầu phân khúc.</p>', 29, 'dien-thoai-xiaomi-13t-5g-8gb-655df3f7b939c', 1, 6, '2023-11-20 22:25:02', '2023-11-20 22:25:02');
INSERT INTO `product` (`id`, `title`, `brand_id`, `price`, `discount`, `isVariant`, `sold`, `quantity`, `thumb`, `totalRatings`, `totalUserRatings`, `short_description`, `description`, `cate_id`, `slug`, `status`, `view`, `create_at`, `update_at`) VALUES
(89, 'Điện thoại Samsung Galaxy Z Fold4 5G 256GB', 29, 25990000, 6, 1, 3, 334, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700494368/uploads_ecommerce_php_5_1/php3B3C_kdl3dw.jpg', 1, 1, '<p>Với những bạn yêu thích sử mới mẻ, muốn thay đổi cách sử dụng smartphone thông thường thì chiếc điện thoại gập Galaxy Z Fold4 512GB có lẽ là một cái tên không nên bỏ qua. Sở hữu nhiều công nghệ hàng đầu từ camera cho đến hiệu năng để bạn có thể thoải mái chiến game hay thỏa sức chụp ảnh chất lượng cao.</p>', '<h3><a href=\"https://www.thegioididong.com/dtdd/samsung-galaxy-z-fold4-5g-512gb\">Samsung Galaxy Z Fold4 512GB</a>&nbsp;có lẽ là cái tên dành được nhiều sự chú ý đến từ sự kiện Unpacked thường niên của Samsung, bởi máy sở hữu màn hình lớn cùng cơ chế gấp gọn giúp người dùng có thể dễ dàng mang theo. Cùng với đó là sự nâng cấp về hiệu năng và phần mềm giúp máy xử lý tốt hầu hết mọi tác vụ bạn cần từ làm việc đến giải trí.</h3><h3>Vẻ ngoài thời thượng chuẩn chỉnh flagship</h3><p>Samsung Galaxy Z Fold4 512GB được hoàn thiện với ngoại hình khá giống với một chiếc máy tính bảng, sử dụng cơ chế gập hiện đại giúp cho người dùng có thể tùy biến thay đổi Galaxy Z Fold4 thành chiếc smartphone hay tablet một cách linh hoạt tùy vào nhu cầu sử dụng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090605.jpg\" alt=\"Thiết kế sang trọng - Samsung Galaxy Z Fold4 5G 512GB\"></figure><p>Độ bền của máy đã được kiểm chứng qua nhiều bài đánh giá khắt khe khác nhau, nên&nbsp;<a href=\"https://www.thegioididong.com/dtdd-samsung\">Samsung</a>&nbsp;tự tin cho biết Galaxy Z Fold4 có tuổi thọ sử dụng và số lần gập gia tăng rất nhiều so với thế hệ tiền nhiệm. Từ đó người dùng có thể an tâm hơn trong việc mua sắm và sử dụng máy trong một thời gian lâu dài.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090606.jpg\" alt=\"Độ bền của máy cao - Samsung Galaxy Z Fold4 5G 512GB\"></figure><p>Bộ khung của máy và phần bản lề sẽ được làm từ nhôm Armor Aluminum cao cấp, vừa nhẹ và vừa bền bỉ giúp thiết bị có thể chịu được áp lực trong một vài tình huống khi không may xảy ra va chạm.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090608.jpg\" alt=\"Khung viền chắc chắn - Samsung Galaxy Z Fold4 5G 512GB\"></figure><p>Ngoài ra với đặc tính ánh kim trên Armor Aluminum cũng giúp Galaxy Z Fold4 trở nên sáng bóng và bắt mắt hơn, làm toát lên một diện mạo cao cấp sang trọng khi cầm nắm sử dụng trên tay.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090610.jpg\" alt=\"Sáng bóng sang trọng - Samsung Galaxy Z Fold4 5G 512GB\"></figure><p>Sản phẩm lần này được tinh chỉnh chiều dài của máy xuống để mở rộng chiều ngang giúp cho bề ngang hiển thị của màn hình phụ sau khi gập được lớn hơn so với Z Fold3, thao tác gõ văn bản cũng sẽ trở nên dễ dàng và thuận tiện đối với phiên bản Z Fold thế hệ thứ 4.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/250625/samsung-galaxy-z-fold4-100822-064949.jpg\" alt=\"Màn hình phụ - Samsung Galaxy Z Fold4 5G\"></figure><p>Với những bạn có sở thích viết và phải làm việc với tính chất đặc thù là ghi chép nhanh hay phác họa, Galaxy Z Fold4 có lẽ là một lựa chọn tối ưu dành cho các bạn bởi máy sẽ có chức năng tương tự như một cuốn sổ truyền thống khi sử dụng kèm với bút S Pen*.</p><p><i>*S Pen không có sẵn trong hộp</i></p><p>Điểm mà hãng có nhấn mạnh trên dòng sản phẩm lần này chuẩn kháng nước IPX8 cao cấp, đây là trang bị chưa từng được trang bị trên bất kỳ dòng điện thoại gập nào thì nay đã được giới thiệu trên Galaxy Z Fold4. Vậy nên người dùng có thể an tâm hơn trong những tình huống mang theo thiết bị bên mình bất kể nắng mưa.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chong-nuoc-va-chong-bui-tren-smart-phone-771130\">Tiêu chuẩn chống nước IP là gì? Có ý nghĩa gì? Các chuẩn IP hiện nay</a></p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090611.jpg\" alt=\"Hỗ trợ chuẩn kháng nước cao cấp - Samsung Galaxy Z Fold4 5G 512GB\"></figure><h3>Nhiếp ảnh chuyên nghiệp với bộ 3 camera cao cấp</h3><p>Ở phía mặt lưng, máy sẽ được tích hợp 3 camera với camera chính có độ phân giải 50 MP, camera góc siêu rộng 12 MP và một cảm biến tele 10 MP. Với chất lượng ảnh thu lại có độ sắc nét cao giúp Galaxy Z Fold4 có thể trở thành một chiếc camera phone xịn sò để ghi lại những khoảnh khắc đẹp xung quanh bạn.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090613.jpg\" alt=\"Camera sau chất lượng - Samsung Galaxy Z Fold4 5G 512GB\"></figure><p>Đi kèm với đó sẽ là những tính năng như: Góc siêu rộng, chuyên nghiệp, zoom quang học 3X hay thậm chí là thu phóng chuẩn không gian lên đến 30 lần. Không đơn thuần là một trợ thủ phục vụ cho việc ghi chép mà máy còn có thể đóng vai trò như một một chiếc máy ảnh tiện lợi đối với các bạn phóng viên hay vlogger.</p><p>Bên trong màn hình lớn sẽ là camera ẩn có độ phân giải 4 MP giúp cho người dùng có thể vừa sử dụng máy cho công việc và vừa có thể video call với bạn bè. Hơn thế nữa, ở phần màn hình phụ còn có thêm camera 10 MP để các tác vụ chụp nhanh trở nên dễ dàng hơn cho dù thiết bị có đang gặp hay không đi chăng nữa.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090622.jpg\" alt=\"Tích hợp nhiều tính năng - Samsung Galaxy Z Fold4 5G 512GB\"></figure><h3>Màn hình rộng lớn cùng màu sắc hiển thị sinh động</h3><p>Galaxy Z Fold4 sẽ được trang bị trên máy một tấm nền Dynamic AMOLED 2X, mang đến khả năng tái hiện màu sắc sinh động rực rỡ hay thể hiện màu đen sâu giúp người dùng có thể trải nghiệm nội dung một cách chân thực. Dù người dùng có nhìn máy từ góc độ nào đi chăng nữa thì hình ảnh cũng sẽ không có sự thay đổi quá nhiều.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/250625/samsung-galaxy-z-fold4-100822-070501.jpg\" alt=\"Trang bị tấm nền Dynamic AMOLED 2X - Samsung Galaxy Z Fold4 5G\"></figure><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-man-hinh-dynamic-amoled-2x-tren-smartphone-1245213\">Màn hình Dynamic AMOLED 2X là gì? Điểm nổi bật? Có trên điện thoại nào?</a></p><p>Màn hình trong của Galaxy Z Fold4 sau khi mở hoàn toàn sẽ có tổng kích thước lên đến 7.6 inch, vừa hỗ trợ công việc được thuận tiện hơn cũng như đem đến không gian giải trí bất tận trên các bộ phim bom tấn hay trò chơi đồ họa cao.</p><p>Máy có độ phân giải 2176 x 1812 Pixels giúp cho hình ảnh được thể hiện chi tiết, các công việc chỉnh sửa - cắt ảnh cũng trở nên dễ dàng hơn khi thao tác trên Galaxy Z Fold4.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090616.jpg\" alt=\"Độ phân giải màn hình cao - Samsung Galaxy Z Fold4 5G 512GB\"></figure><p>Màn hình phụ lần này có kích thước 6.2 inch giúp bạn có thể dễ dàng sử dụng các tác vụ thông thường mà không cần mở hết chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd\">điện thoại</a>&nbsp;gập. Vì được trang bị hai màn hình cả trước và sau nên đây được xem là một lợi thế rất lớn so với những chiếc flagship chỉ có một màn hình đến từ nhiều thương hiệu khác trên thị trường.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090618.jpg\" alt=\"Màn hình phụ lớn - Samsung Galaxy Z Fold4 5G 512GB\"></figure><p>Cả hai màn hình này đều được hỗ trợ tần số quét 120 Hz và độ sáng 1200 nits giúp cho mọi thao tác của người dùng có thể diễn ra một cách mượt mà, cũng như sử dụng máy ở ngoài trời được dễ dàng hơn bởi nội dung được hiển thị rõ ràng kể cả những môi trường có độ sáng cao.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/250625/samsung-galaxy-z-fold4-100822-070505.jpg\" alt=\"Camera trước ẩn dưới màn hình - Samsung Galaxy Z Fold4 5G\"></figure><h3>Hiệu năng mạnh mẽ hàng đầu trên smartphone</h3><p>Con chip trang bị bên trong máy là bộ vi xử lý mới ra mắt và đã lấy được cảm tình của cộng đồng người dùng công nghệ trên toàn cầu với tên gọi Snapdragon 8+ Gen 1. Nhờ có hiệu suất cao mà giờ đây mọi tác vụ từ giải trí chơi game hay đàm thoại công việc thì máy đều có thể xử lý một cách dễ dàng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090620.jpg\" alt=\"Chipset mạnh mẽ - Samsung Galaxy Z Fold4 5G 512GB\"></figure><p><a href=\"https://www.thegioididong.com/dtdd-ram-12gb\">Điện thoại RAM 12 GB</a> giúp cho thiết bị vận hành trơn tru hơn khi sử dụng nhiều tác vụ cùng lúc hay đa nhiệm được mượt mà. Bộ nhớ trong lên đến 512 GB đem đến không gian lưu trữ lớn để bạn thoải mái tải xuống dữ liệu hay quay phim, chụp ảnh số lượng lớn.</p><h3>Hỗ trợ công nghệ sạc nhanh</h3><p>Galaxy Z Fold4 được trang bị một viên pin kép có dung lượng 4400 mAh mang đến thiết bị thời lượng dùng cả ngày cho các tác vụ cơ bản như nhắn tin, đàm thoại hay nghe nhạc.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/285031/samsung-galaxy-z-fold4-5g-512gb-100822-090623.jpg\" alt=\"Sử dụng dài lâu - Samsung Galaxy Z Fold4 5G 512GB\"></figure><p>Để có thể nạp đầy dung lượng pin trong thời gian ngắn hơn thì Samsung cũng có hỗ trợ thêm cho máy công nghệ sạc nhanh 25 W, ngoài ra bạn cũng có thể chia sẻ lượng pin có trong máy qua các thiết bị khác khác có hỗ trợ thông qua tính năng chia sẻ pin không dây.</p><p>Với những bạn yêu thích sử mới mẻ, muốn thay đổi cách sử dụng smartphone thông thường thì chiếc điện thoại gập Galaxy Z Fold4 512GB có lẽ là một cái tên không nên bỏ qua. Sở hữu nhiều công nghệ hàng đầu từ camera cho đến hiệu năng để bạn có thể thoải mái chiến game hay thỏa sức chụp ảnh chất lượng cao.</p>', 29, 'dien-thoai-samsung-galaxy-z-fold4-5g-256gb-655df3f345242', 1, 17, '2023-11-20 22:32:42', '2023-12-05 10:08:29'),
(90, 'Điện thoại Xiaomi Redmi 12 4GB', 30, 3690000, 8, 1, 28, 356, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700495413/uploads_ecommerce_php_5_1/php54DC_eairxw.jpg', 5, 1, '<p>Xiaomi Redmi 12 sẽ là sự lựa chọn phù hợp với những bạn đang có nhu cầu tìm kiếm một chiếc điện thoại có vẻ ngoài đẹp mắt, màn hình lớn cho hình ảnh sắc nét cùng một hiệu năng ổn định với các tác vụ hằng ngày.</p>', '<h3>Xiaomi Redmi 12 mẫu điện thoại mới nhất được nhà <a href=\"https://www.thegioididong.com/dtdd-xiaomi\">Xiaomi</a> tung ra vào tháng 06/2023 khiến cho cộng đồng đam mê công nghệ vô cùng thích thú. Máy khoác lên mình một vẻ ngoài cá tính, màn hình lớn đem đến trải nghiệm đã mắt cùng một hiệu năng ổn định với mọi tác vụ.</h3><h3>Vẻ ngoài đơn giản</h3><p>Thiết kế của <a href=\"https://www.thegioididong.com/dtdd/xiaomi-redmi-12-4gb\">Xiaomi Redmi 12 4GB </a>được lấy cảm hứng từ sự tối giản khi mặt lưng được làm từ kính bóng bẩy đi cùng với thân máy khá mỏng nhẹ mang đến vẻ ngoài thời trang, trẻ trung cùng khả năng cầm nắm tốt hơn khi sử dụng trong thời gian dài.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/307556/xiaomi-redmi-12-4gb-190523-044751.jpg\" alt=\"Thiết kế đẹp mắt - Xiaomi Redmi 12 4GB\"></figure><p>Mặt trước của điện thoại thiết kế kiểu nốt ruồi, đồng thời các viền xung quanh được hãng tối ưu khá mỏng hứa hẹn mang đến cho bạn góc nhìn rộng hơn giúp việc giải trí trở nên trọn vẹn.</p><h3>Màn hình lớn giải trí vui</h3><p>Với mong muốn đem lại sự thư giãn sau giờ làm việc căng thẳng hoặc một góc nhìn rõ ràng sắc nét hơn. Xiaomi đã trang bị tấm nền IPS LCD với kích thước lên đến 6.79 inch cùng độ phân giải Full HD+ (1080 x 2460 Pixels)&nbsp;giúp bạn xem các nội dung trên YouTube hoặc Netflix tốt hơn. Màn hình này cho chất lượng hiển thị tốt, màu sắc chân thực, độ tương phản cao và góc nhìn rộng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/307556/xiaomi-redmi-12-4gb-190523-044750.jpg\" alt=\"Màn hình sắc nét - Xiaomi Redmi 12 4GB\"></figure><p>Redmi 12 hiển thị hình ảnh khá tốt khi ở ngoài trời nắng, không bị mờ khi máy có độ sáng tối đa lên đến 550 nits một con số ổn trong phân khúc. Ngoài ra, màn hình này còn được hỗ trợ tần số quét 90 Hz giúp cho các thao tác vuốt chạm trên máy được diễn ra mượt mà và nhanh chóng hơn.</p><h3>Trải nghiệm ổn định với các tác vụ thường ngày</h3><p>Cung cấp sức mạnh cho máy là chip xử lý Helio G88 đến từ nhà MediaTek, có tốc độ xử lý 2.0 GHz cho khả năng xử lý khá ổn định và mượt mà với các tác vụ lướt web, nghe nhạc, xem phim, chỉnh sửa ảnh,… thậm chí bạn có thể chơi với các tựa game như: Liên Quân Mobile, PUBG Mobile ở mức cấu hình tầm trung.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/307556/xiaomi-redmi-12-4gb-cpu.jpeg\" alt=\"Hiệu năng mượt mà - Xiaomi Redmi 12\"></figure><p><a href=\"https://www.thegioididong.com/dtdd-ram-4gb\">Điện thoại RAM 4 GB</a> tuy mức RAM không quá cao nhưng hãng cũng đã tích hợp tính năng mở rộng RAM nên vấn đề đa nhiệm trên máy không còn quá bận tâm nữa. Khi các thao tác chuyển đổi qua lại giữa tab không phải đợi load lại cũng như gặp hiện tượng giật lag.</p><h3>Cụm camera chất lượng để trải nghiệm</h3><p>Cụm camera sau của Redmi 12 bao gồm camera chính 50 MP, 2 camera phụ 8 MP và 2 MP, hỗ trợ quay phim và chụp ảnh chất lượng cao với các hiệu ứng làm đẹp thông minh, cân bằng tốt màu sắc và ánh sáng cho bức ảnh chân thực, có độ nét cao.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/307556/xiaomi-redmi-12-4gb-030623-103603.jpg\" alt=\"Camera chụp ảnh sắc nét - Xiaomi Redmi 12\"></figure><p>Phía trước điện thoại bạn sẽ có ngay camera selfie với độ phân giải 8 MP đi cùng với nhiều tính năng như: làm đẹp, bộ lọc màu,... giúp bạn có những bức ảnh tự sướng đẹp mắt mà không cần dùng đến ứng dụng bên thứ 3.</p><h3>Viên pin 5000 mAh thoải mái dùng cả ngày</h3><p>Một chi tiết đáng chú ý khác của Xiaomi Redmi 12 là viên pin lớn 5000 mAh, <a href=\"https://www.thegioididong.com/dtdd\">điện thoại</a> có thể dễ dàng cung cấp đủ năng lượng để giữ cho thiết bị hoạt động suốt cả ngày, ngay cả khi sử dụng nhiều.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/42/307556/xiaomi-redmi-12-4gb-190523-044756.jpg\" alt=\"Viên pin lớn - Xiaomi Redmi 12 4GB\"></figure><p>Bên cạnh đó, máy cũng hỗ trợ sạc nhanh 18 W, vì vậy bạn có thể nhanh chóng lấp đầy dung lượng của thiết bị mà không cần phải mất quá nhiều thời gian chờ đợi.</p><p>Xiaomi Redmi 12 sẽ là sự lựa chọn phù hợp với những bạn đang có nhu cầu tìm kiếm một chiếc điện thoại có vẻ ngoài đẹp mắt, màn hình lớn cho hình ảnh sắc nét cùng một hiệu năng ổn định với các tác vụ hằng ngày.</p>', 29, 'dien-thoai-xiaomi-redmi-12-4gb-655df3fc24f2c', 1, 127, '2023-11-20 22:50:07', '2023-12-05 10:08:58'),
(91, 'Laptop HP 15s fq5229TU i3 1215U/8GB/512GB/Win11 (8U237PA) ', 22, 13690000, 0, 1, 2, 34, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700559865/uploads_ecommerce_php_5_1/php3051_xxm7eq.png', 0, 0, '<p>Laptop HP cơ bản được hoàn thiện với gam màu bạc trung tính, vỏ nhựa cứng cáp cùng kiểu dáng hiện đại để bạn có thể mang theo làm việc ở bất cứ đâu. Với khối lượng 1.69 kg, laptop dễ dàng nằm gọn trong balo cho bạn mang theo đến trường học, cơ quan hay quán coffee.</p>', '<h3>Với một mức giá thành lý tưởng, bạn đã có thể sở hữu cho mình một mẫu <a href=\"https://www.thegioididong.com/laptop?g=hoc-tap-van-phong\">laptop học tập - văn phòng</a> có hiệu năng ổn định, ngoại hình thanh lịch cùng các tính năng hiện đại. <a href=\"https://www.thegioididong.com/laptop/hp-15s-fq5229tu-i3-8u237pa\">Laptop&nbsp;HP 15s fq5229TU i3 1215U&nbsp;(8U237PA)</a> chắc chắn sẽ đáp ứng đầy đủ nhu cầu làm việc, học tập và giải trí thường ngày của sinh viên cũng như người đi làm.</h3><p>• <a href=\"https://www.thegioididong.com/laptop-hp-compaq\">Laptop HP</a> sử dụng bộ vi xử lý&nbsp;<strong>Intel Core i3 1215U</strong> kết hợp cùng hiệu suất xử lý nâng cao của card tích hợp <strong>Intel UHD Graphics </strong>cho phép người dùng khả năng xử lý công việc trơn tru trên Word, Excel, PowerPoint,... cũng như giải trí, xem phim lướt web và chơi các tựa game nhẹ.</p><p>• Với bộ nhớ <strong>RAM 8 GB </strong>có hỗ trợ nâng cấp tối đa <strong>16 GB</strong>, bạn có thể mở cùng lúc nhiều tab công việc, chuyển qua lại giữa nhiều tác vụ hay vừa làm việc vừa nghe nhạc mà không bị hiện tượng đơ máy gây khó chịu. Hơn nữa, ổ cứng <strong>SSD 512 GB</strong> <strong>NVMe PCIe</strong> giúp tăng tốc độ khởi động hệ thống lên đáng kể, cũng như đem lại không gian lưu trữ thoải mái cho nhiều tệp tin.</p><p>• Màn hình <a href=\"https://www.thegioididong.com/laptop\">laptop </a>kích thước <strong>15.6 inch</strong> có độ phân giải&nbsp;<strong>Full HD (1920 x 1080) </strong>cho bạn tha hồ trải nghiệm nội dung với khung hình lớn, hình ảnh rõ nét và chi tiết cho làm việc và xem phim thú vị. Ngoài ra, công nghệ chống chói<strong> Anti Glare</strong> làm hạn chế đáng kể tình trạng bóng gương trên màn hình khi người dùng làm việc ngoài trời hay dưới ánh sáng mạnh.</p><p>• Hệ thống <strong>loa kép</strong> cho chất âm to rõ, sống động, phục vụ trọn vẹn cho trải nghiệm xem phim, nghe nhạc và làm việc.</p><p>• <a href=\"https://www.thegioididong.com/laptop-hp-compaq-co-ban\">Laptop HP cơ bản</a> được hoàn thiện với gam <strong>màu bạc </strong>trung tính, <strong>vỏ nhựa </strong>cứng cáp cùng kiểu dáng hiện đại để bạn có thể mang theo làm việc ở bất cứ đâu. Với khối lượng&nbsp;<strong>1.69 kg</strong>, laptop dễ dàng nằm gọn trong balo cho bạn mang theo đến trường học, cơ quan hay quán coffee.</p><p>• Đầy đủ các cổng kết nối thông dụng dọc hai bên máy như: USB Type-C (chỉ hỗ trợ truyền dữ liệu), Jack tai nghe 3.5 mm, USB Type-A, HDMI và khe SD để thực hiện kết nối nhanh chóng khi cần thiết.</p>', 10, 'laptop-hp-15s-fq5229tu-i3-1215u8gb512gbwin11-8u237pa-655df3daf079c', 1, 16, '2023-11-21 16:44:18', '2023-11-21 16:44:18'),
(92, 'Màn hình MSI PRO MP243X 23.8 inch FHD/IPS/100Hz/4ms/HDMI ', 23, 2790000, 0, 1, 1, 29, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701428692/uploads_ecommerce_php_5_1/phpDC2C_t0ldd5.jpg', 5, 1, '<p>Với tần số quét <strong>100 Hz </strong>và thời gian đáp ứng chỉ <strong>4&nbsp;ms</strong>, màn hình cung cấp hình ảnh mượt mà và không bị giật, giảm thiểu các tình trạng nhòa mờ, duy trì tốt độ chính xác cho các chuyển động, hỗ trợ tốt khi bạn trải nghiệm các bộ phim hành động hay các tựa game có tốc độ chuyển cảnh nhanh.</p>', '<h3><a href=\"https://www.thegioididong.com/man-hinh-may-tinh/msi-pro-mp243x-23-8-inch-fhd\">Màn hình MSI PRO MP243X 23.8 inch FHD</a> sở hữu tần số quét 100 Hz, thời gian đáp ứng 4 ms mang đến cho bạn trải nghiệm hình ảnh tuyệt vời, cùng 119% sRGB và những thông số cao, hiện đại. Chiếc <a href=\"https://www.thegioididong.com/man-hinh-may-tinh-do-hoa\">màn hình đồ họa</a> này chắc chắn sẽ đáp ứng đầy đủ bạn từ các nhu cầu làm việc, giải trí thường ngày đến chơi game hay làm việc đồ họa.</h3><p>•&nbsp;<a href=\"https://www.thegioididong.com/man-hinh-may-tinh-msi\">Màn hình máy tính MSI</a> có kích thước <strong>23.8 inch </strong>sử dụng tấm nền<strong> IPS </strong>cùng độ phân giải<strong>&nbsp;Full HD (1920 x 1080) </strong>mang đến không gian rộng rãi cùng chất lượng hình ảnh sắc nét để bạn thoải mái trải nghiệm các nội dung khác nhau. Hơn nữa, công nghệ chống chói<strong> Anti-Glare </strong>làm hạn chế tình trạng bóng gương, tăng cường khả năng quan sát của người dùng dưới điều kiện ánh sáng cao.</p><p>• Với tần số quét <strong>100 Hz </strong>và thời gian đáp ứng chỉ <strong>4&nbsp;ms</strong>, màn hình cung cấp hình ảnh mượt mà và không bị giật, giảm thiểu các tình trạng nhòa mờ, duy trì tốt độ chính xác cho các chuyển động, hỗ trợ tốt khi bạn trải nghiệm các bộ phim hành động hay các tựa game có tốc độ chuyển cảnh nhanh.</p><p>• Đặc biệt, chiếc màn hình này còn có độ phủ màu đạt&nbsp;<strong>119% sRGB </strong>đem đến khả năng tái tạo màu sắc chuẩn xác khi bạn làm việc đồ họa hay chỉnh sửa hình ảnh, video.&nbsp;MSI còn trang bị tính năng <strong>Eye Care</strong>, được thiết kế đặc biệt để bảo vệ sức khỏe của mắt bằng cách điều chỉnh tự động độ sáng và màu sắc để tối ưu hóa trải nghiệm xem mà không gây căng thẳng cho mắt khi sử dụng lâu.</p><p>• Tính năng <strong>giảm ánh sáng xanh</strong> được tích hợp trên màn hình giúp giảm bớt ánh sáng xanh gây mỏi mắt và gây ảnh hưởng đến giấc ngủ. Kết hợp với tính năng <strong>Anti-Flicker</strong> cũng giúp giảm nhấp nháy không chỉ gây phiền hà khi xem, mà còn gây mệt mỏi và khó chịu cho mắt, từ đó đảm bảo bạn có một trải nghiệm xem mượt mà và không gây khó chịu cho mắt.</p><p>• <a href=\"https://www.thegioididong.com/man-hinh-may-tinh\">Màn hình máy tính</a> được trang bị <strong>loa tích hợp </strong>để mang đến cho người dùng trải nghiệm âm thanh tốt nhất trong khi làm việc hoặc giải trí. Ngoài ra,&nbsp;với khả năng gắn <strong>ARM chuẩn VESA</strong>, bạn có thể dễ dàng thay đổi vị trí màn hình theo ý muốn, điều chỉnh độ cao, nghiêng, quay và xoay một cách linh hoạt.</p><p>•&nbsp;MSI PRO MP243X được hoàn thiện với kiểu dáng tinh tế, hiện đại rất phù hợp để đặt trong phòng làm việc cá nhân, văn phòng hay các quầy lễ tân,... Khối lượng tổng thể&nbsp;<strong>4.15 kg </strong>cũng không quá khó khăn khi di chuyển và lắp đặt.&nbsp;</p><p>• Màn hình cũng có DisplayPort, HDMI, Headphone-out cho phép bạn kết nối nhanh chóng với các thiết bị như máy tính, loa và nhiều thiết bị khác.&nbsp;</p>', 24, 'man-hinh-msi-pro-mp243x-238-inch-fhdips100hz4mshdmi-6569be5be86bc', 1, 7, '2023-12-01 18:04:50', '2023-12-01 20:36:40'),
(94, 'Màn hình MSI Pro MP273QP 27 inch 2K/IPS/75Hz/1ms/HDMI', 23, 5690000, 0, 1, 0, 90, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429051/uploads_ecommerce_php_5_1/php650A_r7rdnt.jpg', 0, 0, '<p>Màn hình có khả năng hiển thị&nbsp;<strong>16.7 triệu màu</strong>&nbsp;và đạt chuẩn <strong>102% sRGB</strong>&nbsp;vừa nâng cao trải nghiệm xem vừa đáp ứng được nhu cầu làm việc với đồ họa cần tinh chỉnh màu sắc chuyên nghiệp. Độ sáng&nbsp;<strong>350 cd/m2</strong> đảm bảo nội dung luôn được thể rõ nhất dù bạn làm việc dưới bóng đèn điện chói sáng.</p>', '<h3><a href=\"https://www.thegioididong.com/man-hinh-may-tinh/msi-pro-mp273qp-27-inch-2k-75hz\">Màn hình MSI Pro MP273QP 27 inch 2K</a> là sản phẩm mới nhất của nhà MSI, được thiết kế để đáp ứng nhu cầu làm việc với đồ họa hoặc giải trí hằng ngày của người dùng khi sở hữu những tính năng ưu việt cho khả năng hiển thị nội dung chất lượng cao.</h3><p>• Với kích thước <strong>27 inch </strong>độ phân giải <strong>QHD (2560 x 1440)</strong>, <a href=\"https://www.thegioididong.com/man-hinh-may-tinh-msi\">màn hình máy tính MSI</a> đem lại độ sắc nét và chi tiết cao hơn so với các màn hình Full HD thông thường, một lựa chọn tuyệt vời cho những người làm việc với đồ họa hoặc cần sử dụng một màn hình đủ lớn để chạy nhiều ứng dụng cùng lúc.</p><p>• Với tần số quét <strong>75 Hz</strong>, chiếc <a href=\"https://www.thegioididong.com/man-hinh-may-tinh\">màn hình máy tính</a> này có khả năng hiển thị hình ảnh sắc nét và mượt mà, mang đến cho bạn những phút giây giải trí tuyệt vời khi chơi game và xem phim. Thời gian đáp ứng chỉ <strong>1&nbsp;ms</strong> giúp giảm thiểu hiện tượng mờ và giật hình trong các cảnh chuyển động nhanh. Công nghệ <strong>Adaptive-sync</strong>&nbsp;giảm thiểu hiện tượng giật hình và tách hình trong quá trình chơi game.</p><p>• Màn hình có khả năng hiển thị&nbsp;<strong>16.7 triệu màu</strong>&nbsp;và đạt chuẩn <strong>102% sRGB</strong>&nbsp;vừa nâng cao trải nghiệm xem vừa đáp ứng được nhu cầu làm việc với đồ họa cần tinh chỉnh màu sắc chuyên nghiệp. Độ sáng&nbsp;<strong>350 cd/m2</strong> đảm bảo nội dung luôn được thể rõ nhất dù bạn làm việc dưới bóng đèn điện chói sáng.</p><p>•&nbsp;<a href=\"https://www.thegioididong.com/man-hinh-may-tinh-2k\">Màn hình máy tính 2K</a> này cũng được trang bị công nghệ <strong>giảm ánh sáng xanh</strong>, chống nháy <strong>Anti-Flicker </strong>và chống chói <strong>Anti-Glare</strong> giúp bảo vệ đôi mắt của bạn khỏi tác hại của ánh sáng xanh hay các hiệu ứng không tốt gây mỏi mắt khi sử dụng trong thời gian dài.</p><p>•&nbsp;Bên cạnh đó bạn còn có thể <strong>điều chỉnh góc nhìn </strong>của màn hình&nbsp;một cách dễ dàng, cũng như gắn <strong>ARM chuẩn VESA</strong> để nâng cao trải nghiệm. Thiết bị cũng được tích hợp <strong>loa</strong> giúp bạn giải trí, tham gia lớp học hoặc cuộc họp trực tuyến thuận tiện hơn.</p><p>•&nbsp;Các cổng giao tiếp như HDMI, DisplayPort và Headphone-out cho phép người dùng kết nối với màn hình và tai nghe một cách linh hoạt, dễ dàng. Màn hình MSI Pro MP273QP có kiểu dáng sang trọng và hiện đại với viền mỏng ở các cạnh, giúp làm tôn lên không gian làm việc hay giải trí của bạn.</p>', 24, 'man-hinh-msi-pro-mp273qp-27-inch-2kips75hz1mshdmi-6569bf89c2d1b', 1, 7, '2023-12-01 18:10:50', '2023-12-01 18:10:50'),
(96, 'Asus S500SD i5 12400/8GB/256GB/Bàn phím/Chuột/Win11 (512400050W)', 2, 13890000, 0, 1, 0, 34, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429499/uploads_ecommerce_php_5_1/php3BC4_rmpr2y.jpg', 0, 0, '<p>PC được trang bị bộ nhớ <strong>RAM 8 GB DDR4</strong> và hỗ trợ nâng cấp lên tới <strong>64 GB</strong>, cho phép bạn tăng tốc độ xử lý và cải thiện hiệu suất hệ thống. Từ đó hỗ trợ bạn làm việc đa nhiệm mượt mà, vừa mở ứng dụng làm việc vừa nghe nhạc đều trơn tru.</p>', '<h3>Bạn đang tìm kiếm một chiếc <a href=\"https://www.thegioididong.com/may-tinh-de-ban-pc\">PC</a> mạnh mẽ, đáp ứng nhu cầu làm việc và giải trí hàng ngày? Tham khảo ngay <a href=\"https://www.thegioididong.com/may-tinh-de-ban/asus-s500sd-i5-512400050w\">PC Asus S500SD i5 12400 (512400050W)</a> với ngoại hình tối giản cùng những thông số cấu hình ấn tượng.</h3><p>•&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-de-ban-asus\">PC Asus</a> được trang bị bộ vi xử lý <strong>Intel Core i5 12400</strong> với tốc độ xung nhịp lên đến <strong>4.40 GHz,</strong> cho phép xử lý các tác vụ đa nhiệm và xử lý dữ liệu phức tạp một cách mạnh mẽ và nhanh chóng, từ các ứng dụng văn phòng cho đến thiết kế, chơi game.</p><p>• Card tích hợp <strong>Intel UHD Graphics 730</strong>&nbsp;có khả năng xuất nội dung với độ phân giải lên đến 4K, cung cấp đủ sức mạnh để xử lý các tác vụ đồ họa thông thường và các ứng dụng văn phòng như Word, Excel, PowerPoint.</p><p>• Nhờ bo mạch chủ&nbsp;<strong>Intel B660&nbsp;</strong>với các tính năng bảo vệ và quản lý điện năng thông minh để tối ưu hiệu suất và tiết kiệm điện năng. Bộ nguồn <strong>300 W</strong> cung cấp đủ điện năng cho toàn bộ các linh kiện và đảm bảo độ ổn định trong quá trình hoạt động.</p><p>•&nbsp;PC được trang bị bộ nhớ <strong>RAM 8 GB DDR4</strong> và hỗ trợ nâng cấp lên tới <strong>64 GB</strong>, cho phép bạn tăng tốc độ xử lý và cải thiện hiệu suất hệ thống. Từ đó hỗ trợ bạn làm việc đa nhiệm mượt mà, vừa mở ứng dụng làm việc vừa nghe nhạc đều trơn tru.</p><p>•&nbsp;Ổ cứng <strong>SSD 256 GB</strong> với khe cắm ổ <strong>SSD M.2&nbsp;PCIe 4.0</strong> mở rộng cung cấp đủ không gian lưu trữ cho tất cả các tệp và dữ liệu học tập, công việc của bạn, tốc độ truy xuất dữ liệu giúp tối ưu tốc độ xử lý của hệ thống.</p><p>•&nbsp;Với nhiều cổng giao tiếp như: HDMI, USB-A, USB-C, LAN,..., PC cho phép kết nối với các thiết bị ngoại vi khác nhau. Máy đi kèm&nbsp;<strong>bàn phím</strong> và <strong>chuột</strong>, đồng thời được cài đặt sẵn hệ điều hành <strong>Windows 11</strong> để bạn có thể bắt đầu sử dụng máy ngay khi mua về.</p><p>•&nbsp;Với thiết kế&nbsp;<strong>vỏ nhựa</strong> <strong>màu đen </strong>chắc chắn và kích thước tổng thể <strong>9.46 x 29.27 x 33.96 cm</strong>, PC sẽ phù hợp với nhiều không gian khác nhau.</p>', 30, 'asus-s500sd-i5-124008gb256gbban-phimchuotwin11-512400050w-6569c0f86e750', 1, 0, '2023-12-01 18:18:18', '2023-12-01 18:18:18'),
(97, 'HP ProOne 440 G9 AIO i5 12500T/8GB/512GB/23.8\"F/Touch/Bàn phím/Chuột/Win11 (6M3X9PA)', 22, 22990000, 0, 1, 0, 23, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701429729/uploads_ecommerce_php_5_1/phpBBC9_mdzupp.jpg', 0, 0, '<p>Công nghệ <strong>Wi-Fi 6</strong> mang lại tốc độ truyền tải nhanh hơn, độ ổn định tốt hơn và độ bảo mật cao hơn so với các chuẩn Wi-Fi trước đó, trong khi <strong>Bluetooth 5.3</strong> cho phép kết nối không dây với các thiết bị ngoại vi như tai nghe, loa, chuột, bàn phím,... một cách dễ dàng, nhanh chóng.</p>', '<h3>Với thiết kế đẹp mắt và tính năng tiện ích, <a href=\"https://www.thegioididong.com/may-tinh-de-ban/hp-proone-440-g9-aio-i5-6m3x9pa\">máy tính để bàn HP ProOne 440 G9 AIO i5 12500T (6M3X9PA)</a> sẽ giúp người dùng thực hiện công việc một cách dễ dàng và hiệu quả, một sự lựa chọn hoàn hảo cho các bạn học sinh, sinh viên và nhân viên văn phòng.</h3><p>• <a href=\"https://www.thegioididong.com/may-tinh-de-ban-hp\">Máy tính để bàn HP</a> được trang bị bộ vi xử lý <strong>Intel Core i5 12500T</strong> thế hệ 12 với tốc độ xung nhịp tối đa lên đến <strong>4.40 GHz</strong> nhờ <strong>Turbo Boost</strong>, giúp máy tính có khả năng thực hiện mượt mà các tác vụ văn phòng và học tập trên các phần mềm như Word, Excel, PowerPoint. Bên cạnh đó máy cũng có thể vận hành các hoạt động giải trí như xem phim, lướt web với tốc độ nhanh và ổn định.</p><p>• Card tích hợp <strong>Intel UHD Graphics 770</strong>&nbsp;cho phép máy tính có khả năng xử lý tốt các tác vụ đồ họa cơ bản trên những phần mềm như Photoshop, AI, Canva,... Ngoài ra, card đồ họa này cũng cho phép người dùng chơi một số tựa game phổ biến ở mức cấu hình trung bình một cách mượt mà.</p><p>• Bộ nhớ <strong>RAM 8 GB</strong> chuẩn <strong>DDR4</strong> với khả năng nâng cấp lên đến <strong>64 GB</strong>, cho phép người dùng làm việc và giải trí trên máy tính một cách hiệu quả và không bị gián đoạn. Bên cạnh đó, ổ cứng <strong>SSD 512 GB</strong> giúp thời gian ghi đọc dữ liệu trở nên nhanh chóng và tăng tốc độ khởi động hệ thống.</p><p>• Nhờ màn hình rộng <strong>23.8 inch</strong> độ phân giải <strong>Full HD</strong>, người dùng có thể tận hưởng trải nghiệm giải trí tuyệt vời với các tác vụ như phim, video, chơi game. Đồng thời, công nghệ <strong>Anti Glare</strong> giúp giảm thiểu tình trạng chói sáng, đảm bảo sức khỏe cho đôi mắt của người dùng.</p><p>• <a href=\"https://www.thegioididong.com/may-tinh-de-ban-aio\">Máy tính để bàn All in one</a> của HP còn được trang bị <strong>camera 5 MP</strong>, cho phép người dùng dễ dàng tham gia các cuộc họp trực tuyến, gọi điện thoại video hay các hoạt động làm việc, học tập từ xa một cách thuận tiện và nhanh chóng.</p><p>• Công nghệ <strong>Wi-Fi 6</strong> mang lại tốc độ truyền tải nhanh hơn, độ ổn định tốt hơn và độ bảo mật cao hơn so với các chuẩn Wi-Fi trước đó, trong khi <strong>Bluetooth 5.3</strong> cho phép kết nối không dây với các thiết bị ngoại vi như tai nghe, loa, chuột, bàn phím,... một cách dễ dàng, nhanh chóng.</p><p>• <a href=\"https://www.thegioididong.com/may-tinh-de-ban\">Máy tính để bàn</a> có thiết kế đẹp mắt với các đường nét hiện đại, tông <strong>màu đen</strong> thanh lịch, phù hợp với nhiều không gian khác nhau,&nbsp;giúp bạn tập trung vào công việc và học tập một cách hiệu quả.</p><p>• Thiết bị được trang bị đầy đủ các cổng giao tiếp như: LAN, HDMI, SuperSpeed USB Type-A, SuperSpeed USB Type-C,... để bạn dễ dàng kết nối với nhiều thiết bị ngoại vi khác nhau, tối ưu hóa trải nghiệm sử dụng.</p>', 30, 'hp-proone-440-g9-aio-i5-12500t8gb512gb238ftouchban-phimchuotwin11-6m3x9pa-6569c1ddca747', 1, 10, '2023-12-01 18:22:08', '2023-12-01 18:22:08'),
(98, 'Pin sạc dự phòng Polymer 10000mAh Type C 15W AVA+ DS2107 ', 20, 500000, 0, 1, 0, 34, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1701435400/uploads_ecommerce_php_5_1/php410B_kn8dwi.jpg', 0, 0, '<p>Ấn tượng với dung lượng pin 10.000 mAh, thiết kế 3 cổng sạc 2 chiều, màu sắc thời trang, kiểu dáng gọn nhẹ, chất lượng tốt, <a href=\"https://www.thegioididong.com/sac-dtdd/pin-polymer-10000mah-type-c-ava-ds2107\">pin sạc dự phòng Polymer 10000mAh Type C AVA+ DS2107</a> chắc chắn sẽ là phụ kiện yêu thích nhất của bạn trong thời gian tới đấy.&nbsp;</p>', '<h3>Nạp pin&nbsp;<a href=\"https://www.thegioididong.com/dtdd\">điện thoại</a> nhiều lần nhờ có&nbsp;<a href=\"https://www.thegioididong.com/sac-dtdd-10000mah\">dung lượng sạc dự phòng 10.000 mAh</a></h3><p>Nguồn tích trữ năng lượng dồi dào cho bạn hoàn toàn yên tâm khi khám phá các vùng đất mới hoặc công tác ở những nơi thiếu nguồn điện, sạc dự phòng sẽ luôn đảm bảo điện thoại có đủ năng lượng để bạn xử lý công việc, chụp ảnh, quay video khi cần.</p><p>Sạc dự phòng tương thích đa dạng thiết bị, có thể sạc cho iPhone X tầm 2.3 lần với hiệu suất sạc lên đến&nbsp;<strong>64%</strong>.</p><p><a href=\"https://www.thegioididong.com/hoi-dap/so-sanh-pin-li-ion-va-pin-li-po-651833#lipo\"><strong>Lõi pin Polymer</strong></a>&nbsp;cho khối lượng sản phẩm nhẹ, dùng bền, hạn chế rò rỉ năng lượng, duy trì quá trình sạc liền mạch, an toàn.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/57/245112/pin-polymer-10000mah-type-c-ava-ds2107-1.jpg\" alt=\"Pin sạc dự phòng Polymer 10000mAh Type C AVA+ DS2107 - Nạp pin điện thoại nhiều lần nhờ có dung lượng sạc dự phòng 10.000 mAh\"></figure><h3>Sạc 2 chiều tiện lợi qua 3 cổng USB, Type-C và Micro USB</h3><p>Nguồn ra, thiết bị có cổng&nbsp;<strong>USB&nbsp;5V - 2A</strong>,&nbsp;<strong>Type-C 5V - 3A</strong>, công suất sạc tối đa khi sạc cùng lúc 2 cổng lên tới 15 W cho tốc độ nạp pin mạnh mẽ, giảm đáng kể thời gian chờ đợi.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/57/245112/pin-polymer-10000mah-type-c-ava-ds2107-4.jpg\" alt=\"Pin sạc dự phòng Polymer 10000mAh Type C AVA+ DS2107 - Công suất sạc tối đa khi sạc cùng lúc 2 cổng lên tới 15 W\"></figure><p>Dải&nbsp;<strong>đèn LED báo hiệu&nbsp;</strong>dung lượng pin được tích hợp ở mặt trước pin sạc dự phòng cho phép bạn theo dõi nhanh, mỗi đèn thể hiện cho&nbsp;<strong>25%</strong>&nbsp;dung lượng pin.&nbsp;</p><p>Đặc biệt, cổng Type-C cũng đồng thời là nguồn vào cho dòng sạc&nbsp;5V - 3A, cổng vào&nbsp;<strong>Micro USB 5V - 2A</strong>, cung cấp cho bạn 2 lựa chọn sạc vào, kết hợp với nhiều loại cáp sạc để nạp pin hiệu quả hơn.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/57/245112/pin-polymer-10000mah-type-c-ava-ds2107-2.jpg\" alt=\"Pin sạc dự phòng Polymer 10000mAh Type C AVA+ DS2107 - Sạc 2 chiều tiện lợi qua 3 cổng USB, Type-C và Micro USB\"></figure><h3>Thời gian nạp pin lại linh hoạt</h3><p>Khi <a href=\"https://www.thegioididong.com/sac-dtdd\">sạc dự phòng</a> sắp hết pin, bạn có thể sạc lại cùng&nbsp;<strong>adapter 1A&nbsp;</strong>trong khoảng&nbsp;<strong>10 - 11 tiếng</strong>&nbsp;hoặc rút ngắn thời gian sạc với&nbsp;<strong>adapter 2A</strong>, khi sạc đầy pin chỉ trong&nbsp;<strong>5 - 6 tiếng</strong>.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/57/245112/pin-polymer-10000mah-type-c-ava-ds2107-3.jpg\" alt=\"Pin sạc dự phòng Polymer 10000mAh Type C AVA+ DS2107 - Thời gian nạp pin lại linh hoạt\"></figure><h3>AVA+ DS2107 kiểu dáng nhỏ nhắn, cầm vừa vặn trong lòng bàn tay</h3><p>Tối giản về kích cỡ mang đến cho bạn 1 thiết kế <a href=\"https://www.thegioididong.com/sac-dtdd-ava-plus\">sạc dự phòng&nbsp;AVA+</a>&nbsp;cực kỳ nhỏ gọn, có thể cho vào túi quần, túi áo hoặc đặt trong túi đồ thường nhật và đem theo bên mình thuận tiện khi đi đến trường, công ty, du lịch,... Thiết kế 2 phiên bản&nbsp;<strong>màu đen sang trọng</strong>&nbsp;và&nbsp;<strong>màu trắng thanh nhã</strong>, hợp sở thích của cả phái mạnh và phái đẹp.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/57/245112/pin-polymer-10000mah-type-c-ava-ds2107-5.jpg\" alt=\"Pin sạc dự phòng Polymer 10000mAh Type C AVA+ DS2107 - AVA+ DS2107 kiểu dáng nhỏ nhắn, cầm vừa vặn trong lòng bàn tay\"></figure><p>Ấn tượng với dung lượng pin 10.000 mAh, thiết kế 3 cổng sạc 2 chiều, màu sắc thời trang, kiểu dáng gọn nhẹ, chất lượng tốt, <a href=\"https://www.thegioididong.com/sac-dtdd/pin-polymer-10000mah-type-c-ava-ds2107\">pin sạc dự phòng Polymer 10000mAh Type C AVA+ DS2107</a> chắc chắn sẽ là phụ kiện yêu thích nhất của bạn trong thời gian tới đấy.&nbsp;</p>', 9, 'pin-sac-du-phong-polymer-10000mah-type-c-15w-ava-ds2107-6569d8696b487', 1, 3, '2023-12-01 19:56:39', '2023-12-01 19:56:39'),
(99, 'Tai nghe Bluetooth Chụp Tai HAVIT H661BT', 2, 500000, 0, 1, 0, 23, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702021952/uploads_ecommerce_php_5_1/phpA3AD_iepvyc.jpg', 0, 0, '<p>Trang bị công nghệ kết nối Bluetooth 5.3 hiện đại cho phép kết nối nhanh chóng giữa tai nghe với thiết bị, cho bạn trải nghiệm âm nhạc liền mạch mà không lo bị ngắt quãng.</p>', '<h3><a href=\"https://www.thegioididong.com/tai-nghe/tai-nghe-bluetooth-chup-tai-havit-h661bt\">Tai nghe Bluetooth Chụp Tai Havit H661BT</a> là dạng tai nghe chụp tai, sở hữu vẻ ngoài sang trọng, âm thanh sống động, kết nối nhanh chóng và ổn định, thời lượng pin sử dụng khá lâu, mang đến cho bạn những trải nghiệm tối ưu nhất.</h3><p>•&nbsp;Diện mạo <a href=\"https://www.thegioididong.com/tai-nghe\">tai nghe</a> sang trọng, gam màu phù hợp với mọi phong cách và mọi lứa tuổi sử dụng.</p><p>• Trang bị công nghệ kết nối Bluetooth 5.3 hiện đại cho phép kết nối nhanh chóng giữa tai nghe với thiết bị, cho bạn trải nghiệm âm nhạc liền mạch mà không lo bị ngắt quãng.</p><p>•&nbsp;<a href=\"https://www.thegioididong.com/tai-nghe-havit\">Tai nghe HAVIT</a>&nbsp;có thể kết nối 2 thiết bị cùng 1 lúc vô cùng tiện lợi và dễ sử dụng.</p><p>• Tai nghe hỗ trợ mic thoại với chất lượng thu âm tốt giúp chất lượng cuộc gọi rõ ràng và chi tiết.</p><p>• Tương thích với nhiều hệ điều hành: macOS, iOS, Android và Windows cho phép bạn có thể kết nối được với đa dạng các loại thiết bị điện tử hiện nay.</p><p>• Âm thanh sôi động, phong phú và mạnh mẽ mang đến những buổi tiệc âm nhạc tuyệt vời.</p><p>• Trang bị sẵn dây cáp 3.5 mm với chiều dài 1.2 m để người dùng linh hoạt chuyển thành tai nghe có dây, tiện lợi sử dụng khi tai nghe hết pin hoặc thiết bị gặp vấn đề về kết nối.</p>', 4, 'tai-nghe-bluetooth-chup-tai-havit-h661bt-6572cb3f85038', 1, 2, '2023-12-08 14:52:35', '2023-12-08 14:52:35'),
(100, 'Tai nghe Chụp Tai Gaming Asus TUF H3', 2, 990000, 0, 1, 0, 345, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702022516/uploads_ecommerce_php_5_1/php4961_hqxqqi.jpg', 0, 0, '<p>Nói đến thao tác điều khiển, cá nhân mình vẫn thích dạng nút vật lý này vì nó dễ sử dụng, thao tác tay tiện lợi và không phức tạp, các nút điều khiển cực kỳ linh hoạt và nhạy trong lúc sử dụng gồm hai kiểu: nút bấm để điều chỉnh bật/tắt mic và con lăn tăng/giảm âm lượng.</p>', '<h3>Nói về tai nghe gaming, sau bộ đôi tai nghe TUF Gaming H5 và H7, Asus tiếp tục cho ra mắt chiếc <a href=\"https://www.thegioididong.com/tai-nghe/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do\">tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ</a>, một mẫu tai nghe có mức giá rất phải chăng nhưng chất lượng lại hơn sự kỳ vọng. Cùng mình tìm hiểu vì sao đã ra mắt cũng hơn hai năm nhưng chiếc tai nghe này có gì đáng đặc biệt để review lại.</h3><h3>Mang thiết kế hầm hố, mạnh mẽ kết hợp hai màu đỏ và đen đẹp mắt&nbsp;</h3><p>Về kiểu dáng, cảm nhận đầu tiên khi nhìn qua Gaming TUF H3 thì mình thấy cũng khá giống như chiếc <a href=\"https://www.thegioididong.com/tai-nghe/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do\">tai nghe Chụp Tai Gaming Asus TUF H3</a>. Phần chụp tai có form hình bầu dục, đệm tai có lớp bọc được làm kết hợp từ hai chất liệu là da cùng mút hoạt tính, mang lại sự vừa vặn, thoải mái kể cả các bạn có khuôn tai to, đeo vào khá êm và không bị cấn tai.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/54/223020/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do-1-1.jpg\" alt=\"Tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ - Thiết kế\"></figure><p>Ở mặt ngoài thiết kế, <a href=\"https://www.thegioididong.com/tai-nghe\">tai nghe</a> tuy không trang bị đèn LED RGB nhưng logo TUF GAMING được khắc ở ngay bề mặt ngoài của phần chụp tai cực kì đẹp mắt và trông khá “cool ngầu”.</p><p>Kế tiếp, phần gọng tai nghe là thép chống gỉ được gia công trông rất chắc chắn và bền bỉ, lực ép ở gọng tai khi đeo tương đối dễ chịu, mình có đưa cho bạn mình đeo thử kể cả các bạn đeo kính, đeo khoảng 2 - 3 tiếng vẫn rất thoải mái, không có cảm giác bị áp quá chặt vào tai hay trên đỉnh đầu.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/54/223020/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do-2-1.jpg\" alt=\"Tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ - Thiết kế\"></figure><p>Phần quai đeo ở đầu cũng khá mềm mại được gia công với chất liệu da có độ hoàn thiện tốt, đường chỉ may đều đặn, không hề có chỉ thừa, được in thêm cụm TUF GAMING làm điểm nhấn cho tai nghe.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/54/223020/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do-3-1.jpg\" alt=\"Tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ - Thiết kế\"></figure><p><a href=\"https://www.thegioididong.com/tai-nghe-asus\">Tai nghe Asus </a>TUF GAMING H3 có kết cấu chắc chắn, khối lượng khá nhẹ khoảng 294 g khi đeo không có cảm giác nặng đầu, gọng tai bằng thép không gỉ với màu đỏ sang trọng, có thể điều chỉnh linh hoạt để phù hợp với kích thước đầu của bạn, với form dáng của dòng tai nghe gaming này thì đối với các bạn nữ khi đeo vào trông sẽ hơi thô, tuy nhiên đối với các bạn nam thì sẽ không chê vào đâu được.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/54/223020/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do-4-1.jpg\" alt=\"Tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ - Tổng quan\"></figure><h3>Chất âm ấn tượng, mang lại trải nghiệm đa dạng ở mọi thể loại âm</h3><p>Tai nghe Gaming Asus TUF H3 được trang bị công nghệ âm thanh vòm 7.1, mình có mở YouTube và nghe thử qua một đoạn video âm thanh virtual 7.1 và theo cảm nhận của riêng mình, phải nói là khá ưng ý, ở phân khúc giá dưới 1 triệu nhưng khi nghe âm thanh phân vùng rất rõ, to và khá bén, không bị rè âm và trộn âm. Tuy nhiên, âm thanh tái tạo không gian nghe còn hơi hẹp, nhưng điểm này không thành vấn đề và mình nhận xét thì đối với chất lượng âm thanh như thế này vẫn đủ phục vụ cho bạn khi ở nhà xem phim hành động hoặc các chương trình giải trí.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/54/223020/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do-5-1.jpg\" alt=\"Tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ - Chất âm\"></figure><p>Đối với nhu cầu nghe nhạc, phải công nhận là mình khá hài lòng về chất âm của TUF H3, tất nhiên, cũng sẽ không làm bạn thất vọng khi bạn muốn tận hưởng nhiều thể loại nhạc. Là chiếc tai nghe gaming nhưng thể hiện âm bass khá ấm và đầm, chắc gọn, có lực vừa đủ ở những bản EDM có bass nhẹ, đây chính là điểm mà mình ấn tượng về em này. Ở dải Mid nghe khá chi tiết và rõ giọng ca sĩ, không có hiện tượng rè âm. Treble cũng khá hài hoà, không bị gắt ở các nốt cao.&nbsp;</p><p>Trong lúc chơi PUBG trên điện thoại, TUF H3 thể hiện âm thanh cực rõ và chân thật, nghe tiếng súng to, tiếng chân để xác định được phương hướng của địch, cực kì phù hợp cho các tay chơi game hàng ngày vì “em nó\" đáp ứng tốt hơn kỳ vọng rất nhiều.</p><h3>Kết nối ổn định, tương thích nhiều thiết bị kể cả các dòng máy chơi game</h3><p>Tai nghe được sử dụng là jack 3.5 mm phổ biến có độ dài khoảng 1.3 m, chiều dài khá lý tưởng để sử dụng với nhiều thiết bị như: <a href=\"https://www.thegioididong.com/laptop\">laptop</a>, pc, <a href=\"https://www.thegioididong.com/dtdd\">điện thoại</a>,... bao gồm cả các dòng máy chơi game: PS4, Nintendo Switch, Xbox 1. Dây của tai nghe có chất liệu là nhựa cho nên khi sử dụng bạn chú ý lúc cuộn quấn dây nên nhẹ nhàng để tránh tình trạng đứt gãy ở đầu kết nối.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/54/223020/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do-6-1.jpg\" alt=\"Tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ \"></figure><p>Phụ kiện có đi kèm thêm dây nối, rất tiện lợi cho các bạn dùng với PC khi ở trong không gian rộng, hoặc là sử dụng cho các máy chơi game. Dây nối là dạng dây bện cực chắc chắn, có hai cổng jack kết nối tai nghe và jack kết nối mic thoại đầy đủ.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/54/223020/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do-7-1.jpg\" alt=\"Tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ - Phụ kiện\"></figure><h3>Mic thoại ổn định, thao tác điều khiển linh hoạt&nbsp;</h3><p>Micro của TUF H3 được gắn liền với thân tai nghe, có độ uốn dẻo tốt và chắc chắn, điều chỉnh mic linh động trong phạm vi góc 180 độ, giữ được độ ổn định cao khi tuỳ chỉnh xong vị trí mic để sử dụng. Lúc sử dụng mic, đàm thoại với đối phương cực rõ, thu âm rất tốt, lọc được tiếng ồn kha khá và không thu tạp âm khi ở trong không gian rộng, nhiều người. Mình thấy rất phù hợp cho các bạn khi sử dụng trong phòng game hoặc ở nhà thường xuyên đàm thoại, học trực tuyến, tán gẫu với bạn bè.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/54/223020/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do-8-1.jpg\" alt=\"Tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ - Mic thoại\"></figure><p>Nói đến thao tác điều khiển, cá nhân mình vẫn thích dạng nút vật lý này vì nó dễ sử dụng, thao tác tay tiện lợi và không phức tạp, các nút điều khiển cực kỳ linh hoạt và nhạy trong lúc sử dụng gồm hai kiểu: nút bấm để điều chỉnh bật/tắt mic và con lăn tăng/giảm âm lượng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/54/223020/tai-nghe-chup-tai-gaming-asus-tuf-h3-den-do-9-1.jpg\" alt=\"Tai nghe chụp tai Gaming Asus TUF H3 Đen Đỏ \"></figure><p>Nhìn chung, TUF Gaming H3 thể hiện khá hơn nhiều so với một số mẫu tai nghe Gaming khác trong cùng phân khúc giá, từ chất âm để nghe nhạc xem phim cho đến việc chơi game thì đây là một chiếc tai nghe rất đáng để lựa chọn cho các bạn trẻ.&nbsp;</p>', 4, 'tai-nghe-chup-tai-gaming-asus-tuf-h3-6572cd7648f22', 1, 0, '2023-12-08 15:01:59', '2023-12-08 15:01:59');
INSERT INTO `product` (`id`, `title`, `brand_id`, `price`, `discount`, `isVariant`, `sold`, `quantity`, `thumb`, `totalRatings`, `totalUserRatings`, `short_description`, `description`, `cate_id`, `slug`, `status`, `view`, `create_at`, `update_at`) VALUES
(101, 'Đồng hồ thông minh Xiaomi Watch 2 Pro 46 mm Đen', 30, 6290000, 0, 1, 0, 245, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023088/uploads_ecommerce_php_5_1/php1C5_kxtfde.jpg', 0, 0, '<p>Mình đã tiến hành đàm thoại trên đồng hồ thì thấy chất lượng âm thanh khá tốt, không bị rè hay mất tiếng. Đồng hồ còn cho phép mình điều chỉnh âm lượng khi đàm thoại, phù hợp với nhiều môi trường sử dụng. Tuy nhiên, khi mình nhận cuộc gọi trên đường thì dù chỉnh âm lượng lên mức to nhất vẫn không nghe rõ lắm mà cần phải kề tai sát vào đồng hồ.</p>', '<h3><a href=\"https://www.thegioididong.com/dong-ho-thong-minh/xiaomi-watch-2-pro\">Xiaomi Watch 2 Pro</a>&nbsp;là thế hệ smartwatch thứ 2 sử dụng hệ điều hành Wear OS vừa được Xiaomi trình làng. Với thiết kế sang trọng, hiện đại cùng nhiều tính năng vượt trội, đây hứa hẹn sẽ là người bạn đồng hành lý tưởng cho người dùng trong mọi hoạt động.</h3><h3>Sự phối hợp hài hòa giữa cổ điển và hiện đại</h3><p>Xiaomi Watch 2 Pro có mặt hình tròn kết hợp cùng phần viền kiểu bằng&nbsp;<strong>thép không gỉ&nbsp;</strong>được đánh bóng tinh xảo. Phần viền bezel được vát phẳng mang đến cảm giác vừa hiện đại vừa cổ điển. Với<strong>&nbsp;kích thước 46 mm</strong>&nbsp;thì chiếc&nbsp;<a href=\"https://www.thegioididong.com/dong-ho-thong-minh\">đồng hồ thông minh</a>&nbsp;này sẽ phù hợp với những bạn nam có cổ tay to.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-1-1.jpg\" alt=\"Xiaomi Watch 2 Pro - Thiết kế\"></figure><p>Sản phẩm này được trang bị một núm vặn tựa như những chiếc đồng hồ cơ học giúp điều hướng nhanh chóng và trực quan hơn. Nút xoay mượt, có độ rung vừa phải giúp mình khá nhiều trong các tác vụ hằng ngày. Ở phía trên và dưới của nút xoay được trang bị thêm 2 nút bấm, theo cảm nhận của mình thì có độ nảy cao, êm ái khi bấm.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-3-1.jpg\" alt=\"Xiaomi Watch 2 Pro - Nút xoay\"></figure><p>Đồng hồ sử dụng&nbsp;<strong>dây silicone</strong>&nbsp;có bề mặt mềm mại, ôm sát cổ tay, mang lại cảm giác thoải mái và dễ chịu ngay cả khi đeo trong thời gian dài. Khi trải nghiệm sản phẩm thì mình rất hài lòng với cảm giác đeo mà dây silicone mang lại. Những lúc chơi thể thao đổ nhiều mồ hôi, chỗ đeo đồng hồ cũng không bị rít, không gây vướng víu giúp mình tập luyện thoải mái hơn.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-2-1.jpg\" alt=\"Xiaomi Watch 2 Pro - Dây silicone\"></figure><h3>Hình ảnh rõ nét, màn hình luôn sáng tiện lợi khi dùng</h3><p>Màn hình cảm ứng có kích thước&nbsp;<strong>1.43 inch</strong>&nbsp;khá là rộng rãi, khi mình thực hiện thao tác vuốt chạm trên màn hình cũng ít khi bị nhầm ứng dụng. Với độ phân giải&nbsp;<strong>466 x 466 pixels,</strong>&nbsp;chiếc&nbsp;<a href=\"https://www.thegioididong.com/dong-ho-thong-minh-xiaomi\">đồng hồ thông minh Xiaomi</a>&nbsp;này đã cung cấp cho mình khả năng hiển thị vô cùng chi tiết. Sử dụng công nghệ màn hình&nbsp;<strong>AMOLED&nbsp;</strong>với độ sáng lên đến&nbsp;<strong>600 nits</strong>, lúc mình tập luyện ở ngoài trời nắng gắt thì vẫn quan sát được đầy đủ các nội dung.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-4-1.jpg\" alt=\"Xiaomi Watch 2 Pro - Khả năng hiện thị\"></figure><h3>Hiệu năng mạnh mẽ, xử lý trơn tru nhiều tác vụ</h3><p>Xiaomi đã trang bị cho chiếc đồng hồ này con chip&nbsp;<strong>Snapdragon W5+ Gen 1</strong>&nbsp;được sản xuất trên tiến trình<strong>&nbsp;4</strong> <strong>nm</strong>, mang lại hiệu năng và hiệu suất cao hơn so với thế hệ trước. Trong quá trình sử dụng mình chưa gặp trường hợp đồng hồ bị lag hay phản hồi chậm lần nào.&nbsp;</p><p>Đồng hồ chạy trên hệ điều hành<strong>&nbsp;Wear OS&nbsp;</strong>với giao diện vô cùng quen thuộc, dễ sử dụng. Nhờ đó người dùng cũng có thể trải nghiệm kho ứng dụng và dịch vụ khổng lồ từ Google như: Trợ lý giọng nói Google Assistant, Ví điện tử Google, Google Maps,... Mình sử dụng Google Maps trên đồng hồ khá thường xuyên, bởi bản đồ vô cùng chi tiết và nhỏ gọn trên cổ tay dễ xem khi lái xe.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-5.jpg\" alt=\"Xiaomi Watch 2 Pro -  Google Wear OS\"></figure><p>Ngoài ra, mình cũng có thể lên CH Play để tải một số ứng dụng tương thích để sử dụng. Đồng hồ thông minh có bộ nhớ trong&nbsp;<strong>32 GB,</strong>&nbsp;cho phép bạn có thể tải khá nhiều ứng dụng và lưu trữ những mặt đồng hồ yêu thích mà không ảnh hưởng đến việc xử lý các tác vụ khác.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-6.jpg\" alt=\"Xiaomi Watch 2 Pro -  Tải thêm ứng dụng\"></figure><h3>Luôn sẵn sàng trợ giúp về sức khỏe</h3><p>Đồng hồ thông minh Xiaomi được trang bị nhiều tính năng sức khỏe như: Theo dõi nhịp tim 24/7, đo thành phần cơ thể, theo dõi giấc ngủ, chu kỳ kinh nguyệt, nồng độ oxy trong máu (SpO2), đo mức độ căng thẳng, nhiệt độ trên da,... giúp người dùng hiểu hơn về sức khỏe và cơ thể.</p><p>Mình đã tiến hành đo&nbsp;<a href=\"https://www.thegioididong.com/dong-ho-thong-minh?g=do-nong-do-oxy-trong-mau-spo2\">SpO2</a>&nbsp;và nhịp tim trên đồng hồ sau đó so sánh với kết quả trên máy đo y tế. Sau nhiều lần thử nghiệm thì kết quả giữa hai thiết bị chỉ chênh lệch từ 1 - 6 số. Nhìn chung, người dùng có thể tham khảo các chỉ số trên đồng hồ để chăm sóc sức khỏe tại nhà.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-7.jpg\" alt=\"Xiaomi Watch 2 Pro -  SpO2 và nhịp tim\"></figure><p>Sau một thời gian sử dụng tính năng&nbsp;<a href=\"https://www.thegioididong.com/dong-ho-thong-minh-theo-doi-giac-ngu\">theo dõi giấc ngủ</a>&nbsp;trên đồng hồ thì mình thấy thời gian ngủ kể cả khi mình ngủ trưa cũng được ghi lại khá chính xác. Ở giấc ngủ đêm thì đồng hồ sẽ hiển thị ở dạng biểu đồ phân tích giai đoạn ngủ như: Ngủ sâu, ngủ REM, ngủ nông và số lần tỉnh giấc.</p><p>Bên cạnh đó, đồng hồ còn được trang bị thêm một&nbsp;<strong>cảm biến phân tích trở kháng điện sinh học&nbsp;</strong>hỗ trợ người dùng đo các chỉ số thành phần cơ thể như những dòng smartwatch cao cấp khác. Tuy nhiên, theo mình các bạn chỉ nên tham khảo để điều chỉnh chế độ ăn uống và tập luyện cho phù hợp.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-8.jpg\" alt=\"Xiaomi Watch 2 Pro -  Đo thành phần cơ thể\"></figure><h3>Chế độ tập luyện đa dạng</h3><p>Xiaomi Watch 2 Pro được trang bị&nbsp;<strong>hơn 150 chế độ thể thao</strong>&nbsp;như đạp xe, nhảy dây, máy chèo thuyền, chạy bộ, cầu lông, đi bộ,... cho người dùng thỏa thích lựa chọn tùy vào mục đích tập luyện. Giao diện tập luyện của đồng hồ rất đơn giản, dễ thao tác và theo dõi các chỉ số cơ thể một cách trực quan.</p><p>Đồng hồ còn trang bị nhiều bài chạy khác nhau phục vụ cho các nhu cầu tập luyện của người dùng. Bên cạnh đó, đồng hồ còn có thể tải về ứng dụng Strava cho phép người dùng theo dõi các hoạt động thể thao một cách chi tiết, việc chia sẻ các hoạt động thể thao với bạn bè, người thân cũng rất đơn giản.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-9.jpg\" alt=\"Xiaomi Watch 2 Pro -  Chế độ tập luyện\"></figure><p>Chế độ đi bộ được mình sử dụng thường xuyên trên đồng hồ, theo trải nghiệm cá nhân mình thấy khả năng theo dõi thể chất hoạt động khá tốt. Cuối buổi tập, đồng hồ sẽ thống kê lượng calo tiêu thụ, số bước chân, nhịp tim trung bình, phạm vi nhịp tim, tốc độ trung bình, thời gian hồi phục,... Trong lúc đi bộ, mình có nhẩm đếm số bước chân thì con số mình đếm được là 1270 bước, còn trên đồng hồ là 1254 bước, sự chênh lệch không quá lớn nên có thể tham khảo để tập luyện hiệu quả hơn.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-10.jpg\" alt=\"Xiaomi Watch 2 Pro -  Theo dõi luyện tập\"></figure><h3>Khả năng định vị độc lập</h3><p>Được trang bị khả năng định vị băng tần kép L1 và L5, kết hợp hệ thống vệ tinh GPS, Galileo, GLONASS, Beidou, QZSS, Xiaomi Watch 2 Pro có thể ghi lại chính xác vị trí của người dùng ngay cả khi ở trong các môi trường khó định vị, giúp người dùng có thể tham gia các hoạt động thể thao ngoài trời một cách tiện lợi, ngay cả khi không có điện thoại bên cạnh.</p><p>Mình đã đeo chiếc đồng hồ này khi chạy bộ, nhìn chung tốc độ nhận tín hiệu khá nhanh chỉ khoảng 2 - 3 giây ở những khu vực trống trải và khoảng 5 - 7 giây ở những nơi đông đúc, nhiều vật cản. Ở cuối buổi chạy đồng hồ sẽ cung cấp một bản đồ nhỏ vẽ lại hành trình di chuyển, theo mình thấy thì độ chính xác khá cao.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-11.jpg\" alt=\"Xiaomi Watch 2 Pro - Khả năng định vị\"></figure><h3>Nhận cuộc gọi bằng đồng hồ vô cùng tiện lợi</h3><p>Hiện tại Xiaomi Watch 2 Pro có hai phiên bản là bản LTE và Bluetooth, ngay trên tay mình đây là bản Bluetooth nhưng vẫn hỗ trợ đàm thoại trên đồng hồ thông qua kết nối <strong>Bluetooth v5.2</strong> vô cùng ổn định. Để bắt đầu sử dụng đồng hồ thì mình cần phải tải ứng dụng Mi Fitness trên điện thoại thông minh và kết nối hai thiết bị với nhau.</p><p><strong>Tải ứng dụng&nbsp;Mi Fitness:&nbsp;</strong><a href=\"https://play.google.com/store/apps/details?id=com.xiaomi.wearable&amp;hl=vi&amp;gl=US\">CH Play</a>&nbsp;|&nbsp;<a href=\"https://apps.apple.com/vn/app/xiaomi-wear-lite/id1493500777\">App Store</a></p><p>Đồng hồ thông minh Xiaomi hỗ trợ nhận cuộc gọi thường từ sim, còn cuộc gọi từ ứng dụng (Zalo, Line, Messenger,...) thì sẽ có thông báo nhỡ. Đồng hồ sẽ đổ chuông khi có cuộc gọi đến và rung nhẹ để thu hút sự chú ý của người dùng.&nbsp;</p><p>Mình đã tiến hành đàm thoại trên đồng hồ thì thấy chất lượng âm thanh khá tốt, không bị rè hay mất tiếng. Đồng hồ còn cho phép mình điều chỉnh âm lượng khi đàm thoại, phù hợp với nhiều môi trường sử dụng. Tuy nhiên, khi mình nhận cuộc gọi trên đường thì dù chỉnh âm lượng lên mức to nhất vẫn không nghe rõ lắm mà cần phải kề tai sát vào đồng hồ.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-15.jpg\" alt=\"Xiaomi Watch 2 Pro - Đàm thoại bằng đồng hồ\"></figure><p>Phần tin nhắn trên đồng hồ cũng được hiển thị rõ ràng, phông chữ tiếng Việt dễ nhìn. Mình cũng có thể gõ tin nhắn trả lời ngay trên đồng hồ kèm theo emoji vô cùng thú vị. Ngoài ra, đồng hồ còn hỗ trợ chuyển giọng nói thành văn bản khi bạn trả lời tin nhắn khá là chính xác, tiện lợi hơn trong những lúc làm việc.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-12.jpg\" alt=\"Xiaomi Watch 2 Pro - Nhắn tin\"></figure><h3>Thời lượng pin vừa phải, đáp ứng nhu cầu sử dụng cơ bản</h3><p>Theo thông tin mà Xiaomi cung cấp thì thiết bị này có viên<strong>&nbsp;</strong>pin<strong> 495 mAh&nbsp;</strong>cho thời gian hoạt động&nbsp;<strong>khoảng 65 giờ</strong>. Ngày đầu tiên trải nghiệm thì mình đã bật Always On Display, theo dõi nhịp tim, SpO2 và mức độ căng thẳng liên tục thì chưa đến 1 ngày là đồng hồ đã hết pin. Ngày thứ 2 mình dùng thì tắt Always On Display, luyện tập với định vị khoảng 3 giờ và tắt các tính năng theo dõi sức khỏe thì tầm 1.5 ngày đồng hồ mới hết pin.</p><p>Tuy thời lượng pin không quá dài nhưng mình thấy vẫn đáp ứng đủ nhu cầu dùng trong 1 ngày của mình. Và với&nbsp;thời gian sạc đầy chỉ&nbsp;<strong>khoảng 45 phút&nbsp;</strong>thì trải nghiệm của mình cũng không bị gián đoạn quá lâu.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-13.jpg\" alt=\"Xiaomi Watch 2 Pro - Thời lượng pin\"></figure><p>Xiaomi Watch 2 Pro sở hữu chuẩn&nbsp;<strong>chống nước 5 ATM - ISO 22810:2010</strong>&nbsp;cho phép người dùng đeo khi tắm, bơi vùng nước nông,... mà không lo hư hại. Trong các hoạt động thường ngày mình thường xuyên tiếp xúc với nước nhưng chiếc đồng hồ này vẫn đang hoạt động khá tốt. Tuy nhiên, nhà sản xuất cũng cảnh báo người dùng không nên để đồng hồ trong phòng xông hơi, không tiếp xúc với nước nóng, không rửa bằng hóa chất, không đem đi lặn,... để đảm bảo độ bền cho thiết bị.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/7077/316986/xiaomi-watch-2-pro-14.jpg\" alt=\"Xiaomi Watch 2 Pro - Chống nước\"></figure><p>Bên cạnh các chức năng chính như nghe gọi, theo dõi sức khỏe, tập luyện thể thao hay định vị thì chiếc đồng hồ này còn được tích hợp nhiều tiện ích như: Báo thức, dự báo thời tiết, đồng hồ bấm giờ,... Xiaomi Watch 2 Pro là một lựa chọn tốt cho những người đang tìm kiếm một chiếc đồng hồ thông minh có thiết kế đẹp mắt, nhiều tính năng hữu ích và giá thành hợp lý.</p>', 3, 'dong-ho-thong-minh-xiaomi-watch-2-pro-46-mm-den-6572cfb1ba388', 1, 1, '2023-12-08 15:11:31', '2023-12-08 15:43:40'),
(102, 'Bao da bàn phím Samsung Tab S9 Ultra (Pad Chuột)', 4, 9190000, 0, 1, 0, 345, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023376/uploads_ecommerce_php_5_1/php6779_vivb5s.jpg', 0, 0, '<p>Kết hợp bàn phím và pad chuột mang đến cho bạn trải nghiệm sử dụng hệt như 1 chiếc laptop thực sự, tuy nhiên tổng thể sản phẩm nhỏ gọn hơn nhiều so với 1 chiếc laptop.</p>', '<h3><a href=\"https://www.thegioididong.com/phu-kien-thong-minh/bao-da-ban-phim-samsung-tab-s9-ultra-pad-chuot\">Bao da bàn phím Samsung Tab S9 Ultra (Pad Chuột)</a>&nbsp;kết hợp bàn phím và pad chuột, sử dụng kèm với Samsung Tab nhằm cho người dùng trải nghiệm hệt như dùng trên laptop, thích hợp với người di chuyển thường xuyên nhờ thiết kế gọn nhẹ.</h3><p>• <a href=\"https://www.thegioididong.com/phu-kien-thong-minh\">Bao da bàn phím</a> sở hữu gam màu sang trọng, thiết kế chắc chắn, mặt ngoài êm ái, cầm nắm êm tay.</p><p>• Sản phẩm trang bị từ tính với khả năng hít cực chắc chắn, đồng thời cho phép tháo rời nhanh chóng mà không để lại vết trầy.</p><p>• Kết hợp bàn phím và pad chuột mang đến cho bạn trải nghiệm sử dụng hệt như 1 chiếc laptop thực sự, tuy nhiên tổng thể sản phẩm nhỏ gọn hơn nhiều so với 1 chiếc laptop.</p><p>• Bạn có thể dễ dàng xoay mặt sau tới góc 150 độ, thoải mái điều chỉnh góc xem phù hợp.</p><p>• Sản phẩm hoàn toàn vừa khít với chiếc <a href=\"https://www.thegioididong.com/may-tinh-bang/samsung-galaxy-tab-s9-ultra\">Samsung Tab S9 Ultra</a>, giúp bảo vệ máy tính bảng khi gặp va chạm, cọ xát.</p><p>• <a href=\"https://www.thegioididong.com/phu-kien-thong-minh-samsung\">Bao da bàn phím Samsung</a> dễ dàng gập gọn, tiết kiệm không gian và mang theo bên người bất cứ đâu.&nbsp;</p><p>•&nbsp;Bật đèn nền để hỗ trợ làm việc tốt hơn vào buổi tối bằng cách nhấn tổ hợp phím Fn + F12.</p>', 9, 'bao-da-ban-phim-samsung-tab-s9-ultra-pad-chuot-6572d0d1e1b70', 1, 0, '2023-12-08 15:16:19', '2023-12-08 15:19:03'),
(103, 'Bút cảm ứng Apple Pencil MQLY3', 1, 2640000, 0, 1, 0, 367, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023530/uploads_ecommerce_php_5_1/phpC13D_uwhsye.jpg', 0, 0, '<p>Kiểu dáng tối giản, sử dụng gam màu trắng sang trọng đặc trưng của nhà Apple tạo cảm giác sang trọng.</p>', '<h3><a href=\"https://www.thegioididong.com/phu-kien-thong-minh/but-cam-ung-apple-pencil-mqly3\">Bút cảm ứng Apple Pencil MQLY3</a> sở hữu vẻ ngoài tối giản, di bút nhẹ nhàng trên bề mặt iPad, tối ưu trải nghiệm vẽ.</h3><p>•&nbsp;Kiểu dáng tối giản, sử dụng gam màu trắng sang trọng đặc trưng của nhà Apple tạo cảm giác sang trọng.</p><p>•&nbsp;Khối lượng gọn nhẹ, thiết kế vừa tay giúp di bút nhẹ nhàng, các nét vẽ mềm mại.</p><p>•&nbsp;Độ trễ cực thấp, <a href=\"https://www.thegioididong.com/phu-kien-thong-minh-apple\">Apple Pencil</a> phản hồi ngay khi đầu bút vừa chạm vào màn hình, giúp thể hiện một cách chính xác và kịp thời ứng với từng thao tác.</p><p>•&nbsp;Sạc pin nhanh chóng qua cổng Lightning chỉ trong khoảng 45 phút có ngay 4 tiếng sử dụng.</p><p>•&nbsp;Sản phẩm tương thích với&nbsp;<a href=\"https://www.thegioididong.com/may-tinh-bang-apple-ipad\">iPad </a>(Gen 6, 7, 8, 9), iPad Gen 10 (với Adapter).</p><p><strong>•&nbsp;Lưu ý: Thanh toán trước khi mở seal.</strong></p>', 9, 'but-cam-ung-apple-pencil-mqly3-6572d16be93d5', 1, 3, '2023-12-08 15:18:53', '2023-12-08 15:18:53'),
(104, 'Bàn phím Apple Magic Keyboard với phím số MQ052 ', 1, 3890000, 0, 1, 0, 245, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702023739/uploads_ecommerce_php_5_1/phpF16A_r0pjao.jpg', 0, 0, '<p>Bàn phím Apple tự động ghép nối với chiếc MacBook, iPad và iPhone của bạn thông qua Bluetooth từ lần sử dụng thứ 2. Lưu ý: Kết nối bàn phím với MacBook qua Bluetooth phải sử dụng hệ điều hành macOS 10.12.4 trở lên. Còn đối với iPhone và iPad là iOS 10.3 trở lên.</p>', '<h3>Thiết kế <a href=\"https://www.thegioididong.com/phu-kien-thong-minh/magic-keyboard-voi-phim-so\">bàn phím Apple Magic Keyboard với phím số MQ052</a> mỏng nhẹ, vẻ ngoài sang chảnh, phím bấm cực nhạy và còn nhiều điều thú vị nữa đang chờ đón bạn khi sở hữu chiếc bàn phím này.</h3><p>• Thiết kế sang trọng với tông màu sang trọng, đồng thời, sử dụng chất liệu cao cấp, bền bỉ cho thời gian sử dụng lâu dài.</p><p>•&nbsp;<a href=\"https://www.thegioididong.com/ban-phim\">Bàn phím</a> mỏng nhẹ, chỉ khoảng 390 g, cho phép bạn dễ dàng mang theo trong mọi chuyến hành trình của mình.</p><p>• Bàn phím Magic mang đến cho bạn trải nghiệm gõ chính xác và thoải mái, tốc độ phản hồi của phím nhanh giúp tối ưu trải nghiệm sử dụng,</p><p>• <a href=\"https://www.thegioididong.com/ban-phim-apple\">Bàn phím Apple</a>&nbsp;tự động ghép nối với chiếc <a href=\"https://www.thegioididong.com/laptop-apple-macbook\">MacBook</a>, <a href=\"https://www.thegioididong.com/may-tinh-bang-apple-ipad\">iPad</a>&nbsp;và <a href=\"https://www.thegioididong.com/dtdd-apple-iphone\">iPhone</a>&nbsp;của bạn thông qua Bluetooth từ lần sử dụng thứ 2. Lưu ý: Kết nối bàn phím với MacBook qua Bluetooth phải sử dụng hệ điều hành macOS 10.12.4 trở lên. Còn đối với iPhone và iPad là iOS 10.3 trở lên.</p><p>• Dung lượng pin lớn cho thời gian sử dụng lâu, sạc 1 lần có thể sử dụng khoảng 1 tháng.</p><p><strong>•&nbsp;Lưu ý: Thanh toán trước khi mở seal.</strong></p>', 9, 'ban-phim-apple-magic-keyboard-voi-phim-so-mq052-6572d23cd8308', 1, 1, '2023-12-08 15:22:22', '2023-12-08 15:22:41'),
(105, 'Máy tính bảng iPad 10 WiFi 64GB', 1, 11490000, 0, 1, 5, 356, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024032/uploads_ecommerce_php_5_1/php6842_iyn8n0.jpg', 5, 1, '<p>Ở phiên bản tablet năm nay ta có thể dễ dàng nhận thấy sự đổi mới mà Apple mang đến cho người dùng, iPad 10 không chỉ nâng cấp về phần thiết kế bên ngoài mà gần như mọi linh kiện bên trong cũng đã được cải tiến nhằm mang lại cho người dùng những trải nghiệm tuyệt vời.</p>', '<h3>Sau khi trình làng hàng loạt mẫu iPhone vào tháng 09/2022 thì Apple cũng đã tiếp tục giới thiệu series iPad mới cho năm 2022. Trong đó <a href=\"https://www.thegioididong.com/may-tinh-bang/ipad-gen-10\">iPad 10 WiFi 64GB</a> là cái tên được hãng chú trọng khá nhiều về việc tối ưu giá thành nhằm giúp người dùng có thể dễ dàng tiếp cận. Máy hỗ trợ hệ điều hành iPadOS 16 cùng con chip Apple A14 Bionic giúp mang lại hiệu năng vượt trội.</h3><h3>Thiết kế trẻ trung</h3><p>iPad 10 sẽ có một thiết kế khá quen thuộc khi được hoàn thiện với phần vật liệu chủ yếu là kim loại ở phần mặt lưng, các cạnh và hai mặt đều được vát phẳng để mang lại cái nhìn sang trọng. Đi kèm với đó là các góc được bo tròn giúp cho tổng thể máy tính bảng trở nên thanh thoát và hiện đại hơn thay vì vuông vức trông như một cuốn tập.</p><p>Với iPad thế hệ thứ 10 thì nhà Apple mang đến cho chúng ta 4 phiên bản với các màu sắc như: Bạc, hồng, vàng và xanh. Trong đó các tone màu của năm nay được làm đậm hơn đôi chút so với những thế hệ trước đó, đây có thể xem là đặc điểm nhận dạng giúp người dùng phân biệt iPad 10 các đàn anh của mình.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031416.jpg\" alt=\"Thiết kế trẻ trung - iPad 10 WiFi 64GB\"></figure><p>Mẫu <a href=\"https://www.thegioididong.com/may-tinh-bang-apple-ipad\">iPad</a> này chỉ có độ mỏng khoảng 7 mm nên khi cầm trên tay thì máy mang lại cho chúng ta một cái nhìn sang trọng và mang tính thời thượng, điều này là dễ hiểu bởi hiện tại xu hướng thiết kế mỏng nhẹ và thanh lịch đang là mục tiêu mà hầu hết các nhà sản xuất công nghệ đang hướng đến.</p><p>Điểm vượt trội hơn so với phiên bản <a href=\"https://www.thegioididong.com/may-tinh-bang/ipad-gen-9\">iPad 9 WiFi 64GB</a> vào năm ngoái là phần viền màn hình giờ đây đã được tối ưu và làm đều ở 4 cạnh, nó mang lại cho máy một cái nhìn cân đối và hài hòa hơn, cảm giác sử dụng cũng trở nên cực kỳ dễ chịu khi mà chúng ta nhìn vào màn hình.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031418.jpg\" alt=\"Viền màn hình mỏng - iPad 10 WiFi 64GB\"></figure><p>Phím Home trên <a href=\"https://www.thegioididong.com/may-tinh-bang-apple-ipad-10-2-inch\">iPad 9</a> giờ đây cũng đã không còn xuất hiện ở phiên bản mới nữa. Tuy nhiên với sự phát triển không ngừng về công nghệ thì việc loại bỏ cũng chỉ là chuyện sớm muộn, bây giờ có thể coi là thời điểm thích hợp để chúng ta làm quen với những thao tác sử dụng mới. Đa nhiệm hay thoát app đã có thể thao tác bằng cử chỉ ở màn hình, nó mang lại một cảm giác sử dụng hiện đại và cao cấp hơn trên một thiết bị hướng tới tương lai.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031420.jpg\" alt=\"Loại bỏ phím Home - iPad 10 WiFi 64GB\"></figure><h3>Làm việc hiệu quả với màn hình chất lượng</h3><p>iPad 10 sẽ có kích thước màn hình là 10.9 inch, đây có thể xem là con số khá phù hợp với hầu hết mọi người dùng, nó không quá to và cồng kềnh hay quá nhỏ để ta nheo mắt mỗi khi nhìn.&nbsp;</p><p>Màn hình 10.9 inch được xem là chuẩn màn hình lý tưởng cho khách hàng đang là học sinh, sinh viên, dân văn phòng hay những bạn đam mê vẽ vời bởi ta có thể dễ dàng mang theo đến bất cứ nơi đâu mà không sợ bị vướng hay cảm thấy chật chội.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031423.jpg\" alt=\"Màn hình kích thước lớn - iPad 10 WiFi 64GB\"></figure><p>Máy tính bảng lần này sẽ được sử dụng tấm nền Retina IPS LCD, loại công nghệ này được nghiên cứu và phát triển độc quyền bởi Apple cho nên máy sẽ mang lại cho chúng ta một cảm nhận về màu sắc, độ tương phản rất đã mắt mà ít có hãng nào có thể làm được điều tương tự.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-retina-la-gi-905780\">Màn hình Retina là gì? Thiết bị Apple nào sử dụng màn hình Retina?</a></p><p>iPad 10 có độ phân giải 1640 x 2360 Pixels và mật độ điểm ảnh khá cao, tuy hãng không công bố tablet thuộc vào chuẩn độ phân giải nào, nhưng ta có thể so sánh dựa theo con số rằng màn hình này có thể nằm trong khoảng chuẩn 2K. Vì thế mà nội dung được phản ánh chi tiết, tái tạo quang cảnh trong phim hay trò chơi được chân thực hơn bao giờ hết.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031424.jpg\" alt=\"Hiển thị hình ảnh chi tiết - iPad 10 WiFi 64GB\"></figure><h3>Sở hữu hiệu năng ổn định</h3><p>Theo như truyền thống của những mẫu <a href=\"https://www.thegioididong.com/dtdd-apple-iphone\">iPhone</a> và iPad từ trước đến nay, chiếc máy tính bảng lần này cũng sẽ được trang bị con chip được sản xuất bởi chính nhà Apple và đó là bộ vi xử lý A14 Bionic.</p><p>Xem thêm:&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-chip-xu-ly-apple-a14-bionic-hieu-nang-manh-den-1302095\">Tìm hiểu chip xử lý Apple A14 Bionic. Hiệu năng mạnh đến mức nào?</a></p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031426.jpg\" alt=\"Chipset mạnh mẽ - iPad 10 WiFi 64GB\"></figure><p>Apple A14 Bionic đã không còn quá xa lạ bởi mức độ nổi tiếng về hiệu năng cực kỳ mạnh mẽ trên nhiều dòng sản phẩm trước đây. Với hiệu suất tối đa vào khoảng 3.1 GHz nên bạn hoàn toàn có thể an tâm, không lo đến sự ổn định của máy hay thậm chí có thể dùng để chơi những tựa game nặng và thiết kế đồ họa.</p><p>iPad 10 là chiếc <a href=\"https://www.thegioididong.com/may-tinh-bang-ram-4gb\">máy tính bảng RAM 4 GB</a> nên đây có thể là điểm mà hãng đã tối ưu để có thể giảm mức giá thành sản phẩm đến tay người dùng. Nhưng thực sự mà nói thì con số chưa phải là tất cả để chứng minh rằng máy có xử lý đa nhiệm tốt hay không, điều này còn phụ thuộc một phần vào hệ điều hành mà nó được hỗ trợ.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031421.jpg\" alt=\"Đa nhiệm mượt mà  - iPad 10 WiFi 64GB\"></figure><p>Và trên iPad 10 sẽ được cài đặt sẵn hệ điều hành iPadOS 16 mới nhất (10/2022), giúp <a href=\"https://www.thegioididong.com/may-tinh-bang\">tablet</a> có thể cân bằng hiệu suất và tối ưu phần mềm để bạn có thể sử dụng mượt mà và ổn định. Ngoài ra, hệ điều hành này còn có một giao diện đẹp mắt, độ bảo mật an toàn hơn nhằm hạn chế tình trạng rò rỉ thông tin cá nhân trước những đối tượng nguy hiểm.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031431.jpg\" alt=\"Hỗ trợ hệ điều hành mới - iPad 10 WiFi 64GB\"></figure><h3>Tích hợp camera chất lượng</h3><p>Từ trước cho đến nay thì việc quay phim, chụp ảnh được xem là một điểm không thuộc vào thế mạnh của tablet, bởi nhu cầu sử dụng của người dùng thường thiên về các tác vụ văn phòng và học tập.&nbsp;</p><p>Thế nhưng trên iPad 10 thì lại khác, máy hoàn toàn có thể quay phim với chất lượng 4K và chụp được những bức ảnh góc rộng, kèm với đó là công nghệ Smart HDR 3 trên camera 12 MP giúp chụp đêm hay ngược sáng trở nên tuyệt vời hơn.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031428.jpg\" alt=\"Hỗ trợ quay video 4K - iPad 10 WiFi 64GB\"></figure><p>Mặt trước của tablet thì được trang bị camera selfie có độ phân giải 12 MP đi cùng tính năng HDR thông minh, vậy nên máy có thể chụp được những bức ảnh selfie ngược sáng tốt hơn, nâng cao chất lượng trên những cuộc gọi video hay hội họp online qua những phần mềm chuyên dụng như: Google Meet, Zoom,...</p><p>Ở những trường hợp quay video bằng camera trước thì máy hoàn toàn có thể thu phóng khung hình ở một mức độ giới hạn nhằm giúp chủ thể là người được nằm gần trung tâm nhất. Ta có thể thấy đây là tính năng rất hay và cực kỳ phù hợp đối với những bạn đang làm nội dung video cá nhân thiên về học thuật hay review trên nhiều nền tảng mạng xã hội.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031430.jpg\" alt=\"Nâng cao chất lượng video call - iPad 10 WiFi 64GB\"></figure><h3>Thời lượng sử dụng dài lâu</h3><p>iPad 10 được trang bị một viên pin có dung lượng 28.6 Wh hay còn có thể đổi thành con số xấp xỉ 7587 mAh, với một mức pin tương đối cao nên người dùng hoàn toàn có thể an tâm sử dụng thiết bị cho cả ngày dài mà không cần quá lo lắng đến những vấn đề như cạn pin giữa chừng chẳng hạn.</p><p>Ngoài ra hãng còn công bố thêm iPad 10 có thể duy trì việc sử dụng cho lướt web, xem video lên đến 10 tiếng đồng hồ ở chế độ Wifi.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/522/294103/ipad-gen-10-231022-031433.jpg\" alt=\"Sử dụng dài lâu - iPad 10 WiFi 64GB\"></figure><p>Ở phiên bản tablet năm nay ta có thể dễ dàng nhận thấy sự đổi mới mà Apple mang đến cho người dùng, <a href=\"https://www.thegioididong.com/may-tinh-bang-apple-ipad-10-9-inch\">iPad 10</a> không chỉ nâng cấp về phần thiết kế bên ngoài mà gần như mọi linh kiện bên trong cũng đã được cải tiến nhằm mang lại cho người dùng những trải nghiệm tuyệt vời.</p>', 33, 'may-tinh-bang-ipad-10-wifi-64gb-6572d36170ee3', 1, 7, '2023-12-08 15:27:15', '2023-12-26 19:06:31'),
(106, 'Máy chơi game cầm tay Asus ROG Ally RC71L Ryzen Z1 Extreme/16GB/512GB/120Hz/Win11 (NH001W) ', 2, 17990000, 0, 1, 0, 334, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024343/uploads_ecommerce_php_5_1/php2751_dswdcu.jpg', 0, 0, '<p>Asus ROG Ally khoác lên mình một tone màu trắng với thiết kế những đường vân vô cùng đẹp mắt, máy vẫn giữ cái kiểu dáng thiết kế hình chữ nhật giống như hầu hết các máy cầm tay khác đang có mặt trên thị trường. Tuy nhiên một điểm khác biệt là chỗ tay cầm được hoàn thiện to hơn tạo cảm giác cầm nắm khá chắc chắn, kết hợp với khối lượng \"khiêm tốn\" chỉ 0.608 kg tạo nên cảm giác liền mạch hơn khi cầm chơi và cũng rất dễ dàng để mang theo đến mọi nơi.</p>', '<h3>Nâng tầm mọi giác quan với <a href=\"https://www.thegioididong.com/may-choi-game-cam-tay/asus-rog-ally-rc71l-ryzen-z1-extreme-nh001w\">máy chơi game cầm tay Asus ROG Ally RC71L Ryzen Z1 Extreme&nbsp;(NH001W)</a>, được tích hợp gọn gàng vừa với bàn tay người dùng, hiệu năng đỉnh cao từ con chip thế hệ mới cùng thư viện game khủng. Mẫu sản phẩm này từ nhà Asus hứa hẹn cho gamer những trải nghiệm thật tuyệt vời.</h3><h3>Chiến đỉnh mọi tựa game</h3><p>Máy được trang bị vi xử lý <strong>AMD Ryzen&nbsp;Z1 Extreme</strong> – dòng APU <strong>8 nhân</strong>, <strong>16 luồng </strong>mới nhất của AMD dựa trên kiến trúc <strong>Zen 4 </strong>với nhân đồ hoạ <strong>AMD Radeon Graphics (AMD RDNA 3)</strong>, Asus ROG Ally hứa hẹn cung cấp một hiệu năng tuyệt vời nhất cho trải nghiệm người dùng. Bạn có thể trực tiếp cảm nhận chơi game cầm tay thật thú vị với những tựa game Esport, bom tấn đồ hoạ AAA yêu thích như FO4, Horizon, God of War,... nhanh chóng mượt mà ở bất cứ đâu.</p><p>Hơn nữa, kho game khủng trên các nền tảng cùng <strong>Game Pass</strong> miễn phí <strong>3 tháng</strong> cũng cho gamer thoải mái trải nghiệm \"nhiều hơn một\" những tựa game yêu thích.</p><p><a href=\"https://www.thegioididong.com/may-choi-game-cam-tay-asus\">Máy chơi game cầm tay Asus</a> không chỉ có thể ứng dụng chơi game, mà với hệ điều hành <strong>Windows 11 Home SL</strong>&nbsp;có sẵn bạn hoàn toàn sử dụng như một chiếc laptop mini để làm các công việc văn phòng cơ bản hoặc xem phim, nghe nhạc. Ngoài ra, bạn cũng có thể render những video cơ bản trên ứng dụng Capcut bằng chiếc máy này.</p><p>Bộ nhớ <strong>RAM&nbsp;16 GB LPDDR5&nbsp;</strong>sở hữu tốc độ Bus lên đến<strong>&nbsp;6400 MHz </strong>cho mọi thao tác đa nhiệm, tốc độ phản hồi game của bạn đều được diễn ra nhanh chóng và suôn sẻ, không bị giật lag hay đơ thiết bị. Ổ cứng <strong>SSD 512 GB NVMe PCIe 4.0 </strong>rút ngắn hơn hẳn thời gian đọc ghi dữ liệu, mang đến không gian lưu trữ tương đối lớn cho mọi trò chơi mà bạn tải về.</p><h3>Khung hình mượt mà, sắc nét</h3><p><a href=\"https://www.thegioididong.com/may-choi-game-cam-tay\">Máy chơi game cầm tay</a> có màn hình kích thước&nbsp;<strong>7 inch</strong>, tích hợp tấm nền <strong>IPS </strong>cho góc nhìn thoải mái hơn cùng độ phân giải&nbsp;<strong>Full HD (1920 x 1080)</strong> cho chất lượng hiển thị rõ nét trên mọi loại nội dung bạn xem. Màn hình với độ phủ màu đạt<strong>&nbsp;100% sRGB</strong> và <strong>75.35% Adobe RGB</strong> cũng tái hiện thật chân thực những khung cảnh game, chất màu sâu, tương phản tốt hơn để cho những trải nghiệm thêm thú vị.</p><p>Màn hình hỗ trợ tốc độ làm tươi cao&nbsp;<strong>120 Hz </strong>cùng công nghệ&nbsp;<strong>FreeSync Premium</strong>&nbsp;cho bạn những khung cảnh game được diễn ra mượt mà ở mức tối ưu nhất. Ngoài ra, độ sáng&nbsp;<strong>500 nits&nbsp;</strong>giúp bạn thoải mái chơi ở các môi trường nhiều ánh sáng. Thêm vào đó, tính năng <strong>cảm ứng</strong> đa điểm cũng cho thao tác tuỳ chọn thuận lợi hơn so với những nút bấm.</p><p>Hệ thống <strong>2 loa</strong> cũng được hãng bố trí ở mặt trước với những công nghệ khử ồn cao cấp, công nghệ<strong> Smart Amplifier</strong>, <strong>Dolby Atmos</strong> cho chất lượng âm thanh trải nghiệm trở nên tốt nhất.</p><h3>Thiết kế công thái học cùng diện mạo cực chất</h3><p>Asus ROG Ally khoác lên mình một tone<strong> màu trắng</strong> với thiết kế những đường vân vô cùng đẹp mắt, máy vẫn giữ cái kiểu dáng thiết kế hình chữ nhật giống như hầu hết các máy cầm tay khác đang có mặt trên thị trường. Tuy nhiên một điểm khác biệt là chỗ tay cầm được hoàn thiện to hơn tạo cảm giác cầm nắm khá chắc chắn, kết hợp với khối lượng \"khiêm tốn\" chỉ&nbsp;<strong>0.608 kg</strong> tạo nên cảm giác liền mạch hơn khi cầm chơi và cũng rất dễ dàng để mang theo đến mọi nơi.</p><p>Các nút bấm trực quan của thiết bị hỗ trợ \"cặn kẽ\" mọi thao tác di chuyển, tung chiêu của bạn ở những tựa game.</p><p>Máy chơi game cầm tay Asus cũng có những cổng giao tiếp hỗ trợ tuyền xuất dữ liệu nhanh như: USB Type-C 3.2 combo, cổng ROG XG Mobile, Jack tai nghe 3.5 mm và khe&nbsp;MicroSD.</p>', 1, 'may-choi-game-cam-tay-asus-rog-ally-rc71l-ryzen-z1-extreme16gb512gb120hzwin11-nh001w-6572d498807a3', 1, 0, '2023-12-08 15:32:26', '2023-12-08 15:32:49'),
(107, 'Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U/16GB/512GB/Win11 (82XS002KVN)', 21, 17990000, 0, 1, 0, 228, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024756/uploads_ecommerce_php_5_1/php7637_ynotpu.jpg', 0, 0, '<p>Tổng thể, Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) là một chiếc laptop tầm trung với nhiều trang bị tốt như màn hình Full HD, bộ vi xử lý mạnh mẽ, RAM và ổ cứng nhanh. Máy phù hợp cho đối tượng người dùng văn phòng, học sinh và sinh viên, cần một chiếc laptop để xử lý công việc, xem phim, lướt web và chơi game nhẹ.</p>', '<h3><a href=\"https://www.thegioididong.com/laptop/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn\">Laptop&nbsp;Lenovo IdeaPad Slim 5 Light 14ABR8 R5 (82XS002KVN)</a> -&nbsp;mẫu <a href=\"https://www.thegioididong.com/laptop?g=hoc-tap-van-phong\">laptop học tập - văn phòng</a> mới nhất của Lenovo với thiết kế mỏng nhẹ và tính năng hữu ích, đáp ứng tốt nhu cầu sử dụng thông thường như làm việc văn phòng, học tập, giải trí, xem phim, lướt web, chơi game nhẹ và xử lý đồ họa cơ bản.</h3><h3>Cân hoàn hảo mọi tác vụ học tập, văn phòng</h3><p><a href=\"https://www.thegioididong.com/laptop-lenovo-ideapad\">Laptop Lenovo IdeaPad</a> được trang bị bộ vi xử lý <strong>AMD Ryzen 5 7530U</strong> với cấu trúc <strong>6&nbsp;nhân</strong> và <strong>12 luồng</strong>, hoạt động ở tốc độ xung nhịp cơ bản <strong>2.00 GHz</strong> và tốc độ xung nhịp tối đa lên đến <strong>4.5 GHz</strong>. Với <strong>7248 điểm đa nhân</strong> và <strong>1403 điểm đơn nhân</strong> mình đo được bằng công cụ Cinebench R23,&nbsp;CPU đủ mạnh để xử lý các tác vụ hàng ngày như lướt web, soạn thảo văn bản và giải trí cơ bản, thậm chí bạn còn có thể chơi một số tựa game nhẹ hoặc thực hiện những công việc như chỉnh sửa video hoặc thiết kế đồ họa ở mức độ trung bình.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/44/305673/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn-250423-032554.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) - Lướt web\"></figure><p>Card đồ họa tích hợp <strong>AMD Radeon Graphics</strong>&nbsp;vẫn có thể đáp ứng nhu cầu sử dụng đồ họa cơ bản, chẳng hạn như xem video, xem phim hoặc chỉnh sửa hình ảnh đơn giản trên các ứng dụng như Photoshop, Canva,...</p><p>Với <strong>RAM 16 GB DDR4</strong>, IdeaPad Slim 5 Light đảm bảo khả năng vận hành mượt mà đa ứng dụng và tác vụ cùng lúc, bạn có thể mở hàng loạt tab Chrome, chạy thêm Spotify để nghe nhạc, mở Photoshop để chỉnh sửa hình ảnh mà không lo bị giật lag. Tuy nhiên, thiết bị không hỗ trợ nâng cấp bởi RAM được tích hợp sẵn vào bo mạch chủ và không thể tháo rời được. Đây cũng là điều dễ hiểu bởi&nbsp;máy có thiết kế mỏng nhẹ, hơn nữa mức RAM 16 GB cũng hoàn toàn có thể đáp ứng cho nhu cầu sử dụng của đối tượng người dùng là học sinh, sinh viên và nhân viên văn phòng kể cả về lâu về dài.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/44/305673/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn-250423-032556.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) - Làm việc văn phòng\"></figure><p>Lenovo IdeaPad Slim 5 Light được trang bị ổ cứng <strong>SSD&nbsp;NVMe PCIe Gen 4.0</strong> với&nbsp;tốc độ đọc, ghi dữ liệu nhanh hơn đáng kể so với thế hệ tiền nhiệm, từ đó&nbsp;giúp cho việc khởi động hệ thống và các ứng dụng diễn ra nhanh hơn, đồng thời cải thiện hiệu suất khi sử dụng máy. Dung lượng <strong>512 GB</strong> đáp ứng tốt nhu cầu lưu trữ với các tác vụ học tập, văn phòng vốn chỉ lưu những file tài liệu đơn giản, không tốn quá nhiều không gian. Tuy nhiên nếu bạn thường làm việc với các file đồ họa hay chỉnh sửa video thì vẫn nên cân nhắc sắm thêm một thiết bị lưu trữ bên ngoài.</p><p>Theo thông tin chính thức mà mình tìm hiểu được từ Lenovo, IdeaPad Slim 5 Light được trang bị hệ thống tản nhiệt nâng cao với <strong>2 quạt làm mát</strong> và <strong>2 ống dẫn nhiệt</strong> bố trí ở phía trên và dưới bo mạch chủ để giúp máy tản nhiệt tốt hơn. Trong quá trình trải nghiệm, cá nhân mình đánh giá&nbsp;hệ thống tản nhiệt của thiết bị hoạt động tốt khi sử dụng thông thường, máy không bị quá nóng và quạt cũng không gây ra tiếng ồn. Tất nhiên đối với một chiếc máy mỏng nhẹ, khi chạy các tác vụ đòi hỏi nhiều tài nguyên như làm việc với đồ họa hay chơi game thì máy tỏa nhiệt khá cao và quạt cũng kêu ồn hơn.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/44/305673/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn-250423-032541.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) - Tản nhiệt\"></figure><h3>Không gian hiển thị sắc nét giúp nâng cao trải nghiệm giải trí</h3><p>Lenovo IdeaPad Slim 5 Light được trang bị màn hình <strong>14 inch</strong>, độ phân giải <strong>Full HD (1920 x 1080)</strong> với tấm nền <strong>IPS</strong> giúp đem lại góc nhìn rộng và màu sắc trung thực. Ngoài ra, màn hình còn hỗ trợ công nghệ chống chói&nbsp;<strong>Anti Glare</strong> và có độ sáng cao lên đến <strong>300 nits</strong>,&nbsp;giảm thiểu ánh sáng phản chiếu từ môi trường xung quanh khi mình sử dụng máy ở những nơi có cường độ ánh sáng cao như quán cà phê hay văn phòng gần cửa sổ.</p><p>Với thông số màu đạt chuẩn <strong>100% sRGB</strong>, màn hình của IdeaPad Slim 5 Light có khả năng hiển thị màu sắc chính xác hơn, đặc biệt là các gam màu đậm như đỏ, xanh lá cây và xanh dương, thích hợp cho các tác vụ liên quan đến đồ họa, thiết kế và xử lý hình ảnh bán chuyên nghiệp trên các phần mềm nhà Adobe.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/44/305673/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn-250423-032557.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) - Làm đồ họa\"></figure><p><a href=\"https://www.thegioididong.com/laptop-lenovo\">Laptop Lenovo</a> được trang bị&nbsp;công nghệ <strong>Dolby Audio</strong>&nbsp;giúp cải thiện chất lượng âm thanh và tăng cường trải nghiệm nghe nhạc cũng như xem phim. Ứng dụng Dolby Audio cài sẵn trên máy cung cấp các tính năng tùy chỉnh âm thanh để bạn điều chỉnh âm lượng và âm trầm sao cho phù hợp với sở thích, nhu cầu sử dụng của riêng mình.</p><p>IdeaPad Slim 5 Light sở hữu pin Lithium-ion có dung lượng <strong>47 Wh</strong>, tương đương với thời lượng sử dụng trung bình khoảng <strong>7 - 9 giờ</strong> khi mình chạy các tác vụ thông thường như lướt web, xem phim và làm việc văn phòng. Thời lượng pin phụ thuộc vào nhiều yếu tố như độ sáng màn hình, tần suất sử dụng các thiết bị ngoại vi và ứng dụng đang chạy trên máy, do đó có thể khác nhau đối với mỗi người dùng.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/44/305673/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn-250423-032548.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) - Thường gian sử dụng\"></figure><h3>Ngoại hình sang trọng, bền bỉ</h3><p>Khung vỏ máy được làm bằng <strong>hợp kim nhôm</strong> cao cấp, tạo nên vẻ ngoài sang trọng và đẳng cấp. Bề mặt nhôm phủ một lớp sơn mờ mang đến cảm giác chắc chắn khi chạm và sờ vào, đồng thời cũng tăng độ bền bỉ trong quá trình sử dụng. <strong>Nắp lưng của máy bằng nhựa</strong> được thiết kế dạng nhám giúp tránh trầy xước và tăng độ bám khi cầm nắm.&nbsp;</p><p>Đúng như tên gọi, Lenovo IdeaPad Slim 5 Light có khối lượng nhẹ chỉ <strong>1.17 kg</strong>, đây cũng là một trong những mẫu laptop nhẹ nhất trong phân khúc. Thiết kế tổng thể của máy cũng khá mỏng với độ dày chỉ khoảng <strong>17.1 mm</strong>, tạo cảm giác gọn gàng và tiện lợi để mang theo bên mình.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/44/305673/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn-250423-032543.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) - Thiết kế\"></figure><p>Bên cạnh đó, thiết bị cũng đã được chứng nhận đạt <strong>chuẩn độ bền quân đội MIL STD 810H</strong>. Đây là một tiêu chuẩn quân sự chung được áp dụng cho nhiều thiết bị để đảm bảo tính bền bỉ khi sử dụng trong các điều kiện khắc nghiệt, có khả năng chống lại va đập, rung động, nhiệt độ, độ ẩm và bụi bẩn. Đối với các bạn sinh viên hay nhân viên văn phòng thường xuyên mang theo laptop khi di chuyển sẽ an tâm hơn rất nhiều khi vô tình xảy ra các va chạm không mong muốn.</p><p>Bàn phím của IdeaPad Slim 5 Light được thiết kế với các phím có hành trình tốt, cảm giác bấm êm ái và độ nảy phím cao, cho phép mình gõ văn bản liên tục mà không bị mỏi tay. Bàn phím cũng được trang bị <strong>đèn nền</strong> giúp mình dễ dàng sử dụng trong điều kiện ánh sáng yếu. Còn TouchPad được thiết kế với kích thước vừa phải, hỗ trợ tính năng đa điểm để thực hiện các thao tác như phóng to, thu nhỏ, kéo thả,.... Cảm giác khi sử dụng TouchPad khá nhạy và chính xác, cho mình trải nghiệm&nbsp;sử dụng tốt.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/44/305673/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn-250423-032552.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) - Bàn phím và TouchPad\"></figure><p>Lenovo IdeaPad Slim 5 Light cũng đảm bảo tối đa độ bảo mật khi được trang bị <strong>cảm biến vân tay</strong> giúp mình đăng nhập dễ dàng và an toàn mà không cần phải nhập mật khẩu thủ công. Bên cạnh đó, thiết bị cũng có <strong>công tắc khóa camera</strong> vật lý, được sử dụng để chặn camera khi không sử dụng, đảm bảo sự riêng tư tuyệt đối. Bạn có thể truy cập vào ứng dụng&nbsp;<strong>Lenovo Vantage</strong> để quản lý và bảo mật dữ liệu cá nhân với các công cụ như tắt camera, khóa ứng dụng bằng mật khẩu, bảo vệ tập tin riêng tư.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/44/305673/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn-250423-032559.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) - Công tắc khóa camera\"></figure><p>Với các cổng giao tiếp như HDMI, USB Type-C (hỗ trợ truyền dữ liệu, Power Delivery 3.0 và DisplayPort 1.2), Jack tai nghe 3.5 mm và USB 3.2, IdeaPad Slim 5 Light có khả năng kết nối với nhiều thiết bị khác nhau như màn hình, TV, thiết bị lưu trữ ngoài, tai nghe, loa,... Đồng thời cũng hỗ trợ các tính năng như sạc nhanh, truyền dữ liệu nhanh giữa các thiết bị.</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/44/305673/lenovo-ideapad-slim-5-light-14abr8-r5-82xs002kvn-250423-032546.jpg\" alt=\"Laptop Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) - Cổng kết nối\"></figure><p>Tổng thể, Lenovo IdeaPad Slim 5 Light 14ABR8 R5 7530U (82XS002KVN) là một chiếc laptop tầm trung với nhiều trang bị tốt như màn hình Full HD, bộ vi xử lý mạnh mẽ, RAM và ổ cứng nhanh. Máy phù hợp cho đối tượng người dùng văn phòng, học sinh và sinh viên, cần một chiếc laptop để xử lý công việc, xem phim, lướt web và chơi game nhẹ.&nbsp;</p>', 10, 'laptop-lenovo-ideapad-slim-5-light-14abr8-r5-7530u16gb512gbwin11-82xs002kvn-6572d635ea079', 1, 0, '2023-12-08 15:39:19', '2023-12-08 15:40:44'),
(108, 'Laptop Asus Vivobook X415EA i3 1115G4/8GB/256GB/Win11 (EK2034W)', 2, 10990000, 0, 1, 1, 367, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702024993/uploads_ecommerce_php_5_1/php1456_ktajdh.jpg', 5, 1, '<p>Với thiết kế mỏng nhẹ, khối lượng chỉ 1.55 kg, bạn có thể dễ dàng mang theo Asus Vivobook X415EA khi di chuyển. Vỏ máy được làm bằng nhựa cao cấp, bề mặt phủ màu bạc sang trọng, tạo nên một thiết kế đơn giản nhưng hiện đại.</p>', '<h3>Nếu bạn đang tìm kiếm một chiếc <a href=\"https://www.thegioididong.com/laptop?g=hoc-tap-van-phong\">laptop học tập - văn phòng</a> sở hữu cấu hình tốt và có thiết kế đơn giản nhưng sang trọng, <a href=\"https://www.thegioididong.com/laptop/asus-vivobook-x415ea-i3-ek2034w\">laptop Asus Vivobook X415EA i3 (EK2034W)</a> chính là sự lựa chọn hoàn hảo dành cho bạn.</h3><p>•&nbsp;<a href=\"https://www.thegioididong.com/laptop-asus-vivobook\">Laptop Asus Vivobook</a> với bộ vi xử lý <strong>Intel Core i3 1115G4</strong> thế hệ thứ 11 và tốc độ xung nhịp lên đến&nbsp;<strong>4.1 GHz</strong>&nbsp;đảm bảo sức mạnh và hiệu suất cao,&nbsp;đủ tốt để xử lý các tác vụ học tập, làm việc văn phòng trên Word, Excel, PowerPoint,...&nbsp;</p><p>•&nbsp;<a href=\"https://www.thegioididong.com/laptop-asus\">Laptop Asus</a> cũng được trang bị card đồ họa <strong>Intel UHD Graphics</strong> có khả năng xử lý đồ họa và chơi game đơn giản, giúp đáp ứng nhu cầu giải trí và làm việc đồ họa 2D cơ bản của người dùng.</p><p>•&nbsp;Bộ nhớ <strong>RAM 8 GB DDR4</strong> cho phép bạn làm việc đa nhiệm mượt mà, mở cùng lúc nhiều ứng dụng văn phòng mà không lo giật lag, cùng với ổ cứng&nbsp;<strong>SSD 256 GB</strong> giúp nâng cao tốc độ khởi động và load các ứng dụng nhanh chóng.</p><p>•&nbsp;Màn hình kích thước <strong>14 inch</strong> với độ phân giải <strong>Full HD (1920 x 1080)</strong> cung cấp hình ảnh sắc nét, đáp ứng nhu cầu xem video, làm việc thường ngày. Công nghệ chống chói <strong>Anti Glare</strong> giảm thiểu ánh sáng phản chiếu và lóa mắt khi sử dụng trong môi trường ánh sáng mạnh.</p><p>• Công nghệ <strong>SonicMaster audio</strong> được tối ưu hóa để tăng cường độ rõ nét, độ sâu và âm lượng của âm thanh, từ đó mang đến trải nghiệm giải trí thêm phần tuyệt vời hơn.</p><p>•&nbsp;Với thiết kế mỏng nhẹ, khối lượng chỉ <strong>1.55 kg</strong>, bạn có thể dễ dàng mang theo Asus Vivobook X415EA khi di chuyển. Vỏ máy được làm bằng <strong>nhựa</strong> cao cấp, bề mặt phủ <strong>màu bạc</strong> sang trọng, tạo nên một thiết kế đơn giản nhưng hiện đại.</p><p>•&nbsp;<a href=\"https://www.thegioididong.com/laptop\">Laptop</a> cũng được trang bị đầy đủ các cổng giao tiếp như: USB Type-A, USB Type-C, HDMI và Jack tai nghe 3.5 mm, giúp bạn kết nối với các thiết bị khác một cách dễ dàng.</p>', 10, 'laptop-asus-vivobook-x415ea-i3-1115g48gb256gbwin11-ek2034w-6572d722f3b03', 1, 3, '2023-12-08 15:43:16', '2023-12-22 20:53:04');
INSERT INTO `product` (`id`, `title`, `brand_id`, `price`, `discount`, `isVariant`, `sold`, `quantity`, `thumb`, `totalRatings`, `totalUserRatings`, `short_description`, `description`, `cate_id`, `slug`, `status`, `view`, `create_at`, `update_at`) VALUES
(109, 'Google Tivi Xiaomi A 32 inch L32M8-P2SEA', 30, 4490000, 0, 1, 0, 223, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702025344/uploads_ecommerce_php_5_1/php6F38_uyslf6.jpg', 0, 0, '<p><i>Tóm lại, dòng Google Tivi Xiaomi A 32 inch L32M8-P2SEA được trang bị bộ xử lý tiên tiến, tích hợp công nghệ hình ảnh, âm thanh đáp ứng khá đầy đủ nhu cầu xem phim, nghe nhạc, hệ điều hành thân thiện, tính năng tìm kiếm bằng giọng nói tiếng Việt hứa hẹn sẽ mang đến cho bạn những giờ phút thư giãn tuyệt vời sau ngày dài làm việc mệt mỏi.</i></p>', '<p><a href=\"https://www.dienmayxanh.com/tivi/google-tivi-xiaomi-32-inch-l32m8-p2sea\"><i><strong>Google Tivi Xiaomi A 32 inch L32M8-P2SEA</strong></i></a><i><strong>&nbsp;mang thiết kế hiện đại, màn hình HD kích thước 32 inch phù hợp để sử dụng trong các căn phòng có không gian nhỏ, tích hợp&nbsp;dải màu rộng Wide Color Gamut cho màu sắc sống động,&nbsp;công nghệ HDR10, HLG tái tạo hình ảnh rõ ràng,&nbsp;công nghệ Dolby Audio cho bạn được thưởng thức âm thanh vòm cuốn hút, tìm kiếm giọng nói bằng&nbsp;tiếng Việt với&nbsp;Google Assistant.</strong></i></p><h3>Tổng quan thiết kế</h3><p>-&nbsp;Xiaomi A L32M8-P2SEA có&nbsp;kiểu dáng tối giản, thiết kế viền kim loại&nbsp;siêu mỏng, kích cỡ nhỏ gọn kết hợp màn hình&nbsp;<a href=\"https://www.dienmayxanh.com/tivi-32-inch\">tivi 32 inch</a>&nbsp;phù hợp để nâng tầm phong cách nội thất của không gian phòng khách, phòng ngủ, phòng làm việc diện tích nhỏ của bạn.&nbsp;</p><p>- Chân đế có mặt trước&nbsp;bằng kim loại, thiết kế <strong>hình chữ V úp ngược</strong> giúp đặt&nbsp;<a href=\"https://www.dienmayxanh.com/tivi\">tivi</a>&nbsp;vững vàng trên bề mặt bàn, kệ tủ. Bạn có thể tách rời chân đế và bày trí tivi theo kiểu treo tường cho không gian phòng trông thoáng rộng hơn.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/1942/312858/google-tivi-xiaomi-32-inch-l32m8-p2sea-100823-021849.jpg\" alt=\"Google Tivi Xiaomi A 32 inch L32M8-P2SEA - Tổng quan thiết kế\"></figure><p><i>*Hình ảnh chỉ mang tính chất minh hoạ sản phẩm</i></p><h3>Công nghệ hình ảnh&nbsp;</h3><p>- Độ phân giải&nbsp;<a href=\"https://www.dienmayxanh.com/tivi?g=hd\">HD</a>&nbsp;với 1366 x 768 điểm ảnh tái hiện hình ảnh rõ ràng, sinh động.&nbsp;</p><p>-&nbsp;<strong>Bộ xử lý Mali-G31 MP2</strong> hiệu suất cao cho&nbsp;<a href=\"https://www.dienmayxanh.com/tivi-xiaomi-google-tivi\">Google Tivi Xiaomi</a>&nbsp;xử lý mượt mà các tác vụ, giúp tạo nên những khung hình chất lượng tốt, mang đến trải nghiệm xem chân thực.&nbsp;</p><p>-&nbsp;Dải màu rộng<strong> Wide Color Gamut </strong>tạo nên hình ảnh với nhiều màu sắc hơn bằng cách bổ sung màu trắng vào 3 màu RGB gồm đỏ, xanh lá và xanh dương cho bạn được chiêm ngưỡng cảnh quay với màu sắc sống động, tự nhiên.&nbsp;</p><p>-&nbsp;Công nghệ&nbsp;<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/nhung-dieu-can-biet-ve-tivi-hdr-805354\">HDR10</a>,&nbsp;<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/cac-cong-nghe-hinh-anh-dac-biet-tren-tivi-sony-1127776#hlg\">HLG</a>&nbsp;giúp nâng cao độ tương phản để khung hình được tái hiện rõ nét, chi tiết hơn.&nbsp;</p><p>Mời bạn xem thêm:<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/diem-mat-nhung-do-phan-giai-pho-bien-hien-nay-tren-577178\">&nbsp;Những độ phân giải màn hình phổ biến hiện nay trên tivi</a></p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/1942/312858/google-tivi-xiaomi-32-inch-l32m8-p2sea-100823-021851.jpg\" alt=\"Google Tivi Xiaomi A 32 inch L32M8-P2SEA - Công nghệ hình ảnh \"></figure><p><i>*Hình ảnh chỉ mang tính chất minh hoạ sản phẩm</i></p><h3>Công nghệ âm thanh</h3><p>- Chiếc&nbsp;<a href=\"https://www.dienmayxanh.com/tivi-xiaomi\">tivi Xiaomi</a>&nbsp;này có 2 loa, tổng công suất&nbsp;<strong>10W</strong>.</p><p>- Công nghệ&nbsp;<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/cong-nghe-dolby-audio-la-gi-865079\">Dolby Audio</a>&nbsp;tạo hiệu ứng âm thanh vòm đa hướng, loại bỏ các tạp âm để bạn được tận hưởng chất âm trong trẻo, sống động.&nbsp;</p><p>-&nbsp;Công nghệ<strong>&nbsp;DTS-X,&nbsp;DTS Virtual:X</strong> đem đến trải nghiệm âm thanh đa chiều chân thực mà bạn không cần sử dụng thêm thiết bị âm thanh bổ sung khác.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/1942/312858/google-tivi-xiaomi-32-inch-l32m8-p2sea-100823-021854.jpg\" alt=\"Google Tivi Xiaomi A 32 inch L32M8-P2SEA - Công nghệ âm thanh\"></figure><p><i>*Hình ảnh chỉ mang tính chất minh hoạ sản phẩm</i></p><h3>Hệ điều hành</h3><p>- Thiết lập hệ điều hành&nbsp;<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/android-tv-nang-cap-thanh-thanh-google-tv-trong-na-1350893\">Google TV</a>&nbsp;với giao diện màn hình hiện đại, cho người dùng quan sát, lựa chọn và truy cập vào các nội dung giải trí linh hoạt.&nbsp;</p><p>- Kho ứng dụng phong phú có nhiều ứng dụng quen thuộc như Netflix, Prime Video, YouTube,...&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/1942/312858/google-tivi-xiaomi-32-inch-l32m8-p2sea-100823-021855.jpg\" alt=\"Google Tivi Xiaomi A 32 inch L32M8-P2SEA - Hệ điều hành\"></figure><p><i>*Hình ảnh chỉ mang tính chất minh hoạ sản phẩm</i></p><h3>Tiện ích&nbsp;</h3><p>- Khi trải nghiệm ứng dụng YouTube, bạn có thể sử dụng giọng nói bằng tiếng Việt của mình để tìm kiếm video nhanh chóng hơn. Bên cạnh, thiết bị cũng hỗ trợ <strong>Google Assistant có tiếng Việt</strong> cho quá trình điều khiển thêm thuận lợi.&nbsp;</p><p>-&nbsp;Có&nbsp;<a href=\"https://www.dienmayxanh.com/kinh-nghiem-hay/remote-thong-minh-tim-kiem-giong-noi-tieng-viet-la-1190444\">remote tích hợp sẵn micro</a>&nbsp;cho bạn tìm kiếm bằng khẩu lệnh hoặc tùy chỉnh tivi qua các phím chức năng theo kiểu truyền thống dễ dàng.&nbsp;</p><figure class=\"image\"><img src=\"https://cdn.tgdd.vn/Products/Images/1942/312858/google-tivi-xiaomi-32-inch-l32m8-p2sea-100823-042305.jpg\" alt=\"Google Tivi Xiaomi A 32 inch L32M8-P2SEA - Tiện ích \"></figure><p><i>*Hình ảnh chỉ mang tính chất minh hoạ sản phẩm</i></p><p><i>Tóm lại, dòng Google Tivi Xiaomi A 32 inch L32M8-P2SEA được trang bị bộ xử lý tiên tiến, tích hợp công nghệ hình ảnh, âm thanh đáp ứng khá đầy đủ nhu cầu xem phim, nghe nhạc, hệ điều hành thân thiện, tính năng tìm kiếm bằng giọng nói tiếng Việt hứa hẹn sẽ mang đến cho bạn những giờ phút thư giãn tuyệt vời sau ngày dài làm việc mệt mỏi.</i></p>', 32, 'google-tivi-xiaomi-a-32-inch-l32m8-p2sea-6572d881ed85d', 1, 0, '2023-12-08 15:49:07', '2023-12-08 15:49:07'),
(110, 'Máy ảnh kỹ thuật số Sony ZV-E10', 3, 16990000, 0, 1, 1, 222, 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1702028239/uploads_ecommerce_php_5_1/php9C69_wgebi5.webp', 1, 1, '<p>Bạn có thể tìm mua máy ảnh kỹ thuật số Sony ZV-E10 với giá cả phù hợp và đội ngũ nhân viên tư vấn nhiệt tình, chuyên nghiệp. Hơn nữa, còn có nhiều chương trình khuyến mãi hấp dẫn và dịch vụ bảo hành tốt, giúp bạn hoàn toàn yên tâm khi mua sắm tại đây.</p>', '<h2><strong>Máy ảnh kỹ thuật số Sony ZV-E10 - Thỏa sức sáng tạo</strong></h2><p><strong>Máy ảnh kỹ thuật số Sony ZV-E10 </strong>là một sản phẩm đến từ nhà Sony được thiết kế đặc biệt dành cho những người yêu thích nhiếp ảnh và quay phim. Với thiết kế nhỏ gọn và tính năng chuyên nghiệp, chiếc <a href=\"https://cellphones.com.vn/may-anh/sony.html\"><strong>máy ảnh Sony</strong></a> này hứa hẹn sẽ mang đến những trải nghiệm tuyệt vời cho người dùng.&nbsp;</p><h3><strong>Cảm biến APS-C Exmor CMOS cho kết quả tuyệt vời</strong></h3><p>Với cảm biến APS-C Exmor CMOS 24,2 megapixel, có kích thước tương đương với các máy ảnh DSLR cao cấp của Sony. Nhờ thế mà cho khả năng thu nhận ánh sáng tốt hơn, tạo ra hình ảnh sắc nét và chi tiết hơn trong các điều kiện ánh sáng khác nhau.</p><p><img src=\"https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:80/plain/https://cellphones.com.vn/media/wysiwyg/May-anh/May-anh-sony/may-anh-ky-thuat-so-sony-zv-e10-1.jpg\" alt=\"Đánh giá máy ảnh kỹ thuật số Sony ZV-E10\"></p><p>Ngoài ra, cảm biến APS-C Exmor CMOS còn có khả năng giảm thiểu nhiễu và độ nhạy cao, cho phép <strong>máy ảnh kỹ thuật số Sony ZV-E10 </strong>chụp ảnh và quay phim với chất lượng hình ảnh tốt hơn trong điều kiện ánh sáng yếu. Từ đó giúp cải thiện chất lượng hình ảnh và video của máy ảnh này, đặc biệt là trong việc chụp ảnh và quay phim trong nhiều điều kiện ánh sáng khác nhau.</p><h3><strong>Quay phim chất lượng cao với chế độ HLG</strong></h3><p>HLG (Hybrid Log-Gamma) là một chế độ mới nhất được áp dụng vào máy ảnh. Chế độ này giúp tăng độ tương phản, khả năng xử lý màu sắc rộng và phạm vi độ sáng của hình ảnh, qua đó mang lại hình ảnh hoặc video có màu sắc và độ chân thực cao hơn.</p><p><img src=\"https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:80/plain/https://cellphones.com.vn/media/wysiwyg/May-anh/May-anh-sony/may-anh-ky-thuat-so-sony-zv-e10-2.jpg\" alt=\"Đánh giá máy ảnh kỹ thuật số Sony ZV-E10\"></p><p>Chế độ HLG trên <strong>máy ảnh kỹ thuật số Sony ZV-E10 </strong>còn giúp người dùng chụp ảnh và quay phim với độ tương phản cao hơn, giúp tạo ra hình ảnh có chi tiết rõ nét và độ sáng tự nhiên hơn.</p><h3><strong>Khả năng kết nối tiện lợi</strong></h3><p><strong>Máy ảnh kỹ thuật số Sony ZV-E10 </strong>có khả năng kết nối với hầu hết các thiết bị thông minh hiện nay nhờ vào công nghệ Bluetooth, Wi-Fi và USB. Nhờ vậy mà người dùng có thể kết nối máy ảnh với điện thoại thông minh hoặc máy tính bảng để chia sẻ ảnh và video trực tiếp từ máy ảnh đến các thiết bị này. Hơn hết, khi kết nối Bluetooth với loa hay micro thì người dùng sẽ thu âm và phát lại âm thanh với một chất lượng cực kỳ tốt.</p><p><img src=\"https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:80/plain/https://cellphones.com.vn/media/wysiwyg/May-anh/May-anh-sony/may-anh-ky-thuat-so-sony-zv-e10-3.jpg\" alt=\"Đánh giá máy ảnh kỹ thuật số Sony ZV-E10\"></p><h2><strong>Mua máy ảnh kỹ thuật số Sony ZV-E10 uy tín, chất lượng tại</strong></h2><p>Tại, bạn có thể tìm mua <strong>máy ảnh kỹ thuật số Sony ZV-E10 </strong>với giá cả phù hợp và đội ngũ nhân viên tư vấn nhiệt tình, chuyên nghiệp. Hơn nữa, còn có nhiều chương trình khuyến mãi hấp dẫn và dịch vụ bảo hành tốt, giúp bạn hoàn toàn yên tâm khi mua sắm tại đây.</p>', 6, 'may-anh-ky-thuat-so-sony-zv-e10-6572e3d1110d5', 1, 24, '2023-12-08 16:37:22', '2023-12-08 22:01:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `prod_id`, `price`, `quantity`, `discount`) VALUES
(1, 83, 44900000, 108, 0),
(2, 83, 44590000, 17, 8),
(3, 83, 34690000, 23, 0),
(5, 83, 33590000, 224, 0),
(7, 84, 5100000, 77, 0),
(8, 85, 5990000, 233, 10),
(9, 85, 7990000, 110, 0),
(10, 85, 6590000, 67, 0),
(11, 85, 5690000, 233, 15),
(12, 86, 35690000, 22, 0),
(13, 86, 34890000, 20, 0),
(14, 87, 22990000, 234, 0),
(15, 87, 21990000, 12, 4),
(16, 87, 21990000, 12, 0),
(17, 87, 21790000, 34, 0),
(18, 89, 25990000, 33, 0),
(19, 89, 25990000, 99, 0),
(20, 89, 25290000, 34, 3),
(21, 89, 24990000, 9, 4),
(22, 88, 10990000, 24, 8),
(23, 88, 10990000, 23, 0),
(24, 88, 11590000, 23, 0),
(25, 90, 3590000, 93, 3),
(26, 90, 3690000, 77, 0),
(27, 90, 3190000, 34, 0),
(28, 90, 3990000, 53, 0),
(29, 84, 5181000, 33, 0),
(30, 91, 10890000, 34, 0),
(31, 91, 10890000, 23, 8),
(32, 91, 9990000, 88, 0),
(33, 92, 2190000, 230, 22),
(34, 94, 4890000, 343, 14),
(38, 96, 12890000, 234, 7),
(39, 96, 13490000, 45, 3),
(40, 96, 16890000, 24, 0),
(41, 97, 21490000, 34, 0),
(42, 97, 23490000, 231, 0),
(43, 97, 25190000, 45, 5),
(44, 98, 500000, 33, 0),
(45, 98, 450000, 34, 10),
(46, 94, 5100000, 234, 0),
(47, 92, 2340000, 367, 0),
(48, 99, 450000, 98, 0),
(49, 99, 469000, 456, 6),
(50, 100, 890000, 52, 10),
(51, 100, 790000, 63, 11),
(52, 101, 5290000, 355, 16),
(53, 101, 6290000, 345, 0),
(54, 102, 8090000, 345, 1),
(55, 102, 9190000, 147, 0),
(56, 103, 2390000, 345, 0),
(57, 103, 2390000, 342, 11),
(58, 104, 2720000, 345, 0),
(59, 104, 2890000, 334, 26),
(60, 105, 10990000, 232, 0),
(61, 105, 11990000, 212, 0),
(62, 105, 11390000, 456, 12),
(63, 105, 10990000, 221, 0),
(64, 106, 16990000, 335, 6),
(65, 106, 17990000, 332, 0),
(66, 107, 16990000, 443, 6),
(67, 107, 17990000, 332, 0),
(68, 107, 15990000, 321, 0),
(69, 107, 14990000, 44, 0),
(70, 108, 10990000, 334, 0),
(71, 108, 9990000, 231, 9),
(72, 108, 7990000, 444, 0),
(73, 109, 4490000, 223, 0),
(74, 109, 4290000, 213, 0),
(75, 110, 16990000, 334, 0),
(76, 110, 15990000, 0, 0),
(77, 111, 40000000, 23, 0),
(78, 111, 30000000, 34, 25),
(79, 111, 30000000, 78, 0),
(80, 112, 30000000, 33, 0),
(81, 112, 36000000, 45, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ratings`
--

INSERT INTO `ratings` (`id`, `prod_id`, `user_id`, `star`, `comment`, `status`, `create_at`, `update_at`) VALUES
(2, 83, 4, 4, 'San pham that su chat luong', 1, '2023-11-23 14:58:53', '2023-12-06 20:30:05'),
(3, 83, 25, 4, 'Người dùng không để lại cảm nghĩ.', 1, '2023-11-23 15:03:49', '2023-11-23 15:27:00'),
(4, 92, 4, 5, 'Sản phẩm đỉnh thựt sự không thể tin nổi <3333', 1, '2023-12-01 20:36:40', '2023-12-01 20:37:08'),
(5, 85, 25, 5, 'Sản phẩm xịn', 1, '2023-12-05 10:07:41', '2023-12-05 10:07:41'),
(6, 86, 26, 4, 'Sản phẩm tốt nhỉ', 1, '2023-12-05 10:08:01', '2023-12-05 10:08:01'),
(7, 84, 28, 5, 'Sản phẩm đẹp hết nước chấm', 1, '2023-12-05 10:08:16', '2023-12-05 10:08:16'),
(8, 89, 27, 1, 'Sản phẩm cũ quá tệ', 1, '2023-12-05 10:08:29', '2023-12-05 10:08:29'),
(9, 90, 29, 5, 'Sản phẩm nhiều lượt mua', 1, '2023-12-05 10:08:56', '2023-12-05 10:08:58'),
(10, 110, 30, 1, 'Sản phẩm tồi quá', 1, '2023-12-08 22:01:34', '2023-12-08 22:01:55'),
(11, 83, 9, 5, 'Sản phẩm rất tốt', 1, '2023-12-09 09:33:59', '2023-12-09 09:33:59'),
(12, 108, 34, 5, 'San  pham rat sin', 1, '2023-12-22 20:53:04', '2023-12-22 20:53:04'),
(13, 105, 35, 5, 'San pham chat luong cao', 1, '2023-12-26 19:06:31', '2023-12-26 19:06:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Người quản trị'),
(2, 'seller', 'Người bán hàng'),
(3, 'customer', 'Khách hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `store_custom`
--

CREATE TABLE `store_custom` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `open_time` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `store_custom`
--

INSERT INTO `store_custom` (`id`, `name`, `phone`, `email`, `address`, `logo`, `open_time`, `create_at`, `update_at`) VALUES
(1, 'Ten cua hang moi', '0332225690', 'admin@gmail.com', 'Tầng 1 siêu thị Winmart Nhật Tân,\r\nNg. 689 Đ. Lạc Long Quân, Phú Thượng, Tây Hồ, Hà Nội', 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700660959/uploads_ecommerce_php_5_1/php1D48_ub0liy.png', 'Thứ hai đến thứ 7: 9am - 10pm | Chủ nhật: 10am - 6pm ', '2023-11-22 20:10:13', '2023-11-22 20:10:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg',
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `isBlock` tinyint(4) NOT NULL DEFAULT 0,
  `role_id` tinyint(4) NOT NULL DEFAULT 3,
  `accessToken` text NOT NULL,
  `refreshToken` varchar(500) NOT NULL,
  `create_At` datetime NOT NULL DEFAULT current_timestamp(),
  `update_At` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `avatar`, `address`, `phone`, `isBlock`, `role_id`, `accessToken`, `refreshToken`, `create_At`, `update_At`) VALUES
(4, 'Tân (admin)', 'admin@gmail.com', '$2y$10$kz/Xzp/xNuEXzX.4BkCjzOGtUEMsvmd8hwWqyJ119ZdI9tjbtqnP6', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', 'Dong anh HA NOI', '0993346890', 0, 1, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjo0LCJyb2xlX2lkIjoxLCJmdWxsbmFtZSI6IlRcdTAwZTJuIChhZG1pbikiLCJhdmF0YXIiOiJodHRwczpcL1wvdDQuZnRjZG4ubmV0XC9qcGdcLzA1XC80OVwvOThcLzM5XC8zNjBfRl81NDk5ODM5NzBfYlJDa1lmazBQNlBQNWZLYk1oWk1JYjA3bUNKNmVzWEwuanBnIiwiaXNCbG9jayI6MCwiZXhwIjoxNzAzNzc2ODEyfQ.PiYsqFaEuqtwNSOL8qkpoV_e_0aI3Kv5jcITPOnPSKY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZWZyZXNoVG9rZW4iOjQsImV4cCI6MTcwNDM3NDQxMn0.4fRVD9VsBRl0iMiyNLsO4911bVl_rkRHcKa_P_Tlu-8', '2023-10-02 08:15:37', '2023-12-28 20:20:12'),
(9, 'Trần Văn B', 'tranvanb@gmail.com', '$2y$10$zZczTvtUBq3oGMNhz0vph.dV7OAgz0r51T.56g9GURE9vZnRg3sam', 'https://res.cloudinary.com/dfgkkkcoc/image/upload/v1700472991/uploads_ecommerce_php_5_1/phpADF_qwzk6l.jpg', 'Việt trì, Phú thọ', '0332225678', 0, 3, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjo5LCJyb2xlX2lkIjozLCJmdWxsbmFtZSI6IlRyXHUxZWE3biBWXHUwMTAzbiBCIiwiYXZhdGFyIjoiaHR0cHM6XC9cL3Jlcy5jbG91ZGluYXJ5LmNvbVwvZGZna2trY29jXC9pbWFnZVwvdXBsb2FkXC92MTcwMDQ3Mjk5MVwvdXBsb2Fkc19XRUIyMDQxX0Vjb21tZXJjZVwvcGhwQURGX3F3ems2bC5qcGciLCJpc0Jsb2NrIjowLCJleHAiOjE3MDIwOTY1ODN9.TrS6opnRK664lGp5-2mSFUbQxk39i9KpgHNb3kugk_0', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZWZyZXNoVG9rZW4iOjksImV4cCI6MTcwMjY5NDE4M30.P9kYZ5ns5KtOFOQ1jJzoQLrnWyktzBl4g0ExktUXDR4', '2023-10-02 19:26:25', '2023-12-09 09:36:23'),
(10, 'tan c', 'tanc@fpt.edu.vn', '$2y$10$Qtu1Pelsaj8mi4AIxnVziurp53xeH7VuV0tJSCC1aBuua4.Ld5FCC', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', '', '0990006780', 0, 3, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoxMCwicm9sZV9pZCI6MywiZnVsbG5hbWUiOiJ0YW4gYyIsImF2YXRhciI6Imh0dHBzOlwvXC90NC5mdGNkbi5uZXRcL2pwZ1wvMDVcLzQ5XC85OFwvMzlcLzM2MF9GXzU0OTk4Mzk3MF9iUkNrWWZrMFA2UFA1ZktiTWhaTUliMDdtQ0o2ZXNYTC5qcGciLCJpc0Jsb2NrIjowLCJleHAiOjE3MDE4Nzk1MzR9.cO9B9tiQ5cqIMvmpwS01lLEVBl8YVv7Fza3a6WuwO2g', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZWZyZXNoVG9rZW4iOjEwLCJleHAiOjE3MDI0NzcxMzR9.P2zdNg0HJkRySMiMPtoWud1zt6Rj9Y36MkHZfeqLQJw', '2023-10-06 20:46:35', '2023-12-06 21:18:54'),
(24, ' Tân (seller)', 'seller@gmail.com', '$2y$10$6uO.PhPLoZ58CU7n4C5NVO49w6K.sWF4Ki94kj.RJXvq7s1i0HILq', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', '', '0993334859', 0, 2, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoyNCwicm9sZV9pZCI6MiwiZnVsbG5hbWUiOiJWXHUwMTY5IE5nXHUxZWNkYyBUXHUwMGUybiAoc2VsbGVyKSIsImF2YXRhciI6Imh0dHBzOlwvXC90NC5mdGNkbi5uZXRcL2pwZ1wvMDVcLzQ5XC85OFwvMzlcLzM2MF9GXzU0OTk4Mzk3MF9iUkNrWWZrMFA2UFA1ZktiTWhaTUliMDdtQ0o2ZXNYTC5qcGciLCJpc0Jsb2NrIjowLCJleHAiOjE3MDE4NzY5NDJ9.APSYd99yPCmkXRWR1vB4p7Pig-ZlxFFQpExbFnxMz48', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZWZyZXNoVG9rZW4iOjI0LCJleHAiOjE3MDI0NzQ1NDJ9.Cs6Y3ZNbn0c9IvbHTqtIFcMMAEtt_iiJzetJW7FGTIo', '2023-11-21 16:57:39', '2023-12-06 20:35:42'),
(25, 'Tran Van E', 'tranvane@gmail.com', '$2y$10$CRCZd4az1iD2h.LC5tN/2uQPB1nGnrnlUX0Ik4mBvfm6B6wYbi6c.', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', '', '0332225670', 0, 3, '', '', '2023-11-21 17:16:37', '2023-12-06 20:44:28'),
(27, 'Tran Van D', 'tranvand@gmail.com', '$2y$10$p4.DIhuWHvWuckdPcdgny.0jOSKOcrQ5oaVgQ23rChW0RmQmexxhm', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', '', '', 0, 3, '', '', '2023-12-06 20:43:18', '2023-12-06 20:43:18'),
(28, 'Tran Van A', 'tranvana@gmail.com', '$2y$10$sV0z5asIX4CIK8LTMfZ6SOU.M9D0cgENqrmT2gRAR/3XJRSvm5sVa', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', '', '', 0, 3, '', '', '2023-12-06 20:43:47', '2023-12-06 20:43:47'),
(29, 'Nguyễn Văn A', 'nguyenvana@gmail.com', '$2y$10$zay92B3AqYqDWuI8gPptnOm17QmbntsXXzCfNG0bGl29bbfKEY/A6', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', '', '', 0, 3, '', '', '2023-12-06 20:45:03', '2023-12-06 20:45:03'),
(30, 'Nguyen Van B', 'nguyenvanb@gmail.com', '$2y$10$HPF93P/Hhx4hiJ6bxCsTXeUHEg3e0qS7VY5wJ1MizBAuGgYM4TGce', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', '', '', 0, 3, '', '', '2023-12-06 20:45:33', '2023-12-06 20:45:33'),
(31, 'Nguyễn Văn C', 'nguyenvanc@gmail.com', '$2y$10$.v8BrlRF6cF.dOfVfGkqluPxarzCTGwDr.0Jw8tj.nsYhuPl.g3tW', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', '', '', 0, 3, '', '', '2023-12-06 20:46:12', '2023-12-06 20:46:12'),
(32, 'Nguyên Văn E', 'nguyenvane@gmail.com', '$2y$10$XMyOYhwuMLEM/4JLJahsrek1l5aqqO2xbi8r/QKWVXfYtZPbcmfFW', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', '', '', 0, 3, '', '', '2023-12-06 20:46:36', '2023-12-06 20:46:36'),
(35, 'Tan', 'vung@gmail.com', '$2y$10$8fnmtdF/6EjSSrcMDWteEe2WyPGRpaqd3ZEVGe90Q0ZBLxCYTwka2', 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg', 'Ha tay', '0993332890', 0, 3, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjozNSwicm9sZV9pZCI6MywiZnVsbG5hbWUiOiJUYW4iLCJhdmF0YXIiOiJodHRwczpcL1wvdDQuZnRjZG4ubmV0XC9qcGdcLzA1XC80OVwvOThcLzM5XC8zNjBfRl81NDk5ODM5NzBfYlJDa1lmazBQNlBQNWZLYk1oWk1JYjA3bUNKNmVzWEwuanBnIiwiaXNCbG9jayI6MCwiZXhwIjoxNzAzNTk5MzMxfQ.ati8IS36V2U-ekvN2b-b7Yuv4x314zvQm1Bj1EVZpBI', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZWZyZXNoVG9rZW4iOjM1LCJleHAiOjE3MDQxOTY5MzF9.e3ybxa4zvjEJJFQuvS6Zq4jT2lVyRi_7rSmdTZqMaGw', '2023-12-26 19:02:01', '2023-12-26 19:13:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `variants_value`
--

CREATE TABLE `variants_value` (
  `id` int(11) NOT NULL,
  `product_variant_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `variants_value`
--

INSERT INTO `variants_value` (`id`, `product_variant_id`, `attribute_id`, `attribute_value_id`) VALUES
(22, 1, 20, 30),
(23, 1, 23, 28),
(24, 2, 20, 18),
(25, 2, 23, 28),
(26, 3, 20, 17),
(27, 3, 23, 28),
(30, 5, 20, 18),
(31, 5, 23, 27),
(34, 7, 21, 35),
(35, 7, 23, 25),
(36, 8, 20, 18),
(37, 8, 23, 40),
(38, 9, 20, 17),
(39, 9, 23, 40),
(40, 10, 20, 18),
(41, 10, 23, 39),
(42, 11, 20, 18),
(43, 11, 23, 41),
(44, 12, 20, 18),
(45, 12, 23, 24),
(46, 13, 20, 17),
(47, 13, 23, 40),
(48, 14, 20, 17),
(49, 14, 23, 24),
(50, 15, 20, 18),
(51, 15, 23, 24),
(52, 16, 20, 18),
(53, 16, 23, 39),
(54, 17, 20, 17),
(55, 17, 23, 39),
(56, 18, 20, 17),
(57, 18, 23, 39),
(58, 19, 20, 17),
(59, 19, 23, 40),
(60, 20, 20, 18),
(61, 20, 23, 42),
(62, 21, 20, 18),
(63, 21, 23, 41),
(64, 22, 20, 18),
(65, 22, 23, 22),
(66, 23, 20, 17),
(67, 23, 23, 22),
(68, 24, 20, 18),
(69, 24, 23, 39),
(70, 25, 20, 18),
(71, 25, 23, 39),
(72, 26, 20, 17),
(73, 26, 23, 39),
(74, 27, 20, 17),
(75, 27, 23, 40),
(76, 28, 20, 17),
(77, 28, 23, 42),
(78, 29, 21, 35),
(79, 29, 23, 24),
(80, 30, 20, 18),
(81, 30, 21, 21),
(82, 30, 23, 40),
(83, 31, 20, 18),
(84, 31, 21, 20),
(85, 31, 23, 40),
(86, 32, 20, 17),
(87, 32, 21, 21),
(88, 32, 23, 39),
(89, 33, 23, 43),
(90, 34, 23, 43),
(91, 38, 20, 30),
(92, 38, 21, 21),
(93, 38, 23, 43),
(94, 39, 20, 18),
(95, 39, 21, 20),
(96, 39, 23, 43),
(97, 40, 20, 30),
(98, 40, 21, 32),
(99, 40, 23, 43),
(100, 41, 20, 18),
(101, 41, 21, 20),
(102, 41, 23, 43),
(103, 42, 20, 30),
(104, 42, 21, 20),
(105, 42, 23, 43),
(106, 43, 20, 30),
(107, 43, 21, 32),
(108, 43, 23, 43),
(109, 44, 23, 43),
(110, 44, 32, 45),
(111, 45, 23, 44),
(112, 45, 32, 45),
(113, 46, 23, 44),
(114, 47, 23, 44),
(115, 48, 23, 44),
(116, 49, 23, 43),
(117, 50, 23, 43),
(118, 51, 23, 40),
(119, 52, 23, 44),
(120, 53, 23, 43),
(121, 54, 23, 44),
(122, 55, 23, 43),
(123, 56, 23, 43),
(124, 57, 23, 44),
(125, 58, 23, 43),
(126, 59, 23, 44),
(127, 60, 20, 17),
(128, 60, 23, 40),
(129, 61, 20, 18),
(130, 61, 23, 40),
(131, 62, 20, 18),
(132, 62, 23, 24),
(133, 63, 20, 17),
(134, 63, 23, 24),
(135, 64, 23, 43),
(136, 65, 23, 44),
(137, 66, 20, 18),
(138, 66, 21, 21),
(139, 66, 23, 44),
(140, 67, 20, 18),
(141, 67, 21, 21),
(142, 67, 23, 43),
(143, 68, 20, 17),
(144, 68, 21, 21),
(145, 68, 23, 43),
(146, 69, 20, 17),
(147, 69, 21, 20),
(148, 69, 23, 43),
(149, 70, 20, 18),
(150, 70, 21, 21),
(151, 70, 23, 40),
(152, 71, 20, 18),
(153, 71, 21, 20),
(154, 71, 23, 40),
(155, 72, 20, 17),
(156, 72, 21, 20),
(157, 72, 23, 40),
(158, 73, 23, 43),
(159, 74, 23, 39),
(160, 75, 23, 43),
(161, 76, 23, 44),
(162, 77, 20, 17),
(163, 77, 21, 20),
(164, 77, 23, 28),
(165, 78, 20, 17),
(166, 78, 21, 21),
(167, 78, 23, 29),
(168, 79, 20, 18),
(169, 79, 23, 24),
(170, 80, 20, 17),
(171, 80, 21, 20),
(172, 80, 23, 44),
(173, 81, 20, 18),
(174, 81, 21, 20),
(175, 81, 23, 43);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`product_variant_id`),
  ADD KEY `prod_id_2` (`product_variant_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_variant_id` (`product_variant_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- Chỉ mục cho bảng `images_product`
--
ALTER TABLE `images_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_variant_id` (`product_variant_id`),
  ADD KEY `product_id` (`product_variant_id`),
  ADD KEY `product_variant_id_2` (`product_variant_id`);

--
-- Chỉ mục cho bảng `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_method_id` (`payment_method_id`,`payment_transaction_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prod_id` (`prod_id`,`user_id`),
  ADD KEY `prod_id_2` (`prod_id`,`user_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `store_custom`
--
ALTER TABLE `store_custom`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`phone`),
  ADD KEY `email_2` (`email`,`phone`),
  ADD KEY `email_3` (`email`,`phone`);

--
-- Chỉ mục cho bảng `variants_value`
--
ALTER TABLE `variants_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_id` (`product_variant_id`,`attribute_id`,`attribute_value_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `images_product`
--
ALTER TABLE `images_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `payment_transactions`
--
ALTER TABLE `payment_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `store_custom`
--
ALTER TABLE `store_custom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `variants_value`
--
ALTER TABLE `variants_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
