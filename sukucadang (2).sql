-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Sep 2020 pada 14.23
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sukucadang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan`
--

CREATE TABLE `permintaan` (
  `id_permintaan` varchar(10) NOT NULL,
  `id` int(10) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaan`
--

INSERT INTO `permintaan` (`id_permintaan`, `id`, `id_pelanggan`, `no_pol`, `tanggal`, `status`) VALUES
('PN20090200', 1, 1, 'B4455KSI', '2020-09-02', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_detail`
--

CREATE TABLE `permintaan_detail` (
  `id_permintaan` varchar(10) NOT NULL,
  `id_sc` int(10) NOT NULL,
  `jumlah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cabang`
--

CREATE TABLE `tb_cabang` (
  `id_cabang` int(11) NOT NULL,
  `nama_cbg` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_cabang`
--

INSERT INTO `tb_cabang` (`id_cabang`, `nama_cbg`, `alamat`, `telepon`) VALUES
(1, 'Tunas Toyota', 'Jl. Duren Sawit, Jakarta Timur', '02188990');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `warna` varchar(20) NOT NULL,
  `nama_mobil` date NOT NULL,
  `no_pol` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `cp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama`, `telepon`, `cp`, `alamat`) VALUES
(1, 'sriwidianti', '1234567', 'stmi', 'jl cempaka'),
(2, 'Ahmad Susilo', '09876543', 'PT Suka Maju', 'jl cinere');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_permintaan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_po`
--

CREATE TABLE `tb_po` (
  `id_po` int(11) NOT NULL,
  `id_cabang` int(20) NOT NULL,
  `id_supplier` int(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_po_detail`
--

CREATE TABLE `tb_po_detail` (
  `id_po` int(20) NOT NULL,
  `id_sc` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sa`
--

CREATE TABLE `tb_sa` (
  `id_sa` int(11) NOT NULL,
  `nama_sa` varchar(20) NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sukucadang`
--

CREATE TABLE `tb_sukucadang` (
  `id_sc` int(11) NOT NULL,
  `kode_sc` varchar(50) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `stok` int(10) NOT NULL DEFAULT 0,
  `satuan` varchar(100) DEFAULT NULL,
  `tipe_mobil` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sukucadang`
--

INSERT INTO `tb_sukucadang` (`id_sc`, `kode_sc`, `id_supplier`, `nama`, `stok`, `satuan`, `tipe_mobil`, `status`) VALUES
(11, 'A001', 2, 'OLI', 10, 'btl', 'Avanza', ''),
(15, 'A002', 1, 'BEARING', 20, 'pcs', 'Avanza', ''),
(16, 'A003', 2, 'BAN', 6, 'pcs', 'Alpardh', ''),
(18, 'A004', 2, 'BEARING', 0, 'pcs', 'Avanza', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nama`, `alamat`, `telepon`) VALUES
(1, 'CIPTA PIRANTI TEHNIK PT. (PART', 'JL.Pegangsaan Barat, Menteng\r\nJakarta ', '089876543276'),
(2, 'PT TOYOTA ASTRA MOTOR', 'JL.Laksda Yos Sudarso, Sunter II Jakarta', '021345678902'),
(5, 'Astra', 'bekasi', '0987654354');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `jabatan`, `nama`) VALUES
(1, 'tutrahmat', 'rahmat123', 'Service Advisor', 'Rahmat Hidayat'),
(2, 'tutrofik', 'rofik123', 'Gudang', 'Rofik'),
(3, 'tutdedi', 'dedi123', 'Kepala Gudang', 'Dedi Hermanto'),
(4, 'tutpras', 'pras123', 'Kepala Bengkel', 'Prasetyo'),
(5, 'admin', '1234', 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wo`
--

CREATE TABLE `tb_wo` (
  `no_wo` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_penyerahan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_stok`
--

CREATE TABLE `t_stok` (
  `id_stok` int(11) NOT NULL,
  `id_sc` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(200) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_stok`
--

INSERT INTO `t_stok` (`id_stok`, `id_sc`, `type`, `detail`, `id_supplier`, `jumlah`, `tanggal`, `created`, `id`) VALUES
(7, 11, 'in', 'Kulakan', 1, 10, '2020-08-29', '2020-08-29 19:49:40', 5),
(8, 15, 'in', 'tambahan', 2, 20, '2020-08-29', '2020-08-29 19:49:58', 5),
(11, 16, 'in', 'tambahan', 1, 2, '2020-08-31', '2020-08-31 12:10:13', 5),
(12, 16, 'in', 'tambahan', 2, 2, '2020-08-31', '2020-08-31 12:29:45', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id_permintaan`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`),
  ADD UNIQUE KEY `no_pol` (`no_pol`);

--
-- Indeks untuk tabel `permintaan_detail`
--
ALTER TABLE `permintaan_detail`
  ADD KEY `id_sc` (`id_sc`),
  ADD KEY `id_permintaan` (`id_permintaan`);

--
-- Indeks untuk tabel `tb_cabang`
--
ALTER TABLE `tb_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indeks untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`no_pol`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_permintaan` (`id_permintaan`);

--
-- Indeks untuk tabel `tb_po`
--
ALTER TABLE `tb_po`
  ADD PRIMARY KEY (`id_po`),
  ADD KEY `id_cabang` (`id_cabang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `tb_po_detail`
--
ALTER TABLE `tb_po_detail`
  ADD KEY `id_po` (`id_po`),
  ADD KEY `id_sc` (`id_sc`);

--
-- Indeks untuk tabel `tb_sa`
--
ALTER TABLE `tb_sa`
  ADD PRIMARY KEY (`id_sa`);

--
-- Indeks untuk tabel `tb_sukucadang`
--
ALTER TABLE `tb_sukucadang`
  ADD PRIMARY KEY (`id_sc`),
  ADD UNIQUE KEY `kode_sc` (`kode_sc`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_wo`
--
ALTER TABLE `tb_wo`
  ADD PRIMARY KEY (`no_wo`);

--
-- Indeks untuk tabel `t_stok`
--
ALTER TABLE `t_stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_sc` (`id_sc`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_user` (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_cabang`
--
ALTER TABLE `tb_cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_po`
--
ALTER TABLE `tb_po`
  MODIFY `id_po` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_sa`
--
ALTER TABLE `tb_sa`
  MODIFY `id_sa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_sukucadang`
--
ALTER TABLE `tb_sukucadang`
  MODIFY `id_sc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_wo`
--
ALTER TABLE `tb_wo`
  MODIFY `no_wo` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_stok`
--
ALTER TABLE `t_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `permintaan_detail`
--
ALTER TABLE `permintaan_detail`
  ADD CONSTRAINT `permintaan_detail_ibfk_2` FOREIGN KEY (`id_sc`) REFERENCES `tb_sukucadang` (`id_sc`),
  ADD CONSTRAINT `permintaan_detail_ibfk_3` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan` (`id_permintaan`);

--
-- Ketidakleluasaan untuk tabel `tb_po`
--
ALTER TABLE `tb_po`
  ADD CONSTRAINT `tb_po_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `tb_cabang` (`id_cabang`),
  ADD CONSTRAINT `tb_po_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`);

--
-- Ketidakleluasaan untuk tabel `tb_po_detail`
--
ALTER TABLE `tb_po_detail`
  ADD CONSTRAINT `tb_po_detail_ibfk_1` FOREIGN KEY (`id_po`) REFERENCES `tb_po` (`id_po`),
  ADD CONSTRAINT `tb_po_detail_ibfk_2` FOREIGN KEY (`id_sc`) REFERENCES `tb_sukucadang` (`id_sc`);

--
-- Ketidakleluasaan untuk tabel `tb_sukucadang`
--
ALTER TABLE `tb_sukucadang`
  ADD CONSTRAINT `tb_sukucadang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`);

--
-- Ketidakleluasaan untuk tabel `t_stok`
--
ALTER TABLE `t_stok`
  ADD CONSTRAINT `t_stok_ibfk_1` FOREIGN KEY (`id_sc`) REFERENCES `tb_sukucadang` (`id_sc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_stok_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id_supplier`),
  ADD CONSTRAINT `t_stok_ibfk_3` FOREIGN KEY (`id`) REFERENCES `tb_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
