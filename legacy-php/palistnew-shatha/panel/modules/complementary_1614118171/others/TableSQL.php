CREATE TABLE `complementary_1614118171` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL,
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `mother_module_prefix` INT(11) DEFAULT NULL  COMMENT 'Mother Module Prefix',
		    `mother_id` INT(11) DEFAULT NULL  COMMENT 'Mother ID',
		    `child_module_prefix` INT(11) DEFAULT NULL  COMMENT 'Child Module Prefix',
		    `child_id` INT(11) DEFAULT NULL  COMMENT 'Child ID',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`mother_module_prefix`),INDEX (`mother_id`),INDEX (`child_module_prefix`),INDEX (`child_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;