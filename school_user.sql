-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Paź 2017, 09:49
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `table_schools`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `school_user`
--

CREATE TABLE `school_user` (
  `id` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `school` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `school_user`
--

INSERT INTO `school_user` (`id`, `user`, `mail`, `school`) VALUES
(1, 'Chris Bohn', 'ch.borm@review.com', 'International Community School<br>'),
(2, 'David Clark', 'd.clark@stay.com', 'International Community School<br>'),
(3, 'Susan Torkel', 's.torkel@free.com', 'Halcyon London International School<br>'),
(4, 'Bob Burney', 'b.burney@gmail.com', 'Halcyon London International School<br>'),
(5, 'Alice Andrews', 'a.andrews@gmail.com', 'Cookery School at Little Portland Street<br>London School of Economics<br>');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `school_user`
--
ALTER TABLE `school_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `school_user`
--
ALTER TABLE `school_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
