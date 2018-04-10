
DROP  PROCEDURE IF EXISTS register;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE register(IN name VARCHAR(200),IN surname VARCHAR(200),IN email VARCHAR(200),IN password VARCHAR(200),IN status VARCHAR(200))  
    
BEGIN
    INSERT INTO `users`(name,surname,email,password,status)
VALUES
(name,surname,email,password,status);
END |
DELIMITER ;  -- On remet le délimiteur par défaut
