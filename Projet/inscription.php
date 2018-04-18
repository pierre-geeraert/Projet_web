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
        <link rel="stylesheet" href="css/Form_Incri.css"/>
        <script src="Password.js"async></script>
        <script src="Verify.js"async></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                    <input id="Nom" class="champ" name="Nom" required="required" type="text" placeholder="Nom" />  <!-- Enter a name -->
						</p>
                      
                         <p> 
                                    <label for="firstnamesignup" class="uname"  > </label>
                                    <input id="Prenom" class="champ" name="Prenom" required="required" type="text" placeholder="Prenom" /> <!-- Enter a firstname -->
						</p>
						
						<p> 
                                    <label for="usernamesignup" class="uname"  > </label>
                                    <input id="Email" class="champ" name="Email" required="required" type="email" placeholder="Email" /> <!-- Enter a mail -->
						</p>
                        
						<p> 
                                    <label for="passwordsignup" class="youpasswd"  > </label>
                                    <input id="Mdp" class="champ" name="Mdp" required="required" type="password"  placeholder="Mdp" > <!-- Enter a password with some conditions : -->
                        </p>
                                     <div id="message">
                                    <h3>Le mot de passe doit contenir:</h3>                  
                                    <p id="letter" class="invalid">Une <b>minuscule</b></p>
                                    <p id="capital" class="invalid">Une <b>majuscule</b> </p>
                                    <p id="number" class="invalid">Un<b>nombre</b></p>
                                    <p id="length" class="invalid">Minimum <b>8 caractères</b></p>
                                        </div>
                        <p> 
                            <select id="Statut" class="champ" name="Statut" required="required" type="text" placeholder="Statut">

                                <option>BDE</option>

                                <option>Etudiant</option>

                                <option>Tuteur</option>

                            </select>
						</p>
                                
						<p class="signin_button"> 
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