-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-pi-ux-ce.alwaysdata.net
-- Generation Time: Apr 11, 2018 at 06:33 PM
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

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `Delete_Pic` (IN `picture_id_in` INT)  BEGIN
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

DELETE FROM products
WHERE product_id = product_id_in;

END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `download` ()  BEGIN
    select url from pictures;
END$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `inscription` (IN `nom` VARCHAR(200), IN `Prenom` VARCHAR(200), IN `Email` VARCHAR(200), IN `Mdp` VARCHAR(200), IN `Statut` VARCHAR(200))  BEGIN
    INSERT INTO utilisateurs(nom,Prenom,Email,Mdp,Statut)
VALUES
(nom,Prenom,Email,Mdp,Statut);
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

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `suggest` (IN `event_in` VARCHAR(200), IN `description_in` VARCHAR(200), IN `user_id_in` VARCHAR(200))  BEGIN
    INSERT INTO `events`(event, description,event_date,validation,user_id)
VALUES
(event_in,description_in,NULL,FALSE,user_id_in);
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

--
-- Dumping data for table `appreciate`
--

INSERT INTO `appreciate` (`user_id`, `picture_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1);

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
(1, 'Informatique'),
(2, 'Vetements'),
(3, 'Cuisine'),
(4, 'consommable');

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
(2, 'good', '2018-04-05', 1, 3),
(3, 'interessant', '2018-04-06', 1, 4),
(4, 'rigolo', '2018-04-10', 2, 4),
(7, 'wesh la famille', '2018-04-11', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contain`
--

CREATE TABLE `contain` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contain`
--

INSERT INTO `contain` (`order_id`, `product_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 3);

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
(1, 'foot', 'L\'association de sport voudrai organiser un tournoie de foot au stade de Beaurain', NULL, 0, 3, NULL),
(2, 'hotdog', 'Exiamiam voudrait vous proposer des hot dog le midi du 04/04/2018', '2018-04-04', 0, 2, NULL),
(3, 'don de sang', 'Nous vous invitons à participer au don du sang organiser par l\'exia le 08/04/2018', '2018-04-08', 0, 4, NULL),
(6, 'foot', 'petit foot', '2018-04-11', 1, 1, 1);

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
(1, 1),
(2, 1),
(3, 3),
(4, 2),
(15, 1);

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
(1, '2018-04-11', 0, 1),
(2, '2018-04-09', 0, 3),
(3, '2018-04-11', 0, 1);

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
(1, 'images/event/hotdog1.png', 2, 2),
(2, 'images/event/hotdog2.png', 2, 2),
(4, '/images', NULL, NULL),
(5, '/images', NULL, NULL),
(6, '/images/pictur.PGP/', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `url` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `url`) VALUES
(1, 'souris', NULL, 10, 'Images/souris.png'),
(2, 'tapis de souris', NULL, 5, 'Images/tapisSouris.png'),
(3, 'mug', NULL, 5, 'Images/mug.png'),
(4, 'T-shirt', NULL, 10, 'Images/tShirt.png'),
(15, 'clavier', 'mécanique', 100, 'jesais pas');

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
(2, 1),
(2, 2),
(3, 1),
(4, 2),
(4, 3);

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
(1, 'brunelot', 'romain', 'K666', 'rbrunelot@cesi.fr', 'tuteur'),
(2, 'lecomte', 'alexandre', 'PowerEdge1', 'alexandre.lecomte@viacesi.fr', 'eleve'),
(3, 'exiamiam', 'president', 'Exiamiam2', 'exiamiam@viacesi.fr', 'eleve'),
(4, 'prussel', 'loic', 'Prussel0', 'lprussel@cesi.fr', 'tuteur'),
(5, 'test', 'test', 'A1e', 'test@cesi.fr', 'tuteur'),
(6, 'na', 'val', 'A1e', 'val@cesi.fr', 'bde');

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
(1, 3),
(2, 2),
(3, 3);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
