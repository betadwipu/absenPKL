-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 06:51 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_absensi`
--

CREATE TABLE `tbl_absensi` (
  `id_absensi` int(15) NOT NULL,
  `id_mahasiswa` int(15) DEFAULT NULL,
  `status` int(15) DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_absensi`
--

INSERT INTO `tbl_absensi` (`id_absensi`, `id_mahasiswa`, `status`, `waktu`, `tanggal`) VALUES
(7, 6, 1, '10:17:42', '2024-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(15) NOT NULL,
  `kode_admin` varchar(4) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `kode_admin`, `nama`, `nip`, `email`) VALUES
(4, 'A003', 'betadwipu', '2022122503', 'betadp29@gmail.com'),
(5, 'A005', 'pembim', '1234', 'pembimbing@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alasan`
--

CREATE TABLE `tbl_alasan` (
  `id_alasan` int(15) NOT NULL,
  `id_mahasiswa` int(15) DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_alasan`
--

INSERT INTO `tbl_alasan` (`id_alasan`, `id_mahasiswa`, `alasan`, `tanggal`) VALUES
(5, 6, '', '2024-08-19'),
(6, 6, 'makan', '2024-08-27'),
(7, 6, 'MULWES', '2024-08-30'),
(8, 6, 'MULSSSS', '2024-08-30'),
(9, 6, '', '2024-08-30'),
(10, 6, '', '2024-08-30'),
(11, 6, '', '2024-08-30'),
(12, 6, '', '2024-08-30'),
(13, 6, '', '2024-08-30'),
(14, 6, '', '2024-08-30'),
(15, 6, '', '2024-08-30'),
(16, 6, '', '2024-08-30'),
(17, 6, '', '2024-08-30'),
(18, 6, '', '2024-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dudi`
--

CREATE TABLE `tbl_dudi` (
  `id_dudi` int(15) NOT NULL,
  `kode_dudi` varchar(4) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` int(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dudi`
--

INSERT INTO `tbl_dudi` (`id_dudi`, `kode_dudi`, `nama`, `nip`, `email`) VALUES
(3, 'D001', 'wakit', 1111, 'wakit@mail.com'),
(4, 'D004', 'rara', 12345, '0'),
(5, 'D005', 'beta', 11211, '0'),
(6, 'D006', 'cici', 22121, 'cici@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kegiatan`
--

CREATE TABLE `tbl_kegiatan` (
  `id_kegiatan` int(15) NOT NULL,
  `id_mahasiswa` int(15) DEFAULT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `waktu_awal` time DEFAULT NULL,
  `waktu_akhir` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kegiatan`
--

INSERT INTO `tbl_kegiatan` (`id_kegiatan`, `id_mahasiswa`, `kegiatan`, `waktu_awal`, `waktu_akhir`, `tanggal`) VALUES
(157, 6, 'mengerjakan project ', '08:00:00', '15:00:00', '2024-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `id_mahasiswa` int(15) NOT NULL,
  `kode_mahasiswa` varchar(4) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `universitas` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `mulai_magang` date DEFAULT NULL,
  `akhir_magang` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`id_mahasiswa`, `kode_mahasiswa`, `nama`, `universitas`, `jurusan`, `nim`, `mulai_magang`, `akhir_magang`, `alamat`, `no_telp`, `foto`) VALUES
(6, 'M001', 'BETA DWI PURWANINGSIH', 'SMKN 1 MEJAYAN', 'Rekayasa Perangkat Lunak', '3502/622.063', '2024-06-01', '2024-11-30', 'Ds.Kaligunting,Kec.Mejayan,Kab.Madiun.', '085930021420', 'download-removebg-preview.png'),
(7, 'M007', 'CHELSI DIRA VALENCIA', 'SMKN 1 MEJAYAN', 'REKAYASA PERANGKAT LUNAK', '3502/622.066', '2024-06-01', '2024-11-30', 'Randualas', '085218920374', 'download-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembimbing`
--

CREATE TABLE `tbl_pembimbing` (
  `id_pembimbing` int(15) NOT NULL,
  `kode_pembimbing` varchar(4) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pembimbing`
--

INSERT INTO `tbl_pembimbing` (`id_pembimbing`, `kode_pembimbing`, `nama`, `nip`, `email`) VALUES
(6, 'P006', 'evi', '1111', 'evi@mail.com'),
(7, 'P007', 'tata', '111222', 'tataja@mail.com'),
(10, 'P008', 'tes', '1234', 'tes@mail.com'),
(11, 'P011', 'beta', '22222', 'beta@mail.com'),
(12, 'P012', 'cinta', '5555', 'cinta@mail.com'),
(13, 'P013', 'wakit', '111112', 'wakit@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting_absensi`
--

CREATE TABLE `tbl_setting_absensi` (
  `id_waktu` int(15) DEFAULT NULL,
  `mulai_absen` time DEFAULT NULL,
  `akhir_absen` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_setting_absensi`
--

INSERT INTO `tbl_setting_absensi` (`id_waktu`, `mulai_absen`, `akhir_absen`) VALUES
(1, '08:00:00', '09:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site`
--

CREATE TABLE `tbl_site` (
  `id_site` int(15) DEFAULT NULL,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `pimpinan` varchar(255) DEFAULT NULL,
  `pembimbing` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_site`
--

INSERT INTO `tbl_site` (`id_site`, `nama_instansi`, `pimpinan`, `pembimbing`, `no_telp`, `alamat`, `website`, `logo`) VALUES
(1, 'Universitas Sebelas Maret', 'Hery Kurniawan, S.E. M.Si.', 'Evi susanti S.pd', '(0351) 388296', 'Jl.Imam Bonjol,Sumbersoko,Pandean,Kec.Mejayan,Kab.Madiun', 'https://uns.ac.id', 'png-transparent-sebelas-maret-university-sepuluh-nopember-institute-of-technology-universitas-sebelas-maret-uns-surakarta-diponegoro-university-others-blue-white-text-thumbnail-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(15) NOT NULL,
  `kode_pengguna` varchar(4) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `kode_pengguna`, `username`, `password`, `level`) VALUES
(7, 'A003', 'betadwipu', '4bc1aa6e3296ed49423a0f80b053e3d1', 'Admin'),
(14, 'M001', 'betacantik', '827ccb0eea8a706c4c34a16891f84e7b', 'Mahasiswa'),
(15, 'A005', 'pembimbing', '81dc9bdb52d04dc20036dbd8313ed055', 'Pembimbing'),
(26, 'P006', 'evi', '202cb962ac59075b964b07152d234b70', 'Pembimbing'),
(27, 'P007', 'tata', '827ccb0eea8a706c4c34a16891f84e7b', 'Pembimbing'),
(31, 'P008', 'tes', '202cb962ac59075b964b07152d234b70', 'Pembimbing'),
(34, 'P011', 'beta', '1cdac5ad084879e80e5b67c51baa9095', 'Pembimbing'),
(35, 'D001', 'wakit', '827ccb0eea8a706c4c34a16891f84e7b', 'Dudi'),
(36, 'P012', NULL, NULL, NULL),
(37, 'D004', NULL, NULL, NULL),
(38, 'D005', NULL, NULL, NULL),
(39, 'P013', NULL, NULL, NULL),
(40, 'D006', NULL, NULL, NULL),
(41, 'M007', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `tbl_absensi_ibfk1_1` (`id_mahasiswa`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `kode_admin` (`kode_admin`);

--
-- Indexes for table `tbl_alasan`
--
ALTER TABLE `tbl_alasan`
  ADD PRIMARY KEY (`id_alasan`),
  ADD KEY `tbl_alasan_ibfk1_1` (`id_mahasiswa`);

--
-- Indexes for table `tbl_dudi`
--
ALTER TABLE `tbl_dudi`
  ADD PRIMARY KEY (`id_dudi`),
  ADD KEY `kode_dudi` (`kode_dudi`);

--
-- Indexes for table `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `tbl_kegiatan_ibfk1_1` (`id_mahasiswa`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `kode_mahasiswa` (`kode_mahasiswa`);

--
-- Indexes for table `tbl_pembimbing`
--
ALTER TABLE `tbl_pembimbing`
  ADD PRIMARY KEY (`id_pembimbing`),
  ADD KEY `kode_admin` (`kode_pembimbing`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `kode_pengguna` (`kode_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  MODIFY `id_absensi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_alasan`
--
ALTER TABLE `tbl_alasan`
  MODIFY `id_alasan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_dudi`
--
ALTER TABLE `tbl_dudi`
  MODIFY `id_dudi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  MODIFY `id_kegiatan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  MODIFY `id_mahasiswa` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_pembimbing`
--
ALTER TABLE `tbl_pembimbing`
  MODIFY `id_pembimbing` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD CONSTRAINT `tbl_absensi_ibfk1_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tbl_user` (`kode_pengguna`);

--
-- Constraints for table `tbl_alasan`
--
ALTER TABLE `tbl_alasan`
  ADD CONSTRAINT `tbl_alasan_ibfk1_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_dudi`
--
ALTER TABLE `tbl_dudi`
  ADD CONSTRAINT `tbl_dudi_ibfk_1` FOREIGN KEY (`kode_dudi`) REFERENCES `tbl_user` (`kode_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  ADD CONSTRAINT `tbl_kegiatan_ibfk1_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD CONSTRAINT `tbl_mahasiswa_ibfk_1` FOREIGN KEY (`kode_mahasiswa`) REFERENCES `tbl_user` (`kode_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
