
-- Dumping database structure for autonardo
CREATE DATABASE IF NOT EXISTS `autonardo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `autonardo`;

-- Dumping structure for table autonardo.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `car_id` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `bookings_ibfk_2` (`car_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping structure for table autonardo.cars
CREATE TABLE IF NOT EXISTS `cars` (
  `id` varchar(255) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `transmission` varchar(255) NOT NULL,
  `plate_number` varchar(255) NOT NULL UNIQUE,
  `rental_price_per_day` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping structure for table autonardo.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `channel` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `sent_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping structure for table autonardo.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `transaction_status` varchar(255) NOT NULL,
  `transaction_date` timestamp NOT NULL,
  `transaction_reference` varchar(255) NOT NULL,
  `checkout_url` varchar(255),
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping structure for table autonardo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL UNIQUE,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL UNIQUE,
  `address` varchar(255) NOT NULL,
  `drivers_license_number` varchar(255) NOT NULL UNIQUE,
  `drivers_license_expiry` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table autonardo.users: ~7 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `address`, `drivers_license_number`, `drivers_license_expiry`, `is_admin`, `created_at`, `updated_at`) VALUES
	('ADMIN-0001', 'Admin', 'admin@autonardo.com', '$2y$10$QY3zdx0wiTakyHy8HQ6bI.kyb7xaegCq9G/0XTAjkjxYC/OuwumqG', '09673402517', 'Manila City', '0001', '2030-01-01', 1, '2025-05-10 06:12:58', '0000-00-00 00:00:00');