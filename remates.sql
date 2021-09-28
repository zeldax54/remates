/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.11-MariaDB : Database - remates
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`remates` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `remates`;

/*Table structure for table `cabana` */

DROP TABLE IF EXISTS `cabana`;

CREATE TABLE `cabana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `logos` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `gallery` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `videos` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desactivado` tinyint(1) NOT NULL DEFAULT 0,
  `afiche` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condpreofertas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catalogdescarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechainicio` datetime NOT NULL,
  `fechacierre` datetime NOT NULL,
  `info` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicionventa` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlsegment` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cabana` */

insert  into `cabana`(`id`,`nombre`,`descripcion`,`logos`,`gallery`,`videos`,`desactivado`,`afiche`,`condpreofertas`,`catalogdescarga`,`fechainicio`,`fechacierre`,`info`,`condicionventa`,`urlsegment`) values 
(1,'Cabana 1','<p><strong>esta </strong>es una <span style=\"color:#e74c3c\">cabana </span>cabana</p>','a:3:{i:0;s:52:\"cropped/ec4e30997efcb75f7a3d870e80d06ae905451273.png\";i:1;s:52:\"cropped/0b5fbbce8c003e626d9642737438043292d1397a.png\";i:2;s:52:\"cropped/9f753c51fa41aa9bdfdf4f288fd133727fed5c6b.png\";}','a:2:{i:0;s:52:\"cropped/d2e2a441eeaa5f47610dbb599db3f0d238603ecf.png\";i:1;s:52:\"cropped/2fa3f7c5c328fa482af8d2447d467b7898daa7f6.png\";}','_DwmKtbVFJ4;_DwmKtbVFJ4;_DwmKtbVFJ4;_DwmKtbVFJ4',0,NULL,NULL,NULL,'2020-12-31 22:35:00','2021-01-22 22:35:00','Preoferta','condicion de vebnta','cabana-1'),
(2,'Cabana 2','<pre>\r\n<span style=\"font-size:16px\"><span style=\"color:#e74c3c\"> asdasdasd </span><span style=\"color:#c0392b\">asdasda  </span><span style=\"color:#16a085\">asdasd </span></span></pre>','a:1:{i:0;s:52:\"cropped/947ab4d7366eae79301b2603e4a89661e3ae7f22.png\";}','a:1:{i:0;s:52:\"cropped/57f48729f06c542f944c3f73927e64ca6ef08e6d.png\";}','asdasdasd;asdasd;asdasd',0,NULL,NULL,NULL,'2021-01-07 22:34:00','2021-02-05 22:35:00','Preoferta','condicion de vebnta','cabana-2'),
(3,'Antiguas Estancias Don Roberto S.A.','<p><strong>Antiguas Estancias Don Roberto S.A.,&nbsp;</strong>es una empresa agropecuaria con m&aacute;s de un siglo de actividad y en constante evoluci&oacute;n.&nbsp;<strong>Con mucha fortaleza y vocaci&oacute;n en Ganader&iacute;a, tiene presencia en los mejores mercados de carnes del pa&iacute;s y tambi&eacute;n del mundo.&nbsp;</strong>La empresa tiene como prioridad lograr la estabilidad de sus sistemas productivos en el tiempo, apuntando siempre al largo plazo, y teniendo como pilares el respeto a las ventajas y limitaciones de cada ambiente y la incorporaci&oacute;n de los mejores recursos humanos y tecnol&oacute;gicos disponibles.</p>\r\n\r\n<p>Es miembro hist&oacute;rico de la&nbsp;<span style=\"color:#e74c3c\"><strong>Sociedad Rural Argentina</strong></span>&nbsp;y socio activo en las&nbsp;<strong><span style=\"color:#16a085\">Asociaciones de Criadores de las razas Hereford, Angus, Sanga y Braford</span>.&nbsp;</strong>Adem&aacute;s integra<strong>&nbsp;&laquo;Carne Hereford&raquo;&nbsp;</strong>y es socio activo de&nbsp;<strong>AAPRESID.</strong></p>\r\n\r\n<p><strong>Don Roberto:</strong>&nbsp;16.000 has. en el sur de San Luis (V. M.)<br />\r\n<strong>Los Trapales:</strong>&nbsp;34.000 has. en el sur de San Luis (V. M.)<br />\r\n<strong>El Centenario:</strong>&nbsp;54.000 has. en el sur de San Luis (V. M.)<br />\r\n<strong>El Alegre:</strong>&nbsp;10.000 has. en el sur de C&oacute;rdoba (Villa Valeria)<br />\r\n<strong>Santa Rita:</strong>&nbsp;14.400 has. en el oeste de Buenos Aires (Saladillo)</p>\r\n\r\n<p>En Saladillo,&nbsp;<strong>Caba&ntilde;a y Centro <span style=\"color:#2980b9\">Biotecnol&oacute;gico </span>Santa Rita</strong>&nbsp;cuenta con lo mejor de la gen&eacute;tica actual de las razas&nbsp;<strong>Polled Hereford; Aberdeen Angus; Tuli y Braford</strong>, de las que se pueden dar garant&iacute;as de adaptabilidad y productividad, ya que la caba&ntilde;a es la base gen&eacute;tica de sus rodeos. Entre los establecimientos&nbsp;<strong>Santa Rita, Los Trapales y El Centenario</strong>, poseen un rodeo que supera los&nbsp;<strong>22.000 vientres</strong>&nbsp;en producci&oacute;n, sobre pasturas naturales, digitaria y pasto llor&oacute;n. La recr&iacute;a se desarrolla a base pastoril m&aacute;s suplementaci&oacute;n, principalmente en&nbsp;<strong>Don Roberto</strong>, con grandes superficies de alfalfa y verdeos de invierno. Para la terminaci&oacute;n cuenta con corrales de engorde para&nbsp;<strong>5.000 cabezas</strong>, todas de marca l&iacute;quida, lo que les permite lograr trazabilidad, calidad y estabilidad productiva.</p>','a:2:{i:4;s:52:\"cropped/4f76523df97b915edcae514b99af38de0e74e44b.png\";i:1;s:52:\"cropped/fd6d5c2056fb0cab15e670a56b5e059630f1fa66.png\";}','a:4:{i:0;s:52:\"cropped/2845569ed8d29120f3e5ff621bf778176472ecf5.jpg\";i:1;s:52:\"cropped/e77e5e5214bd1d041ab20591e1ad5f87de98e159.jpg\";i:2;s:52:\"cropped/d697300818bbe92d8d90aea674b344c23fe3fece.jpg\";i:3;s:53:\"cropped/e81d9394d8d08e18f43330e44f083c03a895e2e1.jpeg\";}','u6yBH5jfUVU;u6yBH5jfUVU;u6yBH5jfUVU',0,'http://ganaderadelsursrl.com.ar/calendario/15o-venta-anual-de-don-roberto/#.YASErehKiHs','https://drive.google.com/file/d/18BqqeY9-nbFEQGIN6QNecvFbs5f-645s/view','https://drive.google.com/file/d/1VLd6_RGdDtn-Bd68rgikolZgLzhSk8U3/view','2021-01-06 20:12:00','2022-07-01 20:12:00','Preoferta','condicion de vebnta','antiguas-estancias-don-roberto-s-a');

/*Table structure for table `cabana_entity` */

DROP TABLE IF EXISTS `cabana_entity`;

CREATE TABLE `cabana_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cabana_entity` */

insert  into `cabana_entity`(`id`,`nombre`,`descripcion`) values 
(1,'Antiguas estancias Don Roberto','esta es una cabana bla bla bla'),
(3,'Una cabaña mas','Una cabaña mas');

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `categoria` */

insert  into `categoria`(`id`,`nombre`) values 
(3,'Mi categoria'),
(4,'Nueva catego'),
(6,'Tres Catego'),
(7,'Cuarta Catego 4'),
(8,'asds2');

/*Table structure for table `doctrine_migration_versions` */

DROP TABLE IF EXISTS `doctrine_migration_versions`;

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `doctrine_migration_versions` */

insert  into `doctrine_migration_versions`(`version`,`executed_at`,`execution_time`) values 
('DoctrineMigrations\\Version20210113021616','2021-01-13 03:16:54',36),
('DoctrineMigrations\\Version20210113022740','2021-01-13 03:27:46',32),
('DoctrineMigrations\\Version20210113051332','2021-01-13 06:13:42',30),
('DoctrineMigrations\\Version20210113162126','2021-01-13 17:21:44',173),
('DoctrineMigrations\\Version20210113233739','2021-01-14 00:37:52',33),
('DoctrineMigrations\\Version20210114011232','2021-01-14 02:12:38',86),
('DoctrineMigrations\\Version20210114012009','2021-01-14 02:20:18',92),
('DoctrineMigrations\\Version20210114015415','2021-01-14 02:54:21',55),
('DoctrineMigrations\\Version20210114023502','2021-01-14 03:35:07',37),
('DoctrineMigrations\\Version20210114024122','2021-01-14 03:41:26',28),
('DoctrineMigrations\\Version20210115034036','2021-01-15 04:40:40',132),
('DoctrineMigrations\\Version20210116033440','2021-01-16 04:34:44',35),
('DoctrineMigrations\\Version20210116042329','2021-01-16 05:23:36',30),
('DoctrineMigrations\\Version20210117183653','2021-01-17 19:37:01',48),
('DoctrineMigrations\\Version20210117201928','2021-01-17 21:19:33',34),
('DoctrineMigrations\\Version20210121011157','2021-01-20 22:12:03',351),
('DoctrineMigrations\\Version20210121031204','2021-01-21 00:12:10',35),
('DoctrineMigrations\\Version20210122055859','2021-01-22 02:59:08',50),
('DoctrineMigrations\\Version20210123021028','2021-01-22 23:10:36',59),
('DoctrineMigrations\\Version20210123043258','2021-01-23 01:33:06',30),
('DoctrineMigrations\\Version20210925220124','2021-09-25 19:02:15',140),
('DoctrineMigrations\\Version20210925220749','2021-09-25 19:08:16',71);

/*Table structure for table `fos_user` */

DROP TABLE IF EXISTS `fos_user`;

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fos_user` */

insert  into `fos_user`(`id`,`username`,`username_canonical`,`email`,`email_canonical`,`enabled`,`salt`,`password`,`last_login`,`confirmation_token`,`password_requested_at`,`roles`) values 
(1,'admin','admin','admin@local.com','admin@local.com',1,'sXIUJfPU3rfdDaneCotU5B8Ud5mxhnTGg7Zbj//oYjU','$2y$13$Ded0SGj.dlMRF9M405KvjO4qBcK9IwYLP5YbJvYzSiaXNYskFP1gK','2021-09-25 16:21:39',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(3,'admin1','admin1','admin1@local.com','admin1@local.com',1,'43WG.N/UChN78gxhjoGPAnTFCS57pY/tbBu4KBJccA4','$2y$13$mJtdfYaoIQdUBZHF2V88eu5Ek3QCgh1T3wGe46uYZtcoo4iMfpOuG','2021-05-29 10:52:45',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(4,'asd','asd','asd@asd.com','asd@asd.com',1,'W9W8SIbMGwRH2ngULyZROD/uT9yZseWoYgDXY4fvEX0','$2y$13$PuRNXZCOB8cJmwiGgrVoNOMzRBpTsDECcJEq5W7t05fPy56jH1Cfm','2021-05-29 10:54:05',NULL,NULL,'a:0:{}');

/*Table structure for table `lote` */

DROP TABLE IF EXISTS `lote`;

CREATE TABLE `lote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incrementominimo` double NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `raza_id` int(11) DEFAULT NULL,
  `cabana_id` int(11) DEFAULT NULL,
  `desactivado` tinyint(1) NOT NULL DEFAULT 0,
  `cabanaentity_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_65B4329F3397707A` (`categoria_id`),
  KEY `IDX_65B4329F8CCBB6A9` (`raza_id`),
  KEY `IDX_65B4329F7CBFCDB1` (`cabana_id`),
  KEY `IDX_65B4329F13B1B6D3` (`cabanaentity_id`),
  CONSTRAINT `FK_65B4329F13B1B6D3` FOREIGN KEY (`cabanaentity_id`) REFERENCES `cabana_entity` (`id`),
  CONSTRAINT `FK_65B4329F3397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  CONSTRAINT `FK_65B4329F7CBFCDB1` FOREIGN KEY (`cabana_id`) REFERENCES `cabana` (`id`),
  CONSTRAINT `FK_65B4329F8CCBB6A9` FOREIGN KEY (`raza_id`) REFERENCES `razas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `lote` */

insert  into `lote`(`id`,`gallery`,`nombre`,`incrementominimo`,`categoria_id`,`raza_id`,`cabana_id`,`desactivado`,`cabanaentity_id`) values 
(1,'a:1:{i:0;s:52:\"cropped/aade45cdcece458f9cfc2836a9f089c82257f14a.png\";}','Lote 1',5000,6,2,2,0,NULL),
(2,'a:0:{}','Lote 2',0,7,NULL,NULL,0,NULL),
(3,'a:0:{}','Lote 2',0,NULL,NULL,NULL,0,NULL),
(4,'a:0:{}','Lote 1',0,NULL,NULL,NULL,0,NULL),
(5,'a:0:{}','Lote 1',0,NULL,NULL,NULL,0,NULL),
(7,'a:0:{}','Lote 1',0,NULL,NULL,NULL,0,NULL),
(8,'a:0:{}','Lote 2',0,NULL,NULL,NULL,0,NULL),
(9,'a:0:{}','Lote 1',0,NULL,NULL,NULL,0,NULL),
(10,'a:0:{}','Lote 1',0,NULL,NULL,NULL,0,NULL),
(11,'a:0:{}','Lote 2',0,NULL,NULL,NULL,0,NULL),
(12,'a:0:{}','Lote 2',0,NULL,NULL,NULL,0,NULL),
(13,'a:1:{i:0;s:52:\"cropped/18dedd3bd78a35db0d7cdb993f7f676ec0c0f8d8.png\";}','Lote 15',0,NULL,NULL,3,0,NULL),
(14,'a:1:{i:1;s:52:\"cropped/fcad6979c1b8a570a5502a0b36e85b048bbba2aa.png\";}','Lote 16',3000,7,2,3,0,NULL),
(15,'a:1:{i:0;s:52:\"cropped/ebb1dc5f79d35c6cf031dbf70a6cef4371187f79.png\";}','Lote 17',5000,4,2,3,0,NULL),
(16,'a:1:{i:0;s:52:\"cropped/37e91dfd8393ce531cb6ea317e3c0ce11c433686.png\";}','Lote 121212',2500,4,1,3,0,NULL),
(17,'a:1:{i:0;s:52:\"cropped/3b7fd1e1d512e237df80b136869b9d4b1e52aeca.png\";}','Lote 1212124',3444,7,2,3,0,1);

/*Table structure for table `oferta` */

DROP TABLE IF EXISTS `oferta`;

CREATE TABLE `oferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote_id` int(11) DEFAULT NULL,
  `toro_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dnicuit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `ofertado` double NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7479C8F2B172197C` (`lote_id`),
  KEY `IDX_7479C8F25BEDE11` (`toro_id`),
  CONSTRAINT `FK_7479C8F25BEDE11` FOREIGN KEY (`toro_id`) REFERENCES `toro` (`id`),
  CONSTRAINT `FK_7479C8F2B172197C` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oferta` */

insert  into `oferta`(`id`,`lote_id`,`toro_id`,`nombre`,`empresa`,`dnicuit`,`email`,`telefono`,`status`,`fecha`,`ofertado`,`token`) values 
(21,14,6,'Hector','217-Computer and information systems professionals','345345','zeldax54@gmail.com','01126890684','S','2021-01-22 21:47:13',45000,'3CAC5C3E-FCD5-4E45-96E7-BE4906F6A793'),
(22,14,6,'Patricio Godoy Lastraa','217-Computer and information systems professionals','456456','zeldax54@gmail.com','01126890684','S','2021-01-22 21:48:29',48000,'8B22B183-FD83-435C-9FC9-1656CFB9157D'),
(23,14,6,'Hector','217-Computer and information systems professionals','234234','zeldax54@gmail.com','01126890684',NULL,'2021-07-30 01:08:08',51000,'61F9884A-671A-4DE3-B64D-5F2BBCD2997B'),
(24,14,6,'Hector','217-Computer and information systems professionals','234234','zeldax54@gmail.com','01126890684',NULL,'2021-07-30 01:08:20',51000,'F60632CE-A6E9-4F79-8596-0CCD459C2938'),
(25,14,6,'Hector','217-Computer and information systems professionals','234234','zeldax54@gmail.com','01126890684',NULL,'2021-07-30 01:09:41',51000,'79E7270B-A99D-4B10-BBA6-9234329E3C20'),
(26,14,6,'Patricio Godoy Lastraa','217-Computer and information systems professionals','324234','zeldax54@gmail.com','01126890684','S','2021-08-03 23:22:49',51000,'B5446957-A895-4601-889A-90094E28EEC2'),
(27,14,6,'ghyj','217-Computer and information systems professionals','345345','zeldax54@gmail.com','01126890684','R','2021-08-03 23:31:47',54000,'3694613F-F1F3-4C56-9DE3-75A50103E35B'),
(28,14,6,'Patricio Godoy Lastraa','217-Computer and information systems professionals','234234','zeldax54@gmail.com','01126890684',NULL,'2021-08-08 12:33:10',57000,'94074D28-67BF-44FA-ADE7-184E7016A172'),
(29,14,6,'Patricio Godoy Lastraa','217-Computer and information systems professionals','234234','zeldax54@gmail.com','01126890684',NULL,'2021-08-08 12:41:35',57000,'EC78A8AD-4CEC-47D0-87C1-19601A4B9C9A'),
(30,14,6,'Patricio Godoy Lastraa','217-Computer and information systems professionals','234234','zeldax54@gmail.com','01126890684','R','2021-08-08 12:43:17',57000,'56119ACB-0F41-4062-8305-5EF0AE799ACD'),
(31,14,6,'Patricio Godoy Lastraa','217-Computer and information systems professionals','234234','zeldax54@gmail.com','01126890684','S','2021-08-08 12:47:09',57000,'2997E066-142E-40C1-B80E-125764493C1F'),
(32,14,6,'Patricio Godoy Lastraa','217-Computer and information systems professionals','45545','zeldax54@gmail.com','01126890684','S','2021-08-08 12:48:13',60000,'09A6A044-7D96-44EC-A177-97A481014BDA'),
(33,14,9,'Patricio Godoy Lastraa','217-Computer and information systems professionals','234234','zeldax54@gmail.com','01126890684','S','2021-08-08 13:06:05',20000,'3557F4E9-3693-4993-8A85-D29D1E7D5C04'),
(34,14,9,'Hector','217-Computer and information systems professionals','234','zeldax54@gmail.com','01126890684','A','2021-08-08 13:06:44',26000,'150FB0E8-EA1F-4C78-86A2-201C999D2DCD'),
(35,14,9,'Test','217-Computer and information systems professionals','23','zeldax54@gmail.com','01126890684','R','2021-08-08 13:07:27',29000,'6812BF0B-9459-43B3-90A0-F25A24B03BE9'),
(36,14,6,'Test','217-Computer and information systems professionals','23','zeldax54@gmail.com','01126890684','A','2021-08-08 13:33:41',63000,'352822BA-54ED-479F-867B-EDA46AFE8FB2'),
(37,14,6,'Patricio Godoy Lastraa','217-Computer and information systems professionals','564654654','zeldax54@gmail.com','01126890684',NULL,'2021-09-25 23:36:12',67000,'AC9ED0C5-ABC5-4BC4-9006-15EC2298FC49');

/*Table structure for table `razas` */

DROP TABLE IF EXISTS `razas`;

CREATE TABLE `razas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `razas` */

insert  into `razas`(`id`,`Nombre`) values 
(1,'Hereford'),
(2,'Angus');

/*Table structure for table `toro` */

DROP TABLE IF EXISTS `toro`;

CREATE TABLE `toro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `videos` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `lote_id` int(11) DEFAULT NULL,
  `preciobase` double NOT NULL,
  `oferta_actual` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_46960377B172197C` (`lote_id`),
  CONSTRAINT `FK_46960377B172197C` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `toro` */

insert  into `toro`(`id`,`nombre`,`info`,`videos`,`gallery`,`lote_id`,`preciobase`,`oferta_actual`) values 
(6,'Toro1','asdasd','SbHhaVmdEvc','a:3:{i:0;s:52:\"cropped/afbb6cee1de30a2f2071e1039d902055c7a207a4.png\";i:1;s:52:\"cropped/53e07016cd197d99c2dbf4fa39021691b82cfdac.png\";i:2;s:52:\"cropped/ac56d50bed7be88f3bb2c65d7eb43f085c5cc9be.png\";}',14,45000,63000),
(7,'Toro2','dfgdfgdfg','HgEj3fWCZ9A;HgEj3fWCZ9A','a:0:{}',17,50000,0),
(8,'Toro3','dfgdfgdfg','HgEj3fWCZ9A','a:0:{}',16,30000,0),
(9,'asdasd','asdasd','HgEj3fWCZ9A','a:1:{i:0;s:52:\"cropped/14503793cd5fd27554d7f1c2e521b64b248dfe9f.png\";}',14,20000,26000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
