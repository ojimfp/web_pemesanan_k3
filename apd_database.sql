-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2018 at 06:46 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apd_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `apd`
--

CREATE TABLE `apd` (
  `id_apd` varchar(30) NOT NULL,
  `nama_apd` varchar(30) NOT NULL,
  `gambar_apd` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apd`
--

INSERT INTO `apd` (`id_apd`, `nama_apd`, `gambar_apd`) VALUES
('B001', 'Baju Kerja', ''),
('B002', 'Baju Kerja', ''),
('G001', 'Pelindung Tangan', ''),
('H001', 'Safety Helmet', ''),
('M001', 'Masker', ''),
('S41', 'Safety Shoes', ''),
('S42', 'Safety Shoes', ''),
('S43', 'Safety Shoes', ''),
('S44', 'Safety Shoes', ''),
('T001', 'Pelindung Telinga', ''),
('Y001', 'Ghasjdjsa', '');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nip` int(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tgl_lahir` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nip`, `password`, `nama_karyawan`, `jabatan`, `email`, `jenis_kelamin`, `tgl_lahir`, `alamat`) VALUES
(51001, '51001', 'Ahmad Rifai', 'Admin', 'test@gmail.com', 'L', '13-02-1997', 'Surabaya'),
(51002, '51002', 'Rifai Ahmad', 'Kepala Bagian', 'test1@gmail.com', 'L', '13-02-1997', 'Surabaya'),
(51003, '51003', 'Habib Rifai', 'Karyawan', 'sagj@gmail.com', 'L', '13-02-1997', 'Banyuwangi'),
(52001, '51003', 'Habib', 'Karyawan', 'sagj@gmail.com', 'L', '13-02-1997', 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` varchar(30) NOT NULL,
  `nip_karyawan` int(50) NOT NULL,
  `nip_pj` int(50) NOT NULL,
  `id_apd` varchar(30) NOT NULL,
  `tgl_pinjam` varchar(30) NOT NULL,
  `tgl_kembali` varchar(30) NOT NULL,
  `jumlah` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan`
--

CREATE TABLE `penerimaan` (
  `id_penerimaan` int(30) NOT NULL,
  `id_apd` varchar(30) NOT NULL,
  `nip_karyawan` int(50) NOT NULL,
  `tanggal_penerimaan` varchar(30) NOT NULL,
  `total_penerimaan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` int(30) NOT NULL,
  `jumlah_pengadaan` int(30) NOT NULL,
  `tanggal_pengadaan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`id_pengadaan`, `jumlah_pengadaan`, `tanggal_pengadaan`) VALUES
(1, 12, '28-03-2018');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id_permintaan` int(30) NOT NULL,
  `id_apd` varchar(30) NOT NULL,
  `nip_karyawan` int(50) NOT NULL,
  `tanggal_permintaan` varchar(30) NOT NULL,
  `jumlah_permintaan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_apd` varchar(30) NOT NULL,
  `jumlah_stock` int(30) NOT NULL,
  `id_pengadaan` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_apd`, `jumlah_stock`, `id_pengadaan`) VALUES
('B001', 12, 1),
('B002', 12, 1),
('G001', 12, 1),
('H001', 12, 1),
('M001', 12, 1),
('S41', 12, 1),
('S42', 12, 1),
('S43', 12, 1),
('S44', 12, 1),
('T001', 12, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apd`
--
ALTER TABLE `apd`
  ADD PRIMARY KEY (`id_apd`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `nip_karyawan` (`nip_karyawan`),
  ADD KEY `nip_pj` (`nip_pj`),
  ADD KEY `id_apd` (`id_apd`);

--
-- Indexes for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`id_penerimaan`),
  ADD UNIQUE KEY `id_apd` (`id_apd`),
  ADD UNIQUE KEY `nik_karyawan` (`nip_karyawan`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id_permintaan`),
  ADD UNIQUE KEY `id_apd` (`id_apd`),
  ADD UNIQUE KEY `nik_karyawan` (`nip_karyawan`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD KEY `id_apd` (`id_apd`),
  ADD KEY `jumlah_stock` (`jumlah_stock`),
  ADD KEY `id_pengadaan` (`id_pengadaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `id_penerimaan` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id_permintaan` int(30) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_apd`) REFERENCES `apd` (`id_apd`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`nip_karyawan`) REFERENCES `karyawan` (`nip`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`nip_pj`) REFERENCES `karyawan` (`nip`);

--
-- Constraints for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`id_apd`) REFERENCES `apd` (`id_apd`),
  ADD CONSTRAINT `penerimaan_ibfk_2` FOREIGN KEY (`nip_karyawan`) REFERENCES `karyawan` (`nip`);

--
-- Constraints for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD CONSTRAINT `permintaan_ibfk_1` FOREIGN KEY (`id_apd`) REFERENCES `apd` (`id_apd`),
  ADD CONSTRAINT `permintaan_ibfk_2` FOREIGN KEY (`nip_karyawan`) REFERENCES `karyawan` (`nip`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_pengadaan`) REFERENCES `pengadaan` (`id_pengadaan`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`id_apd`) REFERENCES `apd` (`id_apd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
