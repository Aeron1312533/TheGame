CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `password_salt` varchar(38) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'basic_user',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `language` varchar(4) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;