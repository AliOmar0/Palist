CREATE TABLE `module_settings` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `module_prefix` VARCHAR(250) DEFAULT NULL  COMMENT 'Module Prefix',
		    `default_column` VARCHAR(250) DEFAULT NULL  COMMENT 'Default Column',
		    `default_order` VARCHAR(4) DEFAULT NULL  COMMENT 'Default Order',
		    `items_per_page` INT(5) DEFAULT NULL  COMMENT 'Items Per Page',
		    `ml_fields` VARCHAR(250) DEFAULT NULL  COMMENT 'ML Fields',
		    `menu_field` VARCHAR(250) DEFAULT NULL  COMMENT 'Menu Field',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`module_prefix`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;