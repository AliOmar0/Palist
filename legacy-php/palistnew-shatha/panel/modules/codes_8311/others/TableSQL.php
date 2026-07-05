CREATE TABLE `codes_8311` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `title` VARCHAR(250) DEFAULT NULL  COMMENT 'Title',
		    `dimension` INT(11)  DEFAULT '512' COMMENT 'Dimension',
		    `value` TEXT DEFAULT NULL  COMMENT 'Value',
		    `color` VARCHAR(10) DEFAULT NULL  COMMENT 'Color',
		    `hash_origin` TEXT DEFAULT NULL  COMMENT 'Hash Origin',
		    `hash` TEXT DEFAULT NULL  COMMENT 'Hash',
		    `photo` VARCHAR(1000) DEFAULT NULL  COMMENT 'Photo',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;