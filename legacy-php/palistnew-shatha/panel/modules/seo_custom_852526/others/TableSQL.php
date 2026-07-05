CREATE TABLE `seo_custom_852526` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `module_id` INT(11) DEFAULT NULL  COMMENT 'Module ID',
		    `related_id` INT(11) DEFAULT NULL  COMMENT 'Related ID',
		    `title` VARCHAR(250) DEFAULT NULL  COMMENT 'Title',
		    `default_language` INT(11) DEFAULT NULL  COMMENT 'Default Language',
		    `description` TEXT DEFAULT NULL  COMMENT 'Description',
		    `meta` TEXT DEFAULT NULL  COMMENT 'Meta',
		    `type` VARCHAR(250) DEFAULT NULL  COMMENT 'Type',
		    `photo` VARCHAR(1000) DEFAULT NULL  COMMENT 'Photo',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`module_id`),INDEX (`related_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;