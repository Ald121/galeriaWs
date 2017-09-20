-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.4.3-beta-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema galeria
--

CREATE DATABASE IF NOT EXISTS galeria;
USE galeria;

--
-- Definition of table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `idcategorias` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcategorias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorias`
--

/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;


--
-- Definition of table `colores`
--

DROP TABLE IF EXISTS `colores`;
CREATE TABLE `colores` (
  `idcolores` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcolores`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colores`
--

/*!40000 ALTER TABLE `colores` DISABLE KEYS */;
/*!40000 ALTER TABLE `colores` ENABLE KEYS */;


--
-- Definition of table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `idpictures` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `src` varchar(45) NOT NULL,
  `status` varchar(10) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category` varchar(45) NOT NULL,
  PRIMARY KEY (`idpictures`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` (`idpictures`,`src`,`status`,`createAt`,`category`) VALUES 
 (61,'galeria/1505072686.jpg','A','2017-09-10 14:44:46',''),
 (62,'galeria/1505072700.jpg','I','2017-09-10 14:46:26',''),
 (63,'galeria/1505072701.jpg','A','2017-09-10 14:45:01',''),
 (64,'galeria/1505072702.jpg','I','2017-09-10 14:55:17',''),
 (65,'galeria/1505072704.jpg','A','2017-09-10 14:45:04',''),
 (66,'galeria/1505072706.jpg','A','2017-09-10 14:45:06',''),
 (67,'galeria/1505072708.jpg','I','2017-09-10 14:55:38',''),
 (68,'galeria/1505072709.jpg','I','2017-09-10 14:46:21',''),
 (69,'galeria/1505072710.jpg','A','2017-09-10 14:45:10',''),
 (70,'galeria/1505072712.jpg','A','2017-09-10 14:45:12',''),
 (71,'galeria/1505072713.jpg','A','2017-09-10 14:45:13',''),
 (72,'galeria/1505072714.jpg','A','2017-09-10 14:45:15',''),
 (73,'galeria/1505072716.jpg','A','2017-09-19 00:14:03','Corporativas'),
 (74,'galeria/1505072717.jpg','I','2017-09-19 00:14:03','Corporativas'),
 (75,'galeria/1505072719.jpg','I','2017-09-19 00:14:03','Corporativas'),
 (76,'galeria/1505072720.jpg','I','2017-09-19 00:14:03','Corporativas'),
 (77,'galeria/1505072721.jpg','I','2017-09-19 00:14:03','Corporativas'),
 (78,'galeria/1505072723.jpg','I','2017-09-19 00:14:03','Corporativas'),
 (79,'galeria/1505072724.jpg','I','2017-09-19 00:14:03','Corporativas'),
 (80,'galeria/1505072726.jpg','I','2017-09-19 00:14:03','Corporativas'),
 (81,'galeria/1505072727.jpg','A','2017-09-19 00:14:03','Corporativas'),
 (82,'galeria/1505072729.jpg','A','2017-09-19 00:14:03','Corporativas'),
 (83,'galeria/1505073455.jpg','A','2017-09-19 00:14:04','Corporativas'),
 (84,'galeria/1505073506.jpg','A','2017-09-19 00:14:04','Corporativas'),
 (85,'galeria/1505797205.jpg','I','2017-09-19 00:15:26','Corporativas'),
 (86,'galeria/1505797298.jpg','I','2017-09-19 00:15:38','Corporativas'),
 (87,'galeria/1505797373.jpg','I','2017-09-19 00:15:33','Corporativas');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;


--
-- Definition of table `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `idproductos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `precio` double NOT NULL,
  `status` varchar(1) NOT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inSlider` tinyint(1) NOT NULL,
  `destacar` tinyint(1) NOT NULL,
  PRIMARY KEY (`idproductos`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos`
--

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`idproductos`,`nombre`,`description`,`precio`,`status`,`createat`,`inSlider`,`destacar`) VALUES 
 (1,'Prod A','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasdasdasdascvrtgbrtbrtb',9.99,'I','2017-09-11 22:41:40',0,0),
 (8,'asdasd','ghjfghj',456.46,'I','2017-09-11 22:40:12',0,0),
 (9,'ssasd','uikk',9.99,'I','2017-09-11 22:41:22',0,0),
 (10,'fghfgh','dfgdfgdfg',9.99,'I','2017-09-11 22:40:34',0,0),
 (11,'prod','asdadasdasd',9.99,'I','2017-09-11 22:42:41',0,0),
 (12,'prod 2','asdasdasd',789.78,'I','2017-09-11 22:58:28',0,0),
 (13,'producto 1','asdasdasd',898.79,'I','2017-09-11 23:34:25',0,0),
 (14,'adad','sdadasd',565.67,'I','2017-09-11 23:34:15',0,0),
 (15,'adad','sdadasd',565.67,'I','2017-09-11 23:28:53',0,0),
 (16,'sdt5','asdasd',345.34,'I','2017-09-11 23:34:30',0,0),
 (17,'sdt5','asdasd',345.34,'I','2017-09-11 23:28:58',0,0),
 (18,'prod 3','2222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222',10.21,'I','2017-09-11 23:34:20',0,0),
 (19,'Blusa','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',22,'I','2017-09-18 22:21:18',0,0),
 (20,'adasd','asdasd',234.23,'I','2017-09-18 22:21:13',0,0),
 (21,'blusa mdf','color blanco ffss',9.66,'I','2017-09-19 21:41:29',0,0),
 (22,'Producto 1','BLUSAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA',9.66,'A','2017-09-19 22:17:49',1,1),
 (23,'Producto 2','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',20,'A','2017-09-19 22:22:33',1,1),
 (24,'Producto 3','vvvvvvvvvvvvvvvvvvvvvvvasdvasdvasdvasdvasdvasdv',99.99,'A','2017-09-19 22:26:41',0,1),
 (25,'a777777741632','asdaaaaaaaaaaaaaaaaaaaaaasdasd',99.99,'A','2017-09-19 22:38:29',0,1),
 (26,'Prod5','adasdasdasd',12.31,'A','2017-09-19 22:44:35',1,0);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;


--
-- Definition of table `productos_categorias`
--

DROP TABLE IF EXISTS `productos_categorias`;
CREATE TABLE `productos_categorias` (
  `idproductos_categorias` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproductos` int(10) unsigned NOT NULL,
  `idcategorias` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idproductos_categorias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos_categorias`
--

/*!40000 ALTER TABLE `productos_categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos_categorias` ENABLE KEYS */;


--
-- Definition of table `productos_colores`
--

DROP TABLE IF EXISTS `productos_colores`;
CREATE TABLE `productos_colores` (
  `idproductos_colores` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproductos` int(10) unsigned NOT NULL,
  `idcolores` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idproductos_colores`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos_colores`
--

/*!40000 ALTER TABLE `productos_colores` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos_colores` ENABLE KEYS */;


--
-- Definition of table `productos_imagenes`
--

DROP TABLE IF EXISTS `productos_imagenes`;
CREATE TABLE `productos_imagenes` (
  `idproductos_imagenes` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(500) NOT NULL,
  `idproductos` int(10) unsigned NOT NULL,
  `status` varchar(1) NOT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `default` tinyint(1) NOT NULL,
  PRIMARY KEY (`idproductos_imagenes`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos_imagenes`
--

/*!40000 ALTER TABLE `productos_imagenes` DISABLE KEYS */;
INSERT INTO `productos_imagenes` (`idproductos_imagenes`,`url`,`idproductos`,`status`,`createat`,`default`) VALUES 
 (1,'blusa2.png',1,'I','2017-09-11 22:41:40',1),
 (3,'1505098028.jpg',8,'I','2017-09-11 22:40:12',1),
 (4,'1505101364.jpg',9,'I','2017-09-11 22:41:21',0),
 (5,'1505101365.jpg',9,'I','2017-09-11 22:41:22',1),
 (6,'1505101434.jpg',10,'I','2017-09-11 22:40:34',1),
 (7,'1505101436.jpg',10,'I','2017-09-11 22:40:34',0),
 (8,'1505187733.jpg',11,'I','2017-09-11 22:42:41',1),
 (9,'1505187755.jpg',12,'I','2017-09-11 22:58:28',1),
 (10,'1505189740.jpg',13,'I','2017-09-11 23:34:25',1),
 (11,'1505190429.jpg',14,'I','2017-09-11 23:34:15',1),
 (12,'1505190448.jpg',16,'I','2017-09-11 23:34:30',1),
 (13,'1505190562.jpg',18,'I','2017-09-11 23:34:20',1),
 (14,'1505190919.jpg',19,'I','2017-09-18 22:21:18',1),
 (15,'1505191047.jpg',20,'I','2017-09-18 22:21:13',1),
 (16,'1505792149.jpg',21,'I','2017-09-19 21:41:29',1),
 (17,'1505877470.jpg',22,'A','2017-09-19 22:17:51',1),
 (18,'1505877472.jpg',22,'A','2017-09-19 22:17:52',0),
 (19,'1505877755.jpg',23,'A','2017-09-19 22:22:35',0),
 (20,'1505877756.jpg',23,'A','2017-09-19 22:22:36',1),
 (21,'1505878002.jpg',24,'A','2017-09-19 22:26:42',1),
 (22,'1505878003.jpg',24,'A','2017-09-19 22:26:44',0),
 (23,'1505878005.jpg',24,'A','2017-09-19 22:26:45',0),
 (24,'1505878006.jpg',24,'A','2017-09-19 22:26:46',0),
 (25,'1505878710.jpg',25,'A','2017-09-19 22:38:30',1),
 (26,'1505879076.jpg',26,'A','2017-09-19 22:44:36',1);
/*!40000 ALTER TABLE `productos_imagenes` ENABLE KEYS */;


--
-- Definition of table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider` (
  `idslider` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(500) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `createat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idslider`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;


--
-- Definition of table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(45) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `userType` varchar(10) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(5) NOT NULL DEFAULT 'A',
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `activationCode` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`,`nick`,`pass`,`userType`,`createAt`,`status`,`nombres`,`apellidos`,`email`,`activationCode`) VALUES 
 (1,'root','$2y$10$GGL/v/ranANouRUwzQdhQusFlfPgzcxmEm12r5vVv7YeD89OLoQ1K','ADMIN','2017-08-15 22:14:18','A','Alex','G','fallsouls@hotmail.com','');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
