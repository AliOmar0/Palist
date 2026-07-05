CREATE TABLE `about_the_syndicate_8362` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `title` VARCHAR(250) DEFAULT NULL  COMMENT 'Title',
		    `photo` VARCHAR(1000) DEFAULT NULL  COMMENT 'Photo',
		    `photo_in_single` VARCHAR(1000) DEFAULT NULL  COMMENT 'Photo_in_single',
		    `summary` TEXT DEFAULT NULL  COMMENT 'Summary',
		    `content` TEXT DEFAULT NULL  COMMENT 'Content',
		    `mission_icon` VARCHAR(1000) DEFAULT NULL  COMMENT 'Mission Icon',
		    `mission_title` VARCHAR(250) DEFAULT NULL  COMMENT 'Mission Title',
		    `mission_content` TEXT DEFAULT NULL  COMMENT 'Mission Content',
		    `vision_icon` VARCHAR(1000) DEFAULT NULL  COMMENT 'Vision Icon',
		    `vision_title` VARCHAR(250) DEFAULT NULL  COMMENT 'Vision Title',
		    `vision_content` TEXT DEFAULT NULL  COMMENT 'Vision Content',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;