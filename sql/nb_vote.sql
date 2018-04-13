DELIMITER |

CREATE PROCEDURE nb_vote(IN event_id_in INT)      
BEGIN

SELECT COUNT(*)
FROM vote
WHERE event_id = event_id_in;

END |