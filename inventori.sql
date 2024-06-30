-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2024 at 01:49 PM
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
`gambar` varchar(255)
,`harga_barang` int
,`kd_barang` varchar(7)
,`kd_layout` varchar(7)
,`kd_satuan` varchar(7)
,`kd_supplier` varchar(7)
,`keterangan` varchar(200)
,`layout` varchar(30)
,`nama_barang` varchar(40)
,`nama_supplier` varchar(40)
,`no_telp` varchar(13)
,`satuan` varchar(40)
,`status` varchar(25)
,`stok_barang` int
,`tanggal_masuk` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailbarangrijek`
-- (See below for the actual view)
--
CREATE TABLE `detailbarangrijek` (
`gambar` varchar(255)
,`harga_barang` int
,`kd_barang` varchar(7)
,`kd_layout` varchar(7)
,`kd_satuan` varchar(7)
,`kd_supplier` varchar(7)
,`keterangan` varchar(200)
,`layout` varchar(30)
,`nama_barang` varchar(40)
,`nama_supplier` varchar(40)
,`no_telp` varchar(13)
,`satuan` varchar(40)
,`status` varchar(25)
,`stok_barang` int
,`tanggal_masuk` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailtransaksi`
-- (See below for the actual view)
--
CREATE TABLE `detailtransaksi` (
`alamat_cust` varchar(255)
,`harga_barang` int
,`jumlah` int
,`jumlah_beli` int
,`kd_barang` varchar(11)
,`kd_pretransaksi` varchar(7)
,`kd_satuan` varchar(7)
,`kd_transaksi` varchar(7)
,`kontak_cust` varchar(25)
,`nama_barang` varchar(40)
,`nama_cust` varchar(25)
,`nomor_armada` varchar(125)
,`satuan` varchar(40)
,`sub_total` int
,`supir_armada` varchar(125)
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

--
-- Dumping data for table `table_barang`
--

INSERT INTO `table_barang` (`kd_barang`, `nama_barang`, `kd_layout`, `kd_supplier`, `kd_satuan`, `tanggal_masuk`, `harga_barang`, `stok_barang`, `gambar`, `keterangan`, `status`) VALUES
('BM001', 'Barang A', 'LI001', 'SP001', 'ST001', '2024-06-30', 10000, 3, '1719695055344.jpg', 'Barang A', 'Unapproved'),
('BM002', 'Sample B', 'LI001', 'SP001', 'ST001', '2024-06-30', 20000, 4, '1719727222315.jpg', 'Sample B', 'Unapproved');

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

--
-- Dumping data for table `table_barang_rijek`
--

INSERT INTO `table_barang_rijek` (`kd_barang`, `nama_barang`, `kd_layout`, `kd_supplier`, `kd_satuan`, `tanggal_masuk`, `harga_barang`, `stok_barang`, `gambar`, `keterangan`, `status`) VALUES
('BR001', 'Rijek A', 'LI001', 'SP001', 'ST001', '2024-06-30', 10000, 5, '1719728199235.jpg', 'Kantong semen sobek', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `table_layout`
--

CREATE TABLE `table_layout` (
  `kd_layout` varchar(7) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `layout` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_layout`
--

INSERT INTO `table_layout` (`kd_layout`, `layout`) VALUES
('LI001', 'Layout A');

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
('AN001', 'TR001', 'BM001', 4, 20000),
('AN002', 'TR002', 'BM001', 2, 20000),
('AN003', 'TR002', 'BM002', 2, 40000),
('AN004', 'TR003', 'BM001', 2, 20000),
('AN005', 'TR004', 'BM002', 2, 40000),
('AN006', 'TR005', 'BM002', 2, 40000),
('AN007', 'TR006', 'BM001', 2, 20000),
('AN008', 'TR006', 'BM002', 3, 60000),
('AN009', 'TR007', 'BM001', 3, 30000),
('AN010', 'TR007', 'BM002', 1, 20000),
('AN011', 'TR008', 'BM002', 1, 20000),
('AN012', 'TR009', 'BM002', 2, 40000),
('AN013', 'TR010', 'BM002', 1, 20000),
('AN014', 'TR011', 'BM002', 1, 20000),
('AN015', 'TR012', 'BM002', 1, 20000),
('AN016', 'TR013', 'BM001', 1, 10000),
('AN017', 'TR014', 'BM001', 1, 10000);

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

--
-- Dumping data for table `table_satuan`
--

INSERT INTO `table_satuan` (`kd_satuan`, `satuan`) VALUES
('ST001', 'Sak');

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
('SP001', 'Supplier A', 'Alamat Supplier A', '087811223344');

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

--
-- Dumping data for table `table_transaksi`
--

INSERT INTO `table_transaksi` (`kd_transaksi`, `kd_user`, `jumlah_beli`, `total_harga`, `tanggal_beli`, `nama_cust`, `kontak_cust`, `alamat_cust`, `nomor_armada`, `supir_armada`, `status`) VALUES
('TR004', 'US004', 2, 40000, '2024-06-30', 'Customer A', '081234563456', 'Jalan Raya Baru No. II', '', '', 'Approved'),
('TR005', 'US004', 2, 40000, '2024-06-30', 'Salsa Cust A', '012345671234', 'Jalan Raya Pantura', 'G 2345 TG', 'Supir A', 'Approved'),
('TR007', 'US004', 4, 50000, '2024-06-30', 'Cust A', '087878789090', 'Jalan Baru', 'G 1234 TR', 'Supir B', 'Approved'),
('TR012', 'US004', 1, 20000, '2024-06-30', 'Cust A', '087878789090', 'Jalan Baru', 'G 1234 TR', 'Supir B', 'Approved'),
('TR013', 'US004', 1, 10000, '2024-06-30', 'Cust A', '087878789090', 'Jalan Baru', 'G 1234 TR', 'Supir B', 'Unapproved'),
('TR014', 'US004', 1, 10000, '2024-06-30', 'Cust A', '087878789090', 'Jalan Baru', 'G 1234 TR', 'Supir B', 'Unapproved');

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
,`status` varchar(25)
,`tanggal_beli` date
,`total_harga` int
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
