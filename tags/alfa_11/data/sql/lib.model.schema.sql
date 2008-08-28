
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`username` VARCHAR(30),
	`first_name` VARCHAR(20),
	`last_name` VARCHAR(20),
	`culture` VARCHAR(8),
	PRIMARY KEY (`id`),
	INDEX `sf_guard_user_profile_FI_1` (`user_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- developer_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `developer_profile`;


CREATE TABLE `developer_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_profile_id` INTEGER  NOT NULL,
	`url` VARCHAR(64),
	`description` TEXT,
	`is_free` INTEGER default 0,
	PRIMARY KEY (`id`),
	INDEX `developer_profile_FI_1` (`user_profile_id`),
	CONSTRAINT `developer_profile_FK_1`
		FOREIGN KEY (`user_profile_id`)
		REFERENCES `sf_guard_user_profile` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- player_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `player_profile`;


CREATE TABLE `player_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_profile_id` INTEGER  NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	INDEX `player_profile_FI_1` (`user_profile_id`),
	CONSTRAINT `player_profile_FK_1`
		FOREIGN KEY (`user_profile_id`)
		REFERENCES `sf_guard_user_profile` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- avatar
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `avatar`;


CREATE TABLE `avatar`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`profile_id` INTEGER  NOT NULL,
	`api_key` VARCHAR(13),
	`gender` INTEGER  NOT NULL,
	`total_credits` INTEGER default 0,
	`spent_credits` INTEGER default 0,
	PRIMARY KEY (`id`),
	INDEX `avatar_FI_1` (`profile_id`),
	CONSTRAINT `avatar_FK_1`
		FOREIGN KEY (`profile_id`)
		REFERENCES `sf_guard_user_profile` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- grupo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `grupo`;


CREATE TABLE `grupo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64)  NOT NULL,
	`description` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- avatar_grupo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `avatar_grupo`;


CREATE TABLE `avatar_grupo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`avatar_id` INTEGER,
	`grupo_id` INTEGER,
	`is_owner` INTEGER default 0,
	`is_approved` INTEGER default 0,
	PRIMARY KEY (`id`),
	INDEX `avatar_grupo_FI_1` (`avatar_id`),
	CONSTRAINT `avatar_grupo_FK_1`
		FOREIGN KEY (`avatar_id`)
		REFERENCES `avatar` (`id`)
		ON DELETE CASCADE,
	INDEX `avatar_grupo_FI_2` (`grupo_id`),
	CONSTRAINT `avatar_grupo_FK_2`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- friendship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `friendship`;


CREATE TABLE `friendship`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_avatar_a` INTEGER  NOT NULL,
	`a_confirmed` INTEGER default 0,
	`id_avatar_b` INTEGER  NOT NULL,
	`b_confirmed` INTEGER default 0,
	PRIMARY KEY (`id`),
	INDEX `friendship_FI_1` (`id_avatar_a`),
	CONSTRAINT `friendship_FK_1`
		FOREIGN KEY (`id_avatar_a`)
		REFERENCES `avatar` (`id`),
	INDEX `friendship_FI_2` (`id_avatar_b`),
	CONSTRAINT `friendship_FK_2`
		FOREIGN KEY (`id_avatar_b`)
		REFERENCES `avatar` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- collaboration_offer
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `collaboration_offer`;


CREATE TABLE `collaboration_offer`
(
	`created_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`title` VARCHAR(75)  NOT NULL,
	`stripped_title` VARCHAR(75)  NOT NULL,
	`description` TEXT  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `collaboration_offer_FI_1` (`created_by`),
	CONSTRAINT `collaboration_offer_FK_1`
		FOREIGN KEY (`created_by`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- code_piece
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `code_piece`;


CREATE TABLE `code_piece`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`uuid` VARCHAR(36)  NOT NULL,
	`created_by` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`title` VARCHAR(75)  NOT NULL,
	`stripped_title` VARCHAR(75)  NOT NULL,
	`source` TEXT  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `code_piece_FI_1` (`created_by`),
	CONSTRAINT `code_piece_FK_1`
		FOREIGN KEY (`created_by`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- itemtype
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `itemtype`;


CREATE TABLE `itemtype`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item`;


CREATE TABLE `item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64)  NOT NULL,
	`gender` INTEGER  NOT NULL,
	`id_itemtype` INTEGER  NOT NULL,
	`url` VARCHAR(255)  NOT NULL,
	`description` VARCHAR(255),
	`price` INTEGER default 0,
	PRIMARY KEY (`id`),
	INDEX `item_FI_1` (`id_itemtype`),
	CONSTRAINT `item_FK_1`
		FOREIGN KEY (`id_itemtype`)
		REFERENCES `itemtype` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- avatarpiece
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `avatarpiece`;


CREATE TABLE `avatarpiece`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64)  NOT NULL,
	`description` VARCHAR(255),
	`author_id` INTEGER,
	`owner_id` INTEGER,
	`url` VARCHAR(255)  NOT NULL,
	`price` INTEGER default 0,
	`type` VARCHAR(64)  NOT NULL,
	`in_use` INTEGER default 0,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `avatarpiece_FI_1` (`author_id`),
	CONSTRAINT `avatarpiece_FK_1`
		FOREIGN KEY (`author_id`)
		REFERENCES `avatar` (`id`)
		ON DELETE SET NULL,
	INDEX `avatarpiece_FI_2` (`owner_id`),
	CONSTRAINT `avatarpiece_FK_2`
		FOREIGN KEY (`owner_id`)
		REFERENCES `avatar` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- avatar_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `avatar_item`;


CREATE TABLE `avatar_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_avatar` INTEGER  NOT NULL,
	`id_item` INTEGER  NOT NULL,
	`active` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `avatar_item_FI_1` (`id_item`),
	CONSTRAINT `avatar_item_FK_1`
		FOREIGN KEY (`id_item`)
		REFERENCES `item` (`id`)
		ON DELETE CASCADE,
	INDEX `avatar_item_FI_2` (`id_avatar`),
	CONSTRAINT `avatar_item_FK_2`
		FOREIGN KEY (`id_avatar`)
		REFERENCES `avatar` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- game
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `game`;


CREATE TABLE `game`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`privileges_level` INTEGER default 2 NOT NULL,
	`api_key` VARCHAR(13),
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`thumbnail_path` VARCHAR(255),
	`url` VARCHAR(255)  NOT NULL,
	`width` INTEGER  NOT NULL,
	`height` INTEGER  NOT NULL,
	`bgcolor` VARCHAR(8),
	`gameplays` INTEGER default 0,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- widget
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `widget`;


CREATE TABLE `widget`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`privileges_level` INTEGER default 2 NOT NULL,
	`api_key` VARCHAR(13),
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`url` VARCHAR(255)  NOT NULL,
	`width` INTEGER  NOT NULL,
	`height` INTEGER  NOT NULL,
	`bgcolor` VARCHAR(8),
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;


CREATE TABLE `comment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_avatar` INTEGER  NOT NULL,
	`id_game` INTEGER  NOT NULL,
	`text` TEXT  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `comment_FI_1` (`id_game`),
	CONSTRAINT `comment_FK_1`
		FOREIGN KEY (`id_game`)
		REFERENCES `game` (`id`)
		ON DELETE CASCADE,
	INDEX `comment_FI_2` (`id_avatar`),
	CONSTRAINT `comment_FK_2`
		FOREIGN KEY (`id_avatar`)
		REFERENCES `avatar` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- message
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `message`;


CREATE TABLE `message`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_sender` INTEGER  NOT NULL,
	`id_recipient` INTEGER  NOT NULL,
	`text` TEXT  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `message_FI_1` (`id_sender`),
	CONSTRAINT `message_FK_1`
		FOREIGN KEY (`id_sender`)
		REFERENCES `avatar` (`id`)
		ON DELETE CASCADE,
	INDEX `message_FI_2` (`id_recipient`),
	CONSTRAINT `message_FK_2`
		FOREIGN KEY (`id_recipient`)
		REFERENCES `avatar` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- apisession
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `apisession`;


CREATE TABLE `apisession`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`session_id` VARCHAR(12)  NOT NULL,
	`avatar_apikey` VARCHAR(13)  NOT NULL,
	`api_key` VARCHAR(13)  NOT NULL,
	`privileges_level` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- gamestat
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `gamestat`;


CREATE TABLE `gamestat`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`game_id` INTEGER,
	`gamestattype_id` INTEGER,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	INDEX `gamestat_FI_1` (`game_id`),
	CONSTRAINT `gamestat_FK_1`
		FOREIGN KEY (`game_id`)
		REFERENCES `game` (`id`)
		ON DELETE CASCADE,
	INDEX `gamestat_FI_2` (`gamestattype_id`),
	CONSTRAINT `gamestat_FK_2`
		FOREIGN KEY (`gamestattype_id`)
		REFERENCES `gamestattype` (`id`)
		ON DELETE SET NULL
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- gamestattype
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `gamestattype`;


CREATE TABLE `gamestattype`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- gamestat_avatar
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `gamestat_avatar`;


CREATE TABLE `gamestat_avatar`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`gamestat_id` INTEGER,
	`avatar_id` INTEGER,
	`value` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `gamestat_avatar_FI_1` (`gamestat_id`),
	CONSTRAINT `gamestat_avatar_FK_1`
		FOREIGN KEY (`gamestat_id`)
		REFERENCES `gamestat` (`id`)
		ON DELETE CASCADE,
	INDEX `gamestat_avatar_FI_2` (`avatar_id`),
	CONSTRAINT `gamestat_avatar_FK_2`
		FOREIGN KEY (`avatar_id`)
		REFERENCES `avatar` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- chat_message
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `chat_message`;


CREATE TABLE `chat_message`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` VARCHAR(37)  NOT NULL,
	`created_at` DATETIME,
	`chat_message` TEXT  NOT NULL,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- chat_useronline
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `chat_useronline`;


CREATE TABLE `chat_useronline`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` VARCHAR(37)  NOT NULL,
	`user_name` VARCHAR(64)  NOT NULL,
	`avatar_api_key` VARCHAR(13)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
