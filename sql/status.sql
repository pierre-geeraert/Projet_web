
DROP  PROCEDURE IF EXISTS status;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE status(in user_id_in INT(10))  
    
BEGIN
    select status from users where user_id=user_id_in;
END |
DELIMITER ;  -- On remet le délimiteur par défaut

