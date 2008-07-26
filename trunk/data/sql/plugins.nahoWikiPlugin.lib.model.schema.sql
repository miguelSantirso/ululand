
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- naho_wiki_page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `naho_wiki_page`;


CREATE TABLE `naho_wiki_page`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`latest_revision` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `naho_wiki_page_name_unique` (`name`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- naho_wiki_revision
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `naho_wiki_revision`;


CREATE TABLE `naho_wiki_revision`
(
	`created_at` DATETIME,
	`page_id` INTEGER  NOT NULL,
	`revision` INTEGER default 1 NOT NULL,
	`user_name` VARCHAR(255)  NOT NULL,
	`comment` VARCHAR(255),
	`content_id` INTEGER  NOT NULL,
	PRIMARY KEY (`page_id`,`revision`,`content_id`),
	CONSTRAINT `naho_wiki_revision_FK_1`
		FOREIGN KEY (`page_id`)
		REFERENCES `naho_wiki_page` (`id`)
		ON DELETE CASCADE,
	INDEX `naho_wiki_revision_FI_2` (`content_id`),
	CONSTRAINT `naho_wiki_revision_FK_2`
		FOREIGN KEY (`content_id`)
		REFERENCES `naho_wiki_content` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- naho_wiki_content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `naho_wiki_content`;


CREATE TABLE `naho_wiki_content`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`content` TEXT,
	`gz_content` LONGBLOB,
	PRIMARY KEY (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
