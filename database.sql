
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `akses_login` (
  `id` int(3) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(254) NOT NULL,
  `akses` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `akses_login` (`id`, `nama`, `username`, `password`, `akses`) VALUES
(1, 'Adi Subuhadir', 'adi', 'dfc87a8a900d23c665de66efee2248b6881b7771', 'admin'),
(2, 'Kasir', 'kasir', '8691e4fc53b99da544ce86e22acba62d13352eff', 'user');



CREATE TABLE `daftar_menu` (
  `id` int(11) NOT NULL,
  `url_gambar` text DEFAULT NULL,
  `varian_menu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `daftar_menu` (`id`, `url_gambar`, `varian_menu`) VALUES
(1, 'https://raw.githubusercontent.com/adialfatih/wabot-resto2/refs/heads/main/public/menu1.png', 'var1'),
(2, 'https://raw.githubusercontent.com/adialfatih/wabot-resto2/refs/heads/main/public/menu2.png', 'seafood');


CREATE TABLE `gambar_qris` (
  `id` int(11) NOT NULL,
  `url_gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `gambar_qris` (`id`, `url_gambar`) VALUES
(1, 'https://raw.githubusercontent.com/adialfatih/wabot-resto2/refs/heads/main/public/qr.png');


CREATE TABLE `pembayaran_kodeunik` (
  `kode_pesanan` varchar(35) NOT NULL,
  `total_asli` int(11) NOT NULL,
  `kode_unik` int(11) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `status` enum('Menunggu Pembayaran','Dibayar','Dibatalkan') NOT NULL,
  `tanggal_code` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `pembayaran_kodeunik` (`kode_pesanan`, `total_asli`, `kode_unik`, `total_tagihan`, `status`, `tanggal_code`) VALUES
('OR001', 225000, 827, 225827, 'Menunggu Pembayaran', '2025-06-08 00:23:55'),
('OR002', 65000, 122, 65122, 'Menunggu Pembayaran', '2025-06-08 00:23:55');

CREATE TABLE `pembayaran_masuk` (
  `id_pmbmsk` int(11) NOT NULL,
  `kode_pesanan` varchar(30) NOT NULL,
  `nominal_tagihan` int(11) NOT NULL,
  `kode_unik` int(11) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `tgl_terima` datetime NOT NULL,
  `penerima` varchar(35) NOT NULL,
  `jenis_pemb` enum('Cash','QRIS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `pembayaran_masuk` (`id_pmbmsk`, `kode_pesanan`, `nominal_tagihan`, `kode_unik`, `total_pembayaran`, `tgl_terima`, `penerima`, `jenis_pemb`) VALUES
(14, 'OR003', 295000, 0, 295000, '2025-06-09 17:54:48', 'Kasir', 'Cash');

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `kode_pesanan` varchar(10) DEFAULT NULL,
  `nomor_wa` varchar(20) DEFAULT NULL,
  `daftar_kode_menu` text DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `metode_pengambilan` enum('Dine In','Take Away','Delivery') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_meja` varchar(10) DEFAULT NULL,
  `metode_pembayaran` enum('Cash','QRIS') DEFAULT NULL,
  `status` enum('Menunggu Pembayaran','Dibayar','Sedang dibuat','Selesai','Dibatalkan') DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `pesanan` (`id`, `kode_pesanan`, `nomor_wa`, `daftar_kode_menu`, `total_harga`, `metode_pengambilan`, `alamat`, `no_meja`, `metode_pembayaran`, `status`, `tanggal`, `created_at`) VALUES
(1, 'OR001', '6289651253545@c.us', '1x1,2x2,9x1,10x2', 225000, 'Delivery', 'Jl. Hos Cokroaminoto Gg.2 Kuripan Kidul No.312', NULL, 'QRIS', 'Menunggu Pembayaran', '2025-06-04 14:01:17', '2025-06-04 14:01:17'),
(2, 'OR002', '6287713614538@c.us', '1x1,9x1', 65000, 'Dine In', NULL, '02', 'QRIS', 'Menunggu Pembayaran', '2025-06-06 10:25:26', '2025-06-06 10:25:26'),
(3, 'OR003', '6289651253545@c.us', '1x1,2x2,3x1,9x1,10x2', 295000, 'Take Away', NULL, NULL, 'Cash', 'Selesai', '2025-06-06 14:30:22', '2025-06-06 14:30:22'),
(4, 'OR004', '6285643130806@c.us', '1x1,2x2,9x1,10x1,21x1', 315000, 'Dine In', NULL, '7', 'Cash', 'Menunggu Pembayaran', '2025-06-07 13:10:27', '2025-06-07 13:10:27');



CREATE TABLE `pesan_masuk` (
  `id` int(11) NOT NULL,
  `nomor_wa` varchar(20) DEFAULT NULL,
  `isi_pesan` text DEFAULT NULL,
  `tanggal_jam` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `pesan_masuk` (`id`, `nomor_wa`, `isi_pesan`, `tanggal_jam`) VALUES
(1, '6289651253545@c.us', 'tes', '2025-06-04 13:57:41'),
(2, '6289651253545@c.us', 'hai', '2025-06-04 13:57:50'),
(3, '6289651253545@c.us', 'halo', '2025-06-04 13:57:59'),
(4, '6289651253545@c.us', 'hai', '2025-06-04 13:59:14'),
(5, '6289651253545@c.us', 'halo', '2025-06-04 13:59:19'),
(6, '6289651253545@c.us', 'daftar', '2025-06-04 13:59:27'),
(7, '6289651253545@c.us', 'Ronaldo', '2025-06-04 13:59:36'),
(8, '6289651253545@c.us', 'menu', '2025-06-04 13:59:41'),
(9, '6289651253545@c.us', 'help', '2025-06-04 13:59:58'),
(10, '6289651253545@c.us', 'pesan', '2025-06-04 14:00:08'),
(11, '6289651253545@c.us', '#1', '2025-06-04 14:00:13'),
(12, '6289651253545@c.us', '#2 x2', '2025-06-04 14:00:20'),
(13, '6289651253545@c.us', 'es teh', '2025-06-04 14:00:27'),
(14, '6289651253545@c.us', 'teh hangat x2', '2025-06-04 14:00:36'),
(15, '6289651253545@c.us', 'selesai', '2025-06-04 14:00:41'),
(16, '6289651253545@c.us', 'ya', '2025-06-04 14:00:46'),
(17, '6289651253545@c.us', 'delivery', '2025-06-04 14:00:53'),
(18, '6289651253545@c.us', 'Jl. Hos Cokroaminoto Gg.2 Kuripan Kidul No.312', '2025-06-04 14:01:13'),
(19, '6289651253545@c.us', 'qris', '2025-06-04 14:01:17'),
(20, '6289651253545@c.us', 'status', '2025-06-04 14:32:59'),
(21, '6289651253545@c.us', 'hai', '2025-06-04 14:33:15'),
(22, '6289651253545@c.us', 'batal', '2025-06-04 14:33:37'),
(23, '6289651253545@c.us', 'tidak', '2025-06-04 14:33:40'),
(24, '6289651253545@c.us', 'pesan', '2025-06-04 14:34:44'),
(25, '6287713614538@c.us', '', '2025-06-04 14:39:53'),
(26, '6287713614538@c.us', '', '2025-06-04 14:39:53'),
(27, '6287713614538@c.us', 'Ciken', '2025-06-04 14:39:53'),
(28, '6287713614538@c.us', 'Menu', '2025-06-04 14:40:06'),
(29, '6287713614538@c.us', 'Daftar', '2025-06-04 14:40:18'),
(30, '6287713614538@c.us', 'Husein', '2025-06-04 14:40:24'),
(31, '6287713614538@c.us', 'Menu', '2025-06-04 14:40:30'),
(32, '6287713614538@c.us', 'Ciken', '2025-06-04 14:40:45'),
(33, '6287713614538@c.us', '13', '2025-06-04 14:40:54'),
(34, '6287713614538@c.us', 'Menu', '2025-06-04 14:41:04'),
(35, '6287713614538@c.us', 'Chicken', '2025-06-04 14:41:15'),
(36, '6287713614538@c.us', 'Pay', '2025-06-04 14:41:24'),
(37, '6289651253545@c.us', 'tes', '2025-06-04 14:50:08'),
(38, '6287713614538@c.us', 'Pesan', '2025-06-04 14:50:38'),
(39, '6289651253545@c.us', 'status', '2025-06-04 14:50:48'),
(40, '6287713614538@c.us', 'Selesai', '2025-06-04 14:51:03'),
(41, '6287713614538@c.us', 'Menu', '2025-06-04 14:51:13'),
(42, '6287713614538@c.us', 'Sea scallop', '2025-06-04 14:51:30'),
(43, '6287713614538@c.us', 'Hot tea', '2025-06-04 14:51:43'),
(44, '6287713614538@c.us', 'Total', '2025-06-04 14:51:51'),
(45, '6287713614538@c.us', 'Total', '2025-06-04 14:52:01'),
(46, '6289651253545@c.us', 'cara pesan', '2025-06-04 15:51:10'),
(47, '6289651253545@c.us', 'pesan bagaimana', '2025-06-04 15:52:11'),
(48, '6289651253545@c.us', 'batal', '2025-06-04 15:53:03'),
(49, '6289651253545@c.us', 'ya', '2025-06-04 15:53:07'),
(50, '6289651253545@c.us', 'pesan', '2025-06-04 15:53:11'),
(51, '6289651253545@c.us', 'ciken', '2025-06-04 15:53:18'),
(52, '6289651253545@c.us', 'beef', '2025-06-04 15:53:23'),
(53, '6289651253545@c.us', 'list', '2025-06-04 15:53:26'),
(54, '6289651253545@c.us', 'esteh x2', '2025-06-04 15:53:41'),
(55, '6289651253545@c.us', 'coret grilled beef', '2025-06-04 15:53:51'),
(56, '6289651253545@c.us', 'list', '2025-06-04 15:53:54'),
(57, '6289651253545@c.us', 'selesai', '2025-06-04 15:54:00'),
(58, '6289651253545@c.us', 'udah', '2025-06-04 15:54:05'),
(59, '6289651253545@c.us', 'y', '2025-06-04 15:54:21'),
(60, '6289651253545@c.us', 'help', '2025-06-04 15:56:02'),
(61, '6289651253545@c.us', 'h', '2025-06-04 15:56:05'),
(62, '6289651253545@c.us', 'cara pesan', '2025-06-04 15:56:18'),
(63, '6289651253545@c.us', 'help', '2025-06-04 15:56:31'),
(64, '6289651253545@c.us', 'status', '2025-06-04 15:56:42'),
(65, '6287713614538@c.us', 'Totalnya', '2025-06-04 18:46:21'),
(66, '6289651253545@c.us', 'status', '2025-06-04 23:40:01'),
(67, '6289651253545@c.us', 'hai', '2025-06-04 23:45:05'),
(68, '6289651253545@c.us', 'info', '2025-06-04 23:45:20'),
(69, '6289651253545@c.us', 'cara pesan', '2025-06-04 23:45:28'),
(70, '6289651253545@c.us', 'bisa banget pak, 😁', '2025-06-05 08:35:27'),
(71, '6289651253545@c.us', 'bisa buat pemesanan batik berbasis AI smart customer care', '2025-06-05 08:35:52'),
(72, '6289651253545@c.us', 'hai', '2025-06-05 12:50:50'),
(73, '6285201127759@c.us', 'Status', '2025-06-05 22:02:27'),
(74, '6285201127759@c.us', 'Daftar', '2025-06-05 22:04:06'),
(75, '6285201127759@c.us', 'Fatimah', '2025-06-05 22:04:10'),
(76, '6287713614538@c.us', 'Menu', '2025-06-06 04:45:53'),
(77, '6287713614538@c.us', '#1', '2025-06-06 04:46:14'),
(78, '6287713614538@c.us', 'Cara', '2025-06-06 04:46:23'),
(79, '6287713614538@c.us', 'Cara pesan', '2025-06-06 04:46:26'),
(80, '6287713614538@c.us', '#1', '2025-06-06 04:46:52'),
(81, '6287713614538@c.us', 'Help', '2025-06-06 04:47:02'),
(82, '6287713614538@c.us', '#pesan', '2025-06-06 04:47:15'),
(83, '6287713614538@c.us', 'Menu', '2025-06-06 04:47:22'),
(84, '6287713614538@c.us', '#20', '2025-06-06 04:47:33'),
(85, '6287713614538@c.us', 'Pesan #20', '2025-06-06 04:47:41'),
(86, '6287713614538@c.us', 'Pembayaran', '2025-06-06 04:48:01'),
(87, '6287713614538@c.us', 'Cara pesan', '2025-06-06 09:33:25'),
(88, '6287713614538@c.us', 'Menu', '2025-06-06 09:33:51'),
(89, '6287713614538@c.us', '#1', '2025-06-06 09:34:15'),
(90, '6287713614538@c.us', '1', '2025-06-06 09:34:20'),
(91, '6287713614538@c.us', '2', '2025-06-06 09:34:24'),
(92, '6287713614538@c.us', '#4', '2025-06-06 09:34:28'),
(93, '6287713614538@c.us', 'Menu', '2025-06-06 09:34:50'),
(94, '6287713614538@c.us', 'Pesan 12', '2025-06-06 09:34:57'),
(95, '6287713614538@c.us', 'Menu', '2025-06-06 09:51:33'),
(96, '6287713614538@c.us', 'Spicy crab', '2025-06-06 09:51:47'),
(97, '6287713614538@c.us', 'Pesan dulu', '2025-06-06 10:20:47'),
(98, '6287713614538@c.us', 'Cara pesan', '2025-06-06 10:21:05'),
(99, '6287713614538@c.us', 'Menu', '2025-06-06 10:21:23'),
(100, '6287713614538@c.us', 'Pesan #20', '2025-06-06 10:21:34'),
(101, '6287713614538@c.us', 'Pesan', '2025-06-06 10:22:41'),
(102, '6287713614538@c.us', '#1', '2025-06-06 10:24:31'),
(103, '6287713614538@c.us', '#es teh', '2025-06-06 10:24:42'),
(104, '6287713614538@c.us', 'Jumlah', '2025-06-06 10:24:53'),
(105, '6287713614538@c.us', 'Selesai', '2025-06-06 10:24:58'),
(106, '6287713614538@c.us', 'Sudah', '2025-06-06 10:25:09'),
(107, '6287713614538@c.us', 'Dine in', '2025-06-06 10:25:16'),
(108, '6287713614538@c.us', '02', '2025-06-06 10:25:22'),
(109, '6287713614538@c.us', 'Qris', '2025-06-06 10:25:26'),
(110, '6289651253545@c.us', 'help', '2025-06-06 14:22:12'),
(111, '6289651253545@c.us', 'pesan', '2025-06-06 14:23:37'),
(112, '6289651253545@c.us', '#1', '2025-06-06 14:23:46'),
(113, '6289651253545@c.us', '#2x2', '2025-06-06 14:23:57'),
(114, '6289651253545@c.us', '#3x1', '2025-06-06 14:24:05'),
(115, '6289651253545@c.us', 'Ice tea', '2025-06-06 14:24:17'),
(116, '6289651253545@c.us', 'teh hanget x 3', '2025-06-06 14:24:57'),
(117, '6289651253545@c.us', 'list', '2025-06-06 14:25:01'),
(118, '6289651253545@c.us', 'coret hot tea', '2025-06-06 14:26:26'),
(119, '6289651253545@c.us', 'list', '2025-06-06 14:26:31'),
(120, '6289651253545@c.us', 'hot tea x2', '2025-06-06 14:26:39'),
(121, '6289651253545@c.us', 'selesai', '2025-06-06 14:26:44'),
(122, '6289651253545@c.us', 'ya', '2025-06-06 14:26:52'),
(123, '6289651253545@c.us', 'take away', '2025-06-06 14:30:18'),
(124, '6289651253545@c.us', 'cash', '2025-06-06 14:30:22'),
(125, '6289651253545@c.us', 'status', '2025-06-06 14:30:33'),
(126, '6289651253545@c.us', 'tes', '2025-06-07 11:34:58'),
(127, '6289651253545@c.us', 'hai', '2025-06-07 11:35:02'),
(128, '6289651253545@c.us', 'halo', '2025-06-07 13:03:47'),
(129, '6289651253545@c.us', 'hi', '2025-06-07 13:03:51'),
(130, '6285643130806@c.us', 'Hay', '2025-06-07 13:04:00'),
(131, '6285643130806@c.us', 'Daftar', '2025-06-07 13:04:16'),
(132, '6285643130806@c.us', 'Rembo', '2025-06-07 13:04:38'),
(133, '6285643130806@c.us', 'Menu', '2025-06-07 13:05:57'),
(134, '6285643130806@c.us', 'Help', '2025-06-07 13:06:33'),
(135, '6285643130806@c.us', 'Pesan', '2025-06-07 13:06:46'),
(136, '6285643130806@c.us', '#1', '2025-06-07 13:06:57'),
(137, '6285643130806@c.us', '#2x', '2025-06-07 13:07:11'),
(138, '6285643130806@c.us', '#2x2', '2025-06-07 13:07:28'),
(139, '6285643130806@c.us', 'Es teh', '2025-06-07 13:07:40'),
(140, '6285643130806@c.us', 'Teh anget', '2025-06-07 13:08:02'),
(141, '6285643130806@c.us', 'List', '2025-06-07 13:08:13'),
(142, '6285643130806@c.us', 'Beef', '2025-06-07 13:08:31'),
(143, '6285643130806@c.us', 'List', '2025-06-07 13:08:41'),
(144, '6285643130806@c.us', 'Coret', '2025-06-07 13:08:56'),
(145, '6285643130806@c.us', 'Coret grilled beef', '2025-06-07 13:09:11'),
(146, '6285643130806@c.us', 'Liat', '2025-06-07 13:09:25'),
(147, '6285643130806@c.us', 'List', '2025-06-07 13:09:38'),
(148, '6285643130806@c.us', 'Selesai', '2025-06-07 13:09:46'),
(149, '6285643130806@c.us', 'Ya', '2025-06-07 13:09:55'),
(150, '6285643130806@c.us', 'Dine in', '2025-06-07 13:10:10'),
(151, '6285643130806@c.us', '7', '2025-06-07 13:10:14'),
(152, '6285643130806@c.us', 'Cash', '2025-06-07 13:10:27'),
(153, '6285643130806@c.us', 'Status', '2025-06-07 13:10:56'),
(154, '6285643130806@c.us', 'Pesan', '2025-06-07 13:11:05'),
(155, '6285643130806@c.us', 'Batal', '2025-06-07 13:11:30'),
(156, '6285643130806@c.us', 'Ya', '2025-06-07 13:11:39');

CREATE TABLE `table_menu` (
  `kode_menu` varchar(10) NOT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `alias` varchar(235) NOT NULL DEFAULT '',
  `harga` int(11) DEFAULT NULL,
  `kategori` varchar(45) NOT NULL DEFAULT 'null',
  `varians` varchar(55) NOT NULL DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `table_menu` (`kode_menu`, `nama_menu`, `alias`, `harga`, `kategori`, `varians`) VALUES
('1', 'CHICKEN STEAK MEDIUM', '', 50000, 'FOOD', 'CHICKEN'),
('10', 'HOT TEA', 'teh anget,teh hangat,teh panas', 20000, 'DRINK', 'TEA'),
('11', 'HOT LEMON', '', 20000, 'DRINK', 'LEMON'),
('12', 'ICE LEMON', '', 25000, 'DRINK', 'LEMON'),
('13', 'SEA SCALLOP', '', 200000, 'FOOD', 'SEA FOOD'),
('14', 'SPICY CRAB', '', 210000, 'FOOD', 'SEA FOOD'),
('15', 'SPINY LOBSTER', '', 220000, 'FOOD', 'SEA FOOD'),
('16', 'GRILLED LOBSTER', '', 230000, 'FOOD', 'SEA FOOD'),
('17', 'OYSTER', '', 240000, 'FOOD', 'SEA FOOD'),
('18', 'PRAWN SOUP', '', 250000, 'FOOD', 'SEA FOOD'),
('19', 'GRILLED SQUID', '', 260000, 'FOOD', 'SEA FOOD'),
('2', 'CHICKEN TERIYAKI', '', 60000, 'FOOD', 'CHICKEN'),
('20', 'SPICY PRAWN CRISP', '', 100000, 'SNACK', 'SNACK'),
('21', 'SALTED OYSTER CRISP', '', 110000, 'SNACK', 'SNACK'),
('22', 'CRABS CHIPS', '', 120000, 'SNACK', 'SNACK'),
('23', 'SQUID TAKOYAKI', '', 130000, 'SNACK', 'SNACK'),
('24', 'PRAWN DIM SUM', '', 150000, 'SNACK', 'SNACK'),
('3', 'FRIED CHICKEN TALIWANG', '', 70000, 'FOOD', 'CHICKEN'),
('4', 'SPICY STEAK MANADO', '', 120000, 'FOOD', 'CHICKEN'),
('5', 'BEEF STEAK MEDIUM', '', 65000, 'FOOD', 'BEEF'),
('6', 'BLACK PEPPER BEEF', '', 75000, 'FOOD', 'BEEF'),
('7', 'GRILLED BEEF', '', 80000, 'FOOD', 'BEEF'),
('8', 'OXTAIL SOUP', '', 100000, 'FOOD', 'BEEF'),
('9', 'ICE TEA', 'esteh,es teh,s teh,teh es es', 15000, 'DRINK', 'TEA');

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nomor_wa` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal_daftar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `user` (`id`, `nomor_wa`, `nama`, `tanggal_daftar`) VALUES
(1, '6289651253545@c.us', 'RONALDO', '2025-06-04 13:59:36'),
(2, '6287713614538@c.us', 'HUSEIN', '2025-06-04 14:40:24'),
(3, '6285201127759@c.us', 'FATIMAH', '2025-06-05 22:04:10'),
(4, '6285643130806@c.us', 'REMBO', '2025-06-07 13:04:38');

ALTER TABLE `akses_login`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `daftar_menu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `gambar_qris`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pembayaran_masuk`
  ADD PRIMARY KEY (`id_pmbmsk`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pesanan` (`kode_pesanan`);

--
-- Indexes for table `pesan_masuk`
--
ALTER TABLE `pesan_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_menu`
--
ALTER TABLE `table_menu`
  ADD PRIMARY KEY (`kode_menu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_wa` (`nomor_wa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_login`
--
ALTER TABLE `akses_login`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daftar_menu`
--
ALTER TABLE `daftar_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gambar_qris`
--
ALTER TABLE `gambar_qris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran_masuk`
--
ALTER TABLE `pembayaran_masuk`
  MODIFY `id_pmbmsk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesan_masuk`
--
ALTER TABLE `pesan_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
