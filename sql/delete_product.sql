DELIMITER |

CREATE PROCEDURE delete_product(IN product_id_in INT)      
BEGIN

DELETE FROM have
WHERE product_id = product_id_in;

DELETE FROM products
WHERE product_id = product_id_in;

END |