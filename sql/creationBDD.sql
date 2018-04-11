#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: pi-ux-ce_web.`users`
#------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`(
        user_id  int (11) Auto_increment  NOT NULL ,
        name     Varchar (25) ,
        surname  Varchar (25) ,
        password Varchar (250) ,
        email    Varchar (250) ,
        status   Varchar (25) ,
        PRIMARY KEY (user_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: products
#------------------------------------------------------------
DROP TABLE IF EXISTS products;
CREATE TABLE products(
        product_id  int (11) Auto_increment  NOT NULL ,
        name        Varchar (250) ,
        description Varchar (25) ,
        price       Int ,
        url         Varchar (25) ,
        PRIMARY KEY (product_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: order
#------------------------------------------------------------
DROP TABLE IF EXISTS orders;
CREATE TABLE orders(
        order_id   int (11) Auto_increment  NOT NULL ,
        order_date Date ,
        paid       Bool ,
        user_id    Int ,
        PRIMARY KEY (order_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: events
#------------------------------------------------------------
DROP TABLE IF EXISTS events;
CREATE TABLE events(
        event_id    int (11) Auto_increment  NOT NULL ,
        event       Varchar (250) ,
        description Varchar (250) ,
        event_date  Date ,
        validation  Bool ,
        user_id     Int ,
        PRIMARY KEY (event_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: pictures
#------------------------------------------------------------
DROP TABLE IF EXISTS pictures;
CREATE TABLE pictures(
        picture_id int (11) Auto_increment  NOT NULL ,
        likes      Int ,
        url        Varchar (250) ,
        user_id    Int ,
        event_id   Int ,
        PRIMARY KEY (picture_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: category
#------------------------------------------------------------
DROP TABLE IF EXISTS category;
CREATE TABLE category(
        category_id int (11) Auto_increment  NOT NULL ,
        category    Varchar (25) ,
        PRIMARY KEY (category_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comments
#------------------------------------------------------------
DROP TABLE IF EXISTS comments;
CREATE TABLE comments(
        comment_id   int (11) Auto_increment  NOT NULL ,
        comments     Longtext ,
        comment_date Date ,
        picture_id   Int ,
        user_id      Int ,
        PRIMARY KEY (comment_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contain
#------------------------------------------------------------
DROP TABLE IF EXISTS contain;
CREATE TABLE contain(
        order_id   Int NOT NULL ,
        product_id Int NOT NULL ,
        PRIMARY KEY (order_id ,product_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: subscribe
#------------------------------------------------------------
DROP TABLE IF EXISTS suscribe;
CREATE TABLE subscribe(
        user_id  Int NOT NULL ,
        event_id Int NOT NULL ,
        PRIMARY KEY (user_id ,event_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vote
#------------------------------------------------------------
DROP TABLE IF EXISTS vote;
CREATE TABLE vote(
        user_id  Int NOT NULL ,
        event_id Int NOT NULL ,
        PRIMARY KEY (user_id ,event_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: have
#------------------------------------------------------------
DROP TABLE IF EXISTS have;
CREATE TABLE have(
        product_id  Int NOT NULL ,
        category_id Int NOT NULL ,
        PRIMARY KEY (product_id ,category_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: like
#------------------------------------------------------------
DROP TABLE IF EXISTS appreciate;
CREATE TABLE appreciate(
        user_id    Int NOT NULL ,
        picture_id Int NOT NULL ,
        PRIMARY KEY (user_id ,picture_id )
)ENGINE=InnoDB;

ALTER TABLE orders ADD CONSTRAINT FK_orders_user_id FOREIGN KEY (user_id) REFERENCES `users`(user_id);
ALTER TABLE events ADD CONSTRAINT FK_events_user_id FOREIGN KEY (user_id) REFERENCES `users`(user_id);
ALTER TABLE pictures ADD CONSTRAINT FK_pictures_user_id FOREIGN KEY (user_id) REFERENCES `users`(user_id);
ALTER TABLE pictures ADD CONSTRAINT FK_pictures_event_id FOREIGN KEY (event_id) REFERENCES events(event_id);
ALTER TABLE comments ADD CONSTRAINT FK_comments_picture_id FOREIGN KEY (picture_id) REFERENCES pictures(picture_id);
ALTER TABLE comments ADD CONSTRAINT FK_comments_user_id FOREIGN KEY (user_id) REFERENCES `users`(user_id);
ALTER TABLE contain ADD CONSTRAINT FK_contain_order_id FOREIGN KEY (order_id) REFERENCES orders(order_id);
ALTER TABLE contain ADD CONSTRAINT FK_contain_product_id FOREIGN KEY (product_id) REFERENCES products(product_id);
ALTER TABLE subscribe ADD CONSTRAINT FK_subscribe_user_id FOREIGN KEY (user_id) REFERENCES `users`(user_id);
ALTER TABLE subscribe ADD CONSTRAINT FK_subscribe_event_id FOREIGN KEY (event_id) REFERENCES events(event_id);
ALTER TABLE vote ADD CONSTRAINT FK_vote_user_id FOREIGN KEY (user_id) REFERENCES `users`(user_id);
ALTER TABLE vote ADD CONSTRAINT FK_vote_event_id FOREIGN KEY (event_id) REFERENCES events(event_id);
ALTER TABLE have ADD CONSTRAINT FK_have_product_id FOREIGN KEY (product_id) REFERENCES products(product_id);
ALTER TABLE have ADD CONSTRAINT FK_have_category_id FOREIGN KEY (category_id) REFERENCES category(category_id);
ALTER TABLE appreciate ADD CONSTRAINT FK_appreciate_user_id FOREIGN KEY (user_id) REFERENCES `users`(user_id);
ALTER TABLE appreciate ADD CONSTRAINT FK_appreciate_picture_id FOREIGN KEY (picture_id) REFERENCES pictures(picture_id);

