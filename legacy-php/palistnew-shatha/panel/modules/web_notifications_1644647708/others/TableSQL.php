CREATE TABLE `web_notifications_1644647708` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `user` INT(11) DEFAULT NULL  COMMENT 'User',
		    `user_module` INT(11) DEFAULT NULL  COMMENT 'User Module',
		    `module_id` INT(11) DEFAULT NULL  COMMENT 'Module ID',
		    `action_id` INT(11) DEFAULT NULL  COMMENT 'Action ID',
		    `related_id` INT(11) DEFAULT NULL  COMMENT 'Related ID',
		    `custom_title` VARCHAR(250) NOT NULL  COMMENT 'Custom Title',
		    `custom_link` VARCHAR(250) DEFAULT NULL  COMMENT 'Custom Link',
		    `seen` BOOLEAN  DEFAULT '0' COMMENT 'Seen',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;