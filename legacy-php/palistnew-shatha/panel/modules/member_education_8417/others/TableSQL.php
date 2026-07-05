CREATE TABLE `member_education_8417` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `related_id` INT(11) DEFAULT NULL  COMMENT 'Related ID',
		    `name_degree` VARCHAR(250) DEFAULT NULL  COMMENT 'Name of the university (highest degree)',
		    `college_name` VARCHAR(250) DEFAULT NULL  COMMENT 'College Name',
		    `specializationin_arabic` VARCHAR(250) DEFAULT NULL  COMMENT 'Specialization(In Arabic)',
		    `specializationin_english` VARCHAR(250) DEFAULT NULL  COMMENT 'Specialization(In English)',
		    `university_year` INT(11) DEFAULT NULL  COMMENT 'University Graduation Year',
		    `undergraduate_degree` INT(11) DEFAULT NULL  COMMENT 'Undergraduate degree',
		    `appreciation` VARCHAR(250) DEFAULT NULL  COMMENT 'Appreciation',
		    `university_country` INT(11) DEFAULT NULL  COMMENT 'University Country',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;