DELIMITER |

CREATE PROCEDURE Delete_Pic(IN picture_id_in INT)      

    

BEGIN
DELETE FROM comments
WHERE comments.picture_id = picture_id_in;
DELETE FROM appreciate
WHERE appreciate.picture_id = picture_id_in;
DELETE FROM pictures
WHERE pictures.picture_id = picture_id_in;
END |