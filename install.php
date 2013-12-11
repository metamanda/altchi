<?php

/*

for v2: add following db:

  userpermissions
  review_assignments
  user_emails

*/

require('libs/db.php');

global $dbprefix;


//------------------------------------------------------

//
// Table structure for table `authors`
//

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}authors` (
  `id` int(6) NOT NULL auto_increment,
  `submission_id` int(6) NOT NULL default '0',
  `firstname` varchar(40) NOT NULL default '',
  `lastname` varchar(40) NOT NULL default '',
  `order` int(6) NOT NULL default '1',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;
";
@mysql_query($query) or die("unable to run $query");

//-------------------------------------------------------

//
// Table structure for table `bugs`
//

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}bugs` (
  `id` int(6) NOT NULL auto_increment,
  `text` blob NOT NULL,
  `status` varchar(32) NOT NULL default '',
  `userid` int(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9;";
@mysql_query($query) or die("unable to run $query");



// 
// Table structure for table `deleted_reviews`
// 

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}deleted_reviews` (
  `id` int(6) NOT NULL default '0',
  `userid` int(6) NOT NULL default '0',
  `submissionid` int(6) NOT NULL default '0',
  `expertise` varchar(20) NOT NULL default '',
  `quality` int(1) NOT NULL default '0',
  `qualitytext` blob NOT NULL,
  `appropriate` int(1) NOT NULL default '0',
  `appropriatetext` blob NOT NULL,
  `controversial` int(1) NOT NULL default '0',
  `controversialtext` blob NOT NULL,
  `summary` blob NOT NULL,
  `review` blob NOT NULL,
  `relationship` text NOT NULL,
  `submitted` datetime NOT NULL default '0000-00-00 00:00:00',
  `edited` datetime default NULL,
  `deleted` datetime NOT NULL default '0000-00-00 00:00:00',
  `deletedby` int(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
@mysql_query($query) or die("unable to run $query");

// --------------------------------------------------------

// 
// Table structure for table `deleted_submissions`
// 

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}deleted_submissions` (
  `id` int(6) NOT NULL default '0',
  `userid` int(6) NOT NULL default '0',
  `title` text NOT NULL,
  `additionalauthors` blob,
  `type` varchar(30) NOT NULL default '',
  `abstract` blob NOT NULL,
  `filename` text,
  `filesize` int(4) NOT NULL default '0',
  `link` text,
  `keywords` blob,
  `history` blob,
  `videolink` text,
  `comments` blob,
  `submitted` datetime NOT NULL default '0000-00-00 00:00:00',
  `edited` datetime default NULL,
  `forumthreadid` int(6) default NULL,
  `deleted` datetime NOT NULL default '0000-00-00 00:00:00',
  `deletedby` int(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
@mysql_query($query) or die("unable to run $query");

// --------------------------------------------------------

// 
// Table structure for table `log`
// 

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}log` (
  `id` int(6) NOT NULL auto_increment,
  `category` varchar(64) NOT NULL default '',
  `event` text NOT NULL,
  `details` text NOT NULL,
  `userid` int(6) NOT NULL default '0',
  `time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1626 ;
";
@mysql_query($query) or die("unable to run $query");

// --------------------------------------------------------

// 
// Table structure for table `review_commitments`
// 

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}review_commitments` (
  `id` int(6) NOT NULL auto_increment,
  `userid` int(6) NOT NULL default '0',
  `submissionid` int(6) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `reviewid` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;
";
@mysql_query($query) or die("unable to run $query");

// --------------------------------------------------------

// 
// Table structure for table `reviews`
// 

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}reviews` (
  `id` int(6) NOT NULL auto_increment,
  `userid` int(6) NOT NULL default '0',
  `submissionid` int(6) NOT NULL default '0',
  `expertise` varchar(20) NOT NULL default '',
  `quality` int(1) NOT NULL default '0',
  `qualitytext` blob NOT NULL,
  `appropriate` int(1) NOT NULL default '0',
  `appropriatetext` blob NOT NULL,
  `controversial` int(1) NOT NULL default '0',
  `controversialtext` blob NOT NULL,
  `summary` blob NOT NULL,
  `review` blob NOT NULL,
  `relationship` text,
  `submitted` datetime NOT NULL default '0000-00-00 00:00:00',
  `edited` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;
";
@mysql_query($query) or die("unable to run $query");

// --------------------------------------------------------

// 
// Table structure for table `searchwords`
// 

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}searchwords` (
  `swid` int(6) NOT NULL auto_increment,
  `word` varchar(80) NOT NULL default '',
  `location` varchar(80) NOT NULL default '',
  `id` int(6) NOT NULL default '0',
  PRIMARY KEY  (`swid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8826 ;
";
@mysql_query($query) or die("unable to run $query");

// --------------------------------------------------------

// 
// Table structure for table `submissions`
// 

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}submissions` (
  `id` int(6) NOT NULL auto_increment,
  `userid` int(6) NOT NULL default '0',
  `title` text NOT NULL,
  `additionalauthors` blob,
  `type` varchar(30) NOT NULL default '',
  `abstract` blob NOT NULL,
  `filename` text,
  `filesize` int(4) NOT NULL default '0',
  `link` text,
  `keywords` blob,
  `history` blob,
  `videolink` text,
  `comments` blob,
  `submitted` datetime NOT NULL default '0000-00-00 00:00:00',
  `edited` datetime default NULL,
  `averagerating` float default NULL,
  `numreviews` int(4) NOT NULL default '0',
  `forumthreadid` int(6) default NULL,
  `hidden` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;
";
@mysql_query($query) or die("unable to run $query");

//--------------------------------------------------

// 
// Table structure for table `users`
// 

$query = "
CREATE TABLE IF NOT EXISTS `{$dbprefix}users` (
  `id` int(6) NOT NULL auto_increment,
  `user` varchar(64) NOT NULL default '',
  `firstname` varchar(40) NOT NULL default '',
  `lastname` varchar(40) NOT NULL default '',
  `pass` varchar(32) NOT NULL default '',
  `email` varchar(64) NOT NULL default '',
  `affiliation` blob NOT NULL,
  `presentation` blob,
  `status` varchar(20) NOT NULL default 'user',
  `registered` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastlogin` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;
";
@mysql_query($query) or die("unable to run $query");

echo "done. make sure submissions folder exists. (777...)<br>\n";