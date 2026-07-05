CREATE TABLE `comments` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `module_prefix` INT(11) DEFAULT NULL  COMMENT 'Module Prefix',
		    `related_id` INT(11) DEFAULT NULL  COMMENT 'Related ID',
		    `commenter_module` INT(11) DEFAULT NULL  COMMENT 'Commenter Module',
		    `commenter_id` INT(11) DEFAULT NULL  COMMENT 'Commenter ID',
		    `comment` TEXT DEFAULT NULL  COMMENT 'Comment',
		    `remark` VARCHAR(250) DEFAULT NULL  COMMENT 'Remark',
		    `files` VARCHAR(1000) DEFAULT NULL  COMMENT 'Files',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;