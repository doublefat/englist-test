-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2018 at 08:25 PM
-- Server version: 8.0.12
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing`
--
CREATE DATABASE IF NOT EXISTS `testing` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `testing`;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `disable` tinyint(1) NOT NULL DEFAULT '0',
  `associate_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `detail` mediumtext NOT NULL,
  `extra` text NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `type`, `disable`, `associate_id`, `level`, `detail`, `extra`, `create_time`, `update_time`) VALUES
(1, 1, 0, 0, 1, 'Shikibu Murasaki, who wrote almost a thousand years ago, was one of the world’s _____ novelists.', '', '2018-09-26 22:39:47', '2018-10-01 17:06:59'),
(2, 1, 0, 0, 1, 'The ​Chang​ ​ children _____ their parents by making sandwiches for the whole family.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(3, 1, 0, 0, 1, 'As demonstrated by his last album, which was released after his death, Ibrahim Ferrer _____ one of the most beautiful voices in Latin music.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(4, 1, 0, 0, 1, 'After we saw the play, we had different opinions _____ Vincent’s performance.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(5, 1, 0, 0, 1, 'Having recorded many of the most beloved songs of the 1940s, jazz singer Ella Fitzgerald _____one of the most prominent musical performers of her time.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(6, 1, 0, 0, 1, 'As we drove​ ​Right​ through the darkness, we saw another car coming _____the bend​ ​in the road.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(7, 1, 0, 0, 1, 'Sonia is so determined and stubborn that she never _____until she gets exactly what she wants.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(8, 1, 0, 0, 1, '​At only 43, ​John F. Kennedy was the​_____​ American​_____​ president ​ever to be elected.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(9, 1, 0, 0, 1, 'Elena found a tomato that was much bigger than all the others in the garden. How did the tomato compare to the others in the garden?', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(10, 1, 0, 0, 1, 'When the popular entertainer canceled her appearance, the Latin American festival was postponed indefinitely.<br/>When will the festival likely take place?\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(11, 1, 0, 0, 1, 'Jasmine​ is ​ ​always​ arrives a fewminutes early.<br/> Which ​adjective ​best describes Jasmine?\r\naaa', '', '2018-09-26 22:39:47', '2018-09-28 15:30:50'),
(12, 1, 0, 0, 1, 'Bram Stoker is best known for his classic horror novel Dracula, which was published in 1897.<br/> What did Bram Stoker do?\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(13, 1, 0, 0, 1, 'Exhausted from her transatlantic flight, Judy could not stay up past 9 p.m.<br/>What did Judy do at 9 p.m.?\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(14, 1, 0, 0, 1, 'Eliot sleeps late whenever he can, leaves work early, and never does anything unless he absolutely has to.<br/>Which best describes Eliot?\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(15, 1, 0, 0, 1, 'Juanita rushed to her dance class and burst through the door in the nick of time. When Juanita got to her dance class, she was', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(16, 1, 0, 0, 1, '_____ washing his sweater, Jacob hung it up to dry.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(17, 1, 0, 0, 1, 'Dr. O’Hara is certain that ​someday​, men and women will _____ to Mars.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(18, 1, 0, 0, 1, 'Water _____ at a temperature of zero degrees Celsius.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(19, 1, 0, 0, 1, '_____ you get a new haircut?', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(20, 1, 0, 0, 1, 'Jacques Cousteau will be remembered for his inventions and for _____ to marine science.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(21, 1, 0, 0, 1, 'The children, who were tired of traveling, kept asking, “When _____ we get to the hotel?”', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(22, 1, 0, 0, 1, 'Galileo is most famous _____ that Earth revolves around the Sun, rather than the other way around.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(23, 1, 0, 0, 1, 'Men and women sometimes have difficulty understanding each other because they _____ differently.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(24, 1, 0, 0, 1, '_____ you can speak more than one language, you have the opportunity to make more new friends.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(25, 1, 0, 0, 1, 'Light _____ faster than sound, which is why you see lightning before you hear the thunder.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(26, 1, 0, 0, 1, 'Lisa plays the piano. Her sister Kelly plays the piano, too.<br/>​Please choose correct compound sentence.\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(27, 1, 0, 0, 1, 'Kazuko took her dog for a walk. They went to the park.<br/>​Please choose correct compound sentence.\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(28, 1, 0, 0, 1, 'We knew it might get chilly at the football game. We brought along some extra blankets.<br/>​Please choose correct compound sentence.\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(29, 1, 0, 0, 1, 'Juan loves to play baseball. His friend Miguel enjoys baseball, too.<br/>​Please choose correct compound sentence.\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(30, 1, 0, 0, 1, 'Wolves are pack animals. They are rarely spotted alone.<br/>​Please choose correct compound sentence.\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(31, 1, 0, 0, 2, 'Stamp collecting _____ sometimes used in the schools to teach economics and social studies.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(32, 1, 0, 0, 2, '_____ as if it would fall.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(33, 1, 0, 0, 2, '_____ are Pat’s favorite ways of getting around.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(34, 1, 0, 0, 2, '_____ is an example of jaywalking.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(35, 1, 0, 0, 2, 'Walking by the corner the other day, _____ for the light to change.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(36, 1, 0, 0, 2, '_____, everything there looked smaller than Don remembered.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(37, 1, 0, 0, 2, '_____ are some of the techniques artists such as Picasso used to express themselves.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(38, 1, 0, 0, 2, 'Playing sports in school _____ meant to teach teamwork and leadership skills students can use later in life.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(39, 1, 0, 0, 2, '_____, Daniel picked up his speed.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(40, 1, 0, 0, 2, '_____ up to eight times a year is part of a natural process.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(41, 1, 0, 0, 2, '_____ through the window to see who was at the door.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(42, 1, 0, 0, 2, 'It is easy to carry solid objects without spilling them, but the same cannot be said of liquids.<br/>Rewrite ​the sentence​, beginning with​ : “ ​Unlike liquids,​” The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(43, 1, 0, 0, 2, 'Although the sandpiper is easily frightened by noise and light, it will bravely resist any force that threatens its nest.<br/>Rewrite ​the sentence​,, beginning with ​: “​The sandpiper is easily frightened by noise and light,​” The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(44, 1, 0, 0, 2, 'If he had enough strength, Todd would move the boulder.<br/>Rewrite ​the sentence​,, beginning with ​: “ ​Todd cannot move the boulder ​“ The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(45, 1, 0, 0, 2, 'The band began to play, and then the real party started.<br/>Rewrite the sentence, beginning with​ : “​ The real party started​ “\n<br/>The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(46, 1, 0, 0, 2, 'Chris heard no unusual noises when he listened in the park.<br/>Rewrite ​the sentence​,, beginning with ​: “ ​Listening in the park,​” The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(47, 1, 0, 0, 2, 'It is unusual to see owls during the daytime, since they are nocturnal animals.<br/>Rewrite ​the sentence​,, beginning with ​: “ ​Being nocturnal animals, ​“ The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(48, 1, 0, 0, 2, 'If I want your opinion, I will ask for it.<br/>Rewrite ​the sentence​,, beginning with​ : “ ​I won’t ask for your opinion ​“ The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(49, 1, 0, 0, 2, 'It began to rain, and everyone at the picnic ran to the trees to take shelter.<br/>Rewrite ​the sentence​,, beginning with ​: “ ​Everyone at the picnic ran to the trees to take shelter ​“ The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(50, 1, 0, 0, 2, 'Lucy saw an amazing sight when she witnessed her first sunrise.<br/>Rewrite ​the sentence​,, beginning with ​: “ ​Witnessing her first sunrise​,” The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(51, 1, 0, 0, 2, 'After three hours of walking the museum, the entire family felt in need of a rest.<br/>Rewrite ​the sentence​,, beginning with ​: “ ​The entire family felt in need of a rest ​“ The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(52, 1, 0, 0, 2, 'The big celebration meal was over, and everyone began to feel sleepy.<br/>Rewrite ​the sentence​,, beginning with ​: “ ​Everyone began to feel sleepy​ “ The next few words will be\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(53, 1, 0, 0, 3, 'In the words of Thomas De Quincey, “It is notorious that the memory strengthens as you lay burdens upon it.” If, like most people, you have trouble recalling the names of those you have just met, try this: The next time you are introduced, plan to remember the names. Say to yourself, “I’ll listen carefully; I’ll repeat each person’s name to be sure I’ve got it, and I will remember.” You’ll discover how effective this technique is and probably recall those names for the rest of your life.<br/>The quotation from De Quincey indicates that the memory\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(54, 1, 0, 0, 3, 'In the words of Thomas De Quincey, “It is notorious that the memory strengthens as you lay burdens upon it.” If, like most people, you have trouble recalling the names of those you have just met, try this: The next time you are introduced, plan to remember the names. Say to yourself, “I’ll listen carefully; I’ll repeat each person’s name to be sure I have it, and I will remember.” You’ll discover how effective this technique is and probably recall those names for the rest of your life.<br/>The passage suggests that people remember names best when they\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(55, 1, 0, 0, 3, 'The wheel is considered one of the most important mechanical inventions of all time. Many technologies since the invention of the wheel have been based on its principles, and since the industrial revolution, the wheel has been a basic element of nearly every machine constructed by humankind. No one knows the exact time and place of the invention of the wheel, but its beginnings can be seen across many ancient civilizations.<br/>The passage suggests that the wheel is an important invention because it\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(56, 1, 1, 0, 3, 'Samuel Morse, best known today as the inventor of Morse Code and one of the inventors of the telegraph, was originally a prominent painter. While he was always interested in technology and studied electrical engineering in college, Morse went to Paris to learn from famous artists of his day and later painted many pictures that now hang in museums, including a portrait of former President John Adams. In 1825, Morse was in Washington, D.C., painting a portrait of the Marquis de Lafayette when a messenger arrived on horseback to tell him that his wife was gravely ill back at his home in Connecticut. The message had taken several days to reach him because of the distance. Morse rushed to his home as fast as he could, but his wife had already passed away by the time he arrived. Grief-stricken, he gave up painting and devoted the rest of his life to finding ways to transmit messages over long distances faster.<br/>Morse left the art world and helped to invent the telegraph because he\n', '', '2018-09-26 22:39:47', '2018-09-28 16:35:38'),
(57, 1, 0, 0, 3, 'The Midwest is experiencing its worst drought in 15 years. Corn and soybean prices are expected to be very high this year.<br/>What does the second sentence do?\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(58, 1, 0, 0, 3, 'Social studies classes focus on the complexity of our social environment. The subject combines the study of history and the social sciences and promotes skills in citizenship.<br/>What does the second sentence do?\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(59, 1, 0, 0, 3, 'Knowledge of another language fosters greater awareness of cultural diversity among the peoples of the world. Individuals who have foreign language skills can appreciate more readily other people’s values and ways of life.<br/>How are the two sentences related?\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(60, 1, 0, 0, 3, 'While most people think of dogs as pets, some dogs are bred and trained specifically for certain types of work. The bloodhound’s acute sense of smell and willing personality make it ideal for tracking lost objects or people.<br/>What does the second sentence do?\n<br/>While most people think of dogs as pets, some dogs are bred and trained\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(61, 1, 0, 0, 3, 'Paris, France, is a city that has long been known as a center of artistic and cultural expression. In the 1920s, Paris was home to many famous artists and writers from around the world, such as Picasso and Hemingway.<br/>What does the second sentence do?\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(62, 1, 0, 0, 3, 'Many people own different pets. Dogs, cats, birds, and fish are common household pets. Others pets are considered to be exotic animals. These include snakes, lizards, and hedgehogs.<br/>According to the passage, snakes are\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(63, 1, 0, 0, 3, 'Cesar Chavez was an influential leader for farmworkers. He fought for their rights and better working conditions. Chavez led many strikes that angered farm owners. Eventually he succeeded in getting increased wages and better living situations for farmworkers.<br/>The passage indicates that Chavez changed lives by\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(64, 1, 0, 0, 3, 'Dr. Ellen Ochoa is an inventor and is also the first female Hispanic astronaut. Her inventions include technology to help robots inspect equipment in space to maintain safety and quality control on spacecraft. Before retiring, she logged more than 1,000 hours in space across several space missions.<br/>According to the passage, Dr. Ochoa is the first\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(65, 1, 0, 0, 3, 'Flexible means', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(66, 1, 0, 0, 3, 'A contagious disease is <br/>The African elephant population has declined rapidly over the past twenty-five years. During this time, farmers have cleared and planted land where elephants once fed, and they chase off or kill elephants that raid their crops. Also, ivory hunting, which is now illegal but which still persists, has reduced the elephant herds dramatically.\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(67, 1, 0, 0, 3, 'The best title for this passage is', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(68, 1, 0, 0, 3, '“Declined” in line 1 means', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(69, 1, 0, 0, 3, 'When Karen entered the classroom, she noticed that many desks were missing. Rewrite the sentence, beginning with​ : “ ​ Entering the classroom, ​“<br/>The sentence will be completed by\n<br/>Before 1800, most people throughout the world lived in small villages in the countryside and worked on the land. But since then, more and more people have started to live and work in much larger communities. Today, more than half of the world’s population lives in towns and cities.\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(70, 1, 0, 0, 3, 'Most people in the world today', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(71, 1, 0, 0, 3, 'In Line 1, “throughout the world” means', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(72, 1, 0, 0, 3, '“What is the name of your new restaurant?”<br/>“It ___________ Café Lidia.”\n', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(73, 1, 0, 0, 3, 'I haven’t been to England since I was ten years old. Rewrite the sentence, beginning with ​: “ ​I last went to England ​“', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(74, 1, 0, 0, 3, '__________ are activities which a heart patient must forego.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(75, 1, 0, 0, 3, 'In the smaller towns of Wisconsin, __________ to the greening hills of Spring.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(76, 1, 0, 0, 3, 'Coach Jones is a remarkable physical specimen : __________.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(77, 1, 0, 0, 3, 'The swashbuckling hero was __________.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(78, 1, 0, 0, 3, 'One method of ending discrimination in business and industry is __________', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(79, 1, 0, 0, 3, 'Mr. Bole\'s recommendation was believed to be sufficient __________.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47'),
(80, 1, 0, 0, 3, 'Although she was only sixteen years old, __________.', '', '2018-09-26 22:39:47', '2018-09-26 22:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `question_option`
--

DROP TABLE IF EXISTS `question_option`;
CREATE TABLE `question_option` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `is_right` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_option`
--

INSERT INTO `question_option` (`id`, `question_id`, `content`, `is_right`) VALUES
(1, 1, 'most early', 0),
(2, 1, 'too early', 0),
(3, 1, 'more early', 0),
(4, 1, 'earliest', 1),
(5, 2, 'helped out', 1),
(6, 2, 'helped with', 0),
(7, 2, 'helps for', 0),
(8, 2, 'helps to', 0),
(9, 3, 'had', 1),
(10, 3, 'have', 0),
(11, 3, 'have had', 0),
(12, 3, 'having', 0),
(13, 4, 'about', 1),
(14, 4, 'at', 0),
(15, 4, 'for', 0),
(16, 4, 'to', 0),
(17, 5, 'had been', 0),
(18, 5, 'has been', 0),
(19, 5, 'was', 1),
(20, 5, 'will be', 0),
(21, 6, 'through', 0),
(22, 6, 'under', 0),
(23, 6, 'over', 0),
(24, 6, 'around', 1),
(25, 7, 'gives up', 1),
(26, 7, 'gives out', 0),
(27, 7, 'gave in', 0),
(28, 7, 'gave away', 0),
(29, 8, 'most young', 0),
(30, 8, 'more young', 0),
(31, 8, 'youngest', 1),
(32, 8, 'younger', 0),
(33, 9, 'It was the smallest.', 0),
(34, 9, 'It was not very large.', 0),
(35, 9, 'It was larger than some.', 0),
(36, 9, 'It was the largest.', 1),
(37, 10, 'Tonight', 0),
(38, 10, 'Tomorrow', 0),
(39, 10, 'Next week', 0),
(40, 10, 'Many weeks later', 1),
(41, 11, 'Lonely', 0),
(42, 11, 'Punctual', 1),
(43, 11, 'Talkative', 0),
(44, 11, 'Tardy', 0),
(45, 12, 'He was a doctor.', 0),
(46, 12, 'He was a merchant.', 0),
(47, 12, 'He was a writer.', 1),
(48, 12, 'He was an engineer.', 0),
(49, 13, 'Leave work', 0),
(50, 13, 'Come home from the airport', 0),
(51, 13, 'Get on an airplane', 0),
(52, 13, 'Go to bed', 1),
(53, 14, 'Boring', 0),
(54, 14, 'Lazy', 1),
(55, 14, 'Selfish', 0),
(56, 14, 'Tired.', 0),
(57, 15, 'very early', 0),
(58, 15, 'very late', 0),
(59, 15, 'nearly late', 1),
(60, 15, 'a little late', 0),
(61, 16, 'After', 1),
(62, 16, 'Before', 0),
(63, 16, 'By', 0),
(64, 16, 'Until', 0),
(65, 17, 'travel', 1),
(66, 17, 'travels', 0),
(67, 17, 'traveling', 0),
(68, 17, 'traveled', 0),
(69, 18, 'having frozen', 0),
(70, 18, 'freezing', 0),
(71, 18, 'freeze', 0),
(72, 18, 'freezes', 1),
(73, 19, 'Have', 0),
(74, 19, 'Does', 0),
(75, 19, 'Are', 0),
(76, 19, 'Did', 1),
(77, 20, 'dedication', 0),
(78, 20, 'his dedication', 1),
(79, 20, 'being dedicated', 0),
(80, 20, 'his being dedicated', 0),
(81, 21, 'have', 0),
(82, 21, 'will', 1),
(83, 21, 'did', 0),
(84, 21, 'are', 0),
(85, 22, 'for having discovered', 1),
(86, 22, 'for discovery', 0),
(87, 22, 'his discovery', 0),
(88, 22, 'in discovering', 0),
(89, 23, 'communicate', 1),
(90, 23, 'communicated', 0),
(91, 23, 'have communicated', 0),
(92, 23, 'communicates', 0),
(93, 24, 'So', 0),
(94, 24, 'Before', 0),
(95, 24, 'When', 1),
(96, 24, 'Though', 0),
(97, 25, 'traveling', 0),
(98, 25, 'travels', 1),
(99, 25, 'having traveled', 0),
(100, 25, 'will travel', 0),
(101, 26, 'Lisa and her sister Kelly plays the piano.', 0),
(102, 26, 'Both Lisa and her sister Kelly play the piano.', 1),
(103, 26, 'Lisa plays the piano and Kelly plays the piano.', 0),
(104, 26, 'Lisa and Kelly too play the piano.', 0),
(105, 27, 'Kazuko, going to the park, took her dog for a walk.', 0),
(106, 27, 'Kazuko took her dog for a walk to the park.', 1),
(107, 27, 'Kazuko took her dog for a walk because they went to the park.', 0),
(108, 27, 'Kazuko and her dog went to the park, where she and the dog walked.', 0),
(109, 28, 'We knew it might get chilly at the football game when we brought along some extra blankets.', 0),
(110, 28, 'Bringing along some extra blankets, we knew it might get chilly at the football game.', 0),
(111, 28, 'We brought along some extra blankets because we knew it might get chilly at the football game.', 1),
(112, 28, 'It got chilly at the football game and we brought along some extra blankets.', 0),
(113, 29, 'Both Juan and his friend Miguel enjoy playing baseball.', 1),
(114, 29, 'Juan and his friend Miguel enjoys playing baseball.', 0),
(115, 29, 'Juan enjoys playing baseball and his friend Miguel, too.', 0),
(116, 29, 'Juan loves baseball and Miguel too enjoys baseball.', 0),
(117, 30, 'Wolves are rarely spotted alone if they are pack animals.', 0),
(118, 30, 'Being pack animals, wolves are rarely spotted alone.', 1),
(119, 30, 'After being pack animals, wolves are rarely spotted alone.', 0),
(120, 30, 'Wolves are rarely spotted alone, although they are pack animals.', 0),
(121, 31, 'being a hobby that is', 0),
(122, 31, 'is a hobby because it is', 0),
(123, 31, 'which is a hobby', 0),
(124, 31, 'is a hobby', 1),
(125, 32, 'Knocked sideways, the statue looked', 1),
(126, 32, 'The statue was knocked sideways, looked', 0),
(127, 32, 'The statue looked knocked sideways', 0),
(128, 32, 'The statue, looking knocked sideways,', 0),
(129, 33, 'To walk, biking, and driving', 0),
(130, 33, 'Walking, biking, and driving', 1),
(131, 33, 'To walk, biking, and to drive', 0),
(132, 33, 'To walk, to bike, and also driving', 0),
(133, 34, 'When you cross the street in the middle of the block, this', 0),
(134, 34, 'You cross the street in the middle of the block, this', 0),
(135, 34, 'Crossing the street in the middle of the block', 1),
(136, 34, 'The fact that you cross the street in the middle of the block', 0),
(137, 35, 'a child, I noticed, was waiting', 0),
(138, 35, 'I noticed a child waiting', 1),
(139, 35, 'a child was waiting, I noticed,', 0),
(140, 35, 'there was, I noticed, a child waiting', 0),
(141, 36, 'Going back to his old school,', 0),
(142, 36, 'When he went back to his old school,', 1),
(143, 36, 'To go back to his old school,', 0),
(144, 36, 'As he went back to his old school,', 0),
(145, 37, 'Painting, drawing and to sculpt', 0),
(146, 37, 'To paint, to draw, and sculpting', 0),
(147, 37, 'Painting, drawing, and sculpting', 1),
(148, 37, 'To paint, draw, and sculpting', 0),
(149, 38, 'which is an activity', 0),
(150, 38, 'is an activity because it is', 0),
(151, 38, 'being an activity which is', 0),
(152, 38, 'is an activity', 1),
(153, 39, 'Glancing at his watch,', 1),
(154, 39, 'He glanced at his watch, and', 0),
(155, 39, 'To glance at his watch,', 0),
(156, 39, 'He glanced at his watch,', 0),
(157, 40, 'For a snake, shedding their skin', 0),
(158, 40, 'A snake shedding its skin', 1),
(159, 40, 'When a snake sheds its skin', 0),
(160, 40, 'To shed its skin, for snakes', 0),
(161, 41, 'I was surprised by the noise peering', 0),
(162, 41, 'I was surprised by the noise, peered', 0),
(163, 41, 'The noise surprised me, peering', 0),
(164, 41, 'Surprised by the noise, I peered', 1),
(165, 42, 'it is easy to', 0),
(166, 42, 'we can easily', 0),
(167, 42, 'solid objects can easily be', 1),
(168, 42, 'solid objects are easy to be', 0),
(169, 43, 'but it will bravely resist', 1),
(170, 43, 'nevertheless bravely resisting', 0),
(171, 43, 'and it will bravely resist', 0),
(172, 43, 'even if bravely resisting', 0),
(173, 44, 'when lacking', 0),
(174, 44, 'because he', 1),
(175, 44, 'although there', 0),
(176, 44, 'without enough', 0),
(177, 45, 'after the band began', 1),
(178, 45, 'and the band began', 0),
(179, 45, 'although the band began', 0),
(180, 45, 'the band beginning', 0),
(181, 46, 'no unusual noises could be heard', 0),
(182, 46, 'then Chris heard no unusual noises', 0),
(183, 46, 'and hearing no unusual noises', 0),
(184, 46, 'Chris heard no unusual noises', 1),
(185, 47, 'it is unusual to see owls', 0),
(186, 47, 'owls are not usually seen', 1),
(187, 47, 'owls during the daytime are', 0),
(188, 47, 'it is during the daytime that', 0),
(189, 48, 'if I want it', 0),
(190, 48, 'when I want it', 0),
(191, 48, 'although I want it', 0),
(192, 48, 'unless I want it', 1),
(193, 49, 'beginning to rain', 0),
(194, 49, 'when it began to rain', 1),
(195, 49, 'although it began to rain', 0),
(196, 49, 'and it began to rain', 0),
(197, 50, 'an amazing sight was seen', 0),
(198, 50, 'when Lucy saw an amazing sight', 0),
(199, 50, 'Lucy saw an amazing sight', 1),
(200, 50, 'seeing an amazing sight', 0),
(201, 51, 'walking through the museum for three hours', 0),
(202, 51, 'having walked through the museum for three hours', 1),
(203, 51, 'and they walked through the museum for three hours', 0),
(204, 51, 'despite having walked through the museum for three hours', 0),
(205, 52, 'and the big celebration meal', 0),
(206, 52, 'before the big celebration meal', 0),
(207, 52, 'after the big celebration meal', 1),
(208, 52, 'although the big celebration meal', 0),
(209, 53, 'always operates at peak efficiency', 0),
(210, 53, 'breaks down under great strain', 0),
(211, 53, 'improves if it is used often', 1),
(212, 53, 'becomes unreliable if it tires', 0),
(213, 54, 'meet new people', 0),
(214, 54, 'are intelligent', 0),
(215, 54, 'decide to do so', 1),
(216, 54, 'are interested in people', 0),
(217, 55, 'is one of the world’s oldest inventions', 0),
(218, 55, 'forms the basis of so many later inventions', 1),
(219, 55, 'can be traced to many ancient cultures', 0),
(220, 55, 'is one the world’s most famous inventions', 0),
(221, 56, 'was tired of painting', 0),
(222, 56, 'wanted to communicate with people far away', 0),
(223, 56, 'experienced a personal tragedy in his life', 1),
(224, 56, 'was fascinated by science', 0),
(225, 57, 'It restates the idea found in the first.', 0),
(226, 57, 'It states an effect.', 1),
(227, 57, 'It gives an example.', 0),
(228, 57, 'It analyzes the statement made in the first.', 0),
(229, 58, 'It expands on the first sentence.', 1),
(230, 58, 'It makes a contrast.', 0),
(231, 58, 'It proposes a solution.', 0),
(232, 58, 'It states an effect.', 0),
(233, 59, 'They contradict each other.', 0),
(234, 59, 'They present problems and solutions.', 0),
(235, 59, 'They establish a contrast.', 0),
(236, 59, 'They repeat the same idea.', 1),
(237, 60, 'It makes a contrast.', 0),
(238, 60, 'It restates an idea found in the first.', 0),
(239, 60, 'It states an effect.', 0),
(240, 60, 'It gives an example.', 1),
(241, 61, 'It reinforces the first.', 1),
(242, 61, 'It states an effect.', 0),
(243, 61, 'It draws a conclusion.', 0),
(244, 61, 'It provides a contrast.', 0),
(245, 62, 'uncommon pets', 1),
(246, 62, 'likely to be found in a household with dogs', 0),
(247, 62, 'found only in zoos', 0),
(248, 62, 'not allowed in people’s homes', 0),
(249, 63, 'helping to end the farmworkers’ strikes', 0),
(250, 63, 'fighting for the rights of farm owners', 0),
(251, 63, 'working on the farms every day', 0),
(252, 63, 'improving the conditions for farmworkers', 1),
(253, 64, 'Hispanic person to travel into space', 0),
(254, 64, 'inventor to travel into space. ', 0),
(255, 64, 'woman to travel into space', 0),
(256, 64, 'Hispanic woman to travel into space', 1),
(257, 65, 'firm to the touch', 0),
(258, 65, 'easily bent', 1),
(259, 65, 'shapeless', 0),
(260, 65, 'smooth.', 0),
(261, 66, 'dangerous', 0),
(262, 66, 'preventable', 0),
(263, 66, 'treatable', 0),
(264, 66, 'infectious.', 1),
(265, 67, 'The African Elephant', 0),
(266, 67, 'Living in Africa', 0),
(267, 67, 'The Decline of the African Elephant', 1),
(268, 67, 'Elephant Life-Cycles', 0),
(269, 68, 'increased.', 0),
(270, 68, 'decreased', 1),
(271, 68, 'remained the same.', 0),
(272, 68, 'disappeared.', 0),
(273, 69, 'many desks were missing.', 0),
(274, 69, 'and noticing that many desks were missing.', 0),
(275, 69, 'Karen noticed that many desks were missing.', 1),
(276, 69, 'so Karen noticed that many desks were missing.', 0),
(277, 70, 'live in small villages.', 0),
(278, 70, 'live in the countryside.', 0),
(279, 70, 'live in towns and cities.', 1),
(280, 70, 'work on the land.', 0),
(281, 71, 'outside the world', 0),
(282, 71, 'in the middle of the world', 0),
(283, 71, 'during the world', 0),
(284, 71, 'around the world', 1),
(285, 72, 'Calls', 0),
(286, 72, 'called', 0),
(287, 72, 'is calling', 0),
(288, 72, 'is called', 1),
(289, 73, 'when I was ten years old.', 1),
(290, 73, 'when I am ten years old.', 0),
(291, 73, 'during I was ten years old.', 0),
(292, 73, 'after I was ten years old', 0),
(293, 74, 'Heavy smoking and to overeat', 0),
(294, 74, 'Smoking heavily and to overeat', 0),
(295, 74, 'To smoke heavily and overeating', 0),
(296, 74, 'Heavy smoking and overeating', 1),
(297, 75, ', where one can quickly walk', 0),
(298, 75, 'where one can quickly walk', 0),
(299, 75, ', where one can quickly walk,', 0),
(300, 75, ', one can quickly walk', 1),
(301, 76, 'although sixty, he is as vigorous as ever.', 1),
(302, 76, 'he, seeing that he is sixty, is as vigorous as ever.', 0),
(303, 76, 'he is sixty, being as vigorous as ever.', 0),
(304, 76, 'as vigorous as ever, he is sixty years of age.', 0),
(305, 77, 'without moral convictions, acceptable manners, and he had little else in his favor.', 0),
(306, 77, 'without moral convictions or acceptable manners and had little else in his favor.', 1),
(307, 77, 'without moral convictions, acceptable manners or little else in his favor.', 0),
(308, 77, 'without moral convictions and acceptable manners or little else in his favor.', 0),
(309, 78, 'to demand quotas to be met by employers.', 0),
(310, 78, 'demanding employers to meet quotas.', 0),
(311, 78, 'to demand that employers meet quotas.', 1),
(312, 78, 'that employers be demanded to meet quotas.', 0),
(313, 79, 'and that it would guarantee my getting a job.', 0),
(314, 79, ', and that it would guarantee my getting a job.', 0),
(315, 79, ', and that it would guarantee me to get a job.', 0),
(316, 79, 'to guarantee my getting a job.', 1),
(317, 80, 'the university accepted her application because of her outstanding grades.', 0),
(318, 80, 'her outstanding grades resulted in her application being accepted by the university.', 0),
(319, 80, 'her application was accepted by the university because of her outstanding grades.', 0),
(320, 80, 'she was accepted to study at the university after applying because of her outstanding grades.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reading_main_content`
--

DROP TABLE IF EXISTS `reading_main_content`;
CREATE TABLE `reading_main_content` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `reading_text` mediumtext NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `student_id` varchar(128) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `extra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_session_answer`
--

DROP TABLE IF EXISTS `student_session_answer`;
CREATE TABLE `student_session_answer` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `is_correct` tinyint(4) NOT NULL,
  `student_answer` text NOT NULL,
  `create_time` datetime NOT NULL,
  `extra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_session_answer`
--

INSERT INTO `student_session_answer` (`id`, `section_id`, `student_id`, `question_id`, `is_correct`, `student_answer`, `create_time`, `extra`) VALUES
(1, 1, 33, 6, 0, 'array (\n  0 => \'21\',\n)', '2018-10-09 22:49:31', ''),
(2, 1, 33, 17, 0, 'array (\n  0 => \'68\',\n)', '2018-10-09 22:49:34', ''),
(3, 1, 33, 3, 0, 'array (\n  0 => \'10\',\n)', '2018-10-09 22:56:46', ''),
(4, 1, 33, 7, 0, 'array (\n  0 => \'27\',\n)', '2018-10-09 22:56:48', ''),
(5, 1, 33, 24, 0, 'array (\n  0 => \'96\',\n)', '2018-10-09 22:56:53', ''),
(6, 1, 33, 6, 0, 'array (\n  0 => \'24\',\n)', '2018-10-09 22:56:54', ''),
(7, 1, 33, 19, 0, 'array (\n  0 => \'76\',\n)', '2018-10-09 22:56:56', ''),
(8, 1, 33, 15, 0, 'array (\n  0 => \'60\',\n)', '2018-10-09 22:56:58', ''),
(9, 1, 33, 84, 0, 'array (\n  0 => \'340\',\n)', '2018-10-09 22:57:01', ''),
(10, 1, 33, 13, 0, 'array (\n  0 => \'51\',\n)', '2018-10-09 22:57:06', ''),
(11, 1, 33, 8, 0, 'array (\n  0 => \'32\',\n)', '2018-10-09 22:57:07', ''),
(12, 1, 33, 8, 0, 'array (\n  0 => \'32\',\n)', '2018-10-09 22:57:08', ''),
(13, 1, 33, 6, 0, 'array (\n  0 => \'22\',\n)', '2018-10-09 22:57:28', ''),
(14, 1, 22, 21, 0, 'array (\n  0 => \'81\',\n)', '2018-10-09 22:58:41', ''),
(15, 1, 22, 3, 0, 'array (\n  0 => \'9\',\n)', '2018-10-09 22:58:47', ''),
(16, 1, 222, 84, 0, 'array (\n  0 => \'338\',\n)', '2018-10-09 23:37:04', ''),
(17, 1, 222, 22, 0, 'array (\n  0 => \'86\',\n)', '2018-10-09 23:53:31', ''),
(18, 1, 222, 18, 0, 'array (\n  0 => \'71\',\n)', '2018-10-09 23:53:33', ''),
(19, 1, 222, 22, 0, 'array (\n  0 => \'88\',\n)', '2018-10-09 23:53:34', ''),
(20, 1, 222, 24, 0, 'array (\n  0 => \'95\',\n)', '2018-10-09 23:53:36', ''),
(21, 1, 222, 14, 0, 'array (\n  0 => \'55\',\n)', '2018-10-09 23:53:38', ''),
(22, 1, 222, 10, 0, 'array (\n  0 => \'39\',\n)', '2018-10-09 23:56:49', ''),
(23, 1, 222, 24, 0, 'array (\n  0 => \'94\',\n  1 => \'95\',\n)', '2018-10-09 23:57:52', ''),
(24, 1, 222, 84, 0, 'array (\n  0 => \'338\',\n)', '2018-10-09 23:58:26', ''),
(25, 1, 22, 1, 0, 'array (\n  0 => \'2\',\n  1 => \'3\',\n)', '2018-10-09 23:58:46', ''),
(26, 1, 22, 84, 1, 'array (\n)', '2018-10-10 00:35:04', ''),
(27, 1, 333, 18, 0, 'array (\n  0 => \'71\',\n)', '2018-10-10 09:15:11', ''),
(28, 1, 333, 15, 0, 'array (\n  0 => \'59\',\n)', '2018-10-10 09:15:12', ''),
(29, 1, 333, 23, 0, 'array (\n  0 => \'91\',\n)', '2018-10-10 09:15:14', ''),
(30, 1, 333, 13, 0, 'array (\n  0 => \'49\',\n)', '2018-10-10 09:15:16', ''),
(31, 1, 333, 2, 0, 'array (\n  0 => \'7\',\n)', '2018-10-10 09:16:41', ''),
(32, 1, 333, 10, 0, 'array (\n  0 => \'38\',\n)', '2018-10-10 09:16:53', ''),
(33, 1, 333, 18, 0, 'array (\n  0 => \'71\',\n)', '2018-10-10 09:16:55', ''),
(34, 1, 333, 25, 0, 'array (\n  0 => \'99\',\n)', '2018-10-10 09:16:57', ''),
(35, 1, 333, 23, 0, 'array (\n  0 => \'91\',\n)', '2018-10-10 09:16:59', ''),
(36, 1, 333, 8, 0, 'array (\n  0 => \'31\',\n)', '2018-10-10 09:17:00', ''),
(37, 1, 333, 18, 0, 'array (\n  0 => \'71\',\n)', '2018-10-10 09:17:02', ''),
(38, 1, 333, 6, 0, 'array (\n  0 => \'23\',\n)', '2018-10-10 09:17:04', ''),
(39, 1, 333, 17, 0, 'array (\n  0 => \'67\',\n)', '2018-10-10 09:17:05', ''),
(40, 1, 333, 4, 0, 'array (\n  0 => \'15\',\n)', '2018-10-10 09:17:08', ''),
(41, 1, 333, 19, 0, 'array (\n  0 => \'76\',\n)', '2018-10-10 09:17:11', ''),
(42, 1, 333, 18, 0, 'array (\n  0 => \'71\',\n)', '2018-10-10 09:17:12', ''),
(43, 1, 333, 3, 0, 'array (\n  0 => \'10\',\n)', '2018-10-10 09:17:16', ''),
(44, 1, 333, 12, 0, 'array (\n  0 => \'47\',\n)', '2018-10-10 09:17:18', ''),
(45, 1, 333, 10, 0, 'array (\n  0 => \'38\',\n)', '2018-10-10 09:34:29', ''),
(46, 1, 333, 9, 0, 'array (\n  0 => \'34\',\n)', '2018-10-10 09:35:15', ''),
(47, 1, 333, 17, 0, 'array (\n  0 => \'67\',\n)', '2018-10-10 09:36:45', ''),
(48, 1, 333, 20, 0, 'array (\n  0 => \'78\',\n)', '2018-10-10 09:36:57', ''),
(49, 1, 333, 21, 1, 'array (\n)', '2018-10-10 09:44:57', '');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `amdin_type` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `teacher_id` varchar(128) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `extra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `amdin_type`, `first_name`, `last_name`, `teacher_id`, `create_time`, `update_time`, `email`, `password`, `extra`) VALUES
(1, 1, 'first', 'last', '0', '2018-10-07 18:32:33', '2018-10-08 09:17:12', 'admin@admin', 'e10adc3949ba59abbe56e057f20f883e', '');

-- --------------------------------------------------------

--
-- Table structure for table `testing_session`
--

DROP TABLE IF EXISTS `testing_session`;
CREATE TABLE `testing_session` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `detail` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test_report`
--

DROP TABLE IF EXISTS `test_report`;
CREATE TABLE `test_report` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` float NOT NULL,
  `extra` text NOT NULL,
  `create_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_report`
--

INSERT INTO `test_report` (`id`, `session_id`, `student_id`, `score`, `extra`, `create_time`) VALUES
(1, 1, 33, 0, '', '2018-10-09 22:57:28'),
(2, 1, 22, 0, '', '2018-10-09 22:58:47'),
(3, 1, 22, 2, '', '2018-10-10 00:35:04'),
(4, 1, 333, 2, '', '2018-10-10 09:44:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_option`
--
ALTER TABLE `question_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `reading_main_content`
--
ALTER TABLE `reading_main_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_session_answer`
--
ALTER TABLE `student_session_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `testing_session`
--
ALTER TABLE `testing_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_report`
--
ALTER TABLE `test_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `question_option`
--
ALTER TABLE `question_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `reading_main_content`
--
ALTER TABLE `reading_main_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_session_answer`
--
ALTER TABLE `student_session_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testing_session`
--
ALTER TABLE `testing_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_report`
--
ALTER TABLE `test_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
