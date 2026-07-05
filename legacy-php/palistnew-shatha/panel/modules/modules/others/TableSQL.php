CREATE TABLE `modules` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `module_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Module Name',
		    `module_prefix` VARCHAR(500) DEFAULT NULL  COMMENT 'Module Prefix',
		    `order_by` INT(11) DEFAULT NULL  COMMENT 'Order By',
		    `version` VARCHAR(5) DEFAULT NULL  COMMENT 'Version',
		    `main_icon` VARCHAR(250) DEFAULT NULL  COMMENT 'Main Icon',
		    `legion_version` INT(5)  DEFAULT '1' COMMENT 'Legion Version',
		    `legion_build` INT(5) DEFAULT NULL  COMMENT 'Legion Build',
		    `is_edit_only` BOOLEAN  DEFAULT '0' COMMENT 'Is Edit Only',
		    `is_complemantary` BOOLEAN  DEFAULT '0' COMMENT 'Is Complemantary',
		    `models` VARCHAR(1000)  DEFAULT 'add,edit,delete,list,usage' COMMENT 'Models',
		    `ml` BOOLEAN  DEFAULT '0' COMMENT 'ML',
		    `core` BOOLEAN  DEFAULT '0' COMMENT 'Core',
		    `cluster` BOOLEAN  DEFAULT '0' COMMENT 'Cluster',
		    `external_access` BOOLEAN  DEFAULT '0' COMMENT 'External Access',
		    `commerce` BOOLEAN  DEFAULT '0' COMMENT 'Commerce',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`module_prefix`),INDEX (`order_by`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;