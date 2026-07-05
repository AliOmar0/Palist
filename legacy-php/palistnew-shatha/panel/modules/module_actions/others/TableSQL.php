CREATE TABLE `module_actions` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `module_id` INT(11) DEFAULT NULL  COMMENT 'Module ID',
		    `title` VARCHAR(50) DEFAULT NULL  COMMENT 'Title',
		    `type` VARCHAR(50) DEFAULT NULL  COMMENT 'Type',
		    `icon` VARCHAR(50) DEFAULT NULL  COMMENT 'Icon',
		    `private` BOOLEAN  DEFAULT '0' COMMENT 'Private',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;