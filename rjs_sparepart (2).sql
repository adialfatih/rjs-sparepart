-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 04:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rjs_sparepart`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_user`
--

CREATE TABLE `akses_user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(244) NOT NULL,
  `nama_user` varchar(55) NOT NULL,
  `akses` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akses_user`
--

INSERT INTO `akses_user` (`iduser`, `username`, `password`, `nama_user`, `akses`) VALUES
(1, 'fina', '713a708df061c2679557989f592ec1681412d784', 'Safina Imaniar', 'admin'),
(2, 'nawa', 'd38f1f588faa7721e44d218fd1c05464901bf9c9', 'Nawa', 'user'),
(3, 'husein', 'bf7787faf72b47f0748f64e76a57bae8aebcb931', 'Husein', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `detil_pembelian`
--

CREATE TABLE `detil_pembelian` (
  `id_detilpem` int(11) NOT NULL,
  `kode_beli` varchar(45) NOT NULL,
  `nama_sparepart` varchar(150) NOT NULL,
  `qty` int(11) NOT NULL,
  `satuan` varchar(35) NOT NULL,
  `harga_qty` double NOT NULL,
  `total_harga` double NOT NULL,
  `lokasi` enum('Kantor','Gudang Weaving','Gudang Spinning','Dipakai') NOT NULL,
  `untuk_divisi` varchar(30) NOT NULL DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detil_pembelian`
--

INSERT INTO `detil_pembelian` (`id_detilpem`, `kode_beli`, `nama_sparepart`, `qty`, `satuan`, `harga_qty`, `total_harga`, `lokasi`, `untuk_divisi`) VALUES
(3, '4Oj3TK5cr68R7GqIdSlMmpb', 'hanna 357 - diesel engine oil sae 40', 1, 'Pail', 1396396, 1396396, 'Kantor', 'Gudang Spinning'),
(4, 'tEfij8vMlHmX7WpYbac5Dz9', 'cover drum wd 75', 10, 'Pcs', 85000, 850000, 'Kantor', 'Gudang Spinning'),
(5, 'tEfij8vMlHmX7WpYbac5Dz9', 'magazine base wd 75', 10, 'Pcs', 120000, 1200000, 'Kantor', 'Gudang Spinning'),
(6, 'tEfij8vMlHmX7WpYbac5Dz9', 'suction duct wd 75', 20, 'Pcs', 175000, 3500000, 'Kantor', 'Gudang Spinning'),
(7, 'tEfij8vMlHmX7WpYbac5Dz9', 'mouth pad wd 75', 100, 'Pcs', 10000, 1000000, 'Kantor', 'Gudang Spinning'),
(8, 'tEfij8vMlHmX7WpYbac5Dz9', 'terpal blower', 6, 'Pcs', 350000, 2100000, 'Kantor', 'Gudang Spinning'),
(12, 'mXbFrw1g0oBfCi9eaKM2Wl8', 'flatbelt [rx 100] [8,9 m]', 5, 'Pcs', 400000, 2000000, 'Kantor', 'Gudang Spinning'),
(13, 'p3j0HQ9tUgOn7wzrCale5iv', ' slive za [hitam] ', 50, 'Pcs', 3000, 150000, 'Kantor', 'Gudang Weaving'),
(14, 'p3j0HQ9tUgOn7wzrCale5iv', ' tali kamran tl 430', 30, 'Pcs', 50000, 1500000, 'Kantor', 'Gudang Weaving'),
(15, 'lcVabnsXgFG02WuQeIfPk8E', 'touchsreen jat 600', 7, 'Pcs', 995000, 6965000, 'Kantor', 'Gudang Weaving'),
(16, 'lcVabnsXgFG02WuQeIfPk8E', 'kontaktor st21 coil 110v', 5, 'Pcs', 495000, 2475000, 'Kantor', 'Gudang Weaving'),
(17, 'lcVabnsXgFG02WuQeIfPk8E', 'lcd jat 6002 pita', 2, 'Pcs', 3100000, 6200000, 'Kantor', 'Gudang Weaving'),
(18, 'lcVabnsXgFG02WuQeIfPk8E', 'kabel data lett off', 3, 'Pcs', 560000, 1680000, 'Kantor', 'Gudang Weaving'),
(19, '4DYP8bvsJcKpfj6aiBqFhgC', 'selenoid pin akumulator jat', 10, 'Pcs', 650000, 6500000, 'Kantor', 'Gudang Weaving'),
(20, '4DYP8bvsJcKpfj6aiBqFhgC', 'socket valve ajl', 20, 'Pcs', 95000, 1900000, 'Kantor', 'Gudang Weaving'),
(21, '4DYP8bvsJcKpfj6aiBqFhgC', 'sensor feeler jat 610 wf', 3, 'Pcs', 995000, 2985000, 'Kantor', 'Gudang Weaving'),
(22, '4DYP8bvsJcKpfj6aiBqFhgC', 'sensor feeler jat 610 wwf', 3, 'Pcs', 995000, 2985000, 'Kantor', 'Gudang Weaving'),
(23, '4DYP8bvsJcKpfj6aiBqFhgC', 'feeler board', 3, 'Pcs', 1400000, 4200000, 'Kantor', 'Gudang Weaving'),
(24, '1wIQWq8k3t7eVrcszg9ShbG', 'flatbelt rapplon gg 11,26 rfc uk. 8900 x 12 mm', 10, 'Pcs', 360000, 3600000, 'Kantor', 'Gudang Spinning'),
(26, 'ua1mNcqIlZYb4Co9DKz6fBF', 'u1 us udr sapphire plus 4/0', 5, 'Pcs', 676500, 3382500, 'Kantor', 'Gudang Spinning'),
(27, 'ua1mNcqIlZYb4Co9DKz6fBF', 'u1 us udr sapphire plus 5/0', 2, 'Pcs', 676500, 1353000, 'Kantor', 'Gudang Spinning'),
(28, '1a0cwgSoqNIt2dTUeAxkuhW', ' cutter bawah', 20, 'Pcs', 95000, 1900000, 'Kantor', 'Gudang Weaving'),
(30, 'hePGUBd0KiTofuvNlYbHFtM', 'bobbin holder toyoda lh', 20, 'Pcs', 110000, 2200000, 'Kantor', 'Gudang Weaving'),
(31, 'hePGUBd0KiTofuvNlYbHFtM', 'bobbin holder toyoda rh', 20, 'Pcs', 110000, 2200000, 'Kantor', 'Gudang Weaving'),
(32, 'LSD1yjHs8PnNZRUcoIEM7lJ', 'dropper 0,3 x 11 x 165 mm', 10000, 'Pcs', 600, 6000000, 'Kantor', 'Gudang Weaving'),
(33, 'LSD1yjHs8PnNZRUcoIEM7lJ', 'gear intermediate t 50', 20, 'Pcs', 120000, 2400000, 'Kantor', 'Gudang Weaving'),
(34, 'MXEnK9dlA20ogsV5TwOuLxP', 'density tipe c (20-90)', 2, 'Pcs', 300000, 600000, 'Kantor', 'Gudang Weaving'),
(35, 'MXEnK9dlA20ogsV5TwOuLxP', 'density tipe e (50-120)', 2, 'Pcs', 300000, 600000, 'Kantor', 'Gudang Weaving'),
(36, 'MXEnK9dlA20ogsV5TwOuLxP', 'cutter kiri bawah ty - 022 lurus', 20, 'Pcs', 65000, 1300000, 'Kantor', 'Gudang Weaving'),
(37, 'MXEnK9dlA20ogsV5TwOuLxP', 'gear intermediate t 49 j5105-10010 (f-276)', 20, 'Pcs', 105000, 2100000, 'Kantor', 'Gudang Weaving'),
(38, 'MXEnK9dlA20ogsV5TwOuLxP', 'bobbin shaft leno spr', 200, 'Pcs', 4000, 800000, 'Kantor', 'Gudang Weaving'),
(39, 'MXEnK9dlA20ogsV5TwOuLxP', 'plat break (xxf - 0242) dia. 35 mm', 2, 'Pcs', 1950000, 3900000, 'Kantor', 'Gudang Weaving'),
(40, 'MXEnK9dlA20ogsV5TwOuLxP', 'plat break (xxf - 0242) dia. 40 mm', 2, 'Pcs', 1950000, 3900000, 'Kantor', 'Gudang Weaving'),
(41, 'MXEnK9dlA20ogsV5TwOuLxP', 'otomatic dropper tipis (f-256)', 5, 'Pcs', 300000, 1500000, 'Kantor', 'Gudang Weaving');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `idpemb` int(11) NOT NULL,
  `tgl_datang` date NOT NULL,
  `tgl_nota` date NOT NULL,
  `no_nota_sj` varchar(243) NOT NULL,
  `supp` varchar(75) NOT NULL,
  `untuk` varchar(65) NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT current_timestamp(),
  `yginput` varchar(45) NOT NULL,
  `kode_beli` varchar(45) NOT NULL,
  `ppn` double NOT NULL DEFAULT 0,
  `pph` double NOT NULL DEFAULT 0,
  `pph_tanggung` enum('penjual','pembeli') NOT NULL DEFAULT 'penjual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`idpemb`, `tgl_datang`, `tgl_nota`, `no_nota_sj`, `supp`, `untuk`, `tgl_input`, `yginput`, `kode_beli`, `ppn`, `pph`, `pph_tanggung`) VALUES
(2, '2025-06-23', '2025-06-20', '0026', 'pt. ramadhan caturkarsa layorda', 'kantor', '2025-06-25 15:27:15', 'fina', '4Oj3TK5cr68R7GqIdSlMmpb', 153604, 0, 'pembeli'),
(3, '2025-06-23', '2025-06-23', '-', 'agta technic', 'kantor', '2025-06-25 15:30:43', 'fina', 'tEfij8vMlHmX7WpYbac5Dz9', 0, 0, 'pembeli'),
(4, '2025-06-24', '2025-06-24', '-', 'putra krishna', 'kantor', '2025-06-25 15:34:43', 'fina', 'mXbFrw1g0oBfCi9eaKM2Wl8', 0, 0, 'pembeli'),
(5, '2025-06-23', '2025-06-20', '431', 'mulia jaya', 'kantor', '2025-06-26 10:11:38', 'fina', 'p3j0HQ9tUgOn7wzrCale5iv', 0, 0, 'pembeli'),
(6, '2025-06-23', '2025-06-23', '05/VI/25', 'cv. munatech', 'kantor', '2025-06-26 10:14:11', 'fina', 'lcVabnsXgFG02WuQeIfPk8E', 0, 0, 'pembeli'),
(7, '2025-06-24', '2025-06-24', '06/VI/25', 'cv. munatech', 'kantor', '2025-06-26 10:17:14', 'fina', '4DYP8bvsJcKpfj6aiBqFhgC', 0, 0, 'pembeli'),
(8, '2025-06-25', '2025-06-23', '101', 'pt. buana adhaya agung indonesia', 'kantor', '2025-06-26 10:22:23', 'fina', '1wIQWq8k3t7eVrcszg9ShbG', 396000, 0, 'pembeli'),
(10, '2025-06-25', '2025-06-23', '004', 'pt. texmach impex ', 'kantor', '2025-06-26 10:24:26', 'fina', 'ua1mNcqIlZYb4Co9DKz6fBF', 520905, 0, 'pembeli'),
(11, '2025-06-25', '2025-06-24', '432', 'mulia jaya', 'kantor', '2025-06-26 10:32:46', 'fina', '1a0cwgSoqNIt2dTUeAxkuhW', 0, 0, 'pembeli'),
(13, '2025-06-26', '2025-06-21', '332', 'cv. mulia beltindo', 'kantor', '2025-06-26 15:25:53', 'fina', 'hePGUBd0KiTofuvNlYbHFtM', 0, 0, 'pembeli'),
(14, '2025-06-26', '2025-06-25', '335', 'cv. mulia beltindo', 'kantor', '2025-06-26 15:29:03', 'fina', 'LSD1yjHs8PnNZRUcoIEM7lJ', 0, 0, 'pembeli'),
(15, '2025-06-26', '2025-06-25', '341', 'cv. mulia beltindo', 'kantor', '2025-06-26 15:31:09', 'fina', 'MXEnK9dlA20ogsV5TwOuLxP', 0, 0, 'pembeli');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_tarik`
--

CREATE TABLE `riwayat_tarik` (
  `id_rwtyk` int(11) NOT NULL,
  `id_detilpem` int(11) NOT NULL,
  `tujuan` enum('Weaving','Spinning','Pemakain') NOT NULL,
  `id_sp` int(4) NOT NULL,
  `tanggal_tarik` date NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `satuan_dus` int(11) NOT NULL,
  `satuan_pack` int(11) NOT NULL,
  `satuan_pcs` varchar(20) NOT NULL,
  `penempatan` varchar(30) NOT NULL,
  `kode_qr` varchar(50) NOT NULL,
  `initial_code` enum('dus','pack','pcs') NOT NULL,
  `yg_narik` varchar(50) NOT NULL,
  `codeinput` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_sparepart`
--

CREATE TABLE `stok_sparepart` (
  `idstok` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `qrcode` varchar(50) NOT NULL,
  `initial_code` enum('dus','pack','pcs') NOT NULL,
  `codeinput` varchar(50) NOT NULL,
  `lokasi` varchar(55) NOT NULL,
  `penempatan` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_sparepart`
--

CREATE TABLE `table_sparepart` (
  `id_sp` int(11) NOT NULL,
  `kategori_sp` varchar(55) NOT NULL,
  `nama_sparepart` varchar(254) NOT NULL,
  `kodesp` varchar(4) NOT NULL,
  `struktur_barang` varchar(20) NOT NULL DEFAULT 'null',
  `initial_code` varchar(20) NOT NULL DEFAULT 'pcs'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_onkantor`
-- (See below for the actual view)
--
CREATE TABLE `v_onkantor` (
`id_detilpem` int(11)
,`kode_beli` varchar(45)
,`nama_sparepart` varchar(150)
,`qty` int(11)
,`satuan` varchar(35)
,`harga_qty` double
,`total_harga` double
,`lokasi` enum('Kantor','Gudang Weaving','Gudang Spinning','Dipakai')
,`idpemb` int(11)
,`tgl_datang` date
,`tgl_nota` date
,`no_nota_sj` varchar(243)
,`supp` varchar(75)
,`untuk` varchar(65)
,`tgl_input` datetime
,`yginput` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_onkantor2`
-- (See below for the actual view)
--
CREATE TABLE `v_onkantor2` (
`id_detilpem` int(11)
,`kode_beli` varchar(45)
,`nama_sparepart` varchar(150)
,`qty` int(11)
,`satuan` varchar(35)
,`harga_qty` double
,`total_harga` double
,`lokasi` enum('Kantor','Gudang Weaving','Gudang Spinning','Dipakai')
,`untuk_divisi` varchar(30)
,`idpemb` int(11)
,`tgl_datang` date
,`tgl_nota` date
,`no_nota_sj` varchar(243)
,`supp` varchar(75)
,`untuk` varchar(65)
,`tgl_input` datetime
,`yginput` varchar(45)
);

-- --------------------------------------------------------

--
-- Structure for view `v_onkantor`
--
DROP TABLE IF EXISTS `v_onkantor`;

CREATE VIEW `v_onkantor`  AS SELECT `detil_pembelian`.`id_detilpem` AS `id_detilpem`, `detil_pembelian`.`kode_beli` AS `kode_beli`, `detil_pembelian`.`nama_sparepart` AS `nama_sparepart`, `detil_pembelian`.`qty` AS `qty`, `detil_pembelian`.`satuan` AS `satuan`, `detil_pembelian`.`harga_qty` AS `harga_qty`, `detil_pembelian`.`total_harga` AS `total_harga`, `detil_pembelian`.`lokasi` AS `lokasi`, `pembelian`.`idpemb` AS `idpemb`, `pembelian`.`tgl_datang` AS `tgl_datang`, `pembelian`.`tgl_nota` AS `tgl_nota`, `pembelian`.`no_nota_sj` AS `no_nota_sj`, `pembelian`.`supp` AS `supp`, `pembelian`.`untuk` AS `untuk`, `pembelian`.`tgl_input` AS `tgl_input`, `pembelian`.`yginput` AS `yginput` FROM (`detil_pembelian` join `pembelian`) WHERE `detil_pembelian`.`kode_beli` = `pembelian`.`kode_beli` AND `detil_pembelian`.`lokasi` = 'Kantor''Kantor'  ;

-- --------------------------------------------------------

--
-- Structure for view `v_onkantor2`
--
DROP TABLE IF EXISTS `v_onkantor2`;

CREATE  VIEW `v_onkantor2`  AS SELECT `detil_pembelian`.`id_detilpem` AS `id_detilpem`, `detil_pembelian`.`kode_beli` AS `kode_beli`, `detil_pembelian`.`nama_sparepart` AS `nama_sparepart`, `detil_pembelian`.`qty` AS `qty`, `detil_pembelian`.`satuan` AS `satuan`, `detil_pembelian`.`harga_qty` AS `harga_qty`, `detil_pembelian`.`total_harga` AS `total_harga`, `detil_pembelian`.`lokasi` AS `lokasi`, `detil_pembelian`.`untuk_divisi` AS `untuk_divisi`, `pembelian`.`idpemb` AS `idpemb`, `pembelian`.`tgl_datang` AS `tgl_datang`, `pembelian`.`tgl_nota` AS `tgl_nota`, `pembelian`.`no_nota_sj` AS `no_nota_sj`, `pembelian`.`supp` AS `supp`, `pembelian`.`untuk` AS `untuk`, `pembelian`.`tgl_input` AS `tgl_input`, `pembelian`.`yginput` AS `yginput` FROM (`detil_pembelian` join `pembelian`) WHERE `detil_pembelian`.`kode_beli` = `pembelian`.`kode_beli` AND `detil_pembelian`.`lokasi` = 'Kantor''Kantor'  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_user`
--
ALTER TABLE `akses_user`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `detil_pembelian`
--
ALTER TABLE `detil_pembelian`
  ADD PRIMARY KEY (`id_detilpem`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`idpemb`);

--
-- Indexes for table `riwayat_tarik`
--
ALTER TABLE `riwayat_tarik`
  ADD PRIMARY KEY (`id_rwtyk`);

--
-- Indexes for table `stok_sparepart`
--
ALTER TABLE `stok_sparepart`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `table_sparepart`
--
ALTER TABLE `table_sparepart`
  ADD PRIMARY KEY (`id_sp`),
  ADD UNIQUE KEY `kodesp` (`kodesp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_user`
--
ALTER TABLE `akses_user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detil_pembelian`
--
ALTER TABLE `detil_pembelian`
  MODIFY `id_detilpem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idpemb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `riwayat_tarik`
--
ALTER TABLE `riwayat_tarik`
  MODIFY `id_rwtyk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_sparepart`
--
ALTER TABLE `stok_sparepart`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_sparepart`
--
ALTER TABLE `table_sparepart`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
