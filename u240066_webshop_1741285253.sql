/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.20-MariaDB, for linux-systemd (x86_64)
--
-- Host: localhost    Database: u240066_webshop
-- ------------------------------------------------------
-- Server version	10.6.20-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'smartphones','Mobiele telefoons'),(2,'tablets','Tablets'),(3,'accessories','Accessories');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ipAddress` varchar(45) DEFAULT NULL,
  `userAgent` varchar(255) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT 'UTC',
  `emailVerified` tinyint(1) DEFAULT 0,
  `verificationCode` mediumint(9) DEFAULT NULL,
  `verificationExpiresAt` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `lastUpdatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emailQueue`
--

DROP TABLE IF EXISTS `emailQueue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailQueue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `deviceId` int(11) DEFAULT NULL,
  `email` longtext NOT NULL,
  `subject` longtext DEFAULT NULL,
  `htmlBody` longtext DEFAULT NULL,
  `altBody` longtext DEFAULT NULL,
  `sent` int(11) DEFAULT 0,
  `errorMessage` text DEFAULT NULL,
  `addedTime` timestamp NULL DEFAULT NULL,
  `procesTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emailQueue`
--

LOCK TABLES `emailQueue` WRITE;
/*!40000 ALTER TABLE `emailQueue` DISABLE KEYS */;
/*!40000 ALTER TABLE `emailQueue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stripePaymentIntentId` varchar(255) DEFAULT NULL,
  `stripeClientSecret` varchar(255) DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `totalPrice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paymentStatus` enum('created','canceled','processing','succeeded','failed','requires_action') DEFAULT 'created',
  `methodType` varchar(50) DEFAULT NULL,
  `extraData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extraData`)),
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `gender` varchar(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastNamePrefix` varchar(20) DEFAULT NULL,
  `lastName` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `houseNumber` varchar(10) NOT NULL,
  `houseNumberSuffix` varchar(10) DEFAULT NULL,
  `postalCode` varchar(10) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2,'pi_3QzhB4A4T29zbjnh0023AGsM','pi_3QzhB4A4T29zbjnh0023AGsM_secret_PqRYbaHnTcTZcQAYeFNYneyDQ',0,2.00,'created',NULL,NULL,'[{\"quantity\":1,\"product_data\":{\"id\":21,\"name\":\"usb-c-hub\",\"brand\":\"novoo\",\"price\":\"2.00\",\"title\":\"USB C Hub\",\"mainImage\":\"main.png\",\"description\":\"Een erg mooie hub.\"}}]','Dhr.','Tom','','Tiedemann','netherlands','Vlijmen','De Jonglaan','8','','5251SP','tomtiedemann30@gmail.com','0683384388','2008-03-10');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymentLogs`
--

DROP TABLE IF EXISTS `paymentLogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymentLogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `paymentIntentId` varchar(255) DEFAULT NULL,
  `paymentStatus` enum('created','canceled','processing','succeeded','failed','requires_action') DEFAULT NULL,
  `failureMessage` text DEFAULT NULL,
  `logMessage` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentLogs`
--

LOCK TABLES `paymentLogs` WRITE;
/*!40000 ALTER TABLE `paymentLogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `paymentLogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT NULL,
  `brand` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `mainImage` varchar(255) DEFAULT NULL,
  `galleryImages` text DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_products_category` (`category`),
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category`) REFERENCES `categories` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'smartphones','apple','iphone-16-pro','iPhone 16 Pro',1200.00,'Ervaar de nieuwste technologie met de iPhone 16 Pro. Geniet van een verbluffende camera, krachtige prestaties en een elegant design.','main.png',NULL,'2025-02-17 08:22:10','2025-02-20 15:41:32'),(2,'smartphones','samsung','galaxy-s25-ultra','Galaxy S25 Ultra',1500.00,'Maak adembenemende foto\'s met de geavanceerde camera en geniet van ultrasnelle prestaties met de Galaxy S25 Ultra.','main.png',NULL,'2025-02-19 07:09:35','2025-02-20 15:41:37'),(3,'smartphones','samsung','galaxy-s25','Galaxy S25',900.00,'De Samsung Galaxy S25 biedt krachtige prestaties en een strak design voor een premium smartphone-ervaring.','main.png',NULL,'2025-02-19 09:14:38','2025-02-20 15:41:43'),(4,'smartphones','samsung','galaxy-s25-plus','Galaxy S25 Plus',1200.00,'Met de Galaxy S25 Plus heb je alles wat je nodig hebt: snelheid, stijl en een indrukwekkende batterijduur.','main.png',NULL,'2025-02-19 09:16:31','2025-02-20 15:41:49'),(5,'smartphones','apple','iphone-16','iPhone 16',1000.00,'Ontdek de iPhone 16: een perfecte mix van prestaties, stijl en innovatie. Jouw ideale dagelijkse metgezel.','main.png',NULL,'2025-02-19 09:17:36','2025-02-20 15:52:52'),(6,'smartphones','oneplus','oneplus-13','13',1200.00,'Snel, krachtig en stijlvol: de OnePlus 13 biedt topklasse prestaties en een vloeiende gebruikerservaring.','main.png',NULL,'2025-02-19 09:19:24','2025-02-20 15:42:02'),(7,'smartphones','samsung','galaxy-a55-5g','Galaxy A55 5G',500.00,'Supersnel 5G, een prachtige display en een batterij die de hele dag meegaat – de Galaxy A55 5G heeft het allemaal!','main.png',NULL,'2025-02-19 09:23:17','2025-02-20 15:42:08'),(8,'tablets','samsung','galaxy-tab-a9-plus','Galaxy Tab A9 Plus',250.00,'Perfect voor werk en entertainment! De Galaxy Tab A9 Plus biedt een groot scherm en lange batterijduur voor eindeloos plezier.','main1.png',NULL,'2025-02-19 09:26:05','2025-02-20 15:42:13'),(9,'smartphones','apple','iphone-15','iPhone 15',900.00,'De iPhone 15 brengt een krachtig design en indrukwekkende prestaties samen in een stijlvolle behuizing.','main.png',NULL,'2025-02-20 15:52:42','2025-02-20 16:24:35'),(10,'smartphones','samsung','galaxy-a16','Galaxy A16',200.00,'Betaalbaar en betrouwbaar: de Samsung Galaxy A16 biedt een lange batterijduur en een helder scherm.','main.png',NULL,'2025-02-20 15:54:07','2025-02-20 16:24:35'),(11,'smartphones','samsung','galaxy-s24-ultra','Galaxy S24 Ultra',1500.00,'De ultieme flagship-ervaring! Maak haarscherpe foto\'s en werk razendsnel met de Galaxy S24 Ultra.','main.png',NULL,'2025-02-20 15:56:09','2025-02-20 16:24:35'),(12,'smartphones','apple','iphone-14','iPhone 14',750.00,'Een tijdloos design met krachtige hardware: de iPhone 14 blijft een topkeuze.','main.png',NULL,'2025-02-20 15:56:48','2025-02-20 16:24:35'),(13,'smartphones','oneplus','oneplus-13r','13R',750.00,'Snel, stijlvol en krachtig – de OnePlus 13R levert topprestaties tegen een scherpe prijs.','main.png',NULL,'2025-02-20 15:58:06','2025-02-20 16:24:35'),(14,'smartphones','samsung','galaxy-s24','Galaxy S24',960.00,'Met de Galaxy S24 geniet je van premium features, een haarscherp scherm en razendsnelle prestaties.','main.png',NULL,'2025-02-20 15:59:02','2025-02-20 16:24:35'),(15,'smartphones','motorola','razr-50','Razr 50',900.00,'Ervaar de nostalgie in een modern jasje! De Motorola Razr 50 is een vouwbare telefoon met high-end specificaties.','main.png',NULL,'2025-02-20 16:01:22','2025-02-20 16:24:35'),(16,'smartphones','xaomi','redmi-14c','Redmi 14C',180.00,'Krachtige prestaties en razendsnel 5G-internet in een betaalbare smartphone.','main1.png',NULL,'2025-02-20 16:07:39','2025-02-20 16:24:35'),(17,'smartphones','motorola','moto-g85-5g','Moto G85 5G',350.00,'Met de Oppo A80 5G krijg je snelheid, een groot scherm en een krachtige batterij voor een betaalbare prijs.','main.png',NULL,'2025-02-20 16:09:40','2025-02-20 16:24:35'),(18,'smartphones','oppo','a80-5g','A80 5G',300.00,'Een minimalistisch design met maximale prestaties – de Nothing Phone (2a) laat zich zien!','main.png',NULL,'2025-02-20 16:10:47','2025-02-20 16:24:36'),(19,'smartphones','nothing','Phone-2a','Phone (2a)',380.00,'Een budgetvriendelijke krachtpatser met een groot scherm en betrouwbare prestaties.','main.png',NULL,'2025-02-20 16:12:03','2025-02-20 16:24:36'),(20,'smartphones','xaomi','redmi-a3','Redmi A3',120.00,'Compact, licht en perfect voor de basis: de Xiaomi Redmi A3 biedt een solide ervaring voor weinig geld.','main.png',NULL,'2025-02-20 16:13:11','2025-02-20 16:24:36'),(21,'accessories','novoo','usb-c-hub','USB C Hub',2.00,'Een erg mooie hub.','main.png',NULL,'2025-02-27 17:02:15','2025-02-27 17:02:15');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'u240066_webshop'
--

--
-- Dumping routines for database 'u240066_webshop'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-06 19:20:53
