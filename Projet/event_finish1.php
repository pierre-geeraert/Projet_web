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
		<div class="even_individuel">

			<h3>FOOT du 15 janvier</h3>
						
			<ul>
				<fieldset>
								
					<img class="ballon" src="image/foot.png">
					<p class="description">
						La sortie a eu lieu au City Stade des Hochettes. 
					</p>
									
				</fieldset>
				
			</ul>
			<ul>
				<form method="post" action="img.php" enctype="multipart/form-data">
				<input type="file" name="image" />
				<input type="submit" name="submit" value="Envoyer" />
				</form>
			</ul>

	</div>
    </div>
    </body>
	
	<footer>
	<?php include("footer.php"); ?>
	</footer>

</html>
