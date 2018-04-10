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
                <form  method="post" action="scriptInscription.php" autocomplete="on"> 
                    <h1> Inscription </h1> 

                        <p> 
                                    <label for="lastnamesignup" class="uname"  > </label>
                                    <input id="Nom" class="champ" name="Nom" required="required" type="text" placeholder="Nom" />
						</p>
                      
                         <p> 
                                    <label for="firstnamesignup" class="uname"  > </label>
                                    <input id="Prenom" class="champ" name="Prenom" required="required" type="text" placeholder="Prenom" />
						</p>
						
						<p> 
                                    <label for="usernamesignup" class="uname"  > </label>
                                    <input id="Email" class="champ" name="Email" required="required" type="text" placeholder="Email" />
						</p>
                        
						<p> 
                                    <label for="passwordsignup" class="youpasswd"  > </label>
                                    <input id="Mdp" class="champ" name="Mdp" required="required" type="password"  placeholder="Mdp" onBlur="verifMotdepasse(this)"/>
                        </p>
                        <p> 
                                    <label for="statutsignup" class="uname"  > </label>
                                    <input id="Statut" class="champ" name="Statut" required="required" type="text" placeholder="Statut" />
						</p>
                                
						<p class="signin button"> 
                                    <input type="submit" value="S'inscrire"/> 
						</p>
						<p class="change_link">  
                                    Déjà inscrit ?
                                    <a href="connexion.php">Connexion</a>
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