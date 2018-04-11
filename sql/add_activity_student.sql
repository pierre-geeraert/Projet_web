
DROP  PROCEDURE IF EXISTS suggest;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE suggest(IN event_in VARCHAR(200),IN description_in VARCHAR(200),IN user_id_in VARCHAR(200))  
    
BEGIN
    INSERT INTO `events`(event, description,event_date,validation,user_id)
VALUES
(event_in,description_in,NULL,FALSE,user_id_in);
END |
DELIMITER ;  -- On remet le délimiteur par défaut
