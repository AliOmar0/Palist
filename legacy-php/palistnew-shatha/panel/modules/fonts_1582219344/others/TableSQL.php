CREATE TABLE `fonts_1582219344` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `css_name` VARCHAR(250) NOT NULL  COMMENT 'CSS Name',
		    `file` VARCHAR(2000) NOT NULL  COMMENT 'File',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,UNIQUE KEY `css_name` (`css_name`),INDEX (`css_name`),INDEX (`file`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;