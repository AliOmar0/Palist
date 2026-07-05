CREATE TABLE `admin_settings` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `admin` INT(11) DEFAULT NULL  COMMENT 'Admin',
		    `status_report` BOOLEAN  DEFAULT '1' COMMENT 'Status Report',
		    `storage` BOOLEAN  DEFAULT '1' COMMENT 'Storage',
		    `datetime` BOOLEAN  DEFAULT '1' COMMENT 'Datetime',
		    `todo` BOOLEAN  DEFAULT '1' COMMENT 'Todo',
		    `app_links` BOOLEAN  DEFAULT '1' COMMENT 'App Links',
		    `grid_dashboard` BOOLEAN  DEFAULT '0' COMMENT 'Grid Dashboard',
		    `colors_palette` BOOLEAN  DEFAULT '1' COMMENT 'Colors Palette',
		    `translations` BOOLEAN  DEFAULT '1' COMMENT 'Translations',
		    `front_control_options` BOOLEAN  DEFAULT '1' COMMENT 'Front Control Options',
		    `sitemap_info` BOOLEAN  DEFAULT '1' COMMENT 'Sitemap Info',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;