CREATE TABLE `users_8400` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `username` VARCHAR(250) DEFAULT NULL  COMMENT 'Username',
		    `password` VARCHAR(250) DEFAULT NULL  COMMENT 'Password',
		    `email_address` VARCHAR(250) DEFAULT NULL  COMMENT 'Email Address',
		    `profile_photo` VARCHAR(1000) DEFAULT NULL  COMMENT 'Profile Photo',
		    `active` BOOLEAN  DEFAULT '0' COMMENT 'Active',
		    `full_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Full Name',
		    `full_name_en` VARCHAR(250) DEFAULT NULL  ,
		    `date_of_birth` DATE DEFAULT NULL  COMMENT 'Date of Birth',
		    `province` INT(11) DEFAULT NULL  COMMENT 'Province',
		    `id_number` INT(11) DEFAULT NULL  COMMENT 'Id Number',
		    `gender` INT(11) DEFAULT NULL  COMMENT 'Gender',
		    `employment_status` INT(11) DEFAULT NULL  COMMENT 'Employment Status',
		    `organisation` VARCHAR(250) DEFAULT NULL  COMMENT 'Organisation',
		    `business_type` INT(11) DEFAULT NULL  COMMENT 'Business type',
		    `work_nature` VARCHAR(250) DEFAULT NULL  COMMENT 'work nature',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;