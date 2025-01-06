-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jan 2025 pada 02.01
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `like_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `title`, `image`, `slug`, `content`, `like_count`, `created_at`, `updated_at`) VALUES
(6, 8, 'Pengenalan MySQLSebagai Sistem Manajemen Basis Data Relasional (RDBMS) yang Kuat', 'images/Onzk9jzcg3VDgDRaPUuFaEGubgzXETJ1Y4zT8Y0z.jpg', 'pengenalan-mysqlsebagai-sistem-manajemen-basis-data-relasional-rdbms-yang-kuat', '<p>MySQL adalah salah satu sistem manajemen basis data relasional (RDBMS) yang paling populer dan banyak digunakan di seluruh dunia. MySQL adalah perangkat lunak open-source yang terkenal dengan kecepatan, skalabilitas, dan kemudahan penggunaannya. Artikel ini akan memberikan gambaran umum tentang MySQL, fungsinya, serta bagaimana Anda bisa memulai menggunakannya dalam proyek pengembangan Anda.</p><p>MySQL adalah perangkat lunak untuk mengelola data dalam bentuk tabel yang saling terhubung, menggunakan SQL (Structured Query Language). Sebagai RDBMS, MySQL menyimpan data dalam tabel yang dapat saling berhubungan satu sama lain. MySQL banyak digunakan di berbagai jenis aplikasi, terutama di dunia pengembangan web.</p>', 4, '2025-01-04 07:04:48', '2025-01-05 17:45:22'),
(7, 8, 'Pengenalan PHP: Bahasa Pemrograman yang Dinamis untuk Pengembangan Web', 'images/B6iNAJrNpdCXuAUL73Babyy9700o07iWkfnkGTN9.jpg', 'pengenalan-php-bahasa-pemrograman-yang-dinamis-untuk-pengembangan-web', '<p>PHP (Hypertext Preprocessor) adalah bahasa pemrograman yang sering digunakan untuk mengembangkan aplikasi web dinamis. PHP adalah bahasa server-side scripting, yang berarti bahwa kode PHP dijalankan di server untuk menghasilkan konten dinamis yang ditampilkan kepada pengguna. Artikel ini akan memberikan gambaran umum tentang PHP, fungsinya, serta bagaimana Anda bisa memulai menggunakan PHP dalam proyek pengembangan web.</p><p>PHP adalah bahasa pemrograman server-side yang digunakan untuk membuat halaman web dinamis. PHP pertama kali diciptakan oleh Rasmus Lerdorf pada tahun 1993 sebagai alat untuk memantau pengunjung situs web-nya. Seiring waktu, PHP berkembang menjadi bahasa pemrograman yang lengkap dan kini digunakan secara luas di web.</p>', 0, '2025-01-04 07:08:41', '2025-01-05 17:15:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `user_id`, `parent_id`, `content`, `created_at`, `updated_at`) VALUES
(17, 6, 10, NULL, 'nice', '2025-01-05 09:57:50', '2025-01-05 09:57:50'),
(18, 6, 12, NULL, 'sangat bermanfaat', '2025-01-05 10:26:05', '2025-01-05 10:26:05'),
(19, 6, 12, 17, 'iya sangat bagus', '2025-01-05 10:26:34', '2025-01-05 10:26:34'),
(20, 6, 8, 17, 'oke terimaksih', '2025-01-05 10:27:53', '2025-01-05 10:27:53'),
(21, 6, 8, 18, 'oke terimakasih', '2025-01-05 10:28:08', '2025-01-05 10:28:08'),
(23, 6, 13, NULL, 'bagus banget', '2025-01-05 10:43:22', '2025-01-05 10:43:22'),
(24, 6, 13, 17, 'iya', '2025-01-05 10:43:34', '2025-01-05 10:43:34'),
(25, 6, 13, 18, 'oke', '2025-01-05 10:43:42', '2025-01-05 10:43:42'),
(26, 6, 8, 23, 'ok maksih', '2025-01-05 10:45:18', '2025-01-05 10:45:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `blog_id`, `created_at`, `updated_at`) VALUES
(48, 11, 6, '2025-01-05 10:16:27', '2025-01-05 10:16:27'),
(50, 10, 6, '2025-01-05 10:16:55', '2025-01-05 10:16:55'),
(53, 13, 6, '2025-01-05 10:43:10', '2025-01-05 10:43:10'),
(54, 8, 6, '2025-01-05 10:45:22', '2025-01-05 10:45:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(8, 'jipy', 'marufsambong29@gmail.com', '$2y$12$NSHd.obk1pXttQF1/U4X5uWiIv1XXQEXZugLmw3F096zBw1A7gQ3u', 'admin', '2025-01-05 05:08:23', '2025-01-05 05:39:01'),
(10, 'ani', 'ani29@gmail.com', '$2y$12$3Ei3fUwNWvCrDLNmU7VVQOHIZ4M0lzuHzXvptXZwDQwSeUXg7a9q6', 'pengunjung', '2025-01-05 09:29:20', '2025-01-05 09:29:20'),
(11, 'divan', 'divan29@gmail.com', '$2y$12$z/8UPyTV/.XZiG.RXFcwtunhe3UJkyg9zICd8SREWfw6QnnADT3vm', 'pengunjung', '2025-01-05 10:08:41', '2025-01-05 10:08:41'),
(12, 'divantri', 'divantri29@gmail.com', '$2y$12$gciOpeCXUKio2kWRrIywAePzxak.7LuxjXUlCW5pztpjOR/Kzv62G', 'pengunjung', '2025-01-05 10:25:05', '2025-01-05 10:25:05'),
(13, 'ali', 'ali29@gmail.com', '$2y$12$LtKgw2.9fyNMQ4DKqyNJd.TRnSc5eMan9iJcsb9478yome3h9MUEK', 'pengunjung', '2025-01-05 10:42:25', '2025-01-05 10:42:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indeks untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
