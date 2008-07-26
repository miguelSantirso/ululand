
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_simple_forum_category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_simple_forum_category`;


CREATE TABLE `sf_simple_forum_category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`stripped_name` VARCHAR(255),
	`description` TEXT,
	`rank` INTEGER,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- sf_simple_forum_forum
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_simple_forum_forum`;


CREATE TABLE `sf_simple_forum_forum`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`description` TEXT,
	`rank` INTEGER,
	`category_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`stripped_name` VARCHAR(255),
	`latest_post_id` INTEGER,
	`nb_posts` BIGINT,
	`nb_topics` BIGINT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sf_simple_forum_forum_stripped_name_unique` (`stripped_name`),
	INDEX `sf_simple_forum_forum_FI_1` (`category_id`),
	CONSTRAINT `sf_simple_forum_forum_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `sf_simple_forum_category` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_simple_forum_forum_FI_2` (`latest_post_id`),
	CONSTRAINT `sf_simple_forum_forum_FK_2`
		FOREIGN KEY (`latest_post_id`)
		REFERENCES `sf_simple_forum_post` (`id`)
		ON DELETE SET NULL
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- sf_simple_forum_topic
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_simple_forum_topic`;


CREATE TABLE `sf_simple_forum_topic`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`is_sticked` INTEGER default 0,
	`is_locked` INTEGER default 0,
	`forum_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`latest_post_id` INTEGER,
	`user_id` INTEGER,
	`stripped_title` VARCHAR(255),
	`nb_posts` BIGINT default 0,
	`nb_views` BIGINT default 0,
	PRIMARY KEY (`id`),
	INDEX `sf_simple_forum_topic_FI_1` (`forum_id`),
	CONSTRAINT `sf_simple_forum_topic_FK_1`
		FOREIGN KEY (`forum_id`)
		REFERENCES `sf_simple_forum_forum` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_simple_forum_topic_FI_2` (`latest_post_id`),
	CONSTRAINT `sf_simple_forum_topic_FK_2`
		FOREIGN KEY (`latest_post_id`)
		REFERENCES `sf_simple_forum_post` (`id`)
		ON DELETE SET NULL,
	INDEX `sf_simple_forum_topic_FI_3` (`user_id`),
	CONSTRAINT `sf_simple_forum_topic_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `account` (`id`)
		ON DELETE SET NULL
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- sf_simple_forum_post
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_simple_forum_post`;


CREATE TABLE `sf_simple_forum_post`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`content` TEXT,
	`topic_id` INTEGER,
	`user_id` INTEGER,
	`created_at` DATETIME,
	`forum_id` INTEGER,
	`author_name` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `sf_simple_forum_post_FI_1` (`topic_id`),
	CONSTRAINT `sf_simple_forum_post_FK_1`
		FOREIGN KEY (`topic_id`)
		REFERENCES `sf_simple_forum_topic` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_simple_forum_post_FI_2` (`user_id`),
	CONSTRAINT `sf_simple_forum_post_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `account` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_simple_forum_post_FI_3` (`forum_id`),
	CONSTRAINT `sf_simple_forum_post_FK_3`
		FOREIGN KEY (`forum_id`)
		REFERENCES `sf_simple_forum_forum` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- sf_simple_forum_topic_view
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_simple_forum_topic_view`;


CREATE TABLE `sf_simple_forum_topic_view`
(
	`user_id` INTEGER  NOT NULL,
	`topic_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`user_id`,`topic_id`),
	CONSTRAINT `sf_simple_forum_topic_view_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `account` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_simple_forum_topic_view_FI_2` (`topic_id`),
	CONSTRAINT `sf_simple_forum_topic_view_FK_2`
		FOREIGN KEY (`topic_id`)
		REFERENCES `sf_simple_forum_topic` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
