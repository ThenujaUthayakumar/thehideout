-- ================================================================
-- The Hide Out Cafe — Website Tables (added to cafe_pos_db)
-- These tables are for the public website only.
-- They do NOT modify any existing POS tables.
-- ================================================================

USE `cafe_pos_db`;

-- ---------------------------------------------------------------
-- 1. Customer Feedback / Reviews
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `website_feedback` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NULL,
  `rating` TINYINT NOT NULL DEFAULT 5,
  `message` TEXT NOT NULL,
  `type` ENUM('review', 'inquiry') NOT NULL DEFAULT 'review',
  `subject` VARCHAR(200) NULL,
  `is_approved` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------
-- 2. Opening Hours (Mon–Sun)
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `website_hours` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `day_name` VARCHAR(20) NOT NULL,
  `day_order` TINYINT NOT NULL,
  `open_time` TIME NULL,
  `close_time` TIME NULL,
  `is_closed` TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `website_hours` (`day_name`, `day_order`, `open_time`, `close_time`, `is_closed`) VALUES
('Monday',    1, '09:00:00', '23:00:00', 0),
('Tuesday',   2, '09:00:00', '23:00:00', 0),
('Wednesday', 3, '09:00:00', '23:00:00', 0),
('Thursday',  4, '09:00:00', '23:00:00', 0),
('Friday',    5, '09:00:00', '23:00:00', 0),
('Saturday',  6, '09:00:00', '23:00:00', 0),
('Sunday',    7, '09:00:00', '23:00:00', 0);

-- ---------------------------------------------------------------
-- 3. Social Media Links
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `website_social_links` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `platform` VARCHAR(50) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `icon` VARCHAR(60) NOT NULL,
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `website_social_links` (`platform`, `url`, `icon`, `sort_order`, `is_active`) VALUES
('Instagram',   'https://instagram.com/TheHideOutCafeLK',   'fa-brands fa-instagram',       1, 1),
('Facebook',    'https://facebook.com/TheHideOutCafeLK',    'fa-brands fa-facebook',        2, 1),
('TikTok',      'https://tiktok.com/@TheHideOutCafeLK',     'fa-brands fa-tiktok',          3, 1),
('WhatsApp',    'https://wa.me/94771234567',                 'fa-brands fa-whatsapp',        4, 1),
('Google Maps', 'https://maps.app.goo.gl/example',          'fa-solid fa-map-location-dot', 5, 1);

-- ---------------------------------------------------------------
-- Seed: Sample Approved Customer Reviews
-- ---------------------------------------------------------------
INSERT INTO `website_feedback` (`name`, `email`, `rating`, `message`, `type`, `is_approved`, `created_at`) VALUES
('Kavindu Silva',       'kavindu@gmail.com',    5, 'Best flat white in Colombo! The ambiance is perfect for working remotely. Love the cozy window seats.',                        'review', 1, NOW() - INTERVAL 30 DAY),
('Dharshini Perera',    'dharshini@yahoo.com',  5, 'Their almond croissants are to die for. I come here every Saturday morning. Friendly staff and great playlist!',               'review', 1, NOW() - INTERVAL 20 DAY),
('Roshan Fernando',     'roshan@creative.lk',   4, 'Amazing matcha latte and the basque cheesecake is heavenly. A true hidden gem in Colombo 03!',                                 'review', 1, NOW() - INTERVAL 15 DAY),
('Amaya Jayawardena',   'amaya.j@gmail.com',    5, 'The nitro cold brew here is unbelievable — smooth, creamy, and perfectly balanced. My new favorite coffee spot in Sri Lanka!',  'review', 1, NOW() - INTERVAL 7 DAY),
('Nimal Bandara',       'nimal.b@outlook.com',  4, 'Love the Spanish latte paired with the pain au chocolat. The outdoor terrace is so peaceful.',                                  'review', 1, NOW() - INTERVAL 3 DAY),
('Sachini De Silva',    'sachini@gmail.com',     5, 'Came for coffee, stayed for the vibes. The truffle egg brioche sandwich is a must-try. Will keep coming back!',                 'review', 1, NOW() - INTERVAL 1 DAY);
