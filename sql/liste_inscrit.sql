DROP  PROCEDURE IF EXISTS registered_list;
DELIMITER |

CREATE PROCEDURE registered_list(IN event_id_in INT)      
BEGIN

SELECT name, surname
FROM users, subscribe
WHERE event_id = event_id_in AND subscribe.user_id = users.user_id;


END |