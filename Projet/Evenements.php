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
		
				<div class="even1">
				
					<h3>Evénements à venir :</h3>
					
						<ul>
							<fieldset>
							
								<a href="even1.php"> > FOOT < </a>
								
								<fieldset class="inner">
								
									<img class="ballon" src="image/foot.png">
									<p class="description">
										Partie de foot avec l'Exia et l'EI.
									</p>
									
								</fieldset>

							</fieldset>
						</ul>
						
						<ul>
							<fieldset>
							
								<a href="even2.php"> > LAN < </a>
								
								<fieldset class="inner">
								
									<p class="description">
										LAN party
									</p>
									
								</fieldset>

							</fieldset>
						</ul>
						

				</div>
				
				<div class="even2">
				
					<h3>Evénements terminés :</h3>
					
						<ul>
							<fieldset>
								<a href="Index.php"> > FOOT < </a>
								<fieldset class="inner">
									<p class="description">
										Partie de foot
									</p>
								</fieldset>
							</fieldset>
						</ul>
						
						<ul>
							<fieldset>
								<a href="Index.php"> > LAN < </a>
								<fieldset class="inner">
									<p class="description">
										LAN party
									</p>
								</fieldset>
							</fieldset>
						</ul>
						

				</div>
				
		</div>
    </body>
	
	
	<footer>
	<?php include("footer.php"); ?>
	</footer>

</html>