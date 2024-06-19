-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2024 at 12:48 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventori`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailbarang`
-- (See below for the actual view)
--
CREATE TABLE `detailbarang` (
`foto_merek` varchar(50)
,`gambar` varchar(255)
,`harga_barang` int
,`kd_barang` varchar(7)
,`kd_merek` varchar(7)
,`kd_supplier` varchar(7)
,`keterangan` varchar(200)
,`merek` varchar(30)
,`nama_barang` varchar(40)
,`nama_supplier` varchar(40)
,`no_telp` varchar(13)
,`stok_barang` int
,`tanggal_masuk` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailtransaksi`
-- (See below for the actual view)
--
CREATE TABLE `detailtransaksi` (
`harga_barang` int
,`jumlah` int
,`jumlah_beli` int
,`kd_barang` varchar(11)
,`kd_pretransaksi` varchar(7)
,`kd_transaksi` varchar(7)
,`nama_barang` varchar(40)
,`sub_total` int
,`tanggal_beli` date
,`total_harga` int
);

-- --------------------------------------------------------

--
-- Table structure for table `table_barang`
--

CREATE TABLE `table_barang` (
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `kd_merek` varchar(7) NOT NULL,
  `kd_supplier` varchar(7) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_barang` int NOT NULL,
  `stok_barang` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_barang`
--

INSERT INTO `table_barang` (`kd_barang`, `nama_barang`, `kd_merek`, `kd_supplier`, `tanggal_masuk`, `harga_barang`, `stok_barang`, `gambar`, `keterangan`) VALUES
('BR001', 'Semen Gresik', 'ME001', 'DS001', '2024-05-27', 80000, 0, '1716134815325.jpg', 'Semen Gresik'),
('BR002', 'semen Padang', 'ME002', 'DS002', '2024-05-27', 50000, 5, '1716205916316.jpg', 'ada'),
('BR003', 'semen', 'ME003', 'DS001', '2024-06-07', 1500000, 0, '1717732050810.jpeg', ''),
('BR004', 'Semen Tanosa', 'ME008', 'DS001', '2024-06-10', 60000, 15, '1717995262743.jpeg', ''),
('BR005', 'Semen Merdeka', 'ME009', 'DS001', '2024-06-10', 45000, 10, '1717995341815.png', ''),
('BR006', 'Kawat Pas', 'ME010', 'DS001', '2024-06-10', 30000, 20, '171799546146.jpg', ''),
('BR007', 'Board Bintang', 'ME007', 'DS001', '2024-06-10', 35000, 25, '1717995644707.jpg', ''),
('BR008', 'Atap Metal Union S-RoofBromo', 'ME004', 'DS001', '2024-06-10', 100000, 50, '1717995858230.jpg', ''),
('BR009', 'Atap Metal Union S-RoofCoklat', 'ME005', 'DS001', '2024-06-10', 100000, 45, '1717996104126.jpg', ''),
('BR010', 'Atap Metal Union S-RoofCarita', 'ME006', 'DS001', '2024-06-10', 100000, 50, '1717996172652.jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_merek`
--

CREATE TABLE `table_merek` (
  `kd_merek` varchar(7) NOT NULL,
  `merek` varchar(30) NOT NULL,
  `foto_merek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_merek`
--

INSERT INTO `table_merek` (`kd_merek`, `merek`, `foto_merek`) VALUES
('ME001', 'Semen Gresik', '1716133565154.jpg'),
('ME002', 'Semen Padang', '1716778942588.jpg'),
('ME003', 'Semen Dynamix', '1716779010521.jpg'),
('ME004', 'Atap Metal Union S-RoofBromo', '1717725200208.jpg'),
('ME005', 'Atap Metal Union S-RoofCoklat', '171772574655.jpg'),
('ME006', 'Atap Metal Union S-RoofCarita', '1717725915272.jpeg'),
('ME007', 'Board Bintang', '1717726055119.jpg'),
('ME008', 'Semen Tonasa', '171794532160.jpeg'),
('ME009', 'Semen Merdeka', '1717945625489.png'),
('ME010', 'Kawat Pas', '1717945724409.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `table_pretransaksi`
--

CREATE TABLE `table_pretransaksi` (
  `kd_pretransaksi` varchar(7) NOT NULL,
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_barang` varchar(11) NOT NULL,
  `jumlah` int NOT NULL,
  `sub_total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_pretransaksi`
--

INSERT INTO `table_pretransaksi` (`kd_pretransaksi`, `kd_transaksi`, `kd_barang`, `jumlah`, `sub_total`) VALUES
('AN001', 'TR001', 'BR001', 3, 240000),
('AN002', 'TR002', 'BR001', 2, 160000),
('AN003', 'TR003', 'BR003', 20, 30000000);

--
-- Triggers `table_pretransaksi`
--
DELIMITER $$
CREATE TRIGGER `batal_beli` AFTER DELETE ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang + OLD.jumlah
WHERE kd_barang = OLD.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaksi` AFTER INSERT ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang - new.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_beli` AFTER UPDATE ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang + OLD.jumlah - NEW.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `table_supplier`
--

CREATE TABLE `table_supplier` (
  `kd_supplier` varchar(7) NOT NULL,
  `nama_supplier` varchar(40) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_supplier`
--

INSERT INTO `table_supplier` (`kd_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
('DS001', 'PT Semen Gresik', 'Gresik, Jawa Timur', '081244003300'),
('DS002', 'PT Semen Padang', 'Padang', '085225605058');

-- --------------------------------------------------------

--
-- Table structure for table `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_user` varchar(7) NOT NULL,
  `jumlah_beli` int NOT NULL,
  `total_harga` int NOT NULL,
  `tanggal_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_transaksi`
--

INSERT INTO `table_transaksi` (`kd_transaksi`, `kd_user`, `jumlah_beli`, `total_harga`, `tanggal_beli`) VALUES
('TR001', 'US003', 3, 240000, '2024-05-19'),
('TR002', 'US003', 2, 160000, '2024-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `kd_user` varchar(7) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `foto_user` varchar(50) NOT NULL,
  `level` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`kd_user`, `nama_user`, `username`, `password`, `foto_user`, `level`) VALUES
('US001', 'Manager', 'manager', 'bWFuYWdlcjEyMw==', '1716778063732.jpeg', 'Manager'),
('US003', 'Checker', 'checker', 'Y2hlY2tlcjEyMw==', '1718764160170.jpg', 'Checker'),
('US004', 'Admin', 'admin', 'YWRtaW4xMjM=', '1716778025352.jpeg', 'Admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi`
-- (See below for the actual view)
--
CREATE TABLE `transaksi` (
`jumlah` int
,`kd_barang` varchar(11)
,`kd_pretransaksi` varchar(7)
,`kd_transaksi` varchar(7)
,`nama_barang` varchar(40)
,`sub_total` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi_terbaru`
-- (See below for the actual view)
--
CREATE TABLE `transaksi_terbaru` (
`jumlah_beli` int
,`kd_transaksi` varchar(7)
,`kd_user` varchar(7)
,`nama_user` varchar(20)
,`tanggal_beli` date
,`total_harga` int
);

-- --------------------------------------------------------

--
-- Structure for view `detailbarang`
--
DROP TABLE IF EXISTS `detailbarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailbarang`  AS SELECT `table_barang`.`kd_barang` AS `kd_barang`, `table_barang`.`nama_barang` AS `nama_barang`, `table_barang`.`kd_merek` AS `kd_merek`, `table_barang`.`kd_supplier` AS `kd_supplier`, `table_barang`.`tanggal_masuk` AS `tanggal_masuk`, `table_barang`.`harga_barang` AS `harga_barang`, `table_barang`.`stok_barang` AS `stok_barang`, `table_barang`.`gambar` AS `gambar`, `table_barang`.`keterangan` AS `keterangan`, `table_merek`.`merek` AS `merek`, `table_merek`.`foto_merek` AS `foto_merek`, `table_supplier`.`nama_supplier` AS `nama_supplier`, `table_supplier`.`no_telp` AS `no_telp` FROM ((`table_barang` join `table_merek` on((`table_barang`.`kd_merek` = `table_merek`.`kd_merek`))) join `table_supplier` on((`table_barang`.`kd_supplier` = `table_supplier`.`kd_supplier`))) ;

-- --------------------------------------------------------

--
-- Structure for view `detailtransaksi`
--
DROP TABLE IF EXISTS `detailtransaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailtransaksi`  AS SELECT `table_pretransaksi`.`kd_pretransaksi` AS `kd_pretransaksi`, `table_pretransaksi`.`kd_transaksi` AS `kd_transaksi`, `table_pretransaksi`.`kd_barang` AS `kd_barang`, `table_pretransaksi`.`jumlah` AS `jumlah`, `table_pretransaksi`.`sub_total` AS `sub_total`, `table_barang`.`nama_barang` AS `nama_barang`, `table_barang`.`harga_barang` AS `harga_barang`, `table_transaksi`.`jumlah_beli` AS `jumlah_beli`, `table_transaksi`.`total_harga` AS `total_harga`, `table_transaksi`.`tanggal_beli` AS `tanggal_beli` FROM ((`table_pretransaksi` join `table_barang` on((`table_pretransaksi`.`kd_barang` = `table_barang`.`kd_barang`))) join `table_transaksi` on((`table_transaksi`.`kd_transaksi` = `table_pretransaksi`.`kd_transaksi`))) ;

-- --------------------------------------------------------

--
-- Structure for view `transaksi`
--
DROP TABLE IF EXISTS `transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi`  AS SELECT `table_pretransaksi`.`kd_pretransaksi` AS `kd_pretransaksi`, `table_pretransaksi`.`kd_transaksi` AS `kd_transaksi`, `table_pretransaksi`.`kd_barang` AS `kd_barang`, `table_pretransaksi`.`jumlah` AS `jumlah`, `table_pretransaksi`.`sub_total` AS `sub_total`, `table_barang`.`nama_barang` AS `nama_barang` FROM (`table_pretransaksi` join `table_barang` on((`table_pretransaksi`.`kd_barang` = `table_barang`.`kd_barang`))) ;

-- --------------------------------------------------------

--
-- Structure for view `transaksi_terbaru`
--
DROP TABLE IF EXISTS `transaksi_terbaru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_terbaru`  AS SELECT `table_transaksi`.`kd_transaksi` AS `kd_transaksi`, `table_transaksi`.`kd_user` AS `kd_user`, `table_transaksi`.`jumlah_beli` AS `jumlah_beli`, `table_transaksi`.`total_harga` AS `total_harga`, `table_transaksi`.`tanggal_beli` AS `tanggal_beli`, `table_user`.`nama_user` AS `nama_user` FROM (`table_transaksi` join `table_user` on((`table_transaksi`.`kd_user` = `table_user`.`kd_user`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_barang`
--
ALTER TABLE `table_barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `kd_distributor` (`kd_supplier`),
  ADD KEY `kd_merek` (`kd_merek`);

--
-- Indexes for table `table_merek`
--
ALTER TABLE `table_merek`
  ADD PRIMARY KEY (`kd_merek`);

--
-- Indexes for table `table_pretransaksi`
--
ALTER TABLE `table_pretransaksi`
  ADD PRIMARY KEY (`kd_pretransaksi`);

--
-- Indexes for table `table_supplier`
--
ALTER TABLE `table_supplier`
  ADD PRIMARY KEY (`kd_supplier`);

--
-- Indexes for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`),
  ADD KEY `kd_user` (`kd_user`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`kd_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD CONSTRAINT `table_transaksi_ibfk_1` FOREIGN KEY (`kd_user`) REFERENCES `table_user` (`kd_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
