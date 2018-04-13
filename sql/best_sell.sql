
DROP  PROCEDURE IF EXISTS best_sell;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE best_sell()

BEGIN
  select name from products order by number_of_sales desc limit 3;
END |
DELIMITER ;  -- On remet le délimiteur par défaut
