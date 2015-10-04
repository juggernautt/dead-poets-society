-- MySQL dump 10.13  Distrib 5.6.25, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dead_poets_society
-- ------------------------------------------------------
-- Server version	5.6.25-0ubuntu0.15.04.1-log

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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `p_text` text NOT NULL,
  `p_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,'All good books are alike in that they are truer than if they had really happened and after you are finished reading one you will feel that all that happened to you and afterwards it all belongs to you: the good and the bad, the ecstasy, the remorse and sorrow, the people and the places and how the weather was. If you can get so that you can give that to people, then you are a writer. ','2015-07-28 17:54:57'),(2,1,'You expected to be sad in the fall. Part of you died each year when the leaves fell from the trees and their branches were bare against the wind and the cold, wintery light. But you knew there would always be the spring, as you knew the river would flow again after it was frozen. When the cold rains kept on and killed the spring, it was as though a young person died for no reason.','2015-07-28 17:55:21'),(3,1,'If people bring so much courage to this world the world has to kill them to break them, so of course it kills them. The world breaks every one and afterward many are strong at the broken places. But those that will not break it kills. It kills the very good and the very gentle and the very brave impartially. If you are none of these you can be sure it will kill you too but there will be no special hurry.','2015-07-28 17:55:51'),(4,1,'With so many trees in the city, you could see the spring coming each day until a night of warm wind would bring it suddenly in one morning. Sometimes the heavy cold rains would beat it back so that it would seem that it would never come and that you were losing a season out of your life. This was the only truly sad time in Paris because it was unnatural. You expected to be sad in the fall. Part of you died each year when the leaves fell from the trees and their branches were bare against the wind and the cold, wintry light. But you knew there would always be the spring, as you knew the river would flow again after it was frozen. When the cold rains kept on and killed the spring, it was as though a young person had died for no reason. \r\n\r\nIn those days, though, the spring always came finally but it was frightening that it had nearly failed.','2015-07-28 17:56:29'),(5,1,'I had gone to no such place but to the smoke of cafes and nights when the room whirled and you needed to look at the wall to make it stop, nights in bed, drunk, when you knew that that was all there was, and the strange excitement of waking and not knowing who it was with you, and the world all unreal in the dark and so exciting that you must resume again unknowing and not caring in the night, sure that this was all and all and all and not caring.','2015-07-28 17:57:11'),(6,2,'He smiled understandingly-much more than understandingly. It was one of those rare smiles with a quality of eternal reassurance in it, that you may come across four or five times in life. It faced--or seemed to face--the whole eternal world for an instant, and then concentrated on you with an irresistible prejudice in your favor. It understood you just as far as you wanted to be understood, believed in you as you would like to believe in yourself, and assured you that it had precisely the impression of you that, at your best, you hoped to convey.','2015-07-28 17:58:50'),(7,2,'I\'m not sentimental--I\'m as romantic as you are. The idea, you know,\r\nis that the sentimental person thinks things will last--the romantic\r\nperson has a desperate confidence that they won\'t.','2015-07-28 17:59:10'),(8,2,'In my younger and more vulnerable years my father gave me some advice that I\'ve been turning over in my mind ever since.\r\n\"Whenever you feel like criticizing any one,\" he told me, \"just remember that all the people in this world haven\'t had the advantages that you\'ve had.','2015-07-28 17:59:36'),(9,3,'I was a Flower of the mountain yes when I put the rose in my hair like the Andalusian girls used or shall I wear a red yes and how he kissed me under the Moorish wall and I thought well as well him as another and then I asked him with my eyes to ask again yes and then he asked me would I yes to say yes my mountain flower and first I put my arms around him yes and drew him down to me so he could feel my breasts all perfume yes and his heart was going like mad and yes I said yes I will Yes.','2015-07-28 18:00:24'),(10,3,'Open your eyes now. I will. One moment. Has all vanished since? If I open and am for ever in the black adiaphane. Basta! I will see if I can see.\r\nSee now. There all the time without you: and ever shall be, world without end.','2015-07-28 18:00:50'),(11,6,'If, then, I were asked for the most important advice I could give, that which I considered to be the most useful to the men of our century, I should simply say: in the name of God, stop a moment, cease your work, look around you.','2015-07-28 18:01:55'),(12,6,'Only people who are capable of loving strongly can also suffer great sorrow, but this same necessity of loving serves to counteract their grief and heals them.','2015-07-28 18:02:12'),(13,1,'The most painful thing is losing yourself in the process of loving someone too much, and forgetting that you are special too.','2015-07-29 17:00:28'),(22,1,'Never confuse movement with action','2015-07-29 17:13:12'),(76,1,'Forget your personal tragedy. We are all bitched from the start and you especially have to be hurt like hell before you can write seriosly','2015-07-31 22:25:54'),(78,9,'Never be afraid to raise your voice for honesty and truth and compassion against injustice and lying and greed. If people all over the world...would do this, it would change the earth.','2015-08-01 12:25:08'),(79,9,'...I give you the mausoleum of all hope and desire...I give it to you not that you may remember time, but that you might forget it now and then for a moment and not spend all of your breath trying to conquer it. Because no battle is ever won he said. They are not even fought. The field only reveals to man his own folly and despair, and victory is an illusion of philosophers and fools.','2015-08-01 12:25:37'),(80,10,'The pages are still blank, but there is a miraculous feeling of the words being there, written in invisible ink and clamoring to become visible.','2015-08-01 12:37:06'),(81,10,'There is nothing in the world that I loathe more than group activity, that communal bath where the hairy and slippery mix in a multiplication of mediocrity.\r\n','2015-08-01 12:37:58'),(83,1,'You expected to be sad in the fall. Part of you died each year when the leaves fell from the trees and their branches were bare against the wind and the cold, wintery light. But you knew there would always be the spring, as you knew the river would flow again after it was frozen. When the cold rains kept on and killed the spring, it was as though a young person died for no reason.','2015-08-02 20:12:04');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relationship`
--

DROP TABLE IF EXISTS `relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relationship` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id1` int(11) NOT NULL COMMENT 'who sent frind request',
  `u_id2` int(11) NOT NULL COMMENT 'to whom sent friend request',
  `r_status` enum('REQUEST_SENT','DECLINED','FRIENDS') NOT NULL,
  `r_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relationship`
--

LOCK TABLES `relationship` WRITE;
/*!40000 ALTER TABLE `relationship` DISABLE KEYS */;
INSERT INTO `relationship` VALUES (1,2,1,'REQUEST_SENT','2015-08-15 14:29:29'),(3,4,1,'FRIENDS','2015-08-13 15:28:49'),(5,8,1,'FRIENDS','2015-08-13 15:28:49'),(7,6,7,'REQUEST_SENT','2015-08-13 15:28:49'),(8,7,6,'FRIENDS','2015-08-13 15:12:48'),(9,1,10,'DECLINED','2015-08-15 14:29:37'),(10,1,5,'FRIENDS','2015-08-13 16:04:10'),(11,1,7,'REQUEST_SENT','2015-08-14 16:45:45'),(14,1,3,'FRIENDS','2015-08-14 18:59:59'),(15,1,6,'REQUEST_SENT','2015-08-15 14:19:06');
/*!40000 ALTER TABLE `relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_email` varchar(255) NOT NULL,
  `u_password` varchar(50) NOT NULL,
  `u_nickname` varchar(50) NOT NULL,
  `u_birthdate` date NOT NULL,
  `u_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_about_myself` text NOT NULL,
  `u_picture` varchar(50) NOT NULL,
  `u_secret_pic` varchar(50) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_email` (`u_email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ernest@gmail.com','1234','Papa Hem','1899-07-21','2015-07-28 16:04:52','If you are lucky enough to have lived in Paris as a young man, then wherever you go for the rest of your life it stays with you, for Paris is a moveable feast','images/hemingway1.jpg','images/hemingway2.jpg'),(2,'fitzgerald@gmail.com','1234','F. Scott','1896-09-24','2015-07-28 16:14:27','“I’m so damn glad I love you – I wouldn’t love any other man on earth – I b’lieve if I had deliberately decided on a sweetheart, he’d have been you.” Zelda Fitzgerald','images/fizgerald1.jpg','images/fizgerald2.jpg'),(3,'joyce@gmail.com','1234','Ulysses','1882-02-02','2015-07-28 16:16:45','No pen, no ink, no table, no room, no time, no quiet, no inclination.\r\n','images/joyce1.jpg','images/joyce2.jpg'),(4,'stein@gmail.com','1234','Gertrude','1874-02-03','2015-07-28 17:29:29','\"average middle class woman [supported by] some male relative, a husband or father or brother,...[is] not worth her keep economically considered.\" [This economic dependence caused her to become] oversexed...adapting herself to the abnormal sex desire of the male...and becoming a creature that should have been first a human being and then a woman into one that is a woman first and always.\"','images/stein1.jpg','images/stein2.jpg'),(5,'ezra@gmail.com','1234','Ezra','1885-10-30','2015-07-28 17:34:48','I resolved that at thirty I would know more about poetry than any man living ... that I would know what was accounted poetry everywhere, what part of poetry was \'indestructible\', what part could not be lost by translation and – scarcely less important – what effects were obtainable in one language only and were utterly incapable of being translated.','images/pound1.jpg','images/pound2.jpg'),(6,'leo@gmail.com','1234','Lev Nikolayevich','1828-09-09','2015-07-28 17:40:16','One of the first conditions of happiness is that the link between Man and Nature shall not be broken.\r\n','images/tolstoy1.jpg','images/tolstoy2.jpg'),(7,'fyodor@gmail.com','1234','Fyodor Mikhailovich','1821-11-11','2015-07-28 17:44:37','We sometimes encounter people, even perfect strangers, who begin to interest us at first sight, somehow suddenly, all at once, before a word has been spoken.\r\n','images/dostoevsky1.jpg','images/dostoevsky2.jpg'),(8,'cummings@gmail.com','1234','E.E.','1894-10-14','2015-07-28 17:49:31','To be nobody but \r\nyourself in a world \r\nwhich is doing its best day and night to make you like \r\neverybody else means to fight the hardest battle \r\nwhich any human being can fight and never stop fighting. ','images/cammings1.jpg','images/cammings2.jpg'),(9,'faulkner@gmail.com','1234','The Sound and the Fury','1962-07-06','2015-08-01 12:03:01','My own experience has been that the tools I need for my trade are paper, tobacco, food, and a little whisky.','images/faulkner1.jpg','images/faulkner2.jpg'),(10,'nabokov@gmail.com','1234','Sirin','1899-04-22','2015-08-01 12:07:38','Nothing is more exhilarating than philistine vulgarity.','images/nabokov1.jpg','images/nabokov2.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-22 23:38:25
