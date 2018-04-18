-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-pi-ux-ce.alwaysdata.net
-- Generation Time: Apr 17, 2018 at 05:39 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pi-ux-ce_web`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `add_category` (IN `category_in` VARCHAR(200))  BEGIN
    INSERT INTO `category`(category)
VALUES
(category_in);
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `add_event` (IN `event_in` VARCHAR(250), IN `descrition_in` VARCHAR(250), IN `user_id_in` INT(11), IN `date_in` DATE)  NO SQL
BEGIN

INSERT INTO `events`(`event`, description, user_id, validation, event_date)
VALUES (event_in, descrition_in,user_id_in, "1", date_in);

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `add_idea` (IN `event_in` VARCHAR(250), IN `descrition_in` VARCHAR(250), IN `user_id_in` INT(11))  BEGIN

INSERT INTO `events`(`event`, description,user_id,validation)
VALUES (event_in, descrition_in,user_id_in, "0");

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `add_picture` (IN `url_in` VARCHAR(200), IN `user_id_in` INT(11), IN `event_id_in` VARCHAR(200))  BEGIN
    INSERT INTO `pictures`(url, user_id,event_id)
VALUES
(url_in,user_id_in,event_id_in);
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `add_product` (IN `name_in` VARCHAR(250), IN `description_in` VARCHAR(250), IN `price_in` INT, IN `url_in` VARCHAR(250), IN `category_in` VARCHAR(250))  BEGIN

INSERT INTO products (name, description, price, url)
VALUES (name_in,description_in,price_in,url_in);

INSERT INTO have(product_id, category_id)
VALUES (
    (
   
        SELECT product_id
        FROM products
        WHERE name = name_in
    
    ),
    (
        SELECT category_id
        FROM category
        WHERE `category` = category_in
    )

);


END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `add_product_cart` (IN `product_id_in` INT(10), IN `order_id_in` INT(10))  BEGIN
  INSERT INTO `contain`(order_id, product_id)
VALUES
(order_id_in,product_id_in);


END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `best_sell` ()  BEGIN
  select * from products order by number_of_sales desc limit 3;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `comment` (IN `comment_in` TEXT, IN `picture_id_in` INT, IN `user_id_in` INT)  BEGIN
    INSERT INTO comments (comments, comment_date, picture_id, user_id)
VALUES (comment_in, NOW(), picture_id_in, user_id_in);

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `connection` (IN `email_in` VARCHAR(200), IN `password_in` VARCHAR(200))  BEGIN
    select email, password from users where users.email=email_in and password=password_in limit 1;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `delete_comment` (IN `comment_id_in` VARCHAR(200))  BEGIN
    delete from `comments` where comment_id=comment_id_in;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `delete_pic` (IN `picture_id_in` INT)  BEGIN
DELETE FROM comments
WHERE comments.picture_id = picture_id_in;
DELETE FROM appreciate
WHERE appreciate.picture_id = picture_id_in;
DELETE FROM pictures
WHERE pictures.picture_id = picture_id_in;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `delete_product` (IN `product_id_in` INT)  BEGIN

DELETE FROM have
WHERE product_id = product_id_in;

DELETE FROM contain
WHERE product_id = product_id_in;

DELETE FROM products
WHERE product_id = product_id_in;

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `download` ()  BEGIN
    select url from pictures;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `event_futur` ()  BEGIN
  SELECT event, description,event_id FROM events WHERE DATEDIFF( event_date, NOW() ) > 0 AND validation=1;


END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `event_past` ()  BEGIN
  SELECT event, description,event_id FROM events WHERE DATEDIFF( event_date, NOW() ) < 0 AND validation=1;


END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `like` (IN `user_id_in` INT, IN `picture_id_in` INT)  BEGIN
    INSERT INTO appreciate(user_id, picture_id)
      VALUES(user_id_in, picture_id_in);

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `nb_like` (IN `pictures_id_in` INT)  BEGIN

SELECT COUNT(*) as nbr_like
FROM appreciate
WHERE picture_id = pictures_id_in;

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `nb_vote` (IN `event_id_in` INT)  BEGIN

SELECT COUNT(*) as nbr_vote
FROM vote
WHERE event_id = event_id_in;

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `notification` (IN `user_id_in` INT)  BEGIN

SELECT date, description, user_sent_id
FROM notification
WHERE user_notif_id = user_id_in;

SELECT name, surname
FROM users
WHERE user_id = (
    SELECT user_sent_id
    FROM notification
    WHERE user_notif_id = user_id_in
);

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `notif_insert_cart` (IN `user_notif_id_in` INT, IN `user_sent_id_in` INT, IN `date_in` DATE, IN `description_in` TEXT)  BEGIN

INSERT INTO notification(user_notif_id, user_sent_id, date, type, order_id,description)
VALUES (user_notif_id_in, user_sent_id_in, date_in, '1', order_id_in, description_in);

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `notif_insert_nocif` (IN `user_sent_id_in` INT(11), IN `picture_id_in` INT(11))  BEGIN

INSERT INTO notification(user_notif_id, user_sent_id, date, type, picture_id)
VALUES ('28', user_sent_id_in, NOW(), '0', picture_id_in);

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `order_category` ()  BEGIN
     select products.name,  category.category from have,products,category where have.product_id=products.product_id and have.category_id=category.category_id order by category;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `participants_list` (IN `event_id_in` INT)  BEGIN

SELECT users.name, users.surname
FROM users, subscribe
WHERE subscribe.user_id = users.user_id AND event_id = event_id_in;


END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `post_notif` ()  BEGIN

SELECT user_id
FROM users
WHERE status = 'BDE';

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `register` (IN `name_in` VARCHAR(200), IN `surname_in` VARCHAR(200), IN `email_in` VARCHAR(200), IN `password_in` VARCHAR(200), IN `status_in` VARCHAR(200))  BEGIN
    INSERT INTO `users`(name,surname,email,password,status)
VALUES
(name_in,surname_in,email_in,password_in,status_in);
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `show_contain` (IN `user_id_in` INT)  BEGIN



CREATE OR REPLACE VIEW produit_panier
AS
SELECT name, description, price, url, order_id, products.product_id
FROM products
INNER JOIN contain ON products.product_id = contain.product_id;

SELECT name, description, price, url
FROM produit_panier
WHERE order_id = (
        SELECT order_id
        FROM orders
        WHERE user_id = user_id_in	
        ORDER BY order_id DESC
        LIMIT 1    
    );


END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `show_event` (IN `event_id_in` INT)  BEGIN

SELECT `event`,`description`,`event_date`
FROM `events`
WHERE `event_id`= event_id_in;


END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `subscribe_event` (IN `user_id_in` INT, IN `event_id_in` INT)  BEGIN

INSERT INTO subscribe (user_id, event_id)
VALUES(user_id_in, event_id_in);

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `suggest` (IN `event_in` VARCHAR(200), IN `description_in` VARCHAR(200), IN `user_id_in` VARCHAR(200))  BEGIN
    INSERT INTO `events`(`event`, description,event_date,validation,user_id)
VALUES
(event_in,description_in,NULL,FALSE,user_id_in);
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `test_email` (IN `email_in` VARCHAR(200))  BEGIN
    select * from users where email=email_in;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `validation_event` (IN `event_id_in` INT(10), IN `validator_id_in` INT(10), IN `event_date_in` DATE)  BEGIN
     update events set event_date=event_date_in, validation=1, validator_id=validator_id_in where event_id=event_id_in;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `verification_event` (IN `event_id_in` INT(10), IN `user_id_in` INT(10))  BEGIN
     select count(*) as bool_present from subscribe where user_id=user_id_in and event_id=event_id_in;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `vote` (IN `user_id_in` INT, IN `event_id_in` INT)  BEGIN

INSERT INTO vote (user_id, event_id)
VALUES (user_id_in,event_id_in);

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `appreciate`
--

CREATE TABLE `appreciate` (
  `user_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appreciate`
--

INSERT INTO `appreciate` (`user_id`, `picture_id`) VALUES
(1, 8),
(1, 23),
(28, 8),
(28, 11),
(28, 12),
(28, 23),
(29, 11);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(5, 'informatique'),
(6, 'goodies'),
(7, 'vêtements');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comments` longtext,
  `comment_date` date DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comments`, `comment_date`, `picture_id`, `user_id`) VALUES
(11, 'Commentaire 1', '2018-04-16', 8, 28),
(12, 'Commentaire 2', '2018-04-16', 8, 28),
(14, 'Commentaire 2eme photo', '2018-04-16', 11, 28),
(16, 'first', '2018-04-16', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contain`
--

CREATE TABLE `contain` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `validation` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `validator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event`, `description`, `event_date`, `validation`, `user_id`, `validator_id`) VALUES
(7, 'Tournoi de foot', 'Tournoi de foot à Beaurain, Maximum 16 équipes de 5 personnes. Pour les inscritions, cliquer ci-dessous :', '2018-05-24', 1, 27, NULL),
(8, 'Soirée à L\'Annexe', 'Exia party vous invite à une soirée qui se déroulera à L\'Annexe. Réduction sur la plupart des boissons', '2018-04-26', 1, 26, NULL),
(9, 'Paintball', 'Painball au multi-games venez nombreux!', NULL, 0, 34, NULL),
(10, 'Conférence aquariophilie', 'Conférence passion sur l\'aquariophilie présenter par Anthony!', '2017-02-11', 1, 35, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `have`
--

CREATE TABLE `have` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `have`
--

INSERT INTO `have` (`product_id`, `category_id`) VALUES
(16, 5),
(17, 5),
(18, 6),
(19, 7),
(20, 7),
(21, 6);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `user_notif_id` int(11) NOT NULL,
  `user_sent_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` tinyint(1) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `user_notif_id`, `user_sent_id`, `date`, `type`, `order_id`, `picture_id`, `description`) VALUES
(4, 43, 23, '2018-04-13', 1, 5, NULL, ''),
(15, 28, 23, '2018-04-17', 0, NULL, 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `paid`, `user_id`) VALUES
(4, '2018-04-18', 1, 28),
(5, '2018-04-03', 0, 23),
(8, '2018-04-17', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `picture_id` int(11) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`picture_id`, `url`, `user_id`, `event_id`) VALUES
(7, 'Images/Evenements/foot.png', 27, 7),
(8, 'Images/Evenements/Paintball.jpg', 34, 9),
(9, 'Images/Evenements/Soiree.jpg', 26, 8),
(10, 'Images/Evenements/conference.jpg', 35, 10),
(11, 'Images/Evenements/1.jpg', 34, 9),
(12, 'Images/Evenements/2.jpg', 34, 9),
(23, 'image/photos/5d578fc81c460f36796fac6920d51866.jpg', 24, 9),
(44, 'image/photos/d88d6722ba07bf06e3ae4df84be7bd42.png', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `url` varchar(25) DEFAULT NULL,
  `number_of_sales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `url`, `number_of_sales`) VALUES
(16, 'souris', 'souris haute performance,', 50, 'souris.png', 12),
(17, 'clavier', 'clavier mécanique avec 2 ', 50, 'clavier.png', 13),
(18, 'stylo', 'stylo plume au couleur de', 10, 'stylo.png', 0),
(19, 'tee-shirt', 'tee-shirt 100% coton avec', 15, 'tee-shirt.png', 0),
(20, 'veste', 'veste avec logo de l\'EXIA', 30, 'veste.png', 0),
(21, 'balle anti-stress', 'balle anti-stress idéal p', 2, 'balle_anti_stress.png', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `produit_panier`
-- (See below for the actual view)
--
CREATE TABLE `produit_panier` (
`name` varchar(250)
,`description` varchar(25)
,`price` int(11)
,`url` varchar(25)
,`order_id` int(11)
,`product_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`user_id`, `event_id`) VALUES
(1, 7),
(1, 8),
(28, 10),
(47, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `surname` varchar(25) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `password`, `email`, `status`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'BDE'),
(23, 'Ramon', 'Sébastien', 'BrCenter0', 'SRamon@cesi.fr', 'Tuteur'),
(24, 'Geeraert', 'Pierre', 'leplusBO62', 'pierre.geeraert@viacesi.fr', 'BDE'),
(25, 'test', 'test', 'test', 'test.test@viacesi.fr', 'BDE'),
(26, 'Naessens', 'Valentin', 'leplusBO59', 'valentin.naessens@viacesi.fr', 'BDE'),
(27, 'Podevin', 'Jean-Clément', 'valentinleBB12', 'jeanclement@viacesi.fr', 'BDE'),
(28, 'Hoyez', 'Alexis', 'M0tdepasse62', 'alexis.hoyez@viacesi.fr', 'BDE'),
(29, 'Brunelot', 'Romain', 'Tuteur62', 'RBrunelot@cesi.fr', 'Tuteur'),
(34, 'Alexis', 'Caron', 'Jesaispas62', 'alexis.caron@viacesi.fr', 'Etudiant'),
(35, 'Descamp', 'Anthony', 'PoissonLune62', 'anthony.descamp', 'Etudiant'),
(43, 'Klein', 'Aurélien', 'jjj', 'aurelien@viacesi.ed', 'BDE'),
(47, 'jean', 'podevin', '1Aaaaaaa', 'clement', 'BDE');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`user_id`, `event_id`) VALUES
(28, 9);

-- --------------------------------------------------------

--
-- Structure for view `produit_panier`
--
DROP TABLE IF EXISTS `produit_panier`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pi-ux-ce_web`@`%` SQL SECURITY DEFINER VIEW `produit_panier`  AS  select `products`.`name` AS `name`,`products`.`description` AS `description`,`products`.`price` AS `price`,`products`.`url` AS `url`,`contain`.`order_id` AS `order_id`,`products`.`product_id` AS `product_id` from (`products` join `contain` on((`products`.`product_id` = `contain`.`product_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appreciate`
--
ALTER TABLE `appreciate`
  ADD PRIMARY KEY (`user_id`,`picture_id`),
  ADD KEY `FK_appreciate_picture_id` (`picture_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `FK_comments_picture_id` (`picture_id`),
  ADD KEY `FK_comments_user_id` (`user_id`);

--
-- Indexes for table `contain`
--
ALTER TABLE `contain`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `FK_contain_product_id` (`product_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `FK_events_user_id` (`user_id`);

--
-- Indexes for table `have`
--
ALTER TABLE `have`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `FK_have_category_id` (`category_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `picture_id` (`picture_id`),
  ADD KEY `user_id_send` (`user_sent_id`),
  ADD KEY `user_notif_id` (`user_notif_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_orders_user_id` (`user_id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`picture_id`),
  ADD KEY `FK_pictures_user_id` (`user_id`),
  ADD KEY `FK_pictures_event_id` (`event_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`user_id`,`event_id`),
  ADD KEY `FK_subscribe_event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`user_id`,`event_id`),
  ADD KEY `FK_vote_event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appreciate`
--
ALTER TABLE `appreciate`
  ADD CONSTRAINT `FK_appreciate_picture_id` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`picture_id`),
  ADD CONSTRAINT `FK_appreciate_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comments_picture_id` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`picture_id`),
  ADD CONSTRAINT `FK_comments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `contain`
--
ALTER TABLE `contain`
  ADD CONSTRAINT `FK_contain_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `FK_contain_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_events_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `have`
--
ALTER TABLE `have`
  ADD CONSTRAINT `FK_have_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_have_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`picture_id`),
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`user_sent_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`user_notif_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `FK_pictures_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `FK_pictures_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD CONSTRAINT `FK_subscribe_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `FK_subscribe_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_vote_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `FK_vote_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
