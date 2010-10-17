
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- session
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `session`;


CREATE TABLE `session`
(
	`id` VARCHAR(40)  NOT NULL,
	`data` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(100)  NOT NULL,
	`password` VARCHAR(40)  NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
