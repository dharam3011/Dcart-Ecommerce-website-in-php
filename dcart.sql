-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 04:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `user_id` int(99) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pin` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `fname`, `lname`, `user_id`, `email`, `address_1`, `address_2`, `mobile`, `city`, `state`, `country`, `pin`, `status`, `added_on`) VALUES
(2, 'userfname', 'userlname', 1, '', 'useradd1', 'useradd2', '1111111111', 'usercity', 'gujarat', 'India', 123, 1, '2021-05-01 08:52:47'),
(3, 'Harsh', 'patel', 1, 'harsh@gmail.com', 'Silver Oak univercity, Gota', '', '2222222222', 'Ahmedabad', 'Gujarat', 'India', 360001, 1, '2021-05-11 06:11:53'),
(5, 'Sachin ', 'Patel', 1, 'sachin@gmail.com', 'Patanvav, T: dhoraji', '', '3333333333', 'Rajkot', 'gujarat', 'India', 360430, 1, '2021-05-11 06:09:09'),
(6, 'Jay', 'patel', 1, 'jay@gmail.com', 'Rangoli Ice-cream, babla choke, Upleta', 'Vadlichock Uplata', '4444444444', 'Rajkot', 'Gjarat', 'India', 360490, 1, '2021-05-11 06:00:08'),
(8, 'nikunj', 'patel', 1, 'nikunj@gmail.com', 'prime Guest, Nr. Nirman tower, ghatlodiya, ', 'chankyapuri', '5555555555', 'Ahmedabad', 'Gujrat', 'India', 360001, 1, '2021-05-11 06:06:25'),
(9, 'dharam', 'patel', 1, 'dharam@gmail.com', 'Patanvav, T: dhoraji', '', '6666666666', 'Rajkot', 'gujarat', 'India', 360430, 1, '2021-05-01 08:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `mobile`, `email`, `password`, `image`, `status`) VALUES
(1, 'admin123', 'admin', '9876543210', 'admin@gmail.com', 'admin', 'placeholder.png', 1),
(3, 'dharam3011', 'dharam sojitra', '12344567890', 'dharamsojitra3011@gmail.com', '457b2221bc24a34e3df0df13c5bc2162', 'Printed Men Polo Neck White T-Shirt.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`, `status`, `added_on`) VALUES
(1, 'Mobile', 'SAMSUNG Galaxy A71 (Prism Crush Blue, 128 GB)  (8 GB RAM).jpeg', 1, '2021-05-07 09:02:54'),
(2, 'Leptop', 'laptop.jpeg', 1, '2021-05-07 09:06:05'),
(3, 'Eletronics', 'Electronics.jpeg', 1, '2021-05-07 09:00:01'),
(5, 'Shoes', 'shoes.jpeg', 1, '2021-05-07 09:02:38'),
(6, 'Fashion', 'Abstract Men Hooded Neck Dark Blue T-Shirt.jpeg', 1, '2021-05-02 04:48:19'),
(7, 'TV', 'Mi 4X 108 cm (43 inch) Ultra HD (4K) LED Smart Android TV.jpeg', 1, '2021-05-07 09:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `name`, `email`, `mobile`, `message`, `status`, `added_on`) VALUES
(1, 'user', 'user@gmail.com', '9876543210', 'hello I am user', 1, '2021-04-15 06:55:38'),
(2, 'user2', 'user2@gmail.com', '9876543210', 'this is query message please solve it', 1, '2021-05-20 06:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `demo2`
--

CREATE TABLE `demo2` (
  `id` bigint(50) NOT NULL,
  `Enrollment` bigint(20) NOT NULL,
  `FirstName` varchar(11) NOT NULL,
  `LastName` varchar(11) NOT NULL,
  `samester` int(11) NOT NULL,
  `Contactno` int(15) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `demo2`
--

INSERT INTO `demo2` (`id`, `Enrollment`, `FirstName`, `LastName`, `samester`, `Contactno`, `created_at`) VALUES
(1, 180770107223, 'Dharam', 'Sojitra', 6, 987654321, '2021-04-30 11:45:34'),
(3, 0, '', '', 0, 0, '2021-04-30 11:41:07'),
(4, 0, '', '', 0, 0, '2018-12-05 12:39:16'),
(5, 0, '', '', 0, 0, '2021-04-30 11:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `grand_total` double NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `delivery_charge` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `address_id` int(50) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `card_bank_upi_wallet` varchar(30) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `payment_status` varchar(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `payment_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `grand_total`, `total_item`, `total_price`, `delivery_charge`, `user_id`, `address_id`, `payment_type`, `card_bank_upi_wallet`, `payment_id`, `payment_status`, `order_status`, `payment_date`, `delivery_date`, `order_date`) VALUES
(1111112, 570, 2, 520, 50, 1, 8, 'paymentGetway', '', '', 'pending', 1, '0000-00-00 00:00:00', '2021-05-11 10:03:32', '2021-05-10 06:02:00'),
(1111113, 1449, 1, 1399, 50, 1, 8, 'paymentGetway', '', '', 'pending', 1, '0000-00-00 00:00:00', '2021-05-11 10:03:32', '2021-05-10 06:04:54'),
(1111114, 1449, 1, 1399, 50, 1, 8, 'paymentGetway', '', '', 'pending', 1, '0000-00-00 00:00:00', '2021-05-11 10:03:32', '2021-05-10 06:06:58'),
(1111115, 1449, 1, 1399, 50, 1, 8, 'paymentGetway', '', '', 'pending', 1, '0000-00-00 00:00:00', '2021-05-11 10:03:32', '2021-05-10 06:08:57'),
(1111116, 1449, 1, 1399, 50, 1, 8, 'netbanking', '', '', 'Success', 1, '0000-00-00 00:00:00', '2021-05-11 10:03:32', '2021-04-13 06:09:50'),
(1111117, 1449, 1, 1399, 50, 1, 8, 'netbanking', 'BARB_R', 'pay_H8zDyrkIeX2Wpo', 'Success', 1, '2021-05-10 11:43:33', '2021-05-11 10:03:32', '2021-05-10 06:11:26'),
(1111118, 4549, 1, 4499, 50, 1, 9, 'card', 'card_H9NqU7mUcVFDAF', 'pay_H9NqU41uJUJFzL', 'Success', 4, '2021-05-11 11:48:44', '0000-00-00 00:00:00', '2021-05-11 06:16:51'),
(1111119, 39049, 1, 38999, 50, 1, 5, 'netbanking', 'SBIN', 'pay_H9O5CNXq7f1Ypz', 'Success', 2, '2021-05-11 12:02:31', '0000-00-00 00:00:00', '2021-05-11 06:32:03'),
(1111120, 1899, 3, 1849, 50, 1, 3, 'COD', '', '', 'pending', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-05-11 06:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `qty`, `added_on`) VALUES
(1, 1111111, 1, 1, '2021-05-05 06:45:46'),
(2, 1111112, 0, 0, '2021-05-10 06:02:00'),
(3, 1111113, 21, 1, '2021-05-10 06:04:54'),
(4, 1111114, 21, 1, '2021-05-10 06:06:58'),
(5, 1111115, 21, 1, '2021-05-10 06:08:58'),
(6, 1111116, 21, 1, '2021-05-10 06:09:50'),
(7, 1111117, 21, 1, '2021-05-10 06:11:27'),
(8, 1111118, 67, 1, '2021-05-11 06:16:52'),
(9, 1111119, 23, 1, '2021-05-11 06:32:03'),
(10, 1111120, 54, 1, '2021-05-11 06:35:05'),
(11, 1111120, 59, 2, '2021-05-11 06:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `order_status`) VALUES
(1, 'pending'),
(2, 'processing'),
(3, 'shipped'),
(4, 'complete'),
(5, 'cancled');

-- --------------------------------------------------------

--
-- Table structure for table `payment_card`
--

CREATE TABLE `payment_card` (
  `card_id` int(11) NOT NULL,
  `card_holder` varchar(100) NOT NULL,
  `card_number` bigint(255) NOT NULL,
  `exp_date` int(11) NOT NULL,
  `exp_year` int(11) NOT NULL,
  `cvv` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `card_type` varchar(100) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_detail` text NOT NULL,
  `product_price` float NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `category_id` int(50) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `best_seller` int(11) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_detail`, `product_price`, `product_image`, `category_id`, `sub_category_id`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `status`, `added_on`) VALUES
(1, 'Abstract Men Hooded Neck Dark Blue T-Shirt', 'Type : Hooded Neck\r\nSleeve : Full Sleeve\r\nFit : Regular\r\nFabric : Cotton Blend\r\nPack of : 1\r\nNeck Type : Hooded Neck\r\nIdeal For : Men\r\nSize : XL\r\nPattern : Abstract\r\nSuitable For : Western Wear\r\nBrand Fit : Regular\r\nReversible : No\r\nFabric Care : Regular Machine Wash\r\nBrand Color : Navy Blue\r\n', 323, 'Abstract Men Hooded Neck Dark Blue T-Shirt.jpeg', 6, 1, 0, '', '', '', 1, '2021-05-05 18:20:11'),
(2, 'Hooded Neck Sleeve Full Sleeve Fit Regular Fabric Cotton Blend Sales Package Pack Of 1 Pack of 1 Sty', 'Type : Hooded Neck\r\nSleeve : Full Sleeve\r\nFit : Regular\r\nFabric : Cotton Blend\r\nSales Package : Pack Of 1\r\nPack of : 1\r\nStyle Code : T345-BLWHRD-NEW\r\nNeck Type : Hooded Neck\r\nIdeal For : Men\r\nSize : XXL\r\nPattern : Color Block\r\nSuitable For : Western Wear\r\nSleeve Type : Narrow\r\nReversible : No\r\nBrand Color : Black-White-Red', 349, 'Color Block Men Hooded Neck Multicolor T-Shirt.jpeg', 6, 1, 0, '', '', '', 1, '2021-05-06 12:34:27'),
(3, 'Printed Men Hooded Neck Black T-Shirt', 'Type : Hooded Neck\r\nSleeve : Full Sleeve\r\nFit : Regular\r\nFabric : Cotton Blend\r\nPack of : 1\r\nStyle Code : TBLHDFULMASK-LION\r\nNeck Type : Hooded Neck\r\nIdeal For : Men\r\nSize : S\r\nPattern : Printed\r\nSuitable For : Western Wear\r\nReversible : No\r\nBrand Color : Black', 349, 'Printed Men Hooded Neck Black T-Shirt.jpeg', 6, 1, 0, '', '', '', 1, '2021-05-06 12:38:49'),
(4, 'Printed Men Polo Neck White T-Shirt', 'Type : Polo Neck\r\nSleeve : Short Sleeve\r\nFit : Regular\r\nFabric : Pure Cotton\r\nPack of : 1\r\nStyle Code : UDTSH0187\r\nNeck Type : Polo Neck\r\nIdeal For : Men\r\nSize : XL\r\nPattern : Printed\r\nSuitable For : Western Wear\r\nSleeve Type : Narrow\r\nReversible : No\r\nFabric Care : Reverse and dry, Do not tumble dry, Do not bleach, Gentle Machine Wash\r\nBrand Color : OFF WHITE\r\nHALF SLEEVE POLO, XL', 849, 'Printed Men Polo Neck White T-Shirt.jpeg', 6, 1, 0, '', '', '', 1, '2021-05-05 18:43:48'),
(5, 'Solid Men Mandarin Collar Blue, Black T-Shirt  (Pack of 2)', 'Type : Mandarin Collar\r\nSleeve : Half Sleeve\r\nFit : Regular\r\nFabric : Pure Cotton\r\nPack of : 2\r\nStyle Code : 4180-4181\r\nNeck Type : Mandarin Collar\r\nIdeal For : Men\r\nSize : S\r\nPattern : Solid\r\nSuitable For : Western Wear\r\nBrand Fit : Regular\r\nSleeve Type : Narrow\r\nFabric Care : Machine wash as per tag\r\nModel Name : t-shirt combo t-shirt for men casual tees half sleeve t-shirts boys men\r\nBrand Color : Black, Blue', 509, 'Solid Men Mandarin Collar Blue, Black T-Shirt  (Pack of 2).jpeg', 6, 1, 0, '', '', '', 1, '2021-05-06 02:46:07'),
(6, 'Solid Men Mandarin Collar Green T-Shirt', 'Type : Mandarin Collar\r\nSleeve : Half Sleeve\r\nFit : Regular\r\nFabric : Pure Cotton\r\nPack of : 2\r\nStyle Code : 4180-4181\r\nNeck Type : Mandarin Collar\r\nIdeal For : Men\r\nSize : S\r\nPattern : Solid\r\nSuitable For : Western Wear\r\nBrand Fit : Regular\r\nSleeve Type : Narrow\r\nFabric Care : Machine wash as per tag\r\nModel Name : t-shirt combo t-shirt for men casual tees half sleeve t-shirts boys men\r\nBrand Color : Black, Blue', 350, 'Solid Men Mandarin Collar Green T-Shirt.jpeg', 6, 1, 0, '', '', '', 1, '2021-05-06 03:51:46'),
(7, 'Solid Men Polo Neck Blue T-Shirt', 'Type : Mandarin Collar\r\nSleeve : Full Sleeve\r\nFit : Regular\r\nFabric : Cotton Blend\r\nPack of : 1\r\nStyle Code : T325-PWGH\r\nNeck Type; Mandarin Collar\r\nIdeal For : Men\r\nSize : S\r\nPattern : Solid\r\nSuitable For : Western Wear\r\nBrand Fit : Regular\r\nReversible : No\r\nFabric Care: Gentle Machine Wash\r\nBrand Color : Green\r\nBand Collar Men T-Shirt', 350, 'Solid Men Polo Neck Blue T-Shirt.jpeg', 6, 1, 0, '', '', '', 1, '2021-05-06 04:20:50'),
(8, 'Solid Men Polo Neck White, Black T-Shirt', 'Type : Polo Neck\r\nSleeve : Full Sleeve\r\nFit : Regular\r\nFabric : Cotton Blend\r\nSales Package : Pack of 1 Tshirt\r\nPack of : 1\r\nStyle Code : Style T-shirt\r\nNeck Type : Polo Neck\r\nIdeal For : Men\r\nSize : S\r\nPattern : Solid\r\nSuitable For : Western Wear\r\nBrand Fit : S\r\nReversible : No\r\nFabric Care : Machine wash as per tag\r\nOther Details : Try This Premium Quality T-shirt\r\nModel Name : T-shirt\r\nBrand Color : White::Black	', 324, 'Solid Men Polo Neck White, Black T-Shirt.jpeg', 6, 1, 0, '', '', '', 1, '2021-05-06 07:20:04'),
(9, 'Striped Men Round Neck Reversible Dark Blue T-Shirt', 'Type : Round Neck\r\nSleeve : Short Sleeve\r\nFit : Slim\r\nFabric : Pure Cotton\r\nSales Package : 1 Men Cotton T-shirt\r\nPack of : 1\r\nStyle Code : JC-19-RN-HS-NAVY-SLV-STRIP\r\nNeck Type :  Round Neck\r\nIdeal For : Men\r\nSize : M\r\nPattern : Striped\r\nSuitable For : Western Wear\r\nBrand Fit : Slim\r\nSleeve Type : Narrow\r\nReversible : Yes\r\nFabric Care : Machine wash as per tag, Do not Iron on print/embroidery/embellishment, Do not bleach, : Reverse and dry, Wash with like colors, Dry in shade\r\nBrand Color : Dark blue', 260, 'Striped Men Round Neck Reversible Dark Blue T-Shirt.jpeg', 6, 1, 0, '', '', '', 1, '2021-05-06 04:41:21'),
(10, 'Casual Half Sleeve Printed Women White Top', 'Neck : Round Neck\r\nSleeve Style : Half Sleeve\r\nFit : Regular\r\nFabric : Polyester\r\nType : Regular Top\r\nPattern : Printed\r\nColor : White\r\nPack of : 1\r\nFabric Care : Machine Wash\r\nThis Round Neck cream print top from Van Heusen is a perfect addition to your style repertoire.', 585, 'Casual Half Sleeve Printed Women White Top.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-06 04:55:14'),
(11, 'Casual Short Sleeve Printed Women Yellow Top', 'Neck : Tie-Up\r\nSleeve Style : Short Sleeve\r\nFit : Regular\r\nFabric : Rayon\r\nType : Empire Waist\r\nPattern : Printed\r\nColor : Yellow\r\nPack of : 1\r\nFabric Care : Gentle Machine Wash\r\nModel Name : Tops\r\nTOKYO TALKIES Solid RAYON Regular Fit MUSTARD Tops', 549, 'Casual Short Sleeve Printed Women Yellow Top.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-07 08:05:18'),
(12, 'Color Block Women Hooded Neck Maroon, Black T-Shirt', 'Type : Hooded Neck\r\nSleeve : Full Sleeve\r\nFit : Slim\r\nFabric : Hosiery\r\nSales Package : 1 hood tshirt\r\nPack of : 1\r\nStyle Code : W_HOOD_MAROON\r\nNeck Type : Hooded Neck\r\nIdeal For : Women\r\nSize : S\r\nPattern : Color Block\r\nSuitable For : Western Wear\r\nReversible : No\r\nFabric Care : Gentle Machine Wash\r\nBrand Color : Maroon', 316, 'Color Block Women Hooded Neck Maroon, Black T-Shirt.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-10 05:48:25'),
(13, 'Party Cuffed Sleeve Solid Women White Top ', 'Neck : High Neck\r\nSleeve Style : Cuffed Sleeve\r\nSleeve Length : Full Sleeve\r\nFit : Regular\r\nFabric : Polyester\r\nType : Regular Top\r\nBelt Included : No\r\nPattern : Solid\r\nColor : White\r\nPack of : 1\r\nFabric Care : Dry Clean\r\nIvory Blingy Neck Top, in fabric, Unlined, Regular length, Comfort Fit, Button Closure, Straight Hemline and features Blingy Tape On Neck', 560, 'Party Cuffed Sleeve Solid Women White Top.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-10 05:38:14'),
(14, 'Women A-line Multicolor Dress', 'Color : Multicolor\r\nLength : Maxi/Full Length\r\nFabric : Polyester\r\nPattern : Printed\r\nIdeal For : Women\r\nType : A-line\r\nStyle Code : TTJ6005084\r\nSuitable For : Western Wear\r\nSleeve Length : Sleeveless\r\nPack of : 1\r\nFabric Care : Gentle Machine Wash\r\nSleeve : Sleeveless', 1019, 'Women A-line Multicolor Dress.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-07 08:15:17'),
(15, 'Women Ethnic Dress Multicolor Dress', ' Color : Multicolor\r\nLength : Maxi/Full Length\r\nFabric : Cotton Blend\r\nPattern : Printed\r\nIdeal For : Women\r\nType : Maxi\r\nStyle Code : FK_02\r\nSuitable For : Western Wear\r\nSleeve Length : Sleeveless\r\nPack of : 1\r\nNeck : Sweetheart Neck\r\nFabric Care : Washing instruction: Gentle Wash, Machine wash, Wash in normal water, Do not brush & bleach\r\nSleeve : No Sleeves\r\nSpruce Up Your Wardrobe With This Dress From SHIVA Available On Amazon. Wear It With A Pair Of Sneakers For A Day Out Or With A Pair Of Nude Heels For The Party And You Are Sure To Make Heads Turn.', 355, 'Women Ethnic Dress Multicolor Dress.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-07 08:19:19'),
(16, 'Women Fit and Flare Black Dress', 'Color : Black\r\nLength : Maxi/Full Length\r\nFabric : Rayon\r\nPattern : Floral Print\r\nIdeal For : Women\r\nType : Fit and Flare\r\nStyle Code : PW222\r\nSuitable For : Western Wear\r\nPack of : 1\r\nNeck : Round Neck\r\nFabric Care ; Regular Machine Wash\r\nSleeve : Regular Sleeves', 539, 'Women Fit and Flare Black Dress.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-07 08:22:35'),
(17, 'Women Fit and Flare Blue Dress', 'Color : Blue\r\nLength : Midi/Calf Length\r\nFabric : Polycotton\r\nPattern : Printed\r\nIdeal For : Women\r\nType : Fit and Flare\r\nStyle Code : TTJ6003419\r\nSuitable For : Western Wear\r\nSleeve Length : Sleeveless\r\nPack of : 1\r\nFabric Care : Gentle Machine Wash\r\nSleeve : Sleeveless', 484, 'Women Fit and Flare Blue Dress.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-07 08:24:39'),
(18, 'Women Gown Purple Dress', 'Color : Purple\r\nLength : Maxi/Full Length\r\nFabric : Rayon\r\nPattern : Solid\r\nIdeal For : Women\r\nType : Gown\r\nStyle Cod : \r\nAD6Win : \r\nSuitable For : Western Wear\r\nSleeve : No Sleeves', 603, 'Women Gown Purple Dress.jpeg', 6, 3, 1, 'Women Gown Purple Dress', 'Color : Purple, Length : Maxi/Full Length,  Fabric : Rayon', 'Women Gown', 1, '2021-05-13 09:16:04'),
(19, 'Women Pleated Maroon Dress', 'Color : Maroon\r\nLength : Maxi/Full Length\r\nFabric : Cotton Rayon Blend\r\nPattern : Self Design\r\nIdeal For : Women\r\nType : Pleated\r\nStyle Code : 818\r\nSuitable For : Western Wear\r\nSleeve Length : 3/4 Sleeve\r\nPack of : 1\r\nNeck : Boat Neck\r\nFabric Care : Hand Wash Only\r\nLining Material : Reyon\r\nSleeve : Bell Sleeves\r\nMaroon Color Reyon Which Has 14Kg Quality Of reyon Pure Fabric,Also It Has Stiched A Button For Geting Look Fashion Trends Of Garment Also It Has 3/4 Sleeves And Sleeves Has A Bell Pattern So Garment Will Look So Fashionable.Neack Type Is Boat Neck Also You Will Get 100% Of Quality From Hetvi Creation.', 522, 'Women Maxi Maroon Dress.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-07 08:30:24'),
(20, 'Women Sheath Black Dress', 'Color : Black\r\nLength : Above Knee/Mid Thigh Length\r\nFabric : Polyester\r\nIdeal For :P Women\r\nType : Sheath\r\nStyle Code : VWDRFRGHC46502\r\nSuitable For : Western Wear', 1125, 'Women Sheath Black Dress.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-07 08:32:52'),
(21, 'Women Wrap Pink Dress', 'Color : Pink\r\nLength : Below Knee\r\nFabric : Pure Cotton\r\nIdeal For : Women\r\nType : Wrap\r\nStyle Code : 1\r\nSuitable For : Western Wear\r\nSleeve Length : 3/4 Sleeve\r\nPack of : 1\r\nYou will look classy when you dress up in this trendy dress from angelete. This beautiful dress is made up of soft cotton and it is light in weight, suitable for travel and a perfect gift for all occasions and season. It is extremely fashionable and is super comfort in wearing. Its unique colour gives the product rich and glamorous look. It will give you that extra comfort and make you stand out wherever you are.\r\nGeneric Name : Dress\r\nCountry of Origin : India', 1399, 'Women Wrap Pink Dress.jpeg', 6, 3, 0, '', '', '', 1, '2021-05-07 08:40:35'),
(22, 'Mi 4A Horizon Edition 80 cm (32 inch) HD Ready LED Smart Android TV', 'Genreal\r\nIn The Box : 1 LED TV, 1 U Manual & Warranty card, 4 U Screws, 1 U Stand,1 U Remote Control\r\nModel Name : L32M6-EI/ L32M6-EI_V1\r\nDisplay Size : 80 cm (32)\r\nScreen Type : LED\r\nHD Technology & Resolution : HD Ready, 1366 x 768\r\n3D : No\r\nSmart TV : Yes\r\nCurve TV : No\r\nSeries\r\n4A Horizon Edition\r\nTouchscreen\r\nNo\r\nMotion Sensor : No\r\nHDMI : 3\r\nUSB : 2\r\nWi-Fi Type : 2.4\r\nBuilt In Wi-Fi : Yes\r\nLaunch Year: : 2020\r\n\r\nInternet Features\r\nBuilt In Wi-Fi : Yes\r\n3G Dongle Plug and Play : No\r\nEthernet (RJ45) : 1\r\nOther Internet Features : PatchWall, Android TV 9.0, Data Saver, Google Play Store with 5000+ Apps, Chromecast Built-in, Google Assistant, Live TV Channels, 23+ Content Partners\r\n\r\nConnectivity Features\r\nHDMI : 3 Side\r\nUSB : 2 Side\r\nComponent In (RGB Cable) : Yes\r\nComposite In (Audio Video Cable) : Yes\r\nNFC Support : No\r\nHeadphone Jack : No\r\nRF Connectivity Input : Yes', 15499, 'Mi 4A Horizon Edition 80 cm (32 inch) HD Ready LED Smart Android TV.jpeg', 7, 26, 0, '', '', '', 1, '2021-05-07 10:58:12'),
(23, 'Mi 4X 138.8 cm (55 Inches) Ultra HD Android LED TV (Black)', 'Brand	MI\r\nResolution	4K\r\nConnector Type	USB, Built-in Wi-fi, Hdmi\r\nDisplay Technology	LED Supported Internet Services	Zee5, Google Play Music, Sony Liv, All Android apps Supported by source provider, Google Play Store, Hotstar, YouTubeZee5, Google Play Music, Sony Liv, All Android apps Supported by source provider, Google Play Store, Hotstar, YouTube\r\nColour	Black\r\nScreen Size	55 Inches\r\nRefresh Rate	60 Hz\r\nItem Weight	13 Kilograms\r\n\r\nAbout this item :\r\n\r\nResolution: 4K Ultra HD (3840x2160) | Refresh Rate: 60 hertz\r\nConnectivity: 3 HDMI ports to connect set top box, Blu Ray players gaming console | 2 USB ports to connect hard drives and other USB devices\r\nSound: 20 Watts Output | Dolby Audio + DTS-HD. Audio Power ：10W x 2\r\nSmart TV features : Built-In Wi-Fi | PatchWall | Netflix | Prime Video | Disney+Hotstar and more | Android TV 9.0 | Google Assistant\r\nDisplay : LED Panel | Vivid picture engine | 4K HDR 10\r\nWarranty Information: 1 year warranty on product and 1 year extra on Panel\r\nInstallation/Wall mounting/demo will be arranged by Amazon Home Services or Xiaomi service partner. For more information, please call Mi support on 1800-103-6286 | Wall Mount is not included in the box and will be charged extra at the time of installation\r\nEasy Returns: This product is eligible for replacement within 10 days of delivery in case of any product defects, damage or features not matching the description provided\r\nCountry of Origin: India\r\n', 38999, 'Mi 4X 138.8 cm (55 Inches) Ultra HD Android LED TV (Black).jpg', 7, 26, 0, '', '', '', 1, '2021-05-07 11:19:09'),
(24, 'OnePlus Y Series 80 cm (32 inch) HD Ready LED Smart Android TV  (32HA0A00)', 'Brand  	OnePlus\r\nResolution	720p\r\nConnector Type	Wi-Fi\r\nDisplay Technology	LED\r\nSupported Internet Services	Netflix, Prime Video, YouTube\r\nColour	Black\r\nScreen Size	32 Inches\r\nRefresh Rate	60 Hz\r\nItem Weight	3500 Grams\r\n\r\nAbout this item :\r\n\r\nResolution: HD Ready (1366x768) | Refresh Rate: 60 hertz\r\nConnectivity: 2 HDMI ports to connect set top box, Blu Ray players, gaming console | 2 USB ports to connect hard drives and other USB devices\r\nSound : 20 Watts Output | Dolby Audio\r\nSmart TV Features: Android TV 9.0 | OnePlus Connect | Google Assistant | Play Store | Chromecast | Shared Album | Supported Apps : Netflix, YouTube, Prime video | Content Calendar | OxygenPlay\r\nDisplay : LED Panel | Noise Reduction | Colour Space Mapping |Dynamic Contrast | Anti-Aliasing | DCI-P3 93% colour gamut | Gamma Engine\r\nDesign: Bezel-less | Screen/Body Ratio = 91.4%\r\nWarranty Information: 1 year comprehensive warranty and additional 1 year on panel provided by the manufacturer from date of purchase\r\nInstallation/Wall mounting/demo will be arranged by Amazon Home Services. For any other information, please contact Amazon customer support | Wall Mount is not included in the box and will be charged extra at the time of installation\r\nEasy returns: This product is eligible for replacement within 10 days of delivery in case of any product defects, damage or features not matching the description provided\r\n', 14999, 'OnePlus Y Series 80 cm (32 inch) HD Ready LED Smart Android TV  (32HA0A00).jpeg', 7, 29, 0, '', '', '', 1, '2021-05-07 11:13:29'),
(25, 'OnePlus Y Series 108 cm (43 inch) Full HD LED Smart Android TV  (43FA0A00)', 'Brand	OnePlus\r\nResolution	1080p\r\nConnector Type	Wi-Fi\r\nDisplay Technology	LED\r\nSupported Internet Services	Netflix, Prime Video, YouTube\r\nColour	Black\r\nScreen Size	43 Inches\r\nRefresh Rate	60 Hz\r\nItem Weight	5700 Grams\r\n\r\nAbout this item :\r\n\r\nResolution: Full HD (1920x1080) | Refresh Rate: 60 hertz\r\nConnectivity: 2 HDMI ports to connect set top box, Blu Ray players, gaming console | 2 USB ports to connect hard drives and other USB devices\r\nSound : 20 Watts Output | Dolby Audio\r\nSmart TV Features: Android TV 9.0 | OnePlus Connect | Google Assistant | Play Store | Chromecast | Shared Album | Supported Apps : Netflix, YouTube, Prime video | Content Calendar | OxygenPlay\r\nDisplay: LED Panel | Noise Reduction | Colour Space Mapping |Dynamic Contrast | Anti-Aliasing | DCI-P3 93% colour gamut | Gamma Engine\r\nDesign: Bezel-less | Screen/Body Ratio = 88.5%\r\nWarranty Information: 1 year comprehensive warranty + additional 1 year on panel provided by the manufacturer from date of purchase\r\n', 25499, 'OnePlus Y Series 108 cm (43 inch) Full HD LED Smart Android TV  (43FA0A00).jpeg', 7, 29, 0, '', '', '', 1, '2021-05-07 13:00:19'),
(26, 'realme 80 cm (32 inch) HD Ready LED Smart Android TV  (TV 32)', 'In The Box : 1U contains LED TV 1N, Power Cable 1N, Remote Control 1N, Battery 2N, Manual 1N, Stand 1N\r\nModel Name : TV 32\r\nColor : Black\r\nDisplay Size : 80 cm (32)\r\nScreen Type : LED\r\nHD Technology & Resolution : HD Ready, 1366 x 768\r\n3D : No\r\nSmart TV : Yes\r\nCurve TV : No\r\nTouchscreen : No\r\nMotion Sensor : No\r\nHDMI : 3\r\nUSB : 2\r\nWi-Fi Type : Support 2.4G\r\nBuilt In Wi-Fi : Yes\r\nLaunch Year : 2020\r\n\r\nInternet Features\r\n\r\nBuilt In Wi-Fi : Yes\r\n3G Dongle Plug and Play : No\r\nEthernet (RJ45) : 1\r\nOther Internet Features : Certified Android TV, Chromecast Built-IN, Voice Search Enabled Remote, Android Pie 9.0 \r\n\r\nConnectivity Features\r\nHDMI : 3 Side\r\nUSB  : 2 Side\r\nComponent In (RGB Cable) : SPDIF\r\nNFC Support : No\r\nHeadphone Jack : No', 13999, 'realme 80 cm (32 inch) HD Ready LED Smart Android TV  (TV 32).jpeg', 7, 28, 0, '', '', '', 1, '2021-05-07 13:05:36'),
(27, 'Samsung Galaxy M31 (Space Black, 6GB RAM, 128GB Storage)', 'Brand	Samsung\r\nColour	Ocean Blue\r\nMemory Storage Capacity	128 GB\r\nOS	Android\r\nScreen Size	6.4 Inches\r\nDisplay Type	AMOLED\r\nCellular Technology	4G\r\nManufacturer	Samsung, Samsung India Electronics Pvt ltd, 6th Floor, DLF Centre, Sansad Marg, New delhi - 110001, India(Toll-free) 1800 40 7267864Samsung, Samsung India Electronics Pvt ltd, 6th Floor, DLF Centre, Sansad Marg, New delhi - 110001, India(Toll-free) 180\r\n\r\nOther camera features	64MP + 8MP + 5MP + 5MP\r\nConnectivity technologies	2G GSM,3G WCDMA,4G LTE FDD,4G LTE TDD\r\n\r\nAbout this item :\r\n\r\nQuad Camera Setup - 64MP (F1.8) Main Camera +8MP (F2.2) Ultra Wide Camera +5MP(F2.2) Depth Camera +5MP(F2.4) Macro Camera and 32MP (F2.0) front facing Camera\r\n6.4-inch(16.21 centimeters) Super Amoled - Infinity U Cut Display , FHD+ Resolution (2340 x 1080) , 404 ppi pixel density and 16M color support\r\nAndroid v10.0 operating system with 2.3GHz + 1.7GHz Exynos 9611 Octa core processor , 6GB RAM, 128GB internal memory expandable up to 512GB and dual SIM\r\n6000 mAh Battery\r\n1 year manufacturer warranty for device and 6 months manufacturer warranty for in-box accessories including batteries from the date of purchase\r\nPlease contact Samsung helpline number 1800 407 267864 for any assistance related to device', 13999, 'Samsung Galaxy M31 (Space Black, 6GB RAM, 128GB Storage).jpg', 1, 6, 0, '', '', '', 1, '2021-05-07 13:22:18'),
(28, 'Redmi 9 Prime (Sunrise Flare, 4GB RAM, 128GB Storage) - Full HD+ Display & AI Quad Camera', '4 GB RAM | 64 GB ROM | Expandable Upto 512 GB\r\n16.59 cm (6.53 inch) Full HD+ Display\r\n13MP Rear Camera | 8MP Front Camera\r\n5020 mAh Battery\r\nMediaTek Helio G80 Processor\r\n\r\nGeneral\r\n\r\nIn The Box : Handset, Power Adapter, USB Type-C Cable, SIM Eject Tool, Simple Protective Cover, Warranty Card, User Guide\r\nModel Number : M2004J191 / M2004J19I / MZB9763IN\r\nModel Name : 9 Prime\r\nColor : Space Blue\r\nBrowse Type : Smartphones\r\nSIM Type : Dual Sim\r\nHybrid Sim Slot : No\r\nTouchscreen : Yes\r\nOTG Compatible : Yes\r\nQuick Charging : Yes\r\nSAR Value : Head - 0.854W/Kg, Body - 0.417W/Kg\r\n\r\nDisplay Features\r\n\r\nDisplay Size : 16.59 cm (6.53 inch)\r\nResolution : 2340 x 1080 Pixels\r\nResolution Type : Full HD+\r\nDisplay Type : Full HD+ IPS Display\r\nOther Display Features : 19.5:9 Aspect Ratio, Brightness : 400 nit, Reading Mode Certified by TUV Rheinland, Corning Gorilla Glass 3 : Os & Processor Features\r\nOperating System : Android 10\r\nProcessor Type : MediaTek Helio G80\r\nProcessor Core : Octa Core\r\nPrimary Clock Speed : 2 GHz\r\nSecondary Clock Speed : 1.8 GHz\r\nOperating Frequency : 2G GSM: B2/B3/B5/B8, 3G WCDMA: B1/B2/B5/B8, 4G TD-LTE: B40/B41, 4G FDD-LTE: B1/B3/B5/B8\r\nMemory & Storage Features\r\nInternal Storage : 64 GB\r\nRAM : 4 GB\r\nExpandable Storage :L 512 GB\r\nSupported Memory Card Type : microSD\r\nMemory Card Slot Type : Dedicated Slot\r\nCall Log Memory : Yes\r\n\r\nCamera Features\r\n\r\nPrimary Camera Available : Yes\r\nPrimary Camera : 13MP Rear Camera\r\nPrimary Camera Features  :  13MP Main + 8MP (118.2 Degree FOV)Ultra-wide + 5MP Macro + 2MP Depth Sensor AI Quad Camera\r\nSecondary Camera Available : Yes\r\nSecondary Camera : 8MP Front Camera\r\nSecondary Camera Features : 8MP Selfie Camera\r\nHD Recording : Yes\r\nFull HD Recording : Yes\r\nVideo Recording : Yes\r\nVideo Recording Resolution : 1080P\r\nImage Editor : Yes\r\nDual Camera Lens : Primary Camera\r\n\r\nCall Features\r\n\r\nCall Wait/Hold : Yes\r\nConference Call : Yes\r\nHands Free : Yes\r\nVideo Call Support : Yes\r\nCall Divert : Yes\r\nPhone Book : Yes\r\nCall Timer : Yes\r\nSpeaker Phone : Yes\r\nSpeed Dialing : Yes\r\n\r\nConnectivity Features\r\n\r\nNetwork Type : 4G VOLTE, 4G, 3G, 2G\r\nSupported Networks : 4G VoLTE, 4G LTE, WCDMA, GSM\r\nInternet Connectivity : 4G, 3G, Wi-Fi, EDGE, GPRS\r\n3G : Yes\r\nGPRS : Yes\r\nBluetooth Support  : Yes\r\nWi-Fi : Yes\r\nWi-Fi Version : 802.11 a/b/g/n/ac\r\nWi-Fi Hotspot : Yes\r\nUSB Tethering : Yes\r\nUSB Connectivity : Yes\r\nEDGE : Yes\r\nAudio Jack : 3.5mm\r\nMap Support : Google Maps\r\nGPS Support :  Yes\r\n\r\nOther Details\r\n\r\nSmartphone : Yes\r\nUser Interface : MIUI 11 (Based on Android 10)\r\nSocial Networking Phone : Yes\r\nInstant Message : Yes\r\nBusiness Phone : Yes\r\nRemovable Battery : No\r\nMMS : Yes\r\nSMS : Yes\r\nKeypad : No\r\nVoice Input : Yes\r\nPredictive Text Input : Yes\r\nOther Features : Aura 360 Design, Splash-proof Design, Protected by P2i, Supports Dual SIM VoLTE HD Calling, Supports VoWiFi\r\nGPS Type : AGPS, Glonass, Beidou\r\n\r\nMultimedia Features\r\n\r\nAudio Formats : PCM, AAC / AAC+, MP3, AMR-NB and WB, PCM/WAVE Vorbis\r\n\r\nBattery & Power Features\r\n\r\nBattery Capacity : 5020 mAh\r\nTalk Time : 31 hrs\r\n\r\nDimensions\r\n\r\nWidth : 77 mm\r\nHeight : 163.3 mm\r\nDepth : 9.1 mm\r\nWeight: 198 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Manufacturer Warranty', 10999, 'Redmi 9 Prime (Space Blue, 64 GB)  (4 GB RAM).jpeg', 1, 4, 0, 'Redmi 9 Prime (Sunrise Flare, 4GB RAM, 128GB Storage) - Full HD+ Display & AI Quad Camera', '4 GB RAM | 64 GB ROM | Expandable Upto 512 GB 16.59 cm (6.53 inch) Full HD+ Display 13MP Rear Camera | 8MP Front Camera', 'Redmi 9 Prime ', 1, '2021-05-20 07:58:22'),
(29, 'Allmusic Wireless Headhone for Running, Workout, Sports, Bluetooth Headset  (Black, In the Ear)', 'General :\r\n\r\nModel Name : Super bass rocks beat sound sports stereo neckband headphone.\r\nColor : Black\r\nHeadphone Type : In the Ear\r\nInline Remote : Yes\r\nSales Package : 1 HBS -730 HEADPHONE, 1 USB CABLE\r\nConnectivity : Bluetooth\r\nHeadphone Design : Earbud\r\n\r\nProduct Details :\r\n\r\nSweat Proof : Yes\r\nFoldable/Collapsible : Yes\r\nDeep Bass : Yes\r\nWater Resistant : Yes\r\nMonaural : Yes\r\nDesigned For : All Smart Phone\r\nSeries : Neckband\r\nControls : POWER ON/OFF, PREV/NEXT, PLAY/PAUSE, VOLUME UP/DOWN\r\nTechnology Used : WIRELESS, BLUETOOTH\r\nOther Features : The Wireless Bluetooth Headset top-rate sound with advanced audio features. Enhanced bass response, HD Voice, and aptX compatibility make for an incredible listening experience with full, rich, sound for music and crystal-clear voice calls\r\nBoom Microphone : Yes\r\nWith Microphone : Yes\r\n\r\nSound Features :\r\n\r\nSensitivity : 106 dBmW\r\nImpedance : 16 ohm\r\nSignal to Noise Ratio : 85 dB\r\nNoise Reduction : 20 dB\r\nOther Sound Features : High quality sound with HD speaker and enhanced bass effect\r\n\r\nConnectivity Features :\r\n\r\nWireless Type  : BLUETOOTH\r\nWireless Range : 10 m\r\nBluetooth Version : 4.1\r\nBluetooth Range : 10 m\r\nHeadphone Power Source : BATTERY\r\nBattery Type : RECHARGEABLE\r\nCharging Time : 2\r\nPlay Time : 8 hr\r\nStandby Time : 160 hr\r\n\r\nWarranty :\r\n\r\nWarranty Service Type : NA\r\nCovered in Warranty : NA', 299, 'Allmusic Wireless Headhone for Running, Workout, Sports, Bluetooth Headset  (Black, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:01:50'),
(30, 'boAt BassHeads 100 Wired Headset  (Carbon Black, On the Ear)', 'General :\r\n\r\nModel Name : BassHeads 100\r\nColor : Black\r\nHeadphone Type : In the Ear\r\nInline Remote : No\r\nSales Package : Bassheads 100, Additional Earbuds, Warranty Card\r\nConnectivity : Wire \r\nHeadphone Design: Flatwire\r\n\r\nProduct Details :\r\n\r\nSweat Proof : Yes\r\nDeep Bass : Yes\r\nWater Resistant : No\r\nWith Microphone : Yes\r\n\r\nDimensions  :\r\n\r\nWidth : 15 mm\r\nDepth : 5 mm\r\nWeight : 0.3\r\n\r\nWarranty :\r\n\r\nDomestic Warranty : 1 Year\r\nWarranty Summary : 1 Year\r\nWarranty Service Type : Carry in to service centre or reach out to us at info@imaginemarketingindia.com/+912249461882/support.boat-lifestyle.com. Alternatively you can activate your warranty by giving a missed call on 9223032222\r\nCovered in Warranty : manufacturing defect\r\nNot Covered in Warranty : Physical Damage', 399, 'boAt BassHeads 100 Wired Headset  (Carbon Black, On the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:32:37'),
(31, 'boAt Airdopes 381 Bluetooth Headset  (Active Black, True Wireless)', 'General\r\n\r\nModel Name : Airdopes 381 / Airdopes 383\r\nColor : Active Black\r\nHeadphone Type : True Wireless\r\nInline Remote : No\r\nSales Package : 1 Pair of Earbuds, Charging Case, USB Type-C Charging Cable, User Manual, Warranty Card\r\nConnectivity : Bluetooth\r\nHeadphone Design : Earbud\r\n\r\nProduct Details\r\n\r\nSweat Proof : Yes\r\nDeep Bass : Yes\r\nWater Resistant : Yes\r\nDesigned For : iOS,Android,Windows\r\nSeries : Airdopes\r\nWith Microphone : Yes\r\n\r\nConnectivity Features\r\n\r\nWireless Type : Bluetooth\r\nWireless Range : 10 m\r\nBluetooth Profiles : HSP, HPF, A2DP, AVRCP\r\nBluetooth Version : 5\r\nBluetooth Range : 10 m\r\nBattery Life : 20 hrs\r\nBattery Capacity : 500 mAh\r\nCharging Time: 1.5 hours\r\nPlay Time : 20 hrs\r\n\r\nWarranty\r\n\r\nDomestic Warranty : 1 Year\r\nWarranty Summary : 1 Year Warranty from the Date of Purchase\r\nWarranty Service Type : Reach out to us at info@imaginemarketingindia.com/+912249461882/support.boat-lifestyle.com. Alternatively you can activate your warranty by giving a missed call on 9223032222\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage', 1999, 'boAt Airdopes 381 Bluetooth Headset  (Active Black, True Wireless).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:36:59'),
(32, 'Bentag y1 champ Wired Headset  (Black, In the Ear)', 'General\r\n\r\nModel Name : y1 champ\r\nColor : Black\r\nHeadphone Type : In the Ear\r\nInline Remote : Yes\r\nSales Package : 1 Earphone\r\n\r\nConnectivity :\r\n\r\nWired : Headphone Design\r\nFlatwire : Product Details\r\nSweat Proof : No\r\nFoldable/Collapsible : Yes\r\nDeep Bass : Yes\r\nWater Resistant : No\r\nWith Microphone : Yes\r\n\r\nDimensions :\r\n\r\nCord Length : 1.2 m\r\n\r\nWarranty :\r\n\r\nCovered in Warranty : Manufacturing defect only\r\nNot Covered in Warranty : Damage or repaired\r\n\r\nMore Details\r\n\r\nGeneric Name : Headphones\r\nCountry of Origin : India', 149, 'Bentag y1 champ Wired Headset  (Black, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:40:56'),
(33, 'boAt BassHeads 100 Wired Headset  (Taffy Pink, In the Ear)', 'General :\r\n\r\nModel Name : BassHeads 100 / Bassheads 110\r\nColor : Taffy Pink\r\nHeadphone Type : In the Ear\r\nInline Remote : No\r\nSales Package : Bassheads 100, Additional Earbuds, Warranty Card\r\nConnectivity : Wire \r\nHeadphone Design: Flatwire\r\n\r\nProduct Details :\r\n\r\nSweat Proof : Yes\r\nDeep Bass : Yes\r\nWater Resistant : No\r\nWith Microphone : Yes\r\n\r\nDimensions  :\r\n\r\nWidth : 15 mm\r\nDepth : 5 mm\r\nWeight : 0.3\r\n\r\nWarranty :\r\n\r\nDomestic Warranty : 1 Year\r\nWarranty Summary : 1 Year\r\nWarranty Service Type : Carry in to service centre or reach out to us at info@imaginemarketingindia.com/+912249461882/support.boat-lifestyle.com. Alternatively you can activate your warranty by giving a missed call on 9223032222\r\nCovered in Warranty : manufacturing defect\r\nNot Covered in Warranty : Physical Damage', 399, 'boAt BassHeads 100 Wired Headset  (Taffy Pink, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:43:53'),
(34, 'boAt Bassheads 242 Wired Headset  (Active Black, In the Ear)', 'General\r\n\r\nModel Name : Bassheads 242\r\nColor : Active Black\r\nHeadphone Type : In the Ear\r\nInline Remote : No\r\nSales Package : Bassheads 242, Extra Earbuds, Carry Pouch, Warranty Card\r\nConnectivity : Wired\r\nHeadphone Design  : Ear Clip\r\nAccessories Included : Warranty Card\r\n : Product Details\r\n\r\nSweat Proof : Yes\r\nFoldable/Collapsible : Yes\r\nDeep Bass : Yes\r\nWater Resistant : Yes\r\nMonaural : Yes\r\nDesigned For : ios, Android, Windows\r\nSeries : Bassheads\r\nConnector Size  : 3.5 mm\r\nControls : Volume\r\nWith Microphone : Yes', 549, 'boAt Bassheads 242 Wired Headset  (Active Black, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:47:39'),
(35, 'boAt Rockerz 235v2 with ASAP charging Version 5.0 Bluetooth Headset  (Black, In the Ear)', 'General\r\n\r\nModel Name : Rockerz 235v2\r\nColor : Black\r\nHeadphone Type : In the Ear\r\nInline Remote : Yes\r\nSales Package : Rockerz 235v2, Additional Earbuds(S&L), Micro USB Charging Cable, Manual, Warranty Card\r\nConnectivity : Bluetooth\r\nHeadphone Design : Earwings\r\n\r\nProduct Details\r\n\r\nSweat Proof : Yes\r\nDeep Bass : Yes\r\nWater Resistant : Yes\r\nDesigned For : All Smartphones\r\nWith Microphon : \r\nYes : Sound Features\r\nOther Sound Features : HD Sound\r\n\r\nConnectivity Features\r\n\r\nWireless Type : Bluetooth\r\nBluetooth Version : 5.0\r\nBluetooth Range : 10 m\r\nOther Power Features : Fast Charging Technology', 1199, 'boAt Rockerz 235v2 with ASAP charging Version 5.0 Bluetooth Headset  (Black, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:50:29'),
(36, 'JBL C150SI Wired Headset  (Black, In the Ear)', 'General\r\n\r\nModel Name : C150SIUBLK\r\nColor\r\nBlack\r\nHeadphone Type\r\nIn the Ear\r\nInline Remote : No\r\nSales Package : 1 pair JBL C150SI headphones 3 sets of ear tips (S, M, L) 1 Warranty and safety card\r\n\r\nConnectivity\r\n\r\nWired : Type\r\nDynamic : Product Details\r\nSweat Proof : No\r\nDeep Bass : Yes\r\nWater Resistant : No\r\nDesigned For : iOS, Android, Window, Other Aux Support Devices\r\nSystem Requirements 3.5MM Audio Port\r\nConnector Size : 3.5 mm\r\n\r\nOther Features\r\n\r\nOne-button univer  : al remote with Noise cancelling microphone: Answer and manage your calls effortlessly, with the touch of a button, Compatible With Android and iOS devices (Mobile, Tablet, Laptop & Audio Player)\r\nWith Microphone : Yes\r\n\r\nSound Features\r\n\r\nMinimum Frequency Response : 20000 HZ\r\nMaximum Frequency Response : 20 HZ\r\n\r\nDimensions\r\n\r\nCord Length : 1.2 m\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1Year JBL Warrant\r\nCovered in Warranty : Manufacturing Defect\r\nNot Covered in Warranty : Physical Damage', 699, 'JBL C150SI Wired Headset  (Black, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:53:47'),
(37, 'OnePlus Bullets Wireless Z Bass Edition Bluetooth Headset  (Bass Blue, In the Ear)', 'General\r\n\r\nModel Name : E304A\r\nColor : Bass Blue\r\nHeadphone Type : In the Ear\r\nInline Remote : Yes\r\nSales Package : Wireless Earphone, Type C Cable, Earplug, User Guide, Membership Card\r\n\r\nConnectivity\r\n\r\nBluetooth : Headphone Design\r\nBehind the Neck : Product Details\r\nSweat Proof : Yes\r\nDeep Bass : Yes\r\nWater Resistant : Yes\r\nMonaural : No\r\nWith Microphone : Yes\r\n\r\nConnectivity Features\r\n\r\nWireless Type : Bluetooth\r\nBluetooth Version : 5\r\n\r\nWarranty\r\n\r\nDomestic Warranty : 1 Year\r\nWarranty Summary : 1 Year Warranty on Product\r\nWarranty Service Type : Carry-in\r\nCovered in Warranty : Manufcaturing Defects\r\nNot Covered in Warranty : Physical Damage', 1999, 'OnePlus Bullets Wireless Z Bass Edition Bluetooth Headset  (Bass Blue, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:56:47'),
(38, 'OnePlus Bullets Wireless Z Bass Edition Bluetooth Headset  (Reverb Red, In the Ear)', 'General\r\n\r\nModel Name : E304A\r\nColor : Reverb Red\r\nHeadphone Type : In the Ear\r\nInline Remote : Yes\r\nSales Package : Wireless Earphone, Type C Cable, Earplug, User Guide, Membership Card\r\nConnectivity : Bluetooth\r\nHeadphone Design : Behind the Neck\r\n\r\nProduct Details\r\n\r\nSweat Proof : Yes\r\nDeep Bass : Yes\r\nWater Resistant : Yes\r\nMonaural : No\r\nWith Microphone : Yes\r\n\r\nConnectivity Features\r\n\r\nWireless Type : Bluetooth\r\nBluetooth Version : 5\r\n\r\nWarranty\r\n\r\nDomestic Warranty : 1 Year\r\nWarranty Summary : 1 Year Warranty on Product\r\nWarranty Service Type : Carry-in\r\nCovered in Warranty : Manufcaturing Defects\r\nNot Covered in Warranty : Physical Damage', 1999, 'OnePlus Bullets Wireless Z Bass Edition Bluetooth Headset  (Reverb Red, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 11:58:51'),
(39, 'realme Buds Classic RMA2001 Wired Earphones with HD Microphone Wired Headset  (Black, In the Ear)', 'General\r\n\r\nModel Name : Buds Classic RMA2001 Wired Earphones with HD Microphone\r\nColor : Black\r\nHeadphone Type : In the Ear\r\nInline Remote : Yes\r\nSales Package : 1 N Earphone\r\nConnectivity : Wired\r\nHeadphone Design : Canalphone\r\n\r\nProduct Details\r\n\r\nSweat Proof : Yes\r\nFoldable/Collapsible : Yes\r\nDeep Bass : Yes\r\nMonaural : Yes\r\nDesigned For : All Smartphones, Tablets, Laptop, Audio Players\r\nConnector Size : 3.5 mm\r\nDriver Type : 14.2mm Large\r\nControls : Music And Calls Control\r\nOther Features : Cable Organizer - The built-in cable organizer makes sure that your earbuds stay organized and do not get tangled., HD Microphone - The realme Buds Classic features an in-line HD microphone which you can use for calling and voice assistant.\r\nHeadphone Driver Units : 14.2 mm\r\nCord Type : Flat Cable\r\nWith Microphone : Yes\r\n\r\nSound Features\r\n\r\nOther Sound Features : 14.2mm Large Driver The realme Buds Classic features a large 14.2mm driver for an excellent sound quality, which makes the bass deeper and vocals clearer. : Dimensions\r\nWidth : 1.8 mm\r\nHeight : 1.4 mm\r\nDepth : 126 mm\r\nWeight : 14\r\nCord Length : 1.26 m\r\n\r\nWarranty\r\n\r\nDomestic Warranty : 6 Months\r\nWarranty Summary : 6 months warranty\r\nWarranty Service Type : Customer To Bring The Product At Service Center\r\nCovered in Warranty : Internal Fault\r\nNot Covered in Warranty : Physical Damage', 399, 'realme Buds Classic RMA2001 Wired Earphones with HD Microphone Wired Headset.jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 12:10:26'),
(40, 'realme Buds Q Bluetooth Headset  (Black, True Wireless)', 'General\r\n\r\nModel Name : RMA216\r\nColor : Black\r\nHeadphone Type : True Wireless\r\nInline Remote : No\r\nSales Package : 1 Pair of Earbuds, Charging Case, Charging Cable, 3 Sets of Ear Tips (S/M/L), User Manual and Warranty Card\r\nConnectivity : Bluetooth\r\nHeadphone Design : Earbud\r\n\r\nProduct Details\r\n\r\nSweat Proof : Yes\r\nDeep Bass : Yes\r\nWater Resistant : Yes\r\nHeadphone Driver Units : 10 mm\r\nWith Microphone : Yes\r\n\r\nSound Features : \r\n\r\nAudio Codec : AAC\r\n\r\nConnectivity Features\r\n\r\nBluetooth Version : 5\r\nBluetooth Range : 10 m\r\nBattery Life : 20 hrs\r\nBattery Capacity : 400 mAh\r\nPlay Time : 20 hrs\r\n\r\nWarranty\r\n\r\nWarranty Summary : 12 Months\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage', 1999, 'realme Buds Q Bluetooth Headset  (Black, True Wireless).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 12:08:06'),
(41, 'SAMSUNG Level U2 With Type-C Charging Bluetooth Headset  (Blue, In the Ear)', 'General\r\n\r\nModel Name : Level U2 EO-B3300\r\nColor : Blue\r\nHeadphone Type : In the Ear\r\nInline Remote : No\r\nSales Package ; 1 Bluetooth Stereo Headset, Eartip 3 Set (S, L, Wing Tip), Quick Guide Manual\r\nConnectivity : Bluetooth\r\nHeadphone Design : Behind the Neck\r\n\r\nProduct Details\r\n\r\nSweat Proof : Yes\r\nDeep Bass : No\r\nWater Resistant : Yes\r\nMonaural : Yes\r\nSeries : Level\r\nOther Features : 12 mm Dynamic Speakers (Hybrid Open Type)\r\nWith Microphone : Yes\r\n\r\nSound Features :\r\n \r\nOther Sound Features : High-quality Sound, Seamless Play \r\n\r\nConnectivity Features\r\n\r\nBluetooth Version : 5\r\nBattery Capacity : 159 mAh\r\nPlay Time : 18 hrs\r\nStandby Time : 500 hrs\r\n\r\nDimensions\r\n\r\nWidth : 19.48 mm\r\nHeight : 170.83 mm\r\nDepth : 146 mm\r\nWeight : 41.5 g\r\n\r\nWarranty\r\n\r\nDomestic Warranty : 1 Year\r\nWarranty Summary : 1 Year Domestic Warranty\r\nWarranty Service Type : Carry-in\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage', 2199, 'SAMSUNG Level U2 With Type-C Charging Bluetooth Headset  (Blue, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 12:19:05'),
(42, 'U&I Titanic Series - Low Price Bluetooth Neckband Bluetooth Headset  (Black, In the Ear)', 'Genaral\r\n\r\nModel Name : Virus Series Bluetooth Earphone - 6 Hours Battery Back Up\r\nColor : Black\r\nHeadphone Type : In the Ear\r\nInline Remote : Yes\r\nSales Package : 1 Headphone\r\nConnectivity : Bluetooth\r\nHeadphone Design : Behind the Neck\r\nAccessories Included : Warranty Card\r\n\r\nProduct Details\r\n\r\nSweat Proof : No\r\nFoldable/Collapsible : Yes\r\nDeep Bass : Yes\r\nWater Resistant : No\r\nMonaural : No\r\nWith Microphone : Yes\r\n\r\nConnectivity Features\r\n\r\nWireless Range : 10 m\r\nBluetooth Version : 5.0\r\nBluetooth Range : 10 m\r\nBattery Life : 6 hr\r\nBattery Capacity : 80 mAh\r\nCharging Time : 1.5 hours\r\nPlay Time : 5 hr\r\n\r\nWarranty\r\n\r\nWarranty Summary : 7 days replacement for manufacturing defects\r\nCovered in Warranty : Manufecturing defects\r\nNot Covered in Warranty : Liquid damage or physical damage', 399, 'U&I Titanic Series - Low Price Bluetooth Neckband Bluetooth Headset  (Black, In the Ear).jpeg', 3, 14, 0, '', '', '', 1, '2021-05-10 12:22:13'),
(43, 'boAt BassHeads 900 Wired Headset  (Carbon Black, On the Ear)', 'General\r\n\r\nModel Name : BassHeads 900/Bassheads 910\r\nColor : Carbon Black\r\nHeadphone Type : On the Ear\r\nInline Remote : Yes\r\nSales Package : Bassheads 900, Warranty Card\r\nConnectivity : Wired\r\nHeadphone Design : Foldable Over the Head\r\n\r\nProduct Details\r\n\r\nSweat Proof : Yes\r\nFoldable/Collapsible : Yes\r\nDeep Bass : Yes\r\nWater Resistant : No\r\nDesigned For : Music Lovers\r\nSeries : BassHeads\r\nWith Microphone : Yes\r\n\r\nDimensions\r\n\r\nWeight : 180 g\r\nCord Length : 1.2 m\r\n\r\nWarranty\r\n\r\nDomestic Warranty : 1 Year\r\nWarranty Summary : 1 Year Brand Warranty\r\nWarranty Service Type : Carry in to service centre or reach out to us at info@imaginemarketingindia.com/+912249461882/support.boat-lifestyle.com. Alternatively you can activate your warranty by giving a missed call on 9223032222\r\nCovered in Warranty : Technical & Manufacturing Defects\r\nNot Covered in Warranty : Physical, Water Damange', 674, 'boAt BassHeads 900 Wired Headset  (Carbon Black, On the Ear).jpeg', 3, 15, 0, '', '', '', 1, '2021-05-10 12:25:37'),
(44, 'boAt Rockerz 450 Bluetooth Headset  (Luscious Black, On the Ear)', 'General\r\n\r\nModel Name : Rockerz 450\r\nColor : Luscious Black\r\nHeadphone Type : On the Ear\r\nInline Remote : Yes\r\nSales Package : Rockerz 450, Charging Cable, User Manual, Warranty Card\r\n\r\nConnectivity\r\n\r\nBluetooth : Headphone Design\r\nFoldable Over the Head : Product Details\r\nFoldable/Collapsible :Yes\r\nDeep Bass : Yes\r\nWater Resistant : No\r\nDesigned For : Android, iOS\r\nWith Microphone : Yes\r\n\r\nConnectivity Features\r\n\r\nBattery Life : 15 hr\r\nCharging Time : 3\r\n\r\nWarranty\r\n\r\nDomestic Warranty : 1 Year\r\nWarranty Summary : 1 Year from the date of purchase\r\nWarranty Service Type : Carry in to service centre or reach out to us at info@imaginemarketingindia.com/+912249461882/support.boat-lifestyle.com. Alternatively you can activate your warranty by giving a missed call on 9223032222\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Accidental and Liquid Damages', 1499, 'boAt Rockerz 450 Bluetooth Headset  (Luscious Black, On the Ear).jpeg', 3, 15, 0, '', '', '', 1, '2021-05-10 12:28:15'),
(46, 'I-Kool Extra Bass & Crisp Sound Over the Head Headphones Wired Headset  (Black, Wired over the head)', 'General\r\n\r\nModel Name : Extra Bass & Crisp Sound Over the Head Headphones\r\nColor : Black\r\nHeadphone Type : Wired over the head\r\nInline Remote : No\r\nSales Package : Extra Bass & Crisp Sound Over the Head Headphones\r\nConnectivity : Wired\r\nHeadphone Design : Over the Head\r\n\r\nProduct Details\r\n\r\nDeep Bass : Yes\r\nWith Microphone : Yes\r\n\r\nWarranty\r\n\r\nCovered in Warranty : NA', 3755, 'IKool Extra Bass and Crisp Sound Over the Head Headphones Wired Headset.jpeg', 3, 15, 0, '', '', '', 1, '2021-05-10 12:40:41'),
(47, 'HP v150W PENDRIVE 64 GB Pen Drive  (Blue, Black)', 'General\r\n\r\nSales Package : 1 pen drive\r\nModel Name : v150W PENDRIVE\r\nOpening Mechanism : Sliding Capless\r\nPart Number : HPFD150W 64\r\n\r\nWarranty\r\n\r\nCovered in Warranty : Manufacturing defects\r\nWarranty Service Type : 2 years manufacturing warranty\r\nNot Covered in Warranty : physical damages\r\nWarranty Summary : 2 Years Limited Warranty\r\nInternational Warranty : 0 Year\r\nDomestic Warranty : 2 Year', 865, 'HP v150W PENDRIVE 64 GB Pen Drive  (Blue, Black).jpeg', 3, 25, 0, '', '', '', 1, '2021-05-10 12:50:22'),
(48, 'HP V236w 32 GB Pen Drive  (Silver)', 'General\r\n\r\nSales Package : 1 Pendrive\r\nModel Name : V236w\r\nRead Speed : Upto 20 MB/ \r\nWrite Speed : Up to 4MB/s\r\nPart Number : HPFD236W-32\r\nWeight : 6.4 g\r\nOther Features : Plug & Play\r\n\r\nWarranty\r\n\r\nCovered in Warranty : Limited Warranty\r\nWarranty Service Type : Customer need to come service centre\r\nNot Covered in Warranty : Physically damage\r\nWarranty Summary : 1 Year limited from the date of purchase\r\nDomestic Warranty : 1 Year', 415, 'HP V236w 32 GB Pen Drive  (Silver).jpeg', 3, 25, 0, '', '', '', 1, '2021-05-10 12:52:20'),
(49, 'Sandisk Cruzer Blade 32 GB  (Black, Red)', 'General\r\n\r\nSales Package : 1\r\nModel Name : Cruzer Blade USB Flash Drive 2.0\r\n\r\nWarranty\r\n\r\nWarranty Service Type : Service Center\r\nNot Covered in Warranty : Physical Damage', 520, 'Sandisk Cruzer Blade 32 GB  (Black, Red).jpeg', 3, 25, 0, '', '', '', 1, '2021-05-10 12:53:57'),
(50, 'SanDisk SDDDC4-128G-I35 128 GB OTG Drive  (Silver, Type A to Type C)', 'General \r\nUSB 3.1|128 GB\r\nMetal\r\nFor Mobile, Laptop, Desktop Computer\r\nColor : Silver\r\nSales Package : 1 PENDRIVE\r\nModel Name : SDDDC4-128G-I35', 1667, 'SanDisk SDDDC4-128G-I35 128 GB OTG Drive  (Silver, Type A to Type C).jpeg', 3, 25, 0, '', '', '', 1, '2021-05-10 12:56:36'),
(51, 'SanDisk Ultra Dual Drive M3.0 32 GB OTG Drive  (Black, Type A to Micro USB)', 'General\r\n\r\nSales Package : 1 PenDrive\r\nModel Name : Ultr Dual 32GB USB M3.0 OTG Pen Drive (Black)\r\nOpening Mechanism : Retractable\r\nRead Speed : 150 MB/s\r\nWrite Speed : Write Speeds Vary By Drive Capacity\r\nSupported OS : Windows Vista, Windows 7, Windows 8, Windows 10, Mac OS X v10.6 and Higher\r\nPart Number : SDDD3-032G-I35\r\nWeight : 200 g\r\nOther Dimensions : 15*25*5\r\n\r\nWarranty\r\n\r\nWarranty Service Type : Manufacture Warranty\r\nNot Covered in Warranty : Physically Damaged\r\nInternational Warranty : 5 Year\r\nDomestic Warranty : 5 Year', 610, 'SanDisk Ultra Dual Drive M3.0 32 GB OTG Drive  (Black, Type A to Micro USB).jpeg', 3, 25, 0, '', '', '', 1, '2021-05-10 12:58:32'),
(52, 'APPLE MHJD3HN A 20 W 3 A Mobile Charger  (White)', 'General\r\n\r\nSales Package : 1 Adapter\r\nModel Number : MHJD3HN/A\r\nModel Name : MHJD3HN/A\r\nOutput Interface : USB Type-C\r\nNumber Of Devices/Batteries Charged : 1\r\nNumber Of Charger Pins : 1\r\n\r\nPower Features\r\n\r\nOutput Current : 3 A\r\nOutput Wattage  : 20 W\r\n\r\nWarranty\r\n\r\nCovered in Warranty : Manufacturing Defects\r\nWarranty Summary : 1 Year Warranty', 1900, 'APPLE MHJD3HN A 20 W 3 A Mobile Charger  (White).jpeg', 3, 24, 0, '', '', '', 1, '2021-05-10 13:03:01'),
(53, 'Mi MDY-09-EJ 10 W 2 A Mobile Charger with Detachable Cable  (Black, Cable Included)', 'General\r\n\r\nSales Package : 1 Charger, USB Cable\r\nModel Number : MDY-09-EJ\r\nOutput Interface : Micro USB Pin\r\nNumber Of Devices/Batteries Charged : 1\r\nCable Length : 1.2 m\r\nOther Features : Round Design, 10 W Fast Charging, Sturdy Design, Up to 2A Fast Charging\r\n\r\nPower Features\r\n\r\nOutput Current : 2 A\r\nOutput Wattage : 10 W\r\n\r\nWarranty\r\n\r\nDomestic Warranty : 6 Months', 600, 'Mi MDY-09-EJ 10 W 2 A Mobile Charger with Detachable Cable  (Black, Cable Included).jpeg', 3, 24, 0, '', '', '', 1, '2021-05-10 13:05:22'),
(54, 'SAMSUNG Travel Adapter A13IWEUGIN 2 A Mobile Charger with Detachable Cable  (White, Cable Includ)', 'General\r\n\r\nSales Package : Travel Adapter\r\nSeries : NA\r\nModel Number : Travel Adapter EP-TA13IWEUGIN\r\nModel Name : 0\r\nOutput Interface : Micro UBB\r\nDisplay : No\r\nCertifications : NA\r\nBattery Type : LI-ION\r\nNumber Of Devices/Batteries Charged : 1\r\nNumber Of Charger Pins : 2\r\nCable Length : 1 m\r\nWidth x Height x Depth : 0 mm x 0 mm x 0 mm\r\nWeight : 0 g\r\nOther Dimensions : NA\r\nOther Features : NA\r\nCable Type : Detachable Cable Included\r\n\r\nPower Features\r\n\r\nPower Input : 0\r\nPower Source : USB\r\nPower Requirement : 0\r\nCharging Time : 5hr\r\nOutput Current : 2 A\r\nOutput Wattage : 0 W\r\nOther Power Features : NA\r\n\r\nWarranty\r\n\r\nCovered in Warranty : Manufacturing Defects\r\nWarranty Service Type : ON-SITE SERVICESE\r\nNot Covered in Warranty : Physical Damage\r\nWarranty Summary : 0\r\nInternational Warranty : 6 Month\r\nDomestic Warranty : 6 Month', 649, 'Samsung charger.jpeg', 3, 24, 0, '', '', '', 1, '2021-05-10 13:16:58'),
(55, 'Syska WC-3AD-WH 15.5 W 3.1 A Multiport Mobile Charger with Detachable Cable  (White, Cable Included)', 'General\r\n\r\nSales Package : Wall Charger, Micro USB Charging Cable, User Manual, Warranty Card\r\nModel Number : WC-3AD-WH\r\nOutput Interface : Micro USB\r\nConnector Type : Micro USB Cable\r\nNumber Of Devices/Batteries Charged : 2\r\nDesigned For : Tablets, Mobiles\r\nCable Length : 1 m\r\nWidth x Height x Depth : 40 mm x 20 mm x 70 mm\r\nWeight : 40 g\r\nOther Features : Dual USB Adapter with Smart IC, Overload, Over Current, Short Circuit : Protection, Fire Retardant Housing and PCB\r\n\r\nPower Features\r\n\r\nPower Input : AC 90 - 300 V, 50/60 Hz\r\nPower Output : DC 5 V, 3.1 A\r\nOutput Current : 3.1 A\r\nOutput Wattage : 15.5 W\r\n\r\nWarranty\r\n\r\nCovered in Warranty : Manufacturing Defects\r\nWarranty Service Type : Customer Needs to Call Service Center (Toll Free: 1800-102-8787)\r\nNot Covered in Warranty : Physical and Electrical Damages\r\nWarranty Summary ; 6 Months Warranty\r\nDomestic Warranty : 6 Months', 649, 'Syska  Multiport Mobile Charger with Detachable Cable  (White, Cable Included).jpeg', 3, 24, 0, '', '', '', 1, '2021-05-10 13:16:21'),
(56, 'ALPRA SMART 10000 mAh Power Bank (18 W, Fast Charging)  (Black, Lithium Polymer)', 'General\r\n\r\nSales Package : 1 Power Bank, 1 USB to Micro USB Cable, 1 C to C Fast Charging Cable, User manual\r\nModel Name : ALPRA FAST 10\r\nSuitable Device : Mobile\r\nNumber of Output Ports : 2\r\nCharging Cable Included : YES\r\nPower Supply : Input 5V/2.1A, Input Type-C 5V/3A, 9V/2A, 12V/1.5A, 18W max\r\nOutput Power : Output 1: USB-A 5V/3A, 9V/2A, 12V/1.5A, 18W max, Output 2: Type-C 5V/3A, 9V/2A, : 12V/1.5A, 18W max\r\nType : Wired\r\nOther Features : This power bank is compatible with a wide range of phones like MI,REALME,REDMI,ONEPLUS, OPPO,VIVO, SAMSUNG,MOTO,APPLE, tablets, music players, Laptops and other USB, Type C chargeable devices., Support smart power management.\r\nWidth : 137 mm\r\nHeight : 65 mm\r\nDepth : 15 mm\r\nWeight : 220 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Manufacturer Warranty\r\nWarranty Service Type : Customer Need to Call Service number (+91 9975393969) Monday To Saturday 10:00 AM \r\n To 07:00 PM\r\nCovered in Warranty : Manufacturing Defects Only\r\nNot Covered in Warranty : Physical and Electrical Damages Not Covered\r\nDomestic Warranty : 1 Year\r\nInternational Warranty : 1 Year\r\n', 749, 'ALPRA SMART 10000 mAh Power Bank (18 W, Fast Charging)  (Black, Lithium Polymer).jpeg', 3, 22, 0, '', '', '', 1, '2021-05-10 13:21:40');
INSERT INTO `product` (`product_id`, `product_name`, `product_detail`, `product_price`, `product_image`, `category_id`, `sub_category_id`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `status`, `added_on`) VALUES
(57, 'Ambrane 10000 mAh Power Bank (12 W, Fast Charging)  (Black, Lithium Polymer)', 'General\r\n\r\nSales Package : User Manual, Warranty Card, Flat USB Cable\r\nModel Name : Power bank\r\nSuitable Device : Mobile\r\nNumber of Output Ports : 2\r\nCharging Cable Included : Yes\r\nPower Supply : 5V / 2.1A\r\nOutput Power : 5V / 2.4A\r\nWidth : 6.9 mm\r\nDepth : 13.5 mm\r\nWeight : 187 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 06 month Manufacturer Warranty\r\nWarranty Service Type : Repair\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : - Liquid damage, force damage, damage due to misuse, wear and tear, user inflicted damage, : infestation, mould or mildew . Force majeure\r\nDomestic Warranty : 6 Months', 699, 'Ambrane 10000 mAh Power Bank (12 W, Fast Charging)  (Black, Lithium Polymer).jpeg', 3, 22, 0, '', '', '', 1, '2021-05-10 13:34:34'),
(58, 'Mi 3i 20000 mAh Power Bank (Fast Charging, 18W)  (Black, Lithium Polymer)', 'General\r\n\r\nSales Package : 1 Power Bank, 1 USB Cable and 1 User Manual\r\nModel Name :P Power Bank\r\nSuitable Device : Mobile\r\nNumber of Output Ports : 2\r\nCharging Cable Included : Yes\r\nPower Supply : USB-C: 5 V/3 A, 9 V/2 A, 12 V/1.5 A, Micro-USB: 5 V/2 A, 9 V/2 A, 12 V/1.5 A\r\nOutput Power : USB-A: 5 V/2.4 A, 9 V/2 A, 12 V/1.5 A, USB-C: 5 V/3 A, 9 V/2 A, 12 V/1.5 A, Triple Port: 5 V/3.6 A\r\nOther Features : Power Delivery, Smart Power Management\r\nWidth : 72.2 mm\r\nHeight : 150.6 mm\r\nDepth : 26.3 mm\r\nWeight : 434 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : Domestic warranty\r\nWarranty Service Type : Carry in\r\nCovered in Warranty : Manufacturing defect\r\nNot Covered in Warranty : Physical Damages, Wear and Tear\r\nDomestic Warranty : 6 Months', 1599, 'Mi 3i 20000 mAh Power Bank (Fast Charging, 18W)  (Black, Lithium Polymer).jpeg', 3, 22, 0, '', '', '', 1, '2021-05-10 13:37:12'),
(59, 'Pomics 30000 mAh Power Bank  (Orange, Lithium-ion)', 'General\r\n\r\nSales Package : 1 Power Bank\r\nModel Name :P High Speed\r\nSuitable Device :P Mobile\r\nNumber of Output Ports : 3\r\nCharging Cable Included : Yes\r\n\r\nWarranty\r\n\r\nWarranty Summary : Off Site 3 Months\r\nWarranty Service Type : Repair Or Replacement\r\nCovered in Warranty : manufacturing sefect\r\nNot Covered in Warranty : mishandled or damaged', 600, 'Pomics 30000 mAh Power Bank  (Orange, Lithium-ion).jpeg', 3, 22, 0, '', '', '', 1, '2021-05-10 13:39:28'),
(60, 'realme 20000 mAh Power Bank (18 W, Quick Charge 2.0)  (Black, Lithium Polymer)#JustHere', 'General\r\n\r\nSales Package : 1 Power Bank, USB Type-C Cable, User Manual\r\nModel Name : Power Bank\r\nSuitable Device : Mobile\r\nNumber of Output Ports : 3\r\nCharging Cable Included\r\nYes\r\nWidth\r\n72 mm\r\nHeight : 150 mm\r\nDepth : 27.5 mm\r\nWeight : 495 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Warranty\r\nWarranty Service Type : Carry-in\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage\r\nDomestic Warranty : 1 Year\r\nInternational Warranty : 0 Year', 1599, 'realme 20000 mAh Power Bank (18 W, Quick Charge 2.0)  (Black, Lithium Polymer).jpeg', 3, 22, 0, '', '', '', 1, '2021-05-10 13:41:29'),
(61, 'Syska 10000 mAh Power Bank (10 W, Fast Charging)  (Black, Lithium Polymer)', 'General\r\n\r\nSales Package : Power Bank, Micro USB Cable, User Manual, Warranty Card\r\nModel Name : Pro 200-\r\nSuitable Device : Mobile\r\nNumber of Output Ports : 2\r\nCharging Cable Included : YES\r\nPower Supply :\" AC 5V 2A\r\nOutput Power : DC 5V 2.1A, DC 5V 1A\r\nWidth : 82 mm\r\nHeight : 158 mm\r\nDepth : 23 mm\r\nWeight : 403 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 6 Months Manufacturer Warranty\r\nWarranty Service Type : Customer Needs to Call Service Center (Toll Free: 1800-102-8787)\r\nCovered in Warranty : Warranty for Manufacturing Defects Only\r\nNot Covered in Warranty : Physical and Electrical Damages Not Covered\r\nDomestic Warranty : 6 Months\r\nInternational Warranty : 6 Months', 1299, 'Syska 10000 mAh Power Bank (10 W, Fast Charging)  (Black, Lithium Polymer).jpeg', 3, 22, 0, '', '', '', 1, '2021-05-10 13:43:33'),
(62, 'boAt Storm Smartwatch  (Blue Strap, Regular)', '3.3 cms(1.3 inches) Full Touch Screen Curved Display with Multiple Cloud Based Watch Faces (Note: Cloud Based Watch Faces will be Available via OTA Post Launch)\r\nWellness Mode: Spo2 (Real-time Blood Oxygen Level Monitor), 24x7 Heart Rate Monitor, Sleep monitor, Guided Breathing & Menstruation Tracker\r\nMetal Body Casing and 5ATM Water Resistance\r\nDaily Activity Tracker and 9 sports Modes | Notifications with Vibration Alerts for Calls, Texts, Social media, Alarms and Sedentary Alerts\r\nTouchscreen\r\nFitness & Outdoor\r\nBattery Runtime: Upto 8 days\r\n\r\nGeneral\r\n\r\nSales Package : Smartwatch, USB Magnetic Charging Cable, User Manual, Warranty Card\r\nModel Number : Storm\r\nModel Name : Storm\r\nDial Shape : Square\r\nStrap Color : Blue\r\nStrap Material : Thermo Plastic Polyurethene\r\nSize : Regular\r\nTouchscreen : Yes\r\nWater Resistant : Yes\r\nWater Resistance Depth : 50 m\r\nUsage : Fitness & Outdoor\r\nIdeal For : Men & Women\r\n\r\nProduct Details\r\n\r\nClosure : Strap Buckle\r\nSensor : Accelerometer, Optical Heart Rate Sensor, G-sensor\r\nCompatible Device : iPhone with iOS 8.0 or Above, Android 4.4 or Higher\r\nNotification : Yes\r\nNotification Type : Vibration\r\nBattery Type : Lithium Polymer\r\nBattery Life : Upto 8 to 10 Days (Based on Usage)\r\nRechargeable Battery : Yes\r\nOther Features : Multi Sport Mode | Music Control\r\n\r\nPlatform And Storage Features \r\n\r\nCompatible Operating System : Android & iOS\r\n\r\nConnectivity Features\r\n\r\nCall Function : No\r\nBluetooth : Yes\r\nBluetooth Version : v4.2\r\n\r\nCamera And Display Features\r\n\r\nDisplay Resolution : 240 x 240 Pixels\r\nDisplay Size : 1.3 inch\r\nOther Display Features : 2.5D Curved Display\r\n\r\nFitness And Watch Functions\r\n\r\nCalorie Count : Yes\r\nStep Count : Yes\r\nHeart Rate Monitor : Yes\r\nOther Fitness Features : Activity Tracker (Distance, Steps, Calories Burned, Heart Rate, Sleep, Blood Oxygen Level, Menstruation Cycle), Multiple Sports Mode: Running, Hiking, Riding, Rreadmill, Climbing, Spinning, Yoga\r\nDate & Time Display : Yes\r\nCalendar : Yes\r\nAlarm Clock : Yes\r\nLanguage : English\r\nOther Watch Functions : Smart Notifications (Text, Call, Email, Social Media App Alerts, Weather), Alarm Clock, Calendar Alerts, Music Control\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Warranty from the Date of Purchase\r\nWarranty Service Type : Kindly Reach Out to Us at info@imaginemarketingindia.com, +912249461882, : support.boat-lifestyle.com\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage\r\nDomestic Warranty : 1 Year', 2999, 'boAt Storm Smartwatch  (Blue Strap, Regular).jpeg', 3, 23, 0, '', '', '', 1, '2021-05-10 13:51:43'),
(63, 'FITBIT Sense Smartwatch  (Beige Strap, Regular)', 'With Call Function\r\nTouchscreen\r\nFitness & Outdoor\r\n\r\nGeneral\r\n\r\nSales Package : Smartwatch with Small Band Strap, Additional Large Band Strap, Charging Cable, Instruction Manual\r\nModel Number : FB512GLWT\r\nModel Name : Sense\r\nDial Shape : Curved\r\nStrap Color : Beige\r\nStrap Material : Elastomer\r\nSize : Regular\r\nTouchscreen : Yes\r\nWater Resistant : Yes\r\nWater Resistance Depth : 50 m\r\nUsage : Fitness & Outdoor\r\nDial Material : Stainless Steel\r\nIdeal For : Men & Women\r\n\r\nProduct Details\r\n\r\nMaximum Operating Altitude : 8534 m\r\nClosure : Loop and Peg\r\nSensor : 3-axis Accelerometer, Gyroscope, Altimeter, Built-in GPS Receiver + GLONASS, Multi-path Optical Heart Rate Sensor, Multipurpose Electrical Sensors Compatible with the ECG App and EDA Scan App, On-wrist Skin Temperature Sensor, Ambient Light Sensor\r\nCompatible Device : iOS 12.2 or Higher, Android OS 7.0 or Higher\r\nNotification : Yes\r\nNotification Type : Ringer, Vibration\r\nBattery Type : Lithium Polymer\r\nCharge Time :P 120 mins\r\nBattery Life : Upto 6 Days (Based on Usage)\r\nRechargeable Battery : Yes\r\nCharger Type : USB Cable/ 4-Pin Magnetic Charging\r\nOther Features : Google Assistant and Built-in Alexa Support, Fast Charging, Control Spotify, Take Bluetooth Calls from Wrist, Notifications, Hundreds of Apps and Clock Faces, Free Fitbit Premium Trial, Swimproof and Water-resistant\r\nPlatform And Storage Features\r\nOperating System : Proprietary OS\r\nCompatible Operating System : Android & iOS\r\n\r\nConnectivity Features\r\n\r\nCall Function : Yes\r\nBluetooth : Yes\r\nWi-Fi : Yes\r\nGPS : Yes\r\nMessaging Support : Yes\r\nBluetooth Version : v5.0\r\nEmail Support : Yes\r\nCall Features : Accept or Reject Calls, Adjust Volume, Mute Function, Send Caller to Voicemail\r\n\r\nCamera And Display Features\r\n\r\nDisplay Size : 1.59 inch\r\nDisplay Type : AMOLED\r\nBacklight Display : Yes\r\nScratch Resistant : Yes\r\nOther Display Features : Always-on AMOLED Color Display (With Brightness Control, Screen Wake, Screen Timeout)\r\n\r\nFitness And Watch Functions\r\n\r\nCalorie Count : Yes\r\nStep Count : Yes\r\nHeart Rate Monitor : Yes\r\nAltimeter : Yes\r\nOther Fitness Features : Stress Tracking with EDA Sensor, ECG App, Sleep Duration, Sleep Stages, Sleep Score, 24/7 Heart Rate, High and Low Heart Rate Notifications, Resting Heart Rate, VO2 Max, Active Zone Minutes, Skin Temperature, SpO2 Levels, Exercise Modes + SmartTrack, On-wrist Workouts, Reminders to Move, Floor Climbed, Smart Wake, Menstrual Health Tracking\r\nDate & Time Display : Yes\r\nCalendar : Yes\r\nAlarm Clock : Yes\r\nChronograph : Yes\r\nLanguage : English\r\nNumber of Buttons : 1\r\nOther Watch Functions : Smart Notifications (Text, Email, Social Media App Alerts, Calls, Calendar Events), Do Not Disturb, Sleep Mode, Focus Mode, Widget on Screen, Send Quick Replies and Voice Replies : Audio And Video Features\r\nSpeaker : Yes\r\nMicrophone : Yes\r\nVoice Control : Yes\r\n\r\nDimensions\r\n\r\nWidth : 40.4 mm\r\nHeight : 40.4 mm\r\nThickness : 12.3 mm\r\nWeight : 30 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Warranty Provided by the Manufacturer from Date of Purchase. For Our Full Return Policy, See https://www.fitbit.com/legal/returns-and-warranty. : Warranty Service Type\r\nCarry In : Covered in Warranty\r\nManufacturing Defect : \r\nNot Covered in Warranty : Physical Damage\r\nDomestic Warranty : 1 Year', 22999, 'FITBIT Sense Smartwatch  (Beige Strap, Regular).jpeg', 3, 23, 0, '', '', '', 1, '2021-05-10 13:58:49'),
(64, 'Mi Band 3  (Black Strap)', 'Up to 20 days battery life(If Automatic Heart Rate feature is turned on then expected battery life will be 3-9 days)\r\nSwim Proof - 5ATM (Water resistant Up to 50m)\r\n0.78\" OLED Touch Screen\r\nCall and Notification Alert\r\nContinuous Heart Rate Monitoring\r\nSleep Tracking & Analysis\r\nStep tracking, Idle Alert & Weather Forecast\r\nFind my phone & phone unlock feature\r\nActivity Tracking- For eg: Running, Walking, Cycling etc\r\nOLED Display\r\nWater Resistant\r\n\r\nGeneral\r\n\r\nModel Number : XMSH05HM\r\nModel Name : Band 3\r\nReading Type : Digital\r\nIdeal For : Unisex\r\nMaterial : Plastic\r\nSuitable For : Sports, Fitness\r\nTouch Enabled : Yes\r\nWater Resistant : Yes\r\nWater Resistant Rating : 5AT\r\nFunction : Show Time/Date, Alarm Clock, Display / Reject Calls, View Messages, Idle Alert, Phone Unlock, Event Reminders, Phone Locator, Weather Forecast, App Notifications, Smart Unlock\r\nIndicator Type : Vibration\r\nCompatible Devices : iPhone, Android Phones\r\nSales Package : Mi Band Sensor, Strap, Charging Cable, User Guide, Warranty Card\r\n\r\nPerformance Features\r\n\r\nActivity Tracker Present : Yes\r\nActivity Tracking Function : Monitor Heart Rate Continuously, Daily Steps Count, Calories Burned, Distance Covered, Sleep Monitoring\r\nSensor Type : 3-axis Accelerometer, PPG Heart Rate Sensor\r\nCompatible OS : Android 4.0 and IOS 7 and above\r\nHeart Rate Monitor Present : Yes\r\nShock Resistant : Yes\r\nOperating Temperature : -10 Degree C to 50 Degree C K\r\nWater-Resistant Depth : 50 m\r\n\r\nConnectivity Features\r\n\r\nWifi Enabled : No\r\nBluetooth Enabled : Yes\r\nBluetooth Version : 4.0\r\n\r\nWireless Options\r\n\r\nSync Wirelessly :  Display & Battery Features\r\nDisplay Type : OLED\r\nDisplay Resolution : 128 x 80 Pixels\r\nBacklight Present : Yes\r\nBattery Life : 20 Days\r\nBattery Type : Lithium Polymer\r\n\r\nAdditional Features\r\n\r\nSupported Apps : Mi Fit\r\nOther Battery Features : 110 mAh Li-ion Polymer Battery\r\nOther Display Features : 0.78 inch OLED Display\r\n\r\nDimensions\r\n\r\nWeight : 19 g\r\nOther Dimensions : Band Capsule: 17.9 x 46.9 x 12 mm, Strap Length: 247 mm, Adjustable Strap Length: 155 : mm to 216 mm\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Manufacturer Warranty\r\nService Type : Carry In\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage\r\nDomestic Warranty : 1 Year', 1780, 'Mi Band 3  (Black Strap).jpeg', 3, 23, 0, '', '', '', 1, '2021-05-10 14:05:39'),
(65, 'Mi Smart Band 4  (Black Strap)', 'Color AMOLED full-touch display\r\nUp to 20 days of battery life\r\n24/7 heart monitoring\r\nMusic and volume controls\r\nSwim tracking with stroke recognition\r\nAMOLED Display\r\nWater Resistant\r\n\r\nGeneral\r\n\r\nModel Number : XMSH07HM\r\nModel Name : Smart Band 4\r\nReading Type : Digital\r\nIdeal For : Unisex\r\nMaterial : Thermoplastic polyurethane (TPU)\r\nSuitable For : Health, Lifestyle\r\nTouch Enabled : Yes\r\nWater Resistant : Yes\r\nFunction : Display Time/Date, Alarm Clock, Idle Alerts, Customizable Watch Faces, Timer/Stopwatch, Notifications (Calendar, Message, Calls, Apps Notifications, Weather Forecast, Event), Phone Unlock, Music Controls on Band, Bluetooth Broadcasting, Battery Level Display, OTA Updates, Night Mode\r\nDial Shape : Rectangle\r\nIndicator Type : Vibration\r\nCompatible Devices : Android 4.4 or Above, iOS 9.0 or Above\r\nSales Package : Smart Band, Pogo Charging Dock, User Manual\r\n\r\nPerformance Features\r\n\r\nActivity Tracker Present : Yes\r\nActivity Tracking Function : Monitor Heart Rate, Daily Step Count, Distance Covered, Calorie Burned, Sleep Monitoring, Sport Functions: 6 Workout Modes (Treadmill, Exercise, Outdoor Running, Cycling, Walking, Pool Swimming)\r\nSensor Type : 3-axis Accelerometer, 3-axis Gyroscope, PPG Heart Rate Sensor, Capacitive Proximity Sensor\r\nCompatible OS : Android & iOS\r\nHeart Rate Monitor Present : Yes\r\nShock Resistant : No\r\nWater-Resistant Depth : 50 m\r\n\r\nConnectivity Features\r\n\r\nWifi Enabled : No\r\nBluetooth Enabled : Yes\r\nBluetooth Version : v5.0\r\nWireless Options : Sync Wirelessly\r\n\r\nOther Connectivity Features\r\n\r\nBluetooth Profile: BLE : Display & Battery Features\r\nDisplay Type : AMOLED\r\nDisplay Resolution : 240 x 120 Pixels\r\nBattery Life : 20 Days\r\nBattery Type : Lithium Polymer\r\nCharge Time : 2 hrs\r\n\r\nAdditional Features\r\n\r\nCertification : CE, EAC, ROHS, WEEE, KC, MIC\r\nSupported Apps : Mi Fit\r\nOther Battery Features : 135 mAh Lithium Polymer Battery\r\nOther Display Features : 0.95 inch Full Color AMOLED Display, Colour Depth: 24 bit, Screen Brightness: Upto 400 nits (Brightness Adjustable), On-cell Capacitive Touchscreen, 2.5D Tempered Glass with Anti Fingerprint Coating\r\nOther Features : Adjustable Wrist Strap Length: 155 - 216 mm\r\n\r\nDimensions\r\n\r\nWidth : 1.78 cm\r\nHeight : 4.68 cm\r\nDepth : 1.26 cm\r\nWeight : 22.1 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Limited Manufacturer Warranty\r\nService Type : Carry In\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage\r\nDomestic Warranty : 1 Year', 2099, 'Mi Smart Band 4  (Black Strap).jpeg', 3, 23, 1, 'Mi Smart Band 4  (Black Strap)', 'Color AMOLED full-touch display Up to 20 days of battery life', 'Mi Smart Band 4 ', 1, '2021-05-13 08:48:17'),
(66, 'Noise ColorFit Pro 2 Smartwatch  (Black Strap, Regular)', 'Get Upto 10 Day Battery Life with Magnetic Charger\r\nMenstrual Cycle Tracking\r\nHeart Rate Monitor\r\nIP68 Waterproof\r\nTouchscreen\r\nFitness & Outdoor\r\nBattery Runtime: Upto 10 days\r\n\r\nGeneral\r\n\r\nSales Package : netic Charger, User Manual, Warranty Card\r\nModel Number : wrb-sw-colorfitpro2-std-blk\r\nModel Name : ColorFit Pro 2\r\nDial Shape : Rectangle\r\nStrap Color : Black\r\nStrap Material : Synthetic\r\nSize : Regular\r\nTouchscreen : Yes\r\nWater Resistant : Yes\r\nWater Resistance Depth : 1.5 m\r\nUsage : Fitness & Outdoor\r\nIdeal For : Men & Women\r\n\r\nProduct Details\r\n\r\nClosure : Strap Buckle\r\nSensor : Accelerometer, Heart Rate Sensor\r\nCompatible Device : iPhone, Android Smartphones\r\nNotification : Yes\r\nNotification Type : Vibration\r\nBattery Type : Lithium Polymer\r\nCharge Time : 2 hrs\r\nBattery Life : Upto 10 Days (Based on Usage)\r\nRechargeable Battery : Yes\r\n\r\nCharger Type\r\n\r\nMagnetic Charger : Platform And Storage Features\r\nCompatible Operating System : Android & iOS\r\n\r\nConnectivity Features\r\n\r\nCall Function : No\r\nBluetooth : Yes\r\nWi-Fi : No\r\nBluetooth Version : v5.0\r\nOperating Range : 10 m\r\n\r\nCamera And Display Features\r\n\r\nDisplay Resolution : 240 x 240 Pixels\r\nDisplay Size : 33 mm\r\nDisplay Type : LCD\r\nBacklight Display : Yes\r\nScratch Resistant : Yes\r\n\r\nOther Display Features\r\n\r\nColor LCD Display : Fitness And Watch Functions\r\nCalorie Count : Yes\r\nStep Count : Yes\r\nHeart Rate Monitor : Yes\r\nOther Fitness Features : Activity Tracker (Distance, Steps, Calories Burned, Heart Rate, Sleep Monitor)\r\nDate & Time Display : Yes\r\nCalendar : Yes\r\nAlarm Clock : Yes\r\nLanguage : English\r\nNumber of Buttons : 1\r\nOther Watch Functions : Smart Notifications (Text, Email, Social Media App Alerts), Alarm Clock, Calendar Alerts, Sedentary Reminder and Goal Completion Reminder\r\n\r\nDimensions\r\n\r\nWidth :16 mm\r\nHeight : 9 mm\r\nThickness : 4 mm\r\nWeight : 35 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Manufacturer Warranty\r\nWarranty Service Type : Email | Support | Contact - help@nexxbase.com | support.gonoise.in | +91 8882132132\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage\r\nDomestic Warranty : 1 Year', 2599, 'Noise ColorFit Pro 2 Smartwatch  (Black Strap, Regular).jpeg', 3, 23, 0, '', '', '', 1, '2021-05-10 15:30:36'),
(67, 'Noise ColorFit Pro 3 Smartwatch  (Black Strap, Regular)', 'TruView Display 1.55 inch HD Color touch screen with 320*360 Resolution & 500 NITS Brightness\r\nSpo2, Stress , Sleep & Heart Rate Monitoring with 14 sports mode( with breathing exercise)\r\nCustomisable & Cloud-based Watch Faces.\r\nCompatible with NoiseFit App\r\nTouchscreen\r\nFitness & Outdoor\r\nBattery Runtime: Upto 7 days\r\n\r\nGeneral\r\n\r\nSales Package : Smartwatch, Magnetic Charger, User Manual, Warranty Card\r\nModel Number : wrb-sw-colorfitpro3-std-blk_blk\r\nModel Name : ColorFit Pro 3\r\nDial Shape : Rectangle\r\nStrap Color : Black\r\nStrap Material : Thermo Plastic Polyurethene\r\nSize : Regular\r\nTouchscreen : Yes\r\nWater Resistant : Yes\r\nWater Resistance Depth : 50 m\r\nUsage : Fitness & Outdoor\r\nDial Material : Stainless Steel\r\nIdeal For : Men & Women\r\n\r\nProduct Details\r\n\r\nClosure : Strap Buckle\r\nSensor : Accelerometer, Heart Rate Sensor, SpO2 Sensor\r\nCompatible Device : iPhone, Android Smartphones\r\nNotification : Yes\r\nNotification Type : Vibration\r\nBattery Type : Lithium Polymer\r\nCharge Time : 120 mins\r\nBattery Life : 5-7 Days\r\nRechargeable Battery : Yes\r\n\r\nCharger Type\r\n\r\nMagnetic Charge Cable : Platform And Storage Features\r\nCompatible Operating System : Android & iOS\r\n\r\nConnectivity Features\r\n\r\nCall Function : No\r\nBluetooth : Yes\r\nWi-Fi : No\r\nGPS : No\r\nBluetooth Version : v5.0\r\nOperating Range : 10 m\r\nCall Features : Mute Calls, Reject Calls\r\n\r\nCamera And Display Features\r\n\r\nDisplay Resolution :p 320 x 360 Pixels\r\nDisplay Size : 39.37 mm\r\nDisplay Type : LCD\r\nScratch Resistant : Yes\r\n\r\nOther Display Features\r\n\r\nColor LCD TruView Display : Fitness And Watch Functions\r\nCalorie Count : Yes\r\nStep Count : Yes\r\nHeart Rate Monitor :Yes\r\nOther Fitness Features : Activity Tracker (Distance, Steps, Calories Burned, Heart Rate), SpO2 Monitoring, Stress Monitoring, Breathe Guide Support, Sedentary Reminder, 14 Sports Modes\r\nDate & Time Display : Yes\r\nCalendar : Yes\r\nAlarm Clock : Yes\r\nLanguage : English\r\nNumber of Buttons : 1\r\nOther Watch Functions : Smart Notifications (Text, Email, Social Media App Alerts, Weather), Alarm Clock, Calendar Alerts, Sedentary Reminder and Goal Achieve Reminder, Hydropenia Reminder, Low Battery Reminder, Find Phone Support, Music Control\r\n\r\nAudio And Video Features\r\n\r\nSpeaker : No\r\nMicrophone : No\r\nGesture Control: Raise Wrist : Light Up Screen, Put Down: Shutdown Screen\r\n\r\nDimensions\r\n\r\nWidth : 38.83 mm\r\nHeight : 43.23 mm\r\nThickness : 10.83 mm\r\nWeight : 38.9 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Manufacturer Warranty\r\nWarranty Service Type : Contact - productfeedback@nexxbase.com | support.gonoise.com | +91 8882132132\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage\r\nDomestic Warranty : 1 Year', 4499, 'Noise ColorFit Pro 3 Smartwatch  (Black Strap, Regular).jpeg', 3, 23, 1, 'Noise ColorFit Pro 3 Smartwatch  (Black Strap, Regular)', 'Spo2, Stress , Sleep & Heart Rate Monitoring with 14 sports mode', 'Noise ColorFit Pro 3 Smartwatch  ', 1, '2021-05-13 08:47:28'),
(68, 'Realme Classic Watch  (Black Strap, Regular)', '3.5 cm (1.4 inch) Large Color Touch Screen\r\nReal Time Heart Rate Monitor | Blood Oxygen Level Monitor (SpO2) | Intelligent Activity Tracker (14 Sports Modes) | IP68 Water Resistant\r\nSmart Notifications for SMS, Calls, WhatsApp, and Other Apps\r\nUpto 9 Day Battery Life\r\nSmart Connect - Control Your Phone Camera and Music from Your Watch\r\nRealme Link App - Get All Your Fitness Data on Your Phone Seamlessly (Only for Android)\r\nTouchscreen\r\nFitness & Outdoor\r\nBattery Runtime: Upto 9 days\r\n\r\nGeneral\r\n\r\nSales Package : Smartwatch, Charging Dock, Quick Start Guide, Warranty Card\r\nModel Number : RMA161\r\nModel Name : Watch\r\nDial Shape : Square \r\nStrap Color : Black\r\nStrap Material : Thermo Plastic Polyurethene\r\nSize : Regular\r\nTouchscreen : Yes\r\nWater Resistant : Yes\r\nWater Resistance Depth : 1.5 m\r\nUsage : Fitness & Outdoor\r\nIdeal For : Men & Women\r\n\r\nProduct Details\r\n\r\nClosure : Strap Buckle\r\nSensor : 3-axis Accelerometer, Heart Rate Sensor, Rotor Vibration Motor, IP68(1.5m) Water Resistance Rating\r\nCompatible Device : Android Phones with Android 4.4 or Later\r\nNotification : Yes\r\nNotification Type : Vibration\r\nBattery Type : Lithium Polymer\r\nBattery Life : Upto 9 Days (Based on Usage)\r\nRechargeable Battery : Yes\r\n\r\nOther Features\r\n\r\nIP 68 Water Resistant : Platform And Storage Features\r\nCompatible Operating System : Android\r\n\r\nConnectivity Features\r\n\r\nCall Function : No\r\nBluetooth : Yes\r\nGPS : No\r\n\r\nCamera And Display Features\r\n\r\nDisplay Resolution : 320 x 320 Pixels\r\nDisplay Size : 40.5 mm\r\nDisplay Type : LCD\r\nBacklight Display : Yes\r\nOther Display Features : Color LCD Display\r\n\r\nFitness And Watch Functions\r\n\r\nCalorie Count : Yes\r\nStep Count : Yes\r\nHeart Rate Monitor : Yes\r\nOther Fitness Features : Activity Tracker (Distance, Steps, Calories Burned, Heart Rate, Blood Oxygen Level (SpO2)), 14 Sports Modes\r\nDate & Time Display : Yes\r\nAlarm Clock : Yes\r\nLanguage : English\r\nNumber of Buttons : 1\r\nOther Watch Functions : Smart Notifications (Text, Email, Social Media App Alerts), Alarm Clock, Calendar Alerts, Smart Connect Music and Camera Control : Dimensions\r\nWeight : 33 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year Manufacturer Warranty\r\nWarranty Service Type : Carry In\r\nCovered in Warranty : Manufacturing Defects\r\nNot Covered in Warranty : Physical Damage\r\nDomestic Warranty : 1 Year', 3499, 'Realme Classic Watch  (Black Strap, Regular).jpeg', 3, 23, 1, 'Realme Classic Watch  (Black Strap, Regular)', 'Smart Notifications for SMS, Calls, WhatsApp, and Other Apps', 'Realme Classic Watch  ', 1, '2021-05-13 08:40:42'),
(69, 'ASUS ROG Phone 5 (Black, 128 GB)  (8 GB RAM)', '8 GB RAM | 128 GB ROM\r\n17.22 cm (6.78 inch) Full HD+ Display\r\n64MP + 13MP + 5MP | 24MP Front Camera\r\n6000 mAh Lithium Polymer Battery\r\nQualcomm Snapdragon 888 (SM8350) Processor\r\n\r\nGeneral\r\n\r\nIn The Box : Handset, Adapter (30W), USB Type-C to Type C Cable, Ejector Pin (SIM Tray Needle), Aero Case, Documentation (User Guide, Warranty Card)\r\nModel Number : ZS673KS-1A043IN\r\nModel Name : ROG Phone 5\r\nColor : Black\r\nBrowse Type : Smartphones\r\nSIM Type : Dual Sim\r\nHybrid Sim Slot : No\r\nTouchscreen : Yes\r\nOTG Compatible : Yes\r\nSound Enhancements : ESS Sabre Quad DAC + Headphone Amplifier, Dual 7-Magnet Stereo Speaker with Dirac:Tuning, Quad Microphone\r\n\r\nDisplay Features\r\n\r\nDisplay Size : 17.22 cm (6.78 inch)\r\nResolution : 2448 x 1080 Pixels\r\nResolution Type : Full HD+\r\nGPU : Qualcomm Adreno 660\r\nDisplay Type : Full HD+ sAMOLED Display\r\nOther Display Features : 144 Hz Refresh Rate, 300 Hz Touch Sense, HDR10+, Delta E<1 Os & Processor Features\r\nOperating System : Android 11\r\nProcessor Type : Qualcomm Snapdragon 888 (SM8350)\r\nProcessor Core : Octa Core\r\nPrimary Clock Speed : 2.84 GHz\r\nOperating Frequency : 2G GSM: 850/900/1800/1900, 3G HSDPA: 850(5)/900/1700/1800/1900/1(2100), 4G LTE: B1(2100), B2(1900), B3(1800), B4(1700/2100), B5(850), B7(2600), B8(900), B18, B19, B20(800), B26, B28(700), 4G TD-LTE: B34(2000), B38(2600), B39(1900), B40(2300), B41(2500), B48(3600), B42(3500), 5G: n1/n3/n7/n8/n20/n28/n38/n41/n77/n78/n79\r\nMemory & Storage Features\r\nInternal Storage : 128 GB\r\nRAM : 8 GB\r\n\r\nCamera Features\r\n\r\nPrimary Camera Available : Yes\r\nPrimary Camera : 64MP + 13MP + 5MP\r\nPrimary Camera Features : Triple Rear Camera: 64MP Main + 13MP Wide-angle + 5MP Macro\r\nSecondary Camera Available : Yes\r\nSecondary Camera : 24MP Front Camera\r\nHD Recording : Yes\r\nVideo Recording : Yes\r\nDual Camera Lens : Primary Camera\r\n\r\nConnectivity Features\r\n\r\nNetwork Type : 5G, 4G VOLTE, 4G, 3G, 2G\r\nSupported Networks : 5G, 4G VoLTE, 4G LTE, WCDMA, GSM\r\nInternet Connectivity : 5G, 4G, 3G, Wi-Fi, EDGE, GPRS\r\n3G : Yes\r\nGPRS : Yes\r\nPre-installed Browser : Google Chrome\r\nBluetooth Support : Yes\r\nBluetooth Version : v5.2\r\nWi-Fi : Yes\r\nWi-Fi Version : 802.11 a/b/g/n/ac/ax (Wi-Fi 6)\r\nWi-Fi Hotspot : Yes\r\nNFC : Yes\r\nUSB Connectivity : Yes\r\nEDGE : Yes\r\nAudio Jack : 3.5mm\r\nMap Support : Google Maps\r\nGPS Support : Yes\r\n\r\nOther Details\r\n\r\nSmartphone : Yes\r\nSMS : Yes\r\nSensors : Gyroscope, E-compass, Proximity Sensor, Ambient Light Sensor, In-display Fingerprint, Accelerator, Gyro (Support ARCore), Ultrasonic Sensor\r\nBrowser : Google Chrome\r\nOther Features : UFS 3.1 ROM, 2x2 MIMO, Wi-Fi Direct, MMT Split Battery Design, ROG GameCool 5 Cooling System, Supports 65W ROG HyperCharge, Dual USB-C Ports (Charging | Audio | Display Out)\r\nGPS Type : GPS (L1+L5), GLONASS, GLONASS (L1), BDS (B1/B2a), GALILEO (E1+E5a), QZSS (L1+L5), NavIC (L5)\r\n\r\nBattery & Power Features\r\nBattery Capacity : 6000 mAh\r\n\r\nDimensions\r\n\r\nWidth : 77.25 mm\r\nHeight : 172.83 mm\r\nDepth : 10.29 mm\r\nWeight : 242 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : Brand Warranty of 1 Year\r\nDomestic Warranty : 1 Year', 49000, 'ASUS ROG Phone 5 (Black, 128 GB)  (8 GB RAM).jpeg', 1, 9, 0, 'ASUS ROG Phone 5 (Black, 128 GB)  (8 GB RAM)', '8 GB RAM | 128 GB ROM,6000 mAh Lithium Polymer Battery, Qualcomm Snapdragon 888 (SM8350) Processor', 'ASUS ROG Phone 5 ', 1, '2021-05-20 07:26:14'),
(70, 'ASUS ROG Phone 5 (White, 128 GB)  (8 GB RAM)', '8 GB RAM | 128 GB ROM\r\n17.22 cm (6.78 inch) Full HD+ Display\r\n64MP + 13MP + 5MP | 24MP Front Camera\r\n6000 mAh Lithium Polymer Battery\r\nQualcomm Snapdragon 888 (SM8350) Processor\r\n\r\nGeneral\r\n\r\nIn The Box : Handset, Adapter (30W), USB Type-C to Type C Cable, Ejector Pin (SIM Tray Needle), Aero Case, Documentation (User Guide, Warranty Card)\r\nModel Number : ZS673KS-1A043IN\r\nModel Name : ROG Phone 5\r\nColor : White\r\nBrowse Type : Smartphones\r\nSIM Type : Dual Sim\r\nHybrid Sim Slot : No\r\nTouchscreen : Yes\r\nOTG Compatible : Yes\r\nSound Enhancements : ESS Sabre Quad DAC + Headphone Amplifier, Dual 7-Magnet Stereo Speaker with Dirac:Tuning, Quad Microphone\r\n\r\nDisplay Features\r\n\r\nDisplay Size : 17.22 cm (6.78 inch)\r\nResolution : 2448 x 1080 Pixels\r\nResolution Type : Full HD+\r\nGPU : Qualcomm Adreno 660\r\nDisplay Type : Full HD+ sAMOLED Display\r\nOther Display Features : 144 Hz Refresh Rate, 300 Hz Touch Sense, HDR10+, Delta E<1 Os & Processor Features\r\nOperating System : Android 11\r\nProcessor Type : Qualcomm Snapdragon 888 (SM8350)\r\nProcessor Core : Octa Core\r\nPrimary Clock Speed : 2.84 GHz\r\nOperating Frequency : 2G GSM: 850/900/1800/1900, 3G HSDPA: 850(5)/900/1700/1800/1900/1(2100), 4G LTE: B1(2100), B2(1900), B3(1800), B4(1700/2100), B5(850), B7(2600), B8(900), B18, B19, B20(800), B26, B28(700), 4G TD-LTE: B34(2000), B38(2600), B39(1900), B40(2300), B41(2500), B48(3600), B42(3500), 5G: n1/n3/n7/n8/n20/n28/n38/n41/n77/n78/n79\r\nMemory & Storage Features\r\nInternal Storage : 128 GB\r\nRAM : 8 GB\r\n\r\nCamera Features\r\n\r\nPrimary Camera Available : Yes\r\nPrimary Camera : 64MP + 13MP + 5MP\r\nPrimary Camera Features : Triple Rear Camera: 64MP Main + 13MP Wide-angle + 5MP Macro\r\nSecondary Camera Available : Yes\r\nSecondary Camera : 24MP Front Camera\r\nHD Recording : Yes\r\nVideo Recording : Yes\r\nDual Camera Lens : Primary Camera\r\n\r\nConnectivity Features\r\n\r\nNetwork Type : 5G, 4G VOLTE, 4G, 3G, 2G\r\nSupported Networks : 5G, 4G VoLTE, 4G LTE, WCDMA, GSM\r\nInternet Connectivity : 5G, 4G, 3G, Wi-Fi, EDGE, GPRS\r\n3G : Yes\r\nGPRS : Yes\r\nPre-installed Browser : Google Chrome\r\nBluetooth Support : Yes\r\nBluetooth Version : v5.2\r\nWi-Fi : Yes\r\nWi-Fi Version : 802.11 a/b/g/n/ac/ax (Wi-Fi 6)\r\nWi-Fi Hotspot : Yes\r\nNFC : Yes\r\nUSB Connectivity : Yes\r\nEDGE : Yes\r\nAudio Jack : 3.5mm\r\nMap Support : Google Maps\r\nGPS Support : Yes\r\n\r\nOther Details\r\n\r\nSmartphone : Yes\r\nSMS : Yes\r\nSensors : Gyroscope, E-compass, Proximity Sensor, Ambient Light Sensor, In-display Fingerprint, Accelerator, Gyro (Support ARCore), Ultrasonic Sensor\r\nBrowser : Google Chrome\r\nOther Features : UFS 3.1 ROM, 2x2 MIMO, Wi-Fi Direct, MMT Split Battery Design, ROG GameCool 5 Cooling System, Supports 65W ROG HyperCharge, Dual USB-C Ports (Charging | Audio | Display Out)\r\nGPS Type : GPS (L1+L5), GLONASS, GLONASS (L1), BDS (B1/B2a), GALILEO (E1+E5a), QZSS (L1+L5), NavIC (L5)\r\n\r\nBattery & Power Features\r\nBattery Capacity : 6000 mAh\r\n\r\nDimensions\r\n\r\nWidth : 77.25 mm\r\nHeight : 172.83 mm\r\nDepth : 10.29 mm\r\nWeight : 242 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : Brand Warranty of 1 Year\r\nDomestic Warranty : 1 Year', 49000, 'ASUS ROG Phone 5 (White, 128 GB)  (8 GB RAM).jpeg', 1, 9, 0, 'ASUS ROG Phone 5 (White, 128 GB)  (8 GB RAM)', '8 GB RAM | 128 GB ROM,6000 mAh Lithium Polymer Battery, Qualcomm Snapdragon 888 (SM8350) Processor', 'ASUS ROG Phone 5', 1, '2021-05-20 07:30:41'),
(71, 'Mi 10i (Midnight Black, 128 GB)  (6 GB RAM)', '6 GB RAM | 128 GB ROM\r\n16.94 cm (6.67 inch) Full HD+ Display\r\n108MP + 8MP + 2MP + 2MP | 16MP Front Camera\r\n4820 mAh Battery\r\nQualcomm® Snapdragon™ 750G Processor\r\nGeneral\r\n\r\nIn The Box : Mi 10i 5G/ Power adapter / USB Type-C cable/ Simple protective cover / SIM eject tool / User guide / Warranty card\r\nModel Number : M10iX05 / m2007j17i\r\nModel Name : 10i\r\nColor : Midnight Black\r\nBrowse Type : Smartphones\r\nSIM Type : Dual Sim\r\nHybrid Sim Slot : Yes\r\nTouchscreen : Yes\r\nOTG Compatible : Yes\r\nQuick Charging : Yes\r\n\r\nDisplay Features\r\n\r\nDisplay Size : 16.94 cm (6.67 inch)\r\nResolution : 2400 x 1080pixel\r\nResolution Type : Full HD+\r\nGPU : Adreno™ 619\r\nDisplay Type : IPS LCD\r\nHD Game Support : Yes\r\nOther Display Features  :  Resolution: 2400 x 1080 FHD+ Color gamut: NTSC 84% (typ) Supports AdaptiveSync in 30Hz/48Hz/50Hz/60Hz/90Hz/120Hz Contrast ratio: 1500:1 (typ) Brightness: 450 nits (typ) Reading mode 3.0 Sunlight display 3.0 TÜV Rheinland Low Blue Light Certification Corning® Gorilla® Glass 5 : Os & Processor Features\r\nOperating System : Android Android Q 11\r\nProcessor Type\r\nQualcomm® Snapdragon™ 750G\r\nProcessor Core\r\nOcta Core\r\nPrimary Clock Speed\r\n2.2 GHz\r\nMemory & Storage Features\r\nInternal Storage\r\n128 GB\r\nRAM\r\n6 GB\r\nSupported Memory Card Type : Micro SD\r\nMemory Card Slot Type : Dedicated Slot\r\n\r\nCamera Features\r\n\r\nPrimary Camera Available : Yes\r\nPrimary Camera : 108MP + 8MP + 2MP + 2MP\r\nPrimary Camera Features  :  Rear camera photography features 108MP wide-angle camera | Timed burst | 6 long exposure modes | New photo filters: cyberpunk, gold vibes, black ice | Document mode | HDR | AI scene detection | Ultra wide-angle edge distortion correction | Google Lens | AI beautify | Portrait mode background blur adjustment | Movie frame | Night mode 2.0 | Panorama | Pro mode | Raw mode Rear camera video features Dual video (selfie camera + main camera) | Movie frame | Video pro mode | Video filters | Rear video beautify | ShootSteady video | Vlog mode | Video macro mode | Kaleidoscope\r\nSecondary Camera Available : Yes\r\nSecondary Camera : 16MP Front Camera\r\nSecondary Camera Features  :  Front camera photography features Night mode 1.0 | Timed burst | Movie frame | AI Beautify | Palm shutter | AI portrait mode | Panorama selfie Front camera video features Time-lapse selfie | Movie frame | AI beautify | Video filters | Short video mod\r\nFlash : Back\r\nHD Recording : Yes\r\nFull HD Recording : Yes\r\nVideo Recording : Yes\r\nFrame Rate : 60 fps\r\nDual Camera Lens : Primary Camera\r\n\r\nCall Features\r\n\r\nCall Wait/Hold : Yes\r\nConference Call : Yes\r\nHands Free : Yes\r\nVideo Call Support : Yes\r\nPhone Book : Yes\r\nCall Timer : Yes\r\nSpeaker Phone : Yes\r\n\r\nConnectivity Features\r\n\r\nNetwork Type : 5G\r\nSupported Networks : 5G\r\nInternet Connectivity : 5G,4G,3G,2G\r\n3G : Yes\r\nBluetooth Support : Yes\r\nWi-Fi : Yes\r\nWi-Fi Hotspot : Yes\r\nUSB Tethering : Yes\r\nUSB Connectivity : Yes\r\nGPS Support : Yes\r\n\r\nOther Details\r\n\r\nSmartphone : Yes\r\nSIM Size : nano\r\nKeypad Type : Alphanumeric\r\nInstant Message : Yes\r\nRemovable Battery : No\r\nSMS : Yes\r\nKeypad : No\r\nVoice Input : Yes\r\nPredictive Text Input : Yes\r\nSensors : Ultra-sound proximity sensor | 360° Ambient light sensors | Accelerometer | Gyroscope | : Electronic compass | Z-axis linear vibration motor| IR blaster\r\nGPS Type : A-GPS\r\n\r\nMultimedia Features\r\n\r\nAudio Formats : MP3, FLAC, APE, AAC, OGG, WAV, WMA, AMR-NB/AMR-WB\r\nVideo Formats : MP4,MKV,AVI,WMV,WEBM,3GP,ASF,MOV,TS\r\nBattery & Power Features : Battery Capacity : 4820 mAh\r\n\r\nDimensions\r\n\r\nWidth : 76.8 mm\r\nHeight : 165.38 mm\r\nDepth : 9 mm\r\nWeight : 214.5 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 year manufacturer warranty for device and 6 months manufacturer warranty for in-box accessories including batteries from the date of purchase', 22700, 'Mi 10i (Midnight Black, 128 GB)  (6 GB RAM).jpeg', 1, 4, 1, 'Mi 10i (Midnight Black, 128 GB)  (6 GB RAM)', '6 GB RAM | 128 GB ROM 16.94 cm (6.67 inch) Full HD+ Display 108MP + 8MP + 2MP + 2MP | 16MP Front Camera', 'Mi 10i ', 1, '2021-05-20 07:49:08'),
(72, 'Redmi Note 9 Pro (Champagne Gold, 64 GB)  (4 GB RAM)', '4 GB RAM | 64 GB ROM\r\n16.94 cm (6.67 inch) Full HD+ Display\r\n48MP + 48MP + 8MP + 5MP + 2MP | 16MP Dual Front Camera\r\n5020 mAh Battery\r\nQualcomm® Snapdragon™ 720G Processor\r\nGeneral\r\n\r\nIn The Box : Handset, Power adapter, USB cable, SIM eject tool, Warranty card, User guide, Clear soft case, Screen protector pre-applied on the phone\r\nModel Number : M2003J6A1I\r\nModel Name : Redmi Note 9 Pro\r\nColor : Champagne Gold\r\nBrowse Type : Smartphones\r\nSIM Type : Dual Sim\r\nHybrid Sim Slot : Yes\r\nTouchscreen : Yes\r\nOTG Compatible : Yes\r\n\r\nDisplay Features\r\n\r\nDisplay Size : 16.94 cm (6.67 inch)\r\nResolution : 2400 x 1080$$pixel\r\nResolution Type : Full HD+\r\nGPU : Adreno A618\r\nDisplay Type : DotDisplay\r\nHD Game Support : Yes\r\n\r\nOs & Processor Features\r\n\r\nOperating System : Android Pie 10\r\nProcessor Type : Qualcomm® Snapdragon™ 720G\r\nProcessor Core : Octa Core\r\nPrimary Clock Speed : 2.3 GHz\r\nSecondary Clock Speed : 1.8 GHz\r\n\r\nMemory & Storage Features\r\n\r\nInternal Storage : 64 GB\r\nRAM : 4 GB\r\nMemory Card Slot Type : Dedicated Slot\r\n\r\nCamera Features\r\n\r\nPrimary Camera Available : Yes\r\nPrimary Camera : 48MP + 48MP + 8MP + 5MP + 2MP\r\nPrimary Camera Features : Ultra nightscape mode, AI scene detection, Smart ultra-wide angle mode, Ultra wide-angle edge distortion correction, AI Beautify | Burst mode, Tilt-shift\r\nOptical Zoom : Yes\r\nSecondary Camera Available : Yes\r\nSecondary Camera : 16MP Dual Front Camera\r\nSecondary Camera Features : Panorama selfie, Palm shutter, AI silhouette detection, wide-angle distortion correction | Front camera HDR | Front camera display brightness correction | Selfie timer | Face recognition | Age recognition | Full screen camera frame | AI Beautify | AI feature adjustment | AI makeup | AI portrait mode | AI scene detection | AI studio lighting\r\nFlash : Yes\r\nHD Recording : Yes\r\nFull HD Recording : Yes\r\nVideo Recording : Yes\r\nDigital Zoom : 10x\r\n\r\nDual Camera Lens\r\n\r\nPrimary Camera : Call Features\r\nCall Wait/Hold : Yes\r\nConference Call : Yes\r\nVideo Call Support : Yes\r\nCall Divert : Yes\r\nSpeaker Phone : Yes \r\nConnectivity Features\r\nNetwork Type : 4G VOLTE, 4G, 3G\r\nSupported Networks : 4G VoLTE, 4G LTE, GSM\r\nInternet Connectivity : GSM , WCDMA , LTE FDD , LTE TDD , DLCA , ULCA\r\n3G : Yes\r\nBluetooth Support : Yes\r\nBluetooth Version : 5\r\nWi-Fi : Yes\r\nWi-Fi Version : 802.11a/b/g/n/ac\r\nWi-Fi Hotspot : Yes\r\nUSB Tethering : Yes\r\nUSB Connectivity : Yes\r\nAudio Jack : 3.5mm\r\n\r\nOther Details\r\n\r\nSmartphone : Yes\r\nTouchscreen Type : capacitive\r\nSIM Size : Nano\r\nKeypad Type : QWERTY\r\nRemovable Battery : No\r\nKeypad : No\r\nVoice Input : Yes\r\nPredictive Text Input : Yes\r\nSensors : Ambient Light Sensor , Proximity Sensor , E Compass , Accelerometer , Gyroscope\r\nMultimedia Features : FM Radio\r\nYes : Battery & Power Features\r\nBattery Capacity : 5020 mAh\r\nBattery Type : lithium-ion\r\nTalk Time : 29\r\n\r\nDimensions\r\n\r\nWidth : 76.68 mm\r\nHeight : 165.75 mm\r\nDepth : 8.8 mm\r\n\r\nWarranty\r\n\r\nWarranty Summary : 1 Year\r\nDomestic Warranty : 1 Year', 13700, 'Redmi Note 9 Pro (Champagne Gold, 64 GB)  (4 GB RAM).jpeg', 1, 4, 1, 'Redmi Note 9 Pro (Champagne Gold, 64 GB)  (4 GB RAM)', '4 GB RAM | 64 GB ROM 16.94 cm (6.67 inch) Full HD+ Display 48MP + 48MP + 8MP + 5MP + 2MP | 16MP Dual Front Camera', 'Redmi Note 9 Pro ', 1, '2021-05-20 08:08:30'),
(73, 'OPPO A12 (Black, 64 GB)  (4 GB RAM)', '4 GB RAM | 64 GB ROM | Expandable Upto 256 GB\r\n15.8 cm (6.22 inch) HD+ Display\r\n13MP + 2MP | 5MP Front Camera\r\n4230 mAh Battery\r\nMediaTek Helio P35 Processor\r\n\r\nGeneral\r\n\r\nIn The Box : Handset, USB Cable, Adapter, SIM Card Pin, Protective Case, Quick Guide, Warranty Card\r\nModel Number : CPH2083\r\nModel Name : A12\r\nColor : Black\r\nBrowse Type : Smartphones\r\nSIM Type : Dual Sim\r\nHybrid Sim Slot : No\r\nTouchscreen : Yes\r\nOTG Compatible : Yes\r\nSound Enhancements : Dirac Sound Effect, Integrated Audio Decoding Chip\r\nSAR Value : Head: 1.160 W/kg, Body: 0.586 W/kg\r\n\r\nDisplay Features\r\n\r\nDisplay Size : 15.8 cm (6.22 inch)\r\nResolution : 1520 x 720 Pixels\r\nResolution Type : HD+\r\nGPU : IMG GE8320\r\nDisplay Type : HD+ TFT-LCD Display\r\nDisplay Colors : 16M\r\nOther Display Features : 19:9 Screen Proportion, 89% Screen Ratio, 70% NTSC Color Gamut, 1500:1 Color Contrast, 70% Color Saturation, 450 nit Brightness (Typical), in-cell Touch Panel Technology, Corning Gorilla Glass 3, 10 Points Multi-touch, PET 2D Screen Protector Film Type, 60 Hz Screen Refresh Rate, 120 HZ Touch Sampling Rate, No Stroboscopic Eye Protection\r\n\r\nOs & Processor Features\r\n\r\nOperating System : Android Pie 9.0\r\nProcessor Type : MediaTek Helio P35\r\nProcessor Core : Octa Core\r\nPrimary Clock Speed : 1.8 GHz\r\nSecondary Clock Speed : 2.3 GHz\r\nOperating Frequency : GSM: 850/900/1800/1900 MHz, WCDMA: Bands 1/5/8, FDD-LTE: Bands 1/3/5/8, TD-LTE: Bands 38/40/41\r\n\r\nMemory & Storage Features\r\n\r\nInternal Storage : 64 GB\r\nRAM : 4 GB\r\nExpandable Storage : 256 GB\r\nSupported Memory Card Type : microSD\r\nMemory Card Slot Type : Dedicated Slot\r\n\r\nCamera Features\r\n\r\nPrimary Camera Available : Yes\r\nPrimary Camera : 13MP + 2MP\r\nPrimary Camera Features   :   Camera Composition: Main: - 13 MP, Secondary - 2 MP, Sensor Sizes/Pixel Size: 1/3 inch / 1.12 um, CMOS Sensor, Aperture: - Main - f/2.2, Secondary - f/2.4, Focal Length: Main - 3.37 mm, Secondary - 2.0 mm, Wide Angle - Main: 81.3 Degree, Secondary - 83 Degree, Lens Structure: Main - 5P, Secondary - 3P, Focusing Method: Main - Contrast Focus + Phase Detection Auto Focus, Consecutive Shooting (20 Photos), Lens Glass Material: Resin, Photograph Mode: Photo, Video, Professional Mode, Panorama, Portrait, Time-lapse Photography, AR Stickers, Characteristic Function for Photograph: filters, AI Beautification, Bokeh, HDR, Dazzle Color Mode, Video Format: MP4, Shooting Method: Timed Shot, Touch Screen Shot, Gestures Shot\r\nSecondary Camera Available : Yes\r\nSecondary Camera : 5MP Front Camera\r\nSecondary Camera Features  :  CMOS Sensor, Sensor Size / Pixel Size: 1/5 inch / 1.12 um, Focal Length: 2.28 mm, Wide Angle of Front Lens: 76 Degree, Flash: Screen Lighting, Flashlight Aperture: F/2.4, Lens Structure: 3P, Lens Glass Material: Resin\r\nFlash : Yes\r\nHD Recording : Yes\r\nFull HD Recording : Yes\r\nVideo Recording : Yes\r\nVideo Recording Resolution : 1080p, 720p\r\nDigital Zoom : 6x\r\nFrame Rate : 30 fps\r\n\r\nDual Camera Lens\r\n\r\nPrimary Camera : Call Features\r\nVideo Call Support : Yes\r\nPhone Book : Yes\r\nSpeaker Phone : Yes\r\nSpeed Dialing : Yes\r\nCall Records : Yes\r\n\r\nConnectivity Features\r\n\r\nNetwork Type : 4G VOLTE, 4G, 3G, 2G\r\nSupported Networks : 4G VoLTE, 4G LTE, WCDMA, GSM\r\nInternet Connectivity : 4G, 3G, Wi-Fi, EDGE, GPRS\r\nGPRS : Yes\r\nPre-installed Browser : Google Chrome, Oppo Browser\r\nMicro USB Version : USB 2.0\r\nBluetooth Support : Yes\r\nBluetooth Version : v5.0\r\nWi-Fi : Yes\r\nWi-Fi Version : 802.11a/b/g/n/ac\r\nWi-Fi Hotspot : Yes\r\nUSB Connectivity : Yes\r\nAudio Jack : 3.5mm\r\nMap Support : Google Maps\r\nGPS Support : Yes\r\n\r\nOther Details\r\n\r\nSmartphone : Yes\r\nTouchscreen Type : Capacitive\r\nSIM Size : Nano SIM\r\nUser Interface : ColorOS 6.1.2\r\nMMS : Yes\r\nSMS : Yes\r\nGraphics PPI : 270 PPI\r\nSensors : Electronic Compass, Distance Transducer, Magnetic Induction Sensor, Light Sensor, G-Sensor/Acceleration Sensor, Gyroscope\r\nBrowser : Google Chrome, Oppo Browser\r\nRingtones Format : MP3, AMR, APE, OGG, FLAC, WAV, MIDI, WMA\r\nOther Features  :  eMMC ROM Technology, OTG Storage Format: FAT12, FAT16, FAT32, NTFS, EXFAT, Split Screen, Picture in Picture, Rear Fingerprint, AI Face Unlock, Apps Lock, File Encryption, Limit Number of Connction of Hotspot: 10 Hotspots, WLAN Display, Polycarbonate Back Cover Material, Graphite Sheet Heat Dissipation, IPX2 Water Proof\r\nGPS Type : A-GPS, GLONASS, BeiDou\r\n\r\nMultimedia Features\r\n\r\nFM Radio : Yes\r\nAudio Formats : AAC, APE, FLAC, AMR, MID, MP3, OGG, WAV, WMA, MKA\r\nVideo Formats : MP4, 3GP, ASF, AVI, FLV, M2TS, MKV, MPG, TS, WEBM, WMV\r\n\r\nBattery & Power Features\r\n\r\nBattery Capacity :  4230 mAh\r\n\r\nDimensions\r\n\r\nWidth : 75.5 mm\r\nHeight : 155.9 mm\r\nDepth : 8.3 mm\r\nWeight : 165 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : Brand Warranty of 1 Year Available for Mobile Including Battery and 6 Months for Accessories\r\nDomestic Warranty : 1 Year', 119900, 'OPPO A12 (Black, 64 GB)  (4 GB RAM).jpeg', 1, 8, 0, 'OPPO A12 (Black, 64 GB)  (4 GB RAM)', '4 GB RAM | 64 GB ROM | Expandable Upto 256 GB 15.8 cm (6.22 inch) HD+ Display 13MP + 2MP | 5MP Front Camera', 'OPPO A12 ', 1, '2021-05-20 08:22:53');
INSERT INTO `product` (`product_id`, `product_name`, `product_detail`, `product_price`, `product_image`, `category_id`, `sub_category_id`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `status`, `added_on`) VALUES
(74, 'OPPO A53 (Mint Cream, 128 GB)  (6 GB RAM)', '6 GB RAM | 128 GB ROM | Expandable Upto 256 GB\r\n16.51 cm (6.5 inch) HD+ Display\r\n13MP + 2MP + 2MP | 16MP Front Camera\r\n5000 mAh Lithium-ion Polymer Battery\r\nQualcomm Snapdragon 460 Processor\r\n\r\nGeneral\r\n\r\nIn The Box : Handset, USB Cable (1m White), Adapter, SIM Card Pin, Protective Case (Soft Shell Transparent - TPU), Protective Film (Screen), Quick Guide, Warranty Card\r\nModel Number : CPH2139 / CPH2127\r\nModel Name : A53\r\nColor : Mint Cream\r\nBrowse Type : Smartphones\r\nSIM Type : Dual Sim\r\nHybrid Sim Slot : No\r\nTouchscreen : Yes\r\nOTG Compatible : Yes\r\n\r\nSound Enhancements\r\n\r\nDirac Sound Effect, WCD9370 Audio Decoding Chip : SAR Value\r\nHead: 0.77 W/kg, Body: 0.97 W/kg : Display Features\r\nDisplay Size : 16.51 cm (6.5 inch)\r\nResolution : 1600 x 720 Pixels\r\nResolution Type : HD+\r\nGPU : Adreno 610 (600 MHz at 16 fps)\r\nDisplay Type : HD+ LCD Display\r\nDisplay Colors : 16.7M\r\nOther Display Features  :  89.20% Screen Ratio, 72% (Typ) Color Saturation, 20:9 Screen Proportion, Touch Screen Glass Type: Corning GG3+, 90 Hz Screen Refresh Rate, 120 Hz Touch Sampling Rate, 2D Screen Protective Film, Oleophobic Layer on Film\r\n\r\nOs & Processor Features\r\n\r\nOperating System : Android 10\r\nProcessor Type : Qualcomm Snapdragon 460\r\nProcessor Core : Octa Core\r\nPrimary Clock Speed : 1.8 GHz\r\nSecondary Clock Speed : 1.6 GHz\r\nOperating Frequency : GSM: 850/900/1800/1900, WCDMA: B1/B5/B8, 4G FDD LTE: B1/B3/B5/B8, 4G TDD LTE: B38/B40/B41 (2535 - 2655 MHz)\r\n\r\nMemory & Storage Features\r\n\r\nInternal Storage : 128 GB\r\nRAM : 6 GB\r\nExpandable Storage : 256 GB\r\nSupported Memory Card Type : microSD\r\nMemory Card Slot Type : Dedicated Slot\r\n\r\nCamera Features\r\n\r\nPrimary Camera Available : Yes\r\nPrimary Camera : 13MP + 2MP + 2MP\r\nPrimary Camera Features  :  13MP (Main) + 2MP (Blur) + 2MP (Macro) Rear Camera Setup, Sensor Size: OV13B, 1/3.06 inch, 1.12um, Camera Size - Main Camera - f/2.2, FOV 81.3 Degree, 5P, Autofocus - Open Loop Motor, Electronic Stabilization, Focusing: Contrast Autofocus + Phase Autofocus, Shooting Function: Taking Pictures, Video, Professional, Panorama, Portrait, Time Lapse Photography, Slow Motion, AI Scene Recognition, CMOS Sensor, 20 Consecutive Shooting, Fill Light for Shooting Video, Photo Features: Filters, Automatic Enhancement, Crop Rotation, Stickers, Graffiti, Beauty, Text, Mosaic, Blur, Erase Pen, Lens Glass Material: Corning Gorilla Glass 5\r\nSecondary Camera Available : Yes\r\nSecondary Camera : 16MP Front Camera\r\nSecondary Camera Features : 16MP Front Camera, CMOS Sensor, Shooting Function: Taking Pictures, Video, Professional Mode Panorama, Portrait, Time Lapse, Fixed Focusing, Lens Glass Material: Corning GG3+\r\nFlash : Rear LED Monochrome Temperature Single Lamp\r\nHD Recording : Yes\r\nFull HD Recording : Yes\r\nVideo Recording : Yes\r\nVideo Recording Resolution : 1080P (at 30 fps), 720P (at 30 fps)\r\nDigital Zoom : 6x\r\nFrame Rate : 30 fps\r\nDual Camera Lens : Primary Camera\r\n\r\nCall Features\r\n\r\nVideo Call Support : Yes\r\nSpeaker Phone : Yes\r\nCall Records : Yes\r\n\r\nConnectivity Features\r\n\r\nNetwork Type : 4G VOLTE, 4G, 3G, 2G\r\nSupported Networks : 4G VoLTE, 4G LTE, WCDMA, GSM\r\nInternet Connectivity : 4G, 3G, Wi-Fi, GPRS\r\nGPRS : Yes\r\nPre-installed Browser : Google Chrome\r\nBluetooth Support : Yes\r\nBluetooth Version : v5.0\r\nWi-Fi : Yes\r\nWi-Fi Version : 802.11a/b/g/n/ac\r\nWi-Fi Hotspot : Yes\r\nUSB Connectivity : Yes\r\nAudio Jack : 3.5mm\r\nMap Support : Google Maps\r\nGPS Support : Yes\r\n\r\nOther Details\r\n\r\nSmartphone : Yes\r\nTouchscreen Type : Capacitive\r\nSIM Size : Nano + Nano\r\nUser Interface  : ColorOS 7.2 (Based on Android 10)\r\nSMS : Yes\r\nGraphics PPI : 269 PPI\r\nSensors :  Geomagnetic Induction, Light Induction, Proximity Sensor, Acceleration Sensor, Gravity Sensor, Gyroscope\r\nRingtones Format : MP3/AMR/APE/OGG/FLAC/WAV/MIDI/WMA\r\nOther Features   :   UFS 2.1 ROM Technology, OTG Storage Format: FAT32, NTFS, EXFAT, Maximum Support for OTG Storage: 2TB, Number of RAM Channels: 2, 1804 MHz RAM Frequency, Automatic Call Recording, Picture Editing, Data Backup, File Encryption, Apps Lock, Fingerprint Reset Password, Split Screen, Picture in Picture, Video Floating Window, Webpage Video Play, Google Lens, Kids Space, World Time, Lock Screen Clock, Screen Recording, Clone App, OPPO Share, Voice Changer in Game, Game Boost, Game Function, Face Unlock, Music Interconnection, Supports SBC, AAC, APTX HD, LDAC Bluetooth Codec, Fingerprint Payment, Facial Recognition, Fast Charging, Reverse Charging, Water Proof (Life Waterproof), Graphite Sheet Heat Dissipation, 18 W Charging\r\nGPS Type : A-GPS, Beidou, Glonass, Galileo\r\n\r\nMultimedia Features\r\n\r\nFM Radio : Yes\r\n\r\nVideo Formats\r\n\r\nMP4 : Battery & Power Features\r\nBattery Capacity : 5000 mAh\r\n\r\nDimensions\r\n\r\nWidth : 75.1 mm\r\nHeight : 163.9 mm\r\nDepth : 8.4 mm\r\nWeight : 186 g\r\n\r\nWarranty\r\n\r\nWarranty Summary : Brand Warranty of 1 Year Available for Mobile Including Battery and 6 Months for Accessories\r\nDomestic Warranty : 1 Year', 12990, 'OPPO A53 (Mint Cream, 128 GB)  (6 GB RAM).jpeg', 1, 8, 0, 'OPPO A53 (Mint Cream, 128 GB)  (6 GB RAM)', '6 GB RAM | 128 GB ROM | Expandable Upto 256 GB 16.51 cm (6.5 inch) HD+ Display 13MP + 2MP + 2MP | 16MP Front Camera', 'OPPO A53', 1, '2021-05-20 08:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(50) NOT NULL,
  `sub_category_name` varchar(100) NOT NULL,
  `sub_category_image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `category_id`, `sub_category_name`, `sub_category_image`, `status`, `added_on`) VALUES
(1, 6, 'Man', 'Solid Men Mandarin Collar Blue, Black T-Shirt  (Pack of 2).jpeg', 1, '2021-05-05 17:49:00'),
(3, 6, 'Woman', 'Women A-line Multicolor Dress.jpeg', 1, '2021-05-05 17:48:25'),
(4, 1, 'MI', 'MI.jpeg', 1, '2021-05-07 09:11:22'),
(5, 1, 'Realme', 'Realme.jpeg', 1, '2021-05-07 09:16:58'),
(6, 1, 'Samsung', 'SAMSUNG Galaxy A71 (Prism Crush Blue, 128 GB)  (8 GB RAM).jpeg', 1, '2021-05-07 09:18:34'),
(7, 1, 'VIVO', 'Vivo.jpeg', 1, '2021-05-07 09:19:08'),
(8, 1, 'oppo', 'Oppo.jpeg', 1, '2021-05-07 09:19:51'),
(9, 1, 'Asus', 'Asus.jpeg', 1, '2021-05-07 09:20:09'),
(10, 2, 'HP', 'HP.jpeg', 1, '2021-05-07 09:25:37'),
(11, 2, 'Lenevo', 'Lenevo.jpeg', 1, '2021-05-07 09:25:57'),
(12, 2, 'Dell', 'Dell.jpeg', 1, '2021-05-07 09:26:30'),
(13, 2, 'MI', 'MI_laptop.jpeg', 1, '2021-05-07 09:30:47'),
(14, 3, 'Earphone', 'Earphone.jpeg', 1, '2021-05-07 09:37:21'),
(15, 3, 'Headphone', 'Electronics.jpeg', 1, '2021-05-07 09:37:48'),
(16, 5, 'Sport Shoes', 'sport shoes.jpeg', 1, '2021-05-07 10:26:30'),
(18, 5, 'Casual Shoes', 'casual shoes.jpeg', 1, '2021-05-08 11:28:28'),
(20, 5, 'Part Ware shoes', 'Party wear shoes.jpeg', 1, '2021-05-07 10:28:01'),
(21, 5, 'Sandle', 'Sandle.jpeg', 1, '2021-05-07 10:29:45'),
(22, 3, 'Power Bank', 'Power Bank.jpeg', 1, '2021-05-07 10:31:09'),
(23, 3, 'Smart Watch', 'Smart Watch.jpeg', 1, '2021-05-07 10:31:38'),
(24, 3, 'Charger', 'Chargers.jpeg', 1, '2021-05-07 10:32:06'),
(25, 3, 'Pandrive', 'Pandrive.jpeg', 1, '2021-05-07 10:34:33'),
(26, 7, 'MI', 'Mi 4X 108 cm (43 inch) Ultra HD (4K) LED Smart Android TV.jpeg', 1, '2021-05-07 10:36:34'),
(27, 7, 'Samsung', 'Samsung TV.jpeg', 1, '2021-05-07 10:38:29'),
(28, 7, 'Realme', 'realme 80 cm (32 inch) HD Ready LED Smart Android TV  (TV 32).jpeg', 1, '2021-05-07 10:44:12'),
(29, 7, 'One pluse', 'OnePlus Y Series 108 cm (43 inch) Full HD LED Smart Android TV  (43FA0A00).jpeg', 1, '2021-05-07 10:44:53'),
(30, 7, 'Thomson', 'Thomson 9A Series 106 cm (42 inch) Full HD LED Smart Android TV  (42PATH2121).jpeg', 1, '2021-05-07 10:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `email`, `mobile`, `password`, `status`, `added_on`) VALUES
(1, 'user', 'user', 'user@gmail.com', '9876543210', 'user123', 1, '2021-03-25 10:12:44'),
(2, 'dharam123', 'dharam', 'dharam@gmail.com', '123456789', 'dharam123', 0, '2021-03-25 10:26:37'),
(3, 'dharam3011', 'Dharam Sojitra', 'dharamsojitra3011@gmail.com', '8758119104', '457b2221bc24a34e3df0df13c5bc2162', 1, '2021-05-17 07:13:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`email`,`username`,`mobile`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `demo2`
--
ALTER TABLE `demo2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `payment_card`
--
ALTER TABLE `payment_card`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `UNIQUE` (`card_number`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`username`,`email`,`mobile`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `demo2`
--
ALTER TABLE `demo2`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111121;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_card`
--
ALTER TABLE `payment_card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
