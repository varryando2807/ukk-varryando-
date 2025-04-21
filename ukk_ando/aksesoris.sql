

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 06:53 AM
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
-- Database: `dbtoko`
--

-- --------------------------------------------------------

--
-- Table structure for table `aksesoris`
--

CREATE TABLE `aksesoris` (
  `Id_aksesoris` int(11) NOT NULL,
  `Nama_aksesoris` varchar(255) NOT NULL,
  `Satuan` varchar(50) NOT NULL,
  `Harga_beli` decimal(10,2) NOT NULL,
  `Harga_jual` decimal(10,2) NOT NULL,
  `Jumlah_stok` int(11) NOT NULL,
  `User_name` varchar(100) NOT NULL,
  `Tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aksesoris`
--

INSERT INTO `aksesoris` (`Id_aksesoris`, `Nama_aksesoris`, `Satuan`, `Harga_beli`, `Harga_jual`, `Jumlah_stok`, `User_name`, `Tgl_input`) VALUES
(1, 'jepit rambut', '3', 10000.00, 15000.00, 50, '788', '2025-01-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aksesoris`
--
ALTER TABLE `aksesoris`
  ADD PRIMARY KEY (`Id_aksesoris`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aksesoris`
--
ALTER TABLE `aksesoris`
  MODIFY `Id_aksesoris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
