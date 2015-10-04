-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2015 at 04:27 PM
-- Server version: 5.6.25-0ubuntu0.15.04.1-log
-- PHP Version: 5.6.4-4ubuntu6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dead_poets_society`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_text` text NOT NULL,
  `p_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`p_id`, `u_id`, `p_text`, `p_date`) VALUES
(1, 1, 'All good books are alike in that they are truer than if they had really happened and after you are finished reading one you will feel that all that happened to you and afterwards it all belongs to you: the good and the bad, the ecstasy, the remorse and sorrow, the people and the places and how the weather was. If you can get so that you can give that to people, then you are a writer. ', '2015-07-28 17:54:57'),
(2, 1, 'You expected to be sad in the fall. Part of you died each year when the leaves fell from the trees and their branches were bare against the wind and the cold, wintery light. But you knew there would always be the spring, as you knew the river would flow again after it was frozen. When the cold rains kept on and killed the spring, it was as though a young person died for no reason.', '2015-07-28 17:55:21'),
(3, 1, 'If people bring so much courage to this world the world has to kill them to break them, so of course it kills them. The world breaks every one and afterward many are strong at the broken places. But those that will not break it kills. It kills the very good and the very gentle and the very brave impartially. If you are none of these you can be sure it will kill you too but there will be no special hurry.', '2015-07-28 17:55:51'),
(4, 1, 'With so many trees in the city, you could see the spring coming each day until a night of warm wind would bring it suddenly in one morning. Sometimes the heavy cold rains would beat it back so that it would seem that it would never come and that you were losing a season out of your life. This was the only truly sad time in Paris because it was unnatural. You expected to be sad in the fall. Part of you died each year when the leaves fell from the trees and their branches were bare against the wind and the cold, wintry light. But you knew there would always be the spring, as you knew the river would flow again after it was frozen. When the cold rains kept on and killed the spring, it was as though a young person had died for no reason. \r\n\r\nIn those days, though, the spring always came finally but it was frightening that it had nearly failed.', '2015-07-28 17:56:29'),
(5, 1, 'I had gone to no such place but to the smoke of cafes and nights when the room whirled and you needed to look at the wall to make it stop, nights in bed, drunk, when you knew that that was all there was, and the strange excitement of waking and not knowing who it was with you, and the world all unreal in the dark and so exciting that you must resume again unknowing and not caring in the night, sure that this was all and all and all and not caring.', '2015-07-28 17:57:11'),
(6, 2, 'He smiled understandingly-much more than understandingly. It was one of those rare smiles with a quality of eternal reassurance in it, that you may come across four or five times in life. It faced--or seemed to face--the whole eternal world for an instant, and then concentrated on you with an irresistible prejudice in your favor. It understood you just as far as you wanted to be understood, believed in you as you would like to believe in yourself, and assured you that it had precisely the impression of you that, at your best, you hoped to convey.', '2015-07-28 17:58:50'),
(7, 2, 'I''m not sentimental--I''m as romantic as you are. The idea, you know,\r\nis that the sentimental person thinks things will last--the romantic\r\nperson has a desperate confidence that they won''t.', '2015-07-28 17:59:10'),
(8, 2, 'In my younger and more vulnerable years my father gave me some advice that I''ve been turning over in my mind ever since.\r\n"Whenever you feel like criticizing any one," he told me, "just remember that all the people in this world haven''t had the advantages that you''ve had.', '2015-07-28 17:59:36'),
(9, 3, 'I was a Flower of the mountain yes when I put the rose in my hair like the Andalusian girls used or shall I wear a red yes and how he kissed me under the Moorish wall and I thought well as well him as another and then I asked him with my eyes to ask again yes and then he asked me would I yes to say yes my mountain flower and first I put my arms around him yes and drew him down to me so he could feel my breasts all perfume yes and his heart was going like mad and yes I said yes I will Yes.', '2015-07-28 18:00:24'),
(10, 3, 'Open your eyes now. I will. One moment. Has all vanished since? If I open and am for ever in the black adiaphane. Basta! I will see if I can see.\r\nSee now. There all the time without you: and ever shall be, world without end.', '2015-07-28 18:00:50'),
(11, 6, 'If, then, I were asked for the most important advice I could give, that which I considered to be the most useful to the men of our century, I should simply say: in the name of God, stop a moment, cease your work, look around you.', '2015-07-28 18:01:55'),
(12, 6, 'Only people who are capable of loving strongly can also suffer great sorrow, but this same necessity of loving serves to counteract their grief and heals them.', '2015-07-28 18:02:12'),
(22, 1, 'Never confuse movement with action', '2015-07-29 17:13:12'),
(76, 1, 'Forget your personal tragedy. We are all bitched from the start and you especially have to be hurt like hell before you can write seriosly', '2015-07-31 22:25:54'),
(78, 9, 'Never be afraid to raise your voice for honesty and truth and compassion against injustice and lying and greed. If people all over the world...would do this, it would change the earth.', '2015-08-01 12:25:08'),
(79, 9, '...I give you the mausoleum of all hope and desire...I give it to you not that you may remember time, but that you might forget it now and then for a moment and not spend all of your breath trying to conquer it. Because no battle is ever won he said. They are not even fought. The field only reveals to man his own folly and despair, and victory is an illusion of philosophers and fools.', '2015-08-01 12:25:37'),
(80, 10, 'The pages are still blank, but there is a miraculous feeling of the words being there, written in invisible ink and clamoring to become visible.', '2015-08-01 12:37:06'),
(81, 10, 'There is nothing in the world that I loathe more than group activity, that communal bath where the hairy and slippery mix in a multiplication of mediocrity.\r\n', '2015-08-01 12:37:58'),
(83, 1, 'You expected to be sad in the fall. Part of you died each year when the leaves fell from the trees and their branches were bare against the wind and the cold, wintery light. But you knew there would always be the spring, as you knew the river would flow again after it was frozen. When the cold rains kept on and killed the spring, it was as though a young person died for no reason.', '2015-08-02 20:12:04'),
(84, 22, 'The prisoner is not the one who has commited a crime, but the one who clings to his crime and lives it over and over.\n', '2015-08-25 16:01:52'),
(85, 22, 'Develop an interest in life as you see it; the people, things, literature, music - the world is so rich, simply throbbing with rich treasures, beautiful souls and interesting people. Forget yourself.\n', '2015-08-25 16:02:16'),
(86, 1, 'But in the night he woke and held her tight as though she were all of life and it was being taken from him. He held her feeling she was all of life there was and it was true.', '2015-08-31 13:18:22'),
(91, 6, 'Nietzsche was stupid and abnormal.', '2015-09-03 12:41:03'),
(92, 6, 'We must not only cease our present desire for the growth of the state, but we must desire its decrease, its weakening.\n', '2015-09-03 12:47:39'),
(103, 6, 'And all people live, Not by reason of any care they have for themselves, But by the love for them that is in other people.', '2015-09-03 13:10:24'),
(106, 6, 'And all people live, Not by reason of any care they have for themselves, But by the love for them that is in other people.', '2015-09-03 13:22:14'),
(107, 6, 'And all people live, Not by reason of any care they have for themselves, But by the love for them that is in other people.', '2015-09-03 13:23:24'),
(108, 6, 'And all people live, Not by reason of any care they have for themselves, But by the love for them that is in other people.', '2015-09-03 13:25:06'),
(109, 6, 'qweqw', '2015-09-03 13:29:43'),
(117, 4, 'You will write if you will write without thinking of the result in terms of a result, but think of the writing in terms of discovery, which is to say that creation must take place \nbetween the pen and the paper, not before in a thought or afterwards in a recasting... \nIt will come if it is there and if you will let it come.', '2015-09-04 12:13:10'),
(118, 4, 'it is nice that nobody writes as they talk and that the printed language is different from the spoken otherwise you could not lose yourself in books and of course you do you completely do.', '2015-09-04 12:16:50'),
(119, 4, 'For a very long time everybody refuses and then almost without a pause almost everybody accepts.', '2015-09-04 12:20:11'),
(120, 4, 'I certainly do care for you Jeff Campbell less than you are always thinking and much more than you are ever knowing', '2015-09-04 12:25:27'),
(121, 4, 'America is my country, and Paris is my home town.', '2015-09-04 12:26:27'),
(122, 1, 'You are so brave and quiet I forget you are suffering.', '2015-09-04 16:56:34'),
(133, 23, 'We are like roses that have never bothered to bloom when we should have bloomed and it is as if the sun has become disgusted with waiting', '2015-09-17 13:35:23'),
(134, 23, 'The problem was you had to keep choosing between one evil or another, and no matter what you chose, they sliced a little bit more off you, until there was nothing left. At the age of 25 most people were finished. A whole god-damned nation of assholes driving automobiles, eating, having babies, doing everything in the worst way possible, like voting for the presidential candidates who reminded them most of themselves. I had no interests. I had no interest in anything. I had no idea how I was going to escape. At least the others had some taste for life. They seemed to understand something that I didn''t understand. Maybe I was lacking. It was possible. I often felt inferior. I just wanted to get away from them. But there was no place to go.', '2015-09-17 13:35:39'),
(135, 23, 'I never met another man I''d rather be. And even if that''s a delusion, it''s a lucky one.', '2015-09-17 13:35:55'),
(136, 9, 'They say that it is the practiced liar who can deceive. But so often the practiced and chronic liar deceives only himself; it is the man who all his life has been self convicted of veracity whose lies find quickest credence.\n', '2015-09-19 18:33:52'),
(137, 63, 'Assure a man that he has a soul and then frighten him with old wives'' tales as to what is to become of him afterward, and you have hooked a fish, a mental slave.\n', '2015-09-22 17:28:50'),
(138, 63, 'People in general attach too much importance to words. They are under the illusion that talking effects great results. As a matter of fact, words are, as a rule, the shallowest portion of all the argument. They but dimly represent the great surging feelings and desires which lie behind. When the distraction of the tongue is removed, the heart listens.', '2015-09-22 17:48:03'),
(139, 1, 'I learned never to empty the well of my writing, but always to stop when there was still something there in the deep part of the well, and let it refill at night from the springs that fed it.\n', '2015-09-26 17:25:17'),
(140, 64, 'There are occasions when a woman, no matter how weak and impotent in character she may be in comparison with a man, will yet suddenly become not only harder than any man, but even harder than anything and everything in the world.', '2015-09-30 13:45:57'),
(141, 64, 'But youth has a future. The closer he came to graduation, the more his heart beat. He said to himself: “This is still not life, this is only the preparation for life.', '2015-09-30 13:47:21'),
(142, 64, 'Everywhere across whatever sorrows of which our life is woven, some radiant joy will gaily flash past.', '2015-09-30 13:48:23'),
(145, 1, 'We are all apprentices in a craft where no one ever becomes a master.\n', '2015-10-04 12:31:50'),
(146, 25, 'It is not necessary that you leave the house. Remain at your table and listen. Do not even listen, only wait. Do not even wait, be wholly still and alone. The world will present itself to you for its unmasking, it can do no other, in ecstasy it will writhe at your feet.\n\n', '2015-10-04 13:12:37'),
(147, 25, 'The history of mankind is the instant between two strides taken by a traveler.\n', '2015-10-04 13:12:53'),
(148, 25, 'You do not need to leave your room. Remain sitting at your table and listen. Do not even listen, simply wait, be quiet still and solitary. The world will freely offer itself to you to be unmasked, it has no choice, it will roll in ecstasy at your feet.\n', '2015-10-04 13:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
`r_id` int(11) NOT NULL,
  `u_id1` int(11) NOT NULL COMMENT 'who sent frind request',
  `u_id2` int(11) NOT NULL COMMENT 'to whom sent friend request',
  `r_status` enum('REQUEST_SENT','DECLINED','FRIENDS') NOT NULL,
  `r_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`r_id`, `u_id1`, `u_id2`, `r_status`, `r_updated_at`) VALUES
(15, 6, 1, 'REQUEST_SENT', '2015-08-23 18:19:03'),
(17, 6, 3, 'REQUEST_SENT', '2015-08-23 17:10:32'),
(18, 6, 4, 'REQUEST_SENT', '2015-08-23 17:16:46'),
(22, 6, 2, 'REQUEST_SENT', '2015-08-23 17:23:34'),
(23, 6, 5, 'FRIENDS', '2015-08-23 17:45:08'),
(30, 7, 8, 'REQUEST_SENT', '2015-08-24 16:11:43'),
(32, 10, 6, 'REQUEST_SENT', '2015-08-24 16:14:51'),
(33, 22, 6, 'REQUEST_SENT', '2015-08-25 16:02:46'),
(37, 22, 8, 'REQUEST_SENT', '2015-08-25 16:13:52'),
(38, 22, 2, 'DECLINED', '2015-08-25 16:14:52'),
(41, 4, 2, 'REQUEST_SENT', '2015-09-04 12:28:21'),
(43, 4, 3, 'REQUEST_SENT', '2015-09-04 12:33:46'),
(44, 4, 9, 'DECLINED', '2015-09-04 12:37:13'),
(45, 22, 4, 'DECLINED', '2015-10-03 13:08:10'),
(46, 22, 7, 'FRIENDS', '2015-09-04 13:06:00'),
(47, 7, 10, 'REQUEST_SENT', '2015-09-04 13:06:15'),
(50, 1, 10, 'FRIENDS', '2015-10-02 17:48:38'),
(52, 1, 22, 'FRIENDS', '2015-10-04 12:34:51'),
(53, 1, 9, 'FRIENDS', '2015-10-02 18:03:01'),
(60, 10, 5, 'FRIENDS', '2015-09-05 16:47:57'),
(64, 5, 2, 'FRIENDS', '2015-09-05 20:08:49'),
(69, 8, 13, 'FRIENDS', '2015-09-15 21:00:39'),
(70, 23, 8, 'REQUEST_SENT', '2015-09-17 13:40:24'),
(72, 23, 10, 'REQUEST_SENT', '2015-09-17 13:40:45'),
(74, 23, 13, 'FRIENDS', '2015-09-17 13:43:17'),
(75, 23, 2, 'FRIENDS', '2015-09-17 13:43:29'),
(77, 6, 23, 'REQUEST_SENT', '2015-09-17 13:49:35'),
(79, 25, 23, 'REQUEST_SENT', '2015-09-19 12:31:35'),
(80, 9, 8, 'REQUEST_SENT', '2015-09-19 18:40:27'),
(82, 63, 7, 'REQUEST_SENT', '2015-09-22 17:48:40'),
(83, 63, 24, 'REQUEST_SENT', '2015-09-22 17:48:47'),
(84, 63, 3, 'REQUEST_SENT', '2015-09-22 17:48:50'),
(85, 1, 8, 'DECLINED', '2015-10-02 18:00:01'),
(90, 25, 3, 'FRIENDS', '2015-09-29 13:33:23'),
(91, 25, 24, 'FRIENDS', '2015-09-29 13:33:52'),
(93, 25, 8, 'DECLINED', '2015-09-29 13:57:08'),
(94, 25, 9, 'FRIENDS', '2015-09-29 13:57:55'),
(95, 25, 13, 'DECLINED', '2015-09-29 13:35:15'),
(96, 25, 63, 'FRIENDS', '2015-09-29 13:35:34'),
(97, 1, 25, 'FRIENDS', '2015-10-02 17:40:13'),
(98, 64, 1, 'REQUEST_SENT', '2015-09-30 14:08:03'),
(99, 64, 7, 'REQUEST_SENT', '2015-09-30 13:48:57'),
(100, 64, 3, 'REQUEST_SENT', '2015-09-30 13:49:02'),
(101, 1, 2, 'FRIENDS', '2015-10-02 16:58:25'),
(102, 1, 3, 'FRIENDS', '2015-10-02 16:59:00'),
(105, 1, 13, 'DECLINED', '2015-10-02 17:16:08'),
(106, 7, 1, 'DECLINED', '2015-10-02 17:16:34'),
(107, 1, 24, 'DECLINED', '2015-10-02 17:41:53'),
(108, 1, 58, 'DECLINED', '2015-10-02 17:32:55'),
(109, 1, 63, 'FRIENDS', '2015-10-02 17:33:21'),
(110, 22, 25, 'FRIENDS', '2015-10-03 13:07:41'),
(111, 3, 22, 'REQUEST_SENT', '2015-10-03 13:11:26'),
(113, 22, 58, 'FRIENDS', '2015-10-03 13:12:18'),
(114, 22, 63, 'FRIENDS', '2015-10-03 13:12:25'),
(115, 64, 22, 'REQUEST_SENT', '2015-10-03 13:12:33'),
(116, 1, 4, 'REQUEST_SENT', '2015-10-04 12:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`u_id` int(11) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_password` varchar(50) NOT NULL,
  `u_nickname` varchar(50) NOT NULL,
  `u_birthdate` date NOT NULL,
  `u_register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_about_myself` text NOT NULL,
  `u_picture` varchar(50) NOT NULL,
  `u_secret_pic` varchar(50) NOT NULL,
  `u_is_frozen_account` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_password`, `u_nickname`, `u_birthdate`, `u_register_date`, `u_about_myself`, `u_picture`, `u_secret_pic`, `u_is_frozen_account`) VALUES
(1, 'ernest@gmail.com', '1234', 'Papa', '1899-07-21', '2015-07-28 16:04:52', 'You belong to me and all Paris belongs to me and I belong to this notebook and this pencil.', 'images/hemingway1.jpg', 'images/hemingway2.jpg', 0),
(2, 'fitzgerald@gmail.com', '1234', 'F. Scott', '1896-09-24', '2015-07-28 16:14:27', '“I’m so damn glad I love you – I wouldn’t love any other man on earth – I b’lieve if I had deliberately decided on a sweetheart, he’d have been you.” Zelda Fitzgerald', 'images/fizgerald1.jpg', 'images/fizgerald2.jpg', 0),
(3, 'joyce@gmail.com', '1234', 'Ulysses', '1882-02-02', '2015-07-28 16:16:45', 'No pen, no ink, no table, no room, no time, no quiet, no inclination.\r\n', 'images/joyce1.jpg', 'images/joyce2.jpg', 0),
(4, 'stein@gmail.com', '1234', 'Gertrude', '1874-02-03', '2015-07-28 17:29:29', '"average middle class woman [supported by] some male relative, a husband or father or brother,...[is] not worth her keep economically considered." [This economic dependence caused her to become] oversexed...adapting herself to the abnormal sex desire of the male...and becoming a creature that should have been first a human being and then a woman into one that is a woman first and always."', 'images/stein1.jpg', 'images/stein2.jpg', 0),
(5, 'ezra@gmail.com', '1234', 'Ezra', '1885-10-30', '2015-07-28 17:34:48', 'I resolved that at thirty I would know more about poetry than any man living ... that I would know what was accounted poetry everywhere, what part of poetry was ''indestructible'', what part could not be lost by translation and – scarcely less important – what effects were obtainable in one language only and were utterly incapable of being translated.', 'images/pound1.jpg', 'images/pound2.jpg', 0),
(6, 'leo@gmail.com', '1234', 'Lev Nikolaevich ', '1828-09-09', '2015-07-28 17:40:16', 'One of the first conditions of happiness is that the link between Man and Nature shall not be broken.\r\n', 'images/user_uploads/tolstoy1.jpg', 'images/user_uploads/tolstoy2.jpg', 1),
(7, 'fyodor@gmail.com', '1234', 'Fyodor Mikhailovich', '1821-11-11', '2015-07-28 17:44:37', 'We sometimes encounter people, even perfect strangers, who begin to interest us at first sight, somehow suddenly, all at once, before a word has been spoken.\r\n', 'images/dostoevsky1.jpg', 'images/dostoevsky2.jpg', 0),
(8, 'cummings@gmail.com', '1234', 'E.E.', '1894-10-14', '2015-07-28 17:49:31', 'To be nobody but \r\nyourself in a world \r\nwhich is doing its best day and night to make you like \r\neverybody else means to fight the hardest battle \r\nwhich any human being can fight and never stop fighting. ', 'images/cammings1.jpg', 'images/cammings2.jpg', 0),
(9, 'faulkner@gmail.com', '1234', 'The Sound and the Fury', '1962-07-06', '2015-08-01 12:03:01', 'My own experience has been that the tools I need for my trade are paper, tobacco, food, and a little whisky.', 'images/faulkner1.jpg', 'images/faulkner2.jpg', 0),
(10, 'nabokov@gmail.com', '1234', 'Sirin', '1899-04-22', '2015-08-01 12:07:38', 'Nothing is more exhilarating than philistine vulgarity.', 'images/nabokov1.jpg', 'images/nabokov2.jpg', 0),
(13, 'boffin13@gmail.com', '1234', 'Boffin', '1982-10-20', '2015-08-22 20:43:36', '', '', '', 0),
(22, 'miller@gmail.com', '1234', 'Sexus', '1891-12-26', '2015-08-25 15:21:54', 'Life has no other discipline to impose, if we would but realize it, than to accept life unquestioningly. Everything we shut our eyes to, everything we run away from, everything we deny, denigrate or despise, serves to defeat us in the end. What seems nasty, painful, evil, can become a source of beauty, joy and strength, if faced with an open mind. Every moment is a golden one for him who has the vision to recognize it as such.', 'images/user_uploads/miller.jpg', 'images/user_uploads/miller2.jpg', 0),
(23, 'women@gmail.com', '1234', 'Bukowski', '1920-08-16', '2015-09-16 21:52:07', 'Some people never go crazy. What truly horrible lives they must lead.', 'images/user_uploads/bukowski.jpg', 'images/user_uploads/bukowsli2.jpg', 0),
(24, 'camus@gmail.com', '1234', 'The Stranger', '1913-11-07', '2015-09-17 17:41:06', 'But in the end one needs more courage to live than to kill himself.', 'images/user_uploads/55fafb329a8eccamus.jpg', 'images/user_uploads/55fafb329a965camus2.jpg', 0),
(25, 'franz@gmail.com', '1234', 'K.', '1883-07-03', '2015-09-19 12:30:58', 'The tremendous world I have in my head. But how to free myself and free them without ripping apart. And a thousand times rather tear in me they hold back or buried. For this I''m here, that''s quite clear to me', 'images/user_uploads/55fd558261601kafka.jpg', 'images/user_uploads/55fd558261685kafka2.jpg', 0),
(58, 'rand@gmail.com', '1234', 'Mrs. Objectivism', '1905-02-02', '2015-09-22 15:28:39', 'Nature, to be commanded, must be obeyed.', 'images/user_uploads/560173a77ad33rand.jpg', 'images/user_uploads/560173a77adc2rand2.jpg', 0),
(63, 'dreiser@gmail.com', '1234', 'Genius', '1870-08-27', '2015-09-22 17:27:29', 'In order to have wisdom we must have ignorance.\r\n', 'images/user_uploads/56018f810b54cdreizer.jpg', 'images/user_uploads/56018f810b5badreizer2.jpg', 0),
(64, 'gogol@gmail.com', '1234', 'The Nose', '1809-03-31', '2015-09-30 13:44:19', 'We have the marvelous gift of making everything insignificant.', 'images/user_uploads/560be73359f14gogol.jpg', 'images/user_uploads/560be781a6fadgogol2.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
 ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`u_id`), ADD UNIQUE KEY `u_email` (`u_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
