CREATE TABLE `psn_1627841195` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `user` VARCHAR(250) DEFAULT NULL  COMMENT 'User',
		    `module_prefix` INT(11) DEFAULT NULL  COMMENT 'Module Prefix',
		    `title` VARCHAR(250) DEFAULT NULL  COMMENT 'Title',
		    `message` VARCHAR(250) DEFAULT NULL  COMMENT 'Message',
		    `seen` BOOLEAN  DEFAULT '0' COMMENT 'Seen',
		    `extra` VARCHAR(1000) DEFAULT NULL  COMMENT 'Extra',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`user`),INDEX (`module_prefix`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;