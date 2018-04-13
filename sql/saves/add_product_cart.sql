
DROP  PROCEDURE IF EXISTS add_product_cart;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE add_product_cart(IN `product_id_in` INT(10), IN `order_id_in` INT(10))

BEGIN
  INSERT INTO `contain`(order_id, product_id)
VALUES
(order_id_in,product_id_in);


END |
DELIMITER ;  -- On remet le délimiteur par défaut

