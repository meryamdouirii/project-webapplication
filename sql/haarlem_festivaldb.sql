-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 14 feb 2025 om 16:45
-- Serverversie: 11.6.2-MariaDB-ubu2404
-- PHP-versie: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haarlem_festivaldb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `about_event`
--

CREATE TABLE `about_event` (
  `about_event_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `button_text` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `detail_event`
--

CREATE TABLE `detail_event` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `banner_description` varchar(200) DEFAULT NULL,
  `banner_image` varchar(200) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `image_description_1` varchar(500) DEFAULT NULL,
  `image_description_2` varchar(500) DEFAULT NULL,
  `card_image` varchar(500) DEFAULT NULL,
  `card_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `detail_event_card_tag`
--

CREATE TABLE `detail_event_card_tag` (
  `id` int(11) NOT NULL,
  `detail_event_id` int(11) NOT NULL,
  `tag` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description_homepage` varchar(2000) DEFAULT NULL,
  `banner_description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `event`
--

INSERT INTO `event` (`id`, `name`, `description_homepage`, `banner_description`) VALUES
(1, 'dance', 'Top DJs make an appearance for unforgettable nights.', 'Top DJ\'s performing in DANCE festival!'),
(2, 'Yummy', 'A culinary journey through Haarlem\'s finest dining', 'Visit the best restaurants in Haarlem!');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `homepage_description` varchar(200) DEFAULT NULL,
  `banner_image` varchar(200) DEFAULT NULL,
  `banner_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `homepage`
--

INSERT INTO `homepage` (`id`, `name`, `homepage_description`, `banner_image`, `banner_description`) VALUES
(1, 'The festival', NULL, 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=1600', 'Join us for three days of music, food, and unforgettable memories');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `detail_event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `ticket_limit` int(11) NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `datetime_start` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `song`
--

CREATE TABLE `song` (
  `id` int(11) NOT NULL,
  `detail_event_id` int(11) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `bar_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket_order`
--

CREATE TABLE `ticket_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `about_event`
--
ALTER TABLE `about_event`
  ADD PRIMARY KEY (`about_event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexen voor tabel `detail_event`
--
ALTER TABLE `detail_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexen voor tabel `detail_event_card_tag`
--
ALTER TABLE `detail_event_card_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

--
-- Indexen voor tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

--
-- Indexen voor tabel `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

--
-- Indexen voor tabel `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexen voor tabel `ticket_order`
--
ALTER TABLE `ticket_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `about_event`
--
ALTER TABLE `about_event`
  MODIFY `about_event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `detail_event`
--
ALTER TABLE `detail_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `detail_event_card_tag`
--
ALTER TABLE `detail_event_card_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `ticket_order`
--
ALTER TABLE `ticket_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `about_event`
--
ALTER TABLE `about_event`
  ADD CONSTRAINT `about_event_fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Beperkingen voor tabel `detail_event`
--
ALTER TABLE `detail_event`
  ADD CONSTRAINT `detail_event_fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Beperkingen voor tabel `detail_event_card_tag`
--
ALTER TABLE `detail_event_card_tag`
  ADD CONSTRAINT `detail_event_card_tag_fk_detail_event_id` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

--
-- Beperkingen voor tabel `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_fk_detail_event_id` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

--
-- Beperkingen voor tabel `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_fk_detail_event_id` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

--
-- Beperkingen voor tabel `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `ticket_order` (`id`),
  ADD CONSTRAINT `ticket_fk_session_id` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`);

--
-- Beperkingen voor tabel `ticket_order`
--
ALTER TABLE `ticket_order`
  ADD CONSTRAINT `ticket_order_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
