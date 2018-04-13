-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-pi-ux-ce.alwaysdata.net
-- Generation Time: Apr 13, 2018 at 10:28 AM
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

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `add_event` (IN `event_in` VARCHAR(250), IN `descrition_in` VARCHAR(250), IN `event_date_in` DATE, IN `user_id_in` INT)  BEGIN

INSERT INTO `events`(`event`, description, event_date, validation, user_id)
VALUES (event_in, descrition_in, event_date_in, TRUE, user_id_in);

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `add_picture` (IN `url_in` VARCHAR(200), IN `user_id_in` INT(10), IN `event_id_in` VARCHAR(200))  BEGIN
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
  select name from products order by number_of_sales desc limit 3;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `comment` (IN `comment_in` VARCHAR(1000), IN `comment_date_in` DATE, IN `picture_id_in` INT, `user_id_in` INT)  BEGIN


INSERT INTO comments (comments, comment_date, picture_id, user_id)
VALUES (comment_in, comment_date_in, picture_id_in, user_id_in);



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
  SELECT event, description,event_id FROM events WHERE DATEDIFF( event_date, NOW() ) > 0;


END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `event_past` ()  BEGIN
  SELECT event, description,event_id FROM events WHERE DATEDIFF( event_date, NOW() ) < 0;


END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `like` (IN `user_id_in` INT, IN `picture_id_in` INT)  BEGIN

INSERT INTO appreciate(user_id, picture_id)
VALUES(user_id_in, picture_id_in);

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `nb_vote` (IN `event_id_in` INT)  BEGIN

SELECT COUNT(*)
FROM vote
WHERE event_id = event_id_in;

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `order_category` ()  BEGIN
     select products.name,  category.category from have,products,category where have.product_id=products.product_id and have.category_id=category.category_id order by category;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `register` (IN `name_in` VARCHAR(200), IN `surname_in` VARCHAR(200), IN `email_in` VARCHAR(200), IN `password_in` VARCHAR(200), IN `status_in` VARCHAR(200))  BEGIN
    INSERT INTO `users`(name,surname,email,password,status)
VALUES
(name_in,surname_in,email_in,password_in,status_in);
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `registered_list` (IN `event_id_in` INT)  BEGIN

SELECT users.name, users.surname
FROM users, subscribe
WHERE subscribe.user_id = users.user_id AND event_id = event_id_in;


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
     select count(*) from subscribe where user_id=user_id_in and event_id=event_id_in;
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
(7, 'Tournoi de foot', 'Tournoi de foot à Beaurain, Maximum 16 équipes de 5 personnes. Pour les inscritions se référer à un membre du BDS', '2018-05-24', 1, 27, NULL),
(8, 'Soirée à L\'Annexe', 'Exia party vous invite à une soirée qui se déroulera à L\'Annexe. Réduction sur la plupart des boissons', '2018-04-26', 1, 26, NULL),
(9, 'Paintball', 'Painball au multi-games venez nombreux!', '2017-10-18', 0, 34, NULL),
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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(7, 'foot.png', 27, 7),
(8, 'Painball.jpg', 34, 9),
(9, 'Soiree.jpg', 26, 8),
(10, 'conference.jpg', 35, 10);

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
(23, 'Ramon', 'Sébastien', 'BrCenter0', 'SRamon@cesi.fr', 'Tuteur'),
(24, 'Geeraert', 'Pierre', 'leplusBO62', 'pierre.geeraert@viacesi.fr', 'BDE'),
(25, 'test', 'test', 'test', 'test.test@viacesi.fr', 'BDE'),
(26, 'Naessens', 'Valentin', 'leplusBO59', 'valentin.naessens@viacesi.fr', 'BDE'),
(27, 'Podevin', 'Jean-Clément', 'valentinleBB12', 'jeanclement@viacesi.fr', 'BDE'),
(28, 'Hoyez', 'Alexis', 'M0tdepasse62', 'alexis.hoyez@viacesi.fr', 'BDE'),
(29, 'Brunelot', 'Romain', 'Tuteur62', 'RBrunelot@cesi.fr', 'Tuteur'),
(30, 'd', 'd', 'n', 'dd', 'BDE'),
(31, 'ff', 'ff', 'fff', 'ff', 'BDE'),
(32, 'd', 'd', 'ddd', 'd', 'BDE'),
(33, 'gg', 'gg', 'hhh', 'gg', 'BDE'),
(34, 'Alexis', 'Caron', 'Jesaispas62', 'alexis.caron@viacesi.fr', 'Etudiant'),
(35, 'Descamp', 'Anthony', 'PoissonLune62', 'anthony.descamp', 'Etudiant'),
(36, 'rr', 'rr', 'gg', 'rr', 'BDE'),
(37, 'fff', 'ff', 'ffff', 'f', 'BDE'),
(38, 'qqqqq', 'qq', 'fffff', 'qq', 'BDE'),
(39, 'ss', 's', 'jjjj', 'ss', 'BDE'),
(40, 'ss', 'seee', 'rrrr', 'sszzzzz', 'BDE'),
(41, 'qqq', 'qqqq', 'ccccc', 'qqqqqq', 'BDE'),
(42, 'qqqq', 'zzzzzzz', 'kkkk', 'zzzz', 'BDE'),
(43, 'Klein', 'Aurélien', 'jjj', 'aurelien@viacesi.ed', 'BDE'),
(44, 'Kleinn', 'Aurélienkk', 'mmmmmm', 'aurelien@vi,acesi.ed', 'BDE'),
(45, 'ksdks', 'plz', 'jQ78888888', 'jj', 'BDE');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
  ADD CONSTRAINT `FK_have_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `FK_have_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

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
