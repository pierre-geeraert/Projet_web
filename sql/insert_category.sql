
DROP  PROCEDURE IF EXISTS add_category;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE add_category(IN category_in VARCHAR(200))  
    
BEGIN
    INSERT INTO `category`(category)
VALUES
(category_in);
END |
DELIMITER ;  -- On remet le délimiteur par défaut
