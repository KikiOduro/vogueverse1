-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2024 at 01:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vogueverse`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`comment_id`, `post_id`, `user_id`, `comment_text`, `created_at`) VALUES
(2, 12, 3, 'i love this!', '2024-12-15 18:23:32'),
(3, 12, 4, 'Thank you so much Eugene!', '2024-12-15 19:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `post_id`, `user_id`, `liked_at`) VALUES
(2, 12, 3, '2024-12-15 19:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` enum('published','archived') DEFAULT 'published',
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Posts`
--

INSERT INTO `Posts` (`post_id`, `user_id`, `title`, `content`, `created_at`, `updated_at`, `status`, `image_url`) VALUES
(7, 4, 'The Art of Accessorizing: How to Elevate Any Outfit', 'Accessories are the unsung heroes of fashion. They can transform even the simplest outfits into stunning ensembles. In this post, we explore:\r\n\r\nStatement Jewelry: Bold necklaces or oversized earrings can add drama to plain outfits. Pair a chunky necklace with a simple black dress for instant glamour.\r\n\r\nBags for Every Occasion: Invest in a structured tote for work, a sleek clutch for evenings, and a casual crossbody bag for weekends.\r\n\r\nHats and Scarves: A wide-brimmed hat or a silk scarf tied around the neck can add sophistication to your look.\r\n\r\nShoes as Statement Pieces: From metallic heels to patterned flats, the right shoes can elevate any outfit.', '2024-12-14 13:51:52', '2024-12-15 20:55:12', 'published', 'uploads/posts/675d8d783b12c.jpg'),
(8, 4, 'Sustainable Fashion: How to Shop Smarter and Save the Planet', 'Fashion doesn’t have to cost the earth. In this post, we highlight actionable steps for building a sustainable wardrobe:\r\n\r\nThrifting Tips: Learn how to find gems in second-hand stores. Look for timeless pieces in excellent condition and consider tailoring for a perfect fit.\r\n\r\nEco-Friendly Brands: Support labels like Patagonia and Reformation that prioritize ethical and sustainable practices.\r\n\r\nClothing Care Tips: Extend the life of your clothes by washing them with cold water, air-drying when possible, and storing them properly.', '2024-12-14 14:15:47', NULL, 'published', 'uploads/posts/675d9313b896d.jpg'),
(9, 4, 'How to Build a Capsule Wardrobe That Works for You!', 'Simplify your life by curating a capsule wardrobe. Here’s how to start:\r\n\r\nStep 1: Choose Versatile Pieces: Opt for basics in neutral colors like black, white, navy, and beige.\r\n\r\nStep 2: Invest in Quality: Look for durable fabrics and well-constructed garments that can withstand frequent wear.\r\n\r\nStep 3: Mix and Match: Ensure each piece can be paired with at least three other items in your wardrobe.', '2024-12-14 14:18:26', NULL, 'published', 'uploads/posts/675d93b2a69ce.jpg'),
(10, 4, 'VogueVerse Spotlight: How to Nail the Monochrome Trend', 'Master the monochrome trend like a pro. From all-white ensembles to bold, single-color outfits, here’s how:\r\n\r\nChoosing Shades: Understand your undertone to select flattering hues. For example, warm undertones pair well with earthy tones, while cool undertones suit jewel tones.\r\n\r\nMixing Textures: Combine fabrics like silk, denim, and wool in the same color family to add depth to your look.\r\n\r\nAccessorizing: Use metallic or contrasting accessories to break the monotony while keeping the outfit cohesive.', '2024-12-14 14:27:48', NULL, 'published', 'uploads/posts/675d95e4acfff.jpg'),
(11, 4, 'From the Runway to Reality: 2024’s Biggest Trends You Can Wear Now', 'This season&#039;s fashion shows were all about bold prints, oversized tailoring, and metallic accents. But how do you translate high-fashion looks into everyday outfits?\r\n\r\nTrend 1: Metallics: Shine bright with metallic accents. Try pairing a shiny silver skirt with a basic white tee for a balanced look.\r\n\r\nTrend 2: Sheer Fabrics: Layer a sheer blouse over a bralette or camisole for a chic, modern vibe that’s perfect for evenings.\r\n\r\nTrend 3: Oversized Tailoring: Rock an oversized blazer with slim-fit trousers or even over a mini dress for a mix of masculine and feminine energy.', '2024-12-14 14:29:51', NULL, 'published', 'uploads/posts/675d965f42360.jpg'),
(12, 4, 'Street Style Diaries: Fashion Inspiration from Around the World', 'Get inspired by how fashionistas from different cities express their style:\r\n\r\nTokyo: Experimental layering with bold colors and quirky accessories define Tokyo’s eclectic style.\r\n\r\nParis: Chic minimalism reigns supreme, with staples like trench coats, striped tees, and berets.\r\n\r\nNew York: Edgy, urban looks featuring leather jackets, distressed denim, and statement sneakers reflect the city’s hustle.', '2024-12-14 14:31:17', NULL, 'published', 'uploads/posts/675d96b564830.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `fname`, `lname`, `email`, `password`, `role`, `created_at`, `updated_at`, `gender`, `dob`, `phone`) VALUES
(1, 'akua', 'oduro', 'akua.oduro@ashesi.edu.gh', '$2y$10$6s.bIB0aV6hZRjD8LD9Fi.HrejdrsGn7q5Uz3pxIqbdPjlMJ1mb8G', 2, '2024-12-09 00:33:25', '2024-12-09 00:33:25', '2', '2024-12-10', '0557663220'),
(2, 'rachel', 'frimps', 'rachel.frimpong@gmail.com', '$2y$10$Pc29Po0kOV2zzhJNsWiH1.i5CqLaMFjvWYGze4N390KpDABqMayFW', 2, '2024-12-09 00:37:00', '2024-12-09 00:37:00', '2', '2024-12-10', '0557233220'),
(3, 'Eugene', 'Daniels', 'eugenedaniels@gmail.com', '$2y$10$oeIyF.1Yij3hXrfDdfYkbOzUEk.kUnuutUNm0mfzS1rKDCtaDwQmq', 2, '2024-12-10 21:22:37', '2024-12-10 21:22:37', '1', '2024-12-13', '0322456811'),
(4, 'Nhyiraba', 'Mensah', 'nhyie.mensah@gmail.com', '$2y$10$qFImm6zSBP.TReTG3bHaC.AY7NU4bqdeyx7R4uzh/R647KgGCIefS', 2, '2024-12-14 13:40:02', '2024-12-14 13:40:02', '2', '2024-12-15', '0244603811'),
(5, 'Bubble', 'Gum', 'bubble.gum@gmail.com', '$2y$10$0e3nKLUspfJfBaTpicv.1uYbbSrUzLhFDuT0WSfy5P7u8tvFKLwFu', 2, '2024-12-15 19:34:17', '2024-12-15 19:34:17', '2', '2024-12-16', '0555703705'),
(6, 'kiki', 'oduro', 'kiki.oduro@gmail.com', '$2y$10$1NH.tEkCdqmPlN1RQDqi7O5TeOzM6PYb3SQcjtv5p/54z8pOm2JhK', 2, '2024-12-15 20:48:24', '2024-12-15 20:48:24', '2', '2024-07-21', '0557663220'),
(7, 'Abena', 'Oduro', 'abena.oduro@gmail.com', '$2y$10$U9WjKy5MpUqFE0aOcBT60ObLAu9V/TlOA5dNJvnPp00d28Q2Mkr66', 2, '2024-12-16 21:22:19', '2024-12-16 21:22:19', '2', '2024-12-04', '0246869889');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `post_id` (`post_id`,`user_id`);

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
