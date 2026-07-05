CREATE TABLE `quick_access_1563567918` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `module_prefix` VARCHAR(250) DEFAULT NULL  COMMENT 'Module Prefix',
		    `action_of_module` VARCHAR(250) DEFAULT NULL  COMMENT 'Action of Module',
		    `title_of_link` VARCHAR(250) DEFAULT NULL  COMMENT 'Title of link',
		    `custom_link` VARCHAR(500) DEFAULT NULL  COMMENT 'Custom Link',
		    `icon` VARCHAR(50) DEFAULT NULL  COMMENT 'Icon',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`module_prefix`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;