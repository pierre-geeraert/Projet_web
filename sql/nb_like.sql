DELIMITER |

CREATE PROCEDURE nb_like(IN pictures_id_in INT)
BEGIN

SELECT COUNT(*)
FROM appreciate
WHERE picture_id = pictures_id_in;

END |