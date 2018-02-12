-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 12, 2018 alle 22:37
-- Versione del server: 10.1.26-MariaDB
-- Versione PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `image_viewer`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `images`
--

CREATE TABLE `images` (
  `user` varchar(200) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `images`
--

INSERT INTO `images` (`user`, `image`) VALUES
('ale', 'DSCN0010.jpg'),
('ale', '20160825_144002.jpg'),
('alessandro', 'DSCN0010.jpg'),
('alessandro', '20160825_144002.jpg'),
('alessandro', 'Af80cq7CQAEi6Rz.jpg-large.jpg'),
('utente', 'DSCN0010.jpg'),
('alessandro', '20160825_144002.jpg'),
('alessandro', 'DSCN0010.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `user` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`user`, `password`) VALUES
('alessandro', 'alessandro'),
('utente', 'utente'),
('alessandro2', 'alessandro'),
('alessandro3', 'alessandro'),
('alessandro', 'alessandro'),
('alessandro', 'alessandro'),
('alessandro', 'alessandro'),
('alessandro', 'alessandro'),
('alessandro', 'alessandro'),
('alessandro', 'alessandro'),
('alessandro', 'alessandro'),
('alessandro', 'alessandro'),
('alessandro', 'alessandro'),
('alessandro', 'alessandro'),
('ale', 'ale'),
('ale2', 'ale');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
