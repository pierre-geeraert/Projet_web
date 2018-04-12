DROP  PROCEDURE IF EXISTS test_email;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE test_email(IN email_in VARCHAR(200))

BEGIN
    select * from users where email=email_in;
END |
DELIMITER ;  -- On remet le délimiteur par défaut

