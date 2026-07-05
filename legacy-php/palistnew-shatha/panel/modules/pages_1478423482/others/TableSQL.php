CREATE TABLE `pages_1478423482` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `title` VARCHAR(500) NOT NULL  COMMENT 'Title',
		    `slug` VARCHAR(250) NOT NULL  COMMENT 'Slug',
		    `content` TEXT DEFAULT NULL  COMMENT 'Content',
		    `photo` VARCHAR(2000) DEFAULT NULL  COMMENT 'Photo',
		    `files` VARCHAR(2000) DEFAULT NULL  COMMENT 'Files',
		    `additional_file` VARCHAR(250) DEFAULT NULL  COMMENT 'Additional File',
		    `signin_required` INT(11) DEFAULT NULL  COMMENT 'Signin Required',
		    `with_share_functionality` BOOLEAN  DEFAULT '1' COMMENT 'With Share Functionality',
		    `with_messenger` BOOLEAN  DEFAULT '1' COMMENT 'With Messenger',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,UNIQUE KEY `slug` (`slug`),INDEX (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;