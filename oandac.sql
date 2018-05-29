-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 29 May 2018, 08:45:35
-- Sunucu sürümü: 5.7.22-0ubuntu0.16.04.1
-- PHP Sürümü: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `oandac`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `namee` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilepic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yearbooks`
--

CREATE TABLE `yearbooks` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `school` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yearbook_apps`
--

CREATE TABLE `yearbook_apps` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `school` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `status` int(4) NOT NULL DEFAULT '0',
  `detailed_explanation` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yearbook_apps_enrolls`
--

CREATE TABLE `yearbook_apps_enrolls` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `yearbook_app_id` int(11) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yearbook_comments`
--

CREATE TABLE `yearbook_comments` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `to_yearbook_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text COLLATE utf8_turkish_ci NOT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yearbooks`
--
ALTER TABLE `yearbooks`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yearbook_apps`
--
ALTER TABLE `yearbook_apps`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yearbook_apps_enrolls`
--
ALTER TABLE `yearbook_apps_enrolls`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yearbook_comments`
--
ALTER TABLE `yearbook_comments`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `yearbooks`
--
ALTER TABLE `yearbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `yearbook_apps`
--
ALTER TABLE `yearbook_apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `yearbook_apps_enrolls`
--
ALTER TABLE `yearbook_apps_enrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `yearbook_comments`
--
ALTER TABLE `yearbook_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
