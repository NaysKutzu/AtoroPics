


DROP TABLE IF EXISTS `imgs`;
CREATE TABLE `imgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `owner_key` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `storage_folder` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


LOCK TABLES `imgs` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `app_proto` varchar(255) NOT NULL,
  `app_url` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `discord` varchar(255) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `smtp_user` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `smtp_from` varchar(255) NOT NULL,
  `smtp_from_name` varchar(255) NOT NULL,
  `discord_webhook` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


LOCK TABLES `settings` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  `register_ip` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `admin` varchar(255) NOT NULL,
  `embed_title` varchar(255) NOT NULL,
  `embed_desc` varchar(255) NOT NULL,
  `embed_theme` varchar(255) NOT NULL,
  `embed_sitename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


LOCK TABLES `users` WRITE;
UNLOCK TABLES;


