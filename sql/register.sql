
DROP  PROCEDURE IF EXISTS register;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE register(IN name_in VARCHAR(200),IN surname_in VARCHAR(200),IN email_in VARCHAR(200),IN password_in VARCHAR(200),IN status_in VARCHAR(200))  
    
BEGIN
    INSERT INTO `users`(name,surname,email,password,status,`validation`,token)
VALUES
(name_in,surname_in,email_in,password_in,status_in,false,sha1(email_in));
    select sha1(email_in) as token;
END |
DELIMITER ;  -- On remet le délimiteur par défaut
