DELIMITER | 
CREATE PROCEDURE cart_validation(IN user_id_in INT)  
    
BEGIN

UPDATE products
SET number_of_sales = number_of_sales +1
WHERE produt_id IN (
    SELECT product_id
    FROM contain
    WHERE order_id =(
        SELECT order_id
        FROM orders
        WHERE user_id = user_id_in
        ORDER BY order_id DESC
        LIMIT 1
    )
);


END |
DELIMITER ;