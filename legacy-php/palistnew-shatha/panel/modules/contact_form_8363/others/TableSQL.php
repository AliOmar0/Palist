CREATE TABLE `contact_form_8363` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `name` VARCHAR(250) DEFAULT NULL  COMMENT 'Name',
		    `email` VARCHAR(250) DEFAULT NULL  COMMENT 'Email',
		    `mobile_number` INT(11) DEFAULT NULL  COMMENT 'Mobile Number',
		    `telephone` INT(11) DEFAULT NULL  COMMENT 'Telephone',
		    `message` TEXT DEFAULT NULL  COMMENT 'Message',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;