-- -----------------------------------------------------
-- Table tx_glibi_domain_model_thing
-- -----------------------------------------------------
CREATE TABLE tx_glibi_domain_model_thing (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,

    type int(11) unsigned DEFAULT '0' NOT NULL,
    title varchar(255) NOT NULL DEFAULT '',
    bodytext mediumtext,
    categories int(11) unsigned DEFAULT '0' NOT NULL,
    books int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    INDEX parent (pid),
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table tx_glibi_domain_model_category
-- -----------------------------------------------------
CREATE TABLE tx_glibi_domain_model_category (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,

    title varchar(255) NOT NULL DEFAULT '',
    parent_category int(11) unsigned DEFAULT '0' NOT NULL,
    things int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    INDEX parent (pid),
    INDEX parent_category (parent_category)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table tx_glibi_domain_model_thing_category_mm
-- -----------------------------------------------------
CREATE TABLE tx_glibi_domain_model_thing_category_mm (
    uid_local int(11) unsigned DEFAULT '0' NOT NULL COMMENT 'thing',
    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL COMMENT 'category',

    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid_local,uid_foreign)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ENGINE = InnoDB COMMENT = 'TYPO3-style mn table';

-- -----------------------------------------------------
-- Table tx_glibi_domain_model_book
-- -----------------------------------------------------
CREATE TABLE tx_glibi_domain_model_book (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,

    identifier char(64) DEFAULT '' NOT NULL,
    things int(11) unsigned DEFAULT '0' NOT NULL,
    searchconfig mediumblob,

    PRIMARY KEY (uid),
    INDEX parent (pid),
    UNIQUE identifier(identifier)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table tx_glibi_domain_model_thing_book_mm
-- -----------------------------------------------------
CREATE TABLE tx_glibi_domain_model_thing_book_mm (
    uid_local int(11) unsigned DEFAULT '0' NOT NULL COMMENT 'thing',
    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL COMMENT 'book',

    sorting int(11) unsigned DEFAULT '0' NOT NULL,
    sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid_local,uid_foreign)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ENGINE = InnoDB COMMENT = 'TYPO3-style mn table';
