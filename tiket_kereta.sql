-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2026 at 02:32 PM
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
-- Database: `tiket_kereta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'zahraa', '1234', 'admin'),
(2, 'makpidemigod', 'projekpwd', 'admin'),
(3, 'user1', 'projekpwd', 'user'),
(4, 'amini', '123', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `asal` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(10) DEFAULT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_per_orang` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status_pembayaran` varchar(30) DEFAULT 'Belum Dibayar',
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `jarak` int(11) DEFAULT NULL,
  `status_tiket` varchar(30) DEFAULT 'Menunggu Konfirmasi',
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `asal`, `tujuan`, `tanggal`, `jam`, `nama_pemesan`, `email`, `kelas`, `jumlah`, `harga_per_orang`, `total_harga`, `metode_pembayaran`, `status_pembayaran`, `bukti_pembayaran`, `jarak`, `status_tiket`, `username`) VALUES
(3, 'Bandung', 'Malang', '2026-05-08', '18.00', 'makfi', 'makfi@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Belum Dibayar', NULL, NULL, 'Menunggu Konfirmasi', NULL),
(4, 'Jakarta', 'Cirebon', '2026-04-29', '12:00', 'zahra', 'amini@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Belum Dibayar', NULL, NULL, 'Menunggu Konfirmasi', NULL),
(5, 'Jakarta', 'Bandung', '2026-04-30', '12:00', 'zahra', '123@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Belum Dibayar', NULL, NULL, 'Menunggu Konfirmasi', NULL),
(6, 'Surabaya', 'Yogyakarta', '2026-05-08', '20:00', 'zahra', 'amini@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Belum Dibayar', NULL, NULL, 'Menunggu Konfirmasi', NULL),
(8, 'Yogyakarta', 'Semarang', '2026-05-28', '18:00', 'zahra', 'amini@gmail.com', 'ekonomi', 1, 50000, 0, 'Transfer Bank', 'Belum Dibayar', NULL, 1, 'Menunggu Konfirmasi', NULL),
(9, 'Yogyakarta', 'Semarang', '2026-05-28', '18:00', 'zahra', 'amini@gmail.com', 'ekonomi', 1, 50000, 0, 'Transfer Bank', 'Belum Dibayar', NULL, 1, 'Menunggu Konfirmasi', NULL),
(10, 'Yogyakarta', 'Semarang', '2026-05-28', '18:00', 'zahra', 'amini@gmail.com', 'ekonomi', 1, 50000, 50000, 'Transfer Bank', 'Belum Dibayar', NULL, 1, 'Menunggu Konfirmasi', NULL),
(11, 'Yogyakarta', 'Semarang', '2026-05-28', '18:00', 'zahra', 'amini@gmail.com', 'ekonomi', 1, 50000, 50000, 'Transfer Bank', 'Belum Dibayar', NULL, 1, 'Menunggu Konfirmasi', NULL),
(12, 'Surabaya', 'Yogyakarta', '2026-05-20', '20:00', 'zahra', 'amini@gmail.com', 'vip', 1, 75000, 75000, 'Transfer Bank', 'Belum Dibayar', NULL, 1, 'Menunggu Konfirmasi', NULL),
(14, 'Bandung', 'Surabaya', '2026-06-03', '15:00', 'makfi', 'amini@gmail.com', 'ekonomi', 1, 200000, 200000, 'Transfer Bank', 'Belum Dibayar', NULL, 4, 'Menunggu Konfirmasi', NULL),
(18, 'Jakarta', 'Bandung', '2026-05-27', '05:00', 'charles', 'charles@gmail.com', 'vip', 1, 75000, 75000, 'E-Wallet', 'Sudah Bayar', 'bukti_1777695271_1395.png', 1, 'Menunggu Konfirmasi', NULL),
(19, 'Jakarta', 'Bandung', '2026-05-27', '05:00', 'charles', 'charles@gmail.com', 'vip', 1, 75000, 75000, 'QRIS', 'Belum Dibayar', NULL, 1, 'Menunggu Konfirmasi', NULL),
(20, 'Jakarta', 'Bandung', '2026-05-27', '05:00', 'charles', 'charles@gmail.com', 'vip', 1, 75000, 75000, 'QRIS', 'Belum Dibayar', NULL, 1, 'Menunggu Konfirmasi', NULL),
(21, 'Bandung', 'Yogyakarta', '2026-05-13', '12:00', 'charles', 'charles@gmail.com', 'vip', 1, 225000, 225000, 'QRIS', 'Sudah Bayar', 'bukti_1777696209_6125.png', 3, 'Menunggu Konfirmasi', NULL),
(22, 'Bandung', 'Yogyakarta', '2026-05-13', '12:00', 'makfi', 'makfitrain@gmail.com', 'ekonomi', 1, 150000, 150000, 'Transfer Bank', 'Belum Dibayar', NULL, 3, 'Menunggu Konfirmasi', NULL),
(23, 'Jakarta', 'Bandung', '2026-05-27', '09:00', 'makfi', 'makfitrain@gmail.com', 'ekonomi', 1, 50000, 50000, 'Transfer Bank', 'Belum Dibayar', NULL, 1, 'Menunggu Konfirmasi', NULL),
(24, 'Jakarta', 'Semarang', '2026-05-20', '18:00', 'amini', 'amini@gmail.com', 'ekonomi', 1, 150000, 150000, 'Transfer Bank', 'Pembayaran Dikonfirmasi', 'bukti_1778256851_9618.png', 3, 'Menunggu Konfirmasi', NULL),
(25, 'Jakarta', 'Bandung', '2026-05-31', '05:00', 'aku', 'aku@gmail.com', 'ekonomi', 2, 50000, 100000, 'Transfer Bank', 'Pembayaran Dikonfirmasi', 'bukti_1778309955_6882.jpg', 1, 'Menunggu Konfirmasi', NULL),
(26, 'Yogyakarta', 'Surabaya', '2026-06-04', '18:00', 'zahra', 'amini@gmail.com', 'ekonomi', 1, 50000, 50000, 'Transfer Bank', 'Menunggu Konfirmasi', 'bukti_1778319416_1956.jpg', 1, 'Menunggu Konfirmasi', NULL),
(27, 'Surabaya', 'Yogyakarta', '2026-06-04', '15:00', 'zahra', 'zahra@gmail.com', 'ekonomi', 1, 50000, 50000, 'Transfer Bank', 'Pembayaran Dikonfirmasi', 'bukti_1778320282_5411.jpg', 1, 'Terkonfirmasi', 'amini'),
(28, 'Surabaya', 'Yogyakarta', '2026-06-04', '15:00', 'aku', '123@gmail.com', 'ekonomi', 1, 50000, 50000, 'QRIS', 'Pembayaran Dikonfirmasi', 'bukti_1778321629_6840.jpg', 1, 'Terkonfirmasi', 'amini'),
(29, 'Bandung', 'Jakarta', '2026-05-28', '05:00', 'charles', 'asasdadsa@email.com', 'ekonomi', 1, 50000, 50000, 'QRIS', 'Pembayaran Dikonfirmasi', 'bukti_1778338335_1636.png', 1, 'Terkonfirmasi', 'makpidemigod'),
(30, 'Jakarta', 'Bandung', '2026-05-12', '05:00', 'dad', 'sukikriya@gmail.com', 'vip', 1, 75000, 75000, 'QRIS', 'Pembayaran Dikonfirmasi', 'bukti_1778338833_1742.png', 1, 'Terkonfirmasi', 'user1'),
(32, 'Surabaya', 'Semarang', '2026-05-28', '15:00', 'Makfiy Ahmad Hamizan', 'makfiyahmad@gmail.com', 'ekonomi', 1, 100000, 100000, 'QRIS', 'Belum Bayar', NULL, 2, 'Menunggu Konfirmasi', 'makpidemigod'),
(33, 'Bandung', 'Jakarta', '2026-05-20', '09:00', 'dad', 'makfiyahmad@gmail.com', 'ekonomi', 1, 50000, 50000, 'QRIS', 'Belum Bayar', NULL, 1, 'Menunggu Konfirmasi', 'makpidemigod'),
(34, 'Bandung', 'Jakarta', '2026-05-20', '09:00', 'USERNAME 1', 'USERNAME@gmai.com', 'ekonomi', 1, 50000, 50000, 'QRIS', 'Belum Bayar', NULL, 1, 'Menunggu Konfirmasi', 'makpidemigod');

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `nama_penumpang` varchar(100) DEFAULT NULL,
  `kursi` varchar(10) DEFAULT NULL,
  `gerbong` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`id`, `id_pemesanan`, `nama_penumpang`, `kursi`, `gerbong`) VALUES
(5, 3, 'makfi', 'A1', NULL),
(6, 4, 'zahra', 'A1', NULL),
(7, 5, 'zahh', 'A1', NULL),
(8, 5, 'makfi', 'A2', NULL),
(9, 6, 'zahra', 'A1', NULL),
(11, 8, 'zahh', 'A1', 'Gerbong 2'),
(12, 9, 'zahh', 'A2', 'Gerbong 3'),
(13, 10, 'zahh', 'A2', 'Gerbong 3'),
(14, 11, 'zahh', 'A2', 'Gerbong 3'),
(15, 12, 'aku', 'A1', 'Gerbong 1'),
(17, 14, 'makfi', 'A1', 'Gerbong 2'),
(21, 18, 'charles', 'E3', 'Gerbong 2'),
(22, 19, 'charles', 'E2', 'Gerbong 3'),
(23, 20, 'charles', 'E2', 'Gerbong 3'),
(24, 21, 'charles', 'A1', 'Gerbong 1'),
(25, 22, 'makfi', 'A1', 'Gerbong 1'),
(26, 23, 'makfi', 'A2', 'Gerbong 1'),
(27, 24, 'zahh', 'A4', 'Gerbong 2'),
(28, 25, 'aku', 'A1', 'Gerbong 1'),
(29, 25, 'dia', 'A2', 'Gerbong 1'),
(30, 26, 'amini', 'B2', 'Gerbong 13'),
(31, 27, 'zahra', 'A1', 'Gerbong 2'),
(32, 28, 'zahh', 'A1', 'Gerbong 1'),
(33, 29, 'charles', 'A1', 'Gerbong 5'),
(34, 30, 'suki', 'A4', 'Gerbong 8'),
(36, 32, '1', 'B2', 'Gerbong 15'),
(37, 33, '1', 'A1', 'Gerbong 13'),
(38, 34, 'USERNAME', 'A1', 'Gerbong 1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD CONSTRAINT `penumpang_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
