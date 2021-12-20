-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2021 at 02:52 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suratci`
--

-- --------------------------------------------------------

--
-- Table structure for table `surat_in`
--

CREATE TABLE `surat_in` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_surat` date NOT NULL,
  `perihal` text COLLATE utf8_unicode_ci NOT NULL,
  `asal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ket_disposisi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `akses` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nama_gbr` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_out`
--

CREATE TABLE `surat_out` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `no_urut` int(11) DEFAULT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_surat` date NOT NULL,
  `perihal` text COLLATE utf8_unicode_ci NOT NULL,
  `tujuan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ket_disposisi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `akses` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nama_gbr` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `akses` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `akses`, `level`) VALUES
(1, 'pekok', 'koko', '1', 'administrator', 'administrator'),
(2, 'Broh', 'admin', 'imambonjol13', 'agendaris', 'agendaris'),
(3, 'Bpk. Imron', 'kadis', '1', 'KADIS', 'kadis'),
(4, 'Bpk. Gazali', 'sekdin', '1', 'sekdin', 'sekdin'),
(5, 'Kabid P2', 'kabidp2', '1', 'kabidp2', 'kabid'),
(6, 'Kabid SDK', 'kabidsdk', '1', 'kabidsdk', 'kabid'),
(7, 'Kabid Kesmas', 'kabidkesmas', '1', 'kabidkesmas', 'kabid'),
(8, 'Kabid Yankes', 'kabidyankes', '1', 'kabidyankes', 'kabid'),
(9, 'Kasi P2PM', 'p2pm', '1', 'p2pm', 'kasi'),
(10, 'Kasi P2PTM', 'p2ptm', '1', 'p2ptm', 'kasi'),
(11, 'Kasi Surveilans', 'surveilans', '1', 'surveilans', 'kasi'),
(12, 'Kasi SDMK', 'sdmk', '1', 'sdmk', 'kasi'),
(13, 'Kasi Farmasi', 'farmasi', '1', 'farmasi', 'kasi'),
(14, 'Kasi Alkes', 'alkes', '1', 'alkes', 'kasi'),
(15, 'Kasi Promkes', 'promkes', '1', 'promkes', 'kasi'),
(16, 'Kasi Kesling', 'kesling', '1', 'kesling', 'kasi'),
(17, 'Kasi KGM', 'kgm', '1', 'kgm', 'kasi'),
(18, 'Kasi Primer', 'primer', '1', 'primer', 'kasi'),
(19, 'Kasi Rujukan', 'rujukan', '1', 'rujukan', 'kasi'),
(20, 'Kasi Kestrad', 'kestrad', '1', 'kestrad', 'kasi'),
(21, 'Kasubag PIEP', 'piep', '1', 'piep', 'kasubag'),
(22, 'Kasubag Keuangan', 'keuangan', '1', 'keuangan', 'kasubag'),
(23, 'Kasubag UP', 'up', '1', 'up', 'kasubag'),
(25, 'Ka IFK', 'ifk', '1', 'ifk', 'kabid'),
(26, 'Ka Labkesda', 'labkesda', '1', 'labkesda', 'kabid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surat_in`
--
ALTER TABLE `surat_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_out`
--
ALTER TABLE `surat_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surat_in`
--
ALTER TABLE `surat_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_out`
--
ALTER TABLE `surat_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
