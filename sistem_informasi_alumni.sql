-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.26-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table sistem_informasi_alumni.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` int(11) DEFAULT NULL,
  `nim` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `program_studi` varchar(255) NOT NULL,
  `jenjang_studi` varchar(255) NOT NULL,
  `tanggal_masuk` varchar(255) NOT NULL,
  `propinsi_asal` varchar(255) NOT NULL,
  `alamat_rumah` varchar(255) NOT NULL,
  `kode_pos` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `handphone` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table sistem_informasi_alumni.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `admin`, `nim`, `username`, `email`, `password`, `program_studi`, `jenjang_studi`, `tanggal_masuk`, `propinsi_asal`, `alamat_rumah`, `kode_pos`, `kota`, `nama_sekolah`, `tempat_lahir`, `agama`, `handphone`, `foto`, `status`) VALUES
	(1, 1, 1, 'admin', 'admin@email.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '', '', '', '', '', '', '', '', '', '', '', '', '');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
