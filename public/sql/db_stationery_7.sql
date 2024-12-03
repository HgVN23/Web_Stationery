-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 07, 2024 at 12:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stationery`
--
CREATE DATABASE IF NOT EXISTS `db_stationery` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_stationery`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `IsCheckedOut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ID`, `CustomerId`, `CreatedDate`, `IsCheckedOut`) VALUES
(1, 1, '2024-10-28 14:34:08', 0),
(2, 2, '2024-10-28 14:34:08', 1),
(3, 3, '2024-10-28 14:34:08', 0),
(4, 4, '2024-10-28 14:34:08', 1),
(5, 5, '2024-10-28 14:34:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `ID` int(11) NOT NULL,
  `CartId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`ID`, `CartId`, `ProductId`, `Quantity`, `Price`) VALUES
(3, 2, 6, 10, 1000.00),
(4, 2, 17, 24, 1000.00),
(5, 3, 4, 10, 1000.00),
(6, 3, 18, 5, 1000.00),
(7, 4, 27, 10, 1000.00),
(8, 4, 12, 24, 1000.00),
(9, 5, 3, 10, 1000.00),
(10, 5, 22, 24, 1000.00),
(12, 1, 4, 10002, 39000.00);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `IsFeature` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `CategoryName`, `Description`, `IsFeature`) VALUES
(1, 'Giấy in ấn', 'Giấy A4 Excel 70 Gsm, Giấy A4 Double A 70 Gsm, Giấy in bill tính tiền 8F (80x45mm), Giấy kraft (tờ) size A0, Decal Tomy mũi tên - 1cm - hình vuông, Giấy Fort màu 80 A3 Gsm....', 1),
(2, 'Bìa - Kệ - Rổ', 'Bìa Accor nhựa Kingstar - Xám, Trình ký nhựa đơn A4 Hongjie H-904, Túi Đựng Hồ Sơ Kéo Khóa 5588 Deli khổ A4 (10 cái), Bìa túi phân trang Kingstar 32 x 24,5cm (10cái), Combo 5 cái bìa trình ký Simili đôi F001 (5màu)...', 0),
(3, 'Dụng Cụ Văn Phòng', 'Dây đeo thẻ tên co rút yoyo màu trắng, Kim bấm số 3 Deli 24/6, Kim bấm số 3 - 26/6 Việt Đức, Màng cán nhiệt BOPP 25mic mờ - 315mmx200m, Dây đeo bảng tên hình mặt cười (lụa), Gỡ Kim MESA - SR10....', 1),
(4, 'Sổ - Tập - Bao Thư', 'Tập 96 trang Hiệp Phong - 58gsm, Bao thư Xi măng quấn dây A3 đáy 10cm (50cái), Sổ lò xo A5 bìa nhựa grand 140 trang, Phiếu xuất kho 2 liên A5 mỏng (Lốc 10 cuốn), Sổ ghi danh bạ điện thoại ABC - A5....', 0),
(5, 'Bút - Mực Chất Lượng Cao', 'Bút dạ quang STACOM - Hồng, Bút gel xóa được Baoke PC3188 - Tím, Ruột bút Uni Ball Pen Refills SXR-7 For SXN-217, SXN-1575 - xanh, Hộp cắm bút Toppoint HY348 - xám, ....', 1),
(6, 'Băng Keo - Dao - Kéo', 'Băng keo cách điện NANO Xanh Dương 5cm - 1KG/ 6 Cuộn, Băng keo cách điện NANO Đen 5cm - 1KG/ 8 Cuộn, Keo trám khe silicone - SILIRUB AC - 280ml, Đạn nhựa súng bắn mác 75mm (5000 cái/ Hộp), ...', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `ContactDate` datetime NOT NULL,
  `IsReplied` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ID`, `CustomerName`, `Email`, `Message`, `ContactDate`, `IsReplied`) VALUES
(1, 'C1', 'c1@gmail.com', 'Web đã xong :D', '2024-10-28 14:31:41', 0),
(2, 'C2', 'c2@gmail.com', 'Web chưa xong :(', '2024-10-28 14:31:41', 0),
(3, 'C3', 'c3@gmail.com', 'Test 3', '2024-10-28 14:31:41', 0),
(4, 'C4', 'c4@gmail.com', 'Moshi moshi~', '2024-10-28 14:31:41', 0),
(5, 'C5', 'c5@gmail.com', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '2024-10-28 14:31:41', 0),
(6, 'Ngô Xuân Hòa', 'ngohoahn@gmail.com', 'Hôm nay trời đẹp', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `CustomerName`, `Phone`, `Email`, `Address`, `UserID`) VALUES
(1, 'nxhoa', '0839559999', 'nxhoa@gmail.com', 'Hà Nội', 1),
(2, 'vmhoang', '0839552999', 'vmhoang@gmail.com', 'Hà Nội', 2),
(3, 'customer', '0839552999', 'customer@gmail.com', 'Hà Nội', 3),
(4, 'buyer', '0839552999', 'buyer@gmail.com', 'Hà Nội', 4),
(5, '12345678', '0839552999', '12345678@gmail.com', 'Hà Nội', 5);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderCode` varchar(15) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `TotalAmount` decimal(8,2) NOT NULL,
  `OrderStatus` varchar(255) NOT NULL COMMENT '"Pending", "Completed", "Cancelled"',
  `ShippingAddress` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderCode`, `CustomerId`, `OrderDate`, `TotalAmount`, `OrderStatus`, `ShippingAddress`) VALUES
('ORD0CE7ABA8', 2, '2024-10-28 14:43:42', 1000.00, 'Completed', 'a'),
('ORD0D16842B', 1, '2024-10-28 14:43:42', 1000.00, 'Completed', 'a'),
('ORD145E9859', 1, '2024-11-06 16:43:15', 3000.00, 'Pending', 'Hà Nội'),
('ORD1F5E4D0E', 1, '2024-11-06 16:40:29', 45000.00, 'Pending', 'Hà Nội'),
('ORD2D40304A', 1, '2024-10-28 14:43:42', 1000.00, 'Cancelled', 'a'),
('ORD340D0A9B', 2, '2024-10-28 14:43:42', 1000.00, 'Pending', 'a'),
('ORD3B19F5CC', 1, '2024-11-07 17:37:33', 186000.00, 'Pending', 'Hà Nội'),
('ORD48984D1E', 3, '2024-10-28 14:43:42', 1000.00, 'Cancelled', 'a'),
('ORD6B1780F0', 1, '2024-11-06 10:34:56', 62000.00, 'Pending', 'Hà Nội'),
('ORD75C31B0B', 1, '2024-11-06 16:44:33', 24000.00, 'Pending', 'Hà Nội'),
('ORD86432420', 1, '2024-11-07 17:39:02', 13000.00, 'Cancelled', 'Hà Nội'),
('ORD8A479954', 1, '2024-10-28 14:43:42', 1000.00, 'Pending', 'a'),
('ORDB087E7E7', 1, '2024-11-06 16:41:57', 58000.00, 'Cancelled', 'Hà Nội'),
('ORDB8C0C7F6', 1, '2024-11-07 17:38:13', 4000.00, 'Pending', 'Hà Nội'),
('ORDC41063F1', 1, '2024-11-07 17:33:37', 20000.00, 'Pending', 'Hà Nội'),
('ORDDF87B46D', 1, '2024-11-07 17:30:56', 31000.00, 'Pending', 'Hà Nội'),
('ORDED50C461', 1, '2024-11-06 16:46:35', 8000.00, 'Pending', 'Hà Nội'),
('ORDFC056F3F', 1, '2024-11-06 10:27:36', 104000.00, 'Cancelled', 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `ID` int(11) NOT NULL,
  `OrderCode` varchar(15) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Price` decimal(8,2) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `UnitPrice` decimal(8,2) NOT NULL,
  `PriceSale` decimal(8,2) DEFAULT NULL,
  `ImageUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`ID`, `OrderCode`, `ProductId`, `Price`, `Quantity`, `ProductName`, `UnitPrice`, `PriceSale`, `ImageUrl`) VALUES
(1, 'ORD0CE7ABA8', 23, 15000.00, 5, 'Item23', 3000.00, 3000.00, '/Upload/Product/23.jpg'),
(2, 'ORD0CE7ABA8', 12, 15000.00, 5, 'Item12', 3000.00, 3000.00, '/Upload/Product/12.jpg'),
(3, 'ORD0CE7ABA8', 30, 15000.00, 5, 'Item30', 3000.00, 3000.00, '/Upload/Product/30.jpg'),
(4, 'ORD0CE7ABA8', 11, 15000.00, 5, 'Item11', 3000.00, 3000.00, '/Upload/Product/11.jpg'),
(5, 'ORD0D16842B', 23, 15000.00, 5, 'Item23', 3000.00, 3000.00, '/Upload/Product/23.jpg'),
(6, 'ORD0D16842B', 12, 15000.00, 5, 'Item12', 3000.00, 3000.00, '/Upload/Product/12.jpg'),
(7, 'ORD2D40304A', 30, 15000.00, 5, 'Item30', 3000.00, 3000.00, '/Upload/Product/30.jpg'),
(8, 'ORD8A479954', 11, 15000.00, 5, 'Item11', 3000.00, 3000.00, '/Upload/Product/11.jpg'),
(9, 'ORD340D0A9B', 23, 15000.00, 5, 'Item23', 3000.00, 3000.00, '/Upload/Product/23.jpg'),
(10, 'ORD340D0A9B', 12, 15000.00, 5, 'Item12', 3000.00, 3000.00, '/Upload/Product/12.jpg'),
(11, 'ORD340D0A9B', 30, 15000.00, 5, 'Item30', 3000.00, 3000.00, '/Upload/Product/30.jpg'),
(12, 'ORD48984D1E', 11, 15000.00, 5, 'Item11', 3000.00, 3000.00, '/Upload/Product/11.jpg'),
(13, 'ORDFC056F3F', 23, 20000.00, 20, 'Gôm Pentel Nhỏ (ZEH-03)', 1000.00, NULL, '/Upload/Product/23.jpg'),
(14, 'ORDFC056F3F', 12, 17000.00, 17, 'Kẹp giấy tam giác C62', 1000.00, NULL, '/Upload/Product/12.jpg'),
(15, 'ORDFC056F3F', 8, 43000.00, 1, 'Bìa còng 7F Thiên Long F4 (chiều cao bìa 34cm)', 43000.00, NULL, '/Upload/Product/08.jpg'),
(16, 'ORDFC056F3F', 29, 24000.00, 3, 'Băng keo trong 1.2F (lõi lớn)', 8000.00, NULL, '/Upload/Product/29.jpg'),
(17, 'ORD6B1780F0', 1, 62000.00, 1, 'Giấy A4 IK Natural 70 Gsm', 62000.00, NULL, '/Upload/Product/01.jpg'),
(18, 'ORD1F5E4D0E', 2, 45000.00, 1, 'Giấy A4 Excel 70 Gsm', 45000.00, NULL, '/Upload/Product/02.jpg'),
(19, 'ORDB087E7E7', 7, 58000.00, 2, 'Bìa lỗ 320g - Xấp 100 tờ', 29000.00, NULL, '/Upload/Product/07.jpg'),
(20, 'ORD145E9859', 11, 3000.00, 1, 'Kim bấm số 10 Plus', 3000.00, NULL, '/Upload/Product/11.jpg'),
(21, 'ORD75C31B0B', 24, 24000.00, 1, 'Bút xóa nước Thiên Long CP02', 24000.00, NULL, '/Upload/Product/24.jpg'),
(22, 'ORDED50C461', 29, 8000.00, 1, 'Băng keo trong 1.2F (lõi lớn)', 8000.00, NULL, '/Upload/Product/29.jpg'),
(23, 'ORDDF87B46D', 14, 31000.00, 1, 'Đồ bấm kim số 10 Plus', 31000.00, NULL, '/Upload/Product/14.jpg'),
(24, 'ORDC41063F1', 25, 20000.00, 1, 'Băng xóa kéo plus mini - 7m', 20000.00, NULL, '/Upload/Product/25.jpg'),
(25, 'ORD3B19F5CC', 5, 186000.00, 1, 'Giấy A3 Double A 80 Gsm', 186000.00, NULL, '/Upload/Product/05.jpg'),
(26, 'ORDB8C0C7F6', 21, 4000.00, 1, 'Bút bi Thiên Long TL027 - xanh', 4000.00, NULL, '/Upload/Product/21.jpg'),
(27, 'ORD86432420', 15, 13000.00, 1, 'Kim bấm số 3 Plus', 13000.00, NULL, '/Upload/Product/15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `UnitPrice` decimal(8,2) NOT NULL,
  `PriceSale` decimal(8,2) NOT NULL,
  `Description` text DEFAULT NULL,
  `ImageURL` varchar(255) NOT NULL,
  `StockQuantity` int(10) NOT NULL,
  `IsAvailable` tinyint(1) NOT NULL DEFAULT 1,
  `IsHot` tinyint(1) NOT NULL DEFAULT 0,
  `Created_at` datetime NOT NULL,
  `Updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `CategoryId`, `ProductName`, `UnitPrice`, `PriceSale`, `Description`, `ImageURL`, `StockQuantity`, `IsAvailable`, `IsHot`, `Created_at`, `Updated_at`) VALUES
(1, 1, 'Giấy A4 IK Natural 70 Gsm', 62000.00, 62000.00, 'Bề mặt mịn của giấy cho ta biết được giấy ít bị bám bụi, nhờ đó mà mực bám vào giấy chặt và khó phai. Một tờ giấy mịn sẽ có khả năng thấm mực tốt hơn, tình trạng kẹt giấy khi in cũng giảm đi. Khi sờ và cảm nhận, bạn sẽ biết được bề mặt giấy IK Natural đạt yêu cầu. Công đoạn loại bỏ tạp chất trong bột gỗ khá tốt, vì vậy cho ra màu giấy trắng sáng tự nhiên.\r\n\r\nĐối với các dòng giấy dùng trong in ấn giấy tờ trong công ty hay các doanh nghiệp, thông thường người ta sử dụng giấy định lượng 70-80gsm. Đây là loại phổ biến dùng trong các văn phòng, công sở hay dùng tại nhà. Chất lượng giấy và độ dày ổn định, có thể lưu trữ lâu dài. Giấy in A4 IK Natural 70 gsm vừa đủ để đảm bảo chất lượng các bản in đạt yêu cầu rõ nét, mỏng vừa phải, dễ lật và bảo quản. ', '/Upload/Product/01.jpg', 100, 1, 0, '2024-10-28 08:50:16', '2024-10-28 08:50:16'),
(2, 1, 'Giấy A4 Excel 70 Gsm', 45000.00, 45000.00, 'Các cuộn giấy Excel được sản xuất tại Indonesia với công nghệ đạt chuẩn, sau đó được nhập khẩu về Việt Nam. Trải qua công đoạn cắt và đóng gói trong nước nên có lợi thế về giá thành hơn so với các đối thủ khác.\r\n\r\nPhần mặt giấy trải qua nhiều công đoạn sản xuất phức tạp, đòi hỏi về trình độ máy móc cao. Công nghệ sản xuất hạn chế các chất tẩy trắng, nhờ đó nên giấy giữ được màu trắng sáng tự nhiên, nhìn kỹ bạn sẽ thấy giấy có màu trắng ánh xanh nhẹ, không làm đau mắt khi đọc trong thời gian dài. \r\n\r\nSo với hầu hết các dòng giấy ngày nay với cùng mức giá giấy Excel, chất lượng giấy mặt bằng chung đều đã đạt đến chất lượng ổn định. Tuy nhiên so với một hãng giấy mang thương hiệu “ngoại nhập” cộp mác Indonesia, mức giá này có vẻ “hời” hơn nhờ lợi thế trong công đoạn đóng gói.\r\n\r\nĐịnh lượng giấy có ảnh hưởng đáng kể đến giá thành sản phẩm. Giấy A4 Excel định lượng 70gsm cực kỳ phù hợp khi bạn muốn in tài liệu hoặc các loại giấy tờ quan trọng. Chất giấy có độ dày dặn cao, khả năng cản quang tốt. ', '/Upload/Product/02.jpg', 100, 1, 0, '2024-10-28 08:50:16', '2024-10-28 08:50:16'),
(3, 1, 'Giấy A4 Excel 80 Gsm', 51000.00, 51000.00, 'Các cuộn giấy Excel được sản xuất tại Indonesia với công nghệ đạt chuẩn, sau đó được nhập khẩu về Việt Nam. Trải qua công đoạn cắt và đóng gói trong nước nên có lợi thế về giá thành hơn so với các đối thủ khác.\r\n\r\nPhần mặt giấy trải qua nhiều công đoạn sản xuất phức tạp, đòi hỏi về trình độ máy móc cao. Công nghệ sản xuất hạn chế các chất tẩy trắng, nhờ đó nên giấy giữ được màu trắng sáng tự nhiên, nhìn kỹ bạn sẽ thấy giấy có màu trắng ánh xanh nhẹ, không làm đau mắt khi đọc trong thời gian dài. \r\n\r\nSo với hầu hết các dòng giấy ngày nay với cùng mức giá giấy Excel, chất lượng giấy mặt bằng chung đều đã đạt đến chất lượng ổn định. Tuy nhiên so với một hãng giấy mang thương hiệu “ngoại nhập” cộp mác Indonesia, mức giá này có vẻ “hời” hơn nhờ lợi thế trong công đoạn đóng gói.\r\n\r\nĐịnh lượng giấy có ảnh hưởng đáng kể đến giá thành sản phẩm. Giấy A4 Excel định lượng 80gsm cực kỳ phù hợp khi bạn muốn in tài liệu hoặc các loại giấy tờ quan trọng. Chất giấy có độ dày dặn cao, khả năng cản quang tốt. ', '/Upload/Product/03.jpg', 100, 1, 0, '2024-10-28 08:50:16', '2024-10-28 08:50:16'),
(4, 1, 'Giấy A5 Double A 70 Gsm', 39000.00, 39000.00, 'Giấy A5 Double A 70 Gsm - chính hãng: Loại giấy in cao cấp, trắng, đẹp, thích hợp với tất cả các loại Máy in phun, Máy in Laser,\r\n\r\nMáy Fax laser, Máy Photocopy. In đảo 2 mặt không lo kẹt giấy.\r\n\r\nGiấy được đóng gói và nhập khẩu từ Thailand\r\n\r\nKhổ A5 (500sheets/ Ream)', '/Upload/Product/04.jpg', 100, 1, 0, '2024-10-28 08:50:16', '2024-10-28 08:50:16'),
(5, 1, 'Giấy A3 Double A 80 Gsm', 186000.00, 186000.00, 'Giấy A5 Double A 80 Gsm - chính hãng: Loại giấy in cao cấp, trắng, đẹp, thích hợp với tất cả các loại Máy in phun, Máy in Laser,\r\n\r\nMáy Fax laser, Máy Photocopy. In đảo 2 mặt không lo kẹt giấy.\r\n\r\nGiấy được đóng gói và nhập khẩu từ Thailand\r\n\r\nKhổ A5 (500sheets/ Ream)', '/Upload/Product/05.jpg', 99, 1, 0, '2024-10-28 08:50:16', '2024-10-28 08:50:16'),
(6, 2, 'Bìa nút Myclear F4 (26x35cm)', 3000.00, 3000.00, 'ĐƠN VỊ TÍNH: 1 CÁI\r\nQUY CÁCH: 12cái/xấp\r\n\r\nLoại F4 sẽ lớn hơn A4', '/Upload/Product/05.jpg', 100, 1, 0, '2024-10-28 09:07:14', '2024-10-28 09:07:14'),
(7, 2, 'Bìa lỗ 320g - Xấp 100 tờ', 29000.00, 29000.00, 'Bìa lỗ 320g - Xấp 100 tờ', '/Upload/Product/07.jpg', 100, 1, 0, '2024-10-28 09:09:12', '2024-10-28 09:09:12'),
(8, 2, 'Bìa còng 7F Thiên Long F4 (chiều cao bìa 34cm)', 43000.00, 43000.00, 'Vật liệu Simili cao cấp\r\nBìa cứng, chắc bền\r\nCòng chắc khỏe, được phủ lớp chống oxy hóa\r\nCó thanh giữ hồ sơ chắc chắn\r\n\r\nĐơn vị tính: Cái\r\n\r\nMàu sắc: xanh dương', '/Upload/Product/08.jpg', 100, 1, 0, '2024-10-28 09:09:12', '2024-10-28 09:09:12'),
(9, 2, 'Bìa phân trang nhựa 31 số', 29000.00, 29000.00, 'Là sản phẩm được làm bằng nhựa mềm có độ dai bền cao, gồm có 31 bìa \r\n\r\nKích thước bìa khổ A4, phù hợp với các File hồ sơ cùng kích thước khổ A4.\r\n\r\nBên mép trái có 1 hàng lỗ, mục đích để dùng để sỏ vào còng sắt của các bìa còng, bìa accor, bìa còng nhẫn....\r\n\r\nBên mép phải gồm 2 màu sắc có đánh số thứ tự theo 31 chữ cái để phân biệt. Cách đánh dấu các chữ cái để phân biệt các chỉ mục, khi cần tìm giấy tờ, tài liệu của phần nào, chỉ cần tìm đúng màu sắc và chữ cái ở phần đó.', '/Upload/Product/09.jpg', 100, 1, 0, '2024-10-28 09:09:12', '2024-10-28 09:09:12'),
(10, 2, 'Bìa thái A3 hồng - 180 Gsm', 70000.00, 70000.00, 'Sử dụng bìa thái A3 định lượng 180gsm để làm tăng tính chuyên nghiệp và tạo sức hút cho bộ tài liệu, báo cáo của bạn. Ngoài ra, bạn còn có thể sử dụng loại giấy này để làm thiệp, cắt dán hộp quà, trang trí... Sản phẩm sẽ hỗ trợ bạn tối đa trong học tập, làm việc và sáng tạo.', '/Upload/Product/10.jpg', 100, 1, 0, '2024-10-28 09:09:12', '2024-10-28 09:09:12'),
(11, 3, 'Kim bấm số 10 Plus', 3000.00, 3000.00, 'Công dụng Kim bấm số 10 Plus là loại kim dùng cho dụng cụ bấm kim số 10 giúp giữ cho các tập tài liệu giấy chắc chắn không bị bung rời, có thể sử dụng cho nhiều loại bấm kim số 10.\r\n\r\nSản phẩm thiết kế đơn giản, dễ sử dụng và không độc hại, số lượng giấy bấm tùy theo đặc tính của kim bấm số 10.\r\n\r\nĐặc Điểm Chất liệu bền bỉ, tiện dụng cho văn phòng và cơ sở in ấn.\r\n\r\nKim bấm số 10 dùng cho bấm kim số 10 phổ biến.\r\n\r\nGiúp kẹp bấm giấy tờ đồng bộ và tránh thất lạc.\r\n\r\nĐơn Vị Tính hộp\r\n\r\nQuy Cách 20 hộp nhỏ/ 1 hộp lớn', '/Upload/Product/11.jpg', 100, 1, 0, '2024-10-28 09:46:31', '2024-10-28 09:46:31'),
(12, 3, 'Kẹp giấy tam giác C62', 3000.00, 3000.00, 'Công dụng có thể kẹp chặt lượng tài liệu ít, mỏng tối đa 10 tờ A4 để không bị bung rời.\r\n\r\nSản phẩm thiết kế đơn giản, dễ sử dụng mà không bị đau tay. Sử dụng kẹp phổ biến trong việc bảo quản, phân loại và tránh thất lạc các liên giấy, tài liệu rời. \r\n\r\nNhờ đó mà công tác văn phòng sẽ trở nên đơn giản và nhẹ nhàng hơn.\r\n\r\nĐặc Điểm : Loại kẹp nhỏ gọn, dễ sử dụng.\r\n\r\nBền bỉ và không gỉ sét mang đến hiệu quả lâu dài.\r\n\r\nSử dụng hàng ngày trong mọi văn phòng để sắp xếp giấy tờ.\r\n \r\nĐơn Vị Tính : Hộp\r\nQuy Cách : 10 Hộp nhỏ/ 1 Hộp lớn', '/Upload/Product/12.jpg', 100, 1, 0, '2024-10-28 09:46:31', '2024-10-28 09:46:31'),
(13, 3, 'Kẹp bướm 15mm SLECHO (12 cái)', 5000.00, 5000.00, 'Kẹp bướm Slecho được sản xuất tại Việt Nam\r\n\r\nSản xuất bằng thép không rỉ rất an toàn khi sử dụng\r\n\r\nTay kẹp chắc chắn giúp kẹp số lượng lớn giấy tờ, tài liệu\r\n\r\nĐóng gói: 12 chiếc/ hộp (tất cả các cỡ)', '/Upload/Product/13.jpg', 100, 1, 0, '2024-10-28 09:46:31', '2024-10-28 09:46:31'),
(14, 3, 'Đồ bấm kim số 10 Plus', 31000.00, 31000.00, 'Bấm kim số 10 Plus được sản xuất tại nhà máy ở Khu công nghiệp Nhơn Trạch, tỉnh Đồng Nai bằng công nghệ Nhật Bản nên quý khách hàng có thể yên tâm vào chất lượng, hơn nữa với Bấm kim số 10 Plus đã được tạo được 1 thương hiệu vững chắc, đã đang và sẽ đồng hành cùng thành công của quý vị', '/Upload/Product/14.jpg', 100, 1, 0, '2024-10-28 09:46:31', '2024-10-28 09:46:31'),
(15, 3, 'Kim bấm số 3 Plus', 13000.00, 13000.00, 'Công dụng để kết nối tối đa 30 tờ giấy định lượng 70gsm. Kim bấm Plus phù hợp với các loại bấm kim văn phòng cỡ số 3 và máy bấm kim cán dài... giúp giữ cho các tập tài liệu giấy chắc chắn không bị bung rời.\r\n\r\nĐặc Điểm Chất liệu kim Plus là loại thép chuyên dụng độ cứng cao giúp dễ dàng đâm xuyên các tập giấy dày. Hơn nữa, loại kim bấm này ít bị gỉ sét, thanh kim dài chứa nhiều kim thuận tiện và dễ dàng trong quá trình bấm tài liệu. Quy cách hộp nhỏ 1000 kim dễ bảo quản và sử dụng trong thời gian dài.\r\n\r\nĐơn Vị Tính hộp\r\nQuy Cách 10 hộp nhỏ/ 1 hộp lớn', '/Upload/Product/15.jpg', 100, 1, 0, '2024-10-28 09:46:31', '2024-10-28 09:46:31'),
(16, 4, 'Sổ lò xo A5 (15x21cm)', 23000.00, 23000.00, 'Sổ lò xo A5 dày - 160 trang\r\n\r\nĐặc điểm: là sổ tập dạng ghi chú khổ A5, giấy kẻ ngang trắng đẹp ĐL 70gsm, dày 160 trang có lò xo bên mép trái thuận tiện cho việc ghi chép hoặc xé rời các trang cần thiết phục vụ cho công việc văn phòng', '/Upload/Product/16.jpg', 100, 1, 0, '2024-10-28 09:56:09', '2024-10-28 09:56:09'),
(17, 4, 'Bao thư trắng 12x22 - 80g (100 cái)', 21000.00, 21000.00, 'Công dụng thuận tiện cho việc lưu trữ, ký gởi các chứng từ như hóa đơn VAT, giấy tờ khổ nhỏ trong văn phòng\r\n\r\nĐặc Điểm\r\n-Được thiết kế với khổ giấy 12x22cm (80gsm)\r\n\r\nĐơn Vị Tính Xấp\r\nQuy Cách : 100 Cái / Xấp . 50 Xấp/Thùng', '/Upload/Product/17.jpg', 100, 1, 0, '2024-10-28 09:56:09', '2024-10-28 09:56:09'),
(18, 4, 'Sổ da CK7 dày (16 x 21 cm)', 28000.00, 28000.00, 'Sổ da CK7 dày (16 x 21 cm)', '/Upload/Product/18.jpg', 100, 1, 0, '2024-10-28 09:56:09', '2024-10-28 09:56:09'),
(19, 4, 'Sổ lò xo A4 (21x30cm)', 42000.00, 42000.00, 'Công Dụng chuyên dùng để ghi chép các thông tin khi hội họp hay note các dữ liệu của công việc. Thiết kế gọn gàng, chất lượng giấy cao cấp, an toàn cho sức khỏe người dùng nên được dân văn phòng yêu thích và ưu tiên lựa chọn.\r\n\r\nĐặc Điểm là loại sổ đóng gáy lò xo chắc chắn giúp dễ dàng cho việc lật giở, bìa dày có nhiều màu sắc cá tính và sở hữu thiết kế trang nhã. Độ trắng 92% đạt tiêu chuẩn ISO chất lượng cao, chống lóa, mỏi mắt. Sản phẩm được sản xuất từ công nghệ tiên tiến, sử dụng loại bột giấy cao cấp giúp bề mặt giấy mịn đẹp, bám mực tốt và không bị lem nhòe qua mặt sau.\r\n\r\nĐơn Vị Tính : Cuốn\r\nQuy Cách : 21x30 Khổ A4', '/Upload/Product/19.jpg', 100, 1, 0, '2024-10-28 09:56:09', '2024-10-28 09:56:09'),
(20, 4, 'Bao thư trắng A5 - 80gsm - DỌC (18x24cm) ( Xấp 100 Cái)', 70000.00, 70000.00, 'Bao thư trắng A5 - 80gsm - DỌC (18x24cm) (Xấp 100 Cái)', '/Upload/Product/20.jpg', 100, 1, 0, '2024-10-28 09:56:09', '2024-10-28 09:56:09'),
(21, 5, 'Bút bi Thiên Long TL027 - xanh', 4000.00, 4000.00, 'Đầu bi: 0.5mm, sản xuất tại Thụy Sĩ.\r\nBút bi dạng bấm cò.\r\nNơi tì ngón tay có tiết diện hình tam giác vừa vặn với tay cầm giúp giảm trơn tuột khi viết thường xuyên.\r\nĐộ dài viết được: 1.600-2.000m\r\nMực đạt chuẩn: ASTM D-4236, ASTM F 963-91, EN71/3, TSCA.', '/Upload/Product/21.jpg', 99, 1, 0, '2024-10-28 10:07:32', '2024-10-28 10:07:32'),
(22, 5, 'Bút lông bảng Thiên Long WB03 Xanh', 8000.00, 8000.00, '- Bút được sản xuất theo công nghệ hiện đại , đạt tiêu chuẩn an toàn quốc tế\r\n- Viết tốt , trơn , êm trơn bảng trắng , thủy tinh và những bề mặt nhẵn bóng\r\n- Sử dụng mực mới , tốt , màu mức đậm , tươi sáng , dễ dàng xóa sạch ngay cả khi viết trên bảng lâu và không để lại bóng mực sau khi lau bảng và các bề mặt nhẵn bóng\r\n- Bơm mực dễ dàng , bao bì được thiết kế đẹp\r\n- Đầu bút xóa thuận tiện khi sử dụng .\r\n- Mực không độc hàng , dạt tiêu chuẩn an toàn quốc tế .\r\n- Sợi Polyeste viết êm , nhập khẩu Nhật Bản.\r\n- Đầu bút ngoại nhập chất lượng cao, nét viết êm, có thể sử dụng được nhiều lần.\r\n- Nắp bút có “ ink stopper “ ( vòng tròn giữ mực trên đầu bút , giúp giữ cho nét viết có màu ổn định trong suốt quá trình sử dụng , lưu trữ , bảo quản .\r\n- Không gây độc hại.\r\n- Luôn đặt bút nằm ngang và đậy nắp sau khi sử dụng.\r\n- Có thể bơm thêm mực tái sử dụng nhiều lần\r\nĐơn Vị Tính : Cây - 10cây / hộp\r\nQuy Cách : Bề rộng nét viết 2.5mm\r\nMàu Sắc : Xanh/Đỏ/Đen', '/Upload/Product/22.jpg', 100, 1, 0, '2024-10-28 10:07:32', '2024-10-28 10:07:32'),
(23, 5, 'Gôm Pentel Nhỏ (ZEH-03)', 2000.00, 2000.00, 'HỘP = 60 cục', '/Upload/Product/23.jpg', 100, 1, 0, '2024-10-28 10:07:32', '2024-10-28 10:07:32'),
(24, 5, 'Bút xóa nước Thiên Long CP02', 24000.00, 24000.00, 'Bút xóa Thiên Long CP02 có kiểu dáng thân dẹp, vừa tầm tay , thuận tiện khi sử dụng. Cán bằng nhựa màu xanh lá thể hiện sự trẻ trung , năng động. Đầu bút bằng kim loại có lò xo đàn hồi tốt.', '/Upload/Product/24.jpg', 100, 1, 0, '2024-10-28 10:07:32', '2024-10-28 10:07:32'),
(25, 5, 'Băng xóa kéo plus mini - 7m', 20000.00, 20000.00, 'Bút xóa kéo mini Plus mặc dù size nhỏ nhưng phần ruột xoá vẫn được chú trọng giữ nguyên độ dài để đảm bảo việc tẩy xóa. Mỗi chiếc có độ dày tiêu chuẩn 5mm, độ dài cuộn giấy xoá là 7m. Tổng thể phần băng kéo có màu trắng, tương đồng với nhiều loại giấy phổ biến hiện nay. ', '/Upload/Product/25.jpg', 99, 1, 0, '2024-10-28 10:07:32', '2024-10-28 10:07:32'),
(26, 6, 'Băng keo giấy 2.4cm - 13 mét', 5000.00, 5000.00, 'Độ dính cao, tiện sử dụng\r\n\r\nGiấy dùng để dán vào các sản phẩm cần ghi rõ để tránh nhầm, hoặc để phun sơn lên sản phẩm mà không bị lem sơn ra chỗ khác.\r\n\r\nĐóng gói: 12 cuộn/ cây.\r\n\r\nĐơn vị tính: Cuộn\r\n\r\nBăng keo giấy 2.4cm - Dán lá dính', '/Upload/Product/26.jpg', 100, 1, 0, '2024-10-28 10:11:50', '2024-10-28 10:11:50'),
(27, 6, 'Keo gạt Thiên Long TP-G08', 4000.00, 4000.00, 'Keo gạt Thiên Long TP-G08', '/Upload/Product/27.jpg', 100, 1, 0, '2024-10-28 10:11:50', '2024-10-28 10:11:50'),
(28, 6, 'Lưỡi dao rọc giấy SDI nhỏ 1403', 10000.00, 10000.00, '\r\nCông dụng sử dụng cho dao rọc giấy trung SDI 0404, rất phổ biển trong văn phòng công ty, dùng để rọc giấy hoặc một số công việc thủ công khác.\r\n\r\nLưỡi làm bằng chất liệu kim loại có độ cứng cao, lưỡi dao sắc bén giúp cho đường rọc trở nên thẳng và chính xác hơn. Thiết kế hộp đựng bằng nhựa dễ dàng bảo quản và tiện lấy dùng khi cần.\r\n\r\nĐơn Vị Tính : Hộp\r\n\r\nHộp lớn = 20 vĩ ', '/Upload/Product/28.jpg', 100, 1, 0, '2024-10-28 10:11:50', '2024-10-28 10:11:50'),
(29, 6, 'Băng keo trong 1.2F (lõi lớn)', 8000.00, 8000.00, 'Được làm từ màng BOPP có độ bền cao, cộng keo tráng được lựa chọn làm băng keo có độ dính cao, khả năng đàn hồi tốt.\r\n\r\nCó thể dính rất chắc trên nhiều chất liệu khác nhau.\r\n\r\nCông nghệ hiện đại, đạt tiêu chuẩn quốc tế, thân thiện với môi trường.', '/Upload/Product/29.jpg', 100, 1, 0, '2024-10-28 10:11:50', '2024-10-28 10:11:50'),
(30, 6, 'Dao rọc giấy nhỏ inox 30 độ Deli - 2034', 36000.00, 36000.00, 'HỘP = 36 VĨ', '/Upload/Product/30.jpg', 100, 1, 0, '2024-10-28 10:11:50', '2024-10-28 10:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `PasswordHash`, `Role`, `IsActive`) VALUES
(1, 'nxhoa', '$2y$10$8W.29NJnBbn9Qwy62yB/UOH3WROvWbupn7eSvz6uiagB1UbPA44Xi', 'customer', 1),
(2, 'vmhoang', 'vmhoang', 'customer', 1),
(3, 'customer', 'customer', 'customer', 1),
(4, 'buyer', 'buyer', 'customer', 1),
(5, '12345678', '12345678', 'customer', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cart_customerid_foreign` (`CustomerId`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cartitem_id_foreign` (`CartId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `customer_userid_foreign` (`UserID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderCode`),
  ADD KEY `order_customerid_foreign` (`CustomerId`),
  ADD KEY `OrderCode` (`OrderCode`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `orderdetail_orderid_foreign` (`OrderCode`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `product_categoryid_foreign` (`CategoryId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_username_unique` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_customerid_foreign` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`ID`);

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_id_foreign` FOREIGN KEY (`CartId`) REFERENCES `cart` (`ID`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_userid_foreign` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_customerid_foreign` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`ID`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_orderid_foreign` FOREIGN KEY (`OrderCode`) REFERENCES `order` (`OrderCode`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_categoryid_foreign` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
