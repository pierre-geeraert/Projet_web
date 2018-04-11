
DROP  PROCEDURE IF EXISTS delete_comment;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE delete_comment(IN comment_id_in VARCHAR(200))  
    
BEGIN
    delete from `comments` where comment_id=comment_id_in;
END |
DELIMITER ;  -- On remet le délimiteur par défaut
