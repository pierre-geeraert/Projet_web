DROP  PROCEDURE IF EXISTS add_event;
DELIMITER |

CREATE PROCEDURE add_event(IN event_in VARCHAR(250), IN description_in VARCHAR(250), IN event_date_in DATE)
BEGIN

INSERT INTO `events`(`event`, description, event_date, validation)
VALUES (event_in, description_in, event_date_in, 1);

select event_id as event_id_out from events where event=event_in and description=description_in and event_date=event_date_in;


END |