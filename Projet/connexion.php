<!DOCTYPE html>

<!--####################################
 Auteur : Groupe 3
 Date : 2018
 Contexte : Projet Web Exia CESI
 #######################################-->

<html>

    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />

        <title>BDE Arras</title>
    </head>

    <header>
	<?php include("header.php"); ?>
    </header>
	
    <body>
		<div class="wrapper">

			<form method="POST" action="scriptConnexion.php">
					<fieldset><legend>Login : </legend><input type="text" name="login" placeholder="xyz@example.com" ></fieldset>
					<fieldset><legend>Mot de passe : </legend><input type="pass" name="motdepasse" placeholder="Mot de passe" /></fieldset>
					<input type="submit" name="submit" value="Se connecter"/>
			</form>

		
		</div>
    </body>
	
	<footer>
	<?php include("footer.php"); ?>
	</footer>

</html>