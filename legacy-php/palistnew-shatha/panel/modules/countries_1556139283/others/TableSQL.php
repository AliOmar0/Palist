CREATE TABLE `countries_1556139283` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `title` VARCHAR(250) NOT NULL  COMMENT 'Title',
		    `active` BOOLEAN NOT NULL DEFAULT '0' COMMENT 'Active',
		    `flag` VARCHAR(50) DEFAULT NULL  COMMENT 'Flag',
		    `alpha_2_code` VARCHAR(2) NOT NULL  COMMENT 'alpha_2_code',
		    `alpha_3_code` VARCHAR(3) NOT NULL  COMMENT 'alpha_3_code',
		    `nationality` VARCHAR(250) NOT NULL  COMMENT 'Nationality',
		    `phone_code` INT(5) NOT NULL  COMMENT 'Phone Code',
		    `currency_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Currency Name',
		    `currency_shortname` VARCHAR(250) DEFAULT NULL  COMMENT 'Currency Shortname',
		    `currency_symbol` VARCHAR(250) DEFAULT NULL  COMMENT 'Currency Symbol',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,UNIQUE KEY `alpha_2_code` (`alpha_2_code`),UNIQUE KEY `alpha_3_code` (`alpha_3_code`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;