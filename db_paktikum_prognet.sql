/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.14-MariaDB : Database - data_mahasiswa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`data_mahasiswa` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `data_mahasiswa`;

/*Table structure for table `tb_mahasiswa` */

DROP TABLE IF EXISTS `tb_mahasiswa`;

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `nim` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat` varchar(30) NOT NULL,
  `ttl` date NOT NULL,
  `agama` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `hobby` varchar(30) NOT NULL,
  PRIMARY KEY (`id_mahasiswa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_mahasiswa` */

insert  into `tb_mahasiswa`(`id_mahasiswa`,`nim`,`nama`,`jenis_kelamin`,`tempat`,`ttl`,`agama`,`alamat`,`hobby`) values 
(1,1905551069,'BAGAS GUSTAMA','laki-laki','Jakarta','2021-02-28','Islam','ewewewew','wewe'),
(2,1905551069,'BAGAS GUSTAMA','laki-laki','Jakarta','2021-02-28','Islam','ewewewew','wewe'),
(3,1905551069,'BAGAS GUSTAMA','laki-laki','Jakarta','2021-02-28','Islam','ewewewew','wewe');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
