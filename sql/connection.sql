DROP  PROCEDURE IF EXISTS connection;

DELIMITER | -- Facultatif si votre délimiteur est toujours |

CREATE PROCEDURE connection(IN email_in VARCHAR(200),IN password_in VARCHAR(200))  
    
BEGIN
    	select email, password from users where users.email=email_in and password=password_in limit 1;
END |

DELIMITER ;  -- On remet le délimiteur par défaut


