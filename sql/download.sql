
DROP  PROCEDURE IF EXISTS download;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE download()  
    
BEGIN
    select url from pictures;
END |
DELIMITER ;  -- On remet le délimiteur par défaut
