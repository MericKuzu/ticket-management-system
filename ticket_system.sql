-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Nis 2026, 12:06:34
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ticket_system`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `category` enum('Hardware','Software','Network','Account','Other') NOT NULL DEFAULT 'Other',
  `priority` enum('Low','Medium','High') NOT NULL DEFAULT 'Medium',
  `status` enum('Open','In Progress','Resolved','Closed') NOT NULL DEFAULT 'Open',
  `created_by` int(11) NOT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `resolution_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `category`, `priority`, `status`, `created_by`, `assigned_to`, `resolution_note`, `created_at`, `updated_at`) VALUES
(7, 'Hesabmın şifresini unttum', 'Sitenizde şifremi unttum kısmı yok bu yüzden şifremi unutmama rağmen yeni şifre oluşturamıyorum.', 'Account', 'High', 'Closed', 1, NULL, 'Şifre sıfırlama bağlantısı mail yoluyla gönderildi.', '2026-04-13 16:16:46', '2026-04-13 17:02:37'),
(8, 'Aldığım ürünü iade etmek istiyorum', 'İletişim numarası bulamadım.', 'Other', 'Medium', 'Open', 1, NULL, NULL, '2026-04-13 16:21:33', '2026-04-14 10:04:26'),
(9, '404 not found error', 'Sayfayı açtığımda bu yazı çıkıyor\r\n', 'Network', 'High', 'In Progress', 3, NULL, '', '2026-04-13 16:28:01', '2026-04-14 10:03:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Test1', 'test1@hotmail.com', '$2y$10$Pt2i0EwpbK3q6qZZFWdqhutM.u2nErV/ua2TRPA0AJUlJh5cb1Bry', 'user', '2026-04-12 15:58:24'),
(2, 'Meriç Kuzu', 'admin_ticket@gmail.com', '$2y$10$9Jk7sdWJlNRqAtCXJZMBGOerBs75AyMRiu8.66WkiO8XlZoquwiFS', 'admin', '2026-04-13 15:28:28'),
(3, 'Test2', 'test2@gmail.com', '$2y$10$I5Vm/Zg8WNsHj7eInC4X0e.clbEai8FYUItNVLJBTdJnF06kzX0Am', 'user', '2026-04-13 16:26:17');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
