DELIMITER |

CREATE PROCEDURE add_event(IN event_in VARCHAR(250), IN descrition_in VARCHAR(250), IN event_date_in DATE)      
BEGIN

INSERT INTO `events`(`event`, descrition, event_date, validation)
VALUES (event_in, descrition_in, event_date_in, 1);


END |