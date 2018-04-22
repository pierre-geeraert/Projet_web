DELIMITER |
CREATE PROCEDURE `notification` (IN `user_id_in`INT)


BEGIN

SELECT date, description, user_sent_id
FROM notification
WHERE user_notif_id = user_id_in;

SELECT name, surname
FROM user
WHERE user_id = (
    SELECT user_sent_id
    FROM notif
    WHERE user_notif_id = user_id_in
);

END |