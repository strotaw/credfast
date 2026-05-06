-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2026 at 09:39 PM
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
-- Database: `kredit_motor`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kredit_id` bigint(20) UNSIGNED NOT NULL,
  `angsuran_ke` int(10) UNSIGNED NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `nominal` double NOT NULL,
  `denda` double NOT NULL DEFAULT 0,
  `total_bayar` double NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','dibayar','valid','ditolak','telat') NOT NULL DEFAULT 'menunggu',
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id`, `kredit_id`, `angsuran_ke`, `tanggal_jatuh_tempo`, `tanggal_bayar`, `nominal`, `denda`, `total_bayar`, `bukti_bayar`, `status`, `verified_by`, `verified_at`, `keterangan`, `created_at`, `updated_at`) VALUES
(13, 2, 1, '2026-03-01', '2026-02-28', 2906250, 0, 2906250, NULL, 'valid', 14, '2026-03-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(14, 2, 2, '2026-04-01', '2026-03-31', 2906250, 0, 2906250, NULL, 'valid', 14, '2026-04-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(15, 2, 3, '2026-05-01', NULL, 2906250, 50000, 2906250, NULL, 'telat', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 06:04:59'),
(16, 2, 4, '2026-06-01', NULL, 2906250, 0, 2906250, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(17, 2, 5, '2026-07-01', NULL, 2906250, 0, 2906250, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(18, 2, 6, '2026-08-01', NULL, 2906250, 0, 2906250, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(19, 2, 7, '2026-09-01', NULL, 2906250, 0, 2906250, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(20, 2, 8, '2026-10-01', NULL, 2906250, 0, 2906250, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(21, 2, 9, '2026-11-01', NULL, 2906250, 0, 2906250, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(22, 2, 10, '2026-12-01', NULL, 2906250, 0, 2906250, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(23, 2, 11, '2027-01-01', NULL, 2906250, 0, 2906250, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(24, 2, 12, '2027-02-01', NULL, 2906250, 0, 2906250, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(25, 3, 1, '2025-12-01', '2025-11-30', 1408916.67, 0, 1408916.67, NULL, 'valid', 14, '2025-12-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(26, 3, 2, '2026-01-01', '2025-12-31', 1408916.67, 0, 1408916.67, NULL, 'valid', 14, '2026-01-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(27, 3, 3, '2026-02-01', '2026-01-31', 1408916.67, 0, 1408916.67, NULL, 'valid', 14, '2026-02-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(28, 3, 4, '2026-03-01', '2026-02-28', 1408916.67, 0, 1408916.67, NULL, 'valid', 14, '2026-03-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(29, 3, 5, '2026-04-01', '2026-03-31', 1408916.67, 0, 1408916.67, NULL, 'valid', 14, '2026-04-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(30, 3, 6, '2026-05-01', NULL, 1408916.67, 50000, 1408916.67, NULL, 'telat', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 06:04:59'),
(31, 3, 7, '2026-06-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(32, 3, 8, '2026-07-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(33, 3, 9, '2026-08-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(34, 3, 10, '2026-09-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(35, 3, 11, '2026-10-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(36, 3, 12, '2026-11-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(37, 3, 13, '2026-12-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(38, 3, 14, '2027-01-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(39, 3, 15, '2027-02-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(40, 3, 16, '2027-03-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(41, 3, 17, '2027-04-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(42, 3, 18, '2027-05-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(43, 3, 19, '2027-06-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(44, 3, 20, '2027-07-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(45, 3, 21, '2027-08-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(46, 3, 22, '2027-09-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(47, 3, 23, '2027-10-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(48, 3, 24, '2027-11-01', NULL, 1408916.67, 0, 1408916.67, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(49, 4, 1, '2025-11-01', '2025-10-31', 3700083.33, 0, 3700083.33, NULL, 'valid', 14, '2025-11-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(50, 4, 2, '2025-12-01', '2025-11-30', 3700083.33, 0, 3700083.33, NULL, 'valid', 14, '2025-12-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(51, 4, 3, '2026-01-01', '2025-12-31', 3700083.33, 0, 3700083.33, NULL, 'valid', 14, '2026-01-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(52, 4, 4, '2026-02-01', '2026-01-31', 3700083.33, 0, 3700083.33, NULL, 'valid', 14, '2026-02-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(53, 4, 5, '2026-03-01', '2026-02-28', 3700083.33, 0, 3700083.33, NULL, 'valid', 14, '2026-03-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(54, 4, 6, '2026-04-01', '2026-03-31', 3700083.33, 0, 3700083.33, NULL, 'valid', 14, '2026-04-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(55, 5, 1, '2025-12-01', '2025-11-30', 1377458.33, 0, 1377458.33, NULL, 'valid', 14, '2025-12-01 03:00:00', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(56, 5, 2, '2026-01-01', NULL, 1377458.33, 50000, 1427458.33, NULL, 'telat', NULL, NULL, 'Belum dibayar melewati tanggal jatuh tempo.', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(57, 5, 3, '2026-02-01', NULL, 1377458.33, 50000, 1427458.33, NULL, 'telat', NULL, NULL, 'Belum dibayar melewati tanggal jatuh tempo.', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(58, 5, 4, '2026-03-01', NULL, 1377458.33, 50000, 1427458.33, NULL, 'telat', NULL, NULL, 'Belum dibayar melewati tanggal jatuh tempo.', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(59, 5, 5, '2026-04-01', NULL, 1377458.33, 50000, 1377458.33, NULL, 'telat', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 06:04:59'),
(60, 5, 6, '2026-05-01', NULL, 1377458.33, 50000, 1377458.33, NULL, 'telat', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 06:04:59'),
(61, 5, 7, '2026-06-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(62, 5, 8, '2026-07-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(63, 5, 9, '2026-08-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(64, 5, 10, '2026-09-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(65, 5, 11, '2026-10-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(66, 5, 12, '2026-11-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(67, 5, 13, '2026-12-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(68, 5, 14, '2027-01-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(69, 5, 15, '2027-02-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(70, 5, 16, '2027-03-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(71, 5, 17, '2027-04-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(72, 5, 18, '2027-05-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(73, 5, 19, '2027-06-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(74, 5, 20, '2027-07-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(75, 5, 21, '2027-08-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(76, 5, 22, '2027-09-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(77, 5, 23, '2027-10-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(78, 5, 24, '2027-11-01', NULL, 1377458.33, 0, 1377458.33, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(79, 6, 1, '2026-04-01', NULL, 1503687.5, 50000, 1503687.5, NULL, 'telat', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 06:04:59'),
(80, 6, 2, '2026-05-01', NULL, 1503687.5, 50000, 1503687.5, NULL, 'telat', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 06:04:59'),
(81, 6, 3, '2026-06-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:58'),
(82, 6, 4, '2026-07-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(83, 6, 5, '2026-08-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(84, 6, 6, '2026-09-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(85, 6, 7, '2026-10-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(86, 6, 8, '2026-11-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(87, 6, 9, '2026-12-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(88, 6, 10, '2027-01-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(89, 6, 11, '2027-02-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(90, 6, 12, '2027-03-01', NULL, 1503687.5, 0, 1503687.5, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(91, 7, 1, '2026-05-06', NULL, 5575000, 0, 5575000, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 12:03:06', '2026-05-06 12:03:06'),
(92, 7, 2, '2026-06-06', NULL, 5575000, 0, 5575000, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 12:03:06', '2026-05-06 12:03:06'),
(93, 7, 3, '2026-07-06', NULL, 5575000, 0, 5575000, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 12:03:06', '2026-05-06 12:03:06'),
(94, 7, 4, '2026-08-06', NULL, 5575000, 0, 5575000, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 12:03:06', '2026-05-06 12:03:06'),
(95, 7, 5, '2026-09-06', NULL, 5575000, 0, 5575000, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 12:03:06', '2026-05-06 12:03:06'),
(96, 7, 6, '2026-10-06', NULL, 5575000, 0, 5575000, NULL, 'menunggu', NULL, NULL, NULL, '2026-05-06 12:03:06', '2026-05-06 12:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `asuransi`
--

CREATE TABLE `asuransi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan_asuransi` varchar(255) NOT NULL,
  `nama_asuransi` varchar(255) NOT NULL,
  `margin_asuransi` decimal(8,2) NOT NULL,
  `no_rekening` varchar(255) DEFAULT NULL,
  `url_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asuransi`
--

INSERT INTO `asuransi` (`id`, `nama_perusahaan_asuransi`, `nama_asuransi`, `margin_asuransi`, `no_rekening`, `url_logo`, `created_at`, `updated_at`) VALUES
(3, 'PT Aman Berkendara', 'Asuransi All Risk Premium', 2.50, '0011223344', 'seed/logo/aman-berkendara.png', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(4, 'PT Proteksi Nusantara', 'Asuransi Kehilangan & Kecelakaan', 1.75, '9988776655', 'seed/logo/proteksi-nusantara.png', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(5, 'PT Sentosa Proteksi Motor', 'Asuransi Comprehensive Fleet', 2.15, '5566778899', 'seed/logo/sentosa-proteksi.png', '2026-05-06 05:48:57', '2026-05-06 05:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cicilan`
--

CREATE TABLE `jenis_cicilan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lama_cicilan` int(10) UNSIGNED NOT NULL,
  `margin_kredit` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_cicilan`
--

INSERT INTO `jenis_cicilan` (`id`, `lama_cicilan`, `margin_kredit`, `created_at`, `updated_at`) VALUES
(3, 3, 3.00, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(4, 6, 5.00, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(5, 12, 10.00, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(6, 18, 14.00, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(7, 24, 18.00, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(8, 36, 25.00, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(9, 48, 32.00, '2026-05-06 05:48:57', '2026-05-06 05:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_motor`
--

CREATE TABLE `jenis_motor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `merk` varchar(255) NOT NULL,
  `tipe` enum('bebek','skuter','dual_sport','naked_sport','sport_bike','retro','cruiser','sport_touring','dirt_bike','motocross','scrambler','atv','motor_adventure','lainnya') NOT NULL,
  `deskripsi_jenis` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_motor`
--

INSERT INTO `jenis_motor` (`id`, `merk`, `tipe`, `deskripsi_jenis`, `image_url`, `created_at`, `updated_at`) VALUES
(7, 'Honda', 'skuter', 'Skuter matik irit dan nyaman untuk mobilitas harian.', 'seed/motor/honda-vario-160.png', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(8, 'Yamaha', 'skuter', 'Skuter premium dengan bagasi lega dan fitur konektivitas.', 'seed/motor/yamaha-nmax.jpg', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(9, 'Yamaha', 'sport_bike', 'Motor sport untuk performa tinggi dan gaya agresif.', 'seed/motor/yamaha-r15.jpg', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(10, 'Suzuki', 'bebek', 'Motor bebek tangguh untuk usaha dan keluarga.', 'seed/motor/suzuki-smash-fi.jpg', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(11, 'Suzuki', 'skuter', 'Skuter praktis untuk aktivitas perkotaan dan harian.', 'seed/motor/suzuki-address-fi.jpg', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(12, 'Kawasaki', 'dual_sport', 'Motor untuk jalanan kota dan semi adventure.', 'seed/motor/kawasaki-klx-150.jpg', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(13, 'Kawasaki', 'sport_bike', 'Sport bike fairing untuk pengendara yang ingin tampilan agresif.', 'seed/motor/kawasaki-ninja-250.jpg', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(14, 'Kawasaki', 'retro', 'Motor retro klasik dengan karakter santai dan elegan.', 'seed/motor/kawasaki-w175.jpg', '2026-05-06 05:48:57', '2026-05-06 05:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `kredit`
--

CREATE TABLE `kredit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_kredit_id` bigint(20) UNSIGNED NOT NULL,
  `metode_bayar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_kontrak` varchar(255) NOT NULL,
  `tgl_mulai_kredit` date NOT NULL,
  `tgl_selesai_kredit` date NOT NULL,
  `total_kredit` double NOT NULL,
  `sisa_kredit` double NOT NULL,
  `status_kredit` enum('aktif','macet','lunas','dibatalkan') NOT NULL DEFAULT 'aktif',
  `keterangan_status_kredit` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kredit`
--

INSERT INTO `kredit` (`id`, `pengajuan_kredit_id`, `metode_bayar_id`, `no_kontrak`, `tgl_mulai_kredit`, `tgl_selesai_kredit`, `total_kredit`, `sisa_kredit`, `status_kredit`, `keterangan_status_kredit`, `created_at`, `updated_at`) VALUES
(2, 9, 4, 'KM-20260506-0001', '2026-03-01', '2027-02-01', 34875000, 29062500, 'aktif', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(3, 10, 6, 'KM-20260506-0002', '2025-12-01', '2027-11-01', 33814000, 26769416.65, 'aktif', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(4, 11, 7, 'KM-20260506-0003', '2025-11-01', '2026-04-01', 22200500, 0, 'lunas', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(5, 12, 5, 'KM-20260506-0004', '2025-12-01', '2027-11-01', 33059000, 31681541.67, 'macet', 'Beberapa angsuran melewati jatuh tempo.', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(6, 13, 4, 'KM-20260506-0005', '2026-04-01', '2027-03-01', 18044250, 18044250, 'aktif', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(7, 14, 4, 'KM-20260506-0006', '2026-05-06', '2026-10-06', 33450000, 33450000, 'aktif', NULL, '2026-05-06 12:03:06', '2026-05-06 12:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `metode_bayar`
--

CREATE TABLE `metode_bayar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `url_logo` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metode_bayar`
--

INSERT INTO `metode_bayar` (`id`, `nama_bank`, `nomor_rekening`, `atas_nama`, `url_logo`, `status`, `created_at`, `updated_at`) VALUES
(4, 'BCA', '1234567890', 'PT Kredit Motor Nusantara', 'motor/as3n9IQotttujaEQT7yWxx8IvKu5GTfMfhyma2ib.png', 'aktif', '2026-05-06 05:48:57', '2026-05-06 12:08:38'),
(5, 'BRI', '9876543210', 'PT Kredit Motor Nusantara', 'motor/k3xvCrlhNNGCtjFFuGgcCnSY5RmUSg33jefaz7ek.jpg', 'aktif', '2026-05-06 05:48:57', '2026-05-06 12:08:47'),
(6, 'Mandiri', '1122334455', 'PT Kredit Motor Nusantara', 'motor/916l5VB6vGybsnUmhQ2EF6ZixtwSJTQyOwLBBG0z.jpg', 'aktif', '2026-05-06 05:48:57', '2026-05-06 12:08:54'),
(7, 'BNI', '6677889900', 'PT Kredit Motor Nusantara', 'motor/Lnk4XIpqmd3CR3TUDh5DTiytPKvnmrHe2hwVg6SB.jpg', 'aktif', '2026-05-06 05:48:57', '2026-05-06 12:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2026_05_01_151206_create_pelanggan_table', 1),
(3, '2026_05_01_151207_create_jenis_motor_table', 1),
(4, '2026_05_01_151207_create_motor_table', 1),
(5, '2026_05_01_151208_create_asuransi_table', 1),
(6, '2026_05_01_151208_create_jenis_cicilan_table', 1),
(7, '2026_05_01_151209_create_kredit_table', 1),
(8, '2026_05_01_151209_create_metode_bayar_table', 1),
(9, '2026_05_01_151209_create_pengajuan_kredit_table', 1),
(10, '2026_05_01_151210_create_angsuran_table', 1),
(11, '2026_05_01_151210_create_pengiriman_table', 1),
(12, '2026_05_03_000001_add_metode_bayar_to_pengajuan_kredit_table', 1),
(13, '2026_05_05_000001_move_pengajuan_user_to_pelanggan', 1),
(14, '2026_05_06_000002_update_pengajuan_status_options', 2);

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_motor_id` bigint(20) UNSIGNED NOT NULL,
  `nama_motor` varchar(255) NOT NULL,
  `harga_jual` bigint(20) UNSIGNED NOT NULL,
  `deskripsi_motor` text NOT NULL,
  `warna` varchar(255) DEFAULT NULL,
  `kapasitas_mesin` varchar(255) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `foto1` varchar(255) DEFAULT NULL,
  `foto2` varchar(255) DEFAULT NULL,
  `foto3` varchar(255) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `status` enum('tersedia','habis','nonaktif') NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`id`, `jenis_motor_id`, `nama_motor`, `harga_jual`, `deskripsi_motor`, `warna`, `kapasitas_mesin`, `tahun`, `foto1`, `foto2`, `foto3`, `stok`, `status`, `created_at`, `updated_at`) VALUES
(5, 7, 'Honda Vario 160 CBS', 27600000, 'Skutik premium dengan tampilan sporty, mesin 160cc eSP+, dan fitur modern.', 'Matte Black', '160cc', '2025', 'seed/motor/honda-vario-160.png', 'seed/motor/honda-pcx-160.jpg', 'seed/motor/honda-scoopy.jpg', 8, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(6, 7, 'Honda PCX 160 ABS', 36000000, 'Skutik elegan dengan ABS, bagasi lega, dan kenyamanan premium.', 'Majestic Matte Red', '160cc', '2025', 'seed/motor/honda-pcx-160.jpg', 'seed/motor/honda-vario-160.png', 'seed/motor/honda-scoopy.jpg', 4, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 12:03:06'),
(7, 7, 'Honda BeAT Street', 19100000, 'Skutik ringan untuk mobilitas harian dengan desain street style.', 'Street Black', '110cc', '2025', 'seed/motor/honda-beat-street.png', 'seed/motor/honda-vario-160.png', 'seed/motor/honda-scoopy.jpg', 11, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:58'),
(8, 7, 'Honda Scoopy Stylish', 22500000, 'Skutik retro modern dengan desain compact dan fitur smart key.', 'Stylish Brown', '110cc', '2025', 'seed/motor/honda-scoopy.jpg', 'seed/motor/honda-beat-street.png', 'seed/motor/honda-vario-160.png', 10, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(9, 9, 'Yamaha R15 Connected', 39800000, 'Motor sport fairing dengan DNA R-Series dan konektivitas modern.', 'Icon Blue', '155cc', '2025', 'seed/motor/yamaha-r15.jpg', 'seed/motor/yamaha-nmax.jpg', 'seed/motor/kawasaki-ninja-250.jpg', 3, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(10, 8, 'Yamaha NMAX 155', 32600000, 'Skuter maxi dengan posisi berkendara nyaman dan fitur konektivitas.', 'Prestige Silver', '155cc', '2025', 'seed/motor/yamaha-nmax.jpg', 'seed/motor/yamaha-r15.jpg', 'seed/motor/honda-pcx-160.jpg', 6, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(11, 8, 'Yamaha Aerox 155', 29200000, 'Skuter sporty bertenaga 155cc dengan karakter lincah untuk kota.', 'CyberCity', '155cc', '2025', 'seed/motor/yamaha-nmax.jpg', 'seed/motor/yamaha-r15.jpg', 'seed/motor/honda-vario-160.png', 9, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(12, 10, 'Suzuki Smash FI', 19400000, 'Motor bebek ekonomis dengan konsumsi bahan bakar irit.', 'Titan Black', '115cc', '2024', 'seed/motor/suzuki-smash-fi.jpg', 'seed/motor/suzuki-address-fi.jpg', 'seed/motor/suzuki-satria-f150.jpg', 5, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(13, 10, 'Suzuki Satria F150', 29400000, 'Motor underbone sporty dengan mesin 150cc dan tampilan agresif.', 'Metallic Triton Blue', '150cc', '2025', 'seed/motor/suzuki-satria-f150.jpg', 'seed/motor/suzuki-smash-fi.jpg', 'seed/motor/suzuki-address-fi.jpg', 6, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(14, 11, 'Suzuki Address FI', 20100000, 'Skuter praktis dengan bagasi luas dan konsumsi bahan bakar efisien.', 'Brilliant White', '113cc', '2024', 'seed/motor/suzuki-address-fi.jpg', 'seed/motor/suzuki-smash-fi.jpg', 'seed/motor/honda-beat-street.png', 7, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(15, 12, 'Kawasaki KLX 150', 33800000, 'Dual purpose ringan untuk area kota dan off-road ringan.', 'Lime Green', '150cc', '2025', 'seed/motor/kawasaki-klx-150.jpg', 'seed/motor/kawasaki-w175.jpg', 'seed/motor/kawasaki-ninja-250.jpg', 2, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(16, 13, 'Kawasaki Ninja 250', 66500000, 'Sport bike fairing 250cc untuk pengendara yang mengejar performa.', 'Lime Green Ebony', '250cc', '2025', 'seed/motor/kawasaki-ninja-250.jpg', 'seed/motor/kawasaki-klx-150.jpg', 'seed/motor/yamaha-r15.jpg', 2, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(17, 14, 'Kawasaki W175 SE', 35200000, 'Motor retro klasik dengan desain sederhana dan mesin mudah dirawat.', 'Metallic Spark Black', '177cc', '2025', 'seed/motor/kawasaki-w175.jpg', 'seed/motor/kawasaki-klx-150.jpg', 'seed/motor/kawasaki-ninja-250.jpg', 4, 'tersedia', '2026-05-06 05:48:57', '2026-05-06 05:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `katakunci` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat1` varchar(255) DEFAULT NULL,
  `kota1` varchar(255) DEFAULT NULL,
  `propinsi1` varchar(255) DEFAULT NULL,
  `kodepos1` varchar(255) DEFAULT NULL,
  `alamat2` varchar(255) DEFAULT NULL,
  `kota2` varchar(255) DEFAULT NULL,
  `propinsi2` varchar(255) DEFAULT NULL,
  `kodepos2` varchar(255) DEFAULT NULL,
  `alamat3` varchar(255) DEFAULT NULL,
  `kota3` varchar(255) DEFAULT NULL,
  `propinsi3` varchar(255) DEFAULT NULL,
  `kodepos3` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `user_id`, `nama_pelanggan`, `email`, `katakunci`, `no_telp`, `alamat1`, `kota1`, `propinsi1`, `kodepos1`, `alamat2`, `kota2`, `propinsi2`, `kodepos2`, `alamat3`, `kota3`, `propinsi3`, `kodepos3`, `foto`, `created_at`, `updated_at`) VALUES
(5, 18, 'User CredFast', 'user@gmail.com', '$2y$12$Xc5sED9zyRocLte2/WrM4.KQ5j2yyVLnWAt1z9IC763sAeshFw4xm', '081234567893', 'Jl. Melati No. 10', 'Semarang', 'Jawa Tengah', '50123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'seed/profile/user.png', '2026-05-06 05:48:56', '2026-05-06 05:48:56'),
(6, 19, 'Nina Pelanggan', 'nina@gmail.com', '$2y$12$CHRlcK4ZCQKFgk0HLFynk.l8BBMj7Cb1p9PA5fNp.AkjM58EnBnFa', '081234567894', 'Jl. Anggrek No. 18', 'Yogyakarta', 'DI Yogyakarta', '55161', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'seed/profile/nina.png', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(7, 20, 'Budi Santoso', 'budi@gmail.com', '$2y$12$bVf5HM.RSbF7XJ8VgvTYhOdz8S0d4LOPSqrqt.LvTC4zMkic1/Fw2', '081222333444', 'Jl. Ahmad Yani No. 45', 'Bekasi', 'Jawa Barat', '17141', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'seed/profile/budi.png', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(8, 21, 'Sari Lestari', 'sari@gmail.com', '$2y$12$oByAQ4ADSDIJYZtHuCdb1e7BllfSu9lUm4.PgRzMkfBk53UM0qWnm', '081333444555', 'Jl. Gajah Mada No. 8', 'Denpasar', 'Bali', '80111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'seed/profile/sari.png', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(9, 22, 'Dimas Pratama', 'dimas@gmail.com', '$2y$12$OpPH.5V1h1N26JADLNFIbO/IWfgUaZI9hKYh1g8ZK3Vc4lb83hVhi', '081444555666', 'Jl. Pahlawan No. 17', 'Malang', 'Jawa Timur', '65111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'seed/profile/dimas.png', '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(10, 23, 'A. Zahir', 'akmalzahir931@gmail.com', '$2y$12$UIKpd7qrHGm.OPoXwcEFz.LQTo2o6WA1YBz.b2tqrUDDPotuMqyRS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-06 06:04:59', '2026-05-06 06:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_kredit`
--

CREATE TABLE `pengajuan_kredit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `motor_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_cicilan_id` bigint(20) UNSIGNED NOT NULL,
  `asuransi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tgl_pengajuan_kredit` date NOT NULL,
  `harga_cash` bigint(20) UNSIGNED NOT NULL,
  `dp` bigint(20) UNSIGNED NOT NULL,
  `harga_kredit` double NOT NULL,
  `biaya_asuransi_perbulan` double NOT NULL DEFAULT 0,
  `cicilan_perbulan` double NOT NULL,
  `url_kk` varchar(255) DEFAULT NULL,
  `url_ktp` varchar(255) DEFAULT NULL,
  `url_npwp` varchar(255) DEFAULT NULL,
  `url_slip_gaji` varchar(255) DEFAULT NULL,
  `url_foto` varchar(255) DEFAULT NULL,
  `status_pengajuan` enum('menunggu_konfirmasi','diproses','dibatalkan_pembeli','dibatalkan_penjual','bermasalah','diterima') NOT NULL DEFAULT 'menunggu_konfirmasi',
  `catatan_marketing` text DEFAULT NULL,
  `marketing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `keterangan_status_pengajuan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `metode_bayar_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_kredit`
--

INSERT INTO `pengajuan_kredit` (`id`, `pelanggan_id`, `motor_id`, `jenis_cicilan_id`, `asuransi_id`, `tgl_pengajuan_kredit`, `harga_cash`, `dp`, `harga_kredit`, `biaya_asuransi_perbulan`, `cicilan_perbulan`, `url_kk`, `url_ktp`, `url_npwp`, `url_slip_gaji`, `url_foto`, `status_pengajuan`, `catatan_marketing`, `marketing_id`, `admin_id`, `keterangan_status_pengajuan`, `created_at`, `updated_at`, `metode_bayar_id`) VALUES
(3, 5, 5, 5, 3, '2026-05-02', 27600000, 5000000, 25550000, 57500, 2129166.67, NULL, NULL, NULL, NULL, NULL, 'menunggu_konfirmasi', NULL, NULL, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:58', 4),
(4, 6, 9, 7, 3, '2026-04-26', 39800000, 7000000, 39699000, 41458.33, 1654125, NULL, NULL, NULL, NULL, NULL, 'diproses', 'Prospek bagus, dokumen lengkap.', 15, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57', 5),
(5, 6, 12, 5, NULL, '2026-04-21', 19400000, 2000000, 19140000, 0, 1595000, NULL, NULL, NULL, NULL, NULL, 'dibatalkan_penjual', NULL, 15, NULL, 'Slip gaji belum memenuhi kriteria.', '2026-05-06 05:48:57', '2026-05-06 05:48:57', 6),
(6, 8, 14, 6, 4, '2026-05-04', 20100000, 3000000, 19845750, 19541.67, 1102541.67, NULL, NULL, NULL, NULL, NULL, 'bermasalah', NULL, 16, NULL, 'NPWP dan slip gaji belum dilengkapi.', '2026-05-06 05:48:57', '2026-05-06 05:48:57', 7),
(7, 7, 16, 8, 5, '2026-04-30', 66500000, 15000000, 65804750, 39715.28, 1827909.72, NULL, NULL, NULL, NULL, NULL, 'diproses', 'Survey rumah dijadwalkan pekan ini.', 15, NULL, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57', 4),
(8, 9, 8, 4, 4, '2026-04-27', 22500000, 2000000, 21918750, 65625, 3653125, NULL, NULL, NULL, NULL, NULL, 'dibatalkan_pembeli', NULL, NULL, NULL, 'User membatalkan pengajuan dari dashboard.', '2026-05-06 05:48:57', '2026-05-06 05:48:57', 5),
(9, 5, 9, 5, 3, '2026-03-03', 39800000, 9000000, 34875000, 82916.67, 2906250, NULL, NULL, NULL, NULL, NULL, 'diterima', 'Layak pembiayaan.', 15, 14, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57', 4),
(10, 7, 6, 7, 5, '2025-12-04', 36000000, 8000000, 33814000, 32250, 1408916.67, NULL, NULL, NULL, NULL, NULL, 'diterima', 'Riwayat pembayaran dan domisili valid.', 15, 14, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57', 6),
(11, 8, 10, 4, 4, '2025-11-01', 32600000, 12000000, 22200500, 95083.33, 3700083.33, NULL, NULL, NULL, NULL, NULL, 'diterima', 'DP besar dan tenor pendek.', 16, 14, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57', 7),
(12, 9, 15, 7, 3, '2025-11-28', 33800000, 6500000, 33059000, 35208.33, 1377458.33, NULL, NULL, NULL, NULL, NULL, 'diterima', 'Disetujui dengan catatan monitoring ketat.', 16, 14, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57', 5),
(13, 6, 7, 5, 4, '2026-04-16', 19100000, 3000000, 18044250, 27854.17, 1503687.5, NULL, NULL, NULL, NULL, NULL, 'diterima', 'Pembelian unit harian untuk operasional pribadi.', 15, 14, NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57', 4),
(14, 10, 6, 4, 3, '2026-05-06', 36000000, 5000000, 33450000, 150000, 5575000, 'dokumen_pengajuan/xMxwmxmCD5Sa9ELpTj8ua1yWGOjKXXRmyuXQAHGv.png', 'dokumen_pengajuan/A0MEJZ6Zx9LN6UeGns0BxTysysLUC7poao6Tgrhx.png', 'dokumen_pengajuan/OK5XaZaWZtBA3LE0CK88QMLgWvIp5D7XuSBkFC6b.png', 'dokumen_pengajuan/ChGzKnXvIL0qiJytrOZHq4WqDXXBXYaTaDn9HwXS.png', 'dokumen_pengajuan/70TwrpaVtVj9imtfuk0Rd96qgEFPOLC4mZ8RWLZ8.png', 'diterima', NULL, 15, 14, NULL, '2026-05-06 06:09:15', '2026-05-06 12:03:06', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kredit_id` bigint(20) UNSIGNED NOT NULL,
  `no_invoice` varchar(255) NOT NULL,
  `tgl_kirim` datetime DEFAULT NULL,
  `tgl_tiba` datetime DEFAULT NULL,
  `status_kirim` enum('diproses','dikirim','diterima') NOT NULL DEFAULT 'diproses',
  `nama_kurir` varchar(255) DEFAULT NULL,
  `telpon_kurir` varchar(255) DEFAULT NULL,
  `bukti_foto` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id`, `kredit_id`, `no_invoice`, `tgl_kirim`, `tgl_tiba`, `status_kirim`, `nama_kurir`, `telpon_kurir`, `bukti_foto`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 2, 'INV-KRM-20260506-0001', '2026-05-01 12:48:57', NULL, 'dikirim', 'Rizal Kurir', '081355566677', 'seed/motor/yamaha-r15.jpg', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(3, 3, 'INV-KRM-20260506-0002', '2025-12-17 12:48:57', '2025-12-19 12:48:57', 'diterima', 'Dewi Logistics', '081377788899', 'seed/motor/honda-pcx-160.jpg', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(4, 4, 'INV-KRM-20260506-0003', '2025-11-11 12:48:57', '2025-11-13 12:48:57', 'diterima', 'Made Express', '081399988877', 'seed/motor/yamaha-nmax.jpg', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(5, 5, 'INV-KRM-20260506-0004', '2025-12-12 12:48:57', '2025-12-15 12:48:57', 'diterima', 'Arif Courier', '081366655544', 'seed/motor/kawasaki-klx-150.jpg', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(6, 6, 'INV-KRM-20260506-0005', NULL, NULL, 'diproses', 'Tim Gudang CredFast', '081300011122', 'seed/motor/honda-beat-street.png', NULL, '2026-05-06 05:48:58', '2026-05-06 05:48:58'),
(7, 7, 'INV-KRM-20260506-0006', NULL, NULL, 'diproses', NULL, NULL, NULL, NULL, '2026-05-06 12:03:06', '2026-05-06 12:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','marketing','admin','ceo') NOT NULL DEFAULT 'user',
  `no_hp` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `no_hp`, `alamat`, `kota`, `provinsi`, `kode_pos`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(14, 'Admin CredFast', 'admin@gmail.com', '$2y$12$scQSZ6mq0A95ooX.ooCqeeA6cZpkJavQ6bf4P7185JHpZeWNjbcqa', 'admin', '081234567890', 'Kantor Pusat CredFast', 'Jakarta', 'DKI Jakarta', '10110', 'seed/profile/admin.png', NULL, '2026-05-06 05:48:56', '2026-05-06 05:48:56'),
(15, 'Marketing CredFast', 'marketing@gmail.com', '$2y$12$rMfxMUyT2/3YnTYRCNzfPO78hHFR3z/FNNiCom1jMG6WThYhYDUbu', 'marketing', '081234567891', 'Area Follow Up', 'Bandung', 'Jawa Barat', '40111', 'seed/profile/marketing.png', NULL, '2026-05-06 05:48:56', '2026-05-06 05:48:56'),
(16, 'Marketing Surabaya', 'marketing.surabaya@gmail.com', '$2y$12$izsZkG6EAGLCOq7WPkS6Ve3HL6iGdIqQb3xNYrrJzwFPB3OqVt4nG', 'marketing', '081234567895', 'Jl. Panglima Sudirman No. 21', 'Surabaya', 'Jawa Timur', '60271', 'seed/profile/marketing.png', NULL, '2026-05-06 05:48:56', '2026-05-06 05:48:56'),
(17, 'CEO CredFast', 'ceo@gmail.com', '$2y$12$uCkTIv13I5QmTm71q7WAn.Rn0h4/lYGsoKcZhZRD.07dSbYMOHsZ2', 'ceo', '081234567892', 'Executive Office', 'Surabaya', 'Jawa Timur', '60222', 'seed/profile/ceo.png', NULL, '2026-05-06 05:48:56', '2026-05-06 05:48:56'),
(18, 'User CredFast', 'user@gmail.com', '$2y$12$Xc5sED9zyRocLte2/WrM4.KQ5j2yyVLnWAt1z9IC763sAeshFw4xm', 'user', '081234567893', 'Jl. Melati No. 10', 'Semarang', 'Jawa Tengah', '50123', 'seed/profile/user.png', NULL, '2026-05-06 05:48:56', '2026-05-06 05:48:56'),
(19, 'Nina Pelanggan', 'nina@gmail.com', '$2y$12$CHRlcK4ZCQKFgk0HLFynk.l8BBMj7Cb1p9PA5fNp.AkjM58EnBnFa', 'user', '081234567894', 'Jl. Anggrek No. 18', 'Yogyakarta', 'DI Yogyakarta', '55161', 'seed/profile/nina.png', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(20, 'Budi Santoso', 'budi@gmail.com', '$2y$12$bVf5HM.RSbF7XJ8VgvTYhOdz8S0d4LOPSqrqt.LvTC4zMkic1/Fw2', 'user', '081222333444', 'Jl. Ahmad Yani No. 45', 'Bekasi', 'Jawa Barat', '17141', 'seed/profile/budi.png', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(21, 'Sari Lestari', 'sari@gmail.com', '$2y$12$oByAQ4ADSDIJYZtHuCdb1e7BllfSu9lUm4.PgRzMkfBk53UM0qWnm', 'user', '081333444555', 'Jl. Gajah Mada No. 8', 'Denpasar', 'Bali', '80111', 'seed/profile/sari.png', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(22, 'Dimas Pratama', 'dimas@gmail.com', '$2y$12$OpPH.5V1h1N26JADLNFIbO/IWfgUaZI9hKYh1g8ZK3Vc4lb83hVhi', 'user', '081444555666', 'Jl. Pahlawan No. 17', 'Malang', 'Jawa Timur', '65111', 'seed/profile/dimas.png', NULL, '2026-05-06 05:48:57', '2026-05-06 05:48:57'),
(23, 'A. Zahir', 'akmalzahir931@gmail.com', '$2y$12$UIKpd7qrHGm.OPoXwcEFz.LQTo2o6WA1YBz.b2tqrUDDPotuMqyRS', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-06 06:04:59', '2026-05-06 06:04:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `angsuran_kredit_id_foreign` (`kredit_id`),
  ADD KEY `angsuran_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `asuransi`
--
ALTER TABLE `asuransi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_cicilan`
--
ALTER TABLE `jenis_cicilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_motor`
--
ALTER TABLE `jenis_motor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kredit`
--
ALTER TABLE `kredit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kredit_pengajuan_kredit_id_unique` (`pengajuan_kredit_id`),
  ADD UNIQUE KEY `kredit_no_kontrak_unique` (`no_kontrak`);

--
-- Indexes for table `metode_bayar`
--
ALTER TABLE `metode_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motor_jenis_motor_id_foreign` (`jenis_motor_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelanggan_email_unique` (`email`),
  ADD UNIQUE KEY `pelanggan_user_id_unique` (`user_id`);

--
-- Indexes for table `pengajuan_kredit`
--
ALTER TABLE `pengajuan_kredit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_kredit_pelanggan_id_foreign` (`pelanggan_id`),
  ADD KEY `pengajuan_kredit_motor_id_foreign` (`motor_id`),
  ADD KEY `pengajuan_kredit_jenis_cicilan_id_foreign` (`jenis_cicilan_id`),
  ADD KEY `pengajuan_kredit_asuransi_id_foreign` (`asuransi_id`),
  ADD KEY `pengajuan_kredit_marketing_id_foreign` (`marketing_id`),
  ADD KEY `pengajuan_kredit_admin_id_foreign` (`admin_id`),
  ADD KEY `pengajuan_kredit_metode_bayar_id_foreign` (`metode_bayar_id`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengiriman_kredit_id_unique` (`kredit_id`),
  ADD UNIQUE KEY `pengiriman_no_invoice_unique` (`no_invoice`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `asuransi`
--
ALTER TABLE `asuransi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_cicilan`
--
ALTER TABLE `jenis_cicilan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis_motor`
--
ALTER TABLE `jenis_motor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kredit`
--
ALTER TABLE `kredit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `metode_bayar`
--
ALTER TABLE `metode_bayar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `motor`
--
ALTER TABLE `motor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengajuan_kredit`
--
ALTER TABLE `pengajuan_kredit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD CONSTRAINT `angsuran_kredit_id_foreign` FOREIGN KEY (`kredit_id`) REFERENCES `kredit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `angsuran_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `motor`
--
ALTER TABLE `motor`
  ADD CONSTRAINT `motor_jenis_motor_id_foreign` FOREIGN KEY (`jenis_motor_id`) REFERENCES `jenis_motor` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_kredit`
--
ALTER TABLE `pengajuan_kredit`
  ADD CONSTRAINT `pengajuan_kredit_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengajuan_kredit_asuransi_id_foreign` FOREIGN KEY (`asuransi_id`) REFERENCES `asuransi` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengajuan_kredit_jenis_cicilan_id_foreign` FOREIGN KEY (`jenis_cicilan_id`) REFERENCES `jenis_cicilan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuan_kredit_marketing_id_foreign` FOREIGN KEY (`marketing_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengajuan_kredit_metode_bayar_id_foreign` FOREIGN KEY (`metode_bayar_id`) REFERENCES `metode_bayar` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengajuan_kredit_motor_id_foreign` FOREIGN KEY (`motor_id`) REFERENCES `motor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuan_kredit_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_kredit_id_foreign` FOREIGN KEY (`kredit_id`) REFERENCES `kredit` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
