-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30 Mar 2019 pada 05.33
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pabb8836_pkreativitas_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(15) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(8) NOT NULL,
  `pertanyaan` varchar(100) NOT NULL,
  `posisi` int(1) NOT NULL,
  `foto_profil` varchar(30) NOT NULL,
  `foto_sampul` varchar(35) NOT NULL,
  `kota_asal` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `email`, `username`, `alamat`, `password`, `pertanyaan`, `posisi`, `foto_profil`, `foto_sampul`, `kota_asal`) VALUES
('ADM020120191327', 'pabrikkreativitas', '1970-09-13', 1, '628139452277', 'pabrikkreativitas@yahoo.com', 'superAdmin', 'Jl. Cikoang No. 48 Cigending, Ujungberung Kota Bandung 40611', 'superAdm', 'p4-nasigoreng', 1, 'img_man.png', 'img_sampul.png', '22'),
('ADM221120181413', 'Rafi', '1996-10-14', 1, '62085795851996', 'admin@pabrikkreativitas.com', 'Rafisf', 'alamat di bandung', 'Rfauzi14', 'p3-uus', 2, 'img_man.png', 'img_sampul.png', '22'),
('ADM271120181210', 'Yuni', '1997-01-12', 0, '6285795851997', 'y.widya12@gmail.com', 'yuni12', 'Lembang', 'yuni1122', 'p3-rafi', 3, 'img_woman.png', 'img_sampul.png', '22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_artikel`
--

CREATE TABLE `tb_artikel` (
  `id_artikel` varchar(15) NOT NULL,
  `judul_artikel` varchar(50) NOT NULL,
  `isi_artikel` text NOT NULL,
  `tgl_artikel` date NOT NULL,
  `id_kategori` varchar(5) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `publish` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_artikel`
--

INSERT INTO `tb_artikel` (`id_artikel`, `judul_artikel`, `isi_artikel`, `tgl_artikel`, `id_kategori`, `id_user`, `publish`) VALUES
('A27122018211', 'Gaya Desain Minimalisme', 'Minimalisme atau seni minimal adalah aliran dalam seni lukis dan pahat sejak tahun 1960-an. Aliran ini cenderung mengurangi bentuk artistik atas dasar pertimbangan logika dan kesederhanaan. Muncul pertama kali pada suprematisme Rusia dan neoplastisisme Belanda. Tokoh-tokoh dalam aliran ini adalah Donald Judd, Robert Moris, Ronald Bladen, Robert Grosvenor, Carl Andre, Robert Smithson, Fred Sandback, Sol LeWitt dan Larry Bell.<br>Aliran minimalis muncul sebagai tren di akhir tahun 1950-an', '2018-12-27', 'KB4', 'ADM221120181413', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bank`
--

CREATE TABLE `tb_bank` (
  `id_bank` varchar(10) NOT NULL,
  `nama_bank` varchar(30) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `no_rek` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bank`
--

INSERT INTO `tb_bank` (`id_bank`, `nama_bank`, `nama_pemilik`, `no_rek`) VALUES
('BANK01', 'BRI', 'Rafi', '1123456784951'),
('BANK02', 'BNI', 'Fauzi', '1123476854951');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku_besar`
--

CREATE TABLE `tb_buku_besar` (
  `id` int(50) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nominal` int(50) NOT NULL,
  `biaya` float NOT NULL,
  `ket` tinyint(1) NOT NULL,
  `transaksi` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_buku_besar`
--

INSERT INTO `tb_buku_besar` (`id`, `tgl_transaksi`, `nominal`, `biaya`, `ket`, `transaksi`, `status`) VALUES
(13, '2018-12-31', 161000, 0.15, 1, 'INV-D/31122018/2018/1', 1),
(14, '2018-12-31', 1380000, 0.15, 1, 'INV-D/31122018/2018/2', 1),
(15, '2018-12-31', 5000000, 0.15, 1, 'INV-J/31122018/2018/3', 1),
(18, '2019-01-01', 50000, 0.15, 0, 'Carikan Dana US221220181220', 1),
(29, '2019-01-01', 23000, 0.15, 1, 'TKT01012019119', 1),
(30, '2019-01-01', 575000, 0.15, 1, 'INV-C/01012019/2019/1', 1),
(31, '2019-01-01', 250000, 0.15, 0, 'Carikan Dana US191120181418', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cetak`
--

CREATE TABLE `tb_cetak` (
  `id_cetak` varchar(20) NOT NULL,
  `jenis_cetak` varchar(50) NOT NULL,
  `format` text NOT NULL,
  `min_pesan` int(100) NOT NULL,
  `max_pesan` int(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `berat` int(10) NOT NULL,
  `ket_harga` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `icon` varchar(20) NOT NULL,
  `pemilik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_cetak`
--

INSERT INTO `tb_cetak` (`id_cetak`, `jenis_cetak`, `format`, `min_pesan`, `max_pesan`, `harga`, `berat`, `ket_harga`, `deskripsi`, `icon`, `pemilik`) VALUES
('CT11122018313', 'Id Card', '9x5,5x9', 100, 500, 5750, 1000, 'per pcs', 'Cetak ID Card adalah proses mencetak kartu pada material kertas pvc dengan mesin cetak offset, <br>sablon atau digital print sehingga menjadi sebuah Kartu ID Card dengan ukuran dan ketebalan yang sama seperti Kartu ATM.<br>Pencetakan id card bisa dilengkapi dengan data personalisasi seperti photo, barcode, nomer karyawan dan lain-lain.<br>Maka dari itulah Kami menerima jasa cetak beberapa kartu yaitu Kartu Member, Kartu Pasien, Kartu Mahasiswa, Kartu Pelajar,<br>Kartu Asuransi, Kartu Garansi, Kartu Anggota,', 'CT11122018313-1.png', 'ADM221120181413');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_client`
--

CREATE TABLE `tb_client` (
  `id_client` varchar(15) NOT NULL,
  `nama_client` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `no_hp` varchar(11) NOT NULL,
  `tgl_mou` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_client`
--

INSERT INTO `tb_client` (`id_client`, `nama_client`, `alamat`, `pemilik`, `no_hp`, `tgl_mou`) VALUES
('C27112018031', 'PT Tokopedia', 'Jakarta', 'William Tanuwijaya', '02180647333', '2018-10-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_desain`
--

CREATE TABLE `tb_desain` (
  `id_desain` varchar(15) NOT NULL,
  `nama_desain` varchar(35) NOT NULL,
  `tgl_upload` date NOT NULL,
  `harga` int(10) NOT NULL,
  `berat` int(10) NOT NULL,
  `color_background` varchar(50) NOT NULL,
  `favorit` int(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_kategori` varchar(3) NOT NULL,
  `pemilik` varchar(20) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_desain`
--

INSERT INTO `tb_desain` (`id_desain`, `nama_desain`, `tgl_upload`, `harga`, `berat`, `color_background`, `favorit`, `deskripsi`, `id_kategori`, `pemilik`, `status`) VALUES
('D0301201913023', 'Gambar PASEN Gambar PASEN', '0000-00-00', 616, 1000, '', 0, 'Desain minimalis adalah salah satu gaya desain yang paling signifikan abad ini. <br>Desain minimalis mungkin bukanlah yang paling populer, tetapi memiliki pengaruh ke hampir segala bidang. <br>Pengaruh desain minimalis bisa dibilang menembus lebih banyak bidang daripada hampir semua tren seni atau gaya desain lainnya.', 'KB2', 'ADM221120181413', '1'),
('D27122018382', 'Gaya Minimalist Desain', '2018-12-27', 80500, 1000, '1.Monokrom,Fullcolor', 0, 'Desain minimalis adalah salah satu gaya desain yang paling signifikan abad ini. <br>Desain minimalis mungkin bukanlah yang paling populer, tetapi memiliki pengaruh ke hampir segala bidang. <br>Pengaruh desain minimalis bisa dibilang menembus lebih banyak bidang daripada hampir semua tren seni atau gaya desain lainnya.', 'KB4', 'ADM221120181413', '1'),
('D2712201857021', 'Front-end development', '2018-12-27', 690000, 1000, 'minimalis colorfull,minimalis monocrom', 1, 'Front-end web development is the practice of converting data to graphical interface for user <br>to view and interact with data through digital interaction using HTML, CSS and JavaScript.', 'KB1', 'US221220181220', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `no_invoice` varchar(30) NOT NULL,
  `id_item` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `file` varchar(40) NOT NULL,
  `format` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`no_invoice`, `id_item`, `qty`, `catatan`, `file`, `format`) VALUES
('INV-D/31122018/2018/1', 'D27122018382', 2, 'Desain kamar anak', '-', '-'),
('INV-D/31122018/2018/2', 'D2712201857021', 2, 'Frontend company profil dan curiculum vitae', '-', '-'),
('INV-J/31122018/2018/3', 'J28122018293', 1, 'data untuk tesis', '-', '-'),
('INV-C/01012019/2019/1', 'CT11122018313', 100, 'harus bagus ya', 'INV-C-01012019-2019-1.psd', '9x5'),
('INV-D/23032019/2019/3', 'D27122018382', 1, 'abc', '-', '-'),
('INV-C/23032019/2019/2', 'CT11122018313', 100, 'abcsdfa', 'INV-C-23032019-2019-2.jpg', '9x5'),
('INV-J/23032019/2019/4', 'J03012019084', 2, 'penjualan', '-', '-'),
('INV-D/23032019/2019/3', 'D27122018382', 2, 'bikin yang bagus', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_wallet`
--

CREATE TABLE `tb_detail_wallet` (
  `id_wallet` varchar(15) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nominal` int(15) NOT NULL,
  `biaya` float NOT NULL,
  `ket` tinyint(1) NOT NULL,
  `transaksi` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_wallet`
--

INSERT INTO `tb_detail_wallet` (`id_wallet`, `tgl_transaksi`, `nominal`, `biaya`, `ket`, `transaksi`, `status`) VALUES
('W221220181220', '2018-12-31', 1173000, 0.15, 1, 'INV-D/31122018/2018/2', 1),
('W191120181418', '2018-12-31', 4250000, 0.15, 1, 'INV-J/31122018/2018/3', 1),
('W221220181220', '2019-01-01', 50000, 0.15, 0, 'Cairkan Dana', 1),
('W191120181418', '2019-01-01', 250000, 0.15, 0, 'Cairkan Dana', 1),
('W191120181418', '2019-03-25', 500000, 0.15, 0, 'Cairkan Dana', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar_artikel`
--

CREATE TABLE `tb_gambar_artikel` (
  `id_artikel` varchar(15) NOT NULL,
  `gambar_artikel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gambar_artikel`
--

INSERT INTO `tb_gambar_artikel` (`id_artikel`, `gambar_artikel`) VALUES
('A27122018211', 'A27122018211-1.jpg'),
('A27122018211', 'A27122018211-2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar_desain`
--

CREATE TABLE `tb_gambar_desain` (
  `id_desain` varchar(15) NOT NULL,
  `gambar_desain` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gambar_desain`
--

INSERT INTO `tb_gambar_desain` (`id_desain`, `gambar_desain`) VALUES
('D2712201857021', 'D2712201857021-1.jpg'),
('D2712201857021', 'D2712201857021-2.jpg'),
('D27122018382', 'D27122018382-1.jpg'),
('D27122018382', 'D27122018382-2.jpg'),
('D0301201913023', 'D0301201913023-1.jpg'),
('D0301201913023', 'D0301201913023-2.jpg'),
('D0301201913023', 'D0301201913023-3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar_jobs`
--

CREATE TABLE `tb_gambar_jobs` (
  `id_jobs` varchar(30) NOT NULL,
  `gambar_jobs` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gambar_jobs`
--

INSERT INTO `tb_gambar_jobs` (`id_jobs`, `gambar_jobs`) VALUES
('J28122018293', 'J28122018293-1.jpg'),
('J28122018293', 'J28122018293-2.jpg'),
('J28122018293', 'J28122018293-3.jpg'),
('J28122018293', 'J28122018293-4.jpg'),
('J03012019084', 'J03012019084-1.jpg'),
('J03012019084', 'J03012019084-2.jpg'),
('J03012019084', 'J03012019084-3.jpg'),
('J03012019544', 'J03012019544-1.jpg'),
('J03012019544', 'J03012019544-2.jpg'),
('J03012019544', 'J03012019544-3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar_visit`
--

CREATE TABLE `tb_gambar_visit` (
  `id_visit` varchar(20) NOT NULL,
  `gambar_visit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gambar_visit`
--

INSERT INTO `tb_gambar_visit` (`id_visit`, `gambar_visit`) VALUES
('V30112018111', 'V30112018111.png'),
('V25122018072', 'V25122018072-1.56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_headline`
--

CREATE TABLE `tb_headline` (
  `id_headline` varchar(5) NOT NULL,
  `gambar_headline` varchar(10) NOT NULL,
  `tgl_headline` date NOT NULL,
  `nama_headline` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_headline`
--

INSERT INTO `tb_headline` (`id_headline`, `gambar_headline`, `tgl_headline`, `nama_headline`) VALUES
('H1', '01.png', '2018-12-24', 'Digitalna Fronta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `kode_jabatan` varchar(5) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`kode_jabatan`, `nama_jabatan`) VALUES
('1', 'Super Admin'),
('2', 'Customer Service'),
('3', 'Karyawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jobs`
--

CREATE TABLE `tb_jobs` (
  `id_jobs` varchar(30) NOT NULL,
  `judul_jobs` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `ket_harga` varchar(50) NOT NULL,
  `berat` int(5) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` int(1) NOT NULL,
  `id_user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jobs`
--

INSERT INTO `tb_jobs` (`id_jobs`, `judul_jobs`, `harga`, `ket_harga`, `berat`, `deskripsi`, `status`, `id_user`) VALUES
('J03012019084', 'coba input posyandu aja', 9600000, 'per data', 1000, 'coba input posyandu ajacoba input posyandu aja<br>coba input posyandu ajacoba input posyandu ajacoba input posyandu aja', 1, 'ADM221120181413'),
('J03012019544', 'coba input posyandu', 9600000, 'per data', 1000, 'coba input posyandu ajacoba input posyandu aja<br>coba input posyandu ajacoba input posyandu ajacoba input posyandu aja', 1, 'ADM221120181413'),
('J28122018293', 'Data Analysis Marketing', 5000000, 'per bulan', 1000, 'Analisis data adalah proses pemeriksaan, pembersihan, transformasi, dan pemodelan data<br>dengan tujuan menemukan informasi yang berguna, memberi tahu kesimpulan, dan mendukung pengambilan keputusan.', 1, 'US191120181418');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` varchar(3) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
('KB1', 'Logo'),
('KB2', 'Branding'),
('KB3', 'Brosur'),
('KB4', 'Cetak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_negara`
--

CREATE TABLE `tb_negara` (
  `kode_negara` varchar(4) NOT NULL,
  `nama_negara` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_negara`
--

INSERT INTO `tb_negara` (`kode_negara`, `nama_negara`) VALUES
('62', 'Indonesia'),
('65', 'Singapura');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_settings`
--

CREATE TABLE `tb_settings` (
  `id_set` varchar(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tagline` text NOT NULL,
  `popup` text NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `maintenance` tinyint(1) NOT NULL,
  `keuntungan` float NOT NULL,
  `keuntungan_visit` float NOT NULL,
  `primary_logo` varchar(30) NOT NULL,
  `secondary_logo` varchar(30) NOT NULL,
  `ugd` varchar(30) NOT NULL,
  `urc` varchar(30) NOT NULL,
  `pasen` varchar(30) NOT NULL,
  `posyandu` varchar(30) NOT NULL,
  `apotik` varchar(30) NOT NULL,
  `vaksin` varchar(30) NOT NULL,
  `client` varchar(50) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_settings`
--

INSERT INTO `tb_settings` (`id_set`, `nama`, `nomor`, `email`, `alamat`, `tagline`, `popup`, `visi`, `misi`, `maintenance`, `keuntungan`, `keuntungan_visit`, `primary_logo`, `secondary_logo`, `ugd`, `urc`, `pasen`, `posyandu`, `apotik`, `vaksin`, `client`, `facebook`, `twitter`, `instagram`) VALUES
('01', 'Pabrik Kreativitas', '+62 813 945 22 777', 'pabrikkreativitas@yahoo.com', 'Jl. Cikoang No. 48 Cigending, Ujungberung Kota Bandung 40611', '#BerkreasiTanpaBatas', 'Kalau Tuan & Nyonya ''ngebet'' pengen desain, buruan pilih UGD. Tapi klo mau nyetak bisa pilih URC. Dan klo mo liat-liat atawa beli produk unik nan kreatif, silahkan masuk ke PASAR SENI (PASEN). selamat ngubek-ngubek ya, semoga berkenan di hati!', 'PABRIK KREATIVITAS adalah sebuah perusahaan desain berjiwa sosial yang bertujuan untuk meningkatkan kesejahteraan pekerja di sektor industri kreatif serta mengingkatkan performa desain, komunikasi dan citra personal, perusahaan dan institusi di Indonesia.', 'Meningkatkan kesejahteraan pekerja di Industri kreatif.<br>\r\nMemproduksi dan mendistribusikan produk kreatif dan inovatif yang inspiratif.<br>\r\nMeningkatkan performa desain, komunikasi dan citra personal, perusahaan dan institusi di Indonesia.<br>\r\n', 0, 0.15, 0.02, 'logo-typo.png', 'logo.png', 'ugd.png', 'urc.png', 'pasen.png', 'posyandu.png', 'apotik.png', 'vaksin.png', '1-Official Partner', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `no_invoice` varchar(30) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `sub_total` int(30) NOT NULL,
  `kurir` varchar(10) NOT NULL,
  `ongkir` int(10) NOT NULL,
  `bukti_transfer` varchar(30) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `id_bank` varchar(10) NOT NULL,
  `no_resi` varchar(30) NOT NULL,
  `status` int(1) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`no_invoice`, `id_user`, `tgl_transaksi`, `sub_total`, `kurir`, `ongkir`, `bukti_transfer`, `tgl_pembayaran`, `id_bank`, `no_resi`, `status`, `keterangan`) VALUES
('INV-C/01012019/2019/1', 'US191120181418', '2019-01-01', 575000, 'tiki', 10000, 'INV-C-01012019-2019-1.jpg', '2019-01-01', 'BANK02', 'JT035467234761', 6, ''),
('INV-D/23032019/2019/3', 'US191120181418', '2019-03-23', 161000, '', 0, '', '0000-00-00', '', '', 0, ''),
('INV-D/31122018/2018/1', 'US221220181220', '2018-12-31', 161000, 'sicepat', 11000, 'INV-D-31122018-2018-1.jpg', '2018-12-31', 'BANK02', 'JT006744234765', 6, ''),
('INV-D/31122018/2018/2', 'US191120181418', '2018-12-31', 1380000, 'email', 8000, 'INV-D-31122018-2018-2.jpg', '2018-12-31', 'BANK01', 'GT7849538800', 6, ''),
('INV-J/31122018/2018/3', 'US221220181220', '2018-12-31', 5000000, 'tiki', 10000, 'INV-J-31122018-2018-3.jpg', '2018-12-31', 'BANK02', 'TK4562351sdfq1243', 6, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi_visit`
--

CREATE TABLE `tb_transaksi_visit` (
  `no_tiket` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_visit` varchar(50) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bukti_bayar` varchar(30) NOT NULL,
  `id_bank` varchar(10) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi_visit`
--

INSERT INTO `tb_transaksi_visit` (`no_tiket`, `id_user`, `id_visit`, `tgl_transaksi`, `tgl_bayar`, `bukti_bayar`, `id_bank`, `status`) VALUES
('TKT01012019119', 'US191120181418', 'V25122018072', '2019-01-01', '2019-01-01', 'TKT01012019119.jpg', 'BANK02', '6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(15) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(8) NOT NULL,
  `pertanyaan` varchar(100) NOT NULL,
  `foto_profil` varchar(30) NOT NULL,
  `foto_sampul` varchar(35) NOT NULL,
  `akun_bank` varchar(100) NOT NULL,
  `kota_asal` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `email`, `username`, `alamat`, `password`, `pertanyaan`, `foto_profil`, `foto_sampul`, `akun_bank`, `kota_asal`) VALUES
('US191120181418', 'Rafi Fauzi', '1996-10-14', 1, '6285795851996', 'mrafi.sfauzi@gmail.com', 'Rafisf', 'Jl sadang subur 2 no.6/16 Rt.03 Rw.14', 'Rfauzi14', 'p4-nasi goreng', 'US191120181418-fp.jpg', 'US191120181418-sp.jpg', 'BNI-0769731979-Rafi', '22'),
('US221220181220', 'Toped Bula', '1997-01-12', 0, '6285795851997', 'Toped@gmail.com', 'Toped', 'Lembang', 'Toped123', 'p3-rafi', 'img_woman.png', 'img_sampul.png', 'BRI-037701000435301-Toped', '22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_visit`
--

CREATE TABLE `tb_visit` (
  `id_visit` varchar(20) NOT NULL,
  `pemilik_acara` varchar(100) NOT NULL,
  `nama_visit` varchar(100) NOT NULL,
  `tgl_visit` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `biaya` int(10) NOT NULL,
  `include` text NOT NULL,
  `tgl_upload` date NOT NULL,
  `tiket` tinyint(1) NOT NULL,
  `stok_tiket` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_visit`
--

INSERT INTO `tb_visit` (`id_visit`, `pemilik_acara`, `nama_visit`, `tgl_visit`, `lokasi`, `biaya`, `include`, `tgl_upload`, `tiket`, `stok_tiket`) VALUES
('V25122018072', 'acarakita.net', 'Workshop Desain Grafis - Flat Design', '2018-04-15', 'Djagongan Cafe Purwokerto', 23000, 'Materi<br>Snack<br>Sertifikat<br>Stiker<br>Teman Baru', '2018-12-25', 1, 92),
('V30112018111', 'Barudak Seni Computer Proudly', 'Seminar Multimedia', '2015-04-11', 'STMIK & POLITEKNIK LPKIA AT GSG LPKIA', 70000, 'Seminar Kit<br>Snack<br>Sertifikat', '2018-12-09', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wallet`
--

CREATE TABLE `tb_wallet` (
  `id_wallet` varchar(15) NOT NULL,
  `id_user` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_wallet`
--

INSERT INTO `tb_wallet` (`id_wallet`, `id_user`) VALUES
('W191120181418', 'US191120181418'),
('W221220181220', 'US221220181220');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_artikel`
--
ALTER TABLE `tb_artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tb_buku_besar`
--
ALTER TABLE `tb_buku_besar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cetak`
--
ALTER TABLE `tb_cetak`
  ADD PRIMARY KEY (`id_cetak`);

--
-- Indexes for table `tb_client`
--
ALTER TABLE `tb_client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `tb_desain`
--
ALTER TABLE `tb_desain`
  ADD PRIMARY KEY (`id_desain`);

--
-- Indexes for table `tb_headline`
--
ALTER TABLE `tb_headline`
  ADD PRIMARY KEY (`id_headline`);

--
-- Indexes for table `tb_jobs`
--
ALTER TABLE `tb_jobs`
  ADD PRIMARY KEY (`id_jobs`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_settings`
--
ALTER TABLE `tb_settings`
  ADD PRIMARY KEY (`id_set`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`no_invoice`);

--
-- Indexes for table `tb_transaksi_visit`
--
ALTER TABLE `tb_transaksi_visit`
  ADD PRIMARY KEY (`no_tiket`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_visit`
--
ALTER TABLE `tb_visit`
  ADD PRIMARY KEY (`id_visit`);

--
-- Indexes for table `tb_wallet`
--
ALTER TABLE `tb_wallet`
  ADD PRIMARY KEY (`id_wallet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_buku_besar`
--
ALTER TABLE `tb_buku_besar`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
