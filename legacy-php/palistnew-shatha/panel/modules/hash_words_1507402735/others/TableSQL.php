CREATE TABLE `hash_words_1507402735` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `hash` VARCHAR(250) NOT NULL  COMMENT 'Hash',
		    `php_variable` VARCHAR(250) NOT NULL  COMMENT 'PHP Variable',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`hash`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;