DROP  PROCEDURE IF EXISTS `comment`;
DELIMITER  |

CREATE PROCEDURE `comment`(IN comment_in INT, IN picture_id_in INT, IN user_id_in INT)
BEGIN
    INSERT INTO comments (comments, comment_date, picture_id, user_id)
VALUES (comment_in, NOW(), picture_id_in, user_id_in);

END |
DELIMITER ;  -- On remet le délimiteur par défaut


