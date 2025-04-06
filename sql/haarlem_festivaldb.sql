-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 06 apr 2025 om 12:29
-- Serverversie: 11.7.2-MariaDB-ubu2404
-- PHP-versie: 8.2.28

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
(1, 1, '<p>One of the world-class DJs performing at Haarlem Festival is Hardwell!</p>', '/images-logos/uploads/1743939681_Hardwell.jpg', 'Hardwell', 'Hardwell, born Robbert van de Corput, is a globally renowned Dutch DJ, music producer, and remixer. He gained fame for his contributions to electronic dance music (EDM), specifically in the genres of progressive house and big room house. Rising to prominence in the early 2010s, Hardwell quickly established himself as a festival headliner. Known for his dynamic live performances, he was crowned the World\'s No.1 DJ twice in a row (2013, 2014) by DJ Mag\'s Top 100 DJs poll.', NULL, NULL, '/images-logos/uploads/1743939802_Hardwell.jpg', '<p>Hardwell is known for his energetic performances. Hardwell hails from Breda, Netherlands, and began DJing at the age of 14.</p>', 0),
(2, 1, '<p>One of the world-class DJs performing at Haarlem Festival is Martin Garrix!</p>', '/images-logos/uploads/1743940133_DJ-Martin-GarrixKopie.jpg', 'Martin Garrix', '<p>Martin Garrix, de jonge superster uit Nederland, heeft zichzelf bewezen als een van de grootste namen in de dance- en elektronische muziekwereld. Met hits zoals \"Animals\" en \"Scared to Be Lonely\" domineert hij zowel de charts als festivals over de hele wereld. Zijn energieke optredens en pakkende producties hebben hem de titel van werelds beste DJ opgeleverd in meerdere DJ Mag Top 100-lijsten.</p>', '/images-logos/uploads/1743940103_martingarixxjpg.jpg', '/images-logos/uploads/1743939982_martinchair.jpg', '/images-logos/uploads/1743940048_DJ-Martin-GarrixKopie.jpg', '<p>(Martijn Garritsen): Martin is an animal lover, particularly fond of dogs, and supports various charitable causes. He has had a succesfull career since he was young.</p>', 0),
(3, 1, '<p>One of the world-class DJs performing at Haarlem Festival is Tiesto!</p>', '/images-logos/uploads/1743940442_zo-sleept-dj-tiesto-zijn-miljoenen-binnen.jpeg', 'Tiesto', '<p>Add some information about tiesto </p>', '/images-logos/uploads/1743940321_tietsoCrop.jpg', '/images-logos/uploads/1743940274_tietsoCrop.jpg', '/images-logos/uploads/1743940326_tietsoCrop.jpg', '<p>(Tijs Michiel Verwest): Tiësto, also from Breda, Netherlands, is known for being a trailblazer in electronic music.</p>', 0),
(4, 1, '<p>One of the world-class DJs performing at Haarlem Festival is Armin van Buuren!</p>', '/images-logos/uploads/1743940888_ArminVanBuuren.jpg', 'Armin van Buuren', '<p>there is no information available for armin </p>', '/images-logos/uploads/1743940893_ArminVanBuuren.jpg', '/images-logos/uploads/1743940873_ArminVanBuuren.jpg', '/images-logos/uploads/1743940917_ArminVanBuuren.jpg', '<p>Armin is known for his meticulous work ethic and dedication to his fans. Despite his success, he remains approachable and enjoys connecting with his global audience.</p>', 0),
(5, 1, '<p>One of the world-class DJs performing at Haarlem Festival is Afrojack!</p>', '/images-logos/uploads/1743941044_AFROJACKcopie.jpg', 'Afrojack', '<p>NULL</p>', '/images-logos/uploads/1743941024_AFROJACKcopie.jpg', '/images-logos/uploads/1743941002_AFROJACKcopie.jpg', '/images-logos/uploads/1743941028_AFROJACKcopie.jpg', '<p>(Nick van de Wall): Afrojack is not only a DJ but also an entrepreneur, owning his own label, Wall Recordings.</p>', 0),
(6, 1, '<p>One of the world-class DJs performing at Haarlem Festival is Nicky Romero!</p>', '/images-logos/uploads/1743941167_NickyRomerocopy.jpg', 'Nicky Romero', '<p>NULL</p>', '/images-logos/uploads/1743941173_NickyRomerocopy.jpg', '/images-logos/uploads/1743941141_NickyRomerocopy.jpg', '/images-logos/uploads/1743941179_NickyRomerocopy.jpg', '<p>(Nick Rotteveel): Nicky is known for his collaborative and friendly nature in the music industry.</p>', 0),
(7, 2, '<p><strong>Visit US!!!!!</strong></p>', '/images-logos/uploads/1743933809_HetgezelschapbijRatatouille_.jfif', 'Ratatouille', '<p>Nestled along the scenic Spaarne River at Spaarne 96, 2011 CL Haarlem, Ratatouille Food &amp; Wine offers an exce<strong>ptional dining experience that harmoniously blends modern culinary techniques with a deep appreciation for fresh, local ingredients. Under the guidance of chef Jozua Jaring, this Michelin-starred restaurant presents meticulously crafted dishes that surprise and delight with their innovative presentations and flavor combinations. With its commitment to culinary excellence and warm hospitalit</strong>y, Ratatouille Food &amp; Wine has become a must-visit destination for food enthusiasts in Haarlem. Whether you\'re a local resident or a visitor, the restaurant offers a memorable dining experience that highlights the best of modern cuisine in a welcoming and stylish setting.</p>', '/images-logos/uploads/1743933816_large_61047dad35.jpg', '/images-logos/uploads/1743933829_rataouille1_0_4.png', '/images-logos/uploads/1743933837_c3108c2d430d443fa32af7798be03899.webp', '<p>Ratatouille is specialised in French cuisine. However you can also visit them for fish, seafood and other European dishes! It is located at Spaarne 96 in Haarlem.</p>', 4),
(8, 2, '<p>Cozy vibes and fine food in the heart of the city.</p>', '/images-logos/uploads/1743933930_dvb-roemer-3.jpg', 'Café de Roemer', '<p>Café de Roemer is a charming spot that serves classic dishes with a modern twist. The warm and inviting interior makes it perfect for lunch or casual drinks. Their chefs work with seasonal, locally sourced ingredients. The wine list is thoughtfully curated to pair perfectly with the menu.</p>', '/images-logos/uploads/1743933936_image-asset1.jpeg', '/images-logos/uploads/1743933942_image-asset.jpeg', '/images-logos/uploads/1743933946_image-asset2.jpeg', '<p>A cozy café offering modern classics and a fine wine selection.</p>', 4),
(9, 2, '<p>Fine dining in a beautiful historic setting.</p>', '/images-logos/uploads/1743934018_BistroML3.jpg', 'Restaurant ML', '<p>Housed in a stunning heritage building, Restaurant ML offers a premium gastronomic experience. The seasonal menu is full of surprising flavors and creative presentation. Guests enjoy top-tier service and perfectly paired wines. A must-visit for lovers of high-end cuisine.</p>', '/images-logos/uploads/1743934024_restaurant-moustique.jpg', '/images-logos/uploads/1743934031_ml-gerecht.jpg', '/images-logos/uploads/1743934035_crunchy_sushi.jpg', '<p>High-end gastronomy served in a historic ambiance.</p>', 4),
(10, 2, '<p>Fresh, modern, and full of flavor.</p>', '/images-logos/uploads/1743934121_og-image.png', 'Restaurant Fris', '<p>Restaurant Fris is known for its light and contemporary dishes made with local, sustainable ingredients. The kitchen focuses on clean flavors and beautiful presentation. The atmosphere is relaxed and stylish, making it great for both casual and special occasions. A true hidden gem for food lovers.</p>', '/images-logos/uploads/1743934129_0d4d07defb.jpeg', '/images-logos/uploads/1743934152_tussengerecht.jpg', '/images-logos/uploads/1743934197_1586946823.jpg', '<p>Modern and fresh cuisine with a sustainable touch.</p>', 3),
(11, 2, '<p>Where dining meets entertainment.</p>', '/images-logos/uploads/1743934253_download1.jpg', 'New Vegas', '<p>New Vegas blends upscale dining with a touch of Las Vegas flair. Enjoy premium steaks, fresh seafood, and signature cocktails in a vibrant setting. Themed nights and live entertainment add to the experience. It’s the perfect spot for a fun night out with friends.</p>', '/images-logos/uploads/1743934260_download3.jpg', '/images-logos/uploads/1743934264_download2.jpg', '/images-logos/uploads/1743934280_download.jpg', '<p>Upscale dining with a fun, Vegas-style vibe.</p>', 3),
(12, 2, '<p>A local classic since 1879.</p>', '/images-logos/uploads/1743934403_DSC00722kopie-1024x576.jpg', 'Grand Cafe Brinkmann', '<p>Grand Cafe Brinkman is a timeless café with rich history and character. Located on a lively square, it\'s ideal for coffee, lunch, or casual drinks. The interior has a nostalgic charm, while the menu stays classic and crowd-pleasing. Friendly service and a laid-back vibe keep guests coming back.</p>', '/images-logos/uploads/1743934371_photo0jpg.jpg', '/images-logos/uploads/1743934392_DSC00441-kleiner-1024x576.jpg', '/images-logos/uploads/1743934407_DSC06530.JPG', '<p>A historic café with charm and a classic menu.</p>', 3),
(13, 2, '<p>French bistro vibes with a modern twist.</p>', '/images-logos/uploads/1743934488_overall-terras.jpg', 'Urban Frenchy Bistro Toujours', '<p>Toujours brings the charm of Paris to the city with a playful, creative menu. The interior is trendy and photo-friendly, blending classic bistro style with urban flair. Dishes are inspired by French tradition but given a bold, modern upgrade. Perfect for stylish dining with friends or date night.</p>', '/images-logos/uploads/1743934497_food.jpg', '/images-logos/uploads/1743934507_restaurant-toujours-haarlem-7.jpg', '/images-logos/uploads/1743934517_20181125-210657-largejpg.jpg', '<p>Trendy French bistro with creative flair and urban style.</p>', 3);

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
(48, 7, 'French'),
(49, 7, 'European'),
(50, 7, 'Fish & Seafood'),
(51, 8, 'Dutch'),
(52, 8, 'Fish & Seafood'),
(53, 8, 'European'),
(54, 9, 'Dutch'),
(55, 9, 'Fish & Seafood'),
(56, 9, 'European'),
(57, 10, 'Dutch'),
(58, 10, 'French'),
(59, 10, 'European'),
(60, 11, 'Vegan'),
(61, 12, 'Dutch'),
(62, 12, 'European'),
(63, 12, 'Modern'),
(64, 13, 'Dutch'),
(65, 13, 'Fish & Seafood'),
(66, 13, 'European'),
(73, 1, 'Dance'),
(74, 1, 'House'),
(83, 2, 'Trance'),
(84, 2, 'Techno'),
(91, 3, 'Trance'),
(92, 3, 'Techno'),
(96, 4, 'Trance'),
(97, 4, 'Techno'),
(98, 4, 'house'),
(101, 5, 'House'),
(104, 6, 'House'),
(105, 6, 'Electro');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description_homepage` varchar(2000) DEFAULT NULL,
  `banner_description` varchar(200) DEFAULT NULL,
  `picture_homepage` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `event`
--

INSERT INTO `event` (`id`, `name`, `description_homepage`, `banner_description`, `picture_homepage`) VALUES
(1, 'Dance', 'Top DJs make an appearance for unforgettable nights.', 'Top DJ\'s performing in DANCE festival!', '/images-logos/uploads/photo-1516450360452-9312f5e86fc7.jfif'),
(2, 'Yummy!', '<p><i>A culinary journey through Haarlem\'s finest dining</i></p>', '<p><strong>Visit the best restaurants in Haarlem!</strong></p>', '/images-logos/uploads/1742913778_photo-1414235077428-338989a2e8c0.jfif');

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
-- Tabelstructuur voor tabel `payment`
--

CREATE TABLE `payment` (
  `id` int(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `payment_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `payment_status`, `payment_id`, `amount`, `created_at`) VALUES
(15, 69, 'paid', 'cs_test_a1Wd4h7LYl7ukBQgYvOSRgDkWB05lVlE7BunMcasJYSj4d80DdcFc3bFVj', 7500.00, '2025-03-19 17:52:49'),
(16, 70, 'pending', 'cs_test_b1vbpTWq4E8P2W7av9GYNuTrfrxHLd2enW0AHEi9YuVCubdP7kOTXZV8qF', 13500.00, '2025-03-19 18:42:36'),
(17, 71, 'paid', 'cs_test_a16LTNilglXUftGDzwXx7sda5tQHOC44JkLh4Q0vfni7jhurnGhm9bMVGq', 4500.00, '2025-03-19 20:01:07'),
(18, 72, 'paid', 'cs_test_a1eJfZnpn3pSY2WTkTql83WQOqeVJmuj1CTdKuwI6LiM6NmnhjZ5EbeycX', 6000.00, '2025-04-03 10:03:35'),
(19, 73, 'pending', 'cs_test_a1HwhnzaLBUP8a5w2dqx2RkyfqP8ExxRZH8x9tdLYn1tCfIa1J8cQJKd9I', 4500.00, '2025-04-03 10:05:19'),
(20, 74, 'pending', 'cs_test_b18CgJuotV4TCc9kNrmjejSXAvLsYlxHMug6kSEhB2FEOKER0f4dkuG1ey', 9000.00, '2025-04-03 10:06:09'),
(21, 75, 'paid', 'cs_test_a1KLc1bcboNc61FbX13sBW50oqYx3QbOYj4sZtQg5KH00KsKITR4TvCvc7', 9000.00, '2025-04-03 10:17:01');

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

--
-- Gegevens worden geëxporteerd voor tabel `session`
--

INSERT INTO `session` (`id`, `detail_event_id`, `name`, `description`, `location`, `ticket_limit`, `duration_minutes`, `price`, `datetime_start`) VALUES
(1, 6, 'back2back', NULL, 'Lichtfabriek', 1500, 360, 75.00, '2025-07-25 20:00:00'),
(3, 3, 'club', NULL, 'Slachthuis', 200, 90, 60.00, '2025-07-25 22:00:00'),
(4, 1, 'club', NULL, 'Jopenkerk', 300, 90, 60.00, '2025-07-25 23:00:00'),
(5, 4, 'club', NULL, 'XO the Club', 200, 90, 60.00, '2025-07-25 22:00:00'),
(6, 2, 'club', NULL, 'Puncher comedy club', 200, 90, 60.00, '2025-07-25 22:00:00'),
(7, 1, 'back2back', NULL, 'Caprera Openluchtheater', 2000, 540, 110.00, '2025-07-26 14:00:00'),
(10, 5, 'club', NULL, 'Jopenkerk', 300, 90, 60.00, '2025-07-26 22:00:00'),
(11, 3, 'club', NULL, 'Lichtfabriek', 1500, 240, 75.00, '2025-07-26 21:00:00'),
(12, 6, 'club', NULL, 'Slachthuis', 200, 90, 60.00, '2025-07-26 23:00:00'),
(13, 5, 'back2back', NULL, 'Caprera Openluchtheater', 2000, 540, 110.00, '2025-07-27 14:00:00'),
(16, 4, 'club', NULL, 'Jopenkerk', 300, 90, 60.00, '2025-07-27 19:00:00'),
(17, 1, 'club', NULL, 'XO the Club', 1500, 90, 90.00, '2025-07-27 21:00:00'),
(18, 2, 'club', NULL, 'Slachthuis', 200, 90, 60.00, '2025-07-27 18:00:00'),
(20, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-25 17:00:00'),
(21, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-26 17:00:00'),
(22, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-27 17:00:00'),
(23, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-27 19:00:00'),
(24, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-26 19:00:00'),
(25, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-25 19:00:00'),
(26, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-24 19:00:00'),
(27, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-24 21:00:00'),
(28, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-25 21:00:00'),
(29, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-26 21:00:00'),
(30, 7, 'Ratatouille', NULL, 'Spaarne 96, 2011 CL Haarlem, Nederland', 52, 120, 45.00, '2025-07-27 21:00:00'),
(31, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-24 18:00:00'),
(32, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-24 19:30:00'),
(33, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-24 21:00:00'),
(34, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-25 21:00:00'),
(35, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-25 18:00:00'),
(36, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-25 19:30:00'),
(37, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-26 21:00:00'),
(38, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-26 18:00:00'),
(39, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-26 19:30:00'),
(40, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-27 21:00:00'),
(41, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-27 18:00:00'),
(42, 8, 'Café de Roemer', NULL, 'Botermarkt 17, 2011 XL Haarlem', 35, 90, 45.00, '2025-07-27 19:30:00'),
(43, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-24 17:30:00'),
(44, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-24 19:00:00'),
(45, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-24 20:30:00'),
(46, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-25 17:30:00'),
(47, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-25 20:30:00'),
(48, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-25 19:00:00'),
(49, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-26 17:30:00'),
(50, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-26 20:30:00'),
(51, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-26 19:00:00'),
(52, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-27 17:30:00'),
(53, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-27 20:30:00'),
(54, 13, 'Urban Frenchy Bistro Toujours', NULL, 'Oude Groenmarkt 10-12, 2011 HL Haarlem, Nederland', 48, 90, 35.00, '2025-07-27 19:00:00'),
(55, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-24 16:30:00'),
(56, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-24 18:00:00'),
(57, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-24 19:30:00'),
(58, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-25 16:30:00'),
(59, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-25 18:00:00'),
(60, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-25 19:30:00'),
(61, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-26 16:30:00'),
(62, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-26 18:00:00'),
(63, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-26 19:30:00'),
(64, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-27 16:30:00'),
(65, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-27 18:00:00'),
(66, 12, 'Grand Cafe Brinkman', NULL, 'Grote Markt 13, 2011 RC Haarlem, Nederland', 100, 90, 35.00, '2025-07-27 19:30:00'),
(67, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-24 17:00:00'),
(68, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-24 18:30:00'),
(69, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-24 20:00:00'),
(70, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-25 18:30:00'),
(71, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-25 20:00:00'),
(72, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-25 17:00:00'),
(73, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-26 18:30:00'),
(74, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-26 20:00:00'),
(75, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-26 17:00:00'),
(76, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-27 18:30:00'),
(77, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-27 20:00:00'),
(78, 11, 'New Vegas', NULL, 'Koningstraat 5, 2011 TB Haarlem', 36, 90, 35.00, '2025-07-27 17:00:00'),
(79, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-24 17:30:00'),
(80, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-24 20:30:00'),
(81, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-24 19:00:00'),
(82, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-25 20:30:00'),
(83, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-25 19:00:00'),
(84, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-25 17:30:00'),
(85, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-26 20:30:00'),
(86, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-26 19:00:00'),
(87, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-26 17:30:00'),
(88, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-27 20:30:00'),
(89, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-27 19:00:00'),
(90, 10, 'Restaurant Fris', NULL, 'Twijnderslaan 7, 2012 BG Haarlem, Nederland', 45, 90, 45.00, '2025-07-27 17:30:00'),
(91, 9, 'Restaurant ML', NULL, 'Kleine Houtstraat 70, 2011 DR Haarlem, Nederland', 60, 120, 45.00, '2025-07-24 17:00:00'),
(92, 9, 'Restaurant ML', NULL, 'Kleine Houtstraat 70, 2011 DR Haarlem, Nederland', 60, 120, 45.00, '2025-07-24 19:00:00'),
(93, 9, 'Restaurant ML', NULL, 'Kleine Houtstraat 70, 2011 DR Haarlem, Nederland', 60, 120, 45.00, '2025-07-27 19:00:00'),
(94, 9, 'Restaurant ML', NULL, 'Kleine Houtstraat 70, 2011 DR Haarlem, Nederland', 60, 120, 45.00, '2025-07-27 17:00:00'),
(95, 9, 'Restaurant ML', NULL, 'Kleine Houtstraat 70, 2011 DR Haarlem, Nederland', 60, 120, 45.00, '2025-07-26 19:00:00'),
(96, 9, 'Restaurant ML', NULL, 'Kleine Houtstraat 70, 2011 DR Haarlem, Nederland', 60, 120, 45.00, '2025-07-26 17:00:00'),
(97, 9, 'Restaurant ML', NULL, 'Kleine Houtstraat 70, 2011 DR Haarlem, Nederland', 60, 120, 45.00, '2025-07-25 19:00:00'),
(98, 9, 'Restaurant ML', NULL, 'Kleine Houtstraat 70, 2011 DR Haarlem, Nederland', 60, 120, 45.00, '2025-07-25 17:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `session_artists`
--

CREATE TABLE `session_artists` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `detail_event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `session_artists`
--

INSERT INTO `session_artists` (`id`, `session_id`, `detail_event_id`) VALUES
(1, 1, 6),
(3, 7, 1),
(6, 13, 5),
(16, 1, 6),
(18, 7, 1),
(21, 13, 5);

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

--
-- Gegevens worden geëxporteerd voor tabel `song`
--

INSERT INTO `song` (`id`, `detail_event_id`, `photo`, `title`, `description`) VALUES
(1, 1, NULL, 'Spaceman', 'Spaceman is one of Hardwell\'s most iconic tracks and a breakthrough hit. Released in 2012, this song became a staple at festivals worldwide. With its soaring synth melodies, explosive drops, and an unmistakable uplifting energy, \"Spaceman\" showcases Hardwell’s mastery of big room house. '),
(2, 1, NULL, 'Appolo', 'Apollo features the angelic vocals of Amba Shepherd combined with Hardwell’s signature big-room style. The track balances heartfelt lyrics and a soaring melodic drop, which made it an instant favorite among fans. The emotional build-up and euphoric energy made \"Apollo\" a timeless anthem in Hardwell\'s discography and EDM history. '),
(3, 1, NULL, 'Zero 76', 'Zero 76 is a collaborative effort between Hardwell and Tiësto, released in 2011. The track title pays homage to their hometown Breda, Netherlands, whose area code is 076. Combining the sounds of two Dutch powerhouses, this track offers punchy beats, a driving rhythm, and an electrifying drop.'),
(4, 2, '/images-logos/uploads/animals.jpg', 'Animals', 'Martin Garrix\'s doorbraaknummer dat de wereld in één klap kennis liet maken met zijn unieke sound. Met zijn hypnotiserende beats en energie werd Animals een festivalanthem en een mijlpaal in de elektronische muziek.'),
(5, 2, '/images-logos/uploads/scared.jpeg', 'Scared to Be Lonely (met Dua Lipa)', 'Een emotionele samenwerking tussen Martin Garrix en Dua Lipa. Dit nummer combineert krachtige vocals met een diepgaande melodie, wat het tot een favoriet maakt bij zowel dance- als popliefhebbers.'),
(6, 2, '/images-logos/uploads/name.jpg', 'In the Name of Love (met Bebe Rexha)', 'Een perfecte mix van elektronische beats en pop, In the Name of Love benadrukt Martin Garrix\'s veelzijdigheid als producer. Samen met Bebe Rexha creëerde hij een nummer dat zowel gevoelig als energiek is');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `bar_code` int(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `ticket`
--

INSERT INTO `ticket` (`id`, `order_id`, `session_id`, `bar_code`, `user_id`) VALUES
(68, 69, 1, 81274, 1),
(69, 70, 3, 76726, 1),
(70, 70, 1, 64792, 1),
(71, 71, 20, 30306, 1),
(72, 72, 4, 13031, 1),
(73, 73, 25, 11482, 1),
(74, 74, 25, 10414, 1),
(75, 74, 30, 92410, 1),
(76, 75, 25, 22807, 1),
(77, 75, 25, 42302, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket_order`
--

CREATE TABLE `ticket_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `ticket_order`
--

INSERT INTO `ticket_order` (`id`, `user_id`, `order_date`) VALUES
(69, 1, '2025-03-19 17:52:43'),
(70, 1, '2025-03-19 18:42:33'),
(71, 1, '2025-03-19 20:01:05'),
(72, 1, '2025-04-03 10:03:30'),
(73, 1, '2025-04-03 10:05:18'),
(74, 1, '2025-04-03 10:06:08'),
(75, 1, '2025-04-03 10:16:59');

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
(1, 'customer', 'Meryam', 'Douiri', '0643209996', 'Douirimeryam14@gmail.com', '$2y$12$wq97BWrTh4Y03rymy99tge1VZqENcqYcEhbP9bD0xDhbp67UR0R3W', 'lkYXwmY0gvZXbk5AGD7kNg==', '250c6b04c99c3af94edc41b1376c80c0faa7d2638ed511ad20503fb04831b43c', '2025-03-18 22:04:56'),
(2, 'administrator', 'Romy', 'Groen', NULL, 'groenromy0@gmail.com', '$2y$12$w6Vh.v5QvPOglb2HAmDkXOvWz2/oyzCui4fc8jxbWW6LKswt4V20G', 'el6XUJnPebqT4oQPrewI3A==', NULL, NULL),
(3, 'employee', 'Fiona', 'Shrek', NULL, '701224@student.inholland.nl', '$2y$12$3S3MFqiiCrSfpMp9pCmBWeJguq3EhrAnwlTtr24c3BsU8f/Z4kAdm', 'xMZpfw1LiC+St2cGSu1i7g==', NULL, NULL),
(5, 'customer', 'Mark', 'Haan', '06 67291092', 'markdeHaan@gmail.com', '$2y$12$ULjXzvGJVngxlOU5Pe0qpOOhCn/D8AbTsVnM92RcDKUkOO.aSIRAm', 'vu3IWR6CUU83V37Zm9vImw==', NULL, NULL),
(6, 'customer', 'John', 'Doe', '0629102738', 'Johndoe@gmail.com', '$2y$12$fE5TgMI4d8cqRXM96jSH1OU/YmzTMzAnxMimeXxDRRhm4cjQVlUwe', 'FPsX9Fk++YCoW8uXfV7zQg==', NULL, NULL),
(7, 'customer', 'Bart', 'godijn', '0643209996', 'bartgodijn@gmail.com', '$2y$12$OJbOZYGooaVfPaJ5pxB9M.8A3TyONGQEnoNMoXg2CGgVWF1iVu13.', 'fFqtRsC4MZ+l9bd618KUsQ==', NULL, NULL);

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
-- Indexen voor tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_id` (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexen voor tabel `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_event_id` (`detail_event_id`);

--
-- Indexen voor tabel `session_artists`
--
ALTER TABLE `session_artists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`),
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
  ADD KEY `session_id` (`session_id`),
  ADD KEY `fk_ticket_user` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `detail_event_card_tag`
--
ALTER TABLE `detail_event_card_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT voor een tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT voor een tabel `session_artists`
--
ALTER TABLE `session_artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT voor een tabel `ticket_order`
--
ALTER TABLE `ticket_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `detail_event`
--
ALTER TABLE `detail_event`
  ADD CONSTRAINT `detail_event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ticket_order` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`);

--
-- Beperkingen voor tabel `session_artists`
--
ALTER TABLE `session_artists`
  ADD CONSTRAINT `session_artists_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `session_artists_ibfk_2` FOREIGN KEY (`detail_event_id`) REFERENCES `detail_event` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_ticket_order` FOREIGN KEY (`order_id`) REFERENCES `ticket_order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ticket_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`);

--
-- Beperkingen voor tabel `ticket_order`
--
ALTER TABLE `ticket_order`
  ADD CONSTRAINT `ticket_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
