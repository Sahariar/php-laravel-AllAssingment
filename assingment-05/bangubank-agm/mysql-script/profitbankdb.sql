-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: profitbankdb
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `transaction_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,2,2,9000000.00,9000000.00,'deposit','2024-07-20 16:31:42'),(2,2,2,50000.00,8950000.00,'withdraw','2024-07-20 16:44:57'),(3,2,2,200000.00,9150000.00,'deposit','2024-07-20 17:04:35'),(4,2,2,200000.00,9350000.00,'deposit','2024-07-20 17:09:16'),(5,2,2,200000.00,9550000.00,'deposit','2024-07-20 17:17:11'),(6,3,3,600000.00,600000.00,'deposit','2024-07-20 17:26:05'),(7,3,3,50000.00,550000.00,'withdraw','2024-07-20 18:00:03'),(8,3,3,5000.00,545000.00,'withdraw','2024-07-20 18:20:09'),(9,3,3,5000.00,550000.00,'deposit','2024-07-20 18:20:09'),(10,7,7,8000000.00,8000000.00,'deposit','2024-07-20 19:27:13'),(11,7,7,481.00,7999519.00,'withdraw','2024-07-20 19:28:59'),(12,9,9,900000.00,900000.00,'deposit','2024-07-20 20:48:15'),(13,9,5,6000.00,894000.00,'withdraw','2024-07-21 16:08:48'),(14,5,9,6000.00,6000.00,'deposit','2024-07-21 16:08:48'),(15,9,6,7000.00,887000.00,'withdraw','2024-07-21 16:14:18'),(16,6,9,7000.00,7000.00,'deposit','2024-07-21 16:14:18'),(17,6,6,900000.00,907000.00,'deposit','2024-07-24 14:10:59');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sahariark@gmail.com','Sahariar Kabir','$2y$10$wLnMnyTlTNHxRJV3qj9.SeDLYFoP4tOxXd4vtNPfhSSrDzWhlY.ce','fuchsia','admin','2024-07-20 15:58:25','2024-07-20 15:58:25'),(2,'wipivepo@mailinator.com','Patricia Shepherd','$2y$10$EqHRYFpJTRinR2Hegje6N.fZnvrO7MF7CXPRAYFN2U8MY.E.sl0zm','zinc','customer','2024-07-20 16:04:55','2024-07-20 16:04:55'),(3,'kyzemi@mailinator.com','Tanner Davis','$2y$10$vLDcMUS6Sp4YqNc.IOyomeJoT6mhKLq8Vev3oErziZSTclx7SgGj2','emerald','customer','2024-07-20 17:25:38','2024-07-20 17:25:38'),(4,'fageveq@mailinator.com','Nolan Pope','$2y$10$uVWBnvhSpmQ/gX5sdp6SquXmCNd9nTMm3rfThyjL7LplDvKHoU5by','red','customer','2024-07-20 19:07:32','2024-07-20 19:07:32'),(5,'fiko@mailinator.com','Glenna Gilbert','$2y$10$TVR6H6phWwEmQqgssDlmueQ2qRqsPmzlrivu/rVUJJSAeyqDGjVXa','stone','customer','2024-07-20 19:09:41','2024-07-20 19:09:41'),(6,'namohekep@mailinator.com','Lucian Barker','$2y$10$wfZm7Mru5Xm0FjGypos/huWnHOp5M.fincJDT4bYwF95AJd.MTru6','orange','customer','2024-07-20 19:14:44','2024-07-20 19:14:44'),(7,'qeqa@mailinator.com','Charles Mcbride','$2y$10$RvTp1FrLH5mXDIBJ9Jonr.B0S6Ymb6X.18zi/lS.VZ1BwJ/AWBB9e','stone','customer','2024-07-20 19:15:18','2024-07-20 19:15:18'),(8,'kicabem@mailinator.com','Alika Conner','$2y$10$1kvDF9bf8z5JgeUvw15uQ.wcMpiH0JUg6xmkHZr2ITNaJ/pF3u/zO','indigo','customer','2024-07-20 19:16:29','2024-07-20 19:16:29'),(9,'zafuqi@mailinator.com','Aphrodite Slater','$2y$10$3aDNaPh6RKrVjGSDcbn7oOSCuvxQj9SJX0crrWBoALNNd4W8DseN2','orange','customer','2024-07-20 20:47:43','2024-07-20 20:47:43'),(10,'sejy@mailinator.com','Amena James','$2y$10$ut0bHyKqNZRq/kLzYErU5.aFmlXtbM5eg50G0BJsS1lOYlYQgmgQS','gray','customer','2024-07-21 16:28:35','2024-07-21 16:28:35'),(11,'vezinyjuku@mailinator.com','Kalia Salas','$2y$10$UMZ7Oj72vDuM84llESWs6.D5wYrKT7nD0Pjz0oU33mqOWRcNHHkAS','cyan','customer','2024-07-21 17:01:53','2024-07-21 17:01:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-24 20:41:24
