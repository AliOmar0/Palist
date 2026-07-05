CREATE TABLE `admins` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `username` VARCHAR(250) NOT NULL  COMMENT 'Username',
		    `password` VARCHAR(250) NOT NULL  COMMENT 'Password',
		    `email` VARCHAR(250) NOT NULL  COMMENT 'Email',
		    `phone` VARCHAR(250) DEFAULT NULL  COMMENT 'Phone',
		    `first_name` VARCHAR(250) DEFAULT NULL  COMMENT 'First Name',
		    `last_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Last Name',
		    `position` VARCHAR(250) DEFAULT NULL  COMMENT 'Position',
		    `language_id` INT(11)  DEFAULT '1' COMMENT 'Language',
		    `country` INT(11) DEFAULT NULL  COMMENT 'Country',
		    `menu_style` VARCHAR(500)  DEFAULT 'List' COMMENT 'Menu Style',
		    `photo` VARCHAR(2000)  DEFAULT 'default_profile.png' COMMENT 'Photo',
		    `dark_mode` BOOLEAN  DEFAULT '0' COMMENT 'Dark Mode',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,UNIQUE KEY `username` (`username`),UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;