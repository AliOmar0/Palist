CREATE TABLE `tokens` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `user_id` INT(11) DEFAULT NULL  COMMENT 'User ID',
		    `module_prefix` VARCHAR(250) DEFAULT NULL  COMMENT 'Module Prefix',
		    `token` VARCHAR(280) DEFAULT NULL  COMMENT 'Token',
		    `_d` INT(11) DEFAULT NULL  COMMENT 'Device',
		    `app_version` VARCHAR(250)  DEFAULT '0' COMMENT 'App Version',
		    `device_model` VARCHAR(250) DEFAULT NULL  COMMENT 'Device Model',
		    `os_version` VARCHAR(250) DEFAULT NULL  COMMENT 'OS Version',
		    `browser_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Browser Name',
		    `browser` TEXT DEFAULT NULL  COMMENT 'Browser',
		    `language` INT(11) DEFAULT NULL  COMMENT 'Language',
		    `player_id` VARCHAR(250) DEFAULT NULL  COMMENT 'Player ID',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`user_id`),INDEX (`module_prefix`),INDEX (`token`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;