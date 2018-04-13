DROP  PROCEDURE IF EXISTS `like`;
DELIMITER  |

CREATE PROCEDURE `like`(IN user_id_in INT, IN picture_id_in INT)
BEGIN
    INSERT INTO appreciate(user_id, picture_id)
      VALUES(user_id_in, picture_id_in);

END |
DELIMITER ;  -- On remet le délimiteur par défaut

