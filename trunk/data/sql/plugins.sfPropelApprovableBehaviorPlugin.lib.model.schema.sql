
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_approval
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_approval`;


CREATE TABLE `sf_approval`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`approvable_model` VARCHAR(30),
	`approvable_id` INTEGER,
	`uuid` VARCHAR(36),
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
