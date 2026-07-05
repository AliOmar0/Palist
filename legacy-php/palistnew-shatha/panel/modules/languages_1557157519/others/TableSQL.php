CREATE TABLE `languages_1557157519` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `title` VARCHAR(250) NOT NULL  COMMENT 'Title',
		    `prefix` VARCHAR(250) NOT NULL  COMMENT 'Prefix',
		    `language_name` VARCHAR(250) NOT NULL  COMMENT 'Language Name',
		    `direction` VARCHAR(3) NOT NULL  COMMENT 'Direction',
		    `active` BOOLEAN  DEFAULT '1' COMMENT 'Active',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;