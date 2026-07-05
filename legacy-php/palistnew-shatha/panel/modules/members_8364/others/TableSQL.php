CREATE TABLE `members_8364` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `name` VARCHAR(250) DEFAULT NULL  COMMENT 'Name',
		    `job_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Job Name',
		    `photo` VARCHAR(1000) DEFAULT NULL  COMMENT 'Photo',
		    `summary` VARCHAR(250) DEFAULT NULL  COMMENT 'Summary',
		    `content` TEXT DEFAULT NULL  COMMENT 'Content',
		    `order_number` VARCHAR(250) DEFAULT NULL  COMMENT 'Order Number',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;