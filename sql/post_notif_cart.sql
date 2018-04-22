DELIMITER |
CREATE PROCEDURE `post_notif_cart` ()


BEGIN

SELECT user_id
FROM users
WHERE satus = 'BDE';

END |