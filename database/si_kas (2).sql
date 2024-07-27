-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 27, 2024 at 10:58 AM
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
  `ketua_organisasi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pembina_organisasi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_user_bendahara` int NOT NULL,
  `no_telp_bendahara` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_organisasi`
--

INSERT INTO `data_organisasi` (`id_organisasi`, `nama_organisasi`, `ketua_organisasi`, `pembina_organisasi`, `id_user_bendahara`, `no_telp_bendahara`) VALUES
(1, 'OSIS', 'Unknown', 'Unknown', 3, '081213141516');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int NOT NULL,
  `kode_jabatan` int NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `kode_jabatan`, `nama_jabatan`, `created_at`) VALUES
(1, 1, 'Kepala Sekolah', '2024-07-27 12:04:44'),
(2, 2, 'Waka Kesiswaan', '2024-07-27 12:05:20'),
(3, 3, 'Bendahara Osis', '2024-07-27 12:05:33'),
(4, 4, 'Bendahara Pramuka', '2024-07-27 12:06:01'),
(5, 5, 'Bendahara PMR', '2024-07-27 12:06:27'),
(6, 6, 'Bendahara KKR', '2024-07-27 12:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `kas_kkr`
--

CREATE TABLE `kas_kkr` (
  `id_kas_kkr` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tipe_kas` enum('pemasukan','pengeluaran') NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kas_kkr`
--

INSERT INTO `kas_kkr` (`id_kas_kkr`, `jumlah`, `keterangan`, `tipe_kas`, `id_user`, `created_at`) VALUES
(1, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 06:26:19'),
(2, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 09:07:07'),
(3, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:14'),
(4, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:16'),
(5, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:19'),
(6, 3000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:21'),
(7, 5000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:24'),
(8, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:27'),
(9, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:29'),
(10, 60000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:32'),
(11, 50000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:36'),
(12, 4000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:39'),
(13, 50000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:43'),
(14, 100000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:45'),
(15, 75000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `kas_osis`
--

CREATE TABLE `kas_osis` (
  `id_kas_osis` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tipe_kas` enum('pemasukan','pengeluaran') NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kas_osis`
--

INSERT INTO `kas_osis` (`id_kas_osis`, `jumlah`, `keterangan`, `tipe_kas`, `id_user`, `created_at`) VALUES
(1, 100000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 06:26:19'),
(2, 50000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 09:07:07'),
(3, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:14'),
(4, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:16'),
(5, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:19'),
(6, 15000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:21'),
(7, 25000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:24'),
(8, 100000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:27'),
(9, 50000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:29'),
(10, 300000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:32'),
(11, 250000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:36'),
(12, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:39'),
(13, 250000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:43'),
(14, 500000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:45'),
(15, 375000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `kas_pmr`
--

CREATE TABLE `kas_pmr` (
  `id_kas_pmr` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tipe_kas` enum('pemasukan','pengeluaran') NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kas_pmr`
--

INSERT INTO `kas_pmr` (`id_kas_pmr`, `jumlah`, `keterangan`, `tipe_kas`, `id_user`, `created_at`) VALUES
(1, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 06:26:19'),
(2, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 09:07:07'),
(3, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:14'),
(4, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:16'),
(5, 2000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:19'),
(6, 3000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:21'),
(7, 5000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:24'),
(8, 20000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:27'),
(9, 10000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:29'),
(10, 60000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:32'),
(11, 50000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:36'),
(12, 4000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:39'),
(13, 50000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:43'),
(14, 100000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:45'),
(15, 75000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `kas_pramuka`
--

CREATE TABLE `kas_pramuka` (
  `id_kas_pramuka` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tipe_kas` enum('pemasukan','pengeluaran') NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kas_pramuka`
--

INSERT INTO `kas_pramuka` (`id_kas_pramuka`, `jumlah`, `keterangan`, `tipe_kas`, `id_user`, `created_at`) VALUES
(1, 60000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 06:26:19'),
(2, 30000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 09:07:07'),
(3, 6000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:14'),
(4, 6000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:16'),
(5, 6000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:19'),
(6, 9000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:21'),
(7, 15000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:24'),
(8, 60000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:27'),
(9, 30000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:29'),
(10, 180000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:32'),
(11, 150000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:36'),
(12, 12000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:39'),
(13, 150000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:43'),
(14, 300000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:45'),
(15, 225000, 'Inputan Kas oleh OSIS', 'pemasukan', 2, '2024-07-27 10:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jabatan` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `jabatan`, `created_at`) VALUES
(2, 'Hendri', 'cytus', '$2y$10$tvjztVC3qQEp4guf8D.1y.1MCKylZDoePx.ZDPtcgbkcfQEfzLA.G', 1, '2024-07-27 15:43:38'),
(3, 'Admin', 'admin', '$2y$10$rfkAM.GimALWxZp3RWrUS.df2Wgz1L/Kt1gDZaaQV6Z92EZVec8/i', 1, '2024-07-27 15:43:38'),
(4, 'Henduri', 'hendri', '$2y$10$wy2pNcNjfFJHHSVi8a/zOOyQk2I0VvJ.4ClXnePi7WXp5giXLZqsC', 3, '2024-07-27 15:43:38'),
(5, 'Hendri Dunand', 'cytuss', '$2y$10$bua5Oe5UWj4KR0b2oJRXBuDc2UvpThNx0q1aatuXZQdtuwDVloO8m', 3, '2024-07-27 17:41:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_organisasi`
--
ALTER TABLE `data_organisasi`
  ADD PRIMARY KEY (`id_organisasi`),
  ADD KEY `id_user_bendahara` (`id_user_bendahara`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `kode_jabatan` (`kode_jabatan`);

--
-- Indexes for table `kas_kkr`
--
ALTER TABLE `kas_kkr`
  ADD PRIMARY KEY (`id_kas_kkr`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kas_osis`
--
ALTER TABLE `kas_osis`
  ADD PRIMARY KEY (`id_kas_osis`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kas_pmr`
--
ALTER TABLE `kas_pmr`
  ADD PRIMARY KEY (`id_kas_pmr`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kas_pramuka`
--
ALTER TABLE `kas_pramuka`
  ADD PRIMARY KEY (`id_kas_pramuka`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `jabatan` (`jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_organisasi`
--
ALTER TABLE `data_organisasi`
  MODIFY `id_organisasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kas_kkr`
--
ALTER TABLE `kas_kkr`
  MODIFY `id_kas_kkr` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kas_osis`
--
ALTER TABLE `kas_osis`
  MODIFY `id_kas_osis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kas_pmr`
--
ALTER TABLE `kas_pmr`
  MODIFY `id_kas_pmr` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kas_pramuka`
--
ALTER TABLE `kas_pramuka`
  MODIFY `id_kas_pramuka` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_organisasi`
--
ALTER TABLE `data_organisasi`
  ADD CONSTRAINT `data_organisasi_ibfk_1` FOREIGN KEY (`id_user_bendahara`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `kas_kkr`
--
ALTER TABLE `kas_kkr`
  ADD CONSTRAINT `kas_kkr_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `kas_osis`
--
ALTER TABLE `kas_osis`
  ADD CONSTRAINT `kas_osis_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `kas_pmr`
--
ALTER TABLE `kas_pmr`
  ADD CONSTRAINT `kas_pmr_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `kas_pramuka`
--
ALTER TABLE `kas_pramuka`
  ADD CONSTRAINT `kas_pramuka_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`jabatan`) REFERENCES `jabatan` (`kode_jabatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
