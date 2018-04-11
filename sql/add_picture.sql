
DROP  PROCEDURE IF EXISTS add_picture;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE add_picture(IN url_in VARCHAR(200),IN user_id_in int(10),IN event_id_in VARCHAR(200))  
    
BEGIN
    INSERT INTO `pictures`(url, user_id,event_id)
VALUES
(url_in,user_id_in,event_id_in);
END |
DELIMITER ;  -- On remet le délimiteur par défaut
