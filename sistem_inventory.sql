-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2026 at 03:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idBarang` varchar(20) NOT NULL,
  `namaBarang` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `idSupplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idBarang`, `namaBarang`, `harga`, `stok`, `idSupplier`) VALUES
('01', 'teh celup', 2000, 28, 1),
('02', 'beras', 15000, 22, 1),
('03', 'kopi', 2, 21, 1),
('04', 'air botol', 5000, 38, 1),
('05', 'gula pasir', 7000, 27, 1),
('06', 'kecap', 2000, 25, 1),
('07', 'minyak goreng', 18000, 29, 1),
('08', 'larutan', 5000, 20, 2),
('96', 'nabati', 2000, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `idDetail` int(11) NOT NULL,
  `idTransaksi` int(11) DEFAULT NULL,
  `idBarang` varchar(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`idDetail`, `idTransaksi`, `idBarang`, `jumlah`, `subtotal`) VALUES
(1, 1, '01', 2, 4000),
(2, 1, '02', 3, 45000),
(3, 2, '02', 1, 15000),
(4, 3, '05', 1, 7000),
(5, 3, '04', 2, 10000),
(6, 4, '96', 1, 2000),
(7, 4, '03', 3, 6),
(8, 5, '96', 2, 4000),
(9, 5, '02', 4, 60000),
(10, 6, '03', 2, 4),
(11, 7, '05', 2, 14000),
(12, 7, '07', 1, 18000),
(13, 8, '03', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `idKaryawan` int(11) NOT NULL,
  `namaKaryawan` varchar(100) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `noTelepon` varchar(20) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`idKaryawan`, `namaKaryawan`, `jabatan`, `noTelepon`, `userId`) VALUES
(1, 'tiara', 'kasir', '08888', NULL),
(2, 'fatir', 'kasir', '09999', NULL),
(3, 'dimas', 'kasir', '011111', NULL),
(4, 'tegar ', 'owner', '9292', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idSupplier` int(11) NOT NULL,
  `namaSupplier` varchar(100) DEFAULT NULL,
  `noTelepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idSupplier`, `namaSupplier`, `noTelepon`, `alamat`) VALUES
(1, 'PT Jaya Abadi', '08123456789', 'Jakarta'),
(2, 'PT abadi nan jaya', '081510134567', 'bandung'),
(3, 'PT sentosa', '0897564', 'bekasi');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idTransaksi` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `totalBayar` int(11) DEFAULT NULL,
  `namaKasir` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `tanggal`, `totalBayar`, `namaKasir`) VALUES
(1, '2026-01-19 11:30:35', 49000, 'admin'),
(2, '2026-01-19 12:27:55', 15000, 'admin'),
(3, '2026-01-19 12:41:33', 17000, 'admin'),
(4, '2026-01-19 12:53:16', 2006, 'admin'),
(5, '2026-01-19 19:46:28', 64000, 'admin'),
(6, '2026-01-22 14:39:52', 4, 'admin'),
(7, '2026-01-22 14:40:19', 32000, 'admin'),
(8, '2026-01-26 12:46:36', 4, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Owner','Kasir') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'Owner'),
(2, 'kasir', 'kasir123', 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idBarang`),
  ADD KEY `idSupplier` (`idSupplier`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`idDetail`),
  ADD KEY `idTransaksi` (`idTransaksi`),
  ADD KEY `idBarang` (`idBarang`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`idKaryawan`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idSupplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `idDetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `idKaryawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idSupplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`idSupplier`) REFERENCES `supplier` (`idSupplier`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`idTransaksi`) REFERENCES `transaksi` (`idTransaksi`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`idBarang`) REFERENCES `barang` (`idBarang`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
