DROP  PROCEDURE IF EXISTS connexion;

DELIMITER | -- Facultatif si votre délimiteur est toujours |

CREATE PROCEDURE connection(IN email VARCHAR(200),IN password VARCHAR(200))  
    
BEGIN
    	select email, password from users where email=email and password=password;
END |

DELIMITER ;  -- On remet le délimiteur par défaut


