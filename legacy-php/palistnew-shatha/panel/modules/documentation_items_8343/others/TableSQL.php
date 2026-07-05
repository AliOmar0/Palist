CREATE TABLE `documentation_items_8343` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `title` VARCHAR(250) DEFAULT NULL  COMMENT 'Title',
		    `documentation` INT(11) DEFAULT NULL  COMMENT 'Documentation',
		    `content` TEXT DEFAULT NULL  COMMENT 'Content',
		    `additional_content` TEXT DEFAULT NULL  COMMENT 'Additional Content',
		    `order_number` INT(11) DEFAULT NULL  COMMENT 'Order Number',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;