--
-- Table structure for database fitness.
-- $Id: tables.sql 35 2009-03-16 00:55:27Z alphafoobar $

-- this table is specific to all types of users (we'll collect from all networks - hence no email data)
DROP TABLE `users`;
CREATE TABLE `users` (  
  	`id` int(11) AUTO_INCREMENT NOT NULL,  
  	`name` text,  
	`location` INT(10) unsigned NULL,
	`thumb_id` INT(10) unsigned NOT NULL, -- allows the setting of an image for a location
	`email` VARCHAR(255) collate utf8_general_ci NULL,
	`about` VARCHAR(255) collate utf8_general_ci default NULL,
	`password` VARCHAR(100) collate utf8_general_ci NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
  	PRIMARY KEY `id` (`id`)  
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `facebook_users` (  
	`fb_uid` bigint(11) default NULL,  
	`email_hash` varchar(64) default NULL,  
	`account_id` int(11) NOT NULL,  
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
 PRIMARY KEY `fb_uid` (`fb_uid`)  
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- thumbs associated with photos
DROP TABLE `thumbs`;
CREATE TABLE `thumbs` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`photo_id` INT(10) unsigned NOT NULL,
	`user_id` INT(10) unsigned NOT NULL,
	`name` VARCHAR(100) collate utf8_general_ci NULL,
	`thumb` BLOB NOT NULL,
	`thumb_x` INT(10) NOT NULL, -- dimansions
	`thumb_y` INT(10) NOT NULL,
	`location_id` INT(10) unsigned NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- photos may also be added to anything
DROP TABLE `photos`;
CREATE TABLE `photos` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) collate utf8_general_ci NULL,
	`image` BLOB NOT NULL,
	`image_x` INT(10) NOT NULL, -- dimensions
	`image_y` INT(10) NOT NULL,
	`location_id` INT(10) unsigned NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE `invitations`;
CREATE TABLE `invitations` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(10),
	`name` VARCHAR(100) collate utf8_general_ci NULL,
	`email` VARCHAR(255) collate utf8_general_ci NULL,
	`message` VARCHAR(100) collate utf8_general_ci NULL,
	`response` INT(10), --  accept, question, 
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- locations might be connected to a user or a workout session... they might have names as well
DROP TABLE `locations`;
CREATE TABLE `locations` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(10) unsigned NOT NULL,
	`thumb_id` INT(10) unsigned NOT NULL, -- allows the setting of an image for a location
	`location_name` VARCHAR(100) collate utf8_general_ci NULL,
	`time_zone` VARCHAR(4) collate utf8_general_ci NULL, -- exercise dates stores as GMT
	`icao` VARCHAR(4) collate utf8_general_ci NULL, -- allows look up of temperature data
	`detail` VARCHAR(100) collate utf8_general_ci NULL,
	`city` VARCHAR(100) collate utf8_general_ci NULL,
	`postcode` VARCHAR(20) collate utf8_general_ci NULL,
	`country` VARCHAR(50) collate utf8_general_ci NULL,
	`lat` FLOAT NULL,
	`lng` FLOAT NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- course might be connected to a user or a workout session... they might have names as well
DROP TABLE `course`;
CREATE TABLE `course` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(10),
	`name` VARCHAR(100) collate utf8_general_ci NULL,
	`detail` VARCHAR(100) collate utf8_general_ci NULL,
	`location_id` INT(10) unsigned NOT NULL,
	`lat_lngs` text,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE `workout_type`;
CREATE TABLE `workout_type` (
	`workout_type` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(40) collate utf8_general_ci NOT NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`workout_type`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- insert some data
INSERT INTO workout_type (workout_type, description, modified) VALUES (0,'Other', NOW());
INSERT INTO workout_type (description, modified) VALUES ('Run', NOW());
INSERT INTO workout_type (description, modified) VALUES ('Erg', NOW());
INSERT INTO workout_type (description, modified) VALUES ('Row', NOW());
INSERT INTO workout_type (description, modified) VALUES ('Cycle', NOW());
INSERT INTO workout_type (description, modified) VALUES ('Cross trainer', NOW());
INSERT INTO workout_type (description, modified) VALUES ('Gym', NOW());
INSERT INTO workout_type (description, modified) VALUES ('Swim', NOW());
INSERT INTO workout_type (description, modified) VALUES ('Mountain biking', NOW());

DROP TABLE `weights`;
CREATE TABLE `weights` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(10),
	`sets` INT(10),
	`repititions` INT(10),
	`description` VARCHAR(40) collate utf8_general_ci NOT NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE `meals`;
CREATE TABLE `meals` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(10),
	`location_id` INT(10),
	`description` VARCHAR(40) collate utf8_general_ci NOT NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE `groups`;
CREATE TABLE `groups` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(10),
	`location_id` INT(10),
	`description` VARCHAR(40) collate utf8_general_ci NOT NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE `memberships`;
CREATE TABLE `memberships` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(10),
	`group_id` INT(10),
	`level` INT(10), -- owner, admin, group, blocked
	`description` VARCHAR(40) collate utf8_general_ci NOT NULL, -- really the role description, allows descriptive naming
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE `comments`;
CREATE TABLE `comments` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`by_user` INT(10) unsigned NOT NULL,
	`group_id` INT(10) unsigned NULL, -- the id of the recipient comment / group
	`message` VARCHAR(255) collate utf8_general_ci NOT NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE `contacts`;
CREATE TABLE `contacts` (
	`user_id` INT(10) unsigned NOT NULL,
	`contact_id` INT(10) unsigned NOT NULL,
	`reln_type` INT(10),
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`user_id`,`contact_id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE `sessions`;
CREATE TABLE `sessions` (
	`id` INT(10) unsigned NOT NULL,
	`user_id` INT(10) unsigned NOT NULL,
	`location` INT(10),
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- contact table contains user data specific to a workout
DROP TABLE `workout`;
CREATE TABLE `workout` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(10) unsigned NOT NULL,
	`workout_type` INT(10) unsigned NOT NULL, --  from the workout type table [erg, run, cycle]
	`record_type` INT(10) unsigned NOT NULL, -- planned, executed, template
	`time` timestamp NULL,
	`distance` INT(10) unsigned NULL,
	`hours` INT(10) unsigned NULL,
	`mins` INT(10) unsigned NULL,
	`secs` FLOAT unsigned NULL,
	`ave_hr` INT(10) unsigned NULL,
	`max_hr` INT(10) unsigned NULL,
	`kcal` INT(10) unsigned NULL,
	`ave_watts` INT(10) unsigned NULL,
	`other_type` VARCHAR(20) collate utf8_general_ci NULL,
	`location` INT(10) unsigned NULL,
	`weight` INT(10) unsigned NULL,
	`mood` VARCHAR(40) collate utf8_general_ci NULL,
	`difficulty` INT(10) unsigned NULL,
	`path` TEXT BINARY NULL,
	`notes` VARCHAR(255) collate utf8_general_ci NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `weather`;
CREATE TABLE `weather` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`location` INT(10) unsigned NULL,
	`time` timestamp NULL,
	`temperature` INT(10) unsigned NULL,
	`clouds` VARCHAR(40) collate utf8_general_ci NULL, 
	`humidity` INT(10) unsigned NULL,
	`wind_direction` INT(10) unsigned NULL,
	`wind_speed` INT(10) unsigned NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `erg_make`;
CREATE TABLE `erg_make` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`manufacturer` VARCHAR(40) collate utf8_general_ci NULL, -- who makes it: i.e. concept2, rowperfect
	`version` VARCHAR(40) collate utf8_general_ci NULL, -- model type: i.e. A,B,C or particular brand and model
	`url` VARCHAR(255) collate utf8_general_ci NULL, -- supplier URL
	`notes` VARCHAR(255) collate utf8_general_ci NULL, -- any other notes
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- insert some data
INSERT INTO erg_make (manufacturer, version, modified) VALUES ('Concept2', 'Model E', NOW());
INSERT INTO erg_make (manufacturer, version, modified) VALUES ('Concept2', 'Model D', NOW());
INSERT INTO erg_make (manufacturer, version, modified) VALUES ('Concept2', 'Model C', NOW());
INSERT INTO erg_make (manufacturer, version, modified) VALUES ('Rowperfect', 'Original', NOW());
INSERT INTO erg_make (manufacturer, version, modified) VALUES ('Rowperfect', 'Indoor Sculler', NOW());

DROP TABLE IF EXISTS `erg_workout`;
CREATE TABLE `erg_workout` (
	`id` INT(10) unsigned NOT NULL, -- link to workout.id
	`user_id` INT(10) unsigned NOT NULL,
	`erg_make_id` INT(10) unsigned NOT NULL, -- link to erg make
	`watts` INT(10) unsigned NULL,
	`drag` INT(10) unsigned NULL,
	`splits` VARCHAR(10) collate utf8_general_ci NULL,
	`ave_rating` INT(10) unsigned NULL,
	`settings` VARCHAR(10) collate utf8_general_ci NULL,
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;