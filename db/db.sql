-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2019 at 12:34 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_review_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'coderflare@yahoo.com', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL,
  `movie_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `movie_id`, `user_id`, `user_name`, `comment`, `date`) VALUES
(1, 14, 15, 'Ravi Rathod', 'Ha ha it\'s not horror movie it\'s comedy movie ????????????', '2019-05-16 05:43:17'),
(2, 6, 12, 'user', 'guju', '2019-05-16 09:55:49'),
(3, 5, 12, 'user', 'chelo', '2019-05-16 09:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genres`
--

CREATE TABLE `tbl_genres` (
  `gid` int(11) NOT NULL,
  `genre_name` varchar(255) NOT NULL,
  `genre_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_genres`
--

INSERT INTO `tbl_genres` (`gid`, `genre_name`, `genre_image`) VALUES
(1, 'Horror', '88406_Horror.jpg'),
(3, 'Action', '33053_Action.jpg'),
(4, 'Thriller', '54577_Thrille.jpg'),
(5, 'Drama', '92886_Drama_2_23.jpg'),
(6, 'Love', '35754_LoveMovie.jpg'),
(7, 'Comedy', '95352_Comedy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE `tbl_language` (
  `id` int(11) NOT NULL,
  `language_name` varchar(60) NOT NULL,
  `language_background` varchar(30) NOT NULL,
  `is_on_home` varchar(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_language`
--

INSERT INTO `tbl_language` (`id`, `language_name`, `language_background`, `is_on_home`, `status`) VALUES
(1, 'English', '00FF8F', 'on', 1),
(2, 'Hindi', 'FF771B', '', 1),
(3, 'Gujarati', '15A1FF', '', 1),
(4, 'South Indian', 'FF1F7C', '', 1),
(9, 'عربى', 'E863E9', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photo_gallery`
--

CREATE TABLE `tbl_photo_gallery` (
  `id` int(11) NOT NULL,
  `parent_id` int(5) NOT NULL,
  `image_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_photo_gallery`
--

INSERT INTO `tbl_photo_gallery` (`id`, `parent_id`, `image_name`) VALUES
(1, 18, '90904_hym30OkkaKshanam.jpg'),
(2, 18, '60246_kshanam-20160203170914-14871.jpg'),
(3, 18, '1120_kshanam-et00038680-24-03-2017-19-26-25.jpg'),
(4, 18, '39781_Kshanam-Remake--Bang-On-Target-1497953894-1911.jpg'),
(5, 5, '55476_Chhello-Divas-Gujarati-Movie-Review.jpg'),
(6, 5, '57867_maxresdefault.jpg'),
(7, 3, '15707_spider_poster.0.jpg'),
(8, 3, '63306_spidermanhomecoming.jpg'),
(9, 17, '24528_59236474.jpg'),
(10, 17, '96942_rgxpyzifgbgbe.jpg'),
(11, 16, '18581_711eHgGtnFL._SX522_.jpg'),
(12, 16, '16986_baahubali-2-review-rating.jpg'),
(13, 16, '69273_PCTV-1770016137-hcdl.jpg'),
(14, 15, '41123_306-singam-iii-movie-review-1.jpg'),
(15, 15, '71703_105496_thumb_665.jpg'),
(16, 15, '39972_x1080-LzB.jpg'),
(17, 14, '69016_bhoot-returns-wallpaper-01.jpg'),
(18, 13, '54684_horror1.jpg'),
(19, 12, '42707_gone-girl-4.jpg'),
(20, 12, '98392_gone-girl-df-05063_05054_comp5_rgb.jpg'),
(21, 11, '88384_5ac36ecadd97b.png'),
(22, 11, '19222_OB-XR180_iyjhd_G_20130531074212.jpg'),
(23, 11, '84519_All-Actors-of-Yeh-Jawaani-Hai-Deewani.jpg'),
(24, 10, '38978_sultan-salman-khan-anushka-sharma.jpg'),
(25, 10, '8421_salman-khan-sultan-1468333953.jpg'),
(26, 10, '41051_480872-salman-sultan.jpg'),
(27, 10, '55761_sultan.jpg'),
(28, 8, '14351_before-midnight-1200-1200-675-675-crop-000000.jpg'),
(29, 8, '35896_before-midnight-stills-film-summary-com.jpg'),
(30, 2, '82689_Tubelight-Movie-Stills-02.jpg'),
(31, 2, '86164__ecaf12c4-542c-11e7-869c-505e32be9126.jpg'),
(32, 2, '53063_tubelight-new-story_647_062117043237.jpg'),
(33, 1, '97089_dc-Cover-96v48a1t974ngsdulj8jdv0ja7-20170518202819.Medi.jpeg'),
(34, 19, '97620_Coming-Forth-By-Day.jpg'),
(35, 20, '91115_TaJ7A94nihcLwGbePIN9W3gx_large.jpg'),
(36, 20, '20928_avengers-endgame-2019.jpeg'),
(37, 20, '85040_avengers-endgame-poster-square-crop.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `post_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `rate` int(5) NOT NULL,
  `dt_rate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`id`, `post_id`, `user_id`, `rate`, `dt_rate`) VALUES
(1, 18, 12, 3, '2019-05-14 08:39:38'),
(2, 5, 12, 3, '2019-05-14 08:58:57'),
(3, 4, 12, 3, '2019-05-14 09:13:45'),
(4, 1, 12, 5, '2019-05-14 09:20:51'),
(5, 16, 12, 5, '2019-05-14 10:21:08'),
(6, 17, 12, 5, '2019-05-15 06:00:44'),
(7, 10, 12, 5, '2019-05-15 06:15:50'),
(8, 15, 12, 2, '2019-05-15 06:22:42'),
(9, 18, 14, 5, '2019-05-15 07:01:27'),
(10, 11, 12, 5, '2019-05-15 11:16:09'),
(11, 14, 15, 4, '2019-05-16 04:53:21'),
(12, 15, 15, 3, '2019-05-16 06:51:03'),
(13, 20, 12, 1, '2019-05-16 08:19:17'),
(14, 19, 12, 5, '2019-05-16 08:35:11'),
(15, 12, 12, 5, '2019-05-16 08:35:46'),
(16, 20, 15, 5, '2019-05-16 08:51:19'),
(17, 6, 15, 2, '2019-05-16 08:53:02'),
(18, 16, 16, 5, '2019-05-16 09:44:59'),
(19, 8, 15, 3, '2019-05-16 10:14:57'),
(20, 4, 15, 2, '2019-05-16 10:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `id` int(11) NOT NULL,
  `language_id` int(5) NOT NULL,
  `genre_id` int(5) NOT NULL,
  `movie_title` varchar(150) NOT NULL,
  `movie_trailer` text,
  `movie_casts` text NOT NULL,
  `movie_cover` text NOT NULL,
  `movie_poster` text NOT NULL,
  `movie_desc` longtext NOT NULL,
  `movie_date` date NOT NULL,
  `video_url` text NOT NULL,
  `video_id` text NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT '0',
  `total_rate` varchar(30) NOT NULL DEFAULT '0',
  `rate_avg` varchar(30) NOT NULL DEFAULT '0',
  `admin_rate` int(5) DEFAULT '0',
  `featured` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`id`, `language_id`, `genre_id`, `movie_title`, `movie_trailer`, `movie_casts`, `movie_cover`, `movie_poster`, `movie_desc`, `movie_date`, `video_url`, `video_id`, `total_views`, `total_rate`, `rate_avg`, `admin_rate`, `featured`, `status`) VALUES
(1, 2, 5, 'Guest Iin London Movie Review', NULL, 'Kartik Aaryan, Paresh Rawal, Tanvi Azmi, Kirti Kharbanda', '41384_dc-Cover-q0vrpb82scf3hjm7aonhvmbdu3-20170708012355.Medi.jpeg', '81324_P_HO00004677.jpg', '<p><strong>GUEST IIN LONDON&nbsp;</strong><strong>STORY</strong>: Aryan and his wife are saddled with the responsibility of uninvited guests, who have a dozen desi quirks and no sense of boundaries.<br />\r\n<br />\r\n<strong>GUEST IIN LONDON&nbsp;</strong><strong>REVIEW</strong>: Guest iin London goes against everything the movie industry has been trying to accomplish in the recent past.<br />\r\n<br />\r\nIt spends 2 hours and 18 minutes hitting CTRL+Z on the kind of experimental storytelling, fresh writing and gender balance that the industry has been striving towards.<br />\r\n<br />\r\nInstead, it gives us men talking down to women, nonchalant racism, forced gay humour and a buttload of fart jokes. So much so that Paresh Rawal&rsquo;s character recites a minutes-long &ldquo;ghazal&rdquo; about farts. The movie covers toilet humour extensively from poop and pee jokes, right up to kidney stones.<br />\r\n<br />\r\nThe first Ajay Devgn-Konkona Sensharma movie, Atithi Tum Kab Jaoge? hit a home run owing to its charming, unassuming execution. It turned the atithi devo bhava sentiment on its head and became an outlet for our collective rogue-guests rage. However, the paper-thin plot was already used to its fullest in that movie. A sequel wasn&rsquo;t needed. But it is unleashed on us anyway.</p>\r\n', '2016-07-07', 'https://www.youtube.com/watch?v=nPezCIqTZ-k', 'nPezCIqTZ-k', 119, '7', '3', 3, 0, 1),
(2, 2, 5, 'Tubelight Movie Review', NULL, 'Salman Khan, Sohail Khan, Om Puri, Mohammed Zeeshan Ayyub, Matin Rey Tangu, Zhu Zhu', '16149_maxresdefault.jpg', '22757_PCTV-1000194295-vl.jpg', '<p><strong>TUBELIGHT&nbsp;</strong><strong>STORY :</strong>&nbsp;​ Laxman Singh Bisht (Salman) is nicknamed tube light by his neighbours because he is feeble-minded. Despite being special, Laxman lives by one life-lesson; keep the faith alive and you can do almost anything, even stop a war.<br />\r\n<br />\r\n<strong>TUBELIGHT&nbsp;</strong><strong>REVIEW :</strong>&nbsp;​ At the outset, one must warn people that Tubelight is a departure from your regular Salman Khan mass entertainer. Here Bollywood&rsquo;s darling-star plays a child-man who doesn&rsquo;t take off his shirt or flex his biceps. So the audience going in for this one should invest belief (or should that be disbelief?) in this age of innocence offering from Kabir Khan, whose past outings Ek Tha Tiger and Bajrangi Bhaijaan were more commercially-wired.</p>\r\n', '2016-06-26', 'https://www.youtube.com/watch?v=PGQRNKHJwH4', 'PGQRNKHJwH4', 122, '2', '5', 2, 0, 1),
(3, 1, 3, 'Spider-Man: Homecoming Movie Review', NULL, 'Tom Holland, Michael Keaton, Robert Downey Jr, Marisa Tomei, Jon Favreau, Zendaya', '22167_spider_poster.0.jpg', '9348_spider_poster.0.jpg', '<p><strong>SPIDER-MAN: HOMECOMING&nbsp;</strong><strong>STORY :</strong>&nbsp;It&#39;s been a while since Captain America: Civil War, where an ecstatic and starstruck teen Spider-Man/Peter Parker (Tom Holland) rubbed shoulders with the mighty Avengers. Months later, Peter yearns for the heroic experience once again. But mentor Tony Stark aka Iron Man (Robert Downey Jr) advises him to go back to school and patiently wait for his moment of glory, when he can assist the Avengers.<br />\r\n<br />\r\n<strong>SPIDER-MAN: HOMECOMING&nbsp;</strong><strong>REVIEW :&nbsp;</strong>However, patience is certainly not the boy&rsquo;s virtue. Desperate to earn a sensational &#39;job offer&#39; from Stark, the trainee masked crusader curbs petty robberies and scouts for a crime worthy enough to fight. He soon runs into &lsquo;Vulture&rsquo; (Michael Keaton), a man who poses real threat to lives. Can Spider-boy take him down?<br />\r\n<br />\r\nJon Watts starts his film with a clean slate. Unlike the previous outings, his Spider-Man reboot doesn&rsquo;t necessarily have the aura of a superhero epic. He gives it a quirky campus-caper twist, which evokes mixed views initially. His Peter is solely focussed on being an A list (Avengers like) superhero. There are no sob stories of Uncle Ben or Aunt May either. May in fact, is a hottie (Marisa Tomei)! Once you warm up to Watts&rsquo; vision, this Spidey film, replete with humour and thrilling stunt scenes, grows on you and tugs at your heartstrings eventually.</p>\r\n', '2017-07-07', 'https://www.youtube.com/watch?v=xuaChFO2Q0Y', 'xuaChFO2Q0Y', 101, '2', '4', 0, 0, 1),
(4, 3, 6, 'Romance Complicated', 'https://www.youtube.com/watch?v=IJfBXfAXZcc', 'Malhar Pandya, Divya Misra, Dharmesh Vyas, Shekhar Shukla, Darshan Jariwala, Nisha Kalamdani, Umang Acharya, Yulia Yanina, Dhwani Gautam', '40649_rom2bcom2bsmsbunches.jpg', '56980_0c693e68ead7853c410090c4adbdd6c2.jpg', '<p>As a favor to his father&#39;s best friend, a young man agrees to escort a woman to America where she&#39;s expected to devote herself to her studies.<br />\r\n<br />\r\nRomance Complicated is a journey of exploring emotions, romance, friendship and life. When two opposite characters, Dev and Maahi meet under circumstances created by destiny, life takes them through paths never thought of. From virtual relations to encounters with reality, from arguments to friendship and from comedy to romance, a tale of emotions rather than a story of two people. Dev, the king of romance, flirtatious and a hardcore bollywood devotee yet innocent desi guy meets Maahi, the ultramodern, carefree, gorgeous and arrogant high society girl. Stuck together in pursuit of their selfish motives, they understand the true essence of their strange but irresistible bonding. Initial problems soon become a reason for living, and life takes a sharp bend when sparks arise, complicating things to the maximum and taking you through a roller coaster ride of emotions. The movie also portrays the transformation of all characters as they pass through different phases of the story.</p>\r\n', '2016-01-15', 'https://www.youtube.com/watch?v=IJfBXfAXZcc', 'IJfBXfAXZcc', 63, '3', '3', 4, 0, 1),
(5, 3, 7, 'Chhello Divas', NULL, 'Malhar Thakar, Yash Soni, Mitra Gadhvi, Aarjav Trivedi, Rahul Raval, Janki Bodiwala, Kinjal Rajpriya, Netri Trivedi', '64111_Chhello-Divas-Gujarati-Movie-Review.jpg', '196_MV5BMTViN2VlN2QtYjc3Zi00M2EzLWIyNWItZDI5MTUwNmYyMWVkXkEyXkFqcGdeQXVyNjQzNTMxNDQ@._V1_.jpg', '<p>The movie revolves around the lives of eight friends and their journey of growing up while they face the highs and lows of their relationships, love and romance, the end of their college days and the beginning of a new life.</p>\r\n\r\n<p>Chhello Divas (2015) Directed by Krishnadev Yagnik is a light hearted comedy movie with some really good punches. The movie revolves around college life of eight friends and their journey of their graduation.<br />\r\n<br />\r\nThis is my first review for a Gujarati movie. I think Gujarati cinema is becoming a mainstream cinema and taking steps forward with big budget films and a full-fledged theatrical releases all over India after Kevi Rite Jaish and Bey Yaar.<br />\r\n<br />\r\nTalking about this movie, had enjoyed a lot while watching and relive that college time memories again. The dialouges are truly gujju which will be stay back with you till long as you can relate them with the day to day situation.<br />\r\n<br />\r\nWhen we talk about the technical aspect there are some flaws in the movie, the background score was too over and some scenes looks too over dramatic because of that.Acting was brilliant by all lead actors except Loy (Mitra Gadhvi) in some scenes.<br />\r\n<br />\r\nOverall it was a brilliant effort to make such a good cinema. Will look forward for more good movies from this industry.</p>\r\n', '2015-09-20', '', '', 57, '3', '3', 5, 1, 1),
(6, 3, 5, 'Gujjubhai the Great', NULL, 'Siddharth Randeria, Jimit Trivedi, Swati Shah, Dipna Patel, Alekh Sangal, Sunil Vishrani, Annapurna Shukla, Khatera Hakimi, Dharmesh Vyas', '84856_gujjubhai-the-great.jpg', '70524_Gujjubhai_The_Great_Poster.jpg', '<p>Hasmukh Gandhi has a simple philosophy: enjoy and let enjoy. But his stress-free life is interrupted when his daughter, Tanisha comes home with her boyfriend, Montu. While everyone in the Gandhi family has fallen for Montu&#39;s charm, Hasmukh sees him for the trickster he is. Not wanting his daughter to be entrapped, Hasmukh has found the perfect boy for her; one who is not only trustworthy, but also someone he knows will take care of her. The trouble is no one approves of his choice. Bakul Buch, Hasmukh&#39;s hardworking manager has always had a soft spot for Tanisha but has never been brave enough to talk to any woman, let alone Tanisha. Hasmukh takes it upon himself to transform Bakul from the simpleton that he is, to a cool &#39;gujju&#39;. Hasmukh puts in place a series of events that soon start to go terribly out of his control, with some totally unexpected consequences; Bakul has no choice but to play along, and Montu is onto them at every turn. And if their cat and mouse game was not crazy enough, the police suspect Hasmukh and Bakul to be wanted terrorists and follow their every move. What begins then is the most bizarre gujju love story ever told, with lies, spies, underworld dons, and a curious case of a gold bracelet. Will Bakul manage to win over Tanisha?<br />\r\n<br />\r\nI have been an ardent fan of Gujjubhai since I watched &quot;Lage Raho Gujjubhai&quot; (the natak) 5 years ago. I have tried to watch his plays whenever I get time. When I came to know that this movie is currently in a multiplex near me, and that too only one show at 3:00 PM, I took a leave from office and went and saw the movie!<br />\r\n<br />\r\nBelieve me, I was not disappointed at all. Had a laughter riot in the hall. Great work by Bakul &amp; Hasubhai. Great actors both of them. With their entry in bollywood, sky is the limit!<br />\r\n<br />\r\nI hope we get to see more such mainstream Gujarati movies in the future!</p>\r\n', '1970-01-01', '', '', 57, '2', '2', 5, 0, 1),
(7, 1, 3, 'The Fate of the Furious 8 ', NULL, 'Vin Diesel, Dwayne Johnson, Jason Statham, Michelle Rodriguez, Tyrese Gibson, Chris', '16961_noticias2010_-3672742.jpg', '58677_b125d7b60c2141bf409bf61112fb4201.jpg', '<p>Now that Dom and Letty are on their honeymoon and Brian and Mia have retired from the game-and the rest of the crew has been exonerated-the globetrotting team has found a semblance of a normal life. But when a mysterious woman seduces Dom into the world of crime he can&#39;t seem to escape and a betrayal of those closest to him, they will face trials that will test them as never before. From the shores of Cuba and the streets of New York City to the icy plains off the arctic Barents Sea, the elite force will crisscross the globe to stop an anarchist from unleashing chaos on the world&#39;s stage... and to bring home the man who made them a family.</p>\r\n', '2017-04-12', '', '', 12, '1', '5', 5, 0, 1),
(8, 1, 6, 'Before Midnight', NULL, 'Richard Linklater, Ethan Hawk, Julie Delpy', '81844_hi-before-midnight-8col.jpg', '88351_92d3912d3898be1b95652cbbbd854064c07d0cbb.jpg', '<p>Nine years have passed since&nbsp;<em>Before Sunset</em>. Jesse and C&eacute;line have become a couple and parents to twin girls. Jesse struggles to maintain his relationship with his teenage son, Hank, who lives in Chicago with Jesse&#39;s ex-wife. After Hank spends the summer with Jesse and C&eacute;line on the Greek&nbsp;Peloponnese&nbsp;peninsula, Jesse drops him off at the airport to fly home. Jesse is a successful novelist, while C&eacute;line is at a career crossroads, considering a job with the&nbsp;French government.</p>\r\n\r\n<p>The couple discuss their concerns about Hank, and then about C&eacute;line&#39;s choices for her career. Over dinner they talk more about love and life. Friends staying with them pay for a hotel room so they can have a night alone. While walking to the hotel, the couple reminisce about coming together. After reaching the hotel, they have a fierce argument, expressing fears about their present and future together. Among other issues, Jesse wants them to move to Chicago so he can be closer to Hank, which C&eacute;line thinks will cost her any chance of a life outside her family. In the heat of the argument, C&eacute;line tells Jesse she no longer loves him.</p>\r\n\r\n<p>C&eacute;line leaves their room and sits alone in the hotel&#39;s outdoor restaurant. Jesse joins her and jokes that he is a time traveler bringing her a letter from her 82-year-old self, describing this night as one of the best of their lives. Unamused, C&eacute;line says their fantasies will never match the imperfect reality. Jesse proclaims his love, saying he does not know what else she could want. After a moment, C&eacute;line joins in Jesse&#39;s joke, and the two seem to reconcile.</p>\r\n', '2013-05-22', '', '', 27, '2', '3', 2, 0, 1),
(9, 2, 7, 'Housefull (2010 film)', NULL, 'Akshay Kumar, Arjun Rampal, Ritesh Deshmukh, Deepika Padukone, Lara Dutta, Jiah Khan, Boman Irani, Randhir Kapoor, Chunkey Pandey, Malaika Arora Khan', '15375_Housefull-Movie-Poster.jpg', '3035__315x420_63a5f8069c45ca38adc081ebc525de97d27b547cd5a111458f145f4b931e8456.jpg', '<p>Housefull is a romantic comedy entertainer which narrates the story of Aarush - the world&#39;s unluckiest man. Being jinxed, he believes his bad luck can vanish if he finds true love. In this quest for true love how one lie leads to another and how different people from different walks of life come together adding even more confusion to this hilarious comedy of errors resulting in total chaos and mayhem forms the crux of the story. The line which Deepika tells Akshay in the film &quot;Jis jhooth se kissi ka ghar basta ho, voh jhooth jhooth nahin hota&quot;, pretty much sums up the essence of the film.</p>\r\n', '2010-04-30', '', '', 16, '1', '5', 5, 0, 1),
(10, 2, 3, 'Sultan (2016 film)', NULL, 'Salman Khan, Anushka Sharma, Randeep Hooda, Amit Sadh', '21919_maxresdefault.jpg', '98596_MV5BNDc0OTU3M2MtMGFhMi00ZGVlLWI4YmItODA1ZTc0OGY0NmJlXkEyXkFqcGdeQXVyNjQ2MjQ5NzM@._V1_.jpg', '<p>Sultan is a story of Sultan Ali Khan - a local wrestling champion with the world at his feet as he dreams of representing India at the Olympics. It&#39;s a story of Aarfa - a feisty young girl from the same small town as Sultan with her own set of dreams. When the 2 local wrestling legends lock horns, romance blossoms and their dreams and aspirations become intertwined and aligned. However, the path to glory is a rocky one and one must fall several times before one stands victorious - More often than not, this journey can take a lifetime. Sultan is a classic underdog tale about a wrestler&#39;s journey, looking for a comeback by defeating all odds staked up against him. But when he has nothing to lose and everything to gain in this fight for his life match... Sultan must literally fight for his life. Sultan believes he&#39;s got what it takes... but this time, it&#39;s going to take everything he&#39;s got.</p>\r\n', '2016-07-06', '', '', 29, '2', '5', 3, 0, 1),
(11, 2, 6, 'Yeh Jawaani Hai Deewani', NULL, 'Ranbir Kapoor, Deepika Padukone, Aditya Roy Kapurl, Kalki Koechlin', '62381_deepika-Padukone-yeh-jawaani-hai-deewani-1.jpg', '40812_345fecf5e269212d9a287508648ec173.jpg', '<p>Yeh Jawaani Hai Deewani is the story of the relationship between two characters, Bunny (Ranbir Kapoor) &amp; Naina (Deepika Padukone), at two separate but defining times in their lives... first, when they are just out of college and standing on the crossroads of multiple decisions that will shape who and what they become... and then later on, in their late-twenties when they meet again, holding on to certain fulfilled and certain unfulfilled dreams, at a crossroads of another nature this time... how these two characters affect, change, befriend and eventually fall in love with each other is the journey the film aspires to take us on<br />\r\n<br />\r\nFrom the director of &quot;Wake up Sid,&quot; the star-studded cast and Dharma productions, the expectations are high. Yeh Jawani Hain Deewani falls short on the direction, significantly. The production value is high; the songs, the locales and background scores are all great. However, the story is awful. There is nothing new in the story or the story-telling. Wake Up Sid did not have a new story but the direction was spot on. This movie has unnecessary songs (i.e. Madhuri&#39;s song), flashbacks (major set back in direction) and forced emotional scenes. There didn&#39;t seem to be any character progression as well. Taran Adarsh (bollywood hungama) raves about the character progression but I beg to differ.&nbsp;<br />\r\n<br />\r\nThis movie is fine for the audience who like the ZeeTV romantic shows, who are Ranbir-Deepika lovers or the people who go to movies for the cinematography. But to the lovers of new bollywood, this movie is not recommended. About 75% of the movie is very predictable, moves at a slow pace and illogical.&nbsp;</p>\r\n', '2013-05-31', '', '', 46, '2', '5', 0, 0, 1),
(12, 1, 4, 'Gone Girl ', NULL, 'Ben Affleck, Rosamund Pike, Neil Patrick Harris, Tyler Perry', '24368_47821_Gone-Girl-2014.jpg', '63840_gone-girl-movie-review-ben-affleck-ftr.jpg', '<p>On the occasion of his fifth wedding anniversary, Nick Dunne reports that his wife, Amy, has gone missing. Under pressure from the police and a growing media frenzy, Nick&#39;s portrait of a blissful union begins to crumble. Soon his lies, deceits and strange behavior have everyone asking the same dark question: Did Nick Dunne kill his wife?</p>\r\n', '2014-10-10', '', '', 35, '2', '5', 3, 0, 1),
(13, 1, 1, 'Horror (2015 film)', NULL, 'Chloë Sevigny, Natasha Lyonne, Timothy Hutton, Taryn Manning, Balthazar Getty, Lydia Hearst, Stella Schnabel', '14037_horror1.jpg', '13052_a1733095630_10.jpg', '<p>#HORROR is a film about the lives of six young girls, Sam, Georgie, Sofia, Francesca, Cat and Eva played by our ensemble of emerging actresses. Their world is one of money, success, leisure and decadence. This is a film about the HORROR of cyberbullying. This film is an integral insight on the pressure that girls take on as they grow in a world that is increasingly dependent on the promotion and attention that social media platforms provide yet prevent bullying. as well as the roles that parents must play regarding controlling their child&#39;s use of the internet and bullying plays such a terrifying role in society. These young girls are telling this story inside a glass mansion, filled with millions of dollars of artwork, as if they were living in a contemporary art museum.</p>\r\n', '2015-09-20', 'https://www.youtube.com/watch?v=NZfig3-zn3M', 'NZfig3-zn3M', 46, '1', '5', 0, 0, 1),
(14, 2, 1, 'Bhoot Returns', NULL, 'Manisha Koirala, J. D. Chakravarthy, Madhu Shalini, Alayana Sharma', '67924_bhoot-returns-wallpaper-01.jpg', '57523_26968.jpg', '<p>This story revolves around a family that moves into a new bungalow. Soon the family members experience weird things happening in the house. The little girl Nimmi claims the presence of an invisible figure named Shabbu thus putting her parents in trouble. Pooja (the sister of Nimmi&#39;s father) surprises the family by a sudden visit, and after analyzing the situation that Nimmi is suffering from, she places wireless cameras all over the house to record the activities of Nimmi. With the passage of time, Laxman (the servant) and Taman (the brother of Nimmi) are brutally murdered. Lastly, the possessed girl Nimmi is burned down and the family flee, bloody and injured.</p>\r\n', '2012-10-12', 'https://www.youtube.com/watch?v=zhn2aBvv2BQ', 'zhn2aBvv2BQ', 22, '1', '4', 0, 0, 1),
(15, 4, 3, 'Singam 3', NULL, 'Suriya, Anushka Shetty, Shruti Haasan', '54330_306-singam-iii-movie-review-1.jpg', '54709_singam-3-indian-movie-poster-md.jpg', '<p>The film starts with tremble in Andhra Pradesh legislature where long pending murder case of city commissioner Ramakrishna (Jayaprakash) is being discussed where home minister K. Sathyanarayana (Sarath Babu) proposes to bring DCP Durai Singam (Suriya) from Tamil Nadu police to solve the long pending case. Initially being attacked by Madhusudhana Reddy&#39;s (Sharat Saxena) men at the railway station at arrival Durai Singam bashes them out and joins the Visakhapatnam police force under CBI pretending to be casual and not serious about the murder case Durai Singam secretly investigates the case from all aspects. Meanwhile, Durai Singam is being followed by Vidhya (Shruti Haasan) who is a journalist from Andhra Pradesh tracking Durai Singam in disguise as student applied for IPS exams. Durai Singam initially says divorced his wife Kavya (Anushka Shetty), but secretly contacts her later, after suspicion of Subba Rao (Robo Shankar), it is told to play to avoid Kavya from attacks from suspects of the murder case. But, finally finding Reddy is behind the murder in series of investigation decides to wipe out goondas in Vishakhapatnam along with arresting Police officers involved in the murder of commissioner. After, tracking a suspect he come across to know illegal dumping of Bio-waste and E-Waste from Australia by Vittal Prasad (Thakur Anoop Singh) a wealthy businessman from Australia and son of central minister Ram Prasad (Suman) who works as master mind behind dumping of wastes from Australia for his business benefits in Vishakapatnam by help of Reddy and his staff Rajeev Krishna (Kamalesh). When the commissioner tried to expose this to media he was brutally killed by Reddy and his subordinates. This is proved by the witness from assistant commissioner&#39;s driver Malaya (Jeeva Ravi) and school teacher (Joe Malloori) who lost his granddaughter in toxic smoke caused by burning wastes from Australia in nearby dump yard. When Durai Singam attempts to arrest Reddy and Vittal Prasad with help the witness and evidence collected, Reddy&#39;s men kill the school teacher and warn Durai Singam that he will destroy his whole family from Australia if he further investigates the case. Durai Singam travels to Australia like a personal trip with his wife, but he actually goes to get all the shreds of evidence of Vittal&#39;s Business. After returning from Australia he tackles every rowdies and henchman of Reddy and kills him. Angry Vittal arrives Visakhapatnam and warns Durai Singam. As expecting arrival of Vittal to Visakhapatnam, Durai Singam exposes the containers that contained the waste to the press and warns Vittal to surrender. Vittal tries to kill Vidhya who tried to spy on him and Durai Singam by hiring a contract killer from Mumbai by making a bomb blast. Durai Singam manages to save Vidhya as well as himself and exposes Vittal&#39;s real face to the world and provide every evidence he collected from his Australian Head Office and arrest him while he tried to escape from Hyderabad Airport in Telengana State. Vittal tries to escape from Policemen, but Durai Singam stops him and fights with him in Talakona Forest and kills him there. Durai Singam successfully concludes and submits the case file to the home minister and returns to Tamil Nadu. Finally, Vidhya gets engaged with another person happily and Home Minister Ramanathan (Vijayakumar) calls Durai Singam once again as Kavya says &quot;Innoru mission aa?&quot; (Another Mission?). Which suggests that there will be a sequel to this film.</p>\r\n', '2017-02-09', 'https://www.youtube.com/watch?v=CP9DinMVFq8', 'CP9DinMVFq8', 30, '3', '3', 4, 0, 1),
(16, 4, 5, 'Baahubali 2: The Conclusion', NULL, 'Prabhas, Rana Daggubati, Anushka Shetty, Sathyaraj, Ramya Krishnan, Nassar, Tamannaah', '83394_baahubali-2-review-rating.jpg', '13060_711eHgGtnFL._SX522_.jpg', '<p>Yes, the movie cannot be skipped, as the first part and the twist question at the end ensure we all will flock to the theatres. So, I&#39;ll dwelve rather on what one expected from the movie and what one got.<br />\r\n<br />\r\nExp -Magnum opus with brilliant VFX Act - Brilliant VFX indeed with Kingdom, Dream sequences and war scenes portrayed effectively to border disbelief<br />\r\n<br />\r\nExp - Enhancing the character of Bahubali n son, Devsana, Bhallaldev, Sivagami and Kattappa with brilliant one- liners. Act - Characters watered down with very few one-liners to keep the audience hooked. Sivagami&#39;s fierceness gets lost, Kattappa&#39;s loyalty questioned, Bhallaldev&#39;s might becomes more brain than brawn and worst, even Bahubali ends up wasting his arm strength and skills<br />\r\n<br />\r\nExp- A nuanced script where politics and drama get overshadowed by pure heroics and camera following lead character all the time. Act- A muddled script reminiscent of good old Mahabharat serial of schemes and sub- schemes where Bahubali keeps losing without any retribution<br />\r\n<br />\r\nExp - Music which would create awe and timed beautifully to take the movie forward. Act - BGM remains good enough, but the songs didn&#39;t deliver, especially the romantic number between Devsana and Bahubali on which a good share of budget gets wasted<br />\r\n<br />\r\nExp - Last but not the least, an epic climax and final war, which would go on for an hour and where Sivadu finally manages to kill Bhallaldev against all odds Act - Kind of anti climax, which feels edited too much and put together fast enough to ensure reasonable running time and enough shows to hit Rs. 500 Crs collection in a week<br />\r\n<br />\r\nAll in all, somewhere the commercials seem to have overtaken the story, melodrama overshadowing an epic in making and VFX substituting genuine acting.<br />\r\n<br />\r\nIndependently, keeping aside the expectations, the film has been done well, with good BGM, main characters building up muscles, graphics team putting a lot of efforts and the costumes team doing well too. The love story between Bahubali and Devsana develops like a typical Bollywood potboiler with fake acting and a caricature wannabe boyfriend in the middle; finally blooming to a romance with a dream sequence in clouds on a flying ship. Anushka shetty as Devasena, to her credit delivers a wonderful performance as the young devasana with strong dialogues and attitude.<br />\r\n<br />\r\nHowever, as the &#39;Conclusion&#39; ends and a dialogue giving a hint of another sequel pours out, the excitement of crowd is nowhere to be seen. But for those times where you have open mouth stared and cheered for our hero when he nonchalantly massacred people, conquered animals and even challenged nature, &#39;Jai Mahishmati&#39;.</p>\r\n', '2017-04-28', 'https://www.youtube.com/watch?v=G62HrubdD6o', 'G62HrubdD6o', 36, '3', '5', 3, 1, 1),
(17, 4, 7, 'Duvvada Jagannadham', NULL, 'Allu Arjun, Pooja Hegde, Rao Ramesh, Tanikella Bharani, Murali Sharma, Subbaraju', '41676_59236474.jpg', '19335_rgxpyzifgbgbe.jpg', '<p>Duvvada Jagannadham or DJ is an Indian Telugu-language action comedy film written and directed by Harish Shankar and produced by Dil Raju under his banner Sri Venkateswara Creations. The film stars Allu Arjun and Pooja Hegde. Devi Sri Prasad composed the film&#39;s music while Ayananka Bose handled the cinematography. Principal photography commenced in August 2016 in Hyderabad.[1] Abu Dhabi[2] was also a filming location; the production crew chose Abu Dhabi, as they would benefit from the Emirate&#39;s 30% film production rebate.</p>\r\n', '2017-06-23', '', '', 117, '14', '3', 4, 1, 1),
(18, 4, 4, 'Kshanam', NULL, 'Adivi Sesh, Adah Sharma, Anasuya Bharadwaj, Vennela Kishore, Satyam Rajesh, Satyadev Kancharana', '81544_Kshanam-Remake--Bang-On-Target-1497953894-1911.jpg', '53626_kshanam-20160203170914-14871.jpg', '<p>Rishi, a San Fransisco-based investment banker gets a voice call from Shweta, his ex-lover. They studied medicine in the same college and wanted to marry, but her father arranged an alliance with an entrepreneur named Karthik. Rishi leaves for India with the pretense of attending a marriage in their relatives&#39; household. He takes a car for hire from Babu Khan, a travels agent. Rishi also takes a SIM card on his sister&#39;s address and stays at Hotel Marriott.</p>\r\n\r\n<p>Rishi meets Shweta at a restaurant and learns that her five-year old daughter Ria is missing. Things went worse when none except Shweta, including Karthik, believe that Ria actually exists. He also learns about Karthik&#39;s brother Bobby, a drug addict, who regularly visits her home. Rishi begins an informal investigation which fails many a times, also inviting the ire of two afro-american gangsters in the city. Babu Khan, who helps them in transporting drugs, saves Rishi on humanitarian grounds. Posing as Vasanth Khanna, a police officer, Rishi meets Karthik and learns that the couple was childless. Karthik recalls Shweta being attacked by two masked men before a school to steal her car. He added that Shweta went into coma and post recovery started telling that she had a five-year old daughter named Ria.</p>\r\n', '2016-02-26', 'https://www.youtube.com/watch?v=OroFSmQQm1U', 'OroFSmQQm1U', 134, '10', '4', 5, 1, 1),
(19, 9, 5, 'القادمة الرابعة بعد يوم', NULL, 'Donia Maher,Salma Al-Naggar,Ahmad Lutfi,Doaa Ereikat', '35364_coming-forth-by-day-2012-001-old-vs-new-architecture.jpg', '16704_MV5BMjI5OTY0ODY5Ml5BMl5BanBnXkFtZTcwMjQzMzI2OQ@@._V1_.jpg', '<p>أولئك الذين استمتعوا بالكامل بأجسادهم لا يمكن أن يكونوا خاضعين. وأولئك الذين ليس لديهم أبدا؟ هل يمكنهم الصمود في عبودية العزلة والقبول العاجز لما لا يمكنهم تغييره أو احتضانه؟ هذه هي قصة كل يوم لامرأتين تعتنين برجلهم المريض.</p>', '2013-11-14', '', '', 36, '1', '5', 4, 0, 1),
(20, 1, 3, 'Avengers Endgame', NULL, 'Robert Downey Jr.,Chris Evans,Mark Ruffalo,Chris Hemsworth,Scarlett Johansson,Jeremy Renner,Don Cheadle,Paul Rudd,Brie Larson,Karen Gillan,Danai Gurira,Bradley Cooper,Josh Brolin', '37351_09B_AEG_DomPayoff_1Sht_REV-7c16828.jpg', '66924_dHjLaIUHXcMBt7YxK1TKWK1end9.jpg', '<p>Twenty-three days after&nbsp;Thanos&nbsp;used the&nbsp;Infinity Gauntlet&nbsp;to disintegrate half of all life in the universe, Carol Danvers&nbsp;rescues&nbsp;Tony Stark&nbsp;and&nbsp;Nebula&nbsp;from deep space and returns them to Earth. They reunite with the remaining&nbsp;Avengers&mdash;Bruce Banner,&nbsp;Steve Rogers,&nbsp;Rocket,&nbsp;Thor,&nbsp;Natasha Romanoff, and&nbsp;James Rhodes&mdash;and find Thanos on an uninhabited planet. They plan to retake and use the&nbsp;Infinity Stones&nbsp;to reverse the disintegrations, but Thanos reveals he destroyed them to prevent further use. An enraged Thor decapitates Thanos.</p>\r\n\r\n<p>Five years later,&nbsp;Scott Lang&nbsp;escapes from the&nbsp;quantum realm. He travels to the Avengers&#39; compound, where he explains to Romanoff and Rogers that he experienced only five hours while trapped. Theorizing the quantum realm could allow&nbsp;time travel, the three ask Stark to help them retrieve the Stones from the past to reverse Thanos&#39; actions in the present, but Stark refuses to help. After talking with his wife,&nbsp;Pepper Potts, Stark relents and works with Banner, who has since merged his intelligence with the Hulk&#39;s strength and body, and the two successfully build a time machine. Banner warns that changing the past does not affect their present and any changes instead create branched&nbsp;alternate realities. He and Rocket go to the Asgardian refugees&#39; new home in&nbsp;Norway&nbsp;to recruit Thor, now an overweight alcoholic, despondent over his failure in stopping Thanos. In&nbsp;Tokyo, Romanoff recruits&nbsp;Clint Barton, now a ruthless vigilante following the disintegration of his family.</p>', '2019-04-26', '', '', 51, '2', '3', 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `email_from` varchar(255) NOT NULL,
  `onesignal_app_id` varchar(500) NOT NULL,
  `onesignal_rest_key` varchar(500) NOT NULL,
  `envato_buyer_name` varchar(200) NOT NULL,
  `envato_purchase_code` text NOT NULL,
  `envato_purchased_status` int(1) NOT NULL DEFAULT '0',
  `package_name` varchar(200) NOT NULL,
  `ios_bundle_identifier` varchar(200) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_contact` varchar(255) NOT NULL,
  `app_website` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `app_developed_by` varchar(255) NOT NULL,
  `app_privacy_policy` text NOT NULL,
  `api_genre_order_by` varchar(255) NOT NULL,
  `api_latest_limit` int(3) NOT NULL,
  `api_review_limit` int(3) NOT NULL,
  `api_search_limit` int(3) NOT NULL,
  `api_cat_order_by` varchar(255) NOT NULL,
  `api_cat_post_order_by` varchar(255) NOT NULL,
  `publisher_id` varchar(500) NOT NULL,
  `interstital_ad` varchar(500) NOT NULL,
  `interstital_ad_id` varchar(500) NOT NULL,
  `interstital_ad_click` varchar(500) NOT NULL,
  `banner_ad` varchar(500) NOT NULL,
  `banner_ad_id` varchar(500) NOT NULL,
  `publisher_id_ios` varchar(500) NOT NULL,
  `app_id_ios` varchar(500) NOT NULL,
  `interstital_ad_ios` varchar(500) NOT NULL,
  `interstital_ad_id_ios` varchar(500) NOT NULL,
  `interstital_ad_click_ios` varchar(500) NOT NULL,
  `banner_ad_ios` varchar(500) NOT NULL,
  `banner_ad_id_ios` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `email_from`, `onesignal_app_id`, `onesignal_rest_key`, `envato_buyer_name`, `envato_purchase_code`, `envato_purchased_status`, `package_name`, `ios_bundle_identifier`, `app_name`, `app_logo`, `app_email`, `app_version`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `api_genre_order_by`, `api_latest_limit`, `api_review_limit`, `api_search_limit`, `api_cat_order_by`, `api_cat_post_order_by`, `publisher_id`, `interstital_ad`, `interstital_ad_id`, `interstital_ad_click`, `banner_ad`, `banner_ad_id`, `publisher_id_ios`, `app_id_ios`, `interstital_ad_ios`, `interstital_ad_id_ios`, `interstital_ad_click_ios`, `banner_ad_ios`, `banner_ad_id_ios`) VALUES
(1, 'info@viaviweb.in', '5c2e22b8-ebc0-41b9-8866-3d44eb6f0242', 'YTMyNGJiMTMtZDY1YS00Nzc5LTg0MWMtODgzMTAxNTM4Mjk5', 'Nulled By CoderFlare.info', 'Nulled By CoderFlare.info', 1, 'com.example.moviereview', '', 'Movie Review App', 'icon.png', 'coderflare@yahoo.com', '1.0.0', 'CoderFlare', '+91 1234567891', 'www.coderflare.info', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'Viavi Webtech', '<p><strong>We are committed to protecting your privacy</strong></p>\n\n<p>We collect the minimum amount of information about you that is commensurate with providing you with a satisfactory service. This policy indicates the type of processes that may result in data being collected about you. Your use of this website gives us the right to collect that information.&nbsp;</p>\n\n<p><strong>Information Collected</strong></p>\n\n<p>We may collect any or all of the information that you give us depending on the type of transaction you enter into, including your name, address, telephone number, and email address, together with data about your use of the website. Other information that may be needed from time to time to process a request may also be collected as indicated on the website.</p>\n\n<p><strong>Information Use</strong></p>\n\n<p>We use the information collected primarily to process the task for which you visited the website. Data collected in the UK is held in accordance with the Data Protection Act. All reasonable precautions are taken to prevent unauthorised access to this information. This safeguard may require you to provide additional forms of identity should you wish to obtain information about your account details.</p>\n\n<p><strong>Cookies</strong></p>\n\n<p>Your Internet browser has the in-built facility for storing small files - &quot;cookies&quot; - that hold information which allows a website to recognise your account. Our website takes advantage of this facility to enhance your experience. You have the ability to prevent your computer from accepting cookies but, if you do, certain functionality on the website may be impaired.</p>\n\n<p><strong>Disclosing Information</strong></p>\n\n<p>We do not disclose any personal information obtained about you from this website to third parties unless you permit us to do so by ticking the relevant boxes in registration or competition forms. We may also use the information to keep in contact with you and inform you of developments associated with us. You will be given the opportunity to remove yourself from any mailing list or similar device. If at any time in the future we should wish to disclose information collected on this website to any third party, it would only be with your knowledge and consent.&nbsp;</p>\n\n<p>We may from time to time provide information of a general nature to third parties - for example, the number of individuals visiting our website or completing a registration form, but we will not use any information that could identify those individuals.&nbsp;</p>\n\n<p>In addition Dummy may work with third parties for the purpose of delivering targeted behavioural advertising to the Dummy website. Through the use of cookies, anonymous information about your use of our websites and other websites will be used to provide more relevant adverts about goods and services of interest to you. For more information on online behavioural advertising and about how to turn this feature off, please visit youronlinechoices.com/opt-out.</p>\n\n<p><strong>Changes to this Policy</strong></p>\n\n<p>Any changes to our Privacy Policy will be placed here and will supersede this version of our policy. We will take reasonable steps to draw your attention to any changes in our policy. However, to be on the safe side, we suggest that you read this document each time you use the website to ensure that it still meets with your approval.</p>\n\n<p><strong>Contacting Us</strong></p>\n\n<p>If you have any questions about our Privacy Policy, or if you want to know what information we have collected about you, please email us at hd@dummy.com. You can also correct any factual errors in that information or require us to remove your details form any list under our control.</p>\n', 'genre_name', 3, 3, 3, 'id', 'DESC', 'pub-3940256099942544', 'true', 'ca-app-pub-3940256099942544/1033173712', '5', 'true', 'ca-app-pub-3940256099942544/6300978111', 'pub-8356404931736973', 'ca-app-pub-8356404931736973~5938963872', 'true', 'ca-app-pub-8356404931736973/7100246157', '3', 'true', 'ca-app-pub-8356404931736973/9726409493');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(60) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `photo` text,
  `city` varchar(50) DEFAULT NULL,
  `address` text,
  `confirm_code` varchar(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 
--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_genres`
--
ALTER TABLE `tbl_genres`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `tbl_language`
--
ALTER TABLE `tbl_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_photo_gallery`
--
ALTER TABLE `tbl_photo_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_genres`
--
ALTER TABLE `tbl_genres`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_language`
--
ALTER TABLE `tbl_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_photo_gallery`
--
ALTER TABLE `tbl_photo_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
