-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: localhost:3306
-- Χρόνος δημιουργίας: 13 Νοε 2022 στις 09:06:00
-- Έκδοση διακομιστή: 5.7.33
-- Έκδοση PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `cms`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(2, 'Javascript'),
(3, 'PHP'),
(4, 'Java'),
(24, 'OOP'),
(25, 'Procedural PHP'),
(27, 'Bootstrap');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(7, 16, 'Joe Doe', 'dasdas@dasdasdasc', 'In eu purus quis purus feugiat commodo vel a diam. Quisque magna purus, feugiat et lorem id, laoreet lobortis sapien. Pellentesque bibendum rhoncus quam, vel vestibulum lorem faucibus ut.', 'unapproved', '2022-09-01'),
(10, 16, 'sdad', 'dasdas@dasdas', 'Quisque aliquet dui quis diam rutrum molestie. Fusce fermentum ex a velit tristique molestie sit amet vitae sapien. Sed ut ligula sem. Donec quis quam facilisis, auctor erat in, consectetur purus. Quisque ultricies tortor ut ante tempor, eu tincidunt mauris feugiat. Phasellus semper tellus massa, ac convallis dui commodo eget.', 'approved', '2022-09-03'),
(11, 2, 'dasdas', 'dsads@dsadas', 'Suspendisse non ex sem. Etiam vulputate turpis eu eleifend cursus. Morbi euismod enim vel interdum commodo. Integer euismod libero eget tincidunt placerat. ', 'unapproved', '2022-09-03'),
(12, 16, 'dsa', 'das', 'das', 'unapproved', '2022-10-16'),
(13, 16, 'dsa', 'das', 'das', 'unapproved', '2022-10-16'),
(14, 16, 'das', 'dsa', 'das', 'unapproved', '2022-10-16'),
(17, 16, 'das', 'ddas', 'dasd', 'unapproved', '2022-10-16'),
(18, 16, 'das', 'das', 'das', 'unapproved', '2022-10-16'),
(19, 16, 'das', 'das', 'das', 'unapproved', '2022-10-16');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` varchar(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) DEFAULT NULL,
  `post_user` varchar(255) DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL DEFAULT '0',
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) UNSIGNED DEFAULT '0',
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`) VALUES
(96, '2', 'Php OOP', 'John Doe', 'admin', '2022-10-29', 'image_3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu feugiat dui, vitae pellentesque orci. Nunc molestie consectetur nisi vitae maximus. Nullam rhoncus eu dui a varius. Aliquam in est a metus lacinia gravida. Aenean ac mi in magna convallis ornare. Aliquam elementum arcu vel est condimentum, vel tempus tellus scelerisque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec euismod elementum leo vel bibendum. Nullam nec nisl eget odio ultrices vulputate. Curabitur non scelerisque felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec venenatis dapibus tincidunt. Aenean a eleifend lacus.', 'php, oop, john', 0, 'published', 352, 0),
(97, '4', 'Wow another post', 'TeoVala', 'admin', '2022-10-29', '', '<p>asfasgasgas<br></p>', 'asds', 0, 'published', 46, 0),
(98, '25', 'Php OOP', 'John Doe', 'admin', '2022-10-29', 'image_3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu feugiat dui, vitae pellentesque orci. Nunc molestie consectetur nisi vitae maximus. Nullam rhoncus eu dui a varius. Aliquam in est a metus lacinia gravida. Aenean ac mi in magna convallis ornare. Aliquam elementum arcu vel est condimentum, vel tempus tellus scelerisque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec euismod elementum leo vel bibendum. Nullam nec nisl eget odio ultrices vulputate. Curabitur non scelerisque felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec venenatis dapibus tincidunt. Aenean a eleifend lacus.', 'php, oop, john', 0, 'published', 1, 0),
(99, '2', 'Wow another post', 'TeoVala', 'admin', '2022-10-29', '', '<p>asfasgasgas<br></p>', 'asds', 0, 'published', 2, 0),
(100, '3', 'Php OOP', 'John Doe', 'admin', '2022-10-29', 'image_3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu feugiat dui, vitae pellentesque orci. Nunc molestie consectetur nisi vitae maximus. Nullam rhoncus eu dui a varius. Aliquam in est a metus lacinia gravida. Aenean ac mi in magna convallis ornare. Aliquam elementum arcu vel est condimentum, vel tempus tellus scelerisque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec euismod elementum leo vel bibendum. Nullam nec nisl eget odio ultrices vulputate. Curabitur non scelerisque felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec venenatis dapibus tincidunt. Aenean a eleifend lacus.', 'php, oop, john', 0, 'published', 2, 0),
(101, '2', 'Hello world', 'dasdasasd', 'admin', '2022-10-29', '', '<p>dadas<br></p>', 'dasdas', 0, 'published', 1, 0),
(104, '27', 'dasds', NULL, 'user1', '2022-10-29', '', '', 'dasddas', 0, 'published', 3, 0),
(105, '2', 'dsadas', NULL, 'admin', '2022-10-29', '', '<p>dasdas<br></p>', 'dasdas', 0, 'published', 1, 0),
(106, '2', 'This is the escaped post', NULL, 'admin', '2022-10-29', '', '', '', 0, 'published', 4, 0),
(107, '2', 'dsadas', NULL, 'admin', '2022-10-29', '', '', '', 0, 'published', 2, 0),
(109, '24', 'dasdas', NULL, 'user2', '2022-10-29', '', '<p>dfasgds</p><p><br></p><p><br></p><p><br></p><p><br></p>', '', 0, 'published', 0, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(30, 'admin', '$2y$12$OjSzmj9qplG9GTEfLCxuf.0AW/vou6/oAq8GxYvUsqP1wM6KfQjJi', 'Teo', 'Vala', 'teodor.pj@gmail.com', NULL, 'admin', '$2y$10$iusesomecrazystrings22', ''),
(31, 'user1', '$2y$10$ZlxCm0I/FEKuAi51ta77Z.AOpEr8JBBrg10S2Vvl3ZrqGQzZ0K2A.', 'kapws', 'kaspoios', 'tedsakl@dfasl', NULL, 'subscriber', '$2y$10$iusesomecrazystrings22', NULL),
(32, 'user2', '$2y$10$NRyaAwfwVOFnY1DcwNpQ0eIMVwUW5maozrAvCfyLSCt57ybvohZgS', 'das', 'dasdas', 'waedoij@gnau', NULL, 'subscriber', '$2y$10$iusesomecrazystrings22', NULL),
(36, 'user3', '$2y$12$lsBHi577Cw5vTe0Od4Z2L.j8GyIZJhPhF4pkia1PxccBQT1trz1IK', NULL, NULL, 'user@gmail.com', NULL, 'subscriber', '$2y$10$iusesomecrazystrings22', NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'ek60h56d0l98gedj1svaltvori', 1666300261),
(2, 'ngd0q75e7hnf6r24tcrpr2vpd4', 1666298530),
(3, '67048vsquojtsotjjf55viaq52', 1666298615),
(4, 'uko1pnpmddqsik5d15ff9se9i8', 1666299466),
(5, 'fotb28fdb7a9k8h8ou5av2jfo6', 1666553423),
(6, '6jllf7o1ii3am7a67qggluibj5', 1666547623),
(7, 'ml9btjfa1km55cqss10nheeug2', 1666547743),
(8, '0pm6dpdlmj6medpeffimpudcda', 1666547908),
(9, 'sfs1qi5159p4pkf8qo642o4dpe', 1666820689),
(10, 'uj7267u3m4v5rfrboaoqsc90d3', 1667007536),
(11, 'f22t1qpp0c316p8d3ug97s3p6t', 1667064195),
(12, 'ceclbk50bj6g5fnjmsot4bu2is', 1667082347),
(13, 'vgs7ojbdh7kfsj0gevdgqujrsg', 1667420654),
(14, 'n62u5cpt1udbn9m828lf3mdkne', 1667679154),
(15, 'hiaul8t5gffl1kmv8rn4t24p4k', 1667757864),
(16, 'i7gqfpatqau9gasr3tjuus30jr', 1667859184),
(17, 'replh96po5aha3ns6mgt1101ks', 1667945680),
(18, 'besbpm9fjvkrprflhi13bttqui', 1668329662);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Ευρετήρια για πίνακα `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Ευρετήρια για πίνακα `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Ευρετήρια για πίνακα `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT για πίνακα `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT για πίνακα `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT για πίνακα `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
