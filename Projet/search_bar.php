<!DOCTYPE html>

<!--####################################
 Auteur : Groupe 3
 Date : 2018
 Contexte : Projet Web Exia CESI
 #######################################-->

<html>

    <head>
        <meta charset="utf-8" />


        <title>BDE Arras</title>
    </head>

  
	
    <body>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
    
    <form> 

        <input type="text" id="recherche" />
 
        <script>

        $('#recherche').autocomplete({
        source : 'list.php'
        });

        </script>

    </form>

    </body>

</html>