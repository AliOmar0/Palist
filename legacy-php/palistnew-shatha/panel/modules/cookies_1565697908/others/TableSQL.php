CREATE TABLE `cookies_1565697908` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `user_id` INT(11) DEFAULT NULL  COMMENT 'User ID',
		    `module_id` INT(11) DEFAULT NULL  COMMENT 'Module ID',
		    `token` VARCHAR(280) DEFAULT NULL  COMMENT 'Token',
		    `browser` TEXT(500) DEFAULT NULL  COMMENT 'Browser',
		    `browser_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Browser Name',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`user_id`),INDEX (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;