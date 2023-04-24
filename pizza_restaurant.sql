-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 12:45 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `idAbout` int(10) NOT NULL,
  `nameAbout` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descAbout` text COLLATE utf8_unicode_ci NOT NULL,
  `srcImgAbout` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extImgAbout` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `altImgAbout` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`idAbout`, `nameAbout`, `descAbout`, `srcImgAbout`, `extImgAbout`, `altImgAbout`) VALUES
(1, 'Welcome to <span class=\"flaticon-pizza\">Pizza</span> A Restaurant', 'On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word and the Little Blind Text should turn around and return ', 'about', 'jpg', 'Pizza restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `idAuthor` int(10) NOT NULL,
  `titleAuthor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nameAuthor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `indexAuthor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptionAuthor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `infoDestinationAuthor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hrefAuthor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `srcImgAuthor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `altImgAuthor` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `idBook` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bookedDateTime` datetime NOT NULL,
  `currentDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `message` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `idContact` int(100) NOT NULL,
  `nameContact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailContact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subjectContact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `messageContact` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`idContact`, `nameContact`, `emailContact`, `subjectContact`, `messageContact`) VALUES
(1, 'Daca', 'daca@gmail.com', 'Daca', 'Nesto'),
(2, 'Daca', 'daca@gmail.com', 'Daca', 'Nesto');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `idCounter` int(10) NOT NULL,
  `nameCounter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numberCounter` int(10) NOT NULL,
  `iconCounter` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`idCounter`, `nameCounter`, `numberCounter`, `iconCounter`) VALUES
(1, 'Pizza Branches', 100, 'pizza-1'),
(2, 'Number of Awards', 85, 'medal'),
(3, 'Happy Customer', 10567, 'laugh'),
(4, 'Staff', 900, 'chef');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `idInfo` int(11) NOT NULL,
  `nameInfo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `textInfo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descInfo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iconInfo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`idInfo`, `nameInfo`, `textInfo`, `descInfo`, `iconInfo`) VALUES
(1, 'Phone', '000 (123) 456 7890', 'A small river named Duden flows', 'phone'),
(2, 'Adress', '198 West 21th Street', 'Suite 721 New York NY 10016', 'my_location'),
(3, 'Open', 'Monday-Friday', '8:00am - 9:00pm', 'clock-o');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(10) NOT NULL,
  `nameMenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descMenu` text COLLATE utf8_unicode_ci NOT NULL,
  `srcImgMenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extImgMenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `altImgMenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceMenu` float NOT NULL,
  `visibleMenu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `nameMenu`, `descMenu`, `srcImgMenu`, `extImgMenu`, `altImgMenu`, `priceMenu`, `visibleMenu`) VALUES
(1, 'Italian Pizza', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 'pizza-1', 'jpg', 'Italian Pizza', 3, 1),
(2, 'Greek Pizza', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 'pizza-2', 'jpg', 'Greek Pizza', 3, 1),
(3, 'Caucasian Pizza', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 'pizza-3', 'jpg', 'Caucasian Pizza', 3, 1),
(4, 'American Pizza', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 'pizza-4', 'jpg', 'American Pizza', 3, 1),
(5, 'Tomatoe Pie', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 'pizza-5', 'jpg', 'Tomatoe Pie', 3, 1),
(6, 'Margherita', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia', 'pizza-6', 'jpg', 'Margherita', 3, 1),
(7, 'Italian pizza', 'Italian pizza', 'pizza-7', 'jpeg', 'Italian pizza', 5, 1),
(16, 'Indian pizza', 'Indian pizza', 'pizza-9', 'jpeg', 'Indian pizza', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nav`
--

CREATE TABLE `nav` (
  `idNav` int(10) NOT NULL,
  `nameNav` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hrefNav` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibleNav` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nav`
--

INSERT INTO `nav` (`idNav`, `nameNav`, `hrefNav`, `visibleNav`) VALUES
(1, 'Home', 'index.php', 1),
(4, 'Book', 'book.php', 1),
(5, 'Contact', 'contact.php', 1),
(6, 'Login', 'login.php', 1),
(7, 'Register', 'register.php', 1),
(10, 'Profile', 'profile.php', 1),
(11, 'Logout', 'logout.php', 1),
(15, 'DB', 'dashboard/indexDB.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quicklinks`
--

CREATE TABLE `quicklinks` (
  `idLinks` int(10) NOT NULL,
  `nameLinks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hrefLinks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibleLinks` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quicklinks`
--

INSERT INTO `quicklinks` (`idLinks`, `nameLinks`, `hrefLinks`, `visibleLinks`) VALUES
(1, 'Documentation', 'documentaition.pdf', 1),
(2, 'JavaScript', 'assets/js/main.js', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `idRating` int(10) NOT NULL,
  `idMenu` int(10) NOT NULL,
  `idUser` int(10) NOT NULL,
  `ratingValue` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`idRating`, `idMenu`, `idUser`, `ratingValue`) VALUES
(1, 1, 1, 3),
(2, 2, 1, 5),
(3, 3, 1, 5),
(4, 4, 1, 5),
(5, 5, 1, 5),
(6, 6, 1, 5),
(9, 1, 2, 1),
(12, 2, 2, 2),
(13, 3, 2, 4),
(14, 4, 2, 4),
(15, 5, 2, 1),
(16, 1, 5, 5),
(17, 2, 5, 5),
(18, 3, 5, 5),
(19, 5, 5, 5),
(20, 4, 5, 5),
(21, 6, 5, 5),
(22, 7, 5, 5),
(23, 16, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `idRole` int(10) NOT NULL,
  `nameRole` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idRole`, `nameRole`) VALUES
(1, 'Unauthorised'),
(2, 'Authorised'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `idSlider` int(10) NOT NULL,
  `subHeading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mainHeading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postHeading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `srcImgSlider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extImgSlider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `altImgSlider` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`idSlider`, `subHeading`, `mainHeading`, `postHeading`, `srcImgSlider`, `extImgSlider`, `altImgSlider`) VALUES
(1, 'Welcome', 'We cooked your desired Pizza Recipe', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', '', '', ''),
(2, 'Delicious', 'Italian Cuizine', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', 'bg_1', 'png', 'Italian Cuizine'),
(3, 'Crunchy', 'Italian Pizza', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', 'bg_2', 'png', 'Italian Pizza');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `idSocial` int(100) NOT NULL,
  `nameSocial` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hrefSocial` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `iconSocial` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `visibleSocial` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`idSocial`, `nameSocial`, `hrefSocial`, `iconSocial`, `visibleSocial`) VALUES
(1, 'Facebook', 'facebook.com', 'facebook', 1),
(2, 'Instagram', 'instagram.com', 'instagram', 1),
(3, 'Twitter', 'twitter.com', 'twitter', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int(10) NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idRole` int(10) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `firstName`, `lastName`, `password`, `email`, `gender`, `address`, `idRole`, `status`, `banned`) VALUES
(2, 'Pera', 'Peric', '68cb6aa94e0b567ebf9c8d305688a850', 'pera@peric.com', 'male', 'Perina 123', 3, 1, 0),
(3, 'Mika', 'Mikic', '30a620b46a591e95397a269a1f8fc403', 'mika@mikic.com', 'male', 'Mikina 12', 0, 0, 0),
(5, 'Bojan', 'Stojkovic', '5c1adc0b439fb817daffd015f08b4ce7', 'bojan.stojkovic.29.19@ict.edu.rs', 'male', 'Admin 12345tacka', 3, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`idAbout`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`idAuthor`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`idBook`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idContact`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`idCounter`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`idInfo`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`),
  ADD UNIQUE KEY `srcImgMenu` (`srcImgMenu`);

--
-- Indexes for table `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`idNav`);

--
-- Indexes for table `quicklinks`
--
ALTER TABLE `quicklinks`
  ADD PRIMARY KEY (`idLinks`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`idRating`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRole`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`idSlider`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`idSocial`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `idAbout` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `idAuthor` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `idBook` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `idContact` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `idCounter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `idInfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nav`
--
ALTER TABLE `nav`
  MODIFY `idNav` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quicklinks`
--
ALTER TABLE `quicklinks`
  MODIFY `idLinks` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `idRating` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `idRole` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `idSlider` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `idSocial` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
