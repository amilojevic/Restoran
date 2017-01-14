-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 10:03 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `idKontaktPoruke` int(11) NOT NULL,
  `idKorisnika` int(10) NOT NULL,
  `ime` varchar(20) COLLATE utf32_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf32_unicode_ci NOT NULL,
  `subjekat` varchar(20) COLLATE utf32_unicode_ci NOT NULL,
  `tekst` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`idKontaktPoruke`, `idKorisnika`, `ime`, `email`, `subjekat`, `tekst`) VALUES
(1, 1, 'Admin', 'Admin@admin.com', 'Admin sam ja', 'Ovo je prva poruka koja se salje. U nadi da ce odmah proraditi'),
(2, 99, 'Gost', 'Gost@gost.gost', 'Gost sam ja', 'Ovo je druga poruka kao gost. U nadi da ce proraditi :D'),
(3, 99, 'Gost', 'Gost@gost.gost', 'Gost sam ja', 'Radi :D'),
(4, 99, 'Gost', 'Gost@gost.gost', 'Gost sam ja', 'Radi :D');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `idRezervacije` int(11) NOT NULL,
  `idKorisnika` int(10) NOT NULL,
  `ime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vrijeme` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`idRezervacije`, `idKorisnika`, `ime`, `prezime`, `email`, `vrijeme`) VALUES
(1, 1, 'Blabla1', 'gdfgfdg', 'fsdfsdf@fsdff', '30 Januar'),
(2, 1, 'Andrej', 'gdfgfdg', 'Andklrjejkdfsnkf@diasb.com', '31 Januar'),
(3, 1, 'Dado', 'Andrej11', 'andrej@gmail.com', '13 Januar'),
(4, 1, 'Dado', 'Kjklcfjsd', 'cjnkn@xuiasn.com', '14 Januar'),
(5, 99, 'Andrej', 'Milojevic', 'Andklrjejkdfsnkf@diasb.com', '11 Januar'),
(6, 99, 'dsfdfsd', 'Andrej11', 'fsdfsdf@fsdff', '9 Januar'),
(7, 99, 'blabla', 'bla', 'Andklrjejkdfsnkf@diasb.com', '5 Januar'),
(8, 99, 'Andrej8', 'fsdfsdf', 'Andklrjejkdfsnkf@diasb.com', '30 Januar'),
(9, 99, 'Andrej8', 'fsdfsdf', 'bla@bka.com', '30 Januar'),
(10, 99, 'Dado', 'Kjklcfjsd', 'bla@bka.com', '20 Januar'),
(11, 99, 'dsfdfsd', 'fsdfsdf', 'fsdfsdf@fsdff', '30 Januar'),
(12, 99, 'Blabla1', 'fsdfsdf', 'dasnkfjo@fjnsdf.com', '23 Januar'),
(13, 99, 'Andrej', 'Andrej11', 'andrej@gmail.com', '14 Februar'),
(43, 1, 'Philip', 'frederick', 'philipF@gmail.com', 'Decembar 13'),
(44, 1, 'Frederik', 'Mulan', 'asassa@f.com', 'Januar 15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `admin`) VALUES
(1, 'admin', 'admin', 1),
(2, 'andrej', 'admin', 1),
(99, 'guest', 'guest', 0),
(100, 'dado', 'dado', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`idKontaktPoruke`),
  ADD KEY `Index` (`idKorisnika`) USING BTREE;

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`idRezervacije`),
  ADD KEY `idKorisnika` (`idKorisnika`) USING BTREE,
  ADD KEY `ime` (`ime`) USING BTREE,
  ADD KEY `email` (`email`) USING BTREE,
  ADD KEY `vrijeme` (`vrijeme`) USING BTREE,
  ADD KEY `prezime` (`prezime`) USING BTREE,
  ADD KEY `Index` (`idKorisnika`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `idKontaktPoruke` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `idRezervacije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD CONSTRAINT `KoJeNapisaoKontaktPoruku` FOREIGN KEY (`idKorisnika`) REFERENCES `user` (`id`);

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `rezervacija_ibfk_1` FOREIGN KEY (`idKorisnika`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
