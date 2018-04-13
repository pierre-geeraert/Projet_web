DELIMITER |

CREATE PROCEDURE subscribe_event(IN user_id_in INT, IN event_id_in INT)

BEGIN

INSERT INTO subscribe (user_id, event_id)
VALUES(user_id_in, event_id_in);

END |