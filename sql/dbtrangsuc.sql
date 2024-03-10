-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 09:03 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `IDdonhang` int(11) NOT NULL,
  `tongtien` float DEFAULT NULL,
  `soluongsanpham` int(11) DEFAULT NULL,
  `thoigiandat` datetime DEFAULT NULL,
  `trangthai` varchar(30) DEFAULT NULL,
  `IDsanpham` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giaodich`
--

CREATE TABLE `giaodich` (
  `IDgiaodich` int(11) NOT NULL,
  `thoigiangiaodich` time DEFAULT NULL,
  `hinhthucthanhtoan` varchar(30) DEFAULT NULL,
  `IDnhanvien` int(11) DEFAULT NULL,
  `IDtaikhoan` int(11) DEFAULT NULL,
  `IDdonhang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `IDgiohang` int(11) NOT NULL,
  `soluong` int(11) DEFAULT NULL,
  `IDdonhang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `IDkhachhang` int(11) NOT NULL,
  `hoten` varchar(50) DEFAULT NULL,
  `diachi` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sodienthoai` varchar(10) DEFAULT NULL,
  `IDrole` int(11) DEFAULT NULL,
  `IDtaikhoan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khohang`
--

CREATE TABLE `khohang` (
  `IDkhohang` int(11) NOT NULL,
  `thoigianxuathang` date DEFAULT NULL,
  `thoigiannhaphang` date DEFAULT NULL,
  `tonkho` int(11) DEFAULT NULL,
  `soluongxuat` int(11) DEFAULT NULL,
  `soluongnhap` int(11) DEFAULT NULL,
  `IDsanpham` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `IDnhanvien` int(11) NOT NULL,
  `hoten` varchar(50) DEFAULT NULL,
  `diachi` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sodienthoai` varchar(10) DEFAULT NULL,
  `IDrole` int(11) DEFAULT NULL,
  `IDtaikhoan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phanloai`
--

CREATE TABLE `phanloai` (
  `IDloai` int(11) NOT NULL,
  `soluong` int(11) DEFAULT NULL,
  `tenloai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phanquyen`
--

CREATE TABLE `phanquyen` (
  `IDquyen` int(11) NOT NULL,
  `tenquyen` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quanly`
--

CREATE TABLE `quanly` (
  `IDquanly` int(11) NOT NULL,
  `hoten` varchar(50) DEFAULT NULL,
  `diachi` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sodienthoai` varchar(10) DEFAULT NULL,
  `IDrole` int(11) DEFAULT NULL,
  `IDnhanvien` int(11) DEFAULT NULL,
  `IDtaikhoan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `IDsp` int(11) NOT NULL,
  `tensp` varchar(50) DEFAULT NULL,
  `giasp` varchar(50) DEFAULT NULL,
  `mota` varchar(50) DEFAULT NULL,
  `hinhanh` varchar(150) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `IDloai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `IDtaikhoan` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `IDrole` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`IDtaikhoan`, `username`, `password`, `IDrole`) VALUES
(1, 'user', 'admin', 1),
(2, 'thu', '123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`IDdonhang`);

--
-- Indexes for table `giaodich`
--
ALTER TABLE `giaodich`
  ADD PRIMARY KEY (`IDgiaodich`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`IDgiohang`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`IDkhachhang`);

--
-- Indexes for table `khohang`
--
ALTER TABLE `khohang`
  ADD PRIMARY KEY (`IDkhohang`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`IDnhanvien`);

--
-- Indexes for table `phanloai`
--
ALTER TABLE `phanloai`
  ADD PRIMARY KEY (`IDloai`);

--
-- Indexes for table `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`IDquyen`);

--
-- Indexes for table `quanly`
--
ALTER TABLE `quanly`
  ADD PRIMARY KEY (`IDquanly`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`IDsp`),
  ADD KEY `IDloai` (`IDloai`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`IDtaikhoan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`IDloai`) REFERENCES `phanloai` (`IDloai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
