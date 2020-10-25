# phpMyAdmin MySQL-Dump
# version 2.2.2
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# --------------------------------------------------------

#
# Table structure for table `eascont`
#

CREATE TABLE eascont (
    artid     INT(11)     NOT NULL AUTO_INCREMENT,
    easyid    INT(11)     NOT NULL DEFAULT '0',
    url_title VARCHAR(16) NOT NULL DEFAULT '',
    title     TEXT        NOT NULL,
    content   LONGTEXT,
    counter   INT(11)     NOT NULL DEFAULT '0',
    weight    INT(3)      NOT NULL DEFAULT '0',
    isactive  TINYINT(1)  NOT NULL DEFAULT '0',
    PRIMARY KEY (artid),
    KEY idxeasyconteasyid (easyid),
    KEY idxeasycontcounterdesc (counter)
)
    ENGINE = ISAM;


#
# Table structure for table `easyweb`
#

CREATE TABLE easyweb (
    easyid   INT(11)     NOT NULL AUTO_INCREMENT,
    easyname VARCHAR(16) NOT NULL DEFAULT '',
    weight   INT(3)      NOT NULL DEFAULT '0',
    isactive TINYINT(1)  NOT NULL DEFAULT '0',
    PRIMARY KEY (easyid),
    KEY idxeasytionseasyname (easyname)
)
    ENGINE = ISAM;


#
# Table structure for table `easyweb_startpage`
#

CREATE TABLE easyweb_startpage (
    id      INT(11) NOT NULL AUTO_INCREMENT,
    content LONGTEXT,
    PRIMARY KEY (id)
)
    ENGINE = ISAM;

