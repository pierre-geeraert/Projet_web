
DROP  PROCEDURE IF EXISTS verification_event;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE verification_event(IN event_id_in int(10),IN user_id_in int(10))  
    
BEGIN
     select count(*) from subscribe where user_id=user_id_in and event_id=event_id_in;
END |
DELIMITER ;  -- On remet le délimiteur par défaut


