CREATE TABLE `events_8362` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `title` VARCHAR(250) DEFAULT NULL  COMMENT 'Title',
		    `event_date` DATE DEFAULT NULL  COMMENT 'Event Date',
		    `events_description` TEXT DEFAULT NULL  COMMENT 'Events Description',
		    `photo` VARCHAR(1000) DEFAULT NULL  COMMENT 'Photo',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;