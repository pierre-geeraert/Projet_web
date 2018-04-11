
DROP  PROCEDURE IF EXISTS order_category;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE order_category()  
    
BEGIN
     select products.name,  category.category from have,products,category where have.product_id=products.product_id and have.category_id=category.category_id order by category;
END |
DELIMITER ;  -- On remet le délimiteur par défaut





