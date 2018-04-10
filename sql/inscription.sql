DROP  PROCEDURE IF EXISTS inscription;
DELIMITER | -- Facultatif si votre délimiteur est toujours |
CREATE PROCEDURE inscription(IN nom VARCHAR(200),IN Prenom VARCHAR(200),IN Email VARCHAR(200),IN Mdp VARCHAR(200),IN Statut VARCHAR(200))  
    
BEGIN
    select 
END |
DELIMITER ;  -- On remet le délimiteur par défaut
