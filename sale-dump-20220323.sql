-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: sale
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gubun`
--

DROP TABLE IF EXISTS `gubun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gubun` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호',
  `name` varchar(20) DEFAULT NULL COMMENT '구분명',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='구분정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gubun`
--

LOCK TABLES `gubun` WRITE;
/*!40000 ALTER TABLE `gubun` DISABLE KEYS */;
INSERT INTO `gubun` VALUES (2,'과자'),(3,'라면'),(4,'맥주'),(5,'야채'),(6,'음료'),(7,'소주'),(9,'영양제'),(10,'빵'),(11,'냉동식품'),(12,'생활용품'),(13,'조각케잌');
/*!40000 ALTER TABLE `gubun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jangbu`
--

DROP TABLE IF EXISTS `jangbu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jangbu` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호',
  `io` tinyint(4) DEFAULT NULL COMMENT '매입/매출',
  `writeday` date DEFAULT NULL COMMENT '날짜',
  `product_no` int(11) DEFAULT NULL COMMENT '제품_번호',
  `price` int(11) DEFAULT NULL COMMENT '단가',
  `numi` int(11) DEFAULT NULL COMMENT '매입수량',
  `numo` int(11) DEFAULT NULL COMMENT '매출수량',
  `prices` int(11) DEFAULT NULL COMMENT '금액',
  `bigo` varchar(20) DEFAULT NULL COMMENT '비고',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COMMENT='판매장부';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jangbu`
--

LOCK TABLES `jangbu` WRITE;
/*!40000 ALTER TABLE `jangbu` DISABLE KEYS */;
INSERT INTO `jangbu` VALUES (1,0,'2022-03-19',7,1000,2,0,2000,''),(2,0,'2022-03-19',6,1000,2,0,2000,''),(3,0,'2022-03-20',3,1000,3,0,3000,''),(5,1,'2022-03-21',7,1000,0,2,2000,''),(6,1,'2022-03-21',5,1000,0,1,1000,''),(7,1,'2022-03-21',3,1000,0,1,1000,''),(8,1,'2022-03-21',1,1000,0,2,2000,''),(9,0,'2022-03-21',9,950,2,0,1900,''),(10,0,'2022-03-21',8,900,8,0,7200,''),(11,1,'2022-03-21',9,950,0,3,2850,''),(12,1,'2022-03-21',8,900,0,3,2700,''),(13,0,'2022-03-21',9,950,8,0,7600,'');
/*!40000 ALTER TABLE `jangbu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호',
  `uid` varchar(20) NOT NULL COMMENT '아이디',
  `pwd` varchar(20) NOT NULL COMMENT '암호',
  `name` varchar(20) NOT NULL COMMENT '이름',
  `tel` varchar(20) DEFAULT NULL COMMENT '전화',
  `rank` tinyint(4) DEFAULT NULL COMMENT '등급',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COMMENT='회원정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,'admin','1234','관리자','01012341234',1),(6,'id6','1234','고은이','01066752295',0),(7,'id7','1234','이창기','01094867737',0),(8,'id8','1234','강주석','01097175378',0),(9,'id9','1234','김상준','01073282001',0),(10,'id10','1234','김강현','01090696074',0),(11,'id11','1234','양구민','01089906973',0),(12,'id12','1234','박철완','01064517732',0),(13,'id13','1234','이조규','01064725207',0),(14,'id14','1234','김안기','01047835553',0),(15,'id15','1234','황전하','01098549069',0),(16,'id16','1234','원정현','01097953309',0),(17,'id17','1234','김성현','01071564586',0),(18,'id18','1234','윤고영','01046674402',0),(19,'id19','1234','손양진','01093091586',0),(20,'id20','1234','서천범','01029609537',0),(21,'id212','12345','최미은','01095910011',0),(22,'id22','1234','현자석','01045525203',0),(23,'id23','1234','고연진','01039039565',0),(24,'id24','1234','임양진','01047441735',0),(25,'id25','1234','김진형','01029752059',0),(26,'id26','1234','강명한','01017367547',0),(27,'id27','1234','김동진','01032374556',0),(28,'id28','1234','박지영','01032583779',0),(29,'id29','1234','이양성','01022293628',0),(30,'id30','1234','박자형','01035604903',0),(31,'id31','1234','김다우','01029114044',0),(32,'id32','1234','임전철','01030126920',0),(33,'id33','1234','최구선','01023734840',0),(34,'id34','1234','정도솔','01098643720',0),(35,'id35','1234','이영석','01065956653',0),(36,'id36','1234','조경현','01072265535',0),(37,'id37','1234','김만석','01034670483',0),(38,'id38','1234','박만석','01044184218',0),(39,'id39','1234','김현진','01024095317',0),(40,'id40','1234','박솔희','01075709030',0),(41,'id41','1234','권하미','01024517990',0),(42,'id42','1234','이성민','01036524847',0),(43,'id43','1234','장도운','01035337719',0),(44,'id44','1234','고일남','01096943617',0),(45,'id45','1234','황지우','01091057558',0),(46,'id46','1234','정기근','01025764748',0),(47,'id47','1234','양자승','01080972732',0),(48,'id48','1234','윤성현','01030685978',0),(49,'id49','1234','최기문','01027595634',0),(50,'id50','1234','오시헌','01020203572',0),(51,'kbg','1234','김부각','01011223344',0);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호',
  `gubun_no` int(11) DEFAULT NULL COMMENT '구분종류',
  `name` varchar(50) DEFAULT NULL COMMENT '제품명',
  `price` int(11) DEFAULT NULL COMMENT '단가',
  `jaego` int(11) DEFAULT NULL COMMENT '재고',
  `pic` varchar(255) DEFAULT NULL COMMENT '사진',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COMMENT='제품정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,6,'코카콜라',1000,-2,''),(2,6,'사이다',1000,0,''),(3,6,'사과주스',1000,2,''),(4,6,'배주스',1000,0,''),(5,6,'몬스터',1000,-1,''),(6,6,'바나나우유',1000,2,'banana_mlik.png'),(7,6,'딸기우유',1000,0,'stroberry_milk.png'),(8,3,'신라면',900,5,NULL),(9,3,'너구리',950,7,'nuguri.png');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `product_no` int(11) DEFAULT NULL,
  `jaego` int(11) DEFAULT 0,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp`
--

LOCK TABLES `temp` WRITE;
/*!40000 ALTER TABLE `temp` DISABLE KEYS */;
INSERT INTO `temp` VALUES (1,1,-2),(2,3,2),(3,5,-1),(4,6,2),(5,7,0),(6,8,5),(7,9,7);
/*!40000 ALTER TABLE `temp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-23 16:15:26
