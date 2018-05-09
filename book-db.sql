-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: mysql.cs.uky.edu    Database: lnwo224
-- ------------------------------------------------------
-- Server version	5.5.5-10.0.31-MariaDB-0ubuntu0.16.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `ISBN` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Authors` varchar(45) NOT NULL,
  `Summary` varchar(250) NOT NULL,
  `Language` varchar(45) NOT NULL,
  `Publish_Date` date NOT NULL,
  `Publisher` varchar(45) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'Boats n Stuff','Scruff Boatington','About boats and stuff.','English','1885-07-15','Scholastic Books',180,3.51),(2,'Cat Lady Life','Mildred Boringham,Fluffy Amazing Whiskers','You arent really crazy yet.','English','1920-12-12','Boring Company',15,1.71),(3,'Merica','Hillbilly Joe','The best planet in the whole world.','Merican','1776-06-04','Joe',49,50.50),(4,'M\'lady','Keith Neckbeard','Embrace the Cringe','English','1999-02-02','NeckingBeard Hall',60,30.61),(5,'Cosplaying','Some Deadpool Guy','Learn to cosplay as only deadpool.','English','2015-06-06','Deadpool C',398,600.23),(6,'Futball','Dan Dannington','Learn to toss the old Pig Skin','English','1775-12-11','The Proper Company',50,45.50),(7,'My Fingers are Dead','The Writer','Why, just why.','Help','1669-07-06','Existential Crisis',0,1000.22),(8,'When will the End','Greg Suffering','A guide to delicious cookies.','No','2020-05-08','Why did i do this',19,30.20),(9,'How not to create a black hole in the living room.','Some Guy','This doesnt work.','Hawking','2050-02-08','The Deed is done',5995,2.22),(10,'Why you should separate your crocodiles and your babies','Incompetent Mother','You would think i would learn the first 8 times.','English','1450-06-05','Sweets',194,5335.33),(11,'When You cross the Gandi','Muhammad','Im not sure where i was going with this','English','1500-02-06','I dont even know',459,600.30),(12,'What is love','Baby dont hurt me','No more','What can i say','1999-02-09','Its up to you',79992,5000.69),(13,'How to Guide to being an Adult','A Tumblr User','Fake it till you make it.','LOL','1550-06-05','Cant Even',499,90.56),(14,'What is the meaning of this','This is too','Im so tired','English','1860-08-07','Send Help',420,4.20),(15,'I hope This works','Im glad i saved','Or did I','Who knows','1453-03-07','I hope so',89995,23.20),(19,'The Human Anatomy','Bill Jackson, Peter Huffington','Textbook about the human anatomy','English','2010-02-02','Goodyear',298,115.99),(21,'Some Dads','James Dad','Dads come in all shapes and sizes and personalities!','English','2017-05-01','Dad Co',299,20.30),(22,'Cat in the Hat','Dr. Seuss','A book about a cat that wears a hat.','English','2000-05-12','Cat Co',16,15.00),(25,'Emperor With Money','Waylon Dalton, Justine Henderson','He go the muns hun','Chinese','1832-06-20','The Company',52,30.21),(26,'Human Of The Banished','Abdullah Lang, Marcus Cruz','He was banished from something.','German','1225-02-03','The Crusaders',63,40.51),(27,'Mice Of Wood','Thalia Cobb','Wood mice take over the city.','German','1561-05-07','Micer',20,10.58),(28,'Trees Of Twilight','Mathias Little','When trees come to life.','English','1868-05-09','Not Another One',100,84.56),(29,'Pilots And Snakes','Eddie Randolph','The sequel nobody asked for.','Spanish','2001-05-07','Universal',19,73.26),(30,'Goal Without A Home','Angela Walker','He is not home bound but he is walking fast.','English','1765-04-08','Wut.Inc',654,2.32),(31,'Staff With Immortality','Lia Shelton','Story of an immortal hotel.','French','1989-12-01','Hotelllz',52,21.65),(32,'Death At The Sun','Hadassah Hartman','See what happens when you fly to the sun.','English','1010-03-25','Icarus',43,82.11),(33,'Hobgoblin Of Limbo','Joanna Shaffer','When you die this might be who you meet.','Russian','1766-06-13','YeOlde',51,13.26),(34,'Mermen And Pilots','Jonathon Sheppard','How these relate is anyones guess.','Chinese','2015-06-22','PiloM',610,66.66),(35,'Robot In The Hallway','Roger Williamson','Robots, they are int hallway.','English','1232-05-04','Beep',40,15.75),(36,'Wife And Fool','Kelli	Valdez','Never call the wife the fool, ever.','English','2016-12-25','The Fool',800,752.21);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `UserIDc` int(11) NOT NULL,
  `ISBNc` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserIDc`,`ISBNc`),
  KEY `ISBNc_idx` (`ISBNc`),
  CONSTRAINT `ISBNc` FOREIGN KEY (`ISBNc`) REFERENCES `books` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `UserIDc` FOREIGN KEY (`UserIDc`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (3,1,4),(3,8,1),(3,9,30),(5,4,1),(6,25,2),(9,19,1),(9,33,3),(11,26,2),(13,14,2),(13,21,1),(15,13,1),(17,1,1),(17,4,1),(21,2,1),(21,11,1),(21,30,1),(21,34,1),(22,1,3),(25,36,100),(26,5,2),(26,12,2),(26,15,2),(27,4,1),(27,6,1),(28,27,1),(28,28,3),(28,29,1),(29,31,1),(29,32,2),(30,1,2),(30,4,1),(30,6,1),(31,13,2),(31,14,1);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keywords` (
  `ISBNk` int(11) NOT NULL,
  `Word` varchar(45) NOT NULL,
  PRIMARY KEY (`ISBNk`,`Word`),
  CONSTRAINT `ISBNk` FOREIGN KEY (`ISBNk`) REFERENCES `books` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keywords`
--

LOCK TABLES `keywords` WRITE;
/*!40000 ALTER TABLE `keywords` DISABLE KEYS */;
INSERT INTO `keywords` VALUES (1,'boats'),(2,'Cats'),(3,'History'),(3,'United States'),(4,'Waifu'),(5,'Action'),(6,'Football'),(6,'Sports'),(7,'Fingers'),(8,'Cooking'),(9,'Physics'),(10,'How'),(11,'Philosophy'),(12,'Love'),(13,'ROFL'),(14,'Wow'),(15,'Works'),(19,'Medicine'),(21,'Dad'),(22,'Children'),(25,'Money'),(26,'Mystery'),(27,'Mice'),(28,'Nature'),(29,'Reboot'),(30,'Homebound'),(31,'hotel'),(32,'Myth'),(33,'Goblin'),(34,'Planes');
/*!40000 ALTER TABLE `keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_isbn`
--

DROP TABLE IF EXISTS `order_isbn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_isbn` (
  `ISBNo` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Quant_ord` int(11) DEFAULT NULL,
  PRIMARY KEY (`ISBNo`,`OrderID`),
  KEY `OrderID_idx` (`OrderID`),
  CONSTRAINT `ISBNo` FOREIGN KEY (`ISBNo`) REFERENCES `books` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `OrderID` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_isbn`
--

LOCK TABLES `order_isbn` WRITE;
/*!40000 ALTER TABLE `order_isbn` DISABLE KEYS */;
INSERT INTO `order_isbn` VALUES (1,37,1),(1,41,20),(2,5,7),(2,19,2),(2,21,4),(2,27,4),(2,28,5),(2,29,1),(2,31,1),(2,45,1),(2,46,4),(3,6,2),(3,9,2),(3,11,1),(3,21,2),(3,34,1),(4,15,1),(5,6,2),(5,33,1),(5,46,1),(6,2,3),(6,35,1),(6,44,5),(7,40,1),(8,38,1),(9,5,8),(9,30,1),(9,42,4),(10,32,3),(11,11,3),(11,24,5),(11,25,20),(11,28,20),(11,42,1),(12,8,3),(13,6,1),(13,30,1),(14,7,2),(15,42,5),(19,35,2),(21,42,1),(22,22,1),(22,27,5),(22,31,4),(26,42,2),(28,36,1),(29,29,1),(30,39,1),(32,43,2),(33,30,1),(34,39,1),(35,44,6);
/*!40000 ALTER TABLE `order_isbn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `Billing` varchar(60) DEFAULT NULL,
  `Shipping` varchar(60) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Cost` decimal(10,2) DEFAULT NULL,
  `Card_Num` int(11) DEFAULT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `UserID_idx` (`UserID`),
  CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'In Process','1600 Pennsylvania Washington DC 10928','1600 Pennsylvania Washington DC 10928','2016-02-17',3.50,111),(2,2,'Shipped','1600 Pennsylvania Washington DC 10928','12 Donald Duck Ln Miami Fl 48742','2011-01-11',61.22,162),(3,3,'Delivered','5 Kings Square Ln Strathholme 20205','5 Kings Square Ln Strathholme 20205','2000-05-20',1.11,371),(4,4,'Shipped','310 Lakeshore Dr Baltimore MD 32360','310 Lakeshore Dr Baltimore MD 32360','1999-09-30',30.20,348),(5,5,'In Process','200 Milky Way Dr Hollywood CA 93827','200 Milky Way Dr Hollywood CA 93827','2018-03-25',1.11,177),(6,6,'Shipped','123 Starshoot Way San Antonio TX 24025','123 Starshoot Way San Antonio TX 24025','2018-03-17',16005.99,341),(7,7,'Delivered','539 Aries Rd March ARB CA 98322','539 Aries Rd March ARB CA 98322','2009-07-03',1200.46,118),(8,8,'In Process','302 River Run Hilton Head SC 29594','302 River Run Hilton Head SC 29594','2018-03-22',42.00,304),(9,9,'Delivered','78 Terrance Dr Lexington KY 40308','78 Terrance Dr Lexington KY 40308','2015-06-01',69.60,405),(10,10,'In Process','832 Neonite PKWAY Boise ID 78372','832 Neonite PKWAY Boise ID 78372','2018-03-20',175.00,145),(11,1,'Delivered','1600 Pennsylvania Washington DC 10928','1600 Pennsylvania Washington DC 10928','2017-08-16',2401.20,399),(12,14,'In Process','539 Air Depot Midwest City OK 73110','539 Air Depot Midwest City OK 73110','2018-03-22',90.56,445),(13,12,'Cancelled','382 Main St Detroit MI 19384','382 Main St Detroit MI 19384','2005-02-13',50.50,471),(14,4,'Shipped','500 Lane Allen Rd Boston MA 49874','500 Lane Allen Rd Boston MA 49874','2018-03-15',5335.33,350),(15,5,'Cancelled','100 Nike Way Phoenix AZ 68382','100 Nike Way Phoenix AZ 68382','2001-09-11',1200.46,829),(19,19,'In Process','123 Lane Ln','123 Lane Ln','2018-04-12',1.71,2147483647),(21,18,'In Process','456 Street St','456 Street St','2018-04-12',52.21,2147483647),(22,19,'In Process','6789 Dr. Seuss Lane','6789 Dr. Seuss Lane','2018-04-12',15.00,2147483647),(23,19,'In Process','gagrsdga','gadhbraegrae','2018-04-12',3.51,2147483647),(24,10,'In Process','adsadsa','asddaas','2018-04-12',600.30,12345543),(25,14,'In Process','sdkfjnsdkjf','ksjfnfdkjsnl','2018-04-12',600.30,456789),(26,21,'In Process','srdtfyguhijugytf','fghjnkljhgtf','2018-04-12',5338.84,3456789),(27,22,'In Process','Example','Example','2018-04-13',15.00,123),(28,17,'In Process','test','test','2018-04-15',605.52,123),(29,16,'In Process','12 asd ln','12 asd ln','2018-04-18',74.97,1234),(30,17,'In Process','321 sdf','321 sdf','2018-04-18',106.04,234),(31,18,'In Process','7654 erggf','7654 erggf','2018-04-18',16.71,654),(32,19,'In Process','874 jhg','874 jhg','2018-04-18',5335.33,4564),(33,21,'In Process','983 rdigdo','1600 Pennsylvania Washington DC','2018-04-18',600.23,332),(34,22,'In Process','989 sdds','989 sdds','2018-04-18',50.50,522),(35,23,'In Process','6564 ghjk apt 3','6564 ghjk apt 3','2018-04-18',161.49,111),(36,25,'In Process','NeverNeverLand','NeverNeverLand','2018-04-18',84.56,322),(37,26,'In Process','432  poiuy','432  poiuy','2018-04-18',3.51,251),(38,27,'In Process','DisneyWorld','DisneyWorld','2018-04-18',30.20,27),(39,28,'In Process','7654 sdgdag','7654 sdgdag','2018-04-18',68.98,84),(40,29,'In Process','8543 sdofjh','8543 sdofjh','2018-04-18',1000.22,467),(41,30,'In Process','qwertyu','qwertyu','2018-04-18',3.51,454),(42,31,'In Process','asdfgh','asdfgh','2018-04-18',686.53,153),(43,32,'In Process','zxcvb','zxcvb','2018-04-18',82.11,242),(44,17,'In Process','sfdjnfl','kjsdnflj','2018-04-18',61.25,1355),(45,17,'In Process','hfdjsahg','gdjksagha','2018-04-20',1.71,3456789),(46,5,'In Process','761 Triangle Cr','761 Triangle Cr','2018-04-20',601.94,13);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `ISBNr` int(11) NOT NULL,
  `UserIDr` int(11) NOT NULL,
  `Review` varchar(250) DEFAULT NULL,
  `Score` int(11) DEFAULT NULL,
  KEY `UserID_idx` (`UserIDr`),
  KEY `ISBNr` (`ISBNr`),
  CONSTRAINT `ISBNr` FOREIGN KEY (`ISBNr`) REFERENCES `books` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `UserIDr` FOREIGN KEY (`UserIDr`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (2,2,'Me and my 90 furry babies live by this book',5),(3,3,'Best gosh darn book in alabamma',5),(4,4,'Lies, this book didnt instantly turn me popular',1),(5,5,'Deadpool is love, Deadpool is life.',4),(6,6,'Hmmmmmm Prrrrrooooper.',3),(7,7,'How am i still typing, they are but booooones',3),(8,8,'The answer is never, spoiler alert.',2),(9,9,'I can know see sideways in time after being inside the black hole.',5),(11,11,'What was i thinking?',3),(12,12,'This meme is dead, long live the meme',4),(13,13,'I still dont know how to do taxes.Rip.',1),(14,14,'There is none.',2),(15,15,'I still dont know if i did, on no.',1),(2,1,'Doesnt work with dogs',1),(22,19,'Great book! My kids love it!',5),(22,22,'Example',4),(9,9,'This book was pretty good.',3),(12,9,'I learned what love is.',1),(14,9,'I learned what the meaning of this was.',5),(33,14,'This book was thrilling!',5),(32,14,'This book was sad but good.',5),(19,14,'Very informative',5),(30,17,'worth the price!',5),(25,17,'Boooooo to this book',1),(28,16,'Good but not great',3),(21,16,'I learned so much about some dads',5),(31,16,'This book was awful do not purchase!!',1),(27,16,'Great read! 10/10 would recommend',5),(3,21,'I learned so much about america',4),(34,21,'Just horrible!',1),(11,21,'If you enjoy books about crossing the gandi you will enjoy this!',5);
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `ISBNb` int(11) NOT NULL,
  `Subject` varchar(45) NOT NULL,
  PRIMARY KEY (`ISBNb`,`Subject`),
  CONSTRAINT `ISBNb` FOREIGN KEY (`ISBNb`) REFERENCES `books` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'More Boats'),(2,'Cats'),(2,'Life'),(3,'Merica'),(4,'The Way of the Sword'),(5,'Cosplay'),(6,'Ball'),(7,'Pain'),(8,'Whhhyyy'),(9,'Particle Physics'),(10,'What'),(11,'What'),(12,'Dont hurt me'),(13,'OMG'),(14,'much'),(15,'A back up'),(19,'Medical'),(21,'Fiction'),(22,'Children'),(25,'Action'),(25,'Thriller'),(26,'Fiction'),(27,'Fantasy'),(28,'Fantasy'),(29,'Action'),(30,'Slice of Life'),(31,'Drama'),(32,'Fantasy'),(33,'Fantasy'),(34,'Fantasy'),(34,'Pilots');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Manager` tinyint(4) NOT NULL,
  `Fname` varchar(45) NOT NULL,
  `Mname` varchar(45) NOT NULL,
  `Lname` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `UserName` varchar(45) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Larry','Kevin','Smith','lks123@gmail.com','password1',40,'M','lks123'),(2,0,'Beth','Ann','Crawley','bethlikescats@gmail.com','kittycat3',31,'F','bethann5'),(3,1,'Taylor','James','Riggs','taylorjames54@ymail.com','password123',27,'M','tjames54'),(4,1,'Bob','Rob','Grossman','the.grossman@yahoo.com','aXy4Tb8',35,'M','grossman1'),(5,1,'Sheila','Nicole','Brown','snbrown40@gmail.com','wordpass',41,'F','snb40'),(6,0,'Katelyn','Taylor','Morrow','soccergirl5@yahoo.com','password1',15,'F','soccerfan1'),(7,0,'Greg','James','Smith','gregoryjames1@gmail.com','abcdefgh',40,'M','gregjames'),(8,0,'Rhonda','Sue','Shoe','rss34@gmail.com','Kansas333',65,'F','rshoe1'),(9,0,'Stephen','David','Boringham','steveb83@gmail.com','yellowlemon',32,'F','boringham'),(10,0,'Sarah','Grace','Patterson','spatt5@gmail.com','whiskers3',23,'F','spatt1'),(11,0,'Elizabeth','Megan','Bruder','lizbruder@gmail.com','larrylobster',26,'F','lizb5617'),(12,0,'Frank','Joseph','Horseman','frankiejoe@gmail.com','leoPards',39,'M','frankiejoe'),(13,1,'Beverley','Ann','Billingsly','bab60@gmail.com','beverleyann',54,'F','bab60'),(14,0,'Nick','James','Mussleman','nick.the.dude@gmail.com','password',18,'M','nickdude'),(15,0,'Holli','Lynn','Bruce','hollibruce1@gmail.com','goatsandsheep',21,'F','hollibruce'),(16,0,'John','Fitzgerald','Kennedy','JFK1917@gmail.com','President',101,'M','JFK35'),(17,0,'User','User','User','user@gmail.com','password',22,'F','user'),(18,0,'Leah','Nicole','Woodworth','leahw728@gmail.com','password',22,'F','leahw'),(19,1,'Manager','Manager','Manager','manager@gmail.com','password',24,'M','manager'),(21,0,'Sam','Michelle','Comb','comb@gmail.com','password',25,'F','scomberger'),(22,0,'Person','Person','Person','person@gmail.com','password',22,'F','person'),(23,0,'John','F','Doe','john.doe@uky.edu','password',69,'m','johndoe'),(25,1,'sysadmin','sysadmin','sysadmin','sysadmin@gmail.com','password',22,'F','sysadmin'),(26,0,'Sarah','Lee','Henderson','shen@gmail.com','lees',26,'F','shen'),(27,0,'Marcella','Coup','Powell','mpowell@gmail.com','coupy',56,'F','mpowell'),(28,0,'Philip','Joel','Henry','phen@gmail.com','joeyph',58,'M','phenry'),(29,0,'Joel','Numan','Gordon','jgordon@gmail.com','jg12345',36,'M','jgordon'),(30,0,'Matt','Kul','Hayes','mhayes@gmail.com','gkh5648',63,'M','mhayes'),(31,0,'Eleanor','Mick','Sanchez','esanch@gmail.com','emc156165',82,'F','esanch'),(32,0,'Mattie','Floof','Davis','mdaivis@gmail.com','mfd1651',31,'M','mdaivis');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlist` (
  `UserIDw` int(11) NOT NULL,
  `ISBNw` int(11) NOT NULL,
  PRIMARY KEY (`UserIDw`,`ISBNw`),
  KEY `ISBNw_idx` (`ISBNw`),
  CONSTRAINT `ISBNw` FOREIGN KEY (`ISBNw`) REFERENCES `books` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `UserIDw` FOREIGN KEY (`UserIDw`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(7,6),(8,7),(9,8),(10,9),(11,10),(12,11),(13,12),(14,13),(15,14),(16,15),(17,2),(17,3),(17,7),(17,19),(17,21),(17,22),(18,10),(19,1),(19,10),(19,22),(21,25),(22,26),(23,27),(25,28),(26,29),(27,30),(28,31),(29,32);
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-20 14:12:00
