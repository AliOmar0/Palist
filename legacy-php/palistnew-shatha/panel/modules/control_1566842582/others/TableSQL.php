CREATE TABLE `control_1566842582` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `title` VARCHAR(250) DEFAULT NULL  COMMENT 'Title',
		    `code` VARCHAR(250) DEFAULT NULL  COMMENT 'Code',
		    `photo` VARCHAR(50) DEFAULT NULL  COMMENT 'Photo',
		    `file` VARCHAR(2000) DEFAULT NULL  COMMENT 'File',
		    `color` VARCHAR(10) DEFAULT NULL  COMMENT 'Color',
		    `active` BOOLEAN  DEFAULT '1' COMMENT 'Active',
		    `text` TEXT DEFAULT NULL  COMMENT 'Text',
		    `formatted_text` TEXT DEFAULT NULL  COMMENT 'Formatted Text',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,UNIQUE KEY `code` (`code`),INDEX (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;