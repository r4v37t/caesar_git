-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2015 at 07:31 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `caesar`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `target` varchar(50) NOT NULL,
  PRIMARY KEY (`follow_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`follow_id`, `user`, `target`) VALUES
(2, 'user2@mail.com', 'user@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `komentar_id` int(11) NOT NULL AUTO_INCREMENT,
  `track_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `isi` varchar(255) NOT NULL,
  PRIMARY KEY (`komentar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`komentar_id`, `track_id`, `user`, `isi`) VALUES
(1, 1, 'user@mail.com', 'coba'),
(2, 1, 'user@mail.com', 'coba kembali'),
(3, 1, 'user2@mail.com', 'bagus');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE IF NOT EXISTS `konten` (
  `konten_id` int(11) NOT NULL AUTO_INCREMENT,
  `isi` text NOT NULL,
  PRIMARY KEY (`konten_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`konten_id`, `isi`) VALUES
(1, 'ini peraturan coba<br>'),
(2, 'ini tutorial lagi<br>'),
(3, 'ini about us saja<br>');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE IF NOT EXISTS `track` (
  `track_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `desk` text NOT NULL,
  `sampul` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `putar` int(11) NOT NULL,
  `suka` int(11) NOT NULL,
  PRIMARY KEY (`track_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`track_id`, `user`, `judul`, `desk`, `sampul`, `file`, `tgl`, `putar`, `suka`) VALUES
(1, 'user@mail.com', 'Lagu Pertama', 'sasadsadsa', 'assets/track/sampul/AZCS-1041.jpg', 'assets/track/file/08. Decision.mp3', '2015-06-17', 3, 2),
(2, 'user2@mail.com', 'Heartache', 'One Ok Rock', 'assets/track/sampul/AZCS-1041.jpg', 'assets/track/file/06. Heartache.mp3', '2015-06-17', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `akses` varchar(5) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `nama`, `foto`, `akses`) VALUES
('admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'assets/img/new.jpg', 'admin'),
('user2@mail.com', '202cb962ac59075b964b07152d234b70', 'user2', 'assets/img/new.jpg', 'user'),
('user@mail.com', '202cb962ac59075b964b07152d234b70', 'Pengguna Pertama', 'assets/profil/default.png', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
