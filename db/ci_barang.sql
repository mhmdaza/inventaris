-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2022 at 03:36 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `harga_barang` bigint(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`, `stok`, `satuan_id`, `jenis_id`) VALUES
('B000001', 'ASUS X455WA', 3600000, 5, 1, 3),
('B000002', 'Faber-Castell', 2100, 20, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` char(16) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `ruangan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `barang_id`, `user_id`, `jumlah_keluar`, `tanggal_keluar`, `ruangan_id`) VALUES
('T-BK-22071900001', 'B000002', 1, 12, '2022-07-19', 8);

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `delete_stok_keluar` AFTER DELETE ON `barang_keluar` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + OLD.jumlah_keluar WHERE `barang`.`id_barang` = OLD.barang_id
$$
DELIMITER ;
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
(1, 'B000001', 1, '2022-07-17', 1, 'Maintenance');

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
  `tanggal_masuk` date NOT NULL,
  `total_harga` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `supplier_id`, `user_id`, `barang_id`, `jumlah_masuk`, `tanggal_masuk`, `total_harga`) VALUES
('T-BM-22071500001', 4, 1, 'B000001', 5, '2022-07-15', 18000000),
('T-BM-22071800001', 4, 1, 'B000001', 5, '2022-07-18', 18000000),
('T-BM-22071900001', 6, 1, 'B000002', 20, '2022-07-19', 42000);

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
  `deskripsi` varchar(128) NOT NULL,
  `status_barang` enum('Rusak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_rusak`
--

INSERT INTO `barang_rusak` (`id_barang_rusak`, `barang_id`, `user_id`, `tgl_brg_rusak`, `jumlah_rusak`, `deskripsi`, `status_barang`) VALUES
(5, 'B000001', 1, '2022-07-17', 1, 'Layar Pecah', 'Rusak');

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
(6, 'Layar Projector'),
(7, 'Perangkat Komputer'),
(8, 'Printer'),
(9, 'Paper Shredder'),
(10, 'Speaker'),
(11, 'Mesin Antrian'),
(12, 'Microphone'),
(13, 'Lemari Arsip'),
(14, 'Meja'),
(15, 'ATK');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_pegawai` varchar(128) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `telp` varchar(128) NOT NULL,
  `tmt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nip`, `nama_pegawai`, `jabatan`, `alamat`, `telp`, `tmt`) VALUES
(11, '131149868', 'Agus Sutejo', 'Kepala Kantor', 'Jalan Tambun Bungai', '089127781001', '2016-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `penempatan`
--

CREATE TABLE `penempatan` (
  `id_penempatan` char(12) CHARACTER SET utf8 NOT NULL,
  `tgl_penempatan` date NOT NULL,
  `barang_id` char(7) CHARACTER SET utf8 NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `jumlah_penempatan` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penempatan`
--

INSERT INTO `penempatan` (`id_penempatan`, `tgl_penempatan`, `barang_id`, `pegawai_id`, `jumlah_penempatan`, `ruangan_id`) VALUES
('T-PB-2207170', '2022-07-17', 'B000001', 11, 3, 12);

--
-- Triggers `penempatan`
--
DELIMITER $$
CREATE TRIGGER `delete_stok_penempatan` AFTER DELETE ON `penempatan` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + OLD.jumlah_penempatan WHERE `barang`.`id_barang` = OLD.barang_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_penempatan` BEFORE INSERT ON `penempatan` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_penempatan WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_brg`
--

CREATE TABLE `pengguna_brg` (
  `id_pengguna` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `barang_id` char(7) CHARACTER SET utf8 NOT NULL,
  `jenis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna_brg`
--

INSERT INTO `pengguna_brg` (`id_pengguna`, `pegawai_id`, `barang_id`, `jenis_id`) VALUES
(7, 11, 'B000001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`) VALUES
(7, 'Ruang Pegawai'),
(8, 'Ruang Arsip'),
(9, 'Ruang Resepsionis'),
(10, 'Ruang Rapat'),
(12, 'Ruang Kerja Atasan'),
(14, 'Gudang');

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
(1, 'Unit'),
(2, 'Buah');

-- --------------------------------------------------------

--
-- Table structure for table `setting_app`
--

CREATE TABLE `setting_app` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `logo` varchar(225) DEFAULT NULL,
  `is_active` varchar(1) DEFAULT NULL,
  `visi` longtext,
  `misi` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_app`
--

INSERT INTO `setting_app` (`id`, `nama`, `logo`, `is_active`, `visi`, `misi`) VALUES
(1, 'BPJAMSOSTEK', '00b1d3bbe4da8021954a06dff22bb9a2.png', '1', '<p><span xss=removed>Mewujudkan Jaminan Sosial Ketenagakerjaan yang Terpercaya, Berkelanjutan dan Menyejahterakan Seluruh Pekerja Indonesia</span><br></p>', '<p><span xss=removed>-</span><b> </b><span xss=removed>Melindungi, Melayani & Menyejahterakan Pekerja dan Keluarga</span></p><p><span xss=removed>- </span><span xss=removed>Memberikan rasa Aman, Mudah & Nyaman untuk Meningkatkan Produktivitas dan Daya Saing Peserta</span></p><p><span xss=removed>- </span><span xss=removed>Memberikan Kontribusi dalam Pembangunan dan Perekonomian Bangsa dengan Tata Kelola Baik</span></p>');

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
  `toko` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `toko`, `no_telp`, `alamat`) VALUES
(4, 'Andi Suhendra', 'Nusantara Elektronik', '089602917399', 'Jalan Citra Abadi'),
(5, 'Jefry Pratama', 'Jaya Lestari', '081238409843', 'Jalan Mawar'),
(6, 'Denis Irwin', 'Aneka Elektronik', '089991823893', 'Jalan Patih Rumbih'),
(7, 'Ahmad Supriyadi', 'Raja Elektronik', '089633912000', 'Jalan Anggrek'),
(8, 'Syarif Hidayat', 'Sentosa', '081281738976', 'Jalan Sulawesi'),
(9, 'Andi Suherman', 'Jaya Makmur', '0895700555390', 'Jalan Tendean');

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
(1, 'Muhammad', 'admin', 'admin@admin.com', '0895700555390', 'admin', '$2y$10$wMgi9s3FEDEPEU6dEmbp8eAAEBUXIXUy3np3ND2Oih.MOY.q/Kpoy', 1568689561, 'eca1adc150cdf684720445d4c770532a.jpg', 1),
(12, 'User', 'user', 'user@gmail.com', '081231415552', 'gudang', '$2y$10$uqXyUOJpZDCrowGXISK1l.rmbA/Pxls6q/yLlDoov0dg86SeZs.42', 1655127381, 'user.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `kategori_id` (`jenis_id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ruangan_id` (`ruangan_id`);

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
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD PRIMARY KEY (`id_penempatan`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `pegawai_id` (`pegawai_id`),
  ADD KEY `ruangan_id` (`ruangan_id`);

--
-- Indexes for table `pengguna_brg`
--
ALTER TABLE `pengguna_brg`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `pegawai_id` (`pegawai_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `jenis_id` (`jenis_id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

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
  MODIFY `id_barang_maintenance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  MODIFY `id_barang_rusak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengguna_brg`
--
ALTER TABLE `pengguna_brg`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_5` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD CONSTRAINT `penempatan_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penempatan_ibfk_2` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penempatan_ibfk_3` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengguna_brg`
--
ALTER TABLE `pengguna_brg`
  ADD CONSTRAINT `pengguna_brg_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengguna_brg_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
