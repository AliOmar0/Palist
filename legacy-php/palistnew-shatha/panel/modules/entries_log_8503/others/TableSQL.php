CREATE TABLE `entries_log_8503` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `entry_module` INT(11) DEFAULT NULL  COMMENT 'Entry Module',
		    `entry_id` INT(11) DEFAULT NULL  COMMENT 'Entry ID',
		    `user_module` INT(11) DEFAULT NULL  COMMENT 'User Module',
		    `user_id` INT(11) DEFAULT NULL  COMMENT 'User ID',
		    `action` VARCHAR(250) DEFAULT NULL  COMMENT 'Action',
		    `remark` VARCHAR(250) DEFAULT NULL  COMMENT 'Remark',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`entry_module`),INDEX (`entry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;