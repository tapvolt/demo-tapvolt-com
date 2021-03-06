CREATE TABLE `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `lock_version` int(11) DEFAULT '0',
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `last_seen` int(11) DEFAULT NULL,
  `last_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `roles` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`id`, `created_at`, `created_by`, `lock_version`, `updated_at`, `updated_by`, `enabled`, `name`, `email`, `password_hash`, `auth_key`, `last_seen`, `last_ip`, `unconfirmed_email`, `confirmed_at`, `roles`)
VALUES
  (12, 1436709050, NULL, 0, 1436709050, NULL, 1, 'Tapvolt', 'admin@tapvolt.com', '$2y$13$4KlFZSyaDGGxchm.D6xel.yGU95jl1Kc6FDY1r/MK/vkOukfUtMNO', '5Z2EED0SN6-XKtbIpoXNlE29N0WGfrOz', NULL, '192.168.56.1', NULL, NULL, 0);

