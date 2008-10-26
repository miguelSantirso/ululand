#
# Table structure for table `chat_message`
#

DROP TABLE IF EXISTS chat_message;
CREATE TABLE chat_message (
  user_id varchar(37) NOT NULL default '0',
  chat_data double NOT NULL default '0',
  chat_message text NOT NULL,
  KEY user_id(user_id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `chat_useronline`
#

DROP TABLE IF EXISTS chat_useronline;
CREATE TABLE chat_useronline (
  user_id char(37) NOT NULL default '0',
  user_name char(15) NOT NULL default '',
  user_date double NOT NULL default '0',
  KEY user_id(user_id)
) TYPE=MyISAM;