
DROP  PROCEDURE IF EXISTS validation;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE validation(IN token_in VARCHAR(200))

BEGIN
  update users
  set validation=TRUE
  where token=token_in;
END |
DELIMITER ;  -- On remet le délimiteur par défaut
