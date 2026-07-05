CREATE TABLE `protected_files_hash_863024` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `file_name` VARCHAR(250) DEFAULT NULL  COMMENT 'File Name',
		    `requested_file_version` VARCHAR(250) DEFAULT NULL  COMMENT 'Requested File Version',
		    `ip` VARCHAR(250) DEFAULT NULL  COMMENT 'IP',
		    `device` INT(11) DEFAULT NULL  COMMENT 'Device',
		    `version` VARCHAR(250) DEFAULT NULL  COMMENT 'Version',
		    `user` INT(11) DEFAULT NULL  COMMENT 'User',
		    `user_module` INT(11) DEFAULT NULL  COMMENT 'User Module',
		    `hash` VARCHAR(250) DEFAULT NULL  COMMENT 'Hash',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;