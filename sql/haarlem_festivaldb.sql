-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 04 mrt 2025 om 21:02
-- Serverversie: 11.7.2-MariaDB-ubu2404
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
-- Tabelstructuur voor tabel `detail_event`
--

CREATE TABLE `detail_event` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `banner_description` varchar(200) DEFAULT NULL,
  `banner_image` varchar(200) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `image_description_1` varchar(500) DEFAULT NULL,
  `image_description_2` varchar(500) DEFAULT NULL,
  `card_image` varchar(500) DEFAULT NULL,
  `card_description` varchar(200) DEFAULT NULL,
  `amount_of_stars` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `detail_event`
--

INSERT INTO `detail_event` (`id`, `event_id`, `banner_description`, `banner_image`, `name`, `description`, `image_description_1`, `image_description_2`, `card_image`, `card_description`, `amount_of_stars`) VALUES
(1, 1, 'One of the world-class DJs performing at Haarlem Festival is Hardwell!', 'default.jpg', 'Hardwell', 'Hardwell, born Robbert van de Corput, is a globally renowned Dutch DJ, music producer, and remixer. He gained fame for his contributions to electronic dance music (EDM), specifically in the genres of progressive house and big room house. Rising to prominence in the early 2010s, Hardwell quickly established himself as a festival headliner. Known for his dynamic live performances, he was crowned the World\'s No.1 DJ twice in a row (2013, 2014) by DJ Mag\'s Top 100 DJs poll.', 'default.jpg', NULL, 'default.jpg', 'Hardwell is known for his energetic performances. Hardwell hails from Breda, Netherlands, and began DJing at the age of 14.', NULL),
(2, 1, 'One of the world-class DJs performing at Haarlem Festival is Martin Garrix!', 'default.jpg', 'Martin Garrix', 'Martin Garrix, de jonge superster uit Nederland, heeft zichzelf bewezen als een van de grootste namen in de dance- en elektronische muziekwereld. Met hits zoals \"Animals\" en \"Scared to Be Lonely\" domineert hij zowel de charts als festivals over de hele wereld. Zijn energieke optredens en pakkende producties hebben hem de titel van werelds beste DJ opgeleverd in meerdere DJ Mag Top 100-lijsten.', 'default.jpg', NULL, 'default.jpg', '(Martijn Garritsen): Martin is an animal lover, particularly fond of dogs, and supports various charitable causes. He has had a succesfull career since he was young.', NULL),
(3, 1, 'One of the world-class DJs performing at Haarlem Festival is Tiesto!', 'default.jpg', 'Tiesto', 'NULL', 'default.jpg', NULL, 'default.jpg', '(Tijs Michiel Verwest): Tiësto, also from Breda, Netherlands, is known for being a trailblazer in electronic music.  ', NULL),
(4, 1, 'One of the world-class DJs performing at Haarlem Festival is Armin van Buuren!', 'default.jpg', 'Armin van Buuren', 'NULL', 'default.jpg', NULL, 'default.jpg', 'Armin is known for his meticulous work ethic and dedication to his fans. Despite his success, he remains approachable and enjoys connecting with his global audience.  ', NULL),
(5, 1, 'One of the world-class DJs performing at Haarlem Festival is Afrojack!', 'default.jpg', 'Afrojack', 'NULL', 'default.jpg', NULL, 'default.jpg', '(Nick van de Wall): Afrojack is not only a DJ but also an entrepreneur, owning his own label, Wall Recordings.  ', NULL),
(6, 1, 'One of the world-class DJs performing at Haarlem Festival is Nicky Romero!', 'default.jpg', 'Nicky Romero', 'NULL', 'default.jpg', NULL, 'default.jpg', '(Nick Rotteveel): Nicky is known for his collaborative and friendly nature in the music industry.   ', NULL),
(7, 2, 'Visit Ratatouille!', NULL, 'Ratatouille', 'Nestled along the scenic Spaarne River at Spaarne 96, 2011 CL Haarlem, Ratatouille Food & Wine offers an exceptional dining experience that harmoniously blends modern culinary techniques with a deep appreciation for fresh, local ingredients. Under the guidance of chef Jozua Jaring, this Michelin-starred restaurant presents meticulously crafted dishes that surprise and delight with their innovative presentations and flavor combinations.\r\nWith its commitment to culinary excellence and warm hospitality, Ratatouille Food & Wine has become a must-visit destination for food enthusiasts in Haarlem. Whether you\'re a local resident or a visitor, the restaurant offers a memorable dining experience that highlights the best of modern cuisine in a welcoming and stylish setting.', NULL, NULL, NULL, 'Ratatouille is specialised in French cuisine. However you can also visit them for fish, seafood and other European dishes! It is located at Spaarne 96 in Haarlem.', 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `detail_event_card_tag`
--

CREATE TABLE `detail_event_card_tag` (
  `id` int(11) NOT NULL,
  `detail_event_id` int(11) NOT NULL,
  `tag` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `detail_event_card_tag`
--

INSERT INTO `detail_event_card_tag` (`id`, `detail_event_id`, `tag`) VALUES
(1, 2, 'Trance'),
(2, 2, 'Techno'),
(3, 1, 'Dance'),
(4, 1, 'House'),
(5, 3, 'Trance'),
(6, 3, 'Techno'),
(7, 4, 'Trance'),
(8, 4, 'Techno'),
(9, 5, 'House'),
(10, 6, 'House'),
(11, 6, 'Electro'),
(12, 7, 'French'),
(13, 7, 'European'),
(14, 7, 'Fish & Seafood');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description_homepage` varchar(2000) DEFAULT NULL,
  `banner_description` varchar(50) DEFAULT NULL,
  `picture_homepage` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `event`
--

INSERT INTO `event` (`id`, `name`, `description_homepage`, `banner_description`, `picture_homepage`) VALUES
(1, 'Dance', 'Top DJs make an appearance for unforgettable nights.', 'Top DJ\'s performing in DANCE festival!', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?'),
(2, 'Yummy!', 'A culinary journey through Haarlem\'s finest dining', 'Visit the best restaurants in Haarlem!', 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=500');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `banner_image` varchar(200) DEFAULT NULL,
  `banner_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `homepage`
--

INSERT INTO `homepage` (`id`, `name`, `banner_image`, `banner_description`) VALUES
(1, 'The festival', 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=1600', 'Join us for three days of music, food, and unforgettable memories');

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
  `datetime_start` datetime NOT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `session`
--

INSERT INTO `session` (`id`, `detail_event_id`, `name`, `description`, `location`, `ticket_limit`, `duration_minutes`, `price`, `datetime_start`, `event_id`) VALUES
(1, 6, 'back2back', '1', 'Lichtfabriek', 1500, 360, 75.00, '2025-07-25 20:00:00', 1),
(2, 5, 'back2back', '1', 'Lichtfabriek', 1500, 360, 75.00, '2025-07-25 20:00:00', 1),
(3, 3, 'club', '1', 'Slachthuis', 200, 90, 60.00, '2025-07-25 22:00:00', 1),
(4, 1, 'club', '1', 'Jopenkerk', 300, 90, 60.00, '2025-07-25 23:00:00', 1),
(5, 4, 'club', '1', 'XO the Club', 200, 90, 60.00, '2025-07-25 22:00:00', 1),
(6, 2, 'club', '1', 'Puncher comedy club', 200, 90, 60.00, '2025-07-25 22:00:00', 1),
(7, 1, 'back2back', '1', 'Caprera Openluchtheater', 2000, 540, 110.00, '2025-07-26 14:00:00', 1),
(8, 2, 'back2back', '1', 'Caprera Openluchtheater', 2000, 540, 110.00, '2025-07-26 14:00:00', 1),
(9, 4, 'back2back', '1', 'Caprera Openluchtheater', 2000, 540, 110.00, '2025-07-26 14:00:00', 1),
(10, 5, 'club', '1', 'Jopenkerk', 300, 90, 60.00, '2025-07-26 22:00:00', 1),
(11, 3, 'club', '1', 'Lichtfabriek', 1500, 240, 75.00, '2025-07-26 21:00:00', 1),
(12, 6, 'club', '1', 'Slachthuis', 200, 90, 60.00, '2025-07-26 23:00:00', 1),
(13, 5, 'back2back', '1', 'Caprera Openluchtheater', 2000, 540, 110.00, '2025-07-27 14:00:00', 1),
(14, 3, 'back2back', '1', 'Caprera Openluchtheater', 2000, 540, 110.00, '2025-07-27 14:00:00', 1),
(15, 6, 'back2back', '1', 'Caprera Openluchtheater', 2000, 540, 110.00, '2025-07-27 14:00:00', 1),
(16, 4, 'club', '1', 'Jopenkerk', 300, 90, 60.00, '2025-07-27 19:00:00', 1),
(17, 1, 'club', '1', 'XO the Club', 1500, 90, 90.00, '2025-07-27 21:00:00', 1),
(18, 2, 'club', '1', 'Slachthuis', 200, 90, 60.00, '2025-07-27 18:00:00', 1),
(19, 7, 'Ratatouille Ticket 24 July 17:00', '1', 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-24 17:00:00', NULL),
(20, 7, 'Ratatouille Ticket 25 July 17:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-25 17:00:00', NULL),
(21, 7, 'Ratatouille Ticket 26 July 17:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-26 17:00:00', NULL),
(22, 7, 'Ratatouille Ticket 27 July 17:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-27 17:00:00', NULL),
(23, 7, 'Ratatouille Ticket 27 July 19:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-27 19:00:00', NULL),
(24, 7, 'Ratatouille Ticket 26 July 19:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-26 19:00:00', NULL),
(25, 7, 'Ratatouille Ticket 25 July 19:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-25 19:00:00', NULL),
(26, 7, 'Ratatouille Ticket 24 July 19:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-24 19:00:00', NULL),
(27, 7, 'Ratatouille Ticket 24 July 21:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-24 21:00:00', NULL),
(28, 7, 'Ratatouille Ticket 25 July 21:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-25 21:00:00', NULL),
(29, 7, 'Ratatouille Ticket 26 July 21:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-26 21:00:00', NULL),
(30, 7, 'Ratatouille Ticket 27 July 21:00', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-27 21:00:00', NULL);

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
  `type` enum('employee','customer','administrator') NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `type`, `first_name`, `last_name`, `phone_number`, `email_address`, `password_hash`, `salt`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'customer', 'Meryam', 'Douiri', '0643209996', 'Douirimeryam14@gmail.com', '$2y$12$Ur95y1Tws68/beiuhQTeVOGCNTwZ3saGD1nWgKhbnpynUZ4zR407u', 'eDyW6lt0dAA/FoAZTIMcUQ==', '206ba682bb5035bfdd31258a2312e1755b76ae0a34117ab870ce0ebb911cbbaf', '2025-02-25 11:30:53'),
(2, 'administrator', 'Romy', 'Groen', NULL, 'groenromy0@gmail.com', '$2y$12$w6Vh.v5QvPOglb2HAmDkXOvWz2/oyzCui4fc8jxbWW6LKswt4V20G', 'el6XUJnPebqT4oQPrewI3A==', NULL, NULL),
(3, 'employee', 'Fiona', 'Shrek', NULL, '701224@student.inholland.nl', '$2y$12$3S3MFqiiCrSfpMp9pCmBWeJguq3EhrAnwlTtr24c3BsU8f/Z4kAdm', 'xMZpfw1LiC+St2cGSu1i7g==', NULL, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

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
  ADD KEY `detail_event_id` (`detail_event_id`),
  ADD KEY `fk_event` (`event_id`);

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
-- AUTO_INCREMENT voor een tabel `detail_event`
--
ALTER TABLE `detail_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `detail_event_card_tag`
--
ALTER TABLE `detail_event_card_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `detail_event`
--
ALTER TABLE `detail_event`
  ADD CONSTRAINT `detail_event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
