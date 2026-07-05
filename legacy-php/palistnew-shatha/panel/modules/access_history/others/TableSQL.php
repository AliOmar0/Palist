CREATE TABLE `access_history` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `module_prefix` INT(11) DEFAULT NULL  COMMENT 'Module Prefix',
		    `user_id` INT(11) DEFAULT NULL  COMMENT 'User ID',
		    `remark` VARCHAR(250) DEFAULT NULL  COMMENT 'Remark',
		    `ip` VARCHAR(250) DEFAULT NULL  COMMENT 'IP',
		    `browser` VARCHAR(250) DEFAULT NULL  COMMENT 'Browser',
		    `referer` VARCHAR(250) DEFAULT NULL  COMMENT 'Referer',
		    `browser_language` VARCHAR(250) DEFAULT NULL  COMMENT 'Browser Language',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;