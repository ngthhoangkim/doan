-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 05:26 AM
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
-- Database: `dbtrangsuc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'in progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `qty` int(20) NOT NULL,
  `price` int(20) NOT NULL,
  `method` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `id_type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `qty`, `price`, `method`, `image`, `id_type`) VALUES
(6, '5 HEART LINE', 50, 390000, 'Chiếc nhẫn là biểu tượng của tình yêu và sự thanh ', '5 HEART LINE.webp', 5),
(7, 'BIG BUTTERFLY', 50, 450000, 'Nhẫn midi bạc cao cấp được thiết kế theo phong các', 'BIG BUTTERFLY.webp', 5),
(8, 'SLEEK 8 MM (NAM)', 50, 550000, 'Nhẫn bạc cỡ lớn cao cấp 925 được thiết kế theo pho', 'SLEEK 8 MM (NAM).webp', 5),
(9, 'SLEEK 6 MM (NAM)', 50, 450000, 'Nhẫn bạc cỡ lớn cao cấp 925 được thiết kế theo pho', 'SLEEK 6 MM (NAM).webp', 5),
(10, 'CHAIN 01 (NAM)', 50, 390000, 'Nhẫn bạc cỡ lớn cao cấp 925 được thiết kế theo pho', 'CHAIN 01 (NAM).webp', 5),
(11, 'FLOWING PATTERN', 50, 390000, 'Nhẫn bạc cỡ lớn cao cấp 925 được thiết kế theo pho', 'FLOWING PATTERN (NAM).webp', 5),
(12, 'BLINK NAIL', 50, 690000, 'Chiếc nhẫn là một thiết kế độc đáo. Bề mặt của nhẫ', 'BLINK NAIL.webp', 5),
(13, 'CRESCENT MOON SUN OPAL', 50, 490000, 'Chiếc nhẫn \"Crescent Moon Sun Opal\" là một món tra', 'CRESCENT MOON SUN OPAL.webp', 5),
(14, 'CROWN', 50, 250000, 'Chiếc nhẫn \"Crown\" là một món trang sức đẹp và độc', 'CROWN.webp', 5),
(15, 'CURVE BAR', 50, 270000, 'Với sự đơn giản và tinh tế của nó, chiếc nhẫn \"Cur', 'CURVE BAR.webp', 5),
(16, 'DOUBLE BIG LEAF', 50, 350000, 'Với sự tươi mát và tự nhiên của nó, chiếc nhẫn \"Do', 'DOUBLE BIG LEAF.webp', 5),
(17, 'DOUBLE LINE CLOVE', 50, 250000, 'Với sự hiện diện của biểu tượng lá bốn lá, chiếc n', 'DOUBLE LINE CLOVER.webp', 5),
(18, 'DOUBLE OPEN TWIST LEAF', 50, 250000, 'Với hình dạng lá cây nhẹ nhàng và các chi tiết tin', 'DOUBLE OPEN TWIST LEAF.webp', 5),
(19, 'LEAF', 50, 210000, 'Chiếc nhẫn \"Leaf\" có hình dạng và đường nét mô phỏ', 'LEAF.webp', 5),
(20, 'MULTI TINY FLOWER', 50, 390000, 'Với sự chi tiết và tinh tế của từng bông hoa nhỏ, ', 'MULTI TINY FLOWER.webp', 5),
(21, 'DOUBLE BUBBLE HEART', 50, 270000, 'Với sự kết hợp của hai hình trái tim nhỏ, chiếc nh', 'Nhẫn DOUBLE BUBBLE HEART.webp', 5),
(22, 'TWIS THREAD', 50, 250000, 'Sợi dây xoắn trong chiếc nhẫn \"Twist Thread\" tạo r', 'TWIS THREAD.webp', 5),
(23, 'TWIST LEAF', 50, 450000, 'Các đường cong xoắn của chiếc nhẫn \"Twist Leaf\" tạ', 'TWIST LEAF.webp', 5),
(24, 'TWIST TRIPLE', 50, 490000, 'Sự kết hợp của ba sợi dây xoắn trong chiếc nhẫn \"T', 'TWIST TRIPLE.webp', 5),
(25, 'ZIG ZAG', 50, 330000, 'Các đường nét zig zag trong thiết kế \"Zig Zag\" tạo', 'ZIG ZAG.webp', 5),
(26, 'SUNFLOWER OPAL STONE', 50, 490000, 'Viên đá opal trong dây chuyền \"Sunflower Opal Ston', 'SUNFLOWER OPAL STONE.webp', 6),
(27, 'SMALL CRESCENT MOON AND SINGLE GEM', 50, 450000, 'Mặt trăng lưỡi liềm nhỏ trong dây chuyền \"Small Cr', 'SMALL CRESCENT MOON AND SINGLE GEM.webp', 6),
(28, 'BALLET GIRL TRIPLE PINK', 50, 490000, 'Hình ảnh cô gái nhảy múa ballet trong dây chuyền \"', 'BALLET GIRL TRIPLE PINK.webp', 6),
(29, 'CIRCLE SNOWFLAKE', 50, 450000, 'Hình dạng tuyết tinh trong dây chuyền \"Circle Snow', 'CIRCLE SNOWFLAKE.webp', 6),
(30, 'STAMP CIRCLE DAY AND NIGHT BLUE STONE', 50, 490000, 'Mặt ban ngày và ban đêm trong dây chuyền \"Stamp Ci', 'STAMP CIRCLE DAY AND NIGHT BLUE STONE.webp', 6),
(31, 'TURTLE', 50, 450000, 'Hình ảnh con rùa trong dây chuyền \"Turtle\" tạo ra ', 'TURTLE.webp', 6),
(32, 'KEY HEART', 50, 490000, 'Chiếc chìa khóa và trái tim trong dây chuyền \"Key ', 'KEY HEART.webp', 6),
(33, 'CRESCENT MOON BALL LINE CUBIC HEART', 50, 550000, 'Dây chuyền \"Crescent Moon Ball Line Cubic Heart\" l', 'CRESCENT MOON BALL LINE CUBIC HEART.webp', 6),
(34, 'CRESCENT MOON TINY GEM AND BLACK DROP', 50, 690000, 'Dây chuyền \"Crescent Moon Tiny Gem and Black Drop\"', 'CRESCENT MOON TINY GEM AND BLACK DROP.webp', 6),
(35, 'CRESCENT MOON TINY GEM WITH STAR INSIDE AND DOUBLE', 50, 550000, 'Dây chuyền \"Crescent Moon Tiny Gem with Star Insid', 'CRESCENT MOON TINY GEM WITH STAR INSIDE AND DOUBLE', 6),
(36, 'SQUARE ', 50, 390000, 'Hình dạng hình vuông trong dây chuyền \"Square\" tượ', 'SQUARE.webp', 6),
(37, 'BAMBOO', 50, 450000, 'Dây chuyền \"Bamboo\" là biểu tượng của sự mạnh mẽ, ', 'BAMBOO.webp', 6),
(38, 'STAR GEM DROP BLUE PLANET', 50, 590000, 'Hình dạng ngôi sao trong dây chuyền \"Star Gem Drop', 'STAR GEM DROP BLUE PLANET.webp', 6),
(39, 'SPARKLING STAR', 50, 490000, 'Dây chuyền \"Sparkling Star\" được trang trí bằng cá', 'SPARKLING STAR.webp', 6),
(40, 'CRESCENT MOON', 50, 450000, 'Hình dạng mặt trăng lưỡi liềm trong dây chuyền \"Cr', 'CRESCENT MOON.webp', 6),
(41, 'CORAL AZURE STONE', 50, 490000, 'Hình dạng của san hô trong dây chuyền \"Coral Azure', 'CORAL AZURE STONE.webp', 6),
(42, 'ROUND AND CZ', 50, 590000, 'Hình dạng tròn trong dây chuyền \"Round and CZ\" biể', 'ROUND AND CZ.webp', 6),
(43, '5MM CIRCLE', 50, 450000, 'Hình dạng hình tròn trong dây chuyền \"5mm Circle\" ', '5MM CIRCLE.webp', 6),
(44, 'DOUBLE HEART ', 50, 490000, 'Hình dạng trái tim trong dây chuyền \"Double Heart\"', 'DOUBLE HEART.webp', 6),
(45, 'DOT TWINKLE STAR ', 50, 450000, 'Hình dạng chấm tròn và ngôi sao trong dây chuyền \"', 'DOT TWINKLE STAR.webp', 6),
(46, 'STAR AND CRESCENT', 50, 450000, 'Biểu tượng ngôi sao và bán nguyệt trong vòng tay \"', 'STAR AND CRESCENT.webp', 7),
(47, 'SLEEK 5MM', 50, 990000, 'Vòng tay \"Sleek 5mm\" thích hợp để đeo hàng ngày và', 'SLEEK 5MM.webp', 7),
(48, 'THIN DOUBLE BALL', 50, 590000, 'Vòng tay \"Thin Double Ball\" là một lựa chọn tuyệt ', 'THIN DOUBLE BALL.webp', 7),
(49, 'BABY MULTI FLOWER ', 50, 690000, 'Vòng tay \"Baby Multi Flower\" thích hợp để đeo hàng', 'BABY MULTI FLOWER.webp', 7),
(50, 'BIG DAISY', 50, 550000, 'Với hoa cúc lớn, vòng tay \"Big Daisy\" tạo ra một đ', 'BIG DAISY.webp', 7),
(51, 'BABY EXTENDABLE BIG BOW', 50, 850000, 'Vòng tay \"Baby Extendable Big Bow\" thích hợp để đe', 'BABY EXTENDABLE BIG BOW.webp', 7),
(52, 'UNISEX OPEN HEXAGON', 50, 490000, 'Với hình sáu cạnh mở, vòng tay \"Unisex Open Hexago', 'UNISEX OPEN HEXAGON.webp', 7),
(53, 'DOUBLE DAISY FLOWER', 50, 550000, 'Với hai hoa cúc nhỏ kết nối, vòng tay \"Double Dais', 'DOUBLE DAISY FLOWER.webp', 7),
(54, '4 BUBBLE FLOWER', 50, 490000, 'Vòng tay \"4 Bubble Flower\" là một lựa chọn tuyệt v', '4 BUBBLE FLOWER.webp', 7),
(55, 'AZURE BLUE', 50, 490000, 'Với màu sắc xanh dương của biển, vòng tay \"Azure B', 'AZURE BLUE.webp', 7),
(56, 'LOTUS OVAL', 50, 550000, 'Với họa tiết hoa sen, bông tai \"Lotus Oval\" mang đ', 'LOTUS OVAL.webp', 8),
(57, 'CHAIN WATER', 50, 490000, 'Với hình dạng chuỗi nhỏ giống như dòng nước chảy, ', 'CHAIN WATER.webp', 8),
(58, 'DOUBLE STAR', 50, 390000, 'Với hai ngôi sao nhỏ kết hợp, bông tai \"Double Sta', 'DOUBLE STAR.webp', 8),
(59, 'DOUBLE DAISY FLOWER MATT', 50, 550000, 'Với hai bông hoa cúc nhỏ kết hợp, bông tai \"Double', 'DOUBLE DAISY FLOWER MATT.webp', 8),
(60, 'SUN SHINE', 50, 450000, 'Bông tai \"Sun Shine\" thích hợp để tạo điểm nhấn và', 'SUN SHINE.webp', 8);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(10) NOT NULL,
  `name_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name_type`) VALUES
(5, 'Nhẫn'),
(6, 'Dây chuyền '),
(7, 'Vòng tay'),
(8, 'Khuyên tai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `address`, `password`, `user_type`, `image`) VALUES
(1, 'ADMIN', 'admin@gmail.com', 0, '', '21232f297a57a5a743894a0e4a801fc3', 'admin', ''),
(2, 'Test', 'test@gmail.com', 0, '', '202cb962ac59075b964b07152d234b70', 'user', ''),
(4, 'Hoàng Kim', 'kim@gmail.com', 123456789, 'Hồ Chí Minh ', 'fb1eaf2bd9f2a7013602be235c305e7a', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `user_id_2` (`user_id`,`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_typle` (`id_type`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
