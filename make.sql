CREATE TABLE `age_ranges` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `min` tinyint(3) unsigned NOT NULL,
  `max` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

CREATE TABLE `campaigns` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sex` tinyint(3) unsigned NOT NULL,
  `age_range_id` tinyint(3) unsigned NOT NULL,
  `banner` varchar(512) NOT NULL,
  `lp_url` varchar(1023) NOT NULL,
  `cpm` int(11) default '0',
  `cpc` int(11) default '0',
  `ecpm` int(10) unsigned default '0',
  `budget` int(10) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB
;

alter table campaigns add foreign key (age_range_id) references age_ranges(id);

CREATE TABLE `demographics` (
  `uuid` tinyint(3) unsigned NOT NULL auto_increment,
  `sex` tinyint(3) unsigned NOT NULL default '0',
  `age` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`uuid`)
) ENGINE=InnoDB
;

