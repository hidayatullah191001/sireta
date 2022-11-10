-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2022 at 09:05 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sireta`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `title`, `id_cabang`, `stok`) VALUES
(1, 'Printer', 1, 20),
(2, 'Barcode', 1, 10),
(3, 'Kabel Lan', 1, 30),
(4, 'Switch', 1, 20),
(5, 'RAM', 2, 12),
(7, 'Colokan', 1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(11) NOT NULL,
  `id_file` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `id_file`, `id_user`, `status`) VALUES
(34, 13, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `cabang1` int(11) NOT NULL,
  `cabang2` int(11) NOT NULL,
  `cabang3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id`, `id_barang`, `cabang1`, `cabang2`, `cabang3`) VALUES
(1, 1, 0, 0, 0),
(2, 2, 0, 0, 0),
(3, 3, 0, 0, 0),
(4, 4, 0, 0, 0),
(5, 5, 0, 0, 0),
(6, 7, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fileupload`
--

CREATE TABLE `fileupload` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `date_uploaded` date NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `penanda` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fileupload`
--

INSERT INTO `fileupload` (`id`, `judul`, `nama_file`, `date_uploaded`, `id_user`, `id_kategori`, `penanda`) VALUES
(8, 'MPSI', 'DPNA-EXCEL_MANAJEMEN_PROYEK_SISTEM_INFORMASI_(3_SKS)_2021-2022_(SEMESTER_GANJIL)_KLS_19221.xls', '2021-12-24', 4, 2, 1),
(9, 'Excel Skenario Diagram', 'SKENARIO_PAK_BAYU.xlsx', '2021-12-10', 4, 2, 1),
(10, 'Artikel MetPem SI', 'Tugas_Artikel_Metode_Pengembangan_SI_Berbasis_Mobile_Android.pdf', '2021-12-24', 4, 3, 1),
(15, 'UTS KOMMAS', 'UJIAN_TENGAH_SEMESTER_KOMMAS.docx', '2021-12-30', 12, 3, 1),
(17, 'Contoh12', 'ch_09.docx', '2022-01-11', 12, 4, 0),
(18, 'pengenalan mpsi', 'Pengenalan_MPSI.pptx', '2022-01-16', 4, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(2, 'Audit ISO 27001:2013 (IT)'),
(3, 'Audit ISO SMAP 3700:2016'),
(4, 'ISO Manajemen Mutu 900001:2015'),
(11, 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `ms_cabang`
--

CREATE TABLE `ms_cabang` (
  `id` int(11) NOT NULL,
  `cabang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_cabang`
--

INSERT INTO `ms_cabang` (`id`, `cabang`) VALUES
(1, 'Cabang 1'),
(2, 'Cabang 2'),
(3, 'Cabang 3');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `pinjam` int(11) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `pinjam`
--
DELIMITER $$
CREATE TRIGGER `deletepinjam` AFTER DELETE ON `pinjam` FOR EACH ROW BEGIN
	UPDATE barang set stok = stok + OLD.pinjam
WHERE id = OLD.id_barang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `image`, `role_id`, `status`, `date_created`) VALUES
(4, 'Hidayatullah Dayat', 'hidayat19', '$2y$10$22omvJRWh72jsLLUL.DoI.26XMO4aODH7qa3Q0uaDuUObcWBgwnRy', 'WhatsApp_Image_2021-12-01_at_19_12_05.jpeg', 1, 1, 1640269445),
(9, 'Jihan Atori', 'jihan2001', '$2y$10$TmYAetsnNWZQUdNe700wpuVy8eF8gmK5Jo9p2UBgOscs37ByRUapu', 'bg-jihan.png', 2, 1, 1640265984),
(11, 'liwi', 'manager', '$2y$10$Kvwe.u6HFXvQleY8BLv/mu6Zak2Jvf6v98ddRmIIbnHn6.GepuRMW', 'bg-liwi.png', 3, 1, 1640327037),
(12, 'Admin', 'admin', '$2y$10$GjqMUQvSKSTcL0xscFLd5ujmFUIE3VQB0hJWQDYjfW/mwjDO2h4Te', 'default.png', 1, 1, 1640597365),
(13, 'manager', 'mana', '$2y$10$Ezr6mavjOtzsTKUFwXTyX.F2OHcWj4aaqIeT7DJY9P.7lXxNvjg1C', 'default.png', 3, 1, 1640599487),
(14, 'liwi', 'liwislsssss', '$2y$10$IY1ZIM8jfQkyGXRt8hQSFu5UPDT15YXDMTq4M/2GTXjDBbrfl0Cn6', 'default.png', 2, 1, 1641137168),
(15, 'Jihan Atori', 'Jihan', '$2y$10$Pdd6xS.K3j5MH/yo6EFUhuCucdJelXlq4xuuFwCoINCnemTgi9cxq', 'default.png', 2, 1, 1641265034),
(16, 'Jihan Atori', 'Atori', '$2y$10$URDaR8y3gSZolr5jdboO6.l25OZcY21uW/RbUVxM52Yp1KOBLEjM2', 'default.png', 2, 1, 1641518665),
(18, 'admin', 'adminname', '$2y$10$lqJDCyTqj018d.6jqpV/dOGRqTrtKLyVHZmjEFQ70jBZ7ZoAiHy7G', 'default.png', 1, 1, 1642323045);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Kepala Bagian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fileupload`
--
ALTER TABLE `fileupload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_cabang`
--
ALTER TABLE `ms_cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fileupload`
--
ALTER TABLE `fileupload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ms_cabang`
--
ALTER TABLE `ms_cabang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
