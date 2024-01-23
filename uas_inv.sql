-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 03:06 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(6) NOT NULL,
  `nama_barang` varchar(80) NOT NULL,
  `stok` int(11) NOT NULL,
  `vendor` char(6) NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `vendor`, `gambar`) VALUES
('BAR001', 'RTX', 0, 'VEN004', '1705974600-20220921015207.jpg'),
('BAR002', 'GTX', 10, 'VEN004', '1705974649-download (3).jpeg'),
('BAR003', 'AMD 3', 52, 'VEN003', '1705974681-download (4).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barkel` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` char(6) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barkel`, `id_user`, `id_barang`, `tanggal`, `jumlah`) VALUES
(4, 1, 'BAR002', '2024-01-23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barsuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barsuk`, `tanggal_masuk`, `jumlah`, `id_user`, `id_barang`) VALUES
(11, '2024-01-23', 20, 1, 'BAR003'),
(12, '2024-01-23', 32, 1, 'BAR003'),
(13, '2024-01-23', 12, 1, 'BAR002');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(80) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` char(16) NOT NULL,
  `foto` varchar(80) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `email`, `alamat`, `telp`, `foto`, `role`) VALUES
(1, 'KOMPUTER.CO', 'komputerCO', 'admin123', 'KOMP@gmail.com', '-', '-', '-', 'ADMIN'),
(6, 'Ganss', 'gans', 'gans123', 'Gansteng@gmail.com', 'Meduri', '089999', '1705975404-f09c5dee85b3a16688e1f36db5747a2a.jpg', 'KARYAWAN'),
(7, 'Diva', 'div', 'div123', 'div@container.com', 'England', '145666', '1705975437-download (1).jpeg', 'KARYAWAN');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` char(6) NOT NULL,
  `nama_vendor` varchar(250) NOT NULL,
  `kontak_vendor` varchar(20) NOT NULL,
  `alamat_vendor` varchar(80) NOT NULL,
  `telp_vendor` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `kontak_vendor`, `alamat_vendor`, `telp_vendor`) VALUES
('VEN001', 'ASUS', 'ASUS@gmail.com', 'Brokly', '0912222'),
('VEN002', 'INTEL', 'Intel@inc.com', 'USA', '1200'),
('VEN003', 'RYZEN', 'ryzen@gmail.com', 'NusaKambangan', '56777'),
('VEN004', 'NVIDIA', 'nvida@gmail.com', 'England', '567899');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barkel`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barsuk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barkel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barsuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
