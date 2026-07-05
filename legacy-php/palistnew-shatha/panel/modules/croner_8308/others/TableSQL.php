CREATE TABLE `croner_8308` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `module_prefix` INT(11) DEFAULT NULL  COMMENT 'Module Prefix',
		    `item_id` INT(11) DEFAULT NULL  COMMENT 'Item ID',
		    `remark` VARCHAR(250) DEFAULT NULL  COMMENT 'Remark',
		    `emails` VARCHAR(250) DEFAULT NULL  COMMENT 'Emails',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`module_prefix`),INDEX (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;