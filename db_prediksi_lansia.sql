-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2026 pada 08.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_prediksi_lansia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktivitas_lansia`
--

CREATE TABLE `aktivitas_lansia` (
  `id_aktivitas` int(11) NOT NULL,
  `id_lansia` int(11) NOT NULL,
  `aktivitas_fisik` varchar(100) DEFAULT NULL,
  `kondisi_emosional` varchar(100) DEFAULT NULL,
  `interaksi_sosial` varchar(100) DEFAULT NULL,
  `kehadiran_kegiatan` varchar(100) DEFAULT NULL,
  `pola_makan` varchar(100) DEFAULT NULL,
  `kesehatan_harian` varchar(100) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aktivitas_lansia`
--

INSERT INTO `aktivitas_lansia` (`id_aktivitas`, `id_lansia`, `aktivitas_fisik`, `kondisi_emosional`, `interaksi_sosial`, `kehadiran_kegiatan`, `pola_makan`, `kesehatan_harian`, `tanggal`, `created_by`) VALUES
(2, 2, 'Aktif', 'Baik', 'Aktif', 'Rutin', 'Baik', 'Sehat', '2026-06-01', 2),
(3, 3, 'Sedang', 'Stabil', 'Cukup', 'Rutin', 'Baik', 'Sehat', '2026-06-01', 2),
(4, 4, 'Kurang Aktif', 'Sedih', 'Kurang', 'Jarang', 'Kurang Baik', 'Kurang Sehat', '2026-06-01', 2),
(5, 5, 'Kurang Aktif', 'Stres', 'Kurang', 'Tidak Pernah', 'Kurang Baik', 'Sakit Ringan', '2026-06-01', 2),
(6, 6, 'Aktif', 'Baik', 'Aktif', 'Rutin', 'Baik', 'Sehat', '2026-06-02', 2),
(7, 7, 'Sedang', 'Cemas', 'Kurang', 'Jarang', 'Cukup', 'Kurang Sehat', '2026-06-02', 2),
(8, 8, 'Sedang', 'Stabil', 'Cukup', 'Rutin', 'Baik', 'Sehat', '2026-06-03', 2),
(9, 9, 'Aktif', 'Baik', 'Aktif', 'Rutin', 'Baik', 'Sehat', '2026-06-03', 2),
(10, 10, 'Kurang Aktif', 'Sedih', 'Kurang', 'Jarang', 'Kurang Baik', 'Sakit Ringan', '2026-06-04', 2),
(11, 11, 'Sedang', 'Baik', 'Cukup', 'Rutin', 'Baik', 'Sehat', '2026-06-04', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_perilaku`
--

CREATE TABLE `kategori_perilaku` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_perilaku`
--

INSERT INTO `kategori_perilaku` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
(1, 'Stabil', 'Perilaku lansia dalam kondisi normal dan konsisten.'),
(2, 'Perlu Perhatian', 'Lansia menunjukkan gejala yang memerlukan pengawasan lebih lanjut.'),
(3, 'Kurang Aktif', 'Lansia jarang berpartisipasi dalam aktivitas harian.'),
(4, 'Berisiko Mengalami Perubahan Perilaku', 'Kondisi yang menunjukkan potensi penurunan kesehatan mental atau fisik.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lansia`
--

CREATE TABLE `lansia` (
  `id_lansia` int(11) NOT NULL,
  `nama_lansia` varchar(100) NOT NULL,
  `umur` int(11) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `kondisi_health` varchar(100) DEFAULT NULL,
  `status_sosial` varchar(100) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lansia`
--

INSERT INTO `lansia` (`id_lansia`, `nama_lansia`, `umur`, `jenis_kelamin`, `kondisi_health`, `status_sosial`, `foto`, `created_at`) VALUES
(1, 'asdasd', 345345, 'L', 'asdas', 'asdasd', '1780746067_faspen.jpg', '2026-06-06 18:41:07'),
(2, 'Siti Aminah', 68, 'P', 'Hipertensi', 'Tinggal Bersama Keluarga', '1780746067_faspen.jpg', '2026-06-07 13:33:35'),
(3, 'Ahmad Yani', 72, 'L', 'Diabetes', 'Tinggal Bersama Pasangan', '1780746067_faspen.jpg', '2026-06-07 13:33:35'),
(4, 'Nurhayati', 75, 'P', 'Sehat', 'Tinggal Sendiri', '1780746067_faspen.jpg', '2026-06-07 13:33:35'),
(5, 'Baharuddin', 80, 'L', 'Artritis', 'Tinggal Bersama Anak', '1780746067_faspen.jpg', '2026-06-07 13:33:35'),
(6, 'Rosmawati', 69, 'P', 'Hipertensi', 'Tinggal Bersama Keluarga', '1780746067_faspen.jpg', '2026-06-07 13:33:35'),
(7, 'M. Ridwan', 77, 'L', 'Jantung Ringan', 'Tinggal Sendiri', '1780746067_faspen.jpg', '2026-06-07 13:33:35'),
(8, 'Yusnidar', 71, 'P', 'Diabetes', 'Tinggal Bersama Anak', '1780746067_faspen.jpg', '2026-06-07 13:33:35'),
(9, 'Hasan Basri', 74, 'L', 'Sehat', 'Tinggal Bersama Pasangan', '1780746067_faspen.jpg', '2026-06-07 13:33:35'),
(10, 'Rahmah', 81, 'P', 'Artritis', 'Tinggal Sendiri', '1780746067_faspen.jpg', '2026-06-07 13:33:35'),
(11, 'Zulkifli', 70, 'L', 'Hipertensi', 'Tinggal Bersama Keluarga', '1780746067_faspen.jpg', '2026-06-07 13:33:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prediksi`
--

CREATE TABLE `prediksi` (
  `id_prediksi` int(11) NOT NULL,
  `id_lansia` int(11) NOT NULL,
  `id_aktivitas` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `akurasi` decimal(5,2) DEFAULT NULL,
  `hasil_prediksi` varchar(100) DEFAULT NULL,
  `tanggal_prediksi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prediksi`
--

INSERT INTO `prediksi` (`id_prediksi`, `id_lansia`, `id_aktivitas`, `id_kategori`, `akurasi`, `hasil_prediksi`, `tanggal_prediksi`) VALUES
(2, 2, 2, 1, 96.50, 'Stabil', '2026-06-07 13:33:35'),
(3, 3, 3, 1, 92.30, 'Stabil', '2026-06-07 13:33:35'),
(4, 4, 4, 2, 88.75, 'Perlu Perhatian', '2026-06-07 13:33:35'),
(5, 5, 5, 4, 90.20, 'Berisiko Mengalami Perubahan Perilaku', '2026-06-07 13:33:35'),
(6, 6, 6, 1, 95.10, 'Stabil', '2026-06-07 13:33:35'),
(7, 7, 7, 2, 87.40, 'Perlu Perhatian', '2026-06-07 13:33:35'),
(8, 8, 8, 1, 91.80, 'Stabil', '2026-06-07 13:33:35'),
(9, 9, 9, 1, 97.00, 'Stabil', '2026-06-07 13:33:35'),
(10, 10, 10, 3, 89.60, 'Kurang Aktif', '2026-06-07 13:33:35'),
(11, 11, 11, 1, 93.25, 'Stabil', '2026-06-07 13:33:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas','kepala_uptd') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-06-06 18:37:55'),
(2, 'INI PETUGAS', 'ptugas2', '$2y$10$Kkwz/33b749LKl2vqb1sduemFj9SQqQ2dLGu4LF1Cd5UX6d7IQYpi', 'petugas', '2026-06-06 18:40:43'),
(3, 'Saya Petugas', 'petugas', '$2y$10$XwNDKTXwo36jMC9U9cwlf.erW/5fQSGQK0KL4uVU7QWrEI6XM8ebi', 'petugas', '2026-06-06 18:42:38'),
(4, 'Kepala UPTD', 'kepaluptd', '$2y$10$uLa7R5xjwNSnIE1NgOAD5uqb98EIb3qOWgUPAXUUruv32900G3l12', 'kepala_uptd', '2026-06-06 18:43:05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aktivitas_lansia`
--
ALTER TABLE `aktivitas_lansia`
  ADD PRIMARY KEY (`id_aktivitas`),
  ADD KEY `id_lansia` (`id_lansia`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `kategori_perilaku`
--
ALTER TABLE `kategori_perilaku`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `lansia`
--
ALTER TABLE `lansia`
  ADD PRIMARY KEY (`id_lansia`);

--
-- Indeks untuk tabel `prediksi`
--
ALTER TABLE `prediksi`
  ADD PRIMARY KEY (`id_prediksi`),
  ADD KEY `id_lansia` (`id_lansia`),
  ADD KEY `id_aktivitas` (`id_aktivitas`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aktivitas_lansia`
--
ALTER TABLE `aktivitas_lansia`
  MODIFY `id_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kategori_perilaku`
--
ALTER TABLE `kategori_perilaku`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lansia`
--
ALTER TABLE `lansia`
  MODIFY `id_lansia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `prediksi`
--
ALTER TABLE `prediksi`
  MODIFY `id_prediksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aktivitas_lansia`
--
ALTER TABLE `aktivitas_lansia`
  ADD CONSTRAINT `aktivitas_lansia_ibfk_1` FOREIGN KEY (`id_lansia`) REFERENCES `lansia` (`id_lansia`) ON DELETE CASCADE,
  ADD CONSTRAINT `aktivitas_lansia_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `prediksi`
--
ALTER TABLE `prediksi`
  ADD CONSTRAINT `prediksi_ibfk_1` FOREIGN KEY (`id_lansia`) REFERENCES `lansia` (`id_lansia`) ON DELETE CASCADE,
  ADD CONSTRAINT `prediksi_ibfk_2` FOREIGN KEY (`id_aktivitas`) REFERENCES `aktivitas_lansia` (`id_aktivitas`) ON DELETE CASCADE,
  ADD CONSTRAINT `prediksi_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_perilaku` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
