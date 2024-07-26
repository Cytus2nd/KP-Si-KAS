-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2024 at 11:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_kas`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_organisasi`
--

CREATE TABLE `data_organisasi` (
  `id_organisasi` int NOT NULL,
  `nama_organisasi` varchar(200) NOT NULL,
  `ketua_organisasi` varchar(150) NOT NULL,
  `pembina_organisasi` varchar(150) NOT NULL,
  `nama_bendahara` varchar(150) NOT NULL,
  `no_telp_bendahara` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_organisasi`
--

INSERT INTO `data_organisasi` (`id_organisasi`, `nama_organisasi`, `ketua_organisasi`, `pembina_organisasi`, `nama_bendahara`, `no_telp_bendahara`) VALUES
(1, 'OSIS', 'Unknown', 'Unknown', 'Unknown', '081213141516');

-- --------------------------------------------------------

--
-- Table structure for table `kas_kkr`
--

CREATE TABLE `kas_kkr` (
  `id_kas_kkr` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tipe_kas` enum('pemasukan','pengeluaran') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kas_kkr`
--

INSERT INTO `kas_kkr` (`id_kas_kkr`, `jumlah`, `keterangan`, `tipe_kas`, `created_at`) VALUES
(1, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-25 06:54:45'),
(2, 50000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 03:40:38'),
(3, 85000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 03:41:59'),
(4, 56000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 04:01:31'),
(5, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 04:09:38'),
(6, 58500, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:13:03'),
(7, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:14:59'),
(8, 12000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:15:28'),
(9, 200, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:19:10'),
(10, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:22:19'),
(11, 200, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:22:36'),
(12, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:28:31'),
(13, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:29:24'),
(14, 2500, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:30:09'),
(15, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 09:26:52'),
(16, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 09:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `kas_osis`
--

CREATE TABLE `kas_osis` (
  `id_kas_osis` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tipe_kas` enum('pemasukan','pengeluaran') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kas_osis`
--

INSERT INTO `kas_osis` (`id_kas_osis`, `jumlah`, `keterangan`, `tipe_kas`, `created_at`) VALUES
(1, 100000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-25 06:54:45'),
(2, 50000, 'Beli Barang', 'pengeluaran', '2024-07-25 08:42:00'),
(3, 250000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 03:40:38'),
(4, 425000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 03:41:59'),
(5, 280000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 04:01:31'),
(6, 100000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 04:09:38'),
(7, 120000, 'Pengeluaran Beli barang', 'pengeluaran', '2024-08-31 06:33:59'),
(8, 292500, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:13:03'),
(9, 100000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:14:59'),
(10, 60000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:15:28'),
(11, 1000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:19:10'),
(12, 100000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:22:19'),
(13, 1000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:22:36'),
(14, 1000000, 'Beli Tenda Camping ', 'pengeluaran', '2024-07-26 08:24:37'),
(15, 9500, 'beli air wkwkkwkw', 'pengeluaran', '2024-07-26 08:26:50'),
(16, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:28:31'),
(17, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:29:24'),
(18, 12500, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:30:09'),
(19, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 09:26:52'),
(20, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 09:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `kas_pmr`
--

CREATE TABLE `kas_pmr` (
  `id_kas_pmr` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tipe_kas` enum('pemasukan','pengeluaran') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kas_pmr`
--

INSERT INTO `kas_pmr` (`id_kas_pmr`, `jumlah`, `keterangan`, `tipe_kas`, `created_at`) VALUES
(1, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-25 06:54:45'),
(2, 50000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 03:40:38'),
(3, 85000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 03:41:59'),
(4, 56000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 04:01:31'),
(5, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 04:09:38'),
(6, 58500, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:13:03'),
(7, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:14:59'),
(8, 12000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:15:28'),
(9, 200, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:19:10'),
(10, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:22:19'),
(11, 200, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:22:36'),
(12, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:28:31'),
(13, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:29:24'),
(14, 2500, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:30:09'),
(15, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 09:26:52'),
(16, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 09:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `kas_pramuka`
--

CREATE TABLE `kas_pramuka` (
  `id_kas_pramuka` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tipe_kas` enum('pemasukan','pengeluaran') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kas_pramuka`
--

INSERT INTO `kas_pramuka` (`id_kas_pramuka`, `jumlah`, `keterangan`, `tipe_kas`, `created_at`) VALUES
(1, 60000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-25 06:54:45'),
(2, 150000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 03:40:38'),
(3, 255000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 03:41:59'),
(4, 168000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 04:01:31'),
(5, 60000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 04:09:38'),
(6, 175500, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:13:03'),
(7, 60000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:14:59'),
(8, 36000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:15:28'),
(9, 600, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:19:10'),
(10, 60000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:22:19'),
(11, 600, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:22:36'),
(12, 6000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:28:31'),
(13, 6000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:29:24'),
(14, 7500, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 08:30:09'),
(15, 6000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 09:26:52'),
(16, 6000, 'Inputan Kas oleh OSIS', 'pemasukan', '2024-07-26 09:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jabatan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `jabatan`) VALUES
(2, 'Hendri', 'cytus', '$2y$10$tvjztVC3qQEp4guf8D.1y.1MCKylZDoePx.ZDPtcgbkcfQEfzLA.G', 1),
(3, 'Admin', 'admin', '$2y$10$rfkAM.GimALWxZp3RWrUS.df2Wgz1L/Kt1gDZaaQV6Z92EZVec8/i', 1),
(4, 'Henduri', 'hendri', '$2y$10$wy2pNcNjfFJHHSVi8a/zOOyQk2I0VvJ.4ClXnePi7WXp5giXLZqsC', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_organisasi`
--
ALTER TABLE `data_organisasi`
  ADD PRIMARY KEY (`id_organisasi`);

--
-- Indexes for table `kas_kkr`
--
ALTER TABLE `kas_kkr`
  ADD PRIMARY KEY (`id_kas_kkr`);

--
-- Indexes for table `kas_osis`
--
ALTER TABLE `kas_osis`
  ADD PRIMARY KEY (`id_kas_osis`);

--
-- Indexes for table `kas_pmr`
--
ALTER TABLE `kas_pmr`
  ADD PRIMARY KEY (`id_kas_pmr`);

--
-- Indexes for table `kas_pramuka`
--
ALTER TABLE `kas_pramuka`
  ADD PRIMARY KEY (`id_kas_pramuka`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_organisasi`
--
ALTER TABLE `data_organisasi`
  MODIFY `id_organisasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kas_kkr`
--
ALTER TABLE `kas_kkr`
  MODIFY `id_kas_kkr` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kas_osis`
--
ALTER TABLE `kas_osis`
  MODIFY `id_kas_osis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kas_pmr`
--
ALTER TABLE `kas_pmr`
  MODIFY `id_kas_pmr` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kas_pramuka`
--
ALTER TABLE `kas_pramuka`
  MODIFY `id_kas_pramuka` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
