CREATE TABLE `privileges_1565709771` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `user_id` INT(11) NOT NULL  COMMENT 'User ID',
		    `module_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Module Name',
		    `type_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Type Name',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`user_id`),INDEX (`module_name`),INDEX (`type_name`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;