DELIMITER |

CREATE PROCEDURE add_event(IN user_id_in INT, IN picture_id_in INT)      
BEGIN

INSERT INTO appreciate(user_id, picture_id)
VALUES(user_id_in, picture_id_in);

END |