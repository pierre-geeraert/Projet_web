
DROP  PROCEDURE IF EXISTS validation_event;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE validation_event(IN event_id_in int(10),IN validator_id_in int(10),IN event_date_in date)  
    
BEGIN
     update events set event_date=event_date_in, validation=1, validator_id=validator_id_in where event_id=event_id_in;
END |
DELIMITER ;  -- On remet le délimiteur par défaut



