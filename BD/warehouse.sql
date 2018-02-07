-- CREATE DATABASE  IF NOT EXISTS `istxxxxx` /*!40100 DEFAULT CHARACTER SET latin1 */;
-- USE `istxxxxx`;
-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: db.ist.utl.pt    Database: istxxxxx
-- ------------------------------------------------------
-- Server version	5.1.73-1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user_dimension`
--

DROP TABLE IF EXISTS `user_dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_dimension` (
	`user_nif` varchar(9) NOT NULL,
	`user_name` varchar(80) NOT NULL,
	`user_phone` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_dimension`
--

LOCK TABLES `user_dimension` WRITE, `user` READ;
/*!40000 ALTER TABLE `user_dimension` DISABLE KEYS */;
INSERT INTO `user_dimension` SELECT nif, nome, telefone FROM `user`;
/*!40000 ALTER TABLE `user_dimension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_dimension`
--

DROP TABLE IF EXISTS `location_dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location_dimension` (
	`location_morada` varchar(255) NOT NULL,
	`location_codigo_espaco` varchar(255) NOT NULL,
	`location_codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_dimension`
--

LOCK TABLES `location_dimension` WRITE, `alugavel` AS a1 READ,`alugavel` AS a2 READ, `posto` READ, `espaco` READ;
/*!40000 ALTER TABLE `location_dimension` DISABLE KEYS */;
INSERT INTO `location_dimension` SELECT morada, codigo_espaco ,codigo FROM `alugavel` a1 NATURAL JOIN `posto` UNION SELECT morada, codigo AS codigo_espaco, codigo FROM `alugavel` a2 NATURAL JOIN `espaco`;

/*!40000 ALTER TABLE `location_dimension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_dimension`
--

DROP TABLE IF EXISTS `time_dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_dimension` (
	`minute_of_day` int(11) NOT NULL,
	`hour_of_day` int(11) NOT NULL,
	`minute_of_hour` int(11) NOT NULL,
	PRIMARY KEY (`minute_of_day`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_dimension`
--
DROP PROCEDURE IF EXISTS load_time_dim;
delimiter //
CREATE PROCEDURE load_time_dim()
BEGIN
	DECLARE v_full_date DATETIME;
	SET v_full_date = '2016-01-01 00:00:00';
	WHILE v_full_date < '2016-01-02 00:00:00' DO
		INSERT INTO time_dimension(
			minute_of_day,
			hour_of_day,
			minute_of_hour						
		) VALUES (
			MINUTE(v_full_date)+(HOUR(v_full_date)*60),
			HOUR(v_full_date),
			MINUTE(v_full_date)			
		);
		SET v_full_date = DATE_ADD(v_full_date, INTERVAL 1 MINUTE);
	END WHILE;
END;
//
delimiter ;
LOCK TABLES `time_dimension` WRITE;
/*!40000 ALTER TABLE `time_dimension` DISABLE KEYS */;
CALL load_time_dim();
/*!40000 ALTER TABLE `time_dimension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `date_dimension`
--

DROP TABLE IF EXISTS `date_dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `date_dimension` (
	`date_key` int(11) NOT NULL,
	`date_year` int(11) NOT NULL,
	`date_semester` int(11) NOT NULL,
	`date_month_number` int(11) NOT NULL,
	`date_week` int(11) NOT NULL,
	`date_day` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date_dimension`
--
DROP PROCEDURE IF EXISTS load_date_dim;
delimiter //
CREATE PROCEDURE load_date_dim()
BEGIN
	DECLARE v_full_date DATETIME;
	SET v_full_date = '2016-01-01 00:00:00';
	WHILE v_full_date < '2018-01-01 00:00:00' DO
		INSERT INTO date_dimension(
			date_key,
			date_year,
			date_semester,
			date_month_number,
			date_week,
			date_day
		) VALUES (
			YEAR(v_full_date) * 10000 + MONTH(v_full_date)*100 + DAY(v_full_date),
			YEAR(v_full_date),
			IF(MONTH(v_full_date)<7, 1, 2),
			MONTH(v_full_date),
			WEEKOFYEAR(v_full_date),
			DAY(v_full_date)
		);
		SET v_full_date = DATE_ADD(v_full_date, INTERVAL 1 DAY);
	END WHILE;
END;
//
delimiter ;
LOCK TABLES `date_dimension` WRITE;
/*!40000 ALTER TABLE `date_dimension` DISABLE KEYS */;
CALL load_date_dim();
/*!40000 ALTER TABLE `date_dimension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meter_readings`
--

DROP TABLE IF EXISTS `reserves_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserves_info` (
	`date_key` int(11) NOT NULL,
	`minute_of_day` int(11) NOT NULL,
	`user_nif` varchar(9) NOT NULL,
	`location_codigo` varchar(255) NOT NULL,
	`location_morada` varchar(255) NOT NULL,
	`montante` numeric(19,4) NOT NULL,
	`duration` int(11) NOT NULL,
	`reserve_num` varchar(255) NOT NULL,
	KEY `idx_metering` (`date_key`,`minute_of_day`,`user_nif`,`location_codigo`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserves_info`
--

LOCK TABLES `reserves_info` WRITE, `paga` READ, `aluga` READ, `oferta` READ;
/*!40000 ALTER TABLE `reserves_info` DISABLE KEYS */;
INSERT INTO `reserves_info`
SELECT YEAR(data) * 10000 + MONTH(data)*100 + DAY(data) AS date_key, 
	MINUTE(data)+(HOUR(data)*60) AS minute_of_day, 
	nif AS user_nif,
	codigo AS location_codigo,
	morada AS location_morada,
	DATEDIFF(data_fim, data_inicio)*tarifa AS montante,
	DATEDIFF(data_fim, data_inicio) AS duration, 
	numero AS reserve_num
FROM `paga` NATURAL JOIN `aluga` NATURAL JOIN `oferta`;

/*!40000 ALTER TABLE `reserves_info` ENABLE KEYS */;
UNLOCK TABLES;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-17 10:16:09
