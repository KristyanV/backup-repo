-- Run this SQL in phpMyAdmin or via your MySQL client to add a `users` table

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `companyposition` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;