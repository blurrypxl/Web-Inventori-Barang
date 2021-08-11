-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 05:21 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `sbrg_keluar`
--

CREATE TABLE `sbrg_keluar` (
  `id` int(11) NOT NULL,
  `idx` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `penerima` varchar(35) CHARACTER SET latin1 NOT NULL,
  `keterangan` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sbrg_keluar`
--

INSERT INTO `sbrg_keluar` (`id`, `idx`, `tgl`, `jumlah`, `penerima`, `keterangan`) VALUES
(96, 262, '2021-01-11', 6, 'Workshop', 'Untuk pembuatan master room Bpk.Alip'),
(98, 262, '2021-01-16', 4, 'Finishing', 'Untuk pembuatan kitchen set bpk.kemal'),
(99, 267, '2021-02-12', 8, 'Workshop', 'Untuk pembuatan living room set Bpk.Soepomo'),
(100, 266, '2021-02-15', 2, 'Finishing', 'Untuk pembuatan kitchen set Ibu Desi'),
(101, 264, '2021-03-05', 5, 'Workshop', 'Untuk pembuatan kitchen set Bpk.Alip'),
(102, 265, '2021-03-12', 8, 'Workshop', 'Untuk pembuatan bathroom set Bpk Adi'),
(103, 262, '2021-04-08', 6, 'Workshop', 'Untuk pembuatan backyard set Ibu Neneng'),
(105, 266, '2021-04-12', 3, 'Finishing', 'Untuk pembuatan bathroom set Bpk.Asep'),
(106, 265, '2021-05-06', 4, 'Finishing', 'Untuk pembuatan kitchen set Bpk.Mulyono'),
(108, 262, '2021-05-13', 6, 'Workshop', 'Untuk pembuatan garage set Ibu.Suprapti');

-- --------------------------------------------------------

--
-- Table structure for table `sbrg_masuk`
--

CREATE TABLE `sbrg_masuk` (
  `id` int(11) NOT NULL,
  `idx` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sbrg_masuk`
--

INSERT INTO `sbrg_masuk` (`id`, `idx`, `id_supplier`, `tgl`, `jumlah`) VALUES
(80, 262, 1, '2021-01-09', 3),
(82, 262, 1, '2021-01-14', 5),
(83, 267, 2, '2021-02-10', 4),
(84, 267, 2, '2021-02-16', 2),
(85, 264, 4, '2021-03-02', 3),
(86, 265, 1, '2021-03-10', 5),
(87, 262, 1, '2021-04-05', 6),
(88, 266, 3, '2021-04-10', 3),
(89, 265, 1, '2021-05-04', 5),
(90, 262, 1, '2021-05-12', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sgudang`
--

CREATE TABLE `sgudang` (
  `id_gudang` int(11) NOT NULL,
  `nama_gudang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sgudang`
--

INSERT INTO `sgudang` (`id_gudang`, `nama_gudang`) VALUES
(1, 'Gudang 1'),
(2, 'Gudang 2');

-- --------------------------------------------------------

--
-- Table structure for table `slogin`
--

CREATE TABLE `slogin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slogin`
--

INSERT INTO `slogin` (`id`, `username`, `password`, `nickname`, `role`) VALUES
(1, 'admin1', '912ec803b2ce49e4a541068d495ab570', 'Adi Prayitno', 'super admin'),
(22, 'admin3', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Al Capone', 'admin'),
(16, 'admin2', '81dc9bdb52d04dc20036dbd8313ed055', 'Petugas', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sstock_brg`
--

CREATE TABLE `sstock_brg` (
  `idx` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(55) CHARACTER SET latin1 NOT NULL,
  `jenis` varchar(30) CHARACTER SET latin1 NOT NULL,
  `merk` varchar(40) CHARACTER SET latin1 NOT NULL,
  `ukuran` varchar(20) CHARACTER SET latin1 NOT NULL,
  `stock` int(12) NOT NULL,
  `satuan` varchar(10) CHARACTER SET latin1 NOT NULL,
  `lokasi` varchar(55) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sstock_brg`
--

INSERT INTO `sstock_brg` (`idx`, `id_supplier`, `nama`, `jenis`, `merk`, `ukuran`, `stock`, `satuan`, `lokasi`) VALUES
(262, 1, 'HPL ARBORITE', 'Kayu', 'Arborite', '122x244 cm', 1, 'Unit', 'CSF Gudang 1'),
(264, 4, 'KAYU MELAMIN', 'Kayu', 'Cap Cai', '150x150 cm', 3, 'Unit', 'CSF Gudang 1'),
(265, 1, 'HPL TACO', 'HPL', 'Taco', '144x122 cm', 3, 'Unit', 'CSF Gudang 1'),
(266, 3, 'CAT', 'Duco', 'Nippon Paint', '3 kg', 2, 'Unit', 'CSF Gudang 1'),
(267, 2, 'Beton', 'Besi', 'Krakatau Steel', '20x20 cm', 4, 'Unit', 'CSF Gudang 1'),
(268, 2, 'HOLOW', 'Besi', 'Besi Mantap', '20x20 cm', 10, 'Unit', 'CSF Gudang 2');

-- --------------------------------------------------------

--
-- Table structure for table `ssuplier_brg`
--

CREATE TABLE `ssuplier_brg` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ssuplier_brg`
--

INSERT INTO `ssuplier_brg` (`id_supplier`, `nama_supplier`) VALUES
(1, 'Mitra Abadi'),
(2, 'Surya Logam Universal'),
(3, 'Cat De Lucent'),
(4, 'PK Garuda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sbrg_keluar`
--
ALTER TABLE `sbrg_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx` (`idx`);

--
-- Indexes for table `sbrg_masuk`
--
ALTER TABLE `sbrg_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx` (`idx`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `sgudang`
--
ALTER TABLE `sgudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `slogin`
--
ALTER TABLE `slogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sstock_brg`
--
ALTER TABLE `sstock_brg`
  ADD PRIMARY KEY (`idx`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `ssuplier_brg`
--
ALTER TABLE `ssuplier_brg`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sbrg_keluar`
--
ALTER TABLE `sbrg_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `sbrg_masuk`
--
ALTER TABLE `sbrg_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `sgudang`
--
ALTER TABLE `sgudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slogin`
--
ALTER TABLE `slogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sstock_brg`
--
ALTER TABLE `sstock_brg`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `ssuplier_brg`
--
ALTER TABLE `ssuplier_brg`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sbrg_keluar`
--
ALTER TABLE `sbrg_keluar`
  ADD CONSTRAINT `sbrg_keluar_ibfk_1` FOREIGN KEY (`idx`) REFERENCES `sstock_brg` (`idx`);

--
-- Constraints for table `sbrg_masuk`
--
ALTER TABLE `sbrg_masuk`
  ADD CONSTRAINT `sbrg_masuk_ibfk_1` FOREIGN KEY (`idx`) REFERENCES `sstock_brg` (`idx`),
  ADD CONSTRAINT `sbrg_masuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `ssuplier_brg` (`id_supplier`);

--
-- Constraints for table `sstock_brg`
--
ALTER TABLE `sstock_brg`
  ADD CONSTRAINT `sstock_brg_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `ssuplier_brg` (`id_supplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
