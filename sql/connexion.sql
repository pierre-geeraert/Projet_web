
IF EXISTS(SELECT 1 FROM utilisateurs WITH(NOLOCK)
          WHERE IdUsers = 1)
    BEGIN
        PRINT 'Record Exists'
    END
ELSE
    BEGIN
        PRINT 'Record doesn''t Exists'
    END


SELECT 'Record Exist'
WHERE EXISTS(select 1 from utilisateurs where Nom="brunelot" and Prenom="romain");
