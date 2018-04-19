DELIMITER$$

CREATE DEFINER=`pi-ux-ce_web`@`%` PROCEDURE `add_product_cart` (IN `product_id_in` INT(10), IN `user_id_in` INT(10))  BEGIN

INSERT INTO `contain`(order_id, product_id)
VALUES
((
SELECT order_id
FROM orders
WHERE user_id = user_id_in AND paid = 0),product_id_in);
END$$