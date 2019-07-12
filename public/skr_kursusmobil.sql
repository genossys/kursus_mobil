-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2019 at 09:22 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skr_kursusmobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id`, `username`, `email`, `password`, `nohp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Bagus', 'bagusgmail.com', '$2y$10$o/ajB7N1jqnMcdM7ObYeY.Y209LcgSFnpYo3AYGlme/amXM2CMvOq', '089418924', 'Joho Sukoharjo', '2019-07-07 23:52:29', '2019-07-07 23:52:29'),
(2, 'Pradana', 'pradana@gmail.com', '$2y$10$/Uflkf19XFkOb4iim3u2jeHzZWAUoh6OyKCQRDZbYUeGiAXSSTu4W', '089418924', 'solo', '2019-07-07 23:58:13', '2019-07-07 23:58:13'),
(3, 'Pradana2', 'pradana2@gmail.com', '$2y$10$V4p2jA129E4X0jOnU6klx.ntFXSgxCKOVAkcWKdpGT0N57tB5WQYe', '089418924', 'solo', '2019-07-08 00:00:03', '2019-07-08 00:00:03');

--
-- Triggers `tb_customer`
--
DELIMITER $$
CREATE TRIGGER `ADmember` AFTER DELETE ON `tb_customer` FOR EACH ROW BEGIN
                   DELETE FROM `tb_user` WHERE `tb_user`.`username` = OLD.username;
                END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BIcustomer` BEFORE INSERT ON `tb_customer` FOR EACH ROW BEGIN
                   INSERT INTO `tb_user` (`idCustomer`,`email`, `username`, `password` , `hakAkses` , `created_at`, `updated_at`) VALUES (NEW.id,NEW.email, NEW.username, NEW.password, 'customer' ,NEW.created_at, NEW.updated_at);
                END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobil`
--

CREATE TABLE `tb_mobil` (
  `idMobil` int(11) NOT NULL,
  `merkMobil` varchar(30) NOT NULL,
  `typeMobil` enum('Automatic','Manual','Kombinasi') NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `noPol` varchar(10) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mobil`
--

INSERT INTO `tb_mobil` (`idMobil`, `merkMobil`, `typeMobil`, `tahun`, `noPol`, `gambar`) VALUES
(1, 'Avanza', 'Manual', '2010', 'AD 2010 AA', 'avanza.jpg'),
(2, 'Brio', 'Automatic', '2011', 'AD 2011 AA', 'brio.jpg'),
(3, 'a', 'Manual', '2019', 'ab1002', 'C:\\xampp\\tmp\\phpD605.tmp');

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `idPaket` int(11) NOT NULL,
  `namaPaket` varchar(100) NOT NULL,
  `typeMobil` enum('Automatic','Manual','Kombinasi') NOT NULL,
  `kaliPertemuan` int(11) NOT NULL,
  `jadwalBuka` time NOT NULL,
  `jadwalTutup` time NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`idPaket`, `namaPaket`, `typeMobil`, `kaliPertemuan`, `jadwalBuka`, `jadwalTutup`, `harga`) VALUES
(1, 'Paket Matic Regular 4x', 'Automatic', 4, '07:00:00', '17:00:00', 300000),
(2, 'Paket Matic Regular 8x', 'Automatic', 8, '07:00:00', '17:00:00', 550),
(3, 'Paket Kombinasi Regular 10x', 'Kombinasi', 10, '07:00:00', '17:00:00', 600000),
(4, 'Paket Manual malam 6x', 'Manual', 6, '18:00:00', '19:00:00', 450000),
(5, 'Paket ABC', 'Manual', 5, '18:00:00', '19:00:00', 800000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id` int(11) NOT NULL,
  `noTrans` varchar(50) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `bukti` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id` int(11) NOT NULL,
  `noTrans` varchar(40) NOT NULL,
  `idPaket` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `checkout` enum('0','1') NOT NULL DEFAULT '0',
  `reqTglMulai` date DEFAULT NULL,
  `reqWaktu` time DEFAULT NULL,
  `reqMobil` varchar(5) DEFAULT NULL,
  `reqTentor` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id`, `noTrans`, `idPaket`, `idCustomer`, `harga`, `checkout`, `reqTglMulai`, `reqWaktu`, `reqMobil`, `reqTentor`) VALUES
(35, '220190712020735', 3, 2, 600000, '1', NULL, NULL, NULL, NULL),
(36, '220190712020727', 1, 2, 300000, '1', NULL, NULL, NULL, NULL),
(37, '220190712020727', 3, 2, 600000, '1', NULL, NULL, NULL, NULL),
(38, '220190712070712', 1, 2, 300000, '1', '2019-07-16', '14:00:00', '1', '1'),
(39, '220190712070712', 3, 2, 600000, '1', '2019-07-16', '14:00:00', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tentor`
--

CREATE TABLE `tb_tentor` (
  `idTentor` int(11) NOT NULL,
  `namaTentor` varchar(200) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `biodata` text NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tentor`
--

INSERT INTO `tb_tentor` (`idTentor`, `namaTentor`, `tanggalLahir`, `biodata`, `foto`) VALUES
(1, 'Taufik', '1994-11-30', 'Orang Wonogiri yang bla bla bla bla', 'C:\\xampp\\tmp\\php34F6.tmp');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `idTransaksi` int(11) NOT NULL,
  `noTrans` varchar(100) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `batasPembayaran` date NOT NULL,
  `status_bayar` enum('belum','menunggu','sudah','ditolak') NOT NULL DEFAULT 'belum',
  `status_terima` enum('belum','menunggu','sudah') NOT NULL DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`idTransaksi`, `noTrans`, `idCustomer`, `total`, `tanggal`, `batasPembayaran`, `status_bayar`, `status_terima`) VALUES
(2, '220190712020727', 2, 900000, '2019-07-12', '2019-07-15', 'belum', 'belum'),
(3, '220190712070712', 2, 900000, '2019-07-12', '2019-07-15', 'belum', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idCustomer` int(11) DEFAULT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hakAkses` enum('admin','pimpinan','customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `idCustomer`, `username`, `email`, `password`, `hakAkses`, `nohp`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'admin@gmail.com', '$2y$10$JlpRSrwJxJfsNsOPwLBUwOI840i3JBjDDrMNZbzk/GtjwBg0KD.7.', 'admin', '072713987', NULL, NULL, NULL),
(2, 1, 'Bagus', 'bagusgmail.com', '$2y$10$o/ajB7N1jqnMcdM7ObYeY.Y209LcgSFnpYo3AYGlme/amXM2CMvOq', 'customer', '', NULL, '2019-07-07 23:52:29', '2019-07-07 23:52:29'),
(3, 2, 'Pradana', 'pradana@gmail.com', '$2y$10$/Uflkf19XFkOb4iim3u2jeHzZWAUoh6OyKCQRDZbYUeGiAXSSTu4W', 'customer', '', NULL, '2019-07-07 23:58:13', '2019-07-07 23:58:13'),
(4, 3, 'Pradana2', 'pradana2@gmail.com', '$2y$10$V4p2jA129E4X0jOnU6klx.ntFXSgxCKOVAkcWKdpGT0N57tB5WQYe', 'customer', '', NULL, '2019-07-08 00:00:03', '2019-07-08 00:00:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_customer_email_unique` (`email`),
  ADD KEY `tb_customer_username_index` (`username`);

--
-- Indexes for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  ADD PRIMARY KEY (`idMobil`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`idPaket`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tentor`
--
ALTER TABLE `tb_tentor`
  ADD PRIMARY KEY (`idTentor`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_user_username_unique` (`username`),
  ADD UNIQUE KEY `tb_user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  MODIFY `idMobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `idPaket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_tentor`
--
ALTER TABLE `tb_tentor`
  MODIFY `idTentor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `idTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD CONSTRAINT `username_ifk` FOREIGN KEY (`username`) REFERENCES `tb_user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
