-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2024 at 03:06 AM
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
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailbarang`
-- (See below for the actual view)
--
CREATE TABLE `detailbarang` (
`kd_barang` varchar(7)
,`nama_barang` varchar(40)
,`kd_layout` varchar(7)
,`kd_satuan` varchar(7)
,`kd_supplier` varchar(7)
,`tanggal_masuk` date
,`harga_barang` int
,`stok_barang` int
,`gambar` varchar(255)
,`keterangan` varchar(200)
,`status` varchar(25)
,`layout` varchar(30)
,`satuan` varchar(40)
,`nama_supplier` varchar(40)
,`no_telp` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailbarangrijek`
-- (See below for the actual view)
--
CREATE TABLE `detailbarangrijek` (
`kd_barang` varchar(7)
,`nama_barang` varchar(40)
,`kd_layout` varchar(7)
,`kd_satuan` varchar(7)
,`kd_supplier` varchar(7)
,`tanggal_masuk` date
,`harga_barang` int
,`stok_barang` int
,`gambar` varchar(255)
,`keterangan` varchar(200)
,`status` varchar(25)
,`layout` varchar(30)
,`satuan` varchar(40)
,`nama_supplier` varchar(40)
,`no_telp` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailtransaksi`
-- (See below for the actual view)
--
CREATE TABLE `detailtransaksi` (
`kd_pretransaksi` varchar(7)
,`kd_transaksi` varchar(7)
,`kd_barang` varchar(11)
,`jumlah` int
,`sub_total` int
,`nama_barang` varchar(40)
,`harga_barang` int
,`kd_satuan` varchar(7)
,`satuan` varchar(40)
,`jumlah_beli` int
,`total_harga` int
,`tanggal_beli` date
,`nama_cust` varchar(25)
,`kontak_cust` varchar(25)
,`alamat_cust` varchar(255)
,`nomor_armada` varchar(125)
,`supir_armada` varchar(125)
);

-- --------------------------------------------------------

--
-- Table structure for table `table_barang`
--

CREATE TABLE `table_barang` (
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `kd_layout` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_supplier` varchar(7) NOT NULL,
  `kd_satuan` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_barang` int NOT NULL,
  `stok_barang` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_barang_rijek`
--

CREATE TABLE `table_barang_rijek` (
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `kd_layout` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kd_supplier` varchar(7) NOT NULL,
  `kd_satuan` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_barang` int NOT NULL,
  `stok_barang` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_layout`
--

CREATE TABLE `table_layout` (
  `kd_layout` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `layout` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `table_satuan`
--

CREATE TABLE `table_satuan` (
  `kd_satuan` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `satuan` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_user` varchar(7) NOT NULL,
  `jumlah_beli` int NOT NULL,
  `total_harga` int NOT NULL,
  `tanggal_beli` date NOT NULL,
  `nama_cust` varchar(25) NOT NULL,
  `kontak_cust` varchar(25) NOT NULL,
  `alamat_cust` varchar(255) NOT NULL,
  `nomor_armada` varchar(125) NOT NULL,
  `supir_armada` varchar(125) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('US001', 'PT SID Manager', 'manager', 'bWFuYWdlcjEyMw==', 'default.jpg', 'Manager'),
('US003', 'PT SID Checker', 'checker', 'Y2hlY2tlcjEyMw==', 'default.jpg', 'Checker'),
('US004', 'PT SID Admin', 'admin', 'YWRtaW4xMjM=', 'default.jpg', 'Admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi`
-- (See below for the actual view)
--
CREATE TABLE `transaksi` (
`kd_pretransaksi` varchar(7)
,`kd_transaksi` varchar(7)
,`kd_barang` varchar(11)
,`jumlah` int
,`sub_total` int
,`nama_barang` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaksi_terbaru`
-- (See below for the actual view)
--
CREATE TABLE `transaksi_terbaru` (
`kd_transaksi` varchar(7)
,`kd_user` varchar(7)
,`jumlah_beli` int
,`total_harga` int
,`tanggal_beli` date
,`status` varchar(25)
,`nama_user` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `detailbarang`
--
DROP TABLE IF EXISTS `detailbarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailbarang`  AS SELECT `table_barang`.`kd_barang` AS `kd_barang`, `table_barang`.`nama_barang` AS `nama_barang`, `table_barang`.`kd_layout` AS `kd_layout`, `table_barang`.`kd_satuan` AS `kd_satuan`, `table_barang`.`kd_supplier` AS `kd_supplier`, `table_barang`.`tanggal_masuk` AS `tanggal_masuk`, `table_barang`.`harga_barang` AS `harga_barang`, `table_barang`.`stok_barang` AS `stok_barang`, `table_barang`.`gambar` AS `gambar`, `table_barang`.`keterangan` AS `keterangan`, `table_barang`.`status` AS `status`, `table_layout`.`layout` AS `layout`, `table_satuan`.`satuan` AS `satuan`, `table_supplier`.`nama_supplier` AS `nama_supplier`, `table_supplier`.`no_telp` AS `no_telp` FROM (((`table_barang` join `table_layout` on((`table_barang`.`kd_layout` = `table_layout`.`kd_layout`))) join `table_satuan` on((`table_barang`.`kd_satuan` = `table_satuan`.`kd_satuan`))) join `table_supplier` on((`table_barang`.`kd_supplier` = `table_supplier`.`kd_supplier`))) ;

-- --------------------------------------------------------

--
-- Structure for view `detailbarangrijek`
--
DROP TABLE IF EXISTS `detailbarangrijek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailbarangrijek`  AS SELECT `table_barang_rijek`.`kd_barang` AS `kd_barang`, `table_barang_rijek`.`nama_barang` AS `nama_barang`, `table_barang_rijek`.`kd_layout` AS `kd_layout`, `table_barang_rijek`.`kd_satuan` AS `kd_satuan`, `table_barang_rijek`.`kd_supplier` AS `kd_supplier`, `table_barang_rijek`.`tanggal_masuk` AS `tanggal_masuk`, `table_barang_rijek`.`harga_barang` AS `harga_barang`, `table_barang_rijek`.`stok_barang` AS `stok_barang`, `table_barang_rijek`.`gambar` AS `gambar`, `table_barang_rijek`.`keterangan` AS `keterangan`, `table_barang_rijek`.`status` AS `status`, `table_layout`.`layout` AS `layout`, `table_satuan`.`satuan` AS `satuan`, `table_supplier`.`nama_supplier` AS `nama_supplier`, `table_supplier`.`no_telp` AS `no_telp` FROM (((`table_barang_rijek` join `table_layout` on((`table_barang_rijek`.`kd_layout` = `table_layout`.`kd_layout`))) join `table_satuan` on((`table_barang_rijek`.`kd_satuan` = `table_satuan`.`kd_satuan`))) join `table_supplier` on((`table_barang_rijek`.`kd_supplier` = `table_supplier`.`kd_supplier`))) ;

-- --------------------------------------------------------

--
-- Structure for view `detailtransaksi`
--
DROP TABLE IF EXISTS `detailtransaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailtransaksi`  AS SELECT `table_pretransaksi`.`kd_pretransaksi` AS `kd_pretransaksi`, `table_pretransaksi`.`kd_transaksi` AS `kd_transaksi`, `table_pretransaksi`.`kd_barang` AS `kd_barang`, `table_pretransaksi`.`jumlah` AS `jumlah`, `table_pretransaksi`.`sub_total` AS `sub_total`, `table_barang`.`nama_barang` AS `nama_barang`, `table_barang`.`harga_barang` AS `harga_barang`, `table_barang`.`kd_satuan` AS `kd_satuan`, `table_satuan`.`satuan` AS `satuan`, `table_transaksi`.`jumlah_beli` AS `jumlah_beli`, `table_transaksi`.`total_harga` AS `total_harga`, `table_transaksi`.`tanggal_beli` AS `tanggal_beli`, `table_transaksi`.`nama_cust` AS `nama_cust`, `table_transaksi`.`kontak_cust` AS `kontak_cust`, `table_transaksi`.`alamat_cust` AS `alamat_cust`, `table_transaksi`.`nomor_armada` AS `nomor_armada`, `table_transaksi`.`supir_armada` AS `supir_armada` FROM (((`table_pretransaksi` join `table_barang` on((`table_pretransaksi`.`kd_barang` = `table_barang`.`kd_barang`))) join `table_satuan` on((`table_barang`.`kd_satuan` = `table_satuan`.`kd_satuan`))) join `table_transaksi` on((`table_transaksi`.`kd_transaksi` = `table_pretransaksi`.`kd_transaksi`))) ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_terbaru`  AS SELECT `table_transaksi`.`kd_transaksi` AS `kd_transaksi`, `table_transaksi`.`kd_user` AS `kd_user`, `table_transaksi`.`jumlah_beli` AS `jumlah_beli`, `table_transaksi`.`total_harga` AS `total_harga`, `table_transaksi`.`tanggal_beli` AS `tanggal_beli`, `table_transaksi`.`status` AS `status`, `table_user`.`nama_user` AS `nama_user` FROM (`table_transaksi` join `table_user` on((`table_transaksi`.`kd_user` = `table_user`.`kd_user`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_barang`
--
ALTER TABLE `table_barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `kd_distributor` (`kd_supplier`),
  ADD KEY `kd_merek` (`kd_layout`),
  ADD KEY `kd_satuan` (`kd_satuan`);

--
-- Indexes for table `table_barang_rijek`
--
ALTER TABLE `table_barang_rijek`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `kd_distributor` (`kd_supplier`),
  ADD KEY `kd_merek` (`kd_layout`),
  ADD KEY `kd_satuan` (`kd_satuan`);

--
-- Indexes for table `table_layout`
--
ALTER TABLE `table_layout`
  ADD PRIMARY KEY (`kd_layout`);

--
-- Indexes for table `table_pretransaksi`
--
ALTER TABLE `table_pretransaksi`
  ADD PRIMARY KEY (`kd_pretransaksi`);

--
-- Indexes for table `table_satuan`
--
ALTER TABLE `table_satuan`
  ADD PRIMARY KEY (`kd_satuan`);

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
