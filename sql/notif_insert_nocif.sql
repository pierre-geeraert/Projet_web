DELIMITER |
CREATE PROCEDURE `notif_insert_nocif` (IN user_notif_id_in INT,IN user_sent_id_in INT,IN date_in DATE,IN picture_id_in INT,IN description_in VARCHAR(250))


BEGIN

INSERT INTO notification(user_notif_id, user_sent_id, date, type, picture_id, description)
VALUES (user_notif_id_in, user_sent_id_in, date_in, '0', order_id_in, description_in);

END |