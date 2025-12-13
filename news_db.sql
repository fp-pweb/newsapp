-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2025 pada 13.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `title`, `summary`, `image`, `source`, `url`, `note`, `created_at`) VALUES
(2, 2, '7 deaths and hundreds of injuries are linked to faulty Abbott glucose monitors - NPR', NULL, 'https://npr.brightspotcdn.com/dims3/default/strip/false/crop/2449x1378+0+128/resize/1400/quality/100/format/jpeg/?url=http%3A%2F%2Fnpr-brightspot.s3.amazonaws.com%2Fca%2F70%2F9c8aa8644e5aafc44e39ecea0fb2%2Fgettyimages-2249261565.jpg', 'NPR', 'https://www.npr.org/2025/12/06/g-s1-101082/abbott-glucose-monitor-deaths-recall-freestyle-libre', 'note test 2\n', '2025-12-07 18:46:25'),
(7, 1, 'Trump urges a new vaccine schedule. Here’s what other countries do. - The Washington Post', '', 'https://www.washingtonpost.com/wp-apps/imrs.php?src=https://arc-anglerfish-washpost-prod-washpost.s3.amazonaws.com/public/TZJQC6YZD5BYQK2TECBRFR5CMM.jpg&w=1440', NULL, 'https://www.washingtonpost.com/world/2025/12/06/trump-rfk-international-vaccine-schedule/', 'yofqobdwqp', '2025-12-07 22:52:40'),
(11, 1, 'Zelensky signals progress in talks with US to secure peace plan - BBC', 'BBC News', 'https://ichef.bbci.co.uk/news/1024/branded_news/1230/live/b8babfd0-d2dc-11f0-a892-01d657345866.jpg', NULL, 'https://www.bbc.com/news/articles/cz680jx511no', 'test', '2025-12-07 22:59:14'),
(12, 1, '41 People Who Almost Died Are Sharing How They Barely Survived, And It\'s Actually Terrifying - BuzzFeed', 'Buzzfeed', 'https://img.buzzfeed.com/buzzfeed-static/static/2025-12/05/22/thumb/nrzl6whL9.jpg?crop=2865:1500;68,0%26downsize=1250:*', NULL, 'https://www.buzzfeed.com/mychalthompson/41-people-who-almost-died', '', '2025-12-07 23:00:44'),
(16, 5, 'National parks fee-free calendar drops MLK Day, Juneteenth and adds Trump\'s birthday - NPR', 'NPR', 'https://npr.brightspotcdn.com/dims3/default/strip/false/crop/8667x4875+0+447/resize/1400/quality/100/format/jpeg/?url=http%3A%2F%2Fnpr-brightspot.s3.amazonaws.com%2F83%2F4e%2F0d8739144d15b55f184546b60776%2Fgettyimages-2201331607.jpg', NULL, 'https://www.npr.org/2025/12/06/g-s1-101090/national-parks-fee-free-calendar-mlk-juneteenth', '', '2025-12-07 23:18:38'),
(17, 5, 'Alabama vs. Georgia live updates: Score, analysis and highlights for SEC Championship Game - CBS Sports', 'CBS Sports', 'https://sportshub.cbsistatic.com/i/r/2025/12/06/564c2f1b-cedd-49ce-8764-e1e476802a5c/thumbnail/1200x675/488fdf13b3680dc88693e708845214ec/georgia-bama-1.jpg', NULL, 'https://www.cbssports.com/college-football/news/alabama-georgia-live-updates-sec-championship-game-score-results-analysis/live/', '', '2025-12-07 23:19:12'),
(26, 5, 'Soldiers announce apparent military coup in Benin - AP News', 'Associated Press', 'https://dims.apnews.com/dims4/default/f204264/2147483647/strip/true/crop/5616x3159+0+293/resize/1440x810!/quality/90/?url=https%3A%2F%2Fassets.apnews.com%2Fe4%2F65%2F7fa10e5eb47595fbf7676969c4ba%2F13d4b9ff7e3042fbbeba960db6309106', NULL, 'https://apnews.com/article/benin-coup-soldiers-66ac8edf0e5acf6ebfa37c46131713c8', 'voofo8i7bo', '2025-12-08 10:20:36'),
(28, 5, 'UFC 323 results: Petr Yan upsets Merab Dvalishvili to reclaim bantamweight title - CBS Sports', 'CBS Sports', 'https://sportshub.cbsistatic.com/i/r/2025/12/07/d7492f3a-7d75-427a-bfb6-978ac6adf9cc/thumbnail/1200x675/b972dffc8aab00c70e5c4b8e0cfd299b/petr-yan-point-winner-323.jpg', NULL, 'https://www.cbssports.com/ufc/news/ufc-323-live-updates-results-merab-dvalishvili-petr-yan-scorecard-analysis-highlights/live/', '', '2025-12-08 10:31:03'),
(29, 5, 'Hollywood fears job cuts as opposition to Netflix-Warner deal grows - Financial Times', 'Financial Times', 'https://images.ft.com/v3/image/raw/https%3A%2F%2Fd1e00ek4ebabms.cloudfront.net%2Fproduction%2F9e413864-9df5-49f4-ba7c-908fd9442c24.jpg?source=next-barrier-page', NULL, 'https://www.ft.com/content/7c901bb2-c9d9-4921-a5aa-99235d4ad12f', '', '2025-12-08 10:33:30'),
(30, 2, 'Soldiers announce apparent military coup in Benin - AP News', 'Associated Press', 'https://dims.apnews.com/dims4/default/f204264/2147483647/strip/true/crop/5616x3159+0+293/resize/1440x810!/quality/90/?url=https%3A%2F%2Fassets.apnews.com%2Fe4%2F65%2F7fa10e5eb47595fbf7676969c4ba%2F13d4b9ff7e3042fbbeba960db6309106', NULL, 'https://apnews.com/article/benin-coup-soldiers-66ac8edf0e5acf6ebfa37c46131713c8', '', '2025-12-08 10:34:01'),
(32, 10, 'UFC 323 results: Petr Yan upsets Merab Dvalishvili to reclaim bantamweight title - CBS Sports', 'CBS Sports', 'https://sportshub.cbsistatic.com/i/r/2025/12/07/d7492f3a-7d75-427a-bfb6-978ac6adf9cc/thumbnail/1200x675/b972dffc8aab00c70e5c4b8e0cfd299b/petr-yan-point-winner-323.jpg', NULL, 'https://www.cbssports.com/ufc/news/ufc-323-live-updates-results-merab-dvalishvili-petr-yan-scorecard-analysis-highlights/live/', '', '2025-12-08 11:37:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'test1', 'test@gmail.com', '$2y$10$Am3/KkwbEmhrtK51n.PRUOpqX9oc.YH5sDDNbJ3V0B.GfkP5dxzFC', '2025-12-07 15:46:05'),
(2, 'test2', 'test2@gmail.com', '$2y$10$USheL9in0HAkbhyOBQZrYe2/LB1.Kwk3bg0kgCBpmcWlc9bX/qobS', '2025-12-07 17:52:27'),
(5, 'test12', 'test12@gmail.com', '$2y$10$S5HlQhRXmT5xrb.67ryrveBokrANldJc.ttwMdXonFCIeOiT7sBWq', '2025-12-07 23:07:15'),
(9, 't142', 'hafidzharridil99@gmail.com', '$2y$10$xgfXbya0fg15wH4G7UjAwe6G3/KhG.JB5lmVd8D.Om.WLdlpp.3DO', '2025-12-08 10:23:17'),
(10, 'test3', 'test3@hotmail.com', '$2y$10$KAeIg7M3TRlsMShWpuhYWerYiBX/cKggBdfx9BFb.X8nHuJQsGCqC', '2025-12-08 11:09:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
