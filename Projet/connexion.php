<!DOCTYPE html>

<!--####################################
 Auteur : Groupe 3
 Date : 2018
 Contexte : Projet Web Exia CESI
 #######################################-->

<html>

    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet"href="css/Form_Incri.css" />
        <script src="Vérification.js"async></script>

        <title>BDE Arras</title>
    </head>

    <!-- L'en-tête -->    
    <header>
	
	<?php include("header.php"); ?>

    </header>
    <body>
	<div class="wrapper">
    <section>
			<div id="register" class="Inscri">
                <form  method="post" action="scriptConnexion.php" autocomplete="on"> 
                    <h1> Connexion </h1> 
						
						<p> 
                                    <label for="usernamesignup" class="uname"  > </label>
                                    <input id="Email" class="champ" name="login" required="required" type="text" placeholder="Email" />
						</p>
                        
						<p> 
                                    <label for="passwordsignup" class="youpasswd"  > </label>
                                    <input id="Mdp" class="champ" name="motdepasse" required="required" type="password"  placeholder="Mot de passe"/>
                        </p>
                                
						<p class="signin button"> 
                                    <input type="submit" value="Connexion"/> 
						</p>
						<p class="change_link">  
                                    Pas encore inscrit ?
                                    <a href="inscription.php">Inscription</a>
						</p>
                </form>
            </div>
						
		</section>

    <section>
	
	
	
	</section>
    </div>
    </body>
	
	<footer>
	
	<?php include("footer.php"); ?>
	
	</footer>

</html>