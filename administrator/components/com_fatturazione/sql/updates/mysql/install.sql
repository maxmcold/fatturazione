DROP TABLE `#_fatturazione`
CREATE TABLE `#_fatturazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codice_fattura` varchar(45) DEFAULT NULL,
  `progressivo` varchar(45) DEFAULT NULL,
  `mese` int(11) DEFAULT NULL,
  `anno` varchar(45) DEFAULT NULL,
  `mail_inviata` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
