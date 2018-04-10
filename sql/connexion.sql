DROP  PROCEDURE IF EXISTS connexion;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE connexion(IN nom VARCHAR(200),IN Prenom VARCHAR(200))  
    
BEGIN
    	select "login good" 
	from utilisateurs 
	where (
		select 1 
		from utilisateurs 
		where Nom="brunelot" and Prenom="romain"
		) limit 1;
END |
DELIMITER ;  -- On remet le délimiteur par défaut


