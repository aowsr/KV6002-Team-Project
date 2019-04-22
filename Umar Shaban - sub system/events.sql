
DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `eventID` int(10) NOT NULL auto_increment,
  `eventTitle` varchar(256) NOT NULL,
  `eventDescription` varchar(256) default NULL,
  `location` varchar (256) default NULL,
  `eventStartDate` date default NULL,
  `eventEndDate` date default NULL,
  `eventPrice` decimal(4,2) default NULL,
  PRIMARY KEY  (`eventID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
INSERT INTO `events` (`eventID`, `eventTitle`, `eventDescription`, `location`,  `eventStartDate`, `eventEndDate`, `eventPrice`) VALUES
(1, 'Lake District Tour', 'The lake District is located in the north west of england and it is well known for its lakes, forests and mountains. In this event you will enjoy a guided tour showcasing the beauty of the Lake District', 'Lake District', '2016-11-30', '2017-10-19', '120.00'),
(2, 'Alnwick Castle Tour', 'Enjoy a fantastic experience of Alnwick castle which is located in the english county of Northumberland', 'Northumberland',  '2017-06-24', '2017-06-24', '42.50'),
(3, 'Bus Tour', 'Get ready to explore the amazing city of Edinburgh by jumping onto our bus tour where you will be guided to 10 fantastic locations to  highlight the heritage of Edinburgh', 'Edinburgh', '2017-12-12', '2017-12-12', '30.00'),
(4, 'Glasgow Water Rafting', 'Come along to Glasgow to enjoy water rafting which is one of the most exhilarating river activities you will ever experience', 'Glasgow', '2017-06-11', '2017-07-11', '0.00'),
(5, 'St James Park Tour', 'Come visit st James which is home to the best football club in the UK Newcastle United, in this tour you will get to visit the all parts of the stadium such as the team changing rooms, the pitch, managers press conference table and much more!', 'Newcastle', '2017-02-01', '2017-02-01', '20.00');

--
-- Creating the table structure for table `AE_venue`
--









