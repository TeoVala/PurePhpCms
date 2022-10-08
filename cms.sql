-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: localhost:3306
-- Χρόνος δημιουργίας: 10 Σεπ 2022 στις 09:32:59
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
(1, 2, 'Teo Vala', 'dassad@dasdas', 'This is a example lorem ipsum adasdadasdasd', 'approved', '2022-08-30'),
(5, 2, 'Teo', 'sdaoasop@fasdopas', 'In eu purus quis purus feugiat commodo vel a diam. Quisque magna purus, feugiat et lorem id, laoreet lobortis sapien. Pellentesque bibendum rhoncus quam, vel vestibulum lorem faucibus ut.', 'approved', '2022-09-01'),
(6, 16, 'Greg', 'tgds@dasogrec', 'In eu purus quis purus feugiat commodo vel a diam. Quisque magna purus, feugiat et lorem id, laoreet lobortis sapien. Pellentesque bibendum rhoncus quam, vel vestibulum lorem faucibus ut.', 'approved', '2022-09-01'),
(7, 16, 'Joe Doe', 'dasdas@dasdasdasc', 'In eu purus quis purus feugiat commodo vel a diam. Quisque magna purus, feugiat et lorem id, laoreet lobortis sapien. Pellentesque bibendum rhoncus quam, vel vestibulum lorem faucibus ut.', 'approved', '2022-09-01'),
(8, 2, 'Huan', 'dasd@dasdas', 'Quisque aliquet dui quis diam rutrum molestie. Fusce fermentum ex a velit tristique molestie sit amet vitae sapien. Sed ut ligula sem. Donec quis quam facilisis, auctor erat in, consectetur purus. Quisque ultricies tortor ut ante tempor, eu tincidunt mauris feugiat. Phasellus semper tellus massa, ac convallis dui commodo eget.', 'approved', '2022-09-03'),
(10, 16, 'sdad', 'dasdas@dasdas', 'Quisque aliquet dui quis diam rutrum molestie. Fusce fermentum ex a velit tristique molestie sit amet vitae sapien. Sed ut ligula sem. Donec quis quam facilisis, auctor erat in, consectetur purus. Quisque ultricies tortor ut ante tempor, eu tincidunt mauris feugiat. Phasellus semper tellus massa, ac convallis dui commodo eget.', 'unapproved', '2022-09-03'),
(11, 2, 'dasdas', 'dsads@dsadas', 'Suspendisse non ex sem. Etiam vulputate turpis eu eleifend cursus. Morbi euismod enim vel interdum commodo. Integer euismod libero eget tincidunt placerat. ', 'unapproved', '2022-09-03');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` varchar(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL DEFAULT '0',
  `post_status` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`) VALUES
(2, '2', 'Javascript course', 'John Doe', '2022-09-10', 'placeholder1.jpg', 'Pellentesque ultrices ante nec massa ullamcorper lobortis. In hac habitasse platea dictumst. Donec id risus viverra, suscipit leo non, porttitor sem. Curabitur dictum, sapien at ultrices iaculis, ipsum est pulvinar tellus, eget congue nisl arcu volutpat nunc. Cras in tortor sed dolor pharetra dignissim. Pellentesque porta odio ipsum, non rutrum enim luctus sit amet. Donec libero dolor, suscipit malesuada nulla nec, pulvinar commodo mi. Cras porttitor quam vitae est dignissim, eget consequat enim mattis. Nam nisi felis, consectetur vitae libero at, iaculis fringilla dolor.', 'teo, javascript, course', 4, 'published'),
(16, '2', 'Php OOP', 'John Doe', '2022-09-10', 'image_3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu feugiat dui, vitae pellentesque orci. Nunc molestie consectetur nisi vitae maximus. Nullam rhoncus eu dui a varius. Aliquam in est a metus lacinia gravida. Aenean ac mi in magna convallis ornare. Aliquam elementum arcu vel est condimentum, vel tempus tellus scelerisque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec euismod elementum leo vel bibendum. Nullam nec nisl eget odio ultrices vulputate. Curabitur non scelerisque felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec venenatis dapibus tincidunt. Aenean a eleifend lacus.', 'php, oop, john', 3, 'published'),
(17, '25', 'Draft post', 'Joe Doe', '2022-09-10', '', 'In mollis, mi non condimentum facilisis, lorem massa pellentesque nisl, non tempus urna ex non mauris. Vestibulum at ante leo. Donec porttitor fringilla turpis et lacinia. ', 'draft, proc, php', 0, 'draft');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(10, 'admin', 'admin', 'admin', 'admin', 'admin@admin.com', NULL, 'admin', NULL),
(11, 'user1', 'user1', 'User', 'Useridis', 'user1@user1.com', NULL, 'subscriber', NULL),
(12, 'user2', '123', 'User2', 'useridis', 'user2@user2.com', NULL, 'subscriber', NULL);

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
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT για πίνακα `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
