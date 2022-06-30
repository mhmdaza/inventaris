-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 04:32 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(7) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `penempatan_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `masa_pakai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `penempatan_id`, `satuan_id`, `jenis_id`, `masa_pakai`) VALUES
('B000001', 'Lenovo Ideapad 1550', 19, 2, 1, 3, '2022-06-13'),
('B000002', 'Samsung Galaxy J1 Ace', 47, 2, 1, 4, '2022-06-06'),
('B000004', 'Mouse Wireless Logitech M220', 32, 3, 1, 7, '2022-06-08'),
('B000005', 'Asus X454WA', 3, 3, 1, 3, '2022-06-08'),
('B000006', 'HP LaserJet Pro M12w', 8, 4, 1, 8, '2022-06-08'),
('B000007', 'SSD', 10, 3, 1, 3, '2022-06-08'),
('B000008', 'Hardisk', 10, 3, 1, 3, '2023-06-08'),
('B000009', 'CPU', 0, 2, 1, 7, '2022-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `user_id`, `barang_id`, `jumlah_keluar`, `tanggal_keluar`) VALUES
('T-BK-19082000002', 1, 'B000002', 10, '2019-08-20'),
('T-BK-19092000003', 1, 'B000001', 5, '2019-09-20'),
('T-BK-19092000005', 1, 'B000004', 10, '2019-09-20');

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_keluar` BEFORE INSERT ON `barang_keluar` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_keluar WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_maintenance`
--

CREATE TABLE `barang_maintenance` (
  `id_barang_maintenance` int(11) NOT NULL,
  `barang_id` char(7) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `tgl_brg_maintenance` date NOT NULL,
  `jumlah_maintenance` int(11) NOT NULL,
  `status_barang` enum('Maintenance','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_maintenance`
--

INSERT INTO `barang_maintenance` (`id_barang_maintenance`, `barang_id`, `user_id`, `tgl_brg_maintenance`, `jumlah_maintenance`, `status_barang`) VALUES
(1, 'B000001', 1, '2022-06-06', 2, 'Selesai'),
(2, 'B000004', 1, '2022-06-07', 2, 'Selesai'),
(3, 'B000001', 1, '2022-06-07', 2, 'Maintenance'),
(4, 'B000006', 1, '2022-06-07', 2, 'Maintenance'),
(5, 'B000005', 1, '2022-06-07', 1, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` char(16) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `supplier_id`, `user_id`, `barang_id`, `jumlah_masuk`, `tanggal_masuk`) VALUES
('T-BM-22060700001', 4, 1, 'B000001', 1, '2022-06-13');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + NEW.jumlah_masuk WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_rusak`
--

CREATE TABLE `barang_rusak` (
  `id_barang_rusak` int(11) NOT NULL,
  `barang_id` char(7) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `tgl_brg_rusak` date NOT NULL,
  `jumlah_rusak` int(11) NOT NULL,
  `status_barang` enum('Rusak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_rusak`
--

INSERT INTO `barang_rusak` (`id_barang_rusak`, `barang_id`, `user_id`, `tgl_brg_rusak`, `jumlah_rusak`, `status_barang`) VALUES
(8, 'B000002', 1, '2022-06-06', 2, 'Rusak'),
(9, 'B000006', 1, '2022-06-07', 2, 'Rusak');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(3, 'Laptop'),
(4, 'Handphone'),
(6, 'Layar Projector'),
(7, 'Perangkat Komputer'),
(8, 'Printer'),
(9, 'Paper Shredder');

-- --------------------------------------------------------

--
-- Table structure for table `penempatan_brg`
--

CREATE TABLE `penempatan_brg` (
  `id_penempatan_brg` int(11) NOT NULL,
  `nama_penempatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penempatan_brg`
--

INSERT INTO `penempatan_brg` (`id_penempatan_brg`, `nama_penempatan`) VALUES
(2, 'Rak 1'),
(3, 'Rak 2'),
(4, 'Rak 3');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Unit');

-- --------------------------------------------------------

--
-- Table structure for table `setting_app`
--

CREATE TABLE `setting_app` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `logo` varchar(225) DEFAULT NULL,
  `is_active` varchar(1) DEFAULT NULL,
  `visi` longtext DEFAULT NULL,
  `misi` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_app`
--

INSERT INTO `setting_app` (`id`, `nama`, `logo`, `is_active`, `visi`, `misi`) VALUES
(1, 'BPJAMSOSTEK', 'fd9b813dfe6e519760da4252669d9467.png', '1', '<p><span xss=removed>Mewujudkan Jaminan Sosial Ketenagakerjaan yang Terpercaya, Berkelanjutan dan Menyejahterakan Seluruh Pekerja Indonesia</span><br></p>', '<p><span xss=removed>-</span><b> </b><span xss=removed>Melindungi, Melayani & Menyejahterakan Pekerja dan Keluarga</span></p><p><span xss=removed>- </span><span xss=removed>Memberikan rasa Aman, Mudah & Nyaman untuk Meningkatkan Produktivitas dan Daya Saing Peserta</span></p><p><span xss=removed>- </span><span xss=removed>Memberikan Kontribusi dalam Pembangunan dan Perekonomian Bangsa dengan Tata Kelola Baik</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `foto` varchar(225) DEFAULT NULL,
  `urutan` varchar(2) DEFAULT NULL,
  `aktif` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `foto`, `urutan`, `aktif`) VALUES
(3, '72574ffbcf3e9b36bb637ccf84b6a996.png', NULL, NULL),
(5, 'b1a15227053431aebf155417f28e159e.jpg', NULL, NULL),
(6, '02a499d77f983ff35649258a8831d500.jpg', NULL, NULL),
(7, '20c8adf005d9303c370cae7d988f354e.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `alamat`) VALUES
(4, 'Andi Suhendra', '08960291739', 'Jalan Citra No. 48'),
(5, 'Jefry Pratama', '0812384098431', 'Jalan Mawar No. 24'),
(6, 'Denis Irwin', '089991823893', 'Jalan Patih Rumbih No. 14'),
(7, 'Ahmad Supriyadi', '0896339120000', 'Jalan Anggrek Gg. Abadi No. 15'),
(8, 'Syarif Hidayat', '081281738976', 'Jalan Sulawesi No. 99');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `role` enum('gudang','admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `foto` text NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `no_telp`, `role`, `password`, `created_at`, `foto`, `is_active`) VALUES
(1, 'Muhammad Ali Zainal Abidin', 'admin', 'admin@admin.com', '0895700555390', 'admin', '$2y$10$wMgi9s3FEDEPEU6dEmbp8eAAEBUXIXUy3np3ND2Oih.MOY.q/Kpoy', 1568689561, 'eca1adc150cdf684720445d4c770532a.jpg', 1),
(7, 'Arfan', 'arfandotid', 'arfandotid@gmail.com', '081221528805', 'gudang', '$2y$10$5es8WhFQj8xCmrhDtH86Fu71j97og9f8aR4T22soa7716kAusmaeK', 1568691611, 'user.png', 1),
(8, 'Muhammad Ghifari Arfananda', 'mghifariarfan', 'mghifariarfan@gmail.com', '085697442673', 'gudang', '$2y$10$5SGUIbRyEXH7JslhtEegEOpp6cvxtK6X.qdiQ1eZR7nd0RZjjx3qe', 1568691629, 'user.png', 1),
(9, 'Ali', 'mazasih', 'aliaza@gmail.com', '0895700555390', 'admin', '$2y$10$Ij1fKPCuKddACJSISM/h5OpSH7P/TWPY9Q9ssFw3XhBA7EOmaWVyC', 1644547550, 'user.png', 0),
(10, 'Dedi Cahyadi', 'dediNihBoss', 'dedi@gmail.com', '089691254981', 'admin', '$2y$10$abQ5oSTfiPETmXPZH2nUme2odZODUMe1uUd0ostmj92MSbSkJCzdW', 1644547609, 'user.png', 0),
(11, 'Lisa', 'ayang', 'lisa@gmail.com', '081234097190', 'gudang', '$2y$10$NJS8MJcs9L75xHOijN7DMehMaogxnGOmhB8XQslOC6uJML.Dvay1O', 1644547664, 'user.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `kategori_id` (`jenis_id`),
  ADD KEY `penempatan_id` (`penempatan_id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `barang_maintenance`
--
ALTER TABLE `barang_maintenance`
  ADD PRIMARY KEY (`id_barang_maintenance`),
  ADD KEY `barang_id` (`barang_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  ADD PRIMARY KEY (`id_barang_rusak`),
  ADD KEY `barang_id` (`barang_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `penempatan_brg`
--
ALTER TABLE `penempatan_brg`
  ADD PRIMARY KEY (`id_penempatan_brg`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `setting_app`
--
ALTER TABLE `setting_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_maintenance`
--
ALTER TABLE `barang_maintenance`
  MODIFY `id_barang_maintenance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  MODIFY `id_barang_rusak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penempatan_brg`
--
ALTER TABLE `penempatan_brg`
  MODIFY `id_penempatan_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`penempatan_id`) REFERENCES `penempatan_brg` (`id_penempatan_brg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_maintenance`
--
ALTER TABLE `barang_maintenance`
  ADD CONSTRAINT `barang_maintenance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_maintenance_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  ADD CONSTRAINT `barang_rusak_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_rusak_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
