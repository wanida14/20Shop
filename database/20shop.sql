-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2018 at 04:46 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `20shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `status_id`) VALUES
(1, 'admin', '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'อุปกรณ์การเรียน'),
(2, 'เครื่องแต่งกาย'),
(3, 'ของใช้ทั่วไป'),
(4, 'อิเล็กทรอนิกส์'),
(5, 'ความงาม'),
(6, 'อาหาร');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `tel` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(400) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `name`, `birthday`, `tel`, `email`, `address`, `status_id`) VALUES
(1, 'wanida', '1414', 'wanida krathaijan', '1993-06-28', 833408348, 'wanidacool14@gmail.com', 'กรุงเทพมหานคร', 2),
(3, 'thanu', '1234', 'ธนู ศิลป์เลิศ', '2018-11-24', 833408348, 'wanidacoo14@gmail.com', '123/2 ตำบลทุ่งสุขลา อำเภอศรีราชา จังหวัดชลบุรี', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `payment_code` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `member_id`, `date`, `payment_code`) VALUES
(38, 6, 1, '2018-11-22', '120181122-173609-52');

-- --------------------------------------------------------

--
-- Table structure for table `orders_reserve`
--

CREATE TABLE `orders_reserve` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `payment_code` varchar(50) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_reserve`
--

INSERT INTO `orders_reserve` (`id`, `product_id`, `payment_code`, `member_id`) VALUES
(23, 2, '120181122-173547-82', 1),
(24, 3, '120181122-173547-82', 1),
(25, 6, '120181122-173547-82', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `image` varchar(40) NOT NULL,
  `payment_code` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `price` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `payment_status` varchar(40) NOT NULL,
  `delivery_status` varchar(40) NOT NULL,
  `ems_number` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `image`, `payment_code`, `date`, `price`, `member_id`, `name`, `phone`, `address`, `payment_status`, `delivery_status`, `ems_number`) VALUES
(31, 'img-5bf6daea30d59.png', '120181122-173547-82', '2018-11-22', 110, 1, 'ธนู ศิลป์เลิศ', '0633072884', 'ทุ่งสุขลา', 'จ่ายแล้ว', 'จัดส่งแล้ว', 'TH00000001');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `status`) VALUES
(1, 'admin'),
(2, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `detail` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `image`, `name`, `price`, `detail`, `category_id`) VALUES
(1, 'eraser.png', 'ยางลบ', 20, ' is simply dummy text of the printing', 1),
(2, 'notebook.png', 'สมุดโน๊ต', 20, ' is simply dummy text of the printing', 1),
(3, 'pen.png', 'ปากกา', 20, ' is simply dummy text of the printing ', 1),
(4, 'pencil.png', 'ดินสอ', 20, ' is simply dummy text of the printing ', 1),
(5, 'pencil-box.png', 'กล่องดินสอ', 20, ' is simply dummy text of the printing ', 1),
(6, 'pencil-box2.png', 'กล่องดินสอ', 20, ' is simply dummy text of the printing ', 1),
(7, '9d02a81b0e008de4b274050efa6a081f_6249709a-243b-45ba-afc6-0ea923578b66.png', 'กระโปรง', 20, 'is simply dummy text of the printing', 2),
(8, '1676014433-1-minirodini-stripe-sock-pink_PID1676014433-1PID.png', 'ถุงเท้า', 20, 'is simply dummy text of the printing ', 2),
(9, 'black-skirt-png.png', 'กระโปรง', 20, 'is simply dummy text of the printing ', 2),
(10, 'gloves_PNG8271.png', 'ถุงมือ', 20, 'is simply dummy text of the printing ', 2),
(11, '1857d9258021d05.jpg', 'กระดาษทิชชู่', 20, 'is simply dummy text of the printing ', 3),
(12, '185805f894486a2.jpg', 'ผ้าเช็ดมือ', 20, 'is simply dummy text of the printing ', 3),
(13, '9970070_B.jpg', 'ชุดช้อน-ส้อม-มีด', 20, 'is simply dummy text of the printing ', 3),
(14, '201301280946550.jpg', 'ชุดช้อน-ส้อม', 20, 'is simply dummy text of the printing ', 3),
(15, 'et.png', 'เคสโทรศัพท์', 20, 'is simply dummy text of the printing ', 4),
(16, 'magaroon case iphone 5s.png', 'เคสโทรศัพท์ 5s', 20, 'is simply dummy text of the printing ', 4),
(17, 'Mobile-Earphone-PNG-HD.png', 'หูฟัง', 20, 'is simply dummy text of the printing ', 4),
(18, 'purepng.com-earphoneelectronicsearphoneheadphone-941524670917nlo8p.png', 'หูฟัง', 20, 'is simply dummy text of the printing ', 4),
(19, 'sb.png', 'เคสโทรศัพท์', 20, 'is simply dummy text of the printing ', 4),
(20, '0607845094074.jpg', 'ลิปสติก', 20, 'is simply dummy text of the printing ', 5),
(21, 'earring-115264174260vm7f4fyvj.png', 'ต่างหู', 20, 'is simply dummy text of the printing ', 5),
(22, 'flatback-hatchling-earrings.png', 'ต่างหู', 20, 'is simply dummy text of the printing ', 5),
(23, 'lipstick-149647_960_720.png', 'ลิปสติก', 20, 'is simply dummy text of the printing ', 5),
(24, 'purepng.com-cinna-earringjewelryjewellerydiamondcinnaearring-1701528883611bkje4.png', 'ต่างหู', 20, 'is simply dummy text of the printing ', 5),
(25, 'file.jpg', 'มาม่าคัพ', 20, 'is simply dummy text of the printing ', 6),
(26, 'MINCED-PORK-new.png', 'มาม่าคัพ', 20, 'is simply dummy text of the printing', 6),
(27, 'moo-manaw-new.png', 'มาม่าคัพ', 20, 'is simply dummy text of the printing ', 6),
(28, 'Seaweed-2017.png', 'มาม่าคัพ', 20, 'is simply dummy text of the printing', 6),
(29, 'NIssin-mushroom-J-2017.png', 'มาม่าคัพ', 20, 'is simply dummy text of the printing ', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_reserve`
--
ALTER TABLE `orders_reserve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `orders_reserve`
--
ALTER TABLE `orders_reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
