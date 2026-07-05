CREATE TABLE `bulk_push_notification_1633289547` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `title` VARCHAR(250) NOT NULL  COMMENT 'Title',
		    `message` TEXT NOT NULL  COMMENT 'Message',
		    `specific_users_module` INT(11) DEFAULT NULL  COMMENT 'Specific Users Module',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;