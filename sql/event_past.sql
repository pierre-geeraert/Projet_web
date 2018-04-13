
DROP  PROCEDURE IF EXISTS event_past;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE event_past()

BEGIN
  SELECT event, description,event_id FROM events WHERE DATEDIFF( event_date, NOW() ) < 0;


END |
DELIMITER ;  -- On remet le délimiteur par défaut

