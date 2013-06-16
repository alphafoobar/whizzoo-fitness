--
-- Table structure for weather service database tables.
-- $Id: weather.sql 36 2009-03-16 09:26:43Z alphafoobar $

-- list of weather stations, full data is stored as XML.
-- path: stations/<ID>/<year>/<month>/<day>/<time>.xml
CREATE TABLE `weather_station` (
	`id` VARCHAR(10) collate utf8_general_ci NOT NULL, -- Station Name, this is unique, use ID to fit Model
	`lat` FLOAT NOT NULL, -- latitude
	`lng` FLOAT NOT NULL, -- longitude
	`description` VARCHAR(100) collate utf8_general_ci NOT NULL, -- description of weather station
	`location_count` INT(10) unsigned NOT NULL, -- number of locations that use this station
	`success` INT(1) unsigned NULL, -- if the last passed, if not then another failure drops from update queue
	`attempt` INT(1) unsigned NULL, -- if the last 2 failed then we don't look for new updates
	`last_path` VARCHAR(100) collate utf8_general_ci NOT NULL, -- this describes the path to the latest info
	`created` timestamp NULL default CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- not technically just for the weather service, but weather is bound to have issues!
CREATE TABLE `error` (
	`id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
	`message` VARCHAR(100) collate utf8_general_ci NOT NULL, -- summary, can be shown to user
  	`detail` text,	-- more information, greater technical detail, stack trace
	PRIMARY KEY(`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;