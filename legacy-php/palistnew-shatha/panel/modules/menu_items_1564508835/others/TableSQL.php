CREATE TABLE `menu_items_1564508835` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `module_prefix` VARCHAR(250) DEFAULT NULL  COMMENT 'Module Prefix',
		    `item_id` INT(5) DEFAULT NULL  COMMENT 'Item ID',
		    `custom_title` VARCHAR(250) DEFAULT NULL  COMMENT 'Custom Title',
		    `custom_link` VARCHAR(1000) DEFAULT NULL  COMMENT 'Custom Link',
		    `open_new_window` BOOLEAN NOT NULL DEFAULT '0' COMMENT 'Open New Window',
		    `points_to_home` BOOLEAN NOT NULL DEFAULT '0' COMMENT 'Points to Home',
		    `module_field` VARCHAR(40) DEFAULT NULL  COMMENT 'Module Field',
		    `order_num` INT(11)  DEFAULT '100' COMMENT 'Order Num',
		    `sub_of` INT(5)  DEFAULT '0' COMMENT 'Sub Of',
		    `menu_key` INT(5) DEFAULT NULL  COMMENT 'Menu Key',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`module_prefix`),INDEX (`item_id`),INDEX (`sub_of`),INDEX (`menu_key`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;